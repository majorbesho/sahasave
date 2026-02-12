@extends('backend.layouts.medical-center')

@section('title', 'الملف الشخصي')

@section('breadcrumb')
    <li class="breadcrumb-item active">الملف الشخصي</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-body text-center">
                <img src="{{ $admin->user->photo_url }}" class="rounded-circle mb-3" width="100" height="100">
                <h5>{{ $admin->user->name }}</h5>
                <p class="text-muted">{{ $admin->position ?? 'مسؤول نظام' }}</p>
                <div class="badge bg-primary mb-3">{{ $admin->is_super_admin ? 'مدير عام' : 'مدير' }}</div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">معلومات التواصل</h6>
            </div>
            <div class="card-body">
                <p><strong>البريد الإلكتروني:</strong><br>{{ $admin->user->email }}</p>
                <p><strong>الجوال:</strong><br>{{ $admin->user->phone ?? 'غير مسجل' }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">تفاصيل المركز الطبي</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">اسم المركز:</label>
                        <p>{{ $center->name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">الهاتف:</label>
                        <p>{{ $center->phone }}</p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="font-weight-bold">العنوان:</label>
                        <p>{{ $center->address }}</p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="font-weight-bold">عن المركز:</label>
                        <p>{{ $center->description ?? 'لا يوجد وصف' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">إحصائيات سريعة</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <h4 class="text-primary">{{ $stats['total_doctors'] }}</h4>
                        <small>أطباء</small>
                    </div>
                    <div class="col-md-4 text-center">
                        <h4 class="text-success">{{ $stats['total_patients'] }}</h4>
                        <small>مرضى</small>
                    </div>
                    <div class="col-md-4 text-center">
                        <h4 class="text-info">{{ $stats['today_appointments'] }}</h4>
                        <small>مواعيد اليوم</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
