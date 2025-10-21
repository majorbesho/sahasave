@extends('frontend.layouts.master')


@section('content')

<div class="clear"></div>

@if (count($branch)>0)
@foreach ($branch as $branch )
<!-- One Fourth (1/4) Column -->
<div class="column one-fourth column_list ">
    <div class="list_item lists_3 clearfix">
        <!-- Animated area -->
        <div class="animate" data-anim-type="zoomIn">
            <div class="list_left list_image">
                <img src="{{$branch->photo}}"
                alt="{{$branch->title}}" class="scale-with-grid" width="71"
                height="71" />
            </div>

            <div class="list_right">
                <a href="{{route('sngilbranch',$branch->slug)}}">
                    <h4> {{$branch->title}}
                    </h4>
                </a>
                <div class="desc">
                    <a href="{{route('sngilbranch',$branch->slug)}}">
                    {{$branch->discreption}}
                </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif

<div class="clear"></div>


@endsection

