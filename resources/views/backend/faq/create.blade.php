@extends('backend.layouts.master')

@section('content')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>إضافة سؤال جديد</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('faq.index') }}">الأسئلة الشائعة</a></li>
                            <li class="breadcrumb-item active">إضافة جديد</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">معلومات السؤال</h3>
                            </div>
                            
                            <form method="POST" action="{{ route('faq.store') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="card-body">
                                    <!-- Tabs for Languages -->
                                    <ul class="nav nav-tabs" id="langTabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="ar-tab" data-toggle="tab" href="#ar" role="tab">
                                                <i class="fas fa-language"></i> العربية
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="en-tab" data-toggle="tab" href="#en" role="tab">
                                                <i class="fas fa-language"></i> الإنجليزية
                                            </a>
                                        </li>
                                    </ul>
                                    
                                    <div class="tab-content mt-3" id="langTabsContent">
                                        <!-- Arabic Tab -->
                                        <div class="tab-pane fade show active" id="ar" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="question_ar">السؤال *</label>
                                                        <input type="text" class="form-control" 
                                                               id="question_ar" name="question_ar" 
                                                               value="{{ old('question_ar') }}" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="answer_ar">الإجابة *</label>
                                                        <textarea class="form-control summernote" 
                                                                  id="answer_ar" name="answer_ar" 
                                                                  rows="5" required>{{ old('answer_ar') }}</textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="title_ar">العنوان (اختياري)</label>
                                                        <input type="text" class="form-control" 
                                                               id="title_ar" name="title_ar" 
                                                               value="{{ old('title_ar') }}">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="description_ar">الوصف المختصر</label>
                                                        <textarea class="form-control" 
                                                                  id="description_ar" name="description_ar" 
                                                                  rows="2">{{ old('description_ar') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- English Tab -->
                                        <div class="tab-pane fade" id="en" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="question_en">Question *</label>
                                                        <input type="text" class="form-control" 
                                                               id="question_en" name="question_en" 
                                                               value="{{ old('question_en') }}" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="answer_en">Answer *</label>
                                                        <textarea class="form-control summernote" 
                                                                  id="answer_en" name="answer_en" 
                                                                  rows="5" required>{{ old('answer_en') }}</textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="title_en">Title (Optional)</label>
                                                        <input type="text" class="form-control" 
                                                               id="title_en" name="title_en" 
                                                               value="{{ old('title_en') }}">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="description_en">Short Description</label>
                                                        <textarea class="form-control" 
                                                                  id="description_en" name="description_en" 
                                                                  rows="2">{{ old('description_en') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- General Settings -->
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="category_id">التصنيف</label>
                                                <select class="form-control" id="category_id" name="category_id">
                                                    <option value="">بدون تصنيف</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->getTranslation('name', 'ar') ?: $category->getTranslation('name', 'en') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">الحالة *</label>
                                                <select class="form-control" id="status" name="status" required>
                                                    <option value="draft">مسودة</option>
                                                    <option value="active">نشط</option>
                                                    <option value="inactive">غير نشط</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sort_order">ترتيب العرض</label>
                                                <input type="number" class="form-control" 
                                                       id="sort_order" name="sort_order" 
                                                       value="{{ old('sort_order', 0) }}" min="0">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Images -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="photo">صورة السؤال</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" 
                                                           id="photo" name="photo">
                                                    <label class="custom-file-label" for="photo">اختر صورة</label>
                                                </div>
                                                <small class="form-text text-muted">الحجم الأمثل: 800x600px</small>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="og_image">صورة OG (للمشاركة)</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" 
                                                           id="og_image" name="og_image">
                                                    <label class="custom-file-label" for="og_image">اختر صورة</label>
                                                </div>
                                                <small class="form-text text-muted">الحجم الأمثل: 1200x630px</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Tags -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tags">الكلمات المفتاحية</label>
                                                <select class="form-control select2" id="tags" name="tags[]" multiple>
                                                    @foreach($tags as $tag)
                                                        <option value="{{ $tag->id }}">
                                                            {{ $tag->getTranslation('name', 'ar') ?: $tag->getTranslation('name', 'en') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Related FAQs -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="related_faqs">أسئلة ذات صلة</label>
                                                <select class="form-control select2" id="related_faqs" name="related_faqs[]" multiple>
                                                    @foreach($faqs as $related)
                                                        <option value="{{ $related->id }}">
                                                            {{ $related->getTranslation('question', 'ar') ?: $related->getTranslation('question', 'en') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- SEO Section -->
                                    <div class="card card-secondary mt-3">
                                        <div class="card-header">
                                            <h3 class="card-title">إعدادات SEO</h3>
                                        </div>
                                        <div class="card-body">
                                            <ul class="nav nav-tabs" id="seoTabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#seoAr">SEO العربية</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#seoEn">SEO الإنجليزية</a>
                                                </li>
                                            </ul>
                                            
                                            <div class="tab-content mt-3">
                                                <div class="tab-pane fade show active" id="seoAr">
                                                    <div class="form-group">
                                                        <label for="meta_title_ar">Meta Title</label>
                                                        <input type="text" class="form-control" 
                                                               id="meta_title_ar" name="meta_title_ar" 
                                                               value="{{ old('meta_title_ar') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="meta_description_ar">Meta Description</label>
                                                        <textarea class="form-control" 
                                                                  id="meta_description_ar" name="meta_description_ar" 
                                                                  rows="3">{{ old('meta_description_ar') }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="meta_keywords_ar">Meta Keywords</label>
                                                        <input type="text" class="form-control" 
                                                               id="meta_keywords_ar" name="meta_keywords_ar" 
                                                               value="{{ old('meta_keywords_ar') }}">
                                                    </div>
                                                </div>
                                                
                                                <div class="tab-pane fade" id="seoEn">
                                                    <div class="form-group">
                                                        <label for="meta_title_en">Meta Title</label>
                                                        <input type="text" class="form-control" 
                                                               id="meta_title_en" name="meta_title_en" 
                                                               value="{{ old('meta_title_en') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="meta_description_en">Meta Description</label>
                                                        <textarea class="form-control" 
                                                                  id="meta_description_en" name="meta_description_en" 
                                                                  rows="3">{{ old('meta_description_en') }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="meta_keywords_en">Meta Keywords</label>
                                                        <input type="text" class="form-control" 
                                                               id="meta_keywords_en" name="meta_keywords_en" 
                                                               value="{{ old('meta_keywords_en') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> حفظ
                                    </button>
                                    <a href="{{ route('faq.index') }}" class="btn btn-default">
                                        <i class="fas fa-times"></i> إلغاء
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- Summernote -->
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Initialize Summernote
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        
        // Initialize Select2
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: 'اختر...'
        });
        
        // Initialize file input
        bsCustomFileInput.init();
        
        // Auto-generate meta title and description
        $('#question_ar').on('blur', function() {
            if (!$('#meta_title_ar').val()) {
                $('#meta_title_ar').val($(this).val());
            }
            if (!$('#meta_description_ar').val()) {
                var answer = $('#answer_ar').val().replace(/<[^>]*>/g, '').substring(0, 150);
                $('#meta_description_ar').val(answer);
            }
        });
        
        $('#question_en').on('blur', function() {
            if (!$('#meta_title_en').val()) {
                $('#meta_title_en').val($(this).val());
            }
            if (!$('#meta_description_en').val()) {
                var answer = $('#answer_en').val().replace(/<[^>]*>/g, '').substring(0, 150);
                $('#meta_description_en').val(answer);
            }
        });
    });
</script>
<!-- Summernote -->
<link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

<style>
    .nav-tabs .nav-link {
        color: #495057;
    }
    .nav-tabs .nav-link.active {
        font-weight: bold;
    }
</style>
@endsection


