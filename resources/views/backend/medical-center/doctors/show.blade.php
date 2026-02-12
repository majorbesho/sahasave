@extends('backend.layouts.medical-center')

@section('title', 'تفاصيل الطبيب')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('medical-center.doctors.index') }}">الأطباء</a></li>
    <li class="breadcrumb-item active">{{ $doctor->name }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-body text-center">
                <img src="{{ $doctor->photo_url }}" 
                     class="rounded-circle mb-3" width="150" height="150">
                <h4>{{ $doctor->name }}</h4>
                <p class="text-muted">{{ $doctor->specialization ?? 'متخصص' }}</p>
                <hr>
                <div class="text-start">
                    <p><strong>البريد الإلكتروني:</strong> {{ $doctor->email }}</p>
                    <p><strong>الجوال:</strong> {{ $doctor->phone ?? 'غير مسجل' }}</p>
                    <p><strong>تاريخ الانضمام:</strong> {{ $doctor->created_at->format('Y-m-d') }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">إجمالي المواعيد</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_appointments'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">إجمالي الإيرادات</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['monthly_earnings']) }} درهم</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- يمكن إضافة قائمة المواعيد الخاصة بالطبيب هنا -->
    </div>
</div>
@endsection
