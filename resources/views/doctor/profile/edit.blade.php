@extends('frontend.layouts.master')

@section('content')
<style>
    .is-invalid {
        border-color: #dc3545 !important;
        padding-right: calc(1.5em + 0.75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }
    
    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
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
                            <li class="breadcrumb-item active">Doctor Profile</li>
                        </ol>

                        <h2 class="breadcrumb-title">Doctor Profile</h2>

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

    @php
    $doctorProfile = $doctor->doctorProfile ?? new \App\Models\DoctorProfile();
@endphp
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

                    <div class="setting-title">
                        <h5>Profile</h5>
                    </div>

                    <form action="{{ route('doctor.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="setting-card">

                        <div class="change-avatar img-upload">
    <div class="profile-img">
        @if($doctor->photo)
            <img src="{{ Storage::url($doctor->photo) }}" alt="User Image" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
        @else
            <i class="fa-solid fa-file-image"></i>
        @endif
    </div>
    <div class="upload-img">
        <h5>Profile Image</h5>
        <div class="imgs-load d-flex align-items-center">
            <div class="change-photo">
                Upload New
                <input type="file" class="upload" name="photo">
            </div>
            <a href="#" class="upload-remove" id="remove-photo">Remove</a>
        </div>
        <p class="form-text">Your Image should Below 4 MB, Accepted format jpg,png,svg</p>
    </div>
</div>

                        </div>

                        <div class="setting-title">
    <h5>Professional Information</h5>
</div>
<div class="setting-card">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="form-wrap">
                <label class="form-label">Medical License Number</label>
                <input type="text" class="form-control" name="medical_license_number" value="{{ $doctorProfile->medical_license_number }}">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-wrap">
                <label class="form-label">Specialization</label>
                <input type="text" class="form-control" name="specialization" value="{{ $doctorProfile->specialization }}">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-wrap">
                <label class="form-label">Years of Experience</label>
                <input type="number" class="form-control" name="years_of_experience" value="{{ $doctorProfile->years_of_experience }}" min="0">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-wrap">
                <label class="form-label">Medical School</label>
                <input type="text" class="form-control" name="medical_school" value="{{ $doctorProfile->medical_school }}">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-wrap">
                <label class="form-label">Graduation Year</label>
                <input type="number" class="form-control" name="graduation_year" value="{{ $doctorProfile->graduation_year }}" min="1900" max="{{ date('Y') }}">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-wrap">
                <label class="form-label">Consultation Fee ($)</label>
                <input type="number" step="0.01" class="form-control" name="consultation_fee" value="{{ $doctorProfile->consultation_fee }}">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-wrap">
                <label class="form-label">Current Hospital/Clinic</label>
                <input type="text" class="form-control" name="current_hospital" value="{{ $doctorProfile->current_hospital }}">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-wrap">
                <label class="form-label">Current Position</label>
                <input type="text" class="form-control" name="current_position" value="{{ $doctorProfile->current_position }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-wrap">
                <label class="form-label">Biography</label>
                <textarea class="form-control" name="bio" rows="4">{{ $doctorProfile->bio }}</textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="form-wrap">
                <label class="form-label">Qualifications (comma separated)</label>
                <input type="text" class="form-control" name="qualifications" value="{{ is_array($doctorProfile->qualifications) ? implode(', ', $doctorProfile->qualifications) : $doctorProfile->qualifications }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-wrap">
                <label class="form-label">Certifications (comma separated)</label>
                <input type="text" class="form-control" name="certifications" value="{{ is_array($doctorProfile->certifications) ? implode(', ', $doctorProfile->certifications) : $doctorProfile->certifications }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-wrap">
                <label class="form-label">Subspecialties (comma separated)</label>
                <input type="text" class="form-control" name="subspecialties" value="{{ is_array($doctorProfile->subspecialties) ? implode(', ', $doctorProfile->subspecialties) : $doctorProfile->subspecialties }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-wrap">
                <label class="form-label">Known Languages (comma separated)</label>
                <input type="text" class="form-control" name="languages" value="{{ is_array($doctorProfile->languages) ? implode(', ', $doctorProfile->languages) : $doctorProfile->languages }}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-wrap">
                <label class="form-label">Memberships (comma separated)</label>
                <input type="text" class="form-control" name="memberships" value="{{ is_array($doctorProfile->memberships) ? implode(', ', $doctorProfile->memberships) : $doctorProfile->memberships }}">
            </div>
        </div>
    </div>
</div>
                        
                        {{-- Placeholder for other sections like Memberships, etc. --}}
                        
                        <div class="modal-btn text-end">
                            <a href="#" class="btn btn-gray">Cancel</a>
                            <button type="submit" class="btn btn-primary prime-btn">Save Changes</button>
                        </div>

                    </form>
                    <!-- /Profile Settings -->

                </div>
            </div>

        </div>

    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Preview image before upload
        $('#photo-upload').change(function(e) {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#profile-image').html('<img src="' + e.target.result + '" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">');
                }
                reader.readAsDataURL(this.files[0]);
                
                // Reset remove photo flag
                $('#remove-photo').val('0');
                $('#remove-photo-btn').show();
            }
        });
        
        // Remove photo
        $('#remove-photo-btn').click(function() {
            if (confirm('Are you sure you want to remove your profile photo?')) {
                $('#remove-photo').val('1');
                $('#profile-image').html('<div class="default-avatar"><i class="fa-solid fa-user-doctor"></i></div>');
                $('#photo-upload').val('');
                $(this).hide();
            }
        });
        
        // Form submission
        $('#profile-form').submit(function(e) {
            $('#save-btn').prop('disabled', true);
            $('#save-text').addClass('d-none');
            $('#save-spinner').removeClass('d-none');
        });
        
        // Display success/error messages
        @if(session('success'))
            showAlert('{{ session('success') }}', 'success');
        @endif
        
        @if(session('error'))
            showAlert('{{ session('error') }}', 'error');
        @endif
        
        @if($errors->any())
            @foreach($errors->all() as $error)
                showAlert('{{ $error }}', 'error');
            @endforeach
        @endif
    });
    
    function showAlert(message, type) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const alertHtml = `
            <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        
        // Insert at the top of the form
        $('#profile-form').prepend(alertHtml);
        
        // Auto dismiss after 5 seconds
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    }
</script>

@section('scripts')
<script>
    $(document).ready(function() {
        // Client-side validation
        $('#profile-form').submit(function(e) {
            let isValid = true;
            
            // تحقق من الاسم
            const name = $('input[name="name"]').val().trim();
            if (!name || name.length < 2) {
                showError('name', 'الاسم مطلوب ويجب أن يكون على الأقل حرفين');
                isValid = false;
            } else {
                clearError('name');
            }
            
            // تحقق من الهاتف
            const phone = $('input[name="phone"]').val().trim();
            const phoneRegex = /^[0-9\+\-\s\(\)]{8,20}$/;
            if (!phone || !phoneRegex.test(phone)) {
                showError('phone', 'رقم الهاتف غير صالح (8-20 رقم)');
                isValid = false;
            } else {
                clearError('phone');
            }
            
            if (!isValid) {
                e.preventDefault();
                // التمرير إلى أول حقل به خطأ
                $('.is-invalid').first().focus();
            }
        });
        
        function showError(fieldName, message) {
            const input = $(`[name="${fieldName}"]`);
            input.addClass('is-invalid');
            
            let errorDiv = input.next('.invalid-feedback');
            if (errorDiv.length === 0) {
                errorDiv = $(`<div class="invalid-feedback">${message}</div>`);
                input.after(errorDiv);
            } else {
                errorDiv.text(message);
            }
        }
        
        function clearError(fieldName) {
            const input = $(`[name="${fieldName}"]`);
            input.removeClass('is-invalid');
            input.next('.invalid-feedback').remove();
        }
    });
</script>
@endsection

@endsection
