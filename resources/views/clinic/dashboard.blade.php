@extends('frontend.layouts.master')

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center inner-banner">
            <div class="text-center col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="isax isax-home-15"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Clinic Admin</li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <h2 class="breadcrumb-title">Clinic Dashboard</h2>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container">

        <!-- Alerts Section -->
        @if(count($alerts) > 0)
        <div class="row mb-4">
            <div class="col-md-12">
                @foreach($alerts as $alert)
                <div class="alert alert-{{ $alert['type'] }} alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i> {{ $alert['message'] }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="row">
            
            @include('clinic.layouts.sidebar')

            <div class="col-lg-8 col-xl-9">
                <div class="row">
                    <!-- Stats Widgets -->
                    <div class="col-xl-4 d-flex">
                        <div class="dashboard-box-col w-100">
                            <!-- Upcoming Appointments Today -->
                            <div class="dashboard-widget-box">
                                <div class="dashboard-content-info">
                                    <h6>Upcoming Today</h6>
                                    <h4>{{ $upcomingAppointmentsCount }}</h4>
                                    <span class="text-muted small">Confirmed & Scheduled</span>
                                </div>
                                <div class="dashboard-widget-icon">
                                    <span class="dash-icon-box"><i class="fa-solid fa-calendar-check"></i></span>
                                </div>
                            </div>
                            
                            <!-- New Patients count -->
                            <div class="dashboard-widget-box">
                                <div class="dashboard-content-info">
                                    <h6>New Patients (Week)</h6>
                                    <h4>{{ $newPatientsThisWeek }}</h4>
                                </div>
                                <div class="dashboard-widget-icon">
                                    <span class="dash-icon-box"><i class="fa-solid fa-user-injured"></i></span>
                                </div>
                            </div>
                            
                            <!-- Total Appointments (Optional condition) -->
                            @if($canViewFinancials)
                            <div class="dashboard-widget-box">
                                <div class="dashboard-content-info">
                                    <h6>Total Appointments</h6>
                                    <h4>{{ $totalAppointments }}</h4>
                                </div>
                                <div class="dashboard-widget-icon">
                                    <span class="dash-icon-box"><i class="fa-solid fa-folder-open"></i></span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Revenue Widget (If Permitted) -->
                    @if($canViewFinancials)
                    <div class="col-xl-8 d-flex">
                        <div class="dashboard-card w-100">
                            <div class="dashboard-card-head">
                                <div class="header-title">
                                    <h5>Financial Overview</h5>
                                </div>
                            </div>
                            <div class="dashboard-card-body p-4">
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="revenue-item border-end">
                                            <h6 class="text-muted">Today's Revenue</h6>
                                            <h3 class="text-primary">{{ number_format($todayRevenue, 2) }} QAR</h3>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="revenue-item">
                                            <h6 class="text-muted">This Week's Revenue</h6>
                                            <h3 class="text-success">{{ number_format($weeklyRevenue, 2) }} QAR</h3>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mt-4">
                                    <h6>Revenue Trend (Last 7 Days)</h6>
                                    {{-- Chart placeholder - integration with ApexCharts or similar --}}
                                    <div id="clinic-revenue-chart" style="min-height: 200px;">
                                        <!-- Chart will be rendered here via JS if data exists -->
                                        @if(count($chartData) > 0)
                                            <div class="alert alert-light text-center">Chart data is ready for display</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Today's Appointments Table -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard-card w-100">
                            <div class="dashboard-card-head">
                                <div class="header-title">
                                    <h5>Today's Appointments Queue</h5>
                                </div>
                            </div>
                            <div class="dashboard-card-body">
                                <div class="table-responsive">
                                    <table class="table dashboard-table appoint-table">
                                        <thead>
                                            <tr>
                                                <th>Patient</th>
                                                <th>Doctor</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($todayAppointments as $appointment)
                                            <tr>
                                                <td>
                                                    <div class="patient-info-profile">
                                                        <div class="patient-name-info">
                                                            <h5>{{ $appointment->patient->name }}</h5>
                                                            <span>#{{ $appointment->appointment_number }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="doctor-name-info">
                                                        <h6 class="mb-0">Dr. {{ $appointment->doctor->name }}</h6>
                                                    </div>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($appointment->scheduled_for)->format('h:i A') }}</td>
                                                <td>
                                                    <span class="badge badge-pill bg-{{ $appointment->status == 'confirmed' ? 'success' : ($appointment->status == 'cancelled' ? 'danger' : 'warning') }}">
                                                        {{ ucfirst($appointment->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="apponiment-actions">
                                                        <a href="javascript:void(0);" class="text-success-icon me-2" title="Confirm"><i class="fa-solid fa-check"></i></a>
                                                        <a href="javascript:void(0);" class="text-danger-icon" title="Cancel"><i class="fa-solid fa-xmark"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4">
                                                    <img src="{{ asset('assets/img/no-data.png') }}" alt="No Data" style="max-height: 100px; opacity: 0.5;">
                                                    <p class="mt-2">No appointments scheduled for today.</p>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if($canViewFinancials && count($chartData) > 0)
        var options = {
            series: [{
                name: 'Revenue',
                data: {!! json_encode(array_column($chartData, 'revenue')) !!}
            }, {
                name: 'Appointments',
                data: {!! json_encode(array_column($chartData, 'appointments')) !!}
            }],
            chart: {
                height: 300,
                type: 'area',
                toolbar: { show: false }
            },
            colors: ['#0E82FD', '#E2E8F0'],
            dataLabels: { enabled: false },
            xaxis: {
                categories: {!! json_encode(array_column($chartData, 'date')) !!}
            },
            tooltip: {
                x: { format: 'dd MMM' },
            },
        };

        var chart = new ApexCharts(document.querySelector("#clinic-revenue-chart"), options);
        chart.render();
        @endif
    });
</script>
@endpush
