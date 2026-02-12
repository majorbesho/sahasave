@extends('backend.layouts.medical-center')

@section('title', 'لوحة التحكم')

@section('breadcrumb')
    <li class="breadcrumb-item active">لوحة التحكم</li>
@endsection

@section('content')
<div class="row">
    <!-- بطاقات الإحصائيات -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            إجمالي الأطباء
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_doctors'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-md fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            مواعيد اليوم
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['today_appointments'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            إجمالي المرضى
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_patients'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            الإيرادات الشهرية
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['monthly_revenue']) }} درهم</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- الرسم البياني للمواعيد -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">مواعيد الأسبوع الحالي</h6>
            </div>
            <div class="card-body">
                <canvas id="weeklyAppointmentsChart" height="200"></canvas>
            </div>
        </div>
    </div>
    
    <!-- أعلى الأطباء -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">أعلى الأطباء حجزاً</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>الطبيب</th>
                                <th>عدد المواعيد</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topDoctors as $doctor)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $doctor->photo_url }}" 
                                             class="rounded-circle me-2" width="30" height="30">
                                        <div>
                                            <div class="font-weight-bold">{{ $doctor->name }}</div>
                                            <small class="text-muted">{{ $doctor->specialization ?? 'متخصص' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-primary">{{ $doctor->total_appointments }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- آخر المواعيد -->
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">آخر المواعيد</h6>
                <a href="{{ route('medical-center.appointments.index') }}" class="btn btn-sm btn-outline-primary">
                    عرض الكل <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>رقم الحجز</th>
                                <th>الطبيب</th>
                                <th>المريض</th>
                                <th>التاريخ والوقت</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentAppointments as $appointment)
                            <tr>
                                <td>#{{ $appointment->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $appointment->doctor->photo_url }}" 
                                             class="rounded-circle me-2" width="30" height="30">
                                        {{ $appointment->doctor->name }}
                                    </div>
                                </td>
                                <td>{{ $appointment->patient->name ?? 'مريض زائر' }}</td>
                                <td>
                                    {{ $appointment->scheduled_for->format('Y-m-d') }}
                                    <br>
                                    <small class="text-muted">{{ $appointment->appointment_time }}</small>
                                </td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'pending' => 'warning',
                                            'confirmed' => 'info',
                                            'completed' => 'success',
                                            'cancelled' => 'danger',
                                            'no_show' => 'secondary'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusColors[$appointment->status] ?? 'secondary' }}">
                                        {{ $appointment->getStatusText() }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('medical-center.appointments.show', $appointment->id) }}" 
                                       class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // رسم بياني للمواعيد الأسبوعية
    var ctx = document.getElementById('weeklyAppointmentsChart').getContext('2d');
    var weeklyChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت', 'الأحد'],
            datasets: [{
                label: 'عدد المواعيد',
                data: [12, 19, 8, 15, 22, 18, 10], // بيانات وهمية - يجب استبدالها ببيانات حقيقية
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    rtl: true,
                    labels: {
                        font: {
                            family: 'Tahoma'
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 5
                    }
                }
            }
        }
    });
});
</script>
@endpush