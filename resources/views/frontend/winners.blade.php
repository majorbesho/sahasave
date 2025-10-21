@extends('frontend.layouts.master')


@section('content')
    <!-- inner-hero-section end -->
    <section class="inner-hero-section style--four">
        <div class="bg-shape"><img src="{{asset('frontend4/assets/images/elements/inner-hero-shape-2.png')}}" alt="image"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="inner-page-content">
                        <h2 class="title">Never miss a draw!</h2>
                        <p>Easy way to buy tickets and win your dream car</p>
                        <p>many others anytime, anywhere</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- inner-hero-section end -->




    <section class="winner">
        <div class="container">
            <div class="row">

                <div class="pattern0 fireworks fire0">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div>
                <div class="pattern1 fireworks fire1">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div>
                {{-- <div class="pattern2 fireworks fire2">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div>
                <div class="pattern3 fireworks fire3">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div>
                <div class="pattern4 fireworks fire4">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div>
                <div class="pattern5 fireworks fire5">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div>
                <div class="pattern6 fireworks fire6">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div>
                <div class="pattern7 fireworks fire7">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div>
                <div class="pattern8 fireworks fire8">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div>
                <div class="pattern9 fireworks fire9">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div>
                <div class="pattern10 fireworks fire10">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div>
                <div class="pattern11 fireworks fire11">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div>
                <div class="pattern12 fireworks fire12">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div>
                <div class="pattern13 fireworks fire13">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div>
                <div class="pattern14 fireworks fire14">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div> --}}
                {{-- <div class="pattern15 fireworks fire15">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div>
                <div class="pattern16 fireworks fire16">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div>
                <div class="pattern17 fireworks fire17">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div>
                <div class="pattern18 fireworks fire18">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div>
                <div class="pattern19 fireworks fire19">
                    <div class="ring_1"></div>
                    <div class="ring_2"></div>
                </div> --}}

            </div>
        </div>
    </section>


    <!-- winner details section start -->
    <section class="mt-minus-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="winner-details-wrapper bg_img"
                        data-background="{{ asset('frontend4/assets/images/elements/winner-details.jpg') }}">
                        <div class="left"><img src="{{ asset('frontend4/assets/images/contest/1.png') }}" alt="image">
                        </div>
                        <div class="body">
                            <p class="contest-number">Contest No: B2T</p>
                            <p class="contest-date"><span>Draw took place on :</span> Saturday May 20, 2023</p>
                            <div class="line"></div>
                            <h4 class="title">Latest bigest Winning Numbers:</h4>
                            {{-- <ul class="numbers">
                                <li>11</li>
                                <li>88</li>
                                <li>23</li>
                                <li>9</li>
                                <li>19</li>
                                <li>26</li>
                                <li>87</li>
                            </ul> --}}
                            <div class="btn-grp">
                                <a href="#0" class="btn-border">Alerts</a>
                                <a href="#0" class="btn-border">How to Claim</a>
                            </div>
                        </div>
                        <div class="right"><img src="{{ asset('frontend4/assets/images/contest/7.png') }}" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>







    <!-- inner-hero-section end -->

    <!-- winner details section start -->

    <!-- winner details section end -->


    <!-- video section start -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                {{-- <ul class="page-list">
                <li><a href="index.html">Home</a></li>
                <li><a href="#0">Lottery</a></li>
                <li><a href="#0">Contest No: B2T</a></li>
                <li class="active">Pick your Lottery Number</li>
            </ul> --}}
            </div>
        </div>
    </div>




    <section class="buy-ticket-section">
        <div class="winner-obj"><img src="{{ asset('frontend4/assets/images/elements/winner-obj.png') }}" alt="image">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 text-lg-start text-center">
                    <div class="section-header">
                        <span class="section-sub-title">Dream Big Play Small</span>
                        <h2 class="section-title font-weight-bold">Will you be the next Winner?</h2>
                        <p>Playing the lottery is something many of us do to bring a bit of excitement to our day-to-day
                            routine.</p>
                    </div>
                    <div class="buy-btn-wrapper">
                        <span>Don't miss out! Next draw</span>
                        <img src="{{ asset('frontend4/assets/images/elements/arrow.png') }}" alt="image"
                            class="arrow">
                        <a href="#0" class="cmn-btn">buy ticket now!</a>
                    </div>
                </div>
            </div>
            <div class="row winner-stat-wrapper">
                <div class="col-lg-8 text-lg-start text-center">
                    <h3 class="font-weight-normal winner-stat-wrapper__title">Let the Number Speak for Us</h3>
                    <div class="row mb-none-30">
                        <div class="col-sm-6 mb-30">
                            <div class="counter-item style--three text-center">
                                <div class="counter-item__content">
                                    <span>23</span>
                                    <p>Last Month Winners</p>
                                </div>
                            </div>
                            <!-- counter-item end -->
                        </div>
                        <div class="col-sm-6 mb-30">
                            <div class="counter-item style--three text-center">
                                <div class="counter-item__content">
                                    <span>2837K</span>
                                    <p>Tickets Sold</p>
                                </div>
                            </div>
                            <!-- counter-item end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <div class="pb-120 mt-minus-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="video-wrapper bg_img"
                        data-background="{{ asset('frontend4/assets/images/elements/video-bg.jpg') }}"
                        style="margin-top: 5%">
                        <a class="cmn-btn text-capitalize" href="https://www.youtube.com/embed/d6xn5uflUjg"
                            data-rel="lightcase:myCollection">watch video <i class="fas fa-play ml-2"></i></a>
                    </div>
                    <!-- video-wrapper end -->
                </div>
            </div>
        </div>
    </div>





    <section class="pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-header text-center">
                        <span class="section-sub-title">Top-winners</span>
                        <h2 class="section-title style--two">Ranking for Last Month !</h2>
                        <p>Become a winners and start earning each month</p>
                    </div>
                </div>
            </div>
            <div class="row mb-none-30 justify-content-center">
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="top-affiliate-card">
                        <div class="top-affiliate-card__thumb">
                            <div class="inner">
                                <img src="{{ asset('frontend4/assets/images/top-affiliate/1.jpg') }}" alt="image">
                            </div>
                        </div>
                        <div class="top-affiliate-card__content">
                            <h3 class="name">Ricky Moran</h3>
                            <span class="amount">$5,026.66</span>
                        </div>
                    </div>
                    <!-- top-affiliate-card end -->
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="top-affiliate-card">
                        <div class="top-affiliate-card__thumb">
                            <div class="inner">
                                <img src="{{ asset('frontend4/assets/images/top-affiliate/2.jpg') }}" alt="image">
                            </div>
                        </div>
                        <div class="top-affiliate-card__content">
                            <h3 class="name">Ken Harper</h3>
                            <span class="amount">$5,026.66</span>
                        </div>
                    </div>
                    <!-- top-affiliate-card end -->
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="top-affiliate-card">
                        <div class="top-affiliate-card__thumb">
                            <div class="inner">
                                <img src="{{ asset('frontend4/assets/images/top-affiliate/3.jpg') }}" alt="image">
                            </div>
                        </div>
                        <div class="top-affiliate-card__content">
                            <h3 class="name">Lewis Frank</h3>
                            <span class="amount">$5,026.66</span>
                        </div>
                    </div>
                    <!-- top-affiliate-card end -->
                </div>
            </div>
        </div>
    </section>
@endsection
