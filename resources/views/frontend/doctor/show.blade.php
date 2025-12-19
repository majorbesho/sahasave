@extends('frontend.layouts.master')

@section('title', 'حجز موعد مع د. ' . $doctor->name)


@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="text-center col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="isax isax-home-15"></i></a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Patient</li>
                            <li class="breadcrumb-item active">{{ $doctor->name }}'s Profile</li>
                        </ol>
                        <h2 class="breadcrumb-title">{{ $doctor->name }}'s Profile</h2>
                    </nav>
                </div>
            </div>
        </div>
        <div class="breadcrumb-bg">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-01.png') }}" alt="img"
                class="breadcrumb-bg-01">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-02.png') }}" alt="img"
                class="breadcrumb-bg-02">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img" class="breadcrumb-bg-03">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img" class="breadcrumb-bg-04">
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">

            <!-- Doctor Widget -->
            <div class="card doc-profile-card">
                <div class="card-body">
                    <div class="doctor-widget doctor-profile-two">
                        <div class="doc-info-left">
                            <div class="doctor-img">
                                <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('frontend/xx/assets/img/doctors/doc-profile-02.jpg') }}"
                                    class="img-fluid" alt="{{ $doctor->name }}">
                            </div>
                            <div class="doc-info-cont">
                                <span class="badge doc-avail-badge">
                                    <i
                                        class="fa-solid fa-circle {{ $doctor->status === 'active' ? 'text-success' : 'text-danger' }}"></i>
                                    {{ $doctor->status === 'active' ? 'Available' : 'Unavailable' }}
                                </span>
                                <h4 class="doc-name">Dr.{{ $doctor->name }}
                                    @if ($doctor->doctorProfile && $doctor->doctorProfile->is_verified)
                                        <img src="{{ asset('frontend/xx/assets/img/icons/badge-check.svg') }}"
                                            alt="Verified">
                                    @endif
                                    <span class="badge doctor-role-badge"><i
                                            class="fa-solid fa-circle"></i>{{ $doctor->doctorProfile->specialty->name ?? 'N/A' }}</span>
                                </h4>
                                <p>{{ $doctor->doctorProfile->qualifications_display ?? 'N/A' }}</p>
                                @if ($doctor->doctorProfile && $doctor->doctorProfile->languages)
                                    <p>Speaks :
                                        {{ is_array($doctor->doctorProfile->languages) ? implode(', ', $doctor->doctorProfile->languages) : $doctor->doctorProfile->languages }}
                                    </p>
                                @endif
                                <p class="address-detail"><span class="loc-icon"><i
                                            class="feather-map-pin"></i></span>{{ $doctor->address ?? 'No address provided' }}
                                    <span class="view-text">( View Location )</span>
                                </p>
                            </div>
                        </div>
                        <div class="doc-info-right">
                            <ul class="doctors-activities">
                                <li>
                                    <div class="hospital-info">
                                        <span class="list-icon"><img
                                                src="{{ asset('frontend/xx/assets/img/icons/watch-icon.svg') }}"
                                                alt="Img"></span>
                                        <p>
                                            @if ($doctor->doctorProfile && $doctor->doctorProfile->accepting_new_patients)
                                                Full Time, Online Therapy Available
                                            @else
                                                Not Accepting New Patients
                                            @endif
                                        </p>
                                    </div>
                                    <ul class="sub-links">
                                        <li><a href="#"><i class="feather-heart"></i></a></li>
                                        <li><a href="#"><i class="feather-share-2"></i></a></li>
                                        <li><a href="#"><i class="feather-link"></i></a></li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="hospital-info">
                                        <span class="list-icon"><img
                                                src="{{ asset('frontend/xx/assets/img/icons/thumb-icon.svg') }}"
                                                alt="Img"></span>
                                        <p><b>{{ $doctor->doctorProfile->recommendation_percentage ?? 'N/A' }}% </b>
                                            Recommended</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="hospital-info">
                                        <span class="list-icon"><img
                                                src="{{ asset('frontend/xx/assets/img/icons/building-icon.svg') }}"
                                                alt="Img"></span>
                                        <p>{{ $doctor->doctorProfile->current_hospital ?? ($doctor->medicalCenters->first()->name ?? 'N/A') }}
                                        </p>
                                    </div>
                                    <h5 class="accept-text"><span><i class="feather-check"></i></span>
                                        @if ($doctor->doctorProfile && $doctor->doctorProfile->accepting_new_patients)
                                            Accepting New Patients
                                        @else
                                            Not Accepting New Patients
                                        @endif
                                    </h5>
                                </li>
                                <li>
                                    <div class="rating">
                                        @php
                                            $averageRating = $doctor->doctorProfile->average_rating ?? 0;
                                            for ($i = 1; $i <= 5; $i++) {
                                                echo '<i class="fas fa-star ' .
                                                    ($i <= $averageRating ? 'filled' : '') .
                                                    '"></i>';
                                            }
                                        @endphp
                                        <span>{{ number_format($averageRating, 1) }}</span>
                                        <a href="#"
                                            class="d-inline-block average-rating">{{ $doctor->doctorProfile->rating_count ?? 0 }}
                                            Reviews</a>
                                    </div>
                                    <ul class="contact-doctors">
                                        <li><a href="chat-doctor.html"><span><img
                                                        src="{{ asset('frontend/xx/assets/img/icons/device-message2.svg') }}"
                                                        alt="Img"></span>Chat</a></li>
                                        <li><a href="voice-call.html"><span class="bg-violet"><i
                                                        class="feather-phone-forwarded"></i></span>Audio Call</a></li>
                                        <li><a href="video-call.html"><span class="bg-indigo"><i
                                                        class="fa-solid fa-video"></i></span>Video Call</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="doc-profile-card-bottom">
                        <ul>
                            <li>
                                <span class="bg-blue"><img src="{{ asset('frontend/xx/assets/img/icons/calendar3.svg') }}"
                                        alt="Img"></span>
                                Nearly {{ $doctor->doctorProfile->total_consultations ?? '0' }}+ Appointment Booked
                            </li>
                            <li>
                                <span class="bg-dark-blue"><img
                                        src="{{ asset('frontend/xx/assets/img/icons/bullseye.svg') }}"
                                        alt="Img"></span>
                                In Practice for {{ $doctor->doctorProfile->experience_years ?? '0' }} Years
                            </li>
                            <li>
                                <span class="bg-green"><img
                                        src="{{ asset('frontend/xx/assets/img/icons/bookmark-star.svg') }}"
                                        alt="Img"></span>
                                {{ count($doctor->doctorProfile->awards ?? []) }} Awards
                            </li>
                        </ul>
                        <div class="bottom-book-btn">
                            <p><span>Price : ${{ number_format($doctor->doctorProfile->consultation_fee ?? 0, 0) }} </span>
                                for a Session</p>
                            <div class="clinic-booking">
                                <a class="apt-btn" href="{{ route('doctorshomex.booking.create', $doctor->id) }}"> Book
                                    Appointment</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /Doctor Widget -->

            <div class="doctors-detailed-info">
                <ul class="information-title-list">
                    <li class="active">
                        <a href="#doc_bio">Doctor Bio</a>
                    </li>

                    <li>
                        <a href="#education">Education</a>
                    </li>
                    <li>
                        <a href="#experience">Experience</a>
                    </li>
                    <li>
                        <a href="#insurence">Insurances</a>
                    </li>
                    <li>
                        <a href="#services">Treatments</a>
                    </li>
                    <li>
                        <a href="#speciality">Speciality</a>
                    </li>
                    <li>
                        <a href="#availability">Availability</a>
                    </li>
                    <li>
                        <a href="#clinic">Clinics</a>
                    </li>
                    <li>
                        <a href="#membership">Memberships</a>
                    </li>
                    <li>
                        <a href="#awards">Awards</a>
                    </li>
                    <li>
                        <a href="#bussiness_hour">Business Hours</a>
                    </li>
                    <li>
                        <a href="#review">Review</a>
                    </li>
                </ul>
                <div class="doc-information-main">
                    <div class="doc-information-details bio-detail" id="doc_bio">
                        <div class="detail-title">
                            <h4>Doctor Bio</h4>
                        </div>
                        <p>{{ $doctor->doctorProfile->bio ?? 'No detailed biography available for this doctor.' }}</p>
                        <a href="#" class="show-more d-flex align-items-center">See More<i
                                class="fa-solid fa-chevron-down ms-2"></i></a>
                    </div>

                  <div class="doc-information-details" id="experience">
    <div class="detail-title">
        <h4>Practice Experience</h4>
    </div>
    
    @forelse($doctor->experiences as $experience)
        <div class="experience-info">
            <div class="experience-logo">
                @if($experience->hospital_logo)
                    <span>
                        <img src="{{ $experience->hospital_logo_url }}" 
                             alt="{{ $experience->hospital_name }}"
                             style="width: 50px; height: 50px; border-radius: 8px;">
                    </span>
                @else
                    <span>
                        <img src="{{ asset('frontend/xx/assets/img/icons/experience-logo-01.svg') }}" 
                             alt="Img">
                    </span>
                @endif
            </div>
            <div class="experience-content">
                <h5>{{ $experience->hospital_name }}</h5>
                <ul class="ent-list">
                    <li>{{ $experience->title ?: 'Doctor' }}</li>
                    <li>{{ $experience->location }}</li>
                    <li>{{ $experience->employment_type }}</li>
                </ul>
                <ul class="date-list">
                    <li>{{ $experience->duration }}</li>
                    <li>{{ $experience->years_of_experience }} years experience</li>
                </ul>
                <p>{{ Str::limit($experience->description, 200) }}</p>
            </div>
        </div>
    @empty
        <p class="text-muted">No work experience details available.</p>
    @endforelse
