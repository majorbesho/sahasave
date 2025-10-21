
@extends('frontend.layouts.master')


@section('content')




        <!-- inner-hero-section start -->
        <div class="inner-hero-section style--three">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

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
{{-- date --}}
                             <div class="contest-wrapper__header pt-120">
                                {{-- <h2 class="contest-wrapper__title">Weekly Box </h2> --}}
                                <div>
                                    @if (count($box)>0)
                                    @foreach ($box  as $boxone )
                                    @if ($loop->first)
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-6"> <h2 class="contest-wrapper__title"> </h2>
                                                <h4 class="contest-wrapper__title">Weekly Box </h4>

                                                <p>
                                                    <div class="wrap-countdown center mercado-countdown" data-expire="{{ Carbon\Carbon::parse($boxone->edate)->format('Y/m/d h:i:s') }}"></div>
                                                </p>
                                            </div>
                                            <div class="col-lg-6">

                                                <img src="{{$boxone->photo}}" alt="{{$boxone->title}}" srcset="" style="width: 350px;height: 200px;padding-bottom: 1%;">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    @endif
                                </div>
                            </div>



                            <link rel="stylesheet" href="{{asset('frontend3/2/css/slick.css')}}">
                            <link rel="stylesheet" href="{{asset('frontend3/2/css/magnific-popup.css')}}">
                            <link rel="stylesheet" href="{{asset('frontend3/2/css/flaticon_shofy.css')}}">
                            <link rel="stylesheet" href="{{asset('frontend3/2/css/spacing.css')}}">
                            <link rel="stylesheet" href="{{asset('frontend3/2/css/main.css')}}">


