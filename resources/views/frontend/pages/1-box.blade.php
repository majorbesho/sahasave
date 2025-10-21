@extends('frontend.layouts.master')

{!! SEOMeta::generate() !!}
{!! OpenGraph::generate() !!}
{!! Twitter::generate() !!}
{!! JsonLd::generate() !!}
{{-- {!! JsonLdMulti::generate() !!} --}}
{!! SEO::generate() !!}
{!! SEO::generate(true) !!}
{!! app('seotools')->generate() !!}


@section('content')
    <div id="popupbox" class="popup-container">
        <div class="popup-content">
            <div class="containerpop">
                <div class="container popupedit">
                    <div class="row">
                        <a href="#participate" class="close">&times;</a>
                        <div class="col-lg-12 ">
                            <div class="col-lg-12  popupbtn ">
                                <a class="cmn-btn style--two pop-f-a"
                                    style="
                                margin-top: 2%;
                                margin-bottom: 4%;
                                width: 100%;
                                text-align: center;
                                margin-top: 2%;
                                width: 100%;
                                padding: 2%;
                                background: linear-gradient(180deg, rgb(251, 185, 54) 0%, rgba(255,145,0,1) 100%);
                                font-style: italic;
                                font-size: 1.4rem;
                                text-shadow: 1px 1px 3px black;
                                font-weight: 900; "
                                    href="{{ route('home') }}#myTabContent"> Shopping </a>
                                <a class="cmn-btn style--two d-flex align-items-center"
                                    style="margin-bottom: 4%;width: 100%;justify-content: center;"
                                    href="{{ route('stripe') }}#profile-tab"> checkout </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="inner-hero-section-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="page-list">

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="pb-120 mt-minus-300">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="cart-wrapper">
                        <div class="row justify-content-lg-between">

                            <div class="col-lg-8">


                                <div class="contest-cart__thumb-slider">
                                    @php
                                        $photos = explode(',', $gop->photo);
                                    @endphp
                                    @foreach ($photos as $key => $photo)
                                        <div class="single-slide">
                                            <img src="{{ $photo }}" alt="image" width="250px"
                                                style="border-radius: 25px;max-width: 100%;">
                                        </div>

                                    @endforeach
                                </div>
                                <div class="contest-cart__nav-slider">
                                    @php
                                        $photosx = explode(',', $gop->photo);
                                    @endphp
                                    @foreach ($photosx as $key => $photosx)
                                        <div class="single-slide">
                                            <img src="{{ $photosx }}" alt="image"
                                                style="border-radius: 25px; height: 80%;box-shadow: 2px 1px 7px 3px rgba(0, 0, 0, 0.1);">

                                        </div>
                                    @endforeach

                                </div><!-- contest-cart__nav-slider end -->
                            </div>
                            <div class="col-lg-4 mt-lg-0 mt-4">
                                <div class="checkout-wrapper">
                                    <div class="checkout-wrapper__body">
                                        <div class="checkout-wrapper__header">
                                            <h3 style="color: #000"> {{ $gop->title }}</h3>
                                        </div>
                                        <hr>
                                        <div class="price">
                                            <div class="left">
                                                <h4 class="caption" style="color:#000">Price Offer</h4>
                                                <span>Only</span>
                                            </div>
                                            <div class="right">
                                                <div class="oldprice">
                                                    <span class="oldprice" style="color:#f00"> {{ $gop->price }}
                                                        AED <span tyle="padding-left: 2px;"> 50% Off</span></span>
                                                </div>
                                                <div class="price">
                                                    <span class="price" style="color:#000"> {{ $gop->showPrice }}
                                                        AED</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="contest-cart__right">
                                            <div class=" flex-wrap align-items-center mb-30">
                                                <div class="select-quantity">
                                                    <span class="caption">Quantity</span>
                                                    <div class="quantity">
                                                        <input style="color: #000" type="number" min="1"
                                                            value="1"id="innum">
                                                    </div>



                                                    <script>
                                                        jQuery(
                                                                '<div class="quantity-nav"><div class="quantity-button quantity-down"><i class="las la-minus"></i></div><div class="quantity-button quantity-up"><i class="las la-plus"></i></div></div>')
                                                            .insertAfter('.quantity input');
                                                        jQuery('.quantity').each(function() {
                                                            var spinner = jQuery(this),
                                                                input = spinner.find('input[type="number"]'),
                                                                btnUp = spinner.find('.quantity-up'),
                                                                btnDown = spinner.find('.quantity-down'),
                                                                min = input.attr('min'),
                                                                max = input.attr('max');

                                                            btnUp.on('click', function() {
                                                                var oldValue = parseFloat(input.val());

                                                                if (oldValue >= max) {
                                                                    var newVal = oldValue;
                                                                } else {
                                                                    var newVal = oldValue + 1;
                                                                }
                                                                //    console.log(newVal);
                                                                spinner.find("input").val(newVal);
                                                                spinner.find("input").trigger("change");
                                                            });

                                                            btnDown.on('click', function() {
                                                                var oldValue = parseFloat(input.val());
                                                                if (oldValue <= min) {
                                                                    var newVal = oldValue;
                                                                } else {
                                                                    var newVal = oldValue - 1;
                                                                }
                                                                spinner.find("input").val(newVal);
                                                                spinner.find("input").trigger("change");
                                                            });
                                                        });
                                                    </script>
                                                </div><!-- select-quantity end -->
                                                <div class="mt-sm-0 mt-3 click-to-buy">
                                                    <a href="#0" data-quantity="1"
                                                        data-product-id="{{ $gop->id }}"
                                                        id="add_to_cart{{ $gop->id }}"
                                                        class="add_to_cart cmn-btn style--three">Participate</a>
                                                </div>
                                                <div class="mt-sm-0 mt-3 click-to-buy2" style="padding-top: 4%;">
                                                    <a href="{{ route('stripe.get.v') }}" data-quantity="1"
                                                        data-product-id="{{ $gop->id }}"
                                                        data-product-type="1"
                                                        id="add_to_cartx{{ $gop->id }}"
                                                        class="add_to_cartx cmn-btn style--three" style="width: 100%;">Buy Now
                                                    </a>
                                                </div>
                                            </div>
                                            <p style="color: #000;">Ends in</p>
                                            <div class="wrap-countdown mercado-countdown"
                                                data-expire="{{ Carbon\Carbon::parse($gop->edate)->format('Y/m/d h:i:s') }}">
                                            </div>
                                            <ul class="social-links align-items-center"
                                                style="display: flex;flex-direction: row;flex-wrap:wrap;">
                                                <li style="color: #000;">Share :</li>
                                                <div class="sharemedia">{!! $shareComponent !!}</div>
                                            </ul>
                                        </div><!-- contest-cart__right end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 pt-200" style="padding-top: 2%;">
                            <div class="contest-description">
                                <ul class="nav nav-tabs justify-content-center mb-30 pb-4 border-0" id="myTab"
                                    role="tablist" style="padding-top: 1.8rem;">


                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                                        aria-labelledby="description-tab">
                                        <div class="content-block">
                                            <h3 class="title" style="color:#000;">Box Details</h3>

                                            <p style="color: #000;padding-bottom: 30px;">
                                                {!! $gop->discreption !!}
                                            </p>
                                            @if (count($gop->products) > 0)
                                                @foreach ($gop->products as $item)
                                                    {!! $item->summary !!}
                                                    {{ $item->name }}
                                                    {{ $item->price }}
                                        </div><!-- content-block end -->
                                        <div class="content-block">
                                            <h3 class="title">Specifications</h3>
                                            <div class="row">

                                                <p>
                                                    {!! $item->summary !!}
                                                </p>

                                                <div class="col-lg-4 col-sm-6 mb-30">

                                                </div>

                                            </div>
                                        </div><!-- content-block end -->
                                        @endforeach
                                    @else
                                        @endif
                                    </div>
                                </div><!-- tab-content end -->
                            </div><!-- contest-description end -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- col-lg-12 -->
        </div>
        </div>
    </section>






    <script src="{{ asset('frontend4/js/vendor/jquery-3.5.1.min.js') }}"></script>

    @include('frontend.layouts.script')
    {{--
@include('frontend.layouts.footer') --}}

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>






    <script>
        $(document).on('click', '.add_to_cart', function(e) {
            e.preventDefault();

            var product_id = $(this).data('product-id');
            // var product_qty = $(this).data('quantity');

            var product_qty = document.getElementById("innum").value;
            //alert(product_qty);
            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.store') }}";
            var redic = "{{ route('cart') }}"
            var redichome = "{{ route('home') }}"

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



                            title: "Good job!",
                            text: data['message'],
                            icon: "success",
                            // button: "Go to Checkout",
                            // button: "continue shopping",
                        }).then(function(result) {
                            if (true) {
                                window.location = redic;
                            }
                        })
                        if (cancel) {
                            window.location = redichome;
                        }

                    } else {
                        alert('false')
                    }
                }
            });
        });
    </script>


