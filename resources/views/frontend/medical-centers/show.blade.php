@extends('frontend.layouts.master')

@section('title', ($center->name ?? __('medical_centers.default_center_name')) . ' | SehaSave')

@section('meta_description', ($center->name ?? __('medical_centers.default_center_name')) . ' - ' . ($center->type_localized) . ' في ' . ($center->city ?? __('medical_centers.not_set')) . '. ' . ($center->description ? Str::limit($center->description, 100) : __('medical_centers.book_now')))

@section('og_title', ($center->name ?? __('medical_centers.default_center_name')) . ' | SehaSave')
@section('og_description', ($center->type_localized) . ' في ' . ($center->city ?? __('medical_centers.not_set')))
@section('og_type', 'business.business')

@push('head')
{{-- MedicalClinic Schema for SEO --}}
@if(isset($center) && $center)
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "{{ $center->type == 'hospital' ? 'Hospital' : 'MedicalClinic' }}",
    "name": "{{ $center->name }}",
    "image": "{{ asset('frontend/xx/assets/img/og-image.jpg') }}",
    "url": "{{ url()->current() }}",
    "description": "{{ $center->description ?? '' }}",
    "telephone": "{{ $center->phone ?? '' }}",
    "email": "{{ $center->email ?? '' }}",
    @if($center->address)
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ $center->address }}",
        "addressLocality": "{{ $center->city ?? 'Dubai' }}",
        "addressRegion": "{{ $center->state ?? 'Dubai' }}",
        "addressCountry": "AE"
    },
    @endif
    @if($center->latitude && $center->longitude)
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": "{{ $center->latitude }}",
        "longitude": "{{ $center->longitude }}"
    },
    @endif
    @if($center->average_rating)
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{ number_format($center->average_rating, 1) }}",
        "reviewCount": "{{ $center->rating_count ?? 0 }}",
        "bestRating": "5",
        "worstRating": "1"
    },
    @endif
    @php
        $workingHours = is_array($center->working_hours) ? $center->working_hours : json_decode($center->working_hours, true);
        $hoursSpecs = [];
        $dayMapping = [
            'sunday' => 'Sunday', 'monday' => 'Monday', 'tuesday' => 'Tuesday',
            'wednesday' => 'Wednesday', 'thursday' => 'Thursday', 'friday' => 'Friday', 'saturday' => 'Saturday'
        ];
        if($workingHours) {
            foreach($workingHours as $day => $hours) {
                if(!($hours['closed'] ?? false)) {
                    $hoursSpecs[] = '"' . ($dayMapping[$day] ?? $day) . ' ' . ($hours['open'] ?? '09:00') . '-' . ($hours['close'] ?? '18:00') . '"';
                }
            }
        }
    @endphp
    @if(count($hoursSpecs) > 0)
    "openingHours": [{!! implode(', ', $hoursSpecs) !!}],
    @endif
    "priceRange": "$$"
}
</script>

{{-- BreadcrumbList Schema --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@type": "ListItem",
            "position": 1,
            "name": "{{ __('medical_centers.home') ?? 'Home' }}",
            "item": "{{ url('/') }}"
        },
        {
            "@type": "ListItem",
            "position": 2,
            "name": "{{ __('medical_centers.medical_centers') ?? 'Medical Centers' }}",
            "item": "{{ route('medical-centershome.index') }}"
        },
        {
            "@type": "ListItem",
            "position": 3,
            "name": "{{ $center->name }}",
            "item": "{{ url()->current() }}"
        }
    ]
}
</script>
@endif
@endpush

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="text-center col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="isax isax-home-15"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('medical-centershome.index') }}">{{ __('medical_centers.medical_centers') ?? 'Medical Centers' }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $center->name }}</li>
                        </ol>
                        <h1 class="breadcrumb-title">{{ $center->name }}</h1>
                    </nav>
                </div>
            </div>
        </div>
        <div class="breadcrumb-bg">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-01.png') }}" class="breadcrumb-bg-01" alt="img" width="100" height="100">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-02.png') }}" class="breadcrumb-bg-02" alt="img" width="100" height="100">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" class="breadcrumb-bg-03" alt="img" width="100" height="100">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" class="breadcrumb-bg-04" alt="img" width="100" height="100">
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="content">
    @if(isset($center) && $center)
