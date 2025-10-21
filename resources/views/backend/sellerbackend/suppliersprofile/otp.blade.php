<!DOCTYPE html>
<html lang="en">

<head>

    {{-- <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZRSQERSTD0"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-ZRSQERSTD0');
    </script> --}}


{{--
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}
    {{-- {!! JsonLdMulti::generate() !!}
    {!! SEO::generate() !!}
    {!! SEO::generate(true) !!}
    {!! app('seotools')->generate() !!} --}}


    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="beshog32@gmail.com">
    {{-- <meta name="X-CSRF-TOKEN" content="{{ csrf_token() }}"> --}}
    <!-- Stylesheets
 ============================================= -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="https://smartboxuae.ae/" />
    <!-- SLIDER REVOLUTION 5.x CSS SETTINGS -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
    {{-- old css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{asset('frontend3/css/bootstrap.css')}}" type="text/css" > --}}
    {{-- <link rel="stylesheet" href="{{asset('frontend3/css/shop/bootstrap.min.css')}}"> --}}

    <link rel="icon" type="image/x-icon" href="{{ asset('frontend4/images/favicon.ico') }}">


    <link rel="icon" type="image/png" href="{{ asset('frontend4/images/favicon.png') }}" sizes="16x16">

    <link rel="stylesheet" href="{{ asset('frontend4/css/all.min.css') }}">
    <!-- line-awesome webfont -->
    {{-- <link rel="stylesheet" href="{{ asset('frontend4/css/line-awesome.min.css') }}">
    <!-- custom select css -->
    <link rel="stylesheet" href="{{ asset('frontend4/css/vendor/nice-select.css') }}">
    <!-- animate css  -->
    <link rel="stylesheet" href="{{ asset('frontend4/css/vendor/animate.min.css') }}">
    <!-- lightcase css -->
    <link rel="stylesheet" href="{{ asset('frontend4/css/vendor/lightcase.css') }}">
    <!-- slick slider css -->
    <link rel="stylesheet" href="{{ asset('frontend4/css/vendor/slick.css') }}">
    <!-- jquery ui css -->
    <link rel="stylesheet" href="{{ asset('frontend4/css/vendor/jquery-ui.min.css') }}">
    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ asset('frontend4/css/vendor/datepicker.min.css') }}">
    <!-- style main css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="{{ asset('frontend4/css/main.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend4/css/custom.css') }}" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontend4/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend4/css/mediaQuery.css') }}">--}}



</head>



<div class="page-wrapper">



    {{-- <div id="header" class="full-header"> --}}
    <header class="header" id="header-ajax">



        <div class="header__top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="left d-flex align-items-center">
                            <a href="tel:+971502746822"><i class="las la-phone-volume"></i> Customer Support</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="right">
                            <div class="product__cart">
                                @if (Auth::check())
                                    <a href="{{ route('cart') }}" class="amount__btn">
                                        <i class="las la-shopping-basket"></i>
                                        <span class="cart__num" id="cart_count">
                                            {{ \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() }}
                                        </span>
                                    </a>
                                @else
                                    <a href="#popup1" class="amount__btn">
                                        <i class="las la-shopping-basket"></i>
                                        <span class="cart__num">
                                            0
                                        </span>
                                    </a>
                                @endif
                            </div>
                            @if (Auth::check())
                                <a href="{{ route('dashboard') }}" class="user__btn">
                                    <i class="las la-user"></i>
                                </a>
                            @else
                                <a href="#popup1" class="user__btn">
                                    <i class="las la-user"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header__top end -->
        <div class="header__bottom">
            <div class="container">
                <nav class="navbar navbar-expand-xl p-0 align-items-center">
                    <a class="site-logo site-title" href="{{ route('home') }}">
                        <!--<img src="{{ asset('frontend4/images/color-logo.png') }}" class="logo4" alt="SmartBox">-->
                        <img src="{{ asset('frontend4/images/color-logo.png') }}" class="logo4" alt="SmartBox"
                            width="250px" height="150">
                        <span class="logo-icon"><i class="flaticon-fire"></i></span>
                    </a>
                    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu-toggle"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav main-menu ms-auto">
                            <li>
                                <a href="{{ route('home') }}">Home</a>

                            </li>
                            <li>
                                <a href="{{ route('home') }}#campaigns">Campaigns</a>
                            </li>
                            @if (Auth::check())
                                <li><a href="{{ route('product.library') }}">Product Library</a></li>
                            @endif


                            @if (Auth::check())
                                <li><a href="{{ route('user.logout') }}">Logout</a></li>
                            @elseif (Auth::guest())
                                <li><a href="{{ route('user.auth') }}">Login/Register</a></li>
                            @endif
                        </ul>
                        <div class="nav-right">
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- header__bottom end -->
    </header><!-- #header end -->







    @if (Auth::check())
        <div class="container mt-5" style="max-width: 550px;padding-top: 150px;">
            <div class="alert alert-danger" id="error" style="display: none;"></div>
            <h3>Add Phone Number</h3>
            <div class="alert alert-success" id="successAuth" style="display: none;"></div>
            <form>
                <label>Phone Number:</label>
                <input type="text" id="number" class="form-control" placeholder="{{ $user->phone }}"
                    disabled>
                <div id="recaptcha-container"></div>
                <button type="button" class="btn btn-primary mt-3" onclick="sendOTP();">Send OTP</button>
            </form>

            <div class="mb-5 mt-5">
                <h3>Add verification code</h3>
                <div class="alert alert-success" id="successOtpAuth"></div>
                <form>
                    <input type="text" id="verification" class="form-control" placeholder="Verification code">
                    <button type="button" class="btn btn-danger mt-3" onclick="verify()">Verify code</button>
                </form>
            </div>
        </div>
    @else
        <div class="container mt-5" style="max-width: 550px">
            <div class="alert alert-danger" id="error" style="display: none;"></div>
            <h3>Add Phone Number</h3>
            <div class="alert alert-success" id="successAuth" style="display: none;"></div>
            <form>
                <label>Phone Number:</label>
                <input type="text" id="number" class="form-control" placeholder="+971********">
                <div id="recaptcha-container"></div>
                <button type="button" class="btn btn-primary mt-3" onclick="sendOTP();">Send OTP</button>
            </form>

            <div class="mb-5 mt-5">
                <h3>Add verification code</h3>
                <div class="alert alert-success" id="successOtpAuth"></div>
                <form>
                    <input type="text" id="verification" class="form-control" placeholder="Verification code">
                    <button type="button" class="btn btn-danger mt-3" onclick="verify()">Verify code</button>
                </form>
            </div>
        </div>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>


    <script>
        var firebaseConfig = {
            databaseURL: "https://otpapp-3959b.firebaseio.com",
            apiKey: "AIzaSyBs_UjzAcv1GDAWj-3NQNvo6IHeKTBoIi4",
            authDomain: "smartbox-c6ec9.firebaseapp.com",
            projectId: "smartbox-c6ec9",
            storageBucket: "smartbox-c6ec9.appspot.com",
            messagingSenderId: "392043137324",
            appId: "1:392043137324:web:c2a91ccc200c206b6a8489",
            measurementId: "G-ZRSQERSTD0"
        };
        firebase.initializeApp(firebaseConfig);
        // alert true;
    </script>
    <script type="text/javascript">
        window.onload = function() {
            render();
        };

        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
            recaptchaVerifier.render();
        }

        function sendOTP() {
            var number = $("#number").val();
            firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(confirmationResult) {
                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;
                console.log(coderesult);
                $("#successAuth").text("Message sent");
                $("#successAuth").show();

            }).catch(function(error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        }

        function verify() {
            var code = $("#verification").val();
            coderesult.confirm(code).then(function(result) {
                var user = result.user;
                console.log(user);
                $("#successOtpAuth").text("Auth is successful");
                $("#successOtpAuth").show();

            }).catch(function(error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        }
    </script>








{{--
    @include('frontend.layouts.notify') --}}
    <!-- footer section start  -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">

                <div class="col-lg-12  wow bounceIn" data-wow-duration="0.5s" data-wow-delay="0.3s"
                    style="margin-top: 2%;">
                    <div class="subscribe-area">
                        <div class="left">
                            <span class="subtitle">Subscribe to SmartBox</span>
                            <h3 class="title">To Get Exclusive Benefits</h3>
                        </div>
                        <div class="right">
                            <form class="subscribe-form" style="margin-bottom: 0px;">
                                <input type="email" name="subscribe_email" id="subscribe_email"
                                    placeholder="Enter Your Email">
                                <button type="submit">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container pt-120">
            <div class="row pb-5 align-items-center">
                <div class="col-lg-4">
                    <div>

                        <h5 style="color: #fff">coming soon</h5>

                    </div>
                    <ul class="app-btn">
                        {{-- <div class="bg-shape--top"><img src="{{asset('frontend4/images/logo500.png')}}" class="logo4" alt="smartbox"></div> --}}

                        <li><a href="#0"><img src="{{ asset('frontend4/images/icon/store-btn/1.png') }}"
                                    alt="image"></a></li>
                        <li><a href="#0"><img src="{{ asset('frontend4/images/icon/store-btn/2.png') }}"
                                    alt="image"></a></li>
                    </ul>
                </div>
                <div class="col-lg-8">
                    <ul class="short-links justify-content-lg-end justify-content-center">
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('winners') }}">winners</a></li>

                        <li><a href="{{ route('affiliate') }}">affiliate</a></li>

                        <li><a href="{{ route('media') }}">media</a></li>
                        <li><a href="{{ route('blogs') }}">blogs</a></li>


                        <li><a href="{{ route('user.faqs') }}">FAQs</a></li>
                        <li><a href="{{ route('get-contact-us') }}">Contact</a></li>
                        <li><a href="{{ route('terms.And.Conditions') }}">Terms of Services</a></li>
                        <li><a href="{{ route('privacy.policy') }}">Privacy</a></li>
                        <li class="d-none"><a href="{{ route('site.map') }}">Sitemap</a></li>

                    </ul>
                </div>

            </div>
            <hr>
            <div class="row py-5 align-items-center">
                <div class="col-lg-6">
                    <p class="copy-right-text text-lg-start text-center text-light mb-lg-0 mb-3">Copyright © 2023.All
                        Rights Reserved By <a class="text-light" href="{{route('home')}}">SmartBox</a></p>
                </div>
                <div class="col-lg-6">
                    <ul class="social-links justify-content-lg-end justify-content-center">
                        <li><a href="https://www.facebook.com/profile.php?id=100092493111750"><i
                                    class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://www.instagram.com/smartboxuae/"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="https://www.youtube.com/@smartboxuae/"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="https://www.linkedin.com/@smartboxuae/"><i class="fab fa-linkedin"></i></a></li>

                        <li><a href="https://www.tiktok.com/@smartboxuae?lang=en"><i class="fab fa-tiktok"></i></a>
                        </li>




                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer section end -->
</div>
<!-- page-wrapper end -->



{{--
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script> --}}

{{--
<script src="{{ asset('frontend4/js/vendor/jquery-3.5.1.min.js') }}"></script>
<!-- bootstrap js -->
{{-- <script src="{{asset('frontend4/js/vendor/bootstrap.bundle.min.js')}}"></script>
<!-- custom select js -->
<script src="{{ asset('frontend4/js/vendor/jquery.nice-select.min.js') }}"></script>
<!-- lightcase js -->
<script src="{{ asset('frontend4/js/vendor/lightcase.js') }}"></script>
<!-- wow js -->
<script src="{{ asset('frontend4/js/vendor/wow.min.js') }}"></script>
<!-- slick slider js -->
<script src="{{ asset('frontend4/js/vendor/slick.min.js') }}"></script>
<!-- countdown js -->
<script src="{{ asset('frontend4/js/vendor/jquery.countdown.js') }}"></script>
<!-- jquery ui js -->
<script src="{{ asset('frontend4/js/vendor/jquery-ui.min.js') }}"></script>
<!-- datepicker js -->
<script src="{{ asset('frontend4/js/vendor/datepicker.min.js') }}"></script>
<script src="{{ asset('frontend4/js/vendor/datepicker.en.js') }}"></script>
<!-- preloader -->
<script src='{{ asset('frontend4/js/vendor/TweenMax.min.js') }}'></script>
<script src='{{ asset('frontend4/js/vendor/MorphSVGPlugin.min.js') }}'></script> --}}
{{-- <script src="{{asset('frontend4/js/preloader.js')}}"></script>
<!-- contact js -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('frontend4/js/contact.js') }}"></script>--}}
<!-- custom js -->
{{-- <script src="{{ asset('frontend4/js/app.js') }}"></script> --}}
<!-- jQuery library -->

{{-- <div id="gotoTop" class="icon-angle-up"></div> --}}
<!--Start of Tawk.to Script-->
{{-- <script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/6459fcab6a9aad4bc579ab14/1gvvo60k5';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script> --}}

{{-- <script type="text/javascript">
    $(function() {
        $("[rel='tooltip']").tooltip();
    });
</script>

<script>
    $("#navbarSupportedContent").on('show.bs.collapse', function() {
        $('a.nav-link').click(function() {
            $("#navbarSupportedContent").collapse('hide');
        });
    });
</script> --}}


<!-- Meta Pixel Code -->
{{-- <script>
    ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '2507899182699627');
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=2507899182699627&ev=PageView&noscript=1" /></noscript> --}}



</body>

</html>
