@extends('frontend.layouts.master')



<script src="https://js.stripe.com/v3/"></script>
@section('content')
    @if (Auth::check())
        @php
            $name = explode(' ', auth()->user()->name);
        @endphp
    @endif






    <div class="inner-hero-section style--four">
        <div class="bg-shape"><img src="{{ asset('frontend2/assets/images/elements/inner-hero-shape-2.png') }}" alt="image">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="page-list">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="#0">Pages</a></li>
                        <li class="active">Affiliate</li>
                    </ul>
                </div>
            </div>
        </div>
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

                                                        <input type="hidden" name="qty" value="{{ $item->qty }}">

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
                                        {{ Cart::subtotal() }}
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
