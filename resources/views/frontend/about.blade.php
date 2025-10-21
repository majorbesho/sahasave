@extends('frontend.layouts.master')


@section('content')
    <!--Start Page Header-->
    <section class="page-header">
        <div class="page-header__bg"
            style="background-image: url({{ asset('4/assets/images/backgrounds/page-header-bg.jpg') }})">
        </div>
        <div class="page-header__pattern"><img src="{{ asset('4/assets/images/pattern/page-header-pattern.png') }}"
                alt=""></div>
        <div class="container">
            <div class="page-header__inner" style="">
                <h2>About us</h2>
                <ul class="thm-breadcrumb">
                    <li><a href="{{ route('home') }}" style="color: #fff">Home</a></li>
                    <li><span class="icon-right-arrow21"></span></li>
                    <li>About us</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Header-->

    <!--Start About One-->
    <section class="about-one" style="background:#fff;">
        <div class="container">
            <div class="row">
                <!--Start About One Content-->
                <div class="col-xl-7">
                    <div class="about-one__content">
                        <div class="sec-title tg-heading-subheading animation-style2">
                            <div class="sec-title__tagline">
                                <div class="line"></div>
                                <div class="text tg-element-title">
                                    <h4 style="color: #Fabc3f">Our Company</h4>
                                </div>
                                <div class="icon">
                                    <span class="icon-plane2 float-bob-x3"></span>
                                </div>
                            </div>
                            <h2 class="sec-title__title tg-element-title">Our Expertise Stands in <br>
                                <span>SahaSave.com
                                    Solutions</span>
                            </h2>
                        </div>
                        <div>
                            <iframe width="560" height="315"
                                src="https://www.youtube.com/embed/LIf6hI3-hJ0?si=umbRfO9-ajVpmNsz"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                        <div class="about-one__content-text1">


                            <p style="color: #Fabc3f">Logistic service provider company plays a pivotal role in the global
                                supply
                                chain ecosystem by efficiently managing the movement of goods from origin to final
                                destination. These companies offer a diverse.</p>
                        </div>

                        <div class="about-one__content-text2">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="about-one__content-text2-single">
                                        <div class="about-one__content-text2-single-top">
                                            <div class="icon">
                                                <span class="icon-worldwide-shipping-1"></span>
                                            </div>

                                            <div class="title-box">
                                                <h3>Worldwide Service</h3>
                                            </div>
                                        </div>

                                        <p>Logistic service provider company plays a pivotal role in the global</p>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="about-one__content-text2-single">
                                        <div class="about-one__content-text2-single-top">
                                            <div class="icon">
                                                <span class="icon-24-hours-service"></span>
                                            </div>

                                            <div class="title-box">
                                                <h3>24/7 Online Support</h3>
                                            </div>
                                        </div>

                                        <p>Logistic service provider company plays a pivotal role in the global</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="about-one__content-bottom">
                            <div class="btn-box">
                                <a class="thm-btn" href="https://www.youtube.com/embed/LIf6hI3-hJ0?si=umbRfO9-ajVpmNsz">More
                                    About Us
                                    <i class="icon-right-arrow21"></i>
                                    <span class="hover-btn hover-bx"></span>
                                    <span class="hover-btn hover-bx2"></span>
                                    <span class="hover-btn hover-bx3"></span>
                                    <span class="hover-btn hover-bx4"></span>
                                </a>
                            </div>

                            <div class="contact-box">
                                <div class="icon">
                                    <span class="icon-phone2"></span>
                                </div>

                                <div class="text-box">
                                    <p>Make A Phone Call</p>

                                    <h4><a href="tel:971509257500">+971509257500 </a></h4>
                                    <h4><a href="tel:13606374225">+1 (360) 637
                                            -4225 </a></h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End About One Content-->

                <!--Start About One Img-->
                <div class="col-xl-5">
                    <div class="about-one__img">
                        <div class="shape1 float-bob-y"><img src="{{ asset('4/assets/images/shapes/about-v1-shape1.png') }}"
                                alt="">
                        </div>
                        <div class="shape2 float-bob-y"><img src="{{ asset('4/assets/images/shapes/about-v1-shape2.png') }}"
                                alt="">
                        </div>
                        <div class="about-one__img1 reveal">
                            <img src="{{ asset('4/assets/images/about/about-v1-img1.jpg') }}" alt="">
                        </div>

                        <div class="about-one__img2">
                            <div class="about-one__img2-inner reveal">
                                <img src="{{ asset('4/assets/images/about/about-v1-img2.jpg') }}" alt="">
                            </div>

                            <div class="about-one__circle-text">
                                <div class="about-one__round-text-box">
                                    <div class="inner">
                                        <div class="about-one__curved-circle rotate-me">
                                            WELCOME TO OUR COMPANY SINCE 2002
                                        </div>
                                    </div>
                                    <div class="overlay-icon-box">
                                        <a href="#"><i class="icon-location1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="shape3 float-bob-y">
                                <img src="{{ asset('4/assets/images/shapes/about-v1-shape3.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <!--End About One Img-->
            </div>
        </div>
    </section>
    <!--End About One-->

    <!--Start Service One-->
    <!--Start Testimonial Three-->
    <section class="testimonial-three"
        style="background-image: url({{ asset('4/assets/images/pattern/service-v1-pattern.jpg') }});">
        <div class="shape1 float-bob-x3">
            <img src="{{ asset('4/assets/images/shapes/quote-v1-shape1.png') }}" alt="">
        </div>
        <div class="container" style="padding-bottom: 4%">
            <div class="sec-title center text-center tg-heading-subheading animation-style2">
                <div class="{{ app()->getLocale() === 'ar' ? 'nonetext' : 'sec-title__tagline' }}">
                    <div class="line"></div>
                    <div class="text {{ app()->getLocale() === 'ar' ? 'nonetext' : 'tg-element-title' }} ">
                        <h4 style="color: #Fabc3f">{{ __('index.testimonials') }}</h4>
                    </div>
                    <div class="icon">
                        <span class="icon-plane2 float-bob-x3"></span>
                    </div>
                </div>
                <h2 class="{{ app()->getLocale() === 'ar' ? 'nonetext' : 'sec-title__title tg-element-title' }} ">
                    {{ __('index.What Client’s say about') }} <br>
                    {{ __('index.Our') }} <span>{{ __('index.Services') }}</span></h2>
            </div>

            <div class="testimonial-three__inner">



                <div class="testimonial-three__img1 float-bob-y3">
                    <img src="{{ asset('4/assets/images/testimonial/testimonial-v3-img5.jpg') }}" alt="">
                </div>


                <div class="testimonial-three__img2 float-bob-y3">
                    <img src="{{ asset('4/assets/images/testimonial/testimonial-v3-img7.jpg') }}" alt="">
                </div>

                <div class="testimonial-three__img3  float-bob-x3">
                    <img src="{{ asset('4/assets/images/testimonial/testimonial-v3-img8.jpg') }}" alt="">
                </div>

                <div class="testimonial-three__img4  float-bob-y3">
                    <img src="{{ asset('4/assets/images/testimonial/testimonial-v3-img9.jpg') }}" alt="">
                </div>

                <div class="testimonial-three__img5  float-bob-y3">
                    <img src="{{ asset('4/assets/images/testimonial/testimonial-v3-img6.jpg') }}" alt="">
                </div>

                <div class="testimonial-three__img6  float-bob-x3">
                    <img src="{{ asset('4/assets/images/testimonial/testimonial-v3-img4.jpg') }}" alt="">
                </div>

                <div class="testimonial-three__carousel owl-carousel owl-theme">
                    <!--Start Testimonial Three Single-->
                    @if (count($testim) > 0)
                        @foreach ($testim as $testims)
                            @php
                                $photos = explode(',', $testims->photo);
                            @endphp
                            <div class="testimonial-three__single">
                                <div class="testimonial-three__single-img">
                                    <img src="{{ $photos[0] }}" alt="">
                                </div>

                                <div class="testimonial-three__single-title text-center">
                                    <h2>{!! $testims->discreption !!}</h2>
                                </div>

                                <div class="testimonial-three__single-author text-center">
                                    <h2>{!! $testims->name !!}</h2>
                                    <p>{!! $testims->company !!}</p>
                                </div>

                                <div class="testimonial-three__single-rating">
                                    <div class="icon">
                                        <span class="icon-star"></span>
                                    </div>
                                    <h4>5 out of 5</h4>
                                </div>

                            </div>
                        @endforeach
                    @endif

                    <!--End Testimonial Three Single-->


                </div>5


            </div>
        </div>
    </section>
    <!--End Testimonial Three-->

    <!-- Quote One -->
    <section class="quote-one" style="padding-top: 7%">
        {{-- style="background-image: url({{ asset('4/assets/images/backgrounds/quote-v1-bg4.jpg') }});"></div> --}}


        {{-- <div class="quote-one__bg" data-jarallax="" data-speed="0.2" data-imgposition="50% 0%" style=""></div> --}}
        <div class="container">
            <div class="row">



                <div class="col-lg-12">
                    <div class="sec-title center text-center tg-heading-subheading animation-style2">
                        <div class="sec-title__tagline">
                            <div class="line"></div>
                            <div class="text tg-element-title" style="">
                                <h4 class="font-size:20px">Our Service</h4>
                            </div>
                            <div class="icon">
                                <span class="icon-plane2 float-bob-x3"></span>
                            </div>
                        </div>
                        <h2 class="sec-title__title tg-element-title"><span>Request A Quote</span></h2>
                    </div>


                    <div class="row quote-tab wow fadeInUp" data-wow-delay="100ms">
                        <div class="container">
                            <div class="row">
                                <div class="service-one__carousel owl-carousel owl-theme owl-dot-style1">
                                    <!--Start Service One Single-->

                                    <div class="service-one__single">
                                        <div class="service-one__single-inner">
                                            <div class="service-one__single-img">
                                                <img src="{{ asset('4/assets/images/services/services-v1-img1.jpg') }}"
                                                    alt="#">
                                            </div>

                                            <div class="service-one__single-content">
                                                <h2><a href="{{ route('getrequestforQuote') }}">Request A Quote
                                                    </a></h2>
                                                <p>Request a quote for efficient logistics services tailored to you</p>
                                                <div class="btn-box">
                                                    <a href="{{ route('getrequestforQuote') }}">Get Your Quote <span
                                                            class="icon-right-arrow21"></span></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="icon">
                                            <span class="icon-delivery-man"></span>
                                        </div>
                                    </div>

                                    <div class="service-one__single">
                                        <div class="service-one__single-inner">
                                            <div class="service-one__single-img">
                                                <img src="{{ asset('4/assets/images/services/services-v1-img2.jpg') }}"
                                                    alt="#">
                                            </div>

                                            <div class="service-one__single-content">
                                                <h2><a href="{{ route('gaddyourload') }}">Add your Loads
                                                    </a></h2>
                                                <p>Add your Load (shipment-
                                                    package)</p>
                                                <div class="btn-box">
                                                    <a href="{{ route('gaddyourload') }}">Add your Loads <span
                                                            class="icon-shipment"></span></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="icon">
                                            <span class="icon-delivery-man"></span>
                                        </div>
                                    </div>


                                    <div class="service-one__single">
                                        <div class="service-one__single-inner">
                                            <div class="service-one__single-img">
                                                <a href="{{ route('gaddyourload') }}">
                                                    <img src="{{ asset('4/assets/images/services/services-v1-img3.jpg') }}"
                                                        alt="#">
                                                </a>
                                            </div>

                                            <div class="service-one__single-content">
                                                <h2><a href="{{ route('gaddyourload') }}">Add your Truck
                                                    </a></h2>
                                                <p>Add your Truck</p>
                                                <div class="btn-box">
                                                    <a href="{{ route('gaddyourload') }}">Add your Truck <span
                                                            class="icon-right-arrow21"></span></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="icon">
                                            <span class="icon-delivery-man"></span>
                                        </div>
                                    </div>


                                    <!--End Service One Single-->

                                    <div class="service-one__single">
                                        <div class="service-one__single-inner">
                                            <div class="service-one__single-img">
                                                <img src="{{ asset('4/assets/images/services/services-v1-img2.jpg') }}"
                                                    alt="#">
                                            </div>
                                            <div class="service-one__single-content">
                                                <h2><a href="{{ route('supplier.register1.form') }}">Become a partner
                                                    </a></h2>
                                                <p>Become a partner</p>
                                                <div class="btn-box">
                                                    <a href="{{ route('supplier.register1.form') }}">Become a partner<span
                                                            class="icon-right-arrow21"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="icon">
                                            <span class="icon-delivery-man"></span>
                                        </div>
                                    </div>
                                    <div class="service-one__single">
                                        <div class="service-one__single-inner">
                                            <div class="service-one__single-img">
                                                <img src="{{ asset('4/assets/images/services/services-v1-img3.jpg') }}"
                                                    alt="#">
                                            </div>
                                            <div class="service-one__single-content">
                                                <h2><a href="{{ route('supplier.register1.form') }}">Search Load OR
                                                        Vehicale
                                                    </a></h2>
                                                <p> Search Load OR Vehicale
                                                </p>
                                                <div class="btn-box">
                                                    <a href="{{ route('supplier.register1.form') }}">Search Load OR
                                                        Vehicale<span class="icon-right-arrow21"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="icon">
                                            <span class="icon-delivery-man"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                </div>



            </div>
        </div>
    </section>
    <!-- End Quote One -->



    <!--Start Project One-->
    <section class="project-one">
        <div class="container">
            <div class="row">
                <!--Start Project One Single-->
                <div class="col-xl-5 col-lg-5 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="project-one__title">
                        <div class="sec-title tg-heading-subheading animation-style2">
                            <div class="sec-title__tagline">
                                <div class="line"></div>
                                <div class="text tg-element-title">
                                    <h4 style="color: #Fabc3f">Latest Project</h4>
                                </div>
                                <div class="icon">
                                    <span class="icon-plane2 float-bob-x3"></span>
                                </div>
                            </div>
                            <h2 class="sec-title__title tg-element-title">The Achievement <br>
                                of Our <span>Project</span></h2>
                        </div>

                        <div class="btn-box">
                            <a class="thm-btn" href="{{ route('allrticles') }}">See All Project
                                <i class="icon-right-arrow21"></i>
                                <span class="hover-btn"></span>
                                <!-- يمكن تبسيط عناصر hover -->
                            </a>
                        </div>
                    </div>
                </div>
                <!--End Project One Single-->

                @if ($arts->count() > 0)
                    <!-- العنصر الأول (كبير) -->
                    <div class="col-xl-7 col-lg-7 wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="project-one__single">
                            <div class="project-one__single-img">
                                <div class="inner">
                                    <img src="{{ asset($arts[0]->mainImg) }}" alt="{{ $arts[0]->title }}">
                                    <div class="project-one__overlay-content">
                                        <div class="text-box">
                                            <p>{{ $arts[0]->sdiscreption }}</p>
                                            <h2><a
                                                    href="{{ route('artsDispaly', $arts[0]->slug) }}">{{ $arts[0]->title }}</a>
                                            </h2>
                                        </div>
                                        <div class="icon">
                                            <a href="{{ route('artsDispaly', $arts[0]->slug) }}"><span
                                                    class="icon-right-arrow21"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- العناصر الثلاثة التالية -->
                    @foreach ($arts->slice(1, 3) as $art)
                        <div class="col-xl-4 col-lg-4 wow fadeInLeft" data-wow-delay="{{ $loop->index * 100 }}ms"
                            data-wow-duration="1500ms">
                            <div class="project-one__single">
                                <div class="project-one__single-img">
                                    <div class="inner">
                                        <img src="{{ asset($art->mainImg) }}" alt="{{ $art->title }}">
                                        <div class="project-one__overlay-content">
                                            <div class="text-box">
                                                <p>{{ $art->sdiscreption }}</p>
                                                <h2><a
                                                        href="{{ route('artsDispaly', $art->slug) }}">{{ $art->title }}</a>
                                                </h2>
                                            </div>
                                            <div class="icon">
                                                <a href="{{ route('artsDispaly', $art->slug) }}"><span
                                                        class="icon-right-arrow21"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <p>No projects found</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!--End Project One-->


    <section
        style="display: flex;
                        flex-wrap: nowrap;
                        justify-content: center;padding-bottom: 7%;padding-top: 5%;
                        background-image: url({{ asset('4/assets/images/backgrounds/quote-v1-bg4.jpg') }});
                        background-attachment: scroll;
                        background-size: cover;
                        background-repeat: no-repeat;
                        background-position: center center;
                        ">
        <div class="page-header__pattern">
            <img src="http://127.0.0.1:8000/4/assets/images/pattern/page-header-pattern.png" alt="">
        </div>
        <style>
            .profile-section {
                background: #ffffff;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                padding: 40px;
                max-width: 600px;
                text-align: center;
            }

            .profile-section h1 {
                font-size: 2.5rem;
                color: #2c3e50;
                margin-bottom: 20px;
            }

            .profile-section h2 {
                font-size: 1.5rem;
                color: #3498db;
                margin-bottom: 15px;
            }

            .profile-section p {
                font-size: 1.1rem;
                line-height: 1.8;
                color: #555;
                margin-bottom: 25px;
            }

            .profile-section .highlight {
                color: #Fabc3f;
                font-weight: bold;
            }

            .profile-section .quote {
                font-style: italic;
                color: #7f8c8d;
                margin-top: 20px;
            }

            .profile-section .button {
                background: #3498db;
                color: #fff;
                padding: 12px 24px;
                border: none;
                border-radius: 6px;
                font-size: 1rem;
                cursor: pointer;
                transition: background 0.3s ease;
            }

            .profile-section .button:hover {
                background: #2980b9;
            }
        </style>

        <div class="profile-section">
            <h1>Kadhim Alhisnawi</h1>
            <h2>CEO of SahaSave.com Middle East</h2>
            <p>
                About Us
                Founded and led by Kadhim Alhisnawi, a U.S. citizen originally from Iraq, SahaSave.com Middle East is
                redefining the logistics and trucking industry. With over 20 years of experience in the U.S. logistics
                sector, Kadhim brings a wealth of knowledge and insight into supply chain optimization and SahaSave.com
                management. His unique blend of expertise in U.S. logistics and deep understanding of the Middle East market
                has allowed him to spearhead the development of a state-of-the-art digital SahaSave.com platform tailored to
                the
                region’s needs.

                For the past six years, Kadhim has focused on creating a platform that addresses the region’s specific
                challenges, driving innovation to streamline operations and enhance efficiency. Under his leadership, bUer
                SahaSave.com Middle East is committed to transforming the SahaSave.com industry by providing a smarter, more
                efficient, and transparent solution for logistics professionals across the Middle East.

                Our mission is to bridge the gap between technology and logistics, empowering businesses with reliable,
                cost-effective, and scalable solutions. Whether you’re a carrier or a shipper, SahaSave.com Middle East is
                your trusted partner in navigating the complexities of modern SahaSave.com transport.
            </p>
            <p class="quote">
                "Innovation is the key to transforming the future of logistics."
            </p>
            <a href="https://cardlinesbc.com/bcv/1a78ca336f5c339a13da372771f29782" class="button">Learn More</a>
        </div>

    </section>

    <!--Start Why Choose One-->
    <section class="why-choose-one">
        <div class="why-choose-one__pattern">
            <img src="{{ asset('4/assets/images/pattern/why-choose-v1-pattern.png') }}" alt="">
        </div>
        <div class="shape1 float-bob-y"><img src="{{ asset('4/assets/images/shapes/why-choose-v1-shape1.png') }}"
                alt=""></div>
        <div class="container">
            <div class="row">
                <!--Start Why Choose One Content-->
                <div class="col-xl-6">
                    <div class="why-choose-one__content">
                        <div class="sec-title tg-heading-subheading animation-style2">
                            <div class="sec-title__tagline">
                                <div class="line"></div>
                                <div class="text tg-element-title">
                                    <h4>Why Choose us</h4>
                                </div>
                                <div class="icon">
                                    <span class="icon-plane2 float-bob-x3"></span>
                                </div>
                            </div>
                            <h2 class="sec-title__title tg-element-title">Efficient, Safe, & Swift <br> SahaSave.com
                                <span>Solution!</span>
                            </h2>
                        </div>

                        <div class="why-choose-one__content-list">
                            <ul>
                                <li>
                                    <p><span class="icon-plane2"></span> Make long term business decisions</p>
                                </li>
                                <li>
                                    <p><span class="icon-plane2"></span> Transparent career journey and support.</p>
                                </li>
                                <li>
                                    <p><span class="icon-plane2"></span> Be a responsible member of the community
                                    </p>
                                </li>
                                <li>
                                    <p><span class="icon-plane2"></span> Provide a service we are proud of</p>
                                </li>
                            </ul>
                        </div>

                        <div class="btn-box">
                            <a class="thm-btn" href="{{ route('contact') }}">Contact Us
                                <i class="icon-right-arrow21"></i>
                                <span class="hover-btn hover-bx"></span>
                                <span class="hover-btn hover-bx2"></span>
                                <span class="hover-btn hover-bx3"></span>
                                <span class="hover-btn hover-bx4"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!--End Why Choose One Content-->

                <!--Start Why Choose One Form-->
                {{-- <div class="col-xl-6">
                    <div class="why-choose-one__form-box wow fadeInRight" data-wow-delay="0ms"
                        data-wow-duration="1500ms">
                        <div class="title-box">
                            <h2>Request a Quote</h2>
                        </div>

                        <form class="contact-form-validated why-choose-one__form" action="assets/inc/sendemail.php"
                            method="post" novalidate="novalidate">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="input-box">
                                        <input type="text" name="name" placeholder="Name" required="">
                                        <div class="icon"><span class="icon-user"></span></div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="input-box">
                                        <input type="email" name="email" placeholder="Email" required="">
                                        <div class="icon"><span class="icon-email"></span></div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="input-box">
                                        <input type="text" name="Phone" placeholder="Phone" required="">
                                        <div class="icon"><span class="icon-phone2"></span></div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="input-box">
                                        <input type="text" name="date" value="" placeholder="Date"
                                            id="datepicker">
                                        <div class="icon"><span class="icon-calendar"></span></div>
                                    </div>
                                </div>


                                <div class="col-xl-12">
                                    <div class="why-choose-one__form-distance">
                                        <div class="title">
                                            <p>distance(Kilo):</p>
                                        </div>
                                        <div class="why-choose-one__form-distance-inner">
                                            <div class="price-ranger">
                                                <div id="slider-range"></div>
                                                <div class="ranger-min-max-block">
                                                    <input type="text" readonly="" class="min"
                                                        style="background: #Fabc3f;color:#fff">
                                                    {{-- <span style="background: #Fabc3f;color:#fff">-</span> --}
                <input type="text" readonly="" class="max" style="background: #Fabc3f;color:#fff">
            </div>
        </div>
        </div>
        </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="input-box">
                <div class="select-box">
                    <select class="selectmenu wide">
                        <option selected="selected">SahaSave.com Type</option>
                        <option>SahaSave.com Type 01</option>
                        <option>SahaSave.com Type 02</option>
                        <option>SahaSave.com Type 03</option>
                        <option>SahaSave.com Type 04</option>
                        <option>SahaSave.com Type 05</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="input-box">
                <div class="select-box">
                    <select class="selectmenu wide">
                        <option selected="selected">Load</option>
                        <option>SahaSave.com Type 01</option>
                        <option>SahaSave.com Type 02</option>
                        <option>SahaSave.com Type 03</option>
                        <option>SahaSave.com Type 04</option>
                        <option>SahaSave.com Type 05</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xl-12">
            <div class="why-choose-one__form-btn">
                <button type="submit" class="thm-btn">
                    Contact Us
                    <i class="icon-right-arrow21"></i>
                    <span class="hover-btn hover-bx"></span>
                    <span class="hover-btn hover-bx2"></span>
                    <span class="hover-btn hover-bx3"></span>
                    <span class="hover-btn hover-bx4"></span>
                </button>
            </div>
        </div>
        </div>
        </form>
        <div class="result"></div>
        </div>
        </div> --}}
                <!--End Why Choose One Form-->
            </div>
        </div>
    </section>
    <!--End Why Choose One-->

    <!--Start Testimonial One-->
    {{-- <section class="testimonial-one" style="background:#fff;">
        <div class="testimonial-one__pattern"
            style="background-image: url(assets/images/pattern/testimonial-v1-pattern.png);"></div>
        <div class="container">
            <div class="row">
                <!--Start Testimonial One Content-->
                <div class="col-xl-6">
                    <div class="testimonial-one__content">
                        <div class="big-title">
                            <h2 style="color:  #Fabc3f">TESTIMONIALS</h2>
                        </div>
                        <div class="sec-title tg-heading-subheading animation-style2">
                            <div class="sec-title__tagline">
                                <div class="line"></div>
                                <div class="text tg-element-title">
                                    <h4 style="color:#Fabc3f">Client Testimonial</h4>
                                </div>
                                <div class="icon">
                                    <span class="icon-plane2 float-bob-x3"></span>
                                </div>
                            </div>
                            <h2 class="sec-title__title tg-element-title">What Our Customers <br>
                                Say <span>About Us</span> </h2>
                        </div>

                        <div class="testimonial-one__carousel owl-carousel owl-theme">
                            <!--Start Testimonial One Single-->
                            <div class="testimonial-one__single">
                                <div class="icon">
                                    <span class="icon-quote1"></span>
                                </div>
                                <div class="testimonial-one__single-inner">
                                    <div class="shape1"><img
                                            src="{{ asset('4/assets/images/shapes/testimonial-v1-shape1.png') }}"
                                            alt=""></div>
                                    <div class="author-box">
                                        <div class="img-box">
                                            <img src="{{ asset('4/assets/images/testimonial/testimonial-v1-img1.png') }}"
                                                alt="">
                                        </div>
                                        <div class="author-info">
                                            <h2>Ronald Richards</h2>
                                            <div class="bottom-text">
                                                <p>MANAGER</p>
                                                <div class="rating-box">
                                                    <i class="icon-star"></i>
                                                    <i class="icon-star"></i>
                                                    <i class="icon-star"></i>
                                                    <i class="icon-star"></i>
                                                    <i class="icon-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-box">
                                        <p>A logistic service provider company plays a pivotal role in the global
                                            supply chain A logistic service provider companyA logistic service
                                            provider company plays a pivotal role in the global supply chain A
                                            logistic service provider company</p>
                                    </div>
                                </div>
                            </div>
                            <!--End Testimonial One Single-->

                            <!--Start Testimonial One Single-->
                            <div class="testimonial-one__single">
                                <div class="icon">
                                    <span class="icon-quote1"></span>
                                </div>
                                <div class="testimonial-one__single-inner">
                                    <div class="shape1"><img
                                            src="{{ asset('4/assets/images/shapes/testimonial-v1-shape1.png') }}"
                                            alt=""></div>
                                    <div class="author-box">
                                        <div class="img-box">
                                            <img src="{{ asset('4/assets/images/testimonial/testimonial-v1-img1.png') }}"
                                                alt="">
                                        </div>
                                        <div class="author-info">
                                            <h2>Ronald Richards</h2>
                                            <div class="bottom-text">
                                                <p>MANAGER</p>
                                                <div class="rating-box">
                                                    <i class="icon-star"></i>
                                                    <i class="icon-star"></i>
                                                    <i class="icon-star"></i>
                                                    <i class="icon-star"></i>
                                                    <i class="icon-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-box">
                                        <p>A logistic service provider company plays a pivotal role in the global
                                            supply chain A logistic service provider companyA logistic service
                                            provider company plays a pivotal role in the global supply chain A
                                            logistic service provider company</p>
                                    </div>
                                </div>
                            </div>
                            <!--End Testimonial One Single-->

                            <!--Start Testimonial One Single-->
                            <div class="testimonial-one__single">
                                <div class="icon">
                                    <span class="icon-quote1"></span>
                                </div>
                                <div class="testimonial-one__single-inner">
                                    <div class="shape1"><img
                                            src="{{ asset('4/assets/images/shapes/testimonial-v1-shape1.png') }}"
                                            alt=""></div>
                                    <div class="author-box">
                                        <div class="img-box">
                                            <img src="{{ asset('4/assets/images/testimonial/testimonial-v1-img1.png') }}"
                                                alt="">
                                        </div>
                                        <div class="author-info">
                                            <h2>Ronald Richards</h2>
                                            <div class="bottom-text">
                                                <p>MANAGER</p>
                                                <div class="rating-box">
                                                    <i class="icon-star"></i>
                                                    <i class="icon-star"></i>
                                                    <i class="icon-star"></i>
                                                    <i class="icon-star"></i>
                                                    <i class="icon-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-box">
                                        <p>A logistic service provider company plays a pivotal role in the global
                                            supply chain A logistic service provider companyA logistic service
                                            provider company plays a pivotal role in the global supply chain A
                                            logistic service provider company</p>
                                    </div>
                                </div>
                            </div>
                            <!--End Testimonial One Single-->
                        </div>
                    </div>
                </div>
                <!--End Testimonial One Content-->


                <!--Start Testimonial One Img-->
                <div class="col-xl-6">
                    <div class="testimonial-one__img">
                        <div class="testimonial-one__img1 reveal">
                            <img src="{{ asset('4/assets/images/testimonial/testimonial-v1-img2.jpg') }}" alt="">
                        </div>

                        <div class="testimonial-one__img-author">
                            <ul>
                                <li>
                                    <div class="img-box"><img
                                            src="{{ asset('4/assets/images/banner/banner-v1-img2.jpg') }}"
                                            alt="#">
                                    </div>
                                </li>
                                <li>
                                    <div class="img-box"><img
                                            src="{{ asset('4/assets/images/banner/banner-v1-img3.jpg') }}"
                                            alt="#">
                                    </div>
                                </li>
                                <li>
                                    <div class="img-box"><img
                                            src="{{ asset('4/assets/images/banner/banner-v1-img4.jpg') }}"
                                            alt="#">
                                    </div>
                                </li>
                            </ul>

                            <div class="text-box">
                                <h2>Customer Satisfied</h2>
                                <p>4.8 (15k Reviews)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Testimonial One Img-->
            </div>
        </div>
    </section> --}}



    <!--Start Blog Two-->
    <section class="blog-three">
        <div class="container">
            <div class="sec-title center text-center tg-heading-subheading animation-style2">
                <div class="sec-title__tagline">
                    <div class="line"></div>
                    <div class="text tg-element-title">
                        <h4 style="#0a0a0a">Latest Blogs</h4>
                    </div>
                    <div class="icon">
                        <span class="icon-plane2 float-bob-x3"></span>
                    </div>
                </div>
                <h2 class="sec-title__title tg-element-title" style="color:#0a0a0a ">Latest Blogs & <span>News</span></h2>
            </div>


            <div class="row">

                @if (count($arts) > 0)
                    @foreach ($arts as $art)
                        <!--Start Blog One Single-->
                        <div class="col-xl-4 col-lg-6 wow fadeInDown" data-wow-delay=".3s">
                            <div class="blog-one__single" style="padding-bottom: 30px;">
                                <div class="blog-one__single-img" style="width: 402px;max-width: 400px;">
                                    <img src="{{ $art->photo }}" alt="">
                                </div>
                                <div class="blog-one__single-content">
                                    <div class="date-box">
                                        @php
                                            $date = \Carbon\Carbon::parse($art->date);
                                        @endphp
                                        <h2>{{ $day = $date->day }}</h2>
                                        <p>{{ $day = $date->month }}</p>
                                    </div>
                                    <div class="blog-one__single-content-inner">
                                        <ul class="meta-box">
                                            <li>
                                                <div class="icon">
                                                    <span class="icon-user"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p><a href="#">Admin</a></p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <span class="icon-chat"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p><a href="#">2 Comment</a></p>
                                                </div>
                                            </li>
                                        </ul>
                                        <h2><a href="{{ route('artsDispaly', $art->slug) }}">{{ $art->title }}" <br>
                                            </a>
                                        </h2>
                                        <div
                                            style="
                                        overflow: hidden;
                                        display: -webkit-box;
                                        -webkit-line-clamp: 2; /* number of lines to show */
                                        line-clamp: 2;
                                        -webkit-box-orient: vertical;
                                    ">
                                            <p>{!! $art->discreption !!} </p>
                                        </div>

                                        <div class="btn-box">
                                            <a class="thm-btn" href="{{ route('artsDispaly', $art->slug) }}">Read More
                                                <i class="icon-right-arrow21"></i>
                                                <span class="hover-btn hover-bx"></span>
                                                <span class="hover-btn hover-bx2"></span>
                                                <span class="hover-btn hover-bx3"></span>
                                                <span class="hover-btn hover-bx4"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Blog One Single-->
                    @endforeach
                @endif
            </div>

            {{--
            <div class="row">
                <!--Start Blog Two Single-->
                @if (count($arts) > 0)
                    @foreach ($arts as $key => $artssingle)
                        <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="00ms">
                            <div class="blog-three__single">
                                <div class="blog-three__single-img">
                                    <div class="inner">
                                        <img src="{{ $artssingle->photo }}" alt="">
                                        <img src="{{ $artssingle->photo }}" alt="">
                                    </div>
                                </div>

                                <div class="blog-three__single-content">
                                    <ul class="meta-box">
                                        <li><i class="icon-user"></i> Admin</li>
                                        <li class="bg2"><i class="icon-clock"></i> @php
                                            $date = \Carbon\Carbon::parse($artssingle->date);
                                        @endphp
                                            <p> {{ $date->day }},{{ $date->month }},{{ $date->year }} </p>

                                        </li>
                                    </ul>

                                    <h2><a
                                            href="{{ route('artsDispaly', $artssingle->slug) }}">{{ $artssingle->title }}</a>
                                    </h2>
                                    <p>{!! $artssingle->discreption !!}</p>

                                    <div class="btn-box">
                                        <a class="thm-btn" href="{{ route('artsDispaly', $artssingle->slug) }}">Read More
                                            <i class="icon-right-arrow21"></i>
                                            <span class="hover-btn hover-bx"></span>
                                            <span class="hover-btn hover-bx2"></span>
                                            <span class="hover-btn hover-bx3"></span>
                                            <span class="hover-btn hover-bx4"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Blog Two Single-->
                    @endforeach
                @endif

            </div> --}}


        </div>
    </section>
    <!--End Blog Two-->



@endsection
