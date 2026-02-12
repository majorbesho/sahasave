

        {{-- resources/views/backend/medical-centers/manage-doctors.blade.php --}}
@extends('backend.layouts.master')

@section('title', 'إدارة أطباء المركز - ' . $medicalCenter->name)

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>إدارة أطباء المركز</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.medical-centers.index') }}">المراكز الطبية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.medical-centers.show', $medicalCenter->id) }}">{{ $medicalCenter->name }}</a></li>
                        <li class="breadcrumb-item active">إدارة الأطباء</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">إدارة أطباء المركز: {{ $medicalCenter->name }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.medical-centers.show', $medicalCenter->id) }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-right"></i> العودة للمركز
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <!-- الأطباء المضافين حالياً -->
                        <div class="row">
                            <div class="col-12">
                                <h4>الأطباء المضافين للمركز</h4>
                                
                                @if($medicalCenter->doctors && $medicalCenter->doctors->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الطبيب</th>
                                                <th>التخصص</th>
                                                <th>نوع التوظيف</th>
                                                <th>رسوم الاستشارة</th>
                                                <th>الحالة</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($medicalCenter->doctors as $doctor)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('assets/img/default-avatar.png') }}" 
                                                             class="img-circle mr-2" width="40" height="40" alt="صورة الطبيب">
                                                        <div>
                                                            <strong>{{ $doctor->name }}</strong><br>
                                                            <small class="text-muted">{{ $doctor->email }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $doctor->doctorProfile->specialization ?? 'غير محدد' }}</td>
                                                <td>
                                                    @switch($doctor->pivot->employment_type)
                                                        @case('full_time') دوام كامل @break
                                                        @case('part_time') دوام جزئي @break
                                                        @case('contract') عقد @break
                                                        @case('visiting') زائر @break
                                                        @case('consultant') استشاري @break
                                                        @default غير محدد
                                                    @endswitch
                                                </td>
                                                <td>{{ $doctor->pivot->consultation_fee }} $</td>
                                                <td>
                                                    <span class="badge badge-{{ $doctor->pivot->is_active ? 'success' : 'danger' }}">
                                                        {{ $doctor->pivot->is_active ? 'نشط' : 'غير نشط' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <form action="{{ route('admin.medical-centers.update-doctor-status', $medicalCenter->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                                            <input type="hidden" name="is_active" value="{{ $doctor->pivot->is_active ? '0' : '1' }}">
                                                            <button type="submit" class="btn btn-{{ $doctor->pivot->is_active ? 'warning' : 'success' }} btn-sm">
                                                                <i class="fas fa-{{ $doctor->pivot->is_active ? 'pause' : 'play' }}"></i>
                                                                {{ $doctor->pivot->is_active ? 'تعطيل' : 'تفعيل' }}
                                                            </button>
                                                        </form>
                                                        
                                                        <form action="{{ route('admin.medical-centers.remove-doctor', $medicalCenter->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من إزالة الطبيب من هذا المركز؟')">
                                                                <i class="fas fa-trash"></i> إزالة
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> لا يوجد أطباء مضافين لهذا المركز حالياً.
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- إضافة طبيب جديد -->
                        <div class="row mt-5">
                            <div class="col-12">
                                <h4>إضافة طبيب جديد للمركز</h4>
                                
                                @if($availableDoctors && $availableDoctors->count() > 0)
                                <form action="{{ route('admin.medical-centers.add-doctor', $medicalCenter->id) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="doctor_id">اختر الطبيب</label>
                                                <select class="form-control @error('doctor_id') is-invalid @enderror" 
                                                        id="doctor_id" name="doctor_id" required>
                                                    <option value="">اختر الطبيب</option>
                                                    @foreach($availableDoctors as $doctor)
                                                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                                        {{ $doctor->name }} - {{ $doctor->doctorProfile->specialization ?? 'غير محدد' }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('doctor_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="employment_type">نوع التوظيف</label>
                                                <select class="form-control @error('employment_type') is-invalid @enderror" 
                                                        id="employment_type" name="employment_type" required>
                                                    <option value="">اختر نوع التوظيف</option>
                                                    <option value="full_time" {{ old('employment_type') == 'full_time' ? 'selected' : '' }}>دوام كامل</option>
                                                    <option value="part_time" {{ old('employment_type') == 'part_time' ? 'selected' : '' }}>دوام جزئي</option>
                                                    <option value="contract" {{ old('employment_type') == 'contract' ? 'selected' : '' }}>عقد</option>
                                                    <option value="visiting" {{ old('employment_type') == 'visiting' ? 'selected' : '' }}>زائر</option>
                                                    <option value="consultant" {{ old('employment_type') == 'consultant' ? 'selected' : '' }}>استشاري</option>
                                                </select>
                                                @error('employment_type')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="consultation_fee">رسوم الاستشارة ($)</label>
                                                <input type="number" step="0.01" class="form-control @error('consultation_fee') is-invalid @enderror" 
                                                       id="consultation_fee" name="consultation_fee" 
                                                       value="{{ old('consultation_fee', 0) }}" min="0" required>
                                                @error('consultation_fee')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <button type="submit" class="btn btn-success btn-block">
                                                    <i class="fas fa-plus"></i> إضافة
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="specialty_id">التخصص في هذا المركز</label>
                                                <select class="form-control @error('specialty_id') is-invalid @enderror" 
                                                        id="specialty_id" name="specialty_id">
                                                    <option value="">اختر التخصص</option>
                                                    @foreach($specialties as $specialty)
                                                    <option value="{{ $specialty->id }}" {{ old('specialty_id') == $specialty->id ? 'selected' : '' }}>
                                                        {{ $specialty->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('specialty_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="appointment_duration">مدة الموعد (دقيقة)</label>
                                                <input type="number" class="form-control @error('appointment_duration') is-invalid @enderror" 
                                                       id="appointment_duration" name="appointment_duration" 
                                                       value="{{ old('appointment_duration', 30) }}" min="15" max="120">
                                                @error('appointment_duration')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="max_daily_appointments">الحد الأقصى للمواعيد اليومية</label>
                                                <input type="number" class="form-control @error('max_daily_appointments') is-invalid @enderror" 
                                                       id="max_daily_appointments" name="max_daily_appointments" 
                                                       value="{{ old('max_daily_appointments', 20) }}" min="1" max="50">
                                                @error('max_daily_appointments')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle"></i> لا يوجد أطباء متاحين للإضافة. جميع الأطباء مضافين لهذا المركز أو ليس لديك أطباء نشطين.
                                </div>
                                @endif
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // تحديث رسوم الاستشارة تلقائياً عند اختيار طبيب
        const doctorSelect = document.getElementById('doctor_id');
        const consultationFeeInput = document.getElementById('consultation_fee');
        
        if (doctorSelect && consultationFeeInput) {
            doctorSelect.addEventListener('change', function() {
                // هنا يمكنك إضافة منطق لجلب رسوم الطبيب الافتراضية من قاعدة البيانات
                // حالياً سنتركها كما هي
            });
        }
    });
</script>
@endsection