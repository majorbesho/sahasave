
{{-- @extends('frontend.layouts.master')


@section('content') --}}

<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
	<meta name="author" content="beshog32@gmail.com" >
    <meta name="X-CSRF-TOKEN" content="{{ csrf_token() }}" >
    	<!-- Stylesheets
	============================================= -->







	<!-- SLIDER REVOLUTION 5.x CSS SETTINGS -->



	<meta name="viewport" content="width=device-width, initial-scale=1" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
    <title>SmartBox</title>
	{{-- <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" /> --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{asset('frontend3/css/bootstrap.css')}}" type="text/css" >
    <link rel="stylesheet" href="{{asset('frontend3/css/shop/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('frontend3/css/style.css')}}" type="text/css" >
	<link rel="stylesheet" href="{{asset('frontend3/css/dark.css')}}" type="text/css" >
	<!-- <link rel="stylesheet" href="asset/css/swiper.css" type="text/css')}}" /> -->
	<!-- <link rel="stylesheet" href="asset/css/font-icons.css" type="text/css')}}" /> -->
	<link rel="stylesheet" href="{{asset('frontend3/css/animate.css')}}" type="text/css" >

    {{-- https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css --}}


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" type="text/css" >

	<link rel="stylesheet" href="{{asset('frontend3/css/magnific-popup.css')}}" type="text/css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" >
	<link rel="stylesheet" type="text/css" href="{{asset('frontend3/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend3/fonts/font-awesome/css/font-awesome.css')}}">


	<link rel="stylesheet" type="text/css" href="{{asset('frontend3/css/new/typewriter.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend3/css/new/revolution.addon.revealer.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend3/css/new/revolution.addon.revealer.preloaders.css')}}">


	<link  rel="stylesheet" type="text/css"  media="all" href="{{asset('frontend3/css/revolution.addon.explodinglayers.css')}}" >

	<link rel="stylesheet" type="text/css" href="{{asset('frontend3/css/settings.css')}}" media="screen" >
	<link rel="stylesheet" type="text/css" href="{{asset('frontend3/css/layers.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend3/css/navigation.css')}}">

	<link rel="icon" type="image/png" href="{{asset('frontend3/images/favicon.ico')}}" sizes="16x16">
    <!-- bootstrap 4  -->
<!-- shop -->
    <!-- ====== global style ====== -->
    <link rel="stylesheet" href="{{asset('frontend3/css/shop/stylex.css')}}">

<!-- end of shop -->
    <!-- fontawesome 5  -->
    <link rel="stylesheet" href="{{asset('frontend2/assets/css/all.min.css')}}">
    <!-- line-awesome webfont -->
    <link rel="stylesheet" href="{{asset('frontend2/assets/css/line-awesome.min.css')}}">
    <!-- custom select css -->
    <link rel="stylesheet" href="{{asset('frontend2/assets/css/vendor/nice-select.css')}}">
    <!-- animate css  -->
    <link rel="stylesheet" href="{{asset('frontend2/assets/css/vendor/animate.min.css')}}">
    <!-- lightcase css -->
    <link rel="stylesheet" href="{{asset('frontend2/assets/css/vendor/lightcase.css')}}">
    <!-- slick slider css -->
    <link rel="stylesheet" href="{{asset('frontend2/assets/css/vendor/slick.css')}}">
    <!-- jquery ui css -->
    <link rel="stylesheet" href="{{asset('frontend2/assets/css/vendor/jquery-ui.min.css')}}">
    <!-- datepicker css -->
    <link rel="stylesheet" href="{{asset('frontend2/assets/css/vendor/datepicker.min.css')}}">
    <!-- style main css -->
    <link rel="stylesheet" href="{{asset('frontend3/css/main.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('frontend2/css/simple-line-icons.css')}}"> --}}
	{{-- <link rel="stylesheet" href="{{asset('frontend3/css/custom.css')}}" type="text/css" /> --}}
	<!--SLIDER REVOLUTION 5.x CSS SETTINGS -->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/1/include/rs-plugin/css/settings.css')}}" media="screen" >
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/1/include/rs-plugin/css/layers.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/1/include/rs-plugin/css/navigation.css')}}">
{{-- frontEnd 2  --}}


    <style>
		.club-gradient{background:-webkit-linear-gradient(45deg,#fde501 0%,#ff5287 50%,#d72400 100%);
			-webkit-background-clip:text;-webkit-text-fill-color:transparent}
	</style>
	<link rel="stylesheet" href="{{asset('frontend/1/css/custom.css')}}" type="text/css" >

    <link rel="stylesheet" href="{{asset('frontend3/css/mediaqueries.css')}}" type="text/css" >


 <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 <script>
     $(document).ready(function(){
         $(".notification_icon .fa-bell").click(function(){
             $(".dropdown").toggleClass("active");
         })
     });
 </script>








<title>SmartBox</title>
</head>





<body class="stretched">


    {{-- <body class="stretched">

        <!-- Document Wrapper
        ============================================= -->--}}
        <div id="wrapper" class="clearfix">



            <div id="header" class="full-header">
                <header class="header" id="header-ajax">


                    <div id="header-wrap">
                        <div class="container">
                            <div class="header-row">

                                <div  id="logo">
                                    <a href="{{ route('home') }}" class="standard-logo"
                                        data-dark-logo="{{ asset('frontend3/img/logo500.png') }}">
                                        <img src="{{ asset('frontend3/img/logo500.png') }}" alt="smart Logo">
                                    </a>
                                    <a href="{{ route('home') }}" class="retina-logo"
                                        data-dark-logo="{{ asset('frontend3/img/logo500.png') }}">
                                        <img src="{{ asset('frontend3/img/logo500.png') }}" alt="smart Logo">
                                    </a>
                                </div><!-- #logo end -->

                                <div class="header-misc">

                                    <!-- Top Search
                                    ============================================= -->


                                    <!-- Top Cart
                                    ============================================= -->


                                    <div id="top-cart" class="header-misc-icon">
                                        <a href="#" id="top-cart-trigger"><i class="fa-solid fa-cart-shopping fa-2xl"></i>
                                            <span class="top-cart-number" id="cart_count">
                                                {{ \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() }}
                                            </span>
                                        </a>
                                        <div class="top-cart-content">
                                            <div class="top-cart-title">
                                                <h4>Shopping Cart</h4>
                                            </div>
                                            @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                                                <div class="top-cart-items">
                                                    <div class="top-cart-item">
                                                        <div class="top-cart-item-image">
                                                            <a href="#"><img src="{{ $item->model->photo }}"
                                                                    alt="{{ $item->name }}" />
                                                            </a>
                                                        </div>
                                                        <div class="top-cart-item-desc">
                                                            <div class="top-cart-item-desc-title">
                                                                <a href="#">{{ $item->name }}</a>
                                                                <span class="top-cart-item-price d-block">{{ $item->price }}</span>
                                                            </div>
                                                            <div class="top-cart-item-quantity">x {{ $item->qty }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="top-cart-action">
                                                <span class="top-checkout-price">{{ Cart::subtotal() }}</span>
                                                <a href="{{ route('checkout') }}" class="button button-3d button-small m-0">View
                                                    Cart</a>
                                            </div>
                                        </div>
                                    </div>



                                </div>

                                <div id="primary-menu-trigger">
                                    <svg class="svg-trigger" viewBox="0 0 100 100">
                                        <path
                                            d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20">
                                        </path>
                                        <path d="m 30,50 h 40"></path>
                                        <path
                                            d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20">
                                        </path>
                                    </svg>
                                </div>




                                        <!-- Primary Navigation
                                ============================================= -->
                                        <nav class="primary-menu ">
                                            <ul class="menu-container">
                                                <li class="menu-item">
                                                    <a class="menu-link1" href="{{ route('home') }}">
                                                        <div>Home</div>
                                                    </a>
                                                </li>
                                                @if (Auth::guest())
                                                    <li class="menu-item d-lg-none "><a href="{{ route('user.auth') }}"class="menu-link1">
                                                            <div>login</div>
                                                        </a></li>
                                                    <li class="menu-item d-lg-none"><a href="{{ route('user.auth') }}"class="menu-link1">
                                                            <div>sign up</div>
                                                        </a></li>
                                                @endif
                                                @if (Auth::check())
                                                    <li class="menu-item d-lg-none"><a
                                                            href="{{ route('allgroupOfProduct') }}"class="menu-link1"><i
                                                                class="fa-solid fa-gift fa-flip fa-lg"></i>
                                                            <div>Boxes</div>
                                                        </a></li>
                                                    <li class="menu-item d-lg-none"><a href="{{ route('dashboard') }}"class="menu-link1"><i
                                                                class="fa-solid fa-user fa-lg"></i>
                                                            <div>user dashboard</div>
                                                        </a>
                                                    <li class="menu-item d-lg-none"><a
                                                            href="{{ route('user.logout') }}"class="menu-link1"><i
                                                                class="fa-solid fa-right-from-bracket"></i>
                                                            <div>Exit</div>
                                                        </a>
                                                @endif
                                                <li class="menu-item">
                                                    <a class="menu-link1" href="{{ route('howitwork') }}">
                                                        <div>HOW TO PLAY</div>
                                                    </a>
                                                </li>
                                                <li class="menu-item">
                                                    <a class="menu-link1" href="{{ route('about') }}">
                                                        <div>about</div>
                                                    </a>
                                                </li>


                                                <li class="menu-item">
                                                    <a class="menu-link1" href="{{ route('allbox') }}">
                                                        <div>OPEN BOX</div>
                                                    </a>
                                                </li>

                                                <li class="menu-item">
                                                    <a class="menu-link1" href="{{ route('blogs') }}">
                                                        <div>BLOGS</div>
                                                    </a>
                                                </li>
                                                <li class="menu-item">
                                                    <a class="menu-link1" href="{{ route('media') }}">
                                                        <div>MEDIA</div>
                                                    </a>
                                                </li>

                                                <li class="menu-item">
                                                    <a class="menu-link1" href="{{ route('get-contact-us') }}">
                                                        <div>CONTACT</div>
                                                    </a>
                                                </li>


                                            </ul>

                                        </nav><!-- #primary-menu end -->

                                        {{-- <form class="top-search-form" action="search.html" method="get">
                                            <input type="text" name="q" class="form-control" value=""
                                                placeholder="Type &amp; Hit Enter.." autocomplete="off">
                                        </form> --}}

                            </div>
                        </div>
                    </div>
                            <div class="header-wrap-clone"></div>

                            <!-- Top Cart
                                ============================================= -->
                            {{-- <div id="top-cart" class="header-misc-icon">
                                            <a href="#" id="top-cart-trigger"><i class="fa-solid fa-cart-shopping fa-2xl"></i>
                                                <span class="top-cart-number">
                                                    {{ \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() }}
                                                </span>
                                            </a>
                                            <div class="top-cart-content">
                                                <div class="top-cart-title">
                                                    <h4>Shopping Cart</h4>
                                                </div>
                                                @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                                                    <div class="top-cart-items">
                                                        <div class="top-cart-item">
                                                            <div class="top-cart-item-image">
                                                                <a href="#"><img src="{{ $item->model->photo }}"
                                                                        alt="{{ $item->name }}" />
                                                                </a>
                                                            </div>
                                                            <div class="top-cart-item-desc">
                                                                <div class="top-cart-item-desc-title">
                                                                    <a href="#">{{ $item->name }}</a>
                                                                    <span class="top-cart-item-price d-block">{{ $item->price }}</span>
                                                                </div>
                                                                <div class="top-cart-item-quantity">x {{ $item->qty }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="top-cart-action">
                                                    <span class="top-checkout-price">{{ Cart::subtotal() }}</span>
                                                    <a href="{{ route('checkout') }}" class="button button-3d button-small m-0">View
                                                        Cart</a>
                                                </div>
                                            </div>
                                        </div><!-- #top-cart end --> --}}



                                    </header><!-- #header end -->
                                </div>




<div class="inner-hero-section pt-150">
    {{-- <div class="bg-shape"><img src="{{asset('frontend2/assets/images/elements/inner-hero-shape.png')}}" alt="image"></div> --}}
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <ul class="page-list">
            {{-- <li><a href="index.html">Home</a></li>
            <li><a href="#0">Lottery</a></li>
            <li class="active">Contest No: B2T</li> --}}
          </ul>
        </div>
      </div>
    </div>
  </div>



<section class="pb-120 mt-minus-300">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="clock-wrapper">
            <p>
                <div class="wrap-countdown mercado-countdown" data-expire="{{ Carbon\Carbon::parse($gop->edate)->format('Y/m/d h:i:s') }}"></div>
                </p>

            <p class="mb-2">This competition ends in:</p>

            <div class="clock" data-clock="{{ Carbon\Carbon::parse($gop->edate)->format('Y-m-d h:i:s') }}">
            </div>

            {{-- <div class="clock" data-clock="2023/12/10"></div> --}}
          </div><!-- clock-wrapper end -->
        </div>
        <div class="col-lg-12">
          <div class="contest-cart">
            <div class="contest-cart__left">
              <div class="contest-cart__slider-area">
                <div class="contest-cart__thumb-slider">
                    @php
                    $photos =explode(',',$gop->photo);
                @endphp
                 @foreach ($photos as $key=>$photo )
                 <div class="single-slide">
                    <img src="{{$gop->photo}}" alt="image" width="250px" ></div>
                    {{-- <img src="{{$photo[0]}}" alt="image"></div> --}}

                 @endforeach
                  {{-- <div class="single-slide"><img src="{{asset('frontend2/assets/images/contest/b1.png')}}" alt="image"></div> --}}
                </div><!-- contest-cart__thumb-slider end -->
                <div class="contest-cart__nav-slider">

                    @php
                    $photos =explode(',',$gop->photo);
                @endphp
                  <div class="single-slide">
                    <img src="{{$gop->photo}}" alt="image">
                </div>

                </div><!-- contest-cart__nav-slider end -->
              </div>
            </div><!-- contest-cart__left end -->
            <div class="contest-cart__right">
              <h4 class="subtitle">Enter now for a chance to win</h4>
              <h3 class="contest-name">{{$gop->title}}</h3>
              <p>This competition has a maximum of  entries.</p>
              <div class="contest-num">Contest no: <span>B2T</span></div>
              <h4>Tickets Sold</h4>
              <div class="ticket-amount">
                <span class="left">0</span>
                <span class="right"></span>
                <div class="progressbar" data-perc="70%">
                  <div class="bar"></div>
                </div>
                <p>{{$gop->price}}</p>
              </div>
              <div class="ticket-price">
                <span class="amount">{{$gop->showPrice}}</span>
                <small>Per ticket</small>
              </div>
              <div class="d-flex flex-wrap align-items-center mb-30">
                <div class="select-quantity">
                  <span class="caption">Quantity</span>
                  <div class="quantity">
                    <input type="number"  min="0" value="1"  step="1" id="innum" onclick="Calculate()" value="calculate" >


                  </div>
                </div><!-- select-quantity end -->
                <div class="mt-sm-0 mt-3">
                    <a href="#0"
                    data-quantity="1" data-product-id="{{$gop->id}}"
                    id="add_to_cart{{$gop->id}}"
                    class="add_to_cart cmn-btn style--three"

                    >buy tickets</a>
                    {{--  cmn-btn style--three --}}
                </div>
              </div>
              <ul class="social-links align-items-center" style="display: flex;flex-direction: row;flex-wrap: nowrap;">
                <li>Share :</li>

                <div class="sharemedia" >
                    {!! $shareComponent !!}
                </div>



                {{-- <li><a href="#0"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#0"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#0"><i class="fab fa-linkedin-in"></i></a></li> --}}
              </ul>
            </div><!-- contest-cart__right end -->
          </div><!-- contest-cart end -->
        </div><!-- col-lg-12 end -->
        <div class="col-lg-10">
          <div class="contest-description">
            <ul class="nav nav-tabs justify-content-center mb-30 pb-4 border-0" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="cmn-btn active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" role="tab" aria-controls="description" aria-selected="true"><span class="mr-3"></span> description</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="cmn-btn" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" role="tab" aria-controls="details" aria-selected="false"><span class="mr-3"></span>competition details</button>
              </li>
            </ul>

            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                <div class="content-block">
                  <h3 class="title">Box Details</h3>
                  <p>
                    {{$gop->discreption}}
                     </p>
                     @if (count($gop->products)>0)
                         @foreach ( $gop->products as $item )
                            {{ $item->summary}}
                            {{ $item->name}}
                            {{ $item->price}}


                </div><!-- content-block end -->
                <div class="content-block">
                  <h3 class="title">Specifications</h3>
                  <div class="row">

                        <p>
                            {{ $item->summary}}
                        </p>

                    <div class="col-lg-4 col-sm-6 mb-30">

                    </div>
                    <div class="col-lg-4 col-sm-6 mb-30">

                    </div>
                    <div class="col-lg-4 col-sm-6 mb-30">

                    </div>
                    <div class="col-lg-4 col-sm-6 mb-30">

                    </div>
                    <div class="col-lg-4 col-sm-6 mb-30">

                    </div>
                    <div class="col-lg-4 col-sm-6 mb-30">

                    </div>
                  </div>
                </div><!-- content-block end -->

                @endforeach
                @else

                @endif

              </div>
              <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                <div class="content-block">
                  <h3 class="title">Competition Details</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed ex eget mi sollicitudin consequat. Sed rhoncus ligula vel justo dignissim aliquam. Maecenas non est vitae ipsum luctus feugiat. Fusce purus nunc, sodales at condimentum sed, ullamcorper a nulla. Nam justo est, venenatis quis tellus in, volutpat eleifend nunc. Vestibulum congue laoreet mi non interdum. Ut ut dapibus tellus.</p>
                </div><!-- content-block end -->
              </div>
            </div><!-- tab-content end -->
          </div><!-- contest-description end -->
        </div>
      </div>
    </div>
  </section>
  <script src="{{asset('frontend2/assets/js/vendor/jquery-3.5.1.min.js')}}"></script>



  @include('frontend.layouts.footer')

  <!-- Go To Top
  ============================================= -->
  {{-- <div id="gotoTop" class="icon-angle-up"></div> --}}

@include('frontend.layouts.script')


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>

$(document).on('click','.cart_delete',function(e){
  e.preventDefault();
  var cart_id = $(this).data('id');

   //alert(cart_id);

  // alert(product_id);
  var token = "{{csrf_token()}}";
  var path = "{{route('cart.delete')}}";
  $.ajax({
      url:path,
      type:"POST",
      dataType:"JSON",
      data:{
          cart_id:cart_id,
          _token:token,
      },

      success: function(data){
          console.log(data);
          $('body #header-ajax').html(data['header'])
           if (data['status']) {
              swal({
                  title: "Good job!",
                  text:  data['message'],
                  icon: "success",
                  button: "Aww yiss!",
                  });
           }
      },
      error:function(err){
          console.log(err);
      }
  });
});

</script>


</body>
</html>




<script>
    let button = document.querySelector('top-cart');

    button.addEventListener('click', function() {
       // e.preventDefault()
        console.log('button');
    button.classList.add('top-cart-open');
});
</script>
  <script>


function Calculate() {
    var innum = document.getElementById("innum").value;


   // alert(innum);
}


    // alert ("#totalPersons"),
  </script>
   <script>
           $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  </script>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

    $(document).on('click','.add_to_cart',function(e){
         e.preventDefault();
        //var innum = document.getElementById("innum").value;

        var product_id = $(this).data('product-id');
       // var product_qty = $(this).data('quantity');

       var product_qty = document.getElementById("innum").value;

        //alert(product_qty);
        var token = "{{csrf_token()}}";
        var path = "{{route('cart.store')}}";
        $.ajax({
            url:path,
            type:"POST",
            dataType:"JSON",
            data:{
                product_id:product_id,
                product_qty:product_qty,
                _token:token,
            },
            beforeSend:function () {
                $('#add_to_cart'+product_id).html('<i class="fa fa-spinner"> </i> loading...');
            },
            complete:function () {
                $('#add_to_cart'+product_id).html('<i class="fa fa-cart-plus"> </i> add to cart...');

            },
            success: function(data){
                //console.log(data);
                $('body  #header-ajax').html(data['header']);

                // $('body #header-ajax').html(data['header'])
             $('body #cart_count').html(data['cart_count'])

                 if (data['status']) {
                    swal({
                        title: "Good job!",
                        text:  data['message'],
                        icon: "success",
                        button: "you are Next Winner ",
                        });

                 } else {
                     alert('false')
                }
            }
        });
    });
</script>
<script>

    $(document).on('click','.cart_delete',function(e){
        // e.preventDefault();
        var cart_id = $(this).data('id');

        // alert(cart_id);
        var product_qty = $(this).data('quantity');
        // alert(product_id);
        var token = "{{csrf_token()}}";
        var path = "{{route('cart.delete')}}";
        $.ajax({
            url:path,
            type:"POST",
            dataType:"JSON",
            data:{
                product_id:product_id,
                product_qty:product_qty,
                _token:token,
            },
            beforeSend:function () {
                $('#add_to_cart'+product_id).html('<i class="fa fa-spinner"> </i> loading...');
            },
            complete:function () {
                $('#add_to_cart'+product_id).html('<i class="fa fa-cart-plus"> </i> add to cart...');

            },
            success: function(data){
                console.log(data);
                $('body #header-ajax').html(data['header'])
                 if (data['status']) {
                    swal({
                        title: "Good job!",
                        text:  data['message'],
                        icon: "success",
                        button: "Aww yiss!",
                        });
                 } else {
                     alert('false')
                }

            }
        });
    });

</script>




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
                         $(this).html( event.strftime('<span><b>%D</b> Days</span> <span><b>%-H</b> Hrs</span> <span><b>%M</b> Mins</span> <span><b>%S</b> Secs</span>'));
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

{{--
@endsection --}}
