@extends('frontend.layouts.master')

@section('content')
<div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center inner-banner">
            <div class="text-center col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"><i class="isax isax-home-15"></i></a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">Doctor</li>
                        <li class="breadcrumb-item active">Appointments</li>
                    </ol>
                    <h2 class="breadcrumb-title">Appointments</h2>
                </nav>
            </div>
        </div>
    </div>
    <div class="breadcrumb-bg">
        <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-01.png') }}" alt="img" class="breadcrumb-bg-01" />
        <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-02.png') }}" alt="img" class="breadcrumb-bg-02" />
        <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img" class="breadcrumb-bg-03" />
        <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img" class="breadcrumb-bg-04" />
    </div>
</div>

<div class="content doctor-content">
    <div class="content">
        <div class="container">
            <div class="row">
                @include('doctor.layouts.slide')
                
                <div class="col-lg-8 col-xl-9">
                    <div class="dashboard-header">
                        <h3>Requests</h3>
                        <ul>
                            <li>
                                <div class="dropdown header-dropdown">
                                    <a class="dropdown-toggle nav-tog" data-bs-toggle="dropdown" href="javascript:void(0);">
                                        @if ($filter === 'today')
                                            Today
                                        @elseif($filter === 'this_month')
                                            This Month
                                        @else
                                            Last 7 Days
                                        @endif
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="?filter=today" class="dropdown-item">Today</a>
                                        <a href="?filter=this_month" class="dropdown-item">This Month</a>
                                        <a href="?filter=last_7_days" class="dropdown-item">Last 7 Days</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Request List -->
                    <div id="appointments-container">
                        @if ($appointments->count() > 0)
                            @foreach ($appointments as $appointment)
                                @include('doctor.requests.partials.appointment-item', [
                                    'appointment' => $appointment,
                                ])
                            @endforeach
                        @else
                            <div class="py-5 text-center appointment-wrap">
                                <p class="text-muted">No appointment requests found</p>
                            </div>
                        @endif
                    </div>

                    @if ($appointments->count() >= 5)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center loader-item">
                                    <a href="javascript:void(0);" class="btn btn-load" id="load-more-btn">Load More</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Appointment Accepted Modal -->
<div class="modal fade" id="accept_appointment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center success-wrap">
                    <span class="icon-success"><i class="fa-solid fa-calendar-check"></i></span>
                    <h3>Appointment Accepted</h3>
                    <p id="accepted-date-text">Your Appointment has been scheduled</p>
                    <a href="{{ route('doctor.appointments.index') }}" class="btn btn-primary prime-btn">Go to Appointments</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Appointment Cancel Modal -->
