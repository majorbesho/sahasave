<?php

namespace App\Http\Controllers;

use App\Models\MedicalCenter;
use App\Models\User;
use Illuminate\Http\Request;

class InteractiveMapController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'type' => $request->input('type'),
            'specialty' => $request->input('specialty'),
            'city' => $request->input('city'),
            'is_verified' => $request->input('is_verified'),
            'rating_min' => $request->input('rating_min'),
            'has_doctors' => $request->input('has_doctors'),
        ];

        $medicalCenters = MedicalCenter::query()
            ->when($filters['type'], function ($query, $type) {
                return $query->where('type', $type);
            })
            ->when($filters['city'], function ($query, $city) {
                return $query->where('city', $city);
            })
            ->when($filters['is_verified'], function ($query) {
                return $query->where('is_verified', true);
            })
            ->when($filters['rating_min'], function ($query, $rating) {
                return $query->where('average_rating', '>=', $rating);
            })
            ->when($filters['specialty'], function ($query, $specialty) {
                return $query->whereJsonContains('specialties', $specialty);
            })
            ->when($filters['has_doctors'] === 'true', function ($query) {
                return $query->has('activeDoctors');
            })
            ->active()
            ->get(['id', 'name', 'type', 'address', 'city', 'latitude', 'longitude', 
                  'average_rating', 'doctor_count', 'is_verified', 'is_featured', 
                  'specialties', 'services']);

        $doctors = User::where('role', 'doctor')
            ->where('status', 'active')
            ->with(['doctorProfile', 'primaryClinic'])
            ->get()
            ->filter(function ($doctor) {
                return $doctor->doctorProfile && $doctor->doctorProfile->is_verified;
            });

        $cities = MedicalCenter::distinct()->pluck('city')->filter()->values();
        $specialties = $this->extractAllSpecialties($medicalCenters);

        return view('frontend.map.index', compact('medicalCenters', 'doctors', 'filters', 'cities', 'specialties'));
    }

    public function getMapData(Request $request)
    {
        $medicalCenters = MedicalCenter::active()
            ->withCount(['activeDoctors as active_doctors_count'])
            ->get(['id', 'name', 'type', 'address', 'city', 'latitude', 'longitude', 
                  'average_rating', 'doctor_count', 'is_verified', 'is_featured', 
                  'specialties', 'services', 'phone', 'email']);

        $doctors = User::where('role', 'doctor')
            ->where('status', 'active')
            ->with(['doctorProfile' => function ($query) {
                $query->select('doctor_id', 'specialization', 'average_rating', 'years_of_experience');
            }, 'primaryClinic'])
            ->get(['id', 'name', 'email', 'phone', 'latitude', 'longitude']);

        $data = [
            'medical_centers' => $medicalCenters->map(function ($center) {
                return [
                    'id' => $center->id,
                    'name' => $center->name,
                    'type' => $center->type,
                    'type_label' => $this->getTypeLabel($center->type),
                    'address' => $center->address,
                    'city' => $center->city,
                    'latitude' => $center->latitude,
                    'longitude' => $center->longitude,
                    'rating' => $center->average_rating,
                    'doctor_count' => $center->active_doctors_count ?? $center->doctor_count,
                    'is_verified' => $center->is_verified,
                    'is_featured' => $center->is_featured,
                    'specialties' => is_array($center->specialties) ? $center->specialties : json_decode($center->specialties, true) ?? [],
                    'services' => is_array($center->services) ? $center->services : json_decode($center->services, true) ?? [],
                    'contact' => [
                        'phone' => $center->phone,
                        'email' => $center->email
                    ],
                    'icon' => $this->getIconForType($center->type),
                    'color' => $this->getColorForType($center->type),
                    'popup_content' => $this->generatePopupContent($center)
                ];
            }),
            'doctors' => $doctors->map(function ($doctor) {
                $clinic = $doctor->primaryClinic;
                return [
                    'id' => $doctor->id,
                    'name' => $doctor->name,
                    'specialization' => $doctor->doctorProfile->specialization ?? 'General',
                    'rating' => $doctor->doctorProfile->average_rating ?? 4.5,
                    'experience' => $doctor->doctorProfile->years_of_experience ?? 0,
                    'latitude' => $clinic ? ($clinic->latitude ?? null) : null,
                    'longitude' => $clinic ? ($clinic->longitude ?? null) : null,
                    'clinic_name' => $clinic ? $clinic->name : null,
                    'icon' => 'doctor-icon',
                    'color' => '#4CAF50',
                    'popup_content' => $this->generateDoctorPopupContent($doctor)
                ];
            })->filter(function ($doctor) {
                return $doctor['latitude'] && $doctor['longitude'];
            }),
            'stats' => [
                'total_centers' => $medicalCenters->count(),
                'total_doctors' => $doctors->count(),
                'verified_centers' => $medicalCenters->where('is_verified', true)->count(),
                'featured_centers' => $medicalCenters->where('is_featured', true)->count(),
                'by_type' => $medicalCenters->groupBy('type')->map->count(),
                'by_city' => $medicalCenters->groupBy('city')->map->count()
            ]
        ];

        return response()->json($data);
    }

    private function extractAllSpecialties($medicalCenters)
    {
        $allSpecialties = [];
        
        foreach ($medicalCenters as $center) {
            $specialties = is_array($center->specialties) 
                ? $center->specialties 
                : json_decode($center->specialties, true) ?? [];
            
            $allSpecialties = array_merge($allSpecialties, $specialties);
        }
        
        return array_values(array_unique($allSpecialties));
    }

    private function getTypeLabel($type)
    {
        $labels = [
            'clinic' => 'عيادة',
            'hospital' => 'مستشفى',
            'medical_center' => 'مركز طبي',
            'lab' => 'مختبر',
            'pharmacy' => 'صيدلية'
        ];
        
        return $labels[$type] ?? $type;
    }

    private function getIconForType($type)
    {
        $icons = [
            'clinic' => 'hospital',
            'hospital' => 'hospital-alt',
            'medical_center' => 'clinic-medical',
            'lab' => 'flask',
            'pharmacy' => 'pills'
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
            'pharmacy' => '#f39c12'
        ];
        
        return $colors[$type] ?? '#34495e';
    }

    private function generatePopupContent($center)
    {
        $specialties = is_array($center->specialties) 
            ? $center->specialties 
            : json_decode($center->specialties, true) ?? [];
        
        $services = is_array($center->services) 
            ? $center->services 
            : json_decode($center->services, true) ?? [];
        
        $verifiedBadge = $center->is_verified 
            ? '<span class="badge bg-success"><i class="fas fa-check-circle"></i> موثق</span>' 
            : '';
        
        $featuredBadge = $center->is_featured 
            ? '<span class="badge bg-warning"><i class="fas fa-star"></i> مميز</span>' 
            : '';
        
        $ratingStars = str_repeat('<i class="fas fa-star text-warning"></i>', floor($center->average_rating ?? 0)) 
            . (($center->average_rating ?? 0) - floor($center->average_rating ?? 0) >= 0.5 ? '<i class="fas fa-star-half-alt text-warning"></i>' : '');
        
        return '
            <div class="map-popup">
                <h6 class="mb-2">' . $center->name . '</h6>
                <div class="mb-2">' . $verifiedBadge . ' ' . $featuredBadge . '</div>
                <p class="mb-1"><i class="fas fa-map-marker-alt"></i> ' . $center->address . ', ' . $center->city . '</p>
                <p class="mb-1"><i class="fas fa-stethoscope"></i> ' . $this->getTypeLabel($center->type) . '</p>
                <p class="mb-1"><i class="fas fa-user-md"></i> ' . ($center->active_doctors_count ?? $center->doctor_count) . ' طبيب</p>
                <p class="mb-1"><i class="fas fa-star"></i> ' . ($center->average_rating ?? '0.0') . ' ' . $ratingStars . '</p>
                ' . (!empty($specialties) ? '<p class="mb-1"><strong>التخصصات:</strong> ' . implode(', ', array_slice($specialties, 0, 3)) . '</p>' : '') . '
                <div class="mt-3">
                    <a href="' . route('medical-centers.show', $center->id) . '" class="btn btn-sm btn-primary">عرض التفاصيل</a>
                    <a href="' . route('appointments.create', ['center_id' => $center->id]) . '" class="btn btn-sm btn-success">حجز موعد</a>
                </div>
            </div>
        ';
    }

    private function generateDoctorPopupContent($doctor)
    {
        $profile = $doctor->doctorProfile;
        
        $ratingStars = str_repeat('<i class="fas fa-star text-warning"></i>', floor($profile->average_rating ?? 0)) 
            . (($profile->average_rating ?? 0) - floor($profile->average_rating ?? 0) >= 0.5 ? '<i class="fas fa-star-half-alt text-warning"></i>' : '');
        
        return '
            <div class="map-popup">
                <h6 class="mb-2"><i class="fas fa-user-md"></i> د. ' . $doctor->name . '</h6>
                <p class="mb-1"><strong>التخصص:</strong> ' . ($profile->specialization ?? 'عام') . '</p>
                <p class="mb-1"><strong>الخبرة:</strong> ' . ($profile->years_of_experience ?? 0) . ' سنة</p>
                <p class="mb-1"><strong>التقييم:</strong> ' . ($profile->average_rating ?? '0.0') . ' ' . $ratingStars . '</p>
                ' . ($doctor->clinic_name ? '<p class="mb-1"><i class="fas fa-clinic-medical"></i> ' . $doctor->clinic_name . '</p>' : '') . '
                <div class="mt-3">
                    <a href="' . route('doctors.show', $doctor->id) . '" class="btn btn-sm btn-primary">عرض البروفايل</a>
                    <a href="' . route('appointments.create', ['doctor_id' => $doctor->id]) . '" class="btn btn-sm btn-success">حجز استشارة</a>
                </div>
            </div>
        ';
    }
}