@extends('frontend.layouts.master')



@section('title', 'My Patients')

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="text-center col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('doctor.dashboard') }}">
                                    <i class="isax isax-home-15"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Doctor</li>
                            <li class="breadcrumb-item active">My Patients</li>
                        </ol>
                        <h2 class="breadcrumb-title">My Patients</h2>
                    </nav>
                </div>
            </div>
        </div>
        <div class="breadcrumb-bg">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-01.png') }}" alt="img" class="breadcrumb-bg-01">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-02.png') }}" alt="img" class="breadcrumb-bg-02">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img" class="breadcrumb-bg-03">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img" class="breadcrumb-bg-04">
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content doctor-content">
        <div class="container">
            <div class="row">
                @include('doctor.layouts.slide')

                <!-- Sidebar -->
                {{-- <div class="col-lg-4 col-xl-3 theiaStickySidebar">
                    <!-- Profile Sidebar -->
                    <div class="profile-sidebar doctor-sidebar profile-sidebar-new">
                        <div class="widget-profile pro-widget-content">
                            <div class="profile-info-widget">
                                <a href="{{ route('doctors.index') }}" class="booking-doc-img">
                                    <img src="{{ Auth::user()->photo ? asset(Auth::user()->photo) : asset('assets/img/doctors-dashboard/doctor-profile-img.jpg') }}"
                                        alt="User Image">
                                </a>
                                <div class="profile-det-info">
                                    <h3><a href="{{ route('doctors.index') }}">Dr {{ Auth::user()->name }}</a></h3>
                                    <div class="patient-details">
                                        <h5 class="mb-0">
                                            {{ Auth::user()->doctorProfile->qualifications ?? 'MBBS, MD' }}
                                        </h5>
                                    </div>
                                    <span class="badge doctor-role-badge">
                                        <i class="fa-solid fa-circle"></i>
                                        {{ Auth::user()->doctorProfile->specialization ?? 'General Practitioner' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="doctor-available-head">
                            <div class="input-block input-block-new">
                                <label class="form-label">Availability <span class="text-danger">*</span></label>
                                <select class="select form-control" id="availabilityStatus">
                                    <option value="available" {{ Auth::user()->status === 'active' ? 'selected' : '' }}>I
                                        am Available Now</option>
                                    <option value="not_available"
                                        {{ Auth::user()->status !== 'active' ? 'selected' : '' }}>Not Available</option>
                                </select>
                            </div>
                        </div>



                    </div>
                    <!-- /Profile Sidebar -->
                </div> --}}

                <!-- Main Content -->
                <div class="col-lg-8 col-xl-9">
                    <div class="dashboard-header">
                        <h3>My Patients</h3>
                        <ul class="header-list-btns">
                            <li>
                                <form action="{{ route('doctor.doctor.patients.index') }}" method="GET" class="d-inline">
                                    <div class="input-block dash-search-input">
                                        <input type="text" class="form-control" name="search" placeholder="Search"
                                            value="{{ request('search') }}">
                                        <span class="search-icon">
                                            <i class="isax isax-search-normal"></i>
                                        </span>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>

                    <div class="appointment-tab-head">
                        <div class="appointment-tabs">
                            <ul class="nav nav-pills inner-tab" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-upcoming-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-upcoming" type="button" role="tab"
                                        aria-controls="pills-upcoming" aria-selected="false">
                                        Active<span>{{ $activePatientsCount }}</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-cancel-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-cancel" type="button" role="tab"
                                        aria-controls="pills-cancel" aria-selected="true">
                                        InActive<span>{{ $inactivePatientsCount }}</span>
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-head">
                            <form action="{{ route('doctor.doctor.patients.index') }}" method="GET" id="filterForm">
                                <div class="position-relative daterange-wraper me-2">
                                    <div class="input-groupicon calender-input">
                                        <input type="text" class="form-control date-range bookingrange" name="date_range"
                                            placeholder="From Date - To Date" value="{{ request('date_range') }}">
                                    </div>
                                    <i class="isax isax-calendar-1"></i>
                                </div>

                                <div class="form-sorts dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" id="table-filter">
                                        <i class="isax isax-filter me-2"></i>Filter By
                                    </a>
                                    <div class="filter-dropdown-menu">
                                        <div class="filter-set-view">
                                            <div class="accordion" id="accordionExample">
                                                <!-- Name Filter -->
                                                <div class="filter-set-content">
                                                    <div class="filter-set-content-head">
                                                        <a href="#" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseTwo" aria-expanded="false"
                                                            aria-controls="collapseTwo">
                                                            Name<i class="fa-solid fa-chevron-right"></i>
                                                        </a>
                                                    </div>
                                                    <div class="filter-set-contents accordion-collapse collapse show"
                                                        id="collapseTwo" data-bs-parent="#accordionExample">
                                                        <ul>
                                                            <li>
                                                                <div class="input-block dash-search-input w-100">
                                                                    <input type="text" class="form-control"
                                                                        name="name_search" placeholder="Search by name"
                                                                        value="{{ request('name_search') }}">
                                                                    <span class="search-icon">
                                                                        <i class="fa-solid fa-magnifying-glass"></i>
                                                                    </span>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <!-- Appointment Type Filter -->
                                                <div class="filter-set-content">
                                                    <div class="filter-set-content-head">
                                                        <a href="#" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne" aria-expanded="true"
                                                            aria-controls="collapseOne">
                                                            Appointment Type<i class="fa-solid fa-chevron-right"></i>
                                                        </a>
                                                    </div>
                                                    <div class="filter-set-contents accordion-collapse collapse show"
                                                        id="collapseOne" data-bs-parent="#accordionExample">
                                                        <ul>
                                                            @php
                                                                $appointmentTypes = [
                                                                    'video_call' => 'Video Call',
                                                                    'audio_call' => 'Audio Call',
                                                                    'direct_visit' => 'Direct Visit',
                                                                ];
                                                                $selectedTypes = request('appointment_type', []);
                                                            @endphp
                                                            <li>
                                                                <div class="filter-checks">
                                                                    <label class="checkboxs">
                                                                        <input type="checkbox" name="appointment_type[]"
                                                                            value="all"
                                                                            {{ empty($selectedTypes) || in_array('all', $selectedTypes) ? 'checked' : '' }}>
                                                                        <span class="checkmarks"></span>
                                                                        <span class="check-title">All Type</span>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            @foreach ($appointmentTypes as $value => $label)
                                                                <li>
                                                                    <div class="filter-checks">
                                                                        <label class="checkboxs">
                                                                            <input type="checkbox"
                                                                                name="appointment_type[]"
                                                                                value="{{ $value }}"
                                                                                {{ in_array($value, $selectedTypes) ? 'checked' : '' }}>
                                                                            <span class="checkmarks"></span>
                                                                            <span
                                                                                class="check-title">{{ $label }}</span>
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>

                                                <!-- Visit Type Filter -->
                                                <div class="filter-set-content">
                                                    <div class="filter-set-content-head">
                                                        <a href="#" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseThree" aria-expanded="false"
                                                            aria-controls="collapseThree">
                                                            Visit Type<i class="fa-solid fa-chevron-right"></i>
                                                        </a>
                                                    </div>
                                                    <div class="filter-set-contents accordion-collapse collapse show"
                                                        id="collapseThree" data-bs-parent="#accordionExample">
                                                        <ul>
                                                            @php
                                                                $visitTypes = [
                                                                    'general_visit' => 'General',
                                                                    'consultation' => 'Consultation',
                                                                    'follow_up' => 'Follow-up',
                                                                ];
                                                                $selectedVisits = request('visit_type', []);
                                                            @endphp
                                                            <li>
                                                                <div class="filter-checks">
                                                                    <label class="checkboxs">
                                                                        <input type="checkbox" name="visit_type[]"
                                                                            value="all"
                                                                            {{ empty($selectedVisits) || in_array('all', $selectedVisits) ? 'checked' : '' }}>
                                                                        <span class="checkmarks"></span>
                                                                        <span class="check-title">All Visit</span>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            @foreach ($visitTypes as $value => $label)
                                                                <li>
                                                                    <div class="filter-checks">
                                                                        <label class="checkboxs">
                                                                            <input type="checkbox" name="visit_type[]"
                                                                                value="{{ $value }}"
                                                                                {{ in_array($value, $selectedVisits) ? 'checked' : '' }}>
                                                                            <span class="checkmarks"></span>
                                                                            <span
                                                                                class="check-title">{{ $label }}</span>
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="filter-reset-btns">
                                                <a href="{{ route('doctor.doctor.patients.index') }}"
                                                    class="btn btn-light">Reset</a>
                                                <button type="submit" class="btn btn-primary">Filter Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-content appointment-tab-content grid-patient">
                        <!-- Active Patients Tab -->
                        <div class="tab-pane fade show active" id="pills-upcoming" role="tabpanel"
                            aria-labelledby="pills-upcoming-tab">
                            <div class="row">
                                @forelse($patients as $patient)
                                    @php
                                        $lastAppointment = $patient->getLastAppointmentWithDoctor(Auth::id());
                                        $medicalProfile = $patient->medicalProfile;
                                    @endphp

                                    <!-- Patient Card -->
                                    <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                                        <div class="appointment-wrap appointment-grid-wrap">
                                            <ul>
                                                <li>
                                                    <div class="appointment-grid-head">
                                                        <div class="patinet-information">
                                                            <a href="{{ route('doctor.patients.show', $patient->id) }}">
                                                                <img src="{{ $patient->photo ? asset($patient->photo) : asset('assets/img/doctors-dashboard/profile-01.jpg') }}"
                                                                    alt="User Image">
                                                            </a>
                                                            <div class="patient-info">
                                                                <p>#PT{{ str_pad($patient->id, 4, '0', STR_PAD_LEFT) }}</p>
                                                                <h6>
                                                                    <a
                                                                        href="{{ route('doctor.patients.show', $patient->id) }}">
                                                                        {{ $patient->name }}
                                                                    </a>
                                                                </h6>
                                                                <ul>
                                                                    <li>Age : {{ $patient->age ?? 'N/A' }}</li>
                                                                    <li>{{ ucfirst($patient->gender) ?? 'N/A' }}</li>
                                                                    <li>{{ $medicalProfile->blood_type ?? 'N/A' }}</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="appointment-info">
                                                    @if ($lastAppointment)
                                                        <p>
                                                            <i class="isax isax-clock5"></i>
                                                            {{ $lastAppointment->scheduled_for->format('d M Y h.i A') }}
                                                        </p>
                                                        <p class="mb-0">
                                                            <i class="isax isax-location5"></i>
                                                            {{ $lastAppointment->medicalCenter->name ?? 'Clinic Visit' }}
                                                        </p>
                                                    @else
                                                        <p><i class="isax isax-clock5"></i>No appointments yet</p>
                                                    @endif
                                                </li>
                                                <li class="appointment-action">
                                                    <div class="patient-book">
                                                        @if ($lastAppointment)
                                                            <p>
                                                                <i class="isax isax-calendar-1"></i>
                                                                Last Booking
                                                                <span>{{ $lastAppointment->scheduled_for->format('d M Y') }}</span>
                                                            </p>
                                                        @else
                                                            <p>No previous bookings</p>
                                                        @endif
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Patient Card -->
                                @empty
                                    <div class="col-12">
                                        <div class="text-center alert alert-info">
                                            <i class="isax isax-info-circle me-2"></i>
                                            No active patients found.
                                        </div>
                                    </div>
                                @endforelse
                            </div>

                            <!-- Pagination -->
                            @if ($patients->hasPages())
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="blog-pagination">
                                            {{ $patients->links() }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Inactive Patients Tab -->
                        <div class="tab-pane fade" id="pills-cancel" role="tabpanel" aria-labelledby="pills-cancel-tab">
                            <div class="row">
                                @php
                                    // سيتم تحميل المرضى غير النشطين عبر AJAX أو صفحة منفصلة
                                @endphp
                                <div class="col-12">
                                    <div class="text-center alert alert-info">
                                        <i class="isax isax-info-circle me-2"></i>
                                        Inactive patients will be loaded when you switch to this tab.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Initialize date range picker
            $('.date-range').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('.date-range').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format(
                    'MM/DD/YYYY'));
                $('#filterForm').submit();
            });

            $('.date-range').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                $('#filterForm').submit();
            });

            // Handle tab switching
            $('button[data-bs-toggle="pill"]').on('shown.bs.tab', function(e) {
                const target = $(e.target).data('bs-target');
                const status = target === '#pills-upcoming' ? 'active' : 'inactive';

                // Update URL without page reload
                const url = new URL(window.location);
                url.searchParams.set('tab', status);
                window.history.pushState({}, '', url);

                // You can load data via AJAX here if needed
                if (status === 'inactive') {
                    loadInactivePatients();
                }
            });

            // Availability status change
            $('#availabilityStatus').change(function() {
                const status = $(this).val();

                $.ajax({
                    url: '{{ route('doctor.profile.update') }}',
                    method: 'POST',
                    data: {
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        toastr.success('Availability updated successfully');
                    },
                    error: function() {
                        toastr.error('Failed to update availability');
                    }
                });
            });

            // Search functionality
            let searchTimer;
            $('input[name="search"]').on('keyup', function() {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(() => {
                    $('#filterForm').submit();
                }, 500);
            });

            // Handle "All" checkboxes
            $('input[value="all"]').change(function() {
                const container = $(this).closest('.filter-set-contents');
                const checkboxes = container.find('input[type="checkbox"]').not(this);

                if ($(this).is(':checked')) {
                    checkboxes.prop('checked', false);
                }
            });

            $('input[type="checkbox"]').not('input[value="all"]').change(function() {
                const container = $(this).closest('.filter-set-contents');
                const allCheckbox = container.find('input[value="all"]');

                if ($(this).is(':checked')) {
                    allCheckbox.prop('checked', false);
                }
            });

            function loadInactivePatients() {
                // AJAX call to load inactive patients
                $.ajax({
                    url: '{{ route('doctor.doctor.patients.index') }}',
                    data: {
                        tab: 'inactive',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#pills-cancel').html($(response).find('#pills-cancel').html());
                    }
                });
            }
        });
    </script>
@endsection
