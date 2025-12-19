@extends('backend.layouts.master')

@section('title', 'SEO Analysis: ' . $blog->title)
<style>
    .seo-score-circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 36px;
        margin: 0 auto;
        border: 8px solid;
    }
    .score-excellent { 
        background-color: #28a745; 
        color: white;
        border-color: #218838;
    }
    .score-good { 
        background-color: #20c997; 
        color: white;
        border-color: #17a2b8;
    }
    .score-average { 
        background-color: #ffc107; 
        color: #212529;
        border-color: #e0a800;
    }
    .score-poor { 
        background-color: #dc3545; 
        color: white;
        border-color: #c82333;
    }
    .seo-metric {
        border-left: 4px solid;
        padding-left: 15px;
        margin-bottom: 20px;
    }
    .metric-good { border-color: #28a745; }
    .metric-warning { border-color: #ffc107; }
    .metric-danger { border-color: #dc3545; }
    .progress-thin {
        height: 8px;
    }
    .keyword-density {
        font-family: monospace;
        background: #f8f9fa;
        padding: 10px;
        border-radius: 4px;
        font-size: 12px;
    }
    .heading-structure {
        list-style: none;
        padding-left: 0;
    }
    .heading-structure li {
        padding: 5px 0;
        border-bottom: 1px solid #dee2e6;
    }
    .heading-structure .h1 { font-size: 1.5rem; color: #343a40; }
    .heading-structure .h2 { font-size: 1.25rem; color: #495057; margin-left: 20px; }
    .heading-structure .h3 { font-size: 1rem; color: #6c757d; margin-left: 40px; }
</style>

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>SEO Analysis: <small>{{ Str::limit($blog->title, 50) }}</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('adminblog.index') }}">Blogs</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('adminblog.show', $blog->id) }}">{{ Str::limit($blog->title, 20) }}</a></li>
                        <li class="breadcrumb-item active">SEO Analysis</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Overall Score -->
            <div class="row mb-4">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body text-center">
                            @php
                                $scoreClass = $totalScore >= 80 ? 'score-excellent' : 
                                            ($totalScore >= 60 ? 'score-good' : 
                                            ($totalScore >= 40 ? 'score-average' : 'score-poor'));
                                $scoreLabel = $totalScore >= 80 ? 'Excellent' : 
                                            ($totalScore >= 60 ? 'Good' : 
                                            ($totalScore >= 40 ? 'Average' : 'Poor'));
                            @endphp
                            <div class="seo-score-circle {{ $scoreClass }}">
                                {{ round($totalScore) }}
                            </div>
                            <h3 class="mt-3">{{ $scoreLabel }} SEO Score</h3>
                            <p class="text-muted">Based on {{ count($analysis) }} metrics</p>
                            
                            <div class="progress progress-thin mt-3">
                                <div class="progress-bar bg-success" style="width: {{ $totalScore }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Analysis -->
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <!-- Title Analysis -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-heading text-primary"></i> Title Analysis
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="seo-metric {{ $analysis['title']['optimal'] ? 'metric-good' : 'metric-warning' }}">
                                <h5>Title Length: {{ $analysis['title']['length'] }} characters</h5>
                                <p>Optimal: 50-60 characters</p>
                                <div class="progress progress-thin">
                                    <div class="progress-bar bg-{{ $analysis['title']['optimal'] ? 'success' : 'warning' }}" 
                                         style="width: {{ min(100, ($analysis['title']['length'] / 60) * 100) }}%"></div>
                                </div>
                                <small class="text-muted">Score: {{ round($analysis['title']['score']) }}/100</small>
                            </div>
                            <div class="alert alert-info">
                                <strong>Current Title:</strong><br>
                                "{{ $blog->title }}"
                            </div>
                            @if(!$analysis['title']['optimal'])
                            <div class="alert alert-warning">
                                <strong>Recommendation:</strong><br>
                                @if($analysis['title']['length'] < 50)
                                    Title is too short. Consider adding more descriptive keywords.
                                @else
                                    Title is too long. Try to keep it under 60 characters.
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Meta Description -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-align-left text-info"></i> Meta Description
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="seo-metric {{ $analysis['meta_description']['optimal'] ? 'metric-good' : 'metric-warning' }}">
                                <h5>Description Length: {{ $analysis['meta_description']['length'] }} characters</h5>
                                <p>Optimal: 120-160 characters</p>
                                <div class="progress progress-thin">
                                    <div class="progress-bar bg-{{ $analysis['meta_description']['optimal'] ? 'success' : 'warning' }}" 
                                         style="width: {{ min(100, ($analysis['meta_description']['length'] / 160) * 100) }}%"></div>
                                </div>
                                <small class="text-muted">Score: {{ round($analysis['meta_description']['score']) }}/100</small>
                            </div>
                            <div class="alert alert-info">
                                <strong>Current Description:</strong><br>
                                "{{ $blog->meta_description ?? $blog->excerpt }}"
                            </div>
                            @if(!$analysis['meta_description']['optimal'] && $blog->meta_description)
                            <div class="alert alert-warning">
                                <strong>Recommendation:</strong><br>
                                @if($analysis['meta_description']['length'] < 120)
                                    Meta description is too short. Add more compelling details.
                                @else
                                    Meta description is too long. It may get truncated in search results.
                                @endif
                            </div>
                            @endif
                            @if(!$blog->meta_description)
                            <div class="alert alert-danger">
                                <strong>Warning:</strong> No custom meta description set. Using excerpt instead.
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Content Analysis -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-file-alt text-success"></i> Content Analysis
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="seo-metric {{ $analysis['content']['optimal'] ? 'metric-good' : 'metric-warning' }}">
                                <h5>Content Length: {{ number_format($analysis['content']['word_count']) }} words</h5>
                                <p>Optimal: 1000+ words</p>
                                <div class="progress progress-thin">
                                    <div class="progress-bar bg-{{ $analysis['content']['optimal'] ? 'success' : 'warning' }}" 
                                         style="width: {{ min(100, ($analysis['content']['word_count'] / 2000) * 100) }}%"></div>
                                </div>
                                <small class="text-muted">Score: {{ round($analysis['content']['score']) }}/100</small>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-6">
                                    <div class="small-box bg-light p-3 text-center">
                                        <div class="inner">
                                            <h3>{{ number_format(strlen(strip_tags($blog->content))) }}</h3>
                                            <p>Characters</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="small-box bg-light p-3 text-center">
                                        <div class="inner">
                                            <h3>{{ $blog->reading_time }}</h3>
                                            <p>Reading Time</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @if(!$analysis['content']['optimal'])
                            <div class="alert alert-warning mt-3">
                                <strong>Recommendation:</strong><br>
                                Content is relatively short. Consider adding more depth and value to improve SEO.
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <!-- Keyword Analysis -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-key text-warning"></i> Keyword Analysis
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="seo-metric {{ $analysis['keywords']['density'] >= 1 && $analysis['keywords']['density'] <= 3 ? 'metric-good' : 'metric-warning' }}">
                                <h5>Keyword Density: {{ number_format($analysis['keywords']['density'], 2) }}%</h5>
                                <p>Optimal: 1-3%</p>
                                <div class="progress progress-thin">
                                    <div class="progress-bar bg-{{ $analysis['keywords']['density'] >= 1 && $analysis['keywords']['density'] <= 3 ? 'success' : 'warning' }}" 
                                         style="width: {{ min(100, ($analysis['keywords']['density'] / 3) * 100) }}%"></div>
                                </div>
                                <small class="text-muted">Score: {{ round($analysis['keywords']['score']) }}/100</small>
                            </div>
                            
                            @if($blog->target_keywords)
                            <div class="mt-3">
                                <h6>Target Keywords:</h6>
                                <div class="keyword-density">
                                    @foreach(json_decode($blog->target_keywords, true) ?? [] as $keyword)
                                    <div class="mb-1">
                                        <strong>{{ $keyword }}</strong>: 
                                        {{ $this->calculateKeywordFrequency($blog->content, $keyword) }} occurrences
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @else
                            <div class="alert alert-danger">
                                <strong>Warning:</strong> No target keywords specified.
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Readability -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-book-reader text-info"></i> Readability
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="seo-metric {{ $analysis['readability']['optimal'] ? 'metric-good' : 'metric-warning' }}">
                                <h5>Flesch Score: {{ number_format($analysis['readability']['flesch_score'], 1) }}</h5>
                                <p>Optimal: 60+ (Standard reading level)</p>
                                <div class="progress progress-thin">
                                    <div class="progress-bar bg-{{ $analysis['readability']['optimal'] ? 'success' : 'warning' }}" 
                                         style="width: {{ min(100, $analysis['readability']['flesch_score']) }}%"></div>
                                </div>
                                <small class="text-muted">Score: {{ round($analysis['readability']['score']) }}/100</small>
                            </div>
                            
                            <div class="mt-3">
                                <h6>Reading Level:</h6>
                                @if($analysis['readability']['flesch_score'] >= 90)
                                <span class="badge badge-success">Very Easy</span>
                                @elseif($analysis['readability']['flesch_score'] >= 80)
                                <span class="badge badge-success">Easy</span>
                                @elseif($analysis['readability']['flesch_score'] >= 70)
                                <span class="badge badge-primary">Fairly Easy</span>
                                @elseif($analysis['readability']['flesch_score'] >= 60)
                                <span class="badge badge-primary">Standard</span>
                                @elseif($analysis['readability']['flesch_score'] >= 50)
                                <span class="badge badge-warning">Fairly Difficult</span>
                                @elseif($analysis['readability']['flesch_score'] >= 30)
                                <span class="badge badge-warning">Difficult</span>
                                @else
                                <span class="badge badge-danger">Very Difficult</span>
                                @endif
                                
                                @if(!$analysis['readability']['optimal'])
                                <div class="alert alert-warning mt-3">
                                    <strong>Recommendation:</strong><br>
                                    Content may be difficult to read. Consider simplifying sentence structure.
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Images & Links -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-link text-primary"></i> Images & Links
                            </h3>
                        </div>
                        <div class="card-body">
                            <!-- Images -->
                            <div class="seo-metric {{ $analysis['images']['has_featured'] ? 'metric-good' : 'metric-danger' }}">
                                <h5>Images</h5>
                                <p>
                                    <i class="fas fa-{{ $analysis['images']['has_featured'] ? 'check text-success' : 'times text-danger' }}"></i>
                                    Featured Image: {{ $analysis['images']['has_featured'] ? 'Yes' : 'No' }}
                                </p>
                                <small class="text-muted">Score: {{ round($analysis['images']['score']) }}/100</small>
                            </div>
                            
                            <!-- Links -->
                            <div class="seo-metric mt-4 {{ $analysis['links']['internal'] > 0 || $analysis['links']['external'] > 0 ? 'metric-good' : 'metric-warning' }}">
                                <h5>Links</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <p><i class="fas fa-link"></i> Internal: {{ $analysis['links']['internal'] }}</p>
                                    </div>
                                    <div class="col-6">
                                        <p><i class="fas fa-external-link-alt"></i> External: {{ $analysis['links']['external'] }}</p>
                                    </div>
                                </div>
                                <small class="text-muted">Score: {{ round($analysis['links']['score']) }}/100</small>
                            </div>
                            
                            @if(!$analysis['images']['has_featured'])
                            <div class="alert alert-danger mt-3">
                                <strong>Critical:</strong> No featured image set. This affects social sharing and SEO.
                            </div>
                            @endif
                            
                            @if($analysis['links']['internal'] == 0 && $analysis['links']['external'] == 0)
                            <div class="alert alert-warning mt-3">
                                <strong>Recommendation:</strong> Add internal links to other relevant content on your site.
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Technical SEO -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-cogs text-secondary"></i> Technical SEO
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               {{ $blog->schema_type ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">
                                            Schema Markup
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               {{ $blog->faq_json ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">
                                            FAQ Schema
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6 mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               {{ $blog->canonical_url ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">
                                            Canonical URL
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6 mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               {{ $blog->meta_keywords ? 'checked' : '' }} disabled>
                                        <label class="form-check-label">
                                            Meta Keywords
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <h6>Schema Type:</h6>
                                <span class="badge badge-info">{{ $blog->schema_type ?: 'Not set' }}</span>
                            </div>
                            
                            @if($blog->canonical_url)
                            <div class="mt-3">
                                <h6>Canonical URL:</h6>
                                <code>{{ $blog->canonical_url }}</code>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recommendations -->
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-lightbulb"></i> SEO Recommendations
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Immediate Actions (High Priority)</h5>
                            <ul>
                                @if(!$analysis['images']['has_featured'])
                                <li>Add a featured image (1200x630px recommended)</li>
                                @endif
                                @if(!$blog->meta_description)
                                <li>Add a custom meta description (120-160 characters)</li>
                                @endif
                                @if(!$analysis['title']['optimal'])
                                <li>Optimize title length (currently {{ $analysis['title']['length'] }} chars)</li>
                                @endif
                                @if(!$blog->schema_type)
                                <li>Add schema markup (Article, BlogPosting, etc.)</li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>Improvements (Medium Priority)</h5>
                            <ul>
                                @if(!$analysis['content']['optimal'])
                                <li>Expand content (currently {{ $analysis['content']['word_count'] }} words)</li>
                                @endif
                                @if(!$analysis['readability']['optimal'])
                                <li>Improve readability (score: {{ number_format($analysis['readability']['flesch_score'], 1) }})</li>
                                @endif
                                @if($analysis['links']['internal'] < 2)
                                <li>Add internal links to related content</li>
                                @endif
                                @if(!$blog->faq_json)
                                <li>Add FAQ section for FAQ schema</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h5>Keyword Strategy</h5>
                        @if($blog->target_keywords)
                        <p>Target keywords identified. Consider:</p>
                        <ul>
                            <li>Adding LSI (Latent Semantic Indexing) keywords</li>
                            <li>Including long-tail variations</li>
                            <li>Adding keywords in H2/H3 headings</li>
                        </ul>
                        @else
                        <div class="alert alert-danger">
                            <strong>No target keywords set!</strong> Add primary and secondary keywords for better ranking.
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('adminblog.edit', $blog->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit Blog to Fix Issues
                            </a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('adminblog.show', $blog->id) }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Blog Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
$(document).ready(function() {
    // Update progress bars on page load
    $('.progress-bar').each(function() {
        const width = $(this).attr('style').match(/width: (\d+)%/);
        if (width) {
            $(this).css('width', width[1] + '%');
        }
    });
});
</script>
@endsection

