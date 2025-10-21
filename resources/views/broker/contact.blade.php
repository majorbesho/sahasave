@extends('frontend.layouts.master')


@section('content')
    <!-- Ec Contact Us page -->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{ asset('4/assets/images/7xm.xyz674359.jpg') }})">
        </div>
        <div class="page-header__pattern"><img src="{{ asset('4/assets/images/pattern/page-header-pattern.png') }}"
                alt=""></div>
        <div class="container">
            <div class="page-header__inner">
                <h2>Contact Us</h2>
                <ul class="thm-breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li><span class="icon-right-arrow21"></span></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Header-->

    <!--Start Contact Page-->
    <section class="contact-page">
        <!--Start Contact Page Top-->
        <div class="contact-page__top">
            <div class="contact-page__top-pattern"
                style="background-image: url(assets/images/pattern/contact-page-top-pattern.png);"></div>
            <div class="container">
                <div class="row">
                    <!--Start Contact Page Top Content-->
                    <div class="col-xl-6">
                        <div class="contact-page__top-content">
                            <div class="sec-title tg-heading-subheading animation-style2">
                                <div class="sec-title__tagline">
                                    <div class="line"></div>
                                    <div class="text tg-element-title">
                                        <h4 style="color: #Fabc3f">Contact us</h4>
                                    </div>
                                    <div class="icon">
                                        <span class="icon-plane2 float-bob-x3"></span>
                                    </div>
                                </div>
                                <h6 class="sec-title__title tg-element-title">
                                    “Reach out to us, and let's grow your business.”
                                </h6>
                            </div>

                            <div class="contact-page__top-content-text1">
                                <p style="color: #Fabc3f">Our dedicated team of experts is here to guide you through every
                                    step of the
                                    insurance journey, ensuring you make informed choices tailored to your uniq
                                    needs choices tailored to your unique needs. </p>
                            </div>

                            <div class="social-links">
                                <a href="#"><span class="icon-facebook-f"></span></a>
                                <a href="#"><span class="icon-instagram"></span></a>
                                <a href="#"><span class="icon-twitter"></span></a>
                                <a href="#"><span class="icon-linkedin"></span></a>
                            </div>
                        </div>
                    </div>
                    <!--End Contact Page Top Content-->

                    <!--Start Contact Page Top Form-->
                    <div class="col-xl-6">
                        <div class="contact-page__top-form">
                            <form class="contact-form-validated why-choose-one__form" action="assets/inc/sendemail.php"
                                method="post" novalidate="novalidate">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="input-box">
                                            <input type="text" name="name" placeholder="Name" required=""
                                                style="
                                            background: #e8f0fe;
                                        ">
                                            <div class="icon"><span class="icon-user"></span></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="input-box">
                                            <input type="email" name="email" placeholder="Email"
                                                required=""style="
                                                                                                                                                                background: #e8f0fe;
                                                                                                                                                            ">
                                            <div class="icon"><span class="icon-email"></span></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="input-box">
                                            <input type="text" name="Phone" placeholder="Phone"
                                                required=""style="
                                                                                                                                                                background: #e8f0fe;
                                                                                                                                                            ">
                                            <div class="icon"><span class="icon-phone2"></span></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="input-box">
                                            <div class="select-box">
                                                <input type="text" name="Subject" placeholder="Subject"
                                                    required=""style="
                                                                                                                                                                background: #e8f0fe;
                                                                                                                                                            ">
                                                {{-- <select class="selectmenu wide">
                                                    <option selected="selected">Subject</option>
                                                    <option>SahaSave.com Type 01</option>
                                                    <option>SahaSave.com Type 02</option>
                                                    <option>SahaSave.com Type 03</option>
                                                    <option>SahaSave.com Type 04</option>
                                                    <option>SahaSave.com Type 05</option>
                                                </select> --}}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-xl-12">
                                        <div class="input-box">
                                            <textarea name="message" placeholder="Message"
                                                style="
                                            background: #e8f0fe;
                                        "></textarea>
                                            <div class="icon style2"><span class="icon-pen"></span></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="why-choose-one__form-btn">
                                            <button type="submit" class="thm-btn">
                                                Submit Now
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
                    <!--End Contact Page Top Form-->
                </div>
            </div>
        </div>
        <!--End Contact Page Top-->

        <!--Start Contact Page Bottom-->
        <div class="contact-page__bottom">
            <div class="container">
                <div class="contact-page__bottom-inner">
                    <ul class="list-unstyled">
                        <li class="contact-page__bottom-single">
                            <div class="icon">
                                <span class="icon-address"></span>
                            </div>
                            <div class="content">
                                <h2>Location</h2>
                                <p>Al Goze 1 <br> , sh. Sheikh Zayed Road, Dubai, UAE.</p>
                            </div>
                        </li>

                        <li class="contact-page__bottom-single">
                            <div class="icon">
                                <span class="icon-clock2"></span>
                            </div>
                            <div class="content">
                                <h2>Working Hours</h2>
                                <p>24/7/365 </p>
                            </div>
                        </li>

                        <li class="contact-page__bottom-single">
                            <div class="icon">
                                <span class="icon-email"></span>
                            </div>
                            <div class="content">
                                <h2>Email</h2>
                                <p>
                                    <a href="mailto:info@SahaSave.com">info@SahaSave.com</a> <br>
                                    <a href="mailto:support@SahaSave.com">support@SahaSave.com</a>
                                </p>
                            </div>
                        </li>

                        <li class="contact-page__bottom-single">
                            <div class="icon">
                                <span class="icon-phone"></span>
                            </div>
                            <div class="content">
                                <h2>Phones</h2>
                                <p>

                                    <a href="tel:13606374225">+1 (360) 637
                                        -4225</a> <br>
                                    <a href="tel:971509257500">+971509257500</a>
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--End Contact Page Bottom-->
    </section>
    <!--End Contact Page-->

    <!--Start Google Map One-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <section class="google-map-one">
                    <iframe
                        src="https://www.google.com/maps/embed/v1/place?q=22528+104Th+Ave+Se+Ste+103,+Kent+WA+98030-6439++USA&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"
                        class="google-map-one__map">
                    </iframe>
                </section>
            </div>
            <div class="col-lg-6 col-md-12">
                <section class="google-map-one">
                    <iframe
                        src="https://www.google.com/maps/embed/v1/place?q=Al+Goze+1,+sh.+Sheikh+Zayed Road&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"
                        class="google-map-one__map">
                    </iframe>
                </section>
            </div>
        </div>
    </div>
    {{-- <section class="google-map-one">
        <iframe
            src="https://www.google.com/maps/embed/v1/place?q=Al+Goze+1,+sh.+Sheikh+Zayed Road&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"
            class="google-map-one__map">
        </iframe>
    </section> --}}
    <!--End Google Map One-->
@endsection
