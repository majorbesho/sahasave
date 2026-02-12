@extends('frontend.layouts.master')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card confirmation-card">
                        <div class="py-5 text-center card-body">
                            <div class="mb-4 confirmation-icon">
                                <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                            </div>

                            <h2 class="mb-3 text-success">تم حجز الموعد بنجاح!</h2>
                            <p class="mb-4 text-muted">تم تأكيد حجز موعدك وسيصلك تفاصيل الموعد على بريدك الإلكتروني</p>

                            <div class="mb-4 confirmation-details card bg-light">
                                <div class="card-body">
                                    <h5 class="mb-4 card-title">تفاصيل الحجز</h5>

                                    <div class="row text-start">
                                        <div class="col-md-6">
                                            <p><strong>رقم الحجز:</strong> {{ $appointment->appointment_number }}</p>
                                            <p><strong>الطبيب:</strong> {{ $appointment->doctor->name }}</p>
                                            <p><strong>التخصص:</strong> {{ $appointment->doctor->doctor_specialization }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>التاريخ:</strong> {{ $appointment->scheduled_for->format('Y-m-d') }}
                                            </p>
                                            <p><strong>الوقت:</strong> {{ $appointment->scheduled_for->format('h:i A') }}
                                            </p>
                                            <p><strong>المكان:</strong> {{ $appointment->medicalCenter->name }}</p>
                                        </div>
                                    </div>

                                    <div class="mt-3 row">
                                        <div class="col-12">
                                            <div class="alert alert-info">
                                                <small>
                                                    <i class="fas fa-info-circle me-2"></i>
                                                    يرجى الحضور قبل الموعد بـ 15 دقيقة. للمساعدة، تواصل معنا على 0123456789
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="confirmation-actions">
                                <a href="{{ route('patient.dashboard') }}" class="btn btn-primary me-3">
                                    <i class="fas fa-tachometer-alt me-2"></i>لوحة التحكم
                                </a>
                                <a href="{{ route('appointments.show', $appointment->id) }}"
                                    class="btn btn-outline-primary">
                                    <i class="fas fa-eye me-2"></i>عرض تفاصيل الموعد
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
