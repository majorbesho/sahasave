@extends('shipper.minlayout.master')


@section('content')
    <!-- Breadcrumb -->




    <div class="col-lg-8 col-xl-9">
        <div class="dashboard-header">
            <h3>Shipments</h3>
            <ul class="header-list-btns">
                <li>
                    <div class="input-block dash-search-input">
                        <input type="text" class="form-control" placeholder="Search shipments">
                        <span class="search-icon"><i class="isax isax-search-normal"></i></span>
                    </div>
                </li>
                <li>
                    <div class="view-icons">
                        <a href="driver-shipments.html" class="active"><i class="isax isax-grid-7"></i></a>
                    </div>
                </li>
                <li>
                    <div class="view-icons">
                        <a href="driver-shipments-grid.html"><i class="fa-solid fa-th"></i></a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="appointment-tab-head">
            <div class="appointment-tabs">
                <ul class="nav nav-pills inner-tab" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-upcoming-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-upcoming" type="button" role="tab" aria-controls="pills-upcoming"
                            aria-selected="false">Upcoming<span>21</span></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-cancel-tab" data-bs-toggle="pill" data-bs-target="#pills-cancel"
                            type="button" role="tab" aria-controls="pills-cancel"
                            aria-selected="true">Cancelled<span>16</span></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-complete-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-complete" type="button" role="tab" aria-controls="pills-complete"
                            aria-selected="true">Completed<span>214</span></button>
                    </li>
                </ul>
            </div>
            <div class="filter-head">
                <div class="position-relative daterange-wraper me-2">
                    <div class="input-groupicon calender-input">
                        <input type="text" class="form-control date-range bookingrange"
                            placeholder="From Date - To Date">
                    </div>
                    <i class="isax isax-calendar-1"></i>
                </div>
                <div class="form-sorts dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" id="table-filter"><i
                            class="isax isax-filter me-2"></i>Filter By</a>
                    <div class="filter-dropdown-menu">
                        <div class="filter-set-view">
                            <div class="accordion" id="accordionExample">
                                <div class="filter-set-content">
                                    <div class="filter-set-content-head">
                                        <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">Broker Name<i
                                                class="fa-solid fa-chevron-right"></i></a>
                                    </div>
                                    <div class="filter-set-contents accordion-collapse collapse show" id="collapseTwo"
                                        data-bs-parent="#accordionExample">
                                        <ul>
                                            <li>
                                                <div class="input-block dash-search-input w-100">
                                                    <input type="text" class="form-control" placeholder="Search brokers">
                                                    <span class="search-icon"><i
                                                            class="fa-solid fa-magnifying-glass"></i></span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="filter-set-content">
                                    <div class="filter-set-content-head">
                                        <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">Load Type<i
                                                class="fa-solid fa-chevron-right"></i></a>
                                    </div>
                                    <div class="filter-set-contents accordion-collapse collapse show" id="collapseOne"
                                        data-bs-parent="#accordionExample">
                                        <ul>
                                            <li>
                                                <div class="filter-checks">
                                                    <label class="checkboxs">
                                                        <input type="checkbox" checked="">
                                                        <span class="checkmarks"></span>
                                                        <span class="check-title">All Loads</span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-checks">
                                                    <label class="checkboxs">
                                                        <input type="checkbox">
                                                        <span class="checkmarks"></span>
                                                        <span class="check-title">Dry Van</span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-checks">
                                                    <label class="checkboxs">
                                                        <input type="checkbox">
                                                        <span class="checkmarks"></span>
                                                        <span class="check-title">Reefer</span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-checks">
                                                    <label class="checkboxs">
                                                        <input type="checkbox">
                                                        <span class="checkmarks"></span>
                                                        <span class="check-title">Flatbed</span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-checks">
                                                    <label class="checkboxs">
                                                        <input type="checkbox">
                                                        <span class="checkmarks"></span>
                                                        <span class="check-title">Specialized</span>
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="filter-set-content">
                                    <div class="filter-set-content-head">
                                        <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">Shipment Status<i
                                                class="fa-solid fa-chevron-right"></i></a>
                                    </div>
                                    <div class="filter-set-contents accordion-collapse collapse show" id="collapseThree"
                                        data-bs-parent="#accordionExample">
                                        <ul>
                                            <li>
                                                <div class="filter-checks">
                                                    <label class="checkboxs">
                                                        <input type="checkbox" checked="">
                                                        <span class="checkmarks"></span>
                                                        <span class="check-title">All Statuses</span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-checks">
                                                    <label class="checkboxs">
                                                        <input type="checkbox">
                                                        <span class="checkmarks"></span>
                                                        <span class="check-title">Booked</span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-checks">
                                                    <label class="checkboxs">
                                                        <input type="checkbox">
                                                        <span class="checkmarks"></span>
                                                        <span class="check-title">In Transit</span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-checks">
                                                    <label class="checkboxs">
                                                        <input type="checkbox">
                                                        <span class="checkmarks"></span>
                                                        <span class="check-title">Delivered</span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-checks">
                                                    <label class="checkboxs">
                                                        <input type="checkbox">
                                                        <span class="checkmarks"></span>
                                                        <span class="check-title">Paid</span>
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="filter-reset-btns">
                                <a href="shipments-1.html" class="btn btn-md btn-light rounded-pill">Reset</a>
                                <a href="shipments-1.html" class="btn btn-md btn-primary-gradient rounded-pill">Filter
                                    Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content appointment-tab-content">
            <div class="tab-pane fade show active" id="pills-upcoming" role="tabpanel"
                aria-labelledby="pills-upcoming-tab">
                <!-- Shipment List -->
                <div class="appointment-wrap">
                    <ul>
                        <li>
                            <div class="patinet-information">
                                <a href="driver-upcoming-shipment.html">
                                    <img src="assets/img/brokers/broker-01.jpg" alt="Broker Logo">
                                </a>
                                <div class="patient-info">
                                    <p>#Ship0001</p>
                                    <h6><a href="driver-upcoming-shipment.html">ABC Logistics</a></h6>
                                </div>
                            </div>
                        </li>
                        <li class="appointment-info">
                            <p><i class="isax isax-clock5"></i>11 Nov 2024 10.45 AM</p>
                            <ul class="d-flex apponitment-types">
                                <li>Dry Van</li>
                                <li>Chicago to Dallas</li>
                            </ul>
                        </li>
                        <li class="mail-info-patient">
                            <ul>
                                <li><i class="isax isax-sms5"></i><a href="/cdn-cgi/l/email-protection"
                                        class="__cf_email__"
                                        data-cfemail="573233363b3e3917322f363a273b327934383a">[email&#160;protected]</a>
                                </li>
                                <li><i class="isax isax-call5"></i>+1 504 368 6874</li>
                            </ul>
                        </li>
                        <li class="appointment-action">
                            <ul>
                                <li>
                                    <a href="driver-upcoming-shipment.html"><i class="isax isax-eye4"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="isax isax-messages-25"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="isax isax-close-circle5"></i></a>
                                </li>
                            </ul>
                        </li>
                        <li class="appointment-detail-btn">
                            <a href="#" class="btn btn-md btn-primary-gradient"><i
                                    class="isax isax-truck me-1"></i>Start Trip</a>
                        </li>
                    </ul>
                </div>
                <!-- /Shipment List -->

                <!-- Additional shipment lists would follow the same pattern -->

                <!-- Pagination -->
                <div class="pagination dashboard-pagination">
                    <ul>
                        <li>
                            <a href="#" class="page-link prev">Prev</a>
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
                            <a href="#" class="page-link next">Next</a>
                        </li>
                    </ul>
                </div>
                <!-- /Pagination -->
            </div>

            <div class="tab-pane fade" id="pills-cancel" role="tabpanel" aria-labelledby="pills-cancel-tab">
                <!-- Cancelled Shipment List -->
                <div class="appointment-wrap">
                    <ul>
                        <li>
                            <div class="patinet-information">
                                <a href="driver-cancelled-shipment.html">
                                    <img src="assets/img/brokers/broker-02.jpg" alt="Broker Logo">
                                </a>
                                <div class="patient-info">
                                    <p>#Ship0002</p>
                                    <h6><a href="driver-cancelled-shipment.html">XYZ SahaSave.com</a></h6>
                                </div>
                            </div>
                        </li>
                        <li class="appointment-info">
                            <p><i class="isax isax-clock5"></i>05 Nov 2024 11.50 AM</p>
                            <ul class="d-flex apponitment-types">
                                <li>Reefer</li>
                                <li>Los Angeles to Seattle</li>
                            </ul>
                        </li>
                        <li class="appointment-detail-btn">
                            <a href="driver-cancelled-shipment.html" class="btn btn-md btn-primary-gradient"><i
                                    class="isax isax-calendar-tick5 me-1"></i>Reschedule</a>
                        </li>
                    </ul>
                </div>
                <!-- /Cancelled Shipment List -->
            </div>

            <div class="tab-pane fade" id="pills-complete" role="tabpanel" aria-labelledby="pills-complete-tab">
                <!-- Completed Shipment List -->
                <div class="appointment-wrap">
                    <ul>
                        <li>
                            <div class="patinet-information">
                                <a href="driver-completed-shipment.html">
                                    <img src="assets/img/brokers/broker-03.jpg" alt="Broker Logo">
                                </a>
                                <div class="patient-info">
                                    <p>#Ship0003</p>
                                    <h6><a href="driver-completed-shipment.html">Global Transport</a></h6>
                                </div>
                            </div>
                        </li>
                        <li class="appointment-info">
                            <p><i class="isax isax-clock5"></i>27 Oct 2024 09.30 AM</p>
                            <ul class="d-flex apponitment-types">
                                <li>Flatbed</li>
                                <li>Houston to Atlanta</li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="text-decoration-underline" data-bs-toggle="modal"
                                data-bs-target="#add_review">Rate Broker</a>
                        </li>
                        <li class="appointment-detail-btn d-flex align-items-center gap-3 flex-wrap">
                            <a href="load-board.html" class="btn btn-md btn-dark">Find Similar Load<i
                                    class="isax isax-arrow-right-3 ms-1"></i></a>
                            <a href="driver-completed-shipment.html" class="btn btn-md btn-primary-gradient">View
                                Details<i class="isax isax-arrow-right-3 ms-1"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- /Completed Shipment List -->
            </div>
        </div>
    </div>
@endsection
