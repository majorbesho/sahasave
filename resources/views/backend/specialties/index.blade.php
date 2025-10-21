@extends('backend.layouts.master')

@section('title', 'إدارة التخصصات')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h1>Banners</h1>
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
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title">قائمة التخصصات</h3>
                                <a href="{{ route('admin.specialties.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> إضافة تخصص جديد
                                </a>
                            </div>

                            <div class="card-tools">
                                <form action="{{ route('admin.specialties.index') }}" method="GET" class="form-inline">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="search" class="form-control" placeholder="بحث..."
                                            value="{{ request('search') }}">
                                        <select name="level" class="form-control">
                                            <option value="">جميع المستويات</option>
                                            <option value="1" {{ request('level') == '1' ? 'selected' : '' }}>رئيسي
                                            </option>
                                            <option value="2" {{ request('level') == '2' ? 'selected' : '' }}>فرعي
                                            </option>
                                            <option value="3" {{ request('level') == '3' ? 'selected' : '' }}>دقيق
                                            </option>
                                        </select>
                                        <select name="status" class="form-control">
                                            <option value="">جميع الحالات</option>
                                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                                                مفعل
                                            </option>
                                            <option value="inactive"
                                                {{ request('status') == 'inactive' ? 'selected' : '' }}>
                                                معطل</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="p-0 card-body table-responsive">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الصورة</th>
                                        <th>الاسم (عربي)</th>
                                        <th>الاسم (إنجليزي)</th>
                                        <th>المستوى</th>
                                        <th>عدد الأطباء</th>
                                        <th>الترتيب</th>
                                        <th>الحالة</th>
                                        <th>التميز</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($specialties as $specialty)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ $specialty->image_url }}" alt="{{ $specialty->name }}"
                                                    class="img-circle img-size-50">
                                            </td>
                                            <td>{{ $specialty->name_ar }}</td>
                                            <td>{{ $specialty->name_en }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $specialty->level == 1 ? 'primary' : ($specialty->level == 2 ? 'success' : 'info') }}">
                                                    {{ $specialty->level == 1 ? 'رئيسي' : ($specialty->level == 2 ? 'فرعي' : 'دقيق') }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">{{ $specialty->doctors_count }}</span>
                                            </td>
                                            <td>{{ $specialty->order }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $specialty->is_active ? 'success' : 'danger' }}">
                                                    {{ $specialty->is_active ? 'مفعل' : 'معطل' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $specialty->is_featured ? 'warning' : 'secondary' }}">
                                                    {{ $specialty->is_featured ? 'مميز' : 'عادي' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.specialties.show', $specialty) }}"
                                                        class="btn btn-info btn-sm" title="عرض">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.specialties.edit', $specialty) }}"
                                                        class="btn btn-primary btn-sm" title="تعديل">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.specialties.toggle-status', $specialty) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-{{ $specialty->is_active ? 'warning' : 'success' }} btn-sm"
                                                            title="{{ $specialty->is_active ? 'تعطيل' : 'تفعيل' }}">
                                                            <i
                                                                class="fas fa-{{ $specialty->is_active ? 'pause' : 'play' }}"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.specialties.destroy', $specialty) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="حذف"
                                                            onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">لا توجد تخصصات</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer">
                            {{ $specialties->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
