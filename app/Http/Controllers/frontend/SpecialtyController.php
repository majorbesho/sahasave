<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use App\Models\User;
use App\Models\DoctorProfile;
use App\Models\MedicalCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;




class SpecialtyController extends Controller
{
    // /**
    //  * عرض صفحة التخصص مع الأطباء
    //  */
    // public function show($slug)
    // {
    //     $locale = app()->getLocale();
    //     $slugField = $locale == 'ar' ? 'slug_ar' : 'slug_en';

    //     // جلب التخصص مع العلاقات
    //     $specialty = Specialty::where($slugField, $slug)
    //         ->withCount(['activeDoctors as doctors_count'])
    //         ->active()
    //         ->firstOrFail();

    //     // جلب الأطباء في هذا التخصص مع العلاقات
    //     $doctors = User::where('role', 'doctor')
    //         ->where('status', 'active')
    //         ->whereHas('doctorProfile', function ($query) use ($specialty) {
    //             $query->where('specialty_id', $specialty->id)
    //                 ->where('is_verified', true);
    //         })
    //         ->with([
    //             'doctorProfile',
    //             'medicalCenters' => function ($query) {
    //                 $query->select('id', 'name', 'city', 'address');
    //             }
    //         ])
    //         ->paginate(12);

    //     // جلب التخصصات الأخرى للمرشحات
    //     $otherSpecialties = Specialty::active()
    //         ->where('id', '!=', $specialty->id)
    //         ->withCount(['activeDoctors as doctors_count'])
    //         ->take(10)
    //         ->get();

    //     return view('frontend.specialties.show', compact(
    //         'specialty',
    //         'doctors',

    //     ));
    // }

    // /**
    //  * البحث والتصفية داخل التخصص
    //  */
    // public function filter(Request $request, $slug)
    // {
    //     $locale = app()->getLocale();
    //     $slugField = $locale == 'ar' ? 'slug_ar' : 'slug_en';

    //     $specialty = Specialty::where($slugField, $slug)
    //         ->active()
    //         ->firstOrFail();

    //     $query = User::where('role', 'doctor')
    //         ->where('status', 'active')
    //         ->whereHas('doctorProfile', function ($query) use ($specialty) {
    //             $query->where('specialty_id', $specialty->id)
    //                 ->where('is_verified', true);
    //         })
    //         ->with(['doctorProfile', 'medicalCenters']);

    //     // التصفية حسب الجنس
    //     if ($request->has('gender') && $request->gender != '') {
    //         $query->where('gender', $request->gender);
    //     }

    //     // التصفية حسب الموقع
    //     if ($request->has('location') && $request->location != '') {
    //         $query->where(function ($q) use ($request) {
    //             $q->where('address', 'like', "%{$request->location}%")
    //                 ->orWhereHas('medicalCenters', function ($centerQuery) use ($request) {
    //                     $centerQuery->where('city', 'like', "%{$request->location}%")
    //                         ->orWhere('address', 'like', "%{$request->location}%");
    //                 });
    //         });
    //     }

    //     // التصفية حسب الخبرة
    //     if ($request->has('experience') && $request->experience != '') {
    //         $query->whereHas('doctorProfile', function ($q) use ($request) {
    //             $q->where('years_of_experience', '>=', $request->experience);
    //         });
    //     }

    //     // التصفية حسب التقييم
    //     if ($request->has('rating') && $request->rating != '') {
    //         $query->whereHas('doctorProfile', function ($q) use ($request) {
    //             $q->where('average_rating', '>=', $request->rating);
    //         });
    //     }

    //     // الترتيب
    //     $sort = $request->get('sort', 'name');
    //     switch ($sort) {
    //         case 'experience':
    //             $query->orderByDesc('doctor_profiles.years_of_experience');
    //             break;
    //         case 'rating':
    //             $query->orderByDesc('doctor_profiles.average_rating');
    //             break;
    //         case 'price_low':
    //             $query->orderBy('doctor_profiles.consultation_fee');
    //             break;
    //         case 'price_high':
    //             $query->orderByDesc('doctor_profiles.consultation_fee');
    //             break;
    //         default:
    //             $query->orderBy('name');
    //     }

    //     $doctors = $query->paginate(12);

    //     return view('frontend.specialties.show', compact('specialty', 'doctors'));
    // }


    // public function index(Request $request)
    // {
    //     $query = Specialty::query()->where('is_active', true);

    //     // البحث حسب النص
    //     if ($request->has('search') && !empty($request->search)) {
    //         $search = $request->search;
    //         $locale = app()->getLocale();

