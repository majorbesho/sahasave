<header class="header header-custom header-fixed inner-header relative">
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
                <a href="{{ route('broker') }}" class="navbar-brand logo">
                    <img src="{{ asset('4/assets/images/logo2.png') }}" class="img-fluid" alt="Logo"
                        style="width: 75px;">
                </a>
            </div>
            <div class="header-menu">
                <div class="main-menu-wrapper">
                    <div class="menu-header">
                        <a href="{{ route('broker') }}" class="menu-logo">
                            <img src="{{ asset('dashboard/assets/img/logo-1.svg') }}" class="img-fluid" alt="Logo">
                        </a>
                        <a id="menu_close" class="menu-close" href="javascript:void(0);">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <ul class="main-nav">
                        <li class="has-submenu megamenu">
                            <a href="{{ route('home') }}">{{ __('index.home') }} <i class="fas fa-chevron-down"></i></a>
                            <ul class="submenu mega-submenu">

                            </ul>
                        </li>




                        <li class="has-submenu">
                            <a href="#">broker <i class="fas fa-chevron-down"></i></a>

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

                    <li class="header-theme noti-nav">
                        <a href="javascript:void(0);" id="dark-mode-toggle" class="theme-toggle">
                            <i class="isax isax-sun-1"></i>
                        </a>
                        <a href="javascript:void(0);" id="light-mode-toggle" class="theme-toggle activate">
                            <i class="isax isax-moon"></i>
                        </a>
                    </li>

                    <!-- Notifications -->
                    <li class="nav-item dropdown noti-nav me-3 pe-0">
                        <a href="#" class="dropdown-toggle active-dot active-dot-danger nav-link p-0"
                            data-bs-toggle="dropdown">
                            <i class="isax isax-notification-bing"></i>
                        </a>
                        <div class="dropdown-menu notifications dropdown-menu-end ">
                            <div class="topnav-dropdown-header">
                                <span class="notification-title">Notifications</span>
                            </div>
                            <div class="noti-content">
                                <ul class="notification-list">
                                    <li class="notification-message">
                                        <a href="#">
                                            <div class="notify-block d-flex">
                                                <span class="avatar">
                                                    <img class="avatar-img" alt="Ruby perin"
                                                        src="{{ asset('dashboard/assets/img/clients/client-01.jpg') }}">
                                                </span>
                                                <div class="media-body">
                                                    <h6>Travis Tremble <span class="notification-time">18.30 PM</span>
                                                    </h6>
                                                    <p class="noti-details">Sent a amount of $210 for his Appointment
                                                        <span class="noti-title">Dr.Ruby perin </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="notification-message">
                                        <a href="#">
                                            <div class="notify-block d-flex">
                                                <span class="avatar">
                                                    <img class="avatar-img" alt="Hendry Watt"
                                                        src="{{ asset('dashboard/assets/img/clients/client-02.jpg') }}">
                                                </span>
                                                <div class="media-body">
                                                    <h6>Travis Tremble <span class="notification-time">12 Min
                                                            Ago</span></h6>
                                                    <p class="noti-details"> has booked her appointment to <span
                                                            class="noti-title">Dr. Hendry Watt</span></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="notification-message">
                                        <a href="#">
                                            <div class="notify-block d-flex">
                                                <div class="avatar">
                                                    <img class="avatar-img" alt="Maria Dyen"
                                                        src="{{ asset('dashboard/assets/img/clients/client-03.jpg') }}">
                                                </div>
                                                <div class="media-body">
                                                    <h6>Travis Tremble <span class="notification-time">6 Min Ago</span>
                                                    </h6>
                                                    <p class="noti-details"> Sent a amount $210 for his Appointment
                                                        <span class="noti-title">Dr.Maria Dyen</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="notification-message">
                                        <a href="#">
                                            <div class="notify-block d-flex">
                                                <div class="avatar avatar-sm">
                                                    <img class="avatar-img" alt="client-image"
                                                        src="{{ asset('dashboard/assets/img/clients/client-04.jpg') }}">
                                                </div>
                                                <div class="media-body">
                                                    <h6>Travis Tremble <span class="notification-time">8.30 AM</span>
                                                    </h6>
                                                    <p class="noti-details"> Send a message to his doctor</p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- /Notifications -->

                    <!-- Messages -->
                    <li class="nav-item noti-nav me-3 pe-0">
                        <a href="{{ route('broker.chat') }}"
                            class="dropdown-toggle nav-link active-dot active-dot-success p-0">
                            <i class="isax isax-message-2"></i>
                        </a>
                    </li>
                    <!-- /Messages -->

                    <!-- Cart -->
                    <li class="nav-item dropdown noti-nav view-cart-header me-3 pe-0">
                        <a href="#"
                            class="dropdown-toggle nav-link active-dot active-dot-purple p-0 position-relative"
                            data-bs-toggle="dropdown">
                            <i class="isax isax-shopping-cart"></i>
                        </a>
                        <div class="dropdown-menu notifications dropdown-menu-end">
                            <div class="shopping-cart">
                                <ul class="shopping-cart-items list-unstyled">
                                    <li class="clearfix">
                                        <div class="close-icon"><i class="fa-solid fa-circle-xmark"></i></div>
                                        <a href="product-description-1.html"><img class="avatar-img rounded"
                                                src="{{ asset('dashboard/assets/img/products/product.jpg') }}"
                                                alt="User Image"></a>
                                        <a href="product-description-1.html" class="item-name">Benzaxapine Croplex</a>
                                        <span class="item-price">$849.99</span>
                                        <span class="item-quantity">Quantity: 01</span>
                                    </li>

                                    <li class="clearfix">
                                        <div class="close-icon"><i class="fa-solid fa-circle-xmark"></i></div>
                                        <a href="product-description-1.html"><img class="avatar-img rounded"
                                                src="{{ asset('dashboard/assets/img/products/product1.jpg') }}"
                                                alt="User Image"></a>
                                        <a href="product-description-1.html" class="item-name">Ombinazol Bonibamol</a>
                                        <span class="item-price">$1,249.99</span>
                                        <span class="item-quantity">Quantity: 01</span>
                                    </li>

                                    <li class="clearfix">
                                        <div class="close-icon"><i class="fa-solid fa-circle-xmark"></i></div>
                                        <a href="product-description-1.html"><img class="avatar-img rounded"
                                                src="{{ asset('dashboard/assets/img/products/product2.jpg') }}"
                                                alt="User Image"></a>
                                        <a href="product-description-1.html" class="item-name">Dantotate
                                            Dantodazole</a>
                                        <span class="item-price">$129.99</span>
                                        <span class="item-quantity">Quantity: 01</span>
                                    </li>
                                </ul>
                                <div class="booking-summary pt-3">
                                    <div class="booking-item-wrap">
                                        <ul class="booking-date">
                                            <li>Subtotal <span>$5,877.00</span></li>
                                            <li>Shipping <span>$25.00</span></li>
                                            <li>Tax <span>$0.00</span></li>
                                            <li>Total <span>$5.2555</span></li>
                                        </ul>
                                        <div class="booking-total">
                                            <ul class="booking-total-list text-align">
                                                <li>
                                                    <div class="clinic-booking pt-3">
                                                        <a class="apt-btn" href="cart-1.html">View Cart</a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="clinic-booking pt-3">
                                                        <a class="apt-btn" href="product-checkout-1.html">Checkout</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- /Cart -->

                    <!-- User Menu -->
                    <li class="nav-item dropdown has-arrow logged-item">
                        <a href="#" class="nav-link ps-0" data-bs-toggle="dropdown">
                            <span class="user-img">
                                <img class="rounded-circle"
                                    src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-06.jpg') }}"
                                    width="31" alt="Darren Elder">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="user-header">
                                <div class="avatar avatar-sm">
                                    <img src="{{ asset('dashboard/assets/img/doctors-dashboard/profile-06.jpg') }}"
                                        alt="User Image" class="avatar-img rounded-circle">
                                </div>
                                <div class="user-text">
                                    <h6>Hendrita Hayes</h6>
                                    <p class="text-muted mb-0">Patient</p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ route('broker') }}">Dashboard</a>
                            <a class="dropdown-item" href="{{ route('broker.setting') }}">Profile Settings</a>
                            <a class="dropdown-item" href="{{ route('broker.logout') }}">Logout</a>
                        </div>
                    </li>
                    <!-- /User Menu -->
                </ul>
            </div>
        </nav>
    </div>
