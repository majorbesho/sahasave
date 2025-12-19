@extends('frontend.layouts.master')

@section('content')
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تفاصيل الموعد</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">تفاصيل الموعد</h2>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="booking-doc-info">
                            <a href="{{ route('doctors.showxx', $appointment->doctor->id) }}" class="booking-doc-img">
                                <img src="{{ $appointment->doctor->photo ?? asset('assets/img/doctors/doctor-thumb-02.jpg') }}" alt="Doctor Image">
                            </a>
                            <div class="booking-info">
                                <h4><a href="{{ route('doctors.showxx', $appointment->doctor->id) }}">{{ $appointment->doctor->name }}</a></h4>
                                <div class="rating">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star"></i>
                                    <span class="d-inline-block average-rating">35</span>
                                </div>
                                <p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i> {{ $appointment->doctor->address ?? 'العنوان غير متوفر' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- تفاصيل الموعد -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">معلومات الحجز <span class="badge bg-{{ $appointment->status == 'confirmed' ? 'success' : ($appointment->status == 'cancelled' ? 'danger' : 'warning') }} float-end">{{ $appointment->status == 'confirmed' ? 'مؤكد' : ($appointment->status == 'cancelled' ? 'ملغي' : 'قيد الانتظار') }}</span></h4>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><strong>رقم الموعد:</strong> #{{ $appointment->appointment_number }}</li>
                                    <li class="mb-2"><strong>تاريخ الموعد:</strong> {{ \Carbon\Carbon::parse($appointment->scheduled_for)->translatedFormat('l, j F Y') }}</li>
                                    <li class="mb-2"><strong>وقت الموعد:</strong> 
                                        {{ \Carbon\Carbon::parse($appointment->scheduled_for)->format('h:i A') }} - 
                                        {{ \Carbon\Carbon::parse($appointment->scheduled_until)->format('h:i A') }}
                                        <span class="text-muted">({{ $appointment->duration }} دقيقة)</span>
                                    </li>
                                    <li class="mb-2"><strong>نوع الزيارة:</strong> {{ $appointment->visit_type ?? 'زيارة عامة' }}</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><strong>تاريخ الحجز:</strong> {{ $appointment->created_at->translatedFormat('d/m/Y h:i A') }}</li>
                                    <li class="mb-2"><strong>المبلغ:</strong> <span class="text-primary">{{ number_format($appointment->final_fee, 2) }} درهم</span></li>
                                    @if($appointment->medicalCenter)
                                    <li class="mb-2"><strong>المركز الطبي:</strong> {{ $appointment->medicalCenter->name }}</li>
                                    @endif
                                    <li class="mb-2"><strong>الحالة:</strong> {{ $appointment->status }}</li>
                                </ul>
                            </div>
                        </div>
                        
                        @if($appointment->symptoms || $appointment->reason)
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                @if($appointment->reason)
                                <div class="mb-3">
                                    <strong>سبب الزيارة:</strong>
                                    <p class="text-muted">{{ $appointment->reason }}</p>
                                </div>
                                @endif
                                
                                @if($appointment->symptoms)
                                <div class="mb-3">
                                    <strong>الأعراض:</strong>
                                    <p class="text-muted">{{ $appointment->symptoms }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- أزرار التحكم -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                @if($appointment->status != 'cancelled' && $appointment->status != 'completed')
                                    <a href="#" class="btn btn-primary me-2"><i class="fas fa-edit"></i> تعديل الموعد</a>
                                    <a href="#" class="btn btn-danger me-2"><i class="fas fa-times"></i> إلغاء الموعد</a>
                                @endif
                                <a href="{{ route('patient.dashboard') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> العودة للوحة التحكم</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection