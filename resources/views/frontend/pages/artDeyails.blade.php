@extends('frontend.layouts.master')


@section('content')
    <style>
        .blog-one__single-content-inner .meta-box li .text-box p a {
            color: ;
        }

        .blog-page {
            position: relative;
            display: block;
            background: #fff;
            padding: 120px 0px 120px;
            z-index: 1;
        }

        p {
            color: #062E39
        }
    </style>
    <!-- Main Content -->
    <div class="stricky-header stricky-header--style1 stricked-menu main-menu">
        <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
    </div><!-- /.stricky-header -->

    <!--Start Page Header-->
    <section class="page-header">
        <div class="page-header__bg"
            style="background-image: url({{ asset('4/assets/images/backgrounds/page-header-bg.jpg') }})">
        </div>
        <div class="page-header__pattern"><img src="{{ asset('4/assets/images/pattern/page-header-pattern.png') }}"
                alt=""></div>
        <div class="container">
            <div class="page-header__inner">
                <h2>{{ $artsUrls->title }}</h2>
                <ul class="thm-breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span class="icon-right-arrow21"></span></li>
                    <li>{{ $artsUrls->title }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Header-->

    <!--Start Blog Details-->
    <section class="blog-details" style=" ">
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <div class="blog-details__content">
                        <div class="blog-details__content-img1">
                            <div class="inner">
                                <img src="{{ $artsUrls->photo }}" alt="{{ $artsUrls->slug }}" style="border-radius: 10%;">
                            </div>
                        </div>

                        <div class="blog-details__content-meta-box">
                            <ul>
                                <li>
                                    <div class="img-box">
                                        <img src="{{ $artsUrls->photo }}" alt="{{ $artsUrls->slug }}">
                                    </div>

                                    <div class="text-box">
                                        <p style="color: #062E39">BY-Admin</p>
                                    </div>
                                </li>

                                <li>

                                    @php
                                        $date = \Carbon\Carbon::parse($artsUrls->date);
                                    @endphp

                                    <div class="icon">
                                        <span class="icon-calendar"></span>
                                    </div>

                                    <div class="text-box">
                                        <p style="color: #062E39">
                                            {{ $date->day }},{{ $date->month }},{{ $date->year }} </p>
                                    </div>
                                </li>

                                <li>
                                    <div class="icon">
                                        <span class="icon-chat"></span>
                                    </div>

                                    <div class="text-box">
                                        <p style="color: #062E39">Comment(5)</p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="blog-details__content-text1">
                            <h2 style="color: #062E39">{{ $artsUrls->title }}</h2>
                            <p style="color: #062E39">{!! $artsUrls->discreption !!}</p>
                        </div>

                        <div class="blog-details__content-img2">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="single-img">
                                        <img src="{{ $artsUrls->photo }}" alt="">
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="single-img">
                                        <img src="{{ $artsUrls->photo }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="blog-details__content-text5">
                            <div class="blog-details__content-text5-tag">
                                <div class="title-box">
                                    <h2 style="color: #062E39">Tags:</h2>
                                </div>

                                <ul>
                                    <li><a href="#"style="color: #062E39">#Logistics</a></li>
                                    <li><a href="#"style="color: #062E39">#Transport</a></li>
                                </ul>
                            </div>


                            <div class="blog-details__content-text5-share">
                                <div class="title-box">
                                    <p style="color: #062E39">Share Now</p>
                                </div>

                                <ul>
                                    <li><a href="#"><span class="icon-facebook-f"></span></a></li>
                                    <li><a href="#"><span class="icon-instagram"></span></a></li>
                                    <li><a href="#"><span class="icon-twitter"></span></a></li>
                                    <li><a href="#"><span class="icon-linkedin"></span></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="blog-details__content-text6">
                            <div class="img-box">
                                <img src="{{ asset('4/assets/images/blog/blog-details-img5.jpg') }}" alt="">
                            </div>


                        </div>

                        <div class="comment-one">
                            <div class="title-box">
                                <h2 style="color: #062E39">2 Comments</h2>
                            </div>

                            <div class="comment-one__single">
                                <div class="comment-one__single-inner">
                                    <div class="comment-one__img">
                                        <img src="{{ asset('4/assets/images/blog/blog-details-img6.jpg') }}"
                                            alt="">
                                    </div>

                                    <div class="comment-one__content">
                                        <div class="comment-one__content-title">
                                            <h2 style="color: #062E39">Cameron Williamson</h2>
                                            <p style="color: #062E39">3 Hours Ago</p>
                                        </div>

                                        <p style="color: #062E39">
                                            Your team's brilliance, determination, and confidence will drive you to
                                            conquer new frontiers; greatness lies within you. greatnes lies.
                                        </p>

                                        <div class="btn-box">
                                            <a href="#" style="color: #062E39">Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="comment-one__single style2">
                                <div class="comment-one__single-inner">
                                    <div class="comment-one__img">
                                        <img src="{{ asset('4/assets/images/blog/blog-details-img7.jpg') }}"
                                            alt="">
                                    </div>

                                    <div class="comment-one__content">
                                        <div class="comment-one__content-title">
                                            <h2 style="color: #062E39">Jons kihan</h2>
                                            <p style="color: #062E39">3 Hours Ago</p>
                                        </div>

                                        <p style="color: #062E39"> Your team's brilliance, determination, and confidence
                                            will drive you to
                                            conquer new frontiers; greatness lies within you. greatnes lies within w
                                            ill driveYour team's brilliance</p>

                                        <div class="btn-box">
                                            <a href="#">Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="comment-form">
                            <div class="title-box">
                                <h2 style="color: #062E39">Leave a Reply</h2>
                                <p style="color: #062E39">Your email address will not be published. Required fields are
                                    marked *</p>
                            </div>

                            <form class="contact-form-validated why-choose-one__form" action="assets/inc/sendemail.php"
                                method="post" novalidate="novalidate">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="input-box">
                                            <input type="text" name="name" placeholder="Name" required=""
                                                style="color: #062E39">
                                            <div class="icon"><span class="icon-user"></span></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="input-box">
                                            <input type="email" name="email" placeholder="Email" required=""
                                                style="color: #062E39">
                                            <div class="icon"><span class="icon-email"></span></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="input-box">
                                            <textarea name="message" placeholder="Message"></textarea>
                                            <div class="icon style2"><span class="icon-pen"></span></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="comment-form__checkbox">
                                            <input type="checkbox" name="agree " id="agree" checked="">
                                            <label for="agree" style="color: #062E39"><span></span>Save my name, email,
                                                and website in this
                                                browser for the next time I comment.</label>
                                        </div>
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
                </div>


            </div>
        </div>
    </section>
@endsection
