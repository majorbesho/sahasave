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
                            <li class="breadcrumb-item" aria-current="page">Doctor</li>
                            <li class="breadcrumb-item active">Insurances</li>
                        </ol>
                        <h2 class="breadcrumb-title">Doctor Insurances</h2>
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
    <div class="content doctor-content">
        <div class="container">
            <div class="row">
                @include('doctor.layouts.slide')

                <div class="col-lg-8 col-xl-9">
                    <!-- Profile Settings -->
                    <div class="dashboard-header">
                        <h3>Profile Settings</h3>
                    </div>

                    <!-- Settings List -->
                    <div class="setting-tab">
                        <div class="appointment-tabs">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('doctor.profile.edit') }}">Basic Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('doctor.experience.index') }}">Experience</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('doctor.education.index') }}">Education</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('doctor.awards.index') }}">Awards</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('doctor.insurance.index') }}">Insurances</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('doctor.clinics.index') }}">Clinics</a>
                                </li>
                               
                            </ul>
                        </div>
                    </div>
                    <!-- /Settings List -->

                    <div class="dashboard-header border-0 mb-0">
                        <h3>Insurance</h3>
                        <ul>
                            <li>
                                <button type="button" class="btn btn-primary prime-btn add-insurance" 
                                        data-bs-toggle="modal" data-bs-target="#insuranceModal">
                                    <i class="fa-solid fa-plus me-1"></i> Add New Insurance
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- قائمة التأمينات -->
                    <div class="accordions insurance-infos" id="insuranceAccordion">
                        @forelse($insurances as $index => $insurance)
                            <div class="user-accordion-item" id="insurance-{{ $insurance->id }}">
                                <a href="#" class="accordion-wrap @if($index !== 0) collapsed @endif" 
                                   data-bs-toggle="collapse" 
                                   data-bs-target="#insuranceCollapse{{ $insurance->id }}">
                                    <span>
                                        {{ $insurance->insurance_name }}
                                        @if($insurance->insurance_company)
                                            ({{ $insurance->insurance_company }})
                                        @endif
                                        <span class="badge ms-2 bg-{{ $insurance->is_current && $insurance->is_active ? 'success' : 'danger' }}">
                                            {{ $insurance->is_current && $insurance->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </span>
                                    <span class="actions">
                                        <button type="button" class="btn-edit btn-sm btn-link text-primary me-2"
                                                data-id="{{ $insurance->id }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn-delete btn-sm btn-link text-danger"
                                                data-id="{{ $insurance->id }}"
                                                data-name="{{ $insurance->insurance_name }}">
                                            Delete
                                        </button>
                                    </span>
                                </a>
                                <div class="accordion-collapse collapse @if($index === 0) show @endif" 
                                     id="insuranceCollapse{{ $insurance->id }}" 
                                     data-bs-parent="#insuranceAccordion">
                                    <div class="content-collapse">
                                        <div class="add-service-info">
                                            <div class="row">
                                                @if($insurance->insurance_logo)
                                                    <div class="col-md-12 mb-3">
                                                        <div class="insurance-logo">
                                                            <img src="{{ $insurance->insurance_logo_url }}" 
                                                                 alt="{{ $insurance->insurance_name }}" 
                                                                 style="max-height: 80px;">
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-md-6">
                                                    <strong>Insurance Company:</strong> {{ $insurance->insurance_company ?: 'Not specified' }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Policy Number:</strong> {{ $insurance->policy_number ?: 'Not specified' }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Coverage Period:</strong> {{ $insurance->coverage_period }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Status:</strong> 
                                                    @if($insurance->is_current && $insurance->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @elseif(!$insurance->is_current)
                                                        <span class="badge bg-danger">Expired</span>
                                                    @else
                                                        <span class="badge bg-warning">Inactive</span>
                                                    @endif
                                                </div>
                                                @if($insurance->contact_number)
                                                    <div class="col-md-6">
                                                        <strong>Contact Number:</strong> {{ $insurance->contact_number }}
                                                    </div>
                                                @endif
                                                @if($insurance->website_url)
                                                    <div class="col-md-6">
                                                        <strong>Website:</strong> 
                                                        <a href="{{ $insurance->website_url }}" target="_blank" class="text-primary">
                                                            Visit Website
                                                        </a>
                                                    </div>
                                                @endif
                                                @if($insurance->coverage_details)
                                                    <div class="col-12 mt-3">
                                                        <strong>Coverage Details:</strong>
                                                        <p class="mb-0">{{ $insurance->coverage_details }}</p>
                                                    </div>
                                                @endif
                                                @if($insurance->terms_and_conditions)
                                                    <div class="col-12 mt-3">
                                                        <strong>Terms & Conditions:</strong>
                                                        <p class="mb-0">{{ $insurance->terms_and_conditions }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                <i class="fa-solid fa-info-circle me-2"></i>
                                No insurance records found. Click "Add New Insurance" to add your first insurance.
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Modal لإضافة/تعديل تأمين -->
    <div class="modal fade" id="insuranceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add New Insurance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="insuranceForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- Insurance Logo -->
                            <div class="col-md-12">
                                <div class="form-wrap mb-3">
                                    <div class="change-avatar img-upload">
                                        <div class="profile-img" id="logoPreview">
                                            <i class="fa-solid fa-shield-halved"></i>
                                        </div>
                                        <div class="upload-img">
                                            <h5>Insurance Logo</h5>
                                            <div class="imgs-load d-flex align-items-center">
                                                <div class="change-photo">
                                                    <label for="insurance_logo" style="cursor: pointer;">
                                                        Upload New
                                                    </label>
                                                    <input type="file" id="insurance_logo" class="d-none" 
                                                           name="insurance_logo" accept="image/*">
                                                </div>
                                                <a href="#" class="upload-remove ms-2 d-none" id="removeLogo">Remove</a>
                                            </div>
                                            <p class="form-text">Your Image should Below 2 MB, Accepted format jpg,png,svg</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Insurance Name -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Insurance Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="insurance_name" id="insurance_name" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <!-- Insurance Company -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Insurance Company</label>
                                    <input type="text" class="form-control" name="insurance_company" id="insurance_company">
                                </div>
                            </div>

                            <!-- Policy Number -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Policy Number</label>
                                    <input type="text" class="form-control" name="policy_number" id="policy_number">
                                </div>
                            </div>

                            <!-- Coverage Start Date -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Coverage Start Date</label>
                                    <input type="date" class="form-control" name="coverage_start_date" id="coverage_start_date">
                                </div>
                            </div>

                            <!-- Coverage End Date -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Coverage End Date</label>
                                    <input type="date" class="form-control" name="coverage_end_date" id="coverage_end_date">
                                    <small class="text-muted">Leave empty for ongoing coverage</small>
                                </div>
                            </div>

                            <!-- Active Status -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" 
                                               name="is_active" id="is_active" value="1" checked>
                                        <label class="form-check-label" for="is_active">
                                            Active Insurance
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Number -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" name="contact_number" id="contact_number">
                                </div>
                            </div>

                            <!-- Website URL -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Website URL</label>
                                    <input type="url" class="form-control" name="website_url" id="website_url">
                                </div>
                            </div>

                            <!-- Coverage Details -->
                            <div class="col-12">
                                <div class="form-wrap">
                                    <label class="form-label">Coverage Details</label>
                                    <textarea class="form-control" name="coverage_details" 
                                              id="coverage_details" rows="3"
                                              placeholder="Describe what services are covered, limits, etc..."></textarea>
                                </div>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="col-12">
                                <div class="form-wrap">
                                    <label class="form-label">Terms & Conditions</label>
                                    <textarea class="form-control" name="terms_and_conditions" 
                                              id="terms_and_conditions" rows="3"
                                              placeholder="Any special terms or conditions..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="insurance_id" name="insurance_id">
                        <button type="button" class="btn btn-gray" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary prime-btn">
                            <span id="submitText">Save Insurance</span>
                            <span id="submitSpinner" class="spinner-border spinner-border-sm d-none"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    let currentInsuranceId = null;

    // Initialize modal
    const insuranceModal = new bootstrap.Modal(document.getElementById('insuranceModal'));

    // إضافة تأمين جديد
    $('.add-insurance').click(function() {
        resetForm();
        $('#modalTitle').text('Add New Insurance');
        insuranceModal.show();
    });

    // تعديل تأمين
    $(document).on('click', '.btn-edit', function() {
        const insuranceId = $(this).data('id');
        
        $.ajax({
            url: '{{ route("doctor.insurance.show", "") }}/' + insuranceId,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    const insurance = response.insurance;
                    currentInsuranceId = insurance.id;
                    
                    // ملء النموذج
                    $('#insurance_id').val(insurance.id);
                    $('#insurance_name').val(insurance.insurance_name);
                    $('#insurance_company').val(insurance.insurance_company || '');
                    $('#policy_number').val(insurance.policy_number || '');
                    $('#coverage_details').val(insurance.coverage_details || '');
                    $('#terms_and_conditions').val(insurance.terms_and_conditions || '');
                    $('#contact_number').val(insurance.contact_number || '');
                    $('#website_url').val(insurance.website_url || '');
                    
                    // التواريخ
                    if (insurance.coverage_start_date) {
                        $('#coverage_start_date').val(insurance.coverage_start_date);
                    }
                    if (insurance.coverage_end_date) {
                        $('#coverage_end_date').val(insurance.coverage_end_date);
                    }
                    
                    // الحالة النشطة
                    if (insurance.is_active) {
                        $('#is_active').prop('checked', true);
                    }
                    
                    // صورة التأمين
                    if (insurance.insurance_logo_url) {
                        $('#logoPreview').html(
                            `<img src="${insurance.insurance_logo_url}" 
                                  style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`
                        );
                        $('#removeLogo').removeClass('d-none');
                    }
                    
                    $('#modalTitle').text('Edit Insurance');
                    insuranceModal.show();
                }
            },
            error: function() {
                alert('Failed to load insurance data');
            }
        });
    });

    // حذف تأمين
    $(document).on('click', '.btn-delete', function() {
        const insuranceId = $(this).data('id');
        const insuranceName = $(this).data('name');
        
        if (confirm(`Are you sure you want to delete "${insuranceName}"?`)) {
            $.ajax({
                url: '{{ route("doctor.insurance.destroy", "") }}/' + insuranceId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    if (response.success) {
                        $(`#insurance-${insuranceId}`).remove();
                        showAlert(response.message, 'success');
                        
                        // إذا لم يعد هناك تأمينات
                        if ($('.user-accordion-item').length === 0) {
                            $('#insuranceAccordion').html(`
                                <div class="alert alert-info">
                                    <i class="fa-solid fa-info-circle me-2"></i>
                                    No insurance records found. Click "Add New Insurance" to add your first insurance.
                                </div>
                            `);
                        }
                    }
                },
                error: function() {
                    showAlert('Failed to delete insurance', 'error');
                }
            });
        }
    });

    // معالجة النموذج
    $('#insuranceForm').submit(function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitBtn = $('#submitText');
        const spinner = $('#submitSpinner');
        
        submitBtn.addClass('d-none');
        spinner.removeClass('d-none');
        
        $.ajax({
            url: '/doctor/insurance/store',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                if (response.success) {
                    showAlert(response.message, 'success');
                    insuranceModal.hide();
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // أخطاء التحقق
                    const errors = xhr.responseJSON.errors;
                    clearErrors();
                    
                    for (const field in errors) {
                        const input = $(`[name="${field}"]`);
                        const feedback = input.next('.invalid-feedback') || 
                                        input.parent().find('.invalid-feedback');
                        
                        input.addClass('is-invalid');
                        if (feedback.length) {
                            feedback.text(errors[field][0]);
                        } else {
                            input.after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
                        }
                    }
                    
                    showAlert(xhr.responseJSON.message, 'error');
                } else {
                    showAlert(xhr.responseJSON?.message || 'An error occurred', 'error');
                }
            },
            complete: function() {
                submitBtn.removeClass('d-none');
                spinner.addClass('d-none');
            }
        });
    });

    // Preview insurance logo
    $('#insurance_logo').change(function(e) {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#logoPreview').html(
                    `<img src="${e.target.result}" 
                          style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`
                );
                $('#removeLogo').removeClass('d-none');
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Remove logo
    $('#removeLogo').click(function(e) {
        e.preventDefault();
        $('#insurance_logo').val('');
        $('#logoPreview').html('<i class="fa-solid fa-shield-halved"></i>');
        $(this).addClass('d-none');
    });

    // Helper functions
    function resetForm() {
        currentInsuranceId = null;
        $('#insuranceForm')[0].reset();
        $('#insurance_id').val('');
        $('#logoPreview').html('<i class="fa-solid fa-shield-halved"></i>');
        $('#removeLogo').addClass('d-none');
        clearErrors();
        $('#is_active').prop('checked', true);
    }

    function clearErrors() {
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
    }

    function showAlert(message, type) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const alertHtml = `
            <div class="alert ${alertClass} alert-dismissible fade show position-fixed" 
                 style="top: 20px; right: 20px; z-index: 1050; min-width: 300px;">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        $('body').append(alertHtml);
        
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    }
});
</script>
@endsection