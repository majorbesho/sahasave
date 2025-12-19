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
                            <li class="breadcrumb-item active">Education</li>
                        </ol>
                        <h2 class="breadcrumb-title">Doctor Education</h2>
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
                                    <a class="nav-link active" href="{{ route('doctor.education.index') }}">Education</a>
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
                        <h3>Education</h3>
                        <ul>
                            <li>
                                <button type="button" class="btn btn-primary prime-btn add-education" 
                                        data-bs-toggle="modal" data-bs-target="#educationModal">
                                    <i class="fa-solid fa-plus me-1"></i> Add New Education
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- قائمة التعليم -->
                    <div class="accordions education-infos" id="educationAccordion">
                        @forelse($educations as $index => $education)
                            <div class="user-accordion-item" id="education-{{ $education->id }}">
                                <a href="#" class="accordion-wrap @if($index !== 0) collapsed @endif" 
                                   data-bs-toggle="collapse" 
                                   data-bs-target="#educationCollapse{{ $education->id }}">
                                    <span>
                                        {{ $education->institution_name }} - {{ $education->course }}
                                        ({{ $education->duration }})
                                    </span>
                                    <span class="actions">
                                        <button type="button" class="btn-edit btn-sm btn-link text-primary me-2"
                                                data-id="{{ $education->id }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn-delete btn-sm btn-link text-danger"
                                                data-id="{{ $education->id }}"
                                                data-name="{{ $education->institution_name }}">
                                            Delete
                                        </button>
                                    </span>
                                </a>
                                <div class="accordion-collapse collapse @if($index === 0) show @endif" 
                                     id="educationCollapse{{ $education->id }}" 
                                     data-bs-parent="#educationAccordion">
                                    <div class="content-collapse">
                                        <div class="add-service-info">
                                            <div class="row">
                                                @if($education->institution_logo)
                                                    <div class="col-md-12 mb-3">
                                                        <div class="institution-logo">
                                                            <img src="{{ $education->institution_logo_url }}" 
                                                                 alt="{{ $education->institution_name }}" 
                                                                 style="max-height: 100px;">
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-md-6">
                                                    <strong>Degree:</strong> {{ $education->degree ?: 'Not specified' }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Field of Study:</strong> {{ $education->field_of_study ?: 'Not specified' }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Years:</strong> {{ $education->years }} years
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Grade:</strong> {{ $education->grade ?: 'Not specified' }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Status:</strong> 
                                                    <span class="badge bg-{{ $education->is_current ? 'success' : 'secondary' }}">
                                                        {{ $education->is_current ? 'Current' : 'Completed' }}
                                                    </span>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <strong>Description:</strong>
                                                    <p class="mb-0">{{ $education->description ?: 'No description provided' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                <i class="fa-solid fa-info-circle me-2"></i>
                                No education records found. Click "Add New Education" to add your first education.
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Modal لإضافة/تعديل تعليم -->
    <div class="modal fade" id="educationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add New Education</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="educationForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- Institution Logo -->
                            <div class="col-md-12">
                                <div class="form-wrap mb-3">
                                    <div class="change-avatar img-upload">
                                        <div class="profile-img" id="logoPreview">
                                            <i class="fa-solid fa-graduation-cap"></i>
                                        </div>
                                        <div class="upload-img">
                                            <h5>Institution Logo</h5>
                                            <div class="imgs-load d-flex align-items-center">
                                                <div class="change-photo">
                                                    <label for="institution_logo" style="cursor: pointer;">
                                                        Upload New
                                                    </label>
                                                    <input type="file" id="institution_logo" class="d-none" 
                                                           name="institution_logo" accept="image/*">
                                                </div>
                                                <a href="#" class="upload-remove ms-2 d-none" id="removeLogo">Remove</a>
                                            </div>
                                            <p class="form-text">Your Image should Below 2 MB, Accepted format jpg,png,svg</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Institution Name -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Institution Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="institution_name" id="institution_name" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <!-- Course -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Course/Program <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="course" id="course" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <!-- Degree -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Degree/Certificate</label>
                                    <input type="text" class="form-control" name="degree" id="degree">
                                </div>
                            </div>

                            <!-- Field of Study -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Field of Study</label>
                                    <input type="text" class="form-control" name="field_of_study" id="field_of_study">
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
                                    <small class="text-muted">Leave empty if currently studying</small>
                                </div>
                            </div>

                            <!-- Currently Studying -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" 
                                               name="is_current" id="is_current" value="1">
                                        <label class="form-check-label" for="is_current">
                                            I am Currently Studying Here
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Years -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Years of Study</label>
                                    <input type="number" class="form-control" 
                                           name="years" id="years" 
                                           min="1" max="10" step="0.5">
                                    <small class="text-muted">Leave empty for auto-calculation</small>
                                </div>
                            </div>

                            <!-- Grade -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Grade/GPA</label>
                                    <input type="text" class="form-control" name="grade" id="grade">
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <div class="form-wrap">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" 
                                              id="description" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="education_id" name="education_id">
                        <button type="button" class="btn btn-gray" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary prime-btn">
                            <span id="submitText">Save Education</span>
                            <span id="submitSpinner" class="spinner-border spinner-border-sm d-none"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div><script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    let currentEducationId = null;

    // Initialize modal
    const educationModal = new bootstrap.Modal(document.getElementById('educationModal'));

    // إضافة تعليم جديد
    $('.add-education').click(function() {
        resetForm();
        $('#modalTitle').text('Add New Education');
        educationModal.show();
    });

    // تعديل تعليم
    $(document).on('click', '.btn-edit', function() {
        const educationId = $(this).data('id');
        
        $.ajax({
            url: '{{ route("doctor.education.show", "") }}/' + educationId,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    const edu = response.education;
                    currentEducationId = edu.id;
                    
                    // ملء النموذج
                    $('#education_id').val(edu.id);
                    $('#institution_name').val(edu.institution_name);
                    $('#course').val(edu.course);
                    $('#degree').val(edu.degree || '');
                    $('#field_of_study').val(edu.field_of_study || '');
                    $('#description').val(edu.description || '');
                    $('#years').val(edu.years);
                    $('#grade').val(edu.grade || '');
                    
                    // تواريخ
                    $('#start_date').val(edu.start_date);
                    if (edu.end_date) {
                        $('#end_date').val(edu.end_date);
                    }
                    
                    // الحالية
                    if (edu.is_current) {
                        $('#is_current').prop('checked', true);
                        $('#end_date').prop('disabled', true);
                    }
                    
                    // صورة المؤسسة
                    if (edu.institution_logo_url) {
                        $('#logoPreview').html(
                            `<img src="${edu.institution_logo_url}" 
                                  style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`
                        );
                        $('#removeLogo').removeClass('d-none');
                    }
                    
                    $('#modalTitle').text('Edit Education');
                    educationModal.show();
                }
            },
            error: function() {
                alert('Failed to load education data');
            }
        });
    });

    // حذف تعليم
    $(document).on('click', '.btn-delete', function() {
        const educationId = $(this).data('id');
        const educationName = $(this).data('name');
        
        if (confirm(`Are you sure you want to delete "${educationName}"?`)) {
            $.ajax({
                url: '{{ route("doctor.education.destroy", "") }}/' + educationId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    if (response.success) {
                        $(`#education-${educationId}`).remove();
                        showAlert(response.message, 'success');
                        
                        // إذا لم يعد هناك تعليم
                        if ($('.user-accordion-item').length === 0) {
                            $('#educationAccordion').html(`
                                <div class="alert alert-info">
                                    <i class="fa-solid fa-info-circle me-2"></i>
                                    No education records found. Click "Add New Education" to add your first education.
                                </div>
                            `);
                        }
                    }
                },
                error: function() {
                    showAlert('Failed to delete education', 'error');
                }
            });
        }
    });

    // معالجة النموذج
    $('#educationForm').submit(function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitBtn = $('#submitText');
        const spinner = $('#submitSpinner');
        
        submitBtn.addClass('d-none');
        spinner.removeClass('d-none');
        
        $.ajax({
            url: '/doctor/education/store',
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
                    educationModal.hide();
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

    // Currently studying checkbox handler
    $('#is_current').change(function() {
        if ($(this).is(':checked')) {
            $('#end_date').val('').prop('disabled', true);
        } else {
            $('#end_date').prop('disabled', false);
        }
    });

    // Preview institution logo
    $('#institution_logo').change(function(e) {
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
        $('#institution_logo').val('');
        $('#logoPreview').html('<i class="fa-solid fa-graduation-cap"></i>');
        $(this).addClass('d-none');
    });

    // Helper functions
    function resetForm() {
        currentEducationId = null;
        $('#educationForm')[0].reset();
        $('#education_id').val('');
        $('#logoPreview').html('<i class="fa-solid fa-graduation-cap"></i>');
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
