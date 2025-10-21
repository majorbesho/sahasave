@extends('frontend.layouts.master')


@section('content')



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
                <h2>Blog & News</h2>
                <ul class="thm-breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span class="icon-right-arrow21"></span></li>
                    <li>Blog & News</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Header-->


    <!--Start Blog Page-->
    <section class="blog-page" style=" background: #fff;">
        <div class="container">
            <div class="row">

                @if (count($arts) > 0)
                    @foreach ($arts as $art)
                        <!--Start Blog One Single-->
                        <div class="col-xl-4 col-lg-6 wow fadeInDown" data-wow-delay=".3s">
                            <div class="blog-one__single" style="padding-bottom: 30px;">
                                <div class="blog-one__single-img" style=" max-width: 400px;     height: 274px;">
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
                                        <h2
                                            style=" overflow: hidden;
                                        display: -webkit-box;
                                        -webkit-line-clamp: 2; /* number of lines to show */
                                        line-clamp: 2;
                                        -webkit-box-orient: vertical;">
                                            <a href="{{ route('artsDispaly', $art->slug) }}">{{ $art->title }}" <br> </a>
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
            <ul class="styled-pagination text-center clearfix">
                <li class="arrow prev active"><a href="#"><span class="icon-right-arrow3"></span></a>
                </li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li class="arrow next"><a href="#"><span class="icon-right-arrow31"></span></a>
                </li>
            </ul>
        </div>
    </section>


@endsection
