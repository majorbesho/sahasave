@extends('frontend.layouts.master')


@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="text-center col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-1.html"><i class="isax isax-home-15"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Doctor</li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <h2 class="breadcrumb-title">Dashboard</h2>
                    </nav>
                </div>
            </div>
        </div>
        <div class="breadcrumb-bg">
            <img src="{{ asset('frontend/x/assets/img/bg/breadcrumb-bg-01.png" alt="img') }}" class="breadcrumb-bg-01">
            <img src="{{ asset('frontend/x/assets/img/bg/breadcrumb-bg-02.png" alt="img') }}" class="breadcrumb-bg-02">
            <img src="{{ asset('frontend/x/assets/img/bg/breadcrumb-icon.png" alt="img') }}" class="breadcrumb-bg-03">
            <img src="{{ asset('frontend/x/assets/img/bg/breadcrumb-icon.png" alt="img') }}" class="breadcrumb-bg-04">
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">

            <div class="row">



                @include('doctor.layouts.slide')



                <div class="col-lg-8 col-xl-9">

                    <div class="row">
                        <div class="col-xl-4 d-flex">
                            <div class="dashboard-box-col w-100">
                                <div class="dashboard-widget-box">

                                    <div class="dashboard-content-info">
                                        <h6>Total Patient</h6>
                                        <h4>{{ $totalPatientsCount }}</h4>
                                        {{-- منطق النسبة المئوية يمكن إضافته لاحقاً --}}
                                    </div>
                                    <!-- ... -->


                                    {{-- <div class="dashboard-content-info">
                                        <h6>Total Patient</h6>
                                        <h4>978</h4>
                                        <span class="text-success"><i class="fa-solid fa-arrow-up"></i>15% From Last
                                            Week</span>
                                    </div> --}}
                                    <div class="dashboard-widget-icon">
                                        <span class="dash-icon-box"><i class="fa-solid fa-user-injured"></i></span>
                                    </div>
                                </div>
                                <div class="dashboard-widget-box">
                                    <div class="dashboard-content-info">
                                        <h6>Patients Today</h6>
                                        <h4>80</h4>
                                        <span class="text-danger"><i class="fa-solid fa-arrow-up"></i>15% From
                                            Yesterday</span>
                                    </div>
                                    <div class="dashboard-widget-icon">
                                        <span class="dash-icon-box"><i class="fa-solid fa-user-clock"></i></span>
                                    </div>
                                </div>

                                <div class="dashboard-widget-box">

                                    <div class="dashboard-content-info">
                                        <h6>Appointments Today</h6>
                                        <h4>{{ $todayAppointmentsCount }}</h4>
                                    </div>

                                    {{-- <div class="dashboard-content-info">
                                        <h6>Appointments Today</h6>
                                        <h4>50</h4>
                                        <span class="text-success"><i class="fa-solid fa-arrow-up"></i>20% From
                                            Yesterday</span>
                                    </div> --}}
                                    <div class="dashboard-widget-icon">
                                        <span class="dash-icon-box"><i class="fa-solid fa-calendar-days"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 d-flex">
                            <div class="dashboard-card w-100">
                                <div class="dashboard-card-head">
                                    <div class="header-title">
                                        <h5>Appointment</h5>
                                    </div>
                                    <div class="dropdown header-dropdown">
                                        <a class="dropdown-toggle nav-tog" data-bs-toggle="dropdown"
                                            href="javascript:void(0);">
                                            Last 7 Days
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Today
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                This Month
                                            </a>
                                            <a href="javascript:void(0);" class="dropdown-item">
                                                Last 7 Days
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <div class="dashboard-card-body">
                                    <!-- ... -->
                                    <table class="table dashboard-table appoint-table">
                                        <tbody>
                                            @forelse($upcomingAppointments as $appointment)
                                                <tr>
                                                    <td>
                                                        <div class="patient-info-profile">
                                                            <a href="#" class="table-avatar">
                                                                {{-- يمكنك استخدام أول حرف من اسم المريض كصورة مؤقتة --}}
                                                                <img src="{{ $appointment->patient->photo ?? asset('assets/img/default-avatar.png') }}"
                                                                    alt="Patient Img">
                                                            </a>
                                                            <div class="patient-name-info">
                                                                <span>#Apt{{ str_pad($appointment->id, 4, '0', STR_PAD_LEFT) }}</span>
                                                                <h5><a href="#">{{ $appointment->patient->name }}</a>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="appointment-date-created">
                                                            <h6>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('d M Y h:i A') }}
                                                            </h6>
                                                            {{-- يمكنك إضافة نوع الاستشارة لاحقاً --}}
                                                            <span class="badge table-badge">General</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="apponiment-actions d-flex align-items-center">
                                                            {{-- أضف الروابط الصحيحة هنا --}}
                                                            <a href="#" class="text-success-icon me-2"><i
                                                                    class="fa-solid fa-check"></i></a>
                                                            <a href="#" class="text-danger-icon"><i
                                                                    class="fa-solid fa-xmark"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">No upcoming appointments.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <!-- ... -->

                                    {{-- <div class="table-responsive">
                                        <table class="table dashboard-table appoint-table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="patient-info-profile">
                                                            <a href="appointments-1.html" class="table-avatar">
                                                                <img src="assets/img/doctors-dashboard/profile-01.jpg"
                                                                    alt="Img">
                                                            </a>
                                                            <div class="patient-name-info">
                                                                <span>#Apt0001</span>
                                                                <h5><a href="appointments-1.html">Adrian Marshall</a></h5>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <div class="appointment-date-created">
                                                            <h6>11 Nov 2024 10.45 AM</h6>
                                                            <span class="badge table-badge">General</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="apponiment-actions d-flex align-items-center">
                                                            <a href="#" class="text-success-icon me-2"><i
                                                                    class="fa-solid fa-check"></i></a>
                                                            <a href="#" class="text-danger-icon"><i
                                                                    class="fa-solid fa-xmark"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="patient-info-profile">
                                                            <a href="appointments-1.html" class="table-avatar">
                                                                <img src="assets/img/doctors-dashboard/profile-02.jpg"
                                                                    alt="Img">
                                                            </a>
                                                            <div class="patient-name-info">
                                                                <span>#Apt0002</span>
                                                                <h5><a href="appointments-1.html">Kelly Stevens</a></h5>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <div class="appointment-date-created">
                                                            <h6>10 Nov 2024 11.00 AM</h6>
                                                            <span class="badge table-badge">Clinic Consulting</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="apponiment-actions d-flex align-items-center">
                                                            <a href="#" class="text-success-icon me-2"><i
                                                                    class="fa-solid fa-check"></i></a>
                                                            <a href="#" class="text-danger-icon"><i
                                                                    class="fa-solid fa-xmark"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="patient-info-profile">
                                                            <a href="appointments-1.html" class="table-avatar">
                                                                <img src="assets/img/doctors-dashboard/profile-03.jpg"
                                                                    alt="Img">
                                                            </a>
                                                            <div class="patient-name-info">
                                                                <span>#Apt0003</span>
                                                                <h5><a href="appointments-1.html">Samuel Anderson</a></h5>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <div class="appointment-date-created">
                                                            <h6>03 Nov 2024 02.00 PM</h6>
                                                            <span class="badge table-badge">General</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="apponiment-actions d-flex align-items-center">
                                                            <a href="#" class="text-success-icon me-2"><i
                                                                    class="fa-solid fa-check"></i></a>
                                                            <a href="#" class="text-danger-icon"><i
                                                                    class="fa-solid fa-xmark"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="patient-info-profile">
                                                            <a href="appointments-1.html" class="table-avatar">
                                                                <img src="assets/img/doctors-dashboard/profile-04.jpg"
                                                                    alt="Img">
                                                            </a>
                                                            <div class="patient-name-info">
                                                                <span>#Apt0004</span>
                                                                <h5><a href="appointments-1.html">Catherine Griffin</a>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <div class="appointment-date-created">
                                                            <h6>01 Nov 2024 04.00 PM</h6>
                                                            <span class="badge table-badge">Clinic Consulting</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="apponiment-actions d-flex align-items-center">
                                                            <a href="#" class="text-success-icon me-2"><i
                                                                    class="fa-solid fa-check"></i></a>
                                                            <a href="#" class="text-danger-icon"><i
                                                                    class="fa-solid fa-xmark"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="patient-info-profile">
                                                            <a href="appointments-1.html" class="table-avatar">
                                                                <img src="assets/img/doctors-dashboard/profile-05.jpg"
                                                                    alt="Img">
                                                            </a>
                                                            <div class="patient-name-info">
                                                                <span>#Apt0005</span>
                                                                <h5><a href="appointments-1.html">Robert Hutchinson</a>
                                                                </h5>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <div class="appointment-date-created">
                                                            <h6>28 Oct 2024 05.30 PM</h6>
                                                            <span class="badge table-badge">General</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="apponiment-actions d-flex align-items-center">
                                                            <a href="#" class="text-success-icon me-2"><i
                                                                    class="fa-solid fa-check"></i></a>
                                                            <a href="#" class="text-danger-icon"><i
                                                                    class="fa-solid fa-xmark"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> --}}
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-5 d-flex">
                            <div class="dashboard-chart-col w-100">
                                <div class="dashboard-card w-100">
                                    <div class="border-0 dashboard-card-head">
                                        <div class="header-title">
                                            <h5>Weekly Overview</h5>
                                        </div>
                                        <div class="chart-create-date">
                                            <h6>Mar 14 - Mar 21</h6>
                                        </div>
                                    </div>
                                    <div class="dashboard-card-body">
                                        <div class="chart-tab">
                                            <ul class="nav nav-pills product-licence-tab" id="pills-tab2" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="pills-revenue-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-revenue" type="button"
                                                        role="tab" aria-controls="pills-revenue"
                                                        aria-selected="false">Revenue</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="pills-appointment-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-appointment"
                                                        type="button" role="tab" aria-controls="pills-appointment"
                                                        aria-selected="true">Appointments</button>
                                                </li>
                                            </ul>
                                            <div class="tab-content w-100" id="v-pills-tabContent">
                                                <div class="tab-pane fade show active" id="pills-revenue" role="tabpanel"
                                                    aria-labelledby="pills-revenue-tab">
                                                    <div id="revenue-chart"></div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-appointment" role="tabpanel"
                                                    aria-labelledby="pills-appointment-tab">
                                                    <div id="appointment-chart"></div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="dashboard-card w-100">
                                    <div class="dashboard-card-head">
                                        <div class="header-title">
                                            <h5>Recent Patients</h5>
                                        </div>
                                        <div class="card-view-link">
                                            <a href="my-patients-1.html">View All</a>
                                        </div>
                                    </div>
                                    <div class="dashboard-card-body">
                                        <div class="d-flex recent-patient-grid-boxes">
                                            <div class="recent-patient-grid">
                                                <a href="patient-details.html" class="patient-img">
                                                    <img src="assets/img/doctors-dashboard/profile-01.jpg" alt="Img">
                                                </a>
                                                <h5><a href="patient-details.html">Adrian Marshall</a></h5>
                                                <span>Patient ID : P0001</span>
                                                <div class="date-info">
                                                    <p>Last Appointment
                                                        15 Mar 2024</p>
                                                </div>
                                            </div>
                                            <div class="recent-patient-grid">
                                                <a href="patient-details.html" class="patient-img">
                                                    <img src="assets/img/doctors-dashboard/profile-02.jpg" alt="Img">
                                                </a>
                                                <h5><a href="patient-details.html">Kelly Stevens</a></h5>
                                                <span>Patient ID : P0002</span>
                                                <div class="date-info">
                                                    <p>Last Appointment
                                                        13 Mar 2024</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 d-flex">
                            <div class="dashboard-main-col w-100">
                                <div class="upcoming-appointment-card">
                                    <div class="title-card">
                                        <h5>Upcoming Appointment</h5>
                                    </div>
                                    <div class="upcoming-patient-info">
                                        <div class="info-details">
                                            <span class="img-avatar"><img
                                                    src="assets/img/doctors-dashboard/profile-01.jpg"
                                                    alt="Img"></span>
                                            <div class="name-info">
                                                <span>#Apt0001</span>
                                                <h6>Adrian Marshall</h6>
                                            </div>

                                        </div>
                                        <div class="date-details">
                                            <span>General visit</span>
                                            <h6>Today, 10:45 AM</h6>
                                        </div>
                                        <div class="circle-bg">
                                            <img src="assets/img/bg/dashboard-circle-bg.png" alt="Img">
                                        </div>
                                    </div>
                                    <div class="appointment-card-footer">
                                        <h5><i class="fa-solid fa-video"></i>Video Appointment</h5>
                                        <div class="btn-appointments">
                                            <a href="chat-doctor-1.html" class="btn">Chat Now</a>
                                            <a href="doctor-appointment-start.html" class="btn">Start Appointment</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="dashboard-card w-100">
                                    <div class="dashboard-card-head">
                                        <div class="header-title">
                                            <h5>Recent Invoices</h5>
                                        </div>
                                        <div class="card-view-link">
                                            <a href="invoices-1.html">View All</a>
                                        </div>
                                    </div>
                                    <div class="dashboard-card-body">
                                        <div class="table-responsive">
                                            <table class="table dashboard-table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="patient-info-profile">
                                                                <a href="invoices-1.html" class="table-avatar">
                                                                    <img src="assets/img/doctors-dashboard/profile-01.jpg"
                                                                        alt="Img">
                                                                </a>
                                                                <div class="patient-name-info">
                                                                    <h5><a href="invoices-1.html">Adrian</a></h5>
                                                                    <span>#Apt0001</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="appointment-date-created">
                                                                <span class="paid-text">Amount</span>
                                                                <h6>$450</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="appointment-date-created">
                                                                <span class="paid-text">Paid On</span>
                                                                <h6>11 Nov 2024</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="apponiment-view d-flex align-items-center">
                                                                <a href="invoice-view-1.html"><i
                                                                        class="isax isax-eye4"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="patient-info-profile">
                                                                <a href="#" class="table-avatar">
                                                                    <img src="assets/img/doctors-dashboard/profile-02.jpg"
                                                                        alt="Img">
                                                                </a>
                                                                <div class="patient-name-info">
                                                                    <h5><a href="#">Kelly</a></h5>
                                                                    <span>#Apt0002</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="appointment-date-created">
                                                                <span class="paid-text">Paid On</span>
                                                                <h6>10 Nov 2024</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="appointment-date-created">
                                                                <span class="paid-text">Amount</span>
                                                                <h6>$500</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="apponiment-view d-flex align-items-center">
                                                                <a href="#"><i class="isax isax-eye4"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="patient-info-profile">
                                                                <a href="#" class="table-avatar">
                                                                    <img src="assets/img/doctors-dashboard/profile-03.jpg"
                                                                        alt="Img">
                                                                </a>
                                                                <div class="patient-name-info">
                                                                    <h5><a href="#">Samuel</a></h5>
                                                                    <span>#Apt0003</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="appointment-date-created">
                                                                <span class="paid-text">Paid On</span>
                                                                <h6>03 Nov 2024</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="appointment-date-created">
                                                                <span class="paid-text">Amount</span>
                                                                <h6>$320</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="apponiment-view d-flex align-items-center">
                                                                <a href="#"><i class="isax isax-eye4"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="patient-info-profile">
                                                                <a href="#" class="table-avatar">
                                                                    <img src="assets/img/doctors-dashboard/profile-04.jpg"
                                                                        alt="Img">
                                                                </a>
                                                                <div class="patient-name-info">
                                                                    <h5><a href="#">Catherine</a></h5>
                                                                    <span>#Apt0004</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="appointment-date-created">
                                                                <span class="paid-text">Paid On</span>
                                                                <h6>01 Nov 2024</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="appointment-date-created">
                                                                <span class="paid-text">Amount</span>
                                                                <h6>$240</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="apponiment-view d-flex align-items-center">
                                                                <a href="#"><i class="isax isax-eye4"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="patient-info-profile">
                                                                <a href="#" class="table-avatar">
                                                                    <img src="assets/img/doctors-dashboard/profile-05.jpg"
                                                                        alt="Img">
                                                                </a>
                                                                <div class="patient-name-info">
                                                                    <h5><a href="#">Robert</a></h5>
                                                                    <span>#Apt0005</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="appointment-date-created">
                                                                <span class="paid-text">Paid On</span>
                                                                <h6>28 Oct 2024</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="appointment-date-created">
                                                                <span class="paid-text">Amount</span>
                                                                <h6>$380</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="apponiment-view d-flex align-items-center">
                                                                <a href="#"><i class="isax isax-eye4"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-7 d-flex">
                            <div class="dashboard-card w-100">
                                <div class="dashboard-card-head">
                                    <div class="header-title">
                                        <h5>Notifications</h5>
                                    </div>
                                    <div class="card-view-link">
                                        <a href="#">View All</a>
                                    </div>
                                </div>
                                <div class="dashboard-card-body">
                                    <div class="table-responsive">
                                        <table class="table dashboard-table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="table-noti-info">
                                                            <div class="table-noti-icon color-violet">
                                                                <i class="fa-solid fa-bell"></i>
                                                            </div>

                                                            <div class="table-noti-message">
                                                                <h6><a href="#">Booking Confirmed on <span> 21 Mar
                                                                            2024 </span> 10:30 AM</a></h6>
                                                                <span class="message-time">Just Now</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="table-noti-info">
                                                            <div class="table-noti-icon color-blue">
                                                                <i class="fa-solid fa-star"></i>
                                                            </div>

                                                            <div class="table-noti-message">
                                                                <h6><a href="#">You have a <span> New </span> Review
                                                                        for your Appointment </a></h6>
                                                                <span class="message-time">5 Days ago</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="table-noti-info">
                                                            <div class="table-noti-icon color-red">
                                                                <i class="fa-solid fa-calendar-check"></i>
                                                            </div>

                                                            <div class="table-noti-message">
                                                                <h6><a href="#">You have Appointment with <span>
                                                                            Ahmed </span> by 01:20 PM </a></h6>
                                                                <span class="message-time">12:55 PM</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="table-noti-info">
                                                            <div class="table-noti-icon color-yellow">
                                                                <i class="fa-solid fa-money-bill-1-wave"></i>
                                                            </div>

                                                            <div class="table-noti-message">
                                                                <h6><a href="#">Sent an amount of <span> $200 </span>
                                                                        for an Appointment by 01:20 PM </a></h6>
                                                                <span class="message-time">2 Days ago</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="table-noti-info">
                                                            <div class="table-noti-icon color-blue">
                                                                <i class="fa-solid fa-star"></i>
                                                            </div>

                                                            <div class="table-noti-message">
                                                                <h6><a href="#">You have a <span> New </span> Review
                                                                        for your Appointment </a></h6>
                                                                <span class="message-time">5 Days ago</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-5 d-flex">
                            <div class="dashboard-card w-100">
                                <div class="dashboard-card-head">
                                    <div class="header-title">
                                        <h5>Clinics & Availability</h5>
                                    </div>
                                </div>
                                <div class="dashboard-card-body">
                                    <div class="clinic-available">
                                        <div class="clinic-head">
                                            <div class="clinic-info">
                                                <span class="clinic-img">
                                                    <img src="assets/img/doctors-dashboard/clinic-02.jpg" alt="Img">
                                                </span>
                                                <h6>Sofi’s Clinic</h6>
                                            </div>
                                            <div class="clinic-charge">
                                                <span>$900</span>
                                            </div>
                                        </div>
                                        <div class="available-time">
                                            <ul>
                                                <li>
                                                    <span>Tue :</span>
                                                    07:00 AM - 09:00 PM
                                                </li>
                                                <li>
                                                    <span>Wed : </span>
                                                    07:00 AM - 09:00 PM
                                                </li>
                                            </ul>
                                            <div class="change-time">
                                                <a href="#">Change </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-0 clinic-available">
                                        <div class="clinic-head">
                                            <div class="clinic-info">
                                                <span class="clinic-img">
                                                    <img src="assets/img/doctors-dashboard/clinic-01.jpg" alt="Img">
                                                </span>
                                                <h6>The Family Dentistry Clinic</h6>
                                            </div>
                                            <div class="clinic-charge">
                                                <span>$600</span>
                                            </div>
                                        </div>
                                        <div class="available-time">
                                            <ul>
                                                <li>
                                                    <span>Sat :</span>
                                                    07:00 AM - 09:00 PM
                                                </li>
                                                <li>
                                                    <span>Tue : </span>
                                                    07:00 AM - 09:00 PM
                                                </li>
                                            </ul>
                                            <div class="change-time">
                                                <a href="#">Change </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->
@endsection
