{{-- resources/views/admin/doctors/statistics.blade.php --}}
@extends('backend.layouts.master')

@section('title', 'إحصائيات الأطباء')

@section('content')



    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h1>Users Account</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">إحصائيات الأطباء</h3>
                            <div class="card-tools">
                                <a href="{{ route('doctors.index') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-right"></i> العودة إلى قائمة الأطباء
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- بطاقات الإحصائيات -->
                            <div class="row">
                                <div class="col-md-3 col-sm-6">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><i class="fas fa-user-md"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">إجمالي الأطباء</span>
                                            <span class="info-box-number">{{ $stats['total_doctors'] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning"><i class="fas fa-clock"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">قيد المراجعة</span>
                                            <span class="info-box-number">{{ $stats['pending_doctors'] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i class="fas fa-check-circle"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">نشط</span>
                                            <span class="info-box-number">{{ $stats['active_doctors'] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-danger"><i class="fas fa-times-circle"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">مرفوض</span>
                                            <span class="info-box-number">{{ $stats['rejected_doctors'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- الرسوم البيانية -->
                            <div class="mt-4 row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">توزيع الأطباء حسب الحالة</h3>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="statusChart" width="400" height="200"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">الأطباء المعتمدين</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-center">
                                                <h4>{{ $stats['verified_doctors'] }}</h4>
                                                <p class="text-muted">طبيب معتمد</p>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success"
                                                        style="width: {{ $stats['total_doctors'] > 0 ? ($stats['verified_doctors'] / $stats['total_doctors']) * 100 : 0 }}%">
                                                        {{ $stats['total_doctors'] > 0 ? round(($stats['verified_doctors'] / $stats['total_doctors']) * 100, 1) : 0 }}%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- جدول الإحصائيات التفصيلية -->
                            <div class="mt-4 row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">إحصائيات تفصيلية</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>التخصص</th>
                                                            <th>إجمالي الأطباء</th>
                                                            <th>نشط</th>
                                                            <th>قيد المراجعة</th>
                                                            <th>مرفوض</th>
                                                            <th>النسبة</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($specialtyStats as $stat)
                                                            <tr>
                                                                <td>{{ $stat->specialization ?? 'غير محدد' }}</td>
                                                                <td>{{ $stat->total_count }}</td>
                                                                <td>{{ $stat->active_count }}</td>
                                                                <td>{{ $stat->pending_count }}</td>
                                                                <td>{{ $stat->rejected_count }}</td>
                                                                <td>
                                                                    <div class="progress progress-sm">
                                                                        <div class="progress-bar bg-success"
                                                                            style="width: {{ $stat->total_count > 0 ? ($stat->active_count / $stat->total_count) * 100 : 0 }}%">
                                                                        </div>
                                                                    </div>
                                                                    <small>{{ $stat->total_count > 0 ? round(($stat->active_count / $stat->total_count) * 100, 1) : 0 }}%</small>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // رسم بياني دائري
                var ctx = document.getElementById('statusChart').getContext('2d');
                var statusChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['نشط', 'قيد المراجعة', 'مرفوض', 'موقوف'],
                        datasets: [{
                            data: [
                                {{ $stats['active_doctors'] }},
                                {{ $stats['pending_doctors'] }},
                                {{ $stats['rejected_doctors'] }},
                                {{ $stats['total_doctors'] - $stats['active_doctors'] - $stats['pending_doctors'] - $stats['rejected_doctors'] }}
                            ],
                            backgroundColor: [
                                '#28a745',
                                '#ffc107',
                                '#dc3545',
                                '#6c757d'
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            },
                            title: {
                                display: true,
                                text: 'توزيع الأطباء حسب الحالة'
                            }
                        }
                    }
                });
            });
        </script>
    @endsection
