@extends('frontend.layouts.master')

@section('content')
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('appointments.breadcrumb_home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('appointments.breadcrumb_details') }}</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">{{ __('appointments.title') }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="booking-doc-info">
                            @if($appointment->doctor)
                                <a href="{{ route('doctors.show', $appointment->doctor->doctorProfile->slug ?? $appointment->doctor->id) }}" class="booking-doc-img">
                                    <img src="{{ $appointment->doctor->photo ? Storage::url($appointment->doctor->photo) : asset('frontend/xx/assets/img/doctors/doctor-thumb-02.jpg') }}" alt="Doctor Image">
                                </a>
                            @elseif($appointment->medicalCenter)
                                <div class="booking-doc-img">
                                    <img src="{{ $appointment->medicalCenter->logo_url ?? asset('frontend/xx/assets/img/medical-center-placeholder.png') }}" alt="Medical Center Image">
                                </div>
                            @endif
                            <div class="booking-info">
                                @if($appointment->doctor)
                                    <h4><a href="{{ route('doctors.show', $appointment->doctor->doctorProfile->slug ?? $appointment->doctor->id) }}">{{ $appointment->doctor->name }}</a></h4>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="d-inline-block average-rating">{{ $appointment->doctor->average_rating ?? 0 }}</span>
                                    </div>
                                    <p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i> {{ $appointment->doctor->address ?? __('appointments.address_not_available') }}</p>
                                @elseif($appointment->medicalCenter)
                                    <h4>{{ $appointment->medicalCenter->name }}</h4>
                                    <p class="text-muted mb-0">{{ __('medical_centers.medical_center') }}</p>
                                    <p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i> {{ $appointment->medicalCenter->address ?? __('appointments.address_not_available') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('appointments.booking_info') }} 
                            <span class="badge bg-{{ $appointment->status == 'confirmed' ? 'success' : ($appointment->status == 'cancelled' ? 'danger' : 'warning') }} float-end">
                                {{ __('appointments.statuses.' . $appointment->status) }}
                            </span>
                        </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><strong>{{ __('appointments.appointment_number') }}:</strong> #{{ $appointment->appointment_number }}</li>
                                    <li class="mb-2"><strong>{{ __('appointments.appointment_date') }}:</strong> {{ \Carbon\Carbon::parse($appointment->scheduled_for)->translatedFormat('l, j F Y') }}</li>
                                    <li class="mb-2"><strong>{{ __('appointments.appointment_time') }}:</strong> 
                                        {{ \Carbon\Carbon::parse($appointment->scheduled_for)->format('h:i A') }} - 
                                        {{ \Carbon\Carbon::parse($appointment->scheduled_until)->format('h:i A') }}
                                        <span class="text-muted">({{ $appointment->duration }} {{ __('appointments.minutes') }})</span>
                                    </li>
                                    <li class="mb-2"><strong>{{ __('appointments.visit_type') }}:</strong> {{ $appointment->visit_type ?? __('appointments.general_visit') }}</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><strong>{{ __('appointments.booking_date') }}:</strong> {{ $appointment->created_at->translatedFormat('d/m/Y h:i A') }}</li>
                                    <li class="mb-2"><strong>{{ __('appointments.amount') }}:</strong> <span class="text-primary">{{ number_format($appointment->final_fee, 2) }} {{ __('appointments.currency') }}</span></li>
                                    @if($appointment->medicalCenter)
                                    <li class="mb-2"><strong>{{ __('appointments.medical_center') }}:</strong> {{ $appointment->medicalCenter->name }}</li>
                                    @endif
                                    <li class="mb-2"><strong>{{ __('appointments.status') }}:</strong> {{ __('appointments.statuses.' . $appointment->status) }}</li>
                                </ul>
                            </div>
                        </div>
                        
                        @if($appointment->symptoms || $appointment->reason)
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                @if($appointment->reason)
                                <div class="mb-3">
                                    <strong>{{ __('appointments.reason') }}:</strong>
                                    <p class="text-muted">{{ $appointment->reason }}</p>
                                </div>
                                @endif
                                
                                @if($appointment->symptoms)
                                <div class="mb-3">
                                    <strong>{{ __('appointments.symptoms') }}:</strong>
                                    <p class="text-muted">{{ $appointment->symptoms }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                @if($appointment->status != 'cancelled' && $appointment->status != 'completed')
                                    <a href="#" class="btn btn-primary me-2"><i class="fas fa-edit"></i> {{ __('appointments.edit_appointment') }}</a>
                                    <a href="#" class="btn btn-danger me-2"><i class="fas fa-times"></i> {{ __('appointments.cancel_appointment') }}</a>
                                @endif
                                <a href="{{ route('patient.dashboard') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> {{ __('appointments.back_to_dashboard') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
