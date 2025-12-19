@extends('frontend.layouts.master')

@section('content')
    @

    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="text-center col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="isax isax-home-15"></i></a></li>
                            <li class="breadcrumb-item active">About Us</li>
                        </ol>

                        <h2 class="breadcrumb-title">About Us</h2>

                    </nav>
                </div>
            </div>
        </div>
        <div class="breadcrumb-bg">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-01.png" alt="img') }}" class="breadcrumb-bg-01">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-02.png" alt="img') }}" class="breadcrumb-bg-02">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png" alt="img') }}" class="breadcrumb-bg-03">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png" alt="img') }}" class="breadcrumb-bg-04">
        </div>
    </div>
    <!-- /Breadcrumb --> <!-- About Us -->
    <section class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="about-img-info">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="about-inner-img">
                                    <div class="about-img">
                                        <img src="{{ asset('frontend/xx/assets/img/about-img1.jpg') }}" class="img-fluid"
                                            alt="about-image">
                                    </div>
                                    <div class="about-img">
                                        <img src="{{ asset('frontend/xx/assets/img/about-img2.jpg') }}" class="img-fluid"
                                            alt="about-image">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="about-inner-img">
                                    <div class="about-box">
                                        <h4>Over 25+ Years Experience</h4>
                                    </div>
                                    <div class="about-img">
                                        <img src="{{ asset('frontend/xx/assets/img/about-img3.jpg') }}" class="img-fluid"
                                            alt="about-image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="section-inner-header about-inner-header">
                        <h6>About Our Company</h6>
                        <h2>We Are Always Ensure Best Medical Treatment For Your Health</h2>
                    </div>
                    <div class="about-content">
                        <div class="about-content-details">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                pariatur.</p>
                            <p>Sed ut perspiciatis unde omnis iste natus sit voluptatem accusantium doloremque eaque
                                ipsa quae architecto beatae vitae dicta sunt explicabo.</p>
                        </div>
                        <div class="about-contact">
                            <div class="about-contact-icon">
                                <span><img src="{{ asset('frontend/xx/"assets/img/icons/phone-icon.svg') }}"
                                        alt="phone-image"></span>
                            </div>
                            <div class="about-contact-text">
                                <p>Need Emergency?</p>
                                <h4>+1 315 369 5943</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /About Us -->

    <!-- Why Choose Us -->
    <section class="why-choose-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center section-inner-header">
                        <h2>Why Choose Us</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card why-choose-card w-100">
                        <div class="card-body">
                            <div class="why-choose-icon">
                                <span><img src="{{ asset('frontend/xx/assets/img/icons/choose-01.svg') }}"
                                        alt="choose-image"></span>
                            </div>
                            <div class="why-choose-content">
                                <h4>Qualified Staff of Doctors</h4>
                                <p>Lorem ipsum sit amet consectetur incididunt ut labore et exercitation ullamco
                                    laboris nisi dolore magna enim veniam aliqua. </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card why-choose-card w-100">
                        <div class="card-body">
                            <div class="why-choose-icon">
                                <span><img src="{{ asset('frontend/xx/assets/img/icons/choose-02.svg') }}"
                                        alt="choose-image"></span>
                            </div>
                            <div class="why-choose-content">
                                <h4>Qualified Staff of Doctors</h4>
                                <p>Lorem ipsum sit amet consectetur incididunt ut labore et exercitation ullamco
                                    laboris nisi dolore magna enim veniam aliqua. </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card why-choose-card w-100">
                        <div class="card-body">
                            <div class="why-choose-icon">
                                <span><img src="{{ asset('frontend/xx/assets/img/icons/choose-03.svg') }}"
                                        alt="choose-image"></span>
                            </div>
                            <div class="why-choose-content">
                                <h4>Qualified Staff of Doctors</h4>
                                <p>Lorem ipsum sit amet consectetur incididunt ut labore et exercitation ullamco
                                    laboris nisi dolore magna enim veniam aliqua. </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card why-choose-card w-100">
                        <div class="card-body">
                            <div class="why-choose-icon">
                                <span><img src="{{ asset('frontend/xx/assets/img/icons/choose-04.svg') }}"
                                        alt="choose-image"></span>
                            </div>
                            <div class="why-choose-content">
                                <h4>Qualified Staff of Doctors</h4>
                                <p>Lorem ipsum sit amet consectetur incididunt ut labore et exercitation ullamco
                                    laboris nisi dolore magna enim veniam aliqua. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Why Choose Us -->

    <!-- Way Section -->
    <section class="way-section">
        <div class="container">
            <div class="way-bg">
                <div class="way-shapes-img">
                    <div class="way-shapes-left">
                        <img src="{{ asset('frontend/xx/assets/img/shape-06.png') }}" alt="shape-image">
                    </div>
                    <div class="way-shapes-right">
                        <img src="{{ asset('frontend/xx/assets/img/shape-07.png') }}" alt="shape-image">
                    </div>
                </div>
                <div class="row align-items-end">
                    <div class="col-lg-7 col-md-12">
                        <div class="mb-0 section-inner-header way-inner-header">
                            <h2>Be on Your Way to Feeling Better with the SehaSave.com</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.</p>
                            <a href="contact-us.html" class="btn btn-primary">Contact With Us</a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <div class="way-img">
                            <img src="{{ asset('frontend/xx/assets/img/way-img.png') }}" class="img-fluid"
                                alt="doctor-way-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Way Choose Us -->

    <!-- Doctors Section -->
    <section class="doctors-section professional-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center section-inner-header">
                        <h2>Best Doctors</h2>
                    </div>
                </div>
            </div>

