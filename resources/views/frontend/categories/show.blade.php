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
                            <li class="breadcrumb-item active">
                                Hospitals
                            </li>
                        </ol>

                        <h2 class="breadcrumb-title">Hospitals</h2>
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
    <!-- Terms -->
    <div class="content doctor-content">
        <div class="container">
            <!-- Hospital Tabs -->
            <nav class="settings-tab hospital-tab">
                <ul class="nav nav-tabs-bottom justify-content-center" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" href="hospitals.html">Hospitals</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="speciality.html">Specialities</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="clinic.html">Clinics</a>
                    </li>
                </ul>
            </nav>
            <!-- /Hospital Tabs -->

            <!-- Show Result -->
            <div class="card">
                <div class="card-body">
                    <div class="flex-wrap gap-3 d-flex align-items-center justify-content-between result-wrap">
                        <h5>
                            Showing
                            <span class="text-secondary">450</span>
                            Hospitals For You
                        </h5>
                        <div class="flex-wrap gap-3 d-flex align-items-center">
                            <select class="select">
                                <option>
                                    United States Of America (USA)
                                </option>
                                <option>United Kingdom (UK)</option>
                            </select>
                            <div class="input-block dash-search-input">
                                <input type="text" class="form-control" placeholder="Search Hospitals" />
                                <span class="search-icon"><i class="isax isax-search-normal"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Show Result -->

            <div class="flex-wrap d-flex align-items-center hospital-form">
                <div class="form-check d-flex align-items-center">
                    <input class="mt-0 form-check-input" type="radio" name="Radio" id="all-hospital"
                        value="all-hospital" checked="" />
                    <label class="form-check-label fs-14 fw-medium ms-2" for="all-hospital">
                        All Hospitals
                    </label>
                </div>
                <div class="form-check d-flex align-items-center">
                    <input class="mt-0 form-check-input" type="radio" name="Radio" id="virtual" value="virtual" />
                    <label class="form-check-label fs-14 fw-medium ms-2" for="virtual">
                        Virtual
                    </label>
                </div>
                <div class="form-check d-flex align-items-center">
                    <input class="mt-0 form-check-input" type="radio" name="Radio" id="appointment"
                        value="appointment" />
                    <label class="form-check-label fs-14 fw-medium ms-2" for="appointment">
                        Appointments
                    </label>
                </div>
                <div class="form-check d-flex align-items-center">
                    <input class="mt-0 form-check-input" type="radio" name="Radio" id="clinic" value="clinic" />
                    <label class="form-check-label fs-14 fw-medium ms-2" for="clinic">
                        Hospitals / Clinics
                    </label>
                </div>
            </div>

            <!-- All Hospitals -->
            <div class="all-hospital">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="javascript:void(0);" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-01.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="javascript:void(0);">Cleveland Clinic</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Minneapolis, MN
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-02.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html"> Apollo Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Philadelphia, PA
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-03.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Asian Institute</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Piscataway, NJ
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <div class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-04.svg') }}"
                                        alt="img" />
                                </div>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Manipal North Side</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Albuquerque, NM
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-05.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Johns Hopkins Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Roswell, GA
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <div class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-06.svg') }}"
                                        alt="img" />
                                </div>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Athol Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Chesterfield, IL
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-07.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Austen Riggs Center</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Atlanta, GA
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <div class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-08.svg') }}"
                                        alt="img" />
                                </div>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Baldpate Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Burbank, CA
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-09.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Baystate Noble Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Lena, IL
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-10.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Berkshire Medical Center</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Saginaw, MI
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-11.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Beverly Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Westchester, IL
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-12.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Good Health City Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Santa Fe Springs, CA
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center loader-item">
                    <a href="#" class="btn btn-primary d-inline-flex align-items-center">
                        <i class="isax isax-d-cube-scan me-2"></i>Load
                        More 425 Hospitals
                    </a>
                </div>
            </div>
            <!-- /All Hospitals -->

            <!-- Virtual Hospitals -->
            <div class="virtual-hospital">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-02.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html"> Apollo Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Philadelphia, PA
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-01.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Cleveland Clinic</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Minneapolis, MN
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <div class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-04.svg') }}"
                                        alt="img" />
                                </div>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Manipal North Side</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Albuquerque, NM
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-03.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Asian Institute</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Piscataway, NJ
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <div class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-06.svg') }}"
                                        alt="img" />
                                </div>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Athol Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Chesterfield, IL
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-05.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Johns Hopkins Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Roswell, GA
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-07.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Austen Riggs Center</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Atlanta, GA
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <div class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-08.svg') }}"
                                        alt="img" />
                                </div>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Baldpate Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Burbank, CA
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-10.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Berkshire Medical Center</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Saginaw, MI
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-11.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Beverly Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Westchester, IL
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-09.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Baystate Noble Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Lena, IL
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-12.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Good Health City Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Santa Fe Springs, CA
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center loader-item">
                    <a href="#" class="btn btn-primary d-inline-flex align-items-center">
                        <i class="isax isax-d-cube-scan me-2"></i>Load
                        More 425 Hospitals
                    </a>
                </div>
            </div>
            <!-- /Virtual Hospitals -->

            <!-- Appointment Hospitals -->
            <div class="appointment-hospital">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-03.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Asian Institute</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Piscataway, NJ
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-02.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html"> Apollo Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Philadelphia, PA
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <div class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-04.svg') }}"
                                        alt="img" />
                                </div>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Manipal North Side</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Albuquerque, NM
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-05.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Johns Hopkins Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Roswell, GA
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-01.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Cleveland Clinic</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Minneapolis, MN
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-07.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Austen Riggs Center</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Atlanta, GA
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <div class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-08.svg') }}"
                                        alt="img" />
                                </div>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Baldpate Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Burbank, CA
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-09.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Baystate Noble Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Lena, IL
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <div class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-06.svg') }}"
                                        alt="img" />
                                </div>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Athol Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Chesterfield, IL
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-10.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Berkshire Medical Center</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Saginaw, MI
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-11.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Beverly Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Westchester, IL
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-12.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Good Health City Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Santa Fe Springs, CA
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center loader-item">
                    <a href="#" class="btn btn-primary d-inline-flex align-items-center">
                        <i class="isax isax-d-cube-scan me-2"></i>Load
                        More 425 Hospitals
                    </a>
                </div>
            </div>
            <!-- /Appointment Hospitals -->

            <!-- All Hospitals -->
            <div class="all-clinic">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-05.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Johns Hopkins Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Roswell, GA
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-01.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Cleveland Clinic</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Minneapolis, MN
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <div class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-06.svg') }}"
                                        alt="img" />
                                </div>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Athol Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Chesterfield, IL
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-07.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Austen Riggs Center</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Atlanta, GA
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <div class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-08.svg') }}"
                                        alt="img" />
                                </div>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Baldpate Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Burbank, CA
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-10.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Berkshire Medical Center</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Saginaw, MI
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-12.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Good Health City Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Santa Fe Springs, CA
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card hospital-item">
                            <div class="text-center card-body">
                                <a href="doctor-grid.html" class="hospital-icon">
                                    <img src="{{ asset('frontend/xx/assets/img/hospitals/hospital-11.svg') }}"
                                        alt="img" />
                                </a>
                                <h6 class="mb-1">
                                    <a href="doctor-grid.html">Beverly Hospital</a>
                                </h6>
                                <p class="mb-0 fs-14">
                                    <i class="isax isax-location me-2"></i>Westchester, IL
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center loader-item">
                    <a href="#" class="btn btn-primary d-inline-flex align-items-center">
                        <i class="isax isax-d-cube-scan me-2"></i>Load
                        More 425 Hospitals
                    </a>
                </div>
            </div>
            <!-- /All Hospitals -->
        </div>
    </div>
    <!-- /Terms -->
@endsection
