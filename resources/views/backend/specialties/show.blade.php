@extends('backend.layouts.master')

@section('title', 'تفاصيل التخصص: ' . $specialty->name_ar)

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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">معلومات التخصص</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 text-center">
                                @if ($specialty->image)
                                    <img src="{{ $specialty->image_url }}" alt="{{ $specialty->name }}"
                                        class="rounded img-fluid" style="max-height: 200px;">
                                @endif
                            </div>

                            <table class="table table-bordered">
                                <tr>
                                    <th>الاسم بالعربية:</th>
                                    <td>{{ $specialty->name_ar }}</td>
                                </tr>
                                <tr>
                                    <th>الاسم بالإنجليزية:</th>
                                    <td>{{ $specialty->name_en }}</td>
                                </tr>
                                <tr>
                                    <th>المستوى:</th>
                                    <td>
                                        <span
                                            class="badge badge-{{ $specialty->level == 1 ? 'primary' : ($specialty->level == 2 ? 'success' : 'info') }}">
                                            {{ $specialty->level == 1 ? 'رئيسي' : ($specialty->level == 2 ? 'فرعي' : 'دقيق') }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>التخصص الرئيسي:</th>
                                    <td>{{ $specialty->parent ? $specialty->parent->name_ar : '---' }}</td>
                                </tr>
                                <tr>
                                    <th>عدد الأطباء:</th>
                                    <td><span class="badge badge-info">{{ $specialty->doctors_count }}</span></td>
                                </tr>
                                <tr>
                                    <th>الترتيب:</th>
                                    <td>{{ $specialty->order }}</td>
                                </tr>
                                <tr>
                                    <th>الحالة:</th>
                                    <td>
                                        <span class="badge badge-{{ $specialty->is_active ? 'success' : 'danger' }}">
                                            {{ $specialty->is_active ? 'مفعل' : 'معطل' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>التميز:</th>
                                    <td>
                                        <span class="badge badge-{{ $specialty->is_featured ? 'warning' : 'secondary' }}">
                                            {{ $specialty->is_featured ? 'مميز' : 'عادي' }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">الوصف والمعلومات الإضافية</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>الوصف بالعربية:</h5>
                                    <p>{{ $specialty->description_ar ?: '---' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5>الوصف بالإنجليزية:</h5>
                                    <p>{{ $specialty->description_en ?: '---' }}</p>
                                </div>
                            </div>

                            @if ($specialty->children->count() > 0)
                                <div class="mt-4">
                                    <h5>التخصصات الفرعية:</h5>
                                    <div class="row">
                                        @foreach ($specialty->children as $child)
                                            <div class="mb-2 col-md-6">
                                                <span class="badge badge-secondary">{{ $child->name_ar }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($specialty->doctors->count() > 0)
                        <div class="mt-4 card">
                            <div class="card-header">
                                <h3 class="card-title">الأطباء في هذا التخصص ({{ $specialty->doctors->count() }})</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($specialty->doctors as $doctorProfile)
                                        <div class="mb-3 col-md-6">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $doctorProfile->doctor->photo_url }}"
                                                    alt="{{ $doctorProfile->doctor->name }}" class="mr-3 rounded-circle"
                                                    width="50" height="50">
                                                <div>
                                                    <h6 class="mb-0">{{ $doctorProfile->doctor->name }}</h6>
                                                    <small class="text-muted">{{ $doctorProfile->doctor->email }}</small>
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
    @endsection
