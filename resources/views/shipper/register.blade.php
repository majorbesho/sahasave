@extends('frontend.layouts.master')





@section('content')
    <style>
        .contentCol {
            justify-content: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .simpleInput {
            border: 0px !important;
            border-bottom: 1px solid #6472d9 !important;
            border-radius: 0px !important;
            padding: 0px !important;
            margin: 15px 0px 14px 0px;
        }


        .mainHeader {
            font-size: 2.34rem;
            font-weight: 700;
            color: #496683;
            margin-bottom: 10px;
        }

        .regImg {
            width: 450px;
            margin-bottom: 30px;
        }

        .testimonialVideo {
            border-radius: 25px;
            height: 235px;
            width: 100%;
            margin: 40px 0px;
        }

        @media screen and (max-width: 767px) {
            .testimonialVideo {
                height: 420px;
            }
        }

        .intro {
            position: relative;
        }

        .supp {
            background-color: #0b2f9f;
            margin: 0;
            min-height: 100vh;
            /* background: center / 100px auto no-repeat, url(http://127.0.0.1:8000/4/assets/images/logoBluBGyollow.PNG) right / cover no-repeat, linear-gradient(to right, #FFB6C1 10%, #fabc3f 51%, #FFB6C1 100%) center / cover no-repeat; */
            animation: animate 60s linear infinite;
        }

        /* url({{ asset('4/assets/images/logoBluBGyollow.PNG') }}) */

        @keyframes animate {
            to {
                background-position: center, left, center;
            }
        }


        .flag-icon {
            width: 20px;
            height: 15px;
            margin-right: 8px;
            display: inline-block;
            vertical-align: middle;
        }

        .select2-container--default .select2-selection--single {
            height: 38px;
            padding: 5px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 28px;
        }

        .select2-container--default .select2-results__option--highlighted {
            background-color: #f8f9fa;
            color: #333;
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #e9ecef;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <div class="container" style="margin-top: 24px;">
        <div class="row">
            <div class="col-lg-6 col-md-6 text-center">
                <div class="loginHeading">
                    <h2 class="mainHeader">Create your free Shipper account</h2>
                    <p>
                    <h5>100% free. No credit card needed.</h5>
                    </p>
                    <hr>
                </div>
                <div class="loginForm">
                    <form method="POST" action="{{ route('registerpostshipper') }}" class="">
                        @csrf

                        <input type="email" class="form-control simpleInput @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email"
                            placeholder="Enter Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="password" class="form-control simpleInput @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password" placeholder="Enter Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="password" class="form-control simpleInput" name="password_confirmation" required
                            autocomplete="new-password" placeholder=" Confirm Password">
                        <input type="text" class="form-control simpleInput" placeholder="Full Name" name="name"
                            id="name">

                        <input type="text" class="form-control simpleInput" name="referral_code" id="referral_code"
                            class="form-control" value="{{ old('referral_code') }}"
                            placeholder="Enter Your referral code (Optional )">

                        <input type="file" class="form-control  simpleInput" id="photo" name="photo">
                        <input type="date" class="form-control  simpleInput" id="dateOfbarth" name="dateOfbarth">





                        <select id="countrySelect" class="form-control" style="width: 100%">
                            <option value="">Select a country...</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country['code'] }}" data-flag="{{ $country['flag'] }}">
                                    {{ $country['name'] }}
                                </option>
                            @endforeach
                        </select>

                        <div id="selectedCountry" class="mt-3" style="display: none;">
                            <strong>Selected:</strong>
                            <img id="selectedFlag" src="" class="flag-icon">
                            <span id="selectedName"></span>
                        </div>


                        <div class="custom-dropdown">

                            <ul class="dropdown-menu">
                                @foreach ($countries as $country)
                                    <li data-value="{{ $country['code'] }}">
                                        <img src="{{ asset($country['flag']) }}" width="20" height="15">
                                        {{ $country['name'] }}
                                    </li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="nationality" id="nationality-input">
                        </div>





                        <div class="row mb-3 pt-10">
                            <input id="phone" type="tel" name="phone" placeholder="Phone Number"
                                class="form-control simpleInput" required style="padding-left: 55px!important;" />
                        </div>


                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    <a href="{{ route('privacy.policy') }}"> I agree to the terms</a>
                                </label>
                            </div>
                        </div>

                        <button class="btn btn-primary w-100 mt-4" type="submit">Sign up!</button>
                    </form>
                    <div class="social-buttons">
                        <button class="facebook">
                            <i class="fab fa-facebook-f"></i>
                            Login with Facebook
                        </button>
                        <button class="twitter">
                            <i class="fab fa-twitter"></i>
                            Login with Twitter
                        </button>
                        <button class="google">
                            <i class="fab fa-google"></i>
                            Login with Google
                        </button>
                        <button class="instagram">
                            <i class="fab fa-instagram"></i>
                            Login with Instagram
                        </button>
                    </div>
                    <div class="col-md-12">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>



                    <div class="col-md-12">
                        <h5> Alrady have a account? </h5>
                        <a href="{{ route('user.auth') }}">Login</a>
                    </div>


                    <p class="mt-4 mb-5">
                    <h4>We're committed to your privacy. SahaSave.com uses the information you provice to
                        us to
                        contact you about our relevant content and services. For more information, see our Privacy Policy.
                    </h4>
                    </p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6  supp" style="padding-left: 2%; margin-bottom: 2% ; position: relative;">

                <div>
                    <img src="{{ asset('4/assets/images/backgrounds/quote-v1-bg.jpg') }}" alt=""
                        style="
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        opacity: 0.2;
                        width: 100%; height: 100%; object-fit: cover;
                        border-radius: 2px;
                    ">
                </div>

                <canvas id="canvas" data-image="{{ asset('4/assets/images/logo2.png') }}"></canvas>
                <div class="intro">
                    <div>


                        <h1 style="color: #fff">Interactive SahaSave.com </h1>
                        <p>
                        <h4 style="color: #fff">Interactive SahaSave.com is a streamlined solution for shippers and
                            carriers,
                            enhancing logistics
                            with real-time tracking and seamless communication. By leveraging technology, it optimizes
                            SahaSave.com
                            management, reduces costs, and improves efficiency. This platform connects businesses with
                            reliable
                            trucking partners, ensuring timely deliveries and fostering a more collaborative supply chain.
                        </h4>

                        </p>
                    </div>


                </div>

            </div>


            <hr>
        </div>
        <div class="row mt-5">
            <div class="col-12 col-md-6 col-lg-4">
                <iframe class="testimonialVideo"
                    src="https://www.youtube.com/embed/LIf6hI3-hJ0?si=IyNsEhnVuVZbBEE2"></iframe>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <iframe class="testimonialVideo"
                    src="https://www.youtube.com/embed/LIf6hI3-hJ0?si=IyNsEhnVuVZbBEE2"></iframe>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <iframe class="testimonialVideo"
                    src="https://www.youtube.com/embed/LIf6hI3-hJ0?si=IyNsEhnVuVZbBEE2"></iframe>
            </div>
        </div>
    </div>



    <script>
        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });



        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.style.borderColor = '#007bff';
                this.style.boxShadow = '0 0 5px rgba(0, 123, 255, 0.5)';
            });

            input.addEventListener('blur', function() {
                this.style.borderColor = '#ddd';
                this.style.boxShadow = 'none';
            });
        });
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {
            function formatCountry(country) {
                if (!country.id) {
                    return country.text;
                }

                var $country = $(
                    '<span><img class="flag-icon" src="' + $(country.element).data('flag') + '" /> ' + country
                    .text + '</span>'
                );
                return $country;
            }

            $('#countrySelect').select2({
                placeholder: "Select a country",
                allowClear: true,
                templateResult: formatCountry,
                templateSelection: formatCountry
            });

            $('#countrySelect').on('change', function() {
                var selected = $(this).find('option:selected');
                var flag = selected.data('flag');
                var name = selected.text();

                if (flag && name) {
                    $('#selectedFlag').attr('src', flag);
                    $('#selectedName').text(name);
                    $('#selectedCountry').show();
                } else {
                    $('#selectedCountry').hide();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // تهيئة nice-select
            $('#countrySelect').niceSelect();

            // تعديل العناصر لعرض الأعلام
            function updateNiceSelectFlags() {
                $('.nice-select .list li').each(function() {
                    var value = $(this).data('value');
                    if (value) {
                        var option = $('#countrySelect option[value="' + value + '"]');
                        var flagUrl = option.data('flag');

                        if (flagUrl) {
                            $(this).prepend('<img src="' + flagUrl + '" class="flag-icon" />');
                        }
                    }
                });

                // تحديث العنصر المحدد
                var selected = $('#countrySelect').find('option:selected');
                if (selected.val()) {
                    var flagUrl = selected.data('flag');
                    $('.nice-select .current').prepend('<img src="' + flagUrl + '" class="flag-icon" />');
                }
            }

            // استدعاء الوظيفة عند التحميل وعند التغيير
            updateNiceSelectFlags();

            $('#countrySelect').on('change', function() {
                $('.nice-select .current').html(function() {
                    var selected = $('#countrySelect').find('option:selected');
                    var flagUrl = selected.data('flag');
                    var text = selected.text();

                    if (flagUrl) {
                        return '<img src="' + flagUrl + '" class="flag-icon" /> ' + text;
                    }
                    return text;
                });

                updateNiceSelectFlags();
            });
        });
    </script>


    {{-- <script>
        $(document).ready(function() {
            // تهيئة Select2 مع دعم الأعلام
            $('.select2-with-flags').select2({
                theme: 'bootstrap-5',
                templateResult: formatOption,
                templateSelection: formatOption,
                width: '100%'
            });

            function formatOption(option) {
                if (!option.id) return option.text;

                const flag = $(option.element).data('flag');
                const $wrapper = $('<span></span>');

                if (flag) {
                    $wrapper.append($('<span class="flag-icon">').text(flag));
                    $wrapper.append(' ');
                }

                $wrapper.append(option.text);
                return $wrapper;
            }
        });
    </script> --}}
@endsection
