<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Appointment;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

use App\Models\attachment;

class AppointmentController extends Controller
{


    public function checkout($scheduleId)
    {


        try {



            // فك تشفير الـ scheduleId
            $scheduleData = explode('_', $scheduleId);

            if (count($scheduleData) < 3) {
                abort(404, 'معرف الموعد غير صحيح');
            }

            $scheduleId = $scheduleData[0];
            $date = $scheduleData[1];
            // إصلاح تنسيق الوقت (تحويل 0900 إلى 09:00)
            $rawTime = $scheduleData[2];
            if (strlen($rawTime) == 4) {
                $time = substr($rawTime, 0, 2) . ':' . substr($rawTime, 2, 2);
            } else {
                $time = str_replace('_', ':', $rawTime);
            }

            // الحصول على الجدول والطبيب
            $schedule = Schedule::with('doctor.doctorProfile')->findOrFail($scheduleId);
            $doctor = $schedule->doctor;
            //return $doctor;
            return view('frontend.doctor.booksteptow', compact('doctor', 'schedule', 'date', 'time'));
        } catch (\Exception $e) {
            return redirect()->route('doctorshome.book', $doctor->id ?? 1)->with('error', 'حدث خطأ في تحميل صفحة الحجز');
        }
    }


    public function confirmation($id)
    {



        // تحقق من صحة الـ ID
        if (!is_numeric($id)) {
            \Log::error('Invalid appointment ID: ' . $id);
            return redirect()->route('patient.appointments')->with('error', 'معرف الموعد غير صحيح');
        }

        // البحث بدون شرط patient_id أولاً للتحقق
        $appointment = Appointment::with(['doctor', 'medicalCenter'])->find($id);

        if (!$appointment) {
            \Log::error('Appointment not found in database. ID: ' . $id);
            return redirect()->route('patient.appointments')->with('error', 'الموعد غير موجود في النظام');
        }

        \Log::info('Appointment found. Patient ID: ' . $appointment->patient_id);
        \Log::info('Current user ID: ' . auth()->id());

        // التحقق من أن الموعد يخص المستخدم الحالي
        if ($appointment->patient_id != auth()->id()) {
            \Log::error('Appointment does not belong to user. Appointment patient: ' . $appointment->patient_id . ', Current user: ' . auth()->id());
            return redirect()->route('patient.appointments')->with('error', 'هذا الموعد لا ينتمي لك');
        }
        \Log::info('=== Confirmation Success ===');


        return view('patient.bookingsuccess', compact('appointment'));
    }

    public function store(Request $request)
    {
        try {


            \Log::info('=== Store Method Started ===');
            \Log::info('User authenticated: ' . (auth()->check() ? 'YES' : 'NO'));
            \Log::info('User ID: ' . (auth()->check() ? auth()->id() : 'Not logged in'));
            \Log::info('Request data:', $request->all());

            // إذا كان المستخدم غير مسجل دخول
            if (!auth()->check()) {
                \Log::error('User not authenticated in store method');
                return redirect()->route('login')->with('error', 'يجب تسجيل الدخول أولاً');
            }

            $validated = $request->validate([
                'doctor_id' => 'required|exists:users,id',
                'schedule_id' => 'required|exists:schedules,id',
                'appointment_date' => 'required|date',
                'appointment_time' => 'required',
                'appointment_for' => 'required|in:self,dependent',
                'dependent_id' => 'required_if:appointment_for,dependent',
                'reason' => 'required|string|max:400',
                'symptoms' => 'nullable|string|max:255',
                'has_insurance' => 'required|boolean',
                'insurance_company' => 'required_if:has_insurance,1',
                'insurance_number' => 'required_if:has_insurance,1',
                'attachments.*' => 'nullable|file|max:5120|mimes:jpg,jpeg,png,pdf,doc,docx'
            ]);

            // دمج التاريخ والوقت
            $scheduledFor = \Carbon\Carbon::parse($validated['appointment_date'] . ' ' . $validated['appointment_time']);

            // حساب وقت الانتهاء (افتراضياً 3 ساعات للنطاق، أو حسب الجدول)
            // يمكن جلب الجدول للتحقق من المدة المحددة
            $schedule = Schedule::find($validated['schedule_id']);
            $duration = 180; // 3 ساعات افتراضياً للنطاقات
            $scheduledUntil = $scheduledFor->copy()->addMinutes($duration);

            // إنشاء الموعد
            $appointment = Appointment::create([
                'patient_id' => auth()->id(),
                'doctor_id' => $validated['doctor_id'],
                'schedule_id' => $validated['schedule_id'],
                'scheduled_for' => $scheduledFor,
                'scheduled_until' => $scheduledUntil,
                'duration' => $duration,
                'appointment_for' => $validated['appointment_for'],
                'dependent_id' => $validated['dependent_id'] ?? null,
                'reason' => $validated['reason'],
                'symptoms' => $validated['symptoms'],
                'insurance_covered' => $validated['has_insurance'],
                'insurance_details' => $validated['has_insurance'] ? [
                    'company' => $validated['insurance_company'],
                    'number' => $validated['insurance_number']
                ] : null,
                'status' => 'pending',
                'original_fee' => $request->consultation_fee,
                'final_fee' => $request->consultation_fee,
                'type' => 'direct_visit',
                'mode' => 'online',
            ]);

            \Log::info('Appointment created successfully. ID: ' . $appointment->id);

            // التوجيه إلى صفحة التأكيد
            return redirect()->route('appointments.confirmation', $appointment->id)
                ->with('success', 'تم حجز الموعد بنجاح');
        } catch (\Exception $e) {
            \Log::error('Appointment creation error: ' . $e->getMessage());
            return back()->with('error', 'حدث خطأ أثناء الحجز: ' . $e->getMessage())->withInput();
        }
    }


