<div class="product">

    <div class="product-image">
        <a href="#"><img src="{{$prods_index->photo}}" alt="Image 1"></a>
        <a href="#"><img src="{{asset('frontend/1/images/items/new/1-1.jpg')}}" alt="Image 1"></a>
        {{-- <div class="sale-flash badge bg-danger p-2">Sale!</div> --}}
        <div class="bg-overlay">
            <div class="bg-overlay-content align-items-end justify-content-between" data-hover-animate="fadeIn" data-hover-speed="400">
                <a href="#" class="btn btn-dark me-2"><i class="icon-shopping-basket"></i></a>
                <a href="demos/shop/ajax/shop-item.html" class="btn btn-dark" data-lightbox="ajax"><i class="icon-line-expand"></i></a>
            </div>
            <div class="bg-overlay-bg bg-transparent"></div>
        </div>

    </div>

    <div class="product-desc-box">
        <div class="product-title mb-1"><h3><a href="#"></a></h3></div>
        <div class="product-price font-primary"><del class="me-1">{{$prods_index->price}}</del> <ins>$12.49</ins></div>
        <div class="product-rating">
            <i class="icon-star3"></i>
            <i class="icon-star3"></i>
            <i class="icon-star3"></i>
            <i class="icon-star-half-full"></i>
            <i class="icon-star-empty"></i>
        </div>
    </div>

</div>