    //         $query->where(function ($q) use ($search, $locale) {
    //             if ($locale === 'ar') {
    //                 $q->where('name_ar', 'LIKE', "%{$search}%")
    //                     ->orWhere('description_ar', 'LIKE', "%{$search}%");
    //             } else {
    //                 $q->where('name_en', 'LIKE', "%{$search}%")
    //                     ->orWhere('description_en', 'LIKE', "%{$search}%");
    //             }
    //         });
    //     }

    //     // التصفية حسب النوع (رئيسي/فرعي)
    //     if ($request->has('type') && !empty($request->type)) {
    //         if ($request->type == 'main') {
    //             $query->whereNull('parent_id');
    //         } elseif ($request->type == 'sub') {
    //             $query->whereNotNull('parent_id');
    //         }
    //     }

    //     // التصفية حسب التخصص الرئيسي
    //     if ($request->has('parent_id') && !empty($request->parent_id)) {
    //         $query->where('parent_id', $request->parent_id);
    //     }

    //     // التصفية حسب الميزات
    //     if ($request->has('featured') && $request->featured == 'true') {
    //         $query->where('is_featured', true);
    //     }

    //     if ($request->has('emergency') && $request->emergency == 'true') {
    //         $query->where('is_emergency_available', true);
    //     }

    //     // الترتيب
    //     $sort = $request->get('sort', 'name');
    //     $order = $request->get('order', 'asc');

    //     if ($sort == 'doctors') {
    //         $query->orderBy('doctors_count', $order);
    //     } elseif ($sort == 'popular') {
    //         $query->orderBy('consultations_count', $order);
    //     } elseif ($sort == 'rating') {
    //         $query->orderBy('average_rating', $order);
    //     } else {
    //         $locale = app()->getLocale();
    //         $query->orderBy($locale === 'ar' ? 'name_ar' : 'name_en', $order);
    //     }

    //     // الحصول على التخصصات الرئيسية للإحصائيات
    //     $mainSpecialties = Specialty::whereNull('parent_id')
    //         ->where('is_active', true)
    //         ->select('id', 'name_ar', 'name_en', 'doctors_count', 'consultations_count')
    //         ->take(6)
    //         ->get();

    //     // الحصول على التخصصات الرئيسية للتصفية
    //     $parentSpecialties = Specialty::whereNull('parent_id')
    //         ->where('is_active', true)
    //         ->get(['id', 'name_ar', 'name_en']);

    //     $specialties = $query->paginate(12);

    //     return view('frontend.specialties.index', compact(
    //         'specialties',
    //         'mainSpecialties',
    //         'parentSpecialties'
    //     ));
    // }
    public function index(Request $request)
    {
        try {
            // 1. تأكد من الحصول على البيانات
            $specialties = Specialty::where('is_active', true)
                ->select(
                    'id',
                    'name_ar',
                    'name_en',
                    'slug_ar',
                    'slug_en',
                    'icon',
                    'doctors_count',
                    'consultations_count',
                    'is_featured',
                    'is_emergency_available',
                    'description_ar',
                    'description_en'
                )
                ->orderBy('name_' . app()->getLocale())
                ->paginate(12);
            //return $specialties;
            // 2. التخصصات الرئيسية
            $mainSpecialties = Specialty::whereNull('parent_id')
                ->where('is_active', true)
                ->select(
                    'id',
                    'name_ar',
                    'name_en',
                    'slug_ar',
                    'slug_en',
                    'doctors_count',
                    'icon'
                )
                ->take(6)
                ->get();

            // 3. التخصصات الرئيسية للفلترة
            $parentSpecialties = Specialty::whereNull('parent_id')
                ->where('is_active', true)
                ->select('id', 'name_ar', 'name_en')
                ->get();

            // 4. إضافة accessors يدوياً
            $locale = app()->getLocale();

            foreach ($specialties as $spec) {
                $spec->name = $locale == 'ar' ? $spec->name_ar : $spec->name_en;
                $spec->slug = $locale == 'ar' ? $spec->slug_ar : $spec->slug_en;
                $spec->icon_url = $this->getIconUrl($spec->icon);
            }

            foreach ($mainSpecialties as $spec) {
                $spec->name = $locale == 'ar' ? $spec->name_ar : $spec->name_en;
                $spec->slug = $locale == 'ar' ? $spec->slug_ar : $spec->slug_en;
                $spec->icon_url = $this->getIconUrl($spec->icon);
            }

            foreach ($parentSpecialties as $parent) {
                $parent->name = $locale == 'ar' ? $parent->name_ar : $parent->name_en;
            }

            // 5. تمرير البيانات إلى الـ View
            return view('frontend.specialties.index', [
                'specialties' => $specialties,
                'mainSpecialties' => $mainSpecialties,
                'parentSpecialties' => $parentSpecialties
            ]);
        } catch (\Exception $e) {
            // في حالة حدوث خطأ
            return view('frontend.specialties.index', [
                'specialties' => collect(), // مجموعة فارغة
                'mainSpecialties' => collect(),
                'parentSpecialties' => collect(),
                'error' => $e->getMessage()
            ]);
        }
    }

