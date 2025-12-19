<div class="appointment-wrap">
    <ul>
        <li>
            <div class="patinet-information">
                <a href="{{ route('patient.profile', $appointment->patient->id) }}">
                    <img src="{{ asset($appointment->patient->photo ?? 'assets/img/doctors-dashboard/profile-01.jpg') }}"
                        alt="User Image">
                </a>
                <div class="patient-info">
                    <p>{{ $appointment->appointment_number }}</p>
                    <h6>
                        <a href="{{ route('patient.profile', $appointment->patient->id) }}">
                            {{ $appointment->patient->name }}
                        </a>
                        @if ($appointment->created_at->diffInDays(now()) <= 1)
                            <span class="badge new-tag">New</span>
                        @endif
                    </h6>
                </div>
            </div>
        </li>
        <li class="appointment-info">
            <p><i class="isax isax-clock5"></i>{{ $appointment->scheduled_for->format('d M Y h.i A') }}</p>
            <p class="md-text">{{ $appointment->service_type ?? 'General Visit' }}</p>
        </li>
        <li class="appointment-type">
            <p class="md-text">Type of Appointment</p>
            <p>
                @if ($appointment->type === 'video_call')
                    <i class="isax isax-video5 text-blue"></i>Video Call
                @elseif($appointment->type === 'audio_call')
                    <i class="isax isax-call5 text-indigo"></i>Audio Call
                @elseif($appointment->type === 'direct_visit')
                    <i class="isax isax-building5 text-green"></i>Direct Visit
                    @if ($appointment->medicalCenter)
                        <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip"
                            title="{{ $appointment->medicalCenter->name }}"></i>
                    @endif
                @else
                    <i class="isax isax-clock5"></i>{{ $appointment->type }}
                @endif
            </p>
        </li>
        <li>
            <ul class="request-action">
                <li>
                    <a href="#" class="accept-link" data-bs-toggle="modal"
                        data-appointment-id="{{ $appointment->id }}">
                        <i class="fa-solid fa-check"></i>Accept
                    </a>
                </li>
                <li>
                    <a href="#" class="reject-link" data-bs-toggle="modal" data-bs-target="#cancel_appointment"
                        data-appointment-id="{{ $appointment->id }}">
                        <i class="fa-solid fa-xmark"></i>Reject
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
