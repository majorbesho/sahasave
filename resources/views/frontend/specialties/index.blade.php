@extends('frontend.layouts.master')

@section('title', 'Medical Specialties')

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
                        <li class="breadcrumb-item active">Medical Specialties</li>
                    </ol>
                    <h2 class="breadcrumb-title">Medical Specialties</h2>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<div class="content doctor-content">
    <div class="container">
        <!-- Specialties Tabs -->
        <nav class="settings-tab hospital-tab">
            <ul class="nav nav-tabs-bottom justify-content-center" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ route('medical-centershome.index', ['type' => 'hospital']) }}">
                        Hospitals
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" href="{{ route('specialties.index') }}">
                        Specialties
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ route('medical-centershome.index', ['type' => 'clinic']) }}">
                        Clinics
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /Specialties Tabs -->

        <!-- Show Result -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between flex-wrap result-wrap gap-3">
                    <h5>
                        Showing
                        <span class="text-secondary">
                            {{ $specialties->total() }}
                        </span>
                        Medical Specialties For You
                        
                        @if($search)
                            <span class="text-muted">for "{{ $search }}"</span>
                        @endif
                    </h5>
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('specialties.index') }}" 
                          class="input-block dash-search-input">
                        <input type="text" class="form-control" name="search" 
                               placeholder="Search Specialties" 
                               value="{{ $search ?? '' }}">
                        <button type="submit" class="search-icon border-0 bg-transparent">
                            <i class="isax isax-search-normal"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Show Result -->

        <!-- All Specialties -->
        <div class="all-hospital mt-4">
            @if($specialties->count() > 0)
                <div class="row">
                    @foreach($specialties as $specialty)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card hospital-item h-100 shadow-sm border-0">
                                <div class="card-body text-center p-3">
                                    <!-- Specialty Icon -->
                                    <div class="specialty-icon mb-3">
                                        <div class="icon-wrapper rounded-circle d-inline-flex align-items-center justify-content-center" 
                                             style="background-color: {{ $specialty->color ?? '#3B82F6' }}20; 
                                                    width: 70px; 
                                                    height: 70px;">
                                            @if($specialty->icon_url)
                                                <img src="{{ $specialty->icon_url }}" 
                                                     alt="{{ $specialty->name }}"
                                                     style="width: 40px; height: 40px; object-fit: contain;">
                                            @else
                                                <i class="fas fa-stethoscope" 
                                                   style="font-size: 24px; color: {{ $specialty->color ?? '#3B82F6' }};"></i>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Specialty Name -->
                                    <h6 class="mb-2">
                                        <a href="{{ route('specialties.show', $specialty->slug) }}" 
                                           class="text-decoration-none text-dark fw-bold">
                                            {{ $specialty->name }}
                                        </a>
                                    </h6>
                                    
                                    <!-- Parent Specialty (if exists) -->
                                    @if($specialty->parent_id && $specialty->parent)
                                    <p class="text-muted small mb-3">
                                        <i class="fas fa-level-up-alt me-1"></i>
                                        {{ $specialty->parent->name }}
                                    </p>
                                    @endif
                                    
                                    <!-- Statistics -->
                                    <div class="specialty-stats mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="stat-item">
                                                    <i class="fas fa-user-md text-primary me-1"></i>
                                                    <span class="fw-medium">{{ $specialty->active_doctors_count ?? 0 }}</span>
                                                    <small class="d-block text-muted">Doctors</small>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="stat-item">
                                                    <i class="fas fa-calendar-check text-success me-1"></i>
                                                    <span class="fw-medium">{{ $specialty->consultations_count ?? 0 }}</span>
                                                    <small class="d-block text-muted">Consultations</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Additional Info -->
                                    <div class="center-info fs-12 text-muted mb-3">
                                        @if($specialty->is_featured)
                                            <span class="badge bg-warning me-1 mb-1">Featured</span>
                                        @endif
                                        
                                        @if($specialty->is_emergency_available)
                                            <span class="badge bg-danger me-1 mb-1">Emergency</span>
                                        @endif
                                        
                                        @if(!$specialty->parent_id)
                                            <span class="badge bg-info mb-1">Main Specialty</span>
                                        @else
                                            <span class="badge bg-secondary mb-1">Sub-Specialty</span>
                                        @endif
                                    </div>
                                    
                                    <!-- Description Preview -->
                                    @if($specialty->description)
                                    <p class="text-muted small mb-3 text-truncate" 
                                       style="max-height: 40px; overflow: hidden; -webkit-line-clamp: 2; display: -webkit-box; -webkit-box-orient: vertical;">
                                        {{ Str::limit($specialty->description, 80) }}
                                    </p>
                                    @endif
                                    
                                    <!-- View Details Button -->
                                    <a href="{{ route('specialties.show', $specialty->slug) }}" 
                                       class="btn btn-sm btn-outline-primary w-100">
                                        <i class="fas fa-eye me-1"></i> View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                @if($specialties->hasPages())
                <div class="mt-5">
                    <div class="d-flex justify-content-center">
                        {{ $specialties->appends(['search' => $search])->links() }}
                    </div>
                </div>
                @endif
                
            @else
                <div class="col-12">
                    <div class="alert alert-info text-center py-4">
                        <div class="mb-3">
                            <i class="fas fa-stethoscope fa-3x text-info"></i>
                        </div>
                        <h5 class="mb-2">No specialties found</h5>
                        
                        @if($search)
                            <p class="mb-3">No results found for "<strong>{{ $search }}</strong>"</p>
                            <a href="{{ route('specialties.index') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left me-1"></i> View All Specialties
                            </a>
                        @else
                            <p class="mb-3">There are no specialties available at the moment.</p>
                            <a href="{{ route('home') }}" class="btn btn-primary">
                                <i class="fas fa-home me-1"></i> Back to Home
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        <!-- /All Specialties -->

        <!-- Featured Specialties Section (Optional) -->
        @if(!$search && $specialties->where('is_featured', true)->count() > 0)
        <div class="mt-5">
            <div class="section-header mb-4">
                <h4 class="fw-bold">
                    <i class="fas fa-star text-warning me-2"></i>
                    Featured Specialties
                </h4>
                <p class="text-muted">Most popular medical specialties</p>
            </div>
            
            <div class="row">
                @foreach($specialties->where('is_featured', true)->take(4) as $featured)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card border-warning border-2 shadow-sm">
                            <div class="card-body text-center">
                                <span class="badge bg-warning position-absolute top-0 start-0 m-2">
                                    <i class="fas fa-star me-1"></i> Featured
                                </span>
                                
                                <div class="mb-3">
                                    <div class="icon-wrapper rounded-circle d-inline-flex align-items-center justify-content-center" 
                                         style="background-color: #FEF3C7; width: 60px; height: 60px;">
                                        @if($featured->icon_url)
                                            <img src="{{ $featured->icon_url }}" 
                                                 alt="{{ $featured->name }}"
                                                 style="width: 30px; height: 30px;">
                                        @else
                                            <i class="fas fa-star text-warning"></i>
                                        @endif
                                    </div>
                                </div>
                                
                                <h6 class="mb-2">{{ $featured->name }}</h6>
                                <p class="text-muted small mb-3">{{ $featured->active_doctors_count ?? 0 }} Doctors</p>
                                
                                <a href="{{ route('specialties.show', $featured->slug) }}" 
                                   class="btn btn-sm btn-warning">
                                    Explore
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
<style>
    .specialty-icon .icon-wrapper {
        transition: transform 0.3s ease;
    }
    
    .hospital-item:hover .specialty-icon .icon-wrapper {
        transform: scale(1.1);
    }
    
    .hospital-item {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
    }
    
    .hospital-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    .stat-item {
        padding: 8px 0;
        border-radius: 8px;
        background: #f8f9fa;
    }
    
    .stat-item:hover {
        background: #e9ecef;
    }
</style>
@endsection

