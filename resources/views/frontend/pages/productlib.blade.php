
@extends('frontend.layouts.master')


@section('content')

<div class="container pt-300" style="padding-top:150px">
    <div class="row">
        <div class="col-lg-12">



            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
                        <div class="section-header text-center">
                            <span class="section-sub-title">Try your chance at winning</span>
                            <h2 class="section-title" id="campaigns">Explore Campaigns</h2>
                            <p>With SmartBox we believe everyone should win </p>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
                <div class="col-lg-12">

                    {{-- <ul class="nav nav-tabs justify-content-center mb-30 border-0" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="cmn-btn style--two d-flex align-items-center active" id="home-tab"
                                data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab"
                                aria-controls="home-tab-pane" aria-selected="true">
                                <span class="me-3"><img src="{{ asset('frontend4/images/icon/btn/car.png') }}"
                                        alt="icon"></span>Box
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="cmn-btn style--two d-flex align-items-center active" id="home-tab"
                                data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab"
                                aria-controls="home-tab-pane" aria-selected="true">
                                <span class="me-3"><img src="{{ asset('frontend4/images/icon/btn/car.png') }}"
                                        alt="icon"></span>Box
                            </button>
                        </li>


                    </ul> --}}
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                            aria-labelledby="home-tab" tabindex="0">
                            <div class="row mb-none-30">



                                @if (count($box) > 0)
                                    @foreach ($box as $boxoneNext)
                                        <div class="col-xl-3 col-md-6 mb-30">
                                            <div class="contest-card">

                                                @if (Auth::check())
                                                <a href="{{ route('groupOfProduct', $boxoneNext->slug) }}" class="item-link"></a>

                                                @else
                                                    <a href="#popup1" class="item-link"></a>
                                                @endif

                                                <div class="contest-card__thumb">
                                                    <img src="{{ $boxoneNext->photo }}" alt="image">

                                                </div>
                                                <div class="contest-card__content">
                                                    <div class="container hr">
                                                        <div class="col-12 text-cart">
                                                            <p>
                                                                Get a chance to <span>WIN</span>
                                                            </p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 cart-text">
                                                                <h5 class="contest-card__name">{{ $boxoneNext->title }}
                                                                </h5>
                                                            </div>
                                                            <div class="col-12 cart-text d-none">
                                                                <h5 class="contest-card__name">
                                                                    {{ $boxoneNext->showPrice }}</h5>
                                                            </div>
                                                            <div class="col-12 cmn-btn-cart style--three ">
                                                                @if (Auth::check())
                                                                    <a href="{{ route('groupOfProduct', $boxoneNext->slug) }}"
                                                                        class="center text-light">Add To Cart</a>
                                                                @else
                                                                <a href="{{ route('groupOfProduct', $boxoneNext->slug) }}"
                                                                    class="center text-light">Add To Cart</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="contest-card__footer">
                                                    <ul class="contest-card__meta">
                                                        <li>
                                                            <i class="las la-clock"></i>
                                                            <span>
                                                                {{ Carbon\Carbon::parse($boxoneNext->edate)->format('d') }}
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <i class="las la-ticket-alt"></i>
                                                            {{-- <span>9805</span> --}}
                                                            <p>{{ $boxoneNext->supplier }}</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- contest-card end -->
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pb-5"></div>





@endsection
