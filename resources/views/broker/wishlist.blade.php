@extends('frontend.layouts.master')


@section('content')


    <div class="inner-hero-section style--five">
    </div>

    <!-- Header Area End -->

    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Wishlist</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Wishlist</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->
    <!-- Wishlist Table Area -->
    <div class="wishlist-table section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cart-table wishlist-table">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-30">
                                <thead>

                                    <tr>
                                        <th scope="col"><i class="icofont-ui-delete"></i></th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count() > 0)
                                        @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content() as $item)
                                            <tr>
                                                <th scope="row">
                                                    <i class="icofont-close"></i>
                                                </th>
                                                <td>
                                                    @php
                                                        $photos = explode(',', $item->model->photo);
                                                    @endphp

                                                    <img src="{{ $photos[0] }}" alt="Product" height="150px"
                                                        width="150px">

                                                </td>
                                                <td>
                                                    <a href="#">{{ $item->name }}</a>
                                                </td>
                                                <td>{{ $item->price }}</td>
                                                <td>
                                                    <div class="quantity">
                                                        <input type="number" class="qty-text" id="qty2" step="1"
                                                            min="1" max="99" name="quantity"
                                                            value="{{ $item->qty }}">
                                                    </div>
                                                </td>
                                                <td><a href="javascript:void(0);" data-id="{{ $item->rowId }}"
                                                        class="move-to-cart btn btn-primary btn-sm">Add to Cart</a></td>
                                            </tr>
                                        @endforeach
                                    @endif


                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="cart-footer text-right">
                        <div class="back-to-shop">
                            <a href="#" class="btn btn-primary">Add All Item</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('frontend/4/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>


    <script>
        $('.move-to-cart').on('click', function(e) {
            e.preventDefault();
            var rowId = $(this).data('id');

            //alert(rowId);
            var token = "{{ csrf_token() }}";
            var path = "{{ route('wishlist.move.cart') }}";
            $.ajax({
                url: path,
                type: "POST",
                data: {
                    _token: token,
                    rowId: rowId,
                },
                beforeSend: function() {
                    $(this).html('<i class=" fas fa-spin"> </i> Moving to Cart');
                },

                success: function(data) {

                    if (data(['status'])) {
                        console.log(data);
                        $('body #header-ajax').html(data['header'])
                        $('body #cart_count').html(data['cart_count'])
                    }
                    $(this).html('<i class=" fas fa-spin"> </i> Moving to Cart');
                }
            })


        });
    </script>


@endsection