{{-- 
            <div class="row">

                <!-- Doctor Item -->
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="doctor-profile-widget w-100">
                        <div class="doc-pro-img">
                            <a href="doctor-profile.html">
                                <div class="doctor-profile-img">
                                    <img src="{{ asset('frontend/xx/assets/img/doctors/doctor-03.jpg') }}"
                                        class="img-fluid" alt="Ruby Perrin">
                                </div>
                            </a>
                            <div class="doctor-amount">
                                <span>$ 200</span>
                            </div>
                        </div>
                        <div class="doc-content">
                            <div class="doc-pro-info">
                                <div class="doc-pro-name">
                                    <a href="doctor-profile.html">Dr. Ruby Perrin</a>
                                    <p>Cardiology</p>
                                </div>
                                <div class="reviews-ratings">
                                    <p>
                                        <span><i class="fas fa-star"></i> 4.5</span> (35)
                                    </p>
                                </div>
                            </div>
                            <div class="doc-pro-location">
                                <p><i class="feather-map-pin"></i> Newyork, USA</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Doctor Item -->

                <!-- Doctor Item -->
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="doctor-profile-widget w-100">
                        <div class="doc-pro-img">
                            <a href="doctor-profile.html">
                                <div class="doctor-profile-img">
                                    <img src="{{ asset('frontend/xx/assets/img/doctors/doctor-04.jpg') }}"
                                        class="img-fluid" alt="Darren Elder">
                                </div>
                            </a>
                            <div class="doctor-amount">
                                <span>$ 360</span>
                            </div>
                        </div>
                        <div class="doc-content">
                            <div class="doc-pro-info">
                                <div class="doc-pro-name">
                                    <a href="doctor-profile.html">Dr. Darren Elder</a>
                                    <p>Neurology</p>
                                </div>
                                <div class="reviews-ratings">
                                    <p>
                                        <span><i class="fas fa-star"></i> 4.0</span> (20)
                                    </p>
                                </div>
                            </div>
                            <div class="doc-pro-location">
                                <p><i class="feather-map-pin"></i> Florida, USA</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Doctor Item -->

                <!-- Doctor Item -->
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="doctor-profile-widget w-100">
                        <div class="doc-pro-img">
                            <a href="doctor-profile.html">
                                <div class="doctor-profile-img">
                                    <img src="{{ asset('frontend/xx/assets/img/doctors/doctor-05.jpg') }}"
                                        class="img-fluid" alt="Sofia Brient">
                                </div>
                            </a>
                            <div class="doctor-amount">
                                <span>$ 450</span>
                            </div>
                        </div>
                        <div class="doc-content">
                            <div class="doc-pro-info">
                                <div class="doc-pro-name">
                                    <a href="doctor-profile.html">Dr. Sofia Brient</a>
                                    <p>Urology</p>
                                </div>
                                <div class="reviews-ratings">
                                    <p>
                                        <span><i class="fas fa-star"></i> 4.5</span> (30)
                                    </p>
                                </div>
                            </div>
                            <div class="doc-pro-location">
                                <p><i class="feather-map-pin"></i> Georgia, USA</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Doctor Item -->

                <!-- Doctor Item -->
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="doctor-profile-widget w-100">
                        <div class="doc-pro-img">
                            <a href="doctor-profile.html">
                                <div class="doctor-profile-img">
                                    <img src="{{ asset('frontend/xx/assets/img/doctors/doctor-02.jpg') }}"
                                        class="img-fluid" alt="Paul Richard">
                                </div>
                            </a>
                            <div class="doctor-amount">
                                <span>$ 570</span>
                            </div>
                        </div>
                        <div class="doc-content">
                            <div class="doc-pro-info">
                                <div class="doc-pro-name">
                                    <a href="doctor-profile.html">Dr. Paul Richard</a>
                                    <p>Orthopedic</p>
                                </div>
                                <div class="reviews-ratings">
                                    <p>
                                        <span><i class="fas fa-star"></i> 4.3</span> (45)
                                    </p>
                                </div>
                            </div>
                            <div class="doc-pro-location">
                                <p><i class="feather-map-pin"></i> Michigan, USA</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Doctor Item -->

            </div> --}}


            
            <div class="doctors-slider owl-carousel aos" data-aos="fade-up">
                @forelse($featuredDoctors as $doctor)
                    <div class="card">
                        <div class="card-img card-img-hover">
                            <a href="{{ route('doctorshome.show', $doctor->id) }}">
                                <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('frontend/xx/assets/img/doctor-grid/doctor-grid-01.jpg') }}"
                                    alt="Dr. {{ $doctor->name }}" />
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
                                    {{ $doctor->doctorProfile->specialization ?? 'General Practitioner' }}
                                </a>
                                <span class="badge bg-success-light d-inline-flex align-items-center">
                                    <i class="fa-solid fa-circle fs-5 me-1"></i>
                                    {{ $doctor->doctorProfile->accepting_new_patients ? 'Available' : 'Not Available' }}
                                </span>
                            </div>
                            <div class="p-3 pt-0">
                                <div class="pb-3 mb-3 doctor-info-detail">
                                    <h3 class="mb-1">
                                        <a href="{{ route('doctorshome.show', $doctor->id) }}">Dr.
                                            {{ $doctor->name }}</a>
                                    </h3>
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 d-flex align-items-center fs-14">
                                            <i class="isax isax-location me-2"></i>
                                            {{ $doctor->address ?? 'Location not specified' }}
                                        </p>
                                        <i class="mx-2 fa-solid fa-circle fs-5 text-primary me-1"></i>
                                        <span class="fs-14 fw-medium">
                                            {{ $doctor->doctorProfile->appointment_duration ?? '30' }} Min
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="mb-1">Consultation Fees</p>
                                        <h3 class="text-orange">
                                            ${{ number_format($doctor->doctorProfile->consultation_fee ?? 0, 0) }}</h3>
                                    </div>
                                    @if ($doctor->doctorProfile && $doctor->doctorProfile->canAcceptAppointments())
                                        <a href="{{ route('doctorshome.show', $doctor->id) }}"
                                            class="inline-flex btn btn-md btn-dark align-items-center rounded-pill">
                                            <i class="isax isax-calendar-1 me-2"></i>
                                            Book Now
                                        </a>
                                    @else
                                        <button
                                            class="inline-flex btn btn-md btn-secondary align-items-center rounded-pill"
                                            disabled>
                                            <i class="isax isax-calendar-1 me-2"></i>
                                            Not Available
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

        </div>
    </section>
    <!-- /Doctors Section -->

