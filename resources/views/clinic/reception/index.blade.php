@extends('frontend.layouts.master')

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center inner-banner">
            <div class="text-center col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="isax isax-home-15"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Clinic Admin</li>
                        <li class="breadcrumb-item active">Reception / Booking</li>
                    </ol>
                    <h2 class="breadcrumb-title">Appointment Booking</h2>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<div class="content">
    <div class="container">
        <div class="row">
            
            @include('clinic.layouts.sidebar')

            <div class="col-lg-8 col-xl-9">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">New Appointment</h4>
                            </div>
                            <div class="card-body">
                                <!-- Step 1: Select/Add Patient -->
                                <div id="patient-section" class="mb-4">
                                    <label class="form-label">Patient (Search or Add New)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                        <input type="text" id="patient-search" class="form-control" placeholder="Search by name, phone, or email...">
                                    </div>
                                    <div id="patient-results" class="position-absolute w-100 z-index-1 mt-1 shadow-sm" style="max-height: 200px; overflow-y: auto; background: white; display:none;"></div>
                                    
                                    <div id="selected-patient-display" class="mt-2 p-2 bg-light border rounded" style="display:none;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong id="display-name"></strong><br>
                                                <small id="display-info" class="text-muted"></small>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-link text-danger" onclick="resetPatientSelection()">Change</button>
                                        </div>
                                    </div>

                                    <button class="btn btn-sm btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#newPatientModal">
                                        <i class="fas fa-plus me-1"></i> Add New Patient
                                    </button>
                                </div>

                                <hr>

                                <!-- Step 2: Select Doctor & Date -->
                                <div id="doctor-section" class="mt-3" style="opacity: 0.5; pointer-events: none;">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Select Doctor</label>
                                            <select name="doctor_id" class="form-select" id="doctor-select">
                                                <option value="">Choose...</option>
                                                @foreach($clinic->doctors as $doc)
                                                    <option value="{{ $doc->id }}">Dr. {{ $doc->name }} - {{ $doc->doctorProfile->specialization ?? 'General' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Appointment Date</label>
                                            <input type="date" class="form-control" id="appointment-date" min="{{ now()->format('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 3: Select Time Slot -->
                                <div id="time-section" class="mt-3" style="display:none;">
                                    <label class="form-label">Available Time Slots</label>
                                    <div id="time-slots-container" class="row row-cols-3 g-2">
                                        <!-- Slots will be injected here -->
                                    </div>
                                    <input type="hidden" id="selected-slot" name="scheduled_for">
                                </div>

                                <!-- Step 4: Notes -->
                                <div class="mt-4" id="notes-section" style="opacity: 0.5; pointer-events: none;">
                                    <label class="form-label">Appointment Notes</label>
                                    <textarea class="form-control" rows="3" placeholder="Reason for visit, symptoms, etc." id="notes"></textarea>
                                </div>

                                <div class="mt-4 text-end">
                                    <button class="btn btn-success px-4" id="book-appointment" disabled>
                                        <i class="fas fa-calendar-check me-1"></i> Confirm Booking
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Today's Queue -->
                    <div class="col-lg-5">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Today's Queue</h4>
                                <span class="badge bg-primary rounded-pill">{{ $todayAppointments->count() }}</span>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush">
                                    @forelse($todayAppointments as $appt)
                                        <div class="list-group-item">
                                            <div class="d-flex w-100 justify-content-between align-items-center">
                                                <h6 class="mb-1 text-truncate" style="max-width: 150px;">{{ $appt->patient->name }}</h6>
                                                <small class="text-primary fw-bold">{{ \Carbon\Carbon::parse($appt->scheduled_for)->format('h:i A') }}</small>
                                            </div>
                                            <p class="mb-1 small text-muted">Dr. {{ $appt->doctor->name }}</p>
                                            <div class="d-flex justify-content-between align-items-center mt-2">
                                                <span class="badge badge-pill bg-{{ $appt->status == 'scheduled' ? 'warning' : 'success' }} px-2 py-1">{{ ucfirst($appt->status) }}</span>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-light p-1" type="button" data-bs-toggle="dropdown">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="#">View Details</a></li>
                                                        <li>
                                                            <form action="{{ route('clinic.reception.cancel', ['clinic' => $clinic->id, 'appointment' => $appt->id]) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item text-danger border-0 bg-transparent" onclick="return confirm('Cancel this appointment?')">Cancel Appointment</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="p-4 text-center">
                                            <p class="text-muted">No appointments for today yet.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="card-footer bg-light text-center">
                                <a href="{{ route('clinic.appointments.index', $clinic->id) }}" class="small">View All Appointments</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: New Patient -->
<div class="modal fade" id="newPatientModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Quick Register New Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="new-patient-form">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter patient name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="e.g. +974" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address (Optional)</label>
                        <input type="email" name="email" class="form-control" placeholder="patient@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control" max="{{ now()->format('Y-m-d') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create & Select</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
let selectedPatientId = null;

$(document).ready(function() {
    // Hide results if clicking outside
    $(document).click(function(e) {
        if (!$(e.target).closest('#patient-section').length) {
            $('#patient-results').hide();
        }
    });

    // Patient Search (AJAX)
    $('#patient-search').on('input', function() {
        const q = $(this).val();
        if (q.length < 3) {
            $('#patient-results').hide();
            return;
        }

        $.ajax({
            url: '{{ route("clinic.reception.search-patient", $clinic->id) }}',
            data: { q: q },
            success: function(patients) {
                let html = '';
                if (patients.length > 0) {
                    patients.forEach(p => {
                        html += `
                            <div class="p-2 border-bottom patient-item" style="cursor:pointer;" onclick="selectPatient(${p.id}, '${p.name}', '${p.phone}')">
                                <div class="fw-bold">${p.name}</div>
                                <div class="small text-muted">${p.phone} | ${p.email || 'No email'}</div>
                            </div>`;
                    });
                } else {
                    html = '<div class="p-2 text-muted">No patients found.</div>';
                }
                $('#patient-results').html(html).show();
            }
        });
    });

    // Handle Doctor or Date Change
    $('#appointment-date, #doctor-select').change(function() {
        fetchSlots();
    });

    // Handle Slot Selection
    $(document).on('click', '.time-slot-btn', function() {
        $('.time-slot-btn').removeClass('btn-primary text-white').addClass('btn-outline-primary');
        $(this).removeClass('btn-outline-primary').addClass('btn-primary text-white');
        $('#selected-slot').val($(this).data('value'));
        checkFormReady();
    });

    // Book Appointment Submission
    $('#book-appointment').click(function() {
        const btn = $(this);
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Booking...');

        const data = {
            patient_id: selectedPatientId,
            doctor_id: $('#doctor-select').val(),
            scheduled_for: $('#selected-slot').val(),
            notes: $('#notes').val(),
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: '{{ route("clinic.reception.book", $clinic->id) }}',
            method: 'POST',
            data: data,
            success: function(res) {
                Swal.fire({
                    icon: 'success',
                    title: 'Booked!',
                    text: res.message,
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                btn.prop('disabled', false).html('<i class="fas fa-calendar-check me-1"></i> Confirm Booking');
                const msg = xhr.responseJSON?.message || 'Failed to book appointment.';
                Swal.fire('Error', msg, 'error');
            }
        });
    });

    // New Patient Form Submission
    $('#new-patient-form').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');
        submitBtn.prop('disabled', true).text('Saving...');

        $.ajax({
            url: '{{ route("clinic.reception.store-patient", $clinic->id) }}',
            method: 'POST',
            data: form.serialize(),
            success: function(res) {
                if (res.success) {
                    selectPatient(res.patient.id, res.patient.name, res.patient.phone);
                    $('#newPatientModal').modal('hide');
                    form[0].reset();
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).text('Create & Select');
                let errorMsg = 'Failed to create patient.';
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    errorMsg = Object.values(errors).flat().join('\n');
                }
                alert(errorMsg);
            }
        });
    });
});

