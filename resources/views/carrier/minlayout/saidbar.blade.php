<!-- Brand Logo -->
<a href="/" class="brand-link">
    {{-- <img src="{{ asset('4/assets/images/logo.png') }}" alt="SahaSave.com "
        class="brand-image img-circle elevation-3"style="opacity: .8">
    <span class="brand-text font-weight-light">SahaSave.com </span> --}}
</a>
@php
    $name = explode(' ', auth('carrier')->user()->name);
@endphp
<!-- Sidebar -->

<div class="main">
    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="#">pro sidebar</a>
                    <div id="close-sidebar">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="sidebar-header">
                    <div class="user-pic">
                        <img class="img-responsive img-rounded" src="../assets/photo/user.jpg" alt="User picture">
                    </div>
                    <div class="user-info">
                        <span class="user-name">Admin
                            <strong>
                                @php
                                    echo $name[0];
                                @endphp
                            </strong>
                        </span>
                        <span class="user-role">Carrier</span>
                        <span class="user-status">
                            <i class="fa fa-circle"></i>
                            <span>Online</span>
                        </span>
                    </div>
                </div>
                <!-- sidebar-header  -->
                <div class="sidebar-search">
                    <div>
                        <div class="input-group">
                            <input type="text" class="form-control search-menu" placeholder="Search...">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- sidebar-search  -->
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>General</span>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="{{ route('carriertrucks.index') }}">
                                <i class="fa fa-tachometer-alt"></i>
                                <span>Truck</span>
                                <span class="badge badge-pill badge-warning">New</span>
                            </a>
                            {{-- <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="#">Dashboard 3</a>
                                    </li>
                                </ul>
                            </div> --}}
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                <span>My Setting</span>
                                <span class="badge badge-pill badge-danger">4</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="#">Profile</a>
                                    </li>
                                    <li>
                                        <a href="#">Statices</a>
                                    </li>
                                    <li>
                                        <a href="#">Payment</a>
                                    </li>
                                    <li>
                                        <a href="#">Account</a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="far fa-gem"></i>
                                <span>Updates</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="#">New Trucks </a>
                                    </li>
                                    <li>
                                        <a href="#">New Loads </a>
                                    </li>
                                </ul>

                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-chart-line"></i>
                                <span>Charts</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="#">Pie chart</a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-globe"></i><span>Chat</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="#">Google maps</a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="header-menu">
                            <span>Extra</span>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-book"></i>
                                <span>Documentation</span>
                                <span class="badge badge-pill badge-primary">Beta</span>
                            </a>
                        </li>


                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
            <!-- sidebar-content  -->
            <div class="sidebar-footer">
                <a href="#">
                    <i class="fa fa-bell"></i>
                    <span class="badge badge-pill badge-warning notification">3</span>
                </a>
                <a href="#">
                    <i class="fa fa-envelope"></i>
                    <span class="badge badge-pill badge-success notification">7</span>
                </a>
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span class="badge-sonar"></span>
                </a>

                <form action="{{ route('carrier.logout') }}" method="POST">

                    @csrf
                    <button type="submit"> <i class="fa fa-power-off"></i></button>
                </form>

                {{-- <a href="{{ route('carrier.logout') }}">
                    <i class="fa fa-power-off"></i>
                </a> --}}
            </div>
        </nav>


        <!-- sidebar-wrapper  -->
