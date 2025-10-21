@extends('frontend.layouts.master')


@section('content')



<div class="container clearfix">

    <div class="heading-block center">
        <h3>Some of our <span>Featured</span> Works</h3>
        <span>We have worked on some Awesome Projects that are worth boasting of.</span>
    </div>

    <div class="divider"><i class="icon-circle"></i></div>


    <div class="masonry-thumbs grid-container grid-3" data-big="2" data-lightbox="gallery">

        @if(count($categorys)>0)
        @foreach ($categorys as $item)

            <a class="grid-item" href="{{$item->photo}}"
            data-lightbox="gallery-item"><img src="{{$item->photo}}"
            alt="Gallery Thumb 1">
            </a>
        @endforeach ($category as $item)
            @endif(count($category)>0)
    </div>
    <div class="divider"><i class="icon-circle"></i></div>
</div>




@endsection

