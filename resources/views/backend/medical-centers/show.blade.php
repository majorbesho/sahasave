{{-- resources/views/admin/medical-centers/index.blade.php --}}
@extends('backend.layouts.master')


@section('title', 'تفاصيل المركز الطبي - ' . $medicalCenter->name)

@section('content')


    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h1>تفاصيل المركز الطبي</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('medical-centers.index') }}">المراكز
                                    الطبية</a></li>
                            <li class="breadcrumb-item active">تفاصيل المركز</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- بطاقة المعلومات الأساسية -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">المعلومات الأساسية</h3>
                        </div>
                        <div class="card-body">
                            <h4>{{ $medicalCenter->name }}</h4>
                            <p class="text-muted">{{ $medicalCenter->email }}</p>

                            <div class="mt-3">
                                <p><strong>النوع:</strong>
                                    @switch($medicalCenter->type)
                                        @case('clinic')
                                            عيادة
                                        @break

                                        @case('medical_center')
                                            مركز طبي
                                        @break

                                        @case('hospital')
                                            مستشفى
                                        @break

                                        @case('lab')
                                            مختبر
                                        @break
                                    @endswitch
                                </p>

                                <p><strong>الهاتف:</strong> {{ $medicalCenter->phone }}</p>

                                @if ($medicalCenter->website)
                                    <p><strong>الموقع:</strong>
                                        <a href="{{ $medicalCenter->website }}"
                                            target="_blank">{{ $medicalCenter->website }}</a>
                                    </p>
                                @endif
                            </div>

                            <div class="mt-3">
                                <span
                                    class="badge badge-{{ $medicalCenter->status == 'active' ? 'success' : ($medicalCenter->status == 'pending' ? 'warning' : 'danger') }}">
                                    {{ $medicalCenter->status }}
                                </span>
                                @if ($medicalCenter->is_verified)
                                    <span class="badge badge-info">معتمد</span>
                                @endif
                                @if ($medicalCenter->is_featured)
                                    <span class="badge badge-warning">مميز</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- إجراءات سريعة -->
                    <div class="mt-3 card">
                        <div class="card-header">
                            <h3 class="card-title">إجراءات سريعة</h3>
                        </div>
                        <div class="card-body">
                            @if (!$medicalCenter->is_verified)
                                <form action="{{ route('medical-centers.verify', $medicalCenter->id) }}" method="POST"
                                    class="mb-2">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-block">
                                        <i class="fas fa-check"></i> التحقق من المركز
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('medical-centers.unverify', $medicalCenter->id) }}" method="POST"
                                    class="mb-2">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-block">
                                        <i class="fas fa-times"></i> إلغاء التحقق
                                    </button>
                                </form>
                            @endif

                            @if (!$medicalCenter->is_featured)
                                <form action="{{ route('medical-centers.feature', $medicalCenter->id) }}" method="POST"
                                    class="mb-2">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-block">
                                        <i class="fas fa-star"></i> تمييز المركز
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('medical-centers.unfeature', $medicalCenter->id) }}" method="POST"
                                    class="mb-2">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary btn-block">
                                        <i class="fas fa-star"></i> إلغاء التمييز
                                    </button>
                                </form>
                            @endif

                           <a href="{{ route('medical-centers.manage-doctors', $medicalCenter->id) }}" class="btn btn-primary btn-block">
    <i class="fas fa-user-md"></i> إدارة الأطباء
</a>

                            <a href="{{ route('medical-centers.edit', $medicalCenter->id) }}"
                                class="btn btn-outline-primary btn-block">
                                <i class="fas fa-edit"></i> تعديل البيانات
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- العنوان والموقع -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">العنوان والموقع</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>العنوان:</strong> {{ $medicalCenter->address }}</p>
                            <p><strong>المدينة:</strong> {{ $medicalCenter->city }}</p>
                            @if ($medicalCenter->state)
                                <p><strong>المنطقة:</strong> {{ $medicalCenter->state }}</p>
                            @endif
                            <p><strong>الدولة:</strong> {{ $medicalCenter->country }}</p>
                            @if ($medicalCenter->postal_code)
                                <p><strong>الرمز البريدي:</strong> {{ $medicalCenter->postal_code }}</p>
                            @endif

                            @if ($medicalCenter->latitude && $medicalCenter->longitude)
                                <div class="mt-3">
                                    <strong>الموقع على الخريطة:</strong>
                                    <p class="text-muted">خط العرض: {{ $medicalCenter->latitude }}, خط الطول:
                                        {{ $medicalCenter->longitude }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- الإحصائيات -->
                    <div class="mt-3 card">
                        <div class="card-header">
                            <h3 class="card-title">الإحصائيات</h3>
                        </div>
                        <div class="card-body">
                            <div class="text-center row">
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-primary"><i class="fas fa-user-md"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">الأطباء</span>
                                            <span
                                                class="info-box-number">{{ $medicalCenter->active_doctors_count ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i class="fas fa-calendar-check"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">المواعيد</span>
                                            <span
                                                class="info-box-number">{{ $medicalCenter->appointments_count ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning"><i class="fas fa-star"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">التقييم</span>
                                            <span class="info-box-number">{{ $medicalCenter->average_rating }}/5</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><i class="fas fa-comments"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">التقييمات</span>
                                            <span class="info-box-number">{{ $medicalCenter->ratings_count ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- الخدمات والمرافق -->
                    <div class="mt-3 card">
                        <div class="card-header">
                            <h3 class="card-title">الخدمات والمرافق</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6>الخدمات المقدمة:</h6>
                                    @if ($medicalCenter->services && count($medicalCenter->services) > 0)
                                        <ul class="list-unstyled">
                                            @foreach ($medicalCenter->services as $service)
                                                <li><i class="mr-1 fas fa-check text-success"></i> {{ $service }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-muted">لا توجد خدمات مسجلة</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <h6>المرافق المتاحة:</h6>
                                    @if ($medicalCenter->facilities && count($medicalCenter->facilities) > 0)
                                        <ul class="list-unstyled">
                                            @foreach ($medicalCenter->facilities as $facility)
                                                <li><i class="mr-1 fas fa-check text-success"></i> {{ $facility }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-muted">لا توجد مرافق مسجلة</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <h6>شركات التأمين:</h6>
                                    @if ($medicalCenter->insurance_providers && count($medicalCenter->insurance_providers) > 0)
                                        <ul class="list-unstyled">
                                            @foreach ($medicalCenter->insurance_providers as $insurance)
                                                <li><i class="mr-1 fas fa-check text-success"></i> {{ $insurance }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-muted">لا توجد شركات تأمين مسجلة</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- الأطباء النشطين -->
                    @if ($medicalCenter->activeDoctors && $medicalCenter->activeDoctors->count() > 0)
                        <div class="mt-3 card">
                            <div class="card-header">
                                <h3 class="card-title">الأطباء النشطين</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($medicalCenter->activeDoctors as $doctor)
                                        <div class="mb-3 col-md-6">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('assets/img/default-avatar.png') }}"
                                                    class="mr-3 img-circle" width="50" height="50"
                                                    alt="صورة الطبيب">
                                                <div>
                                                    <strong>{{ $doctor->name }}</strong><br>
                                                    <small
                                                        class="text-muted">{{ $doctor->doctorProfile->specialization ?? 'غير محدد' }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