<div class="container">


    <div class="row">
        <!-- صورة المركز -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class=" justify-content-between align-items-start mb-4">
                        <div class=" align-items-center mb-2">
                            <div class="me-3">
                                <img src="{{ $center->logo_url }}" alt="{{ $center->name }}" class="img-fluid rounded shadow-sm" style="width: 80px; height: 80px; object-fit: contain; background: #fff; padding: 5px;">
                            </div>
                            <div>
                                <h1 class="h3 mb-1">{{ $center->name }}</h1>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                @if($center->is_verified)
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle me-1"></i> {{ __('medical_centers.verified') }}
                                </span>
                                @endif
                                @if($center->is_featured)
                                <span class="badge bg-warning">
                                    <i class="fas fa-star me-1"></i> {{ __('medical_centers.featured') }}
                                </span>
                                @endif
                                <span class="badge bg-primary">{{ $center->type_localized }}</span>
                            </div>
                        </div>
                        
                        <div class="text-end">
                            @if($center->average_rating)
                            <div class="rating-display">
                                <div class="stars mb-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($center->average_rating))
                                            <i class="fas fa-star text-warning"></i>
                                        @elseif($i - 0.5 <= $center->average_rating)
                                            <i class="fas fa-star-half-alt text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-muted small">{{ number_format($center->average_rating, 1) }} ({{ $center->rating_count ?? 0 }} {{ __('medical_centers.rating') }})</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- معلومات الاتصال -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i> {{ __('medical_centers.address') }}
                                </h6>
                                <p class="mb-0">{{ $center->address ?? '' }}{{ $center->city ? ', ' . $center->city : '' }}{{ $center->state ? ', ' . $center->state : '' }}</p>
                            </div>
                            
                            <div class="info-item mb-3">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-phone text-primary me-2"></i> {{ __('medical_centers.phone') }}
                                </h6>
                                <p class="mb-0">{{ $center->phone ?? __('medical_centers.not_available') }}</p>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="info-item mb-3">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-envelope text-primary me-2"></i> {{ __('medical_centers.email') }}
                                </h6>
                                <p class="mb-0">{{ $center->email ?? __('medical_centers.not_available') }}</p>
                            </div>
                            
                            <div class="info-item mb-3">
                                <h6 class="text-muted mb-2">
                                    <i class="fas fa-globe text-primary me-2"></i> {{ __('medical_centers.website') }}
                                </h6>
                                <p class="mb-0">
                                    @if($center->website)
                                    <a href="{{ $center->website }}" target="_blank" class="text-decoration-none">
                                        {{ $center->website }}
                                    </a>
                                    @else
                                    {{ __('medical_centers.not_available') }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- الوصف -->
                    @if($center->description)
                    <div class="mb-4">
                        <h5 class="mb-3">
                            <i class="fas fa-info-circle text-primary me-2"></i> {{ __('medical_centers.description') }}
                        </h5>
                        <p class="text-muted">{{ $center->description }}</p>
                    </div>
                    @endif
                    
                    <!-- الخدمات -->
                    @php
                        $services = $center->services_localized;
                        if (is_string($services)) $services = json_decode($services, true);
                        
                        $facilities = $center->facilities_localized;
                        if (is_string($facilities)) $facilities = json_decode($facilities, true);
                        
                        $specialties = is_array($center->specialties) ? $center->specialties : json_decode($center->specialties, true);
                    @endphp
                    
                    @if($services && count($services) > 0)
                    <div class="mb-4">
                        <h5 class="mb-3">
                            <i class="fas fa-concierge-bell text-primary me-2"></i> {{ __('medical_centers.services_offered') }}
                        </h5>
                        <div class="row">
                            @foreach(array_chunk($services, ceil(count($services)/2)) as $serviceChunk)
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    @foreach($serviceChunk as $service)
                                    <li class="mb-2">
                                        <i class="fas fa-check-circle text-success me-2"></i> {{ $center->localizeItem($service) }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- التخصصات -->
                    @if(isset($centerSpecialties) && count($centerSpecialties) > 0)
                    <div class="mb-4">
                        <h5 class="mb-3">
                            <i class="fas fa-stethoscope text-primary me-2"></i> {{ __('medical_centers.specialties') }}
                        </h5>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($centerSpecialties as $spec)
                            <a href="{{ route('medical-centershome.by-specialty', $spec->slug) }}" class="badge bg-info text-decoration-none">
                                {{ $spec->name }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- المرافق -->
                    @if($facilities && count($facilities) > 0)
                    <div class="mb-4">
                        <h5 class="mb-3">
                            <i class="fas fa-building text-primary me-2"></i> {{ __('medical_centers.facilities') }}
                        </h5>
                        <div class="row">
                            @foreach(array_chunk($facilities, ceil(count($facilities)/2)) as $facilityChunk)
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    @foreach($facilityChunk as $facility)
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i> {{ $center->localizeItem($facility) }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        </div>
        <!-- الجانب الأيمن -->
        <div class="col-lg-4">
            <!-- بطاقة حجز موعد -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-check me-2"></i> {{ __('medical_centers.book_appointment') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-hospital fa-4x text-primary mb-3"></i>
                        <h5>{{ $center->name }}</h5>
                        <p class="text-muted small mb-0">{{ $center->doctor_count ?? 0 }} {{ __('medical_centers.doctor_available') }}</p>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('medical-centershome.book-general', $center->slug) }}" 
                           class="btn btn-primary btn-lg">
                            <i class="fas fa-calendar-plus me-2"></i> {{ __('medical_centers.book_appointment_now') }}
                        </a>
                        <a href="{{ route('map.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-map-marker-alt me-2"></i> {{ __('medical_centers.back_to_map') }}
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- ساعات العمل -->
            @php
                $working_hours = is_array($center->working_hours) ? $center->working_hours : json_decode($center->working_hours, true);
            @endphp
            
            @if($working_hours)
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-clock text-primary me-2"></i> {{ __('medical_centers.working_hours') }}
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tbody>
                            @foreach([
                                'sunday' => __('medical_centers.sunday'),
                                'monday' => __('medical_centers.monday'),
                                'tuesday' => __('medical_centers.tuesday'),
                                'wednesday' => __('medical_centers.wednesday'),
                                'thursday' => __('medical_centers.thursday'),
                                'friday' => __('medical_centers.friday'),
                                'saturday' => __('medical_centers.saturday')
                            ] as $day_en => $day_localized)
                                @if(isset($working_hours[$day_en]) && !$working_hours[$day_en]['closed'])
                                <tr>
                                    <td>{{ $day_localized }}</td>
                                    <td class="text-end">
                                        {{ $working_hours[$day_en]['open'] }} - {{ $working_hours[$day_en]['close'] }}
                                    </td>
                                </tr>
                                @elseif(isset($working_hours[$day_en]) && $working_hours[$day_en]['closed'])
                                <tr class="text-muted">
                                    <td>{{ $day_localized }}</td>
                                    <td class="text-end">{{ __('medical_centers.closed') }}</td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            
            <!-- شركات التأمين -->
            @php
                $insurance_providers = $center->insurance_providers_localized;
                if (is_string($insurance_providers)) $insurance_providers = json_decode($insurance_providers, true);
            @endphp
            
            @if($insurance_providers && count($insurance_providers) > 0)
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-shield-alt text-primary me-2"></i> {{ __('medical_centers.accepted_insurance_providers') }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($insurance_providers as $insurance)
                        <span class="badge bg-light text-dark border">{{ $center->localizeItem($insurance) }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

    </div>
    
    <!-- خرائط جوجل -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-map-marked-alt text-primary me-2"></i> {{ __('medical_centers.location_on_map') }}
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div id="location-map" style="height: 300px; border-radius: 0 0 8px 8px;"></div>
                </div>
            </div>
        </div>
    </div>

    </div>
    @else
    <!-- حالة عدم وجود المركز -->
    <div class="text-center py-5">
        <div class="empty-state">
            <i class="fas fa-hospital fa-4x text-muted mb-4"></i>
            <h4 class="text-muted mb-3">{{ __('medical_centers.center_not_found') }}</h4>
            <p class="text-muted mb-4">{{ __('medical_centers.center_not_found_message') }}</p>
            <a href="{{ route('map.index') }}" class="btn btn-primary">
                <i class="fas fa-map-marked-alt me-2"></i> {{ __('medical_centers.back_to_map') }}
            </a>
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.info-item {
    padding: 10px;
    border-radius: 8px;
    background-color: #f8f9fa;
}

.rating-display {
    text-align: center;
}

.stars {
    font-size: 1.2rem;
}

.empty-state {
    padding: 60px 20px;
}

#location-map {
    width: 100%;
}
</style>
@endpush

@push('scripts')
@if(isset($center) && $center && $center->latitude && $center->longitude)
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<script>
document.addEventListener('DOMContentLoaded', function() {
    // إعداد الخريطة
    const map = L.map('location-map').setView([{{ $center->latitude }}, {{ $center->longitude }}], 15);
    
    // إضافة طبقة الخريطة
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    
    // إضافة علامة للموقع
    L.marker([{{ $center->latitude }}, {{ $center->longitude }}], {
        icon: L.divIcon({
            html: `<div class="custom-marker" style="background-color: #3498db;">
                    <i class="fas fa-hospital"></i>
                  </div>`,
            className: 'custom-div-icon',
            iconSize: [40, 40]
        })
    })
    .addTo(map)
    .bindPopup(`
        <div class="map-popup">
            <h6 class="mb-1">{{ $center->name }}</h6>
            <p class="mb-1 small"><i class="fas fa-map-marker-alt"></i> {{ $center->address }}</p>
        </div>
    `)
    .openPopup();
});
</script>
@endif
@endpush