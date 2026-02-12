@php
    $route = Route::currentRouteName();
@endphp
<div class="profile-sidebar patient-sidebar profile-sidebar-new">
    <div class="widget-profile pro-widget-content">
        <div class="profile-info-widget">
            <a href="{{ route('patient.profile.settings') }}" class="booking-doc-img">
                <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('frontend/xx/assets/img/doctors-dashboard/profile-06.jpg') }}"
                    alt="User Image">
            </a>
            <div class="profile-det-info">
                <h3><a href="{{ route('patient.profile.settings') }}">{{ Auth::user()->name }}</a></h3>
                <div class="patient-details">
                    <h5 class="mb-0">Patient ID : PT{{ str_pad(Auth::id(), 6, '0', STR_PAD_LEFT) }}
                    </h5>
                </div>
                <span>
                    {{ ucfirst(Auth::user()->gender) }}
                    <i class="fa-solid fa-circle"></i>
                    {{ Auth::user()->date_of_birth ? Auth::user()->date_of_birth->age . ' years' : 'Age not set' }}
                </span>
            </div>
        </div>
    </div>

    <!-- القائمة الجانبية المحسنة -->
    <div class="dashboard-widget">
        <nav class="dashboard-menu">
            <ul>
                <li class="{{ $route == 'patient.dashboard' ? 'active' : '' }}">
                    <a href="{{ route('patient.dashboard') }}">
                        <i class="isax isax-category-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ $route == 'patient.appointmentsslide' ? 'active' : '' }}">
                    <a href="{{ route('patient.appointmentsslide') }}">
                        <i class="isax isax-calendar-1"></i>
                        <span>My Appointments</span>
                    </a>
                </li>
                <li class="{{ $route == 'patient.favorites.index' ? 'active' : '' }}">
                    <a href="{{ route('patient.favorites.index') }}">
                        <i class="fa-solid fa-user-doctor"></i>
                        <span>Favourites</span>
                    </a>
                </li>
                {{-- <li class="{{ $route == 'patient.medical-records' ? 'active' : '' }}">
                    <a href="{{ route('patient.medical-records') }}">
                        <i class="isax isax-note-21"></i>
                        <span>Medical Records</span>
                    </a>
                </li> --}}
                {{-- <li class="{{ $route == 'patient.prescriptions' ? 'active' : '' }}">
                    <a href="{{ route('patient.prescriptions') }}">
                        <i class="fa-solid fa-prescription"></i>
                        <span>Prescriptions</span>
                    </a>
                </li>
                <li class="{{ $route == 'patient.lab-orders' ? 'active' : '' }}">
                    <a href="{{ route('patient.lab-orders') }}">
                        <i class="fa-solid fa-flask"></i>
                        <span>Lab Orders</span>
                    </a>
                </li> --}}
                <li class="{{ $route == 'patient.referrals' ? 'active' : '' }}">
                    <a href="{{ route('patient.referrals') }}">
                        <i class="fa-solid fa-share-nodes"></i>
                        <span>Referrals & Rewards</span>
                    </a>
                </li>
                <li class="{{ Str::startsWith($route, 'patient.loyalty') ? 'active' : '' }}">
                    <a href="{{ route('patient.loyalty.index') }}">
                        <i class="fa-solid fa-coins"></i>
                        <span>Loyalty Points</span>
                    </a>
                </li>
                <li class="{{ $route == 'patient.messages' ? 'active' : '' }}">
                    <a href="{{ route('patient.messages') }}">
                        <i class="isax isax-messages-1"></i>
                        <span>Messages</span>
                    </a>
                </li>
                <li class="{{ $route == 'patient.profile.settings' ? 'active' : '' }}">
                    <a href="{{ route('patient.profile.settings') }}">
                        <i class="isax isax-setting-2"></i>
                        <span>Profile Settings</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="isax isax-logout"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                        class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>

</div>
