<?php

namespace App\Http\Controllers;

use App\Models\MedicalCenter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InteractiveMapController extends Controller
{
    public function index(Request $request)
    {
        try {
            $filters = [
                'type' => $request->input('type'),
                'specialty' => $request->input('specialty'),
                'city' => $request->input('city'),
                'is_verified' => $request->input('is_verified'),
                'rating_min' => $request->input('rating_min'),
                'has_doctors' => $request->input('has_doctors'),
            ];

            // جلب المراكز الطبية مع الفلاتر
            $query = MedicalCenter::query()->where('status', 'active');

            if (!empty($filters['type'])) {
                $query->where('type', $filters['type']);
            }

            if (!empty($filters['city'])) {
                $city = $filters['city'];
                $query->where(function ($q) use ($city) {
                    $q->where('city', $city)
                        ->orWhere('city_ar', $city);

                    $cityMappings = [
                        'sharjah' => 'الشارقة',
                        'dubai' => 'دبي',
                        'abu dhabi' => 'أبو ظبي',
                        'ajman' => 'عجمان',
                        'umm al quwain' => 'أم القيوين',
                        'ras al khaimah' => 'رأس الخيمة',
                        'fujairah' => 'الفجيرة',
                        'al ain' => 'العين',
                        'الشارقة' => 'sharjah',
                        'دبي' => 'dubai',
                        'أبو ظبي' => 'abu dhabi',
                        'عجمان' => 'ajman',
                        'أم القيوين' => 'umm al quwain',
                        'رأس الخيمة' => 'ras al khaimah',
                        'الفجيرة' => 'fujairah',
                        'العين' => 'al ain',
                    ];

                    $normalizedCity = strtolower(trim($city));
                    if (isset($cityMappings[$normalizedCity])) {
                        $mapped = $cityMappings[$normalizedCity];
                        $q->orWhere('city', $mapped)
                            ->orWhere('city_ar', $mapped);
                    }
                });
            }

            if ($filters['is_verified'] === 'true') {
                $query->where('is_verified', true);
            }

            if (!empty($filters['rating_min'])) {
                $query->where('average_rating', '>=', (float)$filters['rating_min']);
            }

            if (!empty($filters['specialty'])) {
                $query->where(function ($q) use ($filters) {
                    $q->where('specialties', 'LIKE', '%"' . $filters['specialty'] . '"%')
                        ->orWhere('specialties', 'LIKE', '%' . $filters['specialty'] . '%');
                });
            }

            if ($filters['has_doctors'] === 'true') {
                $query->where('doctor_count', '>', 0);
            }

            $medicalCenters = $query->get([
                'id',
                'name',
                'type',
                'address',
                'city',
                'latitude',
                'longitude',
                'average_rating',
                'doctor_count',
                'is_verified',
                'is_featured',
                'specialties',
                'services',
                'slug'
            ]);

            // جلب الأطباء
            $doctors = User::where('role', 'doctor')
                ->where('status', 'active')
                ->whereHas('doctorProfile', function ($q) {
                    $q->where('is_verified', true);
                })
                ->with(['doctorProfile'])
                ->get();

            // جلب المدن المتاحة
            $cities = MedicalCenter::whereNotNull('city')
                ->where('city', '!=', '')
                ->where('status', 'active')
                ->distinct()
                ->pluck('city')
                ->filter()
                ->values();

            // استخراج التخصصات
            $specialties = $this->extractAllSpecialties($medicalCenters);

            return view('frontend.map.index', compact(
                'medicalCenters',
                'doctors',
                'filters',
                'cities',
                'specialties'
            ));
        } catch (\Exception $e) {
            Log::error('Map index error: ' . $e->getMessage());

            return view('frontend.map.index', [
                'medicalCenters' => collect(),
                'doctors' => collect(),
                'filters' => $request->all(),
                'cities' => collect(),
                'specialties' => []
            ])->with('error', 'حدث خطأ في تحميل البيانات.');
        }
    }

    public function getMapData(Request $request)
    {
        try {
            Log::info('Map data API called', ['params' => $request->all()]);

            // تطبيق الفلاتر
            $query = MedicalCenter::query()->where('status', 'active');

            if ($request->has('type') && $request->type != '') {
                $query->where('type', $request->type);
            }

            if ($request->has('city') && $request->city != '') {
                $city = $request->city;
                $query->where(function ($q) use ($city) {
                    $q->where('city', $city)
                        ->orWhere('city_ar', $city);

                    $cityMappings = [
                        'sharjah' => 'الشارقة',
                        'dubai' => 'دبي',
                        'abu dhabi' => 'أبو ظبي',
                        'ajman' => 'عجمان',
                        'umm al quwain' => 'أم القيوين',
                        'ras al khaimah' => 'رأس الخيمة',
                        'fujairah' => 'الفجيرة',
                        'al ain' => 'العين',
                        'الشارقة' => 'sharjah',
                        'دبي' => 'dubai',
                        'أبو ظبي' => 'abu dhabi',
                        'عجمان' => 'ajman',
                        'أم القيوين' => 'umm al quwain',
                        'رأس الخيمة' => 'ras al khaimah',
                        'الفجيرة' => 'fujairah',
                        'العين' => 'al ain',
                    ];

                    $normalizedCity = strtolower(trim($city));
                    if (isset($cityMappings[$normalizedCity])) {
                        $mapped = $cityMappings[$normalizedCity];
                        $q->orWhere('city', $mapped)
                            ->orWhere('city_ar', $mapped);
                    }
                });
            }

            if ($request->has('is_verified') && $request->is_verified == 'true') {
                $query->where('is_verified', true);
            }

            if ($request->has('rating_min') && $request->rating_min != '') {
                $query->where('average_rating', '>=', (float)$request->rating_min);
            }

            if ($request->has('specialty') && $request->specialty != '') {
                $query->where(function ($q) use ($request) {
                    $q->where('specialties', 'LIKE', '%"' . $request->specialty . '"%')
                        ->orWhere('specialties', 'LIKE', '%' . $request->specialty . '%');
                });
            }

            if ($request->has('has_doctors') && $request->has_doctors == 'true') {
                $query->where('doctor_count', '>', 0);
            }

            if ($request->has('is_featured') && $request->is_featured == 'true') {
                $query->where('is_featured', true);
            }

            // جلب المراكز الطبية
            $medicalCenters = $query->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->where('latitude', '!=', 0)
                ->where('longitude', '!=', 0)
                ->withCount(['activeDoctors'])
                ->get([
                    'id',
                    'name',
                    'type',
                    'address',
                    'city',
                    'latitude',
                    'longitude',
                    'average_rating',
                    'doctor_count',
                    'is_verified',
                    'is_featured',
                    'specialties',
                    'services',
                    'phone',
                    'email',
                    'slug'
                ]);

            Log::info('Found ' . $medicalCenters->count() . ' medical centers');

            // معالجة بيانات المراكز الطبية
            $medicalCentersData = $medicalCenters->map(function ($center) {
                return [
                    'id' => $center->id,
                    'name' => $center->name ?? __('medical_centers.not_available'),
                    'type' => $center->type ?? 'clinic',
                    'type_label' => $center->type_localized,
                    'address' => $center->address ?? __('medical_centers.not_available'),
                    'city' => $center->city ?? __('medical_centers.not_set'),
                    'latitude' => (float)$center->latitude,
                    'longitude' => (float)$center->longitude,
                    'rating' => (float)($center->average_rating ?? 0),
                    'doctor_count' => (int)($center->active_doctors_count ?? $center->doctor_count ?? 0),
                    'is_verified' => (bool)($center->is_verified ?? false),
                    'is_featured' => (bool)($center->is_featured ?? false),
                    'specialties' => $this->parseJsonField($center->specialties),
                    'services' => $center->services_localized,
                    'contact' => [
                        'phone' => $center->phone ?? __('medical_centers.not_available'),
                        'email' => $center->email ?? __('medical_centers.not_available')
                    ],
                    'icon' => $this->getIconForType($center->type ?? 'clinic'),
                    'color' => $this->getColorForType($center->type ?? 'clinic'),
                    'popup_content' => $this->generatePopupContent($center)
                ];
            });

            // جلب الأطباء (إذا طلب المستخدم)
            $doctorsData = [];
            if (!$request->has('has_doctors') || $request->has_doctors != 'false') {
                $doctorsQuery = User::where('role', 'doctor')
                    ->where('status', 'active')
                    ->whereHas('doctorProfile', function ($q) {
                        $q->where('is_verified', true);
                    });

                $doctors = $doctorsQuery->with(['doctorProfile', 'medicalCenters' => function ($q) {
                    $q->whereNotNull('latitude')
                        ->whereNotNull('longitude')
                        ->where('latitude', '!=', 0)
                        ->where('longitude', '!=', 0)
                        ->where('medical_centers.status', 'active');
                }])->get();

                $doctorsData = $doctors->flatMap(function ($doctor) {
                    $locations = [];
                    $profile = $doctor->doctorProfile;

                    // إذا كان الطبيب مرتبط بعيادات
                    if ($doctor->medicalCenters->isNotEmpty()) {
                        foreach ($doctor->medicalCenters as $clinic) {
                            $locations[] = [
                                'id' => 'doctor_' . $doctor->id . '_clinic_' . $clinic->id,
                                'doctor_id' => $doctor->id,
                                'name' => $doctor->name ?? __('medical_centers.not_available'),
                                'specialization' => $profile->specialization ?? __('medical_centers.not_set'),
                                'rating' => (float)($profile->average_rating ?? 0),
                                'experience' => (int)($profile->years_of_experience ?? 0),
                                'latitude' => (float)$clinic->latitude,
                                'longitude' => (float)$clinic->longitude,
                                'clinic_name' => $clinic->name,
                                'clinic_id' => $clinic->id,
                                'icon' => 'user-md',
                                'color' => '#4CAF50',
                                'popup_content' => $this->generateDoctorPopupContent($doctor, $clinic)
                            ];
                        }
                    }

                    return $locations;
                })->toArray();
            }

            // إحصائيات
            $stats = [
                'total_centers' => $medicalCentersData->count(),
                'total_doctors' => count($doctorsData),
                'verified_centers' => $medicalCentersData->where('is_verified', true)->count(),
                'featured_centers' => $medicalCentersData->where('is_featured', true)->count(),
                'by_type' => $medicalCentersData->groupBy('type')->map->count()->toArray(),
                'by_city' => $medicalCentersData->groupBy('city')->map->count()->toArray()
            ];

            $response = [
                'success' => true,
                'message' => __('messages.success'),
                'data' => [
                    'medical_centers' => $medicalCentersData->values()->toArray(),
                    'doctors' => $doctorsData,
                    'stats' => $stats
                ],
                'meta' => [
                    'timestamp' => now()->toDateTimeString(),
                    'count' => $medicalCentersData->count() + count($doctorsData)
                ]
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            Log::error('Map API error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ في الخادم: ' . (config('app.debug') ? $e->getMessage() : 'يرجى المحاولة مرة أخرى'),
                'data' => [
                    'medical_centers' => [],
                    'doctors' => [],
                    'stats' => [
                        'total_centers' => 0,
                        'total_doctors' => 0,
                        'verified_centers' => 0,
                        'featured_centers' => 0,
                        'by_type' => [],
                        'by_city' => []
                    ]
                ]
            ], 500);
        }
    }

    private function parseJsonField($field)
    {
        if (empty($field)) {
            return [];
        }

        if (is_array($field)) {
            return $field;
        }

        if (is_string($field)) {
            // محاولة تحليل JSON
            $decoded = json_decode($field, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }

            // محاولة تحليل كسلسلة مفصولة بفواصل
            if (strpos($field, ',') !== false) {
                return array_map('trim', explode(',', $field));
            }

            // إذا كان نصاً واحداً
            return [$field];
        }

        return [];
    }

    private function extractAllSpecialties($medicalCenters)
    {
        $allSpecialties = [];

        foreach ($medicalCenters as $center) {
            $specialties = $this->parseJsonField($center->specialties);
            $allSpecialties = array_merge($allSpecialties, $specialties);
        }

        $allSpecialties = array_unique(array_filter($allSpecialties));
        sort($allSpecialties);

        return $allSpecialties;
    }

    private function getTypeLabel($type)
    {
        $labels = [
            'clinic' => 'عيادة',
            'hospital' => 'مستشفى',
            'medical_center' => 'مركز طبي',
            'lab' => 'مختبر',
            'pharmacy' => 'صيدلية',
            'dental' => 'عيادة أسنان',
            'optical' => 'مركز بصريات',
            'physiotherapy' => 'علاج طبيعي'
        ];

        return $labels[$type] ?? $type;
    }

    private function getIconForType($type)
    {
        $icons = [
            'clinic' => 'stethoscope',
            'hospital' => 'hospital',
            'medical_center' => 'clinic-medical',
            'lab' => 'flask',
            'pharmacy' => 'pills',
            'dental' => 'tooth',
            'optical' => 'eye',
            'physiotherapy' => 'hand-holding-medical'
        ];

        return $icons[$type] ?? 'map-marker-alt';
    }

    private function getColorForType($type)
    {
        $colors = [
            'clinic' => '#3498db',
            'hospital' => '#e74c3c',
            'medical_center' => '#2ecc71',
            'lab' => '#9b59b6',
            'pharmacy' => '#f39c12',
            'dental' => '#1abc9c',
            'optical' => '#8e44ad',
            'physiotherapy' => '#d35400'
        ];

        return $colors[$type] ?? '#34495e';
    }

    private function generatePopupContent($center)
    {
        $specialties = $this->parseJsonField($center->specialties);
        $services = $this->parseJsonField($center->services);

        $verifiedBadge = $center->is_verified
            ? '<span class="badge bg-success me-1"><i class="fas fa-check-circle"></i> ' . __('medical_centers.verified') . '</span>'
            : '';

        $featuredBadge = $center->is_featured
            ? '<span class="badge bg-warning"><i class="fas fa-star"></i> ' . __('medical_centers.featured') . '</span>'
            : '';

        // نجوم التقييم
        $rating = (float)($center->average_rating ?? 0);
        $stars = '';
        if ($rating > 0) {
            $fullStars = floor($rating);
            $hasHalfStar = ($rating - $fullStars) >= 0.5;

            for ($i = 0; $i < $fullStars; $i++) {
                $stars .= '<i class="fas fa-star text-warning"></i>';
            }
            if ($hasHalfStar) {
                $stars .= '<i class="fas fa-star-half-alt text-warning"></i>';
            }
        }

        // إنشاء الروابط بشكل آمن
        $centerDetailUrl = route('medical-centershome.show', $center->slug ?? $center->id);
        $appointmentUrl = route('booking.create', ['center_id' => $center->id]);

        return '
            <div class="map-popup">
        <div class="popup-header">
            <h6 class="mb-1 fw-bold">' . e($center->name) . '</h6>
            <div class="badges mb-2">' . $verifiedBadge . $featuredBadge . '</div>
        </div>
        <div class="popup-body">
            <p class="mb-1"><i class="fas fa-map-marker-alt text-primary"></i> ' . e($center->address) . ', ' . e($center->city) . '</p>
            <p class="mb-1"><i class="fas fa-stethoscope text-info"></i> ' . $center->type_localized . '</p>
            <p class="mb-1"><i class="fas fa-user-md text-success"></i> ' . ($center->active_doctors_count ?? $center->doctor_count ?? 0) . ' ' . __('global.doctors') . '</p>
            ' . ($rating > 0 ? '<p class="mb-1"><i class="fas fa-star text-warning"></i> ' . $rating . '/5 ' . $stars . '</p>' : '') . '
            ' . (!empty($specialties) ? '<p class="mb-1"><strong><i class="fas fa-tags"></i> ' . __('medical_centers.specialties') . ':</strong><br><small>' . implode(', ', array_slice($specialties, 0, 3)) . '</small></p>' : '') . '
        </div>
        <div class="popup-footer mt-2">
            <a href="' . $centerDetailUrl . '" class="btn btn-sm btn-primary me-1">
                <i class="fas fa-info-circle"></i> ' . __('global.details') . '
            </a>
            <a href="' . $appointmentUrl . '" class="btn btn-sm btn-success">
                <i class="fas fa-calendar-check"></i> ' . __('medical_centers.book_now') . '
            </a>
        </div>
    </div>';
    }




    private function generateDoctorPopupContent($doctor, $clinic = null)
    {
        $profile = $doctor->doctorProfile;
        $rating = (float)($profile->average_rating ?? 0);

        $stars = '';
        if ($rating > 0) {
            $fullStars = floor($rating);
            $hasHalfStar = ($rating - $fullStars) >= 0.5;

            for ($i = 0; $i < $fullStars; $i++) {
                $stars .= '<i class="fas fa-star text-warning"></i>';
            }
            if ($hasHalfStar) {
                $stars .= '<i class="fas fa-star-half-alt text-warning"></i>';
            }
        }

        $clinicInfo = $clinic
            ? '<p class="mb-1"><i class="fas fa-clinic-medical text-info"></i> ' . e($clinic->name) . ' - ' . e($clinic->city) . '</p>'
            : '';

        // التحقق من وجود slug وإنشاء الروابط بشكل آمن
        $doctorProfileUrl = '#';
        $appointmentUrl = '#';

        if ($profile) {
            if (!empty($profile->slug)) {
                $doctorProfileUrl = route('doctors.show', $profile->slug);
            } else {
                $doctorProfileUrl = route('doctors.show', $doctor->id);
            }

            $appointmentUrl = route('booking.create', ['doctor_id' => $doctor->id]);
        }

        return '
    <div class="map-popup">
        <div class="popup-header">
            <h6 class="mb-1 fw-bold"><i class="fas fa-user-md text-success"></i> ' . __('global.doctor') . ' ' . e($doctor->name) . '</h6>
        </div>
        <div class="popup-body">
            <p class="mb-1"><strong><i class="fas fa-graduation-cap"></i> التخصص:</strong> ' . e($profile->specialization ?? 'عام') . '</p>
            <p class="mb-1"><strong><i class="fas fa-briefcase"></i> الخبرة:</strong> ' . ($profile->years_of_experience ?? 0) . ' سنة</p>
            ' . ($rating > 0 ? '<p class="mb-1"><strong><i class="fas fa-star"></i> التقييم:</strong> ' . $rating . '/5 ' . $stars . '</p>' : '') . '
            ' . $clinicInfo . '
        </div>
        <div class="popup-footer mt-2">
            <a href="' . $doctorProfileUrl . '" class="btn btn-sm btn-primary me-1">
                <i class="fas fa-user"></i> ' . __('global.profile') . '
            </a>
            <a href="' . $appointmentUrl . '" class="btn btn-sm btn-success">
                <i class="fas fa-calendar-check"></i> ' . __('medical_centers.book_now') . '
            </a>
        </div>
    </div>';
    }

    public function show($slug)
    {
        try {
            // البحث عن المركز باستخدام slug أو ID
            $center = MedicalCenter::where('slug', $slug)
                ->orWhere('id', $slug)
                ->first();

            if (!$center) {
                return response()->view('errors.404', [], 404);
            }

            return view('frontend.medical-centers.show', compact('center'));
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }
}
