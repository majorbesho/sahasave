@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="text-center col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="isax isax-home-15"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Doctor</li>
                            <li class="breadcrumb-item active">Reviews</li>
                        </ol>
                        <h2 class="breadcrumb-title">Reviews</h2>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="content">
        <div class="container">
            <div class="row">
                
                @include('doctor.layouts.slide')

                <div class="col-lg-8 col-xl-9">
                    <div class="dashboard-card">
                        <div class="dashboard-card-head">
                            <div class="header-title">
                                <h5>Reviews List</h5>
                            </div>
                        </div>
                        <div class="dashboard-card-body">
                            <ul class="comments-list">
                                @forelse($reviews as $review)
                                    <li>
                                        <div class="comment">
                                            <img class="avatar avatar-sm rounded-circle" alt="User Image" src="{{ $review->patient->photo_url }}">
                                            <div class="comment-body">
                                                <div class="meta-data">
                                                    <span class="comment-author">{{ $review->patient->name }}</span>
                                                    <span class="comment-date">Reviewed {{ $review->created_at->diffForHumans() }}</span>
                                                    <div class="review-count rating">
                                                        @for($i=1; $i<=5; $i++)
                                                            <i class="fas fa-star {{ $i <= $review->rating ? 'filled' : '' }}"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <p class="comment-content">
                                                    {{ $review->comment }}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <p class="text-center">No reviews found.</p>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
