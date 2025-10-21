
@extends('frontend.layouts.master')


@section('content')



<div class="inner-hero-section style--five">
</div>
<!-- inner-hero-section end -->

<!-- user section start -->
<div class="mt-minus-150 pb-120">
    <div class="container">

        <div class="row">
            <div class="col-lg-4 ">
                <div class="user-card">
                    <div class="user-card user-prof">
                        <div class="avatar-upload">
                            <div class="obj-el">
                                <img src="{{asset('frontend4/assets/images/elements/team-obj.png')}}" alt="image">
                            </div>
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload"></label>
                            </div>
                            {{-- <div class="avatar-preview">
                                @if (auth()->user()->photo)
                                <div id="imagePreview" style="background-image: url({{$user->photo}});">
                                </div>
                                @else
                                <div id="imagePreview"
                                style="background-image: url({{Helper::userDefaultImage()}});">
                                </div>

                                @endif

                            </div> --}}
                        </div>
                    </div>


                    <h3 class="user-card__name">{{$user->name}}</h3>
                    {{-- <span class="user-card__id">ID : {{$user->id}}</span>
                    <span class="user-card__id">email : {{$user->email}}</span> --}}
                </div>

                        <!-- user-card end -->
                        <div class="user-action-card">
                            <ul class="user-action-list">
                            @include('frontend.user.sidebar')
                            </ul>
                        </div>
                <!-- user-action-card end -->
            </div>


            <div class="col-lg-8 mt-lg-0 mt-5">
                <div class="user-info-card">
                    <div class="user-info-card__header">
                       <p>
                        data
                       </p>
                    </div>

                </div>
                <!-- user-info-card end -->

                <!-- user-info-card end -->
                <div class="user-info-card">


                </div>

            </div>

        </div>
    </div>
</div>


@endsection
