<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ScheduleController extends Controller
{
    

    public function bookedSlots(Request $request)
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $doctor = Auth::user();

        // جلب المواعيد المحجوزة في التاريخ المحدد
        $bookedAppointments = \App\Models\Appointment::where('doctor_id', $doctor->id)
            ->whereDate('scheduled_for', $request->date)
            ->whereIn('status', ['confirmed', 'pending'])
            ->get();

        $bookedSlots = [];
        foreach ($bookedAppointments as $appointment) {
            $bookedSlots[] = $appointment->scheduled_for->format('H:i');
        }

        // جلب الجداول المحجوزة في نفس التاريخ
        $bookedSchedules = $doctor->schedules()
            ->where('date', $request->date)
            ->get();

        foreach ($bookedSchedules as $schedule) {
            $start = \Carbon\Carbon::parse($schedule->start_time);
            $end = \Carbon\Carbon::parse($schedule->end_time);

            while ($start < $end) {
                $bookedSlots[] = $start->format('H:i');
                $start->addMinutes(15); // حجز كل ربع ساعة داخل النطاق
            }
        }

        return response()->json([
            'booked_slots' => array_unique($bookedSlots)
        ]);
    }

    public function index()
    {
        $doctor = Auth::user();
        $medicalCenters = $doctor->medicalCenters()->where('is_active', true)->get();

        $schedules = $doctor->schedules()
            ->with('medicalCenter')
            ->get()
            ->groupBy(['day_of_week', 'medical_center_id']);

        $daysOfWeek = [
            1 => 'الإثنين',
            2 => 'الثلاثاء',
            3 => 'الأربعاء',
            4 => 'الخميس',
            5 => 'الجمعة',
            6 => 'السبت',
            0 => 'الأحد'
        ];

        return view('doctor.schedule.index', compact('schedules', 'daysOfWeek', 'medicalCenters'));
    }

    public function calendarEvents(Request $request)
    {
        $doctor = Auth::user();
        $start = $request->get('start');
        $end = $request->get('end');

        $schedules = $doctor->schedules()
            ->where(function ($query) use ($start, $end) {
                $query->whereBetween('date', [$start, $end])
                    ->orWhere('is_recurring', true);
            })
            ->where('is_active', true)
            ->get();

        $events = [];
        foreach ($schedules as $schedule) {
            $events[] = [
                'id' => $schedule->id,
                'title' => $schedule->medicalCenter ? $schedule->medicalCenter->name : $schedule->clinic_name,
                'start' => $schedule->date ? $schedule->date . 'T' . $schedule->start_time : $this->getNextDate($schedule->day_of_week) . 'T' . $schedule->start_time,
                'end' => $schedule->date ? $schedule->date . 'T' . $schedule->end_time : $this->getNextDate($schedule->day_of_week) . 'T' . $schedule->end_time,
                'color' => $schedule->medicalCenter ? '#007bff' : '#28a745',
                'extendedProps' => [
                    'type' => $schedule->medicalCenter ? 'medical_center' : 'private',
                    'fee' => $schedule->consultation_fee,
                    'duration' => $schedule->session_duration
                ]
            ];
        }

        return response()->json($events);
    }

    private function getNextDate($dayOfWeek)
    {
        $today = Carbon::today();
        $targetDay = $today->copy()->startOfWeek()->addDays($dayOfWeek);

        if ($targetDay->lt($today)) {
            $targetDay->addWeek();
        }

        return $targetDay->format('Y-m-d');
    }

    public function store(Request $request)
    {
        $request->validate([
            'medical_center_id' => 'nullable|exists:medical_centers,id',
            'clinic_name' => 'required_if:medical_center_id,null|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'session_duration' => 'required|in:20,30,45,60,120,180',
            'appointment_type' => 'required|in:clinic,virtual,home',
            'consultation_fee' => 'required|numeric|min:0',
        ]);

        $doctor = Auth::user();

        if ($request->medical_center_id && !$doctor->medicalCenters()->where('medical_centers.id', $request->medical_center_id)->exists()) {
            return back()->with('error', 'المركز الطبي غير مصرح به.');
        }

        try {
            $scheduleData = [
                'medical_center_id' => $request->medical_center_id,
                'date' => $request->date,
                'day_of_week' => Carbon::parse($request->date)->dayOfWeek,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'session_duration' => $request->session_duration,
                'max_sessions' => $this->calculateMaxSessions($request->start_time, $request->end_time, $request->session_duration),
                'appointment_type' => $request->appointment_type,
                'consultation_fee' => $request->consultation_fee,
                'is_active' => true,
            ];

            if (!$request->medical_center_id) {
                $scheduleData['clinic_name'] = $request->clinic_name;
                $scheduleData['clinic_address'] = $request->clinic_address;
            }

            $schedule = $doctor->schedules()->create($scheduleData);

            return back()->with('success', 'تم إضافة الموعد بنجاح.');
        } catch (\Exception $e) {
            return back()->with('error', 'خطأ في إنشاء الموعد: ' . $e->getMessage());
        }
    }

    private function calculateMaxSessions($startTime, $endTime, $duration)
    {
        $start = Carbon::createFromFormat('H:i', $startTime);
        $end = Carbon::createFromFormat('H:i', $endTime);
        $totalMinutes = $end->diffInMinutes($start);

        return floor($totalMinutes / $duration);
    }

    // باقي الدوال تبقى كما هي
    public function update(Request $request, Schedule $schedule)
    {
        if ($schedule->doctor_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'session_duration' => 'required|in:20,30,45,60,120,180',
            'consultation_fee' => 'required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        $schedule->update($request->all());

        return back()->with('success', 'تم تحديث الموعد بنجاح.');
    }

    public function destroy(Schedule $schedule)
    {
        if ($schedule->doctor_id !== Auth::id()) {
            abort(403);
        }

        $schedule->delete();
        return back()->with('success', 'تم حذف الموعد بنجاح.');
    }






    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'medical_center_id' => 'nullable|exists:medical_centers,id',
    //         'clinic_name' => 'required_if:medical_center_id,null|string|max:255',
    //         'clinic_address' => 'nullable|string|max:500',
    //         'day_of_week' => 'nullable|integer|between:0,6',
    //         'date' => 'nullable|date|after_or_equal:today',
    //         'start_time' => 'required|date_format:H:i',
    //         'end_time' => 'required|date_format:H:i|after:start_time',
    //         'session_duration' => 'required|in:20,30,45,60',
    //         'max_sessions' => 'required|integer|min:1',
    //         'appointment_type' => 'required|in:clinic,virtual,home',
    //         'consultation_fee' => 'required|numeric|min:0',
    //         'discount' => 'nullable|numeric|min:0',
    //         'discount_type' => 'nullable|in:percentage,fixed',
    //         'is_recurring' => 'boolean'
    //     ]);

    //     $doctor = Auth::user();

    //     // إذا تم اختيار مركز طبي، التحقق من أن الطبيب تابع له
    //     if ($request->medical_center_id && !$doctor->medicalCenters()->where('medical_centers.id', $request->medical_center_id)->exists()) {
    //         return back()->with('error', 'المركز الطبي غير مصرح به.');
    //     }

    //     try {
    //         $scheduleData = [
    //             'medical_center_id' => $request->medical_center_id,
    //             'day_of_week' => $request->day_of_week,
    //             'date' => $request->date,
    //             'start_time' => $request->start_time,
    //             'end_time' => $request->end_time,
    //             'session_duration' => $request->session_duration,
    //             'max_sessions' => $request->max_sessions,
    //             'appointment_type' => $request->appointment_type,
    //             'consultation_fee' => $request->consultation_fee,
    //             'discount' => $request->discount,
    //             'discount_type' => $request->discount_type,
    //             'is_recurring' => $request->boolean('is_recurring'),
    //             'is_active' => true,
    //         ];

    //         // إذا لم يتم اختيار مركز طبي، إضافة بيانات العيادة الخاصة
    //         if (!$request->medical_center_id) {
    //             $scheduleData['clinic_name'] = $request->clinic_name;
    //             $scheduleData['clinic_address'] = $request->clinic_address;
    //             $scheduleData['clinic_phone'] = $request->clinic_phone;
    //         }

    //         $schedule = $doctor->schedules()->create($scheduleData);

    //         // التحقق من صحة الجدول
    //         if (!$schedule->validateSchedule()) {
    //             $schedule->delete();
    //             return back()->with('error', 'الجدول الزمني غير صالح. يرجى التحقق من الأوقات.');
    //         }

    //         return back()->with('success', 'تم إضافة الجدول بنجاح.');
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'خطأ في إنشاء الجدول: ' . $e->getMessage());
    //     }
    // }
    // public function update(Request $request, Schedule $schedule)
    // {
    //     // التأكد من ملكية الجدول
    //     if ($schedule->doctor_id !== Auth::id()) {
    //         abort(403);
    //     }

    //     $request->validate([
    //         'start_time' => 'required|date_format:H:i',
    //         'end_time' => 'required|date_format:H:i|after:start_time',
    //         'session_duration' => 'required|in:20,30,45,60',
    //         'max_sessions' => 'required|integer|min:1',
    //         'consultation_fee' => 'required|numeric|min:0',
    //         'discount' => 'nullable|numeric|min:0',
    //         'discount_type' => 'nullable|in:percentage,fixed',
    //         'is_active' => 'boolean'
    //     ]);

    //     $schedule->update($request->all());

    //     return back()->with('success', 'Schedule updated successfully.');
    // }

    // public function destroy(Schedule $schedule)
    // {
    //     if ($schedule->doctor_id !== Auth::id()) {
    //         abort(403);
    //     }

    //     $schedule->delete();

    //     return back()->with('success', 'Schedule deleted successfully.');
    // }



}