</div>

                   <div class="doc-information-details" id="insurence">
    <div class="detail-title slider-nav d-flex justify-content-between align-items-center">
        <h4>Insurance Accepted ({{ $doctor->insurances->where('is_active', true)->count() }})</h4>
        @if($doctor->insurances->where('is_active', true)->count() > 4)
            <div class="nav nav-container slide-1"></div>
        @endif
    </div>
    
    @if($doctor->insurances->where('is_active', true)->count() > 0)
        <div class="insurence-logo-slider owl-carousel">
            @foreach($doctor->insurances->where('is_active', true) as $insurance)
                <div class="insurence-logo">
                    @if($insurance->insurance_logo)
                        <span>
                            <img src="{{ $insurance->insurance_logo_url }}" 
                                 alt="{{ $insurance->insurance_name }}"
                                 style="width: 80px; height: 80px; border-radius: 8px;">
                        </span>
                    @else
                        <span>
                            <img src="{{ asset('frontend/xx/assets/img/icons/insurence-logo-01.svg') }}" 
                                 alt="{{ $insurance->insurance_name }}">
                        </span>
                    @endif
                    <p>{{ $insurance->insurance_name }}</p>
                    @if($insurance->insurance_company)
                        <small class="text-muted">{{ $insurance->insurance_company }}</small>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">No insurances accepted at this time.</p>
    @endif
