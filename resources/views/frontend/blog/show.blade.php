@extends('frontend.layouts.master')

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center inner-banner">
            <div class="col-md-12 col-12 text-center">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="isax isax-home-15"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">{{ __('Blog') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($blog->title, 20) }}</li>
                    </ol>
                   
                    <h2 class="breadcrumb-title">{{ $blog->title }}</h2>
                  
                </nav>
            </div>
        </div>
    </div>
    <div class="breadcrumb-bg">
        <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-01.png') }}" alt="img" class="breadcrumb-bg-01">
        <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-02.png') }}" alt="img" class="breadcrumb-bg-02">
        <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img" class="breadcrumb-bg-03">
        <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img" class="breadcrumb-bg-04">
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container">
    
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="blog-view">
                    <h3 class="mb-3">{{ $blog->title }}</h3>
                    <div class="blog blog-single-post">
                        <div class="blog-image">
                            <a href="javascript:void(0);">
                                @if($blog->featured_image)
                                    <img alt="{{ $blog->title }}" src="{{ asset('storage/' . $blog->featured_image) }}" class="img-fluid">
                                @else
                                    <img alt="Default Image" src="{{ asset('assets/img/blog/blog-list-01.jpg') }}" class="img-fluid">
                                @endif
                            </a>
                        </div>
                        <div class="blog-info d-md-flex align-items-center justify-content-between flex-wrap">
                            <div class="post-left">
                                <ul>
                                    @if($blog->category)
                                        <li><span class="badge badge-dark fs-14 fw-medium">{{ $blog->category->name }}</span></li>
                                    @endif
                                    <li><i class="isax isax-calendar"></i>{{ $blog->published_at ? $blog->published_at->format('d M Y') : $blog->created_at->format('d M Y') }}</li>
                                    <li>
                                        <div class="post-author">
                                            <a href="#">
                                                @if($blog->author && $blog->author->photo)
                                                    <img src="{{ asset('storage/' . $blog->author->photo) }}" alt="Post Author">
                                                @else
                                                    <img src="{{ asset('assets/img/patients/patient21.jpg') }}" alt="Default Author">
                                                @endif
                                                <span>{{ $blog->author ? $blog->author->name : 'Admin' }}</span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="blog-views d-flex align-items-center justify-content-md-end">
                                <!-- <span class="badge badge-outline-dark me-2"><i class="isax isax-message-text me-1"></i>0</span> -->
                                <span class="badge badge-outline-primary"><i class="isax isax-eye me-1"></i>{{ $blog->views }}</span>
                            </div>
                        </div>
                        <div class="blog-content">
                            {!! $blog->content !!}
                        </div>
                    </div>
                    
                    @if($blog->author && $blog->author->bio)
                    <h4 class="mb-3">{{ __('About Author') }}</h4>
                    <div class="about-author">
                        <div class="about-author-img">
                            <div class="author-img-wrap">
                                <a href="#">
                                     @if($blog->author->photo)
                                        <img class="img-fluid" alt="{{ $blog->author->name }}" src="{{ asset('storage/' . $blog->author->photo) }}">
                                    @else
                                        <img class="img-fluid" alt="" src="{{ asset('frontend/xx/assets/img/logo.png') }}">
                                    @endif
                                </a>
                            </div>
                        </div>
                        <div class="author-details">
                            <p class="mb-0">{{ $blog->author->bio }}</p>
                        </div>
                    </div>
                    @endif

                    @if($blog->relatedTags && $blog->relatedTags->count() > 0)
                    <h4 class="mb-3">{{ __('Tags') }}</h4>
                    <div class="d-flex align-items-center flex-wrap blog-tags gap-3 mb-4">
                        @foreach($blog->relatedTags as $tag)
                            <a href="{{ route('blog.tag', $tag->slug) }}" class="badge">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                    @endif
                    
                    <!-- Share Buttons (Placeholder or Package) -->
                    <!-- <div class="social-share"> ... </div> -->

                </div>
            </div>
        
            <!-- Blog Sidebar (Same as Index, can be partialized) -->
            <div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">

                <!-- Search -->
                <div class="card search-widget">
                    <div class="card-body">
                         <form class="search-form" action="{{ route('blog.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="q" placeholder="{{ __('Search...') }}" class="form-control">
                                <button type="submit" class="btn btn-primary"><i class="isax isax-search-normal"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Search -->

                <!-- Categories -->
                @php
                    // Fetch categories again or share via ViewComposer (omitted for brevity, fetching directly or checking if passed)
                    // If not passed, we might need to rely on what's available or leave static for now if partial not used
                    // But usually, Sidebar data should be passed to show method too or ViewComposer
                    // Controller passed 'relatedArticles', but not 'categories' explicitly in show method.
                    // We can use relatedArticles as 'Latest News' proxy or similar.
                    // Ideally, use a ViewComposer for sidebar. For now, strict variables check.
                @endphp
                
                 <!-- Latest Posts (Related) -->
                @if(isset($relatedArticles) && $relatedArticles->count() > 0)
                <div class="card post-widget">
                    <div class="card-body">
                        <h5 class="mb-3">{{ __('Related Articles') }}</h5>
                        <ul class="latest-posts">
                            @foreach($relatedArticles as $related)
                            <li>
                                <div class="post-thumb">
                                    <a href="{{ route('blog.show', $related->slug) }}">
                                        @if($related->featured_image)
                                            <img class="img-fluid" src="{{ asset('storage/' . $related->featured_image) }}" alt="">
                                        @else
                                            <img class="img-fluid" src="{{ asset('assets/img/blog/blog-thumb-01.jpg') }}" alt="">
                                        @endif
                                    </a>
                                </div>
                                <div class="post-info">
                                    <p>{{ $related->published_at ? $related->published_at->format('d M Y') : $related->created_at->format('d M Y') }}</p>
                                    <h4>
                                        <a href="{{ route('blog.show', $related->slug) }}">{{ Str::limit($related->title, 40) }}</a>
                                    </h4>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                
            </div>
            <!-- /Blog Sidebar -->
            
        </div>
    </div>

</div>      
<!-- /Page Content -->
@endsection