    public function index(Request $request)
    {
        $doctor = Auth::user();

        $baseQuery = $doctor->doctorAppointments()->with('patient');

        // تطبيق الفلاتر
        if ($request->filled('search')) {
            $baseQuery->whereHas('patient', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // تحديث الترتيب لاستخدام scheduled_for بدلاً من appointment_time
        $upcomingAppointments = (clone $baseQuery)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('scheduled_for', '>', now()) // فقط المواعيد القادمة
            ->orderBy('scheduled_for', 'asc')
            ->paginate(10, ['*'], 'upcoming_page');

        $completedAppointments = (clone $baseQuery)
            ->where('status', 'completed')
            ->orderBy('scheduled_for', 'desc')
            ->paginate(10, ['*'], 'completed_page');

        $cancelledAppointments = (clone $baseQuery)
            ->where('status', 'cancelled')
            ->orderBy('scheduled_for', 'desc')
            ->paginate(10, ['*'], 'cancelled_page');

        // جلب عدد المواعيد لكل تبويب (بدون ترقيم صفحات)
        $upcomingCount = (clone $baseQuery)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('scheduled_for', '>', now())
            ->count();

        $completedCount = (clone $baseQuery)
            ->where('status', 'completed')
            ->count();

        $cancelledCount = (clone $baseQuery)
            ->where('status', 'cancelled')
            ->count();

        return view('doctor.appointments.index', compact(
            'upcomingAppointments',
            'completedAppointments',
            'cancelledAppointments',
            'upcomingCount',
            'completedCount',
            'cancelledCount'
        ));
    }



    // public function payment($id)
    // {
    //     try {
    //         $appointment = Appointment::with(['doctor', 'patient'])
    //             ->where('patient_id', auth()->id())
    //             ->findOrFail($id);

    //         return view('frontend.appointments.payment', compact('appointment'));
    //     } catch (\Exception $e) {
    //         return redirect()->route('home')->with('error', 'لم يتم العثور على الموعد');
    //     }
    // }


    // public function processPayment(Request $request, $id)
    // {
    //     try {
    //         $appointment = Appointment::where('patient_id', auth()->id())
    //             ->findOrFail($id);

    //         $request->validate([
    //             'payment_method' => 'required|in:credit_card,apple_pay,mada'
    //         ]);

    //         // معالجة الدفع هنا
    //         $appointment->update([
    //             'status' => 'confirmed',
    //             'confirmed_at' => now()
    //         ]);

    //         return redirect()->route('appointments.confirmation', $appointment->id)
    //             ->with('success', 'تم الدفع وتأكيد الموعد بنجاح');
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'حدث خطأ أثناء معالجة الدفع: ' . $e->getMessage());
    //     }
    // }



    private function isSlotAvailable($doctorId, $date, $time)
    {
        // التحقق من المواعيد المحجوزة
        $existingAppointment = Appointment::where('doctor_id', $doctorId)
            ->where('appointment_date', $date)
            ->where('appointment_time', $time)
            ->whereIn('status', ['confirmed', 'pending'])
            ->exists();

        return !$existingAppointment;
    }
}
