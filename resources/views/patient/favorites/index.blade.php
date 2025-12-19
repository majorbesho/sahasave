@extends('frontend.layouts.master')

@section('content')

    <!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center inner-banner">
            <div class="col-md-12 col-12 text-center">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="isax isax-home-15"></i></a></li>
                                                <li class="breadcrumb-item" aria-current="page">Patient</li>
                                                <li class="breadcrumb-item active">Favourites</li>
                    </ol>
                   
                    <h2 class="breadcrumb-title">Favourites</h2>
                  
                </nav>
            </div>
        </div>
    </div>
    <div class="breadcrumb-bg">
        <img src="{{asset('frontend/xx/assets/img/bg/breadcrumb-bg-01.png')}}" alt="img" class="breadcrumb-bg-01">
        <img src="{{asset('frontend/xx/assets/img/bg/breadcrumb-bg-02.png')}}" alt="img" class="breadcrumb-bg-02">
        <img src="{{asset('frontend/xx/assets/img/bg/breadcrumb-icon.png')}}" alt="img" class="breadcrumb-bg-03">
        <img src="{{asset('frontend/xx/assets/img/bg/breadcrumb-icon.png')}}" alt="img" class="breadcrumb-bg-04">
    </div>
</div>
<!-- /Breadcrumb -->    
   <!-- Page Content -->
   <div class="content doctor-content">
    <div class="container">
        <div class="row">

            <!-- Profile Sidebar -->
<div class="col-lg-4 col-xl-3 theiaStickySidebar">
    @include('patient.sidebar')
</div>
<!-- / Profile Sidebar -->

            <div class="col-lg-8 col-xl-9">

                <div class="dashboard-header">
                    <h3>Favourites</h3>
                    <ul class="header-list-btns">
                        <li>
                            <div class="input-block dash-search-input">
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="search-icon"><i class="isax isax-search-normal"></i></span>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Favourites -->
                <div class="row">
                    @forelse($favorites as $favorite)
                    @php $doctor = $favorite->doctor; @endphp
                    @if($doctor)
                    <div class="col-md-6 col-lg-4 d-flex">
                        <div class="profile-widget patient-favour flex-fill">
                            <div class="fav-head">
                                <a href="javascript:void(0)" class="fav-btn favourite-btn" onclick="toggleFavorite({{ $doctor->id }})">
                                    <span class="favourite-icon favourite"><i class="isax isax-heart5"></i></span>
                                </a>
                                <div class="doc-img">
                                    <a href="{{ route('doctorshome.show', $doctor->id) }}">
                                        <img class="img-fluid" alt="User Image" src="{{ $doctor->photo ? asset('storage/profiles/' . $doctor->photo) : asset('frontend/xx/assets/img/doctors/doctor-thumb-01.jpg') }}">
                                    </a>
                                </div>
                                <div class="pro-content">
                                    <h3 class="title">
                                        <a href="{{ route('doctorshome.show', $doctor->id) }}">{{ $doctor->name }}</a> 
                                        @if($doctor->is_verified)
                                        <i class="isax isax-tick-circle5 verified"></i>
                                        @endif
                                    </h3>
                                    <p class="speciality">{{ $doctor->doctorProfile->specialization ?? 'General' }}</p>
                                    <div class="rating">
                                        @php
                                            $rating = $doctor->doctorProfile->average_rating ?? 0;
                                            $fullStars = floor($rating);
                                            $halfStar = $rating - $fullStars >= 0.5;
                                        @endphp
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $fullStars)
                                                <i class="fas fa-star filled"></i>
                                            @elseif($i == $fullStars + 1 && $halfStar)
                                                <i class="fas fa-star-half-alt filled"></i>
                                            @else
                                                <i class="fas fa-star"></i>
                                            @endif
                                        @endfor
                                        <span class="d-inline-block average-rating">({{ $doctor->doctorProfile->review_count ?? 0 }})</span>
                                    </div>
                                    <ul class="available-info">
                                        <li>
                                            <i class="isax isax-location5 me-1"></i><span>Location :</span> {{ $doctor->address ?? 'N/A' }}
                                        </li>
                                    </ul>
                                    <div class="last-book">
                                        @php
                                            $lastAppt = Auth::user()->getLastAppointmentWithDoctor($doctor->id);
                                        @endphp
                                        @if($lastAppt)
                                            <p>Last Book on {{ $lastAppt->scheduled_for->format('d M Y') }}</p>
                                        @else
                                            <p>No previous bookings</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="fav-footer">
                                <div class="row row-sm">
                                    <div class="col-6">
                                        {{-- route('doctors.showxx', $doctor->id) --}}
<a href="{{ route('doctorshome.show', $doctor->id) }}" class="btn btn-md btn-light w-100">View Profile</a>                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('doctorshomex.booking.create', $doctor->id) }}" class="btn btn-md btn-outline-primary w-100">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @empty
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3>No Favorite Doctors Yet</h3>
                                <p>You haven't added any doctors to your favorites list.</p>
                                <a href="{{ route('home') }}" class="btn btn-primary">Find Doctors</a>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="pagination-tab d-flex justify-content-center">
                            {{ $favorites->links() }}
                        </div>
                    </div>
                </div>
                <!-- /Pagination -->
                <!-- /Favourites -->



            </div>
        </div>
    </div>

</div>		
<script>
    function toggleFavorite(doctorId) {
        $.ajax({
            url: "{{ route('patient.favorites.toggle', ':id') }}".replace(':id', doctorId),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if(response.success) {
                    // Update UI if needed, e.g., toggle icon class
                    // For now, reload or show toast
                    toastr.success(response.message);
                    if(!response.is_favorite) {
                        // Optional: Remove the card or reload to refresh list
                        location.reload(); 
                    }
                }
            },
            error: function(xhr) {
                toastr.error('Something went wrong');
            }
        });
    }
</script>
@endsection

