{@extends('frontend.layouts.master')

@section('styles')
    <style>
        :root {
            --primary-color: #db1515;
            --secondary-color: #2c3e50;
            --accent-color: #Fabc3f;
            --dark-text: #333333;
            --light-text: #666666;
            --border-color: #e0e0e0;
        }

        h1 {
            color: #Fabc3f
        }

        span {
            color: #Fabc3f;
        }

        .truck-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: #Fabc3f;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .main-image {
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }

        .thumbnail {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .thumbnail:hover,
        .thumbnail.active {
            border-color: var(--accent-color);
            transform: translateY(-5px);
        }

        .specs-card {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
            border: none;
            background-color: #Fabc3f;
        }

        .price-badge {
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }

        .detail-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #Fabc3f;
            margin-right: 10px;
        }

        .booking-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .status-badge {
            font-size: 0.9rem;
            padding: 8px 15px;
            border-radius: 50px;
        }

        .status-booked {
            background-color: #dc3545;
            color: white;
        }

        .status-available {
            background-color: #28a745;
            color: white;
        }

        .condition-used {
            background-color: #ffc107;
            color: #000;
        }

        .condition-new {
            background-color: #17a2b8;
            color: white;
        }

        .action-btns {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .owner-card {
            background-color: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .owner-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .card-title {
            color: var(--secondary-color);
            font-weight: 600;
        }

        .card-text,
        .spec-item {
            color: var(--light-text);
        }

        .section-title {
            color: var(--secondary-color);
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .section-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }


        .truck-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .main-image {
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }

        .main-image:hover {
            transform: scale(1.02);
        }

        .thumbnail {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .thumbnail:hover,
        .thumbnail.active {
            border-color: var(--accent-color);
            transform: translateY(-5px);
        }

        .specs-card {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
            border: none;
        }

        .specs-card:hover {
            transform: translateY(-5px);
        }

        .price-badge {
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }

        .detail-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-left: 10px;
        }

        .booking-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .status-badge {
            font-size: 0.9rem;
            padding: 8px 15px;
            border-radius: 50px;
        }

        .status-booked {
            background-color: #dc3545;
        }

        .status-active {
            background-color: #28a745;
        }

        .condition-used {
            background-color: #ffc107;
            color: #000;
        }

        .gallery-section {
            background-color: #f1f1f1;
            border-radius: 15px;
            padding: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <!-- Header Section -->

        <div class="truck-header p-4 mb-4"
            style="background: linear-gradient(135deg, #db1515 0%, #070202 100%);border-radius: 15px">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="fw-bold mb-2" style="color:#Fabc3f !important ">{{ $truck->title }}</h1>
                    <div class="d-flex align-items-center mb-3">
                        <span class="status-badge status-{{ $truck->status }} me-2" style="color:#Fabc3f">
                            {{ $truck->status === 'booked' ? 'Booked' : 'Available' }}
                        </span>
                        {{-- <span class="status-badge condition-{{ $truck->condition }}">
                            {{ $truck->condition === 'used' ? 'Used' : 'New' }}
                        </span> --}}
                    </div>
                    <div class="d-flex align-items-center ">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <span style="color: #Fabc3f">{{ $truck->location_city }}, {{ $truck->location_country }}</span>
                    </div>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <div class="price-badge badge rounded-pill p-3">
                        @if ($truck->offer_price && $truck->offer_price != $truck->price)
                            <span class="text-decoration-line-through  me-2"
                                style="color: #Fabc3f">${{ number_format($truck->offer_price, 2) }}</span>
                        @endif
                        ${{ number_format($truck->price, 2) }} <small style="color: #Fabc3f">/ day</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Owner Information -->
                <div class="owner-card"
                    style="background: linear-gradient(135deg, #db1515 0%, #070202 100%);border-radius: 15px">
                    <h4 class="section-title" style="color: #Fabc3f">Owner Information</h4>
                    <div class="d-flex align-items-center">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($truck->truck_owner->name ?? 'Owner') }}&background=random"
                            alt="Owner" class="owner-avatar me-3">
                        <div>
                            <h5 class="mb-1" style="color: #Fabc3f">{{ $truck->truck_owner->name ?? 'Owner Name' }}</h5>
                            <p class="mb-1"><i class="fas fa-phone me-2"></i> {{ $truck->truck_owner->phone ?? 'N/A' }}
                            </p>
                            <p class="mb-0"><i class="fas fa-envelope me-2"></i>
                                {{ $truck->truck_owner->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="action-btns">
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-phone me-2"></i> Contact Owner
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-comment me-2"></i> Send Message
                        </button>
                    </div>
                </div>

                <!-- Main Image and Gallery -->
                <img src="{{ $truck->photos[0]->photo_path }}" alt="{{ $truck->title }}" class="main-image w-100 mb-3"
                    style="background: linear-gradient(135deg, #db1515 0%, #070202 100%);border-radius: 15px">

                @if (count($truck->photos) > 1)
                    <div class="gallery-section mb-4"
                        style="background: linear-gradient(135deg, #db1515 0%, #070202 100%);border-radius: 15px">
                        <h4 class="section-title" style="color: #Fabc3f">Photo Gallery</h4>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($truck->photos as $photo)
                                <img src="{{ $photo->photo_path }}" alt="Truck photo {{ $loop->iteration }}"
                                    class="thumbnail" onclick="changeMainImage(this)">
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Description -->
                <div class="card specs-card mb-4"
                    style="background: linear-gradient(135deg, #db1515 0%, #070202 100%);border-radius: 15px">
                    <div class="card-body">
                        <h4 class="section-title">Description</h4>
                        <p class="card-text">{{ $truck->description ?? 'No description available' }}</p>
                    </div>
                </div>

                <!-- Specifications -->
                <div class="card specs-card mb-4"
                    style="background: linear-gradient(135deg, #db1515 0%, #070202 100%);border-radius: 15px">
                    <div class="card-body">
                        <h4 class="section-title">Specifications</h4>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3 spec-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-weight-hanging"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Weight</h6>
                                        <p class="mb-0">{{ $truck->weight }} kg</p>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mb-3 spec-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-ruler-combined"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Dimensions</h6>
                                        <p class="mb-0">{{ $truck->length }} m (L) × {{ $truck->width }} m (W)</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3 spec-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-tachometer-alt"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Capacity</h6>
                                        <p class="mb-0">{{ $truck->capacity }}</p>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center mb-3 spec-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Truck Type</h6>
                                        <p class="mb-0">{{ $truck->truck_type ?: 'Not specified' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Booking Card -->
                <div class="card booking-card mb-4"
                    style="background: linear-gradient(135deg, #db1515 0%, #070202 100%);border-radius: 15px">
                    <div class="card-body">
                        <h4 class="section-title" style="color: #Fabc3f">Book This Truck</h4>

                        @if ($truck->status === 'booked')
                            <div class="alert alert-danger">
                                This truck is currently booked
                            </div>
                        @else
                            <form>
                                <div class="mb-3"
                                    style="background: linear-gradient(135deg, #db1515 0%, #070202 100%);border-radius: 15px">
                                    <label for="startDate" class="form-label" style="color: #Fabc3f">Start Date</label>
                                    <input type="date" class="form-control" id="startDate" required>
                                </div>
                                <div class="mb-3">
                                    <label for="endDate" class="form-label" style="color: #Fabc3f">End Date</label>
                                    <input type="date" class="form-control" id="endDate" required>
                                </div>
                                <div class="mb-3">
                                    <label for="paymentMethod" class="form-label" style="color: #Fabc3f">Payment
                                        Method</label>
                                    <select class="form-select" id="paymentMethod">
                                        <option value="credit">Credit Card</option>
                                        <option value="bank">Bank Transfer</option>
                                        <option value="cash">Cash on Delivery</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                                    <i class="fas fa-check-circle me-2"></i> Confirm Booking
                                </button>
                            </form>
                        @endif

                        <hr class="my-4">

                        <div class="d-flex justify-content-between align-items-center">
                            <span>Daily Price:</span>
                            <span class="fw-bold" style="color: #Fabc3f"> ${{ number_format($truck->price, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Tax:</span>
                            <span class="fw-bold" style="color: #Fabc3f">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="h5">Total:</span>
                            <span class="h5 fw-bold" style="color: #Fabc3f">${{ number_format($truck->price, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card booking-card"
                    style="background: linear-gradient(135deg, #db1515 0%, #070202 100%);border-radius: 15px">
                    <div class="card-body">
                        <h4 class="section-title">Quick Actions</h4>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary">
                                <i class="fas fa-heart me-2"></i> Add to Favorites
                            </button>
                            <button class="btn btn-outline-primary">
                                <i class="fas fa-share-alt me-2"></i> Share This Truck
                            </button>
                            <button class="btn btn-outline-primary">
                                <i class="fas fa-flag me-2"></i> Report Listing
                            </button>
                            <button class="btn btn-outline-primary">
                                <i class="fas fa-print me-2"></i> Print Details
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function changeMainImage(element) {
            const mainImage = document.querySelector('.main-image');
            mainImage.src = element.src;

            // Update active thumbnail
            document.querySelectorAll('.thumbnail').forEach(thumb => {
                thumb.classList.remove('active');
            });
            element.classList.add('active');
        }

        // Initialize map (example using Leaflet)
        function initMap() {
            if ({{ $truck->latitude }} && {{ $truck->longitude }}) {
                // Actual implementation would use a map library like Leaflet or Google Maps
                console.log('Map would be initialized at:', {{ $truck->latitude }}, {{ $truck->longitude }});
            }
        }

        document.addEventListener('DOMContentLoaded', initMap);
    </script>
@endsection
}
