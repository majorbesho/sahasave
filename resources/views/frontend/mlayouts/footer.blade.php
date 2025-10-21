

@include('frontend.layouts.notify')
<!-- footer section start  -->
<footer class="footer-section">
    <div class="container">
        <div class="row">

            <div class="col-lg-12  wow bounceIn" data-wow-duration="0.5s" data-wow-delay="0.3s" style="margin-top: 2%;">
                <div class="subscribe-area">
                    <div class="left">
                        <span class="subtitle">Subscribe to SmartBox</span>
                        <h3 class="title">To Get Exclusive Benefits</h3>
                    </div>
                    <div class="right">
                        <form class="subscribe-form" style="margin-bottom: 0px;">
                            <input type="email" name="subscribe_email" id="subscribe_email" placeholder="Enter Your Email">
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

                    <li><a href="#0"><img src="{{asset('frontend4/images/icon/store-btn/1.png')}}" alt="image"></a></li>
                    <li><a href="#0"><img src="{{asset('frontend4/images/icon/store-btn/2.png')}}" alt="image"></a></li>
                </ul>
            </div>
            <div class="col-lg-8">
                <ul class="short-links justify-content-lg-end justify-content-center">
                     <li><a href="{{route('about')}}">About</a></li>
                    <li><a href="{{route('winners')}}">winners</a></li>

                    <li><a href="{{route('affiliate')}}">affiliate</a></li>

                    <li><a href="{{route('media')}}">media</a></li>
                    <li><a href="{{route('blogs')}}">blogs</a></li>


                    <li><a href="{{route('user.faqs')}}">FAQs</a></li>
                    <li><a href="{{route('get-contact-us')}}">Contact</a></li>
                    <li><a href="{{route('terms.And.Conditions')}}">Terms of Services</a></li>
                    <li><a href="{{route('privacy.policy')}}">Privacy</a></li>
                    <li class="d-none"><a href="{{route('site.map')}}">Sitemap</a></li>

                </ul>
            </div>

        </div>
        <hr>
        <div class="row py-5 align-items-center">
            <div class="col-lg-6">
                <p class="copy-right-text text-lg-start text-center text-light mb-lg-0 mb-3">Copyright © 2023.All Rights Reserved By <a class="text-light" href="index.html">SmartBox</a></p>
            </div>
            <div class="col-lg-6">
                <ul class="social-links justify-content-lg-end justify-content-center">
                    <li><a href="https://www.facebook.com/profile.php?id=100092493111750"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="https://www.instagram.com/smartboxuae/"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="https://www.youtube.com/@smartboxuae/"><i class="fab fa-youtube"></i></a></li>
                    <li><a href="https://www.linkedin.com/@smartboxuae/"><i class="fab fa-linkedin"></i></a></li>

                    <li><a href="https://www.tiktok.com/@smartboxuae?lang=en"><i class="fab fa-tiktok"></i></a></li>




                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- footer section end -->
</div>
<!-- page-wrapper end -->


