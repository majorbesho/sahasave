@extends('frontend.layouts.master')





@section('content')
    <style>
        .timeline {
            position: relative;
            padding-left: 1.5rem;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 1.5rem;
            border-left: 2px solid #e9ecef;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-point {
            position: absolute;
            left: -0.5rem;
            top: 0;
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
            background-color: #dee2e6;
            border: 2px solid white;
        }

        .timeline-item.completed .timeline-point {
            background-color: #0d6efd;
        }

        .timeline-item.current .timeline-point {
            background-color: #ffc107;
        }

        .timeline-content {
            padding-left: 1rem;
        }

        .timeline-item.completed {
            border-left-color: #0d6efd;
        }

        .timeline-item.current {
            border-left-color: #ffc107;
        }

        .card {
            border-radius: 12px;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .badge {
            font-weight: 500;
        }
    </style>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Package Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-primary">{{ $package->title }}</h1>
                    <span
                        class="badge bg-{{ $package->status === 'active' ? 'success' : 'secondary' }} rounded-pill px-3 py-2">
                        {{ ucfirst($package->status) }}
                    </span>
                </div>

                <!-- Tracking Info -->
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">
                                <i class="fas fa-truck me-2 text-primary"></i> Tracking Information
                            </h5>
                            <span
                                class="badge bg-{{ $package->trackingStatus === 'delayed' ? 'warning' : 'info' }} text-dark">
                                {{ ucfirst($package->trackingStatus) }}
                            </span>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-barcode fa-lg text-muted"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Tracking Number</h6>
                                        <p class="mb-0">{{ $package->trackingNumber }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-link fa-lg text-muted"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Tracking URL</h6>
                                        <a href="{{ $package->trackingUrl }}" target="_blank" class="text-decoration-none">
                                            View Tracking <i class="fas fa-external-link-alt ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tracking Timeline -->
                        <div class="mt-4">
                            <h6 class="text-muted mb-3">Delivery Progress</h6>
                            <div class="timeline">
                                <div class="timeline-item completed">
                                    <div class="timeline-point"></div>
                                    <div class="timeline-content">
                                        <h6>Package Received</h6>
                                        <p class="text-muted mb-0">{{ $package->loadDate }} at {{ $package->loadTime }}</p>
                                    </div>
                                </div>
                                <div
                                    class="timeline-item {{ $package->trackingStatus === 'delivered' ? 'completed' : '' }}">
                                    <div class="timeline-point"></div>
                                    <div class="timeline-content">
                                        <h6>In Transit</h6>
                                        <p class="text-muted mb-0">En route to destination</p>
                                    </div>
                                </div>
                                <div
                                    class="timeline-item {{ $package->trackingStatus === 'delivered' ? 'completed' : '' }}">
                                    <div class="timeline-point"></div>
                                    <div class="timeline-content">
                                        <h6>Out for Delivery</h6>
                                        <p class="text-muted mb-0">With local courier</p>
                                    </div>
                                </div>
                                <div
                                    class="timeline-item {{ $package->trackingStatus === 'delivered' ? 'completed' : 'current' }}">
                                    <div class="timeline-point"></div>
                                    <div class="timeline-content">
                                        <h6>Delivery</h6>
                                        <p class="text-muted mb-0">
                                            @if ($package->trackingStatus === 'delivered')
                                                Delivered on {{ $package->dropDate }} at {{ $package->dropTime }}
                                            @else
                                                Expected delivery
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Package Details -->
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm h-100 border-0">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4">
                                    <i class="fas fa-box-open me-2 text-primary"></i> Package Details
                                </h5>

                                <div class="mb-3">
                                    <img src="{{ $package->photo }}" alt="{{ $package->title }}"
                                        class="img-fluid rounded-3 mb-3">
                                </div>

                                <div class="mb-3">
                                    <h6>Description</h6>
                                    <p class="text-muted">{{ $package->discreption ?: 'No description provided' }}</p>
                                </div>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <h6>Total Items</h6>
                                        <p class="text-muted">{{ number_format($package->totalItems) }}</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Load Type</h6>
                                        <p class="text-muted">{{ ucfirst(str_replace('_', ' ', $package->loadType)) }}</p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h6>Dimensions</h6>
                                    <p class="text-muted">
                                        {{ $package->totalLength }} x {{ $package->totalWidth }} x
                                        {{ $package->totalHeight }}
                                        <span class="text-muted small">(L x W x H)</span>
                                    </p>
                                </div>

                                <div class="mb-3">
                                    <h6>Weight</h6>
                                    <p class="text-muted">{{ number_format($package->weight, 2) }} kg</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6 mb-4">
                        <!-- Shipping Information -->
                        <div class="card shadow-sm mb-4 border-0">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4">
                                    <i class="fas fa-shipping-fast me-2 text-primary"></i> Shipping Information
                                </h5>

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <h6>Load Information</h6>
                                        <p class="text-muted mb-1">
                                            <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                            <strong>From:</strong> {{ $package->loadFrom }}
                                        </p>
                                        <p class="text-muted mb-1">
                                            <i class="fas fa-calendar-alt me-2"></i>
                                            {{ $package->loadDate }} at {{ $package->loadTime }}
                                        </p>
                                        <p class="text-muted mb-0">
                                            <i class="fas fa-user me-2"></i>
                                            Loaded by: {{ $package->loadBy }}
                                        </p>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <h6>Delivery Information</h6>
                                        <p class="text-muted mb-1">
                                            <i class="fas fa-map-marker-alt text-success me-2"></i>
                                            <strong>To:</strong> {{ $package->dropTo }}
                                        </p>
                                        <p class="text-muted mb-1">
                                            <i class="fas fa-calendar-alt me-2"></i>
                                            {{ $package->dropDate }} at {{ $package->dropTime }}
                                        </p>
                                        <p class="text-muted mb-0">
                                            <i class="fas fa-user me-2"></i>
                                            Received by: {{ $package->dropBy }}
                                        </p>
                                    </div>

                                    <div class="col-12">
                                        <h6>Notes</h6>
                                        <p class="text-muted mb-0">{{ $package->loadNotes ?: 'No notes available' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div class="card shadow-sm border-0">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4">
                                    <i class="fas fa-credit-card me-2 text-primary"></i> Payment Information
                                </h5>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <h6>Payment Type</h6>
                                        <p class="text-muted">{{ ucfirst(str_replace('_', ' ', $package->paymentType)) }}
                                        </p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Payment Method</h6>
                                        <p class="text-muted">{{ ucfirst($package->paymentMethod) }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <h6>Payment Status</h6>
                                        <span
                                            class="badge bg-{{ $package->paymentStatus === 'failed' ? 'danger' : 'success' }}">
                                            {{ ucfirst($package->paymentStatus) }}
                                        </span>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Payment Date</h6>
                                        <p class="text-muted">{{ $package->paymentDate }}</p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h6>Reference</h6>
                                    <p class="text-muted">{{ $package->paymentRef ?: 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Back to Packages
                    </a>
                    <div>
                        <button class="btn btn-outline-primary me-2">
                            <i class="fas fa-print me-2"></i> Print Details
                        </button>
                        <button class="btn btn-primary">
                            <i class="fas fa-headset me-2"></i> Contact Support
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('content')
@endsection
