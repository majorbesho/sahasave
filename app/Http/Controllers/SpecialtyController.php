<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{



    public function featuredSpecialties()
    {
        $specialties = Specialty::withCount(['activeDoctors as active_doctors_count'])
            ->featured()
            ->active()
            ->ordered()
            ->take(8)
            ->get();

        return $specialties;
    }

    /**
     * عرض صفحة التخصص
     */
    public function show($slug)
    {
        $locale = app()->getLocale();
        $slugField = $locale == 'ar' ? 'slug_ar' : 'slug_en';

        try {
            // جلب التخصص مع العلاقات
            $specialty = Specialty::where($slugField, $slug)
                ->withCount(['activeDoctors as doctors_count'])
                ->active()
                ->firstOrFail();

            // جلب الأطباء في هذا التخصص مع العلاقات
            $doctors = User::select('users.*') // تحديد الجدول بوضوح
                ->where('users.role', 'doctor')
                ->where('users.status', 'active')
                ->whereHas('doctorProfile', function ($query) use ($specialty) {
                    $query->where('specialty_id', $specialty->id)
                        ->where('is_verified', true);
                })
                ->with([
                    'doctorProfile',
                    'medicalCenters' => function ($query) {
                        $query->select(
                            'medical_centers.id',
                            'medical_centers.name',
                            'medical_centers.city',
                            'medical_centers.address'
                        );
                    }
                ])
                ->paginate(12);

            // جلب التخصصات الأخرى للمرشحات
            $otherSpecialties = Specialty::active()
                ->where('id', '!=', $specialty->id)
                ->withCount(['activeDoctors as doctors_count'])
                ->take(10)
                ->get();

            return view('frontend.specialties.show', compact(
                'specialty',
                'doctors',
                'otherSpecialties'
            ));
        } catch (\Exception $e) {
            \Log::error('Error in SpecialtyController@show: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'حدث خطأ في تحميل الصفحة.');
        }
    }



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
            default:
                $query->orderBy('name');
        }

        $doctors = $query->paginate(12);

        return view('frontend.specialties.show', compact('specialty', 'doctors'));
    }

    /**
     * عرض جميع التخصصات
     */
    public function index()
    {
        $specialties = Specialty::withCount(['activeDoctors as doctors_count'])
            ->active()
            ->ordered()
            ->get()
            ->groupBy('parent_id');

        $mainSpecialties = $specialties->get(null, collect());
        $subSpecialties = $specialties->filter(fn($item, $key) => $key !== null);

        return view('frontend.specialties.index', compact('mainSpecialties', 'subSpecialties'));
    }

    /**
     * البحث في التخصصات
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        $locale = app()->getLocale();

        $specialties = Specialty::withCount(['activeDoctors as doctors_count'])
            ->active()
            ->when($search, function ($query) use ($search, $locale) {
                $nameField = $locale == 'ar' ? 'name_ar' : 'name_en';
                return $query->where($nameField, 'like', "%{$search}%");
            })
            ->ordered()
            ->paginate(12);

        return view('frontend.specialties.search', compact('specialties', 'search'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(cr $cr)
    {
        //
    }
}
