<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use App\Models\User;
use App\Models\DoctorProfile;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * عرض صفحة التخصص مع الأطباء
     */
    public function show($slug)
    {
        $locale = app()->getLocale();
        $slugField = $locale == 'ar' ? 'slug_ar' : 'slug_en';

        // جلب التخصص مع العلاقات
        $specialty = Specialty::where($slugField, $slug)
            ->withCount(['activeDoctors as doctors_count'])
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
                    $query->select('id', 'name', 'city', 'address');
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
}
