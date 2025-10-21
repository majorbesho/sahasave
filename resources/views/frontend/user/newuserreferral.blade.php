
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
            <div class="col-lg-8 mt-lg-0 mt-4">


                    <div class="referral-link-wrapper">
                        <h3 class="title">Partners</h3>
                        <div class="copy-link">
                            <span class="copy-link-icon"><i class="las la-link"></i></span>
                            <span class="label">Referral Link :</span>
                            <div class="copy-link-inner">
                                <form data-copy=true>
                                    {{-- {{$user->referral_code}} --}}

                                    @php
                                    $domain = URL::to('/');
                                    $url = $domain.'/authref?ref='.$user->referral_code;
                                    @endphp



                                    <input type="text" value="{{$url}}" data-click-select-all>
                                    <input type="submit" value="Copy Link">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="referral-overview mt-30">
                        <div class="row justify-content-center mb-none-30">
                            <div class="col-lg-5 col-sm-6 mb-30">
                                <div class="referral-crad">
                                    <div class="referral-crad__icon"><img src="{{asset('frontend4/assets/images/3.png')}}" alt="image"></div>
                                    <div class="referral-crad__content">
                                        <h3 class="number">$000.00</h3>
                                        <span>Earned Referral</span>
                                    </div>
                                </div>
                                <!-- referral-crad end -->
                            </div>
                            <div class="col-lg-5 col-sm-6 mb-30">
                                <div class="referral-crad">
                                    <div class="referral-crad__icon"><img src="{{asset('frontend4/assets/images/4.png')}}" alt="image"></div>
                                    <div class="referral-crad__content">
                                        <h3 class="number">$000.00</h3>
                                        <span>Last Month</span>
                                    </div>
                                </div>
                                <!-- referral-crad end -->
                            </div>
                        </div>
                    </div>

                    <div class="referral-transaction">
                        <div class="all-transaction__header">
                            <h3 class="title">Your Partners:</h3>
                            <div class="date-range">
                                <input type="text" data-range="true" data-multiple-dates-separator=" - "
                                data-language="en" class="datepicker-here form-control" data-position='top left' placeholder="min - max date">
                                <i class="las la-calendar-alt"></i>
                            </div>
                        </div>

                        {{-- <td><a href="{{ $domain.('/authref?ref='.$itemref->referral_code)}}" class=""  style="color: #000;"> ref link</a></td> --}}

                        <div class="table-responsive-lg">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>email</th>
                                        <th>Verifiy status</th>
                                        <th>Name</th>
                                        <th>ref</th>
                                        <th>vist</th>
                                        <th>buy</th>
                                        <th>sing</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($userref)>0)
                                    @foreach ($userref as $itemref)

                                    <tr>
                                        <td>
                                            <div class="date">
                                                <span>16</span>
                                                <span class="month">APR</span>
                                            </div>
                                        </td>
                                        <td>{{$itemref->user->email}}</td>
                                        <td>
                                            @if ($itemref->user->is_verified==1)
                                                <span class="badge badge-success">Verified</span>
                                                @else
                                                <span class="badge badge-danger">Not Verified</span>
                                            @endif

                                        </td>
                                        <td>
                                        {{$itemref->user->name}}

                                        </td>
                                        <td>
                                            {{$itemref->user->referral_code}}

                                        </td>
                                        <td>
                                            vist

                                        </td>
                                        <td>
                                            buy

                                        </td>
                                        <td>
                                            sing

                                        </td>

                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        <div class="load-more">
                            <button type="button">Show More Lotteries <i class="las la-angle-down ml-2"></i></button>
                        </div>
                    </div>
                </div>
                <!-- past-draw-wrapper end -->

        </div>
    </div>
</div>


@endsection
