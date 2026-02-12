{{-- resources/views/backend/blog/create-with-ai.blade.php --}}
@extends('backend.layouts.master')

@section('content')


<style>
.ai-control-panel {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    border: 1px solid #dee2e6;
}

.ai-results-container {
    min-height: 500px;
}

.title-option {
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #dee2e6;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s;
}

.title-option:hover {
    background: #e9ecef;
    border-color: #007bff;
}

.title-option.selected {
    background: #d4edda;
    border-color: #28a745;
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-robot"></i> إنشاء مقال بالذكاء الاصطناعي
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="ai-control-panel">
                                <h5>⚙️ إعدادات التوليد</h5>
                                
                                <div class="form-group">
                                    <label>موضوع المقال</label>
                                    <input type="text" id="aiTopic" class="form-control" 
                                           placeholder="مثال: مرض السكري، صحة القلب، التغذية الصحية">
                                </div>
                                
                                <div class="form-group">
                                    <label>التصنيف</label>
                                    <select id="aiCategory" class="form-control">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>نوع المحتوى</label>
                                    <select id="aiContentType" class="form-control">
                                        @foreach($contentTypes as $type)
                                            <option value="{{ $type }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>الكلمات المفتاحية</label>
                                    <input type="text" id="aiKeywords" class="form-control" 
                                           placeholder="مفصولة بفاصلة: سكري, علاج, وقاية">
                                </div>
                                
                                <div class="form-group">
                                    <label>عدد الكلمات</label>
                                    <select id="aiWordCount" class="form-control">
                                        <option value="800">800 كلمة (مختصر)</option>
                                        <option value="1500" selected>1500 كلمة (متوسط)</option>
                                        <option value="2500">2500 كلمة (مفصل)</option>
                                    </select>
                                </div>
                                
                                <div class="btn-group w-100">
                                    <button id="generateFullArticle" class="btn btn-primary">
                                        <i class="fas fa-magic"></i> توليد مقال كامل
                                    </button>
                                    <button id="suggestTitles" class="btn btn-info">
                                        <i class="fas fa-lightbulb"></i> اقتراح عناوين
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <div class="ai-results-container">
                                <!-- حالة التحميل -->
                                <div id="aiLoading" class="text-center p-5" style="display: none;">
                                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"></div>
                                    <h5 class="mt-3">جاري توليد المقال بالذكاء الاصطناعي...</h5>
                                    <p class="text-muted">قد يستغرق هذا بضع دقائق</p>
                                </div>
                                
                                <!-- نتائج التوليد -->
                                <div id="aiResults" style="display: none;">
                                    <div class="alert alert-success">
                                        <i class="fas fa-check-circle"></i>
                                        تم توليد المقال بنجاح!
                                    </div>
                                    
                                    <!-- العناوين المقترحة -->
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h6>📝 عناوين مقترحة</h6>
                                        </div>
                                        <div class="card-body" id="titleSuggestions"></div>
                                    </div>
                                    
                                    <!-- المعاينة -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h6>👁️ معاينة المقال</h6>
                                        </div>
                                        <div class="card-body">
                                            <form id="aiArticleForm" action="{{ route('admin.blog.store-ai') }}" method="POST">
                                                @csrf
                                                
                                                <div class="form-group">
                                                    <label>العنوان</label>
                                                    <input type="text" name="title" id="aiTitle" class="form-control">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>الملخص</label>
                                                    <textarea name="excerpt" id="aiExcerpt" class="form-control" rows="3"></textarea>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>المحتوى</label>
                                                    <textarea name="content" id="aiContent" class="form-control" rows="15"></textarea>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>عنوان SEO</label>
                                                            <input type="text" name="meta_title" id="aiMetaTitle" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>وصف SEO</label>
                                                            <textarea name="meta_description" id="aiMetaDescription" class="form-control" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <input type="hidden" name="category_id" id="aiFormCategory">
                                                <input type="hidden" name="target_keywords" id="aiTargetKeywords">
                                                <input type="hidden" name="faq_json" id="aiFaqJson">
                                                <input type="hidden" name="is_ai_generated" value="1">
                                                
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fas fa-save"></i> حفظ المقال
                                                    </button>
                                                    <button type="button" id="regenerateArticle" class="btn btn-warning">
                                                        <i class="fas fa-redo"></i> إعادة توليد
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    // توليد مقال كامل
    $('#generateFullArticle').click(function() {
        generateArticle('full');
    });
    
    // اقتراح عناوين فقط
    $('#suggestTitles').click(function() {
        generateArticle('titles_only');
    });
    
    // إعادة التوليد
    $('#regenerateArticle').click(function() {
        if (confirm('هل تريد إعادة توليد المقال؟')) {
            generateArticle('full');
        }
    });
    
    function generateArticle(type) {
        const data = {
            topic: $('#aiTopic').val(),
            category_id: $('#aiCategory').val(),
            content_type: $('#aiContentType').val(),
            keywords: $('#aiKeywords').val(),
            word_count: $('#aiWordCount').val(),
            _token: '{{ csrf_token() }}'
        };
        
        if (!data.topic) {
            alert('الرجاء إدخال موضوع المقال');
            return;
        }
        
        // إظهار حالة التحميل
        $('#aiLoading').show();
        $('#aiResults').hide();
        
        $.ajax({
            url: '{{ route("admin.blog.generate-ai") }}',
            method: 'POST',
            data: data,
            success: function(response) {
                $('#aiLoading').hide();
                
                if (response.success) {
                    if (type === 'full') {
                        // تعبئة النموذج
                        $('#aiTitle').val(response.data.title);
                        $('#aiExcerpt').val(response.data.excerpt);
                        $('#aiContent').val(response.data.content);
                        $('#aiMetaTitle').val(response.data.meta_title);
                        $('#aiMetaDescription').val(response.data.meta_description);
                        $('#aiFormCategory').val(data.category_id);
                        $('#aiTargetKeywords').val(JSON.stringify(response.data.target_keywords));
                        $('#aiFaqJson').val(JSON.stringify(response.data.faq_json));
                        
                        // عرض العناوين المقترحة
                        showTitleSuggestions(response.suggestions.titles);
                        
                        $('#aiResults').show();
                        $('html, body').animate({
                            scrollTop: $('#aiResults').offset().top - 100
                        }, 500);
                    } else {
                        // عرض العناوين فقط
                        showTitleSuggestions(response.suggestions.titles);
                        $('#aiResults').show();
                    }
                } else {
                    alert('حدث خطأ أثناء التوليد');
                }
            },
            error: function(xhr) {
                $('#aiLoading').hide();
                alert('حدث خطأ في الاتصال بالخادم');
            }
        });
    }
    
    function showTitleSuggestions(titles) {
        let html = '<div class="row">';
        
        titles.forEach((title, index) => {
            html += `
                <div class="col-md-6 mb-2">
                    <div class="title-option" onclick="selectTitle(${index}, '${title.replace(/'/g, "\\'")}')">
                        <input type="radio" name="selected_title" id="title_${index}">
                        <label for="title_${index}" style="cursor: pointer; margin: 0;">${title}</label>
                    </div>
                </div>
            `;
        });
        
        html += '</div>';
        $('#titleSuggestions').html(html);
    }
});

// اختيار عنوان
function selectTitle(index, title) {
    // إزالة التحديد السابق
    $('.title-option').removeClass('selected');
    
    // إضافة التحديد للعنوان المختار
    $(`#title_${index}`).closest('.title-option').addClass('selected');
    
    // تعبئة حقل العنوان
    $('#aiTitle').val(title);
    
    // توليد وصف SEO تلقائياً
    generateMetaDescription(title);
}

// توليد وصف SEO
function generateMetaDescription(title) {
    // يمكنك إضافة AJAX call هنا لتوليد وصف SEO بالذكاء الاصطناعي
    $('#aiMetaTitle').val(title + ' | SehaSave');
    $('#aiMetaDescription').val('مقال طبي شامل عن ' + title + ' مع نصائح طبية وعلاجية مقدمة من منصة SehaSave.');
}
</script>

@endsection

