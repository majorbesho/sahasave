
@extends('frontend.layouts.master')


@section('content')



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




<div class="row pt-150">



    <div class="col-lg-9">
        <main class="shop-page style-5 style-grad">
            <section class="shop section-padding pt-50">
                <div class="container">
                    <div class="row gx-4">
                        <div class="col-lg-12">
                            <div class="products-content">
                                <div class="top-filter mb-10">
                                    <div class="row align-items-center">
                                    </div>
                                </div>
                                <div class="products product-page">
                                    <div class="row gx-2 gx-lg-4">
                                        @if (count($prod_index) > 0)
                                            @foreach ($prod_index as $pim)
                                                <div class="col-6 col-lg-3 col-sm-6 card-width">
                                                    <div class="product-card">
                                                        <div class="img">
                                                            <img src="{{ $pim->photo }}" alt="">

                                                            <span class="fav-btn active"> <i class="fas fa-heart"></i>
                                                            </span>
                                                        </div>
                                                        <div class="info">
                                                            <h6 class="category">{{ $pim->name }}</h6>
                                                            <h5 class="title">{{ $pim->title }}</h5>
                                                            <div class="rate">

                                                                <span class="rev">3 Reviews</span>
                                                            </div>
                                                        </div>
                                                        <div class="price">
                                                            {{ $pim->price }}
                                                        </div>
                                                        <a href="{{ route('sProduct', $pim->slug) }}"
                                                            class="btn rounded-pill mt-20">
                                                            <span>Add To Cart</span>
                                                        </a>
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
            </section>
        </main>

    </div>

    <div class="col-lg-3  section-padding">
        <div class="sidebar-widgets-wrap">

            <div class="widget widget-filter-links">

                <h4>Select Category</h4>
                <ul class="custom-filter ps-2" data-container="#shop" data-active-class="active-filter">
                    <li class="widget-filter-reset active-filter"><a href="#" data-filter="*">Clear</a></li>
                    <li><a href="#" data-filter=".sf-dress">electornic</a></li>
                    <li><a href="#" data-filter=".sf-tshirts">travel </a></li>
                    <li><a href="#" data-filter=".sf-pants">Uphone</a></li>
                    <li><a href="#" data-filter=".sf-sunglasses">Sunglasses</a></li>
                    <li><a href="#" data-filter=".sf-shoes">android</a></li>
                    <li><a href="#" data-filter=".sf-watches">LG</a></li>
                </ul>

            </div>

            <div class="widget widget-filter-links">

                <h4>Sort By</h4>
                <ul class="shop-sorting ps-2">
                    <li class="widget-filter-reset active-filter"><a href="#" data-sort-by="original-order">Clear</a></li>
                    <li><a href="#" data-sort-by="name">Name</a></li>
                    <li><a href="#" data-sort-by="price_lh">Price: Low to High</a></li>
                    <li><a href="#" data-sort-by="price_hl">Price: High to Low</a></li>
                </ul>

            </div>
                <div class="rang">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                        </li>
                    </ul>
                <input type="range" min="100" max="150000" value="150000" style="width: 200px">
                </div>
        </div>
    </div>

</div>






@endsection
