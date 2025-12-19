<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Appointment;
use App\Models\MedicalCenter;
use App\Models\Reward;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class DoctorBookingController extends Controller
{



    public function show($doctorId)
    {

        $doctor = User::where('role', 'doctor')
            ->where('status', 'active')
            ->whereHas('doctorProfile')
            ->with(['doctorProfile', 'medicalCenters', 'schedules'])
            ->findOrFail($doctorId);

        $patient = Auth::user();

        // الحصول على المكافآت النشطة للمريض
        $activeRewards = $patient->activeRewards()->get();
        // الحصول على المراكز الطبية المتاحة للطبيب
        $medicalCenters = $doctor->medicalCenters()
            ->wherePivot('is_active', true)
            ->where('is_active', true)
            ->get();

        return view('frontend.doctor.booking', compact(
            'doctor',
            'patient',
            'activeRewards',
            'medicalCenters'
        ));
    }

    // معالجة الحجز
    public function store(Request $request, $doctorId)
    {
        $request->validate([
            'medical_center_id' => 'required|exists:medical_centers,id',
            'appointment_type' => 'required|in:consultation,follow_up,emergency',
            'appointment_mode' => 'required|in:in_person,virtual',
            'scheduled_date' => 'required|date|after:now',
            'scheduled_time' => 'required',
            'patient_notes' => 'nullable|string|max:500',
            'reward_id' => 'nullable|exists:rewards,id',
        ]);

        $doctor = User::where('role', 'doctor')
            ->where('status', 'active')
            ->whereHas('doctorProfile')
            ->findOrFail($doctorId);

        $patient = Auth::user();

        // التحقق من توفر الموعد
        $scheduledFor = Carbon::parse($request->scheduled_date . ' ' . $request->scheduled_time);

        if (!$this->isTimeSlotAvailable($doctor, $scheduledFor)) {
            return back()->withErrors(['scheduled_time' => 'هذا الموعد غير متاح. الرجاء اختيار وقت آخر.']);
        }

        // حساب الرسوم
        $fees = $this->calculateFees($doctor, $request->medical_center_id, $request->appointment_type);

        // تطبيق الخصومات والمكافآت
        $discountAmount = 0;
        $appliedRewards = [];
        $rewardId = null;

        if ($request->reward_id) {
            $reward = Reward::where('id', $request->reward_id)
                ->where('user_id', $patient->id)
                ->where('status', 'active')
                ->where(function ($query) {
                    $query->whereNull('expires_at')
                        ->orWhere('expires_at', '>', now());
                })
                ->first();

            if ($reward) {
                $discountAmount = $reward->discount_amount;
                $appliedRewards = [$reward->id];
                $rewardId = $reward->id;

                // تحديث حالة المكافأة
                $reward->update(['status' => 'used', 'used_at' => now()]);
            }
        }

        $finalFee = max(0, $fees['consultation_fee'] - $discountAmount);

        // إنشاء الحجز
        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'medical_center_id' => $request->medical_center_id,
            'type' => $request->appointment_type,
            'mode' => $request->appointment_mode,
            'scheduled_for' => $scheduledFor,
            'scheduled_until' => $scheduledFor->copy()->addMinutes($fees['duration']),
            'duration' => $fees['duration'],
            'status' => 'scheduled',
            'original_fee' => $fees['consultation_fee'],
            'discount_amount' => $discountAmount,
            'final_fee' => $finalFee,
            'applied_rewards' => $appliedRewards,
            'patient_notes' => $request->patient_notes,
            'reward_id' => $rewardId,
        ]);

        // إرسال إشعارات
        $this->sendNotifications($appointment);

        return redirect()->route('appointments.confirmation', $appointment->id)
            ->with('success', 'تم حجز الموعد بنجاح!');
    }

    // التحقق من توفر الموعد
    private function isTimeSlotAvailable($doctor, $scheduledFor)
    {
        // التحقق من أن الموعد خلال ساعات العمل
        $dayOfWeek = $scheduledFor->dayOfWeek; // 0 (الأحد) إلى 6 (السبت)

        $schedule = $doctor->schedules()
            ->where('day_of_week', $dayOfWeek)
            ->where('is_active', true)
            ->first();

        if (!$schedule) {
            return false;
        }

        $startTime = Carbon::parse($schedule->start_time);
        $endTime = Carbon::parse($schedule->end_time);
        $appointmentTime = $scheduledFor->copy()->setDate(2000, 1, 1); // استخدام تاريخ افتراضي للمقارنة

        if ($appointmentTime->lt($startTime) || $appointmentTime->gt($endTime)) {
            return false;
        }

        // التحقق من عدم وجود موعد متعارض
        $conflictingAppointment = Appointment::where('doctor_id', $doctor->id)
            ->where('scheduled_for', '<=', $scheduledFor)
            ->where('scheduled_until', '>', $scheduledFor)
            ->whereIn('status', ['scheduled', 'confirmed'])
            ->exists();

        return !$conflictingAppointment;
    }

    // حساب الرسوم
    private function calculateFees($doctor, $medicalCenterId, $appointmentType)
    {
        $medicalCenter = $doctor->medicalCenters()
            ->where('medical_centers.id', $medicalCenterId)
            ->first();

        $consultationFee = $medicalCenter->pivot->consultation_fee ?? 100;
        $duration = $medicalCenter->pivot->appointment_duration ?? 30;

        // تعديل الرسوم حسب نوع الموعد
        if ($appointmentType === 'follow_up') {
            $consultationFee = $medicalCenter->pivot->follow_up_fee ?? ($consultationFee * 0.8);
        } elseif ($appointmentType === 'emergency') {
            $consultationFee *= 1.2; // زيادة 20% للحالات الطارئة
        }

        return [
            'consultation_fee' => $consultationFee,
            'duration' => $duration,
        ];
    }

    // إرسال الإشعارات
    private function sendNotifications($appointment)
    {
        // إرسال إشعار للمريض
        // يمكنك استخدام نظام الإشعارات الخاص بلارافيل أو البريد الإلكتروني

        // إرسال إشعار للطبيب
        // يمكنك استخدام نظام الإشعارات الخاص بلارافيل أو البريد الإلكتروني

        // مثال بإشعار بسيط
        // Notification::send($appointment->patient, new AppointmentBooked($appointment));
        // Notification::send($appointment->doctor, new NewAppointment($appointment));
    }

    // الحصول على الأوقات المتاحة
    public function getAvailableSlots($doctorId, Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'medical_center_id' => 'required|exists:medical_centers,id',
        ]);

        $doctor = User::findOrFail($doctorId);
        $date = Carbon::parse($request->date);
        $dayOfWeek = $date->dayOfWeek;

        $schedule = $doctor->schedules()
            ->where('day_of_week', $dayOfWeek)
            ->where('is_active', true)
            ->first();

        if (!$schedule) {
            return response()->json(['slots' => []]);
        }

        $startTime = Carbon::parse($schedule->start_time);
        $endTime = Carbon::parse($schedule->end_time);
        $duration = $schedule->appointment_duration ?? 30;

        $slots = [];
        $currentTime = $startTime->copy();

        while ($currentTime->lt($endTime)) {
            $slotTime = $date->copy()->setTime($currentTime->hour, $currentTime->minute);

            if ($slotTime->gt(now()) && $this->isTimeSlotAvailable($doctor, $slotTime)) {
                $slots[] = $currentTime->format('H:i');
            }

            $currentTime->addMinutes($duration);
        }

        return response()->json(['slots' => $slots]);
    }
}
