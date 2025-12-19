@extends('backend.layouts.master')

@section('title', 'إضافة تخصص جديد')

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
                            <h3 class="card-title">إضافة تخصص جديد</h3>
                        </div>

                        <form action="{{ route('admin.specialties.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name_ar">الاسم بالعربية *</label>
                                            <input type="text"
                                                class="form-control @error('name_ar') is-invalid @enderror" id="name_ar"
                                                name="name_ar" value="{{ old('name_ar') }}" required>
                                            @error('name_ar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name_en">الاسم بالإنجليزية *</label>
                                            <input type="text"
                                                class="form-control @error('name_en') is-invalid @enderror" id="name_en"
                                                name="name_en" value="{{ old('name_en') }}" required>
                                            @error('name_en')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description_ar">الوصف بالعربية</label>
                                            <textarea class="form-control @error('description_ar') is-invalid @enderror" id="description_ar" name="description_ar"
                                                rows="3">{{ old('description_ar') }}</textarea>
                                            @error('description_ar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description_en">الوصف بالإنجليزية</label>
                                            <textarea class="form-control @error('description_en') is-invalid @enderror" id="description_en" name="description_en"
                                                rows="3">{{ old('description_en') }}</textarea>
                                            @error('description_en')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="parent_id">التخصص الرئيسي</label>
                                            <select class="form-control @error('parent_id') is-invalid @enderror"
                                                id="parent_id" name="parent_id">
                                                <option value="">-- اختر التخصص الرئيسي --</option>
                                                @foreach ($mainSpecialties as $main)
                                                    <option value="{{ $main->id }}"
                                                        {{ old('parent_id') == $main->id ? 'selected' : '' }}>
                                                        {{ $main->name_ar }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('parent_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="level">المستوى *</label>
                                            <select class="form-control @error('level') is-invalid @enderror" id="level"
                                                name="level" required>
                                                <option value="1" {{ old('level') == '1' ? 'selected' : '' }}>رئيسي
                                                </option>
                                                <option value="2" {{ old('level') == '2' ? 'selected' : '' }}>فرعي
                                                </option>
                                                <option value="3" {{ old('level') == '3' ? 'selected' : '' }}>تخصص
                                                    دقيق
                                                </option>
                                            </select>
                                            @error('level')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="order">ترتيب العرض</label>
                                            <input type="number" class="form-control @error('order') is-invalid @enderror"
                                                id="order" name="order" value="{{ old('order', 0) }}">
                                            @error('order')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">الصورة الرئيسية</label>
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('image') is-invalid @enderror"
                                                    id="image" name="image" accept="image/*">
                                                <label class="custom-file-label" for="image">اختر صورة</label>
                                                @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="icon">الأيقونة</label>
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('icon') is-invalid @enderror"
                                                    id="icon" name="icon" accept="image/*">
                                                <label class="custom-file-label" for="icon">اختر أيقونة</label>
                                                @error('icon')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="color">اللون</label>
                                            <input type="color"
                                                class="form-control @error('color') is-invalid @enderror" id="color"
                                                name="color" value="{{ old('color', '#3498db') }}">
                                            @error('color')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="mt-4 custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="is_active"
                                                    name="is_active" value="1"
                                                    {{ old('is_active', true) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="is_active">مفعل</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="mt-4 custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="is_featured"
                                                    name="is_featured" value="1"
                                                    {{ old('is_featured') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="is_featured">مميز</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- SEO Section -->
                                <div class="row">
                                    <div class="col-12">
                                        <h5>إعدادات SEO</h5>
                                        <hr>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="meta_title_ar">Meta Title عربي</label>
                                            <input type="text" class="form-control" id="meta_title_ar"
                                                name="meta_title_ar" value="{{ old('meta_title_ar') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="meta_title_en">Meta Title إنجليزي</label>
                                            <input type="text" class="form-control" id="meta_title_en"
                                                name="meta_title_en" value="{{ old('meta_title_en') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="meta_description_ar">Meta Description عربي</label>
                                            <textarea class="form-control" id="meta_description_ar" name="meta_description_ar" rows="2">{{ old('meta_description_ar') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="meta_description_en">Meta Description إنجليزي</label>
                                            <textarea class="form-control" id="meta_description_en" name="meta_description_en" rows="2">{{ old('meta_description_en') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">حفظ التخصص</button>
                                <a href="{{ route('admin.specialties.index') }}" class="btn btn-default">إلغاء</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Show file name in file input
            document.querySelectorAll('.custom-file-input').forEach(function(input) {
                input.addEventListener('change', function(e) {
                    var fileName = e.target.files[0]?.name || 'اختر ملف';
                    var nextSibling = e.target.nextElementSibling;
                    nextSibling.innerText = fileName;
                });
            });

            // Auto-generate meta titles if empty
            document.getElementById('name_ar').addEventListener('blur', function() {
                if (!document.getElementById('meta_title_ar').value) {
                    document.getElementById('meta_title_ar').value = this.value;
                }
            });

            document.getElementById('name_en').addEventListener('blur', function() {
                if (!document.getElementById('meta_title_en').value) {
                    document.getElementById('meta_title_en').value = this.value;
                }
            });
        </script>

    @endsection
