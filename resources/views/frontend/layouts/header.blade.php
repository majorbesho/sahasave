<div class="header-topbar">
    <div class="container">
        <div class="topbar-info">
            <div class="gap-3 d-flex align-items-center header-info">
                <p><i class="isax isax-message-text5 me-1"></i><a href="mailto:info@sehasave.com">info@sehasave.com</a></p>
                <p><i class="isax isax-call5 me-1"></i>+971 545060739</p>
                {{-- <p>Current locale: {{ app()->getLocale() }}</p> --}}
            </div>
            <ul>
                <li class="header-theme">
                    <a href="javascript:void(0);" id="dark-mode-toggle" class="theme-toggle" aria-label="Toggle Dark Mode">
                        <i class="isax isax-sun-1"></i>
                    </a>
                    <a href="javascript:void(0);" id="light-mode-toggle" class="theme-toggle activate" aria-label="Toggle Light Mode">
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
                                    alt="flag" width="20" height="15"> ARA
                            @else
                                <img src="{{ asset('frontend/xx/assets/img/flags/us-flag.svg') }}" class="me-2"
                                    alt="flag" width="20" height="15"> ENG
                            @endif
                        </a>

                        <ul class="p-2 mt-2 dropdown-menu">
                            <li>
                                <a class="rounded dropdown-item d-flex align-items-center"
                                    onclick="changeLanguage('en')">
                                    <img src="{{ asset('frontend/xx/assets/img/flags/us-flag.svg') }}" class="me-2"
                                        alt="flag" width="20" height="15">ENG
                                </a>
                            </li>
                            <li>
                                <a class="rounded dropdown-item d-flex align-items-center"
                                    onclick="changeLanguage('ar')">
                                    <img src="{{ asset('frontend/xx/assets/img/flags/arab-flag.svg') }}" class="me-2"
                                        alt="flag" width="20" height="15">ARA
                                </a>
                            </li>
                        </ul>
                    </div>
                    {{-- <div class="dropdown dropdown-amt">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            USD
                        </a>
                        <ul class="p-2 mt-2 dropdown-menu">
                            <li><a class="rounded dropdown-item" href="javascript:void(0);">USD</a></li>
                            <li><a class="rounded dropdown-item" href="javascript:void(0);">YEN</a></li>
                            <li><a class="rounded dropdown-item" href="javascript:void(0);">EURO</a></li>
                        </ul>
                    </div> --}}
                </li>

                <li class="social-header">
                    <div class="social-icon">
                        <a href="https://www.facebook.com/profile.php?id=61586411999359" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
                        <a href="https://www.instagram.com/sehasave.dubai/" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://linkedin.com/company/sehasave" aria-label="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="https://www.youtube.com/@sehasave" aria-label="youtube"><i class="fa-brands fa-youtube"></i></a>
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
                <a id="mobile_btn" href="javascript:void(0);" aria-label="Toggle Mobile Menu">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <a href="{{ route('home') }}" class="navbar-brand logo">
                    <img src="{{ asset('frontend/xx/assets/img/logo/logo.png') }}" class="img-fluid" alt="Logo" width="160" height="40">
                </a>
            </div>
            <div class="header-menu">
                <div class="main-menu-wrapper">
                    <div class="menu-header">
                        <a href="{{ route('home') }}" class="menu-logo">
                            <img src="{{ asset('frontend/xx/assets/img/logo/logo1.png') }}" class="img-fluid"
                                alt="Logo" width="160" height="40">
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
                        <li class="{{ Request::is('doctor/search*') ? 'active' : '' }}">
                            <a href="{{ route('doctors.search') }}">{{ __('messages.search_doctors') }}</a>
                        </li> 
                        <li class="has-submenu">
                            <a href="#">{{ __('messages.more') }} <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu">
                                <li><a href="{{ route('about') }}">{{ __('messages.about_us') }}</a></li>
                                <li><a href="{{ route('contactus') }}">{{ __('messages.contact_us') }}</a></li>
                                 <li><a href="{{ route('blog.index') }}">{{ __('messages.blog') }}</a></li> 
                            </ul>
                        </li>

                        <!-- =================================================================== -->
                        <!-- START: روابط خاصة بالزوار فقط (لم يسجلوا الدخول) -->
                        <!-- =================================================================== -->
                        {{-- @guest
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
                        @endguest --}}


                        <!-- =================================================================== -->
                        <!-- START: روابط خاصة بالمستخدمين المسجلين فقط -->
                        <!-- =================================================================== -->
                        @auth

                            <!-- روابط خاصة بالمريض -->
                            @if (Auth::user()->isPatient())
                                <li>
                                    <a href="#" class="d-flex align-items-center" style="gap: 5px;">
                                        <i class="fa-solid fa-coins text-warning"></i>
                                        <span class="fw-bold">{{ Auth::user()->available_points ?? 0 }}</span>
                                        <small class="text-muted">{{ __('messages.points') }}</small>
                                    </a>
                                </li>
                                <li class="has-submenu">
                                    <a href="#">{{ __('messages.my_account') }} <i
                                            class="fas fa-chevron-down"></i></a>
                                    <ul class="submenu">
                                        <li><a href="{{ route('patient.dashboard') }}">{{ __('messages.dashboard') }}</a>
                                        </li>
                                        {{-- <li><a href="{{ route('patient.appoint') }}">{{ __('messages.my_appointments') }}</a> </li> --}}
                                        <li><a
                                                href="{{ route('patient.favorites.index') }}">{{ __('messages.favorites') }}</a>
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
                                    <a href="{{ route('admin') }}" target="_blank">{{ __('messages.admin_dashboard') }}</a>
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

                    </ul>
                </div>
                <ul class="nav header-navbar-rht">
                    <li class="searchbar">
                        <a href="javascript:void(0);"><i class="feather-search"></i></a>
                        <div class="togglesearch">
                            <form action="{{ route('search.doctors') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control">
                                    <button type="submit" class="btn">Search</button>
                                </div>
                            </form>
                        </div>
                    </li>
                    @guest
                        <li>
                            <a href="{{ route('login') }}"
                                class="btn btn-md btn-primary-gradient d-inline-flex align-items-center rounded-pill"><i
                                    class="isax isax-lock-1 me-1"></i>{{ __('messages.sign_up') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('register.patient') }}"
                                class="btn btn-md btn-dark d-inline-flex align-items-center rounded-pill">
                                <i class="isax isax-user-tick me-1"></i>{{ __('messages.register') }}
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- /Header -->
