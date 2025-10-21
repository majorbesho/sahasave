@extends('frontend.layouts.master')


@section('content')



    <section class="register">
        <div class="inner-hero-section">
            <div class="container center">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="{{ asset('frontend3/img/logo500.png') }}" alt="" srcset="">
                    </div>
                    <div class="col-lg-6 pt-5 ">
                        <form method="POST" action="{{ route('register.submit') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end lab-text ">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Edit user --}}

                            <div class="row mb-3">
                                <label for="phone"
                                    class="col-md-4 col-form-label text-md-end lab-text">{{ __('phone') }}</label>
                                <div class="col-md-6">
                                    <input id="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- end edit user  --}}
                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end lab-text">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end lab-text">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>



                            <span class="login-form-copy">Or Login with</span>
                            <div class="social-icons">

                                <div class="social-icon facebook">
                                    <a href="{{route('login.facebook')}}" class="">
                                    <span class="fa-brands fa-facebook fa-lg"></span>
                                </a>
                                </div>
                                <div class="social-icon google">
                                    <a href="{{route('login.google')}}" class="">
                                    <span class="fa-brands fa-google"></span>
                                    </a>
                                </div>
                                <div class="social-icon linkedin">
                                    <a href="{{route('otp')}}" class="">
                                    <span class="fa-solid fa-mobile"></span>
                                    </a>
                                </div>
                            </div>




                                    {{--

                                        <div class="col-3 socailbtn">

                                            <a href="{{ route('login.google') }}" class="btn btn-danger btn-block pt-3">
                                                <i class="fa-brands fa-google"></i>
                                                <span>google </span>
                                            </a>
                                        </div>
                                        <div class="col-3  socailbtn">

                                            <a href="{{ route('login.facebook') }}" class="btn btn-primary btn-block pt-3">
                                                <i class="fa-brands fa-facebook fa-lg"></i>
                                               <span>facebook</span>
                                            </a>
                                        </div>
                                        <div class="col-3 md-3 socailbtn">
                                            <a href="{{ route('otp') }}" class="btn btn-primary btn-block pt-3">
                                                <i class="fa-solid fa-mobile"></i>
                                                <span>OTP</span>
                                            </a>
                                        </div> --}}

                                        <div class="col center">

                                            <button type="submit" class="btn btn-primary btn-block pt-3 socailbtn">
                                                {{ __('Register') }}
                                            </button>
                                        </div>



                                {{-- <a href="{{ route('login.google') }}" class="btn btn-danger btn-block pt-3">Login with
                                    Google</a> --}}


                                {{-- <a href="{{ route('login.facebook') }}" class="btn btn-primary btn-block pt-3">Login with
                                    Facebook</a> --}}



                                {{-- <a href="{{route('login.github')}}" class="btn btn-dark btn-block">Login with Github</a> --}}



                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">

                                </div>
                            </div>

                        </form>



                    </div>
                </div>
            </div>
        </div>
    </section>





   {{--  <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card register">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register.submit') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>--}}
                            {{-- Edit user

                            <div class="row mb-3">
                                <label for="phone"
                                    class="col-md-4 col-form-label text-md-end">{{ __('phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>--}}



                            {{-- <div class="form-group">
                                <label for="" class="lab-text">nationality</label>
                                <select name="nationality" id="nationality"> nationality
                                    <option value="">nationality</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}






                            {{-- <div class="row mb-3">
                                <label for="dateOfbarth"
                                    class="col-md-4 col-form-label text-md-end">{{ __('dateOfbarth') }}</label>

                                <div class="col-md-6">
                                    <input id="dateOfbarth" type="date"
                                        class="form-control @error('dateOfbarth') is-invalid @enderror"
                                        name="dateOfbarth" value="{{ old('dateOfbarth') }}" required
                                        autocomplete="dateOfbarth" autofocus>

                                    @error('dateOfbarth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                            {{-- <div class="row mb-3">
                                <label for="address"
                                    class="col-md-4 col-form-label text-md-end">{{ __('address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" required autocomplete="address" autofocus>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="photo"
                                    class="col-md-4 col-form-label text-md-end">{{ __('photo') }}</label>

                                <div class="col-md-6">
                                    <input id="photo" type="file"
                                        class="form-control @error('photo') is-invalid @enderror" name="photo"
                                        value="{{ old('photo') }}" required autocomplete="photo" autofocus>

                                    @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}

                            {{-- end edit user
                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-3 d-flex socila-reg">
                                <a href="{{ route('login.google') }}" class="btn btn-danger btn-block">
                                    Google</a>
                                <a href="{{ route('login.facebook') }}" class="btn btn-primary btn-block">
                                    Facebook</a>
                                <a href="{{ route('login.facebook') }}" class="btn btn-primary btn-block">
                                    OTP</a>

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button> --}}

                                {{-- <a href="{{route('login.github')}}" class="btn btn-dark btn-block">Login with Github</a>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
