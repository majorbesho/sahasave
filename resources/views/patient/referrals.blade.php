  @extends('frontend.layouts.master')
  @section('content')

    <style>
        .referral-stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stat-item i {
            font-size: 24px;
            color: #007bff;
        }

        .referral-code-section {
            margin: 15px 0;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .reward-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            background: #fff;
            border-radius: 10px;
            margin-bottom: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.05);
        }

        .dashboard-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            height: 100%;
        }
    </style>

    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="text-center col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('patient.dashboard') }}"><i
                                        class="isax isax-home-15"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Patient</li>
                            <li class="breadcrumb-item active">Referrals & Rewards</li>
                        </ol>
                        <h2 class="breadcrumb-title">Referrals & Rewards</h2>
                    </nav>
                </div>
            </div>
        </div>
        <div class="breadcrumb-bg">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-01.png') }}" alt="img"
                class="breadcrumb-bg-01">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-02.png') }}" alt="img"
                class="breadcrumb-bg-02">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img" class="breadcrumb-bg-03">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img" class="breadcrumb-bg-04">
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <!-- Profile Sidebar -->
                <div class="col-lg-4 col-xl-3 theiaStickySidebar">
                    @include('patient.sidebar')
                </div>
                <!-- / Profile Sidebar -->

                <div class="col-lg-8 col-xl-9">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="dashboard-header">
                                <h3>Referrals & Rewards</h3>
                            </div>
                        </div>

                        <!-- Stats & Code -->
                        <div class="col-md-12">
                            <div class="referral-code-section">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h4>Your Referral Stats</h4>
                                        <div class="referral-stats mt-3">
                                            <div class="stat-item">
                                                <i class="fa-solid fa-users text-success"></i>
                                                <div>
                                                    <h4 class="mb-0">{{ Auth::user()->referral_count }}</h4>
                                                    <span>Total Referrals</span>
                                                </div>
                                            </div>
                                            <div class="stat-item">
                                                <i class="fa-solid fa-coins text-warning"></i>
                                                <div>
                                                    <h4 class="mb-0">AED{{ number_format(Auth::user()->total_referral_earnings, 2) }}</h4>
                                                    <span>Total Earnings</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 border-start">
                                        <h4>Invite Friends</h4>
                                        <p class="text-muted mb-2">Share your code and earn rewards!</p>
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                value="{{ Auth::user()->referral_code ?? 'Generate in settings' }}"
                                                readonly id="referralCode">
                                            <button class="btn btn-primary" onclick="copyReferralCode()" type="button">
                                                <i class="fa-solid fa-copy"></i> Copy
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Referral Tree -->
                        <div class="col-md-12 mt-4">
                            <div class="dashboard-card">
                                <h4 class="mb-4">Referral Network (3 Levels)</h4>
                                <div class="referral-tree-container">
                                    @forelse($referralTree as $l1)
                                        <div class="tree-item tier-1 mb-4">
                                            <div class="tree-header d-flex align-items-center p-3 bg-primary-light rounded shadow-sm">
                                                <div class="avatar avatar-md rounded-circle bg-primary text-white me-3">
                                                    {{ substr($l1->name, 0, 1) }}
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-0 fw-bold text-primary">{{ $l1->masked_name }}</h5>
                                                    <span class="badge badge-primary">Direct Referral (Level 1)</span>
                                                </div>
                                                <div class="text-end">
                                                    <span class="small text-muted">{{ $l1->created_at->format('M Y') }}</span>
                                                </div>
                                            </div>

                                            @if($l1->children->count() > 0)
                                                <div class="tree-body ms-4 ps-4 border-start border-2 border-dashed mt-3">
                                                    @foreach($l1->children as $l2)
                                                        <div class="tree-item tier-2 mb-3">
                                                            <div class="tree-header d-flex align-items-center p-2 bg-light border-start border-4 border-info rounded">
                                                                <div class="avatar avatar-sm rounded-circle bg-info text-white me-2" style="width: 30px; height: 30px; font-size: 12px;">
                                                                    {{ substr($l2->name, 0, 1) }}
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <h6 class="mb-0 fw-bold">{{ $l2->masked_name }}</h6>
                                                                    <span class="small text-info">Level 2</span>
                                                                </div>
                                                            </div>

                                                            @if($l2->children->count() > 0)
                                                                <div class="tree-body ms-3 ps-3 border-start border-2 border-dotted mt-2">
                                                                    @foreach($l2->children as $l3)
                                                                        <div class="tree-item tier-3 mb-2">
                                                                            <div class="tree-header d-flex align-items-center p-2 rounded border-bottom">
                                                                                <i class="fa-solid fa-user-circle me-2 text-secondary"></i>
                                                                                <div class="flex-grow-1">
                                                                                    <p class="mb-0 small fw-bold">{{ $l3->masked_name }}</p>
                                                                                    <span class="text-mini text-muted" style="font-size: 10px;">Level 3</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <div class="text-center py-5 opacity-50">
                                            <i class="fa-solid fa-sitemap fs-1 mb-3"></i>
                                            <p>No network built yet. Indirect referrals from your friends will appear here!</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- Rewards List -->
                        <div class="col-md-12 mt-4">
                            <div class="dashboard-card">
                                <h4>My Rewards</h4>
                                <div class="mt-3">
                                    @forelse($rewards as $reward)
                                        <div class="reward-item">
                                            <div class="flex-shrink-0">
                                                <span class="avatar avatar-lg rounded-circle bg-success-light">
                                                    <i class="fa-solid fa-gift text-success fs-3"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="mb-1">{{ $reward->title }}</h5>
                                                <span class="text-muted small">{{ $reward->created_at->format('d M Y') }}</span>
                                            </div>
                                            <div class="text-end">
                                                <h5 class="text-success mb-1">+ AED {{ number_format($reward->amount, 2) }}</h5>
                                                <span class="badge badge-soft-{{ $reward->status == 'active' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($reward->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center text-muted py-3">
                                            <p>No rewards available yet.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyReferralCode() {
            const referralCode = document.getElementById('referralCode');
            referralCode.select();
            referralCode.setSelectionRange(0, 99999);
            document.execCommand('copy');
            alert('Referral code copied to clipboard!');
        }
    </script>
@endsection