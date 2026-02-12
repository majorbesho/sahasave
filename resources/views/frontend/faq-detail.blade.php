@extends('frontend.layouts.master')



@section('title', $faq->translate(app()->getLocale())->meta_title ?? $faq->question)
@section('meta_description', $faq->translate(app()->getLocale())->meta_description ?? strip_tags($faq->answer))
@section('meta_keywords', $faq->translate(app()->getLocale())->meta_keywords ?? '')

@section('content')


<style>
.faq-detail-card {
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.faq-answer {
    font-size: 1.1rem;
    line-height: 1.8;
}

.faq-answer img {
    max-width: 100%;
    height: auto;
}

.faq-answer ul,
.faq-answer ol {
    padding-left: 25px;
}

.faq-tags .badge {
    font-size: 0.9rem;
}

.social-share .btn {
    min-width: 120px;
}

.list-group-item {
    transition: all 0.3s ease;
}

.list-group-item:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}
</style>

<!-- Breadcrumb -->
<div class="breadcrumb-bar-two">
    <div class="container">
        <div class="row align-items-center inner-banner">
            <div class="col-md-12 col-12 text-center">
                <h2 class="breadcrumb-title">{{ __('faq.title') }}</h2>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('frontend.faq.index') }}">{{ __('faq.title') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($faq->question, 50) }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- FAQ Detail Section -->
<section class="py-5 faq-detail-section">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="mb-4 card faq-detail-card">
                    <div class="card-body">
                        <!-- Category Badge -->
                        @if($category)
                        <div class="mb-3">
                            <span class="badge bg-primary">
                                {{ $category->translateOrDefault(app()->getLocale())->name ?? $category->name }}
                            </span>
                        </div>
                        @endif

                        <!-- Question -->
                        <h1 class="mb-3 h3">{{ $faq->question }}</h1>

                        <!-- Meta Info -->
                        <div class="pb-3 mb-4 border-bottom faq-meta d-flex align-items-center text-muted">
                            <span class="me-3">
                                <i class="fas fa-eye"></i> {{ $faq->views_count }} {{ __('views') }}
                            </span>
                            <span class="me-3">
                                <i class="fas fa-thumbs-up text-success"></i> {{ $faq->helpful_yes }}
                            </span>
                            <span>
                                <i class="fas fa-thumbs-down text-danger"></i> {{ $faq->helpful_no }}
                            </span>
                        </div>

                        <!-- Answer -->
                        <div class="mb-4 faq-answer">
                            {!! $faq->answer !!}
                        </div>

                        <!-- Tags -->
                        @if($tags && $tags->count() > 0)
                        <div class="pb-3 mb-4 border-bottom faq-tags">
                            <h5 class="mb-3">{{ __('Related Topics') }}</h5>
                            @foreach($tags as $tag)
                            <span class="mb-2 badge bg-light text-dark me-2">
                                <i class="fas fa-tag"></i> 
                                {{ $tag->translateOrDefault(app()->getLocale())->name ?? $tag->name }}
                            </span>
                            @endforeach
                        </div>
                        @endif

                        <!-- Helpful Feedback -->
                        <div class="faq-feedback">
                            <h5 class="mb-3">{{ __('faq.helpful') }}</h5>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-success helpful-btn" data-faq-id="{{ $faq->id }}" data-type="yes">
                                    <i class="fas fa-thumbs-up"></i> {{ __('faq.yes') }}
                                </button>
                                <button type="button" class="btn btn-outline-danger helpful-btn" data-faq-id="{{ $faq->id }}" data-type="no">
                                    <i class="fas fa-thumbs-down"></i> {{ __('faq.no') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Share Section -->
                <div class="mb-4 card">
                    <div class="card-body">
                        <h5 class="mb-3">{{ __('Share this FAQ') }}</h5>
                        <div class="social-share">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('frontend.faq.show', $faq->slug)) }}" 
                               target="_blank" class="btn btn-sm btn-primary me-2">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('frontend.faq.show', $faq->slug)) }}&text={{ urlencode($faq->question) }}" 
                               target="_blank" class="btn btn-sm btn-info me-2">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($faq->question . ' ' . route('frontend.faq.show', $faq->slug)) }}" 
                               target="_blank" class="btn btn-sm btn-success">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Related FAQs -->
                @if($relatedFaqs && $relatedFaqs->count() > 0)
                <div class="mb-4 card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">{{ __('Related Questions') }}</h5>
                    </div>
                    <div class="p-0 card-body">
                        <div class="list-group list-group-flush">
                            @foreach($relatedFaqs as $relatedFaq)
                            <a href="{{ route('frontend.faq.show', $relatedFaq->slug) }}" 
                               class="list-group-item list-group-item-action">
                                <i class="fas fa-question-circle text-primary"></i>
                                {{ Str::limit($relatedFaq->question, 60) }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Popular FAQs -->
                <div class="mb-4 card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0" style="color: #fff" >{{ __('Popular Questions') }}</h5>
                    </div>
                    <div class="p-0 card-body">
                        <div class="list-group list-group-flush">
                            @php
                            $popularFaqs = App\Models\Faq::active()
                                ->orderBy('views_count', 'desc')
                                ->take(5)
                                ->get();
                            @endphp
                            @foreach($popularFaqs as $popularFaq)
                            <a href="{{ route('frontend.faq.show', $popularFaq->slug) }}" 
                               class="list-group-item list-group-item-action">
                                <i class="fas fa-fire text-danger"></i>
                                {{ Str::limit($popularFaq->question, 60) }}
                                <small class="text-muted d-block">
                                    <i class="fas fa-eye"></i> {{ $popularFaq->views_count }}
                                </small>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Back to All FAQs -->
                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route('frontend.faq.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left"></i> {{ __('faq.view_all') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    // Handle helpful feedback
    $('.helpful-btn').on('click', function() {
        const faqId = $(this).data('faq-id');
        const type = $(this).data('type');
        const button = $(this);
        
        // Disable buttons to prevent multiple clicks
        $('.helpful-btn').prop('disabled', true);
        
        $.ajax({
            url: '{{ route("frontend.faq.helpful", $faq->id) }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                faq_id: faqId,
                type: type
            },
            success: function(response) {
                if (response.success) {
                    // Update button text with count
                    if (type === 'yes') {
                        button.html('<i class="fas fa-thumbs-up"></i> {{ __("faq.yes") }} (' + response.helpful_yes + ')');
                        button.removeClass('btn-outline-success').addClass('btn-success');
                    } else {
                        button.html('<i class="fas fa-thumbs-down"></i> {{ __("faq.no") }} (' + response.helpful_no + ')');
                        button.removeClass('btn-outline-danger').addClass('btn-danger');
                    }
                    
                    toastr.success('{{ __("Thank you for your feedback!") }}');
                }
            },
            error: function() {
                toastr.error('{{ __("An error occurred. Please try again.") }}');
                $('.helpful-btn').prop('disabled', false);
            }
        });
    });
});
</script>

<!-- /FAQ Detail Section -->



@endsection
