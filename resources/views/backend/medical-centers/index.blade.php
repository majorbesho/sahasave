{{-- resources/views/admin/medical-centers/index.blade.php --}}
@extends('backend.layouts.master')


@section('title', 'إدارة المراكز الطبية')

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
                            <h3 class="card-title">قائمة المراكز الطبية</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.medical-centers.create') }}" class="btn btn-success">
                                    <i class="fas fa-plus"></i> إضافة مركز طبي
                                </a>
                                <a href="{{ route('admin.medical-centers.statistics') }}" class="btn btn-info">
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
                                            placeholder="بحث بالاسم، المدينة..." value="{{ request('search') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <select name="type" class="form-control">
                                            <option value="">جميع الأنواع</option>
                                            <option value="clinic" {{ request('type') == 'clinic' ? 'selected' : '' }}>عيادة
                                            </option>
                                            <option value="medical_center"
                                                {{ request('type') == 'medical_center' ? 'selected' : '' }}>مركز طبي
                                            </option>
                                            <option value="hospital" {{ request('type') == 'hospital' ? 'selected' : '' }}>
                                                مستشفى</option>
                                            <option value="lab" {{ request('type') == 'lab' ? 'selected' : '' }}>مختبر
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="status" class="form-control">
                                            <option value="">جميع الحالات</option>
                                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>نشط
                                            </option>
                                            <option value="inactive"
                                                {{ request('status') == 'inactive' ? 'selected' : '' }}>غير
                                                نشط</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                                قيد
                                                المراجعة</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="is_verified" class="form-control">
                                            <option value="">جميع حالات التحقق</option>
                                            <option value="1" {{ request('is_verified') == '1' ? 'selected' : '' }}>
                                                معتمد
                                            </option>
                                            <option value="0" {{ request('is_verified') == '0' ? 'selected' : '' }}>
                                                غير
                                                معتمد</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">بحث</button>
                                        <a href="{{ route('admin.medical-centers.index') }}" class="btn btn-secondary">إعادة
                                            تعيين</a>
                                    </div>
                                </div>
                            </form>

                            <!-- جدول المراكز الطبية -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>النوع</th>
                                            <th>المدينة</th>
                                            <th>عدد الأطباء</th>
                                            <th>التقييم</th>
                                            <th>الحالة</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($medicalCenters as $center)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <strong>{{ $center->name }}</strong><br>
                                                            <small class="text-muted">{{ $center->email }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @switch($center->type)
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
                                                </td>
                                                <td>{{ $center->city }}</td>
                                                <td>{{ $center->active_doctors_count }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="text-warning">
                                                            <i class="fas fa-star"></i> {{ $center->average_rating }}
                                                        </span>
                                                        <small
                                                            class="mr-1 text-muted">({{ $center->rating_count }})</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $center->status == 'active' ? 'success' : ($center->status == 'pending' ? 'warning' : 'danger') }}">
                                                        {{ $center->status }}
                                                    </span>
                                                    @if ($center->is_verified)
                                                        <span class="badge badge-info">معتمد</span>
                                                    @endif
                                                    @if ($center->is_featured)
                                                        <span class="badge badge-warning">مميز</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.medical-centers.show', $center->id) }}"
                                                            class="btn btn-info btn-sm" title="عرض">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.medical-centers.edit', $center->id) }}"
                                                            class="btn btn-primary btn-sm" title="تعديل">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('admin.medical-centers.manage-doctors', $center->id) }}"
                                                            class="btn btn-success btn-sm" title="إدارة الأطباء">
                                                            <i class="fas fa-user-md"></i>
                                                        </a>
                                                        <form action="{{ route('admin.medical-centers.destroy', $center->id) }}"
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
                                {{ $medicalCenters->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
