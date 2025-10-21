<div class="col-lg-4 col-xl-3 theiaStickySidebar">
    @php
        $name = explode(' ', auth('shipper')->user()->name);
        $photo = explode(' ', auth('shipper')->user()->photo);
    @endphp
    <!-- Profile Sidebar -->
    <div class="profile-sidebar carrier-sidebar profile-sidebar-new">
        <div class="widget-profile pro-widget-content">
            <div class="profile-info-widget">
                <a href="profile-settings-1.html" class="booking-doc-img">
                    <img src="{{ asset('storage/' . auth('shipper')->user()->photo) }}" alt="User Image">
                </a>



                <div class="profile-det-info">
                    <h3><a href="profile-settings-1.html">{{ ucfirst($name[0]) }}</a></h3>
                    <div class="carrier-details">
                        <h5 class="mb-0">Shipper ID : {{ auth('shipper')->user()->id }}</h5>
                    </div>
                    <span>created at <i class="fa-solid fa-circle"></i> {{ auth('shipper')->user()->created_at }}</span>
                </div>
            </div>
        </div>
        <div class="dashboard-widget">
            <nav class="dashboard-menu">
                <ul>
                    <li class="active">
                        <a href="{{ route('shipper') }}">
                            <i class="isax isax-category-2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shipment.schedule') }}">
                            <i class="isax isax-calendar-1"></i>
                            <span>Shipment Schedule</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('saved.load') }}">
                            <i class="isax isax-star-1"></i>
                            <span>Saved Loads</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('loads.index') }}">
                            <i class="isax isax-truck"></i>
                            <span>loads Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shipment.history') }}">
                            <i class="isax isax-note-21"></i>
                            <span>Shipment History</span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('trucks.show') }}">
                            <i class="isax isax-note-21"></i>
                            <span>Trucks </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('shipper.payment.account') }}">
                            <i class="isax isax-wallet-2"></i>
                            <span>Payments</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="invoices.html">
                            <i class="isax isax-document-text"></i>
                            <span>Invoices</span>
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{ route('shipper.chat') }}">
                            <i class="isax isax-messages-1"></i>
                            <span>Messages</span>
                            <small class="unread-msg">7</small>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="vehicle-details.html">
                            <i class="isax isax-car"></i>
                            <span>Vehicle Details</span>
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{ route('shipper.setting') }}">
                            <i class="isax isax-setting-2"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="login-1.html">
                            <i class="isax isax-logout"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /Profile Sidebar -->

</div>

{{-- <!-- Brand Logo -->
<a href="{{ route('shipper') }}" class="brand-link" style="display: flex;flex-wrap: wrap;justify-content: center;">
    <img src="{{ asset('4/assets/images/logo2.png') }}" alt="User picture" style="width: 160px;height: 160px;">
    <span class="brand-text font-weight-light">SahaSave.com </span>
</a>

@php
    $name = explode(' ', auth('shipper')->user()->name);
    $photo = explode(' ', auth('shipper')->user()->photo);
@endphp
<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('storage/' . auth('shipper')->user()->photo) }}" class="img-circle elevation-2"
                alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ ucfirst($name[0]) }} </a>


        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        loads
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('loads.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>loads </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('loads.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add loads </p>
                        </a>
                    </li>
                </ul>
            </li>




            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        My Setting
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('loads.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Setting </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('loads.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>My Setting </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('shipper.profile') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Profile </p>
                        </a>
                    </li>
                </ul>
            </li>





            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Chat
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('loads.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Chat </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('loads.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Chat </p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Trucks
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('trucks.show') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>trucks.show </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('loads.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Chat </p>
                        </a>
                    </li>
                </ul>
            </li>

            trucksshow

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Documentation
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('loads.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Documentation </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('loads.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Documentation </p>
                        </a>
                    </li>
                </ul>
            </li>







        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar --> --}}
