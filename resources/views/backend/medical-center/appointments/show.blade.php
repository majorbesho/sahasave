@extends('backend.layouts.medical-center')

@section('title', 'تفاصيل الموعد')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('medical-center.appointments.index') }}">المواعيد</a></li>
    <li class="breadcrumb-item active">#{{ $appointment->id }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">معلومات الموعد</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">المريض:</label>
                        <p>{{ $appointment->patient->name ?? 'مريض زائر' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">الطبيب:</label>
                        <p>{{ $appointment->doctor->name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">التاريخ:</label>
                        <p>{{ $appointment->scheduled_for->format('Y-m-d') }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">الوقت:</label>
                        <p>{{ $appointment->appointment_time }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">الحالة الحالية:</label>
                        <p>
                            <span class="badge bg-{{ $appointment->status == 'completed' ? 'success' : ($appointment->status == 'cancelled' ? 'danger' : 'warning') }}">
                                {{ $appointment->getStatusText() }}
                            </span>
                        </p>
                    </div>
                </div>
                <hr>
                <div class="mb-3">
                    <label class="font-weight-bold">ملاحظات المريض:</label>
                    <p>{{ $appointment->patient_notes ?? 'لا توجد ملاحظات' }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">تحديث الحالة</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('medical-center.appointments.update-status', $appointment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <select name="status" class="form-select">
                            <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                            <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>مؤكد</option>
                            <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>مكتمل</option>
                            <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>ملغي</option>
                            <option value="no_show" {{ $appointment->status == 'no_show' ? 'selected' : '' }}>لم يحضر</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">تحديث الحالة</button>
                </form>
                
                @if($appointment->status != 'cancelled')
                <hr>
                <form action="{{ route('medical-center.appointments.cancel', $appointment->id) }}" method="POST" 
                      onsubmit="return confirm('هل أنت متأكد من إلغاء هذا الموعد؟')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100">إلغاء الموعد</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
