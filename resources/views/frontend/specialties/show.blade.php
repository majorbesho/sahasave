@extends('frontend.layouts.master')

@section('title', __('specialties.title', ['name' => $specialty->name]))

@section('content')
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
                            <li class="breadcrumb-item">@lang('specialties.breadcrumb.specialties')</li>
                            <li class="breadcrumb-item active">{{ $specialty->name }}</li>
                        </ol>
                        <h2 class="breadcrumb-title">{{ $specialty->name }}</h2>
                        <p class="text-muted">@lang('specialties.breadcrumb.doctors_count', ['count' => $specialty->doctors_count])</p>
                    </nav>
                </div>
            </div>

            <!-- شريط البحث -->
            <div class="bg-primary-gradient rounded-pill doctors-search-box">
                <div class="search-box-one rounded-pill">
                    <form action="{{ route('specialties.filter', $specialty->slug) }}" method="GET"
                        id="specialtySearchForm">
                        <div class="search-input search-line">
                            <i class="isax isax-hospital5 bficon"></i>
                            <div class="mb-0">
                                <input type="text" class="form-control" name="search" placeholder="@lang('specialties.search.placeholder', ['name' => $specialty->name])"
                                    value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="search-input search-map-line">
                            <i class="isax isax-location5"></i>
                            <div class="mb-0">
                                <input type="text" class="form-control" name="location" placeholder="@lang('specialties.search.location')"
                                    value="{{ request('location') }}">
                            </div>
                        </div>
                        <div class="search-input search-calendar-line">
                            <i class="isax isax-calendar-tick5"></i>
                            <div class="mb-0">
                                <input type="text" class="form-control datetimepicker" name="date"
                                    placeholder="@lang('specialties.search.date')" value="{{ request('date') }}">
                            </div>
                        </div>
                        <div class="form-search-btn">
                            <button class="btn btn-primary d-inline-flex align-items-center rounded-pill" type="submit">
                                <i class="isax isax-search-normal-15 me-2"></i>@lang('specialties.search.button')
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
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img"
                class="breadcrumb-bg-04">
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="mt-5 content">
        <div class="container">
            <div class="row">
                <!-- المرشحات الجانبية -->
                <div class="col-xl-3">
                    <div class="card filter-lists">
                        <div class="card-header">
                            <div class="d-flex align-items-center filter-head justify-content-between">
                                <h4>@lang('specialties.filters.title')</h4>
                                <a href="{{ route('specialties.show', $specialty->slug) }}"
                                    class="text-secondary text-decoration-underline">@lang('specialties.filters.clear_all')</a>
                            </div>
                            <div class="filter-input">
                                <div class="position-relative input-icon">
                                    <input type="text" class="form-control" id="filterSearch"
                                        placeholder="@lang('specialties.filters.search_doctors')">
                                    <span><i class="isax isax-search-normal-1"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="p-0 card-body">

                            <!-- تصفية التخصصات -->
                            <div class="accordion-item border-bottom">
                                <div class="accordion-header" id="heading1">
                                    <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse1"
                                        aria-controls="collapse1" role="button">
                                        <div class="d-flex align-items-center w-100">
                                            <h5>@lang('specialties.filters.specialties')</h5>
                                            <div class="ms-auto">
                                                <span><i class="fas fa-chevron-down"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div id="collapse1" class="accordion-collapse show" aria-labelledby="heading1">
                                    <div class="pt-3 accordion-body">
                                        @foreach ($otherSpecialties as $otherSpecialty)
                                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                                <div class="form-check">
                                                    <input class="form-check-input specialty-filter" type="checkbox"
                                                        value="{{ $otherSpecialty->id }}"
                                                        id="specialty_{{ $otherSpecialty->id }}">
                                                    <label class="form-check-label"
                                                        for="specialty_{{ $otherSpecialty->id }}">
                                                        {{ $otherSpecialty->name }}
                                                    </label>
                                                </div>
                                                <span class="filter-badge">{{ $otherSpecialty->doctors_count }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div> --}}
                            </div>

                            <!-- تصفية الجنس -->
                            <div class="accordion-item border-bottom">
                                <div class="accordion-header" id="heading2">
                                    <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse2"
                                        aria-controls="collapse2" role="button">
                                        <div class="d-flex align-items-center w-100">
                                            <h5>@lang('specialties.filters.gender')</h5>
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
                                                <input class="form-check-input gender-filter" type="radio"
                                                    name="gender" value="male" id="gender_male">
                                                <label class="form-check-label"
                                                    for="gender_male">@lang('specialties.filters.male')</label>
                                            </div>
                                            <span class="filter-badge">
                                                {{ \App\Models\User::where('role', 'doctor')->where('gender', 'male')->count() }}
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="form-check">
                                                <input class="form-check-input gender-filter" type="radio"
                                                    name="gender" value="female" id="gender_female">
                                                <label class="form-check-label"
                                                    for="gender_female">@lang('specialties.filters.female')</label>
                                            </div>
                                            <span class="filter-badge">
                                                {{ \App\Models\User::where('role', 'doctor')->where('gender', 'female')->count() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- تصفية الخبرة -->
                            <div class="accordion-item border-bottom">
                                <div class="accordion-header" id="heading5">
                                    <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse5"
                                        aria-controls="collapse5" role="button">
                                        <div class="d-flex align-items-center w-100">
                                            <h5>@lang('specialties.filters.experience')</h5>
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
                                                <input class="form-check-input experience-filter" type="radio"
                                                    name="experience" value="2" id="exp_2">
                                                <label class="form-check-label" for="exp_2">@lang('specialties.filters.experience_years', ['years' => 2])</label>
                                            </div>
                                        </div>
                                        <div class="mb-2 d-flex align-items-center justify-content-between">
                                            <div class="form-check">
                                                <input class="form-check-input experience-filter" type="radio"
                                                    name="experience" value="5" id="exp_5">
                                                <label class="form-check-label" for="exp_5">@lang('specialties.filters.experience_years', ['years' => 5])</label>
                                            </div>
                                        </div>
                                        <div class="mb-2 d-flex align-items-center justify-content-between">
                                            <div class="form-check">
                                                <input class="form-check-input experience-filter" type="radio"
                                                    name="experience" value="10" id="exp_10">
                                                <label class="form-check-label" for="exp_10">@lang('specialties.filters.experience_years', ['years' => 10])</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- تصفية التقييم -->
                            <div class="accordion-item border-bottom">
                                <div class="accordion-header" id="heading9">
                                    <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse9"
                                        aria-controls="collapse9" role="button">
                                        <div class="d-flex align-items-center w-100">
                                            <h5>@lang('specialties.filters.rating')</h5>
                                            <div class="ms-auto">
                                                <span><i class="fas fa-chevron-down"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapse9" class="accordion-collapse show" aria-labelledby="heading9">
                                    <div class="pt-3 accordion-body">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                                <div class="form-check">
                                                    <input class="form-check-input rating-filter" type="radio"
                                                        name="rating" value="{{ $i }}"
                                                        id="rating_{{ $i }}">
                                                    <label class="form-check-label" for="rating_{{ $i }}">
                                                        <span>
                                                            @for ($j = 1; $j <= 5; $j++)
                                                                @if ($j <= $i)
                                                                    <i class="fa-solid fa-star text-orange me-1"></i>
                                                                @else
                                                                    <i class="fa-regular fa-star text-orange me-1"></i>
                                                                @endif
                                                            @endfor
                                                        </span>
                                                        @lang('specialties.filters.stars', ['rating' => $i])
                                                    </label>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- قائمة الأطباء -->
                <div class="col-xl-9">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h3>
                                    @lang('specialties.doctors.title', ['count' => $doctors->total(), 'name' => $specialty->name])
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4 d-flex align-items-center justify-content-end">
                                <div class="dropdown header-dropdown me-2">
                                    <a class="dropdown-toggle sort-dropdown" data-bs-toggle="dropdown"
                                        href="javascript:void(0);" aria-expanded="false">
                                        <span>@lang('specialties.doctors.sort.label')</span> @lang('specialties.doctors.sort.name_asc')
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="javascript:void(0);" class="dropdown-item sort-option" data-sort="name">
                                            @lang('specialties.doctors.sort.name_asc')
                                        </a>
                                        <a href="javascript:void(0);" class="dropdown-item sort-option"
                                            data-sort="experience">
                                            @lang('specialties.doctors.sort.experience_desc')
                                        </a>
                                        <a href="javascript:void(0);" class="dropdown-item sort-option"
                                            data-sort="rating">
                                            @lang('specialties.doctors.sort.rating_desc')
                                        </a>
                                        <a href="javascript:void(0);" class="dropdown-item sort-option"
                                            data-sort="price_low">
                                            @lang('specialties.doctors.sort.price_low')
                                        </a>
                                        <a href="javascript:void(0);" class="dropdown-item sort-option"
                                            data-sort="price_high">
                                            @lang('specialties.doctors.sort.price_high')
                                        </a>
                                    </div>
                                </div>
                                <a href="{{ route('specialties.show', $specialty->slug) }}?view=grid"
                                    class="btn btn-sm head-icon active me-2">
                                    <i class="isax isax-grid-7"></i>
                                </a>
                                <a href="{{ route('specialties.show', $specialty->slug) }}?view=list"
                                    class="btn btn-sm head-icon me-2">
                                    <i class="isax isax-row-vertical"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- شبكة الأطباء -->
                    <div class="row" id="doctorsGrid">
                        @forelse($doctors as $doctor)
                            <div class="mb-4 col-xxl-4 col-md-6 doctor-card" data-name="{{ $doctor->name }}"
                                data-gender="{{ $doctor->gender }}"
                                data-experience="{{ $doctor->doctorProfile->years_of_experience ?? 0 }}"
                                data-rating="{{ $doctor->doctorProfile->average_rating ?? 0 }}"
                                data-price="{{ $doctor->doctorProfile->consultation_fee ?? 0 }}">
                                <div class="card h-100">
                                    <div class="card-img card-img-hover">
                                        <a href="{{ route('doctorshome.show', $doctor->id) }}">
                                            <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('frontend/xx/assets/img/doctors/doctor-thumb-01.jpg') }}"
                                                alt="{{ $doctor->name }}" class="img-fluid">
                                        </a>
                                        <div class="grid-overlay-item d-flex align-items-center justify-content-between">
                                            <span class="badge bg-orange">
                                                <i class="fa-solid fa-star me-1"></i>
                                                {{ $doctor->doctorProfile->average_rating ?? '4.5' }}
                                            </span>
                                            <a href="javascript:void(0)" class="fav-icon"
                                                data-doctor-id="{{ $doctor->id }}">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="p-0 card-body d-flex flex-column">
                                        <div class="p-3 d-flex active-bar align-items-center justify-content-between">
                                            <a href="#" class="text-indigo fw-medium fs-14">
                                                {{ $specialty->name }}
                                            </a>
                                            <span class="badge bg-success-light d-inline-flex align-items-center">
                                                <i class="fa-solid fa-circle fs-5 me-1"></i>
                                                {{ $doctor->doctorProfile->accepting_new_patients ? __('specialties.doctors.card.available') : __('specialties.doctors.card.not_available') }}
                                            </span>
                                        </div>
                                        <div class="p-3 pt-0 flex-grow-1">
                                            <div class="pb-3 mb-3 doctor-info-detail">
                                                <h3 class="mb-1">
                                                    <a href="{{ route('doctorshome.show', $doctor->id) }}">
                                                        د. {{ $doctor->name }}
                                                    </a>
                                                </h3>
                                                <div class="d-flex align-items-center">
                                                    <p class="mb-0 d-flex align-items-center fs-14">
                                                        <i class="isax isax-location me-2"></i>
                                                        @if ($doctor->medicalCenters->count() > 0)
                                                            {{ $doctor->medicalCenters->first()->city ?? __('specialties.doctors.card.location') }}
                                                        @else
                                                            {{ $doctor->address ?? __('specialties.doctors.card.location') }}
                                                        @endif
                                                    </p>
                                                    <i class="mx-2 fa-solid fa-circle fs-5 text-primary me-1"></i>
                                                    <span class="fs-14 fw-medium">
                                                        @lang('specialties.doctors.card.experience', ['years' => $doctor->doctorProfile->years_of_experience ?? 0])
                                                    </span>
                                                </div>
                                                @if ($doctor->doctorProfile->qualifications)
                                                    <p class="mt-2 mb-0 text-muted fs-12">
                                                        @if (is_array($doctor->doctorProfile->qualifications))
                                                            {{ implode('، ', $doctor->doctorProfile->qualifications) }}
                                                        @else
                                                            {{ $doctor->doctorProfile->qualifications }}
                                                        @endif
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="mt-auto d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="mb-1">@lang('specialties.doctors.card.consultation_fee')</p>
                                                    <h3 class="text-orange">
                                                        AED {{ $doctor->doctorProfile->consultation_fee ?? '100' }}
                                                    </h3>
                                                </div>
                                                <a href="{{ route('doctorshomex.booking.create', $doctor->id) }}"
                                                    class="btn btn-md btn-dark d-inline-flex align-items-center rounded-pill">
                                                    <i class="isax isax-calendar-1 me-2"></i>
                                                    @lang('specialties.doctors.card.book_appointment')
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="py-5 text-center card">
                                    <div class="card-body">
                                        <i class="mb-3 isax isax-search-status-1 display-1 text-muted"></i>
                                        <h3 class="text-muted">@lang('specialties.doctors.no_results.title')</h3>
                                        <p class="text-muted">@lang('specialties.doctors.no_results.message')</p>
                                        <a href="{{ route('specialties.show', $specialty->slug) }}"
                                            class="btn btn-primary">
                                            @lang('specialties.doctors.no_results.show_all')
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- الترقيم -->
                    @if ($doctors->hasPages())
                        <div class="col-md-12">
                            <div class="mt-0 mb-4 pagination dashboard-pagination mt-md-3">
                                {{ $doctors->onEachSide(1)->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    @endif

                    @if ($doctors->count() > 0)
                        <div class="col-md-12">
                            <div class="mb-4 text-center">
                                <p class="text-muted">@lang('specialties.doctors.pagination.results', ['count' => $doctors->count(), 'total' => $doctors->total()])</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterSearch = document.getElementById('filterSearch');
            const specialtyFilters = document.querySelectorAll('.specialty-filter');
            const genderFilters = document.querySelectorAll('.gender-filter');
            const experienceFilters = document.querySelectorAll('.experience-filter');
            const ratingFilters = document.querySelectorAll('.rating-filter');
            const sortOptions = document.querySelectorAll('.sort-option');
            const doctorCards = document.querySelectorAll('.doctor-card');

            // تطبيق التصفية
            function applyFilters() {
                const searchText = filterSearch.value.toLowerCase();
                const selectedGender = document.querySelector('input[name="gender"]:checked')?.value;
                const selectedExperience = document.querySelector('input[name="experience"]:checked')?.value;
                const selectedRating = document.querySelector('input[name="rating"]:checked')?.value;

                let visibleCount = 0;

                doctorCards.forEach(card => {
                    const name = card.dataset.name.toLowerCase();
                    const gender = card.dataset.gender;
                    const experience = parseInt(card.dataset.experience);
                    const rating = parseFloat(card.dataset.rating);

                    const matchesSearch = name.includes(searchText);
                    const matchesGender = !selectedGender || gender === selectedGender;
                    const matchesExperience = !selectedExperience || experience >= parseInt(
                        selectedExperience);
                    const matchesRating = !selectedRating || rating >= parseInt(selectedRating);

                    if (matchesSearch && matchesGender && matchesExperience && matchesRating) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // تحديث عدد النتائج
                const resultsCount = document.querySelector('.mb-4 h3');
                if (resultsCount) {
                    resultsCount.innerHTML =
                        `عرض <span class="text-secondary">${visibleCount}</span> طبيب في تخصص <span class="text-primary">{{ $specialty->name }}</span>`;
                }
            }

            // إضافة event listeners
            filterSearch.addEventListener('input', applyFilters);

            specialtyFilters.forEach(checkbox => {
                checkbox.addEventListener('change', applyFilters);
            });

            genderFilters.forEach(radio => {
                radio.addEventListener('change', applyFilters);
            });

            experienceFilters.forEach(radio => {
                radio.addEventListener('change', applyFilters);
            });

            ratingFilters.forEach(radio => {
                radio.addEventListener('change', applyFilters);
            });

            // الترتيب
            sortOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const sort = this.dataset.sort;
                    window.location.href =
                        `{{ route('specialties.show', $specialty->slug) }}?sort=${sort}`;
                });
            });

            // إضافة إلى المفضلة
            document.querySelectorAll('.fav-icon').forEach(icon => {
                icon.addEventListener('click', function() {
                    const doctorId = this.dataset.doctorId;
                    // هنا يمكنك إضافة كود AJAX لإضافة الطبيب إلى المفضلة
                    this.classList.toggle('text-danger');

                    // استخدام الترجمة بدلاً من النص الثابت
                    const message = this.classList.contains('text-danger') ?
                        '{{ __('تم إضافة الطبيب إلى المفضلة') }}' :
                        '{{ __('تم إزالة الطبيب من المفضلة') }}';

                    // يمكنك استخدام toast أو sweetalert بدلاً من alert
                    showNotification(message);
                });
            });

            // دالة لعرض الإشعارات (بديل عن alert)
            function showNotification(message) {
                // يمكنك استخدام مكتبة مثل Toastify أو إنشاء إشعار مخصص
                if (typeof Toastify !== 'undefined') {
                    Toastify({
                        text: message,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                    }).showToast();
                } else {
                    alert(message);
                }
            }

            // تهيئة التقويم
            if (typeof flatpickr !== 'undefined') {
                flatpickr(".datetimepicker", {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    minDate: "today",
                    time_24hr: true,
                    minuteIncrement: 30,
                    locale: "ar"
                });
            }
        });
    </script>

@endsection
