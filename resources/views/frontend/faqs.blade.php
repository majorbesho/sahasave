@extends('frontend.layouts.master')
@section('title', __('seo.faqs.title'))
@section('meta_description', __('seo.faqs.description'))
@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar-two">
    <div class="container">
        <div class="row align-items-center inner-banner">
            <div class="col-md-12 col-12 text-center">
                <h1 class="breadcrumb-title">{{ __('faq.title') }}</h1>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('faq.title') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<section class="faq-section-one py-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-4 order-lg-2 mb-4">
                <!-- Search Widget -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title mb-3">{{ __('Search') }}</h5>
                        <form action="{{ route('frontend.faq.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="{{ __('Search questions...') }}" value="{{ request('search') }}">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Categories Widget -->
                @if(isset($categories) && $categories->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">{{ __('Categories') }}</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('frontend.faq.index') }}" class="list-group-item list-group-item-action {{ !request('category') ? 'active' : '' }}">
                                {{ __('All Categories') }}
                            </a>
                            @foreach($categories as $cat)
                            <a href="{{ route('frontend.faq.category', $cat->slug) }}" 
                               class="list-group-item list-group-item-action {{ (isset($category) && $category->id == $cat->id) ? 'active' : '' }}">
                                {{ $cat->translateOrDefault(app()->getLocale())->name ?? $cat->name }}
                                <span class="badge bg-secondary float-end">{{ $cat->faqs_count }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Tags Widget -->
                @if(isset($tags) && $tags->count() > 0)
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">{{ __('Tags') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="tags-cloud">
                            @foreach($tags as $t)
                            <a href="{{ route('frontend.faq.tag', $t->slug) }}" 
                               class="badge bg-light text-dark mb-2 text-decoration-none border {{ (isset($tag) && $tag->id == $t->id) ? 'border-primary' : '' }}">
                                {{ $t->translateOrDefault(app()->getLocale())->name ?? $t->name }}
                                ({{ $t->faqs_count }})
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Main Content -->
            <div class="col-lg-8 order-lg-1">
                <div class="section-header mb-4">
                    @if(request('search'))
                        <h3>{{ __('Search Results for') }}: "{{ request('search') }}"</h3>
                    @elseif(isset($category))
                        <h3>{{ __('Category') }}: {{ $category->translateOrDefault(app()->getLocale())->name ?? $category->name }}</h3>
                    @elseif(isset($tag))
                        <h3>{{ __('Tag') }}: {{ $tag->translateOrDefault(app()->getLocale())->name ?? $tag->name }}</h3>
                    @else
                        <h3>{{ __('All Questions') }}</h3>
                    @endif
                </div>

                @if($faqs->count() > 0)
                    <div class="accordion" id="faq-list">
                        @foreach($faqs as $index => $faq)
                        <div class="accordion-item mb-3 shadow-sm border-0">
                            <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                <a href="javascript:void(0);" 
                                   class="accordion-button collapsed bg-white text-dark p-3 rounded" 
                                   data-bs-toggle="collapse"
                                   data-bs-target="#collapse{{ $faq->id }}" 
                                   aria-expanded="false" 
                                   aria-controls="collapse{{ $faq->id }}">
                                    <span class="me-2 text-primary"><i class="fas fa-question-circle"></i></span>
                                    {{ $faq->question }}
                                </a>
                            </h2>
                            <div id="collapse{{ $faq->id }}" 
                                 class="accordion-collapse collapse" 
                                 aria-labelledby="heading{{ $faq->id }}" 
                                 data-bs-parent="#faq-list">
                                <div class="accordion-body bg-light">
                                    <div class="accordion-content">
                                        {!! $faq->answer !!}
                                        
                                        <div class="mt-3 d-flex justify-content-between align-items-center">
                                            <a href="{{ route('frontend.faq.show', $faq->slug) }}" class="btn btn-sm btn-outline-primary">
                                                {{ __('faq.read_more') }}
                                            </a>
                                            <small class="text-muted">
                                                <i class="fas fa-eye"></i> {{ $faq->views_count }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $faqs->onEachSide(1)->links() }}
                    </div>
                @else
                    <div class="alert alert-warning text-center">
                        <i class="fas fa-search me-2"></i> {{ __('faq.no_faqs') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .accordion-button:not(.collapsed) {
        color: #0d6efd;
        background-color: #e7f1ff;
        box-shadow: inset 0 -1px 0 rgba(0,0,0,.125);
    }
    .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }
    .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%230c63e4'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }
    .tags-cloud .badge {
        font-size: 0.9rem;
        padding: 8px 12px;
        font-weight: normal;
    }
    .tags-cloud .badge:hover {
        background-color: #0d6efd !important;
        color: white !important;
    }
</style>
@endpush
