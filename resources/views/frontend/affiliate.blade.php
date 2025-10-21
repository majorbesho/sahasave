@extends('frontend.layouts.master')


@section('content')
    <!-- inner-hero-section start -->
    <div class="inner-hero-section style--four">
        <div class="bg-shape"><img src="{{ asset('frontend4/assets/images/elements/inner-hero-shape-2.png') }}" alt="image">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    {{-- <ul class="page-list">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="#0">Pages</a></li>
                        <li class="active">Affiliate</li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- inner-hero-section end -->

    <!-- affiliate single section start -->
    <section class="mt-minus-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="affiliate-single-wrapper pt-120 pb-120">
                        <div class="affiliate-single-wrapper__obj"><img
                                src="{{ asset('frontend4/assets/images/elements/affiliate-obj.png') }}" alt="image">
                        </div>
                        <div class="section-header mb-0">
                            <span class="section-sub-title">Boost Your Earnings</span>
                            <h2 class="section-title font-weight-bold">Become an affiliate</h2>
                            <p>Follow these 3 easy steps! </p>
                            <a href="#0" class="cmn-btn text-capitalize mt-4">join us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- affiliate single section end -->

    <!-- how it work section start  -->
    <section class=" pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-header text-center">
                        <span class="section-sub-title">Getting started? It’s simple</span>
                        <h2 class="section-title style--two">How it works</h2>
                        <p>The affiliate program is our special feature for Customers.Invite users and earn 40% commission
                        </p>
                    </div>
                </div>
            </div>
            <div class="row mb-none-30 justify-content-center">
                <div class="col-lg-4 col-sm-6 mb-30">
                    <div class="work-card text-center">
                        <div class="work-card__icon">
                            <div class="inner"><img src="{{ asset('frontend4/assets/images/icon/how-work/1.png') }}"
                                    alt="image"></div>
                        </div>
                        <div class="work-card__content">
                            <h3 class="work-card__title">Sign up</h3>
                            <p>Sign Up with us as an affiliate in just a few easy steps</p>
                        </div>
                    </div>
                    <!-- work-card end -->
                </div>
                <div class="col-lg-4 col-sm-6 mb-30">
                    <div class="work-card text-center">
                        <div class="work-card__icon">
                            <div class="inner"><img src="{{ asset('frontend4/assets/images/icon/how-work/2.png') }}"
                                    alt="image"></div>
                        </div>
                        <div class="work-card__content">
                            <h3 class="work-card__title">Promote</h3>
                            <p>Get links or custom affiliate links we provide</p>
                        </div>
                    </div>
                    <!-- work-card end -->
                </div>
                <div class="col-lg-4 col-sm-6 mb-30">
                    <div class="work-card text-center">
                        <div class="work-card__icon">
                            <div class="inner"><img src="{{ asset('frontend4/assets/images/icon/how-work/3.png') }}"
                                    alt="image"></div>
                        </div>
                        <div class="work-card__content">
                            <h3 class="work-card__title">earn</h3>
                            <p>You receive commission on every refferal</p>
                        </div>
                    </div>
                    <!-- work-card end -->
                </div>
            </div>
        </div>
    </section>
    <!-- how it work section end  -->

    <!-- client section start -->
    <section class="pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="client-wrapper">
                        <h2 class="client-wrapper__title">Trusted by</h2>
                        <div class="client-slider">
                            <div class="client-single">
                                <img src="{{ asset('frontend4/assets/images/client/1.png') }}" alt="image">
                            </div>
                            <div class="client-single">
                                <img src="{{ asset('frontend4/assets/images/client/2.png') }}" alt="image">
                            </div>
                            <div class="client-single">
                                <img src="{{ asset('frontend4/assets/images/client/3.png') }}" alt="image">
                            </div>
                            <div class="client-single">
                                <img src="{{ asset('frontend4/assets/images/client/4.png') }}" alt="image">
                            </div>
                            <div class="client-single">
                                <img src="{{ asset('frontend4/assets/images/client/1.png') }}" alt="image">
                            </div>
                            <div class="client-single">
                                <img src="{{ asset('frontend4/assets/images/client/2.png') }}" alt="image">
                            </div>
                        </div>
                        <!-- client-slider end -->
                    </div>
                    <!-- client-wrapper end -->
                </div>
            </div>
        </div>
    </section>
    <!-- client section end -->

    <!-- affiliate partner section start -->
    <section class="pt-120 pb-120 position-relative">
        <div class="bg-el"><img src="{{ asset('frontend4/assets/images/elements/affiliate-bg.jpg') }}" alt="image">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-header text-center">
                        <span class="section-sub-title">What you'll get as</span>
                        <h2 class="section-title style--two"> Affiliate Partner</h2>
                        <p>Earn Unlimited Commissions with rifa affiliate program. Our partner program can increase your
                            income by receing percentage.</p>
                    </div>
                </div>
            </div>
            <div class="row mb-none-30">
                <div class="col-xl-3 col-sm-6 mb-30">
                    <div class="affiliate-card">
                        <div class="affiliate-card__icon">
                            <img src="{{ asset('frontend4/assets/images/icon/affiliate/1.png') }}" alt="image">
                        </div>
                        <div class="affiliate-card__content">
                            <h3 class="affiliate-card__title">No fees</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur eget varius diameget.</p>
                        </div>
                    </div>
                    <!-- affiliate-card end -->
                </div>
                <div class="col-xl-3 col-sm-6 mb-30">
                    <div class="affiliate-card">
                        <div class="affiliate-card__icon">
                            <img src="{{ asset('frontend4/assets/images/icon/affiliate/2.pn') }}g" alt="image">
                        </div>
                        <div class="affiliate-card__content">
                            <h3 class="affiliate-card__title">Easy payouts</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur eget varius diameget.</p>
                        </div>
                    </div>
                    <!-- affiliate-card end -->
                </div>
                <div class="col-xl-3 col-sm-6 mb-30">
                    <div class="affiliate-card">
                        <div class="affiliate-card__icon">
                            <img src="{{ asset('frontend4/assets/images/icon/affiliate/3.png') }}" alt="image">
                        </div>
                        <div class="affiliate-card__content">
                            <h3 class="affiliate-card__title">Tools for success</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur eget varius diameget.</p>
                        </div>
                    </div>
                    <!-- affiliate-card end -->
                </div>
                <div class="col-xl-3 col-sm-6 mb-30">
                    <div class="affiliate-card">
                        <div class="affiliate-card__icon">
                            <img src="{{ asset('frontend4/assets/images/icon/affiliate/4.png') }}" alt="image">
                        </div>
                        <div class="affiliate-card__content">
                            <h3 class="affiliate-card__title">24/7 Support </h3>
                            <p>Lorem ipsum dolor sit amet, consectetur eget varius diameget.</p>
                        </div>
                    </div>
                    <!-- affiliate-card end -->
                </div>
            </div>
        </div>
    </section>
    <!-- affiliate partner section end -->

    <!-- top affiliate section start -->
    <section class="pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-header text-center">
                        <span class="section-sub-title">Top-Earning Affiliate</span>
                        <h2 class="section-title style--two">Ranking for Last Month !</h2>
                        <p>Become a Rifa affiliate and start earning each month</p>
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
    <!-- top affiliate section end -->
@endsection
