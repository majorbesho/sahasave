@extends('backend.layouts.master')

@section('content')

<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>تفاصيل الموعد</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.appointments.index') }}">المواعيد</a></li>
                            <li class="breadcrumb-item active">{{ $appointment->appointment_number }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Appointment Info -->
                    <div class="col-md-8">
                        <!-- Main Details Card -->
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-calendar-check mr-2"></i>
                                    معلومات الموعد
                                </h3>
                                <div class="card-tools">
                                    @switch($appointment->status)
                                        @case('pending')
                                            <span class="badge badge-warning badge-lg px-3 py-2">قيد الانتظار</span>
                                            @break
                                        @case('confirmed')
                                            <span class="badge badge-success badge-lg px-3 py-2">مؤكد</span>
                                            @break
                                        @case('completed')
                                            <span class="badge badge-info badge-lg px-3 py-2">مكتمل</span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge badge-danger badge-lg px-3 py-2">ملغي</span>
                                            @break
                                    @endswitch
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="200"><i class="fas fa-hashtag mr-2"></i>رقم الموعد</th>
                                        <td><code class="text-lg">{{ $appointment->appointment_number }}</code></td>
                                    </tr>
                                    <tr>
                                        <th><i class="fas fa-calendar mr-2"></i>تاريخ الموعد</th>
                                        <td>
                                            @if($appointment->scheduled_for)
                                                <strong>{{ $appointment->scheduled_for->format('Y-m-d') }}</strong>
                                                <span class="text-muted mx-2">|</span>
                                                {{ $appointment->scheduled_for->format('h:i A') }}
                                            @else
                                                <span class="text-muted">غير محدد</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><i class="fas fa-video mr-2"></i>نوع الموعد</th>
                                        <td>
                                            @switch($appointment->type)
                                                @case('video_call')
                                                    <span class="badge badge-primary"><i class="fas fa-video"></i> مكالمة فيديو</span>
                                                    @break
                                                @case('audio_call')
                                                    <span class="badge badge-info"><i class="fas fa-phone"></i> مكالمة صوتية</span>
                                                    @break
                                                @case('direct_visit')
                                                    <span class="badge badge-secondary"><i class="fas fa-hospital"></i> زيارة مباشرة</span>
                                                    @break
                                                @default
                                                    {{ $appointment->type ?? 'غير محدد' }}
                                            @endswitch
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><i class="fas fa-clock mr-2"></i>المدة</th>
                                        <td>{{ $appointment->duration ?? 30 }} دقيقة</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fas fa-calendar-plus mr-2"></i>تاريخ الإنشاء</th>
                                        <td>{{ $appointment->created_at->format('Y-m-d h:i A') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Patient Info Card -->
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-user mr-2"></i>
                                    معلومات المريض
                                </h3>
                            </div>
                            <div class="card-body">
                                @if($appointment->patient)
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        @if($appointment->patient->photo)
                                            <img src="{{ asset('storage/' . $appointment->patient->photo) }}" 
                                                 alt="{{ $appointment->patient->name }}" 
                                                 class="img-circle elevation-2" 
                                                 style="width: 100px; height: 100px; object-fit: cover;">
                                        @else
                                            <div class="img-circle elevation-2 bg-secondary d-flex align-items-center justify-content-center mx-auto" 
                                                 style="width: 100px; height: 100px;">
                                                <i class="fas fa-user fa-3x text-white"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-9">
                                        <table class="table table-sm">
                                            <tr>
                                                <th width="150">الاسم</th>
                                                <td><strong>{{ $appointment->patient->name }}</strong></td>
                                            </tr>
                                            <tr>
                                                <th>البريد الإلكتروني</th>
                                                <td>{{ $appointment->patient->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>الهاتف</th>
                                                <td>{{ $appointment->patient->phone ?? 'غير متوفر' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                @else
                                <p class="text-muted">معلومات المريض غير متوفرة</p>
                                @endif
                            </div>
                        </div>

                        <!-- Doctor Info Card -->
                        <div class="card card-success card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-user-md mr-2"></i>
                                    معلومات الطبيب
                                </h3>
                            </div>
                            <div class="card-body">
                                @if($appointment->doctor)
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        @if($appointment->doctor->photo)
                                            <img src="{{ asset('storage/' . $appointment->doctor->photo) }}" 
                                                 alt="د. {{ $appointment->doctor->name }}" 
                                                 class="img-circle elevation-2" 
                                                 style="width: 100px; height: 100px; object-fit: cover;">
                                        @else
                                            <div class="img-circle elevation-2 bg-primary d-flex align-items-center justify-content-center mx-auto" 
                                                 style="width: 100px; height: 100px;">
                                                <i class="fas fa-user-md fa-3x text-white"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-9">
                                        <table class="table table-sm">
                                            <tr>
                                                <th width="150">الاسم</th>
                                                <td><strong>{{ $appointment->doctor->name }}</strong></td>
                                            </tr>
                                            <tr>
                                                <th>التخصص</th>
                                                <td>
                                                    <span class="badge badge-info">
                                                        {{ $appointment->doctor->doctorProfile->specialty->name ?? 'غير محدد' }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>البريد الإلكتروني</th>
                                                <td>{{ $appointment->doctor->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>الهاتف</th>
                                                <td>{{ $appointment->doctor->phone ?? 'غير متوفر' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                @else
                                <p class="text-muted">معلومات الطبيب غير متوفرة</p>
                                @endif
                            </div>
                        </div>

                        <!-- Notes Card -->
                        @if($appointment->patient_notes || $appointment->doctor_notes || $appointment->reason)
                        <div class="card card-secondary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-sticky-note mr-2"></i>
                                    الملاحظات
                                </h3>
                            </div>
                            <div class="card-body">
                                @if($appointment->reason)
                                <div class="mb-3">
                                    <strong>سبب الزيارة:</strong>
                                    <p class="mb-0">{{ $appointment->reason }}</p>
                                </div>
                                @endif
                                @if($appointment->patient_notes)
                                <div class="mb-3">
                                    <strong>ملاحظات المريض:</strong>
                                    <p class="mb-0">{{ $appointment->patient_notes }}</p>
                                </div>
                                @endif
                                @if($appointment->doctor_notes)
                                <div>
                                    <strong>ملاحظات الطبيب:</strong>
                                    <p class="mb-0">{{ $appointment->doctor_notes }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Cancellation Info -->
                        @if($appointment->status == 'cancelled')
                        <div class="card card-danger card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-times-circle mr-2"></i>
                                    معلومات الإلغاء
                                </h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <tr>
                                        <th width="200">سبب الإلغاء</th>
                                        <td>{{ $appointment->cancellation_reason ?? 'غير محدد' }}</td>
                                    </tr>
                                    <tr>
                                        <th>تاريخ الإلغاء</th>
                                        <td>{{ $appointment->cancelled_at ? $appointment->cancelled_at->format('Y-m-d h:i A') : 'غير محدد' }}</td>
                                    </tr>
                                    @if($appointment->cancelledBy)
                                    <tr>
                                        <th>ألغي بواسطة</th>
                                        <td>{{ $appointment->cancelledBy->name }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Side Panel -->
                    <div class="col-md-4">
                        <!-- Fees Card -->
                        <div class="card card-warning card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-money-bill-wave mr-2"></i>
                                    الرسوم والمدفوعات
                                </h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>الرسوم الأصلية</span>
                                        <strong>${{ number_format($appointment->original_fee ?? 0, 2) }}</strong>
                                    </li>
                                    @if($appointment->discount_amount > 0)
                                    <li class="list-group-item d-flex justify-content-between text-success">
                                        <span>الخصم</span>
                                        <strong>-${{ number_format($appointment->discount_amount, 2) }}</strong>
                                    </li>
                                    @endif
                                    <li class="list-group-item d-flex justify-content-between bg-light">
                                        <span><strong>المبلغ النهائي</strong></span>
                                        <strong class="text-primary">${{ number_format($appointment->final_fee ?? 0, 2) }}</strong>
                                    </li>
                                    @if($appointment->cashback_earned > 0)
                                    <li class="list-group-item d-flex justify-content-between text-success">
                                        <span>كاش باك مكتسب</span>
                                        <strong>${{ number_format($appointment->cashback_earned, 2) }}</strong>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <!-- Medical Center Card -->
                        @if($appointment->medicalCenter)
                        <div class="card card-secondary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-hospital mr-2"></i>
                                    المركز الطبي
                                </h3>
                            </div>
                            <div class="card-body">
                                <h5>{{ $appointment->medicalCenter->name }}</h5>
                                @if($appointment->medicalCenter->address)
                                <p class="text-muted mb-0">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    {{ $appointment->medicalCenter->address }}
                                </p>
                                @endif
                                @if($appointment->medicalCenter->phone)
                                <p class="text-muted mb-0">
                                    <i class="fas fa-phone mr-1"></i>
                                    {{ $appointment->medicalCenter->phone }}
                                </p>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Review Card -->
                        @if($appointment->rating)
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-star mr-2"></i>
                                    التقييم
                                </h3>
                            </div>
                            <div class="card-body text-center">
                                <div class="mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $appointment->rating ? 'text-warning' : 'text-muted' }} fa-lg"></i>
                                    @endfor
                                </div>
                                <h4 class="mb-2">{{ $appointment->rating }} / 5</h4>
                                @if($appointment->review)
                                <p class="text-muted">{{ $appointment->review }}</p>
                                @endif
                                @if($appointment->reviewed_at)
                                <small class="text-muted">
                                    تم التقييم: {{ $appointment->reviewed_at->format('Y-m-d') }}
                                </small>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Actions -->
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('admin.appointments.index') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    العودة للقائمة
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection
