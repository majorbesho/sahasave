@extends('backend.layouts.master')
@section('title', 'تفاصيل الطبيب - ' . $doctor->name)

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h1>تفاصيل الطبيب</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item active">تفاصيل الطبيب</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- بطاقة المعلومات الشخصية -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">المعلومات الشخصية</h3>
                        </div>
                        <div class="text-center card-body">
                            <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('assets/img/default-avatar.png') }}"
                                class="mb-3 img-circle" width="120" height="120" alt="صورة الطبيب">
                            <h4>{{ $doctor->name }}</h4>
                            <p class="text-muted">{{ $doctor->email }}</p>
                            <p><i class="fas fa-phone"></i> {{ $doctor->phone }}</p>

                            <div class="mt-3">
                                <span
                                    class="badge badge-{{ $doctor->status == 'active' ? 'success' : ($doctor->status == 'pending' ? 'warning' : 'danger') }} mb-2">
                                    حالة الحساب: {{ $doctor->status }}
                                </span>
                                <br>
                                @if ($doctor->doctorProfile)
                                    <span
                                        class="badge badge-{{ $doctor->doctorProfile->verification_status == 'verified' ? 'success' : ($doctor->doctorProfile->verification_status == 'pending_review' ? 'warning' : 'danger') }}">
                                        حالة التحقق: {{ $doctor->doctorProfile->verification_status }}
                                    </span>
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
                            @if ($doctor->status == 'pending')
                                <form action="{{ route('doctors.approve', $doctor->id) }}" method="POST" class="mb-2">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-block">
                                        <i class="fas fa-check"></i> اعتماد الطبيب
                                    </button>
                                </form>

                                <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                                    data-target="#rejectModal">
                                    <i class="fas fa-times"></i> رفض الطبيب
                                </button>
                            @endif

                            @if ($doctor->status == 'active')
                                <button type="button" class="btn btn-warning btn-block" data-toggle="modal"
                                    data-target="#suspendModal">
                                    <i class="fas fa-pause"></i> تعليق الطبيب
                                </button>
                            @endif

                            @if ($doctor->status == 'suspended')
                                <form action="{{ route('doctors.updateStatus', $doctor->id) }}" method="POST"
                                    class="mb-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="active">
                                    <button type="submit" class="btn btn-success btn-block">
                                        <i class="fas fa-play"></i> تفعيل الطبيب
                                    </button>
                                </form>
                            @endif

                            <!-- زر التميز - مرة واحدة فقط -->
                            @if ($doctor->doctorProfile)
                                <form action="{{ route('doctors.toggle-featured', $doctor->id) }}" method="POST"
                                    class="mt-3">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="btn btn-{{ $doctor->doctorProfile->is_featured ? 'warning' : 'primary' }} btn-block">
                                        <i class="fas fa-star"></i>
                                        {{ $doctor->doctorProfile->is_featured ? 'إلغاء التميز' : 'تمييز الطبيب' }}
                                    </button>
                                </form>
                            @endif

                            <!-- تحديث حالة التحقق -->
                            @if ($doctor->doctorProfile)
                                <form action="{{ route('doctors.updateVerificationStatus', $doctor->id) }}" method="POST"
                                    class="mt-3">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>تحديث حالة التحقق:</label>
                                        <select name="verification_status" class="form-control" required>
                                            <option value="pending_review"
                                                {{ $doctor->doctorProfile->verification_status == 'pending_review' ? 'selected' : '' }}>
                                                قيد المراجعة</option>
                                            <option value="under_review"
                                                {{ $doctor->doctorProfile->verification_status == 'under_review' ? 'selected' : '' }}>
                                                قيد الدراسة</option>
                                            <option value="verified"
                                                {{ $doctor->doctorProfile->verification_status == 'verified' ? 'selected' : '' }}>
                                                معتمد</option>
                                            <option value="rejected"
                                                {{ $doctor->doctorProfile->verification_status == 'rejected' ? 'selected' : '' }}>
                                                مرفوض</option>
                                            <option value="suspended"
                                                {{ $doctor->doctorProfile->verification_status == 'suspended' ? 'selected' : '' }}>
                                                موقوف</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>ملاحظات:</label>
                                        <textarea name="verification_notes" class="form-control" rows="3" placeholder="ملاحظات حول حالة التحقق...">{{ $doctor->doctorProfile->verification_notes ?? '' }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">تحديث حالة التحقق</button>
                                </form>
                            @else
                                <p class="text-center text-danger">لا يوجد بروفايل طبي</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- المعلومات المهنية -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">المعلومات المهنية</h3>
                        </div>
                        <div class="card-body">
                            @if ($doctor->doctorProfile)
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>التخصص:</strong> {{ $doctor->doctorProfile->specialization }}</p>
                                        <p><strong>رقم الرخصة الطبية:</strong>
                                            {{ $doctor->doctorProfile->medical_license_number }}</p>
                                        <p><strong>سنوات الخبرة:</strong>
                                            {{ $doctor->doctorProfile->years_of_experience ?? 'غير محدد' }}</p>
                                        <p><strong>رسوم الاستشارة:</strong>
                                            {{ $doctor->doctorProfile->consultation_fee ? $doctor->doctorProfile->consultation_fee . ' $' : 'غير محدد' }}
                                        </p>
                                        <p><strong>مميز:</strong>
                                            <span
                                                class="badge badge-{{ $doctor->doctorProfile->is_featured ? 'primary' : 'secondary' }}">
                                                {{ $doctor->doctorProfile->is_featured ? 'نعم' : 'لا' }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>الكلية الطبية:</strong>
                                            {{ $doctor->doctorProfile->medical_school ?? 'غير محدد' }}</p>
                                        <p><strong>سنة التخرج:</strong>
                                            {{ $doctor->doctorProfile->graduation_year ?? 'غير محدد' }}</p>
                                        <p><strong>المستشفى الحالي:</strong>
                                            {{ $doctor->doctorProfile->current_hospital ?? 'غير محدد' }}</p>
                                        <p><strong>المنصب الحالي:</strong>
                                            {{ $doctor->doctorProfile->current_position ?? 'غير محدد' }}</p>
                                    </div>
                                </div>

                                @if ($doctor->doctorProfile->bio)
                                    <div class="mt-3">
                                        <strong>السيرة الذاتية:</strong>
                                        <p class="mt-2">{{ $doctor->doctorProfile->bio }}</p>
                                    </div>
                                @endif

                                <!-- ملف الرخصة -->
                                <div class="mt-3">
                                    <strong>ملف الرخصة الطبية:</strong>
                                    @if ($doctor->doctorProfile->license_document_path)
                                        <div class="mt-2">
                                            <a href="{{ asset('storage/' . $doctor->doctorProfile->license_document_path) }}"
                                                target="_blank" class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-download"></i> عرض الملف
                                            </a>
                                        </div>
                                    @else
                                        <p class="text-muted">لا يوجد ملف مرفق</p>
                                    @endif
                                </div>
                            @else
                                <p class="text-muted">لا يوجد بروفايل طبي مكتمل</p>
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
                                        <span class="info-box-icon bg-info"><i class="fas fa-stethoscope"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">إجمالي الاستشارات</span>
                                            <span
                                                class="info-box-number">{{ $doctor->doctorProfile->total_consultations ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i class="fas fa-star"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">التقييم</span>
                                            <span
                                                class="info-box-number">{{ $doctor->doctorProfile->average_rating ?? 0 }}/5</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning"><i class="fas fa-comments"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">عدد التقييمات</span>
                                            <span
                                                class="info-box-number">{{ $doctor->doctorProfile->rating_count ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-primary"><i
                                                class="fas fa-calendar-check"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">يقبل مرضى جدد</span>
                                            <span class="info-box-number">
                                                {{ $doctor->doctorProfile && $doctor->doctorProfile->accepting_new_patients ? 'نعم' : 'لا' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal الرفض -->
        <div class="modal fade" id="rejectModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('doctors.reject', $doctor->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">رفض الطبيب</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>سبب الرفض:</label>
                                <textarea name="rejection_reason" class="form-control" rows="4" required
                                    placeholder="يرجى كتابة سبب الرفض..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-danger">رفض الطبيب</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal التعليق -->
        <div class="modal fade" id="suspendModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('doctors.suspend', $doctor->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">تعليق الطبيب</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>سبب التعليق:</label>
                                <textarea name="suspension_reason" class="form-control" rows="4" required
                                    placeholder="يرجى كتابة سبب التعليق..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-warning">تعليق الطبيب</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
