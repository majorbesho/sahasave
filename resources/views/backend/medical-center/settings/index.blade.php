@extends('backend.layouts.medical-center')

@section('title', 'إعدادات المركز')

@section('breadcrumb')
    <li class="breadcrumb-item active">الإعدادات</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">المعلومات الأساسية</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('medical-center.settings.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">اسم المركز</label>
                        <input type="text" name="name" class="form-control" value="{{ $center->name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" value="{{ $center->email }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">رقم الهاتف</label>
                        <input type="text" name="phone" class="form-control" value="{{ $center->phone }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">العنوان</label>
                        <textarea name="address" class="form-control">{{ $center->address }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">الوصف</label>
                        <textarea name="description" class="form-control" rows="4">{{ $center->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">الحالة والتفعيل</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label d-block">حالة التحقق</label>
                    <span class="badge bg-{{ $center->is_verified ? 'success' : 'warning' }}">
                        {{ $center->is_verified ? 'تم التحقق' : 'قيد المراجعة' }}
                    </span>
                </div>
                <div class="mb-3">
                    <label class="form-label d-block">الحالة العامة</label>
                    <span class="badge bg-{{ $center->status == 'active' ? 'success' : 'danger' }}">
                        {{ $center->status == 'active' ? 'نشط' : 'متوقف' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
