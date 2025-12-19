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
                            <li class="breadcrumb-item active">Awards</li>
                        </ol>
                        <h2 class="breadcrumb-title">Doctor Awards</h2>
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
                                    <a class="nav-link active" href="{{ route('doctor.awards.index') }}">Awards</a>
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
                        <h3>Awards</h3>
                        <ul>
                            <li>
                                <button type="button" class="btn btn-primary prime-btn add-award" 
                                        data-bs-toggle="modal" data-bs-target="#awardModal">
                                    <i class="fa-solid fa-plus me-1"></i> Add New Award
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- قائمة الجوائز -->
                    <div class="accordions awards-infos" id="awardsAccordion">
                        @forelse($awards as $index => $award)
                            <div class="user-accordion-item" id="award-{{ $award->id }}">
                                <a href="#" class="accordion-wrap @if($index !== 0) collapsed @endif" 
                                   data-bs-toggle="collapse" 
                                   data-bs-target="#awardCollapse{{ $award->id }}">
                                    <span>
                                        {{ $award->award_name }}
                                        @if($award->organization)
                                            - {{ $award->organization }}
                                        @endif
                                        ({{ $award->year }})
                                    </span>
                                    <span class="actions">
                                        <button type="button" class="btn-edit btn-sm btn-link text-primary me-2"
                                                data-id="{{ $award->id }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn-delete btn-sm btn-link text-danger"
                                                data-id="{{ $award->id }}"
                                                data-name="{{ $award->award_name }}">
                                            Delete
                                        </button>
                                    </span>
                                </a>
                                <div class="accordion-collapse collapse @if($index === 0) show @endif" 
                                     id="awardCollapse{{ $award->id }}" 
                                     data-bs-parent="#awardsAccordion">
                                    <div class="content-collapse">
                                        <div class="add-service-info">
                                            <div class="row">
                                                @if($award->award_image)
                                                    <div class="col-md-12 mb-3">
                                                        <div class="award-image">
                                                            <img src="{{ $award->award_image_url }}" 
                                                                 alt="{{ $award->award_name }}" 
                                                                 style="max-height: 150px; border-radius: 8px;">
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-md-6">
                                                    <strong>Award Name:</strong> {{ $award->award_name }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Organization:</strong> {{ $award->organization ?: 'Not specified' }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Year:</strong> {{ $award->year }}
                                                </div>
                                                @if($award->award_url)
                                                    <div class="col-md-6">
                                                        <strong>URL:</strong> 
                                                        <a href="{{ $award->award_url }}" target="_blank" class="text-primary">
                                                            View Details
                                                        </a>
                                                    </div>
                                                @endif
                                                <div class="col-12 mt-3">
                                                    <strong>Description:</strong>
                                                    <p class="mb-0">{{ $award->description ?: 'No description provided' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info">
                                <i class="fa-solid fa-info-circle me-2"></i>
                                No awards found. Click "Add New Award" to add your first award.
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Modal لإضافة/تعديل جائزة -->
    <div class="modal fade" id="awardModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add New Award</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="awardForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- Award Image -->
                            <div class="col-md-12">
                                <div class="form-wrap mb-3">
                                    <div class="change-avatar img-upload">
                                        <div class="profile-img" id="imagePreview">
                                            <i class="fa-solid fa-trophy"></i>
                                        </div>
                                        <div class="upload-img">
                                            <h5>Award Image/Certificate</h5>
                                            <div class="imgs-load d-flex align-items-center">
                                                <div class="change-photo">
                                                    <label for="award_image" style="cursor: pointer;">
                                                        Upload New
                                                    </label>
                                                    <input type="file" id="award_image" class="d-none" 
                                                           name="award_image" accept="image/*">
                                                </div>
                                                <a href="#" class="upload-remove ms-2 d-none" id="removeImage">Remove</a>
                                            </div>
                                            <p class="form-text">Your Image should Below 2 MB, Accepted format jpg,png,svg</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Award Name -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Award Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="award_name" id="award_name" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <!-- Organization -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Organization</label>
                                    <input type="text" class="form-control" name="organization" id="organization">
                                    <small class="text-muted">e.g., Ministry of Health, Medical Association</small>
                                </div>
                            </div>

                            <!-- Year -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Year <span class="text-danger">*</span></label>
                                    <select class="form-control" name="year" id="year" required>
                                        <option value="">Select Year</option>
                                        @for($y = date('Y'); $y >= 1900; $y--)
                                            <option value="{{ $y }}">{{ $y }}</option>
                                        @endfor
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <!-- Award URL -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Award URL/Link</label>
                                    <input type="url" class="form-control" name="award_url" id="award_url">
                                    <small class="text-muted">Optional: Link to award details</small>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <div class="form-wrap">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" 
                                              id="description" rows="4" 
                                              placeholder="Describe the award, its significance, or any additional details..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="award_id" name="award_id">
                        <button type="button" class="btn btn-gray" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary prime-btn">
                            <span id="submitText">Save Award</span>
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
    let currentAwardId = null;

    // Initialize modal
    const awardModal = new bootstrap.Modal(document.getElementById('awardModal'));

    // إضافة جائزة جديدة
    $('.add-award').click(function() {
        resetForm();
        $('#modalTitle').text('Add New Award');
        awardModal.show();
    });

    // تعديل جائزة
    $(document).on('click', '.btn-edit', function() {
        const awardId = $(this).data('id');
        
        $.ajax({
            url: '{{ route("doctor.awards.show", "") }}/' + awardId,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    const award = response.award;
                    currentAwardId = award.id;
                    
                    // ملء النموذج
                    $('#award_id').val(award.id);
                    $('#award_name').val(award.award_name);
                    $('#organization').val(award.organization || '');
                    $('#year').val(award.year);
                    $('#description').val(award.description || '');
                    $('#award_url').val(award.award_url || '');
                    
                    // صورة الجائزة
                    if (award.award_image_url) {
                        $('#imagePreview').html(
                            `<img src="${award.award_image_url}" 
                                  style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`
                        );
                        $('#removeImage').removeClass('d-none');
                    }
                    
                    $('#modalTitle').text('Edit Award');
                    awardModal.show();
                }
            },
            error: function() {
                alert('Failed to load award data');
            }
        });
    });

    // حذف جائزة
    $(document).on('click', '.btn-delete', function() {
        const awardId = $(this).data('id');
        const awardName = $(this).data('name');
        
        if (confirm(`Are you sure you want to delete "${awardName}"?`)) {
            $.ajax({
                url: '{{ route("doctor.awards.destroy", "") }}/' + awardId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    if (response.success) {
                        $(`#award-${awardId}`).remove();
                        showAlert(response.message, 'success');
                        
                        // إذا لم يعد هناك جوائز
                        if ($('.user-accordion-item').length === 0) {
                            $('#awardsAccordion').html(`
                                <div class="alert alert-info">
                                    <i class="fa-solid fa-info-circle me-2"></i>
                                    No awards found. Click "Add New Award" to add your first award.
                                </div>
                            `);
                        }
                    }
                },
                error: function() {
                    showAlert('Failed to delete award', 'error');
                }
            });
        }
    });

    // معالجة النموذج
    $('#awardForm').submit(function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitBtn = $('#submitText');
        const spinner = $('#submitSpinner');
        
        submitBtn.addClass('d-none');
        spinner.removeClass('d-none');
        
        $.ajax({
            url: '/doctor/awards/store',
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
                    awardModal.hide();
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

    // Preview award image
    $('#award_image').change(function(e) {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').html(
                    `<img src="${e.target.result}" 
                          style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`
                );
                $('#removeImage').removeClass('d-none');
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Remove image
    $('#removeImage').click(function(e) {
        e.preventDefault();
        $('#award_image').val('');
        $('#imagePreview').html('<i class="fa-solid fa-trophy"></i>');
        $(this).addClass('d-none');
    });

    // Helper functions
    function resetForm() {
        currentAwardId = null;
        $('#awardForm')[0].reset();
        $('#award_id').val('');
        $('#imagePreview').html('<i class="fa-solid fa-trophy"></i>');
        $('#removeImage').addClass('d-none');
        clearErrors();
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