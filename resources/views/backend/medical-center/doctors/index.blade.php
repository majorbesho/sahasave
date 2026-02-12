@extends('backend.layouts.medical-center')

@section('title', 'إدارة الأطباء')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('medical-center.doctors.index') }}">الأطباء</a></li>
    <li class="breadcrumb-item active">قائمة الأطباء</li>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">إدارة الأطباء</h6>
        <a href="{{ route('medical-center.doctors.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> إضافة طبيب جديد
        </a>
    </div>
    <div class="card-body">
        <!-- فلترة -->
        <div class="row mb-4">
            <div class="col-md-12">
                <form method="GET" class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="بحث بالاسم أو التخصص" 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="specialty" class="form-control select2">
                            <option value="">جميع التخصصات</option>
                            @foreach($specialties as $specialty)
                                <option value="{{ $specialty->id }}" {{ request('specialty') == $specialty->id ? 'selected' : '' }}>
                                    {{ $specialty->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-control">
                            <option value="">جميع الحالات</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>نشط</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>غير نشط</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter"></i> فلترة
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('medical-center.doctors.index') }}" class="btn btn-secondary w-100">
                            <i class="fas fa-redo"></i> إعادة تعيين
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- جدول الأطباء -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>الطبيب</th>
                        <th>التخصص</th>
                        <th>رقم الهاتف</th>
                        <th>الحالة</th>
                        <th>معدل التقييم</th>
                        <th>عدد المواعيد</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctors as $doctor)
                    <tr>
                        <td>{{ $loop->iteration + ($doctors->currentPage() - 1) * $doctors->perPage() }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ $doctor->photo_url }}" 
                                     class="rounded-circle me-3" width="40" height="40">
                                <div>
                                    <div class="font-weight-bold">{{ $doctor->name }}</div>
                                    <small class="text-muted">{{ $doctor->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            @foreach($doctor->specialties->take(2) as $specialty)
                                <span class="badge bg-info mb-1">{{ $specialty->name }}</span>
                            @endforeach
                            @if($doctor->specialties->count() > 2)
                                <span class="badge bg-secondary">+{{ $doctor->specialties->count() - 2 }}</span>
                            @endif
                        </td>
                        <td>{{ $doctor->phone }}</td>
                        <td>
                            @if($doctor->pivot->is_active)
                                <span class="badge bg-success">نشط</span>
                            @else
                                <span class="badge bg-danger">غير نشط</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="text-warning">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($doctor->average_rating))
                                            <i class="fas fa-star"></i>
                                        @elseif($i - 0.5 <= $doctor->average_rating)
                                            <i class="fas fa-star-half-alt"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </span>
                                <span class="ms-2">({{ number_format($doctor->average_rating, 1) }})</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-primary">{{ $doctor->appointments_count }}</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('medical-center.doctors.show', $doctor->id) }}" 
                                   class="btn btn-sm btn-info" title="عرض">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('medical-center.doctors.schedule', $doctor->id) }}" 
                                   class="btn btn-sm btn-warning" title="الجدول الزمني">
                                    <i class="fas fa-calendar-alt"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" 
                                        onclick="toggleDoctorStatus({{ $doctor->id }}, '{{ $doctor->pivot->is_active }}')"
                                        title="{{ $doctor->pivot->is_active ? 'تعطيل' : 'تفعيل' }}">
                                    <i class="fas fa-{{ $doctor->pivot->is_active ? 'ban' : 'check' }}"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- الترقيم -->
            <div class="d-flex justify-content-center">
                {{ $doctors->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.select2-container--default .select2-selection--single {
    height: 38px;
    padding: 5px;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "اختر التخصص",
        allowClear: true
    });
});

function toggleDoctorStatus(doctorId, currentStatus) {
    if(confirm(currentStatus === '1' ? 'هل تريد تعطيل هذا الطبيب؟' : 'هل تريد تفعيل هذا الطبيب؟')) {
        $.ajax({
            url: '{{ url("medical-center/doctors") }}/' + doctorId + '/status',
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                status: currentStatus === '1' ? 'inactive' : 'active'
            },
            success: function(response) {
                if(response.success) {
                    location.reload();
                }
            },
            error: function(xhr) {
                alert('حدث خطأ أثناء تحديث حالة الطبيب');
            }
        });
    }
}
</script>
@endpush