<!-- Testimonial Section -->
<section class="testimonial-section">
    <div class="testimonial-shape-img">
        <div class="testimonial-shape-left">
            <img src="{{ asset('frontend/xx/assets/img/shape-04.png') }}" alt="shape-image">
        </div>
        <div class="testimonial-shape-right">
            <img src="{{ asset('frontend/xx/assets/img/shape-05.png') }}" alt="shape-image">
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if($testim && $testim->count() > 0)
                <div class="testimonial-slider slick">
                    @foreach($testim as $index => $testimony)
                    <div class="testimonial-grid">
                        <div class="testimonial-info">
                            <div class="testimonial-img">
                                <img src="{{ $testimony->photo_url }}" 
                                     class="img-fluid" 
                                     alt="{{ $testimony->name }} - {{ $testimony->company }}"
                                     style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
                            </div>
                            <div class="testimonial-content">
                                <div class="section-inner-header testimonial-header">
                                    <h6>{{ __('Testimonials') }}</h6>
                                    <h2>{{ __('What Our Client Says') }}</h2>
                                </div>
                                <div class="testimonial-details">
                                    <p>{{ $testimony->discreption }}</p>
                                    <h6>
                                        <span>{{ $testimony->name }}</span> 
                                        {{ $testimony->company }}
                                    </h6>
                                    @if($testimony->title)
                                    <small class="text-muted">{{ $testimony->title }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <!-- عرض افتراضي إذا لم توجد بيانات -->
                <div class="text-center py-5">
                    <h4>{{ __('No testimonials available at the moment') }}</h4>
                    <p class="text-muted">{{ __('Check back later for client testimonials') }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- /Testimonial Section -->

<!-- FAQ Section -->
<section class="faq-section faq-section-inner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center section-inner-header">
                    <h6>{{ __('Get Your Answer') }}</h6>
                    <h2>{{ __('Frequently Asked Questions') }}</h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="faq-img">
                    <img src="{{ asset('frontend/xx/assets/img/faq-img.png') }}" class="img-fluid" alt="FAQ Image">
                    <div class="faq-patients-count">
                        <div class="faq-smile-img">
                            <img src="{{ asset('frontend/xx/assets/img/icons/smiling-icon.svg') }}" alt="smiling icon">
                        </div>
                        <div class="faq-patients-content">
                            <h4><span class="count-digit">95</span>k+</h4>
                            <p>{{ __('Happy Patients') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="faq-info">
                    <div class="accordion" id="faqAccordion">
                        @if($faqs && $faqs->count() > 0)
                            @foreach($faqs as $index => $faq)
                                <!-- FAQ Item -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faqHeading{{ $index }}">
                                        <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" 
                                                type="button" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#faqCollapse{{ $index }}" 
                                                aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" 
                                                aria-controls="faqCollapse{{ $index }}">
                                            {{ $faq->qu }}
                                        </button>
                                    </h2>
                                    <div id="faqCollapse{{ $index }}" 
                                         class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" 
                                         aria-labelledby="faqHeading{{ $index }}" 
                                         data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <div class="accordion-content">
                                                <p>{{ $faq->answer }}</p>
                                                @if($faq->discreption)
                                                    <div class="mt-3">
                                                        <small class="text-muted">
                                                            <i class="fas fa-info-circle me-1"></i>
                                                            {{ $faq->discreption }}
                                                        </small>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /FAQ Item -->
                            @endforeach
                        @else
                            <!-- Default FAQs if no data -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="defaultHeading1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                            data-bs-target="#defaultCollapse1" aria-expanded="true" 
                                            aria-controls="defaultCollapse1">
                                        Can I make an appointment online with White Plains Hospital Kendi?
                                    </button>
                                </h2>
                                <div id="defaultCollapse1" class="accordion-collapse collapse show" 
                                     aria-labelledby="defaultHeading1" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <div class="accordion-content">
                                            <p>Yes, you can easily book appointments online through our website. 
                                               Simply visit our appointment booking section, select your preferred 
                                               doctor and time slot, and confirm your booking.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="defaultHeading2">
                                    <button class="accordion-button collapsed" type="button" 
                                            data-bs-toggle="collapse" data-bs-target="#defaultCollapse2" 
                                            aria-expanded="false" aria-controls="defaultCollapse2">
                                        What are your working hours?
                                    </button>
                                </h2>
                                <div id="defaultCollapse2" class="accordion-collapse collapse" 
                                     aria-labelledby="defaultHeading2" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <div class="accordion-content">
                                            <p>Our hospital operates 24/7 for emergency services. For regular 
                                               appointments, our working hours are from 8:00 AM to 10:00 PM, 
                                               seven days a week.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /FAQ Section -->
@endsection
