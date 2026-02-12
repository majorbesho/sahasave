@extends('backend.layouts.master')

@section('content')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>تعديل السؤال</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('faq.index') }}">الأسئلة الشائعة</a></li>
                            <li class="breadcrumb-item active">تعديل</li>
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
                            
                            <form method="POST" action="{{ route('faq.update', $faq->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
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
                                                               value="{{ old('question_ar', $transAr->question ?? '') }}" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="answer_ar">الإجابة *</label>
                                                        <textarea class="form-control summernote" 
                                                                  id="answer_ar" name="answer_ar" 
                                                                  rows="5" required>{{ old('answer_ar', $transAr->answer ?? '') }}</textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="title_ar">العنوان (اختياري)</label>
                                                        <input type="text" class="form-control" 
                                                               id="title_ar" name="title_ar" 
                                                               value="{{ old('title_ar', $transAr->title ?? '') }}">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="description_ar">الوصف المختصر</label>
                                                        <textarea class="form-control" 
                                                                  id="description_ar" name="description_ar" 
                                                                  rows="2">{{ old('description_ar', $transAr->description ?? '') }}</textarea>
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
                                                               value="{{ old('question_en', $transEn->question ?? '') }}" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="answer_en">Answer *</label>
                                                        <textarea class="form-control summernote" 
                                                                  id="answer_en" name="answer_en" 
                                                                  rows="5" required>{{ old('answer_en', $transEn->answer ?? '') }}</textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="title_en">Title (Optional)</label>
                                                        <input type="text" class="form-control" 
                                                               id="title_en" name="title_en" 
                                                               value="{{ old('title_en', $transEn->title ?? '') }}">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="description_en">Short Description</label>
                                                        <textarea class="form-control" 
                                                                  id="description_en" name="description_en" 
                                                                  rows="2">{{ old('description_en', $transEn->description ?? '') }}</textarea>
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
                                                        <option value="{{ $category->id }}" {{ old('category_id', $faq->category_id) == $category->id ? 'selected' : '' }}>
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
                                                    <option value="draft" {{ old('status', $faq->status) == 'draft' ? 'selected' : '' }}>مسودة</option>
                                                    <option value="active" {{ old('status', $faq->status) == 'active' ? 'selected' : '' }}>نشط</option>
                                                    <option value="inactive" {{ old('status', $faq->status) == 'inactive' ? 'selected' : '' }}>غير نشط</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sort_order">ترتيب العرض</label>
                                                <input type="number" class="form-control" 
                                                       id="sort_order" name="sort_order" 
                                                       value="{{ old('sort_order', $faq->sort_order) }}" min="0">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Images -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="photo">صورة السؤال</label>
                                                @if($faq->photo)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $faq->photo) }}" 
                                                             alt="Current Photo" 
                                                             style="max-width: 200px; max-height: 150px;" 
                                                             class="img-thumbnail">
                                                    </div>
                                                @endif
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" 
                                                           id="photo" name="photo">
                                                    <label class="custom-file-label" for="photo">اختر صورة جديدة</label>
                                                </div>
                                                <small class="form-text text-muted">الحجم الأمثل: 800x600px</small>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="og_image">صورة OG (للمشاركة)</label>
                                                @if($faq->og_image)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $faq->og_image) }}" 
                                                             alt="Current OG Image" 
                                                             style="max-width: 200px; max-height: 105px;" 
                                                             class="img-thumbnail">
                                                    </div>
                                                @endif
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" 
                                                           id="og_image" name="og_image">
                                                    <label class="custom-file-label" for="og_image">اختر صورة جديدة</label>
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
                                                        <option value="{{ $tag->id }}" 
                                                            {{ in_array($tag->id, old('tags', $faq->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
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
                                                    @foreach($allFaqs as $related)
                                                        <option value="{{ $related->id }}" 
                                                            {{ in_array($related->id, old('related_faqs', $faq->related_faqs ?? [])) ? 'selected' : '' }}>
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
                                                               value="{{ old('meta_title_ar', $transAr->meta_title ?? '') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="meta_description_ar">Meta Description</label>
                                                        <textarea class="form-control" 
                                                                  id="meta_description_ar" name="meta_description_ar" 
                                                                  rows="3">{{ old('meta_description_ar', $transAr->meta_description ?? '') }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="meta_keywords_ar">Meta Keywords</label>
                                                        <input type="text" class="form-control" 
                                                               id="meta_keywords_ar" name="meta_keywords_ar" 
                                                               value="{{ old('meta_keywords_ar', $transAr->meta_keywords ?? '') }}">
                                                    </div>
                                                </div>
                                                
                                                <div class="tab-pane fade" id="seoEn">
                                                    <div class="form-group">
                                                        <label for="meta_title_en">Meta Title</label>
                                                        <input type="text" class="form-control" 
                                                               id="meta_title_en" name="meta_title_en" 
                                                               value="{{ old('meta_title_en', $transEn->meta_title ?? '') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="meta_description_en">Meta Description</label>
                                                        <textarea class="form-control" 
                                                                  id="meta_description_en" name="meta_description_en" 
                                                                  rows="3">{{ old('meta_description_en', $transEn->meta_description ?? '') }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="meta_keywords_en">Meta Keywords</label>
                                                        <input type="text" class="form-control" 
                                                               id="meta_keywords_en" name="meta_keywords_en" 
                                                               value="{{ old('meta_keywords_en', $transEn->meta_keywords ?? '') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> تحديث
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
                var answer = $('#answer_ar').summernote('code').replace(/<[^>]*>/g, '').substring(0, 150);
                $('#meta_description_ar').val(answer);
            }
        });
        
        $('#question_en').on('blur', function() {
            if (!$('#meta_title_en').val()) {
                $('#meta_title_en').val($(this).val());
            }
            if (!$('#meta_description_en').val()) {
                var answer = $('#answer_en').summernote('code').replace(/<[^>]*>/g, '').substring(0, 150);
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
