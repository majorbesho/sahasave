@extends('frontend.layouts.master')


@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <!-- Login Tab Content -->
                    <div class="account-content">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-7 col-lg-6 login-left">
                                <img src="assets/img/login-banner.png" class="img-fluid" alt="Doccure Login">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right">
                                <div class="login-header">
                                    <h3>Patient Register <a href="{{ route('register.doctor') }}">Are you a Doctor?</a></h3>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('patient.register.save') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" id="name" class="form-control" name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input class="form-control form-control-lg group_formcontrol form-control-phone"
                                            id="Email" name="email" type="email">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Phone</label>
                                        <input class="form-control form-control-lg group_formcontrol form-control-phone"
                                            id="phone" name="phone" type="text">
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group-flex">
                                            <label class="form-label">Create Password</label>
                                        </div>
                                        <div class="pass-group">
                                            <input type="password" class="form-control pass-input" name="password"
                                                id="password" type="password">
                                            <span class="feather-eye-off toggle-password"></span>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <div class="pass-group">
                                            <input type="password" class="form-control pass-input"
                                                name="password_confirmation">
                                            <span class="feather-eye-off toggle-password"></span>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn btn-primary-gradient w-100" type="submit">Sign Up</button>
                                    </div>
                                    <div class="login-or">
                                        <span class="or-line"></span>
                                        <span class="span-or">or</span>
                                    </div>
                                    <div class="social-login-btn">
                                        <a href="javascript:void(0);" class="btn w-100">
                                            <img src="assets/img/icons/google-icon.svg" alt="google-icon">Sign in With
                                            Google
                                        </a>
                                        <a href="javascript:void(0);" class="btn w-100">
                                            <img src="assets/img/icons/facebook-icon.svg" alt="fb-icon">Sign in With
                                            Facebook
                                        </a>
                                    </div>
                                    <div class="account-signup">
                                        <p>Already have account? <a href="login.html">Sign In</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Login Tab Content -->

                </div>
            </div>

        </div>

    </div>
@endsection
