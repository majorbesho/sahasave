@extends('backend.layouts.master')

@section('title', 'Create New Blog')

@push('styles')
<link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
<style>
    .note-editor {
        min-height: 300px;
    }
    .seo-preview {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 15px;
        margin-top: 10px;
    }
    .seo-preview h3 {
        color: #1a0dab;
        font-size: 18px;
        margin: 0 0 5px 0;
        font-weight: normal;
    }
    .seo-preview .url {
        color: #006621;
        font-size: 14px;
        margin: 0 0 5px 0;
    }
    .seo-preview .description {
        color: #545454;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
    }
    .char-count {
        font-size: 12px;
        color: #6c757d;
    }
    .char-count.warning {
        color: #ffc107;
    }
    .char-count.danger {
        color: #dc3545;
    }
</style>
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create New Blog</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('adminblog.index') }}">Blogs</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('adminblog.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
                @csrf
                
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-8">
                        <!-- Basic Information Card -->
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Basic Information</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title" class="form-control" 
                                           value="{{ old('title') }}" 
                                           placeholder="Enter blog title"
                                           required
                                           onkeyup="updateSEOPreview()">
                                    <small class="form-text text-muted">
                                        Keep it between 50-60 characters for optimal SEO.
                                    </small>
                                    <div class="char-count" id="titleCharCount">0/60</div>
                                </div>

                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <div class="input-group">
                                        <input type="text" name="slug" id="slug" class="form-control" 
                                               value="{{ old('slug') }}" 
                                               placeholder="auto-generated-slug">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary" onclick="generateSlug()">
                                                <i class="fas fa-sync-alt"></i> Generate
                                            </button>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        URL-friendly version of the title. Leave empty for auto-generation.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="excerpt">Excerpt <span class="text-danger">*</span></label>
                                    <textarea name="excerpt" id="excerpt" class="form-control" 
                                              rows="3" 
                                              placeholder="Brief summary of the blog post"
                                              onkeyup="updateSEOPreview()"
                                              required>{{ old('excerpt') }}</textarea>
                                    <small class="form-text text-muted">
                                        A short summary (150-160 characters) that appears in listings.
                                    </small>
                                    <div class="char-count" id="excerptCharCount">0/160</div>
                                </div>

                                <div class="form-group">
                                    <label for="content">Content <span class="text-danger">*</span></label>
                                    <textarea name="content" id="content" class="form-control summernote" 
                                              rows="15">{{ old('content') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="featured_image">Featured Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="featured_image" 
                                               name="featured_image" accept="image/*">
                                        <label class="custom-file-label" for="featured_image">Choose image</label>
                                    </div>
                                    <small class="form-text text-muted">
                                        Recommended size: 1200x630px (for social media sharing). Max: 5MB.
                                    </small>
                                    <div id="imagePreview" class="mt-2" style="display: none;">
                                        <img id="previewImage" class="img-thumbnail" style="max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Section Card -->
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h3 class="card-title">FAQ Section (for FAQ Schema)</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="faqContainer">
                                    <!-- FAQ items will be added here -->
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle"></i> 
                                        Add FAQ questions and answers to generate FAQ schema for better SEO.
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-primary mt-2" onclick="addFAQ()">
                                    <i class="fas fa-plus"></i> Add FAQ
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-4">
                        <!-- SEO Card -->
                        <div class="card card-warning card-outline">
                            <div class="card-header">
                                <h3 class="card-title">SEO Settings</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" name="meta_title" id="meta_title" class="form-control" 
                                           value="{{ old('meta_title') }}" 
                                           placeholder="SEO title (optional)"
                                           onkeyup="updateSEOPreview()">
                                    <small class="form-text text-muted">
                                        Shown in search results. Leave empty to use blog title.
                                    </small>
                                    <div class="char-count" id="metaTitleCharCount">0/70</div>
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control" 
                                              rows="3" 
                                              placeholder="SEO description (optional)"
                                              onkeyup="updateSEOPreview()">{{ old('meta_description') }}</textarea>
                                    <small class="form-text text-muted">
                                        Shown in search results. Leave empty to use excerpt.
                                    </small>
                                    <div class="char-count" id="metaDescCharCount">0/160</div>
                                </div>

                                <div class="form-group">
                                    <label for="meta_keywords">Meta Keywords</label>
                                    <input type="text" name="meta_keywords" id="meta_keywords" class="form-control" 
                                           value="{{ old('meta_keywords') }}" 
                                           placeholder="keyword1, keyword2, keyword3">
                                    <small class="form-text text-muted">
                                        Comma-separated keywords for SEO.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="canonical_url">Canonical URL</label>
                                    <input type="text" name="canonical_url" id="canonical_url" class="form-control" 
                                           value="{{ old('canonical_url') }}" 
                                           placeholder="https://example.com/original-post">
                                    <small class="form-text text-muted">
                                        Use if this content is duplicated from another URL.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="schema_type">Schema Type</label>
                                    <select name="schema_type" id="schema_type" class="form-control select2">
                                        <option value="">Select Schema Type</option>
                                        @foreach($schemaTypes as $type)
                                            <option value="{{ $type }}" {{ old('schema_type') == $type ? 'selected' : '' }}>
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">
                                        Structured data type for rich snippets.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="target_keywords">Target Keywords</label>
                                    <input type="text" name="target_keywords" id="target_keywords" class="form-control" 
                                           value="{{ old('target_keywords') }}" 
                                           placeholder="primary keyword, secondary keyword">
                                    <small class="form-text text-muted">
                                        Main keywords to optimize for. Comma separated.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="ls_keyword">LSI Keywords</label>
                                    <input type="text" name="ls_keyword" id="ls_keyword" class="form-control" 
                                           value="{{ old('ls_keyword') }}" 
                                           placeholder="related terms, synonyms">
                                    <small class="form-text text-muted">
                                        Latent Semantic Indexing keywords for better contextual relevance.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="update_frequency">Update Frequency</label>
                                    <select name="update_frequency" id="update_frequency" class="form-control select2">
                                        <option value="never" {{ old('update_frequency') == 'never' ? 'selected' : '' }}>Never</option>
                                        <option value="daily" {{ old('update_frequency') == 'daily' ? 'selected' : '' }}>Daily</option>
                                        <option value="weekly" {{ old('update_frequency') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                        <option value="monthly" {{ old('update_frequency') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                        <option value="quarterly" {{ old('update_frequency') == 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                                        <option value="yearly" {{ old('update_frequency') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                    </select>
                                </div>

                                <!-- SEO Preview -->
                                <div class="seo-preview" id="seoPreview">
                                    <h3 id="previewTitle">Your title will appear here</h3>
                                    <div class="url" id="previewUrl">{{ url('/blog') }}/<span id="previewSlug">your-slug</span></div>
                                    <p class="description" id="previewDescription">Your meta description will appear here.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Trust & Authorship Card -->
                        <div class="card card-dark card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Trust & Authorship (E-E-A-T)</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="author_credentials">Author Credentials</label>
                                    <input type="text" name="author_credentials" id="author_credentials" class="form-control" 
                                           value="{{ old('author_credentials') }}" 
                                           placeholder="e.g., MD, PhD, Senior Medical Consultant">
                                    <small class="form-text text-muted">
                                        Displays professional titles to build authority.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="author_bio">Author Brief Bio</label>
                                    <textarea name="author_bio" id="author_bio" class="form-control" 
                                              rows="3" placeholder="Short bio highlighting expertise...">{{ old('author_bio') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Sources & References Card -->
                        <div class="card card-secondary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Sources & References</h3>
                            </div>
                            <div class="card-body">
                                <div id="sourceContainer">
                                    <div class="alert alert-light border">
                                        <i class="fas fa-link"></i> Add authoritative sources to increase trustworthiness.
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="addSource()">
                                    <i class="fas fa-plus"></i> Add Source
                                </button>
                            </div>
                        </div>

                        <!-- Settings Card -->
                        <div class="card card-secondary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Settings</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category_id">Category <span class="text-danger">*</span></label>
                                    <select name="category_id" id="category_id" class="form-control select2" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <select name="tags[]" id="tags" class="form-control select2" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="content_type">Content Type</label>
                                    <select name="content_type" id="content_type" class="form-control select2">
                                        @foreach($contentTypes as $type)
                                            <option value="{{ $type }}" {{ old('content_type') == $type ? 'selected' : '' }}>
                                                {{ ucfirst($type) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control select2">
                                        <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="visibility">Visibility</label>
                                    <select name="visibility" id="visibility" class="form-control select2">
                                        <option value="public" {{ old('visibility', 'public') == 'public' ? 'selected' : '' }}>Public</option>
                                        <option value="private" {{ old('visibility') == 'private' ? 'selected' : '' }}>Private</option>
                                        <option value="members_only" {{ old('visibility') == 'members_only' ? 'selected' : '' }}>Members Only</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="scheduled_for">Schedule Publish</label>
                                    <input type="datetime-local" name="scheduled_for" id="scheduled_for" 
                                           class="form-control" 
                                           value="{{ old('scheduled_for') }}">
                                    <small class="form-text text-muted">
                                        Leave empty to publish immediately or save as draft.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="featured" name="featured" value="1"
                                               {{ old('featured') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="featured">Featured Post</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Translation Card -->
                        <div class="card card-success card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Translation Settings</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="source_locale">Source Language <span class="text-danger">*</span></label>
                                    <select name="source_locale" id="source_locale" class="form-control select2" required>
                                        @foreach($languages as $language)
                                            <option value="{{ $language->code }}" {{ old('source_locale', 'ar') == $language->code ? 'selected' : '' }}>
                                                {{ $language->name }} ({{ $language->native_name }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="is_translatable" name="is_translatable" value="1"
                                               {{ old('is_translatable') ? 'checked' : '' }}
                                               onchange="toggleTranslationOptions()">
                                        <label class="custom-control-label" for="is_translatable">Enable Translation</label>
                                    </div>
                                    <small class="form-text text-muted">
                                        Automatically translate this content to other languages.
                                    </small>
                                </div>

                                <div id="translationOptions" style="display: none;">
                                    <div class="form-group">
                                        <label for="target_locales">Translate To</label>
                                        <select name="target_locales[]" id="target_locales" class="form-control select2" multiple>
                                            @foreach($languages as $language)
                                                <option value="{{ $language->code }}">
                                                    {{ $language->name }} ({{ $language->native_name }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">
                                            Select languages to translate to.
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="translation_priority">Translation Priority</label>
                                        <select name="translation_priority" id="translation_priority" class="form-control select2">
                                            <option value="1">Low</option>
                                            <option value="2">Medium Low</option>
                                            <option value="3" selected>Medium</option>
                                            <option value="4">Medium High</option>
                                            <option value="5">High</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" 
                                                   id="translate_medical_terms" name="translate_medical_terms" value="1" checked>
                                            <label class="custom-control-label" for="translate_medical_terms">Translate Medical Terms</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" 
                                                   id="cultural_adaptation" name="cultural_adaptation" value="1" checked>
                                            <label class="custom-control-label" for="cultural_adaptation">Cultural Adaptation</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" 
                                                   id="seo_optimized" name="seo_optimized" value="1" checked>
                                            <label class="custom-control-label" for="seo_optimized">SEO Optimized Translation</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" name="action" value="save" class="btn btn-primary btn-block">
                                            <i class="fas fa-save"></i> Save as Draft
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" name="action" value="publish" class="btn btn-success btn-block">
                                            <i class="fas fa-paper-plane"></i> Publish
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('adminblog.index') }}" class="btn btn-default btn-block">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<!-- FAQ Template (hidden) -->
<template id="faqTemplate">
    <div class="faq-item card mb-2">
        <div class="card-body">
            <div class="row">
                <div class="col-11">
                    <div class="form-group">
                        <label>Question</label>
                        <input type="text" name="faqs[@{{index}}][question]" class="form-control" placeholder="Enter question" required>
                    </div>
                    <div class="form-group">
                        <label>Answer</label>
                        <textarea name="faqs[@{{index}}][answer]" class="form-control" rows="2" placeholder="Enter answer" required></textarea>
                    </div>
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-danger btn-sm mt-4" onclick="removeFAQ(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<!-- Source Template (hidden) -->
<template id="sourceTemplate">
    <div class="source-item card mb-2 bg-light">
        <div class="card-body py-2">
            <div class="row">
                <div class="col-11">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="small">Source Title</label>
                                <input type="text" name="sources_references[@{{index}}][title]" class="form-control form-control-sm" placeholder="e.g. WHO Report" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="small">Source URL</label>
                                <input type="url" name="sources_references[@{{index}}][url]" class="form-control form-control-sm" placeholder="https://..." required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1 text-right">
                    <button type="button" class="btn btn-danger btn-xs mt-4" onclick="removeSource(this)">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

@endsection

@push('scripts')
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap4'
    });

    // Initialize Summernote
    $('.summernote').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video', 'hr']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        callbacks: {
            onInit: function() {
                // Add custom buttons for medical content
                var noteBtn = '<button type="button" class="btn btn-light btn-sm" data-toggle="tooltip" title="Insert Medical Term" onclick="insertMedicalTerm()"><i class="fas fa-stethoscope"></i></button>';
                $('.note-toolbar').append(noteBtn);
            }
        }
    });

    // Initialize file input
    bsCustomFileInput.init();

    // Image preview
    $('#featured_image').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
                $('#imagePreview').show();
            }
            reader.readAsDataURL(file);
        }
    });

    // Auto-generate slug from title
    $('#title').on('blur', function() {
        if (!$('#slug').val()) {
            generateSlug();
        }
    });

    // Toggle translation options
    toggleTranslationOptions();

    // Update SEO preview on load
    updateSEOPreview();
});

// Function to generate slug
function generateSlug() {
    const title = $('#title').val();
    if (title) {
        let slug = title.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim();
        
        // Add random string for uniqueness
        const randomStr = Math.random().toString(36).substring(2, 8);
        slug = slug + '-' + randomStr;
        
        $('#slug').val(slug);
        $('#previewSlug').text(slug);
    }
}

// Function to toggle translation options
function toggleTranslationOptions() {
    if ($('#is_translatable').is(':checked')) {
        $('#translationOptions').show();
    } else {
        $('#translationOptions').hide();
    }
}

// Function to update SEO preview
function updateSEOPreview() {
    // Title
    let title = $('#meta_title').val() || $('#title').val();
    $('#previewTitle').text(title || 'Your title will appear here');
    
    // Update title character count
    const titleLength = title.length;
    $('#titleCharCount').text(titleLength + '/60');
    updateCharCountClass('titleCharCount', titleLength, 50, 60);
    
    // Meta title character count
    const metaTitleLength = $('#meta_title').val().length;
    $('#metaTitleCharCount').text(metaTitleLength + '/70');
    updateCharCountClass('metaTitleCharCount', metaTitleLength, 50, 70);
    
    // Description
    let description = $('#meta_description').val() || $('#excerpt').val();
    $('#previewDescription').text(description || 'Your meta description will appear here');
    
    // Update excerpt character count
    const excerptLength = $('#excerpt').val().length;
    $('#excerptCharCount').text(excerptLength + '/160');
    updateCharCountClass('excerptCharCount', excerptLength, 150, 160);
    
    // Meta description character count
    const metaDescLength = $('#meta_description').val().length;
    $('#metaDescCharCount').text(metaDescLength + '/160');
    updateCharCountClass('metaDescCharCount', metaDescLength, 120, 160);
    
    // Update slug in URL preview
    const slug = $('#slug').val() || 'your-slug';
    $('#previewSlug').text(slug);
}

// Function to update character count class
function updateCharCountClass(elementId, length, min, max) {
    const element = $('#' + elementId);
    element.removeClass('warning danger');
    
    if (length < min) {
        element.addClass('warning');
    } else if (length > max) {
        element.addClass('danger');
    }
}

// Function to add FAQ item
let faqIndex = 0;
function addFAQ() {
    const template = $('#faqTemplate').html();
    const html = template.replace(/@{{index}}/g, faqIndex);
    
    if ($('#faqContainer .alert').length) {
        $('#faqContainer').html('');
    }
    
    $('#faqContainer').append(html);
    faqIndex++;
}

// Function to remove FAQ item
function removeFAQ(button) {
    $(button).closest('.faq-item').remove();
    
    // Show info message if no FAQs left
    if ($('#faqContainer .faq-item').length === 0) {
        $('#faqContainer').html('<div class="alert alert-info"><i class="fas fa-info-circle"></i> Add FAQ questions and answers to generate FAQ schema for better SEO.</div>');
        faqIndex = 0;
    }
}

// Function to insert medical term template
function insertMedicalTerm() {
    const term = prompt('Enter medical term:', '');
    if (term) {
        const explanation = prompt('Enter explanation (optional):', '');
        const html = `<span class="medical-term" data-toggle="tooltip" title="${explanation || term}">${term}</span>`;
        
        // Insert into summernote
        $('.summernote').summernote('insertText', term);
        
        // You would need a more sophisticated way to track medical terms
        // This is just a basic example
    }
}

// Form validation
$('#blogForm').submit(function(e) {
    let hasError = false;
    
    // Check title length
    const title = $('#title').val();
    if (title.length < 10) {
        alert('Title should be at least 10 characters long.');
        hasError = true;
    }
    
    // Check excerpt length
    const excerpt = $('#excerpt').val();
    if (excerpt.length < 50) {
        alert('Excerpt should be at least 50 characters long.');
        hasError = true;
    }
    
    // Check content
    const content = $('#content').val();
    if (content.length < 200) {
        alert('Content should be at least 200 characters long.');
        hasError = true;
    }
    
    if (hasError) {
        e.preventDefault();
        return false;
    }
    
    // Show loading indicator
    $('button[type="submit"]').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');
});
</script>
@endpush