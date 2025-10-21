<!-- Appointment List -->
<div class="appointment-wrap">
    <ul>
        <li>
            <div class="patinet-information">
                <a href="#">
                    <img src="{{ $appointment->patient->photo ?? asset('assets/img/default-avatar.png') }}"
                        alt="User Image" />
                </a>
                <div class="patient-info">
                    <p>#Apt{{ str_pad($appointment->id, 4, '0', STR_PAD_LEFT) }}</p>
                    <h6><a href="#">{{ $appointment->patient->name }}</a></h6>
                </div>
            </div>
        </li>
        <li class="appointment-info">
            <p><i class="isax isax-clock5"></i>
                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('d M Y, h:i A') }}</p>
            <ul class="d-flex apponitment-types">
                <li>{{ ucfirst($appointment->visit_type) }}</li>
                <li>{{ ucfirst($appointment->appointment_type) }} Call</li>
            </ul>
        </li>
        <li class="mail-info-patient">
            <ul>
                <li><i class="isax isax-sms5"></i>{{ $appointment->patient->email }}</li>
                <li><i class="isax isax-call5"></i>{{ $appointment->patient->phone }}</li>
            </ul>
        </li>
        <li class="appointment-action">
            <ul>
                <li><a href="#"><i class="isax isax-eye4"></i></a></li>
                @if ($appointment->status != 'cancelled' && $appointment->status != 'completed')
                    <li>
                        {{-- Form to cancel appointment --}}
                        <form action="#" method="POST">
                            @csrf
                            <button type="submit" class="p-0 btn btn-link"><i
                                    class="isax isax-close-circle5"></i></button>
                        </form>
                    </li>
                @endif
            </ul>
        </li>
        @if ($appointment->status == 'confirmed' && \Carbon\Carbon::parse($appointment->appointment_time)->isToday())
            <li class="appointment-start">
                <a href="#" class="start-link">Start Now</a>
            </li>
        @elseif($appointment->status == 'pending')
            <li class="appointment-start">
                {{-- Form to confirm appointment --}}
                <form action="#" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success">Confirm</button>
                </form>
            </li>
        @endif
    </ul>
</div>
<!-- /Appointment List -->
