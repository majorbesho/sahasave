
@extends('frontend.layouts.master')


@section('content')




        <!-- inner-hero-section start -->
        <div class="inner-hero-section style--three">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="page-list">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="#0">Lottery</a></li>
                            <li class="active">Contest</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- inner-hero-section end -->

        <!-- contest section start  -->
        <section class="pb-120 mt-minus-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contest-wrapper">
                            <div class="contest-wrapper__header pt-120">
                                <h2 class="contest-wrapper__title">Latest Contest</h2>
                                <ul class="nav nav-tabs winner-tab-nav" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="dream-tab" data-bs-toggle="tab" data-bs-target="#dream" role="tab" aria-controls="dream" aria-selected="true">
                                            <div class="icon-thumb"><img src="{{asset('frontend2/assets/images/icon/winner-tab/1.png')}}" alt="image"></div>
                                            <span>Dream Car</span>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                         <button class="nav-link" id="bike-tab" data-bs-toggle="tab" data-bs-target="#bike" role="tab" aria-controls="bike" aria-selected="false">
                                    <div class="icon-thumb"><img src="{{asset('frontend2/assets/images/icon/winner-tab/2.png')}}" alt="image"></div>
                                    <span>bike</span>
                                         </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="watch-tab" data-bs-toggle="tab" data-bs-target="#watch" role="tab" aria-controls="watch" aria-selected="false">
                                            <div class="icon-thumb"><img src="{{asset('frontend2/assets/images/icon/winner-tab/3.png')}}" alt="image"></div>
                                            <span>watch</span>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="laptop-tab" data-bs-toggle="tab" data-bs-target="#laptop" role="tab" aria-controls="laptop" aria-selected="false">
                                            <div class="icon-thumb"><img src="{{asset('frontend2/assets/images/icon/winner-tab/4.png')}}" alt="image"></div>
                                            <span>laptop</span>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="money-tab" data-bs-toggle="tab" data-bs-target="#money" role="tab" aria-controls="money" aria-selected="false">
                                        <div class="icon-thumb"><img src="{{asset('frontend2/assets/images/icon/winner-tab/5.png')}}" alt="image"></div>
                                        <span>Money</span>
                                    </button>
                                    </li>
                                </ul>
                            </div>
                            <div class="contest-wrapper__body">
                                        {{-- select Filter --}}
                                <div class="row contest-filter-wrapper justify-content-center mt-30 mb-none-30">
                                    <div class="col-lg-2 col-sm-6 mb-30">
                                        <select>
                                        <option>SORT BY</option>
                                        <option>Filter option</option>
                                        <option>Filter option</option>
                                        <option>Filter option</option>
                                        <option>Filter option</option>
                                        <option>Filter option</option>
                                        <option>Filter option</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 col-sm-6 mb-30">
                                        <select>
                                        <option>ALL MAKES</option>
                                        <option>Filter option</option>
                                        <option>Filter option</option>
                                        <option>Filter option</option>
                                        <option>Filter option</option>
                                        <option>Filter option</option>
                                        <option>Filter option</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 mb-30">
                                        <div class="rang-slider">
                                            <span class="caption">Ticket Price</span>
                                            <div id="slider-range-min-one" class="invest-range-slider" data-value="8" data-maxValue="16"></div>
                                            <div class="amount-wrapper">
                                                <span class="min-amount">0</span>
                                                <div class="main-amount">
                                                    <input type="text" class="calculator-invest" id="basic-amount" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-4 mb-30">
                                        <div class="action-btn-wrapper">
                                            <button type="button" class="action-btn"><i class="lar la-heart"></i></button>
                                            <button type="button" class="action-btn"><i class="las la-redo-alt"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-8 mb-30">
                                        <form class="contest-search-form">
                                            <input type="text" placeholder="SEARCH HERE">
                                            <button><i class="fas fa-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <!-- row end -->

                                <div class="tab-content mt-50" id="myTabContent">
                                        @if (count($gop)>0)

                                        <div class="tab-pane fade show active" id="dream" role="tabpanel" aria-labelledby="dream-tab">
                                            <!-- contest-card end -->


                                        <div class="row mb-none-30 mt-50">
                                                @foreach ($gop  as $item  )
                                                    <div class="col-xl-4 col-md-6 mb-30">
                                                        <div class="contest-card">
                                                            <a href="{{route('groupOfProduct',$item->slug)}}" class="item-link"></a>
                                                            <div class="contest-card__thumb">
                                                                <img src="{{ $item->photo}}" alt="image">
                                                                <a href="#0" class="action-icon"><i class="far fa-heart"></i></a>
                                                                <div class="contest-num">
                                                                    <span>contest no:</span>
                                                                    <h4 class="number">b2t</h4>
                                                                </div>
                                                            </div>
                                                            <div class="contest-card__content">
                                                                <div class="left">
                                                                    <h5 class="contest-card__name">{{$item->title}}</h5>
                                                                </div>
                                                                <div class="right">
                                                                    <span class="contest-card__price">{{$item->showPrice}}</span>
                                                                    <p>ticket price</p>
                                                                </div>
                                                            </div>
                                                            <div class="contest-card__footer">
                                                                <ul class="contest-card__meta">
                                                                    <li>
                                                                        <i class="las la-clock"></i>
                                                                        <span>5d</span>
                                                                    </li>
                                                                    <li>
                                                                        <i class="las la-ticket-alt"></i>
                                                                            <span></span>
                                                                        <p>Remaining</p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- contest-card end -->
                                                    </div>
                                                @endforeach
                                        </div>

                                      </div>
                                        @else
                                        <p> No Data to Display</p>
                                        @endif



                                </div>

                                <div class="tab-content mt-50" id="myTabContent">
                                    @if (count($prod_index)>0)

                                    <div class="tab-pane fade show active" id="dream" role="tabpanel" aria-labelledby="dream-tab">
                                        <!-- contest-card end -->


                                    <div class="row mb-none-30 mt-50">
                                            @foreach ($prod_index  as $itempro  )
                                                <div class="col-xl-4 col-md-6 mb-30">
                                                    <div class="contest-card">
                                                        <a href="{{route('sProduct',$itempro->slug)}}" class="item-link"></a>
                                                        <div class="contest-card__thumb">
                                                            <img src="{{ $itempro->photo}}" alt="image">
                                                            <a href="#0" class="action-icon"><i class="far fa-heart"></i></a>
                                                            <div class="contest-num">
                                                                <span>contest no:</span>
                                                                <h4 class="number">b2t</h4>
                                                            </div>
                                                        </div>
                                                        <div class="contest-card__content">
                                                            <div class="left">
                                                                <h5 class="contest-card__name">{{$itempro->title}}</h5>
                                                            </div>
                                                            <div class="right">
                                                                <span class="contest-card__price">{{$itempro->showPrice}}</span>
                                                                <p>ticket price</p>
                                                            </div>
                                                        </div>
                                                        <div class="contest-card__footer">
                                                            <ul class="contest-card__meta">
                                                                <li>
                                                                    <i class="las la-clock"></i>

                                                                </li>
                                                                <li>
                                                                    <i class="las la-ticket-alt"></i>
                                                                        <span></span>
                                                                    <p>Remaining</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- contest-card end -->
                                                </div>
                                            @endforeach
                                    </div>

                                </div>
                                    @else
                                    <p> No Data to Display</p>
                                    @endif

                            </div>

                            </div>
                        </div>
                        <!-- contest-wrapper end -->
                    </div>
                </div>
            </div>
        </section>
        <!-- contest section end -->

        <!-- contest feature section start -->
        <section class="pb-120">
            <div class="container">
                <div class="row mb-none-30 justify-content-center">
                    <div class="col-lg-4 col-sm-6 mb-30">
                        <div class="icon-item2">
                            <div class="icon-item2__icon">
                                <img src="{{asset('frontend2/assets/images/icon/contest-feature/1.png')}}" alt="image">
                            </div>
                            <div class="icon-item2__content">
                                <h3 class="title">Secure Checkout</h3>
                                <p>Pay with the world’s most popular and secure payment methods.</p>
                            </div>
                        </div>
                        <!-- icon-item2 end -->
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-30">
                        <div class="icon-item2">
                            <div class="icon-item2__icon">
                                <img src="{{asset('frontend2/assets/images/icon/contest-feature/2.png')}}" alt="image">
                            </div>
                            <div class="icon-item2__content">
                                <h3 class="title">Great Value</h3>
                                <p>We offer competitive prices for every lottery tickets</p>
                            </div>
                        </div>
                        <!-- icon-item2 end -->
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-30">
                        <div class="icon-item2">
                            <div class="icon-item2__icon">
                                <img src="{{asset('frontend2/assets/images/icon/contest-feature/3.png')}}" alt="image">
                            </div>
                            <div class="icon-item2__content">
                                <h3 class="title">Free Worldwide Delivery</h3>
                                <p>We are available for providing our services in major countries</p>
                            </div>
                        </div>
                        <!-- icon-item2 end -->
                    </div>
                </div>
            </div>
        </section>
        <!-- contest feature section end -->




















	<!-- Page Title
	     {{--	============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1>Category</h1>
				<span>Our Awsome Category</span>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Shop</li>
				</ol>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<!-- Shop
					============================================= -->
					<div id="shop" class="shop row grid-container gutter-30" data-layout="fitRows">

                @if(count($category->products)>0)
                @foreach ($category->products as $item)


            <div class="product col-lg-3 col-md-4 col-sm-6 col-12">

                <div class="grid-inner">

                @php
                    $photo=explode(',',$item->photo)
                @endphp
                    <div class="product-image">
                        <a href="#"><img src="{{$photo[0]}}" alt="{{$item->title}}"></a>
                        <a href="#"><img src="{{$photo[0]}}" alt="{{$item->title}}"></a>
                        <div class="sale-flash badge bg-success p-2 text-uppercase">
                            {{$item->category}}
                        </div>
                        <div class="bg-overlay">
                            <div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
                                <a href="#" class="btn btn-dark me-2">
                                    <i class="icon-shopping-basket"></i>
                                </a>
                                <a href="include/ajax/shop-item.html"
                                    class="btn btn-dark" data-lightbox="ajax">
                                    <i class="icon-line-expand"></i>
                                </a>
                            </div>
                            <div class="bg-overlay-bg bg-transparent"></div>
                        </div>
                    </div>
                    <div class="product-desc">
                        <div class="product-title"><h3><a href="#">{{$item->title}}</a></h3></div>
                    <div class="product-price"><del>$19.99</del> <ins>$11.99</ins></div> --}}
                        {{-- <div class="product-rating">
                            <i class="icon-star3"></i>
                            <i class="icon-star3"></i>
                            <i class="icon-star3"></i>
                            <i class="icon-star-empty"></i>
                            <i class="icon-star-empty"></i>
                        </div>
                    </div>
                </div>

            </div>

   @endforeach
                @else
                <p> No data </p>
                        @endif






					</div><!-- #shop end -->

				</div>
			</div>
		</section><!-- #content end -->

 --}}





@endsection
