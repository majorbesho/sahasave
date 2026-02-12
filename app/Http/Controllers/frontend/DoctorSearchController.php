<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class DoctorSearchController extends Controller
{
    /**
     * البحث عن الأطباء (محسن للأداء)
     */
    public function search(Request $request)
    {
        $cacheKey = $this->getCacheKey($request);

        // Cache النتائج لمدة دقيقتين
        $data = Cache::remember($cacheKey, 120, function () use ($request) {
            return $this->performSearch($request);
        });

        return view('frontend.doctors-search', $data);
    }
    /**
     * البحث عن طريق المدينة والتخصص (SEO Friendly)
     */
    public function searchBySpecialty(Request $request, $city, $specialty)
    {
        $request->merge([
            'location' => str_replace('-', ' ', $city),
            'search' => str_replace('-', ' ', $specialty)
        ]);

        return $this->search($request);
    }


    /**
     * إنشاء مفتاح cache فريد
     */
    private function getCacheKey(Request $request): string
    {
        return sprintf(
            'doctor_search:%s:%s:%s:%d',
            md5($request->input('search', '')),
            md5($request->input('location', '')),
            md5($request->input('date', '')),
            $request->input('page', 1)
        );
    }

    /**
     * تنفيذ البحث
     */
    private function performSearch(Request $request): array
    {
        $search = trim($request->input('search', ''));
        $location = trim($request->input('location', ''));

        $query = User::where('role', 'doctor')
            ->where('status', 'active')
            ->whereHas('doctorProfile')
            ->with([
                'doctorProfile:id,doctor_id,slug,specialization,years_of_experience,medical_school',
                'medicalCenters:id,name,address,city'
            ])
            ->select(['id', 'name', 'email', 'address', 'phone', 'photo']); // تم استخدام photo بدلاً من avatar لتناسب قاعدة البيانات

        // تطبيق عوامل التصفية
        $this->applyFilters($query, $search, $location);

        // ترتيب النتائج
        $query->orderBy('name');

        // Pagination
        $perPage = 10;
        $page = $request->input('page', 1);

        $total = $query->count();
        $doctors = $query->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        // Specialties مؤقتة (مع جلب الأعمدة الصحيحة)
        $specialties = Specialty::active()
            ->select(['id', 'name_ar', 'name_en', 'slug_ar', 'slug_en'])
            ->orderBy('order')
            ->get();

        return [
            'doctors' => new \Illuminate\Pagination\LengthAwarePaginator(
                $doctors,
                $total,
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            ),
            'search' => $search,
            'location' => $location,
            'date' => $request->input('date', ''),
            'totalDoctors' => $total,
            'specialties' => $specialties
        ];
    }

    /**
     * تطبيق عوامل التصفية بذكاء
     */
    private function applyFilters($query, $search, $location): void
    {
        if ($search) {
            $query->where(function ($q) use ($search) {
                // استخدام البحث الكامل للحصول على أداء أفضل
                if (DB::connection()->getDriverName() === 'mysql') {
                    $q->whereRaw('MATCH(name, email) AGAINST(? IN BOOLEAN MODE)', [$search . '*'])
                        ->orWhereHas('doctorProfile', function ($profile) use ($search) {
                            $profile->whereRaw('MATCH(specialization, medical_school) AGAINST(? IN BOOLEAN MODE)', [$search . '*']);
                        });
                } else {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhereHas('doctorProfile', function ($profile) use ($search) {
                            $profile->where('specialization', 'like', "%{$search}%")
                                ->orWhere('medical_school', 'like', "%{$search}%");
                        });
                }
            });
        }

        if ($location) {
            $query->where(function ($q) use ($location) {
                $q->where('address', 'like', "%{$location}%")
                    ->orWhereHas('medicalCenters', function ($center) use ($location) {
                        $center->where('name', 'like', "%{$location}%")
                            ->orWhere('address', 'like', "%{$location}%")
                            ->orWhere(function ($cityQ) use ($location) {
                                $cityQ->where('city', 'like', "%{$location}%")
                                    ->orWhere('city_ar', 'like', "%{$location}%");

                                // Common UAE city mappings
                                $cityMappings = [
                                    'sharjah' => 'الشارقة',
                                    'dubai' => 'دبي',
                                    'abu dhabi' => 'أبو ظبي',
                                    'ajman' => 'عجمان',
                                    'umm al quwain' => 'أم القيوين',
                                    'ras al khaimah' => 'رأس الخيمة',
                                    'fujairah' => 'الفجيرة',
                                    'al ain' => 'العين',
                                ];

                                $normalizedLocation = strtolower(trim($location));
                                if (isset($cityMappings[$normalizedLocation])) {
                                    $mapped = $cityMappings[$normalizedLocation];
                                    $cityQ->orWhere('city', 'like', "%{$mapped}%")
                                        ->orWhere('city_ar', 'like', "%{$mapped}%");
                                }
                            });
                    });
            });
        }
    }
}
