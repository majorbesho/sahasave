@extends('frontend.layouts.master')

@section('title', 'Link Medical Center')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Link Medical Center</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('doctor.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('doctor.medical-centers.index') }}">Medical Centers</a></li>
                <li class="breadcrumb-item active">Link New Center</li>
            </ul>
        </div>
        <div class="col-auto">
            <a href="{{ route('doctor.medical-centers.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Link to a Medical Center</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('doctor.medical-centers.store') }}" method="POST" id="linkCenterForm">
                    @csrf
                    
                    <!-- Step 1: Select Medical Center -->
                    <div class="step-section" id="step1">
                        <div class="section-header">
                            <h4>Step 1: Select Medical Center</h4>
                        </div>
                        
                        @if(isset($_GET['center_id']))
                            @php
                                $selectedCenter = $medicalCenters->firstWhere('id', $_GET['center_id']);
                            @endphp
                            @if($selectedCenter)
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> You selected: <strong>{{ $selectedCenter->name }}</strong>
                            </div>
                            <input type="hidden" name="medical_center_id" value="{{ $selectedCenter->id }}">
                            @endif
                        @else
                        <div class="mb-4">
                            <label for="centerSearch" class="form-label">Search Medical Center</label>
                            <input type="text" class="form-control" id="centerSearch" 
                                   placeholder="Search by name, location, etc.">
                            <small class="text-muted">Start typing to search for medical centers</small>
                        </div>
                        
                        <div class="row" id="centerResults">
                            @foreach($medicalCenters as $center)
                            <div class="col-md-4 mb-3">
                                <div class="card center-option" data-center-id="{{ $center->id }}">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="flex-shrink-0">
                                                <input type="radio" name="medical_center_id" 
                                                       value="{{ $center->id }}" 
                                                       id="center_{{ $center->id }}"
                                                       class="form-check-input center-radio">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <label for="center_{{ $center->id }}" class="form-check-label">
                                                    <h6 class="mb-0">{{ $center->name }}</h6>
                                                    <small class="text-muted d-block">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                        {{ $center->city }}, {{ $center->country }}
                                                    </small>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="text-muted small">
                                            <div class="mb-1">
                                                <i class="fas fa-stethoscope"></i> {{ $center->type }}
                                            </div>
                                            <div class="mb-1">
                                                <i class="fas fa-phone"></i> {{ $center->phone }}
                                            </div>
                                            <div class="mb-1">
                                                <i class="fas fa-clock"></i> {{ $center->opening_hours }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        
                        <div class="text-end mt-3">
                            <button type="button" class="btn btn-primary next-step" data-next="step2">
                                Next <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 2: Employment Details -->
                    <div class="step-section d-none" id="step2">
                        <div class="section-header">
                            <h4>Step 2: Employment Details</h4>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="employment_type" class="form-label">Employment Type *</label>
                                    <select name="employment_type" id="employment_type" class="form-select" required>
                                        <option value="">Select Type</option>
                                        <option value="full_time">Full Time</option>
                                        <option value="part_time">Part Time</option>
                                        <option value="contract">Contract</option>
                                        <option value="visiting">Visiting</option>
                                        <option value="consultant">Consultant</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="specialty_id" class="form-label">Specialty at this Center</label>
                                    <select name="specialty_id" id="specialty_id" class="form-select">
                                        <option value="">Select Specialty</option>
                                        @foreach($specialties as $specialty)
                                        <option value="{{ $specialty->id }}">
                                            {{ $specialty->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Working Days</label>
                                    <div class="days-selector">
                                        @foreach(['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'] as $day)
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="working_days[]" 
                                                   value="{{ $day }}" 
                                                   id="day_{{ $day }}" 
                                                   class="form-check-input">
                                            <label for="day_{{ $day }}" class="form-check-label">
                                                {{ ucfirst(substr($day, 0, 3)) }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="working_hours_start" class="form-label">Start Time</label>
                                            <input type="time" name="working_hours[start]" 
                                                   id="working_hours_start" 
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="working_hours_end" class="form-label">End Time</label>
                                            <input type="time" name="working_hours[end]" 
                                                   id="working_hours_end" 
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-end mt-3">
                            <button type="button" class="btn btn-secondary prev-step" data-prev="step1">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                            <button type="button" class="btn btn-primary next-step" data-next="step3">
                                Next <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 3: Fees and Settings -->
                    <div class="step-section d-none" id="step3">
                        <div class="section-header">
                            <h4>Step 3: Fees and Settings</h4>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="consultation_fee" class="form-label">Consultation Fee *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="consultation_fee" 
                                               id="consultation_fee" 
                                               class="form-control" 
                                               min="0" 
                                               step="0.01" 
                                               required>
                                    </div>
                                    <small class="text-muted">Fee for new patient consultation</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="follow_up_fee" class="form-label">Follow-up Fee</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="follow_up_fee" 
                                               id="follow_up_fee" 
                                               class="form-control" 
                                               min="0" 
                                               step="0.01">
                                    </div>
                                    <small class="text-muted">Fee for follow-up appointments</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="appointment_duration" class="form-label">Appointment Duration (minutes) *</label>
                                    <select name="appointment_duration" id="appointment_duration" class="form-select" required>
                                        <option value="15">15 minutes</option>
                                        <option value="30" selected>30 minutes</option>
                                        <option value="45">45 minutes</option>
                                        <option value="60">60 minutes</option>
                                        <option value="90">90 minutes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="max_daily_appointments" class="form-label">Max Daily Appointments *</label>
                                    <input type="number" name="max_daily_appointments" 
                                           id="max_daily_appointments" 
                                           class="form-control" 
                                           min="1" 
                                           max="100" 
                                           value="20" 
                                           required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" name="accepts_insurance" 
                                               id="accepts_insurance" 
                                               class="form-check-input"
                                               value="1">
                                        <label for="accepts_insurance" class="form-check-label">
                                            Accept Insurance at this center
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row insurance-section d-none">
                            <div class="col-md-12">
                                <label class="form-label">Accepted Insurances</label>
                                <div class="row">
                                    @php
                                        $commonInsurances = ['Cigna', 'Aetna', 'Blue Cross', 'UnitedHealth', 'Medicare', 'Medicaid'];
                                    @endphp
                                    @foreach($commonInsurances as $insurance)
                                    <div class="col-md-4">
                                        <div class="form-check mb-2">
                                            <input type="checkbox" name="accepted_insurances[]" 
                                                   value="{{ $insurance }}" 
                                                   id="insurance_{{ Str::slug($insurance) }}" 
                                                   class="form-check-input">
                                            <label for="insurance_{{ Str::slug($insurance) }}" 
                                                   class="form-check-label">
                                                {{ $insurance }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" 
                                                   id="custom_insurance" 
                                                   placeholder="Add custom insurance">
                                            <button class="btn btn-outline-secondary" 
                                                    type="button" 
                                                    id="add_insurance">
                                                Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Additional Notes</label>
                                    <textarea name="notes" id="notes" 
                                              class="form-control" 
                                              rows="3"
                                              placeholder="Any additional information or requirements..."></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-end mt-3">
                            <button type="button" class="btn btn-secondary prev-step" data-prev="step2">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-link"></i> Link Medical Center
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Information Card -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Important Information</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        Your request will be sent for approval to the medical center administration.
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-clock text-warning me-2"></i>
                        Approval process may take 1-3 business days.
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-money-bill-wave text-success me-2"></i>
                        Fees should be competitive with market rates at the selected center.
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-calendar-check text-info me-2"></i>
                        Once approved, you can start accepting appointments at this center.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Multi-step form navigation
        $('.next-step').click(function() {
            var currentStep = $(this).closest('.step-section');
            var nextStepId = $(this).data('next');
            
            // Validate current step
            if (validateStep(currentStep.attr('id'))) {
                currentStep.addClass('d-none');
                $('#' + nextStepId).removeClass('d-none');
            }
        });
        
        $('.prev-step').click(function() {
            var currentStep = $(this).closest('.step-section');
            var prevStepId = $(this).data('prev');
            
            currentStep.addClass('d-none');
            $('#' + prevStepId).removeClass('d-none');
        });
        
        // Center selection
        $('.center-option').click(function() {
            var centerId = $(this).data('center-id');
            $('.center-radio').prop('checked', false);
            $('#center_' + centerId).prop('checked', true);
            $('.center-option').removeClass('selected');
            $(this).addClass('selected');
        });
        
        // Center search
        $('#centerSearch').on('keyup', function() {
            var search = $(this).val().toLowerCase();
            $('.center-option').each(function() {
                var text = $(this).text().toLowerCase();
                $(this).toggle(text.includes(search));
            });
        });
        
        // Insurance toggle
        $('#accepts_insurance').change(function() {
            if ($(this).is(':checked')) {
                $('.insurance-section').removeClass('d-none');
            } else {
                $('.insurance-section').addClass('d-none');
            }
        });
        
        // Add custom insurance
        $('#add_insurance').click(function() {
            var insurance = $('#custom_insurance').val().trim();
            if (insurance) {
                var slug = insurance.toLowerCase().replace(/\s+/g, '_');
                var newCheckbox = `
                    <div class="col-md-4">
                        <div class="form-check mb-2">
                            <input type="checkbox" name="accepted_insurances[]" 
                                   value="${insurance}" 
                                   id="insurance_${slug}" 
                                   class="form-check-input" checked>
                            <label for="insurance_${slug}" 
                                   class="form-check-label">
                                ${insurance}
                            </label>
                        </div>
                    </div>`;
                $('#custom_insurance').closest('.col-md-12').before(newCheckbox);
                $('#custom_insurance').val('');
            }
        });
        
        // Step validation
        function validateStep(stepId) {
            var isValid = true;
            
            if (stepId === 'step1') {
                if (!$('input[name="medical_center_id"]:checked').length) {
                    alert('Please select a medical center');
                    isValid = false;
                }
            }
            
            return isValid;
        }
        
        // Set default values based on doctor profile
        @if($doctorProfile)
        $('#consultation_fee').val({{ $doctorProfile->consultation_fee ?? 0 }});
        @endif
        
        // Pre-select specialty if exists
        @if($doctorProfile && $doctorProfile->specialty_id)
        $('#specialty_id').val({{ $doctorProfile->specialty_id }});
        @endif
    });
</script>

<style>
    .step-section {
        animation: fadeIn 0.5s ease;
    }
    
    .section-header {
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 15px;
        margin-bottom: 30px;
    }
    
    .center-option {
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .center-option:hover {
        border-color: #007bff;
        box-shadow: 0 2px 10px rgba(0, 123, 255, 0.1);
    }
    
    .center-option.selected {
        border-color: #007bff;
        background-color: rgba(0, 123, 255, 0.05);
    }
    
    .center-option .form-check-input {
        margin-top: 0.3rem;
    }
    
    .days-selector .form-check-inline {
        margin-right: 15px;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection