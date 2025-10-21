@extends('frontend.layouts.master')

@section('title', 'حجز موعد مع د. ' . $doctor->name)

@section('content')
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="text-center col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('doctorshome.search') }}">الأطباء</a></li>
                            <li class="breadcrumb-item active">حجز موعد</li>
                        </ol>
                        <h2 class="breadcrumb-title">حجز موعد مع د. {{ $doctor->name }}</h2>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <!-- معلومات الطبيب -->
                    <div class="card">
                        <div class="text-center card-body">
                            <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" class="mb-3 rounded-circle"
                                width="120">
                            <h4>د. {{ $doctor->name }}</h4>
                            <p class="text-muted">{{ $doctor->doctorProfile->specialization ?? 'طبيب عام' }}</p>
                            <p><i class="fa-solid fa-star text-warning"></i>
                                {{ $doctor->doctorProfile->average_rating ?? '4.5' }}/5</p>
                            <p><i class="fa-solid fa-graduation-cap"></i>
                                {{ $doctor->doctorProfile->years_of_experience ?? '0' }} سنة خبرة</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- الجداول الزمنية -->
                    <div class="card">
                        <div class="card-header">
                            <h4>اختر الموعد المناسب</h4>
                        </div>
                        <div class="card-body">
                            @if (count($schedulesByCenter) > 0)
                                @foreach ($schedulesByCenter as $centerData)
                                    <div class="mb-4 medical-center-schedule">
                                        <h5>{{ $centerData['medical_center']->name }}</h5>
                                        <p class="text-muted">{{ $centerData['medical_center']->address }}</p>

                                        <div class="schedule-days">
                                            @foreach ($centerData['schedules'] as $schedule)
                                                <div class="mb-3 schedule-day">
                                                    <h6>{{ $schedule->day_name_arabic }}</h6>
                                                    <p>{{ $schedule->time_range }}</p>
                                                    <button class="btn btn-outline-primary btn-sm"
                                                        onclick="selectSchedule({{ $schedule->id }})">
                                                        اختر هذا الوقت
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="py-4 text-center">
                                    <i class="mb-3 fa-solid fa-calendar-times fa-3x text-muted"></i>
                                    <h5>لا توجد جداول متاحة</h5>
                                    <p class="text-muted">لا توجد أوقات متاحة للحجز حالياً</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function selectSchedule(scheduleId) {
            // هنا يمكنك إضافة منطق اختيار الجدول
            alert('تم اختيار الجدول: ' + scheduleId);
            // يمكنك توجيه المستخدم إلى صفحة تأكيد الحجز
            // window.location.href = '/appointments/confirm/' + scheduleId;
        }
    </script>
@endpush
