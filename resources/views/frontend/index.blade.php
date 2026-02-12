@extends('frontend.layouts.master')
@section('title', __('seo.home.title'))
@section('meta_description', __('seo.home.description'))
@section('content')
<style>
    /* دعم RTL للغة العربية */
[dir="rtl"] .horizontal-slide {
    direction: rtl;
}

[dir="rtl"] .slide-list {
    flex-direction: row-reverse;
}

/* سويتشر اللغات */
.language-switcher {
    display: flex;
    gap: 10px;
    align-items: center;
}

.language-switcher a {
    text-decoration: none;
    color: #333;
    font-weight: 500;
}

.language-switcher a.active {
    color: #007bff;
    font-weight: bold;
}
</style>
    <section class="banner-section banner-sec-one">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="banner-content aos" data-aos="fade-up">
                        <div class="gap-2 rating-appointment d-inline-flex align-items-center">
                            <div class="avatar-list-stacked avatar-group-lg">
                                @foreach ($stats['recent_doctors'] as $doctor)
                                    <span class="avatar avatar-rounded">
                                        <img class="border border-white"
                                            src="{{ $doctor->photoUrl(asset('frontend/xx/assets/img/doctors/doctor-thumb-' . (22 + $loop->index) . '.jpg')) }}"
                                            alt="{{ $doctor->name }}" width="45" height="45" />
                                    </span>
                                @endforeach
                            </div>
                            <div class="me-2">
                                <h6>{{ number_format($stats['total_appointments_count']) }}+ {{ __('banner.appointments') }}</h6>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($stats['average_rating']))
                                                <i class="fa-solid fa-star text-orange me-1"></i>
                                            @elseif($i == ceil($stats['average_rating']) && fmod($stats['average_rating'], 1) != 0)
                                                <i class="fa-solid fa-star-half-alt text-orange me-1"></i>
                                            @else
                                                <i class="fa-regular fa-star text-orange me-1"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <p>{{ $stats['average_rating'] }} {{ __('banner.ratings') }}</p>
                                </div>
                            </div>
                        </div>
                    <h1 class="display-5">
                        @lang('banner.title') <span class="text-gradient">@lang('banner.cashback')</span>
                        @lang('banner.after_visit')

                        <span class="banner-icon">
                            <img src="{{ asset('frontend/xx/assets/img/icons/video.svg') }}" 
                                alt="@lang('banner.video_icon_alt')" />
                        </span>
                        
                        <span class="text-gradient">@lang('banner.paid_by')</span>
                        @lang('banner.tagline') </br> 
                        @lang('banner.reward')
                    </h1>
                        <div class="search-box-one aos" data-aos="fade-up">
                            <form action="{{ route('search.doctors') }}" method="GET">
                                @csrf
                                <div class="search-input search-line">
                                    <i class="isax isax-hospital5 bficon"></i>
                                    <div class="mb-0">
                                        <input type="text" class="form-control" name="search"
                                            placeholder="{{ __('banner.search_placeholder') }}" />
                                    </div>
                                </div>
                                <div class="search-input search-map-line">
                                    <i class="isax isax-location5"></i>
                                    <div class="mb-0">
                                        <input type="text" class="form-control" name="location" placeholder="{{ __('banner.location') }}" />
                                    </div>
                                </div>
                                <div class="search-input search-calendar-line">
                                    <i class="isax isax-calendar-tick5"></i>
                                    <div class="mb-0">
                                        <input type="text" class="form-control datetimepicker" name="date"
                                            placeholder="{{ __('banner.date') }}" />
                                    </div>
                                </div>
                                <div class="form-search-btn">
                                    <button class="btn btn-primary" type="submit" aria-label="{{ __('banner.search') }}">
                                        <i class="isax isax-search-normal5 me-2"></i>{{ __('banner.search') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="banner-img aos" data-aos="fade-up">
                        <img src="{{ asset('frontend/xx/assets/img/banner/banner-doctor.svg') }}" class="img-fluid"
                            alt="patient-image" width="512" height="512" />
                        <div class="banner-appointment">
                            <h6>{{ number_format($stats['total_appointments'] / 1000, 1) }}K</h6>
                            <p>
                                @lang('banner.appointments')

                                <span class="d-block">@lang('banner.completed')</span>
                            </p>
                        </div>
                        <div class="banner-patient">
                            <div class="avatar-list-stacked avatar-group-sm">
                                @foreach ($stats['recent_patients'] as $patient)
                                    <span class="avatar avatar-rounded">
                                        <img src="{{ $patient->photoUrl(asset('frontend/xx/assets/img/patients/patient' . (16 + $loop->index) . '.jpg')) }}"
                                            alt="{{ $patient->name }}" width="40" height="40" />
                                    </span>
                                @endforeach
                            </div>
                            <p>{{ number_format($stats['satisfied_patients'] / 1000, 1) }}K+</p>
                            <p>@lang('banner.satisfied_patients')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-bg">
            <img src="{{ asset('frontend/xx/assets/img/bg/banner-bg-02.png') }}" alt="img" class="banner-bg-01" />
            <img src="{{ asset('frontend/xx/assets/img/bg/banner-bg-03.png') }}" alt="img" class="banner-bg-02" />
            <img src="{{ asset('frontend/xx/assets/img/bg/banner-bg-04.png') }}" alt="img" class="banner-bg-03" />
            <img src="{{ asset('frontend/xx/assets/img/bg/banner-bg-05.png') }}" alt="img" class="banner-bg-04" />
            <img src="{{ asset('frontend/xx/assets/img/bg/banner-icon-01.svg') }}" alt="img" class="banner-bg-05" />
            <img src="{{ asset('frontend/xx/assets/img/bg/banner-icon-01.svg') }}" alt="img" class="banner-bg-06" />
        </div>
    </section>











    <!-- List -->
    <div class="list-section">
        <div class="container">
            <div class="mb-0 list-card card">
                <div class="card-body">
                    <div
                        class="flex-wrap gap-4 d-flex align-items-center justify-content-center justify-content-xl-between list-wraps">
                        <a href="{{route('doctors.search')}}" class="list-item aos" data-aos="fade-up">
                            <div class="list-icon bg-secondary">
                                <img src="{{ asset('frontend/xx/assets/img/icons/list-icon-01.svg') }}" alt="img" loading="lazy" width="48" height="48" />
                            </div>
                            <h6>{{__('banner.book_appointment')}}</h6>
                        </a>
                     
                        <a href="{{route('medical-centershome.index')}}" class="list-item aos" data-aos="fade-up">
                            <div class="list-icon bg-pink">
                                <img src="{{ asset('frontend/xx/assets/img/icons/list-icon-03.svg') }}" alt="img" loading="lazy" width="48" height="48" />
                            </div>
                            <h6>{{__('banner.hospitals_clinics')}}</h6>
                        </a>
                        <a href="{{route('map.index')}}" class="list-item aos" data-aos="fade-up">
                            <div class="list-icon bg-cyan">
                                <img src="{{ asset('frontend/xx/assets/img/icons/list-icon-04.svg') }}" alt="img" loading="lazy" width="48" height="48" />
                            </div>
                            <h6>{{__('banner.healthcare')}}</h6>
                        </a>
                        <a href="{{route('how-it-works')}}" class="list-item aos" data-aos="fade-up">
                            <div class="list-icon bg-purple">
                                <img src="{{ asset('frontend/xx/assets/img/icons/list-icon-05.svg') }}" alt="img" width="48" height="48" />
                            </div>
                            <h6>{{__('banner.how_it_works')}}</h6>
                            
                        </a> 

                        {{-- <a href="index-12.html" class="list-item aos" data-aos="fade-up">
                            <div class="list-icon bg-orange">
                                <img src="{{ asset('frontend/xx/assets/img/icons/list-icon-06.svg') }}" alt="img" />
                            </div>
                            <h6>Lab Testing</h6><br>
                            <span>(coming soon)</span>
                        </a> --}}
                        <a href="#" class="list-item aos" data-aos="fade-up">
                            <div class="list-icon bg-teal">
                                <img src="{{ asset('frontend/xx/assets/img/icons/list-icon-07.svg') }}" alt="img" width="48" height="48" />
                            </div>
                            <h6>{{__('banner.home_care')}}</h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /List -->







    <section class="speciality-section">
        <div class="container">
            <div class="text-center section-header sec-header-one aos" data-aos="fade-up">
                <span class="badge badge-primary">{{__('banner.top_specialties')}}</span>
                <h2>{{__('banner.highlighting_the_care_and_support')}}</h2>
            </div>
            <div class="owl-carousel spciality-slider aos" data-aos="fade-up">
                @foreach ($specialties as $specialty)
                    <div class="spaciality-item">
                        <div class="spaciality-img">
                            <img src="{{ $specialty->image_url }}" alt="{{ $specialty->name }}" loading="lazy" width="100" height="100" />
                            <span class="spaciality-icon">
                                <img src="{{ $specialty->icon_url }}" alt="{{ $specialty->name }}" loading="lazy" width="30" height="30" />
                            </span>
                        </div>
                        <h6>
                            <a href="{{ route('specialties.show', $specialty->slug) }}">
                                {{ $specialty->name }}
                            </a>
                        </h6>
                        <p class="mb-0">{{ $specialty->active_doctors_count }} {{ __('banner.doctors') }}</p>
                    </div>
                @endforeach
            </div>
            <div class="spciality-nav nav-bottom owl-nav"></div>

            @if ($specialties->count() === 0)
                <div class="mt-4 text-center">
                    <p class="text-muted">No featured specialties available at the moment.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- /Speciality Section -->
    <!-- /Speciality Section -->

    <!-- Doctor Section -->
    <!-- Doctor Section -->
    <section class="doctor-section">
        <div class="container">
            <div class="text-center section-header sec-header-one aos" data-aos="fade-up">
                <span class="badge badge-primary">{{__('banner.featured_doctors')}}</span>
                <h2>{{__('banner.our_highlighted_doctors')}}</h2>
            </div>

            <div class="doctors-slider owl-carousel aos" data-aos="fade-up">
                @forelse($featuredDoctors as $doctor)
                    <div class="card">
                        <div class="card-img card-img-hover">
                            <a href="{{ route('doctors.show', $doctor->doctorProfile->slug) }}">
                                <img src="{{ $doctor->photoUrl(asset('frontend/xx/assets/img/doctor-grid/doctor-grid-01.jpg')) }}"
                                    alt="Dr. {{ $doctor->name }}" loading="lazy" width="300" height="400" />
                            </a>
                            <div class="grid-overlay-item d-flex align-items-center justify-content-between">
                                <span class="badge bg-orange">
                                    <i class="fa-solid fa-star me-1"></i>{{ number_format($doctor->doctor_rating, 1) }}
                                </span>
                                <a href="javascript:void(0)" class="fav-icon" data-doctor-id="{{ $doctor->id }}">
                                    <i
                                        class="fa fa-heart {{ auth()->check() && auth()->user()->favoriteDoctors->contains($doctor->id) ? 'text-danger' : '' }}"></i>
                                </a>
                            </div>
                        </div>
                        <div class="p-0 card-body">
                            <div class="p-3 d-flex active-bar align-items-center justify-content-between">
                                <a href="#" class="text-indigo fw-medium fs-14">
                                    {{ $doctor->doctorProfile->specialization ?? __('banner.general_practitioner') }}
                                </a>
                                <span class="badge bg-success-light d-inline-flex align-items-center">
                                    <i class="fa-solid fa-circle fs-5 me-1"></i>
                                    {{ $doctor->doctorProfile->accepting_new_patients ? __('banner.available') : __('banner.not_available') }}
                                </span>
                            </div>
                            <div class="p-3 pt-0">
                                <div class="pb-3 mb-3 doctor-info-detail">
                                    <h3 class="mb-1">
                                        <a href="{{ route('doctors.show', $doctor->doctorProfile->slug) }}">
                                            {{ $doctor->name }}</a>
                                    </h3>
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 d-flex align-items-center fs-14">
                                            <i class="isax isax-location me-2"></i>
                                            {{ $doctor->address ?? __('banner.location_not_specified') }}
                                        </p>
                                        <i class="mx-2 fa-solid fa-circle fs-5 text-primary me-1"></i>
                                        <span class="fs-14 fw-medium">
                                            {{ $doctor->doctorProfile->appointment_duration ?? '30' }} {{ __('index.min') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="mb-1">{{ __('banner.consultation_fees') }}</p>
                                        <h3 class="text-orange">
                                            AED{{ number_format($doctor->doctorProfile->consultation_fee ?? 0, 0) }}</h3>
                                    </div>
                                    @if ($doctor->doctorProfile && $doctor->doctorProfile->canAcceptAppointments())
                                        <a href="{{ route('doctors.show', $doctor->doctorProfile->slug) }}"
                                            class="inline-flex btn btn-md btn-dark align-items-center rounded-pill">
                                            <i class="isax isax-calendar-1 me-2"></i>
                                            {{ __('banner.book_now') }}
                                        </a>
                                    @else
                                        <button
                                            class="inline-flex btn btn-md btn-secondary align-items-center rounded-pill"
                                            disabled>
                                            <i class="isax isax-calendar-1 me-2"></i>
                                            {{ __('banner.not_available') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center col-12">
                        <div class="alert alert-info">
                            <p>No featured doctors available at the moment.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="doctor-nav nav-bottom owl-nav"></div>
        </div>
    </section>
    <!-- /Doctor Section -->
    <!-- /Doctor Section -->

    <!-- Services Section -->
    <section class="services-section aos" data-aos="fade-up">
        <div class="horizontal-slide d-flex" data-direction="right" data-speed="slow">
            <div class="gap-4 slide-list d-flex">
                <div class="services-slide">
                    <h6>
                        <a href="javascript:void(0);">{{ __('services.treatments') }}</a>
                    </h6>
                </div>
                <div class="services-slide">
                    <h6>
                        <a href="javascript:void(0);">{{ __('services.lab_testing') }}</a>
                    </h6>
                </div>
                <div class="services-slide">
                    <h6>
                        <a href="javascript:void(0);">{{ __('services.medicines') }}</a>
                    </h6>
                </div>
                <div class="services-slide">
                    <h6>
                        <a href="javascript:void(0);">{{ __('services.hospitals') }}</a>
                    </h6>
                </div>
                <div class="services-slide">
                    <h6>
                        <a href="javascript:void(0);">{{ __('services.health_care') }}</a>
                    </h6>
                </div>
                <div class="services-slide">
                    <h6>
                        <a href="javascript:void(0);">{{ __('services.talk_doctors') }}</a>
                    </h6>
                </div>
                <div class="services-slide">
                    <h6>
                        <a href="javascript:void(0);">{{ __('services.home_care') }}</a>
                    </h6>
                </div>
            </div>
        </div>
    </section>
    <!-- /Services Section -->
 
  <!-- Reasons Section -->
<section class="reason-section">
    <div class="container">
        <div class="text-center section-header sec-header-one aos" data-aos="fade-up">
            <span class="badge badge-primary">{{ __('reasones.reasons_section.title') }}</span>
            <h2>{{ __('reasones.reasons_section.heading') }}</h2>
        </div>
        <div class="row-gap-4 row justify-content-center">
            
            <!-- Reason 1: Follow-Up Care -->
            <div class="col-lg-4 col-md-6">
                <div class="reason-item aos" data-aos="fade-up">
                    <h6 class="mb-2">
                        <i class="{{ __('reasones.reasons_section.reasons.follow_up_care.icon') }} {{ __('reasones.reasons_section.reasons.follow_up_care.color') }} me-2"></i>
                        {{ __('reasones.reasons_section.reasons.follow_up_care.title') }}
                    </h6>
                    <p class="mb-0 fs-14">
                        {{ __('reasones.reasons_section.reasons.follow_up_care.description') }}
                    </p>
                </div>
            </div>
            
            <!-- Reason 2: Patient-Centered Approach -->
            <div class="col-lg-4 col-md-6">
                <div class="reason-item aos" data-aos="fade-up">
                    <h6 class="mb-2">
                        <i class="{{ __('reasones.reasons_section.reasons.patient_centered.icon') }} {{ __('reasones.reasons_section.reasons.patient_centered.color') }} me-2"></i>
                        {{ __('reasones.reasons_section.reasons.patient_centered.title') }}
                    </h6>
                    <p class="mb-0 fs-14">
                        {{ __('reasones.reasons_section.reasons.patient_centered.description') }}
                    </p>
                </div>
            </div>
            
            <!-- Reason 3: Convenient Access -->
            <div class="col-lg-4 col-md-6">
                <div class="reason-item aos" data-aos="fade-up">
                    <h6 class="mb-2">
                        <i class="{{ __('reasones.reasons_section.reasons.convenient_access.icon') }} {{ __('reasones.reasons_section.reasons.convenient_access.color') }} me-2"></i>
                        {{ __('reasones.reasons_section.reasons.convenient_access.title') }}
                    </h6>
                    <p class="mb-0 fs-14">
                        {{ __('reasones.reasons_section.reasons.convenient_access.description') }}
                    </p>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- /Reasons Section -->

    <!-- Bookus Section -->
    <section class="bookus-section bg-dark">
        <div class="container">
            <div class="row-gap-4 row align-items-center">
                <div class="col-lg-6">
                    <div class="bookus-img">
                        <div class="row g-3">
                            <div class="col-md-12 aos" data-aos="fade-up">
                                <img src="{{ asset('frontend/xx/assets/img/book-01.jpg') }}" alt="img"
                                    class="img-fluid" width="600" height="400" />
                            </div>
                            <div class="col-sm-6 aos" data-aos="fade-up">
                                <img src="{{ asset('frontend/xx/assets/img/book-02.jpg') }}" alt="img"
                                    class="img-fluid" width="300" height="200" />
                            </div>
                            <div class="col-sm-6 aos" data-aos="fade-up">
                                <img src="{{ asset('frontend/xx/assets/img/book-03.jpg') }}" alt="img"
                                    class="img-fluid" width="300" height="200" />
                            </div>
                        </div>
                    </div>
                </div>

              <div class="col-lg-6">
    <div class="mb-2 section-header sec-header-one aos" data-aos="fade-up">
        <span class="badge badge-primary">{{ __('sehasave.why_choose_badge') }}</span>
        <h2 class="text-white">
            {!! __('sehasave.why_choose_title') !!}
        </h2>
    </div>
    <p class="mb-4 text-light">
        {!! __('sehasave.why_choose_intro') !!}
    </p>
    <div class="faq-info aos" data-aos="fade-up">
        <div class="accordion" id="why-choose-accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="whyHeadingOne">
                    <a href="javascript:void(0);" class="accordion-button" data-bs-toggle="collapse"
                        data-bs-target="#whyCollapseOne" aria-expanded="true" aria-controls="whyCollapseOne">
                        01 . {{ __('sehasave.faq_cashback_title') }}
                    </a>
                </h2>
                <div id="whyCollapseOne" class="accordion-collapse collapse show" aria-labelledby="whyHeadingOne" data-bs-parent="#why-choose-accordion">
                    <div class="accordion-body">
                        <div class="accordion-content">
                            <p>{!! __('sehasave.faq_cashback_body') !!}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="whyHeadingTwo">
                    <a href="javascript:void(0);" class="accordion-button collapsed"
                        data-bs-toggle="collapse" data-bs-target="#whyCollapseTwo" aria-expanded="false" aria-controls="whyCollapseTwo">
                        02 . {{ __('sehasave.faq_doctors_title') }}
                    </a>
                </h2>
                <div id="whyCollapseTwo" class="accordion-collapse collapse" aria-labelledby="whyHeadingTwo" data-bs-parent="#why-choose-accordion">
                    <div class="accordion-body">
                        <div class="accordion-content">
                            <p>{!! __('sehasave.faq_doctors_body') !!}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="whyHeadingThree">
                    <a href="javascript:void(0);" class="accordion-button collapsed"
                        data-bs-toggle="collapse" data-bs-target="#whyCollapseThree" aria-expanded="false" aria-controls="whyCollapseThree">
                        03 . {{ __('sehasave.faq_risk_title') }}
                    </a>
                </h2>
                <div id="whyCollapseThree" class="accordion-collapse collapse" aria-labelledby="whyHeadingThree" data-bs-parent="#why-choose-accordion">
                    <div class="accordion-body">
                        <div class="accordion-content">
                            <p>{!! __('sehasave.faq_risk_body') !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
<div class="bookus-sec">
    <div class="row g-4">
        <div class="col-lg-3">
            <div class="book-item">
                <div class="book-icon bg-primary">
                    <i class="isax isax-search-normal5"></i>
                </div>
                <div class="book-info">
                    <h6 class="mb-2 text-white">
                        {{ __('bookus.search_doctors.title') }}
                    </h6>
                    <p class="fs-14 text-light">
                        {{ __('bookus.search_doctors.description') }}
                    </p>
                </div>
                <div class="way-icon">
                    <img src="{{ asset('frontend/xx/assets/img/icons/way-icon.svg') }}" 
                         alt="{{ __('bookus.icons.alt') }}" width="24" height="24" />
                </div>
            </div>
        </div>
        
        <div class="col-lg-3">
            <div class="book-item">
                <div class="book-icon bg-orange">
                    <i class="isax isax-security-user5"></i>
                </div>
                <div class="book-info">
                    <h6 class="mb-2 text-white">
                        {{ __('bookus.check_profile.title') }}
                    </h6>
                    <p class="fs-14 text-light">
                        {{ __('bookus.check_profile.description') }}
                    </p>
                </div>
                <div class="way-icon">
                    <img src="{{ asset('frontend/xx/assets/img/icons/way-icon.svg') }}" 
                         alt="{{ __('bookus.icons.alt') }}" />
                </div>
            </div>
        </div>
        
        <div class="col-lg-3">
            <div class="book-item">
                <div class="book-icon bg-cyan">
                    <i class="isax isax-calendar5"></i>
                </div>
                <div class="book-info">
                    <h6 class="mb-2 text-white">
                        {{ __('bookus.schedule_appointment.title') }}
                    </h6>
                    <p class="fs-14 text-light">
                        {{ __('bookus.schedule_appointment.description') }}
                    </p>
                </div>
                <div class="way-icon">
                    <img src="{{ asset('frontend/xx/assets/img/icons/way-icon.svg') }}" 
                         alt="{{ __('bookus.icons.alt') }}" />
                </div>
            </div>
        </div>
        
        <div class="col-lg-3">
            <div class="book-item">
                <div class="book-icon bg-indigo">
                    <i class="isax isax-blend5"></i>
                </div>
                <div class="book-info">
                    <h6 class="mb-2 text-white">
                        {{ __('bookus.get_solution.title') }}
                    </h6>
                    <p class="fs-14 text-light">
                        {{ __('bookus.get_solution.description') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </section>
    <!-- /Bookus Section -->

    <!-- Testimonial Section -->
    <section class="testimonial-section-one">
        <div class="container">
            <div class="text-center section-header sec-header-one aos" data-aos="fade-up">
                <span class="badge badge-primary">{{ __('index.testimonials_title') }}</span>
                <h2>{{ __('index.trust_message') }}</h2>
            </div>

            <!-- Testimonial Slider -->
            <div class="owl-carousel testimonials-slider aos" data-aos="fade-up">
                <div class="mb-0 shadow-none card">
                    <div class="card-body">
                        <div class="mb-4 d-flex align-items-center">
                            <div class="rating d-flex">
                                <i class="fa-solid fa-star filled me-1"></i>
                                <i class="fa-solid fa-star filled me-1"></i>
                                <i class="fa-solid fa-star filled me-1"></i>
                                <i class="fa-solid fa-star filled me-1"></i>
                                <i class="fa-solid fa-star filled"></i>
                            </div>
                            <span>
                                <img src="{{ asset('frontend/xx/assets/img/icons/quote-icon.svg') }}" alt="img" width="30" height="30" />
                            </span>
                        </div>
                        <h6 class="mb-2 fs-16 fw-medium">
                            Nice Treatment
                        </h6>
                        <p>
                            I had a wonderful experience the staff was
                            friendly and attentive, and Dr. Smith took
                            the time to explain everything clearly.
                        </p>
                        <div class="d-flex align-items-center">
                            <a href="javascript:void(0);" class="avatar avatar-lg">
                                <img src="{{ asset('frontend/xx/assets/img/patients/patient22.jpg') }}"
                                    class="rounded-circle" alt="img" width="60" height="60" />
                            </a>
                            <div class="ms-2">
                                <h6 class="mb-1">
                                    <a href="javascript:void(0);">Deny Hendrawan</a>
                                </h6>
                                <p class="mb-0 fs-14">United States</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-0 shadow-none card">
                    <div class="card-body">
                        <div class="mb-4 d-flex align-items-center">
                            <div class="rating d-flex">
                                <i class="fa-solid fa-star filled me-1"></i>
                                <i class="fa-solid fa-star filled me-1"></i>
                                <i class="fa-solid fa-star filled me-1"></i>
                                <i class="fa-solid fa-star filled me-1"></i>
                                <i class="fa-solid fa-star filled"></i>
                            </div>
                            <span>
                                <img src="{{ asset('frontend/xx/assets/img/icons/quote-icon.svg') }}" alt="img" />
                            </span>
                        </div>
                        <h6 class="mb-2 fs-16 fw-medium">
                            Good Hospitability
                        </h6>
                        <p>
                            Genuinely cares about his patients. He
                            helped me understand my condition and worked
                            with me to create a plan.
                        </p>
                        <div class="d-flex align-items-center">
                            <a href="javascript:void(0);" class="avatar avatar-lg">
                                <img src="{{ asset('frontend/xx/assets/img/patients/patient21.jpg') }}"
                                    class="rounded-circle" alt="img" width="60" height="60" />
                            </a>
                            <div class="ms-2">
                                <h6 class="mb-1">
                                    <a href="javascript:void(0);">Johnson DWayne</a>
                                </h6>
                                <p class="mb-0 fs-14">United States</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-0 shadow-none card">
                    <div class="card-body">
                        <div class="mb-4 d-flex align-items-center">
                            <div class="rating d-flex">
                                <i class="fa-solid fa-star filled me-1"></i>
                                <i class="fa-solid fa-star filled me-1"></i>
                                <i class="fa-solid fa-star filled me-1"></i>
                                <i class="fa-solid fa-star filled me-1"></i>
                                <i class="fa-solid fa-star filled"></i>
                            </div>
                            <span>
                                <img src="{{ asset('frontend/xx/assets/img/icons/quote-icon.svg') }}" alt="img" />
                            </span>
                        </div>
                        <h6 class="mb-2 fs-16 fw-medium">
                            Nice Treatment
                        </h6>
                        <p>
                            I had a great experience with Dr. Chen. She
                            was not only professional but also made me
                            feel comfortable discussing.
                        </p>
                        <div class="d-flex align-items-center">
                            <a href="javascript:void(0);" class="avatar avatar-lg">
                                <img src="{{ asset('frontend/xx/assets/img/patients/patient.jpg') }}"
                                    class="rounded-circle" alt="img" />
                            </a>
                            <div class="ms-2">
                                <h6 class="mb-1">
                                    <a href="javascript:void(0);">Rayan Smith</a>
                                </h6>
                                <p class="mb-0 fs-14">United States</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-0 shadow-none card">
                    <div class="card-body">
                        <div class="mb-4 d-flex align-items-center">
                            <div class="rating d-flex">
                                <i class="fa-solid fa-star filled me-1"></i>
                                <i class="fa-solid fa-star filled me-1"></i>
                                <i class="fa-solid fa-star filled me-1"></i>
                                <i class="fa-solid fa-star filled me-1"></i>
                                <i class="fa-solid fa-star filled"></i>
                            </div>
                            <span>
                                <img src="{{ asset('frontend/xx/assets/img/icons/quote-icon.svg') }}" alt="img" />
                            </span>
                        </div>
                        <h6 class="mb-2 fs-16 fw-medium">
                            Excellent Service
                        </h6>
                        <p>
                            I had a wonderful experience the staff was
                            friendly and attentive, and Dr. Smith took
                            the time to explain everything clearly.
                        </p>
                        <div class="d-flex align-items-center">
                            <a href="javascript:void(0);" class="avatar avatar-lg">
                                <img src="{{ asset('frontend/xx/assets/img/patients/patient23.jpg') }}"
                                    class="rounded-circle" alt="img" />
                            </a>
                            <div class="ms-2">
                                <h6 class="mb-1">
                                    <a href="javascript:void(0);">Sofia Doe</a>
                                </h6>
                                <p class="mb-0 fs-14">United States</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Testimonial Slider -->

            <!-- Counter -->
            <div class="testimonial-counter">
                <div class="row-gap-4 row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5">
                    <div class="text-center counter-item aos" data-aos="fade-up">
                        <h6 class="display-6">
                            <span class="count-digit">500</span>+
                        </h6>
                        <p>{{ __('index.doctors_available') }}</p>
                    </div>
                    <div class="text-center counter-item aos" data-aos="fade-up">
                        <h6 class="display-6 secondary-count">
                            <span class="count-digit">18</span>+
                        </h6>
                        <p>{{ __('index.specialities') }}</p>
                    </div>
                    <div class="text-center counter-item aos" data-aos="fade-up">
                        <h6 class="display-6 purple-count">
                            <span class="count-digit">30</span>K
                        </h6>
                        <p>{{ __('index.bookings_done') }}</p>
                    </div>
                    <div class="text-center counter-item aos" data-aos="fade-up">
                        <h6 class="display-6 pink-count">
                            <span class="count-digit">97</span>+
                        </h6>
                        <p>{{ __('index.hospitals_clinics_count') }}</p>
                    </div>
                    <div class="text-center counter-item aos" data-aos="fade-up">
                        <h6 class="display-6 warning-count">
                            <span class="count-digit">317</span>+
                        </h6>
                        <p>Lab Tests Available</p>
                    </div>
                </div>
            </div>
            <!-- /Counter -->
        </div>
    </section>
    <!-- /Testimonial Section -->

    {{-- <section class="company-section bg-dark aos" data-aos="fade-up">
        <div class="container">
            <div class="text-center section-header sec-header-one">
                <h6 class="text-light">
                    Trusted by 5+ million people at companies like
                </h6>
            </div>
            <div class="owl-carousel company-slider">
                <div>
                    <img src="{{ asset('frontend/xx/assets//img/company/company-01.svg') }}" alt="company 1" loading="lazy" width="150" height="50" />
                </div>
                <div>
                    <img src="{{ asset('frontend/xx/assets//img/company/company-02.svg') }}" alt="company 2" loading="lazy" width="150" height="50" />
                </div>
                <div>
                    <img src="{{ asset('frontend/xx/assets//img/company/company-03.svg') }}" alt="company 3" loading="lazy" width="150" height="50" />
                </div>
                <div>
                    <img src="{{ asset('frontend/xx/assets//img/company/company-04.svg') }}" alt="company 4" loading="lazy" width="150" height="50" />
                </div>
                <div>
                    <img src="{{ asset('frontend/xx/assets//img/company/company-05.svg') }}" alt="company 5" loading="lazy" width="150" height="50" />
                </div>
                <div>
                    <img src="{{ asset('frontend/xx/assets//img/company/company-06.svg') }}" alt="company 6" loading="lazy" width="150" height="50" />
                </div>
                <div>
                    <img src="{{ asset('frontend/xx/assets//img/company/company-07.svg') }}" alt="company 7" loading="lazy" width="150" height="50" />
                </div>
                <div>
                    <img src="{{ asset('frontend/xx/assets//img/company/company-08.svg') }}" alt="company 8" loading="lazy" width="150" height="50" />
                </div>
            </div>
        </div>
    </section> --}}

<section class="faq-section-one">
    <div class="container">
        <div class="text-center section-header sec-header-one aos" data-aos="fade-up">
            <span class="badge badge-primary">{{ __('faq.title') }}</span>
            <h2>{{ __('faq.subtitle') }}</h2>
        </div>
        
        @if($faqs->count() > 0)
        <div class="row">
            <div class="mx-auto col-md-10">
                <div class="faq-info aos" data-aos="fade-up">
                    <div class="accordion" id="faq-details">
                        @foreach($faqs as $index => $faq)
                        <!-- FAQ Item -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
                                <a href="javascript:void(0);" class="accordion-button 
                                    {{ $loop->first ? '' : 'collapsed' }}" 
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $loop->iteration }}" 
                                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}" 
                                    aria-controls="collapse{{ $loop->iteration }}">
                                    
                                    {{ $faq->question }}
                                </a>
                            </h2>
                            <div id="collapse{{ $loop->iteration }}" 
                                 class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" 
                                 aria-labelledby="heading{{ $loop->iteration }}" 
                                 data-bs-parent="#faq-details">
                                <div class="accordion-body">
                                    <div class="accordion-content">
                                        {!! $faq->answer !!}
                                        
                                        {{-- معلومات إضافية --}}
                                        @if($faq->category)
                                        <div class="mt-3">
                                            <span class="badge bg-info">
                                                {{ $faq->category->translateOrDefault(app()->getLocale())->name ?? $faq->category->name }}
                                            </span>
                                        </div>
                                        @endif
                                        
                                        {{-- روابط للتفاصيل --}}
                                        <div class="mt-3">
                                            <a href="{{ route('frontend.faq.show', $faq->slug) }}" class="btn btn-sm btn-outline-primary">
                                                {{ __('faq.read_more') }}
                                            </a>
                                            
                                            @if($faq->helpful_yes > 0 || $faq->helpful_no > 0)
                                            <span class="ms-2 text-muted">
                                                <i class="fas fa-thumbs-up"></i> {{ $faq->helpful_yes }}
                                                <i class="fas fa-thumbs-down ms-2"></i> {{ $faq->helpful_no }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /FAQ Item -->
                        @endforeach
                    </div>
                    
                    {{-- رابط لعرض جميع الأسئلة --}}
                    <div class="text-center mt-4">
                        <a href="{{ route('frontend.faq.index') }}" class="btn btn-primary">
                            {{ __('faq.view_all') }}
                            <i class="fas fa-arrow-left ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle"></i>
                    {{ __('faq.no_faqs') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
    <!-- App Section -->
    <section class="p-0 app-section app-sec-one">
        <div class="container">
            <div class="app-bg">
                <div class="row">
                    <div class="col-lg-6 col-md-12 d-flex">
                        <div class="app-content d-flex flex-column justify-content-center">
                            <div class="app-header aos" data-aos="fade-up">
                                <h3 class="text-white display-6">
                                    Download the SehaSave.com App today!
                                </h3>
                                <p class="text-light">
                                    To download an app related to a
                                    doctor or medical services, you can
                                    typically visit the app store on
                                    your device.
                                </p>
                            </div>
                            <div class="google-imgs aos" data-aos="fade-up">
                                <a href="javascript:void(0);" aria-label="Download on App Store"><img
                                        src="{{ asset('frontend/xx/assets//img/icons/app-store-01.svg') }}"
                                        alt="App Store" loading="lazy" width="135" height="40" /></a>
                                <a href="javascript:void(0);" aria-label="Get it on Google Play"><img
                                        src="{{ asset('frontend/xx/assets//img/icons/google-play-01.svg') }}"
                                        alt="Google Play" loading="lazy" width="135" height="40" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 aos" data-aos="fade-up">
                        <div class="mobile-img">
                            <img src="{{ asset('frontend/xx/assets//img/mobile-img.png') }}" class="img-fluid"
                                alt="img" />
                        </div>
                    </div>
                </div>
                <div class="app-bgs">
                    <img src="{{ asset('frontend/xx/assets//img/bg/app-bg-02.png') }}" alt="img"
                        class="app-bg-01" />
                    <img src="{{ asset('frontend/xx/assets//img/bg/app-bg-03.png') }}" alt="img"
                        class="app-bg-02" />
                    <img src="{{ asset('frontend/xx/assets//img/bg/app-bg-04.png') }}" alt="img"
                        class="app-bg-03" />
                </div>
            </div>
        </div>
        <div class="download-bg">
            <img src="{{ asset('frontend/xx/assets//img/bg/download-bg.png') }}" alt="img" />
        </div>
    </section>
    <!-- /App Section -->

    <!-- Article Section -->
    <section class="article-section">
        <div class="container">
            <div class="text-center section-header sec-header-one aos" data-aos="fade-up">
                <span class="badge badge-primary">Recent Blogs</span>
                <h2>Stay Updated With Our Latest Articles</h2>
            </div>
            <div class="row g-4">
                @if(isset($recentBlogs) && $recentBlogs->count() > 0)
                    @foreach($recentBlogs as $blog)
                    <div class="col-lg-6">
                        <div class="article-item aos" data-aos="fade-up">
                            <div class="article-img">
                                <a href="{{ route('blog.show', $blog->slug) }}">
                                    @if($blog->featured_image)
                                        <img src="{{ asset('storage/' . $blog->featured_image) }}" class="img-fluid" alt="{{ $blog->title }}" loading="lazy" width="600" height="400" />
                                    @else
                                        <img src="{{ asset('frontend/xx/assets//img/blog/article-01.jpg') }}" class="img-fluid" alt="default blog image" loading="lazy" width="600" height="400" />
                                    @endif
                                </a>
                                <div class="date-icon">
                                    <span>{{ $blog->published_at ? $blog->published_at->format('d') : $blog->created_at->format('d') }}</span>
                                    {{ $blog->published_at ? $blog->published_at->format('M') : $blog->created_at->format('M') }}
                                </div>
                            </div>
                            <div class="article-info">
                                @if($blog->category)
                                    <span class="mb-2 badge badge-cyan">{{ $blog->category->name }}</span>
                                @endif
                                <h6 class="mb-2">
                                    <a href="{{ route('blog.show', $blog->slug) }}">{{ Str::limit($blog->title, 50) }}</a>
                                </h6>
                                <p>
                                    {{ Str::limit(strip_tags($blog->content), 100) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p>No recent articles found.</p>
                    </div>
                @endif
            </div>
            <div class="text-center load-item aos" data-aos="fade-up">
                <a href="{{ route('blog.index') }}" class="btn btn-dark">View All Articles<i
                        class="isax isax-arrow-right-3 ms-2"></i></a>
            </div>
        </div>
    </section>
    <!-- /Article Section -->

    <!-- Info Section -->
    <section class="info-section">
        <div class="container">
            <div class="contact-info">
                <div class="gap-4 d-lg-flex align-items-center justify-content-between w-100">
                    <div class="mb-4 mb-lg-0 aos" data-aos="fade-up">
                        <h6 class="text-white display-6">
                            Working for Your Better Health.
                        </h6>
                    </div>
                    <div class="gap-4 d-sm-flex align-items-center justify-content-lg-end aos" data-aos="fade-up">
                        <div class="mb-3 con-info d-flex align-items-center mb-sm-0">
                            <span class="con-icon">
                                <i class="isax isax-headphone"></i>
                            </span>
                            <div class="ms-2">
                                <p class="mb-1 text-white">
                                    Customer Support
                                </p>
                                <p class="mb-0 text-white fw-medium">
                                    +97545060739
                                </p>
                            </div>
                        </div>
                        <div class="con-info d-flex align-items-center">
                            <span class="con-icon">
                                <i class="isax isax-message-2"></i>
                            </span>
                            <div class="ms-2">
                                <p class="mb-1 text-white">
                                    Drop Us an Email
                                </p>
                                <p class="mb-0 text-white fw-medium">
                                    <a href="">[email&#160;protected]</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Info Section -->

    <!-- ScrollToTop -->
    <div class="progress-wrap active-progress">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewbox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="
                            transition: stroke-dashoffset 10ms linear 0s;
                            stroke-dasharray: 307.919px, 307.919px;
                            stroke-dashoffset: 228.265px;
                        ">
            </path>
        </svg>
    </div>


















    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.querySelector('.carousel');
            const cards = document.querySelectorAll('.doctor-card');
            const prevBtn = document.querySelector('.prev-btn');
            const nextBtn = document.querySelector('.next-btn');
            const dotsContainer = document.querySelector('.carousel-dots');

            let currentIndex = 0;
            const cardWidth = cards[0].offsetWidth + 20; // width + margin
            const visibleCards = Math.min(4, Math.floor(document.querySelector('.carousel-container').offsetWidth /
                cardWidth));

            // Create dots based on number of slides
            const totalSlides = Math.ceil(cards.length / visibleCards);
            for (let i = 0; i < totalSlides; i++) {
                const dot = document.createElement('div');
                dot.classList.add('dot');
                if (i === 0) dot.classList.add('active');
                dot.addEventListener('click', () => {
                    goToSlide(i);
                });
                dotsContainer.appendChild(dot);
            }
            const dots = document.querySelectorAll('.dot');

            // Update carousel position
            function updateCarousel() {
                carousel.style.transform = `translateX(-${currentIndex * cardWidth * visibleCards}px)`;

                // Update active dot
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentIndex);
                });

                // Disable/enable buttons at boundaries
                prevBtn.disabled = currentIndex === 0;
                nextBtn.disabled = currentIndex >= totalSlides - 1;
            }

            function goToSlide(index) {
                currentIndex = index;
                updateCarousel();
            }

            // Button event listeners
            prevBtn.addEventListener('click', () => {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateCarousel();
                }
            });

            nextBtn.addEventListener('click', () => {
                if (currentIndex < totalSlides - 1) {
                    currentIndex++;
                    updateCarousel();
                }
            });

            // Handle window resize
            window.addEventListener('resize', () => {
                const newVisibleCards = Math.min(4, Math.floor(document.querySelector('.carousel-container')
                    .offsetWidth / cardWidth));
                if (newVisibleCards !== visibleCards) {
                    // Recalculate currentIndex based on new visible cards
                    currentIndex = Math.floor(currentIndex * visibleCards / newVisibleCards);
                    updateCarousel();
                }
            });

            // Initialize
            updateCarousel();
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // التعامل مع إضافة/إزالة المفضلة
            document.querySelectorAll('.fav-icon').forEach(icon => {
                icon.addEventListener('click', function(e) {
                    e.preventDefault();

                    if (!{{ auth()->check() ? 'true' : 'false' }}) {
                        showToast('Please login to manage favorites', 'error');
                        return;
                    }

                    const doctorId = this.dataset.doctorId;
                    const heartIcon = this.querySelector('i');

                    // الحصول على CSRF token بطريقة آمنة
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')
                        ?.getAttribute('content') ||
                        document.querySelector('input[name="_token"]')?.value;

                    if (!csrfToken) {
                        console.error('CSRF token not found');
                        showToast('Security error. Please refresh the page.', 'error');
                        return;
                    }

                    fetch(`/doctor/${doctorId}/favorite`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({})
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.status === 'added') {
                                heartIcon.classList.add('text-danger');
                                showToast('Doctor added to favorites!', 'success');
                            } else if (data.status === 'removed') {
                                heartIcon.classList.remove('text-danger');
                                showToast('Doctor removed from favorites!', 'info');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            if (error.message.includes('Network')) {
                                showToast('Network error. Please try again.', 'error');
                            } else {
                                showToast('Please login to manage favorites', 'error');
                            }
                        });
                });
            });

            function showToast(message, type = 'info') {
                // إزالة أي toast موجود مسبقاً
                const existingToasts = document.querySelectorAll('.custom-toast');
                existingToasts.forEach(toast => toast.remove());

                const toast = document.createElement('div');
                toast.className = `custom-toast alert alert-${type} alert-dismissible fade show position-fixed`;
                toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
                toast.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
                document.body.appendChild(toast);

                // إزالة التلقائية بعد 3 ثواني
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 3000);
            }
        });
    </script>
@endsection
