@extends('frontend.layouts.master')


@section('content')


    @if (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() > 0)
        <!-- Ec cart page -->
        <section class="ec-page-content section-space-p">
            <div class="container">
                <div class="row">
                    <div class="ec-cart-leftside col-lg-8 col-md-12 ">
                        <!-- cart content Start -->
                        <div class="ec-cart-content">
                            <div class="ec-cart-inner">
                                <div class="row">
                                    <form action="#">
                                        <div class="table-content cart-table-content">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th style="text-align: center;">Quantity</th>
                                                        <th>Total</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                                                        @php
                                                            $photos = explode(',', $item->model->photo);
                                                        @endphp


                                                        <div class="action-btns">

                                                            <button type="button" class="del-btn cart_delete"
                                                                data-id="{{ $item->rowId }}">
                                                                <i class="las la-trash-alt"></i>
                                                            </button>

                                                            <tr>
                                                                <td data-label="Product" class="ec-cart-pro-name"><a
                                                                        href="{{ route('groupOfProduct', $item->model->slug) }}"><img
                                                                            class="ec-cart-pro-img mr-4"
                                                                            src="{{ $photos[0] }}"
                                                                            alt="{{ $item->name }}" />{{ $item->name }}</a>
                                                                </td>
                                                                <td data-label="Price" class="ec-cart-pro-price"><span
                                                                        class="amount">AED {{ $item->price }}</span></td>
                                                                <td data-label="Quantity" class="ec-cart-pro-qty"
                                                                    style="text-align: center;">
                                                                    <div class="cart-qty-plus-minus">
                                                                        <input class="cart-plus-minus" type="text"
                                                                            name="cartqtybutton"
                                                                            value="{{ $item->qty }}" />
                                                                    </div>
                                                                </td>
                                                                <td data-label="Total" class="ec-cart-pro-subtotal">
                                                                    AED{{ $item->price }}</td>

                                                                <td data-label="Remove"
                                                                    class="ec-cart-pro-remove cart_delete"
                                                                    data-id="{{ $item->rowId }}">
                                                                    <a href="#"><i class="ecicon eci-trash-o"></i></a>
                                                                </td>
                                                            </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="ec-cart-update-bottom">
                                                    <a href="{{ route('home') }}">Continue Shopping</a>
                                                    <a href="{{ route('stripe') }}" class="btn btn-primary">Check Out</a>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--cart content End -->
                    </div>
                    <!-- Sidebar Area Start -->
                    <div class="ec-cart-rightside col-lg-4 col-md-12">
                        <div class="ec-sidebar-wrap">
                            <!-- Sidebar Summary Block -->
                            <div class="ec-sidebar-block">
                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title">Summary</h3>
                                </div>
                                <div class="ec-sb-block-content">
                                    <h4 class="ec-ship-title">Estimate Shipping</h4>
                                    <div class="ec-cart-form">
                                        <p>Enter your destination to get a shipping estimate</p>
                                        <form action="#" method="post">
                                            <span class="ec-cart-wrap">
                                                <label>Country *</label>
                                                <span class="ec-cart-select-inner">
                                                    <select name="ec_cart_country" id="ec-cart-select-country"
                                                        class="ec-cart-select">
                                                        <option selected="1" disabled="">UAE</option>

                                                    </select>
                                                </span>
                                            </span>
                                            <span class="ec-cart-wrap">
                                                <label>State/Province</label>
                                                <span class="ec-cart-select-inner">
                                                    <select name="ec_cart_state" id="ec-cart-select-state"
                                                        class="ec-cart-select">
                                                        <option selected="" disabled="">Please Select a region, state
                                                        </option>
                                                        <option value="1">Dubai</option>
                                                        <option value="2">Sharjah</option>
                                                        <option value="3">Abu Dubie</option>
                                                        <option value="4">umm Quaeen</option>
                                                        <option value="5">Ras Elkhema</option>
                                                        <option value="6">Ajman</option>

                                                    </select>
                                                </span>
                                            </span>
                                            <span class="ec-cart-wrap">
                                                <label>Zip/Postal Code</label>
                                                <input type="text" name="postalcode" placeholder="Zip/Postal Code">
                                            </span>
                                        </form>
                                    </div>
                                </div>

                                <div class="ec-sb-block-content">
                                    <div class="ec-cart-summary-bottom">
                                        <div class="ec-cart-summary">
                                            <div>
                                                <span class="text-left">Sub-Total</span>
                                                {{-- <span
                                                    class="text-right">AED{{ filter_var(Cart::subtotal()), FILTER_SANITIZE_NUMBER_INT }}
                                                </span> --}}
                                                <span class="text-right">AED {{ Cart::subtotal() }}
                                                </span>
                                            </div>
                                            <div>
                                                <span class="text-left">Delivery Charges</span>
                                                <span class="text-right">AED 00.00 ( Free Delivery )</span>
                                            </div>
                                            <div>
                                                <span class="text-left">Coupan Discount</span>
                                                <span class="text-right"><a class="ec-cart-coupan">Apply Coupan</a></span>
                                            </div>

                                            <div class="ec-cart-coupan-content">
                                                <form class="ec-cart-coupan-form" name="ec-cart-coupan-form" method="POST"
                                                    action="{{ route('coupon.add') }}" id="coupon-form">
                                                    @csrf

                                                    <input class="ec-coupan " type="text"
                                                        placeholder="Enter Your Coupan Code" name="code">
                                                    <button class="ec-coupan-btn button btn-primary coupon-btn"
                                                        type="submit">Apply</button>
                                                </form>
                                            </div>
                                            <div class="ec-cart-summary-total">
                                                <span class="text-left">Total Amount</span>
                                                @if (session()->has('coupon'))
                                                    <span class="text-right">
                                                        {{ Cart::subtotal() - session('coupon')['value'] }}</span>
                                                @else
                                                    <span class="text-right"> {{ Cart::subtotal() }}</span>
                                                @endif
                                                {{-- <span class="text-right"> {{ Cart::subtotal() }}</span> --}}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Sidebar Summary Block -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif








    {{-- href="{{ route('cach.emp') }}"> Cash </a> --}}
    {{-- <a class="cmn-btn style--two d-flex align-items-center"
                                style="justify-content: center;margin-bottom: 4%;text-align: center;margin-top: 2%;width: 100%;padding: 2%;font-style: italic;font-size: 1.4rem;text-shadow: 1px 1px 3px black;font-weight: 900;"
                                href="{{route('stripe')}}"> Card </a> --}}






    {{-- @if (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() > 0)
        @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
            <div class="ticket-wrapper__body">
                <div class="single-row"
                    style=" border: 1px solid #cdcdcd; padding: 10px; display: flex; align-items: center; border-radius: 75px; ">
                    <div class="cartimg">
                        <h1>{{ $item->producttypeid }}</h1>

                        @php
                            $photos = explode(',', $item->model->photo);
                        @endphp

                        <img src="{{ $photos[0] }}" alt="" srcset="" />
                    </div>
                    <div class="cart-data">

                        <span> {{ $item->name }}</span>
                        <h1>{{ $item->producttypeid }}</h1>

                    </div>
                    <div class="action-btns">

                        <button type="button" class="del-btn cart_delete" data-id="{{ $item->rowId }}">
                            <i class="las la-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    @endif --}}
    {{-- </div>
    </div>
    <div class="col-lg-4 mt-lg-0 mt-4">
        <div class="checkout-wrapper">
            <div class="checkout-wrapper__header">
                <h3 style="color: #000">Your Item :</h3>
            </div>
            <div class="checkout-wrapper__body">
                <ul class="price">
                    <li>
                        <div class="left">
                            <h4 class="caption" style="color:#000">Item Price</h4>
                        </div>
                    </li>
                    <li>
                        <div class="right">
                            <span class="price" style="color:#000;font-weight: 600;margin: 0;line-height: 1.4;">
                                {{ Cart::subtotal() }}</span>
                        </div>
                    </li>
                </ul>
                <div class="checkout-wrapper__btn">
                    <a href="#popupcart" class=" amount__btn cmn-btn">
                        <i class="las la-shopping-basket"></i>
                        <span class="cart__num">
                        </span>
                        buy Item

                    </a>

                </div>
            </div>
        </div> --}}
    <!-- checkout-wrapper end -->
    {{-- <div class="mt-30">
            <img src="{{ asset('frontend4/assets/images/elements/payment.png') }}" alt="image">
        </div>
    </div>
    </div>
    </div>
    </div>
    <!-- col-lg-12 -->
    </div>
    </div>
    </section> --}}
    <script src="{{ asset('frontend/4/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).on('click', '.cart_delete', function(e) {
            e.preventDefault();
            var cart_id = $(this).data('id');
            //alert(cart_id);
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

                    if (data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body #cart_counter').html(data['cart_count']);
                        console.log(data);
                        swal({
                            title: "Good job!",
                            text: data['message'],
                            icon: "success",
                            button: "OK",
                        });
                    } else {
                        //alert('false')
                    }
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.cart_delete', function() {
            location.reload(true);
        });
    </script>
    <i class="fas fa-spinner fa-spin"></i>
    <script>
        $(document).on('click', '.coupon-btn', function(e) {
            e.preventDefault();
            var code = $('input[name=code]').val();
            //alert(code);
            $('.coupon-btn').html('<i class="fas fa-spinner fa-spin"></i> Applying...');
            $('#coupon-form').submit();
        });
    </script>

    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


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

</script> --}}


    <!-- cart section end -->
@endsection
