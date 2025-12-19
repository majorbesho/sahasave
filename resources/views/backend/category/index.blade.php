@extends('backend.layouts.master')

@section('title', 'إدارة التصنيفات')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h1>category</h1>
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
                            <h3 class="card-title">قائمة التصنيفات</h3>
                            <div class="card-tools">
                                <a href="{{ route('categories.create') }}" class="btn btn-success">
                                    <i class="fas fa-plus"></i> إضافة تصنيف جديد
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>الاسم</th>
                                        <th>الأيقونة</th>
                                        <th>التصنيف الأب</th>
                                        <th>عدد الأطباء</th>
                                        <th>الترتيب</th>
                                        <th>الحالة</th>
                                        <th>مميز</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                @if ($category->icon)
                                                    <img src="{{ Storage::url($category->icon) }}"
                                                        alt="{{ $category->name }}"
                                                        style="width: 30px; height: 30px; object-fit: cover;">
                                                @endif
                                            </td>
                                            <td>{{ $category->parent->name ?? '-' }}</td>
                                            <td>{{ $category->doctors_count }}</td>
                                            <td>{{ $category->sort_order }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $category->status == 'active' ? 'success' : 'danger' }}">
                                                    {{ $category->status == 'active' ? 'مفعل' : 'غير مفعل' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $category->is_featured ? 'warning' : 'secondary' }}">
                                                    {{ $category->is_featured ? 'مميز' : 'عادي' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('categories.show', $category) }}"
                                                        class="btn btn-info btn-sm" title="عرض">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('categories.edit', $category) }}"
                                                        class="btn btn-primary btn-sm" title="تعديل">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('categories.destroy', $category) }}"
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