    private function getIconUrl($icon)
    {
        if (!$icon) {
            return null;
        }

        if (str_starts_with($icon, 'http')) {
            return $icon;
        }

        return asset('storage/' . $icon);
    }
    /**
     * عرض صفحة التخصص مع الأطباء
     */
    public function show($slug)
    {
        $locale = app()->getLocale();
        $slugField = $locale == 'ar' ? 'slug_ar' : 'slug_en';

        // جلب التخصص مع العلاقات
        $specialty = Specialty::where($slugField, $slug)
            ->with(['parent', 'children' => function ($query) {
                $query->where('is_active', true);
            }])
            ->withCount(['activeDoctors as active_doctors_count'])
            ->active()
            ->firstOrFail();

        // جلب الأطباء في هذا التخصص مع العلاقات
        $doctors = User::where('role', 'doctor')
            ->where('status', 'active')
            ->whereHas('doctorProfile', function ($query) use ($specialty) {
                $query->where('specialty_id', $specialty->id)
                    ->where('is_verified', true);
            })
            ->with([
                'doctorProfile',
                'medicalCenters' => function ($query) {
                    $query->select('id', 'name', 'city', 'address')
                        ->where('status', 'active');
                },
                'ratings' => function ($query) {
                    $query->latest()->take(3);
                }
            ])
            ->paginate(12);

        // جلب التخصصات الأخرى للمرشحات
        $otherSpecialties = Specialty::active()
            ->where('id', '!=', $specialty->id)
            ->withCount(['activeDoctors as doctors_count'])
            ->take(10)
            ->get();

        // جلب المراكز الطبية التي لديها أطباء في هذا التخصص
        $medicalCenters = MedicalCenter::where('status', 'active')
            ->whereHas('doctors.doctorProfile', function ($query) use ($specialty) {
                $query->where('specialty_id', $specialty->id)
                    ->where('is_verified', true);
            })
            ->withCount(['activeDoctors'])
            ->take(8)
            ->get();

        return view('frontend.specialties.show', compact(
            'specialty',
            'doctors',
            'otherSpecialties',
            'medicalCenters'
        ));
    }

    /**
     * البحث والتصفية داخل التخصص
     */
    public function filter(Request $request, $slug)
    {
        $locale = app()->getLocale();
        $slugField = $locale == 'ar' ? 'slug_ar' : 'slug_en';

        $specialty = Specialty::where($slugField, $slug)
            ->active()
            ->firstOrFail();

        $query = User::where('role', 'doctor')
            ->where('status', 'active')
            ->whereHas('doctorProfile', function ($query) use ($specialty) {
                $query->where('specialty_id', $specialty->id)
                    ->where('is_verified', true);
            })
            ->with(['doctorProfile', 'medicalCenters']);

        // التصفية حسب الجنس
        if ($request->has('gender') && $request->gender != '') {
            $query->where('gender', $request->gender);
        }

        // التصفية حسب الموقع
        if ($request->has('location') && $request->location != '') {
            $query->where(function ($q) use ($request) {
                $q->where('address', 'like', "%{$request->location}%")
                    ->orWhereHas('medicalCenters', function ($centerQuery) use ($request) {
                        $centerQuery->where('city', 'like', "%{$request->location}%")
                            ->orWhere('address', 'like', "%{$request->location}%");
                    });
            });
        }

        // التصفية حسب الخبرة
        if ($request->has('experience') && $request->experience != '') {
            $query->whereHas('doctorProfile', function ($q) use ($request) {
                $q->where('years_of_experience', '>=', $request->experience);
            });
        }

        // التصفية حسب التقييم
        if ($request->has('rating') && $request->rating != '') {
            $query->whereHas('doctorProfile', function ($q) use ($request) {
                $q->where('average_rating', '>=', $request->rating);
            });
        }

        // التصفية حسب المركز الطبي
        if ($request->has('medical_center') && $request->medical_center != '') {
            $query->whereHas('medicalCenters', function ($q) use ($request) {
                $q->where('medical_centers.id', $request->medical_center);
            });
        }

        // التصفية حسب السعر
        if ($request->has('price_range') && $request->price_range != '') {
            $priceRange = explode('-', $request->price_range);
            if (count($priceRange) == 2) {
                $query->whereHas('doctorProfile', function ($q) use ($priceRange) {
                    $q->whereBetween('consultation_fee', [$priceRange[0], $priceRange[1]]);
                });
            }
        }

        // الترتيب
        $sort = $request->get('sort', 'name');
        switch ($sort) {
            case 'experience':
                $query->orderByDesc('doctor_profiles.years_of_experience');
                break;
            case 'rating':
                $query->orderByDesc('doctor_profiles.average_rating');
                break;
            case 'price_low':
                $query->orderBy('doctor_profiles.consultation_fee');
                break;
            case 'price_high':
                $query->orderByDesc('doctor_profiles.consultation_fee');
                break;
            case 'appointments':
                $query->orderByDesc('doctor_profiles.total_appointments');
                break;
            default:
                $locale = app()->getLocale();
                $query->orderBy($locale == 'ar' ? 'name_ar' : 'name_en');
        }

        $doctors = $query->paginate(12);

        return view('frontend.specialties.show', compact('specialty', 'doctors'));
    }

