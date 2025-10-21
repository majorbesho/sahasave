{{-- resources/views/admin/doctors/edit.blade.php --}}
@extends('backend.layouts.master')

@section('title', 'تعديل بيانات الطبيب - ' . $doctor->name)

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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">تعديل بيانات الطبيب</h3>
                            <div class="card-tools">
                                <a href="{{ route('doctors.showxx', $doctor->id) }}" class="btn btn-info">
                                    <i class="fas fa-eye"></i> عرض التفاصيل
                                </a>
                                <a href="{{ route('doctors.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-right"></i> العودة للقائمة
                                </a>
                            </div>
                        </div>
                        <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>المعلومات الشخصية</h5>
                                        <hr>

                                        <div class="form-group">
                                            <label for="name">الاسم بالكامل</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $doctor->name) }}"
                                                required>
                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email">البريد الإلكتروني</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email', $doctor->email) }}"
                                                required>
                                            @error('email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">رقم الهاتف</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                id="phone" name="phone" value="{{ old('phone', $doctor->phone) }}"
                                                required>
                                            @error('phone')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="status">حالة الحساب</label>
                                            <select class="form-control @error('status') is-invalid @enderror"
                                                id="status" name="status">
                                                <option value="pending"
                                                    {{ old('status', $doctor->status) == 'pending' ? 'selected' : '' }}>قيد
                                                    المراجعة</option>
                                                <option value="active"
                                                    {{ old('status', $doctor->status) == 'active' ? 'selected' : '' }}>نشط
                                                </option>
                                                <option value="inactive"
                                                    {{ old('status', $doctor->status) == 'inactive' ? 'selected' : '' }}>
                                                    غير نشط</option>
                                                <option value="rejected"
                                                    {{ old('status', $doctor->status) == 'rejected' ? 'selected' : '' }}>
                                                    مرفوض</option>
                                                <option value="suspended"
                                                    {{ old('status', $doctor->status) == 'suspended' ? 'selected' : '' }}>
                                                    موقوف</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h5>المعلومات المهنية</h5>
                                        <hr>

                                        <div class="form-group">
                                            <label for="specialty_id">التخصص</label>
                                            <select class="form-control @error('specialty_id') is-invalid @enderror"
                                                id="specialty_id" name="specialty_id" required>
                                                <option value="">اختر التخصص</option>
                                                @foreach ($specialties as $specialty)
                                                    <option value="{{ $specialty->id }}"
                                                        {{ old('specialty_id', $doctor->doctorProfile->specialty_id ?? '') == $specialty->id ? 'selected' : '' }}>
                                                        {{ $specialty->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('specialty_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="medical_license_number">رقم الرخصة الطبية</label>
                                            <input type="text"
                                                class="form-control @error('medical_license_number') is-invalid @enderror"
                                                id="medical_license_number" name="medical_license_number"
                                                value="{{ old('medical_license_number', $doctor->doctorProfile->medical_license_number ?? '') }}"
                                                required>
                                            @error('medical_license_number')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="years_of_experience">سنوات الخبرة</label>
                                            <input type="number"
                                                class="form-control @error('years_of_experience') is-invalid @enderror"
                                                id="years_of_experience" name="years_of_experience"
                                                value="{{ old('years_of_experience', $doctor->doctorProfile->years_of_experience ?? '') }}"
                                                min="0">
                                            @error('years_of_experience')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="consultation_fee">رسوم الاستشارة ($)</label>
                                            <input type="number" step="0.01"
                                                class="form-control @error('consultation_fee') is-invalid @enderror"
                                                id="consultation_fee" name="consultation_fee"
                                                value="{{ old('consultation_fee', $doctor->doctorProfile->consultation_fee ?? '') }}"
                                                min="0">
                                            @error('consultation_fee')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="medical_school">الكلية الطبية</label>
                                            <input type="text"
                                                class="form-control @error('medical_school') is-invalid @enderror"
                                                id="medical_school" name="medical_school"
                                                value="{{ old('medical_school', $doctor->doctorProfile->medical_school ?? '') }}">
                                            @error('medical_school')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="graduation_year">سنة التخرج</label>
                                            <input type="number"
                                                class="form-control @error('graduation_year') is-invalid @enderror"
                                                id="graduation_year" name="graduation_year"
                                                value="{{ old('graduation_year', $doctor->doctorProfile->graduation_year ?? '') }}"
                                                min="1950" max="{{ date('Y') }}">
                                            @error('graduation_year')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="bio">السيرة الذاتية</label>
                                            <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="4">{{ old('bio', $doctor->doctorProfile->bio ?? '') }}</textarea>
                                            @error('bio')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="current_hospital">المستشفى الحالي</label>
                                            <input type="text"
                                                class="form-control @error('current_hospital') is-invalid @enderror"
                                                id="current_hospital" name="current_hospital"
                                                value="{{ old('current_hospital', $doctor->doctorProfile->current_hospital ?? '') }}">
                                            @error('current_hospital')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="current_position">المنصب الحالي</label>
                                            <input type="text"
                                                class="form-control @error('current_position') is-invalid @enderror"
                                                id="current_position" name="current_position"
                                                value="{{ old('current_position', $doctor->doctorProfile->current_position ?? '') }}">
                                            @error('current_position')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> حفظ التغييرات
                                </button>
                                <a href="{{ route('doctors.index') }}" class="btn btn-secondary">إلغاء</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
