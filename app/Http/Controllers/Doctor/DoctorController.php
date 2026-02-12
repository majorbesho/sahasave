<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Specialty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Models\MedicalCenter;
use Illuminate\Pagination\LengthAwarePaginator;

class DoctorController extends Controller
{
    private const DOCTORS_PER_PAGE = 10;
    private const CACHE_TTL = 600; // 10 دقائق

    /**
     * عرض قائمة الأطباء (نسخة نهائية محسنة)
     */
    public function index()
    {
        $page = request()->input('page', 1);
        $cacheKey = "doctors:index:v6:page:{$page}";

        // جلب البيانات من الكاش أو تحديثها
        $data = Cache::remember($cacheKey, self::CACHE_TTL, function () use ($page) {
            return $this->getDoctorsPageData($page);
        });

        // التحقق من سلامة البيانات في الكاش
        if (!isset($data['doctors_items'])) {
            Cache::forget($cacheKey);
            return redirect()->refresh();
        }

        // تحويل البيانات المخزنة إلى كائنات Laravel Paginator
        $specialties = $data['specialties'];
        $doctors = new LengthAwarePaginator(
            $data['doctors_items'],
            $data['doctors_total'],
            self::DOCTORS_PER_PAGE,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('frontend.doctor.index', compact('doctors', 'specialties'));
    }

    /**
     * جلب البيانات الطازجة من قاعدة البيانات
     */
    private function getDoctorsPageData(int $page): array
    {
        // 1. جلب التخصصات (مع الكاش الخاص بها)
        $specialties = Cache::remember('specialties:active:list', 3600, function () {
            return Specialty::whereNull('parent_id')
                ->with(['activeChildren' => function ($query) {
                    $query->withCount('doctors');
                }])
                ->withCount('doctors as active_doctors_count')
                ->get();
        });

        // 2. استعلام الأطباء الأساسي
        $query = User::doctors()
            ->where('status', 'active')
            ->select(['id', 'name', 'photo', 'email'])
            ->with(['doctorProfile' => function ($q) {
                $q->select(['id', 'doctor_id', 'slug', 'specialty_id', 'years_of_experience', 'is_verified', 'rating_count', 'consultation_fee'])
                    ->with(['specialty:id,name_ar,name_en']);
            }]);

        // 3. تطبيق الترتيب أو البحث (إذا لزم الأمر مستقبلاً)
        $query->latest();

        // 4. تنفيذ التنضيد (Pagination)
        $total = $query->count();
        $doctors = $query->skip(($page - 1) * self::DOCTORS_PER_PAGE)
            ->take(self::DOCTORS_PER_PAGE)
            ->get();

        // 5. الهيدرة اليدوية للمراكز الطبية (لتحسين الأداء وتجنب N+1)
        if ($doctors->isNotEmpty()) {
            $this->hydrateMedicalCenters($doctors);
        }

        return [
            'specialties' => $specialties,
            'doctors_items' => $doctors,
            'doctors_total' => $total
        ];
    }

    /**
     * هيدرة المراكز الطبية بكفاءة عالية
     */
    private function hydrateMedicalCenters($doctors): void
    {
        $doctorIds = $doctors->pluck('id')->toArray();

        $medicalCenters = DB::table('medical_centers')
            ->join('doctor_medical_center', 'medical_centers.id', '=', 'doctor_medical_center.medical_center_id')
            ->whereIn('doctor_medical_center.user_id', $doctorIds)
            ->select('medical_centers.*', 'doctor_medical_center.user_id as doctor_id')
            ->get()
            ->groupBy('doctor_id');

        foreach ($doctors as $doctor) {
            $doctor->setRelation('medicalCenters', $medicalCenters->get($doctor->id, collect()));
        }
    }

    // ... (بقية الميثودات مثل search و schedules تبقى كما هي أو تحسن لاحقاً)

    public function search(Request $request)
    {
        // ... سيتم دمجها مع منطق الـ SearchController لاحقاً
        return redirect()->route('doctors.index', $request->all());
    }

    /**
     * عرض صفحة حجز موعد مع الطبيب
     */
    public function book($slug)
    {
        $doctor = User::doctors()
            ->whereHas('doctorProfile', function ($q) use ($slug) {
                $q->where('slug', $slug);
            })
            ->with(['doctorProfile.specialty', 'medicalCenters'])
            ->firstOrFail();

        $weekOffset = (int)request()->get('week', 0);
        $availableDays = $this->getAvailableDays($weekOffset);
        //return $doctor;

        return view('frontend.doctor.book', compact('doctor', 'availableDays', 'weekOffset'));
    }

    /**
     * جلب الأوقات المتاحة للطبيب في تاريخ معين
     */
    public function getAvailableTimes($slug)
    {
        $doctor = User::doctors()
            ->whereHas('doctorProfile', function ($q) use ($slug) {
                $q->where('slug', $slug);
            })
            ->firstOrFail();

        $id = $doctor->id;
        $date = request()->get('date');
        if (!$date) {
            return response()->json([]);
        }

        $carbonDate = Carbon::parse($date);
        $dayOfWeek = $carbonDate->dayOfWeek;

        // جلب الجداول المتاحة لهذا اليوم
        $schedules = Schedule::where('doctor_id', $id)
            ->where('day_of_week', $dayOfWeek)
            ->where('is_active', true)
            ->get();

        // جلب المواعيد المحجوزة مسبقاً لهذا اليوم لتجنب التكرار
        $appointments = Appointment::where('doctor_id', $id)
            ->whereDate('scheduled_for', $date)
            ->whereIn('status', ['scheduled', 'confirmed'])
            ->get();

        $allSlots = [];
        foreach ($schedules as $schedule) {
            // نستخدم ميثود getAvailableSlots الموجودة في موديل Schedule
            $slots = $schedule->getAvailableSlots($date, $appointments);
            foreach ($slots as &$slot) {
                $slot['schedule_id'] = $schedule->id;
            }
            $allSlots = array_merge($allSlots, $slots);
        }

        return response()->json($allSlots);
    }

    /**
     * عرض الملف الشخصي للطبيب
     */
    public function show($slug)
    {
        $doctor = User::doctors()
            ->whereHas('doctorProfile', function ($q) use ($slug) {
                $q->where('slug', $slug);
            })
            ->with([
                'doctorProfile.specialty',
                'medicalCenters',
                'educations',
                'experiences',
                'awards'
            ])
            ->firstOrFail();

        return view('frontend.doctor.show', compact('doctor'));
    }

    /**
     * صفحة إنشاء حجز جديد (عامة)
     */
    public function bookingcreate(Request $request)
    {
        // 1. If doctor_id is provided, redirect to specific doctor booking
        if ($request->has('doctor_id')) {
            $doctor = User::doctors()
                ->where('id', $request->doctor_id)
                ->with('doctorProfile')
                ->first();

            if ($doctor && $doctor->doctorProfile && $doctor->doctorProfile->slug) {
                return redirect()->route('doctors.book', $doctor->doctorProfile->slug);
            }
        }

        // 2. If center_id is provided, redirect to general center booking
        if ($request->has('center_id')) {
            $center = MedicalCenter::find($request->center_id);
            if ($center && $center->slug) {
                return redirect()->route('medical-centershome.book-general', $center->slug);
            }
        }

        // Fallback: redirect to doctors index
        return redirect()->route('doctors.index')->with('info', 'يرجى اختيار طبيب للمتابعة في الحجز');
    }

    /**
     * توليد قائمة بالأيام المتاحة للحجز
     */
    private function getAvailableDays(int $weekOffset = 0): array
    {
        $days = [];
        // نبدأ من بداية الأسبوع الحالي (الأحد)
        $startDate = now()->startOfWeek(Carbon::SUNDAY)->addWeeks($weekOffset);

        for ($i = 0; $i < 7; $i++) {
            $date = $startDate->copy()->addDays($i);
            $days[] = [
                'date' => $date->format('Y-m-d'),
                'day_name' => $date->format('l'),
                'day_name_arabic' => Schedule::DAYS_OF_WEEK_ARABIC[$date->dayOfWeek] ?? 'غير معروف',
                'display_date' => $date->format('d M'),
                'display_year' => $date->format('Y'),
                'day_of_week' => $date->dayOfWeek,
                'is_past' => $date->isPast() && !$date->isToday()
            ];
        }
        return $days;
    }
}
