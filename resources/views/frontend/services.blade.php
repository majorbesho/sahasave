@extends('frontend.layouts.master')
@section('title', __('seo.services.title'))
@section('meta_description', __('seo.services.description'))

@section('content')
    <!--Start Page Header-->
    <section class="page-header">
        <div class="page-header__bg"
            style="background-image: url({{ asset('4/assets/images/backgrounds/Downpic.cc-1303342297.jpg') }})">
        </div>
        <div class="page-header__pattern"><img src="{{ asset('4/assets/images/pattern/contact-page-top-pattern.png') }}"
                alt="" width="200" height="200"></div>
        <div class="container">
            <div class="page-header__inner">
                <h1>Service</h1>
                <ul class="thm-breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span class="icon-right-arrow21"></span></li>
                    <li>Service</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Header-->

    <!--Start Service One-->
    <section class="service-one service-one--service" style="background: #fff;padding-bottom: 5px">
        <div class="container">
            <div class="row">
                <!--Start Service One Single-->
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInLeft paddingservices" data-wow-delay="0ms"
                    data-wow-duration="1500ms">
                    <div class="service-one__single">
                        <div class="service-one__single-inner">
                            <div class="service-one__single-img">
                                <mg src="{{ asset('4/images/services/services-v1-img1.jpg') }}" alt="#">
                            </div>

                            <div class="service-one__single-content">
                                <h2><a href="#">Fast Load </a></h2>
                                <p>A logistic service provider company plays
                                    You Can Load Your special load .</p>
                                <div class="btn-box">
                                    {{-- <a href="international-transport.">Booking Now <span
                                            class="icon-right-arrow21"></span></a> --}}
                                </div>
                            </div>
                        </div>

                        <div class="icon">
                            <span class="icon-delivery-man"></span>
                        </div>
                    </div>
                </div>
                <!--End Service One Single-->

                <!--Start Service One Single-->
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInRight paddingservices" data-wow-delay="0ms"
                    data-wow-duration="1500ms">
                    <div class="service-one__single">
                        <div class="service-one__single-inner">
                            <div class="service-one__single-img">
                                <mg src="{{ asset('4/images/services/services-v1-img2.jpg') }}" alt="#">
                            </div>

                            <div class="service-one__single-content">
                                <h2><a href="{{ route('supplier.register1.form') }}">Become A Seller</a></h2>
                                <p>Register Your Truck For Free</p>
                                <div class="btn-box">
                                    <a href="{{ route('newreg') }}">Register Now <span
                                            class="icon-right-arrow21"></span></a>
                                </div>
                            </div>
                        </div>

                        <div class="icon">
                            <span class="icon-shipment"></span>
                        </div>
                    </div>
                </div>
                <!--End Service One Single-->

                <!--Start Service One Single-->
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInLeft paddingservices" data-wow-delay="0ms"
                    data-wow-duration="1500ms">
                    <div class="service-one__single">
                        <div class="service-one__single-inner">
                            <div class="service-one__single-img">
                                <mg src="{{ asset('4/images/services/services-v1-img3.jpg') }}" alt="#">
                            </div>

                            <div class="service-one__single-content">
                                <h2><a href="#">International Transport</a></h2>
                                <p>Add Loading From Any to Any .</p>
                                <div class="btn-box">
                                    {{-- <a href="international-transport.">Read More <span
                                            class="icon-right-arrow21"></span></a> --}}
                                </div>
                            </div>
                        </div>

                        <div class="icon">
                            <span class="icon-international-shipping"></span>
                        </div>
                    </div>
                </div>
                <!--End Service One Single-->

                <!--Start Service One Single-->
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInLeft paddingservices" data-wow-delay="0ms"
                    data-wow-duration="1500ms">
                    <div class="service-one__single">
                        <div class="service-one__single-inner">
                            <div class="service-one__single-img">
                                <mg src="{{ asset('4/images/services/services-v1-img1.jpg') }}" alt="#">
                            </div>

                            <div class="service-one__single-content">
                                <h2><a href="#">Safe Transport</a></h2>
                                <p>A logistic service provider company plays
                                    a pivotal role in the global supply chain logistic service.</p>
                                <div class="btn-box">
                                    {{-- <a href="international-transport.">Read More <span
                                            class="icon-right-arrow21"></span></a> --}}
                                </div>
                            </div>
                        </div>

                        <div class="icon">
                            <span class="icon-ship-1"></span>
                        </div>
                    </div>
                </div>
                <!--End Service One Single-->

                <!--Start Service One Single-->
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInRight paddingservices" data-wow-delay="0ms"
                    data-wow-duration="1500ms">
                    <div class="service-one__single">
                        <div class="service-one__single-inner">
                            <div class="service-one__single-img">
                                <mg src="{{ asset('4/images/services/services-v1-img2.jpg') }}" alt="#">
                            </div>

                            <div class="service-one__single-content">
                                <h2><a href="#">Warehouse Facility</a></h2>
                                <p>A logistic service provider company plays
                                    a pivotal role in the global supply chain logistic service.</p>
                                <div class="btn-box">
                                    {{-- <a href="international-transport.">Read More <span
                                            class="icon-right-arrow21"></span></a> --}}
                                </div>
                            </div>
                        </div>

                        <div class="icon">
                            <span class="icon-storehouse"></span>
                        </div>
                    </div>
                </div>
                <!--End Service One Single-->

                <!--Start Service One Single-->
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInLeft paddingservices" data-wow-delay="0ms"
                    data-wow-duration="1500ms">
                    <div class="service-one__single">
                        <div class="service-one__single-inner">
                            <div class="service-one__single-img">
                                <mg src="{{ asset('4/images/services/services-v1-img3.jpg') }}" alt="#">
                            </div>

                            <div class="service-one__single-content">
                                <h2><a href="#">Fast Transport</a></h2>
                                <p>A logistic service provider company plays
                                    a pivotal role in the global supply chain logistic service.</p>
                                <div class="btn-box">
                                    {{-- <a href="international-transport.">Booking Now <span
                                            class="icon-right-arrow21"></span></a> --}}
                                </div>
                            </div>
                        </div>

                        <div class="icon">
                            <span class="icon-humanitarian-aid"></span>
                        </div>
                    </div>
                </div>
                <!--End Service One Single-->
            </div>
        </div>
    </section>
    <!--End Service One-->


    <section class="about-one" style="background:#fff;padding-top: 5px;padding-bottom: 5px">
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
                                <span>SehaSave.com
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
                                <a class="thm-btn"
                                    href="https://www.youtube.com/embed/LIf6hI3-hJ0?si=umbRfO9-ajVpmNsz">More
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



                                    <h4><a href="tel:13606374225">+1 (360) 637
                                            -4225 </a></h4>
                                    <h4><a href="tel:971509257500">+971509257500 </a></h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End About One Content-->

                <!--Start About One Img-->
                <div class="col-xl-5">
                    <div class="about-one__img">
                        <div class="shape1 float-bob-y"><img
                                src="{{ asset('4/assets/images/shapes/about-v1-shape1.png') }}" alt="">
                        </div>
                        <div class="shape2 float-bob-y"><img
                                src="{{ asset('4/assets/images/shapes/about-v1-shape2.png') }}" alt="">
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


    <section class="quote-one" style="padding-bottom: 2%">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div
                        class="{{ app()->getLocale() === 'ar' ? 'nonetext' : 'sec-title  tg-heading-subheading' }}   center text-center  animation-style2">
                        <div class="{{ app()->getLocale() === 'ar' ? 'nonetext' : 'sec-title__tagline' }}">
                            <div class="line"></div>
                            <div class="text tg-element-title" style="">

                                <h4 class="font-size:20px "> {{ __('index.Shipping') }}</h4>
                            </div>
                            <div class="icon">
                                <span class="icon-plane2 float-bob-x3"></span>
                            </div>
                        </div>
                        <h2 class="sec-title__title tg-element-title"><span
                                style="color: #0a0a0a">{{ __('index.Request A Quote') }}</span>
                        </h2>
                    </div>


                    <div class="row quote-tab wow fadeInUp" data-wow-delay="100ms">
                        <div class="container">
                            <div class="row">
                                <div class="service-one__carousel owl-carousel owl-theme owl-dot-style1">
                                    <!--Start Service One Single-->

                                    <div class="service-one__single">
                                        <div class="service-one__single-inner">
                                            <div class="service-one__single-img"
                                                style="
                                            max-width: 350px;">
                                                <img src="{{ asset('4/assets/images/services/services-v1-img1.jpg') }}"
                                                    alt="#">
                                            </div>

                                            <div class="service-one__single-content">
                                                <h2><a href="{{ route('getrequestforQuote') }}">{{ __('index.Request A Quote') }}
                                                    </a></h2>
                                                <p>{{ __('index.Request A index.Request A Quotetext') }}</p>
                                                <div class="btn-box">
                                                    <a href="{{ route('getrequestforQuote') }}">{{ __('index.Request A Quote') }}
                                                        <span class="icon-right-arrow21"></span></a>
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
                                                <h2><a href="{{ route('gaddyourload') }}">{{ __('index.Add your Loads') }}
                                                    </a></h2>
                                                <p>{{ __('index.Add your Load (shipment-package) A Quote') }}
                                                </p>
                                                <div class="btn-box">
                                                    <a href="{{ route('gaddyourload') }}">{{ __('index.Add your Loads') }}<span
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
                                                <h2><a href="{{ route('gaddyourload') }}">{{ __('index.Add your Truck') }}
                                                    </a></h2>
                                                <p>{{ __('index.Add your Truck') }}</p>
                                                <div class="btn-box">
                                                    <a href="{{ route('gaddyourload') }}">{{ __('index.Add your Truck') }}
                                                        <span class="icon-right-arrow21"></span></a>
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
                                                <h2><a href="{{ route('supplier.register1.form') }}">{{ __('index.Become a partner') }}
                                                    </a></h2>
                                                <p>{{ __('index.Become a partner') }}</p>
                                                <div class="btn-box">
                                                    <a href="{{ route('supplier.register1.form') }}">{{ __('index.Become a partner') }}<span
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
                                                <h2><a href="{{ route('supplier.register1.form') }}">{{ __('index.Search Load OR Vehicale') }}
                                                    </a></h2>
                                                <p> {{ __('index.Search Load OR Vehicale') }}
                                                </p>
                                                <div class="btn-box">
                                                    <a href="{{ route('supplier.register1.form') }}">{{ __('index.Search Load OR Vehicale') }}<span
                                                            class="icon-right-arrow21"></span></a>
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



    <!--Start Why Choose One-->
    {{-- <section class="why-choose-one " style="padding-bottom: 22px">
        <div class="why-choose-one__pattern">
            <mg src="{{ asset('4/images/pattern/why-choose-v1-pattern.png') }}" alt="">
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
                            <h2 class="sec-title__title tg-element-title">Efficient, Safe, & Swift <br> Logistics
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
                <div class="col-xl-6">
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
                                                        style="background: #Fabc3f;color: #fff">

                                                    <input type="text" readonly="" class="max"
                                                        style="background: #Fabc3f;color: #fff">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="input-box">
                                        <div class="select-box">
                                            <select class="selectmenu wide">
                                                <option selected="selected">SehaSave.com Type</option>
                                                <option>SehaSave.com Type 01</option>
                                                <option>SehaSave.com Type 02</option>
                                                <option>SehaSave.com Type 03</option>
                                                <option>SehaSave.com Type 04</option>
                                                <option>SehaSave.com Type 05</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="input-box">
                                        <div class="select-box">
                                            <select class="selectmenu wide">
                                                <option selected="selected">Load</option>
                                                <option>SehaSave.com Type 01</option>
                                                <option>SehaSave.com Type 02</option>
                                                <option>SehaSave.com Type 03</option>
                                                <option>SehaSave.com Type 04</option>
                                                <option>SehaSave.com Type 05</option>
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
                </div>
                <!--End Why Choose One Form-->
            </div>
        </div>
    </section> --}}
    <!--End Why Choose One-->




    <!--Start Testimonial One-->
    <section class="testimonial-one" style="background: #fff">
        <div class="testimonial-one__pattern"
            style="background-image: url({{ asset('4/assets/images/pattern/testimonial-v1-pattern.png') }});"></div>
        <div class="container">
            <div class="row">
                <!--Start Testimonial One Content-->
                <div class="col-xl-6">
                    <div class="testimonial-one__content">
                        <div class="big-title">
                            <h2>TESTIMONIALS</h2>
                        </div>
                        <div class="sec-title tg-heading-subheading animation-style2">
                            <div class="sec-title__tagline">
                                <div class="line"></div>
                                <div class="text tg-element-title">
                                    <h4 style="color: #Fabc3f">Client Testimonial</h4>
                                </div>
                                <div class="icon">
                                    <span class="icon-plane2 float-bob-x3"></span>
                                </div>
                            </div>
                            <h2 class="sec-title__title tg-element-title">What Our Customers <br>
                                Say <span>About Us</span> </h2>
                        </div>

                        <div class="testimonial-one__carousel owl-carousel owl-theme" style="background: #fff">
                            <!--Start Testimonial One Single-->
                            <div class="testimonial-one__single">
                                <div class="icon">
                                    <span class="icon-quote1"></span>
                                </div>
                                <div class="testimonial-one__single-inner">
                                    <div class="shape1">
                                        <mg src="{{ asset('4/images/shapes/testimonial-v1-shape1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="author-box">
                                        <div class="img-box">
                                            <mg src="{{ asset('4/images/testimonial/testimonial-v1-img1.png') }}"
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
                                    <div class="shape1">
                                        <mg src="{{ asset('4/images/shapes/testimonial-v1-shape1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="author-box">
                                        <div class="img-box">
                                            <mg src="{{ asset('4/images/testimonial/testimonial-v1-img1.png') }}"
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
                                    <div class="shape1">
                                        <mg src="{{ asset('4/images/shapes/testimonial-v1-shape1.png') }}"
                                            alt="">
                                    </div>
                                    <div class="author-box">
                                        <div class="img-box">
                                            <mg src="{{ asset('4/images/testimonial/testimonial-v1-img1.png') }}"
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
                            <mg src="{{ asset('4/images/testimonial/testimonial-v1-img2.jpg') }}" alt="">
                        </div>

                        <div class="testimonial-one__img-author">
                            <ul>
                                <li>
                                    <div class="img-box">
                                        <mg src="{{ asset('4/images/banner/banner-v1-img2.jpg') }}" alt="#">
                                    </div>
                                </li>
                                <li>
                                    <div class="img-box">
                                        <mg src="{{ asset('4/images/banner/banner-v1-img3.jpg') }}" alt="#">
                                    </div>
                                </li>
                                <li>
                                    <div class="img-box">
                                        <mg src="{{ asset('4/images/banner/banner-v1-img4.jpg') }}" alt="#">
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
    </section>
    <!--End Testimonial One-->
@endsection
