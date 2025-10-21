@extends('frontend.layouts.master')


@section('content')

    <div class="checkout_page">







        @if (Auth::check())
            @php
                $name = explode(' ', auth()->user()->name);
            @endphp
        @endif





        <!-- Ec checkout page -->
        <section class="ec-page-content section-space-p">
            <div class="container">
                <div class="row">
                    <div class="ec-checkout-leftside col-lg-8 col-md-12 ">
                        <!-- checkout content Start -->
                        <div class="ec-checkout-content">
                            <div class="ec-checkout-inner">
                                <div class="ec-checkout-wrap margin-bottom-30">
                                    <div class="ec-checkout-block ec-check-new">
                                        <h3 class="ec-checkout-title">New Customer</h3>
                                        <div class="ec-check-block-content">
                                            <div class="ec-check-subtitle">Checkout Options</div>
                                            <form action="#">
                                                <span class="ec-new-option">
                                                    <span>
                                                        <input type="radio" id="account1" name="radio-group" checked>
                                                        <label for="account1">Sign Up Account</label>
                                                    </span>
                                                    <span>
                                                        <input type="radio" id="account2" name="radio-group">
                                                        <label for="account2">Guest Account</label>
                                                    </span>
                                                </span>
                                            </form>
                                            <div class="ec-new-desc">By creating an account you will be able to shop faster,
                                                be up to date on an order's status, and keep track of the orders you have
                                                previously made.
                                            </div>
                                            <div class="ec-new-btn"><a href="#" class="btn btn-primary">Continue</a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="ec-checkout-block ec-check-login">
                                        <h3 class="ec-checkout-title">Returning Customer</h3>
                                        <div class="ec-check-login-form">
                                            <form action="#" method="post">
                                                <span class="ec-check-login-wrap">
                                                    <label>Email Address</label>
                                                    <input type="text" name="name"
                                                        placeholder="Enter your email address" required />
                                                </span>
                                                <span class="ec-check-login-wrap">
                                                    <label>Password</label>
                                                    <input type="password" name="password" placeholder="Enter your password"
                                                        required />
                                                </span>

                                                <span class="ec-check-login-wrap ec-check-login-btn">
                                                    <button class="btn btn-primary" type="submit">Login</button>
                                                    <a class="ec-check-login-fp" href="#">Forgot Password?</a>
                                                </span>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <div class="ec-checkout-wrap margin-bottom-30 padding-bottom-3">
                                    <div class="ec-checkout-block ec-check-bill">
                                        <h3 class="ec-checkout-title">Billing Details</h3>
                                        <div class="ec-bl-block-content">
                                            <div class="ec-check-subtitle">Checkout Options</div>
                                            <span class="ec-bill-option">
                                                <span>
                                                    <input type="radio" id="bill1" name="radio-group">
                                                    <label for="bill1">I want to use an existing address</label>
                                                </span>
                                                <span>
                                                    <input type="radio" id="bill2" name="radio-group" checked>
                                                    <label for="bill2">I want to use new address</label>
                                                </span>
                                            </span>
                                            <div class="ec-check-bill-form">
                                                <form action="#" method="post">
                                                    <span class="ec-bill-wrap ec-bill-half">
                                                        <label>First Name*</label>
                                                        <input type="text" name="firstname"
                                                            placeholder="Enter your first name" required />
                                                    </span>
                                                    <span class="ec-bill-wrap ec-bill-half">
                                                        <label>Last Name*</label>
                                                        <input type="text" name="lastname"
                                                            placeholder="Enter your last name" required />
                                                    </span>
                                                    <span class="ec-bill-wrap">
                                                        <label>Address</label>
                                                        <input type="text" name="address" placeholder="Address Line 1" />
                                                    </span>
                                                    <span class="ec-bill-wrap ec-bill-half">
                                                        <label>City *</label>
                                                        <span class="ec-bl-select-inner">
                                                            <select name="ec_select_city" id="ec-select-city"
                                                                class="ec-bill-select">
                                                                <option selected disabled>City</option>
                                                                <option value="1">City 1</option>
                                                                <option value="2">City 2</option>
                                                                <option value="3">City 3</option>
                                                                <option value="4">City 4</option>
                                                                <option value="5">City 5</option>
                                                            </select>
                                                        </span>
                                                    </span>
                                                    <span class="ec-bill-wrap ec-bill-half">
                                                        <label>Post Code</label>
                                                        <input type="text" name="postalcode" placeholder="Post Code" />
                                                    </span>
                                                    <span class="ec-bill-wrap ec-bill-half">
                                                        <label>Country *</label>
                                                        <span class="ec-bl-select-inner">
                                                            <select name="ec_select_country" id="ec-select-country"
                                                                class="ec-bill-select">
                                                                <option selected disabled>Country</option>
                                                                <option value="1">Country 1</option>
                                                                <option value="2">Country 2</option>
                                                                <option value="3">Country 3</option>
                                                                <option value="4">Country 4</option>
                                                                <option value="5">Country 5</option>
                                                            </select>
                                                        </span>
                                                    </span>
                                                    <span class="ec-bill-wrap ec-bill-half">
                                                        <label>Region State</label>
                                                        <span class="ec-bl-select-inner">
                                                            <select name="ec_select_state" id="ec-select-state"
                                                                class="ec-bill-select">
                                                                <option selected disabled>Region/State</option>
                                                                <option value="1">Region/State 1</option>
                                                                <option value="2">Region/State 2</option>
                                                                <option value="3">Region/State 3</option>
                                                                <option value="4">Region/State 4</option>
                                                                <option value="5">Region/State 5</option>
                                                            </select>
                                                        </span>
                                                    </span>
                                                </form>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <span class="ec-check-order-btn">
                                    <a class="btn btn-primary" href="#">Place Order</a>
                                </span>
                            </div>
                        </div>
                        <!--cart content End -->
                    </div>
                    <!-- Sidebar Area Start -->
                    <div class="ec-checkout-rightside col-lg-4 col-md-12">
                        <div class="ec-sidebar-wrap">
                            <!-- Sidebar Summary Block -->
                            <div class="ec-sidebar-block">
                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title">Summary</h3>
                                </div>
                                <div class="ec-sb-block-content">
                                    <div class="ec-checkout-summary">
                                        <div>
                                            <span class="text-left">Sub-Total</span>
                                            <span class="text-right">$80.00</span>
                                        </div>
                                        <div>
                                            <span class="text-left">Delivery Charges</span>
                                            <span class="text-right">$80.00</span>
                                        </div>
                                        <div>
                                            <span class="text-left">Coupan Discount</span>
                                            <span class="text-right"><a class="ec-checkout-coupan">Apply Coupan</a></span>
                                        </div>
                                        <div class="ec-checkout-coupan-content">
                                            <form class="ec-checkout-coupan-form" name="ec-checkout-coupan-form"
                                                method="post" action="#">
                                                <input class="ec-coupan" type="text" required=""
                                                    placeholder="Enter Your Coupan Code" name="ec-coupan" value="">
                                                <button class="ec-coupan-btn button btn-primary" type="submit"
                                                    name="subscribe" value="">Apply</button>
                                            </form>
                                        </div>
                                        <div class="ec-checkout-summary-total">
                                            <span class="text-left">Total Amount</span>
                                            <span class="text-right">$80.00</span>
                                        </div>
                                    </div>
                                    <div class="ec-checkout-pro">

                                        <div class="col-sm-12 mb-6">
                                            <div class="ec-product-inner">
                                                <div class="ec-pro-image-outer">
                                                    <div class="ec-pro-image">
                                                        <a href="product-left-sidebar.html" class="image">
                                                            <img class="main-image"
                                                                src="assets/images/product-image/1_1.jpg"
                                                                alt="Product" />
                                                            <img class="hover-image"
                                                                src="assets/images/product-image/1_2.jpg"
                                                                alt="Product" />
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="ec-pro-content">
                                                    <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Baby toy
                                                            teddy bear</a></h5>
                                                    <div class="ec-pro-rating">
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star"></i>
                                                    </div>
                                                    <span class="ec-price">
                                                        <span class="old-price">$95.00</span>
                                                        <span class="new-price">$79.00</span>
                                                    </span>
                                                    <div class="ec-pro-option">
                                                        <div class="ec-pro-color">
                                                            <span class="ec-pro-opt-label">Color</span>
                                                            <ul class="ec-opt-swatch ec-change-img">
                                                                <li class="active"><a href="#"
                                                                        class="ec-opt-clr-img"
                                                                        data-src="assets/images/product-image/1_1.jpg"
                                                                        data-src-hover="assets/images/product-image/1_1.jpg"
                                                                        data-tooltip="Gray"><span
                                                                            style="background-color:#6d4c36;"></span></a>
                                                                </li>
                                                                <li><a href="#" class="ec-opt-clr-img"
                                                                        data-src="assets/images/product-image/1_2.jpg"
                                                                        data-src-hover="assets/images/product-image/1_2.jpg"
                                                                        data-tooltip="Orange"><span
                                                                            style="background-color:#ffb0e1;"></span></a>
                                                                </li>
                                                                <li><a href="#" class="ec-opt-clr-img"
                                                                        data-src="assets/images/product-image/1_3.jpg"
                                                                        data-src-hover="assets/images/product-image/1_3.jpg"
                                                                        data-tooltip="Green"><span
                                                                            style="background-color:#8beeff;"></span></a>
                                                                </li>
                                                                <li><a href="#" class="ec-opt-clr-img"
                                                                        data-src="assets/images/product-image/1_4.jpg"
                                                                        data-src-hover="assets/images/product-image/1_4.jpg"
                                                                        data-tooltip="Sky Blue"><span
                                                                            style="background-color:#74f8d1;"></span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="ec-pro-size">
                                                            <span class="ec-pro-opt-label">Size</span>
                                                            <ul class="ec-opt-size">
                                                                <li class="active"><a href="#" class="ec-opt-sz"
                                                                        data-old="$95.00" data-new="$79.00"
                                                                        data-tooltip="Small">S</a></li>
                                                                <li><a href="#" class="ec-opt-sz" data-old="$90.00"
                                                                        data-new="$70.00" data-tooltip="Medium">M</a></li>
                                                                <li><a href="#" class="ec-opt-sz" data-old="$80.00"
                                                                        data-new="$60.00" data-tooltip="Large">X</a></li>
                                                                <li><a href="#" class="ec-opt-sz" data-old="$70.00"
                                                                        data-new="$50.00"
                                                                        data-tooltip="Extra Large">XL</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="col-sm-12 mb-0">
                                            <div class="ec-product-inner">
                                                <div class="ec-pro-image-outer">
                                                    <div class="ec-pro-image">
                                                        <a href="product-left-sidebar.html" class="image">
                                                            <img class="main-image"
                                                                src="assets/images/product-image/8_1.jpg"
                                                                alt="Product" />
                                                            <img class="hover-image"
                                                                src="assets/images/product-image/8_2.jpg"
                                                                alt="Product" />
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="ec-pro-content">
                                                    <h5 class="ec-pro-title"><a href="product-left-sidebar.html">Smart I
                                                            watch
                                                            2GB</a></h5>
                                                    <div class="ec-pro-rating">
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star"></i>
                                                    </div>
                                                    <span class="ec-price">
                                                        <span class="old-price">$58.00</span>
                                                        <span class="new-price">$45.00</span>
                                                    </span>
                                                    <div class="ec-pro-option">
                                                        <div class="ec-pro-color">
                                                            <span class="ec-pro-opt-label">Color</span>
                                                            <ul class="ec-opt-swatch ec-change-img">
                                                                <li class="active"><a href="#"
                                                                        class="ec-opt-clr-img"
                                                                        data-src="assets/images/product-image/8_2.jpg"
                                                                        data-src-hover="assets/images/product-image/8_2.jpg"
                                                                        data-tooltip="Gray"><span
                                                                            style="background-color:#f3f3f3;"></span></a>
                                                                </li>
                                                                <li><a href="#" class="ec-opt-clr-img"
                                                                        data-src="assets/images/product-image/8_3.jpg"
                                                                        data-src-hover="assets/images/product-image/8_3.jpg"
                                                                        data-tooltip="Orange"><span
                                                                            style="background-color:#fac7f3;"></span></a>
                                                                </li>
                                                                <li><a href="#" class="ec-opt-clr-img"
                                                                        data-src="assets/images/product-image/8_4.jpg"
                                                                        data-src-hover="assets/images/product-image/8_4.jpg"
                                                                        data-tooltip="Green"><span
                                                                            style="background-color:#c5f1ff;"></span></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="ec-pro-size">
                                                            <span class="ec-pro-opt-label">Size</span>
                                                            <ul class="ec-opt-size">
                                                                <li class="active"><a href="#" class="ec-opt-sz"
                                                                        data-old="$48.00" data-new="$45.00"
                                                                        data-tooltip="Small">S</a></li>
                                                                <li><a href="#" class="ec-opt-sz" data-old="$90.00"
                                                                        data-new="$70.00" data-tooltip="Medium">M</a></li>
                                                                <li><a href="#" class="ec-opt-sz" data-old="$80.00"
                                                                        data-new="$60.00" data-tooltip="Large">X</a></li>
                                                                <li><a href="#" class="ec-opt-sz" data-old="$70.00"
                                                                        data-new="$50.00"
                                                                        data-tooltip="Extra Large">XL</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sidebar Summary Block -->
                        </div>
                        <div class="ec-sidebar-wrap ec-checkout-del-wrap">
                            <!-- Sidebar Summary Block -->
                            <div class="ec-sidebar-block">
                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title">Delivery Method</h3>
                                </div>
                                <div class="ec-sb-block-content">
                                    <div class="ec-checkout-del">
                                        <div class="ec-del-desc">Please select the preferred shipping method to use on this
                                            order.</div>
                                        <form action="#">
                                            <span class="ec-del-option">
                                                <span>
                                                    <span class="ec-del-opt-head">Free Shipping</span>
                                                    <input type="radio" id="del1" name="radio-group" checked>
                                                    <label for="del1">Rate - $0 .00</label>
                                                </span>
                                                <span>
                                                    <span class="ec-del-opt-head">Flat Rate</span>
                                                    <input type="radio" id="del2" name="radio-group">
                                                    <label for="del2">Rate - $5.00</label>
                                                </span>
                                            </span>
                                            <span class="ec-del-commemt">
                                                <span class="ec-del-opt-head">Add Comments About Your Order</span>
                                                <textarea name="your-commemt" placeholder="Comments"></textarea>
                                            </span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Sidebar Summary Block -->
                        </div>
                        <div class="ec-sidebar-wrap ec-checkout-pay-wrap">
                            <!-- Sidebar Payment Block -->
                            <div class="ec-sidebar-block">
                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title">Payment Method</h3>
                                </div>
                                <div class="ec-sb-block-content">
                                    <div class="ec-checkout-pay">
                                        <div class="ec-pay-desc">Please select the preferred payment method to use on this
                                            order.</div>
                                        <form action="#">
                                            <span class="ec-pay-option">
                                                <span>
                                                    <input type="radio" id="pay1" name="radio-group" checked>
                                                    <label for="pay1">Cash On Delivery</label>
                                                </span>
                                            </span>
                                            <span class="ec-pay-commemt">
                                                <span class="ec-pay-opt-head">Add Comments About Your Order</span>
                                                <textarea name="your-commemt" placeholder="Comments"></textarea>
                                            </span>
                                            <span class="ec-pay-agree"><input type="checkbox" value=""><a
                                                    href="#">I have
                                                    read and agree to the <span>Terms & Conditions</span></a><span
                                                    class="checked"></span></span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Sidebar Payment Block -->
                        </div>
                        <div class="ec-sidebar-wrap ec-check-pay-img-wrap">
                            <!-- Sidebar Payment Block -->
                            <div class="ec-sidebar-block">
                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title">Payment Method</h3>
                                </div>
                                <div class="ec-sb-block-content">
                                    <div class="ec-check-pay-img-inner">
                                        <div class="ec-check-pay-img">
                                            <img src="{{ asset('frontend/4/assets/images/icons/payment1.png') }}"
                                                alt="">
                                        </div>
                                        <div class="ec-check-pay-img">
                                            <img src="{{ asset('frontend/4/assets/images/icons/payment2.png') }}"
                                                alt="">
                                        </div>
                                        <div class="ec-check-pay-img">
                                            <img src="{{ asset('frontend/4/assets/images/icons/payment3.png') }}"
                                                alt="">
                                        </div>
                                        <div class="ec-check-pay-img">
                                            <img src="{{ asset('frontend/4/assets/images/icons/payment4.png') }}"
                                                alt="">
                                        </div>
                                        <div class="ec-check-pay-img">
                                            <img src="{{ asset('frontend/4/assets/images/icons/payment5.png') }}"
                                                alt="">
                                        </div>
                                        <div class="ec-check-pay-img">
                                            <img src="{{ asset('frontend/4/assets/images/icons/payment6.png') }}"
                                                alt="">
                                        </div>
                                        <div class="ec-check-pay-img">
                                            <img src="{{ asset('frontend/4/assets/images/icons/payment7.png') }}"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sidebar Payment Block -->
                        </div>
                    </div>
                </div>
            </div>
        </section>



    </div>










    <!-- inner-




                                            <div class="checkoutheader">
                                                {{-- <div class="bg-shape"><img src="{{asset('frontend2/assets/images/elements/inner-hero-shape.png')}}" alt="image"></div> --}}
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-lg-12">

                                                            @if ($errors->any())
    <div class="alert alert-danger" id="alert">
                                                                    <ul>
                                                                        @foreach ($errors->all() as $error)
    <li>
                                                                                {{ $error }}
                                                                            </li>
    @endforeach
                                                                    </ul>
                                                                </div>
    @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="checkout-area pb-120 mt-minus-300">

                                                {{-- <form action="{{ route('checkout0.store') }}" method="POST"> --}}
                                            <div class="container" id="shopheader">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="top ">
                                                            <div class="left">
                                                                    @csrf
                                                                    @if (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() > 0)
    @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
    <input type="hidden" name="product-id" value="{{ $item->id }}">
                                                                            <div class="container pb-3 ">
                                                                                <div class="row checkout-item">
                                                                                    <div class="col-lg-3 col-md-2 pb-3">
                                                                                        <img src="{{ $item->model->photo }}" class="cart-thumb pt-3"
                                                                                            alt="{{ $item->name }}" width="75px" height="75px" >
                                                                                    </div>
                                                                                    <div class="col-lg-6 col-md-8 pt-3 ">
                                                                                        <a href="#">{{ $item->name }}</a>
                                                                                        <p class="text-muted">{{ $item->model->discreption }} </p>
                                                                                        <input type="hidden" name="qty"
                                                                                            value="{{ $item->qty }}">

                                                                                        <input type="hidden" name="product-price"
                                                                                            value="{{ $item->price }}">

                                                                                            {{-- <input type="hidden" name="product-id"
                                                value="{{ $item->id }}"> --}}
                                                                                            {{-- <input type="hidden" name="product-id"
                                                value="{{ $item->id }}"> --}}

                                                                                    </div>
                                                                                    <div class="col-lg-3 col-md-2 pt-3">
                                                                                        <p>{{ $item->qty }} x - <span
                                                                                                class="price td-text">{{ $item->price }}</span></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
    @endforeach
                                                                        {{ Cart::subtotal() }}
                                                                        {{-- <a href="{{route('checkout0.store')}}"></a> --}}
