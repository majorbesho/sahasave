@extends('backend.layouts.master')

@section('title', 'تعديل التخصص: ' . $specialty->name_ar)

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
                            <h3 class="card-title">تعديل التخصص: {{ $specialty->name_ar }}</h3>
                        </div>

                        <form action="{{ route('admin.specialties.update', $specialty) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name_ar">الاسم بالعربية *</label>
                                            <input type="text"
                                                class="form-control @error('name_ar') is-invalid @enderror" id="name_ar"
                                                name="name_ar" value="{{ old('name_ar', $specialty->name_ar) }}" required>
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
                                                name="name_en" value="{{ old('name_en', $specialty->name_en) }}" required>
                                            @error('name_en')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- باقي الحقول مشابه لصفحة الإنشاء مع القيم الحالية -->
                                <!-- ... -->

                                <!-- عرض الصور الحالية -->
                                {{-- في قسم تحميل الصور - استبدل الكود الحالي بهذا --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">الصورة الرئيسية</label>
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('image') is-invalid @enderror"
                                                    id="image" name="image" accept="image/*"
                                                    onchange="previewImage(this, 'image-preview')">
                                                <label class="custom-file-label" for="image">اختر صورة (JPEG, PNG, GIF,
                                                    WebP - الحد الأقصى 5MB)</label>
                                                @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <small class="form-text text-muted">
                                                الأبعاد الموصى بها: 800×600 بكسل
                                            </small>

                                            {{-- معاينة الصورة --}}
                                            <div class="mt-2" id="image-preview-container" style="display: none;">
                                                <label>معاينة الصورة:</label>
                                                <div class="p-2 text-center border rounded">
                                                    <img id="image-preview" class="img-fluid" style="max-height: 200px;">
                                                    <button type="button" class="mt-2 btn btn-sm btn-danger"
                                                        onclick="removeImagePreview('image-preview')">
                                                        <i class="fas fa-times"></i> إزالة المعاينة
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="icon">الأيقونة</label>
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('icon') is-invalid @enderror"
                                                    id="icon" name="icon" accept="image/*"
                                                    onchange="previewImage(this, 'icon-preview')">
                                                <label class="custom-file-label" for="icon">اختر أيقونة (SVG, JPEG, PNG,
                                                    GIF, WebP - الحد الأقصى 2MB)</label>
                                                @error('icon')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <small class="form-text text-muted">
                                                الأبعاد الموصى بها: 200×200 بكسل
                                            </small>

                                            {{-- معاينة الأيقونة --}}
                                            <div class="mt-2" id="icon-preview-container" style="display: none;">
                                                <label>معاينة الأيقونة:</label>
                                                <div class="p-2 text-center border rounded">
                                                    <img id="icon-preview" class="img-fluid" style="max-height: 100px;">
                                                    <button type="button" class="mt-2 btn btn-sm btn-danger"
                                                        onclick="removeImagePreview('icon-preview')">
                                                        <i class="fas fa-times"></i> إزالة المعاينة
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- في صفحة التعديل فقط - إضافة خيارات حذف الصور الحالية --}}
                                @if (isset($specialty) && ($specialty->image || $specialty->icon))
                                    <div class="row">
                                        @if ($specialty->image)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>الصورة الحالية:</label>
                                                    <div class="p-2 text-center border rounded position-relative">
                                                        <img src="{{ $specialty->image_url }}" alt="{{ $specialty->name }}"
                                                            class="img-fluid" style="max-height: 200px;">
                                                        <div class="mt-2">
                                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                                onclick="confirmDelete('{{ route('admin.specialties.delete-image', $specialty) }}', 'الصورة')">
                                                                <i class="fas fa-trash"></i> حذف الصورة
                                                            </button>
                                                            <input type="hidden" name="delete_image" id="delete_image"
                                                                value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($specialty->icon)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>الأيقونة الحالية:</label>
                                                    <div class="p-2 text-center border rounded position-relative">
                                                        <img src="{{ $specialty->icon_url }}"
                                                            alt="{{ $specialty->name }}" class="img-fluid"
                                                            style="max-height: 100px;">
                                                        <div class="mt-2">
                                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                                onclick="confirmDelete('{{ route('admin.specialties.delete-icon', $specialty) }}', 'الأيقونة')">
                                                                <i class="fas fa-trash"></i> حذف الأيقونة
                                                            </button>
                                                            <input type="hidden" name="delete_icon" id="delete_icon"
                                                                value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">تحديث التخصص</button>
                                <a href="{{ route('admin.specialties.index') }}" class="btn btn-default">إلغاء</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script></script>
        <script>
            // عرض معاينة الصورة قبل الرفع
            function previewImage(input, previewId) {
                const file = input.files[0];
                const preview = document.getElementById(previewId);
                const container = document.getElementById(previewId + '-container');

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        container.style.display = 'block';
                    }

                    reader.readAsDataURL(file);

                    // عرض اسم الملف
                    const label = input.nextElementSibling;
                    label.innerText = file.name;
                }
            }

            // إزالة معاينة الصورة
            function removeImagePreview(previewId) {
                const input = document.getElementById(previewId.replace('-preview', ''));
                const preview = document.getElementById(previewId);
                const container = document.getElementById(previewId + '-container');

                input.value = '';
                preview.src = '';
                container.style.display = 'none';

                // إعادة تسمية label
                const label = input.nextElementSibling;
                label.innerText = 'اختر ملف';
            }

            // تأكيد حذف الصورة
            function confirmDelete(url, type) {
                if (confirm(`هل أنت متأكد من حذف ${type}؟`)) {
                    // استخدام AJAX لحذف الصورة
                    fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // إعادة تحميل الصفحة لعرض التغييرات
                                location.reload();
                            } else {
                                alert('حدث خطأ أثناء حذف ' + type);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('حدث خطأ أثناء حذف ' + type);
                        });
                }
            }

            // التحقق من حجم الملف قبل الرفع
            document.addEventListener('DOMContentLoaded', function() {
                const imageInput = document.getElementById('image');
                const iconInput = document.getElementById('icon');

                if (imageInput) {
                    imageInput.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file && file.size > 5 * 1024 * 1024) { // 5MB
                            alert('حجم الصورة كبير جداً. الحد الأقصى المسموح به هو 5MB.');
                            this.value = '';
                            removeImagePreview('image-preview');
                        }
                    });
                }

                if (iconInput) {
                    iconInput.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file && file.size > 2 * 1024 * 1024) { // 2MB
                            alert('حجم الأيقونة كبير جداً. الحد الأقصى المسموح به هو 2MB.');
                            this.value = '';
                            removeImagePreview('icon-preview');
                        }
                    });
                }
            });

            // عرض أسماء الملفات المختارة
            document.querySelectorAll('.custom-file-input').forEach(function(input) {
                input.addEventListener('change', function(e) {
                    var fileName = e.target.files[0]?.name || 'اختر ملف';
                    var nextSibling = e.target.nextElementSibling;
                    nextSibling.innerText = fileName;
                });
            });
        </script>



    @endsection
