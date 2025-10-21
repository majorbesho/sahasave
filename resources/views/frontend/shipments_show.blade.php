@extends('frontend.layouts.master')



@section('content')
    <style>
        /* Hero Section */
        .shipment-hero {
            background-size: cover;
            background-position: center;
            padding: 5rem 0;
            margin-bottom: 3rem;
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 50px;
        }

        .timeline:before {
            content: '';
            position: absolute;
            left: 25px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e9ecef;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
        }

        .timeline-badge {
            position: absolute;
            left: -50px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
            box-shadow: 0 0 0 5px white;
        }

        .timeline-content {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            position: relative;
        }

        .timeline-content:after {
            content: '';
            position: absolute;
            left: -10px;
            top: 20px;
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            border-right: 10px solid #f8f9fa;
        }

        /* Cards */
        .card {
            border-radius: 12px;
            overflow: hidden;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Badges */
        .badge {
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        /* Buttons */
        .btn {
            border-radius: 8px;
            padding: 10px 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #4361ee;
            border-color: #4361ee;
        }

        .btn-primary:hover {
            background-color: #3a56d4;
            border-color: #3a56d4;
        }

        p {
            color: #000;
        }
    </style>

    <div class="container-fluid px-0">
        <!-- Hero Section with Shipment Image -->
        <div class="shipment-hero"
            style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ $shipment->photo }}');">
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center text-white">
                        <h1 class="display-5 fw-bold mb-3">{{ $shipment->title }}</h1>
                        <div class="d-flex justify-content-center gap-3">
                            <span
                                class="badge rounded-pill bg-{{ $shipment->status == 'active' ? 'success' : 'danger' }} px-3 py-2">
                                {{ ucfirst($shipment->status) }}
                            </span>
                            <span class="badge rounded-pill bg-info px-3 py-2">
                                #{{ $shipment->trackingNumber }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container py-5">
            <div class="row g-4">
                <!-- Left Column - Shipment Details -->
                <div class="col-lg-8">
                    <!-- Overview Card -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold">Shipment Overview</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-light rounded p-3">
                                            <i class="fas fa-boxes text-primary fs-4"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted small">Total Items</p>
                                            <h5 class="mb-0 fw-bold">{{ $shipment->totalItems }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-light rounded p-3">
                                            <i class="fas fa-weight-hanging text-primary fs-4"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted small">Total Weight</p>
                                            <h5 class="mb-0 fw-bold">{{ number_format($shipment->weight) }} kg</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-light rounded p-3">
                                            <i class="fas fa-truck text-primary fs-4"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted small">Load Type</p>
                                            <h5 class="mb-0 fw-bold text-capitalize">{{ $shipment->loadType }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-light rounded p-3">
                                            <i class="fas fa-calendar-day text-primary fs-4"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted small">Created On</p>
                                            <h5 class="mb-0 fw-bold">{{ $shipment->created_at->format('M d, Y') }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Section -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold">Shipment Timeline</h5>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-badge bg-primary">
                                        <i class="fas fa-truck-loading"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6 class="fw-bold">Load Scheduled</h6>
                                        <p class="small text-muted mb-1">{{ $shipment->loadDate }} at
                                            {{ $shipment->loadTime }}</p>
                                        <p class="mb-0">load From: {{ $shipment->loadFrom }} -
                                            Shipper Name : {{ $shipment->loadTo }}</p>
                                        @if ($shipment->loadNotes)
                                            <div class="alert alert-light mt-2 p-2 small">
                                                <strong>Notes:</strong> {{ $shipment->loadNotes }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-badge bg-success">
                                        <i class="fas fa-truck-moving"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6 class="fw-bold">In Transit</h6>
                                        <p class="small text-muted mb-1">Tracking #{{ $shipment->trackingNumber }}</p>
                                        <a href="{{ $shipment->trackingUrl }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary">
                                            Track Shipment <i class="fas fa-external-link-alt ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-badge bg-warning">
                                        <i class="fas fa-truck-ramp-box"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6 class="fw-bold">Delivery Scheduled</h6>
                                        <p class="small text-muted mb-1">{{ $shipment->dropDate }} at
                                            {{ $shipment->dropTime }}</p>
                                        <p class="mb-0"> drop to: {{ $shipment->dropFrom }} - Receiver name :
                                            {{ $shipment->dropTo }}</p>
                                        @if ($shipment->dropNotes)
                                            <div class="alert alert-light mt-2 p-2 small">
                                                <strong>Notes:</strong> {{ $shipment->dropNotes }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold">Payment Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <p class="text-muted small mb-1">Payment Type</p>
                                    <p class="fw-bold text-capitalize">{{ str_replace('_', ' ', $shipment->paymentType) }}
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="text-muted small mb-1">Payment Status</p>
                                    <p class="fw-bold">
                                        <span
                                            class="badge bg-{{ $shipment->paymentStatus == 'failed' ? 'danger' : 'success' }}">
                                            {{ ucfirst($shipment->paymentStatus) }}
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="text-muted small mb-1">Payment Method</p>
                                    <p class="fw-bold text-capitalize">{{ $shipment->paymentMethod }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p class="text-muted small mb-1">Payment Date</p>
                                    <p class="fw-bold">{{ $shipment->paymentDate }}</p>
                                </div>
                                @if ($shipment->paymentRef)
                                    <div class="col-12">
                                        <p class="text-muted small mb-1">Reference</p>
                                        <p class="fw-bold">{{ $shipment->paymentRef }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Truck and Shipper Info -->
                <div class="col-lg-4">
                    <!-- Truck Information -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold">Truck Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <div class="bg-light rounded p-3 text-center" style="width: 80px;">
                                    <i class="fas fa-truck fa-2x text-primary"></i>
                                </div>
                                <div>
                                    <p class="text-muted small mb-0">Truck Type</p>
                                    <h6 class="fw-bold mb-0">{{ $shipment->truckType->name }}</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <div class="bg-light rounded p-3 text-center" style="width: 80px;">
                                    <i class="fas fa-truck-pickup fa-2x text-primary"></i>
                                </div>
                                <div>
                                    <p class="text-muted small mb-0">Sub Type</p>
                                    <h6 class="fw-bold mb-0">{{ $shipment->truckSubType->name }}</h6>
                                </div>
                            </div>
                            <div class="bg-light p-3 rounded">
                                <div class="row">
                                    <div class="col-6">
                                        <p class="text-muted small mb-1">Capacity</p>
                                        <p class="fw-bold mb-0">{{ $shipment->truckSubType->capacity }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-muted small mb-1">Dimensions</p>
                                        <p class="fw-bold mb-0">{{ $shipment->totalDimensions }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipper Information -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold">Shipper Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="{{ $shipment->shipper->photo }}" alt="Shipper"
                                    class="rounded-circle shadow-sm" width="100" height="100">
                            </div>
                            <h5 class="text-center mb-3">{{ $shipment->shipper->name }}</h5>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="bg-light rounded p-2">
                                    <i class="fas fa-envelope text-primary"></i>
                                </div>
                                <div>
                                    <p class="text-muted small mb-0">Email</p>
                                    <p class="fw-bold mb-0">{{ $shipment->shipper->email }}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="bg-light rounded p-2">
                                    <i class="fas fa-phone text-primary"></i>
                                </div>
                                <div>
                                    <p class="text-muted small mb-0">Phone</p>
                                    <p class="fw-bold mb-0">{{ $shipment->shipper->phone }}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light rounded p-2">
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                </div>
                                <div>
                                    <p class="text-muted small mb-0">Address</p>
                                    <p class="fw-bold mb-0">{{ $shipment->shipper->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0 fw-bold">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ $shipment->trackingUrl }}" target="_blank" class="btn btn-primary">
                                    <i class="fas fa-map-marked-alt me-2"></i> Track Shipment
                                </a>
                                <button class="btn btn-outline-secondary">
                                    <i class="fas fa-file-invoice me-2"></i> Download Invoice
                                </button>
                                <button class="btn btn-outline-danger">
                                    <i class="fas fa-flag me-2"></i> Report Issue
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
