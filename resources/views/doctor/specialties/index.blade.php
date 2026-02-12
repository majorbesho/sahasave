@extends('frontend.layouts.master')





@section('content')
    <div class="content doctor-content">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-4 col-xl-3 theiaStickySidebar">
                    <!-- Profile Sidebar -->
                    <div class="profile-sidebar doctor-sidebar profile-sidebar-new">
                        <div class="widget-profile pro-widget-content">
                            <div class="profile-info-widget">
                                <a href="{{ route('doctor.profile') }}" class="booking-doc-img">
                                    <img src="{{ auth()->user()->avatar_url }}" alt="User Image">
                                </a>
                                <div class="profile-det-info">
                                    <h3><a href="{{ route('doctor.profile') }}">Dr. {{ auth()->user()->full_name }}</a></h3>
                                    <div class="patient-details">
                                        <h5 class="mb-0">{{ $doctorProfile->qualifications_display ?? 'Medical Doctor' }}</h5>
                                    </div>
                                    @if ($doctorProfile->primarySpecialty && ($primarySpecialty = $doctorProfile->primarySpecialty->first()))
                                        <span class="badge doctor-role-badge">
                                            <i class="fa-solid fa-circle"></i>
                                            {{ $primarySpecialty->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- باقي الـ sidebar -->
                    </div>
                </div>

                <div class="col-lg-8 col-xl-9">
                    <div class="dashboard-header">
                        <h3>Speciality & Services</h3>
                        <ul>
                            <li>
                                <a href="#" class="btn btn-primary prime-btn add-speciality" data-bs-toggle="modal"
                                    data-bs-target="#addSpecialtyModal">
                                    Add New Speciality
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="accordions" id="list-accord">
                        @foreach ($specialties as $specialty)
                            <div class="user-accordion-item">
                                <a href="#" class="accordion-wrap {{ $loop->first ? '' : 'collapsed' }}"
                                    data-bs-toggle="collapse" data-bs-target="#specialty-{{ $specialty->id }}">
                                    {{ $specialty->name }}
                                    <span class="delete-specialty" data-id="{{ $specialty->id }}">Delete</span>
                                </a>
                                <div class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                    id="specialty-{{ $specialty->id }}" data-bs-parent="#list-accord">
                                    <div class="content-collapse">
                                        <div class="add-service-info">
                                            <div class="add-info">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-wrap">
                                                            <label class="form-label">Speciality <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-select specialty-select"
                                                                data-specialty-id="{{ $specialty->id }}" disabled>
                                                                <option selected>{{ $specialty->name }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="services-container">
                                                    @foreach ($specialty->services as $service)
                                                        <div class="mb-3 row service-cont"
                                                            data-service-id="{{ $service->id }}">
                                                            <div class="col-md-3">
                                                                <div class="form-wrap">
                                                                    <label class="form-label">Service <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control service-name"
                                                                        name="services[{{ $service->id }}][name_{{ app()->getLocale() }}]"
                                                                        value="{{ $service->name }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-wrap">
                                                                    <label class="form-label">Price ($) <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="number" step="0.01"
                                                                        class="form-control service-price"
                                                                        name="services[{{ $service->id }}][price]"
                                                                        value="{{ $service->price }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-wrap">
                                                                    <label class="form-label">Duration (min) <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="number"
                                                                        class="form-control service-duration"
                                                                        name="services[{{ $service->id }}][duration]"
                                                                        value="{{ $service->duration }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="form-wrap w-100">
                                                                        <label class="form-label">About Service</label>
                                                                        <input type="text"
                                                                            class="form-control service-description"
                                                                            name="services[{{ $service->id }}][description_{{ app()->getLocale() }}]"
                                                                            value="{{ $service->description }}">
                                                                    </div>
                                                                    <div class="form-wrap ms-2">
                                                                        <label class="col-form-label d-block">&nbsp;</label>
                                                                        <a href="#"
                                                                            class="trash-icon trash delete-service"
                                                                            data-id="{{ $service->id }}">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <a href="#" class="mb-0 add-serv more-item add-new-service"
                                                    data-specialty-id="{{ $specialty->id }}">
                                                    Add New Service
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 modal-btn text-end">
                        <a href="{{ route('doctor.dashboard') }}" class="btn btn-gray">Cancel</a>
                        <button class="btn btn-primary prime-btn save-all-changes">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal إضافة تخصص جديد -->
    <div class="modal fade" id="addSpecialtyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Speciality</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-wrap">
                        <label class="form-label">Select Speciality <span class="text-danger">*</span></label>
                        <select class="form-select" id="newSpecialtySelect">
                            <option value="">Choose Speciality</option>
                            @foreach ($availableSpecialties as $specialty)
                                <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gray" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary prime-btn" id="confirmAddSpecialty">Add
                        Speciality</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        // specialties.js
        $(document).ready(function() {
            // إضافة تخصص جديد
            $('#confirmAddSpecialty').click(function() {
                const specialtyId = $('#newSpecialtySelect').val();

                if (!specialtyId) {
                    alert('Please select a specialty');
                    return;
                }

                $.ajax({
                    url: '/doctor/specialties/add-specialty',
                    method: 'POST',
                    data: {
                        specialty_id: specialtyId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert('An error occurred');
                    }
                });
            });

            // حذف تخصص
            $('.delete-specialty').click(function(e) {
                e.preventDefault();
                const specialtyId = $(this).data('id');

                if (confirm('Are you sure you want to delete this specialty and all its services?')) {
                    $.ajax({
                        url: `/doctor/specialties/remove-specialty/${specialtyId}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                location.reload();
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function() {
                            alert('An error occurred');
                        }
                    });
                }
            });

            // حذف خدمة
            $('.delete-service').click(function(e) {
                e.preventDefault();
                const serviceId = $(this).data('id');

                if (confirm('Are you sure you want to delete this service?')) {
                    $.ajax({
                        url: `/doctor/specialties/delete-service/${serviceId}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                $(`[data-service-id="${serviceId}"]`).remove();
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function() {
                            alert('An error occurred');
                        }
                    });
                }
            });

            // حفظ جميع التغييرات
            $('.save-all-changes').click(function() {
                const servicesData = [];

                $('.service-cont').each(function() {
                    const serviceId = $(this).data('service-id');
                    const nameAr = $(this).find('.service-name').val();
                    const price = $(this).find('.service-price').val();
                    const duration = $(this).find('.service-duration').val();
                    const description = $(this).find('.service-description').val();

                    servicesData.push({
                        id: serviceId,
                        name_ar: nameAr,
                        name_en: nameAr, // يمكن تعديل هذا حسب الحاجة
                        price: price,
                        duration: duration,
                        description_ar: description,
                        description_en: description
                    });
                });

                $.ajax({
                    url: '/doctor/specialties/save-all',
                    method: 'POST',
                    data: {
                        services: servicesData,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Changes saved successfully');
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert('An error occurred while saving');
                    }
                });
            });
        });
    </script>
@endsection
