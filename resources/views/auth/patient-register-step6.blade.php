@extends('frontend.layouts.master')


@section('content')
    <!-- Register Content -->
    <div class="account-content">
        <div class="d-flex align-items-center">
            <div class="login-right">
                <div class="inner-right-login">
                    <div class="login-header">
                        <div class="logo-icon">
                            <img src="https://SehaSave.com.dreamstechnologies.com/laravel/template/public/assets/img/logo.png"
                                alt="SehaSave.com-logo">
                        </div>
                        <div class="step-list">
                            <ul>
                                <li><a href="javascript:;" class="active-done">1</a></li>
                                <li><a href="javascript:;" class="active-done">2</a></li>
                                <li><a href="javascript:;" class="active">3</a></li>
                                <li><a href="javascript:;">4</a></li>
                                <li><a href="javascript:;">5</a></li>
                            </ul>
                        </div>
                        <form method="post">
                            <div class="mt-2 text-start">
                                <p>Who all you want to cover in health insurance</p>
                                <h4 class="mt-3">Select Members</h4>
                            </div>
                            <div class="checklist-col pregnant-col">
                                <div class="remember-me-col d-flex justify-content-between">
                                    <span class="mt-1">Self</span>
                                    <label class="mb-3 custom_check">
                                        <input type="checkbox" class="" name="self" id="self" value="1"
                                            checked="">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="remember-me-col d-flex justify-content-between">
                                    <span class="mt-1">Spouse</span>
                                    <label class="mb-3 custom_check">
                                        <input type="checkbox" class="" name="spouse" id="spouse" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="remember-me-col d-flex justify-content-between">
                                    <span class="mt-1">Child</span>
                                    <div class="mt-3 increment-decrement">
                                        <div class="input-groups">
                                            <input type="button" value="-" id="subs"
                                                class="button-minus dec button">
                                            <input type="text" name="child" id="child" value="0"
                                                class="quantity-field">
                                            <input type="button" value="+" id="adds"
                                                class="button-plus inc button a1 a2 a3 a4 a0">
                                        </div>
                                    </div>
                                </div>
                                <div class="remember-me-col d-flex justify-content-between">
                                    <span class="mt-1">Mother</span>
                                    <label class="mb-3 custom_check">
                                        <input type="checkbox" class="" name="mother" id="mother" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="remember-me-col d-flex justify-content-between">
                                    <span class="mt-1">Father</span>
                                    <label class="mb-3 custom_check">
                                        <input type="checkbox" class="" name="father" id="father" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="mt-5">
                                <a href="https://SehaSave.com.dreamstechnologies.com/laravel/template/public/patient-register-step4"
                                    class="btn btn-primary w-100 btn-lg login-btn step3_submit">Continue </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="login-bottom-copyright">
                    <span>©
                        <script type="0e01b108b0e430f0ac849d56-text/javascript">document.write(new Date().getFullYear())</script> SehaSave.com. All rights reserved.
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- /Register Content -->
    <!-- /Register Content -->
@endsection
