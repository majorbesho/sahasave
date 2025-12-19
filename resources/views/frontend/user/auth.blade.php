@extends('frontend.layouts.master')

@section('content')
    <!-- Ec login page -->




    </section>
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Log In</h2>
                        <h2 class="ec-title">Log In</h2>
                        <p class="sub-title mb-3">Best place to BookingSehaSave.com </p>
                    </div>
                </div>
                <div class="ec-login-wrapper">
                    <div class="ec-login-container">
                        <div class="ec-login-form">
                            <form method="POST" action="{{ route('loginsubmit') }}">
                                @csrf
                                <span class="ec-login-wrap">
                                    <label>Email Address*</label>
                                    <input type="text" name="email"
                                        class="form-control
                                @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" autocomplete="email" autofocus
                                        placeholder="Enter your email add..." required />

                                </span>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <span class="ec-login-wrap">
                                    <label>Password*</label>
                                    <input type="password" id="password"
                                        class="form-control @error('password')
                                is-invalid @enderror"
                                        name="password" required autocomplete="current-password"
                                        placeholder="Enter your password" required />

                                </span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                {{-- <span class="ec-login-wrap ec-login-fp">
                                    <label><a href="#">Forgot Password?</a></label>
                                </span> --}}
                                <span class="ec-login-wrap ec-login-btn">
                                    <button class="btn btn-primary" type="submit">Login</button>
                                    <a href="{{ route('newreg') }}" class="btn btn-secondary">Register</a>
                                </span>
                                <div class="row mb-0">
                                    <div class="col-md-12">
                                        {{-- <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button> --}}

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");
        });
    </script>




    <script>
        $('#single-select-clear-field').select2({

            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : '100%',
            placeholder: $(this).data('placeholder'),
            allowClear: true
        });
    </script>

    <script>
        $('#single-select-clear-field1').select2({
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : '100%',
            placeholder: $(this).data('placeholder'),
            allowClear: true
        });

        $("#single-select-clear-field1").off("change").on("change", function() {
            let codeArray = this.value.split(" ");
            let code = codeArray[codeArray.length - 1];
            $(this).parent().find(".current").html("+" + code);
        });

        $("#single-select-clear-field1").trigger("change");
    </script>
    <script>
        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
    </script>

    <script></script>
@endsection
