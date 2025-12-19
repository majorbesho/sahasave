@extends('backend.layouts.master')

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
                            <h3 class="card-title">{{ isset($category) ? 'تعديل التصنيف' : 'إضافة تصنيف جديد' }}</h3>
                        </div>
                        <form
                            action="{{ isset($category) ? route('categories.admin.update', $category) : route('categories.admin.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($category))
                                @method('PUT')
                            @endif

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">اسم التصنيف *</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name"
                                                value="{{ old('name', $category->name ?? '') }}" required>
                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="parent_id">التصنيف الأب</label>
                                            <select class="form-control @error('parent_id') is-invalid @enderror"
                                                id="parent_id" name="parent_id">
                                                <option value="">بدون تصنيف أب</option>
                                                @foreach ($parentCategories as $parent)
                                                    <option value="{{ $parent->id }}"
                                                        {{ old('parent_id', $category->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                                                        {{ $parent->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('parent_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">الوصف</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="3">{{ old('description', $category->description ?? '') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="icon">الأيقونة</label>
                                            <input type="file"
                                                class="form-control-file @error('icon') is-invalid @enderror" id="icon"
                                                name="icon" accept="image/*">
                                            @error('icon')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            @if (isset($category) && $category->icon)
                                                <div class="mt-2">
                                                    <img src="{{ Storage::url($category->icon) }}"
                                                        alt="{{ $category->name }}"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="color">اللون</label>
                                            <input type="color" class="form-control @error('color') is-invalid @enderror"
                                                id="color" name="color"
                                                value="{{ old('color', $category->color ?? '#3B82F6') }}">
                                            @error('color')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sort_order">ترتيب العرض</label>
                                            <input type="number"
                                                class="form-control @error('sort_order') is-invalid @enderror"
                                                id="sort_order" name="sort_order"
                                                value="{{ old('sort_order', $category->sort_order ?? '') }}">
                                            @error('sort_order')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">الحالة *</label>
                                            <select class="form-control @error('status') is-invalid @enderror"
                                                id="status" name="status" required>
                                                <option value="active"
                                                    {{ old('status', $category->status ?? '') == 'active' ? 'selected' : '' }}>
                                                    مفعل</option>
                                                <option value="inactive"
                                                    {{ old('status', $category->status ?? '') == 'inactive' ? 'selected' : '' }}>
                                                    غير مفعل</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="mt-4 custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="is_featured"
                                                    name="is_featured" value="1"
                                                    {{ old('is_featured', $category->is_featured ?? false) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="is_featured">تصنيف مميز</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="meta_title">عنوان SEO</label>
                                            <input type="text"
                                                class="form-control @error('meta_title') is-invalid @enderror"
                                                id="meta_title" name="meta_title"
                                                value="{{ old('meta_title', $category->meta_title ?? '') }}">
                                            @error('meta_title')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="meta_description">وصف SEO</label>
                                            <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description"
                                                name="meta_description" rows="2">{{ old('meta_description', $category->meta_description ?? '') }}</textarea>
                                            @error('meta_description')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($category) ? 'تحديث' : 'إنشاء' }}
                                </button>
                                <a href="{{ route('categories.index') }}" class="btn btn-secondary">إلغاء</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