    /**
     * البحث المتقدم في التخصصات
     */
    public function search(Request $request)
    {
        $query = Specialty::query()->where('is_active', true);

        if ($request->filled('name')) {
            $locale = app()->getLocale();
            $nameField = $locale == 'ar' ? 'name_ar' : 'name_en';
            $query->where($nameField, 'like', "%{$request->name}%");
        }

        if ($request->filled('parent_id')) {
            $query->where('parent_id', $request->parent_id);
        }

        if ($request->filled('min_doctors')) {
            $query->where('doctors_count', '>=', $request->min_doctors);
        }

        if ($request->filled('is_emergency_available')) {
            $query->where('is_emergency_available', true);
        }

        $specialties = $query->paginate(12);

        $parentSpecialties = Specialty::whereNull('parent_id')
            ->where('is_active', true)
            ->get(['id', 'name_ar', 'name_en']);

        return view('frontend.specialties.search', compact('specialties', 'parentSpecialties'));
    }

    /**
     * عرض التخصصات حسب النوع
     */
    public function byType($type)
    {
        $query = Specialty::where('is_active', true);

        if ($type == 'main') {
            $query->whereNull('parent_id');
            $title = __('Main Specialties');
        } elseif ($type == 'sub') {
            $query->whereNotNull('parent_id');
            $title = __('Sub Specialties');
        } elseif ($type == 'featured') {
            $query->where('is_featured', true);
            $title = __('Featured Specialties');
        } elseif ($type == 'emergency') {
            $query->where('is_emergency_available', true);
            $title = __('Emergency Specialties');
        } else {
            return redirect()->route('specialties.index');
        }

        $specialties = $query->paginate(12);

        return view('frontend.specialties.by-type', compact('specialties', 'title'));
    }

    /**
     * عرض التخصصات حسب التخصص الرئيسي
     */
    public function byParent($parentSlug)
    {
        $locale = app()->getLocale();
        $slugField = $locale === 'ar' ? 'slug_ar' : 'slug_en';

        $parent = Specialty::where($slugField, $parentSlug)
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->firstOrFail();

        $specialties = Specialty::where('parent_id', $parent->id)
            ->where('is_active', true)
            ->paginate(12);

        return view('frontend.specialties.by-parent', compact('specialties', 'parent'));
    }

    /**
     * عرض التخصصات الأكثر شعبية
     */
    public function popular()
    {
        $specialties = Specialty::where('is_active', true)
            ->orderBy('consultations_count', 'desc')
            ->orderBy('doctors_count', 'desc')
            ->paginate(12);

        return view('frontend.specialties.popular', compact('specialties'));
    }

    /**
     * عرض الإحصائيات
     */
    public function statistics()
    {
        $stats = [
            'total_specialties' => Specialty::where('is_active', true)->count(),
            'main_specialties' => Specialty::whereNull('parent_id')->where('is_active', true)->count(),
            'sub_specialties' => Specialty::whereNotNull('parent_id')->where('is_active', true)->count(),
            'featured_specialties' => Specialty::where('is_featured', true)->where('is_active', true)->count(),
            'emergency_specialties' => Specialty::where('is_emergency_available', true)->where('is_active', true)->count(),
            'total_doctors' => DB::table('specialties')
                ->where('is_active', true)
                ->sum('doctors_count'),
            'total_consultations' => DB::table('specialties')
                ->where('is_active', true)
                ->sum('consultations_count'),
        ];

        $topSpecialties = Specialty::where('is_active', true)
            ->orderBy('consultations_count', 'desc')
            ->limit(10)
            ->get();

        $specialtiesWithMostDoctors = Specialty::where('is_active', true)
            ->orderBy('doctors_count', 'desc')
            ->limit(10)
            ->get();

        return view('frontend.specialties.statistics', compact(
            'stats',
            'topSpecialties',
            'specialtiesWithMostDoctors'
        ));
    }
}
