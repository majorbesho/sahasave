@extends('frontend.layouts.master')
@section('title', __('seo.about.title'))
@section('meta_description', __('seo.about.description'))
@section('content')

    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="text-center col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="isax isax-home-15"></i></a></li>
                            <li class="breadcrumb-item active">{{ __('about.breadcrumb_title') }}</li>
                        </ol>

                        <h1 class="breadcrumb-title">{{ __('about.breadcrumb_title') }}</h1>
                    </nav>
                </div>
            </div>
        </div>
        <div class="breadcrumb-bg">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-01.png') }}" alt="img" class="breadcrumb-bg-01">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-02.png') }}" class="breadcrumb-bg-02" alt="img">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" class="breadcrumb-bg-03" alt="img" width="100" height="100">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" class="breadcrumb-bg-04" alt="img" width="100" height="100">
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- About Us -->
    <section class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="about-img-info">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="about-inner-img">
                                    <div class="about-img">
                                        <img src="{{ asset('frontend/xx/assets/img/about-img1.jpg') }}" class="img-fluid" alt="about-image" width="300" height="400">
                                    </div>
                                    <div class="about-img">
                                        <img src="{{ asset('frontend/xx/assets/img/about-img2.jpg') }}" class="img-fluid" alt="about-image" width="300" height="200">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="about-inner-img">
                                    <div class="about-box">
                                        <h4>{{ __('about.banner_title') }}</h4>
                                    </div>
                                    <div class="about-img">
                                        <img src="{{ asset('frontend/xx/assets/img/about-img3.jpg') }}" class="img-fluid" alt="about-image" width="300" height="400">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="section-inner-header about-inner-header">
                        <h6>{{ __('about.breadcrumb_title') }}</h6>
                        <h2>{{ __('about.about_title') }}</h2>
                    </div>
                    <div class="about-content">
                        <div class="about-content-details">
                            <p>{{ __('about.about_description') }}</p>
                            <p>{{ __('about.about_description_2') }}</p>
                        </div>
                        <div class="about-contact">
                            <div class="about-contact-icon">
                                <span><img src="{{ asset('frontend/xx/assets/img/icons/phone-icon.svg') }}" alt="phone-image" width="48" height="48"></span>
                            </div>
                            <div class="about-contact-text">
                                <p>{{ __('about.contact_help') }}</p>
                                <h4>+971 54 506 0739</h4>
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
                        <h2>{{ __('about.why_choose_title') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card why-choose-card w-100">
                        <div class="card-body">
                            <div class="why-choose-icon">
                                <span><img src="{{ asset('frontend/xx/assets/img/icons/choose-01.svg') }}" alt="choose-image"></span>
                            </div>
                            <div class="why-choose-content">
                                <h4>{{ __('about.card_1_title') }}</h4>
                                <p>{{ __('about.card_1_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card why-choose-card w-100">
                        <div class="card-body">
                            <div class="why-choose-icon">
                                <span><img src="{{ asset('frontend/xx/assets/img/icons/choose-02.svg') }}" alt="choose-image"></span>
                            </div>
                            <div class="why-choose-content">
                                <h4>{{ __('about.card_2_title') }}</h4>
                                <p>{{ __('about.card_2_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card why-choose-card w-100">
                        <div class="card-body">
                            <div class="why-choose-icon">
                                <span><img src="{{ asset('frontend/xx/assets/img/icons/choose-03.svg') }}" alt="choose-image"></span>
                            </div>
                            <div class="why-choose-content">
                                <h4>{{ __('about.card_3_title') }}</h4>
                                <p>{{ __('about.card_3_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="card why-choose-card w-100">
                        <div class="card-body">
                            <div class="why-choose-icon">
                                <span><img src="{{ asset('frontend/xx/assets/img/icons/choose-04.svg') }}" alt="choose-image"></span>
                            </div>
                            <div class="why-choose-content">
                                <h4>{{ __('about.card_4_title') }}</h4>
                                <p>{{ __('about.card_4_desc') }}</p>
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
                            <h2>{{ __('about.way_title') }}</h2>
                            <p>{{ __('about.way_desc') }}</p>
                            <a href="{{ route('register') }}" class="btn btn-primary">{{ __('about.way_btn') }}</a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <div class="way-img">
                            <img src="{{ asset('frontend/xx/assets/img/way-img.png') }}" class="img-fluid" alt="doctor-way-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Way Section -->

    <!-- How It Works Section -->
    <section class="how-it-works-section" style="padding: 60px 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center section-inner-header">
                        <h2>{{ __('about.how_works_title') }}</h2>
                        <h6 class="mt-2 text-muted">{{ __('about.how_works_subtitle') }}</h6>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="step-card mb-4">
                        <div class="step-icon mb-3">
                            <i class="fas fa-user-plus fa-3x text-primary"></i>
                        </div>
                        <h4>{{ __('about.step_1_title') }}</h4>
                        <p class="text-muted">{{ __('about.step_1_desc') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="step-card mb-4">
                        <div class="step-icon mb-3">
                            <i class="fas fa-search fa-3x text-primary"></i>
                        </div>
                        <h4>{{ __('about.step_2_title') }}</h4>
                        <p class="text-muted">{{ __('about.step_2_desc') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="step-card mb-4">
                        <div class="step-icon mb-3">
                            <i class="fas fa-calendar-check fa-3x text-primary"></i>
                        </div>
                        <h4>{{ __('about.step_3_title') }}</h4>
                        <p class="text-muted">{{ __('about.step_3_desc') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="step-card mb-4">
                        <div class="step-icon mb-3">
                            <i class="fas fa-wallet fa-3x text-primary"></i>
                        </div>
                        <h4>{{ __('about.step_4_title') }}</h4>
                        <p class="text-muted">{{ __('about.step_4_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats-section bg-light" style="padding: 60px 0;">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-12 text-center mb-5">
                     <h2>{{ __('about.stats_title') }}</h2>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter-box text-center mb-4">
                        <h2 class="counter-number fw-bold text-primary">5000+</h2>
                        <p class="counter-text">{{ __('about.stat_1_text') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter-box text-center mb-4">
                        <h2 class="counter-number fw-bold text-secondary">250+</h2>
                        <p class="counter-text">{{ __('about.stat_2_text') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter-box text-center mb-4">
                        <h2 class="counter-number fw-bold text-success">15000+</h2>
                        <p class="counter-text">{{ __('about.stat_3_text') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter-box text-center mb-4">
                        <h2 class="counter-number fw-bold text-warning">500,000+</h2>
                        <p class="counter-text">{{ __('about.stat_4_text') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" style="padding: 80px 0; background: linear-gradient(45deg, #0e82fd, #00b1ff);">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-8 mx-auto text-white">
                    <h2 class="text-white">{{ __('about.cta_title') }}</h2>
                    <p class="mb-4 text-white opacity-75 lead">{{ __('about.cta_desc') }}</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg text-primary fw-bold">{{ __('about.cta_btn_1') }}</a>
                        <a href="{{ route('doctors.search') }}" class="btn btn-outline-light btn-lg">{{ __('about.cta_btn_2') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- FAQ Section -->
    <section class="faq-section faq-section-inner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center section-inner-header">
                        <h6>{{ __('about.faq_title') }}</h6>
                        <h2>{{ __('about.faq_subtitle') }}</h2>
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
                                <p>{{ __('about.stat_1_text') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="faq-info">
                        <div class="accordion" id="faqAccordion">
                            @if($faqs && $faqs->count() > 0)
                                @foreach($faqs as $index => $faq)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="faqHeading{{ $index }}">
                                            <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" 
                                                    type="button" 
                                                    data-bs-toggle="collapse" 
                                                    data-bs-target="#faqCollapse{{ $index }}" 
                                                    aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" 
                                                    aria-controls="faqCollapse{{ $index }}">
                                                {{ $faq->question }}
                                            </button>
                                        </h2>
                                        <div id="faqCollapse{{ $index }}" 
                                             class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" 
                                             aria-labelledby="faqHeading{{ $index }}" 
                                             data-bs-parent="#faqAccordion">
                                            <div class="accordion-body">
                                                <div class="accordion-content">
                                                    <p>{{ $faq->answer }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /FAQ Section -->

    <!-- Partners Section -->
    <section class="partners-section py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2>{{ __('about.partners_title') }}</h2>
                     <p class="text-muted">{{ __('about.partners_subtitle') }}</p>
                </div>
            </div>
            <!-- Add logos here if available in assets, placeholder for now -->
            <div class="row justify-content-center text-center opacity-50">
                 <div class="col-md-2 col-4 mb-4">
                     <i class="fas fa-hospital fa-3x text-muted"></i>
                 </div>
                 <div class="col-md-2 col-4 mb-4">
                    <i class="fas fa-clinic-medical fa-3x text-muted"></i>
                 </div>
                 <div class="col-md-2 col-4 mb-4">
                    <i class="fas fa-user-md fa-3x text-muted"></i>
                 </div>
                 <div class="col-md-2 col-4 mb-4">
                    <i class="fas fa-heartbeat fa-3x text-muted"></i>
                 </div>
            </div>
        </div>
     </section>
@endsection
