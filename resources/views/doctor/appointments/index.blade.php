@extends('frontend.layouts.master')


@section('content')


    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="text-center col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html"><i class="isax isax-home-15"></i></a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Doctor
                            </li>
                            <li class="breadcrumb-item active">
                                Appointments
                            </li>
                        </ol>
                        <h2 class="breadcrumb-title">Appointments</h2>
                    </nav>
                </div>
            </div>
        </div>
        <div class="breadcrumb-bg">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-01.png') }}" alt="img"
                class="breadcrumb-bg-01" />
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-02.png') }}" alt="img"
                class="breadcrumb-bg-02" />
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img"
                class="breadcrumb-bg-03" />
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img"
                class="breadcrumb-bg-04" />
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">
            <div class="row">
                @include('doctor.layouts.slide')
                <div class="col-lg-8 col-xl-9">
                    <div class="dashboard-header">
                        <h3>Appointments</h3>
                        <ul class="header-list-btns">
                            <li>
                                <div class="input-block dash-search-input">
                                    <input type="text" class="form-control" placeholder="Search" />
                                    <span class="search-icon"><i class="isax isax-search-normal"></i></span>
                                </div>
                            </li>
                            <li>
                                <div class="view-icons">
                                    <a href="appointments.html" class="active"><i class="isax isax-grid-7"></i></a>
                                </div>
                            </li>
                            <li>
                                <div class="view-icons">
                                    <a href="doctor-appointments-grid.html"><i class="fa-solid fa-th"></i></a>
                                </div>
                            </li>
                            <li>
                                <div class="view-icons">
                                    <a href="#"><i class="isax isax-calendar-tick"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>


                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="tab-content appointment-tab-content">
                        <!-- Upcoming Appointments Tab -->
                        <div class="tab-pane fade show active" id="pills-upcoming" role="tabpanel">
                            @forelse($upcomingAppointments as $appointment)
                                @include('doctor.appointments.partials.appointment-card', [
                                    'appointment' => $appointment,
                                ])
                            @empty
                                <div class="alert alert-info">No upcoming appointments found.</div>
                            @endforelse
                            {{ $upcomingAppointments->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>

                        <!-- Completed Appointments Tab -->
                        <div class="tab-pane fade" id="pills-complete" role="tabpanel">
                            @forelse($completedAppointments as $appointment)
                                @include('doctor.appointments.partials.appointment-card', [
                                    'appointment' => $appointment,
                                ])
                            @empty
                                <div class="alert alert-info">No completed appointments found.</div>
                            @endforelse
                            {{ $completedAppointments->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>

                        <!-- Cancelled Appointments Tab -->
                        <div class="tab-pane fade" id="pills-cancel" role="tabpanel">
                            @forelse($cancelledAppointments as $appointment)
                                @include('doctor.appointments.partials.appointment-card', [
                                    'appointment' => $appointment,
                                ])
                            @empty
                                <div class="alert alert-info">No cancelled appointments found.</div>
                            @endforelse
                            {{ $cancelledAppointments->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>

                    {{-- <div class="tab-pane fade" id="pills-cancel" role="tabpanel" aria-labelledby="pills-cancel-tab">
                    <!-- Appointment List -->
                    <div class="appointment-wrap">
                        <ul>
                            <li>
                                <div class="patinet-information">
                                    <a href="doctor-cancelled-appointment.html">
                                        <img src="assets/img/doctors-dashboard/profile-01.jpg" alt="User Image" />
                                    </a>
                                    <div class="patient-info">
                                        <p>#Apt0001</p>
                                        <h6>
                                            <a href="doctor-cancelled-appointment.html">Adrian</a>
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="appointment-info">
                                <p>
                                    <i class="isax isax-clock5"></i>11 Nov 2024 10.45 AM
                                </p>
                                <ul class="d-flex apponitment-types">
                                    <li>General Visit</li>
                                    <li>Video Call</li>
                                </ul>
                            </li>
                            <li class="appointment-detail-btn">
                                <a href="doctor-cancelled-appointment.html" class="start-link">View Details</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Appointment List -->

                    <!-- Appointment List -->
                    <div class="appointment-wrap">
                        <ul>
                            <li>
                                <div class="patinet-information">
                                    <a href="doctor-cancelled-appointment.html">
                                        <img src="assets/img/doctors-dashboard/profile-02.jpg" alt="User Image" />
                                    </a>
                                    <div class="patient-info">
                                        <p>#Apt0002</p>
                                        <h6>
                                            <a href="doctor-cancelled-appointment.html">Kelly</a><span
                                                class="badge new-tag">New</span>
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="appointment-info">
                                <p>
                                    <i class="isax isax-clock5"></i>05 Nov 2024 11.50 AM
                                </p>
                                <ul class="d-flex apponitment-types">
                                    <li>General Visit</li>
                                    <li>Audio Call</li>
                                </ul>
                            </li>
                            <li class="appointment-detail-btn">
                                <a href="doctor-cancelled-appointment.html" class="start-link">View Details</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Appointment List -->

                    <!-- Appointment List -->
                    <div class="appointment-wrap">
                        <ul>
                            <li>
                                <div class="patinet-information">
                                    <a href="doctor-cancelled-appointment.html">
                                        <img src="assets/img/doctors-dashboard/profile-03.jpg" alt="User Image" />
                                    </a>
                                    <div class="patient-info">
                                        <p>#Apt0003</p>
                                        <h6>
                                            <a href="doctor-cancelled-appointment.html">Samuel</a>
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="appointment-info">
                                <p>
                                    <i class="isax isax-clock5"></i>27 Oct 2024 09.30 AM
                                </p>
                                <ul class="d-flex apponitment-types">
                                    <li>General Visit</li>
                                    <li>Video Call</li>
                                </ul>
                            </li>
                            <li class="appointment-detail-btn">
                                <a href="doctor-cancelled-appointment.html" class="start-link">View Details</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Appointment List -->

                    <!-- Appointment List -->
                    <div class="appointment-wrap">
                        <ul>
                            <li>
                                <div class="patinet-information">
                                    <a href="doctor-cancelled-appointment.html">
                                        <img src="assets/img/doctors-dashboard/profile-04.jpg" alt="User Image" />
                                    </a>
                                    <div class="patient-info">
                                        <p>#Apt0004</p>
                                        <h6>
                                            <a href="doctor-cancelled-appointment.html">Catherine</a>
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="appointment-info">
                                <p>
                                    <i class="isax isax-clock5"></i>18 Oct 2024 12.20 PM
                                </p>
                                <ul class="d-flex apponitment-types">
                                    <li>General Visit</li>
                                    <li>Direct Visit</li>
                                </ul>
                            </li>
                            <li class="appointment-detail-btn">
                                <a href="doctor-cancelled-appointment.html" class="start-link">View Details</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Appointment List -->

                    <!-- Appointment List -->
                    <div class="appointment-wrap">
                        <ul>
                            <li>
                                <div class="patinet-information">
                                    <a href="doctor-cancelled-appointment.html">
                                        <img src="assets/img/doctors-dashboard/profile-05.jpg" alt="User Image" />
                                    </a>
                                    <div class="patient-info">
                                        <p>#Apt0005</p>
                                        <h6>
                                            <a href="doctor-cancelled-appointment.html">Robert</a>
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="appointment-info">
                                <p>
                                    <i class="isax isax-clock5"></i>10 Oct 2024 11.30 AM
                                </p>
                                <ul class="d-flex apponitment-types">
                                    <li>General Visit</li>
                                    <li>Chat</li>
                                </ul>
                            </li>
                            <li class="appointment-detail-btn">
                                <a href="doctor-cancelled-appointment.html" class="start-link">View Details</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Appointment List -->

                    <!-- Appointment List -->
                    <div class="appointment-wrap">
                        <ul>
                            <li>
                                <div class="patinet-information">
                                    <a href="doctor-cancelled-appointment.html">
                                        <img src="assets/img/doctors-dashboard/profile-06.jpg" alt="User Image" />
                                    </a>
                                    <div class="patient-info">
                                        <p>#Apt0006</p>
                                        <h6>
                                            <a href="doctor-cancelled-appointment.html">Anderea</a>
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="appointment-info">
                                <p>
                                    <i class="isax isax-clock5"></i>26 Sep 2024 10.20 AM
                                </p>
                                <ul class="d-flex apponitment-types">
                                    <li>General Visit</li>
                                    <li>Chat</li>
                                </ul>
                            </li>
                            <li class="appointment-detail-btn">
                                <a href="doctor-cancelled-appointment.html" class="start-link">View Details</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Appointment List -->

                    <!-- Appointment List -->
                    <div class="appointment-wrap">
                        <ul>
                            <li>
                                <div class="patinet-information">
                                    <a href="doctor-cancelled-appointment.html">
                                        <img src="assets/img/doctors-dashboard/profile-07.jpg" alt="User Image" />
                                    </a>
                                    <div class="patient-info">
                                        <p>#Apt0007</p>
                                        <h6>
                                            <a href="doctor-cancelled-appointment.html">Peter</a>
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="appointment-info">
                                <p>
                                    <i class="isax isax-clock5"></i>14 Sep 2024 08.10 AM
                                </p>
                                <ul class="d-flex apponitment-types">
                                    <li>General Visit</li>
                                    <li>Chat</li>
                                </ul>
                            </li>
                            <li class="appointment-detail-btn">
                                <a href="doctor-cancelled-appointment.html" class="start-link">View Details</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Appointment List -->

                    <!-- Appointment List -->
                    <div class="appointment-wrap">
                        <ul>
                            <li>
                                <div class="patinet-information">
                                    <a href="doctor-cancelled-appointment.html">
                                        <img src="assets/img/doctors-dashboard/profile-08.jpg" alt="User Image" />
                                    </a>
                                    <div class="patient-info">
                                        <p>#Apt0008</p>
                                        <h6>
                                            <a href="doctor-cancelled-appointment.html">Emily</a>
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="appointment-info">
                                <p>
                                    <i class="isax isax-clock5"></i>03 Sep 2024 06.00 PM
                                </p>
                                <ul class="d-flex apponitment-types">
                                    <li>General Visit</li>
                                    <li>Video Call</li>
                                </ul>
                            </li>
                            <li class="appointment-detail-btn">
                                <a href="doctor-cancelled-appointment.html" class="start-link">View Details</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Appointment List -->

                    <!-- Pagination -->
                    <div class="pagination dashboard-pagination">
                        <ul>
                            <li>
                                <a href="#" class="page-link"><i class="fa-solid fa-chevron-left"></i></a>
                            </li>
                            <li>
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li>
                                <a href="#" class="page-link active">2</a>
                            </li>
                            <li>
                                <a href="#" class="page-link">3</a>
                            </li>
                            <li>
                                <a href="#" class="page-link">4</a>
                            </li>
                            <li>
                                <a href="#" class="page-link">...</a>
                            </li>
                            <li>
                                <a href="#" class="page-link"><i class="fa-solid fa-chevron-right"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Pagination -->
                </div>
                <div class="tab-pane fade" id="pills-complete" role="tabpanel" aria-labelledby="pills-complete-tab">
                    <!-- Appointment List -->
                    <div class="appointment-wrap">
                        <ul>
                            <li>
                                <div class="patinet-information">
                                    <a href="doctor-completed-appointment.html">
                                        <img src="assets/img/doctors-dashboard/profile-01.jpg" alt="User Image" />
                                    </a>
                                    <div class="patient-info">
                                        <p>#Apt0001</p>
                                        <h6>
                                            <a href="doctor-completed-appointment.html">Adrian</a>
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="appointment-info">
                                <p>
                                    <i class="isax isax-clock5"></i>11 Nov 2024 10.45 AM
                                </p>
                                <ul class="d-flex apponitment-types">
                                    <li>General Visit</li>
                                    <li>Video Call</li>
                                </ul>
                            </li>
                            <li class="appointment-detail-btn">
                                <a href="doctor-completed-appointment.html" class="start-link">View Details</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Appointment List -->

                    <!-- Appointment List -->
                    <div class="appointment-wrap">
                        <ul>
                            <li>
                                <div class="patinet-information">
                                    <a href="doctor-completed-appointment.html">
                                        <img src="assets/img/doctors-dashboard/profile-02.jpg" alt="User Image" />
                                    </a>
                                    <div class="patient-info">
                                        <p>#Apt0002</p>
                                        <h6>
                                            <a href="doctor-completed-appointment.html">Kelly</a><span
                                                class="badge new-tag">New</span>
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="appointment-info">
                                <p>
                                    <i class="isax isax-clock5"></i>05 Nov 2024 11.50 AM
                                </p>
                                <ul class="d-flex apponitment-types">
                                    <li>General Visit</li>
                                    <li>Audio Call</li>
                                </ul>
                            </li>
                            <li class="appointment-detail-btn">
                                <a href="doctor-completed-appointment.html" class="start-link">View Details</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Appointment List -->

                    <!-- Appointment List -->
                    <div class="appointment-wrap">
                        <ul>
                            <li>
                                <div class="patinet-information">
                                    <a href="doctor-completed-appointment.html">
                                        <img src="assets/img/doctors-dashboard/profile-03.jpg" alt="User Image" />
                                    </a>
                                    <div class="patient-info">
                                        <p>#Apt0003</p>
                                        <h6>
                                            <a href="doctor-completed-appointment.html">Samuel</a>
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="appointment-info">
                                <p>
                                    <i class="isax isax-clock5"></i>27 Oct 2024 09.30 AM
                                </p>
                                <ul class="d-flex apponitment-types">
                                    <li>General Visit</li>
                                    <li>Video Call</li>
                                </ul>
                            </li>
                            <li class="appointment-detail-btn">
                                <a href="doctor-completed-appointment.html" class="start-link">View Details</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Appointment List -->

                    <!-- Appointment List -->
                    <div class="appointment-wrap">
                        <ul>
                            <li>
                                <div class="patinet-information">
                                    <a href="doctor-completed-appointment.html">
                                        <img src="assets/img/doctors-dashboard/profile-04.jpg" alt="User Image" />
                                    </a>
                                    <div class="patient-info">
                                        <p>#Apt0004</p>
                                        <h6>
                                            <a href="doctor-completed-appointment.html">Catherine</a>
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="appointment-info">
                                <p>
                                    <i class="isax isax-clock5"></i>18 Oct 2024 12.20 PM
                                </p>
                                <ul class="d-flex apponitment-types">
                                    <li>General Visit</li>
                                    <li>Direct Visit</li>
                                </ul>
                            </li>
                            <li class="appointment-detail-btn">
                                <a href="doctor-completed-appointment.html" class="start-link">View Details</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Appointment List -->

                    <!-- Appointment List -->
                    <div class="appointment-wrap">
                        <ul>
                            <li>
                                <div class="patinet-information">
                                    <a href="doctor-completed-appointment.html">
                                        <img src="assets/img/doctors-dashboard/profile-05.jpg" alt="User Image" />
                                    </a>
                                    <div class="patient-info">
                                        <p>#Apt0005</p>
                                        <h6>
                                            <a href="doctor-completed-appointment.html">Robert</a>
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="appointment-info">
                                <p>
                                    <i class="isax isax-clock5"></i>10 Oct 2024 11.30 AM
                                </p>
                                <ul class="d-flex apponitment-types">
                                    <li>General Visit</li>
                                    <li>Chat</li>
                                </ul>
                            </li>
                            <li class="appointment-detail-btn">
                                <a href="doctor-completed-appointment.html" class="start-link">View Details</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Appointment List -->

                    <!-- Appointment List -->
                    <div class="appointment-wrap">
                        <ul>
                            <li>
                                <div class="patinet-information">
                                    <a href="doctor-completed-appointment.html">
                                        <img src="assets/img/doctors-dashboard/profile-06.jpg" alt="User Image" />
                                    </a>
                                    <div class="patient-info">
                                        <p>#Apt0006</p>
                                        <h6>
                                            <a href="doctor-completed-appointment.html">Anderea</a>
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="appointment-info">
                                <p>
                                    <i class="isax isax-clock5"></i>26 Sep 2024 10.20 AM
                                </p>
                                <ul class="d-flex apponitment-types">
                                    <li>General Visit</li>
                                    <li>Chat</li>
                                </ul>
                            </li>
                            <li class="appointment-detail-btn">
                                <a href="doctor-completed-appointment.html" class="start-link">View Details</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Appointment List -->

                    <!-- Appointment List -->
                    <div class="appointment-wrap">
                        <ul>
                            <li>
                                <div class="patinet-information">
                                    <a href="doctor-completed-appointment.html">
                                        <img src="assets/img/doctors-dashboard/profile-07.jpg" alt="User Image" />
                                    </a>
                                    <div class="patient-info">
                                        <p>#Apt0007</p>
                                        <h6>
                                            <a href="doctor-completed-appointment.html">Peter</a>
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="appointment-info">
                                <p>
                                    <i class="isax isax-clock5"></i>14 Sep 2024 08.10 AM
                                </p>
                                <ul class="d-flex apponitment-types">
                                    <li>General Visit</li>
                                    <li>Chat</li>
                                </ul>
                            </li>
                            <li class="appointment-detail-btn">
                                <a href="doctor-completed-appointment.html" class="start-link">View Details</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Appointment List -->

                    <!-- Appointment List -->
                    <div class="appointment-wrap">
                        <ul>
                            <li>
                                <div class="patinet-information">
                                    <a href="doctor-completed-appointment.html">
                                        <img src="assets/img/doctors-dashboard/profile-08.jpg" alt="User Image" />
                                    </a>
                                    <div class="patient-info">
                                        <p>#Apt0008</p>
                                        <h6>
                                            <a href="doctor-completed-appointment.html">Emily</a>
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="appointment-info">
                                <p>
                                    <i class="isax isax-clock5"></i>03 Sep 2024 06.00 PM
                                </p>
                                <ul class="d-flex apponitment-types">
                                    <li>General Visit</li>
                                    <li>Video Call</li>
                                </ul>
                            </li>
                            <li class="appointment-detail-btn">
                                <a href="doctor-completed-appointment.html" class="start-link">View Details</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Appointment List -->

                    <!-- Pagination -->
                    <div class="pagination dashboard-pagination">
                        <ul>
                            <li>
                                <a href="#" class="page-link"><i class="fa-solid fa-chevron-left"></i></a>
                            </li>
                            <li>
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li>
                                <a href="#" class="page-link active">2</a>
                            </li>
                            <li>
                                <a href="#" class="page-link">3</a>
                            </li>
                            <li>
                                <a href="#" class="page-link">4</a>
                            </li>
                            <li>
                                <a href="#" class="page-link">...</a>
                            </li>
                            <li>
                                <a href="#" class="page-link"><i class="fa-solid fa-chevron-right"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Pagination -->
                </div> --}}
                </div>
            </div>
        </div>
    </div>


@endsection
