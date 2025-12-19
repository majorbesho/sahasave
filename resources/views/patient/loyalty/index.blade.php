@extends('frontend.layouts.master')

@section('content')

    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Loyalty Points') }}</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">{{ __('Loyalty Rewards Program') }}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Profile Sidebar -->
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                    @include('patient.sidebar')
                </div>
                <!-- /Profile Sidebar -->

                <div class="col-md-7 col-lg-8 col-xl-9">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card bg-primary-light">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="loyalty-info">
                                                <h3 class="mb-3">Current Balance</h3>
                                                <h2 class="mb-2 display-4 text-primary fw-bold">
                                                    {{ $loyaltyPoints->available_points ?? 0 }} <small class="fs-4 text-muted">Points</small>
                                                </h2>
                                                <p class="mb-0">Value: {{ $loyaltyPoints->monetary_value ?? 0 }} SAR</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <div class="loyalty-tier">
                                                <span class="badge bg-warning p-2 fs-5 mb-2">
                                                    <i class="fa-solid fa-crown me-1"></i> {{ ucfirst($loyaltyPoints->tier->name ?? 'Bronze') }} Tier
                                                </span>
                                                <div class="progress mt-3" style="height: 20px;">
                                                    <div class="progress-bar bg-success" role="progressbar" 
                                                        style="width: {{ $stats['progress_to_next_tier'] }}%" 
                                                        aria-valuenow="{{ $stats['progress_to_next_tier'] }}" 
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        {{ $stats['progress_to_next_tier'] }}% to next tier
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Redemptions Card -->
                        <div class="col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h4 class="card-title">Available Rewards</h4>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-info">
                                        <i class="fa-solid fa-info-circle me-1"></i> No rewards available for redemption at the moment.
                                    </div>
                                    <!-- Placeholder for reward cards -->
                                </div>
                            </div>
                        </div>
                        
                        <!-- Recent Activity Card -->
                        <div class="col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Recent Activity</h4>
                                    <a href="{{ route('patient.loyalty.history') }}" class="btn btn-sm btn-outline-primary">View All</a>
                                </div>
                                <div class="card-body">
                                    @if($transactions->count() > 0)
                                        <div class="activity-feed">
                                            <ul class="feed-list">
                                                @foreach($transactions as $transaction)
                                                    <li class="feed-item">
                                                        <div class="feed-date">{{ $transaction->created_at->format('M d, Y') }}</div>
                                                        <span class="feed-text">
                                                            @if($transaction->direction == 'credit')
                                                                <strong class="text-success">+{{ $transaction->points }}</strong> 
                                                            @else
                                                                <strong class="text-danger">-{{ $transaction->points }}</strong>
                                                            @endif
                                                            {{ $transaction->description ?? $transaction->type }}
                                                        </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <p class="text-muted text-center py-3">No recent point activity.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

@endsection
