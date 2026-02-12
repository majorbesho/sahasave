@extends('frontend.layouts.master')

@section('title', __('medical_centers.book_appointment') . ' | ' . $center->name)

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="text-center col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('medical_centers.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('medical-centershome.index') }}">{{ __('medical_centers.medical_centers') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('medical-centershome.show', $center->slug) }}">{{ $center->name }}</a></li>
                            <li class="breadcrumb-item active">{{ __('medical_centers.book_appointment') }}</li>
                        </ol>
                        <h2 class="breadcrumb-title">{{ __('medical_centers.book_appointment') }} - {{ $center->name }}</h2>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="content">
        <div class="container">
            <div class="row">
                <!-- Center Info -->
                <div class="col-lg-4">
                    <div class="card booking-card">
                        <div class="card-body">
                            <div class="text-center booking-doc-info">
                                <img src="{{ $center->logo_url }}" alt="{{ $center->name }}" class="mb-3 img-fluid rounded shadow-sm" style="width: 100px; height: 100px; object-fit: contain; background: #fff; padding: 5px;">
                                <h4>{{ $center->name }}</h4>
                                <p class="text-muted">{{ $center->type_localized }}</p>
                                
                                <div class="mt-3 clinic-details">
                                    <p class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i> {{ $center->address }}, {{ $center->city }}</p>
                                    <p class="mb-0"><i class="fas fa-phone text-success me-2"></i> {{ $center->phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Patient Info (Logged in user) -->
                    @if(Auth::check())
                    <div class="mt-4 card patient-info-card">
                        <div class="card-header">
                            <h5 class="mb-0 card-title">{{ __('booking.patient_info') }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-2"><strong>{{ __('global.name') }}:</strong> {{ Auth::user()->name }}</p>
                            <p class="mb-2"><strong>{{ __('global.email') }}:</strong> {{ Auth::user()->email }}</p>
                            <p class="mb-0"><strong>{{ __('global.phone') }}:</strong> {{ Auth::user()->phone }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Booking Form -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 card-title">{{ __('medical_centers.book_appointment_now') }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('medical-centershome.book-general.store') }}" method="POST" id="bookingForm">
                                @csrf
                                <input type="hidden" name="medical_center_id" value="{{ $center->id }}">

                                <div class="row">
                                    <!-- Visit Type -->
                                    <div class="col-md-12">
                                        <div class="mb-4 form-group">
                                            <label class="form-label">{{ __('medical_centers.visit_type') }} <span class="text-danger">*</span></label>
                                            <select name="visit_type" class="form-select" required>
                                                <option value="general_visit">{{ __('medical_centers.general_visit') }}</option>
                                                <option value="consultation">{{ __('medical_centers.specialized_consultation') }}</option>
                                                <option value="emergency">{{ __('medical_centers.emergency') }}</option>
                                                <option value="lab_test">{{ __('medical_centers.lab_test') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Date -->
                                    <div class="col-md-6">
                                        <div class="mb-4 form-group">
                                            <label class="form-label">{{ __('medical_centers.booking_date') }} <span class="text-danger">*</span></label>
                                            <input type="date" name="scheduled_date" class="form-control" min="{{ date('Y-m-d') }}" required>
                                        </div>
                                    </div>

                                    <!-- Time -->
                                    <div class="col-md-6">
                                        <div class="mb-4 form-group">
                                            <label class="form-label">{{ __('medical_centers.booking_time') }} <span class="text-danger">*</span></label>
                                            <input type="time" name="scheduled_time" class="form-control" required>
                                            <small class="text-muted">{{ __('medical_centers.select_time_within_hours') }}</small>
                                        </div>
                                    </div>

                                    <!-- Notes -->
                                    <div class="col-md-12">
                                        <div class="mb-4 form-group">
                                            <label class="form-label">{{ __('medical_centers.patient_notes') }}</label>
                                            <textarea name="patient_notes" class="form-control" rows="4" placeholder="{{ __('medical_centers.notes_placeholder') }}"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-calendar-check me-2"></i> {{ __('medical_centers.confirm_booking') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Doctors info (Optional) -->
                    @if($doctors->count() > 0)
                    <div class="mt-4 alert alert-info">
                        <h6><i class="fas fa-info-circle me-2"></i> {{ __('medical_centers.did_you_know') }}</h6>
                        <p class="mb-2 small">{{ __('medical_centers.can_book_with_specific_doctor') }}</p>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($doctors->take(3) as $doctor)
                            <a href="{{ route('doctors.book', $doctor->doctorProfile->slug ?? $doctor->id) }}" class="btn btn-sm btn-outline-info">
                                {{ $doctor->name }}
                            </a>
                            @endforeach
                            @if($doctors->count() > 3)
                            <span class="small py-1">...</span>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