<div class="row product" >

    {{-- <div class="col-lg-4 d-flex">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                </li>
            </ul>
            <input type="range" min="100" max="150000" value="150000" style="width: 200px">
    </div> --}}
        {{-- <div class="col-lg-8"> --}}
            <main>

                <!-- breadcrumb area start -->
                <section class="breadcrumb__area include-bg pt-100 pb-50">

                </section>
                <!-- breadcrumb area end -->

                <!-- shop area start -->
                <section class="tp-shop-area pb-120">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="tp-shop-main-wrapper">
                                    <div class="tp-shop-top mb-45">

                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                <div class="tp-shop-top-left d-flex align-items-center ">
                                                    <div class="tp-shop-top-tab tp-tab">
                                                        <ul class="nav nav-tabs" id="productTab" role="tablist">
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link active" id="grid-tab" data-bs-toggle="tab" data-bs-target="#grid-tab-pane" type="button" role="tab" aria-controls="grid-tab-pane" aria-selected="true">
                                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M16.3327 6.01341V2.98675C16.3327 2.04675 15.906 1.66675 14.846 1.66675H12.1527C11.0927 1.66675 10.666 2.04675 10.666 2.98675V6.00675C10.666 6.95341 11.0927 7.32675 12.1527 7.32675H14.846C15.906 7.33341 16.3327 6.95341 16.3327 6.01341Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    <path d="M16.3327 15.18V12.4867C16.3327 11.4267 15.906 11 14.846 11H12.1527C11.0927 11 10.666 11.4267 10.666 12.4867V15.18C10.666 16.24 11.0927 16.6667 12.1527 16.6667H14.846C15.906 16.6667 16.3327 16.24 16.3327 15.18Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    <path d="M7.33268 6.01341V2.98675C7.33268 2.04675 6.90602 1.66675 5.84602 1.66675H3.15268C2.09268 1.66675 1.66602 2.04675 1.66602 2.98675V6.00675C1.66602 6.95341 2.09268 7.32675 3.15268 7.32675H5.84602C6.90602 7.33341 7.33268 6.95341 7.33268 6.01341Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    <path d="M7.33268 15.18V12.4867C7.33268 11.4267 6.90602 11 5.84602 11H3.15268C2.09268 11 1.66602 11.4267 1.66602 12.4867V15.18C1.66602 16.24 2.09268 16.6667 3.15268 16.6667H5.84602C6.90602 16.6667 7.33268 16.24 7.33268 15.18Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    </svg>
                                                                </button>
                                                            </li>
                                                            <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="list-tab" data-bs-toggle="tab" data-bs-target="#list-tab-pane" type="button" role="tab" aria-controls="list-tab-pane" aria-selected="false">
                                                                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M15 7.11108H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                        <path d="M15 1H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                        <path d="M15 13.2222H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                        </svg>
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                <div class="tp-shop-top-right tp-shop-top-right-2 d-sm-flex align-items-center justify-content-md-end">
                                                    <div class="tp-shop-top-select">
                                                        <select>
                                                            <option >Default Sorting</option>
                                                            <option >Low to Hight</option>
                                                            <option >High to Low</option>
                                                            <option >New Added</option>
                                                            <option >On Sale</option>
                                                    </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="tp-shop-items-wrapper tp-shop-item-primary">
                                        <div class="tab-content" id="productTabContent">
                                            <div class="tab-pane fade show active" id="grid-tab-pane" role="tabpanel" aria-labelledby="grid-tab" tabindex="0">
                                                <div class="row">
                                                    ======product====
                                                        @if (count($prod_index)>0)
                                                        @foreach($prod_index  as $itemxx  )
                                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">



                                                            <div class="tp-product-item-2 mb-40">
                                                            <div class="tp-product-thumb-2 p-relative z-index-1 fix w-img">
                                                                <a href="{{route('sProduct',$itemxx->slug)}}">
                                                                    <img src="{{$itemxx->photo}}" alt="{{$itemxx->title}}" style="width: 350px;">
                                                                </a>
                                                                <!-- product action -->
                                                                <div class="tp-product-action-2 tp-product-action-blackStyle">
                                                                    <div class="tp-product-action-item-2 d-flex flex-column">
                                                                        <button type="button" class="tp-product-action-btn-2 tp-product-add-cart-btn">
                                                                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.34706 4.53799L3.85961 10.6239C3.89701 11.0923 4.28036 11.4436 4.74871 11.4436H4.75212H14.0265H14.0282C14.4711 11.4436 14.8493 11.1144 14.9122 10.6774L15.7197 5.11162C15.7384 4.97924 15.7053 4.84687 15.6245 4.73995C15.5446 4.63218 15.4273 4.5626 15.2947 4.54393C15.1171 4.55072 7.74498 4.54054 3.34706 4.53799ZM4.74722 12.7162C3.62777 12.7162 2.68001 11.8438 2.58906 10.728L1.81046 1.4837L0.529505 1.26308C0.181854 1.20198 -0.0501969 0.873587 0.00930333 0.526523C0.0705036 0.17946 0.406255 -0.0462578 0.746256 0.00805037L2.51426 0.313534C2.79901 0.363599 3.01576 0.5995 3.04042 0.888012L3.24017 3.26484C15.3748 3.26993 15.4139 3.27587 15.4726 3.28266C15.946 3.3514 16.3625 3.59833 16.6464 3.97849C16.9303 4.35779 17.0493 4.82535 16.9813 5.29376L16.1747 10.8586C16.0225 11.9177 15.1011 12.7162 14.0301 12.7162H14.0259H4.75402H4.74722Z" fill="currentColor"/>
                                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.6629 7.67446H10.3067C9.95394 7.67446 9.66919 7.38934 9.66919 7.03804C9.66919 6.68673 9.95394 6.40161 10.3067 6.40161H12.6629C13.0148 6.40161 13.3004 6.68673 13.3004 7.03804C13.3004 7.38934 13.0148 7.67446 12.6629 7.67446Z" fill="currentColor"/>
                                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.38171 15.0212C4.63756 15.0212 4.84411 15.2278 4.84411 15.4836C4.84411 15.7395 4.63756 15.9469 4.38171 15.9469C4.12501 15.9469 3.91846 15.7395 3.91846 15.4836C3.91846 15.2278 4.12501 15.0212 4.38171 15.0212Z" fill="currentColor"/>
                                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.38082 15.3091C4.28477 15.3091 4.20657 15.3873 4.20657 15.4833C4.20657 15.6763 4.55592 15.6763 4.55592 15.4833C4.55592 15.3873 4.47687 15.3091 4.38082 15.3091ZM4.38067 16.5815C3.77376 16.5815 3.28076 16.0884 3.28076 15.4826C3.28076 14.8767 3.77376 14.3845 4.38067 14.3845C4.98757 14.3845 5.48142 14.8767 5.48142 15.4826C5.48142 16.0884 4.98757 16.5815 4.38067 16.5815Z" fill="currentColor"/>
                                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9701 15.0212C14.2259 15.0212 14.4333 15.2278 14.4333 15.4836C14.4333 15.7395 14.2259 15.9469 13.9701 15.9469C13.7134 15.9469 13.5068 15.7395 13.5068 15.4836C13.5068 15.2278 13.7134 15.0212 13.9701 15.0212Z" fill="currentColor"/>
                                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.9692 15.3092C13.874 15.3092 13.7958 15.3874 13.7958 15.4835C13.7966 15.6781 14.1451 15.6764 14.1443 15.4835C14.1443 15.3874 14.0652 15.3092 13.9692 15.3092ZM13.969 16.5815C13.3621 16.5815 12.8691 16.0884 12.8691 15.4826C12.8691 14.8767 13.3621 14.3845 13.969 14.3845C14.5768 14.3845 15.0706 14.8767 15.0706 15.4826C15.0706 16.0884 14.5768 16.5815 13.969 16.5815Z" fill="currentColor"/>
                                                                            </svg>
                                                                            <span class="tp-product-tooltip tp-product-tooltip-right">Add to Cart</span>
                                                                        </button>

                                                                        <button type="button" class="tp-product-action-btn-2 tp-product-add-to-wishlist-btn">
                                                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.60355 7.98635C2.83622 11.8048 7.7062 14.8923 9.0004 15.6565C10.299 14.8844 15.2042 11.7628 16.3973 7.98985C17.1806 5.55102 16.4535 2.46177 13.5644 1.53473C12.1647 1.08741 10.532 1.35966 9.40484 2.22804C9.16921 2.40837 8.84214 2.41187 8.60476 2.23329C7.41078 1.33952 5.85105 1.07778 4.42936 1.53473C1.54465 2.4609 0.820172 5.55014 1.60355 7.98635ZM9.00138 17.0711C8.89236 17.0711 8.78421 17.0448 8.68574 16.9914C8.41055 16.8417 1.92808 13.2841 0.348132 8.3872C0.347252 8.3872 0.347252 8.38633 0.347252 8.38633C-0.644504 5.30321 0.459792 1.42874 4.02502 0.284605C5.69904 -0.254635 7.52342 -0.0174044 8.99874 0.909632C10.4283 0.00973263 12.3275 -0.238878 13.9681 0.284605C17.5368 1.43049 18.6446 5.30408 17.6538 8.38633C16.1248 13.2272 9.59485 16.8382 9.3179 16.9896C9.21943 17.0439 9.1104 17.0711 9.00138 17.0711Z" fill="currentColor"/>
                                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.203 6.67473C13.8627 6.67473 13.5743 6.41474 13.5462 6.07159C13.4882 5.35202 13.0046 4.7445 12.3162 4.52302C11.9689 4.41097 11.779 4.04068 11.8906 3.69666C12.0041 3.35175 12.3724 3.16442 12.7206 3.27297C13.919 3.65901 14.7586 4.71561 14.8615 5.96479C14.8905 6.32632 14.6206 6.64322 14.2575 6.6721C14.239 6.67385 14.2214 6.67473 14.203 6.67473Z" fill="currentColor"/>
                                                                            </svg>
                                                                            <span class="tp-product-tooltip tp-product-tooltip-right">Add To Wishlist</span>
                                                                        </button>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tp-product-content-2 pt-15">
                                                                <div class="tp-product-tag-2">
                                                                    {{-- <a href="#">Backpack, </a>
                                                                    <a href="#">Wonder</a> --}}
                                                                </div>
                                                                <h3 class="tp-product-title-2">
                                                                    <a href="product-details.html">{{$itemxx->title}}</a>
                                                                </h3>
                                                                <div class="tp-product-rating-icon tp-product-rating-icon-2">
                                                                    <span><i class="fa-solid fa-star"></i></span>
                                                                    <span><i class="fa-solid fa-star"></i></span>
                                                                    <span><i class="fa-solid fa-star"></i></span>
                                                                    <span><i class="fa-solid fa-star"></i></span>
                                                                    <span><i class="fa-solid fa-star"></i></span>
                                                                </div>
                                                                <div class="tp-product-price-wrapper-2">
                                                                    <span class="tp-product-price-2 new-price">{{$itemxx->offer_price}}</span>
                                                                    <span class="tp-product-price-2 old-price">{{$itemxx->price}}</span>
                                                                </div>
                                                            </div>
                                                        </div>

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
                </section>
                <!-- shop area end -->



            </main>

        {{-- </div> --}}
        </div>

                        </div>

                    </div>


                        <!-- contest-wrapper end -->

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





        <script src="{{asset('frontend/1/js/jquery.countdown.min.js')}}"></script>



        <script>
            ;(function($) {

             var MERCADO_JS = {
               init: function(){
                  this.mercado_countdown();

               },
             mercado_countdown: function() {
                  if($(".mercado-countdown").length > 0){
                         $(".mercado-countdown").each( function(index, el){
                           var _this = $(this),
                           _expire = _this.data('expire');
                        _this.countdown(_expire, function(event) {
                                 $(this).html( event.strftime('<span><b>%D</b> :</span> <span><b>%-H</b>:</span> <span><b>%M</b>:</span> <span><b>%S</b>:</span>'));
                             });
                         });
                  }
               },

            }

               window.onload = function () {
                  MERCADO_JS.init();
               }

               })(window.Zepto || window.jQuery, window, document);
         </script>

















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
