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
                                <img src="{{ asset('frontend/xx/assets/img/login-banner.png') }}" class="img-fluid"
                                    alt="SehaSave.com Login">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right">
                                <div class="login-header">
                                    <h1 class="h3">Patient Register <a href="{{ route('register.doctor') }}">Are you a Doctor?</a></h1>
                                </div>


                                @if(session('rate_limit_message'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ session('rate_limit_message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form action="{{ route('patient.register.save') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input class="form-control form-control-lg group_formcontrol form-control-phone"
                                            id="Email" name="email" type="email" value="{{ old('email') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Phone</label>
                                        <input class="form-control form-control-lg group_formcontrol form-control-phone"
                                            id="phone" name="phone" type="text" value="{{ old('phone') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group-flex">
                                            <label class="form-label">Create Password</label>
                                        </div>
                                        <div class="pass-group">
                                            <input type="password" class="form-control pass-input" name="password"
                                                id="password" type="password" required>
                                            <span class="feather-eye-off toggle-password"></span>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <div class="pass-group">
                                            <input type="password" class="form-control pass-input"
                                                name="password_confirmation" required>
                                            <span class="feather-eye-off toggle-password"></span>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Referral Code (Optional)</label>
                                        <input type="text" class="form-control" name="referral_code" value="{{ old('referral_code', request('ref')) }}" placeholder="Enter referral code if you have one">
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn btn-primary-gradient w-100" type="submit">Sign Up</button>
                                    </div>
                                    <div class="login-or">
                                        <span class="or-line"></span>
                                        <span class="span-or">or</span>
                                    </div>
                                    <div class="social-login-btn">
                                        <a href="{{ route('auth.google.patient') }}" class="btn w-100 google-btn">
                                            <img src="{{ asset('frontend/xx/assets/img/icons/google-icon.svg') }}"
                                                alt="google-icon">Sign up With Google
                                        </a>
                                        <a href="javascript:void(0);" class="btn w-100 facebook-btn">
                                            <img src="{{ asset('frontend/xx/assets/img/icons/facebook-icon.svg') }}"
                                                alt="fb-icon">Sign up With Facebook
                                        </a>
                                    </div>
                                    <div class="account-signup">
                                        <p>Already have account? <a href="{{ route('login') }}">Sign In</a></p>
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



<style>
    .social-login-btn .btn {
        border: 1px solid #ddd;
        padding: 12px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.3s ease;
    }
    
    .social-login-btn .btn:hover {
        background-color: #f8f9fa;
        border-color: #ccc;
    }
    
    .social-login-btn img {
        width: 20px;
        height: 20px;
    }
    
    .google-btn {
        background-color: #fff;
        color: #757575;
    }
    
    .facebook-btn {
        background-color: #3b5998;
        color: #fff;
    }
    
    .facebook-btn:hover {
        background-color: #344e86;
        color: #fff;
    }
</style>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(function(toggle) {
            toggle.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                
                // Toggle icon
                this.classList.toggle('feather-eye');
                this.classList.toggle('feather-eye-off');
            });
        });
        
        // Form validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.querySelector('[name="password_confirmation"]').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('كلمات المرور غير متطابقة');
            }
            
            if (password.length < 8) {
                e.preventDefault();
                alert('كلمة المرور يجب أن تكون 8 أحرف على الأقل');
            }
        });
    });
</script>
@endsection