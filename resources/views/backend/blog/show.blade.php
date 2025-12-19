@extends('backend.layouts.master')

@section('title', 'Blog Details: ' . $blog->title)
<style>
    .blog-detail-image {
        max-height: 400px;
        object-fit: cover;
        width: 100%;
        border-radius: 8px;
    }
    .seo-badge {
        font-size: 0.8rem;
        padding: 3px 8px;
        margin-right: 5px;
    }
    .translation-status {
        font-size: 0.75rem;
        padding: 2px 8px;
        border-radius: 12px;
    }
    .status-published { background-color: #d4edda; color: #155724; }
    .status-review { background-color: #d1ecf1; color: #0c5460; }
    .status-pending { background-color: #fff3cd; color: #856404; }
    .seo-score-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 24px;
        margin: 0 auto;
    }
    .score-excellent { background-color: #28a745; color: white; }
    .score-good { background-color: #20c997; color: white; }
    .score-average { background-color: #ffc107; color: #212529; }
    .score-poor { background-color: #dc3545; color: white; }
    .schema-preview {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 15px;
        font-family: monospace;
        font-size: 12px;
        max-height: 300px;
        overflow-y: auto;
    }
</style>


@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blog Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('adminblog.index') }}">Blogs</a></li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-8">
                    <!-- Blog Content Card -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Blog Content</h3>
                            <div class="card-tools">
                                <a href="{{ route('adminblog.edit', $blog->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Featured Image -->
                            @if($blog->featured_image)
                            <div class="text-center mb-4">
                                <img src="{{ Storage::url($blog->featured_image) }}" 
                                     alt="{{ $blog->title }}" 
                                     class="blog-detail-image img-fluid">
                            </div>
                            @endif

                            <!-- Title & Meta -->
                            <h2>{{ $blog->title }}</h2>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-user-circle text-muted mr-2"></i>
                                        <strong>Author:</strong>
                                        <span class="ml-2">{{ $blog->author->name }}</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-folder text-muted mr-2"></i>
                                        <strong>Category:</strong>
                                        <span class="ml-2 badge" style="background-color: {{ $blog->category->color }}; color: white;">
                                            {{ $blog->category->name }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-calendar text-muted mr-2"></i>
                                        <strong>Published:</strong>
                                        <span class="ml-2">
                                            {{ $blog->published_at ? $blog->published_at->format('M d, Y H:i') : 'Not published' }}
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-clock text-muted mr-2"></i>
                                        <strong>Last Updated:</strong>
                                        <span class="ml-2">
                                            {{ $blog->last_updated ? $blog->last_updated->format('M d, Y H:i') : 'Never' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Badges -->
                            <div class="mb-3">
                                <span class="badge badge-{{ $blog->status == 'published' ? 'success' : ($blog->status == 'draft' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($blog->status) }}
                                </span>
                                @if($blog->featured)
                                <span class="badge badge-warning">Featured</span>
                                @endif
                                <span class="badge badge-info">{{ $blog->visibility }}</span>
                                <span class="badge badge-secondary">{{ $blog->content_type }}</span>
                            </div>

                            <!-- Excerpt -->
                            <div class="card card-light mb-4">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Excerpt</h4>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">{{ $blog->excerpt }}</p>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="card card-light mb-4">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Content</h4>
                                </div>
                                <div class="card-body">
                                    {!! $blog->content !!}
                                </div>
                            </div>

                            <!-- Tags -->
                            @if($blog->relatedTags->count() > 0)
                            <div class="card card-light mb-4">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Tags</h4>
                                </div>
                                <div class="card-body">
                                    @foreach($blog->relatedTags as $tag)
                                    <span class="badge badge-secondary mr-1 mb-1">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- FAQ Section -->
                            @if($blog->faq_json)
                            <div class="card card-info mb-4">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">
                                        <i class="fas fa-question-circle"></i> FAQ Section
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="accordion" id="faqAccordion">
                                        @foreach($blog->faq_json as $index => $faq)
                                        <div class="card">
                                            <div class="card-header" id="faqHeading{{ $index }}">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-toggle="collapse" 
                                                            data-target="#faqCollapse{{ $index }}" 
                                                            aria-expanded="false" 
                                                            aria-controls="faqCollapse{{ $index }}">
                                                        {{ $faq['question'] }}
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="faqCollapse{{ $index }}" class="collapse" 
                                                 aria-labelledby="faqHeading{{ $index }}" 
                                                 data-parent="#faqAccordion">
                                                <div class="card-body">
                                                    {{ $faq['answer'] }}
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

                    <!-- Translations Card -->
                    @if($blog->translations->count() > 0)
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-language"></i> Translations
                                <span class="badge badge-light ml-2">{{ $blog->translations->count() }}</span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Language</th>
                                            <th>Status</th>
                                            <th>Translator</th>
                                            <th>Reviewer</th>
                                            <th>Last Updated</th>
                                            <th>Confidence</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($blog->translations as $translation)
                                        <tr>
                                            <td>
                                                <strong>{{ strtoupper($translation->locale) }}</strong>
                                            </td>
                                            <td>
                                                <span class="translation-status status-{{ $translation->translation_status }}">
                                                    {{ ucfirst($translation->translation_status) }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ $translation->translator->name ?? 'Auto' }}
                                            </td>
                                            <td>
                                                {{ $translation->reviewer->name ?? 'Not reviewed' }}
                                            </td>
                                            <td>
                                                {{ $translation->updated_at->diffForHumans() }}
                                            </td>
                                            <td>
                                                @if($translation->translation_confidence)
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar {{ $translation->translation_confidence > 0.8 ? 'bg-success' : ($translation->translation_confidence > 0.6 ? 'bg-warning' : 'bg-danger') }}" 
                                                         role="progressbar" 
                                                         style="width: {{ $translation->translation_confidence * 100 }}%"
                                                         aria-valuenow="{{ $translation->translation_confidence * 100 }}" 
                                                         aria-valuemin="0" 
                                                         aria-valuemax="100">
                                                        {{ number_format($translation->translation_confidence * 100, 1) }}%
                                                    </div>
                                                </div>
                                                @else
                                                <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-info" title="Preview">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Translation Jobs -->
                    @if($translationJobs->count() > 0)
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-tasks"></i> Translation Jobs
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Target Languages</th>
                                            <th>Status</th>
                                            <th>Priority</th>
                                            <th>Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($translationJobs as $job)
                                        <tr>
                                            <td>#{{ $job->id }}</td>
                                            <td>
                                                @foreach($job->target_locales as $locale)
                                                <span class="badge badge-primary mr-1">{{ strtoupper($locale) }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $job->status == 'completed' ? 'success' : ($job->status == 'processing' ? 'warning' : 'secondary') }}">
                                                    {{ ucfirst($job->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $job->priority == 'high' ? 'danger' : ($job->priority == 'medium' ? 'warning' : 'secondary') }}">
                                                    {{ ucfirst($job->priority) }}
                                                </span>
                                            </td>
                                            <td>{{ $job->created_at->diffForHumans() }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-info">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right Column -->
                <div class="col-md-4">
                    <!-- SEO Card -->
                    <div class="card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title">SEO Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                @php
                                    $scoreClass = $seoScore >= 80 ? 'score-excellent' : 
                                                ($seoScore >= 60 ? 'score-good' : 
                                                ($seoScore >= 40 ? 'score-average' : 'score-poor'));
                                @endphp
                                <div class="seo-score-circle {{ $scoreClass }}">
                                    {{ $seoScore }}
                                </div>
                                <div class="mt-2">SEO Score</div>
                            </div>

                            <div class="mb-3">
                                <h5>Meta Information</h5>
                                <div class="mb-2">
                                    <strong>Meta Title:</strong>
                                    <div class="text-muted small">{{ $blog->meta_title ?: 'Not set' }}</div>
                                    <span class="seo-badge badge-{{ strlen($blog->meta_title ?: $blog->title) >= 50 && strlen($blog->meta_title ?: $blog->title) <= 60 ? 'success' : 'warning' }}">
                                        {{ strlen($blog->meta_title ?: $blog->title) }}/60
                                    </span>
                                </div>
                                <div class="mb-2">
                                    <strong>Meta Description:</strong>
                                    <div class="text-muted small">{{ $blog->meta_description ?: 'Not set' }}</div>
                                    <span class="seo-badge badge-{{ strlen($blog->meta_description ?: $blog->excerpt) >= 120 && strlen($blog->meta_description ?: $blog->excerpt) <= 160 ? 'success' : 'warning' }}">
                                        {{ strlen($blog->meta_description ?: $blog->excerpt) }}/160
                                    </span>
                                </div>
                                @if($blog->meta_keywords)
                                <div class="mb-2">
                                    <strong>Meta Keywords:</strong>
                                    <div class="text-muted small">{{ $blog->meta_keywords }}</div>
                                </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <h5>SEO Elements</h5>
                                <div class="mb-1">
                                    <i class="fas fa-{{ $blog->featured_image ? 'check text-success' : 'times text-danger' }}"></i>
                                    Featured Image
                                </div>
                                <div class="mb-1">
                                    <i class="fas fa-{{ $blog->word_count >= 1000 ? 'check text-success' : 'times text-danger' }}"></i>
                                    Content Length: {{ $blog->word_count ?? str_word_count(strip_tags($blog->content)) }} words
                                </div>
                                <div class="mb-1">
                                    <i class="fas fa-{{ $blog->faq_json ? 'check text-success' : 'times text-danger' }}"></i>
                                    FAQ Schema
                                </div>
                                <div class="mb-1">
                                    <i class="fas fa-{{ $blog->schema_type ? 'check text-success' : 'times text-danger' }}"></i>
                                    Schema Type: {{ $blog->schema_type ?: 'Not set' }}
                                </div>
                            </div>

                            <a href="{{ route('adminblog.seo-analysis', $blog->id) }}" class="btn btn-warning btn-block">
                                <i class="fas fa-chart-line"></i> Full SEO Analysis
                            </a>
                        </div>
                    </div>

                    <!-- Stats Card -->
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Statistics</h3>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6 mb-3">
                                    <div class="stat-box">
                                        <div class="stat-number text-primary">{{ number_format($blog->views) }}</div>
                                        <div class="stat-label">Views</div>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="stat-box">
                                        <div class="stat-number text-success">{{ number_format($blog->likes) }}</div>
                                        <div class="stat-label">Likes</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stat-box">
                                        <div class="stat-number text-info">{{ number_format($blog->shares) }}</div>
                                        <div class="stat-label">Shares</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stat-box">
                                        <div class="stat-number text-warning">{{ $blog->comments_count ?? 0 }}</div>
                                        <div class="stat-label">Comments</div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="small">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Reading Time:</span>
                                    <span>{{ $blog->reading_time }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Word Count:</span>
                                    <span>{{ $blog->word_count ?? str_word_count(strip_tags($blog->content)) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Characters:</span>
                                    <span>{{ strlen(strip_tags($blog->content)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Schema Preview Card -->
                    <div class="card card-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Schema Preview</h3>
                        </div>
                        <div class="card-body">
                            <div class="schema-preview">
                                {{ json_encode($seoData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions Card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="btn-group-vertical w-100">
                                <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="btn btn-info mb-2">
                                    <i class="fas fa-eye"></i> View on Website
                                </a>
                                <a href="{{ route('adminblog.edit', $blog->id) }}" class="btn btn-primary mb-2">
                                    <i class="fas fa-edit"></i> Edit Blog
                                </a>
                                <a href="{{ route('adminblog.seo-analysis', $blog->id) }}" class="btn btn-warning mb-2">
                                    <i class="fas fa-chart-line"></i> SEO Analysis
                                </a>
                                <a href="{{ route('adminblog.clone', $blog->id) }}" class="btn btn-success mb-2">
                                    <i class="fas fa-copy"></i> Clone Blog
                                </a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                    <i class="fas fa-trash"></i> Delete Blog
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete "<strong>{{ $blog->title }}</strong>"?</p>
                <p class="text-danger">
                    <i class="fas fa-exclamation-triangle"></i> 
                    This action cannot be undone. All translations and related data will also be deleted.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="{{ route('adminblog.destroy', $blog->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Copy schema to clipboard
    $('#copySchema').click(function() {
        const schemaText = JSON.stringify(@json($seoData), null, 2);
        navigator.clipboard.writeText(schemaText).then(function() {
            alert('Schema copied to clipboard!');
        });
    });
});
</script>

@endsection


