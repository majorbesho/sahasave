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

        .medical-summary .record-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .vital-stats .vital-item {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }

        .stat-box {
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 8px;
            text-align: center;
        }

        .stat-box h3 {
            margin: 0;
            color: #007bff;
            font-size: 24px;
        }

        .referral-code-section {
            margin: 15px 0;
        }

        .reward-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px;
            background: #f8f9fa;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .appointment-status {
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 12px;
        }

        .health-stat-card {
            background: #fff;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
                            <li class="breadcrumb-item active">Patient Dashboard</li>
                        </ol>
                        <h2 class="breadcrumb-title">Patient Dashboard</h2>
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
                <!-- / Profile Sidebar -->

                <div class="col-lg-8 col-xl-9">
                    <div class="dashboard-header">
                        <h3>Welcome back, {{ Auth::user()->name }}!</h3>
                        <p class="text-muted">Here's your health overview</p>
                    </div>

                    <div class="row">
                        <!-- قسم الإحصائيات السريعة -->
                        <div class="mb-4 col-xl-12">
                            <div class="row">
                                <div class="col-md-3 col-6">
                                    <div class="stat-box">
                                        <h3>{{ Auth::user()->patientAppointments()->count() }}</h3>
                                        <span>Total Appointments</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="stat-box">
                                        <h3>{{ Auth::user()->medicalRecords()->count() }}</h3>
                                        <span>Medical Records</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="stat-box">
                                        <h3>{{ Auth::user()->favorites()->count() }}</h3>
                                        <span>Favorite Doctors</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="stat-box">
                                        <h3>{{ Auth::user()->referral_count }}</h3>
                                        <span>Successful Referrals</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- قسم الملخص الطبي -->
                        <div class="col-xl-8 d-flex">
                            <div class="dashboard-card w-100">
                                <div class="dashboard-card-head">
                                    <div class="header-title">
                                        <h5>Medical Overview</h5>
                                    </div>
                                </div>
                                <div class="dashboard-card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="medical-summary">
                                                <h6>Recent Medical Records</h6>
                                                @forelse (Auth::user()->medicalRecords()->latest()->take(3)->get() as $record)
                                                    <div class="record-item">
                                                        <i class="fa-solid fa-file-medical text-primary"></i>
                                                        <div>
                                                            <strong>{{ $record->title }}</strong>
                                                            <small
                                                                class="text-muted">{{ $record->created_at->format('M d, Y') }}</small>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <p class="text-muted">No medical records found</p>
                                                @endforelse
                                                <a href="{{ route('patient.medical-records') }}"
                                                    class="mt-2 btn btn-sm btn-outline-primary">View All Records</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="vital-stats">
                                                <h6>profile Statistics</h6>
                                                @if (Auth::user()->medicalProfile)
                                                    <div class="vital-item">
                                                        <span>Height:</span>
                                                        <strong>{{ Auth::user()->medicalProfile->height ?? 'N/A' }}
                                                            cm</strong>
                                                    </div>
                                                    <div class="vital-item">
                                                        <span>Weight:</span>
                                                        <strong>{{ Auth::user()->medicalProfile->weight ?? 'N/A' }}
                                                            kg</strong>
                                                    </div>
                                                    <div class="vital-item">
                                                        <span>BMI:</span>
                                                        <strong>{{ Auth::user()->medicalProfile->bmi ?? 'N/A' }}</strong>
                                                    </div>
                                                    <div class="vital-item">
                                                        <span>Blood Type:</span>
                                                        <strong>{{ Auth::user()->medicalProfile->blood_type ?? 'N/A' }}</strong>
                                                    </div>
                                                @else
                                                    <p class="text-muted">No medical profile found</p>
                                                    <a href="{{ route('patient.profile.settings') }}"
                                                        class="btn btn-sm btn-primary">Complete Profile</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- قسم الإحالة والمكافآت -->
                        <div class="col-xl-4 d-flex">
                            <div class="dashboard-card w-100">
                                <div class="dashboard-card-head">
                                    <div class="header-title">
                                        <h5>Referral & Rewards</h5>
                                    </div>
                                </div>
                                <div class="dashboard-card-body">
                                    <div class="referral-stats">
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
                                                <h4 class="mb-0">SAR
                                                    {{ number_format(Auth::user()->total_referral_earnings, 2) }}</h4>
                                                <span>Total Earnings</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="referral-code-section">
                                        <label class="form-label">Your Referral Code:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                value="{{ Auth::user()->referral_code ?? 'Generate in settings' }}"
                                                readonly id="referralCode">
                                            <button class="btn btn-primary" onclick="copyReferralCode()" type="button">
                                                <i class="fa-solid fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mt-3 active-rewards">
                                        <h6>Active Rewards</h6>
                                        @forelse(Auth::user()->activeRewards as $reward)
                                            <div class="reward-item">
                                                <i class="fa-solid fa-gift text-success"></i>
                                                <span>{{ $reward->title }} - SAR
                                                    {{ number_format($reward->amount, 2) }}</span>
                                            </div>
                                        @empty
                                            <p class="text-muted">No active rewards</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- قسم المواعيد القادمة -->
                        <div class="col-xl-6 d-flex">
                            <div class="dashboard-card w-100">
                                <div class="dashboard-card-head">
                                    <div class="header-title">
                                        <h5>Upcoming Appointments</h5>
                                    </div>
                                    <div class="card-view-link">
                                        <a href="{{ route('patient.appointmentsslide') }}">View All</a>
                                    </div>
                                </div>
                                <div class="dashboard-card-body">
                                    @forelse(Auth::user()->upcomingAppointments as $appointment)
                                        <div class="mb-3 appointment-dash-card">
                                            <div class="doctor-fav-list">
                                                <div class="doctor-info-profile">
                                                    <a href="#" class="table-avatar">
                                                        <img src="{{ $appointment->doctor->photo ? asset('storage/' . $appointment->doctor->photo) : asset('frontend/xx/assets/img/doctors-dashboard/doctor-profile-img.jpg') }}"
                                                            alt="Doctor">
                                                    </a>
                                                    <div class="doctor-name-info">
                                                        <h5><a href="#">{{ $appointment->doctor->name }}</a></h5>
                                                        <span>{{ $appointment->doctor->doctorProfile->specialization ?? 'General Practitioner' }}</span>
                                                    </div>
                                                </div>
                                                <span
                                                    class="badge badge-{{ $appointment->status == 'confirmed' ? 'success' : 'warning' }} appointment-status">
                                                    {{ ucfirst($appointment->status) }}
                                                </span>
                                            </div>
                                            <div class="date-time">
                                                <p><i class="fa-solid fa-clock"></i>
                                                    {{ $appointment->scheduled_for->format('d M Y - h:i A') }}
                                                </p>
                                                <p><i class="fa-solid fa-location-dot"></i>
                                                    {{ $appointment->medicalCenter->name ?? 'Clinic' }}
                                                </p>
                                            </div>
                                            <div class="card-btns">
                                                <a href="{{ route('patient.chat', $appointment->doctor_id) }}"
                                                    class="btn btn-gray">
                                                    <i class="fa-solid fa-comment-dots"></i> Chat
                                                </a>
                                                <a href="{{ route('patient.appointmentsslide.show', $appointment->id) }}"
                                                    class="btn btn-outline-primary">
                                                    <i class="fa-solid fa-calendar-check"></i> Details
                                                </a>
                                            </div>
                                        </div>

                                    @empty
                                        <div class="py-4 text-center">
                                            <i class="mb-3 fa-solid fa-calendar-xmark fa-2x text-muted"></i>
                                            <p class="text-muted">No upcoming appointments</p>
                                            <a href="{{ route('doctorshome.search') }}" class="btn btn-primary">Book
                                                Appointment</a>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- قسم الأطباء المفضلين -->
                        <div class="col-xl-6 d-flex">
                            <div class="dashboard-card w-100">
                                <div class="dashboard-card-head">
                                    <div class="header-title">
                                        <h5>Favorite Doctors</h5>
                                    </div>
                                    <div class="card-view-link">
                                        <a href="{{ route('patient.favorites.index') }}">View All</a>
                                    </div>
                                </div>
                                <div class="dashboard-card-body">
                                    @php
                                        $favoriteDoctors = Auth::user()->favoriteDoctors;
                                    @endphp

                                    @forelse($favoriteDoctors as $doctor)
                                        <div class="mb-3 doctor-fav-list">
                                            <div class="doctor-info-profile">
                                                <a href="#" class="table-avatar">
                                                    <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('frontend/xx/assets/img/doctors-dashboard/doctor-profile-img.jpg') }}"
                                                        alt="Doctor">
                                                </a>
                                                <div class="doctor-name-info">
                                                    <h5><a href="#">{{ $doctor->name }}</a></h5>
                                                    <span>{{ $doctor->doctorProfile->specialization ?? 'General Practitioner' }}</span>
                                                    <span
                                                        class="text-muted">{{ $doctor->doctorProfile->years_of_experience ?? '0' }}
                                                        years experience</span>
                                                </div>
                                            </div>
                                            <a href="{{ route('doctor.book', $doctor->id) }}" class="cal-plus-icon"
                                                title="Book Appointment">
                                                <i class="fa-solid fa-calendar-plus"></i>
                                            </a>
                                        </div>
                                    @empty
                                        <div class="py-4 text-center">
                                            <i class="mb-3 fa-solid fa-heart fa-2x text-muted"></i>
                                            <p class="text-muted">No favorite doctors yet</p>
                                            <a href="{{ route('doctorshome.search') }}" class="btn btn-primary">Find
                                                Doctors</a>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <!-- قسم التقارير والإحصائيات -->
                        <div class="col-xl-12 d-flex">
                            <div class="dashboard-card w-100">
                                <div class="dashboard-card-head">
                                    <div class="header-title">
                                        <h5>Health Reports & Analytics</h5>
                                    </div>
                                </div>
                                <div class="dashboard-card-body">
                                    <div class="account-detail-table">
                                        <nav class="pb-0 mb-3 border-0 patient-dash-tab">
                                            <ul class="nav nav-tabs-bottom">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#recent-tab"
                                                        data-bs-toggle="tab">Recent Activity</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#prescriptions-tab"
                                                        data-bs-toggle="tab">Prescriptions</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#lab-tab" data-bs-toggle="tab">Lab
                                                        Results</a>
                                                </li>
                                            </ul>
                                        </nav>

                                        <div class="pt-0 tab-content">
                                            <!-- Recent Activity Tab -->
                                            <div id="recent-tab" class="tab-pane fade show active">
                                                <div class="table-responsive">
                                                    <table class="table mb-0 table-hover table-center">
                                                        <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Activity</th>
                                                                <th>Doctor</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {{-- @foreach ($recentActivities as $activity)
                                                                <tr>
                                                                    <td>{{ $activity->created_at->format('M d, Y') }}</td>
                                                                    <td>{{ $activity->description }}</td>
                                                                    <td>{{ $activity->doctor_name ?? 'System' }}</td>
                                                                    <td><span
                                                                            class="badge badge-success-bg">Completed</span>
                                                                    </td>
                                                                </tr>
                                                            @endforeach --}}
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- Prescriptions Tab -->
                                            <div class="tab-pane fade" id="prescriptions-tab">
                                                <!-- محتوى الوصفات الطبية -->
                                            </div>

                                            <!-- Lab Results Tab -->
                                            <div class="tab-pane fade" id="lab-tab">
                                                <!-- محتوى نتائج المختبر -->
                                            </div>
                                        </div>
                                    </div>
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

            // Show notification
            alert('Referral code copied to clipboard!');
        }
    </script>
@endsection
