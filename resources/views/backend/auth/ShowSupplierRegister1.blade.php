@extends('frontend.layouts.master')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
{{-- <link rel="stylesheet" href="{{asset('frontend4/css/intlTelInput.css')}}"> --}}

{{-- <script src="{{ asset('frontend4/js/tele.js') }}"></script> --}}
<script src="{{ asset('4/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

@section('content')
    <div class="container">

        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- Theme style -->
        {{-- <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}"> --}}

        <div class="container">
            <div class="row">

                <div class="card-body">
                    <p class="login-box-msg">
                    <h1>Sign Up a new membership</h1>
                    </p>


                    <form action="{{ route('supplier.register1.post') }}" method="post">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Full name" name="title" id="title"
                                value="{{ old('title') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                                value="{{ old('email') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="tele" class="form-control" placeholder="Tele" name="tele" id="tele"
                                value="{{ old('tele') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password"
                                id="password" value="{{ old('password') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Retype password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>


                        <div class="input-group mb-3">
                            <input type="text" class="form-control simpleInput" name="referral_code" id="referral_code"
                                class="form-control" value="{{ old('referral_code') }}"
                                placeholder="Enter Your referral code (Optional )">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input id="phone" type="tel" name="phone" placeholder="Phone Number"
                                class="form-control simpleInput" required style="padding-left: 55px!important;" />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                    <label for="agreeTerms">
                                        <h3>I agree to the</h3> <a href="{{ route('privacy.policy') }}">terms</a>
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <div>
                        <p>
                        <h3> I already have a membership</h3>
                        </p><a href="{{ route('supplier.login.form') }}" class="text-center">Login </a>
                    </div>
                    <div class="social-auth-links text-center">
                        <a href="#" class="btn btn-block btn-primary">
                            <i class="fab fa-facebook mr-2"></i>
                            Sign up using Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i>
                            Sign up using Google+
                        </a>
                    </div>

                </div>

            </div>
        </div>


        <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>



        {{-- <div class="row">
        <form id="quickForm" action="{{ route('trauck.store') }}" method="POST">
            @csrf

            <div class="card-body">
                <div class="contrainer">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2"><label for="title">Title</label></div>
                                    <div class="col-10"><input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter title" value="{{ old('title') }}"></div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <div class="row">
                                <div class="col-2"><label for="Caturl">Caturl</label></div>
                                <div class="col-10"><input type="Caturl" name="Caturl" class="form-control" placeholder="Enter Caturl"
                                value="{{ old('Caturl') }}"> </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2"><label for="Caturl">Caturl</label></div>
                                    <div class="col-10"><input type="Caturl" name="Caturl" class="form-control" placeholder="Enter Caturl"
                                        value="{{ old('Caturl') }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="container pt-2">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2"> <label for="">price</label></div>
                                    <div class="col-10"><input type="text" name="price" class="form-control" id=""
                                        placeholder="Enter price" value="{{ old('price') }}"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2"> <label for="">showPrice</label></div>
                                    <div class="col-10"> <input type="text" name="showPrice" class="form-control" id=""
                                    placeholder="Enter showPrice" value="{{ old('showPrice') }}"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2"><label for="">discount</label></div>
                                    <div class="col-6"><input type="text" name="discount" class="form-control" id=""
                                        placeholder="Enter discount" value="{{ old('discount') }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="locationCountry">locationCountry</label>
                            <input type="text" name="locationCountry" class="form-control" id="exampleInputEmail1"
                                placeholder="Enter locationCountry" value="{{ old('locationCountry') }}">
                            </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="locationCity">locationCity</label>
                            <input type="text" name="locationCity" class="form-control" id="exampleInputEmail1"
                                placeholder="Enter locationCity" value="{{ old('locationCity') }}">
                            </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="locationL">locationL</label>
                            <input type="text" name="locationL" class="form-control" id="exampleInputEmail1"
                                placeholder="Enter locationL" value="{{ old('locationL') }}">
                            </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="locationG">locationG</label>
                            <input type="text" name="locationG" class="form-control" id="exampleInputEmail1"
                                placeholder="Enter locationG" value="{{ old('locationG') }}">
                            </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="refId">refId</label>
                            <input type="text" name="refId" class="form-control" id=""
                                placeholder="Enter refId" value="{{ old('refId') }}">
                        </div>

                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="lenght">lenght</label>
                                <input type="text" name="lenght" class="form-control" id=""
                                    placeholder="Enter lenght" value="{{ old('lenght') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="weght">weght</label>
                            <input type="text" name="weght" class="form-control" id=""
                                placeholder="Enter weght" value="{{ old('weght') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">supplier</label>
                <input type="text" name="supplier" class="form-control" id=""
                    placeholder="Enter supplier" value="{{ old('supplier') }}">
            </div>
            <div class="form-group">
                <label for="slug">discreption</label>
                <textarea id="summernote" name="discreption" placeholder="Enter discreption">
                    {{ old('discreption') }}
                </textarea>
            </div>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="lfm" data-input="thumbnail" data-preview="holder"
                        class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                    </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="photo">
            </div>
            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Select your Brand</label>
                            <select name="brand_id">
                                <option value="">---Select you option---</option>
                                @foreach (\App\Models\Brand::get() as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Select your Category</label>
                            <select name="cat_id">
                                <option value="">---Select you option---</option>
                                @foreach (\App\Models\Category::get() as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Select your status</label>
                            <select name="status">
                                <option value="">---Select you status---</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                    ---active---</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                    ---inactive--</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Select your conditaion </label>
                            <select name="conditaion">
                                <option value="">---Select you conditaion---</option>

                                <option value="popular"
                                    {{ old('conditaion') == 'popular' ? 'selected' : '' }}> popular</option>
                                <option value="all" {{ old('conditaion') == 'all' ? 'selected' : '' }}>all
                                </option>
                                <option value="new" {{ old('conditaion') == 'new' ? 'selected' : '' }}>new
                                </option>


                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Select your show</label>
                            <select name="showx">
                                <option value="">---Select you option---</option>
                                <option value="showin" {{ old('showx') == 'showin' ? 'selected' : '' }}>
                                    ---show---</option>
                                <option value="notshow" {{ old('notshow') == 'notshow' ? 'selected' : '' }}>
                                    ---notshow--</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>

            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

    </div> --}}
    </div>

    <script>
        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
    </script>
@endsection
