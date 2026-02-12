@extends('backend.layouts.medical-center')

@section('title', 'التقارير المالية')

@section('breadcrumb')
    <li class="breadcrumb-item active">التقارير المالية</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">إجمالي الإيرادات</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($summary['total_revenue']) }} درهم</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">إجمالي العمولات</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($summary['total_commissions']) }} درهم</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">إجمالي المبالغ المستردة</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($summary['total_refunds']) }} درهم</div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">سجل العمليات المالية</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>التاريخ</th>
                        <th>النوع</th>
                        <th>المبلغ</th>
                        <th>الموعد</th>
                        <th>الطبيب</th>
                        <th>المريض</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            @php
                                $typeColors = [
                                    'revenue' => 'success',
                                    'commission' => 'warning',
                                    'refund' => 'danger'
                                ];
                                $typeText = [
                                    'revenue' => 'إيراد',
                                    'commission' => 'عمولة',
                                    'refund' => 'مسترجع'
                                ];
                            @endphp
                            <span class="badge bg-{{ $typeColors[$transaction->type] ?? 'info' }}">
                                {{ $typeText[$transaction->type] ?? $transaction->type }}
                            </span>
                        </td>
                        <td>{{ number_format($transaction->amount, 2) }} درهم</td>
                        <td>#{{ $transaction->appointment_id }}</td>
                        <td>{{ $transaction->doctor->name ?? '---' }}</td>
                        <td>{{ $transaction->patient->name ?? '---' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">لا توجد عمليات حالياً</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection
