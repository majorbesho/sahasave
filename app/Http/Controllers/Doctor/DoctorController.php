<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;


use App\Models\Specialty;
use Carbon\Carbon;

class DoctorController extends Controller
{
    //



    public function index()
    {
        $specialties = Specialty::withCount(['activeDoctors as active_doctors_count'])

            ->active()
            ->ordered()

            ->get();




        $doctors = User::where('role', 'doctor')
            ->where('status', 'active')
            ->with(['doctorProfile.specialty', 'medicalCenters'])
            ->paginate(12);

        return view('frontend.doctor.index', compact('doctors', 'specialties'));
    }


    public function search(Request $request)
    {
        // بناء الاستعلام الأساسي
        $query = User::where('role', 'doctor')
            ->where('status', 'active')
            ->with(['doctorProfile.specialty', 'medicalCenters']);

        // البحث حسب التخصص
        if ($request->filled('specialties')) {
            $specialtyIds = (array) $request->specialties;
            $allSpecialtyIds = $this->getAllSpecialtyIds($specialtyIds);

            $query->whereHas('doctorProfile', function ($q) use ($allSpecialtyIds) {
                $q->whereIn('specialty_id', $allSpecialtyIds);
            });
        }

        // البحث حسب الاسم
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // البحث حسب الموقع
        if ($request->filled('location')) {
            $query->whereHas('medicalCenters', function ($q) use ($request) {
                $q->where('city', 'like', '%' . $request->location . '%')
                    ->orWhere('address', 'like', '%' . $request->location . '%');
            });
        }

        // البحث حسب الجنس
        if ($request->filled('gender')) {
            $query->whereIn('gender', (array) $request->gender);
        }

        // البحث حسب السعر
        if ($request->filled('price_min')) {
            $query->whereHas('doctorProfile', function ($q) use ($request) {
                $q->where('consultation_fee', '>=', $request->price_min);
            });
        }

        if ($request->filled('price_max')) {
            $query->whereHas('doctorProfile', function ($q) use ($request) {
                $q->where('consultation_fee', '<=', $request->price_max);
            });
        }

        // البحث حسب الخبرة
        if ($request->filled('experience')) {
            $query->whereHas('doctorProfile', function ($q) use ($request) {
                $experienceFilters = (array) $request->experience;
                $conditions = [];

                foreach ($experienceFilters as $exp) {
                    if ($exp === '2+') $conditions[] = ['years_of_experience', '>=', 2];
                    if ($exp === '5+') $conditions[] = ['years_of_experience', '>=', 5];
                    if ($exp === '7+') $conditions[] = ['years_of_experience', '>=', 7];
                    if ($exp === '10+') $conditions[] = ['years_of_experience', '>=', 10];
                }

                $q->where(function ($subQ) use ($conditions) {
                    foreach ($conditions as $condition) {
                        $subQ->orWhere([$condition]);
                    }
                });
            });
        }

        // البحث حسب التقييم
        if ($request->filled('rating')) {
            $query->whereHas('doctorProfile', function ($q) use ($request) {
                $ratingFilters = (array) $request->rating;
                $q->where(function ($subQ) use ($ratingFilters) {
                    foreach ($ratingFilters as $rating) {
                        $minRating = (float) $rating;
                        $subQ->orWhere('average_rating', '>=', $minRating);
                    }
                });
            });
        }

        // الترتيب
        $sort = $request->get('sort', 'name_asc');
        switch ($sort) {
            case 'price_asc':
                $query->join('doctor_profiles', 'users.id', '=', 'doctor_profiles.doctor_id')
                    ->orderBy('doctor_profiles.consultation_fee', 'asc');
                break;
            case 'price_desc':
                $query->join('doctor_profiles', 'users.id', '=', 'doctor_profiles.doctor_id')
                    ->orderBy('doctor_profiles.consultation_fee', 'desc');
                break;
            case 'rating':
                $query->join('doctor_profiles', 'users.id', '=', 'doctor_profiles.doctor_id')
                    ->orderBy('doctor_profiles.average_rating', 'desc');
                break;
            case 'experience':
                $query->join('doctor_profiles', 'users.id', '=', 'doctor_profiles.doctor_id')
                    ->orderBy('doctor_profiles.years_of_experience', 'desc');
                break;
            default:
                $query->orderBy('name', 'asc');
        }

        $doctors = $query->paginate(10);
        $specialties = $this->getSpecialtiesTree();

        // إحصائيات البحث
        // $totalDoctors = $doctors->total();

        return view('frontend.doctor.show', compact('doctors', 'specialties'));
    }

