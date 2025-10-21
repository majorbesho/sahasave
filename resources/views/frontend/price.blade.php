@extends('frontend.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">




            <section class="pricing-one" id="#price3" name="price3">
                <div class="pricing-one__pattern"
                    style="background-image: url({{ asset('4/assets/images/pattern/pricing-v1-pattern.png') }});">
                </div>
                <div class="container-fluid">
                    <div class="sec-title center text-center tg-heading-subheading animation-style2">
                        <div class="sec-title__tagline">
                            <div class="line"></div>
                            <div class="text {{ app()->getLocale() === 'ar' ? 'nonetext' : ' tg-element-title' }} ">
                                <h4 style="color:#0a0a0a">{{ __('index.OUR PRICING PLAN') }}</h4>
                            </div>
                            <div class="icon">
                                <span class="icon-plane2 float-bob-x3"></span>
                            </div>
                        </div>
                        <h2 class="{{ app()->getLocale() === 'ar' ? 'nonetext' : ' sec-title__title tg-element-title' }}  ">
                            {{ __('index.Our Effective and Affordable') }}<br>
                            <span> {{ __('index.Pricing Plans') }}</span>
                        </h2>
                    </div>

                    <div class="row">

                        <!--Start Pricing One Single-->
                        <div class="col-xl-3 col-lg-3 wow fadeInUp" data-wow-delay=".3s">
                            <div class="pricing-one__single">
                                <div class="pricing-one__single-inner">
                                    <div class="table-header">
                                        <div class="img-box">
                                            <img src="{{ asset('4/assets/images/resources/pricing-v1-img1.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="title-box">
                                            <h2>{{ __('index.individuals') }}</h2>
                                            <h3>1 {{ __('index.Truck') }} <span>/ 1 {{ __('index.Load') }} </span></h3>
                                        </div>
                                        <div class="title-box">
                                            <h2>{{ __('index.individuals') }}</h2>
                                            <h3>$00 <span>/ 1</span></h3>
                                        </div>
                                    </div>

                                    <div class="table-content">
                                        <ul>
                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.One Load') }} </p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.One Truck') }} </p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.Public Document') }} </p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.No Insurance') }} </p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.Email Support') }} </p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="table-footer">
                                        <div class="btn-box">
                                            <a class="thm-btn" href="{{ route('newreg') }}"> {{ __('index.Choose Plan') }}
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
                        <!--End Pricing One Single-->

                        <!--Start Pricing One Single-->
                        <div class="col-xl-3 col-lg-3 wow fadeInDown" data-wow-delay=".3s">
                            <div class="pricing-one__single">
                                <div class="pricing-one__single-inner">
                                    <div class="table-header">
                                        <div class="img-box">
                                            <img src="{{ asset('4/assets/images/plan/Silver-Membership-1.png') }}"
                                                alt="">
                                        </div>
                                        <div class="title-box">
                                            <h2>{{ __('index.Silver') }}</h2>
                                            <h3>{{ __('index.AED') }} 39.99 <span>/{{ __('index.monthly') }}</span></h3>
                                        </div>
                                        <div class="title-box">
                                            <h2>{{ __('index.Trucks') }} / {{ __('index.loads') }}</h2>
                                            <h3>10 {{ __('index.monthlyno') }} </h3>
                                        </div>
                                    </div>

                                    <div class="table-content">
                                        <ul>
                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.Pickup and delivery') }} </p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.Custom coverage') }} </p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.Customer Management') }} </p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.Deliver in 2-3 days') }}</p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.24 Hours Support') }}</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="table-footer">
                                        <div class="btn-box">
                                            <a
                                                class="thm-btn"href="{{ route('checkouttest', ['plan' => 'price_1QuCmGGh0XImvywkjyfPoRq5']) }}">
                                                {{ __('index.Choose Plan') }}
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
                        <!--End Pricing One Single-->

                        <!--Start Pricing One Single-->
                        <div class="col-xl-3 col-lg-3 wow fadeInUp" data-wow-delay=".3s">
                            <div class="pricing-one__single">
                                <div class="pricing-one__single-inner">
                                    <div class="table-header">
                                        <div class="img-box">
                                            <img src="{{ asset('4/assets/images/plan/Gold-Membership-1-1.png') }}"
                                                alt="">
                                        </div>
                                        <div class="title-box">
                                            <div class="title-box">
                                                <h2> {{ __('index.Gold') }}</h2>
                                                <h3>{{ __('index.AED') }} 64.99 <span>/ {{ __('index.monthly') }}</span>
                                                </h3>
                                            </div>
                                            <div class="title-box">
                                                <h2> {{ __('index.Trucks') }} / {{ __('index.loads') }}</h2>
                                                <h3>20 {{ __('index.monthlyno') }} </h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-content">
                                        <ul>
                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.Pickup and delivery') }} </p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.Custom coverage') }} </p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.Customer Management') }} </p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.Deliver in 2-3 days') }}</p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.24 Hours Support') }}</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="table-footer">
                                        <div class="btn-box">
                                            <a class="thm-btn"
                                                href="{{ route('checkouttest', ['plan' => 'price_1QuCnZGh0XImvywkSvo7IIbK']) }}">
                                                {{ __('index.Choose Plan') }}
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
                        <!--End Pricing One Single-->
                        <!--Start Pricing One Single-->
                        <div class="col-xl-3 col-lg-3 wow fadeInUp" data-wow-delay=".3s">
                            <div class="pricing-one__single">
                                <div class="pricing-one__single-inner">
                                    <div class="table-header">
                                        <div class="img-box">
                                            <img src="{{ asset('4/assets/images/plan/diamond_Membership.png') }}"
                                                alt="">
                                        </div>
                                        <div class="title-box">
                                            <h2>{{ __('index.Diamond') }}</h2>
                                            <h3>{{ __('index.AED') }} 109.99 <span>/{{ __('index.monthly') }}</span></h3>
                                        </div>
                                        <div class="title-box">
                                            <h2>{{ __('index.Trucks') }} / {{ __('index.loads') }}</h2>
                                            <h3>50 {{ __('index.monthlyno') }} </h3>
                                        </div>
                                    </div>

                                    <div class="table-content">
                                        <ul>
                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.Pickup and delivery') }} </p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.Custom coverage') }} </p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.Customer Management') }} </p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.Deliver in 2-3 days') }}</p>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="icon">
                                                    <span class="fa fa-check-circle"></span>
                                                </div>

                                                <div class="text-box">
                                                    <p>{{ __('index.24 Hours Support') }}</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="table-footer">
                                        <div class="btn-box">
                                            <a class="thm-btn"
                                                href="{{ route('checkouttest', ['plan' => 'price_1QuCpdGh0XImvywkWIunY7ZU']) }}">
                                                {{ __('index.Choose Plan') }}
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
                        <!--End Pricing One Single-->

                    </div>
                </div>
            </section>



        </div>
    </div>
@endsection
