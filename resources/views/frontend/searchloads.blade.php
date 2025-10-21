@extends('frontend.layouts.master')


<link href="{{ asset('/car/css/slicknav.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('car/css/swiper-bundle.min.css') }}">

<!-- Animated Css -->
<link href="{{ asset('/car/css/animate.css') }}" rel="stylesheet">
<!-- Magnific Popup Core Css File -->
<link rel="stylesheet" href="{{ asset('/car/css/magnific-popup.css') }}">
<!-- Mouse Cursor Css File -->
{{-- <link rel="stylesheet" href="{{ asset('/car/css/mousecursor.css') }}">
<!-- Main Custom Css --> --}}
<link href="{{ asset('/car/css/custom.css') }}" rel="stylesheet" media="screen">



<style>
    .filter-group {
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #eee;
    }

    .filter-group h4 {
        font-size: 1rem;
        margin-bottom: 0.8rem;
        color: #333;
        font-weight: 600;
    }

    .price-slider {
        padding: 0 10px;
    }

    .price-values {
        display: flex;
        justify-content: space-between;
        margin-top: 5px;
        font-size: 0.9rem;
    }

    .form-range {
        width: 100%;
        margin: 10px 0;
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .fleets-sidebar {
            margin-bottom: 2rem;
        }
    }

    .package-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
    }

    .package-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .package-image-wrapper {
        position: relative;
        overflow: hidden;
        height: 180px;
    }

    .package-image-wrapper img {
        object-fit: cover;
        width: 100%;
        height: 100%;
        transition: transform 0.5s ease;
    }

    .package-card:hover .package-image-wrapper img {
        transform: scale(1.05);
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.3) 100%);
    }

    .card-body {
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    .package-details {
        font-size: 0.9rem;
    }

    .badge {
        font-size: 0.8rem;
        padding: 0.35em 0.65em;
    }

    .date-input {
        font-size: 16px;
        height: 44px;
        padding: 0.5rem 1rem;
        border: 1px solid #ced4da;
        border-radius: 4px;
        width: 100%;
        background-color: #fff;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .date-input:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #333;
    }
</style>




@section('content')
    <div class="container" style="padding-top:108px">
        <div class="row"
            style="align-items: center; align-content: space-between; flex-direction: row; background: rgb(106 100 100 / 20%);">
            <form action="{{ route('searchresultx') }}" method="post" class="searchForm"
                style="background: rgba(255, 255, 255, 0.2); border-radius: 10px; backdrop-filter: blur(10px); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); width: 100%; padding: 15px;z-index: 10;">
                @csrf
                <div class="form-row" style="display: flex; flex-wrap: wrap; gap: 10px;">
                    <!-- Origin -->
                    <div class="form-group col-12 col-md-6 col-lg-3">

                        <label for="origin">{{ __('index.Origin') }}</label>
                        <input type="text" name="location_from" id="location_from" class="form-control"
                            value="{{ request('location_from') }}"
                            style="width: 100%; font-size: 16px; height: 44px; padding: 0 10px;">
                    </div>



                    <!-- Destination -->
                    <div class="form-group col-12 col-md-6 col-lg-3">
                        <label for="destination">{{ __('index.Destination') }}</label>
                        <input type="text" name="location_to" id="location_to" class="form-control"
                            value="{{ request('location_to') }}"
                            style="width: 100%; font-size: 16px; height: 44px; padding: 0 10px;">
                    </div>
                    <!-- SahaSave.com Type -->



                    <div class="form-group col-12 col-md-6 col-lg-2">
                        <label for="truck_sub_type_truck">{{ __('index.Truck Sub Type') }}</label>
                        <div class="custom-dropdown">
                            <div class="dropdown-header">
                                <span class="selected-value">Select Sub Type</span>
                                <span class="arrow">&#9660;</span>
                            </div>
                            <ul class="dropdown-list">
                                <option value="" selected disabled>Select Sub Type</option>
                                @foreach (\App\Models\TruckSubType::get() as $subType)
                                    <li class="dropdown-option" data-value="{{ $subType->id }}" style="color: #0a0a0a">
                                        {{ $subType->name }}
                                    </li>
                                @endforeach
                            </ul>
                            <input type="hidden" name="sub_truck_type_id" id="sub_truck_type_truck_id"
                                value="{{ request('sub_truck_type_id') }}">
                        </div>
                    </div>


                    <!-- Weight -->
                    <div class="form-group col-12 col-md-6 col-lg-3">
                        <label for="weight">{{ __('index.Weight') }}</label>
                        <input type="number" name="weight" id="weight" class="form-control"
                            value="{{ request('weight') }}"
                            style="width: 100%; font-size: 16px; height: 44px; padding: 0 10px;">
                    </div>
                    <!-- Length -->
                    <div class="form-group col-12 col-md-6 col-lg-3">
                        <label for="length">{{ __('index.Length') }}</label>
                        <input type="number" name="length" id="length" class="form-control"
                            value="{{ request('length') }}"
                            style="width: 100%; font-size: 16px; height: 44px; padding: 0 10px;">
                    </div>


                    <div class="form-group col-12 col-md-6 col-lg-2">
                        <label for="location_to_truck">{{ __('index.date') }}</label>
                        <input type="date" name="date" id="date" class="form-contron date-input"
                            value="{{ request('date') }}" style=" font-size: 16px; height: 44px; padding: 0 10px;">
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group col-12 text-center">
                        <button type="submit" class="btn btn-primary"
                            style="width: 100%; max-width: 200px; margin: 0 auto;">{{ __('index.Search') }}</button>
                    </div>
                </div>
            </form>
        </div>

    </div>


    <!-- Page Fleets Start -->
    <div class="page-fleets">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Fleets Sidebar Start -->
                    <div class="fleets-sidebar wow fadeInUp">
                        <!-- Fleets Search Box Start -->
                        <div class="fleets-search-box">
                            <form id="fleetsForm" action="#" method="POST">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" id="search"
                                        placeholder="Search..." required="">
                                    <button type="submit" class="section-icon-btn"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                        <!-- Fleets Search Box End -->

                        <div class="fleets-sidebar-list-box">
                            <!-- Fleets Sidebar List Start -->
                            <div class="fleets-sidebar-list">

                                <div class="filter-group">
                                    <h4>Price Range</h4>
                                    <div class="price-slider">
                                        <input type="range" class="form-range" min="50" max="1000"
                                            step="50" id="priceMin" value="50">
                                        <input type="range" class="form-range" min="50" max="1000"
                                            step="50" id="priceMax" value="1000">
                                        <div class="price-values">
                                            <span id="minValue">AED50</span> - <span id="maxValue">AED1000</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sorting Options -->

                                {{--
                                <div class="filter-group">
                                    <h4>Vehicle Condition</h4>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="conditionNew">
                                        <label class="form-check-label" for="conditionNew">New</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="conditionUsed">
                                        <label class="form-check-label" for="conditionUsed">Used</label>
                                    </div>
                                </div> --}}

                                <!-- Special Offers -->
                                <div class="filter-group">
                                    <h4>Special Offers</h4>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="offerDiscount">
                                        <label class="form-check-label" for="offerDiscount">With Discount</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="offerFeatured">
                                        <label class="form-check-label" for="offerFeatured">Featured</label>
                                    </div>
                                </div>
                                <button class="btn btn-primary w-100 mt-3" id="applyFilters">Apply Filters</button>
                                <button class="btn btn-outline-secondary w-100 mt-2" id="resetFilters">Reset All</button>


                                <div class="fleets-list-title">
                                    <h3>categories</h3>
                                </div>

                                <ul>

                                    @if (count($category) > 0)
                                        @foreach ($category as $key => $categoryone)
                                            <li class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="checkbox1">
                                                <label class="form-check-label"
                                                    for="checkbox1">{{ $categoryone->title }}</label>
                                            </li>
                                        @endforeach
                                    @endif



                                </ul>
                            </div>
                            <!-- Fleets Sidebar List End -->

                            <!-- Fleets Sidebar List Start -->
                            <div class="fleets-sidebar-list">
                                <div class="fleets-list-title">
                                    <h3>pickup location</h3>
                                </div>

                                <ul>
                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox7">
                                        <label class="form-check-label" for="checkbox7">abu dhabi</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox8">
                                        <label class="form-check-label" for="checkbox8">alain</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox9">
                                        <label class="form-check-label" for="checkbox9">dubai</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox10">
                                        <label class="form-check-label" for="checkbox10">sharjah</label>
                                    </li>
                                </ul>
                            </div>
                            <!-- Fleets Sidebar List End -->

                            <!-- Fleets Sidebar List Start -->
                            <div class="fleets-sidebar-list">
                                <div class="fleets-list-title">
                                    <h3>dropoff location</h3>
                                </div>

                                <ul>
                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox11">
                                        <label class="form-check-label" for="checkbox11">abu dhabi</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox12">
                                        <label class="form-check-label" for="checkbox12">alain</label>
                                    </li>

                                    <li class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox13">
                                        <label class="form-check-label" for="checkbox13">dubai</label>
                                    </li>
                                </ul>
                            </div>
                            <!-- Fleets Sidebar List End -->
                        </div>
                    </div>
                    <!-- Fleets Sidebar End -->
                </div>

                <div class="col-lg-9">
                    <!-- Fleets Collection Box Start -->
                    <div class="fleets-collection-box">
                        <div class="row">
                            @if (count($loadPackage) > 0)
                                @foreach ($loadPackage as $key => $truck)
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="card h-100 shadow-sm border-0">
                                            <!-- Truck Image Carousel -->
                                            <div id="truckCarousel-{{ $truck->id }}" class="carousel slide"
                                                data-bs-ride="carousel">
                                                <div class="carousel-inner rounded-top">
                                                    @if ($truck->photos && count($truck->photos) > 0)
                                                        @foreach ($truck->photos as $key => $photo)
                                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                                <img src="{{ asset($photo->path) }}"
                                                                    class="d-block w-100"
                                                                    style="height: 200px; object-fit: cover;"
                                                                    alt="{{ $truck->title }}">
                                                                <div class="image-overlay"></div>

                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="carousel-item active">
                                                            <img src="{{ asset('path/to/default/truck/image.jpg') }}"
                                                                class="d-block w-100"
                                                                style="height: 200px; object-fit: cover;"
                                                                alt="{{ $truck->title }}">
                                                            <div class="image-overlay"></div>

                                                        </div>
                                                    @endif
                                                </div>
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#truckCarousel-{{ $truck->id }}"
                                                    data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#truckCarousel-{{ $truck->id }}"
                                                    data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>

                                            <div class="card-body"
                                                style="background: linear-gradient(135deg, #db1515 0%, #070202 100%);">
                                                <div class="d-flex justify-content-between align-items-start mb-3">
                                                    {{-- <div>
                                                        <h3 class="h6 text-white mb-1">{{ $truck->truck_type }} </h3>
                                                        <h2 class="h5 text-white mb-0">{{ $truck->title }}</h2>
                                                    </div> --}}


                                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                                        <div>
                                                            <h3 class="h6 text-white mb-1">
                                                                {{ $truck->truckType->name ?? 'غير محدد' }}</h3>
                                                            <h2 class="h5 text-white mb-0">{{ $truck->title }}</h2>
                                                        </div>

                                                        @if ($truck->truckSubType)
                                                            <span class="badge bg-secondary">
                                                                {{ $truck->truckSubType->name }}
                                                                @if ($truck->truckSubType->capacity)
                                                                    ({{ $truck->truckSubType->capacity }})
                                                                @endif
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <div class="truck-meta">
                                                        <span
                                                            class="badge {{ $truck->condition == 'new' ? 'bg-success' : ($truck->condition == 'used' ? 'bg-warning' : 'bg-info') }}">
                                                            {{ ucfirst($truck->condition) }}
                                                        </span>
                                                        @if ($truck->status)
                                                            <span
                                                                class="badge {{ $truck->status == 'booked' ? 'bg-danger' : 'bg-secondary' }}">
                                                                {{ ucfirst($truck->status) }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row g-2 mb-3 text-white">
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-weight-hanging me-2"></i>
                                                            <div>
                                                                <small class="text-light opacity-75 d-block">Weight</small>
                                                                <strong>{{ $truck->weight }} kg</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-ruler-horizontal me-2"></i>
                                                            <div>
                                                                <small class="text-light opacity-75 d-block">Length</small>
                                                                <strong>{{ $truck->totalLength }} m</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-ruler-vertical me-2"></i>
                                                            <div>
                                                                <small class="text-light opacity-75 d-block">Width</small>
                                                                <strong>{{ $truck->totalWidth }} m</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-vector-square me-2"></i>
                                                            <div>
                                                                <small
                                                                    class="text-light opacity-75 d-block">Capacity</small>
                                                                <strong>{{ $truck->weight }}</strong>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-vector-square me-2"></i>
                                                            <div>
                                                                <small class="text-light opacity-75 d-block">load
                                                                    Number</small>
                                                                <strong>{{ $truck->loadNumber }}</strong>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-map-marker-alt me-2"></i>
                                                            <div>
                                                                <small
                                                                    class="text-light opacity-75 d-block">Location</small>
                                                                <strong>{{ $truck->loadFrom }},
                                                                    {{ $truck->dropTo }}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if ($truck->specification)
                                                        <div class="col-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="fas fa-gas-pump me-2"></i>
                                                                <div>
                                                                    <small class="text-light opacity-75 d-block">Fuel
                                                                        Type</small>
                                                                    <strong>{{ $truck->specification->fuel_type }}</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div
                                                    class="d-flex justify-content-between align-items-center pt-2 border-top border-light">
                                                    <div class="perfect-fleet-pricing">
                                                        <h2 class="h5 text-white mb-0">
                                                            ${{ number_format($truck->price, 2) }}<small
                                                                class="text-light opacity-75">/day</small></h2>
                                                        @if ($truck->offer_price && $truck->offer_price != $truck->price)
                                                            <small
                                                                class="text-light opacity-75"><del>${{ number_format($truck->offer_price, 2) }}</del></small>
                                                        @endif
                                                    </div>
                                                    <a href="{{ route('shipments.show', $truck->slug) }}"
                                                        class="btn btn-sm btn-outline-light">
                                                        <i class="fas fa-eye me-1"></i> View Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                            @endif






                            <div class="col-lg-12">

                                {{-- {{ $trucks->links('pagination::bootstrap-4') }} --}}

                                <!-- Fleets Pagination Start -->
                                {{-- <div class="fleets-pagination wow fadeInUp" data-wow-delay="0.5s">
                                    <ul class="pagination">
                                        <li><a href="#"><i class="fa-solid fa-arrow-left-long"></i></a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#"><i class="fa-solid fa-arrow-right-long"></i></a></li>
                                    </ul>
                                </div> --}}
                                <!-- Fleets Pagination End -->
                            </div>
                        </div>
                    </div>
                    <!-- Fleets Collection Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Fleets End -->




    <!-- Jquery Library File -->
    <script src="{{ asset('car/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Jquery Ui Js File -->
    <script src="{{ asset('car/js/jquery-ui.js') }}"></script>
    <!-- Bootstrap js file -->
    <script src="{{ asset('car/js/bootstrap.min.js') }}"></script>
    <!-- Validator js file -->
    <script src="{{ asset('car/js/validator.min.js') }}"></script>
    <!-- SlickNav js file -->
    <script src="{{ asset('car/js/jquery.slicknav.js') }}"></script>
    {{-- <!-- Swiper js file -->
    <script src="{{ asset('car/js/swiper-bundle.min.js') }}"></script>
    <!-- Counter js file -->
    <script src="{{ asset('car/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('car/js/jquery.counterup.min.js') }}"></script>
    <!-- Magnific js file -->
    <script src="{{ asset('car/js/jquery.magnific-popup.min.js') }}"></script> --}}
    <!-- SmoothScroll -->
    {{-- <script src="{{ asset('car/js/SmoothScroll.js') }}"></script>
    <!-- Parallax js -->
    <script src="{{ asset('car/js/parallaxie.js') }}"></script>
    <!-- MagicCursor js file --> --}}
    {{-- <script src="{{ asset('car/js/gsap.min.js') }}"></script>
    <script src="{{ asset('car/js/magiccursor.js') }}"></script> --}}
    <!-- Text Effect js file -->
    {{-- <script src="{{ asset('car/js/SplitText.js') }}"></script> --}}
    {{-- <script src="{{ asset('car/js/ScrollTrigger.min.js') }}"></script> --}}
    <!-- YTPlayer js File -->
    {{-- <script src="{{ asset('car/js/jquery.mb.YTPlayer.min.js') }}"></script> --}}
    <!-- Wow js file -->
    {{-- <script src="{{ asset('car/js/wow.js') }}"></script>
    <!-- Main Custom js file -->
    {{-- <script src="{{ asset('car/js/function.js') }}"></script>
    <script src="{{ asset('car/../../assets/js/theme-panel.js') }}"></script> --}}


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Price Range Slider
            const priceMin = document.getElementById('priceMin');
            const priceMax = document.getElementById('priceMax');
            const minValue = document.getElementById('minValue');
            const maxValue = document.getElementById('maxValue');

            priceMin.addEventListener('input', function() {
                minValue.textContent = '$' + this.value;
                if (parseInt(priceMax.value) < parseInt(this.value)) {
                    priceMax.value = this.value;
                    maxValue.textContent = '$' + this.value;
                }
            });

            priceMax.addEventListener('input', function() {
                maxValue.textContent = '$' + this.value;
                if (parseInt(priceMin.value) > parseInt(this.value)) {
                    priceMin.value = this.value;
                    minValue.textContent = '$' + this.value;
                }
            });

            // Apply Filters
            document.getElementById('applyFilters').addEventListener('click', function() {
                // هنا يمكنك إضافة كود AJAX لتصفية النتائج
                alert('Filters applied! (Simulation)');
            });

            // Reset Filters
            document.getElementById('resetFilters').addEventListener('click', function() {
                priceMin.value = 50;
                priceMax.value = 1000;
                minValue.textContent = '$50';
                maxValue.textContent = '$1000';
                document.getElementById('sortBy').value = 'default';
                document.querySelectorAll('.form-check-input').forEach(checkbox => {
                    checkbox.checked = false;
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const truckTypeSelect = document.getElementById('truck_type');
            const subTruckTypeSelect = document.getElementById('sub_truck_type');

            // تحميل الأنواع الفرعية عند تغيير النوع الرئيسي
            truckTypeSelect.addEventListener('change', function() {
                const typeId = this.value;
                subTruckTypeSelect.innerHTML = '<option value="">اختر النوع الفرعي</option>';
                subTruckTypeSelect.disabled = true;

                if (typeId) {
                    // البحث عن الأنواع الفرعية في البيانات المحملة مسبقاً
                    const selectedType = @json($truckTypes).find(type => type.id == typeId);

                    if (selectedType && selectedType.sub_types) {
                        selectedType.sub_types.forEach(subType => {
                            const option = new Option(
                                `${subType.name} (${subType.capacity})`,
                                subType.id
                            );
                            subTruckTypeSelect.add(option);
                        });
                        subTruckTypeSelect.disabled = false;
                    }
                }
            });

            // تعيين القيم المحددة مسبقاً إذا كانت موجودة
            @if (request('truck_type'))
                truckTypeSelect.value = '{{ request('truck_type') }}';
                truckTypeSelect.dispatchEvent(new Event('change'));

                @if (request('sub_truck_type'))
                    setTimeout(() => {
                        subTruckTypeSelect.value = '{{ request('sub_truck_type') }}';
                    }, 100);
                @endif
            @endif
        });
    </script>
@endsection
