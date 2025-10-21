@extends('frontend.layouts.master')


@section('content')
    <!--Start Page Header-->
    <section class="page-header">
        <div class="page-header__bg"
            style="background-image: url({{ asset('4/assets/images/backgrounds/page-header-bg.jpg') }})">
        </div>
        <div class="page-header__pattern"><img src="{{ asset('4/assets/images/pattern/page-header-pattern.png') }}"
                alt=""></div>
        <div class="container">
            <div class="page-header__inner">
                <h2>Add Your Load </h2>
                <ul class="thm-breadcrumb">
                    <li><a href="
                        {{ route('home') }}">Home</a></li>
                    <li><span class="icon-right-arrow21"></span></li>
                    <li>add your load</li>
                </ul>
            </div>
        </div>
    </section>

    <section>
        <div class="contrainer">
            <div class="row">
                <div class="col-12">
                    @if (Auth::check())
                        <div class="container">
                            <div class="row">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>City</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($allLoad) > 0)
                                            @foreach ($allLoad as $key => $allLoadsingle)
                                                <tr>
                                                    <td>{{ $allLoadsingle->weight }}</td>

                                                    <td>{{ $allLoadsingle->lenght }}</td>
                                                    <td>{{ $allLoadsingle->cat_id }}</td>
                                                </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @elseif (Auth::guest())
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center pt-8 center-text">
                                        <h1>
                                            <span class="text-primary">Thank you please Sign Up </span>

                                            <a href="{{ route('newreg') }}">Sign Up
                                                <i class="icon-right-arrow21"></i>
                                            </a>
                                        </h1>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

    <!--End Page Header-->
@endsection
