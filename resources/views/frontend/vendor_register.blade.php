@extends('frontend.layouts.master')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
{{-- <link rel="stylesheet" href="{{asset('frontend4/css/intlTelInput.css')}}"> --}}

<script src="{{ asset('frontend4/js/tele.js') }}"></script>

@section('content')
    <div class="container">
        <div class="row">
            <div id="container" class="container mt-5">
                <div class="progress px-1" style="height: 3px;">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
                <div class="step-container d-flex justify-content-between">
                    <div class="step-circle" onclick="displayStep(1)">1</div>
                    <div class="step-circle" onclick="displayStep(2)">2</div>
                    <div class="step-circle" onclick="displayStep(3)">3</div>
                </div>

                <form id="multi-step-form">
                    <div class="step step-1">
                        <!-- Step 1 form fields here -->
                        <h3>Step 1</h3>
                        <div class="mb-3">
                            <label for="field1" class="form-label">Field 1:</label>
                            <input type="text" class="form-control" id="field1" name="field1">
                        </div>
                        <button type="button" class="btn btn-primary next-step">Next</button>
                    </div>

                    <div class="step step-2">
                        <!-- Step 2 form fields here -->
                        <h3>Step 2</h3>
                        <div class="mb-3">
                            <label for="field2" class="form-label">Field 2:</label>
                            <input type="text" class="form-control" id="field2" name="field2">
                        </div>
                        <button type="button" class="btn btn-primary prev-step">Previous</button>
                        <button type="button" class="btn btn-primary next-step">Next</button>
                    </div>

                    <div class="step step-3">
                        <!-- Step 3 form fields here -->
                        <h3>Step 3</h3>
                        <div class="mb-3">
                            <label for="field3" class="form-label">Field 3:</label>
                            <input type="text" class="form-control" id="field3" name="field3">
                        </div>
                        <button type="button" class="btn btn-primary prev-step">Previous</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



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
    </style>
    <div class="container" style="margin-top: 24px;">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 text-center">
                <div class="loginHeading">
                    <h2 class="mainHeader">Create your free account</h2>
                    <p>100% free. No credit card needed.</p>
                    <hr>
                </div>
                <div class="loginForm">
                    <form method="POST" action="{{ route('register.submit') }}" class="">
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
                        {{-- <select class="form-control simpleInput">
                            <option disabled selected>Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            </select> --}}
                        <div class="row mb-3 pt-10">
                            <input id="phone" type="tel" name="phone" placeholder="Phone Number"
                                class="form-control simpleInput" required style="padding-left: 55px!important;" />
                        </div>

                        <button class="btn btn-primary w-100 mt-4" type="submit">Sign up!</button>
                    </form>
                    <p class="mt-4 mb-5">We're committed to your privacy. SahaSave.com uses the information you provice to
                        us to
                        contact you about our relevant content and services. For more information, see our Privacy Policy.
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 offset-lg-1 text-center contentCol">
                <img class="regImg" src="{{ asset('frontend/4/images/logo10.png') }}" alt="image">
                <h5>Get Started with SahaSave.com </h5>
                <p>Be the next winner. Start your Journey now</p>
            </div>
            <hr>
        </div>
        <div class="row mt-5">
            <div class="col-12 col-md-6 col-lg-4">
                <iframe class="testimonialVideo" src="https://www.youtube.com/embed/"></iframe>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <iframe class="testimonialVideo" src="https://www.youtube.com/embed/"></iframe>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <iframe class="testimonialVideo" src="https://www.youtube.com/embed/"></iframe>
            </div>
        </div>
    </div>

    <script>
        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
    </script>


    <script>
        var currentStep = 1;
        var updateProgressBar;

        function displayStep(stepNumber) {
            if (stepNumber >= 1 && stepNumber <= 3) {
                $(".step-" + currentStep).hide();
                $(".step-" + stepNumber).show();
                currentStep = stepNumber;
                updateProgressBar();
            }
        }

        $(document).ready(function() {
            $('#multi-step-form').find('.step').slice(1).hide();

            $(".next-step").click(function() {
                if (currentStep < 3) {
                    $(".step-" + currentStep).addClass("animate__animated animate__fadeOutLeft");
                    currentStep++;
                    setTimeout(function() {
                        $(".step").removeClass("animate__animated animate__fadeOutLeft").hide();
                        $(".step-" + currentStep).show().addClass(
                            "animate__animated animate__fadeInRight");
                        updateProgressBar();
                    }, 500);
                }
            });

            $(".prev-step").click(function() {
                if (currentStep > 1) {
                    $(".step-" + currentStep).addClass("animate__animated animate__fadeOutRight");
                    currentStep--;
                    setTimeout(function() {
                        $(".step").removeClass("animate__animated animate__fadeOutRight").hide();
                        $(".step-" + currentStep).show().addClass(
                            "animate__animated animate__fadeInLeft");
                        updateProgressBar();
                    }, 500);
                }
            });

            updateProgressBar = function() {
                var progressPercentage = ((currentStep - 1) / 2) * 100;
                $(".progress-bar").css("width", progressPercentage + "%");
            }
        });
    </script>
@endsection
