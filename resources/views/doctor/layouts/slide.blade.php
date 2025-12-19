<div class="col-lg-4 col-xl-3 theiaStickySidebar">
    <!-- Profile Sidebar -->
    <div class="profile-sidebar doctor-sidebar profile-sidebar-new">
        <div class="widget-profile pro-widget-content">
            <div class="profile-info-widget">
                <a href="#" class="booking-doc-img">
                    <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('assets/img/doctors-dashboard/doctor-profile-img.jpg') }}"
                        alt="User Image">
                </a>
                <div class="profile-det-info">
                    <h3><a href="#">{{ Auth::user()->name }}</a></h3>
                    <div class="patient-details">
                        <h5 class="mb-0">
                            {{ Auth::user()->doctorProfile->qualifications_display ?? 'Qualifications not set' }}</h5>
                    </div>
                    <span class="badge doctor-role-badge">
                        <i class="fa-solid fa-circle"></i>
                        {{ Auth::user()->doctorProfile->specialization ?? 'Specialty not set' }}
                    </span>
                </div>
            </div>
        </div>
        <div class="doctor-available-head">
            <div class="input-block input-block-new">
                <label class="form-label">Availability
                    <span class="text-danger">*</span></label>
                <select class="select form-control">
                    <option>I am Available Now</option>
                    <option>Not Available</option>
                </select>
            </div>
        </div>

        <div class="dashboard-widget">
            <nav class="dashboard-menu">
                <ul>
                    <li class="{{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('doctor.dashboard') }}">
                            <i class="isax isax-category-2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('doctor.requests.*') ? 'active' : '' }}">
                        <a href="{{ route('doctor.doctor.requests') }}">
                            <i class="isax isax-clipboard-tick"></i>
                            <span>Requests</span>
                            <small class="unread-msg">2</small>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('doctor.appointments.*') ? 'active' : '' }}">
                        <a href="{{ route('doctor.appointments.index') }}">
                            <i class="isax isax-calendar-1"></i>
                            <span>Appointments</span>
                        </a>
                    </li>



                    <li class="{{ request()->routeIs('doctor.medical-centers.*') ? 'active' : '' }}">
                        <a href="{{ route('doctor.doctor.medical-centers.index') }}">
                            <i class="isax isax-calendar-1"></i>
                            <span>doctor Linked to Ceneter</span>
                        </a>
                    </li>



                    <li class="{{ request()->routeIs('doctor.schedule.*') ? 'active' : '' }}">
                        <a href="{{ route('doctor.schedule.index') }}">
                            <i class="isax isax-calendar-tick"></i>
                            <span>Available Timings</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('doctor.patients.*') ? 'active' : '' }}">
                        <a href="{{ route('doctor.doctor.patients.index') }}">
                            <i class="fa-solid fa-user-injured"></i>
                            <span>My Patients</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('doctor.specialties.*') ? 'active' : '' }}">
                        <a href="{{ route('specialties.index') }}">
                            <i class="isax isax-clock"></i>
                            <span>Specialties & Services</span>
                        </a>
                    </li>




                    <li class="{{ request()->routeIs('doctor.reviews.*') ? 'active' : '' }}">
                        <a href="{{ route('doctor.reviews.index') }}">
                            <i class="isax isax-star-1"></i>
                            <span>Reviews</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('doctor.accounts.*') ? 'active' : '' }}">
                        <a href="{{ route('doctor.accounts.index') }}">
                            <i class="isax isax-profile-tick"></i>
                            <span>Accounts</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('doctor.invoices.*') ? 'active' : '' }}">
                        <a href="{{ route('doctor.invoices.index') }}">
                            <i class="isax isax-document-text"></i>
                            <span>Invoices</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('doctor.payouts.*') ? 'active' : '' }}">
                        <a href="{{ route('doctor.payouts.index') }}">
                            <i class="fa-solid fa-money-bill-1"></i>
                            <span>Payout Settings</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('doctor.chat.*') ? 'active' : '' }}">
                        <a href="{{ route('doctor.chat.index') }}">
                            <i class="isax isax-messages-1"></i>
                            <span>Message</span>
                            <small class="unread-msg">7</small>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('doctor.profile.*') ? 'active' : '' }}">
                        <a href="{{ route('doctor.profile.edit') }}">
                            <i class="isax isax-setting-2"></i>
                            <span>Profile Settings</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('doctor.social.*') ? 'active' : '' }}">
                        <a href="{{ route('doctor.social.index') }}">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>Social Media</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('doctor.password.*') ? 'active' : '' }}">
                        <a href="{{ route('doctor.password.edit') }}">
                            <i class="isax isax-key"></i>
                            <span>Change Password</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="isax isax-logout"></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /Profile Sidebar -->
</div>