</header>










{{--
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link" href="{{ route('broker.logout') }}"
            onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>

</ul>

<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <li class="nav-item">
        {{-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a> --}
        <div class="navbar-search-block">
            <form class="form-inline">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>

    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                    <img src="{{ asset('backend/dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                        class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                            Brad Diesel
                            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">Call me whenever you can...</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                    </div>
                </div>
                <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                    <img src="{{ asset('backend/dist/img/user8-128x128.jpg') }}" alt="User Avatar"
                        class="img-size-50 img-circle mr-3">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                            John Pierce
                            <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">I got your message bro</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                    </div>
                </div>
                <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                    <img src="{{ asset('backend/dist/img/user3-128x128.jpg') }}" alt="User Avatar"
                        class="img-size-50 img-circle mr-3">
                    <div class="media-body">
                        <h3 class="dropdown-item-title">
                            Nora Silvester
                            <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                        </h3>
                        <p class="text-sm">The subject goes here</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                    </div>
                </div>
                <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
    </li>
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> 4 new messages
                <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <i class="fas fa-users mr-2"></i> 8 friend requests
                <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> 3 new reports
                <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
        </a>
    </li>
</ul> --}}




{{-- <style>
    .header {
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 10px 0;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* تنسيق الشعار */
    .logo a {
        font-size: 24px;
        font-weight: bold;
        color: #333333;
        text-decoration: none;
    }

    /* تنسيق قسم الإجراءات (الإحصائيات، الرسائل، التنبيهات) */
    .header-actions {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    /* تنسيق الإحصائيات، الرسائل، التنبيهات */
    .statistics,
    .messages,
    .notifications {
        position: relative;
    }

    .statistics-link,
    .messages-link,
    .notifications-link {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #555555;
        text-decoration: none;
    }

    .statistics-link:hover,
    .messages-link:hover,
    .notifications-link:hover {
        color: #007bff;
    }

    .statistics-count,
    .messages-count,
    .notifications-count {
        background-color: #ff4d4d;
        color: #ffffff;
        font-size: 12px;
        padding: 2px 6px;
        border-radius: 50%;
        position: absolute;
        top: -8px;
        right: -8px;
    }

    /* تنسيق صورة المستخدم */
    .user-profile .user-link {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: #333333;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-name {
        font-size: 16px;
    }

    .messages-dropdown,
    .notifications-dropdown {
        position: absolute;
        top: 100%;
        right: 0;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 4px;
        display: none;
        z-index: 1000;
    }

    .messages-dropdown.show,
    .notifications-dropdown.show {
        display: block;
    }

    .dropdown-content {
        padding: 10px;
        width: 100%;
    }

    .dropdown-content a {
        display: block;
        padding: 8px 16px;
        color: #333333;
        text-decoration: none;
    }

    .dropdown-content a:hover {
        background-color: #f8f9fa;
    }

    .fas {
        font-size: 30px;
        padding-left: 10px;
        padding-right: 10px;
    }
</style>
<!-- Sidebar -->
<header class="header">
    <div class="container">
        <div class="header-content">
            <!-- العنوان أو الشعار -->
            <div class="logo">
                <a href="#">broker Dashboard</a>
            </div>

            <!-- قسم الإحصائيات والرسائل والتنبيهات -->
            <div class="header-actions">
                <!-- الإحصائيات -->
                <div class="statistics">
                    <a href="#" class="statistics-link">
                        <i class="fas fa-chart-line"></i>
                        <span class="statistics-count">5</span>
                    </a>
                </div>

                <!-- الرسائل -->
                <div class="messages">
                    <a href="#" class="messages-link">
                        <i class="fas fa-envelope"></i>
                        <span class="messages-count">3</span>
                    </a>
                </div>

                <!-- التنبيهات -->
                <div class="notifications">
                    <a href="#" class="notifications-link">
                        <i class="fas fa-bell"></i>
                        <span class="notifications-count">2</span>
                    </a>
                </div>

                {{-- <!-- صورة المستخدم -->
                <div class="user-profile">
                    <a href="#" class="user-link">
                        <img src="user-avatar.jpg" alt="User Avatar" class="user-avatar">
                        @php
                            $namelast = explode(' ', auth('broker')->user()->name);
                        @endphp

                        <span class="user-name">{{ $namelast }}</span>
                    </a>
                </div> --}
            </div>
        </div>
    </div>
</header> --}}
