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
                            <li class="breadcrumb-item active">Experience</li>
                        </ol>
                        <h2 class="breadcrumb-title">Doctor Experience</h2>
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
                                    <a class="nav-link active" href="{{ route('doctor.experience.index') }}">Experience</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('doctor.education.index') }}">Education</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('doctor.awards.index') }}">Awards</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('doctor.insurance.index') }}">Insurances</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('doctor.clinics.index') }}">Clinics</a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    <!-- /Settings List -->

                    <div class="dashboard-header border-0 mb-0">
                        <h3>Experience</h3>
                        <ul>
                            <li>
                                <button type="button" class="btn btn-primary prime-btn add-experience" 
                                        data-bs-toggle="modal" data-bs-target="#experienceModal">
                                    <i class="fa-solid fa-plus me-1"></i> Add New Experience
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- قائمة الخبرات -->
                    <div class="accordions experience-infos" id="experienceAccordion">
                        @forelse($experiences as $index => $experience)
                            <div class="user-accordion-item" id="experience-{{ $experience->id }}">
                                <a href="#" class="accordion-wrap @if($index !== 0) collapsed @endif" 
                                   data-bs-toggle="collapse" 
                                   data-bs-target="#experienceCollapse{{ $experience->id }}">
                                    <span>
                                        {{ $experience->hospital_name }}, {{ $experience->location }}
                                        ({{ $experience->duration }})
                                    </span>
                                    <span class="actions">
                                        <button type="button" class="btn-edit btn-sm btn-link text-primary me-2"
                                                data-id="{{ $experience->id }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn-delete btn-sm btn-link text-danger"
                                                data-id="{{ $experience->id }}"
                                                data-name="{{ $experience->hospital_name }}">
                                            Delete
                                        </button>
                                    </span>
                                </a>
                                <div class="accordion-collapse collapse @if($index === 0) show @endif" 
                                     id="experienceCollapse{{ $experience->id }}" 
                                     data-bs-parent="#experienceAccordion">
                                    <div class="content-collapse">
                                        <div class="add-service-info">
                                            <div class="row">
                                                @if($experience->hospital_logo)
                                                    <div class="col-md-12 mb-3">
                                                        <div class="hospital-logo">
                                                            <img src="{{ $experience->hospital_logo_url }}" 
                                                                 alt="{{ $experience->hospital_name }}" 
                                                                 style="max-height: 100px;">
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-md-6">
                                                    <strong>Position:</strong> {{ $experience->title ?: 'Not specified' }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Employment Type:</strong> {{ $experience->employment_type }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Years of Experience:</strong> {{ $experience->years_of_experience }} years
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Status:</strong> 
                                                    <span class="badge bg-{{ $experience->is_current ? 'success' : 'secondary' }}">
                                                        {{ $experience->is_current ? 'Current' : 'Past' }}
                                                    </span>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <strong>Description:</strong>
                                                    <p class="mb-0">{{ $experience->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                <i class="fa-solid fa-info-circle me-2"></i>
                                No experience records found. Click "Add New Experience" to add your first experience.
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Modal لإضافة/تعديل خبرة -->
    <div class="modal fade" id="experienceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add New Experience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="experienceForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- Hospital Logo -->
                            <div class="col-md-12">
                                <div class="form-wrap mb-3">
                                    <div class="change-avatar img-upload">
                                        <div class="profile-img" id="logoPreview">
                                            <i class="fa-solid fa-hospital"></i>
                                        </div>
                                        <div class="upload-img">
                                            <h5>Hospital Logo</h5>
                                            <div class="imgs-load d-flex align-items-center">
                                                <div class="change-photo">
                                                    <label for="hospital_logo" style="cursor: pointer;">
                                                        Upload New
                                                    </label>
                                                    <input type="file" id="hospital_logo" class="d-none" 
                                                           name="hospital_logo" accept="image/*">
                                                </div>
                                                <a href="#" class="upload-remove ms-2 d-none" id="removeLogo">Remove</a>
                                            </div>
                                            <p class="form-text">Your Image should Below 2 MB, Accepted format jpg,png,svg</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Title (e.g., Senior Surgeon)</label>
                                    <input type="text" class="form-control" name="title" id="title">
                                </div>
                            </div>

                            <!-- Hospital Name -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Hospital/Clinic Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="hospital_name" id="hospital_name" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Location <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="location" id="location" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <!-- Employment Type -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Employment Type</label>
                                    <select class="form-select" name="employment_type" id="employment_type">
                                        <option value="Full Time">Full Time</option>
                                        <option value="Part Time">Part Time</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Start Date -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Start Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="start_date" id="start_date" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <!-- End Date -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">End Date</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date">
                                    <small class="text-muted">Leave empty if current position</small>
                                </div>
                            </div>

                            <!-- Currently Working Here -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" 
                                               name="is_current" id="is_current" value="1">
                                        <label class="form-check-label" for="is_current">
                                            I Currently Work Here
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Years of Experience -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Years of Experience</label>
                                    <input type="number" class="form-control" 
                                           name="years_of_experience" id="years_of_experience" 
                                           min="0" max="60" step="0.5">
                                    <small class="text-muted">Leave empty for auto-calculation</small>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <div class="form-wrap">
                                    <label class="form-label">Job Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" 
                                              id="description" rows="4" required></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="experience_id" name="experience_id">
                        <button type="button" class="btn btn-gray" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary prime-btn">
                            <span id="submitText">Save Experience</span>
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
    let currentExperienceId = null;

    // Initialize modal
    const experienceModal = new bootstrap.Modal(document.getElementById('experienceModal'));

    // إضافة خبرة جديدة
    $('.add-experience').click(function() {
        resetForm();
        $('#modalTitle').text('Add New Experience');
        experienceModal.show();
    });

    // تعديل خبرة
    $(document).on('click', '.btn-edit', function() {
        const experienceId = $(this).data('id');
        
        $.ajax({
            url: '{{ route("doctor.experience.show", "") }}/' + experienceId,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    const exp = response.experience;
                    currentExperienceId = exp.id;
                    
                    // ملء النموذج
                    $('#experience_id').val(exp.id);
                    $('#title').val(exp.title || '');
                    $('#hospital_name').val(exp.hospital_name);
                    $('#location').val(exp.location);
                    $('#employment_type').val(exp.employment_type);
                    $('#description').val(exp.description);
                    $('#years_of_experience').val(exp.years_of_experience);
                    
                    // تواريخ
                    $('#start_date').val(exp.start_date);
                    if (exp.end_date) {
                        $('#end_date').val(exp.end_date);
                    }
                    
                    // الحالية
                    if (exp.is_current) {
                        $('#is_current').prop('checked', true);
                        $('#end_date').prop('disabled', true);
                    }
                    
                    // صورة المستشفى
                    if (exp.hospital_logo_url) {
                        $('#logoPreview').html(
                            `<img src="${exp.hospital_logo_url}" 
                                  style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`
                        );
                        $('#removeLogo').removeClass('d-none');
                    }
                    
                    $('#modalTitle').text('Edit Experience');
                    experienceModal.show();
                }
            },
            error: function() {
                alert('Failed to load experience data');
            }
        });
    });

    // حذف خبرة
    $(document).on('click', '.btn-delete', function() {
        const experienceId = $(this).data('id');
        const experienceName = $(this).data('name');
        
        if (confirm(`Are you sure you want to delete "${experienceName}"?`)) {
            $.ajax({
                url: '{{ route("doctor.experience.destroy", "") }}/' + experienceId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    if (response.success) {
                        $(`#experience-${experienceId}`).remove();
                        showAlert(response.message, 'success');
                        
                        // إذا لم يعد هناك خبرات
                        if ($('.user-accordion-item').length === 0) {
                            $('#experienceAccordion').html(`
                                <div class="alert alert-info">
                                    <i class="fa-solid fa-info-circle me-2"></i>
                                    No experience records found. Click "Add New Experience" to add your first experience.
                                </div>
                            `);
                        }
                    }
                },
                error: function() {
                    showAlert('Failed to delete experience', 'error');
                }
            });
        }
    });

   // معالجة النموذج
$('#experienceForm').submit(function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitBtn = $('#submitText');
    const spinner = $('#submitSpinner');
    const experienceId = $('#experience_id').val();
    
    // تحديد الـ URL بناءً على ما إذا كان تعديلاً أو إضافة جديدة
    let url, method;
    
    if (experienceId) {
        // للتحديث: استخدم مسار store مع experience_id
        url =  `/doctor/experience/${experienceId}/update`;
        method = 'POST';
        formData.append('experience_id', experienceId);
    } else {
        // للإضافة الجديدة
        url = '/doctor/experience';
        method = 'POST';
    }
    
    submitBtn.addClass('d-none');
    spinner.removeClass('d-none');
    
    $.ajax({
        url: url,
        method: method,
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function(response) {
            if (response.success) {
                showAlert(response.message, 'success');
                experienceModal.hide();
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            }
        },
error: function(xhr) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                clearErrors();
                
                for (const field in errors) {
                    const input = $(`[name="${field}"]`);
                    input.addClass('is-invalid');
                    input.after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
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
    // Currently working checkbox handler
    $('#is_current').change(function() {
        if ($(this).is(':checked')) {
            $('#end_date').val('').prop('disabled', true);
        } else {
            $('#end_date').prop('disabled', false);
        }
    });

    // Preview hospital logo
    $('#hospital_logo').change(function(e) {
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
        $('#hospital_logo').val('');
        $('#logoPreview').html('<i class="fa-solid fa-hospital"></i>');
        $(this).addClass('d-none');
    });

    // Helper functions
    function resetForm() {
        currentExperienceId = null;
        $('#experienceForm')[0].reset();
        $('#experience_id').val('');
        $('#logoPreview').html('<i class="fa-solid fa-hospital"></i>');
        $('#removeLogo').addClass('d-none');
        clearErrors();
        $('#end_date').prop('disabled', false);
        $('#is_current').prop('checked', false);
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