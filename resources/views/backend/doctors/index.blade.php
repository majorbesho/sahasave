@extends('backend.layouts.master')


@section('title', 'إدارة الأطباء')

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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">قائمة الأطباء</h3>
                            <div class="card-tools">
                                <a href="{{ route('doctors.statistics') }}" class="btn btn-info">
                                    <i class="fas fa-chart-bar"></i> الإحصائيات
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- فلتر البحث -->
                            <form method="GET" class="mb-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="بحث بالاسم، البريد، التخصص..." value="{{ request('search') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <select name="status" class="form-control">
                                            <option value="">جميع الحالات</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                                قيد
                                                المراجعة</option>
                                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>نشط
                                            </option>
                                            <option value="rejected"
                                                {{ request('status') == 'rejected' ? 'selected' : '' }}>
                                                مرفوض</option>
                                            <option value="suspended"
                                                {{ request('status') == 'suspended' ? 'selected' : '' }}>
                                                موقوف</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="verification_status" class="form-control">
                                            <option value="">جميع حالات التحقق</option>
                                            <option value="pending_review"
                                                {{ request('verification_status') == 'pending_review' ? 'selected' : '' }}>
                                                قيد
                                                المراجعة</option>
                                            <option value="verified"
                                                {{ request('verification_status') == 'verified' ? 'selected' : '' }}>معتمد
                                            </option>
                                            <option value="rejected"
                                                {{ request('verification_status') == 'rejected' ? 'selected' : '' }}>مرفوض
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">بحث</button>
                                        <a href="{{ route('doctors.index') }}" class="btn btn-secondary">إعادة تعيين</a>
                                    </div>
                                </div>
                            </form>

                            <!-- جدول الأطباء -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الطبيب</th>
                                            <th>التخصص</th>
                                            <th>رقم الرخصة</th>
                                            <th>حالة الحساب</th>
                                            <th>حالة التحقق</th>
                                            <th>تاريخ التسجيل</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($doctors as $doctor)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('assets/img/default-avatar.png') }}"
                                                            class="mr-2 img-circle" width="40" height="40"
                                                            alt="صورة الطبيب">
                                                        <div>
                                                            <strong>{{ $doctor->name }}</strong><br>
                                                            <small class="text-muted">{{ $doctor->email }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $doctor->doctorProfile->specialization ?? 'غير محدد' }}</td>
                                                <td>{{ $doctor->doctorProfile->medical_license_number ?? 'غير محدد' }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $doctor->status == 'active' ? 'success' : ($doctor->status == 'pending' ? 'warning' : 'danger') }}">
                                                        {{ $doctor->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($doctor->doctorProfile)
                                                        <span
                                                            class="badge badge-{{ $doctor->doctorProfile->verification_status == 'verified' ? 'success' : ($doctor->doctorProfile->verification_status == 'pending_review' ? 'warning' : 'danger') }}">
                                                            {{ $doctor->doctorProfile->verification_status }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-secondary">لا يوجد بروفايل</span>
                                                    @endif
                                                </td>
                                                <td>{{ $doctor->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('doctors.showxx', $doctor->id) }}"
                                                            class="btn btn-info btn-sm" title="عرض">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('doctors.edit', $doctor->id) }}"
                                                            class="btn btn-primary btn-sm" title="تعديل">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @if ($doctor->status == 'pending')
                                                            <form action="{{ route('doctors.approve', $doctor->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm"
                                                                    title="اعتماد">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        <form action="{{ route('doctors.destroy', $doctor->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                title="حذف"
                                                                onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- الترقيم -->
                            <div class="mt-4 d-flex justify-content-center">
                                {{ $doctors->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
