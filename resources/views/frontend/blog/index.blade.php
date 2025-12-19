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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Current Blog') }}</li>
                    </ol>
                   
                    <h2 class="breadcrumb-title">
                        @if(isset($category))
                            {{ $category->name }}
                        @elseif(isset($tag))
                            {{ __('Tag: :tag', ['tag' => $tag->name]) }}
                        @else
                            {{ __('Blog List') }}
                        @endif
                    </h2>
                  
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

                @forelse($blogs as $blog)
                <!-- Blog Post -->
                <div class="blog">
                    <div class="blog-image">
                        <a href="{{ route('blog.show', $blog->slug) }}">
                            @if($blog->featured_image)
                                <img class="img-fluid" src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}">
                            @else
                                <img class="img-fluid" src="{{ asset('assets/img/blog/blog-list-01.jpg') }}" alt="Default Image">
                            @endif
                        </a>
                        @if($blog->category)
                            <span class="badge badge-cyan category-slug">{{ $blog->category->name }}</span>
                        @endif
                    </div>
                    <div class="blog-content">
                        <ul class="entry-meta meta-item">
                            <li>
                                <div class="post-author">
                                    <a href="#">
                                        @if($blog->author && $blog->author->photo)
                                            <img src="{{ asset('storage/' . $blog->author->photo) }}" alt="Post Author">
                                        @else
                                            <img src="{{ asset('frontend/xx/assets/img/logo.png') }}" alt="Default Author">
                                        @endif
                                        <span>{{ $blog->author ? $blog->author->name : 'Admin' }}</span>
                                    </a>
                                </div>
                            </li>
                            <li><i class="isax isax-calendar-1 me-1"></i>{{ $blog->published_at ? $blog->published_at->format('d M Y') : $blog->created_at->format('d M Y') }}</li>
                        </ul>
                        <h3 class="blog-title"><a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a></h3>
                        <p class="mb-0">{{ Str::limit($blog->excerpt, 150) }}</p>
                    </div>
                </div>
                <!-- /Blog Post -->
                @empty
                    <div class="alert alert-info">{{ __('No posts found.') }}</div>
                @endforelse

                <!-- Blog Pagination -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="pagination dashboard-pagination mt-md-3 mt-0 mb-4">
                            {{ $blogs->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
                <!-- /Blog Pagination -->
                
            </div>
            
            <!-- Blog Sidebar -->
            <div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">

                <!-- Search -->
                <div class="card search-widget">
                    <div class="card-body">
                        <form class="search-form" action="{{ route('blog.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="q" placeholder="{{ __('Search...') }}" class="form-control" value="{{ request('q') }}">
                                <button type="submit" class="btn btn-primary"><i class="isax isax-search-normal"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Search -->

                <!-- Categories -->
                @if($categories->count() > 0)
                <div class="card category-widget">
                    <div class="card-body">
                        <h5 class="mb-3">{{ __('Categories') }}</h5>
                        <ul class="categories">
                            @foreach($categories as $cat)
                                <li><a href="{{ route('blog.category', $cat->slug) }}">{{ $cat->name }} <span>({{ $cat->blogs_count }})</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                <!-- /Categories -->

                <!-- Latest Posts -->
                @if(isset($recent_posts) && $recent_posts->count() > 0)
                <div class="card post-widget">
                    <div class="card-body">
                        <h5 class="mb-3">{{ __('Latest News') }}</h5>
                        <ul class="latest-posts">
                            @foreach($recent_posts as $recent)
                            <li>
                                <div class="post-thumb">
                                    <a href="{{ route('blog.show', $recent->slug) }}">
                                        @if($recent->featured_image)
                                            <img class="img-fluid" src="{{ asset('storage/' . $recent->featured_image) }}" alt="">
                                        @else
                                            <img class="img-fluid" src="{{ asset('assets/img/blog/blog-thumb-01.jpg') }}" alt="">
                                        @endif
                                    </a>
                                </div>
                                <div class="post-info">
                                    <p>{{ $recent->published_at ? $recent->published_at->format('d M Y') : $recent->created_at->format('d M Y') }}</p>
                                    <h4>
                                        <a href="{{ route('blog.show', $recent->slug) }}">{{ Str::limit($recent->title, 40) }}</a>
                                    </h4>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                <!-- /Latest Posts -->

                <!-- Tags -->
                @if(isset($popularTags) && $popularTags->count() > 0)
                <div class="card tags-widget">
                    <div class="card-body">
                        <h5 class="mb-3">{{ __('Tags') }}</h5>
                        <ul class="tags">
                            @foreach($popularTags as $tag)
                                <li><a href="{{ route('blog.tag', $tag->slug) }}" class="tag">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                <!-- /Tags -->
                
            </div>
            <!-- /Blog Sidebar -->
            
        </div>
    </div>
</div>
<!-- /Page Content -->
@endsection