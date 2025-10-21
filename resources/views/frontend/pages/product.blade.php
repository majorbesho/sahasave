{{--
@extends('frontend.layouts.master')


@section('content')





<div class="inner-hero-section"></div>



  <link rel="stylesheet" href="{{asset('frontend3/1/css/style.min.css')}}">



  <div class="page-wrapper">



    @php
    $photos =explode(',',$pro_index->photo);
@endphp




<div class="main">
    <div class="container">


        <div class="product-single-container product-single-default">
            <div class="cart-message d-none">
                <strong class="single-cart-notice">{{$pro_index->title}}</strong>
                {{-- <span>has been added to your cart.</span>
            </div>

            <div class="row">
                <div class="col-lg-5 col-md-6 product-single-gallery">
                    <div class="product-slider-container">
                        <div class="label-group">
                            {{-- <div class="product-label label-hot">HOT</div>

                            <div class="product-label label-sale">
                                -16%
                            </div>
                        </div>

                        <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">

                            @foreach ($photos as $key=>$photo )
                            <div class="product-item">
                                <img class="product-single-image" src="{{$pro_index->photo}}" data-zoom-image="{{$pro_index->photo}}" width="468" height="468" alt="product" />
                            </div>
                            @endforeach
                        </div>
                        <!-- End .product-single-carousel -->
                        <span class="prod-full-screen">
                            <i class="icon-plus"></i>
                        </span>
                    </div>

                    <div class="prod-thumbnail owl-dots">
                        @foreach ($photos as $key=>$photo )
                        <div class="owl-dot">
                            <img src="{{$pro_index->photo}}" width="110" height="110" alt="product-thumbnail" />
                        </div>
                        @endforeach

                    </div>
                </div>
                <!-- End .product-single-gallery -->

                <div class="col-lg-7 col-md-6 product-single-details">
                    <h1 class="product-title">{{$pro_index->title}}</h1>



                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:60%"></span>
                            <!-- End .ratings -->
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <!-- End .product-ratings -->

                        {{-- <a href="#" class="rating-link">( 6 Reviews )</a>
                    </div>
                    <!-- End .ratings-container -->

                    <hr class="short-divider">
                    <div class="buttons">
                        <span class="delete-btn"></span>
                        <span class="like-btn"></span>
                      </div>


                    <div class="price-box">
                        <span class="old-price">{{$pro_index->price}}</span>
                        <span class="new-price">{{$pro_index->offer_price}}</span>
                    </div>
                    <!-- End .price-box -->

                    <div class="product-desc">
                        <p>
                            {{$pro_index->discreption}}
                        </p>
                    </div>
                    <!-- End .product-desc -->

                    <ul class="single-info-list">

                        <li>
                            SKU: <strong>654613612</strong>
                        </li>

                        <li>
                            CATEGORY: <strong><a href="#" class="product-category">car</a></strong>
                        </li>

                        <li>
                            TAGs: <strong><a href="#" class="product-category">car</a></strong>,
                            <strong><a href="#" class="product-category">box</a></strong>
                        </li>
                    </ul>



                    <div class="d-flex flex-wrap align-items-center mb-30">
                        <div class="select-quantity">
                          <span class="caption">Quantity</span>
                          <div class="quantity">
                            <input type="number"  min="0"  step="1" value="1" readonly>


                          </div>
                        </div><!-- select-quantity end -->
                        <div class="mt-sm-0 mt-3">
                            <a href="#0"
                            data-quantity="1" data-product-id="{{$pro_index->id}}"
                            id="add_to_cart{{$pro_index->id}}"
                            class="add_to_cart cmn-btn style--three">buy tickets</a>
                            {{--  cmn-btn style--three
                        </div>
                      </div>


                    {{-- <div class="product-action">
                        <div class="product-single-qty">
                            <input class="horizontal-quantity form-control" type="text">
                        </div>
                        <!-- End .product-single-qty -->

                        <a href="javascript:;" class="btn btn-dark add-cart mr-2" title="Add to Cart">Add to
                            Cart</a>

                        <a href="cart.html" class="btn btn-gray view-cart d-none">View cart</a>
                    </div>
                    <!-- End .product-action -->

                    <hr class="divider mb-0 mt-0">

                    <div class="product-single-share mb-3">
                        <label class="sr-only">Share:</label>

                        <div class="social-icons mr-2">
                            <i class="fa-solid fa-envelope"></i>
                            <a href="#" class="social-icon social-facebook fa-brands fa-facebook" target="_blank" title="Facebook"></a>
                            <a href="#" class="social-icon social-twitter fa-brands fa-twitter" target="_blank" title="Twitter"></a>
                            <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank" title="Linkedin"></a>
                            <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank" title="Google +"></a>
                            <a href="#" class="social-icon social-mail icon-mail-alt fa-solid fa-envelope" target="_blank" title="Mail"></a>
                        </div>
                        <!-- End .social-icons -->

                        <a href="wishlist.html" class="btn-icon-wish add-wishlist" title="Add to Wishlist"><i
                                class="fa-light fa-plus"></i><span>Add to
                                Wishlist</span></a>
                    </div>
                    <!-- End .product single-share -->
                </div>
                <!-- End .product-single-details -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .product-single-container -->

        <div class="product-single-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link" id="product-tab-size" data-toggle="tab" href="#product-size-content" role="tab" aria-controls="product-size-content" aria-selected="true">Size Guide</a>
                </li> -

                {{-- <li class="nav-item">
                    <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content" role="tab" aria-controls="product-tags-content" aria-selected="false">Additional
                        Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">information</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                    <div class="product-desc-content">
                        <p>
                            {{$pro_index->summary}}
                        </p>


                    </div>
                    <!-- End .product-desc-content -->
                </div>
                <!-- End .tab-pane -->

                <div class="tab-pane fade" id="product-size-content" role="tabpanel" aria-labelledby="product-tab-size">
                    <div class="product-size-content">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{asset('frontend3/1/images/products/single/body-shape.png')}}" alt="body shape" width="217" height="398">
                            </div>

                        </div>
                        <!-- End .row -->
                    </div>
                    <!-- End .product-size-content -->
                </div>


                <div class="tab-pane fade" id="product-reviews-content" role="tabpanel" aria-labelledby="product-tab-reviews">
                    <div class="product-reviews-content">


                        <div class="comment-list">
                        <p>
                            {{$pro_index->discreption}}
                        </p>
                        </div>

                        <div class="divider"></div>


                        <!-- End .add-product-review -->
                    </div>
                    <!-- End .product-reviews-content -->
                </div>
                <!-- End .tab-pane -->
            </div>
            <!-- End .tab-content -->
        </div>
        <!-- End .product-single-tabs -->

        <div class="products-section pt-0 d-none">
            <h2 class="section-title">Related Products</h2>

            <div class="products-slider owl-carousel owl-theme dots-top dots-small">
                <div class="product-default">
                    <figure>
                        {{-- <a href="product.html">
                            <img src="{{asset('frontend3/1/images/products/product-1.jpg')}}" width="280" height="280" alt="product">
                            <img src="{{asset('frontend3/1/images/products/product-1-2.jpg')}}" width="280" height="280" alt="product">
                        </a> --}}
                        <div class="label-group">
                            {{-- <div class="product-label label-hot">HOT</div>
                            <div class="product-label label-sale">-20%</div>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="category.html" class="product-category">Category</a>
                        </div>
                        <h3 class="product-title">
                            <a href="product.html">Ultimate 3D Bluetooth Speaker</a>
                        </h3>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:80%"></span>
                                <!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                            <!-- End .product-ratings -->
                        </div>
                        <!-- End .product-container -->
                        <div class="price-box">
                            <del class="old-price">59.00</del>
                            <span class="product-price">49.00</span>
                        </div>
                        <!-- End .price-box -->
                        <div class="product-action">
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                    class="icon-heart"></i></a>
                            <a href="product.html" class="btn-icon btn-add-cart"><i
                                    class="fa fa-arrow-right"></i><span>SELECT
                                    OPTIONS</span></a>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                    class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div>
                    <!-- End .product-details -->
                </div>


            </div>
            <!-- End .products-slider -->
        </div>
        <!-- End .products-section -->

        <hr class="mt-0 m-b-5" />


        <!-- End .row -->
    </div>
    <!-- End .container -->
</div>


<!-- End .main -->




  <script src="{{asset('frontend3/1/js/jquery.min.js')}}"></script>
  <script src="{{asset('frontend3/1/js/bootstrap.bundle.min.js')}}"></script>
  {{-- <script src="{{asset('frontend3/1/js/plugins.min.js')}}"></script>

  <!-- Main JS File -->
  <script src="{{asset('frontend3/1/js/main.min.js')}}"></script>

  <div class="inner-hero-section"></div>


  <script src="{{asset('frontend2/assets/js/vendor/jquery-3.5.1.min.js')}}"></script>

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
        var product_id = $(this).data('product-id');
        var product_qty = $(this).data('quantity');
         //alert(product_qty);
        var token = "{{csrf_token()}}";
        var path = "{{route('cartpro.store')}}";
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
<script>

    $(document).on('click','.cart_delete',function(e){
        e.preventDefault();
        var cart_id = $(this).data('id');

         alert(cart_id);
        var product_qty = $(this).data('quantity');
        // alert(product_id);
        var token = "{{csrf_token()}}";
        var path = "{{route('cartpro.delete')}}";
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
@endsection --}}
