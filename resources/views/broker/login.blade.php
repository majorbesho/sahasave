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
            <div class="page-header__inner" style="">
                <h2>Broker Login </h2>


                @if ($message = Session::get('success'))
                    <div class="alert alert-primary rounded-0 fixed-bottom m-0" data-animate="fadeInUp faster">
                        <div class="container">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-lg-auto">
                                    <strong><i class="icon-gift"></i> Done </strong> {{ $message }} <a href="#"
                                        class="alert-link"><u>SahaSave.com</u></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <ul class="thm-breadcrumb">
                    <li><a href="{{ route('home') }}" style="color: #fff">Home</a></li>
                    <li><span class="icon-right-arrow21"></span></li>
                    <li>Broker Login</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Header-->
    <div class="container" style="padding-top: 3%;padding-bottom: 3%;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="color:#Fabc3f">Broker {{ __('Login') }}</div>

                    <div class="card-body">
                        <form action="{{ route('broker.login') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end"
                                    style="color:#Fabc3f">email
                                </label>
                                <div class="col-md-6">
                                    <input class="form-control" type="email" name="email" placeholder="Email" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end" style="color:#Fabc3f">Pass
                                </label>
                                <div class="col-md-6">

                                    <input class="form-control" type="password" name="password" placeholder="Password"
                                        required>
                                </div>

                            </div>


                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember" style="color:#Fabc3f">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                            {{-- <button type="submit">Login</button> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
