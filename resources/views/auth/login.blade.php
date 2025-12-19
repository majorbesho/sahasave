@extends('frontend.layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="account-content">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-7 col-lg-6 login-left">
                                <img src="{{ asset('frontend/xx/assets/img/login-banner.png') }}" class="img-fluid"
                                    alt="SehaSave.com Login">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right">
                                <div class="login-header">
                                    <h3>{{ __('messages.login_title') }} <span>{{ config('app.name') }}</span></h3>
                                </div>

                                <!-- عرض رسائل الخطأ العامة -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- Email Address -->
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('messages.email') }}</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autofocus
                                            placeholder="{{ __('messages.email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-3">
                                        <div class="form-group-flex">
                                            <label class="form-label">{{ __('messages.password') }}</label>
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" class="forgot-link">
                                                    {{ __('messages.forgot_password') }}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="pass-group">
                                            <input type="password"
                                                class="form-control pass-input @error('password') is-invalid @enderror"
                                                name="password" required placeholder="{{ __('messages.password') }}">
                                            <span class="feather-eye-off toggle-password"></span>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                            <label class="form-check-label" for="remember">
                                                {{ __('messages.remember_me') }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn btn-primary-gradient w-100" type="submit">
                                            {{ __('messages.sign_in') }}
                                        </button>
                                    </div>

                                    <div class="login-or">
                                        <span class="or-line"></span>
                                        <span class="span-or">{{ __('messages.or') }}</span>
                                    </div>

                                    <div class="social-login-btn">
                                        <a href="#" class="btn w-100">
                                            <img src="{{ asset('frontend/xx/assets/img/icons/google-icon.svg') }}"
                                                alt="google-icon">
                                            {{ __('messages.sign_in_with_google') }}
                                        </a>
                                    </div>

                                    <div class="text-center account-signup">
                                        <p>
                                            {{ __('messages.dont_have_account') }}
                                            <a href="{{ route('register.patient') }}">
                                                {{ __('messages.sign_up') }}
                                            </a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
