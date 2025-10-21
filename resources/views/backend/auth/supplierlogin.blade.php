
@extends('frontend.layouts.master')


@section('content')

        <div class="inner-hero-section style--six">
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
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="accordion accordion-lg mx-auto mb-0 " style="max-width: 550px;">

						<div class="accordion-header">
							<div class="accordion-icon">
								<i class="accordion-closed icon-lock3"></i>
								<i class="accordion-open icon-unlock"></i>
							</div>
							<div class="accordion-title">
								Login to your Supplier/Account
							</div>
						</div>
						<div class=" ">


                                <form id="login-form" name="login-form" class="row mb-0" method="POST" action="{{route('supplier.post')}}">
                                    @csrf


                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">
                                            {{ __('Email Address') }}
                                        </label>
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control
                                             @error('email') is-invalid @enderror" name="email"
                                             value="{{ old('email') }}" required
                                             autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-end">
                                            {{ __('Password') }}
                                        </label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                             class="form-control @error('password')
                                              is-invalid @enderror" name="password"
                                              required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="width: 10%;height: 38%;">
                                                <label class="form-check-label" for="remember" style="color: #000;">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn " style="display: block;padding: 1em 1em;
                                            color: #7288a2;background-color: #2e1c60;border-radius: 5%;">
                                                {{ __('Login') }}
                                            </button>


                                        </div>
                                    </div>
                                </form>
                                <div class="row mt-3">

                                </div>
						</div>

						<div class="accordion-header">
							<div class="accordion-icon">
								{{-- <i class="accordion-closed icon-user4"></i> --}}
								<i class="accordion-open icon-ok-sign"></i>
							</div>

						</div>


					</div>

				</div>
			</div>
		</section><!-- #content end -->

@endsection