</div>
                    <div class="doc-information-details" id="speciality">
                        <div class="detail-title">
                            <h4>Speciality</h4>
                        </div>
                        @if ($doctor->doctorProfile->subspecialties)
                            <ul class="special-links">
                                @foreach (is_array($doctor->doctorProfile->subspecialties) ? $doctor->doctorProfile->subspecialties : explode(', ', $doctor->doctorProfile->subspecialties) as $subspecialty)
                                    <li><a href="#">{{ $subspecialty }}</a></li>
                                @endforeach
                            </ul>
                        @else
                            <p>No subspecialties listed.</p>
                        @endif
                    </div>

                    <div class="doc-information-details" id="services">
                        <div class="detail-title">
                            <h4>Services & Pricing (Treatments)</h4>
                        </div>
                        {{-- Assuming subspecialties can be treated as services for now --}}
                        @if ($doctor->doctorProfile->subspecialties)
                            <ul class="special-links">
                                @foreach (is_array($doctor->doctorProfile->subspecialties) ? $doctor->doctorProfile->subspecialties : explode(', ', $doctor->doctorProfile->subspecialties) as $subspecialty)
                                    <li><a href="#">{{ $subspecialty }}
                                            <span>${{ number_format(rand(20, 150), 0) }}</span></a></li>
                                    {{-- Placeholder price --}}
                                @endforeach
                            </ul>
                        @else
                            <p>No specific services or pricing listed.</p>
                        @endif
                    </div>

                    <div class="doc-information-details" id="availability">
                        <div class="detail-title slider-nav d-flex justify-content-between align-items-center">
                            <h4>Availability</h4>
                            <div class="nav nav-container slide-2"></div>
                        </div>

                        @if ($doctor->schedules->isNotEmpty())
                            <div class="availability-slots-slider owl-carousel">
                                @php
                                    $availableSlots = [];
                                    foreach (\App\Models\Schedule::DAYS_OF_WEEK as $dayIndex => $dayName) {
                                        foreach ($doctor->schedules->where('day_of_week', $dayIndex) as $schedule) {
                                            $availableSlots[] = [
                                                'day' => $dayName,
                                                'time' =>
                                                    \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') .
                                                    ' - ' .
                                                    \Carbon\Carbon::parse($schedule->end_time)->format('h:i A'),
                                            ];
                                        }
                                    }
                                @endphp
                                @forelse($availableSlots as $slot)
                                    <div class="availability-date">
                                        <div class="book-date">
                                            <h6>{{ $slot['day'] }}</h6>
                                            <span>{{ $slot['time'] }}</span>
                                        </div>
                                    </div>
                                @empty
                                    <p>No specific availability slots found.</p>
                                @endforelse
                            </div>
                        @else
                            <p>No availability information.</p>
                        @endif

                    </div>

                 <div class="doc-information-details" id="clinic">
    <div class="detail-title">
        <h4>Clinics & Locations ({{ $doctor->clinics->where('is_active', true)->count() }})</h4>
    </div>
    
    @forelse($doctor->clinics->where('is_active', true) as $clinic)
        <div class="clinic-loc @if(!$loop->last) mb-4 @endif">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="clinic-info">
                        @if($clinic->clinic_logo)
                            <div class="clinic-img">
                                <img src="{{ $clinic->clinic_logo_url }}" 
                                     alt="{{ $clinic->clinic_name }}"
                                     style="width: 80px; height: 80px; border-radius: 8px;">
                            </div>
                        @else
                            <div class="clinic-img">
                                <img src="{{ asset('frontend/xx/assets/img/clinic/clinic-11.jpg') }}" 
                                     alt="{{ $clinic->clinic_name }}">
                            </div>
                        @endif
                        <div class="detail-clinic">
                            <h5>{{ $clinic->clinic_name }}</h5>
                            <p class="mb-1">
                                <i class="fa-solid fa-location-dot text-primary me-1"></i>
                                {{ $clinic->address }}
                                @if($clinic->city)
                                    , {{ $clinic->city }}
                                @endif
                                @if($clinic->state)
                                    , {{ $clinic->state }}
                                @endif
                            </p>
                            @if($clinic->phone)
                                <p class="mb-1">
                                    <i class="fa-solid fa-phone text-primary me-1"></i>
                                    {{ $clinic->phone }}
                                </p>
                            @endif
                            @if($clinic->email)
                                <p class="mb-1">
                                    <i class="fa-solid fa-envelope text-primary me-1"></i>
                                    {{ $clinic->email }}
                                </p>
                            @endif
                        </div>
                    </div>
                    
                    @if($clinic->gallery->count() > 0)
                        <div class="mt-3">
                            <h6>Clinic Gallery</h6>
                            <div class="row">
                                @foreach($clinic->gallery->take(3) as $image)
                                    <div class="col-4">
                                        <img src="{{ Storage::url($image->image_path) }}" 
                                             alt="Clinic Image"
                                             class="img-fluid rounded"
                                             style="height: 80px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    @if($clinic->description)
                        <div class="mt-3">
                            <p class="mb-0">{{ Str::limit($clinic->description, 200) }}</p>
                        </div>
                    @endif
                </div>
                <div class="col-lg-5">
                    @if($clinic->latitude && $clinic->longitude)
                        <div class="contact-map d-flex">
                            <iframe 
                                src="https://maps.google.com/maps?q={{ $clinic->latitude }},{{ $clinic->longitude }}&z=15&output=embed"
                                width="100%" 
                                height="250" 
                                style="border:0; border-radius: 8px;" 
                                allowfullscreen="" 
                                loading="lazy">
                            </iframe>
                        </div>
                    @else
                        <div class="contact-map d-flex">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3193.7301009561315!2d-76.13077892422932!3d36.82498697224007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89bae976cfe9f8af%3A0xa61eac05156fbdb9!2sBeachStreet%20USA!5e0!3m2!1sen!2sin!4v1669777904208!5m2!1sen!2sin"
                                width="100%" 
                                height="250" 
                                style="border:0; border-radius: 8px;"
                                allowfullscreen="" 
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">No clinics or locations listed for this doctor.</p>
    @endforelse
