<!-- Brand Logo -->
<a href="/" class="brand-link">
    <img src="{{ asset('frontend/img/logo/1.png') }}" alt=" SahaSave.com " class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light"> SahaSave.com </span>
</a>
@php
    //$title = explode(' ', auth('supplier')->user()->title);
@endphp
<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ ucfirst(auth('supplier')->user()->title) }} </a> -
        </div>
    </div>
    @php
        //dd( ucfirst(auth('supplier')->user()) )

        // "{"id":24,"title":"test1","contactNo":"","company":"","slug":"","discreption":null,
// "photo":"","resName":"","email":"test2122@gmaiol.com","tele":"","web":"","nots":"","status":"active","truckNO":"","provider":null,
// "provider_id":null,"phone":"+20454878","phoneOtp_verified_at":null,"referral_code":"t2AeXJceFR","ref_by":"0","no_of_refs":0,"ref_level_id":0,"phone_verfiy":null,
// "is_verified":0,"onesignal_device_id":null,"_lft":45,"_rgt":46,"parent_id":null,"created_at":"2024-10-05T13:29:56.000000Z","updated_at":"2024-10-05T13:29:56.000000Z"}
    @endphp

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
                        supplier
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('supplier.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>supplier </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('supplier.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add supplier </p>
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
                        <a href="{{ route('supplier-trauck.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Trucks </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('supplier-trauck.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Trucks </p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Loads
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('supplier-LoadPackage.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Loads </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('supplier-LoadPackage.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Load </p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        My Dashboard
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                {{--
                        <li><a href="{{ route('personalInformation') }}">User Profile</a></li>
                        <li><a href="{{ route('dashboard') }}">History</a></li>
                        <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                        <li><a href="{{ route('transaction') }}">Cart</a></li>
                        <li><a href="{{ route('stripe') }}">Checkout</a></li>
                        <li><a href="track-order.html">Track Order</a></li>
                        <li><a href="user-invoice.html">Invoice</a></li>
                        <li><a href="{{ route('user.logout') }}">logout</a></li>
                        'title',
                        'company',
                        'slug',
                        'discreption',
                        'photo',
                        'status',
                        'contactNo',
                        'resName',
                        'email',
                        'tele',
                        'web',
                        'nots',
                        'phone',
                        'phone_verfiy',
                        'provider',
                        'provider_id',
                        'is_verified',
                        'referral_code',
                        'ref_by',
                        'no_of_refs',
                        'ref_level_id',
                        'onesignal_device_id',
                    --}}
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('supplier.personalInformation') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Profile </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('supplier.transaction') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>transaction </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('supplier.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add supplier </p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>


    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
