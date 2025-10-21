@extends('frontend.layouts.master')

@section('content')



    <style>
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


    <div class="container-fluid"
        style="padding-top: 47px; display: flex; background: rgba(255, 255, 255, 0.2);
    border-radius: 10px; backdrop-filter: blur(10px); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); flex-wrap: nowrap;
    align-content: stretch; align-items: stretch; justify-content: center; padding-bottom: 9%;">


        <div class="row"
            style="align-items: center; align-content: space-between; flex-direction: row; display: flex; background: rgb(159 159 159 / 20%);
    border-radius: 10px; backdrop-filter: blur(10px); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); flex-wrap: nowrap;
    align-content: stretch; align-items: stretch; justify-content: center;">
            <form action="{{ route('searchresultx') }}" method="post" class="searchForm"
                style="background: rgba(255, 255, 255, 0.2); border-radius: 10px; backdrop-filter: blur(10px); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); width: 100%; padding: 15px;
                z-index: 10;
                margin-top:73px">
                @csrf
                <div class="form-row" style="display: flex; flex-wrap: wrap; gap: 10px;">
                    <!-- Origin -->
                    <div class="form-group col-12 col-md-6 col-lg-2">
                        <label for="location_from_truck">{{ __('index.Origin') }}</label>
                        <input type="text" name="location_from" id="location_from_truck"
                            class="form-control city-autocomplete" value="{{ request('location_from') }}"
                            placeholder="City Origin" style=" font-size: 16px; height: 44px; padding: 0 10px;">
                    </div>

                    <!-- Destination -->
                    <div class="form-group col-12 col-md-6 col-lg-2">
                        <label for="location_to_truck">{{ __('index.Destination') }}</label>
                        <input type="text" name="location_to" id="location_to_truck"
                            class="form-control city-autocomplete" value="{{ request('location_to') }}"
                            placeholder="City Destination" style=" font-size: 16px; height: 44px; padding: 0 10px;">
                    </div>


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


                    <div class="row">

                        <div class="form-group col-12 col-md-6 col-lg-2">
                            <label for="weight_truck">{{ __('index.Weight') }}</label>
                            <input type="number" name="weight" id="weight_truck" class="form-control"
                                value="{{ request('weight') }}" style="font-size: 16px; height: 44px; padding: 0 10px;">
                        </div>
                        <!-- Length -->
                        <div class="form-group col-12 col-md-6 col-lg-2">
                            <label for="length_truck">{{ __('index.Length') }}</label>
                            <input type="number" name="length" id="length_truck" class="form-control"
                                value="{{ request('length') }}" style=" font-size: 16px; height: 44px; padding: 0 10px;">
                        </div>


                        <div class="form-group col-12 col-md-6 col-lg-2">
                            <label for="location_to_truck">{{ __('index.date') }}</label>
                            <input type="date" name="date" id="date" class="form-contron date-input"
                                value="{{ request('date') }}" style=" font-size: 16px; height: 44px; padding: 0 10px;">
                        </div>


                    </div>





                    <!-- Weight -->
                    {{-- <div class="form-group col-12 col-md-6 col-lg-3">
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
                    </div> --}}
                    <!-- Price -->
                    {{-- <div class="form-group col-12 col-md-6 col-lg-3">
                        <label for="price">{{ __('index.Price') }}</label>
                        <input type="number" name="price" id="price" class="form-control"
                            value="{{ request('price') }}"
                            style="width: 100%; font-size: 16px; height: 44px; padding: 0 10px;">
                    </div> --}}
                    <!-- Submit Button -->
                    <div class="form-group col-12 text-center">
                        <button type="submit" class="btn btn-primary"
                            style="width: 100%; max-width: 200px; margin: 0 auto;">{{ __('index.Search') }}</button>
                    </div>
                </div>
            </form>









        </div>
    </div>

    @if ($packages->isEmpty())
        <div class="alert alert-info">
            No packages found matching your criteria.
        </div>
    @else
        {{-- //الاصلي --}}
        <div class="row g-4">
            @foreach ($packages as $package)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 package-card shadow-sm border-0 overflow-hidden">
                        @if ($package->photo)
                            <div class="package-image-wrapper">
                                <img src="{{ asset('storage/' . $package->photo) }}" class="card-img-top img-fluid"
                                    alt="{{ $package->title }}">
                                <div class="image-overlay"></div>
                            </div>
                        @endif
                        <div class="card-body position-relative"
                            style="background: linear-gradient(135deg, #db1515 0%, #070202 100%);">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="card-title text-white mb-0">{{ $package->title }}</h5>
                                <span
                                    class="badge bg-light text-dark rounded-pill">${{ number_format((float) $package->shipment, 2) }}</span>
                            </div>

                            <div class="package-details text-white">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    <div>
                                        <small class="text-light opacity-75">From</small>
                                        <div>{{ $package->loadFrom }}</div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-map-marked-alt me-2"></i>
                                    <div>
                                        <small class="text-light opacity-75">To</small>
                                        <div>{{ $package->loadTo }}</div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center me-3">
                                        <i class="fas fa-weight-hanging me-2"></i>
                                        <div>
                                            <small class="text-light opacity-75">Weight</small>
                                            <div>{{ $package->weight }} kg</div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-ruler-combined me-2"></i>
                                        <div>
                                            <small class="text-light opacity-75">Dimensions</small>
                                            <div>
                                                {{ $package->totalLength }}x{{ $package->totalWidth }}x{{ $package->totalHeight }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <a href="{{ route('package.details', $package->slug) }}"
                                    class="btn btn-outline-light btn-sm rounded-pill px-4">
                                    <i class="fas fa-eye me-1"></i> View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="d-flex justify-content-center mt-4 pb-5">
            {{ $packages->appends($searchParams)->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
        </div>
    @endif
    </div>
@endsection
