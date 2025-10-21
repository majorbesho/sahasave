@extends('frontend.layouts.master')

@section('content')
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
    </style>




    <div class="container"
        style="padding-top: 47px; display: flex;background: rgb(159 159 159 / 20%);
        border-radius: 10px; backdrop-filter: blur(10px); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); flex-wrap: nowrap;
        align-content: stretch; align-items: stretch; justify-content: center;">
        <div class="row"
            style="align-items: center; align-content: space-between; flex-direction: row; background: rgb(159 159 159 / 20%);">
            <form action="{{ route('search.Loads.Result') }}" method="post" class="searchForm"
                style="background: rgba(255, 255, 255, 0.2); border-radius: 10px; backdrop-filter: blur(10px); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); width: 100%; padding: 15px;">
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
                    {{-- <div class="form-group col-12 col-md-6 col-lg-3">
                        <label for="SahaSave.com">SahaSave.com</label>
                        <select class="form-control" name="cat_id"
                            style="width: 100%; font-size: 16px; height: 44px; padding: 0 10px;">
                            <option value="" selected disabled>SahaSave.com Type</option>
                            @foreach (\App\Models\Category::get() as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="form-group col-12 col-md-6 col-lg-3">
                        <label for="SahaSave.com">{{ __('index.SahaSave.com') }}</label>
                        <div class="custom-dropdown">
                            <div class="dropdown-header">
                                <span class="selected-value">SahaSave.com Type</span>
                                <span class="arrow">&#9660;</span>
                            </div>
                            <ul class="dropdown-list">
                                <option value="" selected disabled>SahaSave.com Type</option>
                                @foreach (\App\Models\Category::get() as $brand)
                                    <li class="dropdown-option" data-value="{{ $brand->id }}">
                                        {{ $brand->title }}
                                    </li>
                                @endforeach
                            </ul>
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
                    <!-- Price -->
                    <div class="form-group col-12 col-md-6 col-lg-3">
                        <label for="price">{{ __('index.Price') }}</label>
                        <input type="number" name="price" id="price" class="form-control"
                            value="{{ request('price') }}"
                            style="width: 100%; font-size: 16px; height: 44px; padding: 0 10px;">
                    </div>
                    <!-- Submit Button -->
                    <div class="form-group col-12 text-center">
                        <button type="submit" class="btn btn-primary"
                            style="width: 100%; max-width: 200px; margin: 0 auto;">{{ __('index.Search') }}</button>
                    </div>
                </div>
                <input type="hidden" name="cat_id" id="cat_id" value="{{ request('cat_id') }}">

            </form>
        </div>
    </div>

    <div class="container-fluid py-4">
        <h2 class="mb-4 text-center">{{ __('Search Results') }}</h2>

        @if ($trucks->count() > 0)
            <div class="row">
                {{-- @foreach ($trucks as $truck)
                     <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <!-- Truck Image Carousel -->
                            <div id="truckCarousel-{{ $truck->id }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner rounded-top">
                                    @if ($truck->photos && count($truck->photos) > 0)
                                        @foreach ($truck->photos as $key => $photo)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <img src="{{ asset($photo->path) }}" class="d-block w-100"
                                                    style="height: 200px; object-fit: cover;" alt="Truck Photo">
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="carousel-item active">
                                            <img src="{{ asset('path/to/default/image.jpg') }}" class="d-block w-100"
                                                style="height: 200px; object-fit: cover;" alt="Default Truck Photo">
                                        </div>
                                    @endif
                                </div>
                                <div id="truckCarousel-{{ $truck->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner rounded-top">
                                        @foreach ($truck->photos ?? [] as $key => $photo)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <img src="{{ asset($photo->path) }}" class="d-block w-100"
                                                    style="height: 200px; object-fit: cover;" alt="Truck Photo">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#truckCarousel-{{ $truck->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#truckCarousel-{{ $truck->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0">{{ $truck->title }}</h5>
                                    <span class="badge bg-success">{{ ucfirst($truck->condition) }}</span>
                                </div>

                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                    <span>{{ $truck->location_city }}, {{ $truck->location_country }}</span>
                                </div>

                                <hr class="my-2">

                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-weight-hanging text-primary me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Capacity</small>
                                                <strong>{{ $truck->capacity }} kg</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-ruler-combined text-info me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Dimensions</small>
                                                <strong>{{ $truck->length }}x{{ $truck->width }}x{{ $truck->height }}m</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-truck text-warning me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Type</small>
                                                <strong>{{ $truck->truck_type }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-dollar-sign text-success me-2"></i>
                                            <div>
                                                <small class="text-muted d-block">Price</small>
                                                <strong>${{ number_format(floatval($truck->price), 2) }}/day</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="fas fa-star {{ $i <= $truck->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                        @endfor
                                        <small class="text-muted ms-1">({{ $truck->reviews_count }})</small>
                                    </div>
                                    <a href="{{ route('truck.details', $truck->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye me-1"></i> View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach --}}




                <div class="row g-4">
                    @foreach ($trucks as $truck)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <!-- Truck Image Carousel -->
                                <div id="truckCarousel-{{ $truck->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner rounded-top">
                                        @if ($truck->photos && count($truck->photos) > 0)
                                            @foreach ($truck->photos as $key => $photo)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                    <img src="{{ asset($photo->path) }}" class="d-block w-100"
                                                        style="height: 200px; object-fit: cover;" alt="Truck Photo">
                                                    <div class="image-overlay"></div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="carousel-item active">
                                                <img src="{{ asset('path/to/default/truck/image.jpg') }}"
                                                    class="d-block w-100" style="height: 200px; object-fit: cover;"
                                                    alt="Default Truck Photo">
                                                <div class="image-overlay"></div>
                                            </div>
                                        @endif
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#truckCarousel-{{ $truck->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#truckCarousel-{{ $truck->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>

                                <div class="card-body"
                                    style="background: linear-gradient(135deg, #db1515 0%, #070202 100%);">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h5 class="card-title text-white mb-0">{{ $truck->title }}</h5>
                                        <span class="badge bg-light text-dark">{{ ucfirst($truck->condition) }}</span>
                                    </div>

                                    <div class="d-flex align-items-center mb-2 text-white">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        <span>From : {{ $truck->location_city }}, <i
                                                class="fas fa-map-marker-alt me-2"></i> To :
                                            {{ $truck->location_country }}</span>
                                    </div>

                                    <hr class="my-2 bg-light">

                                    <div class="row g-2 mb-3 text-white">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-weight-hanging me-2"></i>
                                                <div>
                                                    <small class="text-light opacity-75 d-block">Capacity</small>
                                                    <strong>{{ $truck->capacity }} kg</strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-ruler-combined me-2"></i>
                                                <div>
                                                    <small class="text-light opacity-75 d-block">Dimensions</small>
                                                    <strong>{{ $truck->length }}x{{ $truck->width }}x{{ $truck->height }}
                                                        m</strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-truck me-2"></i>
                                                <div>
                                                    <small class="text-light opacity-75 d-block">Type</small>
                                                    <strong>
                                                        @if ($truck->truckType)
                                                            {{ $truck->truckType->name }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-dollar-sign me-2"></i>
                                                <div>
                                                    <small class="text-light opacity-75 d-block">Price</small>
                                                    <strong>${{ number_format(floatval($truck->price), 2) }}/day</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="rating">
                                            @php
                                                $avgRating = $truck->ratings->avg('rating') ?? 0;
                                                $ratingsCount = $truck->ratings->count() ?? 0;
                                            @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="fas fa-star {{ $i <= $avgRating ? 'text-warning' : 'text-light opacity-50' }}"></i>
                                            @endfor
                                            <small class="text-light opacity-75 ms-1">({{ $ratingsCount }})</small>
                                        </div>
                                        <a href="{{ route('trucks.show', $truck->slug) }}"
                                            class="btn btn-sm btn-outline-light">
                                            <i class="fas fa-eye me-1"></i> View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{-- {{ $trucks->appends(request()->query())->links() }} --}}

                {{-- {{ $trucks->appends($searchParams)->onEachSide(1)->links('vendor.pagination.bootstrap-4') }} --}}

                {{ $trucks->links('pagination::bootstrap-4') }}
            </div>
        @else
            <div class="text-center py-5">
                <div class="empty-state">
                    <i class="fas fa-truck fa-4x text-muted mb-4"></i>
                    <h3 class="mb-3">{{ __('No Trucks Found') }}</h3>
                    <p class="text-muted mb-4">{{ __('We couldn\'t find any trucks matching your search criteria.') }}</p>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i> Modify Search
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection



@push('styles')
    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .empty-state {
            max-width: 500px;
            margin: 0 auto;
        }

        .rating {
            font-size: 0.9rem;
        }

        .badge {
            font-size: 0.75rem;
        }
    </style>
@endpush

@push('scripts')
    <!-- Add any necessary scripts here -->
@endpush
