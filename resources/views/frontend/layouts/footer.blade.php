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
                                    {{-- <li><a href="{{ url('/media') }}">{{ __('footer.media_center') }}</a></li> --}}
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


                        <div class="mt-4 footer-about-widget">
                            <h6 class="footer-title">{{ __('about.footer_about_title') }}</h6>
                            <p class="mb-2 text-white-50 small">{{ __('about.footer_team') }}</p>
                            <p class="mb-1 text-white-50 small"><strong>{{ __('about.footer_vision') }}</strong></p>
                            <p class="mb-0 text-white-50 small">{{ __('about.footer_values') }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- الخلفيات -->
        <div class="footer-bg">
            <img src="{{ asset('frontend/xx/assets/img/bg/footer-bg-01.png') }}" alt="{{ __('global.decoration') }}"
                class="footer-bg-01" width="100" height="100" />
            <img src="{{ asset('frontend/xx/assets/img/bg/footer-bg-02.png') }}" alt="{{ __('global.design') }}"
                class="footer-bg-02" width="100" height="100" />
            <img src="{{ asset('frontend/xx/assets/img/bg/footer-bg-03.png') }}" alt="{{ __('global.background') }}"
                class="footer-bg-03" width="100" height="100" />
            <img src="{{ asset('frontend/xx/assets/img/bg/footer-bg-04.png') }}" alt="{{ __('global.elements') }}"
                class="footer-bg-04" width="100" height="100" />
            <img src="{{ asset('frontend/xx/assets/img/bg/footer-bg-05.png') }}" aria-hidden="true" alt="{{ __('global.graphics') }}"
                class="footer-bg-05" width="100" height="100" />
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
                    <li><a href="javascript:void(0);" aria-label="Visa Card"><img
                                src="{{ asset('frontend/xx/assets/img/icons/card-01.svg') }}"
                                alt="{{ __('footer.visa') }}" width="40" height="25" /></a></li>
                    <li><a href="javascript:void(0);" aria-label="Mastercard"><img
                                src="{{ asset('frontend/xx/assets/img/icons/card-02.svg') }}"
                                alt="{{ __('footer.mastercard') }}" width="40" height="25" /></a></li>
                    <li><a href="javascript:void(0);" aria-label="American Express"><img
                                src="{{ asset('frontend/xx/assets/img/icons/card-03.svg') }}"
                                alt="{{ __('footer.american_express') }}" width="40" height="25" /></a></li>
                    <li><a href="javascript:void(0);" aria-label="Apple Pay"><img
                                src="{{ asset('frontend/xx/assets/img/icons/card-04.svg') }}"
                                alt="{{ __('footer.apple_pay') }}" width="40" height="25" /></a></li>
                    <li><a href="javascript:void(0);" aria-label="Mada"><img
                                src="{{ asset('frontend/xx/assets/img/icons/card-05.svg') }}"
                                alt="{{ __('footer.mada') }}" width="40" height="25" /></a></li>
                    <li><a href="javascript:void(0);" aria-label="Credit Cards"><img
                                src="{{ asset('frontend/xx/assets/img/icons/card-06.svg') }}"
                                alt="{{ __('footer.credit_cards') }}" width="40" height="25" /></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
