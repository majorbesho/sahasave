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

                </div>
            </div>
        </div>
    </div>


@endsection