function selectPatient(id, name, info) {
    selectedPatientId = id;
    $('#display-name').text(name);
    $('#display-info').text(info);
    
    $('#patient-search').parent().hide();
    $('#patient-results').hide();
    $('#selected-patient-display').show();
    
    // Enable doctor section
    $('#doctor-section').css({'opacity': '1', 'pointer-events': 'auto'});
    checkFormReady();
}

function resetPatientSelection() {
    selectedPatientId = null;
    $('#selected-patient-display').hide();
    $('#patient-search').val('').parent().show();
    $('#doctor-section').css({'opacity': '0.5', 'pointer-events': 'none'});
    $('#time-section').hide();
    $('#notes-section').css({'opacity': '0.5', 'pointer-events': 'none'});
    checkFormReady();
}

function fetchSlots() {
    const doctorId = $('#doctor-select').val();
    const date = $('#appointment-date').val();
    
    if (doctorId && date) {
        $('#time-slots-container').html('<div class="col-12 text-center p-3"><i class="fas fa-spinner fa-spin me-2"></i> Loading slots...</div>');
        $('#time-section').show();

        $.get('{{ route("clinic.reception.slots", $clinic->id) }}', {
            doctor_id: doctorId,
            date: date
        }, function(slots) {
            let html = '';
            if (slots.length > 0) {
                slots.forEach(slot => {
                    const display = moment(slot).format('h:mm A');
                    html += `
                        <div class="col">
                            <button type="button" class="btn btn-outline-primary btn-sm w-100 time-slot-btn" data-value="${slot}">
                                ${display}
                            </button>
                        </div>`;
                });
                $('#notes-section').css({'opacity': '1', 'pointer-events': 'auto'});
            } else {
                html = '<div class="col-12"><div class="alert alert-warning py-2 mb-0">No available slots for this date.</div></div>';
                $('#notes-section').css({'opacity': '0.5', 'pointer-events': 'none'});
            }
            $('#time-slots-container').html(html);
        }).fail(function() {
            $('#time-slots-container').html('<div class="col-12"><div class="alert alert-danger py-2">Error loading slots.</div></div>');
        });
    } else {
        $('#time-section').hide();
    }
    checkFormReady();
}

function checkFormReady() {
    const isReady = selectedPatientId && 
                    $('#doctor-select').val() && 
                    $('#appointment-date').val() && 
                    $('#selected-slot').val();
    
    $('#book-appointment').prop('disabled', !isReady);
}
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
