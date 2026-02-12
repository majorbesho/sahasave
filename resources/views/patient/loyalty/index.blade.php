@extends('frontend.layouts.master')

@push('styles')
<style>
    :root {
        --loyalty-primary: #2e37a4;
        --loyalty-secondary: #ff9d00;
        --glass-bg: rgba(255, 255, 255, 0.15);
        --glass-border: rgba(255, 255, 255, 0.2);
    }

    .loyalty-hero-card {
        background: linear-gradient(135deg, #2e37a4 0%, #4e54c8 100%);
        border: none;
        border-radius: 24px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 10px 30px rgba(46, 55, 164, 0.3);
        z-index: 1;
    }

    .loyalty-hero-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        z-index: -1;
    }

    .glass-card {
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        color: white;
    }

    .points-display {
        font-family: 'Outfit', sans-serif;
        text-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .points-number {
        font-size: 4.5rem;
        line-height: 1;
        letter-spacing: -2px;
    }

    .tier-badge-premium {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .badge-gold { color: #ffd700; text-shadow: 0 0 10px rgba(255,215,0,0.5); }
    .badge-silver { color: #e0e0e0; }
    .badge-bronze { color: #cd7f32; }

    .stat-mini-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .stat-mini-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .activity-item {
        border-left: 3px solid transparent;
        transition: all 0.3s ease;
    }
    .activity-item:hover {
        background: #f8f9fa;
        border-left-color: var(--loyalty-primary);
        padding-left: 15px !important;
    }

    .pulse-animation {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.05); opacity: 0.8; }
        100% { transform: scale(1); opacity: 1; }
    }

    .floating {
        animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
</style>
@endpush

@section('content')

    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('global.home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('loyalty.loyalty_points') }}</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">{{ __('loyalty.loyalty_rewards_program') }}</h2>
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
                    
                    <!-- Premium Loyalty Header -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card loyalty-hero-card">
                                <div class="card-body p-4 p-lg-5">
                                    <div class="row align-items-center">
                                        <div class="col-lg-7">
                                            <div class="loyalty-info text-white">
                                                <p class="text-white-50 mb-2 fs-5">{{ __('loyalty.current_balance') }}</p>
                                                <div class="points-display mb-3">
                                                    <span class="points-number fw-bold" id="points-counter" data-target="{{ $loyaltyPoints->available_points ?? 0 }}">0</span>
                                                    <span class="fs-2 ms-2 opacity-75">{{ __('loyalty.points') }}</span>
                                                </div>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="glass-card px-3 py-2 d-inline-flex align-items-center">
                                                        <i class="fa-solid fa-coins me-2 text-warning"></i>
                                                        <span class="fw-bold fs-2">≈ {{ number_format($loyaltyPoints->monetary_value ?? 0, 2) }} AED</span>
                                                    </div>
                                                    <span class="text-white-50">{{ __('loyalty.points_value') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 text-lg-end mt-4 mt-lg-0">
                                            <div class="tier-section">
                                                @php
                                                    $tierName = strtolower($loyaltyPoints->tier->name ?? 'bronze');
                                                    $tierClass = "badge-{$tierName}";
                                                @endphp
                                                <div class="tier-badge-premium mb-4 floating">
                                                    <i class="fa-solid fa-crown {{ $tierClass }}"></i>
                                                    {{ ucfirst($tierName) }} {{ __('loyalty.status') }}
                                                </div>
                                                
                                                <div class="progress-container glass-card p-3">
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <span class="small opacity-75">{{ __('loyalty.next_tier_progress') }}</span>
                                                        <span class="small fw-bold">{{ $stats['progress_to_next_tier'] }}%</span>
                                                    </div>
                                                    <div class="progress rounded-pill" style="height: 8px; background: rgba(255,255,255,0.1);">
                                                        <div class="progress-bar bg-white pulse-animation" role="progressbar" 
                                                            style="width: {{ $stats['progress_to_next_tier'] }}%" 
                                                            aria-valuenow="{{ $stats['progress_to_next_tier'] }}" 
                                                            aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <p class="small mt-2 mb-0 opacity-75 text-wrap" style="max-width: 250px; color: #f8f9fa">
                                                        {{ $stats['next_tier']->min_points_required ?? 0 }} {{ __('loyalty.points_total_to_reach') }} {{ $stats['next_tier']->name ?? 'next level' }}
                                                    </p>
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
                            <div class="card flex-fill shadow-sm border-0">
                                <div class="card-header bg-transparent border-0 pt-4 px-4">
                                    <h4 class="card-title mb-0 fw-bold">{{ __('loyalty.available_rewards') }}</h4>
                                </div>
                                <div class="card-body px-4">
                                    <div class="alert alert-info border-0" style="background: #eef2ff; color: #3730a3;">
                                        <i class="fa-solid fa-info-circle me-1"></i> {{ __('loyalty.no_rewards_available') }}
                                    </div>
                                    <!-- Placeholder for reward cards -->
                                </div>
                            </div>
                        </div>
                        
                        <!-- Recent Activity Card -->
                        <div class="col-md-6 d-flex">
                            <div class="card flex-fill shadow-sm border-0">
                                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-4 px-4">
                                    <h4 class="card-title mb-0 fw-bold">{{ __('loyalty.recent_activity') }}</h4>
                                    <a href="{{ route('patient.loyalty.history') }}" class="btn btn-sm btn-light rounded-pill">{{ __('global.view_all') }}</a>
                                </div>
                                <div class="card-body px-0">
                                    @if($transactions->count() > 0)
                                        <div class="activity-feed">
                                            @foreach($transactions as $transaction)
                                                <div class="activity-item d-flex align-items-center p-3 px-4 border-bottom border-light">
                                                    <div class="activity-icon me-3">
                                                        <span class="avatar avatar-sm rounded-circle {{ $transaction->direction == 'credit' ? 'bg-success-light text-success' : 'bg-danger-light text-danger' }}">
                                                            <i class="fa-solid {{ $transaction->direction == 'credit' ? 'fa-arrow-down' : 'fa-arrow-up' }}"></i>
                                                        </span>
                                                    </div>
                                                    <div class="activity-info flex-fill">
                                                        <h6 class="mb-0 fw-bold">{{ $transaction->description ?? ucfirst($transaction->type) }}</h6>
                                                        <p class="small text-muted mb-0">{{ $transaction->created_at->diffForHumans() }}</p>
                                                    </div>
                                                    <div class="activity-amount text-end">
                                                        <p class="mb-0 fw-bold {{ $transaction->direction == 'credit' ? 'text-success' : 'text-danger' }}">
                                                            {{ $transaction->direction == 'credit' ? '+' : '-' }}{{ number_format($transaction->points) }}
                                                        </p>
                                                        <span class="small text-muted">{{ __('loyalty.points') }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-5">
                                            <i class="fa-solid fa-box-open fs-1 text-muted opacity-25 mb-3"></i>
                                            <p class="text-muted">{{ __('loyalty.no_recent_activity') }}</p>
                                        </div>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const counter = document.getElementById('points-counter');
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 1500; // 1.5 seconds
        const startTime = performance.now();

        function updateCounter(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            // Easing function for smoother finish
            const easeOutQuad = (t) => t * (2 - t);
            const currentCount = Math.floor(easeOutQuad(progress) * target);
            
            counter.innerText = currentCount.toLocaleString();

            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                counter.innerText = target.toLocaleString();
            }
        }

        requestAnimationFrame(updateCounter);
    });
</script>
@endpush
