@extends('backend.layouts.medical-center')

@section('title', 'التحليلات والإحصائيات')

@section('breadcrumb')
    <li class="breadcrumb-item active">التحليلات</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">نمو المواعيد والأرباح</h6>
            </div>
            <div class="card-body">
                <canvas id="analyticsChart" height="150"></canvas>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">توزيع حالات المواعيد</h6>
            </div>
            <div class="card-body">
                <canvas id="statusChart" height="250"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // رسم بياني للنمو
    var ctx = document.getElementById('analyticsChart').getContext('2d');
    var analyticsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode(collect($monthlyAppointments)->pluck('month')) !!},
            datasets: [{
                label: 'المواعيد',
                data: {!! json_encode(collect($monthlyAppointments)->pluck('count')) !!},
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.1)',
                yAxisID: 'y',
            }, {
                label: 'الإيرادات (درهم)',
                data: {!! json_encode(collect($monthlyRevenue)->pluck('revenue')) !!},
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.1)',
                yAxisID: 'y1',
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: { display: true, text: 'عدد المواعيد' }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    grid: { drawOnChartArea: false },
                    title: { display: true, text: 'الإيرادات' }
                }
            }
        }
    });

    // رسم بياني دائري للحالات
    var ctx2 = document.getElementById('statusChart').getContext('2d');
    var statusChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($appointmentsByStatus->keys()) !!},
            datasets: [{
                data: {!! json_encode($appointmentsByStatus->values()) !!},
                backgroundColor: [
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(153, 102, 255, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
});
</script>
@endpush
