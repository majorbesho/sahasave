<?php

namespace App\Http\Controllers;

use App\Models\MedicalCenter;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicalCentersController extends Controller
{
    /**
     * Display a listing of medical centers
     */
    public function index(Request $request)
    {
        $query = MedicalCenter::query()->where('status', 'active');

        // التصفية حسب النوع
        $type = $request->get('type', 'hospital');
        $activeTab = 'hospitals';

        if ($type) {
            $query->where('type', $type);
            $activeTab = match ($type) {
                'hospital' => 'hospitals',
                'clinic' => 'clinics',
                'medical_center' => 'medical-centers',
                'lab' => 'labs',
                default => 'hospitals'
            };
        }

        // البحث
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('city', 'LIKE', "%{$search}%")
                    ->orWhere('address', 'LIKE', "%{$search}%");
            });
        }

        // التصفية حسب الميزات
        $filter = $request->get('filter');

        if ($filter) {
            switch ($filter) {
                case 'virtual':
                    $query->where('is_virtual', true);
                    break;
                case 'appointment':
                    $query->where('accepts_appointments', true);
                    break;
                case 'clinic':
                    $query->whereIn('type', ['clinic', 'hospital']);
                    break;
            }
        }

        // التصفية حسب المدينة
        if ($request->has('city') && !empty($request->city)) {
            $query->where('city', $request->city);
        }

        // الترتيب
        $sort = $request->get('sort', 'name');
        $order = $request->get('order', 'asc');

        if ($sort == 'rating') {
            $query->orderBy('average_rating', $order);
        } elseif ($sort == 'doctors') {
            $query->orderBy('doctor_count', $order);
        } else {
            $query->orderBy('name', $order);
        }

        // الحصول على المدن المتاحة
        $cities = MedicalCenter::where('status', 'active')
            ->select('city', DB::raw('COUNT(*) as count'))
            ->groupBy('city')
            ->orderBy('count', 'desc')
            ->get();

        // الحصول على التخصصات مع اسم مناسب للغة الحالية
        $locale = app()->getLocale();
        $specialties = Specialty::where('is_active', true)
            ->select(
                'id',
                $locale === 'ar' ? 'name_ar as name' : 'name_en as name',
                $locale === 'ar' ? 'slug_ar as slug' : 'slug_en as slug'
            )
            ->get();

        $medicalCenters = $query->paginate(12);

        // تحديث العنوان
        $title = match ($type) {
            'hospital' => __('Hospitals'),
            'clinic' => __('Clinics'),
            'medical_center' => __('Medical Centers'),
            'lab' => __('Laboratories'),
            default => __('Hospitals')
        };

        return view('frontend.medical-centers.index', compact(
            'medicalCenters',
            'cities',
            'specialties',
            'title',
            'activeTab',
            'type'
        ));
    }

    /**
     * Display the specified medical center
     */
    public function show($slug)
    {
        $medicalCenter = MedicalCenter::with([
            'activeDoctors' => function ($query) {
                $query->with(['doctorProfile']);
            }
        ])
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        // الحصول على أسماء التخصصات بشكل آمن
        $centerSpecialties = [];
        if (!empty($medicalCenter->specialties) && is_array($medicalCenter->specialties)) {
            $locale = app()->getLocale();
            $centerSpecialties = Specialty::whereIn('id', $medicalCenter->specialties)
                ->where('is_active', true)
                ->select(
                    'id',
                    $locale === 'ar' ? 'name_ar as name' : 'name_en as name',
                    $locale === 'ar' ? 'slug_ar as slug' : 'slug_en as slug'
                )
                ->get();
        }

        // الحصول على مراكز مشابهة
        $similarCenters = MedicalCenter::where('city', $medicalCenter->city)
            ->where('id', '!=', $medicalCenter->id)
            ->where('status', 'active')
            ->where('type', $medicalCenter->type)
            ->limit(4)
            ->get();

        return view('frontend.medical-centers.show', compact(
            'medicalCenter',
            'centerSpecialties',
            'similarCenters'
        ));
    }

    /**
     * البحث المتقدم
     */
    public function search(Request $request)
    {
        $query = MedicalCenter::query()->where('status', 'active');

        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        if ($request->filled('specialty')) {
            $query->whereJsonContains('specialties', (int)$request->specialty);
        }

        if ($request->filled('center_type')) {
            $query->where('type', $request->center_type);
        }

        $medicalCenters = $query->paginate(12);

        $locale = app()->getLocale();
        $specialties = Specialty::where('is_active', true)
            ->select(
                'id',
                $locale === 'ar' ? 'name_ar as name' : 'name_en as name'
            )
            ->get();

        return view('frontend.medical-centers.search', compact('medicalCenters', 'specialties'));
    }

    /**
     * عرض المراكز حسب المدينة
     */
    public function byCity($city)
    {
        // Redirect to index with city parameter for SEO-friendly URLs
        return redirect()->route('medical-centershome.index', ['city' => urldecode($city), 'type' => 'hospital']);
    }

    /**
     * عرض المراكز حسب التخصص
     */
    public function bySpecialty($specialtySlug)
    {
        $locale = app()->getLocale();
        $specialtyField = $locale === 'ar' ? 'slug_ar' : 'slug_en';

        $specialtyModel = Specialty::where($specialtyField, $specialtySlug)
            ->where('is_active', true)
            ->firstOrFail();

        $medicalCenters = MedicalCenter::whereJsonContains('specialties', $specialtyModel->id)
            ->where('status', 'active')
            ->orderBy('name')
            ->paginate(12);

        return view('frontend.medical-centers.by-specialty', compact('medicalCenters', 'specialtyModel'));
    }

    /**
     * المراكز المميزة
     */
    public function featured()
    {
        $medicalCenters = MedicalCenter::where('is_featured', true)
            ->where('status', 'active')
            ->orderBy('name')
            ->paginate(12);

        return view('frontend.medical-centers.featured', compact('medicalCenters'));
    }

    /**
     * الإحصائيات
     */
    public function statistics()
    {
        $stats = [
            'total_centers' => MedicalCenter::where('status', 'active')->count(),
            'hospitals' => MedicalCenter::where('type', 'hospital')->where('status', 'active')->count(),
            'clinics' => MedicalCenter::where('type', 'clinic')->where('status', 'active')->count(),
            'labs' => MedicalCenter::where('type', 'lab')->where('status', 'active')->count(),
            'medical_centers' => MedicalCenter::where('type', 'medical_center')->where('status', 'active')->count(),
            'featured_centers' => MedicalCenter::where('is_featured', true)->where('status', 'active')->count(),
        ];

        $popularCities = MedicalCenter::where('status', 'active')
            ->select('city', DB::raw('COUNT(*) as count'))
            ->groupBy('city')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        return view('frontend.medical-centers.statistics', compact('stats', 'popularCities'));
    }
}
