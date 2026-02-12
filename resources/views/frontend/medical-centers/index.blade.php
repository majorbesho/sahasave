<!-- resources/views/frontend/medical-centers/index.blade.php -->
@extends('frontend.layouts.master')
@section('title', __('seo.medical_centers.title'))
@section('meta_description', __('seo.medical_centers.description'))

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center inner-banner">
            <div class="col-md-12 col-12 text-center">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <i class="isax isax-home-15"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{ is_array($title) ? 'Medical Centers' : $title }}</li>
                    </ol>
                    <h1 class="breadcrumb-title">{{ $title }}</h1>
                </nav>
            </div>
        </div>
    </div>
    <div class="breadcrumb-bg">
        <!-- إضافة الصور الخلفية -->
    </div>
</div>
<!-- /Breadcrumb -->

<div class="content doctor-content">
    <div class="container">
        <!-- Hospital Tabs -->
        <nav class="settings-tab hospital-tab">
            <ul class="nav nav-tabs-bottom justify-content-center" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $type == 'hospital' ? 'active' : '' }}" 
                       href="{{ route('medical-centershome.index', ['type' => 'hospital']) }}">
                        {{ __('global.hospitals') }}
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ route('specialties.index') }}">
                        {{ __('global.specialties') }}
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $type == 'clinic' ? 'active' : '' }}" 
                       href="{{ route('medical-centershome.index', ['type' => 'clinic']) }}">
                        {{ __('global.clinics') }}
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /Hospital Tabs -->

        <!-- Show Result -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between flex-wrap result-wrap gap-3">
                    <h5>
                        {{ __('global.showing') }}
                        <span class="text-secondary">{{ is_array($medicalCenters->total()) ? 0 : $medicalCenters->total() }}</span>
                        {{ is_array($title) ? 'Medical Centers' : $title }} {{ __('global.for_you') }}
                    </h5>
                    <div class="d-flex align-items-center flex-wrap gap-3">
                        <!-- فلترة حسب المدينة -->
                        <select class="select form-select" id="cityFilter">
                            <option value="">{{ __('global.all_cities') }}</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->city }}" 
                                    {{ request('city') == $city->city ? 'selected' : '' }}>
                                    {{ $city->city }} ({{ $city->count }})
                                </option>
                            @endforeach
                        </select>
                        
                        <!-- البحث -->
                        <form method="GET" action="{{ route('medical-centershome.index') }}" 
                              class="input-block dash-search-input">
                            <input type="hidden" name="type" value="{{ $type }}">
                            <input type="text" class="form-control" name="search" 
                                   placeholder="{{ __('global.search') }} {{ is_array($title) ? '' : $title }}" 
                                   value="{{ request('search') }}">
                            <button type="submit" class="search-icon border-0 bg-transparent">
                                <i class="isax isax-search-normal"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Show Result -->

        <!-- Filters -->
        <div class="d-flex align-items-center flex-wrap hospital-form mb-4">
            <div class="form-check d-flex align-items-center">
                <input class="form-check-input mt-0 filter-radio" type="radio" 
                       name="filter" value="" id="all-hospital" 
                       {{ !request('filter') ? 'checked' : '' }}>
                <label class="form-check-label fs-14 fw-medium ms-2" for="all-hospital">
                    {{ __('global.all') }} {{ is_array($title) ? '' : $title }}
                </label>
            </div>
            <div class="form-check d-flex align-items-center">
                <input class="form-check-input mt-0 filter-radio" type="radio" 
                       name="filter" value="virtual" id="virtual" 
                       {{ request('filter') == 'virtual' ? 'checked' : '' }}>
                <label class="form-check-label fs-14 fw-medium ms-2" for="virtual">
                    {{ __('global.virtual') }}
                </label>
            </div>
            <div class="form-check d-flex align-items-center">
                <input class="form-check-input mt-0 filter-radio" type="radio" 
                       name="filter" value="appointment" id="appointment" 
                       {{ request('filter') == 'appointment' ? 'checked' : '' }}>
                <label class="form-check-label fs-14 fw-medium ms-2" for="appointment">
                    {{ __('global.appointments') }}
                </label>
            </div>
            <div class="form-check d-flex align-items-center">
                <input class="form-check-input mt-0 filter-radio" type="radio" 
                       name="filter" value="clinic" id="clinic" 
                       {{ request('filter') == 'clinic' ? 'checked' : '' }}>
                <label class="form-check-label fs-14 fw-medium ms-2" for="clinic">
                    {{ __('global.hospitals') }} / {{ __('global.clinics') }}
                </label>
            </div>
        </div>
        <!-- /Filters -->

        <!-- All Medical Centers -->
        <div class="all-hospital">
            <div class="row">
                @forelse($medicalCenters as $center)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card hospital-item h-100">
                        <div class="card-body text-center">
                            <a href="{{ route('medical-centershome.show', $center->slug) }}" 
                               class="hospital-icon d-block mb-3">
                                    <img src="{{ $center->logo_url }}" 
                                         alt="{{ is_array($center->name) ? 'Medical Center' : $center->name }}" 
                                         class="img-fluid rounded" 
                                         style="height: 80px; object-fit: contain;">
                            </a>
                            <h6 class="mb-1">
                                <a href="{{ route('medical-centershome.show', $center->slug) }}">
                                    {{ $center->name }}
                                </a>
                            </h6>
                            
                            <!-- التقييم -->
                            @if($center->average_rating > 0)
                            <div class="rating mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $center->average_rating ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                                <span class="text-muted">({{ $center->rating_count }})</span>
                            </div>
                            @endif
                            
                            <p class="fs-14 mb-2">
                                <p class="mb-2 text-muted small"><i class="isax isax-location5 me-1"></i>
                                {{ $center->city }}, {{ $center->state ?? $center->country }}</p>
                            </p>
                            
                            <!-- المعلومات الإضافية -->
                            <div class="center-info fs-12 text-muted mb-2">
                                @if($center->doctor_count > 0)
                                    <span class="me-2">
                                        <i class="fas fa-user-md me-1"></i> {{ $center->doctor_count }} {{ __('global.doctors') }}
                                    </span>
                                @endif
                                
                                @if($center->is_virtual)
                                    <span class="badge bg-info me-1">{{ __('global.virtual') }}</span>
                                @endif
                                
                                @if($center->is_featured)
                                    <span class="badge bg-warning">{{ __('medical_centers.featured') }}</span>
                                @endif
                            </div>
                            
                            <!-- التخصصات - بطريقة آمنة -->
                            @if(!empty($center->specialties) && is_array($center->specialties))
                                @php
                                    // الحصول على أول 3 تخصصات فقط
                                    $specialtyIds = array_slice($center->specialties, 0, 3);
                                    // الحصول على التخصصات الفعلية
                                    $centerSpecialties = collect($specialties)->whereIn('id', $specialtyIds);
                                @endphp
                                
                                @if($centerSpecialties->count() > 0)
                                <div class="mt-2">
                                    @foreach($centerSpecialties as $specialty)
                                        <span class="badge bg-light text-dark me-1 mb-1">
                                            {{ $specialty->name }}
                                        </span>
                                    @endforeach
                                    @if(count($center->specialties) > 3)
                                        <span class="badge bg-light text-dark">
                                            +{{ count($center->specialties) - 3 }}
                                        </span>
                                    @endif
                                </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ __('medical_centers.center_not_found_message') }}
                    </div>
                </div>
                @endforelse
            </div>
            
            <!-- الترقيم -->
            @if($medicalCenters->hasPages())
            <div class="mt-4">
                {{ $medicalCenters->appends(request()->query())->links() }}
            </div>
            @endif
            
            <!-- زر Load More -->
            @if($medicalCenters->hasMorePages())
            <div class="loader-item text-center mt-4">
                <a href="{{ $medicalCenters->nextPageUrl() }}" 
                   class="btn btn-primary d-inline-flex align-items-center">
                    <i class="isax isax-d-cube-scan me-2"></i>
                    {{ __('global.view_all') }}
                </a>
            </div>
            @endif
        </div>
        <!-- /All Medical Centers -->
    </div>
</div>

<script>
$(document).ready(function() {
    // فلترة حسب المدينة
    $('#cityFilter').change(function() {
        const city = $(this).val();
        const url = new URL(window.location.href);
        
        if (city) {
            url.searchParams.set('city', city);
        } else {
            url.searchParams.delete('city');
        }
        
        window.location.href = url.toString();
    });
    
    // فلترة حسب الراديو باتونز
    $('.filter-radio').change(function() {
        const filter = $(this).val();
        const url = new URL(window.location.href);
        
        if (filter) {
            url.searchParams.set('filter', filter);
        } else {
            url.searchParams.delete('filter');
        }
        
        window.location.href = url.toString();
    });
});
</script>

@endsection