@extends('backend.layouts.master')

@section('title', 'Edit Blog: ' . $blog->title)

<link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}">
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
    .translation-badge {
        font-size: 0.7rem;
        padding: 2px 6px;
        margin-left: 5px;
    }
</style>

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Blog: <small>{{ Str::limit($blog->title, 50) }}</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('adminblog.index') }}">Blogs</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-exclamation-triangle"></i> Please check the form for errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <form action="{{ route('adminblog.update', $blog->id) }}" method="POST" enctype="multipart/form-data" id="blogForm">
                @csrf
                @method('PUT')
                
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
                                           value="{{ old('title', $blog->title) }}" 
                                           placeholder="Enter blog title"
                                           required
                                           onkeyup="updateSEOPreview()">
                                    <small class="form-text text-muted">
                                        Keep it between 50-60 characters for optimal SEO.
                                    </small>
                                    <div class="char-count" id="titleCharCount">{{ strlen($blog->title) }}/60</div>
                                </div>

                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <div class="input-group">
                                        <input type="text" name="slug" id="slug" class="form-control" 
                                               value="{{ old('slug', $blog->slug) }}" 
                                               placeholder="auto-generated-slug">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary" onclick="generateSlug()">
                                                <i class="fas fa-sync-alt"></i> Generate
                                            </button>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        URL-friendly version of the title. Change with caution.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="excerpt">Excerpt <span class="text-danger">*</span></label>
                                    <textarea name="excerpt" id="excerpt" class="form-control" 
                                              rows="3" 
                                              placeholder="Brief summary of the blog post"
                                              onkeyup="updateSEOPreview()"
                                              required>{{ old('excerpt', $blog->excerpt) }}</textarea>
                                    <small class="form-text text-muted">
                                        A short summary (150-160 characters) that appears in listings.
                                    </small>
                                    <div class="char-count" id="excerptCharCount">{{ strlen($blog->excerpt) }}/160</div>
                                </div>

                                <div class="form-group">
                                    <label for="content">Content <span class="text-danger">*</span></label>
                                    <textarea name="content" id="content" class="form-control summernote" 
                                              rows="15">{{ old('content', $blog->content) }}</textarea>
                                    <div class="mt-2">
                                        <span class="badge badge-info">
                                            <i class="fas fa-file-word"></i> Words: {{ $blog->word_count ?? str_word_count(strip_tags($blog->content)) }}
                                        </span>
                                        <span class="badge badge-secondary ml-2">
                                            <i class="fas fa-clock"></i> Reading: {{ $blog->reading_time }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="featured_image">Featured Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="featured_image" 
                                               name="featured_image" accept="image/*">
                                        <label class="custom-file-label" for="featured_image">Choose new image</label>
                                    </div>
                                    <small class="form-text text-muted">
                                        Recommended size: 1200x630px. Max: 5MB. Leave empty to keep current.
                                    </small>
                                    
                                    @if($blog->featured_image)
                                    <div class="mt-3">
                                        <p>Current Image:</p>
                                        <img src="{{ asset('storage/' . $blog->featured_image) }}" 
                                             alt="{{ $blog->title }}" 
                                             class="img-thumbnail" 
                                             style="max-height: 200px;">
                                        <div class="mt-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" 
                                                       id="remove_image" name="remove_image" value="1">
                                                <label class="custom-control-label text-danger" for="remove_image">
                                                    Remove current image
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    <div id="newImagePreview" class="mt-2" style="display: none;">
                                        <p>New Image Preview:</p>
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
                                    @if(!empty($faqs))
                                        @foreach($faqs as $index => $faq)
                                        <div class="faq-item card mb-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-11">
                                                        <div class="form-group">
                                                            <label>Question</label>
                                                            <input type="text" name="faqs[{{ $index }}][question]" 
                                                                   class="form-control" 
                                                                   value="{{ $faq['question'] }}"
                                                                   placeholder="Enter question" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Answer</label>
                                                            <textarea name="faqs[{{ $index }}][answer]" 
                                                                      class="form-control" 
                                                                      rows="2"
                                                                      placeholder="Enter answer" required>{{ $faq['answer'] }}</textarea>
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
                                        @endforeach
                                    @else
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle"></i> 
                                            Add FAQ questions and answers to generate FAQ schema for better SEO.
                                        </div>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-sm btn-primary mt-2" onclick="addFAQ()">
                                    <i class="fas fa-plus"></i> Add FAQ
                                </button>
                            </div>
                        </div>

                        <!-- Translations Card -->
                        <div class="card card-success card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Translations</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                @if($blog->translations->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Language</th>
                                                <th>Status</th>
                                                <th>Translator</th>
                                                <th>Last Updated</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($blog->translations as $translation)
                                            <tr>
                                                <td>
                                                    <span class="badge badge-primary">
                                                        {{ strtoupper($translation->locale) }}
                                                    </span>
                                                    {{ $languages->where('code', $translation->locale)->first()->name ?? $translation->locale }}
                                                </td>
                                                <td>
                                                    @switch($translation->translation_status)
                                                        @case('published')
                                                            <span class="badge badge-success">Published</span>
                                                            @break
                                                        @case('reviewed')
                                                            <span class="badge badge-info">Reviewed</span>
                                                            @break
                                                        @case('completed')
                                                            <span class="badge badge-primary">Completed</span>
                                                            @break
                                                        @case('in_progress')
                                                            <span class="badge badge-warning">In Progress</span>
                                                            @break
                                                        @default
                                                            <span class="badge badge-secondary">{{ $translation->translation_status }}</span>
                                                    @endswitch
                                                    @if($translation->translation_confidence)
                                                    <small class="text-muted d-block">
                                                        Confidence: {{ number_format($translation->translation_confidence * 100, 1) }}%
                                                    </small>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $translation->translator->name ?? 'Auto-translated' }}
                                                </td>
                                                <td>
                                                    {{ $translation->updated_at->diffForHumans() }}
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-info" title="Preview">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    No translations available for this blog.
                                </div>
                                @endif
                                
                                <hr>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="create_translation_job" name="create_translation_job" value="1"
                                               onchange="toggleTranslationOptions()">
                                        <label class="custom-control-label" for="create_translation_job">
                                            Create New Translation Job
                                        </label>
                                    </div>
                                </div>
                                
                                <div id="translationOptions" style="display: none;">
                                    <div class="form-group">
                                        <label for="target_locales">Translate To</label>
                                        <select name="target_locales[]" id="target_locales" class="form-control select2" multiple>
                                            @foreach($languages as $language)
                                                @if($language->code !== $blog->source_locale && !$blog->translations->contains('locale', $language->code))
                                                <option value="{{ $language->code }}">
                                                    {{ $language->name }} ({{ $language->native_name }})
                                                </option>
                                                @endif
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
                                           value="{{ old('meta_title', $blog->meta_title) }}" 
                                           placeholder="SEO title (optional)"
                                           onkeyup="updateSEOPreview()">
                                    <small class="form-text text-muted">
                                        Shown in search results. Leave empty to use blog title.
                                    </small>
                                    <div class="char-count" id="metaTitleCharCount">{{ strlen($blog->meta_title ?? '') }}/70</div>
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" class="form-control" 
                                              rows="3" 
                                              placeholder="SEO description (optional)"
                                              onkeyup="updateSEOPreview()">{{ old('meta_description', $blog->meta_description) }}</textarea>
                                    <small class="form-text text-muted">
                                        Shown in search results. Leave empty to use excerpt.
                                    </small>
                                    <div class="char-count" id="metaDescCharCount">{{ strlen($blog->meta_description ?? '') }}/160</div>
                                </div>

                                <div class="form-group">
                                    <label for="meta_keywords">Meta Keywords</label>
                                    <input type="text" name="meta_keywords" id="meta_keywords" class="form-control" 
                                           value="{{ old('meta_keywords', $blog->meta_keywords) }}" 
                                           placeholder="keyword1, keyword2, keyword3">
                                    <small class="form-text text-muted">
                                        Comma-separated keywords for SEO.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="canonical_url">Canonical URL</label>
                                    <input type="text" name="canonical_url" id="canonical_url" class="form-control" 
                                           value="{{ old('canonical_url', $blog->canonical_url) }}" 
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
                                            <option value="{{ $type }}" {{ old('schema_type', $blog->schema_type) == $type ? 'selected' : '' }}>
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="target_keywords">Target Keywords</label>
                                    <input type="text" name="target_keywords" id="target_keywords" class="form-control" 
                                           value="{{ old('target_keywords', is_array($blog->target_keywords) ? implode(', ', $blog->target_keywords) : $blog->target_keywords) }}" 
                                           placeholder="primary keyword, secondary keyword">
                                </div>

                                <div class="form-group">
                                    <label for="ls_keyword">LSI Keyword</label>
                                    <input type="text" name="ls_keyword" id="ls_keyword" class="form-control" 
                                           value="{{ old('ls_keyword', $blog->ls_keyword) }}">
                                    <small class="form-text text-muted">
                                        Latent Semantic Indexing keyword for better SEO.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="update_frequency">Update Frequency</label>
                                    <select name="update_frequency" id="update_frequency" class="form-control select2">
                                        <option value="never" {{ old('update_frequency', $blog->update_frequency) == 'never' ? 'selected' : '' }}>Never</option>
                                        <option value="daily" {{ old('update_frequency', $blog->update_frequency) == 'daily' ? 'selected' : '' }}>Daily</option>
                                        <option value="weekly" {{ old('update_frequency', $blog->update_frequency) == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                        <option value="monthly" {{ old('update_frequency', $blog->update_frequency) == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                        <option value="quarterly" {{ old('update_frequency', $blog->update_frequency) == 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                                        <option value="yearly" {{ old('update_frequency', $blog->update_frequency) == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                    </select>
                                </div>

                                <!-- SEO Preview -->
                                <div class="seo-preview" id="seoPreview">
                                    <h3 id="previewTitle">{{ $blog->meta_title ?: $blog->title }}</h3>
                                    <div class="url">{{ url('/blog') }}/<span id="previewSlug">{{ $blog->slug }}</span></div>
                                    <p class="description" id="previewDescription">{{ $blog->meta_description ?: $blog->excerpt }}</p>
                                </div>
                            </div>
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
                                           value="{{ old('author_credentials', $blog->author_credentials) }}" 
                                           placeholder="e.g., MD, PhD, Senior Medical Consultant">
                                    <small class="form-text text-muted">
                                        Displays professional titles to build authority.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="author_bio">Author Brief Bio</label>
                                    <textarea name="author_bio" id="author_bio" class="form-control" 
                                              rows="3" placeholder="Short bio highlighting expertise...">{{ old('author_bio', $blog->author_bio) }}</textarea>
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
                                    @if(!empty($blog->sources_references))
                                        @foreach($blog->sources_references as $index => $source)
                                        <div class="source-item card mb-2 bg-light">
                                            <div class="card-body py-2">
                                                <div class="row">
                                                    <div class="col-11">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-0">
                                                                    <label class="small">Source Title</label>
                                                                    <input type="text" name="sources_references[{{ $index }}][title]" 
                                                                           class="form-control form-control-sm" 
                                                                           value="{{ $source['title'] }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group mb-0">
                                                                    <label class="small">Source URL</label>
                                                                    <input type="url" name="sources_references[{{ $index }}][url]" 
                                                                           class="form-control form-control-sm" 
                                                                           value="{{ $source['url'] }}" required>
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
                                        @endforeach
                                    @else
                                        <div class="alert alert-light border">
                                            <i class="fas fa-link"></i> Add authoritative sources to increase trustworthiness.
                                        </div>
                                    @endif
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
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <select name="tags[]" id="tags" class="form-control select2" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" {{ in_array($tag->id, $selectedTags) ? 'selected' : '' }}>
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="content_type">Content Type</label>
                                    <select name="content_type" id="content_type" class="form-control select2">
                                        @foreach($contentTypes as $type)
                                            <option value="{{ $type }}" {{ old('content_type', $blog->content_type) == $type ? 'selected' : '' }}>
                                                {{ ucfirst($type) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control select2">
                                        <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="archived" {{ old('status', $blog->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="visibility">Visibility</label>
                                    <select name="visibility" id="visibility" class="form-control select2">
                                        <option value="public" {{ old('visibility', $blog->visibility) == 'public' ? 'selected' : '' }}>Public</option>
                                        <option value="private" {{ old('visibility', $blog->visibility) == 'private' ? 'selected' : '' }}>Private</option>
                                        <option value="members_only" {{ old('visibility', $blog->visibility) == 'members_only' ? 'selected' : '' }}>Members Only</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="scheduled_for">Schedule Publish</label>
                                    <input type="datetime-local" name="scheduled_for" id="scheduled_for" 
                                           class="form-control" 
                                           value="{{ old('scheduled_for', $blog->scheduled_for ? $blog->scheduled_for->format('Y-m-d\TH:i') : '') }}">
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" 
                                               id="featured" name="featured" value="1"
                                               {{ old('featured', $blog->featured) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="featured">Featured Post</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Last Updated</label>
                                    <div class="form-control-plaintext">
                                        {{ $blog->last_updated ? $blog->last_updated->format('Y-m-d H:i') : 'Never' }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Published At</label>
                                    <div class="form-control-plaintext">
                                        {{ $blog->published_at ? $blog->published_at->format('Y-m-d H:i') : 'Not published' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stats Card -->
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Statistics</h3>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="small-box bg-light p-2">
                                            <div class="inner">
                                                <h3>{{ number_format($blog->views) }}</h3>
                                                <p>Views</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-eye"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="small-box bg-light p-2">
                                            <div class="inner">
                                                <h3>{{ number_format($blog->likes) }}</h3>
                                                <p>Likes</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-heart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="small-box bg-light p-2 mt-2">
                                            <div class="inner">
                                                <h3>{{ number_format($blog->shares) }}</h3>
                                                <p>Shares</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-share-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="small-box bg-light p-2 mt-2">
                                            <div class="inner">
                                                <h3>{{ $blog->comments_count ?? 0 }}</h3>
                                                <p>Comments</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-comments"></i>
                                            </div>
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
                                        <button type="submit" class="btn btn-primary btn-block">
                                            <i class="fas fa-save"></i> Update
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('adminblog.seo-analysis', $blog->id) }}" 
                                           class="btn btn-warning btn-block">
                                            <i class="fas fa-chart-line"></i> SEO Analysis
                                        </a>
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
        ]
    });

    // Initialize file input
    bsCustomFileInput.init();

    // Image preview for new image
    $('#featured_image').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
                $('#newImagePreview').show();
            }
            reader.readAsDataURL(file);
        }
    });

    // Toggle translation options
    toggleTranslationOptions();
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
    if ($('#create_translation_job').is(':checked')) {
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
    const slug = $('#slug').val();
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
let faqIndex = {{ count($faqs) }};
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
<script>
// Function to add Source item
let sourceIndex = {{ count($blog->sources_references ?? []) }};
function addSource() {
    const template = $('#sourceTemplate').html();
    const html = template.replace(/@{{index}}/g, sourceIndex);
    
    if ($('#sourceContainer .alert').length) {
        $('#sourceContainer').html('');
    }
    
    $('#sourceContainer').append(html);
    sourceIndex++;
}

// Function to remove Source item
function removeSource(button) {
    $(button).closest('.source-item').remove();
    
    if ($('#sourceContainer .source-item').length === 0) {
        $('#sourceContainer').html('<div class="alert alert-light border"><i class="fas fa-link"></i> Add authoritative sources to increase trustworthiness.</div>');
        sourceIndex = 0;
    }
}
</script>
@endpush