</div>



<div class="doc-information-details" id="education">
    <div class="detail-title">
        <h4>Education & Qualifications</h4>
    </div>
    
    @forelse($doctor->educations as $education)
        <div class="education-info mb-4">
            <div class="d-flex align-items-start">
                @if($education->institution_logo)
                    <div class="education-logo me-3">
                        <img src="{{ $education->institution_logo_url }}" 
                             alt="{{ $education->institution_name }}"
                             style="width: 60px; height: 60px; border-radius: 8px;">
                    </div>
                @endif
                <div>
                    <h5 class="mb-1">{{ $education->institution_name }}</h5>
                    <p class="mb-1 text-primary">
                        {{ $education->course }}
                        @if($education->degree)
                            ({{ $education->degree }})
                        @endif
                    </p>
                    <p class="mb-1">
                        <strong>Field:</strong> {{ $education->field_of_study ?: 'Not specified' }}
                    </p>
                    <p class="mb-1">
                        <strong>Duration:</strong> {{ $education->duration }}
                        ({{ $education->years }} years)
                    </p>
                    @if($education->grade)
                        <p class="mb-1"><strong>Grade:</strong> {{ $education->grade }}</p>
                    @endif
                    @if($education->description)
                        <p class="mb-0 mt-2">{{ Str::limit($education->description, 150) }}</p>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted">No education details available.</p>
    @endforelse
