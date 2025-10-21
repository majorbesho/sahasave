@extends('broker.minlayout.master')


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
@endsection
