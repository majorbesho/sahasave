@extends('frontend.layouts.master')
@section('title', __('seo.doctors.title'))
@section('meta_description', __('seo.doctors.description'))
@section('content')
    <!-- Breadcrumb -->
    <!-- Breadcrumb Section -->
    <!-- Breadcrumb -->
    <div class="overflow-visible breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="text-center col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}"><i class="isax isax-home-15"></i></a>
                            </li>
                            <li class="breadcrumb-item">Doctor</li>
                            <li class="breadcrumb-item active">Doctor List</li>
                        </ol>
                        <h1 class="breadcrumb-title">Doctor List</h1>
                    </nav>
                </div>
            </div>
            <div class="bg-primary-gradient rounded-pill doctors-search-box">
                <div class="search-box-one rounded-pill">
                    <form action="{{ route('doctors.search') }}" method="GET">
                        <div class="search-input search-line">
                            <i class="isax isax-hospital5 bficon"></i>
                            <div class="mb-0">
                                <input type="text" name="name" class="form-control"
                                    placeholder="Search for Doctors, Hospitals, Clinics" value="{{ request('name') }}">
                            </div>
                        </div>
                        <div class="search-input search-map-line">
                            <i class="isax isax-location5"></i>
                            <div class="mb-0">
                                <input type="text" name="location" class="form-control" placeholder="Location"
                                    value="{{ request('location') }}">
                            </div>
                        </div>
                        <div class="search-input search-calendar-line">
                            <i class="isax isax-calendar-tick5"></i>
                            <div class="mb-0">
                                <input type="text" class="form-control datetimepicker" placeholder="Date">
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
                class="breadcrumb-bg-01" width="100" height="100">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-02.png') }}" alt="img"
                class="breadcrumb-bg-02" width="100" height="100">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img"
                class="breadcrumb-bg-03" width="100" height="100">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img"
                class="breadcrumb-bg-04" width="100" height="100">
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="mt-5 content">
        <div class="container">
            <div class="row">
                <!-- Filter Sidebar -->
                <div class="col-xl-3">
                    <div class="card filter-lists">
                        <div class="card-header">
                            <div class="d-flex align-items-center filter-head justify-content-between">
                                <h4>Filter</h4>
                                <a href="{{ route('doctors.search') }}"
                                    class="text-secondary text-decoration-underline">Clear All</a>
                            </div>
                            <div class="filter-input">
                                <div class="position-relative input-icon">
                                    <input type="text" class="form-control" placeholder="Search filters...">
                                    <span><i class="isax isax-search-normal-1"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="p-0 card-body">
                            <form id="filterForm" method="GET" action="{{ route('doctors.search') }}">
                                <!-- Specialities Filter -->
                                <div class="accordion-item border-bottom">
                                    <div class="accordion-header" id="heading1">
                                        <div class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse1" aria-controls="collapse1" role="button">
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
                                            @foreach ($specialties as $specialty)
                                                <div class="mb-2 specialty-item">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="form-check">
                                                            <input class="form-check-input specialty-checkbox"
                                                                type="checkbox" name="specialties[]"
                                                                value="{{ $specialty->id }}"
                                                                id="specialty-{{ $specialty->id }}"
                                                                data-has-children="{{ $specialty->activeChildren->count() > 0 ? 'true' : 'false' }}"
                                                                {{ in_array($specialty->id, (array) request('specialties', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label d-flex align-items-center"
                                                                for="specialty-{{ $specialty->id }}">
                                                                @if ($specialty->icon_url)
                                                                    <img src="{{ $specialty->icon_url }}"
                                                                        alt="{{ $specialty->name }}"
                                                                        class="specialty-icon me-2"
                                                                        loading="lazy"
                                                                        style="width: 20px; height: 20px;">
                                                                @endif
                                                                {{ $specialty->name }}
                                                            </label>
                                                        </div>
                                                        <span
                                                            class="filter-badge">{{ $specialty->active_doctors_count }}</span>
                                                    </div>

                                                    @if ($specialty->activeChildren->count() > 0)
                                                        <div class="mt-2 sub-specialties ms-4"
                                                            id="sub-specialties-{{ $specialty->id }}"
                                                            style="{{ in_array($specialty->id, (array) request('specialties', [])) ? 'display: block;' : 'display: none;' }}">
                                                            @foreach ($specialty->activeChildren as $child)
                                                                <div
                                                                    class="mb-2 d-flex align-items-center justify-content-between">
                                                                    <div class="form-check">
                                                                        <input
                                                                            class="form-check-input sub-specialty-checkbox"
                                                                            type="checkbox" name="specialties[]"
                                                                            value="{{ $child->id }}"
                                                                            id="specialty-{{ $child->id }}"
                                                                            {{ in_array($child->id, (array) request('specialties', [])) ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="specialty-{{ $child->id }}">
                                                                            {{ $child->name }}
                                                                        </label>
                                                                    </div>
                                                                    <span
                                                                        class="filter-badge">{{ $child->doctors_count }}</span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Gender Filter -->
                                <div class="accordion-item border-bottom">
                                    <div class="accordion-header" id="heading2">
                                        <div class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse2" aria-controls="collapse2" role="button">
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
                                                    <input class="form-check-input" type="checkbox" name="gender[]"
                                                        value="male" id="checkebox-sm11"
                                                        {{ in_array('male', (array) request('gender', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="checkebox-sm11">Male</label>
                                                </div>
                                                <span class="filter-badge">21</span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="gender[]"
                                                        value="female" id="checkebox-sm12"
                                                        {{ in_array('female', (array) request('gender', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="checkebox-sm12">Female</label>
                                                </div>
                                                <span class="filter-badge">21</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pricing Filter -->
                                <div class="accordion-item border-bottom">
                                    <div class="accordion-header" id="heading4">
                                        <div class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse4" aria-controls="collapse4" role="button">
                                            <div class="d-flex align-items-center w-100">
                                                <h5>Pricing</h5>
                                                <div class="ms-auto">
                                                    <span><i class="fas fa-chevron-down"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapse4" class="accordion-collapse show" aria-labelledby="heading4">
                                        <div class="pt-3 accordion-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="number" name="price_min" class="form-control"
                                                        placeholder="Min" value="{{ request('price_min') }}">
                                                </div>
                                                <div class="col-6">
                                                    <input type="number" name="price_max" class="form-control"
                                                        placeholder="Max" value="{{ request('price_max') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Experience Filter -->
                                <div class="accordion-item border-bottom">
                                    <div class="accordion-header" id="heading5">
                                        <div class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse5" aria-controls="collapse5" role="button">
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
                                                    <input class="form-check-input" type="checkbox"
                                                        name="experience[]" value="2+" id="checkebox-sm21"
                                                        {{ in_array('2+', (array) request('experience', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="checkebox-sm21">2+
                                                        Years</label>
                                                </div>
                                            </div>
                                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="experience[]" value="5+" id="checkebox-sm22"
                                                        {{ in_array('5+', (array) request('experience', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="checkebox-sm22">5+
                                                        Years</label>
                                                </div>
                                            </div>
                                            <div class="view-content">
                                                <div class="viewall-3">
                                                    <div class="mb-2 d-flex align-items-center justify-content-between">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="experience[]" value="7+" id="checkebox-sm23"
                                                                {{ in_array('7+', (array) request('experience', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="checkebox-sm23">7+
                                                                Years</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2 d-flex align-items-center justify-content-between">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="experience[]" value="10+" id="checkebox-sm24"
                                                                {{ in_array('10+', (array) request('experience', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="checkebox-sm24">10+
                                                                Years</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="view-all">
                                                    <a href="javascript:void(0);"
                                                        class="viewall-button-3 text-secondary text-decoration-underline">View
                                                        More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Rating Filter -->
                                <div class="accordion-item border-bottom">
                                    <div class="accordion-header" id="heading9">
                                        <div class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse9" aria-controls="collapse9" role="button">
                                            <div class="d-flex align-items-center w-100">
                                                <h5>Rating</h5>
                                                <div class="ms-auto">
                                                    <span><i class="fas fa-chevron-down"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapse9" class="accordion-collapse show" aria-labelledby="heading9">
                                        <div class="pt-3 accordion-body">
                                            @foreach ([5, 4, 3, 2, 1] as $stars)
                                                <div class="mb-2 d-flex align-items-center justify-content-between">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="rating[]" value="{{ $stars }}"
                                                            id="rating-{{ $stars }}"
                                                            {{ in_array($stars, (array) request('rating', [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="rating-{{ $stars }}">
                                                            <span>
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <i
                                                                        class="fa-solid fa-star {{ $i <= $stars ? 'text-orange' : 'text-muted' }} me-1"></i>
                                                                @endfor
                                                            </span>
                                                            {{ $stars }} Star{{ $stars > 1 ? 's' : '' }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden fields for other search parameters -->
                                @if (request('name'))
                                    <input type="hidden" name="name" value="{{ request('name') }}">
                                @endif
                                @if (request('location'))
                                    <input type="hidden" name="location" value="{{ request('location') }}">
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Doctors List -->
                <div class="col-xl-9">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="mb-4">
                                {{-- <h3>Showing <span class="text-secondary">{{ $totalDoctors }}</span> Doctors For You
                                </h3> --}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4 d-flex align-items-center justify-content-end">
                                <div class="dropdown header-dropdown me-2">
                                    <a class="dropdown-toggle sort-dropdown" data-bs-toggle="dropdown"
                                        href="javascript:void(0);" aria-expanded="false">
                                        <span>Sort By</span>
                                        @php
                                            $sortLabels = [
                                                'name_asc' => 'Name (A-Z)',
                                                'name_desc' => 'Name (Z-A)',
                                                'price_asc' => 'Price (Low to High)',
                                                'price_desc' => 'Price (High to Low)',
                                                'rating' => 'Highest Rating',
                                                'experience' => 'Most Experienced',
                                            ];
                                            $currentSort = request('sort', 'name_asc');
                                        @endphp
                                        {{ $sortLabels[$currentSort] ?? 'Price (Low to High)' }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}"
                                            class="dropdown-item">Name (A-Z)</a>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}"
                                            class="dropdown-item">Name (Z-A)</a>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}"
                                            class="dropdown-item">Price (Low to High)</a>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}"
                                            class="dropdown-item">Price (High to Low)</a>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'rating']) }}"
                                            class="dropdown-item">Highest Rating</a>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'experience']) }}"
                                            class="dropdown-item">Most Experienced</a>
                                    </div>
                                </div>
                                <a href="{{ route('doctors.index') }}" class="btn btn-sm head-icon me-2"><i
                                        class="isax isax-grid-7"></i></a>
                                <a href="{{ route('doctors.search') }}" class="btn btn-sm head-icon active me-2"><i
                                        class="isax isax-row-vertical"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @forelse($doctors as $doctor)
                            <div class="col-lg-12">
                                <div class="card doctor-list-card">
                                    <div class="d-md-flex align-items-center">
                                        <div class="card-img card-img-hover">
                                            <a href="{{ $doctor->doctorProfile && $doctor->doctorProfile->slug ? route('doctors.show', $doctor->doctorProfile->slug) : '#' }}">
                                                <img src="{{ $doctor->photoUrl(asset('frontend/xx/assets/img/doctor-grid/doctor-list-01.jpg')) }}"
                                                    alt="{{ $doctor->name }}">
                                            </a>
                                            <div
                                                class="grid-overlay-item d-flex align-items-center justify-content-between">
                                                <span class="badge bg-orange">
                                                    <i
                                                        class="fa-solid fa-star me-1"></i>{{ number_format($doctor->doctor_rating, 1) }}
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
                                                    {{ $doctor->doctorProfile->specialty->name ?? 'General' }}
                                                </a>
                                                <span class="badge bg-success-light d-inline-flex align-items-center">
                                                    <i class="fa-solid fa-circle fs-5 me-1"></i>
                                                    Available
                                                </span>
                                            </div>
                                            <div class="p-3">
                                                <div class="pb-3 doctor-info-detail">
                                                    <div class="row align-items-center gy-3">
                                                        <div class="col-sm-6">
                                                            <div>
                                                                <h6 class="mb-1 d-flex align-items-center">
                                                                    <a
                                                                        href="{{ $doctor->doctorProfile && $doctor->doctorProfile->slug ? route('doctors.show', $doctor->doctorProfile->slug) : '#' }}">
                                                                        {{ $doctor->name }}</a>
                                                                    @if ($doctor->doctorProfile?->is_verified)
                                                                        <i
                                                                            class="isax isax-tick-circle5 text-success ms-2"></i>
                                                                    @endif
                                                                </h6>
                                                                <p class="mb-2">
                                                                    {{ $doctor->doctorProfile?->qualifications_display ?? 'MBBS' }}
                                                                </p>
                                                                <p class="mb-0 d-flex align-items-center fs-14">
                                                                    <i class="isax isax-location me-2"></i>
                                                                    {{ $doctor->medicalCenters->first()?->city ?? 'N/A' }}
                                                                    <a href="#"
                                                                        class="text-primary text-decoration-underline ms-2">Get
                                                                        Direction</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div>
                                                                <p class="mb-0 mb-2 d-flex align-items-center fs-14">
                                                                    <i
                                                                        class="isax isax-language-circle text-dark me-2"></i>
                                                                    English, Arabic
                                                                </p>
                                                                <p class="mb-0 mb-2 d-flex align-items-center fs-14">
                                                                    <i class="isax isax-like-1 text-dark me-2"></i>
                                                                    {{ $doctor->doctorProfile?->rating_count ?? 0 }}
                                                                    Reviews
                                                                </p>
                                                                <p class="mb-0 d-flex align-items-center fs-14">
                                                                    <i class="isax isax-archive-14 text-dark me-2"></i>
                                                                    {{ $doctor->doctor_experience }} Years of Experience
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
                                                                ${{ $doctor->doctorProfile?->consultation_fee ?? '0' }}
                                                            </h3>
                                                        </div>
                                                        <p class="mb-0">Next available at <br>10:00 AM - Tomorrow</p>
                                                    </div>
                                                    <a href="{{ $doctor->doctorProfile && $doctor->doctorProfile->slug ? route('doctors.book', $doctor->doctorProfile->slug) : '#' }}"
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
                        @empty
                            <div class="col-12">
                                <div class="py-5 text-center card">
                                    <div class="card-body">
                                        <i class="mb-3 isax isax-search-status-15 text-muted"
                                            style="font-size: 3rem;"></i>
                                        <h4 class="text-muted">No doctors found</h4>
                                        <p class="text-muted">Try adjusting your search criteria or filters</p>
                                        <a href="{{ route('doctors.search') }}" class="btn btn-primary">Clear
                                            Filters</a>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if ($doctors->hasPages())
                        <div class="col-md-12">
                            <div class="mt-0 mb-4 pagination dashboard-pagination mt-md-3">
                                {{ $doctors->withQueryString()->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // إدارة التخصصات الرئيسية والفرعية
            const mainSpecialtyCheckboxes = document.querySelectorAll(
                '.specialty-checkbox[data-has-children="true"]');

            mainSpecialtyCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const specialtyId = this.value;
                    const subSpecialties = document.getElementById(
                        `sub-specialties-${specialtyId}`);

                    if (subSpecialties) {
                        const subCheckboxes = subSpecialties.querySelectorAll(
                            '.sub-specialty-checkbox');

                        if (this.checked) {
                            subSpecialties.style.display = 'block';
                        } else {
                            subSpecialties.style.display = 'none';
                            subCheckboxes.forEach(subCheckbox => {
                                subCheckbox.checked = false;
                            });
                        }
                    }

                    // تحديث النتائج تلقائياً
                    document.getElementById('filterForm').submit();
                });
            });

            // تحديث النتائج عند تغيير الفلاتر
            const filterInputs = document.querySelectorAll(
                '#filterForm input[type="checkbox"], #filterForm input[type="number"]');
            filterInputs.forEach(input => {
                input.addEventListener('change', function() {
                    document.getElementById('filterForm').submit();
                });
            });

            // View More functionality
            const viewMoreButtons = document.querySelectorAll('.view-all a');
            viewMoreButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetClass = this.classList[1];
                    const content = this.closest('.view-content').querySelector(
                        `.${targetClass.replace('button', '')}`);

                    if (content.style.display === 'none' || !content.style.display) {
                        content.style.display = 'block';
                        this.textContent = 'View Less';
                    } else {
                        content.style.display = 'none';
                        this.textContent = 'View More';
                    }
                });
            });
        });
    </script>
@endsection
