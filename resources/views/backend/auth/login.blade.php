@extends('frontend.layouts.master')


@section('content')
    <div class="pt-5 inner-hero-section style--six" style="padding-top: 20px">
        {{-- <div class="bg-shape"><img src="{{asset('frontend2/assets/images/elements/inner-hero-shape-2.png')}}" alt="image"></div> --}}
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                </div>
            </div>
        </div>
    </div>

    <!-- Content
                              ============================================= -->
    <section id="content">
        <div class="pt-5 content-wrap">
            <div class="container clearfix pt-5">

                <div class="mx-auto mb-0 accordion accordion-lg " style="max-width: 550px;">

                    <div class="accordion-header">
                        <div class="accordion-icon">
                            <i class="accordion-closed icon-lock3"></i>
                            <i class="accordion-open icon-unlock"></i>
                        </div>
                        <div class="accordion-title">
                            Login to your Admin/Account
                        </div>
                    </div>
                    <div class="">


                        <form id="login-form" name="login-form" class="mb-0 row" method="POST"
                            action="{{ route('admin.login') }}">
                            @csrf


                            <div class="mb-3 row">
                                <label for="email" class="col-md-4 col-form-label text-md-end">
                                    {{ __('Email Address') }}
                                </label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control
                                             @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="password" class="col-md-4 col-form-label text-md-end">
                                    {{ __('Password') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password')
                                              is-invalid @enderror"
                                        name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }} style="width: 10%;height: 38%;">
                                        <label class="form-check-label" for="remember" style="color: #000;">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0 row">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn "
                                        style="display: block;padding: 1em 1em;
                                            color: #7288a2;background-color: #2e1c60;border-radius: 5%;">
                                        {{ __('Login') }}
                                    </button>

                                    {{-- @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif --}}
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="accordion-header">
                        <div class="accordion-icon">
                            {{-- <i class="accordion-closed icon-user4"></i> --}}
                            <i class="accordion-open icon-ok-sign"></i>
                        </div>

                    </div>
                    {{-- <div class="clearfix accordion-content">
							<form id="register-form" name="register-form" class="mb-0 row" action="#" method="post">
								<div class="col-12 form-group">
									<label for="register-form-name">Name:</label>
									<input type="text" id="register-form-name" name="register-form-name" value="" class="form-control" />
								</div>

								<div class="col-12 form-group">
									<label for="register-form-email">Email Address:</label>
									<input type="text" id="register-form-email" name="register-form-email" value="" class="form-control" />
								</div>

								<div class="col-12 form-group">
									<label for="register-form-username">Choose a Username:</label>
									<input type="text" id="register-form-username" name="register-form-username" value="" class="form-control" />
								</div>

								<div class="col-12 form-group">
									<label for="register-form-phone">Phone:</label>
									<input type="text" id="register-form-phone" name="register-form-phone" value="" class="form-control" />
								</div>

								<div class="col-12 form-group">
									<label for="register-form-password">Choose Password:</label>
									<input type="password" id="register-form-password" name="register-form-password" value="" class="form-control" />
								</div>

								<div class="col-12 form-group">
									<label for="register-form-repassword">Re-enter Password:</label>
									<input type="password" id="register-form-repassword" name="register-form-repassword" value="" class="form-control" />
								</div>

								<div class="col-12 form-group">
									<button class="m-0 button button-3d button-black" id="register-form-submit" name="register-form-submit" value="register">Register Now</button>
								</div>
							</form>
						</div> --}}

                </div>

            </div>
        </div>
    </section><!-- #content end -->
@endsection
