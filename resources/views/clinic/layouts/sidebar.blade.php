<div class="col-lg-4 col-xl-3 theiaStickySidebar">
    <div class="profile-sidebar">
        <div class="widget-profile pro-widget-content">
            <div class="profile-info-widget">
                <a href="#" class="booking-doc-img">
                    <img src="{{ $clinic->logo ? asset('storage/' . $clinic->logo) : asset('assets/img/clinic-default.png') }}" alt="Clinic Logo">
                </a>
                <div class="profile-det-info">
                    <h3>{{ $clinic->name }}</h3>
                    <div class="patient-details">
                        <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-widget">
            <nav class="dashboard-menu">
                <ul>
                    <li class="{{ Route::is('clinic.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('clinic.dashboard', $clinic->id) }}">
                            <i class="fas fa-columns"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('clinic.reception.*') ? 'active' : '' }}">
                        <a href="{{ route('clinic.reception.index', $clinic->id) }}">
                            <i class="fas fa-user-plus"></i>
                            <span>Reception / Booking</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('clinic.appointments.*') ? 'active' : '' }}">
                        <a href="{{ route('clinic.appointments.index', $clinic->id) }}">
                            <i class="fas fa-calendar-check"></i>
                            <span>Appointments</span>
                            <small class="unread-msg">{{ \App\Models\Appointment::where('medical_center_id', $clinic->id)->where('status', 'scheduled')->count() }}</small>
                        </a>
                    </li>
                    <li class="{{ Route::is('clinic.patients.*') ? 'active' : '' }}">
                        <a href="{{ route('clinic.patients.index', $clinic->id) }}">
                            <i class="fas fa-user-injured"></i>
                            <span>Patients</span>
                        </a>
                    </li>
                    
                    @if(auth()->user()->hasPermissionInCenter('manage_staff', $clinic->id))
                    <li class="{{ Route::is('clinic.doctors.*') ? 'active' : '' }}">
                        <a href="{{ route('clinic.doctors.index', $clinic->id) }}">
                            <i class="fas fa-user-md"></i>
                            <span>Doctors</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('clinic.staff.*') ? 'active' : '' }}">
                        <a href="{{ route('clinic.staff.index', $clinic->id) }}">
                            <i class="fas fa-users-cog"></i>
                            <span>Staff Management</span>
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->hasPermissionInCenter('manage_clinic_settings', $clinic->id))
                    <li class="{{ Route::is('clinic.services.*') ? 'active' : '' }}">
                        <a href="{{ route('clinic.services.index', $clinic->id) }}">
                            <i class="fas fa-concierge-bell"></i>
                            <span>Services & Pricing</span>
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->hasPermissionInCenter('view_financial_reports', $clinic->id))
                    <li class="{{ Route::is('clinic.reports.*') ? 'active' : '' }}">
                        <a href="{{ route('clinic.reports.overview', $clinic->id) }}">
                            <i class="fas fa-chart-line"></i>
                            <span>Reports</span>
                        </a>
                    </li>
                    @endif

                    <li class="{{ Route::is('clinic.notifications.*') ? 'active' : '' }}">
                        <a href="{{ route('clinic.notifications.index', $clinic->id) }}">
                            <i class="fas fa-bell"></i>
                            <span>Notifications</span>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <small class="unread-msg">{{ auth()->user()->unreadNotifications->count() }}</small>
                            @endif
                        </a>
                    </li>

                    @if(auth()->user()->hasPermissionInCenter('manage_clinic_settings', $clinic->id))
                    <li class="{{ Route::is('clinic.settings.*') ? 'active' : '' }}">
                        <a href="{{ route('clinic.settings.general', $clinic->id) }}">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    @endif
                    
                    <li>
                        <form action="{{ route('logout') }}" method="POST" id="logout-clinic-form" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-clinic-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