    private function getAllSpecialtyIds($selectedIds)
    {
        $allIds = [];
        foreach ($selectedIds as $id) {
            $specialty = Specialty::find($id);
            if ($specialty) {
                $allIds = array_merge($allIds, $specialty->getAllChildrenIds());
            }
        }
        return array_unique($allIds);
    }

    private function getSpecialtiesTree()
    {
        return Specialty::with(['activeChildren' => function ($query) {
            $query->withCount(['activeDoctors as doctors_count'])->ordered();
        }])
            ->main()
            ->active()
            ->withCount(['activeDoctors as doctors_count'])
            ->ordered()
            ->get();
    }







    private function getDayName($dayOfWeek)
    {
        $days = [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        ];
        return $days[$dayOfWeek] ?? 'Unknown';
    }
    private function getArabicDayName($dayOfWeek)
    {
        $arabicDays = [
            0 => 'الأحد',
            1 => 'الاثنين',
            2 => 'الثلاثاء',
            3 => 'الأربعاء',
            4 => 'الخميس',
            5 => 'الجمعة',
            6 => 'السبت'
        ];

        return $arabicDays[$dayOfWeek] ?? 'غير محدد';
    }

    // دالة جديدة لجلب الأوقات المتاحة ليوم معين

    private function isTimeSlotAvailable($schedule, $date)
    {
        // التحقق إذا كان الموعد محجوزاً مسبقاً
        $existingAppointment = Appointment::where('doctor_id', $schedule->doctor_id)
            ->where('scheduled_for', $date . ' ' . $schedule->start_time)
            ->whereIn('status', ['scheduled', 'confirmed'])
            ->exists();

        return !$existingAppointment;
    }

    public function bySpecialty($slug)
    {
        $specialty = Specialty::where('slug_' . app()->getLocale(), $slug)
            ->active()
            ->firstOrFail();

        $doctors = User::where('role', 'doctor')
            ->where('status', 'active')
            ->whereHas('doctorProfile', function ($q) use ($specialty) {
                $specialtyIds = $specialty->getAllChildrenIds();
                $q->whereIn('specialty_id', $specialtyIds);
            })
            ->with(['doctorProfile.specialty', 'medicalCenters'])
            ->paginate(12);

        $relatedSpecialties = Specialty::where('parent_id', $specialty->parent_id)
            ->where('id', '!=', $specialty->id)
            ->active()
            ->get();

        return view('frontend.doctors.specialty', compact('doctors', 'specialty', 'relatedSpecialties'));
    }









    public function show($id)
    {
        $doctor = User::where('role', 'doctor')
            ->where('status', 'active')
            ->with([
                'doctorProfile',
                'medicalCenters',
                'schedules',
                'experiences',           // ✅
                'educations',            // ✅
                'awards',                // ✅
                'insurances',            // ✅
                'clinics.gallery',       // ✅

            ])
            ->findOrFail($id);

        // تحقق إذا كان الطبيب يمتلك ملف تعريف
        if (!$doctor->doctorProfile) {
            abort(404, 'Doctor profile not found');
        }

        return view('frontend.doctor.show', compact('doctor'));
    }

