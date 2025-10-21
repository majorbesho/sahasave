<div class="header-topbar">
    <div class="container">
        <div class="topbar-info">
            <div class="gap-3 d-flex align-items-center header-info">
                <p><i class="isax isax-message-text5 me-1"></i><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                        data-cfemail="">[email&#160;protected]</a></p>
                <p><i class="isax isax-call5 me-1"></i>+971 545060739</p>
            </div>
            <ul>
                <li class="header-theme">
                    <a href="javascript:void(0);" id="dark-mode-toggle" class="theme-toggle">
                        <i class="isax isax-sun-1"></i>
                    </a>
                    <a href="javascript:void(0);" id="light-mode-toggle" class="theme-toggle activate">
                        <i class="isax isax-moon"></i>
                    </a>
                </li>
                <li class="d-inline-flex align-items-center drop-header">
                    <div class="dropdown dropdown-country me-3">
                        <!-- عرض اللغة الحالية -->
                        <a href="#" class="d-inline-flex align-items-center" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            @if (app()->getLocale() == 'ar')
                                <img src="{{ asset('frontend/xx/assets/img/flags/arab-flag.svg') }}" class="me-2"
                                    alt="flag"> ARA
                            @elseif(app()->getLocale() == 'fr')
                                <img src="{{ asset('frontend/xx/assets/img/flags/france-flag.svg') }}" class="me-2"
                                    alt="flag"> FRA
                            @else
                                {{-- اللغة الافتراضية هي الإنجليزية --}}
                                <img src="{{ asset('frontend/xx/assets/img/flags/us-flag.svg') }}" class="me-2"
                                    alt="flag"> ENG
                            @endif
                        </a>

                        <!-- قائمة اللغات المتاحة للتغيير -->
                        <ul class="p-2 mt-2 dropdown-menu">
                            <li>
                                <a class="rounded dropdown-item d-flex align-items-center"
                                    onclick="changeLanguage('en')">
                                    <img src="{{ asset('frontend/xx/assets/img/flags/us-flag.svg') }}" class="me-2"
                                        alt="flag">ENG
                                </a>
                            </li>
                            <li>
                                <a class="rounded dropdown-item d-flex align-items-center"
                                    onclick="changeLanguage('ar')">
                                    <img src="{{ asset('frontend/xx/assets/img/flags/arab-flag.svg') }}" class="me-2"
                                        alt="flag">ARA
                                </a>
                            </li>
                            <li>
                                <a class="rounded dropdown-item d-flex align-items-center"
                                    onclick="changeLanguage('de')">
                                    <img src="{{ asset('frontend/xx/assets/img/flags/france-flag.svg') }}"
                                        class="me-2" alt="flag">FRA
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="dropdown dropdown-amt">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            USD
                        </a>
                        <ul class="p-2 mt-2 dropdown-menu">
                            <li><a class="rounded dropdown-item" href="javascript:void(0);">USD</a></li>
                            <li><a class="rounded dropdown-item" href="javascript:void(0);">YEN</a></li>
                            <li><a class="rounded dropdown-item" href="javascript:void(0);">EURO</a></li>
                        </ul>
                    </div>
                </li>
                <li class="social-header">
                    <div class="social-icon">
                        <a href="javascript:void(0);"><i class="fa-brands fa-facebook"></i></a>
                        <a href="javascript:void(0);"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="javascript:void(0);"><i class="fa-brands fa-instagram"></i></a>
                        <a href="javascript:void(0);"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="javascript:void(0);"><i class="fa-brands fa-pinterest"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Header -->
<header class="relative header header-custom header-fixed inner-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg header-nav">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <a href="{{ route('home') }}" class="navbar-brand logo">
                    <img src="{{ asset('frontend/xx/assets/img/logo/logo2.png') }}" class="img-fluid" alt="Logo">
                </a>
            </div>
            <div class="header-menu">
                <div class="main-menu-wrapper">
                    <div class="menu-header">
                        <a href="{{ route('home') }}" class="menu-logo">
                            <img src="{{ asset('frontend/xx/assets/img//logo/logo1.png') }}" class="img-fluid"
                                alt="Logo">
                        </a>
                        <a id="menu_close" class="menu-close" href="javascript:void(0);">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <ul class="main-nav">

                        <!-- 1. الرئيسية (للجميع) -->
                        <li class="{{ Request::is('/') ? 'active' : '' }}">
                            <a href="{{ route('home') }}">{{ __('messages.home') }}</a>
                        </li>

                        <!-- 2. ابحث عن طبيب (للجميع) -->
                        {{-- <li class="{{ Request::is('doctors/search*') ? 'active' : '' }}">
                            <a href="{{ route('doctors.search') }}">{{ __('messages.search_doctors') }}</a>
                        </li> --}}


                        <!-- =================================================================== -->
                        <!-- START: روابط خاصة بالزوار فقط (لم يسجلوا الدخول) -->
                        <!-- =================================================================== -->
                        @guest
                            <li>
                                <a href="{{ route('login') }}">{{ __('messages.login') }}</a>
                            </li>
                            <li class="has-submenu">
                                <a href="javascript:void(0);">{{ __('messages.register') }} <i
                                        class="fas fa-chevron-down"></i></a>
                                <ul class="submenu">
                                    <li><a
                                            href="{{ route('register.patient') }}">{{ __('messages.register_as_patient') }}</a>
                                    </li>
                                    <li><a href="{{ route('register.doctor') }}">{{ __('messages.join_as_doctor') }}</a>
                                    </li>
                                </ul>
                            </li>
                        @endguest


                        <!-- =================================================================== -->
                        <!-- START: روابط خاصة بالمستخدمين المسجلين فقط -->
                        <!-- =================================================================== -->
                        @auth

                            <!-- روابط خاصة بالمريض -->
                            @if (Auth::user()->isPatient())
                                <li class="has-submenu">
                                    <a href="#">{{ __('messages.my_account') }} <i
                                            class="fas fa-chevron-down"></i></a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('patient.dashboard') }}">{{ __('messages.dashboard') }}</a>
                                        </li>
                                        {{-- <li><a href="{{ route('patient.appoint') }}">{{ __('messages.my_appointments') }}</a> </li> --}}
                                        <li><a href="{{ route('patient.favorites') }}">{{ __('messages.favorites') }}</a>
                                        </li>
                                        <li><a
                                                href="{{ route('patient.profile.settings') }}">{{ __('messages.profile_settings') }}</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            <!-- روابط خاصة بالطبيب -->
                            @if (Auth::user()->isDoctor())
                                <li class="has-submenu">
                                    <a href="#">{{ __('messages.doctor_panel') }} <i
                                            class="fas fa-chevron-down"></i></a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('doctor.dashboard') }}">{{ __('messages.dashboard') }}</a>
                                        </li>
                                        <li><a
                                                href="{{ route('doctor.appointments.index') }}">{{ __('messages.appointments') }}</a>
                                        </li>
                                        <li><a href="{{ route('doctor.patients') }}">{{ __('messages.my_patients') }}</a>
                                        </li>
                                        <li><a
                                                href="{{ route('doctor.appointments.index') }}">{{ __('messages.schedule_timing') }}</a>
                                        </li>
                                        <li><a
                                                href="{{ route('doctor.profile.settings') }}">{{ __('messages.profile_settings') }}</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            <!-- روابط خاصة بالادمن -->
                            @if (Auth::user()->isAdmin())
                                <li>
                                    <a href="{{ route('admin.dashboard') }}" target="_blank">Admin Dashboard</a>
                                </li>
                            @endif

                            <!-- رابط تسجيل الخروج (مشترك للجميع) -->
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('messages.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endauth


                        <!-- 3. صفحات إضافية (مثل من نحن، اتصل بنا) -->
                        <li class="has-submenu">
                            <a href="#">{{ __('messages.more') }} <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu">
                                <li><a href="{{ route('about') }}">{{ __('messages.about_us') }}</a></li>
                                <li><a href="{{ route('contact') }}">{{ __('messages.contact_us') }}</a></li>
                                {{-- <li><a href="{{ route('blog.index') }}">{{ __('messages.blog') }}</a></li> --}}
                            </ul>
                        </li>

                    </ul>
                </div>
                <ul class="nav header-navbar-rht">
                    <li class="searchbar">
                        <a href="javascript:void(0);"><i class="feather-search"></i></a>
                        <div class="togglesearch">
                            <form action="search.html">
                                <div class="input-group">
                                    <input type="text" class="form-control">
                                    <button type="submit" class="btn">Search</button>
                                </div>
                            </form>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('login') }}"
                            class="btn btn-md btn-primary-gradient d-inline-flex align-items-center rounded-pill"><i
                                class="isax isax-lock-1 me-1"></i>Sign Up</a>
                    </li>
                    <li>
                        <a href="{{ route('register.patient') }}"
                            class="btn btn-md btn-dark d-inline-flex align-items-center rounded-pill">
                            <i class="isax isax-user-tick me-1"></i>Register
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- /Header -->
