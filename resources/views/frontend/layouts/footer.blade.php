@include('frontend.layouts.notify')
<footer class="footer inner-footer" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <!-- قسم الشركة -->
                        <div class="col-lg-3 col-md-3">
                            <div class="footer-widget footer-menu">
                                <h6 class="footer-title">
                                    {{ __('footer.company') }}
                                </h6>
                                <ul>
                                    <li><a href="{{ url('/about') }}">{{ __('footer.about_platform') }}</a></li>
                                    <li><a href="{{ url('/how-it-works') }}">{{ __('footer.how_it_works') }}</a></li>
                                    <li><a href="{{ route('blog.index') }}">{{ __('footer.medical_blog') }}</a></li>
                                    <li><a href="{{ route('careers.index') }}">{{ __('footer.careers') }}</a></li>
                                    <li><a href="{{ url('/press') }}">{{ __('footer.media_center') }}</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- قسم التخصصات الطبية -->
                        <div class="col-lg-3 col-md-3">
                            <div class="footer-widget footer-menu">
                                <h6 class="footer-title">
                                    {{ __('footer.medical_specialties') }}
                                </h6>
                                <ul>
                                    <li><a
                                            href="{{ url('/doctors/dubai/cardiology') }}">{{ __('footer.cardiology') }}</a>
                                    </li>
                                    <li><a
                                            href="{{ url('/doctors/dubai/dermatology') }}">{{ __('footer.dermatology') }}</a>
                                    </li>
                                    <li><a
                                            href="{{ url('/doctors/dubai/pediatrics') }}">{{ __('footer.pediatrics') }}</a>
                                    </li>
                                    <li><a
                                            href="{{ url('/doctors/dubai/orthopedics') }}">{{ __('footer.orthopedics') }}</a>
                                    </li>
                                    <li><a
                                            href="{{ url('/doctors/dubai/dentistry') }}">{{ __('footer.dentistry') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- قسم المستشفيات والعيادات -->
                        <div class="col-lg-3 col-md-3">
                            <div class="footer-widget footer-menu">
                                <h6 class="footer-title">
                                    {{ __('footer.service_providers') }}
                                </h6>
                                <ul>
                                    <li><a href="{{ url('/hospitals/dubai') }}">{{ __('footer.dubai_hospitals') }}</a>
                                    </li>
                                    <li><a
                                            href="{{ url('/hospitals/abu-dhabi') }}">{{ __('footer.abu_dhabi_hospitals') }}</a>
                                    </li>
                                    <li><a
                                            href="{{ url('/hospitals/sharjah') }}">{{ __('footer.sharjah_hospitals') }}</a>
                                    </li>
                                    <li><a href="{{ url('/clinics') }}">{{ __('footer.specialized_clinics') }}</a>
                                    </li>
                                    <li><a href="{{ url('/centers') }}">{{ __('footer.medical_centers') }}</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- قسم المساعدة والأقسام القانونية -->
                        <div class="col-lg-3 col-md-3">
                            <div class="footer-widget footer-menu">
                                <h6 class="footer-title">
                                    {{ __('footer.support_help') }}
                                </h6>
                                <ul>
                                    <li><a href="{{ url('/contactus') }}">{{ __('footer.contact_us') }}</a></li>
                                    <li><a href="{{ url('/faqs') }}">{{ __('footer.faq') }}</a></li>
                                    <li><a href="{{ url('/privacy-policy') }}">{{ __('footer.privacy_policy') }}</a>
                                    </li>
                                    <li><a href="{{ url('/terms') }}">{{ __('footer.terms_conditions') }}</a></li>
                                    <li><a
                                            href="{{ url('/cancellation-policy') }}">{{ __('footer.cancellation_policy') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- قسم النشرة البريدية والاتصال -->
                <!-- قسم النشرة البريدية والاتصال -->
                <div class="col-lg-4 col-md-7">
                    <div class="footer-widget">
                        <h6 class="footer-title">{{ __('footer.newsletter') }}</h6>
                        <p class="mb-2">
                            {{ __('footer.newsletter_text') }}
                        </p>
                        <div class="subscribe-input">
                            <form action="{{ route('newsletter.subscribe') }}" method="POST">
                                @csrf
                                <input type="email" name="email" class="form-control"
                                    placeholder="{{ __('footer.enter_email') }}" required />
                                <button type="submit"
                                    class="inline-flex btn btn-md btn-primary-gradient align-items-center">
                                    <i class="isax isax-send-25 me-1"></i>{{ __('footer.subscribe') }}
                                </button>
                            </form>

                            @if ($errors->has('email'))
                                <div class="mt-2 text-danger small">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="mt-2 text-success small">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>

                        <!-- باقي المحتوى -->
                    </div>
                </div>
            </div>
        </div>

        <!-- الخلفيات -->
        <div class="footer-bg">
            <img src="{{ asset('frontend/xx/assets/img/bg/footer-bg-01.png') }}" alt="{{ __('global.decoration') }}"
                class="footer-bg-01" />
            <img src="{{ asset('frontend/xx/assets/img/bg/footer-bg-02.png') }}" alt="{{ __('global.design') }}"
                class="footer-bg-02" />
            <img src="{{ asset('frontend/xx/assets/img/bg/footer-bg-03.png') }}" alt="{{ __('global.background') }}"
                class="footer-bg-03" />
            <img src="{{ asset('frontend/xx/assets/img/bg/footer-bg-04.png') }}" alt="{{ __('global.elements') }}"
                class="footer-bg-04" />
            <img src="{{ asset('frontend/xx/assets/img/bg/footer-bg-05.png') }}" alt="{{ __('global.graphics') }}"
                class="footer-bg-05" />
        </div>
    </div>

    <!-- قسم حقوق النشر -->
    <div class="footer-bottom">
        <div class="container">
            <div class="copyright">
                <div class="copyright-text">
                    <p class="mb-0">
                        © 2024 sehaSave. {{ __('footer.all_rights_reserved') }}
                        <span class="mx-2">|</span>
                        {{ __('footer.licensed_by') }}
                    </p>
                </div>

                <!-- القوانين والسياسات -->
                <div class="copyright-menu">
                    <ul class="policy-menu">
                        <li><a href="{{ url('/privacy-policy') }}">{{ __('footer.privacy_policy') }}</a></li>
                        <li><a href="{{ url('/terms') }}">{{ __('footer.terms_conditions') }}</a></li>
                        <li><a href="{{ url('/refund-policy') }}">{{ __('footer.refund_policy') }}</a></li>
                        <li><a href="{{ url('/sitemap') }}">{{ __('footer.sitemap') }}</a></li>
                    </ul>
                </div>

                <!-- وسائل الدفع -->
                <ul class="payment-method">
                    <li><a href="javascript:void(0);"><img
                                src="{{ asset('frontend/xx/assets/img/icons/card-01.svg') }}"
                                alt="{{ __('footer.visa') }}" /></a></li>
                    <li><a href="javascript:void(0);"><img
                                src="{{ asset('frontend/xx/assets/img/icons/card-02.svg') }}"
                                alt="{{ __('footer.mastercard') }}" /></a></li>
                    <li><a href="javascript:void(0);"><img
                                src="{{ asset('frontend/xx/assets/img/icons/card-03.svg') }}"
                                alt="{{ __('footer.american_express') }}" /></a></li>
                    <li><a href="javascript:void(0);"><img
                                src="{{ asset('frontend/xx/assets/img/icons/card-04.svg') }}"
                                alt="{{ __('footer.apple_pay') }}" /></a></li>
                    <li><a href="javascript:void(0);"><img
                                src="{{ asset('frontend/xx/assets/img/icons/card-05.svg') }}"
                                alt="{{ __('footer.mada') }}" /></a></li>
                    <li><a href="javascript:void(0);"><img
                                src="{{ asset('frontend/xx/assets/img/icons/card-06.svg') }}"
                                alt="{{ __('footer.credit_cards') }}" /></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

{{-- @include('frontend.layouts.notify')





<footer class="footer inner-footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            <div class="footer-widget footer-menu">
                                <h6 class="footer-title">
                                    Company
                                </h6>
                                <ul>
                                    <li>
                                        <a href="about-us.html">About</a>
                                    </li>
                                    <li>
                                        <a href="search.html">Features</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Works</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Careers</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Locations</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="footer-widget footer-menu">
                                <h6 class="footer-title">
                                    Treatments
                                </h6>
                                <ul>
                                    <li>
                                        <a href="search.html">Dental</a>
                                    </li>
                                    <li>
                                        <a href="search.html">Cardiac</a>
                                    </li>
                                    <li>
                                        <a href="search.html">Spinal Cord</a>
                                    </li>
                                    <li>
                                        <a href="search.html">Hair Growth</a>
                                    </li>
                                    <li>
                                        <a href="search.html">Anemia & Disorder</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="footer-widget footer-menu">
                                <h6 class="footer-title">
                                    Specialities
                                </h6>
                                <ul>
                                    <li>
                                        <a href="search.html">Transplant</a>
                                    </li>
                                    <li>
                                        <a href="search.html">Cardiologist</a>
                                    </li>
                                    <li>
                                        <a href="search.html">Oncology</a>
                                    </li>
                                    <li>
                                        <a href="search.html">Pediatrics</a>
                                    </li>
                                    <li>
                                        <a href="search.html">Gynacology</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="footer-widget footer-menu">
                                <h6 class="footer-title">
                                    Utilites
                                </h6>
                                <ul>
                                    <li>
                                        <a href="pricing.html">Pricing</a>
                                    </li>
                                    <li>
                                        <a href="contact-us.html">Contact</a>
                                    </li>
                                    <li>
                                        <a href="contact-us.html">Request A Quote</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Premium Membership</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Integrations</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-7">
                    <div class="footer-widget">
                        <h6 class="footer-title">Newsletter</h6>
                        <p class="mb-2">
                            Subscribe & Stay Updated from the
                            SehaSave.com
                        </p>
                        <div class="subscribe-input">
                            <form action="#">
                                <input type="email" class="form-control" placeholder="Enter Email Address" />
                                <button type="submit"
                                    class="inline-flex btn btn-md btn-primary-gradient align-items-center">
                                    <i class="isax isax-send-25 me-1"></i>Send
                                </button>
                            </form>
                        </div>
                        <div class="social-icon">
                            <h6 class="mb-3">Connect With Us</h6>
                            <ul>
                                <li>
                                    <a href="javascript:void(0);"><i class="fa-brands fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"><i class="fa-brands fa-x-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"><i class="fa-brands fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"><i class="fa-brands fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"><i class="fa-brands fa-pinterest"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bg">
            <img src="{{ asset('frontend/xx/assets/img/bg/footer-bg-01.png') }}" alt="img" class="footer-bg-01" />
            <img src="{{ asset('frontend/xx/assets/img/bg/footer-bg-02.png') }}" alt="img" class="footer-bg-02" />
            <img src="{{ asset('frontend/xx/assets/img/bg/footer-bg-03.png') }}" alt="img" class="footer-bg-03" />
            <img src="{{ asset('frontend/xx/assets/img/bg/footer-bg-04.png') }}" alt="img" class="footer-bg-04" />
            <img src="{{ asset('frontend/xx/assets/img/bg/footer-bg-05.png') }}" alt="img" class="footer-bg-05" />
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <!-- Copyright -->
            <div class="copyright">
                <div class="copyright-text">
                    <p class="mb-0">
                        Copyright © 2025 SehaSave.com. All Rights
                        Reserved
                    </p>
                </div>
                <!-- Copyright Menu -->
                <div class="copyright-menu">
                    <ul class="policy-menu">
                        <li>
                            <a href="javascript:void(0);">Legal Notice</a>
                        </li>
                        <li>
                            <a href="privacy-policy.html">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">Refund Policy</a>
                        </li>
                    </ul>
                </div>
                <!-- /Copyright Menu -->
                <ul class="payment-method">
                    <li>
                        <a href="javascript:void(0);"><img src="{{ asset('frontend/xx/assets/img/icons/card-01.svg') }}"
                                alt="Img" /></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><img src="{{ asset('frontend/xx/assets/img/icons/card-02.svg') }}"
                                alt="Img" /></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><img src="{{ asset('frontend/xx/assets/img/icons/card-03.svg') }}"
                                alt="Img" /></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><img src="{{ asset('frontend/xx/assets/img/icons/card-04.svg') }}"
                                alt="Img" /></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><img
                                src="{{ asset('frontend/xx/assets/img/icons/card-05.svg') }}" alt="Img" /></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"><img
                                src="{{ asset('frontend/xx/assets/img/icons/card-06.svg') }}" alt="Img" /></a>
                    </li>
                </ul>
            </div>
            <!-- /Copyright -->
        </div>
    </div>
</footer>
<!-- /Footer Section -->

<!-- Cursor --> --}}