{{-- <script>
    $(document).on('click', '.add_to_cart2', function(e) {
        e.preventDefault();

        var product_id = $(this).data('product-id');
        // var product_qty = $(this).data('quantity');

        var product_qty = document.getElementById("innum").value;
        //alert(product_qty);
        var token = "{{ csrf_token() }}";
        var path = "{{ route('cart.store2') }}";
        var redic = "{{ route('cart') }}"
        var redichome = "{{ route('home') }}"

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



                        title: "Good job!",
                        text: data['message'],
                        icon: "success",
                        // button: "Go to Checkout",
                        // button: "continue shopping",
                    }).then(function(result) {
                        if (true) {
                            window.location = redic;
                        }
                    })
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



    <script>
        $(document).on('click', '.add_to_cartx', function(e) {
            e.preventDefault();
            //var innum = document.getElementById("innum").value;

            var product_id = $(this).data('product-id');
             var product_qty = $(this).data('quantity');
             var product_type =$(this).data('product-type');

            var product_qty = document.getElementById("innum").value;

           //alert(product_type);
            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.storex') }}";
            //alert(product_type);
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

                    // if (data['status']) {
                    //     swal({
                    //         title: "Good job!",
                    //         text: data['message'],
                    //         icon: "success",
                    //         button: "Go to Checkout ",
                    //     });

                    // } else {
                    //     alert('false')
                    // }
                }
            });
        });
    </script>


    <script>
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
                            title: "Good job!",
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
    </script>


    {{--
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script> --}}

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script>
        $(document).on('click', '.cart_delete', function(e) {
            e.preventDefault();
            var cart_id = $(this).data('id');

            alert(cart_id);
            var product_qty = $(this).data('quantity');
            // alert(product_id);
            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.delete') }}";
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
                        '<i class="fa fa-cart-plus"> </i> add to cart...');

                },
                success: function(data) {
                    console.log(data);
                    $('body #header-ajax').html(data['header'])
                    if (data['status']) {
                        swal({
                            title: "Good job!",
                            text: data['message'],
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

    <script src="{{ asset('frontend4/js/vendor/jquery.countdown.js') }}"></script>

    <script>
        ;
        (function($) {

            var MERCADO_JS = {
                init: function() {
                    this.mercado_countdown();

                },
                mercado_countdown: function() {
                    if ($(".mercado-countdown").length > 0) {
                        $(".mercado-countdown").each(function(index, el) {
                            var _this = $(this),
                                _expire = _this.data('expire');
                            _this.countdown(_expire, function(event) {
                                $(this).html(event.strftime(
                                    '<span><b>%D</b> <label class="unit">Days</label></span> <span><b>%-H</b> <label class="unit">Hours</label></span> <span><b>%M</b> <label class="unit">Minutes</label></span> <span><b>%S</b> <label class="unit">Seconds</label></span>'
                                ));
                            });
                        });
                    }
                },

            }

            window.onload = function() {
                MERCADO_JS.init();
            }

        })(window.Zepto || window.jQuery, window, document);
    </script>


@endsection


{{-- // https://stackoverflow.com/questions/35884752/error-in-slick-js-uncaught-typeerror-cannot-read-property-add-of-null --}}