</div>


                    <div class="doc-information-details" id="membership">
                        <div class="detail-title">
                            <h4>Membership</h4>
                        </div>
                        @forelse($doctor->doctorProfile->memberships ?? [] as $membership)
                            <div class="member-ship-info">
                                <span class="mem-check"><i class="fa-solid fa-check"></i></span>
                                <p>{{ $membership }}</p>
                            </div>
                        @empty
                            <p>No membership information available.</p>
                        @endforelse
                    </div>

                   <div class="doc-information-details" id="awards">
    <div class="detail-title slider-nav d-flex justify-content-between align-items-center">
        <h4>Awards ({{ $doctor->awards->count() }})</h4>
        @if($doctor->awards->count() > 3)
            <div class="nav nav-container slide-3"></div>
        @endif
    </div>
    
    @if($doctor->awards->count() > 0)
        <div class="awards-slider owl-carousel">
            @foreach($doctor->awards as $award)
                <div class="award-card">
                    <div class="award-card-info">
                        @if($award->award_image)
                            <span>
                                <img src="{{ $award->award_image_url }}" 
                                     alt="{{ $award->award_name }}"
                                     style="width: 60px; height: 60px; border-radius: 8px;">
                            </span>
                        @else
                            <span>
                                <img src="{{ asset('frontend/xx/assets/img/icons/bookmark-star.svg') }}" 
                                     alt="Award">
                            </span>
                        @endif
                        <h5>{{ $award->award_name }}</h5>
                        <p>
                            @if($award->organization)
                                <strong>{{ $award->organization }}</strong><br>
                            @endif
                            Year: {{ $award->year }}
                        </p>
                        @if($award->description)
                            <p class="small text-muted">{{ Str::limit($award->description, 100) }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">No awards listed.</p>
    @endif
</div>

                    <div class="doc-information-details" id="bussiness_hour">
                        <div class="detail-title">
                            <h4>Business Hours</h4>
                        </div>
                        <div class="hours-business">
                            <ul>
                                @php
                                    $dailySchedules = $doctor->schedules->groupBy('day_of_week');
                                    $today = \Carbon\Carbon::now()->dayOfWeek; // 0 for Sunday, 1 for Monday, etc.
                                @endphp
                                <li>
                                    <div class="today-hours">
                                        <h6>Today</h6>
                                        <span>{{ \Carbon\Carbon::now()->format('D M Y') }}</span>
                                    </div>
                                    <div class="availed">
                                        @if ($dailySchedules->has($today))
                                            <span class="badge doc-avail-badge"><i
                                                    class="fa-solid fa-circle"></i>Available </span>
                                            @foreach ($dailySchedules[$today] as $schedule)
                                                <p>{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }} -
                                                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}</p>
                                            @endforeach
                                        @else
                                            <span class="badge doc-avail-badge text-danger"><i
                                                    class="fa-solid fa-circle"></i>Unavailable </span>
                                            <p>Closed</p>
                                        @endif
                                    </div>
                                </li>

                                @foreach (\App\Models\Schedule::DAYS_OF_WEEK as $dayIndex => $dayName)
                                    @if ($dayIndex !== $today)
                                        {{-- Skip today as it's handled above --}}
                                        <li>
                                            <h6>{{ $dayName }}</h6>
                                            @if ($dailySchedules->has($dayIndex))
                                                @foreach ($dailySchedules[$dayIndex] as $schedule)
                                                    <p>{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}
                                                        - {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}
                                                    </p>
                                                @endforeach
                                            @else
                                                <p>Closed</p>
                                            @endif
                                        </li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                    </div>

                    <div class="doc-information-details" id="review">
                        <div class="detail-title">
                            <h4>Reviews (Static for now - requires a Review Model)</h4>
                        </div>
                        {{-- Reviews are static as no 'Review' model was provided. --}}
                        <div class="doc-review-card">
                            <div class="user-info-review">
                                <div class="reviewer-img">
                                    <a href="#" class="avatar-img"><img
                                            src="{{ asset('frontend/xx/assets/img/clients/client-13.jpg') }}"
                                            alt="Img"></a>
                                    <div class="review-star">
                                        <a href="#">kadajsalamander</a>
                                        <div class="rating">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <span>5.0 | 2 days ago</span>
                                        </div>
                                    </div>
                                </div>
                                <span class="thumb-icon"><i class="fa-regular fa-thumbs-up"></i>Yes,Recommend for
                                    Appointment</span>
                            </div>
                            <p>Thank you for this informative article! I've had a couple of hit-and-miss experiences with
                                freelancers in the past, and I realize now that I wasn't vetting them properly. Your
                                checklist
                                for choosing the right freelancer is going to be my go-to from now on
                            </p>
                            <a href="#" class="reply d-flex align-items-center"><i
                                    class="fa-solid fa-reply me-2"></i>Reply</a>
                        </div>
                        <div class="doc-review-card">
                            <div class="user-info-review">
                                <div class="reviewer-img">
                                    <a href="#" class="avatar-img"><img
                                            src="{{ asset('frontend/xx/assets/img/clients/client-14.jpg') }}"
                                            alt="Img"></a>
                                    <div class="review-star">
                                        <a href="#">Dane jose</a>
                                        <div class="rating">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <span>5.0 | 1 Months ago</span>
                                        </div>
                                    </div>
                                </div>
                                <span class="thumb-icon"><i class="fa-regular fa-thumbs-up"></i>Yes,Recommend for
                                    Appointment</span>
                            </div>
                            <p>As a freelancer myself, I find this article spot on! It's important for clients to
                                understand what to look for in a freelancer and how to foster a good working relationship.
                                The point about mutual respect
                                and clear communication is key in my experience. Well done
                            </p>
                            <a href="#" class="reply d-flex align-items-center"><i
                                    class="fa-solid fa-reply me-2"></i>Reply</a>
                        </div>
                        <div class="mb-0 doc-review-card">
                            <div class="user-info-review">
                                <div class="reviewer-img">
                                    <a href="#" class="avatar-img"><img
                                            src="{{ asset('frontend/xx/assets/img/clients/client-15.jpg') }}"
                                            alt="Img"></a>
                                    <div class="review-star">
                                        <a href="#">Dane jose</a>
                                        <div class="rating">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <span>5.0 | 15 days ago</span>
                                        </div>
                                    </div>
                                </div>
                                <span class="thumb-icon"><i class="fa-regular fa-thumbs-up"></i>Yes,Recommend for
                                    Appointment</span>
                            </div>
                            <p>Great article! I've bookmarked it for future reference. I'd love to read more about managing
                                long-term relationships with freelancers, if you have any tips on that.
                            </p>
                            <a href="#" class="reply d-flex align-items-center"><i
                                    class="fa-solid fa-reply me-2"></i>Reply</a>
                            <div class="replied-info">
                                <div class="user-info-review">
                                    <div class="reviewer-img">
                                        <a href="#" class="avatar-img"><img
                                                src="{{ asset('frontend/xx/assets/img/clients/client-16.jpg') }}"
                                                alt="Img"></a>
                                        <div class="review-star">
                                            <a href="#">Robert Hollenbeck</a>
                                        </div>
                                    </div>
                                </div>
                                <p>Thank you for your comment and I will try to make a another post on that topic.
                                </p>
                                <a href="#" class="reply d-flex align-items-center"><i
                                        class="fa-solid fa-reply me-2"></i>Reply</a>
                            </div>
                            <!-- Pagination -->
                            <div class="pagination dashboard-pagination">
                                <ul>
                                    <li>
                                        <a href="#" class="page-link prev-link"><i
                                                class="fa-solid fa-chevron-left me-2"></i>Prev</a>
                                    </li>
                                    <li>
                                        <a href="#" class="page-link active">1</a>
                                    </li>
                                    <li>
                                        <a href="#" class="page-link">2</a>
                                    </li>
                                    <li>
                                        <a href="#" class="page-link">3</a>
                                    </li>
                                    <li>
                                        <a href="#" class="page-link">4</a>
                                    </li>
                                    <li>
                                        <a href="#" class="page-link">5</a>
                                    </li>
                                    <li>
                                        <a href="#" class="page-link">6</a>
                                    </li>
                                    <li>
                                        <a href="#" class="page-link next-link">Next<i
                                                class="fa-solid fa-chevron-right ms-2"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /Pagination -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
