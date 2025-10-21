@extends('frontend.layouts.master')

@section('content')

    <body class="product_page">
        <!-- ekka Cart End -->
        <!-- Ec breadcrumb start -->
        <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row ec_breadcrumb_inner">
                            <div class="col-md-6 col-sm-12">
                                <h2 class="ec-breadcrumb-title"> Products</h2>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <!-- ec-breadcrumb-list start -->
                                <ul class="ec-breadcrumb-list">
                                    <li class="ec-breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="ec-breadcrumb-item active">Products</li>
                                </ul>
                                <!-- ec-breadcrumb-list end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ec breadcrumb end -->

        <!-- Sart Single product -->
        <section class="ec-page-content section-space-p">
            <div class="container">
                <div class="row">
                    <div class="ec-pro-rightside ec-common-rightside col-lg-12 col-md-12">

                        <!-- Single product content Start -->
                        <div class="single-pro-block">
                            <div class="single-pro-inner">
                                <div class="row">
                                    <div class="single-pro-img single-pro-img-no-sidebar">
                                        <div class="single-product-scroll">
                                            <a class="ec-header-btn ec-header-wishlist ec-video-icon"
                                                data-link-action="quickview" title="Product Player" data-bs-toggle="modal"
                                                data-bs-target="#ec_product_player_modal">
                                                <div class="header-icon"><i class="fi-rr-video-camera-alt"></i></div>
                                            </a>
                                            <div class="single-product-cover">
                                                @php
                                                    $photos = explode(',', $gop->photo);
                                                @endphp

                                                @foreach ($photos as $key => $photo)
                                                    <div class="single-slide zoom-image-hover">
                                                        <img class="img-responsive" src="{{ $photo }}"
                                                            alt="">
                                                    </div>
                                                @endforeach

                                            </div>
                                            <div class="single-nav-thumb">
                                                @foreach ($photos as $key => $photox)
                                                    <div class="single-slide">
                                                        <img class="img-responsive" src="{{ $photox }}"
                                                            alt="">
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-pro-desc single-pro-desc-no-sidebar">
                                        <div class="single-pro-content">


                                            <h5 class="ec-single-title">{{ $gop->title }}</h5>
                                            <div class="ec-single-rating-wrap">
                                                <div class="ec-single-rating">
                                                    <i class="ecicon eci-star fill"></i>
                                                    <i class="ecicon eci-star fill"></i>
                                                    <i class="ecicon eci-star fill"></i>
                                                    <i class="ecicon eci-star fill"></i>
                                                    <i class="ecicon eci-star-o"></i>
                                                </div>
                                                <span class="ec-read-review"><a href="#ec-spt-nav-review">Be the first to
                                                        review this product</a></span>
                                            </div>
                                            <div class="ec-single-desc">{{ $gop->discreption }}</div>

                                            <div class="ec-single-sales">
                                                <div class="ec-single-sales-inner">
                                                    <div class="ec-single-sales-title">sales accelerators</div>
                                                    <div class="ec-single-sales-visitor">real time <span>24</span> visitor
                                                        right now!</div>
                                                    <div class="ec-single-sales-progress">
                                                        <span class="ec-single-progress-desc">Hurry up!left
                                                            {{ $gop->stok }} in
                                                            stock</span>
                                                        <span class="ec-single-progressbar"></span>
                                                    </div>
                                                    <div class="ec-single-sales-countdown">
                                                        <div class="ec-single-countdown"><span
                                                                id="ec-single-countdown"></span></div>
                                                        <div class="ec-single-count-desc">Time is Running Out!</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ec-single-price-stoke">
                                                <div class="ec-single-price">
                                                    <span class="ec-single-ps-title">As low as</span>
                                                    <span class="new-price">{{ $gop->showPrice }} AED</span>
                                                </div>
                                                <div class="ec-single-stoke">
                                                    <span class="ec-single-ps-title">IN STOCK</span>
                                                    <span class="ec-single-sku">{{ $gop->stock }}</span>
                                                </div>
                                            </div>


                                            <div class="ec-single-qty">
                                                <div class="qty-plus-minus">
                                                    <input class="qty-input" type="text" name="ec_qtybtn"
                                                        value="1" />
                                                </div>
                                                <div class="ec-single-cart ">


                                                    {{--
                                                    <a class="ec-add-to-cart add_to_cart" title="Add To Cart" data-quantity="1"
                                                    data-qty="1" data-product-id="{{ $boxPopulars->id }}"
                                                    data-id="{{ $boxPopulars->id }}
                                                id="add_to_cart{{ $boxPopulars->id }}">
                                                    ADD TO CART
                                                </a> --}}



                                                    <a href="#0" data-product-id="{{ $gop->id }}"
                                                        id="add_to_cart{{ $gop->id }}"
                                                        class="btn btn-primary add_to_cart add-to-cart">
                                                        Add To
                                                        Cart</a>
                                                </div>
                                                <div class="ec-single-wishlist">
                                                    <a class="ec-btn-group wishlist" title="Wishlist"><i
                                                            class="fi-rr-heart"></i></a>
                                                </div>
                                                <div class="ec-single-quickview">
                                                    <a href="#" class="ec-btn-group quickview"
                                                        data-link-action="quickview" title="Quick view"
                                                        data-bs-toggle="modal" data-bs-target="#ec_quickview_modal"><i
                                                            class="fi-rr-eye"></i></a>
                                                </div>
                                            </div>
                                            <div class="ec-single-social">
                                                <ul class="mb-0">
                                                    <li class="list-inline-item facebook">Share :</li>
                                                    <div class="sharemedia">{!! $shareComponent !!}</div>

                                                </ul>
                                            </div>

                                            <div class="container" style="padding-top: 9%;">
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <div class="section-title">
                                                            <h2 class="ec-bg-title">Related Product</h2>
                                                            <h2 class="ec-title"> Related Product</h2>
                                                            <p class="sub-title">Browse The Collection of Top Related
                                                                Product</p>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="row">
                                                    @php
                                                        $related = explode(',', $gop->related_id);
                                                    @endphp

                                                    @foreach ($related as $relateds)
                                                        {{-- <p>{{ $relateds }} </p> --}}

                                                        @php
                                                            $product = App\Models\groupProduct::where([
                                                                'id' => $relateds,
                                                            ])->get();
                                                            // dd($product);
                                                        @endphp

                                                        @foreach ($product as $products)
                                                            <div class="col-lg-3 col-md-6 col-sm-6">
                                                                <div class="ec-product-sup">
                                                                    <div class="ec-product-image">

                                                                        <a href="{{ route('groupOfProduct', $products->slug) }}"
                                                                            class="ec-image">
                                                                            @php
                                                                                $photos = explode(
                                                                                    ',',
                                                                                    $products->photo,
                                                                                );
                                                                            @endphp

                                                                            <img class="pic-1" src="{{ $photos[0] }}"
                                                                                alt="" />
                                                                            <img class="pic-2" src="{{ $photos[1] }}"
                                                                                alt="" />

                                                                        </a>
                                                                        <span class="ec-product-sale-label">sale!</span>
                                                                        <ul class="ec-social">
                                                                            <li>
                                                                                <a href="javascript:void(0);"
                                                                                    class="ec-btn-group wishlist add_to_wishlist"
                                                                                    data-quantity="1" data-qty="1"
                                                                                    data-id="{{ $products->id }}"
                                                                                    id="add_to_wishlist_{{ $products->id }}"
                                                                                    data-product-id="{{ $products->id }}"
                                                                                    title="Wishlist">
                                                                                    <i class="fi-rr-heart"></i>
                                                                                </a>
                                                                            </li>
                                                                            <li><a href="#"><i
                                                                                        class="fi fi-rr-arrows-repeat"></i></a>
                                                                            </li>

                                                                            <li><a
                                                                                    href="{{ route('groupOfProduct', $products->slug) }}">
                                                                                    <i class="fi-rr-eye"></i></a></li>

                                                                        </ul>
                                                                        <div class="ec-product-rating">
                                                                            <ul class="ec-rating">
                                                                                <li class="ecicon eci-star fill"></li>
                                                                                <li class="ecicon eci-star fill"></li>
                                                                                <li class="ecicon eci-star fill"></li>
                                                                                <li class="ecicon eci-star fill"></li>
                                                                                <li class="ecicon eci-star"></li>
                                                                            </ul>
                                                                            <a class="ec-add-to-cart add_to_cart"
                                                                                title="Add To Cart" data-quantity="1"
                                                                                data-qty="1"
                                                                                data-product-id="{{ $products->id }}"
                                                                                data-id="{{ $products->id }}
                                                                            id="add_to_cart{{ $products->id }}">
                                                                                ADD TO CART </a>

                                                                        </div>
                                                                    </div>
                                                                    <div class="ec-product-body">
                                                                        <h3 class="ec-title">
                                                                            <a
                                                                                href="{{ route('groupOfProduct', $products->slug) }}">{{ $products->title }}</a>

                                                                        </h3>
                                                                        <div class="ec-price">
                                                                            <span>AED{{ $products->price }}</span>
                                                                            AED{{ $products->showPrice }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endforeach
                                                    <!-- New Product Content -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Single product content End -->
                        <!-- Single product tab start -->
                        <div class="ec-single-pro-tab">
                            <div class="ec-single-pro-tab-wrapper">
                                <div class="ec-single-pro-tab-nav">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#ec-spt-nav-details" role="tablist">Detail</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-info"
                                                role="tablist">More Information</a>
                                        </li>
                                        {{-- <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-review"
                                                role="tablist">Reviews</a>
                                        </li> --}}
                                    </ul>
                                </div>
                                <div class="tab-content  ec-single-pro-tab-content">
                                    <div id="ec-spt-nav-details" class="tab-pane fade show active">
                                        <div class="ec-single-pro-tab-desc">
                                            <p>
                                                {{ $gop->discreption }}
                                            </p>
                                            <ul>


                                            </ul>
                                        </div>
                                    </div>
                                    <div id="ec-spt-nav-info" class="tab-pane fade">
                                        <div class="ec-single-pro-tab-moreinfo">
                                            <ul>

                                                <li><span>Directions</span> {{ $gop->Directions }}</li>
                                                <li><span>Ingredients</span> {{ $gop->Ingredients }}</li>
                                                <li><span>dose</span> {{ $gop->dose }}</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- product details description area end -->
                    </div>

                </div>
            </div>
        </section>



        <!-- Modal Video -->
        <div class="modal fade" id="ec_product_player_modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body ec-product-player">
                        <a href="#" class="btn btn-lg btn-secondary qty_close" data-bs-dismiss="modal"
                            aria-label="Close">Close</a>
                        <!--HTML5 Video Plyr.io -->
                        <div class="ec-player-wrapper">
                            <video poster="assets/images/banner/9.jpg" class="js-player" autoplay muted crossorigin
                                playsinline controls>
                                <source src="{{ $gop->Caturl }}" />
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end -->



        <!-- Footer navigation panel for responsive display -->
        <div class="ec-nav-toolbar">
            <div class="container">
                <div class="ec-nav-panel">
                    <div class="ec-nav-panel-icons">
                        <a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle"><i
                                class="fi-rr-menu-burger"></i></a>
                    </div>
                    <div class="ec-nav-panel-icons">
                        <a href="#ec-side-cart" class="toggle-cart ec-header-btn ec-side-toggle"><i
                                class="fi-rr-shopping-bag"></i><span
                                class="ec-cart-noti ec-header-count cart-count-lable">3</span></a>
                    </div>
                    <div class="ec-nav-panel-icons">
                        <a href="index.html" class="ec-header-btn"><i class="fi-rr-home"></i></a>
                    </div>
                    <div class="ec-nav-panel-icons">
                        <a href="wishlist.html" class="ec-header-btn"><i class="fi-rr-heart"></i><span
                                class="ec-cart-noti">4</span></a>
                    </div>
                    <div class="ec-nav-panel-icons">
                        <a href="login.html" class="ec-header-btn"><i class="fi-rr-user"></i></a>
                    </div>

                </div>
            </div>
        </div>
        <!-- Footer navigation panel for responsive display end -->







        <!-- Feature tools -->
        <div class="ec-tools-sidebar-overlay"></div>


















        {{-- add to cart buy --}}
        {{-- <script>
            $(document).on('click', '.add_to_cartby', function(e) {
                // console.log("in")
                e.preventDefault();
                var product_id = $(this).data('product-id');
                var product_type = 0;
                // var product_qty = $(this).data('quantity');
                var product_qty = document.getElementById("innum").value;
                //alert(product_type);
                var token = "{{ csrf_token() }}";
                var path = "{{ route('cart.store') }}";
                //alert(token);
                $.ajax({
                    url: path,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        product_id: product_id,
                        product_qty: product_qty,
                        product_type: product_type,
                        _token: token,
                    },
                    beforeSend: function() {
                        $('#add_to_cart' + product_id).html('<i class="fa fa-spinner"> </i> loading...');
                    },
                    complete: function() {
                        $('#add_to_cart' + product_id).html(
                            '<i class="fa fa-cart-plus"> </i> added to cart...');
                    },
                    success: function(data) {
                        console.log(data);
                        $('body  #header-ajax').html(data['header']);

                        // $('body #header-ajax').html(data['header'])
                        $('body #cart_count').html(data['cart_count'])

                        if (data['status']) {
                            swal({
                                title: ' <input type="checkbox" name="chk" id=""> i accept terms and asdaaa!',
                                text: data['message'],
                                icon: "success",
                                button: "Go to Checkoutx ",
                            });

                        } else {
                            alert('false')
                        }
                    }
                });
            });
        </script>



        <script>
            const {
                value: accept
            } = await Swal.fire({
                    title: 'Terms and conditions',
                    input: 'checkbox',
                    inputValue: 1,
                    inputPlaceholder: 'I agree with the terms and conditions',
                    confirmButtonText: 'Continue <i class="fa fa-arrow-right"></i>',
                    inputValidator: (result) => {
                        return !result && 'You need to agree with T&C'
                    }
                }),

                if (accept) {
                    Swal.fire('You agreed with T&C :)')
                }


            $(document).on('click', '.add_to_cart', function(e) {
                e.preventDefault();

                var product_id = $(this).data('product-id');
                // var product_qty = $(this).data('quantity');

                var product_qty = document.getElementById("innum").value;
                //alert(product_qty);
                var token = "{{ csrf_token() }}";
                var path = "{{ route('cart.store') }}";
                var redic = "{{ route('cart') }}";
                var redichome = "{{ route('home') }}";
                const {
                    value: accept
                } = await Swal.fire;

                $.ajax({
                    url: path,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        product_id: product_id,
                        product_qty: product_qty,
                        _token: token,
                    },
                    beforeSend: function() {
                        $('#add_to_cart' + product_id).html('<i class="fa fa-spinner"> </i> loading...');
                    },
                    complete: function() {
                        $('#add_to_cart' + product_id).html(
                            '<i class="fa fa-cart-plus"> </i> added to cart...');
                    },
                    success: function(data) {
                        console.log(data);
                        $('body  #header-ajax').html(data['header']);
                        $('body #cart_count').html(data['cart_count'])

                        if (data['status']) {
                            swal({

                                buttons: {
                                    cancel: "Item Added",
                                    catch: {
                                        // text: "continue shopping",
                                        text: "Go To Cart",
                                        value: "catch",
                                    },
                                    defeat: false,
                                },



                                input: 'checkbox',
                                inputValue: 1,
                                inputPlaceholder: 'I agree with the terms and conditions',
                                confirmButtonText: 'Continue <i class="fa fa-arrow-right"></i>',


                                // title: 'G  <input type="checkbox" name="chk" id=""> i accept terms and asdaaa!',
                                text: data['message'],
                                icon: "success",
                                // button: "Go to Checkout",
                                // button: "continue shopping",
                            }).then(function(result) {
                                    if (true) {
                                        window.location = redic;
                                    }
                                }

                            )
                            if (cancel) {
                                window.location = redichome;
                            }

                        } else {
                            alert('false')
                        }
                    }
                });
            });
        </script> --}}



        {{--

        <script>
            $(document).on('click', '.add_to_cartx', function(e) {
                e.preventDefault();
                //var innum = document.getElementById("innum").value;

                var product_id = $(this).data('product-id');
                // var product_qty = $(this).data('quantity');

                var product_qty = document.getElementById("innum").value;

                alert(product_qty);
                var token = "{{ csrf_token() }}";
                var path = "{{ route('cart.storex') }}";
                //alert(token);
                $.ajax({
                    url: path,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        product_id: product_id,
                        product_qty: product_qty,
                        _token: token,
                    },
                    beforeSend: function() {
                        $('#add_to_cart' + product_id).html('<i class="fa fa-spinner"> </i> loading...');
                    },
                    complete: function() {
                        $('#add_to_cart' + product_id).html(
                            '<i class="fa fa-cart-plus"> </i> added to cart...');
                    },
                    success: function(data) {
                        console.log(data);
                        $('body  #header-ajax').html(data['header']);

                        // $('body #header-ajax').html(data['header'])
                        $('body #cart_count').html(data['cart_count'])

                        if (data['status']) {
                            swal({
                                title: ' <input type="checkbox" name="chk" id=""> i accept terms and asdaaa!',
                                text: data['message'],
                                icon: "success",
                                button: "Go to Checkout ",
                            });

                        } else {
                            alert('false')
                        }
                    }
                });
            });
        </script>  --}}


        {{-- <script>
            $(document).on('click', '.cart_delete', function(e) {
                e.preventDefault();
                var cart_id = $(this).data('id');

                // alert(cart_id);

                //  alert(product_id);
                var token = "{{ csrf_token() }}";
                var path = "{{ route('cart.delete') }}";
                $.ajax({
                    url: path,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        cart_id: cart_id,
                        _token: token,
                    },

                    success: function(data) {
                        console.log(data);
                        $('body #header-ajax').html(data['header'])
                        if (data['status']) {
                            swal({

                                input: 'checkbox',
                                inputValue: 1,
                                inputPlaceholder: 'I agree with the terms and conditions',
                                confirmButtonText: 'Continue <i class="fa fa-arrow-right"></i>',

                                // title: '<input type="checkbox" name="chk" id=""> i accept terms and asdaaa b!',
                                text: data['message'],
                                icon: "success",
                                button: "Aww yiss!",
                            });
                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
        </script> --}}







        {{-- <script>
            $("#ec-single-countdown").countdowntimer({
                startDate: "2021/10/01 00:00:00",
                dateAndTime: "{{ $gop->edate }}",
                labelsFormat: true,
                displayFormat: "DHMS"
            });
        </script> --}}

        {{-- <script src="{{ asset('frontend/4/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>


        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script> --}}

        {{-- <script>
            $(document).on('click', '.add_to_cart', function(e) {
                e.preventDefault();
                //var innum = document.getElementById("innum").value;

                var product_id = $(this).data('product-id');
                // var product_qty = $(this).data('quantity');

                var product_qty = 1;

                //alert(product_id);
                var token = "{{ csrf_token() }}";
                var path = "{{ route('cart.store') }}";
                window.url = "{{ route('cart') }}";


                //alert(token);
                $.ajax({
                    url: path,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        product_id: product_id,
                        product_qty: product_qty,
                        _token: token,
                    },
                    beforeSend: function() {
                        $('#add_to_cart' + product_id).html('<i class="fa fa-spinner"> </i> loading...');
                    },
                    complete: function() {
                        $('#add_to_cart' + product_id).html(
                            '<i class="fa fa-cart-plus"> </i> added to cart...');
                    },
                    success: function(data) {
                        console.log(data);
                        $('body  #header-ajax').html(data['header']);

                        // $('body #header-ajax').html(data['header'])
                        $('body #cart_count').html(data['cart_count'])

                        if (data['status']) {
                            swal({
                                    title: "Good job!",
                                    text: data['message'],
                                    icon: "success",
                                    button: "Go to Checkout ",
                                })

                                .then(() => {
                                    window.location.href = window.url;
                                    console.log('triggered redirect here');
                                })


                            ;

                        } else {
                            alert('false')
                        }
                    }
                });
            });
        </script> --}}
    @endsection


    {{-- // https://stackoverflow.com/questions/35884752/error-in-slick-js-uncaught-typeerror-cannot-read-property-add-of-null --}}



    {{-- </body>

</html> --}}
