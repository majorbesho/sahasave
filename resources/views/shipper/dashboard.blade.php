@extends('shipper.minlayout.master')


@section('content')
    <div class="col-lg-8 col-xl-9">
        <div class="dashboard-header">
            <h3>Trucker Dashboard</h3>
            <ul class="header-list-btns">
                <li>
                    <div class="dropdown header-dropdown">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                            <img src="assets/img/truck-drivers/profile-01.jpg" class="avatar dropdown-avatar"
                                alt="Driver Photo">
                            Mohammed Al-Otaibi
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="assets/img/truck-drivers/profile-01.jpg" class="avatar dropdown-avatar"
                                    alt="Driver Photo">
                                Mohammed Al-Otaibi
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="assets/img/truck-drivers/profile-02.jpg" class="avatar dropdown-avatar"
                                    alt="Driver Photo">
                                Ahmed Al-Salem
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-xl-8 d-flex">
                <div class="dashboard-card w-100">
                    <div class="dashboard-card-head">
                        <div class="header-title">
                            <h5>Shipping Records</h5>
                        </div>
                    </div>
                    <div class="dashboard-card-body">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="health-records icon-orange">
                                            <span><i class="fa-solid fa-truck"></i>Total Shipments</span>
                                            <h3>140 Loads <sup> 2%</sup></h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="health-records icon-amber">
                                            <span><i class="fa-solid fa-gas-pump"></i>Fuel Consumption</span>
                                            <h3>37.5 L/100km</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="health-records icon-dark-blue">
                                            <span><i class="fa-solid fa-road"></i>Distance Covered</span>
                                            <h3>7,000 km<sup> 6%</sup></h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="health-records icon-blue">
                                            <span><i class="fa-solid fa-clock"></i>Average Time</span>
                                            <h3>48 Hours</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="health-records icon-red">
                                            <span><i class="fa-solid fa-weight-hanging"></i>Average Load</span>
                                            <h3>25 Tons<sup> 2%</sup></h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="health-records icon-purple">
                                            <span><i class="fa-solid fa-money-bill-wave"></i>Average Rate</span>
                                            <h3>$0.67/km</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="report-gen-date">
                                            <p>Last Updated: Mar 25, 2024 <span><i class="fa-solid fa-sync-alt"></i></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="chart-over-all-report">
                                    <h6>Overall Report</h6>
                                    <div class="circle-bar circle-bar3 report-chart">
                                        <div class="circle-graph3" data-percent="66">
                                            <p>Last Shipment<br>Mar 25, 2024</p>
                                        </div>
                                    </div>
                                    <span class="health-percentage">Your performance is 95% Excellent</span>
                                    <a href="shipment-details.html" class="btn btn-dark w-100 rounded-pill">View Details<i
                                            class="fa-solid fa-chevron-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 d-flex">
                <div class="favourites-dashboard w-100">
                    <div class="book-appointment-head">
                        <h3><span>Book a</span> New Shipment</h3>
                        <span class="add-icon"><a href="search-1.html"><i class="fa-solid fa-circle-plus"></i></a></span>
                    </div>
                    <div class="dashboard-card w-100">
                        <div class="dashboard-card-head">
                            <div class="header-title">
                                <h5>Favorite Carriers</h5>
                            </div>
                            <div class="card-view-link">
                                <a href="favourites-1.html">View All</a>
                            </div>
                        </div>
                        <div class="dashboard-card-body">
                            <div class="doctor-fav-list">
                                <div class="doctor-info-profile">
                                    <a href="#" class="table-avatar">
                                        <img src="assets/img/truck-companies/company-1.jpg" alt="Company Logo">
                                    </a>
                                    <div class="doctor-name-info">
                                        <h5><a href="#">Fast Transport Co.</a></h5>
                                        <span>General SahaSave.com</span>
                                    </div>
                                </div>
                                <a href="#" class="cal-plus-icon"><i class="isax isax-calendar5"></i></a>
                            </div>
                            <div class="doctor-fav-list">
                                <div class="doctor-info-profile">
                                    <a href="#" class="table-avatar">
                                        <img src="assets/img/truck-companies/company-2.jpg" alt="Company Logo">
                                    </a>
                                    <div class="doctor-name-info">
                                        <h5><a href="#">Arab Transport</a></h5>
                                        <span>Dry Van</span>
                                    </div>
                                </div>
                                <a href="#" class="cal-plus-icon"><i class="isax isax-calendar5"></i></a>
                            </div>
                            <div class="doctor-fav-list">
                                <div class="doctor-info-profile">
                                    <a href="#" class="table-avatar">
                                        <img src="assets/img/truck-companies/company-3.jpg" alt="Company Logo">
                                    </a>
                                    <div class="doctor-name-info">
                                        <h5><a href="#">Gulf Fleet</a></h5>
                                        <span>Reefer</span>
                                    </div>
                                </div>
                                <a href="#" class="cal-plus-icon"><i class="isax isax-calendar5"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-5 d-flex flex-column">
                <div class="dashboard-card flex-fill">
                    <div class="dashboard-card-head">
                        <div class="header-title">
                            <h5>Upcoming Shipments</h5>
                        </div>
                        <div class="card-view-link">
                            <div class="owl-nav slide-nav text-end nav-control"></div>
                        </div>
                    </div>
                    <div class="dashboard-card-body">
                        <div class="apponiment-dates">
                            <ul class="appointment-calender-slider owl-carousel">
                                <li>
                                    <a href="#">
                                        <h5>19 <span>Mon</span></h5>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h5>20 <span>Tue</span></h5>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="available-date">
                                        <h5>21 <span>Wed</span></h5>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="available-date">
                                        <h5>22 <span>Thu</span></h5>
                                    </a>
                                </li>
                            </ul>
                            <div class="appointment-dash-card">
                                <div class="doctor-fav-list">
                                    <div class="doctor-info-profile">
                                        <a href="#" class="table-avatar">
                                            <img src="assets/img/truck-companies/company-4.jpg" alt="Company Logo">
                                        </a>
                                        <div class="doctor-name-info">
                                            <h5><a href="#">United Shipping</a></h5>
                                            <span class="fs-12 fw-medium">Auto Transport</span>
                                        </div>
                                    </div>
                                    <a href="#" class="cal-plus-icon"><i class="isax isax-truck5"></i></a>
                                </div>
                                <div class="date-time">
                                    <p><i class="isax isax-clock5"></i>Mar 21, 2024 - 10:30 AM</p>
                                </div>
                                <div class="card-btns gap-3">
                                    <a href="chat-1.html" class="btn btn-md btn-light rounded-pill"><i
                                            class="isax isax-messages-25"></i>Chat</a>
                                    <a href="patient-appointments.html"
                                        class="btn btn-md btn-primary-gradient rounded-pill"><i
                                            class="isax isax-calendar-tick5"></i>Confirm</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card flex-fill">
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
                                                    <h6><a href="#">Shipment confirmed <span>Mar 21, 2024</span>
                                                            10:30 AM</a></h6>
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
                                                    <h6><a href="#">New rating for your last shipment</a></h6>
                                                    <span class="message-time">5 days ago</span>
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

            <div class="col-xl-7 d-flex flex-column">
                <div class="dashboard-card flex-fill">
                    <div class="dashboard-card-head">
                        <div class="header-title">
                            <h5>Shipping Analytics</h5>
                        </div>
                        <div class="dropdown-links d-flex align-items-center flex-wrap">
                            <div class="dropdown header-dropdown header-dropdown-two">
                                <a class="dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);">
                                    Mar 14 - Mar 21
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item">This Week</a>
                                    <a href="javascript:void(0);" class="dropdown-item">This Month</a>
                                    <a href="javascript:void(0);" class="dropdown-item">This Year</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-card-body pb-1">
                        <div class="chart-tabs">
                            <ul class="nav" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" href="#" data-bs-toggle="tab"
                                        data-bs-target="#fuel-consumption" aria-selected="false" role="tab"
                                        tabindex="-1">Fuel Consumption</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="#" data-bs-toggle="tab"
                                        data-bs-target="#delivery-time" aria-selected="true" role="tab">Delivery
                                        Time</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content pt-0">
                            <div class="tab-pane fade active show" id="fuel-consumption" role="tabpanel">
                                <div id="fuel-consumption-chart"></div>
                            </div>
                            <div class="tab-pane fade" id="delivery-time" role="tabpanel">
                                <div id="delivery-time-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card flex-fill">
                    <div class="dashboard-card-head">
                        <div class="header-title">
                            <h5>Past Shipments</h5>
                        </div>
                        <div class="card-view-link">
                            <div class="owl-nav slide-nav2 text-end nav-control"></div>
                        </div>
                    </div>
                    <div class="dashboard-card-body">
                        <div class="past-appointments-slider owl-carousel">
                            <div class="appointment-dash-card past-appointment mt-0">
                                <div class="doctor-fav-list">
                                    <div class="doctor-info-profile">
                                        <a href="#" class="table-avatar">
                                            <img src="assets/img/truck-companies/company-5.jpg" alt="Company Logo">
                                        </a>
                                        <div class="doctor-name-info">
                                            <h5><a href="#">Express Transport</a></h5>
                                            <span>Expedited SahaSave.com</span>
                                        </div>
                                    </div>
                                    <span class="bg-orange badge"><i class="isax isax-truck5 me-1"></i>3 Days</span>
                                </div>
                                <div class="appointment-date-info">
                                    <h6>Thursday, Mar 14, 2024</h6>
                                    <ul>
                                        <li>
                                            <span><i class="isax isax-clock5"></i></span>Time: 04:00 PM - 07:00 PM
                                        </li>
                                        <li>
                                            <span><i class="isax isax-location5"></i></span>Riyadh → Jeddah
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-btns">
                                    <a href="patient-appointments.html"
                                        class="btn btn-md btn-outline-primary ms-0 me-3 rounded-pill">Reschedule</a>
                                    <a href="patient-appointment-details.html"
                                        class="btn btn-md btn-primary-gradient rounded-pill">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card flex-fill">
                    <div class="dashboard-card-head">
                        <div class="header-title">
                            <h5>My Vehicles</h5>
                        </div>
                        <div class="card-view-link">
                            <a href="#" class="add-new" data-bs-toggle="modal" data-bs-target="#add_vehicle"><i
                                    class="fa-solid fa-circle-plus me-1"></i>Add Vehicle</a>
                            <a href="vehicles.html">View All</a>
                        </div>
                    </div>
                    <div class="dashboard-card-body">
                        <div class="doctor-fav-list">
                            <div class="doctor-info-profile">
                                <a href="#" class="table-avatar">
                                    <img src="assets/img/trucks/truck-1.jpg" alt="Truck Photo">
                                </a>
                                <div class="doctor-name-info">
                                    <h5><a href="#">Volvo Truck</a></h5>
                                    <span>Plate: 1234 ABC</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="#" class="cal-plus-icon me-2"><i class="isax isax-gas-station5"></i></a>
                                <a href="dependent.html" class="cal-plus-icon"><i class="isax isax-eye4"></i></a>
                            </div>
                        </div>
                        <div class="doctor-fav-list">
                            <div class="doctor-info-profile">
                                <a href="#" class="table-avatar">
                                    <img src="assets/img/trucks/truck-2.jpg" alt="Truck Photo">
                                </a>
                                <div class="doctor-name-info">
                                    <h5><a href="#">Flatbed Trailer</a></h5>
                                    <span>Plate: 5678 DEF</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="#" class="cal-plus-icon me-2"><i class="isax isax-gas-station5"></i></a>
                                <a href="dependent.html" class="cal-plus-icon"><i class="isax isax-eye4"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-xl-12 d-flex">
            <div class="dashboard-card w-100">
                <div class="dashboard-card-head">
                    <div class="header-title">
                        <h5>Reports</h5>
                    </div>
                </div>
                <div class="dashboard-card-body">
                    <div class="account-detail-table">
                        <!-- Tab Menu -->
                        <nav class="patient-dash-tab border-0 pb-0">
                            <ul class="nav nav-tabs-bottom">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#appoint-tab"
                                        data-bs-toggle="tab">Appointments</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#medical-tab"
                                        data-bs-toggle="tab">Medical
                                        Records</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#prsc-tab"
                                        data-bs-toggle="tab">Prescriptions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#invoice-tab"
                                        data-bs-toggle="tab">Invoices</a>
                                </li>
                            </ul>
                        </nav>
                        <!-- /Tab Menu -->

                        <!-- Tab Content -->
                        <div class="tab-content pt-0">

                            <!-- Appointments Tab -->
                            <div id="appoint-tab" class="tab-pane fade show active">
                                <div class="custom-new-table">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Doctor</th>
                                                    <th>Date</th>
                                                    <th>Type</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:void(0);"><span
                                                                class="link-primary">#AP1236</span></a>
                                                    </td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="doctor-profile-1.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/doctors/doctor-thumb-24-1.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="doctor-profile-1.html">Dr.
                                                                Robert
                                                                Womack</a>
                                                        </h2>
                                                    </td>
                                                    <td>21 Mar 2024, 10:30 AM</td>
                                                    <td>Video call</td>
                                                    <td>
                                                        <span
                                                            class="badge badge-xs p-2 badge-soft-purple inline-flex align-items-center"><i
                                                                class="fa-solid fa-circle me-1 fs-5"></i>Upcoming</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:void(0);"><span
                                                                class="link-primary">#AP3656</span></a>
                                                    </td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="doctor-profile-1.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/doctors/doctor-thumb-23-1.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="doctor-profile-1.html">Dr.
                                                                Patricia
                                                                Cassidy</a>
                                                        </h2>
                                                    </td>
                                                    <td>28 Mar 2024, 11:40 AM</td>
                                                    <td>Clinic Visit</td>
                                                    <td>
                                                        <span
                                                            class="badge badge-xs p-2 badge-soft-purple inline-flex align-items-center"><i
                                                                class="fa-solid fa-circle me-1 fs-5"></i>Completed</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:void(0);"><span
                                                                class="link-primary">#AP1246</span></a>
                                                    </td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="doctor-profile-1.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/doctors/doctor-thumb-22-1.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="doctor-profile-1.html">Dr.
                                                                Kevin Evans</a>
                                                        </h2>
                                                    </td>
                                                    <td>02 Apr 2024, 09:20 AM</td>
                                                    <td>Audio Call</td>
                                                    <td>
                                                        <span
                                                            class="badge badge-xs p-2 badge-soft-success inline-flex align-items-center"><i
                                                                class="fa-solid fa-circle me-1 fs-5"></i>Completed</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:void(0);"><span
                                                                class="link-primary">#AP6985</span></a>
                                                    </td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="doctor-profile-1.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/doctors/doctor-thumb-25.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="doctor-profile-1.html">Dr.
                                                                Lisa
                                                                Keating</a>
                                                        </h2>
                                                    </td>
                                                    <td>15 Apr 2024, 04:10 PM</td>
                                                    <td>Clinic Visit</td>
                                                    <td>
                                                        <span
                                                            class="badge badge-xs p-2 badge-soft-danger inline-flex align-items-center"><i
                                                                class="fa-solid fa-circle me-1 fs-5"></i>Cancelled</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:void(0);"><span
                                                                class="link-primary">#AP3659</span></a>
                                                    </td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="doctor-profile-1.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/doctors/doctor-thumb-26.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="doctor-profile-1.html">Dr.
                                                                John Hammer</a>
                                                        </h2>
                                                    </td>
                                                    <td>10 May 2024, 06:00 PM</td>
                                                    <td>Video Call</td>
                                                    <td>
                                                        <span
                                                            class="badge badge-xs p-2 badge-soft-purple inline-flex align-items-center"><i
                                                                class="fa-solid fa-circle me-1 fs-5"></i>Upcoming</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /Appointments Tab -->

                            <!-- Medical Records Tab -->
                            <div class="tab-pane fade" id="medical-tab">
                                <div class="custom-table">
                                    <div class="table-responsive">
                                        <table class="table table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Date</th>
                                                    <th>Record For</th>
                                                    <th>Comments</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="javascript:void(0);"
                                                            class="link-primary">#MR1236</a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"
                                                            class="lab-icon">Electro
                                                            cardiography</a>
                                                    </td>
                                                    <td>24 Mar 2024</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="paitent-details.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/doctors-dashboard/profile-06.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="paitent-details.html">Hendrita
                                                                Clark</a>
                                                        </h2>
                                                    </td>
                                                    <td>Take Good Rest</td>
                                                    <td>
                                                        <div class="action-item">
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#view_report">
                                                                <i class="isax isax-link-2"></i>
                                                            </a>
                                                            <a href="javascript:void(0);">
                                                                <i class="isax isax-import"></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete_modal">
                                                                <i class="isax isax-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0);"
                                                            class="link-primary">#MR3656</a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"
                                                            class="lab-icon">Complete Blood
                                                            Count</a>
                                                    </td>
                                                    <td>10 Apr 2024</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="paitent-details.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/dependent/dependent-01.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="paitent-details.html">Laura
                                                                Stewart</a>
                                                        </h2>
                                                    </td>
                                                    <td>Stable, no change</td>
                                                    <td>
                                                        <div class="action-item">
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#view_report">
                                                                <i class="isax isax-link-2"></i>
                                                            </a>
                                                            <a href="javascript:void(0);">
                                                                <i class="isax isax-import"></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete_modal">
                                                                <i class="isax isax-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0);"
                                                            class="link-primary">#MR1246</a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"
                                                            class="lab-icon">Blood
                                                            Glucose Test</a>
                                                    </td>
                                                    <td>19 Apr 2024</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="paitent-details.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/dependent/dependent-02.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="paitent-details.html">Mathew
                                                                Charles </a>
                                                        </h2>
                                                    </td>
                                                    <td>All Clear</td>
                                                    <td>
                                                        <div class="action-item">
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#view_report">
                                                                <i class="isax isax-link-2"></i>
                                                            </a>
                                                            <a href="javascript:void(0);">
                                                                <i class="isax isax-import"></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete_modal">
                                                                <i class="isax isax-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0);"
                                                            class="link-primary">#MR6985</a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"
                                                            class="lab-icon">Liver
                                                            Function Tests</a>
                                                    </td>
                                                    <td>27 Apr 2024</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="paitent-details.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/dependent/dependent-03.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="paitent-details.html">Christopher
                                                                Joseph</a>
                                                        </h2>
                                                    </td>
                                                    <td>Stable, no change</td>
                                                    <td>
                                                        <div class="action-item">
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#view_report">
                                                                <i class="isax isax-link-2"></i>
                                                            </a>
                                                            <a href="javascript:void(0);">
                                                                <i class="isax isax-import"></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete_modal">
                                                                <i class="isax isax-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#"
                                                            class="link-primary">#MR3659</a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"
                                                            class="lab-icon">Blood
                                                            Cultures</a>
                                                    </td>
                                                    <td>10 May 2024</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="paitent-details.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/dependent/dependent-04.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="paitent-details.html">Elisa
                                                                Salcedo</a>
                                                        </h2>
                                                    </td>
                                                    <td>Take Good Rest</td>
                                                    <td>
                                                        <div class="action-item">
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#view_report">
                                                                <i class="isax isax-link-2"></i>
                                                            </a>
                                                            <a href="javascript:void(0);">
                                                                <i class="isax isax-import"></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete_modal">
                                                                <i class="isax isax-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /Medical Records Tab -->

                            <!-- Prescriptions Tab -->
                            <div class="tab-pane fade" id="prsc-tab">
                                <div class="custom-table">
                                    <div class="table-responsive">
                                        <table class="table table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Date</th>
                                                    <th>Prescriped By</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="link-primary"><a href="#"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#view_prescription">#P1236</a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"
                                                            class="lab-icon prescription">Prescription</a>
                                                    </td>
                                                    <td>21 Mar 2024, 10:30 AM</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="doctor-profile-1.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/doctors/doctor-thumb-02.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="doctor-profile-1.html">Edalin
                                                                Hendry</a>
                                                        </h2>
                                                    </td>
                                                    <td>
                                                        <div class="action-item">
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#view_prescription">
                                                                <i class="isax isax-link-2"></i>
                                                            </a>
                                                            <a href="javascript:void(0);">
                                                                <i class="isax isax-import"></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete_modal">
                                                                <i class="isax isax-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="link-primary"><a href="#"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#view_prescription">#P3656</a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"
                                                            class="lab-icon prescription">Prescription</a>
                                                    </td>
                                                    <td>28 Mar 2024, 11:40 AM</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="doctor-profile-1.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/doctors/doctor-thumb-05.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="doctor-profile-1.html">John
                                                                Homes</a>
                                                        </h2>
                                                    </td>
                                                    <td>
                                                        <div class="action-item">
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#view_prescription">
                                                                <i class="isax isax-link-2"></i>
                                                            </a>
                                                            <a href="javascript:void(0);">
                                                                <i class="isax isax-import"></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete_modal">
                                                                <i class="isax isax-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="link-primary"><a href="#"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#view_prescription">#P1246</a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"
                                                            class="lab-icon prescription">Prescription</a>
                                                    </td>
                                                    <td>11 Apr 2024, 09:00 AM</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="doctor-profile-1.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/doctors/doctor-thumb-03.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="doctor-profile-1.html">Shanta
                                                                Neill</a>
                                                        </h2>
                                                    </td>
                                                    <td>
                                                        <div class="action-item">
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#view_prescription">
                                                                <i class="isax isax-link-2"></i>
                                                            </a>
                                                            <a href="javascript:void(0);">
                                                                <i class="isax isax-import"></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete_modal">
                                                                <i class="isax isax-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="link-primary"><a href="#"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#view_prescription">#P6985</a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"
                                                            class="lab-icon prescription">Prescription</a>
                                                    </td>
                                                    <td>15 Apr 2024, 02:30 PM</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="doctor-profile-1.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/doctors/doctor-thumb-08.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="doctor-profile-1.html">Anthony
                                                                Tran</a>
                                                        </h2>
                                                    </td>
                                                    <td>
                                                        <div class="action-item">
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#view_prescription">
                                                                <i class="isax isax-link-2"></i>
                                                            </a>
                                                            <a href="javascript:void(0);">
                                                                <i class="isax isax-import"></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete_modal">
                                                                <i class="isax isax-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="link-primary"><a href="#"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#view_prescription">#P3659</a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);"
                                                            class="lab-icon prescription">Prescription</a>
                                                    </td>
                                                    <td>23 Apr 2024, 06:40 PM</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="doctor-profile-1.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/doctors/doctor-thumb-01.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="doctor-profile-1.html">Susan
                                                                Lingo</a>
                                                        </h2>
                                                    </td>
                                                    <td>
                                                        <div class="action-item">
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#view_prescription">
                                                                <i class="isax isax-link-2"></i>
                                                            </a>
                                                            <a href="javascript:void(0);">
                                                                <i class="isax isax-import"></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete_modal">
                                                                <i class="isax isax-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Prescriptions Tab -->

                            <!--Invoices Tab -->
                            <div class="tab-pane fade" id="invoice-tab">
                                <div class="custom-table">
                                    <div class="table-responsive">
                                        <table class="table table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Doctor</th>
                                                    <th>Appointment Date</th>
                                                    <th>Booked on</th>
                                                    <th>Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#invoice_view"
                                                            class="link-primary">#INV1236</a></td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="doctor-profile-1.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/doctors/doctor-thumb-21.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="doctor-profile-1.html">Edalin
                                                                Hendry</a>
                                                        </h2>
                                                    </td>
                                                    <td>24 Mar 2024</td>
                                                    <td>21 Mar 2024</td>
                                                    <td>$300</td>
                                                    <td>
                                                        <div class="action-item">
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#invoice_view">
                                                                <i class="isax isax-link-2"></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete_modal">
                                                                <i class="isax isax-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#invoice_view"
                                                            class="link-primary">#NV3656</a></td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="doctor-profile-1.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/doctors/doctor-thumb-13.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="doctor-profile-1.html">John
                                                                Homes</a>
                                                        </h2>
                                                    </td>
                                                    <td>17 Mar 2024</td>
                                                    <td>14 Mar 2024</td>
                                                    <td>$450</td>
                                                    <td>
                                                        <div class="action-item">
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#invoice_view">
                                                                <i class="isax isax-link-2"></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete_modal">
                                                                <i class="isax isax-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#invoice_view"
                                                            class="link-primary">#INV1246</a></td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="doctor-profile-1.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/doctors/doctor-thumb-03.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="doctor-profile-1.html">Shanta
                                                                Neill</a>
                                                        </h2>
                                                    </td>
                                                    <td>11 Mar 2024</td>
                                                    <td>07 Mar 2024</td>
                                                    <td>$250</td>
                                                    <td>
                                                        <div class="action-item">
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#invoice_view">
                                                                <i class="isax isax-link-2"></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete_modal">
                                                                <i class="isax isax-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#invoice_view"
                                                            class="link-primary">#INV6985</a></td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="doctor-profile-1.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/doctors/doctor-thumb-08.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="doctor-profile-1.html">Anthony
                                                                Tran</a>
                                                        </h2>
                                                    </td>
                                                    <td>26 Feb 2024</td>
                                                    <td>23 Feb 2024</td>
                                                    <td>$320</td>
                                                    <td>
                                                        <div class="action-item">
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#invoice_view">
                                                                <i class="isax isax-link-2"></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete_modal">
                                                                <i class="isax isax-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#invoice_view"
                                                            class="link-primary">#INV3659</a></td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="doctor-profile-1.html"
                                                                class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-3"
                                                                    src="assets/img/doctors/doctor-thumb-01.jpg"
                                                                    alt="User Image">
                                                            </a>
                                                            <a href="doctor-profile-1.html">Susan
                                                                Lingo</a>
                                                        </h2>
                                                    </td>
                                                    <td>18 Feb 2024</td>
                                                    <td>15 Feb 2024</td>
                                                    <td>$480</td>
                                                    <td>
                                                        <div class="action-item">
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#invoice_view">
                                                                <i class="isax isax-link-2"></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete_modal">
                                                                <i class="isax isax-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Invoices Tab -->

                        </div>
                        <!-- Tab Content -->
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    </div>








    {{-- <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ \App\Models\groupProduct::count() }}</h3>

                                <p>New Box</p>
                            </div>
                            <div class="icon">
                                <i class="ion-android-list"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ \App\Models\product::count() }}<sup style="font-size: 20px"></sup></h3>

                                <p>product</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3> {{ \App\Models\User::count() }} </h3>

                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ \App\Models\order::count() }}</h3>

                                <p>Order</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Sales
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                        </li>
                                    </ul>
                                </div>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <div class="chart tab-pane active" id="revenue-chart"
                                        style="position: relative; height: 300px;">
                                        <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                                    </div>
                                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                        <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- DIRECT CHAT -->
                        <div class="card direct-chat direct-chat-primary">
                            <div class="card-header">
                                <h3 class="card-title">Direct Chat</h3>

                                <div class="card-tools">
                                    <span title="3 New Messages" class="badge badge-primary">3</span>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" title="Contacts"
                                        data-widget="chat-pane-toggle">
                                        <i class="fas fa-comments"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages">
                                    <!-- Message. Default to the left -->
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-left">Alexander Pierce</span>
                                            <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img"
                                            src="{{ asset('backend/dist/img/user1-128x128.jpg') }}"
                                            alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            Is this template really for free? That's unbelievable!
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                    <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-right">Sarah Bullock</span>
                                            <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img"
                                            src="{{ asset('backend/dist/img/user3-128x128.jpg') }}"
                                            alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            You better believe it!
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                    <!-- Message. Default to the left -->
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-left">Alexander Pierce</span>
                                            <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img"
                                            src="{{ asset('backend/dist/img/user1-128x128.jpg') }}"
                                            alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            Working with on a great new app! Wanna join?
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                    <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-right">Sarah Bullock</span>
                                            <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img"
                                            src="{{ asset('backend/dist/img/user3-128x128.jpg') }}"
                                            alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            I would love to.
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                </div>
                                <!--/.direct-chat-messages-->

                                <!-- Contacts are loaded here -->
                                <div class="direct-chat-contacts">
                                    <ul class="contacts-list">
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img"
                                                    src="{{ asset('backend/dist/img/user1-128x128.jpg') }}"
                                                    alt="User Avatar">

                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Count Dracula
                                                        <small class="contacts-list-date float-right">2/28/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">How have you been? I was...</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img"
                                                    src="{{ asset('backend/dist/img/user7-128x128.jpg') }}"
                                                    alt="User Avatar">

                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Sarah Doe
                                                        <small class="contacts-list-date float-right">2/23/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">I will be waiting for...</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img"
                                                    src="{{ asset('backend/dist/img/user3-128x128.jpg') }}"
                                                    alt="User Avatar">

                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Nadia Jolie
                                                        <small class="contacts-list-date float-right">2/20/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">I'll call you back at...</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img"
                                                    src="{{ asset('backend/dist/img/user5-128x128.jpg') }}"
                                                    alt="User Avatar">

                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Nora S. Vans
                                                        <small class="contacts-list-date float-right">2/10/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">Where is your new...</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img"
                                                    src="{{ asset('backend/dist/img/user6-128x128.jpg') }}"
                                                    alt="User Avatar">

                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        John K.
                                                        <small class="contacts-list-date float-right">1/27/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">Can I take a look at...</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                        <li>
                                            <a href="#">
                                                <img class="contacts-list-img"
                                                    src="{{ asset('backend/dist/img/user8-128x128.jpg') }}"
                                                    alt="User Avatar">

                                                <div class="contacts-list-info">
                                                    <span class="contacts-list-name">
                                                        Kenneth M.
                                                        <small class="contacts-list-date float-right">1/4/2015</small>
                                                    </span>
                                                    <span class="contacts-list-msg">Never mind I found...</span>
                                                </div>
                                                <!-- /.contacts-list-info -->
                                            </a>
                                        </li>
                                        <!-- End Contact Item -->
                                    </ul>
                                    <!-- /.contacts-list -->
                                </div>
                                <!-- /.direct-chat-pane -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <form action="#" method="post">
                                    <div class="input-group">
                                        <input type="text" name="message" placeholder="Type Message ..."
                                            class="form-control">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary">Send</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!--/.direct-chat -->

                        <!-- TO DO List -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ion ion-clipboard mr-1"></i>
                                    To Do List
                                </h3>

                                <div class="card-tools">
                                    <ul class="pagination pagination-sm">
                                        <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                                        <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <ul class="todo-list" data-widget="todo-list">
                                    <li>
                                        <!-- drag handle -->
                                        <span class="handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <!-- checkbox -->
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo1" id="todoCheck1">
                                            <label for="todoCheck1"></label>
                                        </div>
                                        <!-- todo text -->
                                        <span class="text">Design a nice theme</span>
                                        <!-- Emphasis label -->
                                        <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
                                        <!-- General tools such as edit or delete-->
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo2" id="todoCheck2"
                                                checked>
                                            <label for="todoCheck2"></label>
                                        </div>
                                        <span class="text">Make the theme responsive</span>
                                        <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo3" id="todoCheck3">
                                            <label for="todoCheck3"></label>
                                        </div>
                                        <span class="text">Let theme shine like a star</span>
                                        <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo4" id="todoCheck4">
                                            <label for="todoCheck4"></label>
                                        </div>
                                        <span class="text">Let theme shine like a star</span>
                                        <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo5" id="todoCheck5">
                                            <label for="todoCheck5"></label>
                                        </div>
                                        <span class="text">Check your messages and notifications</span>
                                        <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash-o"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo6" id="todoCheck6">
                                            <label for="todoCheck6"></label>
                                        </div>

                                        <span class="text">Let theme shine like a star</span>
                                        <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>
                                        <div class="tools">
                                            <i class="fas fa-edit"></i>
                                            <i class="fas fa-trash-o"></i>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i>
                                    Add item</button>
                            </div>
                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    <section class="col-lg-5 connectedSortable">

                        <!-- Map card -->
                        <div class="card bg-gradient-primary">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    Visitors
                                </h3>
                                <!-- card tools -->
                                <div class="card-tools">
                                    <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                                        <i class="far fa-calendar-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <div class="card-body">
                                <div id="world-map" style="height: 250px; width: 100%;"></div>
                            </div>
                            <!-- /.card-body-->
                            <div class="card-footer bg-transparent">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <div id="sparkline-1"></div>
                                        <div class="text-white">Visitors</div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-4 text-center">
                                        <div id="sparkline-2"></div>
                                        <div class="text-white">Online</div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-4 text-center">
                                        <div id="sparkline-3"></div>
                                        <div class="text-white">Sales</div>
                                    </div>
                                    <!-- ./col -->
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                        <!-- /.card -->

                        <!-- solid sales graph -->
                        <div class="card bg-gradient-info">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                    <i class="fas fa-th mr-1"></i>
                                    Sales Graph
                                </h3>

                                <div class="card-tools">
                                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas class="chart" id="line-chart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer bg-transparent">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <input type="text" class="knob" data-readonly="true" value="20"
                                            data-width="60" data-height="60" data-fgColor="#39CCCC">

                                        <div class="text-white">Mail-Orders</div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-4 text-center">
                                        <input type="text" class="knob" data-readonly="true" value="50"
                                            data-width="60" data-height="60" data-fgColor="#39CCCC">

                                        <div class="text-white">Online</div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-4 text-center">
                                        <input type="text" class="knob" data-readonly="true" value="30"
                                            data-width="60" data-height="60" data-fgColor="#39CCCC">

                                        <div class="text-white">In-Store</div>
                                    </div>
                                    <!-- ./col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->

                        <!-- Calendar -->
                        <div class="card bg-gradient-success">
                            <div class="card-header border-0">

                                <h3 class="card-title">
                                    <i class="far fa-calendar-alt"></i>
                                    Calendar
                                </h3>
                                <!-- tools card -->
                                <div class="card-tools">
                                    <!-- button with a dropdown -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                            data-toggle="dropdown" data-offset="-52">
                                            <i class="fas fa-bars"></i>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a href="#" class="dropdown-item">Add new event</a>
                                            <a href="#" class="dropdown-item">Clear events</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item">View calendar</a>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pt-0">
                                <!--The calendar -->
                                <div id="calendar" style="width: 100%"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div> --}}
@endsection
