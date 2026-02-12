@extends('frontend.layouts.master')

@section('content')

<style>
.success-content {
    padding: 40px 0;
}

.success-icon {
    font-size: 80px;
    margin-bottom: 20px;
}

.success-icon i {
    animation: bounce 0.6s ease-in-out;
}

@keyframes bounce {
    0%, 20%, 60%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    80% {
        transform: translateY(-5px);
    }
}

.booking-success-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.booking-doctor-img img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
}

.booking-list ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.booking-list li {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
}

.booking-list li:last-child {
    border-bottom: none;
}

.success-btn {
    display: flex;
    gap: 10px;
    justify-content: center;
    flex-wrap: wrap;
}

@media (max-width: 576px) {
    .success-btn {
        flex-direction: column;
    }
    
    .booking-success-info {
        flex-direction: column;
        text-align: center;
    }
}
</style>

<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center inner-banner">
            <div class="text-center col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}"><i class="isax isax-home-15"></i></a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('confirmation.title') }}</li>
                    </ol>
                    <h2 class="breadcrumb-title">{{ __('confirmation.title') }}</h2>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container">
        <!-- Booking Success -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="success-content text-center">
                    <div class="success-icon">
                        <i class="fas fa-circle-check text-success"></i>
                    </div>
                    <h4 class="mt-3">{{ __('confirmation.success_message') }}</h4>
                    <p class="text-muted">{{ __('confirmation.email_notice') }}</p>
                </div>
                
                <div class="card booking-card mt-4">
                    <div class="card-body booking-card-body booking-list-body">
                        <div class="booking-doctor-left booking-success-info">
                            <div class="booking-doctor-img">
                                @if($appointment->doctor)
                                    <a href="{{ $appointment->doctor->doctorProfile && $appointment->doctor->doctorProfile->slug ? route('doctors.show', $appointment->doctor->doctorProfile->slug) : '#' }}">
                                        <img src="{{ $appointment->doctor->photo_url }}" alt="{{ $appointment->doctor->name }}" class="img-fluid">
                                    </a>
                                @else
                                    <img src="{{ $appointment->medicalCenter->logo_url ?? asset('frontend/xx/assets/img/medical-center-placeholder.png') }}" alt="{{ $appointment->medicalCenter->name ?? '' }}" class="img-fluid">
                                @endif
                            </div>
                            <div class="booking-doctor-info">
                                @if($appointment->doctor)
                                    <h4>
                                        <a href="{{ $appointment->doctor->doctorProfile && $appointment->doctor->doctorProfile->slug ? route('doctors.show', $appointment->doctor->doctorProfile->slug) : '#' }}">
                                            د. {{ $appointment->doctor->name }}
                                        </a>
                                    </h4>
                                    <p>{{ $appointment->doctor->doctorProfile->specialization ?? __('confirmation.doctor_specialization_default') }}</p>
                                @else
                                    <h4>{{ $appointment->medicalCenter->name ?? '' }}</h4>
                                    <p>{{ __('medical_centers.medical_center') }}</p>
                                @endif
                                <div class="booking-doctor-location">
                                    <p>
                                        <i class="feather-map-pin"></i> 
                                        {{ $appointment->doctor->address ?? $appointment->medicalCenter->address ?? __('confirmation.address_not_specified') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="booking-list mt-4">
                            <div class="booking-date-list consultation-date-list">
                                <ul>
                                    <li>
                                        <strong>{{ __('confirmation.booking_number') }}:</strong> 
                                        <span class="text-primary">{{ $appointment->appointment_number }}</span>
                                    </li>
                                    <li>
                                        <strong>{{ __('confirmation.booking_date') }}:</strong> 
                                        <span>{{ $appointment->scheduled_for->translatedFormat('l, j F Y') }}</span>
                                    </li>
                                    <li>
                                        <strong>{{ __('confirmation.booking_time') }}: 
                                            <i class="warning"></i>
                                            {{ __('confirmation.unconfirmed_notice') }} 
                                        </strong> 
                                        <span>{{ $appointment->scheduled_for->format('h:i A') }}</span>
                                    </li>
                                    <li>
                                        <strong>{{ __('confirmation.consultation_type') }}:</strong> 
                                        <span>
                                            @if($appointment->type === 'video_call')
                                                <i class="feather-video text-primary"></i> {{ __('confirmation.video_consultation') }}
                                            @elseif($appointment->type === 'audio_call')
                                                <i class="feather-phone text-primary"></i> {{ __('confirmation.audio_consultation') }}
                                            @else
                                                <i class="feather-map-pin text-primary"></i> {{ __('confirmation.direct_visit') }}
                                            @endif
                                        </span>
                                    </li>
                                    <li>
                                        <strong>{{ __('confirmation.status') }}:</strong> 
                                        <span class="badge 
                                            @if($appointment->status === 'confirmed') bg-success
                                            @elseif($appointment->status === 'pending') bg-warning
                                            @elseif($appointment->status === 'completed') bg-info
                                            @else bg-danger @endif">
                                            {{ $appointment->getStatusDisplayAttribute() }}
                                        </span>
                                    </li>
                                    @if($appointment->final_fee > 0)
                                    <li>
                                        <strong>{{ __('confirmation.amount_paid') }}:</strong> 
                                        <span class="text-success">{{ number_format($appointment->final_fee, 2) }} {{ __('confirmation.currency') }}</span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="success-btn text-center mt-4">
                    <a href="{{ $appointment->getGoogleCalendarLink() }}" 
                       class="btn btn-primary prime-btn" 
                       target="_blank">
                        <i class="fab fa-google me-2"></i>{{ __('confirmation.add_to_google_calendar') }}
                    </a>
                    
                    <a href="{{ route('patient.appointment.details', $appointment->slug) }}" 
                       class="btn btn-light">
                        <i class="feather-eye me-2"></i>{{ __('confirmation.view_appointment_details') }}
                    </a>
                </div>

                <div class="alert alert-info mt-4">
                    <div class="d-flex align-items-center">
                        <i class="feather-info me-2"></i>
                        <div>
                            <strong>{{ __('confirmation.note') }}:</strong> 
                            {{ __('confirmation.confirmation_notice_details') }}
                        </div>
                    </div>
                </div>

                <div class="success-dashboard-link text-center mt-4">
                    <a href="{{ route('patient.dashboard') }}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-arrow-left-long me-2"></i> {{ __('confirmation.back_to_home') }}
                    </a>
                    <a href="{{ route('patient.appointments') }}" class="btn btn-outline-secondary ms-2">
                        <i class="feather-calendar me-2"></i> {{ __('confirmation.my_appointments') }}
                    </a>
                </div>
            </div>
        </div>
        <!-- /Booking Success -->
    </div>
</div>
<!-- /Page Content -->
@endsection

