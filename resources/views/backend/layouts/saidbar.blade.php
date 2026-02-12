<!-- Brand Logo -->
<a href="/" class="brand-link">
    <img src="{{ asset('frontend/img/logo/1.png') }}" alt="SehaSave.com "
        class="brand-image img-circle elevation-3"style="opacity: .8">
    <span class="brand-text font-weight-light">SehaSave.com </span>
</a>
@php
    $name = explode(' ', auth('admin')->user()->name);
@endphp
<!-- Sidebar -->
<div class="sidebar">
    <div class="mt-3">
        <a href="{{ route('admin') }}" class="btn btn-primary btn-block">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
    </div>
    <!-- Sidebar user panel (optional) -->
    <div class="pb-3 mt-3 mb-3 user-panel d-flex">
        <div class="image">
            <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
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
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Banners
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" id="#menu">
                    <li class="nav-item">
                        <a href="{{ route('banner.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Banner </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('banner.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Banner </p>
                        </a>
                    </li>
                </ul>
            </li>









            {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        about
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('about.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>about </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('about.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add about </p>
                        </a>
                    </li>
                </ul>
            </li> --}}


<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-medal"></i>
        <p>
            Loyalty Management
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.loyalty.tiers.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Loyalty Tiers</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.loyalty.points.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>User Points</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.loyalty.settings.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Loyalty Settings</p>
            </a>
        </li>
    </ul>
</li>

<!-- Rewards Management -->
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-gift"></i>
        <p>
            إدارة المكافآت
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.rewards.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>جميع المكافآت</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.rewards.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>إصدار مكافأة</p>
            </a>
        </li>
    </ul>
</li>



            
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        blog
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('adminblog.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>blog </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('adminblog.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add blog </p>
                        </a>
                    </li>
                </ul>
            </li>





            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Doctors
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('doctors.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>all doctors </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('doctors.statistics') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Pindding </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('order.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Clinic </p>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Appointments Management -->
            <li class="nav-item">
                <a href="{{ route('admin.appointments.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-calendar-check"></i>
                    <p>
                        المواعيد
                        <span class="badge badge-info right">جديد</span>
                    </p>
                </a>
            </li>

            <!-- Reviews Management -->
            <li class="nav-item">
                <a href="{{ route('admin.reviews.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-star"></i>
                    <p>
                        التقييمات
                    </p>
                </a>
            </li>




            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Specialty
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.specialties.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>all specialties </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.specialties.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add specialties </p>
                        </a>
                    </li>
                </ul>
            </li>




            {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        order
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('order.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>order </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('order.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add order </p>
                        </a>
                    </li>
                </ul>
            </li> --}}



            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        medical-centers
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.medical-centers.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>medical-centers </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.medical-centers.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>edical-centers Create </p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-list-alt"></i>
                    <p>
                        التصنيفات الطبية
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>جميع التصنيفات</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categories.admin.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>إضافة تصنيف جديد</p>
                        </a>
                    </li>
                </ul>
            </li>




            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Brand
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('brand.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All brand</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('brand.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add brand</p>
                        </a>
                    </li>
                </ul>
            </li>



            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Art<i class="fas fa-angle-left right"></i> </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('art.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All art</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('art.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add art</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>clients<i class="fas fa-angle-left right"></i> </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('client.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All client</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('client.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add client</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>User Account<i class="fas fa-angle-left right"></i> </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All user</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add user</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>faq <i class="fas fa-angle-left right"></i> </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('faq.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All faq</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('faq.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add faq</p>
                        </a>
                    </li>
                </ul>
            </li>









            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Setting Edit
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('setting.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All setting</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('setting.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Setting Add </p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Coupon
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('coupon.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All coupon</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('coupon.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>coupon Add </p>
                        </a>
                    </li>
                </ul>
            </li>




            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        branch
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('branch.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All branch</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('branch.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>add branch </p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Testimonials
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('testim.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Testimonials </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('testim.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>add Testimonials </p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Insta
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('project.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Insta </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('project.create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>add Insta </p>
                        </a>
                    </li>
                </ul>
            </li>



            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        FrontEnd Edit
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/layout/top-nav.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Slid</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/layout/top-nav.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Slid</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->




</div>
<!-- /.sidebar -->
