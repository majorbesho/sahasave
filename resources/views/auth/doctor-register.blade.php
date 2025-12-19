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
                                    alt="Doctor Register">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right">
                                <div class="login-header">
                                    <h3>{{ __('messages.doctor_register_title') }} <a
                                            href="{{ route('register.patient') }}">{{ __('messages.not_a_doctor') }}</a>
                                    </h3>
                                    <!-- 3. إضافة نص توضيحي -->
                                    <p class="text-muted">{{ __('messages.doctor_register_subtitle') }}</p>
                                </div>

                                <form method="POST" action="{{ route('register.doctor') }}" enctype="multipart/form-data">
                                    @csrf

                                    <h5 class="mb-3">{{ __('messages.account_information') }}</h5>
                                    <hr class="mt-0">

                                    <!-- Name, Email, Phone -->
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('messages.name') }}</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('messages.email') }}</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('messages.phone') }}</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            name="phone" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <h5 class="mt-4 mb-3">{{ __('messages.professional_details') }}</h5>
                                    <hr class="mt-0">

                                    <!-- Specialty Dropdown (From Database) -->
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('messages.specialty') }}</label>
                                        <select class="form-select @error('specialty') is-invalid @enderror"
                                            name="specialty" required>
                                            <option value="" selected disabled>--
                                                {{ __('messages.select_specialty') }} --</option>
                                            @foreach ($specialties as $specialty)
                                                <option value="{{ $specialty->id }}"
                                                    {{ old('specialty') == $specialty->id ? 'selected' : '' }}>
                                                    {{ $specialty->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('specialty')
                                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <!-- Medical License Number & Document -->
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('messages.license_number') }}</label>
                                        <input type="text"
                                            class="form-control @error('license_number') is-invalid @enderror"
                                            name="license_number" value="{{ old('license_number') }}" required>
                                        @error('license_number')
                                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('messages.license_document') }}</label>
                                        <input type="file"
                                            class="form-control @error('license_document') is-invalid @enderror"
                                            name="license_document" required>
                                        <small
                                            class="form-text text-muted">{{ __('messages.allowed_formats_pdf_jpg_png') }}</small>
                                        @error('license_document')
                                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <h5 class="mt-4 mb-3">{{ __('messages.password') }}</h5>
                                    <hr class="mt-0">

                                    <!-- Password & Confirmation -->
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('messages.create_password') }}</label>
                                        <div class="pass-group"><input type="password"
                                                class="form-control pass-input @error('password') is-invalid @enderror"
                                                name="password" required></div>
                                        @error('password')
                                            <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('messages.confirm_password') }}</label>
                                        <div class="pass-group"><input type="password" class="form-control pass-input"
                                                name="password_confirmation" required></div>
                                    </div>

                                    <!-- 2. إضافة الموافقة على الشروط -->
                                    <div class="mb-3 form-check">
                                        <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox"
                                            name="terms" id="terms" required>
                                        <label class="form-check-label" for="terms">
                                            {!! __('messages.agree_to_terms', ['url' => route('terms.And.Conditions')]) !!}
                                        </label>
                                        @error('terms')
                                            <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn btn-primary-gradient w-100"
                                            type="submit">{{ __('messages.apply_now') }}</button>
                                    </div>

                                    <div class="text-center account-signup">
                                        <p>{{ __('messages.already_have_account') }} <a
                                                href="{{ route('login') }}">{{ __('messages.sign_in') }}</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