<div class="modal fade" id="cancel_appointment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="success-wrap">
                    <div class="success-info">
                        <div class="text-center">
                            <span class="icon-success bg-red"><i class="fa-solid fa-xmark"></i></span>
                            <h3>Are you Sure</h3>
                            <p>Do you want to Cancel Appointment</p>
                        </div>
                        <form id="reject-form">
                            @csrf
                            <input type="hidden" name="appointment_id" id="reject-appointment-id">
                            <div class="form-wrap">
                                <label class="col-form-label">Cancel Reason <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="cancellation_reason" rows="4" required></textarea>
                            </div>
                            <div class="form-wrap">
                                <div class="custom-control form-check custom-control-inline">
                                    <input type="radio" id="reshedule" name="refund_option" value="reschedule" class="form-check-input" checked>
                                    <label class="form-check-label" for="reshedule">Cancel with Reschedule</label>
                                </div>
                            </div>
                            <div class="form-wrap">
                                <div class="custom-control form-check custom-control-inline">
                                    <input type="radio" id="refund" name="refund_option" value="refund" class="form-check-input">
                                    <label class="form-check-label" for="refund">Cancel with Request Refund</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-button">
                        <div class="row gx-3">
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-gray w-100" data-bs-dismiss="modal">No, I change my mind</button>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-primary prime-btn w-100" id="confirm-reject-btn">Confirm Reject</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><script>
document.addEventListener('DOMContentLoaded', function() {
    let offset = {{ $appointments->count() }};
    const limit = 5;
    let acceptModal = null;
    let rejectModal = null;

    // Initialize modals
    if (document.getElementById('accept_appointment')) {
        acceptModal = new bootstrap.Modal(document.getElementById('accept_appointment'));
    }
    if (document.getElementById('cancel_appointment')) {
        rejectModal = new bootstrap.Modal(document.getElementById('cancel_appointment'));
    }

    // Accept appointment
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('accept-link') || e.target.closest('.accept-link')) {
            e.preventDefault();
            const target = e.target.classList.contains('accept-link') ? e.target : e.target.closest('.accept-link');
            const appointmentId = target.dataset.appointmentId;
            acceptAppointment(appointmentId, target);
        }
        
        if (e.target.classList.contains('reject-link') || e.target.closest('.reject-link')) {
            e.preventDefault();
            const target = e.target.classList.contains('reject-link') ? e.target : e.target.closest('.reject-link');
            const appointmentId = target.dataset.appointmentId;
            document.getElementById('reject-appointment-id').value = appointmentId;
            if (rejectModal) {
                rejectModal.show();
            }
        }
    });

    function acceptAppointment(appointmentId, element) {
        const appointmentItem = element.closest('.appointment-wrap');
        
        // إظهار loading state
        const originalText = element.innerHTML;
        element.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';
        element.style.pointerEvents = 'none';

        fetch(`/doctor/requests/${appointmentId}/accept`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: JSON.stringify({_method: 'POST'})
        })
        .then(response => {
            // معالجة مختلف رموز الاستجابة
            if (response.status === 422) {
                return response.json().then(data => {
                    throw new Error(data.message || 'Validation failed');
                });
            }
            if (response.status === 404) {
                throw new Error('Appointment not found');
            }
            if (response.status === 500) {
                throw new Error('Server error occurred');
            }
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // تحديث نص المودال
                const dateText = document.getElementById('accepted-date-text');
                if (dateText && data.data.scheduled_date) {
                    dateText.textContent = `Your Appointment has been scheduled on ${data.data.scheduled_date}`;
                }
                
                // إظهار مودال القبول
                if (acceptModal) {
                    acceptModal.show();
                }
                
                // إزالة العنصر من القائمة
                if (appointmentItem) {
                    appointmentItem.remove();
                }
                
                // تحديث العداد
                updateAppointmentCount();
            } else {
                showError(data.message || 'Failed to accept appointment');
                // استعادة الحالة الأصلية
                resetElementState(element, originalText);
            }
        })
        .catch(error => {
            console.error('Accept Error:', error);
            showError(error.message || 'Failed to accept appointment. Please try again.');
            // استعادة الحالة الأصلية
            resetElementState(element, originalText);
        });
    }

    // Confirm reject button
    document.getElementById('confirm-reject-btn')?.addEventListener('click', function() {
        const form = document.getElementById('reject-form');
        const formData = new FormData(form);
        const appointmentId = document.getElementById('reject-appointment-id').value;
        const appointmentItem = document.querySelector(`[data-appointment-id="${appointmentId}"]`)?.closest('.appointment-wrap');

        // التحقق من صحة الفورم
        const cancellationReason = formData.get('cancellation_reason');
        if (!cancellationReason || cancellationReason.trim() === '') {
            showError('Please provide a cancellation reason');
            return;
        }

        // إظهار loading state
        const btn = this;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';
        btn.disabled = true;

        fetch(`/doctor/requests/${appointmentId}/reject`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => {
            if (response.status === 422) {
                return response.json().then(data => {
                    throw new Error(data.message || 'Validation failed');
                });
            }
            if (response.status === 404) {
                throw new Error('Appointment not found');
            }
            if (response.status === 500) {
                throw new Error('Server error occurred');
            }
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                if (rejectModal) {
                    rejectModal.hide();
                }
                
                // إزالة العنصر
                if (appointmentItem) {
                    appointmentItem.remove();
                }
                
                // إعادة تعيين الفورم
                form.reset();
                
                // تحديث العداد
                updateAppointmentCount();
                
                showSuccess('Appointment rejected successfully');
            } else {
                showError(data.message || 'Failed to reject appointment');
            }
            resetElementState(btn, originalText);
        })
        .catch(error => {
            console.error('Reject Error:', error);
            showError(error.message || 'Failed to reject appointment. Please try again.');
            resetElementState(btn, originalText);
        });
    });

    // Helper functions
    function resetElementState(element, originalText) {
        element.innerHTML = originalText;
        element.style.pointerEvents = 'auto';
        if (element.disabled !== undefined) {
            element.disabled = false;
        }
    }

    function showError(message) {
        // يمكنك استخدام toast notification أو alert محسن
        alert('Error: ' + message);
    }

    function showSuccess(message) {
        alert('Success: ' + message);
    }

    function updateAppointmentCount() {
        const remainingAppointments = document.querySelectorAll('.appointment-wrap').length;
        if (remainingAppointments === 0) {
            const header = document.querySelector('.dashboard-header h3');
            if (header) {
                header.textContent = 'No Pending Requests';
            }
            
            const loadMoreBtn = document.getElementById('load-more-btn');
            if (loadMoreBtn) {
                loadMoreBtn.style.display = 'none';
            }
        }
    }

    // Load more functionality (نفس الكود السابق)
    document.getElementById('load-more-btn')?.addEventListener('click', function() {
        const btn = this;
        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Loading...';

        fetch('{{ route("doctor.doctor.requests.load-more") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                offset: offset
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.html) {
                const container = document.getElementById('appointments-container');
                container.insertAdjacentHTML('beforeend', data.html);
                offset += data.html ? (data.html.match(/appointment-wrap/g) || []).length : 0;

                if (!data.has_more) {
                    btn.style.display = 'none';
                }
            }
            btn.disabled = false;
            btn.innerHTML = 'Load More';
        })
        .catch(error => {
            console.error('Error:', error);
            btn.disabled = false;
            btn.innerHTML = 'Load More';
            alert('Failed to load more appointments');
        });
    });

    // تنظيف الـ event listeners عند إغلاق المودال
    document.getElementById('cancel_appointment')?.addEventListener('hidden.bs.modal', function() {
        document.getElementById('reject-form').reset();
    });
});
</script>
@endsection

