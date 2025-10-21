@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="overflow-visible breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="text-center col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="isax isax-home-15"></i></a>
                            </li>
                            <li class="breadcrumb-item">Doctor</li>
                            <li class="breadcrumb-item active">Doctor Search</li>
                        </ol>
                        <h2 class="breadcrumb-title">Find Your Doctor</h2>
                    </nav>
                </div>
            </div>
            <div class="bg-primary-gradient rounded-pill doctors-search-box">
                <div class="search-box-one rounded-pill">
                    <form action="{{ route('search.doctors') }}" method="GET" id="searchForm">
                        <div class="search-input search-line">
                            <i class="isax isax-hospital5 bficon"></i>
                            <div class="mb-0">
                                <input type="text" class="form-control" name="search" value="{{ $search ?? '' }}"
                                    placeholder="Search for Doctors, Specializations, etc">
                            </div>
                        </div>
                        <div class="search-input search-map-line">
                            <i class="isax isax-location5"></i>
                            <div class="mb-0">
                                <input type="text" class="form-control" name="location" value="{{ $location ?? '' }}"
                                    placeholder="Location, City, or Area">
                            </div>
                        </div>
                        <div class="search-input search-calendar-line">
                            <i class="isax isax-calendar-tick5"></i>
                            <div class="mb-0">
                                <input type="text" class="form-control datetimepicker" name="date"
                                    value="{{ $date ?? '' }}" placeholder="Preferred Date">
                            </div>
                        </div>
                        <div class="form-search-btn">
                            <button class="btn btn-primary d-inline-flex align-items-center rounded-pill" type="submit">
                                <i class="isax isax-search-normal-15 me-2"></i>Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="breadcrumb-bg">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-01.png') }}" alt="img"
                class="breadcrumb-bg-01">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-02.png') }}" alt="img"
                class="breadcrumb-bg-02">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img" class="breadcrumb-bg-03">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img" class="breadcrumb-bg-04">
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="mt-5 content">
        <div class="container">
            <div class="row">
                <!-- Filters Sidebar -->
                <div class="col-xl-3">
                    <div class="card filter-lists">
                        <div class="card-header">
                            <div class="d-flex align-items-center filter-head justify-content-between">
                                <h4>Filter</h4>
                                <a href="{{ route('search.doctors') }}"
                                    class="text-secondary text-decoration-underline">Clear All</a>
                            </div>
                            <div class="filter-input">
                                <div class="position-relative input-icon">
                                    <input type="text" class="form-control" id="filterSearch"
                                        placeholder="Filter doctors...">
                                    <span><i class="isax isax-search-normal-1"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="p-0 card-body">
                            <!-- Specialties Filter -->
                            <div class="accordion-item border-bottom">
                                <div class="accordion-header" id="heading1">
                                    <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse1"
                                        aria-controls="collapse1" role="button">
                                        <div class="d-flex align-items-center w-100">
                                            <h5>Specialities</h5>
                                            <div class="ms-auto">
                                                <span><i class="fas fa-chevron-down"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapse1" class="accordion-collapse show" aria-labelledby="heading1">
                                    <div class="pt-3 accordion-body">
                                        @php
                                            $specialties = [
                                                'Cardiology',
                                                'Neurology',
                                                'Pediatrics',
                                                'Orthopedics',
                                                'Dermatology',
                                                'Psychiatry',
                                                'Urology',
                                                'Endocrinology',
                                            ];
                                        @endphp
                                        @foreach ($specialties as $specialty)
                                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                                <div class="form-check">
                                                    <input class="form-check-input specialty-filter" type="checkbox"
                                                        value="{{ $specialty }}" id="specialty_{{ $loop->index }}">
                                                    <label class="form-check-label" for="specialty_{{ $loop->index }}">
                                                        {{ $specialty }}
                                                    </label>
                                                </div>
                                                <span class="filter-badge">
                                                    {{ \App\Models\User::where('role', 'doctor')->whereHas('doctorProfile', function ($q) use ($specialty) {
                                                            $q->where('specialization', 'like', "%{$specialty}%");
                                                        })->count() }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Gender Filter -->
                            <div class="accordion-item border-bottom">
                                <div class="accordion-header" id="heading2">
                                    <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse2"
                                        aria-controls="collapse2" role="button">
                                        <div class="d-flex align-items-center w-100">
                                            <h5>Gender</h5>
                                            <div class="ms-auto">
                                                <span><i class="fas fa-chevron-down"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapse2" class="accordion-collapse show" aria-labelledby="heading2">
                                    <div class="pt-3 accordion-body">
                                        <div class="mb-2 d-flex align-items-center justify-content-between">
                                            <div class="form-check">
                                                <input class="form-check-input gender-filter" type="checkbox"
                                                    value="male" id="gender_male">
                                                <label class="form-check-label" for="gender_male">Male</label>
                                            </div>
                                            <span class="filter-badge">
                                                {{ \App\Models\User::where('role', 'doctor')->where('gender', 'male')->count() }}
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="form-check">
                                                <input class="form-check-input gender-filter" type="checkbox"
                                                    value="female" id="gender_female">
                                                <label class="form-check-label" for="gender_female">Female</label>
                                            </div>
                                            <span class="filter-badge">
                                                {{ \App\Models\User::where('role', 'doctor')->where('gender', 'female')->count() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Experience Filter -->
                            <div class="accordion-item border-bottom">
                                <div class="accordion-header" id="heading5">
                                    <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse5"
                                        aria-controls="collapse5" role="button">
                                        <div class="d-flex align-items-center w-100">
                                            <h5>Experience</h5>
                                            <div class="ms-auto">
                                                <span><i class="fas fa-chevron-down"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapse5" class="accordion-collapse show" aria-labelledby="heading5">
                                    <div class="pt-3 accordion-body">
                                        <div class="mb-2 d-flex align-items-center justify-content-between">
                                            <div class="form-check">
                                                <input class="form-check-input experience-filter" type="checkbox"
                                                    value="2" id="exp_2">
                                                <label class="form-check-label" for="exp_2">2+ Years</label>
                                            </div>
                                        </div>
                                        <div class="mb-2 d-flex align-items-center justify-content-between">
                                            <div class="form-check">
                                                <input class="form-check-input experience-filter" type="checkbox"
                                                    value="5" id="exp_5">
                                                <label class="form-check-label" for="exp_5">5+ Years</label>
                                            </div>
                                        </div>
                                        <div class="mb-2 d-flex align-items-center justify-content-between">
                                            <div class="form-check">
                                                <input class="form-check-input experience-filter" type="checkbox"
                                                    value="10" id="exp_10">
                                                <label class="form-check-label" for="exp_10">10+ Years</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Doctors List -->
                <div class="col-xl-9">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h3>Showing <span class="text-secondary">{{ $totalDoctors }}</span>
                                    Doctor{{ $totalDoctors != 1 ? 's' : '' }}
                                    @if ($search || $location)
                                        for "{{ $search ?? '' }}{{ $location ? ' in ' . $location : '' }}"
                                    @endif
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4 d-flex align-items-center justify-content-end">
                                <div class="dropdown header-dropdown me-2">
                                    <a class="dropdown-toggle sort-dropdown" data-bs-toggle="dropdown"
                                        href="javascript:void(0);" aria-expanded="false">
                                        <span>Sort By</span> Name (A-Z)
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="javascript:void(0);" class="dropdown-item sort-option" data-sort="name">
                                            Name (A-Z)
                                        </a>
                                        <a href="javascript:void(0);" class="dropdown-item sort-option"
                                            data-sort="experience">
                                            Experience (High to Low)
                                        </a>
                                        <a href="javascript:void(0);" class="dropdown-item sort-option"
                                            data-sort="rating">
                                            Rating (High to Low)
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="doctorsList">
                        @if ($doctors->count() > 0)
                            @foreach ($doctors as $doctor)
                                <div class="mb-4 col-lg-12 doctor-item"
                                    data-specialty="{{ is_string($doctor->doctorProfile->specialization ?? '') ? $doctor->doctorProfile->specialization : 'General' }}"
                                    data-gender="{{ $doctor->gender ?? 'male' }}"
                                    data-experience="{{ is_numeric($doctor->doctorProfile->years_of_experience ?? 0) ? $doctor->doctorProfile->years_of_experience : 0 }}"
                                    data-name="{{ $doctor->name }}">
                                    <div class="card doctor-list-card">
                                        <div class="d-md-flex align-items-center">
                                            <div class="card-img card-img-hover">
                                                <a href="{{ route('doctorshome.show', $doctor->id) }}">
                                                    <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('frontend/xx/assets/img/doctors/doctor-thumb-01.jpg') }}"
                                                        alt="{{ $doctor->name }}">
                                                </a>
                                                <div
                                                    class="grid-overlay-item d-flex align-items-center justify-content-between">
                                                    <span class="badge bg-orange">
                                                        <i class="fa-solid fa-star me-1"></i>
                                                        {{ is_numeric($doctor->doctorProfile->average_rating ?? 4.5) ? $doctor->doctorProfile->average_rating : '4.5' }}
                                                    </span>
                                                    <a href="javascript:void(0)" class="fav-icon">
                                                        <i class="fa fa-heart"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="p-0 card-body">
                                                <div
                                                    class="p-3 d-flex align-items-center justify-content-between border-bottom">
                                                    <a href="#" class="text-teal fw-medium fs-14">
                                                        {{ is_string($doctor->doctorProfile->specialization ?? '') ? $doctor->doctorProfile->specialization : 'General Practitioner' }}
                                                    </a>
                                                    <span class="badge bg-success-light d-inline-flex align-items-center">
                                                        <i class="fa-solid fa-circle fs-5 me-1"></i>
                                                        {{ $doctor->doctorProfile->accepting_new_patients ? 'Available' : 'Not Available' }}
                                                    </span>
                                                </div>
                                                <div class="p-3">
                                                    <div class="pb-3 doctor-info-detail">
                                                        <div class="row align-items-center gy-3">
                                                            <div class="col-sm-6">
                                                                <div>
                                                                    <h6 class="mb-1 d-flex align-items-center">
                                                                        <a
                                                                            href="{{ route('doctorshome.show', $doctor->id) }}">Dr.
                                                                            {{ $doctor->name }}</a>
                                                                        @if ($doctor->doctorProfile && $doctor->doctorProfile->is_verified)
                                                                            <i
                                                                                class="isax isax-tick-circle5 text-success ms-2"></i>
                                                                        @endif
                                                                    </h6>

                                                                    <!-- إصلاح حقل qualifications -->
                                                                    <p class="mb-2">
                                                                        @if (isset($doctor->doctorProfile->qualifications) && is_array($doctor->doctorProfile->qualifications))
                                                                            {{ implode(', ', $doctor->doctorProfile->qualifications) }}
                                                                        @elseif(isset($doctor->doctorProfile->qualifications) && is_string($doctor->doctorProfile->qualifications))
                                                                            {{ $doctor->doctorProfile->qualifications }}
                                                                        @else
                                                                            MBBS
                                                                        @endif
                                                                    </p>

                                                                    <p class="mb-0 d-flex align-items-center fs-14">
                                                                        <i class="isax isax-location me-2"></i>
                                                                        @if ($doctor->medicalCenters->count() > 0)
                                                                            {{ $doctor->medicalCenters->first()->name ?? 'Medical Center' }}
                                                                            -
                                                                            {{ $doctor->medicalCenters->first()->city ?? 'Location not specified' }}
                                                                        @else
                                                                            {{ is_string($doctor->address ?? '') ? $doctor->address : 'Location not specified' }}
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div>
                                                                    <!-- إصلاح حقل languages -->
                                                                    <p class="mb-2 d-flex align-items-center fs-14">
                                                                        <i
                                                                            class="isax isax-language-circle text-dark me-2"></i>
                                                                        @if (isset($doctor->language) && is_array($doctor->language))
                                                                            {{ implode(', ', $doctor->language) }}
                                                                        @else
                                                                            {{ is_string($doctor->language ?? '') ? $doctor->language : 'English' }}
                                                                        @endif
                                                                    </p>

                                                                    <p class="mb-2 d-flex align-items-center fs-14">
                                                                        <i class="isax isax-like-1 text-dark me-2"></i>
                                                                        {{ is_numeric($doctor->doctorProfile->rating_count ?? 0) ? $doctor->doctorProfile->rating_count : '0' }}
                                                                        Reviews
                                                                        ({{ is_numeric($doctor->doctorProfile->average_rating ?? 0) ? $doctor->doctorProfile->average_rating : '0' }}/5)
                                                                    </p>

                                                                    <p class="mb-0 d-flex align-items-center fs-14">
                                                                        <i class="isax isax-archive-14 text-dark me-2"></i>
                                                                        {{ is_numeric($doctor->doctorProfile->years_of_experience ?? 0) ? $doctor->doctorProfile->years_of_experience : '0' }}
                                                                        Years Experience
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="flex-wrap row-gap-3 mt-3 d-flex align-items-center justify-content-between">
                                                        <div class="flex-wrap row-gap-3 d-flex align-items-center">
                                                            <div class="me-3">
                                                                <p class="mb-1">Consultation Fees</p>
                                                                <h3 class="text-orange">
                                                                    ${{ is_numeric($doctor->doctorProfile->consultation_fee ?? 100) ? $doctor->doctorProfile->consultation_fee : '100' }}
                                                                </h3>
                                                            </div>
                                                            <p class="mb-0">
                                                                @if ($doctor->doctorProfile->accepting_new_patients)
                                                                    Next available at <br>10:00 AM - Tomorrow
                                                                @else
                                                                    Currently not accepting<br>new patients
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <a href="{{ route('doctorshome.book', $doctor->id) }}"
                                                            class="inline-flex btn btn-md btn-primary-gradient align-items-center rounded-pill">
                                                            <i class="isax isax-calendar-1 me-2"></i>
                                                            Book Appointment
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <div class="py-5 text-center card">
                                    <div class="card-body">
                                        <i class="mb-3 isax isax-search-status-1 display-1 text-muted"></i>
                                        <h3 class="text-muted">No Doctors Found</h3>
                                        <p class="text-muted">Try adjusting your search criteria or browse all doctors.</p>
                                        <a href="{{ route('search.doctors') }}" class="btn btn-primary">Browse All
                                            Doctors</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <style>
                        /* تصغير حجم الترقيم */
                        .pagination .page-link {
                            padding: 0.25rem 0.5rem;
                            /* تصغير padding */
                            font-size: 0.875rem;
                            /* تصغير الخط */
                        }

                        .pagination .page-item {
                            margin: 0 0.125rem;
                            /* تقليل المسافات بين الأزرار */
                        }
                    </style>

                    <!-- Pagination -->
                    @if ($doctors->hasPages())
                        <div class="col-md-12">
                            <div class="mt-0 mb-4 pagination dashboard-pagination mt-md-3">
                                {{ $doctors->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Flatpickr
            flatpickr(".datetimepicker", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                minDate: "today",
                time_24hr: true,
                minuteIncrement: 30,
                placeholder: "Select Date & Time"
            });

            // Filter functionality
            const filterSearch = document.getElementById('filterSearch');
            const specialtyFilters = document.querySelectorAll('.specialty-filter');
            const genderFilters = document.querySelectorAll('.gender-filter');
            const experienceFilters = document.querySelectorAll('.experience-filter');
            const doctorItems = document.querySelectorAll('.doctor-item');

            function filterDoctors() {
                const searchText = filterSearch.value.toLowerCase();
                const selectedSpecialties = Array.from(specialtyFilters)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value.toLowerCase());

                const selectedGenders = Array.from(genderFilters)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                const selectedExperiences = Array.from(experienceFilters)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => parseInt(checkbox.value));

                let visibleCount = 0;

                doctorItems.forEach(item => {
                    const name = item.dataset.name.toLowerCase();
                    const specialty = item.dataset.specialty.toLowerCase();
                    const gender = item.dataset.gender;
                    const experience = parseInt(item.dataset.experience);

                    const matchesSearch = name.includes(searchText) || specialty.includes(searchText);
                    const matchesSpecialty = selectedSpecialties.length === 0 ||
                        selectedSpecialties.some(s => specialty.includes(s));
                    const matchesGender = selectedGenders.length === 0 ||
                        selectedGenders.includes(gender);
                    const matchesExperience = selectedExperiences.length === 0 ||
                        selectedExperiences.every(exp => experience >= exp);

                    if (matchesSearch && matchesSpecialty && matchesGender && matchesExperience) {
                        item.style.display = 'block';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Update results count
                const resultsCount = document.querySelector('.mb-4 h3');
                if (resultsCount) {
                    resultsCount.innerHTML =
                        `Showing <span class="text-secondary">${visibleCount}</span> Doctor${visibleCount !== 1 ? 's' : ''}`;
                }
            }

            // Event listeners for filters
            filterSearch.addEventListener('input', filterDoctors);
            specialtyFilters.forEach(checkbox => checkbox.addEventListener('change', filterDoctors));
            genderFilters.forEach(checkbox => checkbox.addEventListener('change', filterDoctors));
            experienceFilters.forEach(checkbox => checkbox.addEventListener('change', filterDoctors));
        });
    </script>
@endpush
