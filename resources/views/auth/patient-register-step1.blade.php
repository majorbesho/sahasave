@extends('frontend.layouts.master')


@section('content')
    <div class="pt-0 content login-page">
        <div class="container-fluid">

            <!-- Register Content -->
            <div class="account-content">
                <div class="d-flex align-items-center">
                    <div class="login-right">
                        <div class="inner-right-login">
                            <div class="login-header">
                                <div class="logo-icon">
                                    <img src="https://doccure.dreamstechnologies.com/laravel/template/public/assets/img/logo.png"
                                        alt="doccure-logo">
                                </div>
                                <div class="step-list">
                                    <ul>
                                        <li><a href="javascript:;" class="active">1</a></li>
                                        <li><a href="javascript:;">2</a></li>
                                        <li><a href="javascript:;">3</a></li>
                                        <li><a href="javascript:;">4</a></li>
                                        <li><a href="javascript:;">5</a></li>
                                    </ul>
                                </div>
                                <form id="profile_pic_form" enctype="multipart/form-data">
                                    <div class="profile-pic-col">
                                        <h3>Profile Picture</h3>
                                        <div class="profile-pic-upload">
                                            <div class="cam-col">
                                                <img src="https://doccure.dreamstechnologies.com/laravel/template/public/assets/img/icons/camera.svg"
                                                    id="prof-avatar" alt="camera-image" class="img-fluid">
                                            </div>
                                            <span>Upload Profile Picture</span>
                                            <input type="file" id="profile_image" name="profile_image">
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <a href="https://doccure.dreamstechnologies.com/laravel/template/public/patient-register-step2"
                                            class="btn btn-primary w-100 btn-lg login-btn step1_submit">Continue </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="login-bottom-copyright">
                            <span>©
                                <script type="39b668be0f81ef58f9f704dc-text/javascript">document.write(new Date().getFullYear())</script> Doccure. All rights reserved.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Register Content -->

        </div>
    </div>
@endsection
