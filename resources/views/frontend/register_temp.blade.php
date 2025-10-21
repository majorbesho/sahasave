@extends('frontend.layouts.master')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
{{-- <link rel="stylesheet" href="{{asset('frontend4/css/intlTelInput.css')}}"> --}}

{{-- <script src="{{ asset('frontend4/js/tele.js') }}"></script> --}}
<script src="{{ asset('4/assets/js/jquery-3.6.0.min.js') }}"></script>




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
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <div class="container" style="margin-top: 24px;">
        <div class="row">
            <div class="col-lg-6 col-md-6 text-center">
                <div class="loginHeading">
                    <h2 class="mainHeader">Create your free account</h2>
                    <p>
                    <h5>100% free. No credit card needed.</h5>
                    </p>
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
    </script>
    <script>
        const phoneInputField2 = document.querySelector("#phone2");
        const phoneInput2 = window.intlTelInput(phoneInputField2, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
    </script>
    <script>
        # Variables
        canvas = document.getElementById('canvas');
        ctx = canvas.getContext('2d');
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
        imgSrc = canvas.dataset.image;
        img = new Image();
        useGrid = true
        imgInfo = {};
        imgs = [];
        grids = [];
        magnet = 2000;
        mouse = {
            x: 1
            y: 0
        }

        init = () - >
            addListeners();

        img.onload = (e) - >
            # Check
        for firefox.
        imgInfo.width =
            if e.path then e.path[0].width
        else e.target.width
        imgInfo.height =
            if e.path then e.path[0].height
        else e.target.height

        numberToShow = (Math.ceil(window.innerWidth / imgInfo.width)) * (Math.ceil(window.innerHeight / imgInfo.height))

        createGrid() if useGrid;
        populateCanvas(numberToShow * 4);


        canvas.classList.add('ready');
        render();

        img.src = imgSrc;

        addListeners = () - >
            window.addEventListener('resize', resizeCanvas);
        window.addEventListener('mousemove', updateMouse);
        window.addEventListener('touchmove', updateMouse);

        updateMouse = (e) - >

            mouse.x = e.clientX
        mouse.y = e.clientY

        resizeCanvas = () - >
            width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;

        # Magic
        populateCanvas = (nb) - >
            i = 0;
        while i <= nb
        p = new Photo();
        imgs.push p
        i++;

        createGrid = () - >
            imgScale = 0.5
        grid = {
            row: Math.ceil(window.innerWidth / (imgInfo.width * imgScale))
            cols: Math.ceil(window.innerHeight / (imgInfo.height * imgScale))
            rowWidth: imgInfo.width * imgScale
            colHeight: imgInfo.height * imgScale
        }

        for r in [0...grid.row]
        x = r * grid.rowWidth
        for c in [0...grid.cols]
        y = c * grid.colHeight

        item = new gridItem(x, y, grid.rowWidth, grid.colHeight)
        grids.push item;

        for i in [0...grids.length]
        grids[i].draw();

        gridItem = (x = 0, y = 0, w, h) - >
            this.draw = () - >
            ctx.drawImage(img, x, y, w, h);
        return
        return

        Photo = () - >
            seed = Math.random() * (2.5 - 0.7) + 0.7;
        w = imgInfo.width / seed
        h = imgInfo.height / seed
        x = window.innerWidth * Math.random()
        finalX = x
        y = window.innerHeight * Math.random()
        finalY = y
        console.log("INIT Y :: #{finalY} || INIT X :: #{finalX}")
        r = Math.random() * (180 - (-180)) + (-180)

        forceX = 0
        forceY = 0

        TO_RADIANS = Math.PI / 180

        this.update = () - >
            x0 = x
        y0 = y
        x1 = mouse.x
        y1 = mouse.y

        dx = x1 - x0
        dy = y1 - y0

        distance = Math.sqrt((dx * dx) + (dy * dy))
        powerX = x0 - (dx / distance) * magnet / distance;
        powerY = y0 - (dy / distance) * magnet / distance

        forceX = (forceX + (finalX - x0) / 2) / 2.1
        forceY = (forceY + (finalY - y0) / 2) / 2.2



        x = powerX + forceX
        y = powerY + forceY

        return
        this.draw = () - >
            rotateAndPaintImage(ctx, img, r * TO_RADIANS, x, y, w / 2, h / 2, w, h)
        return

        rotateAndPaintImage = (context, image, angle, positionX, positionY, axisX, axisY, widthX, widthY) - >
            context.translate(positionX, positionY);
        context.rotate(angle);
        context.drawImage(image, -axisX, -axisY, widthX, widthY);
        context.rotate(-angle);
        context.translate(-positionX, -positionY);

        render = () - >
            x = 0
        y = 0
        ctx.clearRect(0, 0, width, height)
        while y < grids.length
        grids[y].draw()
        y++
        while x < imgs.length
        imgs[x].update()
        imgs[x].draw()
        x++

        requestAnimationFrame render



        init();
    </script>
@endsection
