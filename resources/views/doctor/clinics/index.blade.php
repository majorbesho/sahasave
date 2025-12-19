@extends('frontend.layouts.master')

@section('content')

<style>
.drop-file {
    border: 2px dashed #ddd;
    border-radius: 8px;
    padding: 40px 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
    background-color: #f8f9fa;
}
.drop-file:hover {
    border-color: #0d6efd;
    background-color: #f0f7ff;
}
.drop-file.dragover {
    border-color: #0d6efd;
    background-color: #e8f4ff;
}
.drop-file p {
    margin: 0;
    color: #6c757d;
}
.view-imgs {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 15px;
}
.view-img {
    position: relative;
    width: 80px;
    height: 80px;
    border-radius: 8px;
    overflow: hidden;
}
.view-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.view-img a {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(0,0,0,0.7);
    color: white;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 12px;
    text-decoration: none;
}
.view-img.more-images {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    border: 1px dashed #ddd;
    color: #6c757d;
    font-weight: bold;
}
</style>

    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="col-md-12 col-12 text-center">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="isax isax-home-15"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Doctor</li>
                            <li class="breadcrumb-item active">Clinics</li>
                        </ol>
                        <h2 class="breadcrumb-title">Doctor Clinics</h2>
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
                                    <a class="nav-link" href="{{ route('doctor.insurance.index') }}">Insurances</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('doctor.clinics.index') }}">Clinics</a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    <!-- /Settings List -->

                    <div class="dashboard-header border-0 mb-0">
                        <h3>Clinics</h3>
                        <ul>
                            <li>
                                <button type="button" class="btn btn-primary prime-btn add-clinic" 
                                        data-bs-toggle="modal" data-bs-target="#clinicModal">
                                    <i class="fa-solid fa-plus me-1"></i> Add New Clinic
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- قائمة العيادات -->
                    <div class="accordions clinic-infos" id="clinicsAccordion">
                        @forelse($clinics as $index => $clinic)
                            <div class="user-accordion-item" id="clinic-{{ $clinic->id }}">
                                <a href="#" class="accordion-wrap @if($index !== 0) collapsed @endif" 
                                   data-bs-toggle="collapse" 
                                   data-bs-target="#clinicCollapse{{ $clinic->id }}">
                                    <span>
                                        {{ $clinic->clinic_name }}
                                        @if($clinic->is_primary)
                                            <span class="badge bg-primary ms-2">Primary</span>
                                        @endif
                                        @if($clinic->is_active)
                                            <span class="badge bg-success ms-2">Active</span>
                                        @else
                                            <span class="badge bg-warning ms-2">Inactive</span>
                                        @endif
                                    </span>
                                    <span class="actions">
                                        <button type="button" class="btn-edit btn-sm btn-link text-primary me-2"
                                                data-id="{{ $clinic->id }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn-delete btn-sm btn-link text-danger"
                                                data-id="{{ $clinic->id }}"
                                                data-name="{{ $clinic->clinic_name }}">
                                            Delete
                                        </button>
                                    </span>
                                </a>
                                <div class="accordion-collapse collapse @if($index === 0) show @endif" 
                                     id="clinicCollapse{{ $clinic->id }}" 
                                     data-bs-parent="#clinicsAccordion">
                                    <div class="content-collapse">
                                        <div class="add-service-info">
                                            <div class="row">
                                                @if($clinic->clinic_logo)
                                                    <div class="col-md-12 mb-3">
                                                        <div class="clinic-logo">
                                                            <img src="{{ $clinic->clinic_logo_url }}" 
                                                                 alt="{{ $clinic->clinic_name }}" 
                                                                 style="max-height: 80px;">
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-md-6">
                                                    <strong>Clinic Name:</strong> {{ $clinic->clinic_name }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Location:</strong> {{ $clinic->location ?: 'Not specified' }}
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>Address:</strong> {{ $clinic->address }}
                                                </div>
                                                @if($clinic->city)
                                                    <div class="col-md-6">
                                                        <strong>City:</strong> {{ $clinic->city }}
                                                    </div>
                                                @endif
                                                @if($clinic->phone)
                                                    <div class="col-md-6">
                                                        <strong>Phone:</strong> {{ $clinic->phone }}
                                                    </div>
                                                @endif
                                                @if($clinic->email)
                                                    <div class="col-md-6">
                                                        <strong>Email:</strong> {{ $clinic->email }}
                                                    </div>
                                                @endif
                                                @if($clinic->gallery->count() > 0)
                                                    <div class="col-12 mt-3">
                                                        <strong>Gallery:</strong>
                                                        <div class="view-imgs mt-2">
                                                            @foreach($clinic->gallery->take(3) as $image)
                                                                <div class="view-img">
                                                                    <img src="{{ Storage::url($image->image_path) }}" alt="Gallery Image">
                                                                </div>
                                                            @endforeach
                                                            @if($clinic->gallery->count() > 3)
                                                                <div class="view-img more-images">
                                                                    +{{ $clinic->gallery->count() - 3 }} more
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($clinic->description)
                                                    <div class="col-12 mt-3">
                                                        <strong>Description:</strong>
                                                        <p class="mb-0">{{ $clinic->description }}</p>
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
                                No clinic records found. Click "Add New Clinic" to add your first clinic.
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Modal لإضافة/تعديل عيادة -->
    <div class="modal fade" id="clinicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add New Clinic</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="clinicForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- Clinic Logo -->
                            <div class="col-md-12">
                                <div class="form-wrap mb-3">
                                    <div class="change-avatar img-upload">
                                        <div class="profile-img" id="logoPreview">
                                            <i class="fa-solid fa-hospital"></i>
                                        </div>
                                        <div class="upload-img">
                                            <h5>Clinic Logo</h5>
                                            <div class="imgs-load d-flex align-items-center">
                                                <div class="change-photo">
                                                    <label for="clinic_logo" style="cursor: pointer;">
                                                        Upload New
                                                    </label>
                                                    <input type="file" id="clinic_logo" class="d-none" 
                                                           name="clinic_logo" accept="image/*">
                                                </div>
                                                <a href="#" class="upload-remove ms-2 d-none" id="removeLogo">Remove</a>
                                            </div>
                                            <p class="form-text">Your Image should Below 2 MB, Accepted format jpg,png,svg</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Clinic Name -->
                            <div class="col-lg-12 col-md-12">
                                <div class="form-wrap">
                                    <label class="form-label">Clinic Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="clinic_name" id="clinic_name" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Location</label>
                                    <input type="text" class="form-control" name="location" id="location">
                                    <small class="text-muted">e.g., Downtown, Medical District</small>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="address" id="address" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <!-- City -->
                            <div class="col-lg-4 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" id="city">
                                </div>
                            </div>

                            <!-- State -->
                            <div class="col-lg-4 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" name="state" id="state">
                                </div>
                            </div>

                            <!-- Postal Code -->
                            <div class="col-lg-4 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" name="postal_code" id="postal_code">
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="phone" id="phone">
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>
                            </div>

                            <!-- Website -->
                            <div class="col-lg-6 col-md-6">
                                <div class="form-wrap">
                                    <label class="form-label">Website</label>
                                    <input type="url" class="form-control" name="website" id="website">
                                </div>
                            </div>

                            <!-- Primary Clinic -->
                            <div class="col-lg-3 col-md-6">
                                <div class="form-wrap">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" 
                                               name="is_primary" id="is_primary" value="1">
                                        <label class="form-check-label" for="is_primary">
                                            Primary Clinic
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Active Status -->
                            <div class="col-lg-3 col-md-6">
                                <div class="form-wrap">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" 
                                               name="is_active" id="is_active" value="1" checked>
                                        <label class="form-check-label" for="is_active">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Gallery -->
                            <div class="col-12">
                                <div class="form-wrap">
                                    <label class="form-label">Gallery Images</label>
                                    <div class="drop-file" id="galleryDropzone">
                                        <p>Drop files or Click to upload</p>
                                        <input type="file" id="gallery_images" name="gallery_images[]" 
                                               multiple accept="image/*" style="display: none;">
                                    </div>
                                    <div class="view-imgs mt-3" id="galleryPreview">
                                        <!-- Preview images will be added here -->
                                    </div>
                                    <small class="text-muted">You can upload multiple images (max 5MB each)</small>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <div class="form-wrap">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" 
                                              id="description" rows="3"
                                              placeholder="Describe your clinic, specialties, etc..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="clinic_id" name="clinic_id">
                        <button type="button" class="btn btn-gray" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary prime-btn">
                            <span id="submitText">Save Clinic</span>
                            <span id="submitSpinner" class="spinner-border spinner-border-sm d-none"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    let currentClinicId = null;
    let galleryImages = []; // For storing temporary image previews

    // Initialize modal
    const clinicModal = new bootstrap.Modal(document.getElementById('clinicModal'));

    // إضافة عيادة جديدة
    $('.add-clinic').click(function() {
        resetForm();
        $('#modalTitle').text('Add New Clinic');
        clinicModal.show();
    });

    // تعديل عيادة
    $(document).on('click', '.btn-edit', function() {
        const clinicId = $(this).data('id');
        
        $.ajax({
            url: '{{ route("doctor.clinics.show", "") }}/' + clinicId,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    const clinic = response.clinic;
                    currentClinicId = clinic.id;
                    
                    // ملء النموذج
                    $('#clinic_id').val(clinic.id);
                    $('#clinic_name').val(clinic.clinic_name);
                    $('#location').val(clinic.location || '');
                    $('#address').val(clinic.address);
                    $('#city').val(clinic.city || '');
                    $('#state').val(clinic.state || '');
                    $('#postal_code').val(clinic.postal_code || '');
                    $('#phone').val(clinic.phone || '');
                    $('#email').val(clinic.email || '');
                    $('#website').val(clinic.website || '');
                    $('#description').val(clinic.description || '');
                    
                    // الحالة
                    if (clinic.is_primary) {
                        $('#is_primary').prop('checked', true);
                    }
                    if (clinic.is_active) {
                        $('#is_active').prop('checked', true);
                    }
                    
                    // صورة العيادة
                    if (clinic.clinic_logo_url) {
                        $('#logoPreview').html(
                            `<img src="${clinic.clinic_logo_url}" 
                                  style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`
                        );
                        $('#removeLogo').removeClass('d-none');
                    }
                    
                    // عرض صور المعرض
                    if (response.gallery && response.gallery.length > 0) {
                        $('#galleryPreview').html('');
                        response.gallery.forEach(function(image) {
                            const galleryItem = `
                                <div class="view-img" data-id="${image.id}">
                                    <img src="${image.image_url}" alt="Gallery Image">
                                    <a href="#" class="remove-gallery-image" data-id="${image.id}">Remove</a>
                                </div>
                            `;
                            $('#galleryPreview').append(galleryItem);
                        });
                    }
                    
                    $('#modalTitle').text('Edit Clinic');
                    clinicModal.show();
                }
            },
            error: function() {
                alert('Failed to load clinic data');
            }
        });
    });

    // حذف عيادة
    $(document).on('click', '.btn-delete', function() {
        const clinicId = $(this).data('id');
        const clinicName = $(this).data('name');
        
        if (confirm(`Are you sure you want to delete "${clinicName}"? This will also delete all gallery images.`)) {
            $.ajax({
                url: '{{ route("doctor.clinics.destroy", "") }}/' + clinicId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    if (response.success) {
                        $(`#clinic-${clinicId}`).remove();
                        showAlert(response.message, 'success');
                        
                        // إذا لم يعد هناك عيادات
                        if ($('.user-accordion-item').length === 0) {
                            $('#clinicsAccordion').html(`
                                <div class="alert alert-info">
                                    <i class="fa-solid fa-info-circle me-2"></i>
                                    No clinic records found. Click "Add New Clinic" to add your first clinic.
                                </div>
                            `);
                        }
                    }
                },
                error: function() {
                    showAlert('Failed to delete clinic', 'error');
                }
            });
        }
    });

    // حذف صورة من المعرض
    $(document).on('click', '.remove-gallery-image', function(e) {
        e.preventDefault();
        const imageId = $(this).data('id');
        const imageElement = $(this).closest('.view-img');
        
        if (confirm('Are you sure you want to delete this image?')) {
            if (imageId) {
                // حذف صورة موجودة في قاعدة البيانات
                $.ajax({
                    url: '{{ route("doctor.clinics.gallery.delete", "") }}/' + imageId,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        if (response.success) {
                            imageElement.remove();
                            showAlert(response.message, 'success');
                        }
                    },
                    error: function() {
                        showAlert('Failed to delete image', 'error');
                    }
                });
            } else {
                // حذف صورة معاينة فقط
                imageElement.remove();
            }
        }
    });

    // معالجة النموذج
    $('#clinicForm').submit(function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitBtn = $('#submitText');
        const spinner = $('#submitSpinner');
        
        submitBtn.addClass('d-none');
        spinner.removeClass('d-none');
        
        $.ajax({
            url: '/doctor/clinics/store',
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
                    clinicModal.hide();
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

    // Preview clinic logo
    $('#clinic_logo').change(function(e) {
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
        $('#clinic_logo').val('');
        $('#logoPreview').html('<i class="fa-solid fa-hospital"></i>');
        $(this).addClass('d-none');
    });

    // Handle gallery file upload
    $('#galleryDropzone').click(function() {
        $('#gallery_images').click();
    });

    $('#gallery_images').change(function(e) {
        const files = e.target.files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (file.type.startsWith('image/')) {
                previewGalleryImage(file);
            }
        }
    });

    // Drag and drop for gallery
    $('#galleryDropzone').on('dragover', function(e) {
        e.preventDefault();
        $(this).addClass('dragover');
    });

    $('#galleryDropzone').on('dragleave', function(e) {
        e.preventDefault();
        $(this).removeClass('dragover');
    });

    $('#galleryDropzone').on('drop', function(e) {
        e.preventDefault();
        $(this).removeClass('dragover');
        const files = e.originalEvent.dataTransfer.files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (file.type.startsWith('image/')) {
                previewGalleryImage(file);
            }
        }
    });

    // Helper functions
    function previewGalleryImage(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imageId = 'preview-' + Date.now() + '-' + Math.random();
            const galleryItem = `
                <div class="view-img" data-temp-id="${imageId}">
                    <img src="${e.target.result}" alt="Gallery Image">
                    <a href="#" class="remove-gallery-image">Remove</a>
                </div>
            `;
            $('#galleryPreview').append(galleryItem);
            
            // Add file to FormData
            const input = $('#gallery_images')[0];
            const dataTransfer = new DataTransfer();
            for (let i = 0; i < input.files.length; i++) {
                dataTransfer.items.add(input.files[i]);
            }
            dataTransfer.items.add(file);
            input.files = dataTransfer.files;
        }
        reader.readAsDataURL(file);
    }

    function resetForm() {
        currentClinicId = null;
        $('#clinicForm')[0].reset();
        $('#clinic_id').val('');
        $('#logoPreview').html('<i class="fa-solid fa-hospital"></i>');
        $('#removeLogo').addClass('d-none');
        $('#galleryPreview').html('');
        clearErrors();
        $('#is_primary').prop('checked', false);
        $('#is_active').prop('checked', true);
        $('#gallery_images').val('');
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