@else
    <h1> no item</h1>
    @endif

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-4">
                                                            <div class="checkout-wrapper">
                                                                <div class="checkout-wrapper__header">
                                                                    <h3>order Summary</h3>
                                                                </div>
                                                                <div class="checkout-wrapper__body">
                                                                    <ul class="price">
                                                                        @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
    <li>
                                                                                <div class="left">
                                                                                    <h4 class="caption">Ticket Price</h4>
                                                                                    <span>({{ $item->qty }} tickets X $
                                                                                        {{ $item->price }})</span>
                                                                                </div>
                                                                                <div class="right">
                                                                                    <span class="price">{{ $item->price }} </span>
                                                                                </div>
                                                                            </li>
    @endforeach
                                                                        <li>
                                                                            <div class="left">
                                                                                <h4 class="caption">Total</h4>
                                                                            </div>
                                                                            <div class="right">
                                                                                <span class="price"> {{ Cart::subtotal() }} </span>
                                                                                <input type="hidden"
                                                                                    value="{{ (float) str_replace(',', '', Cart::subtotal()) }}"
                                                                                    name="total">

                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                    {{-- <input type="hidden" name="subtotal" value="{{\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotla}}"> --}}
                                                                    {{-- <div class="personal-details mt-30 d-none">
                            <h3 class="title">Share your Contact Details </h3>
                            <div class="personal-details-form">
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <input type="text" placeholder="Full Name"
                                            value="{{ $name[0] }}" readonly name="username">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <input type="email" placeholder="Enter your Mail"
                                            value="{{ $user->email }}" name="email" readonly>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <input type="hidden" placeholder="Enter your Mail"
                                            value="{{ $user->id }}" name="user_id">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <input type="text" placeholder="Enter your Phone Number"
                                            value="{{ $user->phone }}" name="phone" readonly>
                                    </div>
                                    <div class="form-group col-lg-6">

                                    </div>
                                </div>
                            </div>
                        </div> --}}


                                                                </div>
                                                            </div>

                                                            <!-- checkout-wrapper end -->



    </div>
    </div>
    </div>

    {{-- <button type="submit" class="cmn-btn"  id="btn">continue shopping </button> --}}
    {{-- </form> --}}

    </div>



    <div class=" checkout">
        {{-- <div class="bg-shape"><img src="{{asset('frontend2/assets/images/elements/inner-hero-shape.png')}}" alt="image"></div> --}}
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    @if ($errors->any())
                        <div class="alert alert-danger" id="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>





    <!-- inner-hero-section end -->

    <!-- checkout section start -->
    <section class="pb-120 mt-minus-300 checkout">

        <div class="container">
            <div class="row">

                <div class="col-lg-12 hid-erea" id="box">
                    <form action="{{ route('checkout.store') }}" method="post" class="payment-form">
                        @csrf

                        <div class="checkout-area ">
                            <div class="top d-none">
                                <div class="left">
                                    {{-- <form action="{{ route('checkout0.store') }}" method="POST">
                                        @csrf --}}
                                    @if (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() > 0)
                                        @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                                            <input type="hidden" name="product-id" value="{{ $item->id }}">

                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-3 pb-3">
                                                        <img src="{{ $item->model->photo }}" class="cart-thumb"
                                                            alt="{{ $item->name }}" width="75px" height="75px">
                                                    </div>
                                                    <div class="col-lg-6 pt-3">
                                                        <a href="#">{{ $item->name }}</a>

                                                        <input type="hidden" name="qty"
                                                            value="{{ $item->qty }}">

                                                        <input type="hidden" name="product-id"
                                                            value="{{ $item->id }}">

                                                    </div>
                                                    <div class="col-lg-3 pt-3">
                                                        <p>{{ $item->qty }} x - <span
                                                                class="price td-text">{{ $item->price }}</span></p>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach


                                        {{-- <a href="{{route('checkout0.store')}}"></a> --}}
                                        <button type="submit" class="cmn-btn">continue shopping </button>
                                    @else
                                        <h1> no item</h1>
                                    @endif
                                    {{-- <tr>
                                       <input type="hidden" name="product-id" value="{{$item->id}}">
                                        <td class="td-text"> <a href="#" class="image">
                                            <img src="{{$item->model->photo}}" class="cart-thumb" alt="{{$item->name}}">
                                        </a>
                                        </td>
                                        <td class="td-text">
                                            <a href="#">{{$item->name}}</a>
                                        </td>
                                        <td class="td-text"> <p>{{$item->qty}} x - <span class="price td-text">{{$item->price}}</span></p>
                                        </td>
                                        <input type="hidden" name="qty" value="{{$item->qty}}">

                                        <input type="hidden" name="product-id" value="{{$item->id}}">

                                    </tr> --}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="checkout-form-area">
                                        <div class="payment-details mt-30">
                                            <h3 class="title" style="color: #000">Payment Option</h3>
                                            {{-- <form  action="{{route('checkout1.store')}}"  method="post" class="payment-form"> --}}
                                            {{-- <form  action="{{route('checkout.store')}}"  method="post"  class="payment-form" >
                                        @csrf --}}

                                            <div class="payment-methods">
                                                <button type="button" class="checked">
                                                    <i class="las la-credit-card"></i>
                                                    <span style="color: #000">Credit Card</span>
                                                </button>
                                                <button type="button">
                                                    <i class="las la-credit-card"></i>
                                                    <span style="color: #000">Debit Card</span>
                                                </button>
                                                <button type="button">
                                                    <i class="lab la-paypal"></i>
                                                    <span style="color: #000">Credit Card</span>
                                                </button>
                                            </div>
                                            <h5 class="payment-form__title" style="color: #000">Enter Your Card Details
                                            </h5>
                                            <div class="form-row">
                                                <div class="form-group col-lg-12">
                                                    <label style="color: #000">Card Details</label>

                                                    <input type="text" name="name" placeholder="Enter Card Details"
                                                        value="{{ old('CardDetails') }}">
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label style="color: #000">Name on the Card</label>
                                                    <input type="text" name="name" placeholder="Enter name"
                                                        value="{{ old('name') }}">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label style="color: #000">Expiration</label>
                                                    <input type="text" placeholder="MM/YY" name="exp"
                                                        value="{{ old('exp') }}">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label style="color: #000">CVV</label>
                                                    <input type="text" placeholder="cvv" name="cvv"
                                                        value="{{ old('cvv') }}">
                                                </div>
                                            </div>
                                            {{-- </form> --}}
                                            <p class="info-text"> By Clicking "Make Payment" you agree to the <a
                                                    href="#0">terms and conditions</a></p>
                                        </div>
                                        <!-- personal-details end -->
                                    </div>
                                    <!-- checkout-form-area end -->
                                </div>
                                <div class="col-lg-5 mt-lg-0 mt-4">
                                    <div class="checkout-wrapper">
                                        <div class="checkout-wrapper__header">
                                            <h3>Checkout</h3>
                                        </div>
                                        <div class="checkout-wrapper__body">
                                            <ul class="price">
                                                @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                                                    <li>
                                                        <div class="left">
                                                            <h4 class="caption" style="color: #000">Ticket Price</h4>
                                                            <span>({{ $item->qty }} tickets X $
                                                                {{ $item->price }})</span>
                                                        </div>
                                                        <div class="right">
                                                            <span class="price" style="color: #000">{{ $item->price }}
                                                            </span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                <li>
                                                    <div class="left">
                                                        <h4 class="caption"style="color: #000">Total</h4>
                                                    </div>
                                                    <div class="right">
                                                        <span class="price" style="color: #000"> {{ Cart::subtotal() }}
                                                        </span>
                                                        <input type="hidden"
                                                            value="{{ (float) str_replace(',', '', Cart::subtotal()) }}"
                                                            name="total">

                                                    </div>
                                                </li>
                                            </ul>
                                            {{-- <input type="hidden" name="subtotal" value="{{\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->subtotla}}"> --}}
                                            @if (Auth::check())
                                                <div class="personal-details mt-30 d-none ">
                                                    <h3 class="title">Contact Details </h3>
                                                    <div class="personal-details-form">
                                                        <div class="form-row">
                                                            <div class="form-group col-lg-6">
                                                                <input type="text" placeholder="Full Name"
                                                                    value="{{ $name[0] }}" readonly name="username">
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <input type="email" placeholder="Enter your Mail"
                                                                    value="{{ $user->email }}" name="email" readonly>
                                                            </div>

                                                            <div class="form-group col-lg-6">
                                                                <input type="hidden" placeholder="Enter your Mail"
                                                                    value="{{ $user->id }}" name="user_id" readonly>
                                                            </div>

                                                            <div class="form-group col-lg-6">
                                                                <input type="text"
                                                                    placeholder="Enter your Phone Number"
                                                                    value="{{ $user->phone }}" name="phone" readonly>
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                {{-- <button type="submit" class="cmn-btn">Continue</button> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="container">
                                                    <div class="row">

                                                        <div
                                                            class="col-6 loginecheck d-flex align-items-end flex-column bd-highlight mb-3">
                                                            <form action="{{ route('login.submit') }}" method="get">
                                                                @csrf
                                                                <div class="form-group col-lg-12">
                                                                    <input type="email" placeholder="Enter your email "
                                                                        name="email">
                                                                </div>
                                                                <div class="form-group col-lg-12">
                                                                    <input type="password"
                                                                        placeholder="Enter your password Number"
                                                                        name="password">
                                                                </div>
                                                                <button type="submit"
                                                                    class=" mt-auto p-2 bd-highlight btn btn-success">Login
                                                                </button>
                                                            </form>

                                                        </div>
                                                        <div class="col-6">
                                                            <p class="title">You Have't Acount ?</p>
                                                            <form action="{{ route('register.submit') }}" method="get">
                                                                @csrf

                                                                <div class="form-group col-lg-12">
                                                                    <input type="email" placeholder="Enter your email "
                                                                        name="email">
                                                                </div>
                                                                <div class="form-group col-lg-12">
                                                                    <input type="phone" placeholder="Enter your phone "
                                                                        name="phone">
                                                                </div>

                                                                <div class="form-group col-lg-12">
                                                                    <input type="password"
                                                                        placeholder="Enter your password Number"
                                                                        name="password">
                                                                </div>
                                                                <div class="form-group col-lg-12">
                                                                    <input type="confirm-password"
                                                                        placeholder="Enter your password Number"
                                                                        name="confirm-password">
                                                                </div>
                                                                <button type="submit" class="btn btn-success">Sign Up
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    </div>






                                    <!-- checkout-wrapper end -->
                                </div>
                            </div>
                            <button type="submit" class="cmn-btn">sub</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <script>
        const btn = document.getElementById('btn');
        const btn = document.getElementById('shopheader');

        btn.addEventListener('click', () => {
            // 👇️ hide button
            shopheader.style.display = 'none';

            // 👇️ show div
            const box = document.getElementById('box');
            box.style.display = 'block';

        });
    </script>

@endsection
