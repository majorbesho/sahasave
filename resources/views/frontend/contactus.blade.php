@extends('frontend.layouts.master')


@section('content')
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg)">
        </div>
        <div class="page-header__pattern"><img src="assets/images/pattern/page-header-pattern.png" alt=""></div>
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
                                        <h4>Contact us</h4>
                                    </div>
                                    <div class="icon">
                                        <span class="icon-plane2 float-bob-x3"></span>
                                    </div>
                                </div>
                                <h2 class="sec-title__title tg-element-title">Get in Touch And We’ll <br> Help Your
                                    Business
                                </h2>
                            </div>

                            <div class="contact-page__top-content-text1">
                                <p>Our dedicated team of experts is here to guide you through every step of the
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
                                            <div class="select-box">
                                                <select class="selectmenu wide">
                                                    <option selected="selected">Subject</option>
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
                                        <div class="input-box">
                                            <textarea name="message" placeholder="Message"></textarea>
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

                                <p>Mailing Address: 22528 104Th Ave Se Ste 103, Kent WA 98030-6439
                                    <br> USA
                            </div>
                        </li>

                        <li class="contact-page__bottom-single">
                            <div class="icon">
                                <span class="icon-clock2"></span>
                            </div>
                            <div class="content">
                                <h2>Working Hours</h2>
                                <p>Wednesday - Sunday <br> 7:00 AM - 5:00 PM</p>
                            </div>
                        </li>

                        <li class="contact-page__bottom-single">
                            <div class="icon">
                                <span class="icon-email"></span>
                            </div>
                            <div class="content">
                                <h2>Email</h2>
                                <p>
                                    <a href="mailto:support@logistra.com">support@logistra.com</a> <br>
                                    <a href="mailto:info@logistra.com">info@logistra.com</a>
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

                                    <a href="tel:+13606374225">+1 (360) 637
                                        -4225</a> <br>
                                    <a href="tel:+971509257500">+971509257500</a>
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
    <section class="google-map-one">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d6209.242755903148!2d-77.04363602434464!3d38.90977276948481!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1394992895496"
            class="google-map-one__map">
        </iframe>
    </section>
    <!--End Google Map One-->
@endsection