    public function book($id)
    {
        $doctor = User::where('role', 'doctor')
            ->where('status', 'active')
            ->with([
                'doctorProfile',
                'medicalCenters',
                'activeSchedules.medicalCenter'
            ])
            ->findOrFail($id);
        // return $doctor;
        $schedulesByCenter = [];
        foreach ($doctor->activeSchedules as $schedule) {
            $centerId = $schedule->medical_center_id;
            if (!isset($schedulesByCenter[$centerId])) {
                $schedulesByCenter[$centerId] = [
                    'medical_center' => $schedule->medicalCenter,
                    'schedules' => []
                ];
            }
            $schedulesByCenter[$centerId]['schedules'][] = $schedule;
        }

        // جلب الأيام المتاحة للأسبوع الحالي
        $weekOffset = request()->get('week', 0);
        $availableDays = $this->getAvailableDays($doctor, $weekOffset);

        return view('frontend.doctor.book', compact('doctor', 'schedulesByCenter', 'availableDays', 'weekOffset'));
    }

    public function getAvailableTimes($id)
    {
        try {
            \Log::info('=== getAvailableTimes START ===');
            $date = request()->get('date');

            \Log::info('Request parameters:', ['id' => $id, 'date' => $date]);

            if (!$date) {
                \Log::warning('No date provided');
                return response()->json([]);
            }

            $doctor = User::where('role', 'doctor')
                ->where('status', 'active')
                ->with(['activeSchedules'])
                ->findOrFail($id);

            \Log::info('Doctor found:', ['doctor_id' => $doctor->id, 'schedules_count' => $doctor->activeSchedules->count()]);

            $dayOfWeek = Carbon::parse($date)->dayOfWeek;
            \Log::info('Date analysis:', ['date' => $date, 'day_of_week' => $dayOfWeek]);

            // الحصول على الجداول الخاصة بهذا اليوم
            $schedules = $doctor->activeSchedules->where('day_of_week', $dayOfWeek);
            \Log::info('Filtered schedules:', ['count' => $schedules->count()]);

            // Pre-fetch appointments for the doctor on this date to avoid N+1 queries
            $appointments = Appointment::where('doctor_id', $doctor->id)
                ->whereDate('scheduled_for', $date)
                ->whereIn('status', ['scheduled', 'confirmed'])
                ->get();

            $availableSlots = [];

            foreach ($schedules as $schedule) {
                \Log::info('Processing schedule:', [
                    'schedule_id' => $schedule->id,
                    'start_time' => $schedule->start_time,
                    'end_time' => $schedule->end_time,
                    'day_of_week' => $schedule->day_of_week
                ]);

                // استخدام الدالة الجديدة من نموذج Schedule مع تمرير المواعيد
                $slots = $schedule->getAvailableSlots($date, $appointments);

                // إضافة معلومات إضافية لكل slot
                foreach ($slots as &$slot) {
                    $slot['schedule_id'] = $schedule->id;
                    $slot['appointment_type'] = $schedule->appointment_type;
                    // لا نقوم بإعادة تعيين consultation_fee لأنها تأتي الآن مع الخصم من getAvailableSlots
                    // $slot['consultation_fee'] = $schedule->consultation_fee;
                }

                $availableSlots = array_merge($availableSlots, $slots);
            }

            \Log::info('Final slots:', ['total_slots' => count($availableSlots)]);
            \Log::info('=== getAvailableTimes END ===');

            return response()->json($availableSlots);
        } catch (\Exception $e) {
            \Log::error('Error in getAvailableTimes', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Internal server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    // دالة حجز وهمية مؤقتة لاستقبال البيانات من الرابط
    public function bookingcreate(Request $request)
    {
        // استقبال البيانات المرسلة من زر المتابعة للدفع
        $doctorId = $request->get('doctor_id');
        $scheduleId = $request->get('schedule_id');
        $appointmentDate = $request->get('appointment_date');
        $appointmentTime = $request->get('appointment_time');

        // جلب بيانات الطبيب والجدول لتأكيد الحجز
        $doctor = User::find($doctorId);
        $schedule = Schedule::find($scheduleId);

        // هنا يتم عرض صفحة تأكيد الدفع أو إدخال بيانات المريض
        return view('frontend.booking.confirm', compact('doctor', 'schedule', 'appointmentDate', 'appointmentTime'));
    }


    // private function getAvailableDays($doctor, $weekOffset = 0)
    // {
    //     $days = [];
    //     $startDate = now()->addWeeks($weekOffset)->startOfWeek();

    //     for ($i = 0; $i < 7; $i++) {
    //         $date = $startDate->copy()->addDays($i);
    //         $dayOfWeek = $date->dayOfWeek;

    //         // التحقق إذا كان الطبيب متاح في هذا اليوم
    //         $hasSchedule = $doctor->activeSchedules->contains(function ($schedule) use ($dayOfWeek) {
    //             return $schedule->day_of_week == $dayOfWeek && $schedule->is_active;
    //         });

    //         if ($hasSchedule) {
    //             $days[] = [
    //                 'date' => $date->format('Y-m-d'),
    //                 'day_name' => Schedule::DAYS_OF_WEEK[$dayOfWeek] ?? $this->getDayName($dayOfWeek),
    //                 'day_name_arabic' => Schedule::DAYS_OF_WEEK_ARABIC[$dayOfWeek] ?? $this->getArabicDayName($dayOfWeek),
    //                 'display_date' => $date->format('d M'),
    //                 'display_year' => $date->format('Y'),
    //                 'is_today' => $date->isToday(),
    //                 'day_of_week' => $dayOfWeek
    //             ];
    //         }
    //     }

    //     return $days;
    // }
    private function getAvailableDays($doctor, $weekOffset = 0)
    {
        $days = [];
        $startDate = now()->addWeeks($weekOffset)->startOfWeek();
        $today = now()->startOfDay();

        for ($i = 0; $i < 7; $i++) {
            $date = $startDate->copy()->addDays($i);
            $dayOfWeek = $date->dayOfWeek;

            // التحقق إذا كان الطبيب متاح في هذا اليوم والتاريخ ليس في الماضي
            $hasSchedule = $doctor->activeSchedules->contains(function ($schedule) use ($dayOfWeek) {
                return $schedule->day_of_week == $dayOfWeek && $schedule->is_active;
            });

            // منع التواريخ في الماضي
            $isFutureOrToday = $date->greaterThanOrEqualTo($today);

            if ($hasSchedule && $isFutureOrToday) {
                $days[] = [
                    'date' => $date->format('Y-m-d'),
                    'day_name' => Schedule::DAYS_OF_WEEK[$dayOfWeek] ?? $this->getDayName($dayOfWeek),
                    'day_name_arabic' => Schedule::DAYS_OF_WEEK_ARABIC[$dayOfWeek] ?? $this->getArabicDayName($dayOfWeek),
                    'display_date' => $date->format('d M'),
                    'display_year' => $date->format('Y'),
                    'is_today' => $date->isToday(),
                    'is_past' => $date->lessThan($today),
                    'day_of_week' => $dayOfWeek
                ];
            }
        }

        return $days;
    }



    // public function getAvailableTimes($id)
    // {
    //     try {
    //         $date = request()->get('date');

    //         \Log::info('Testing API - Date received: ' . $date);

    //         // بيانات تجريبية مؤقتة للتأكد من أن الـ API يعمل
    //         $testSlots = [
    //             [
    //                 'time' => '09:00',
    //                 'display' => '9:00 AM',
    //                 'is_available' => true,
    //                 'schedule_id' => 91,
    //                 'appointment_type' => 'clinic',
    //                 'consultation_fee' => '1000.00'
    //             ],
    //             [
    //                 'time' => '09:30',
    //                 'display' => '9:30 AM',
    //                 'is_available' => true,
    //                 'schedule_id' => 91,
    //                 'appointment_type' => 'clinic',
    //                 'consultation_fee' => '1000.00'
    //             ],
    //             [
    //                 'time' => '10:00',
    //                 'display' => '10:00 AM',
    //                 'is_available' => true,
    //                 'schedule_id' => 91,
    //                 'appointment_type' => 'clinic',
    //                 'consultation_fee' => '1000.00'
    //             ],
    //             [
    //                 'time' => '10:30',
    //                 'display' => '10:30 AM',
    //                 'is_available' => false,
    //                 'schedule_id' => 91,
    //                 'appointment_type' => 'clinic',
    //                 'consultation_fee' => '1000.00'
    //             ],
    //             [
    //                 'time' => '11:00',
    //                 'display' => '11:00 AM',
    //                 'is_available' => true,
    //                 'schedule_id' => 91,
    //                 'appointment_type' => 'clinic',
    //                 'consultation_fee' => '1000.00'
    //             ]
    //         ];

    //         \Log::info('Returning test slots: ' . count($testSlots));

    //         return response()->json($testSlots);
    //     } catch (\Exception $e) {
    //         \Log::error('Error in getAvailableTimes: ' . $e->getMessage());
    //         \Log::error('Stack trace: ' . $e->getTraceAsString());

    //         return response()->json([
    //             'error' => 'Internal server error',
    //             'message' => $e->getMessage()
    //         ], 500);
    //     }
    // }


    private function generateTimeSlots($schedule, $date)
    {
        try {
            // Log::info('Generating time slots for schedule', ['schedule_id' => $schedule->id]);

            $slots = [];
            $startTime = Carbon::createFromFormat('H:i', $schedule->start_time);
            $endTime = Carbon::createFromFormat('H:i', $schedule->end_time);
            $duration = $schedule->session_duration ?? 30; // 30 دقيقة كافتراضي

            $currentTime = $startTime->copy();

            // تهيئة تاريخ اليوم الحالي للمقارنة
            $fullDate = Carbon::parse($date);
            $now = Carbon::now();

            while ($currentTime->lessThan($endTime)) {
                $slotEnd = $currentTime->copy()->addMinutes($duration);

                if ($slotEnd->greaterThan($endTime)) {
                    break;
                }

                $timeString = $currentTime->format('H:i');
                $displayTime = $currentTime->format('g:i A');

                // دمج التاريخ مع الوقت لإنشاء نقطة زمنية كاملة للمقارنة
                $slotDateTime = Carbon::parse($date . ' ' . $timeString);

                // التحقق من أن النقطة الزمنية ليست في الماضي، باستثناء الدقائق القليلة الماضية
                $isPast = $slotDateTime->lt($now);
                if ($isPast) {
                    $currentTime->addMinutes($duration);
                    continue; // تخطي هذه الفترة إذا كانت قد مضت
                }

                $isAvailable = $this->isSlotAvailable($schedule->doctor_id, $date, $timeString);

                $slots[] = [
                    'time' => $timeString,
                    'display' => $displayTime,
                    'is_available' => $isAvailable,
                    'schedule_id' => $schedule->id,
                    'appointment_type' => $schedule->appointment_type,
                    'consultation_fee' => $schedule->consultation_fee ?? $schedule->doctor->doctorProfile->consultation_fee ?? 0,
                    'is_past' => $isPast
                ];

                $currentTime->addMinutes($duration);
            }

            return $slots;
        } catch (\Exception $e) {
            \Log::error('Error in generateTimeSlots: ' . $e->getMessage(), ['schedule_id' => $schedule->id]);
            return [];
        }
    }


    private function isSlotAvailable($doctorId, $date, $time)
    {
        // التحقق من المواعيد المحجوزة
        $existingAppointment = Appointment::where('doctor_id', $doctorId)
            ->where('appointment_date', $date)
            ->where('appointment_time', $time)
            ->whereIn('status', ['confirmed', 'pending']) // حالات الحجز التي تمنع الحجز مرة أخرى
            ->exists();

        return !$existingAppointment;
    }
}
