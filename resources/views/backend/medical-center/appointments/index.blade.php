@extends('backend.layouts.medical-center')

@section('title', 'إدارة المواعيد')

@section('breadcrumb')
    <li class="breadcrumb-item active">المواعيد</li>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">قائمة المواعيد</h6>
        <div class="d-flex">
            <select class="form-select form-select-sm me-2" id="doctorFilter">
                <option value="">جميع الأطباء</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
            <select class="form-select form-select-sm" id="statusFilter">
                <option value="">جميع الحالات</option>
                @foreach($statuses as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="appointmentsTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>رقم الموعد</th>
                        <th>المريض</th>
                        <th>الطبيب</th>
                        <th>التاريخ والوقت</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                    <tr>
                        <td>#{{ $appointment->id }}</td>
                        <td>{{ $appointment->patient->name ?? 'مريض زائر' }}</td>
                        <td>{{ $appointment->doctor->name }}</td>
                        <td>{{ $appointment->scheduled_for->format('Y-m-d H:i') }}</td>
                        <td>
                            <span class="badge bg-{{ $appointment->status == 'completed' ? 'success' : ($appointment->status == 'cancelled' ? 'danger' : 'warning') }}">
                                {{ $appointment->status }}
                            </span>
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $appointments->links() }}
        </div>
    </div>
</div>
@endsection
