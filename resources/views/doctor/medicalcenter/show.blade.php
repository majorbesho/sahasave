@extends('frontend.layouts.master')


@section('title', 'Medical Center Details')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Medical Center Details</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('doctor.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('doctor.medical-centers.index') }}">Medical Centers</a></li>
                <li class="breadcrumb-item active">{{ $medicalCenter->name }}</li>
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
        <!-- Center Information Card -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <img src="{{ $medicalCenter->logo_url ?? asset('assets/img/medical-center.jpg') }}" 
                             alt="{{ $medicalCenter->name }}"
                             class="img-fluid rounded-circle mb-3"
                             style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="mt-3">
                            @if($medicalCenter->pivot->is_approved && $medicalCenter->pivot->is_active)
                                <span class="badge bg-success p-2">Active</span>
                            @elseif($medicalCenter->pivot->is_approved && !$medicalCenter->pivot->is_active)
                                <span class="badge bg-warning p-2">Inactive</span>
                            @else
                                <span class="badge bg-info p-2">Pending Approval</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h3>{{ $medicalCenter->name }}</h3>
                        <p class="text-muted mb-4">{{ $medicalCenter->description }}</p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-3">Center Information</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        <strong>Address:</strong> {{ $medicalCenter->address }}
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-city text-primary me-2"></i>
                                        <strong>City:</strong> {{ $medicalCenter->city }}
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-globe text-primary me-2"></i>
                                        <strong>Country:</strong> {{ $medicalCenter->country }}
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-phone text-primary me-2"></i>
                                        <strong>Phone:</strong> {{ $medicalCenter->phone }}
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-envelope text-primary me-2"></i>
                                        <strong>Email:</strong> {{ $medicalCenter->email }}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-3">Your Details at this Center</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="fas fa-briefcase text-success me-2"></i>
                                        <strong>Employment Type:</strong> 
                                        {{ ucfirst(str_replace('_', ' ', $medicalCenter->pivot->employment_type)) }}
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-stethoscope text-success me-2"></i>
                                        <strong>Specialty:</strong> 
                                        {{ $medicalCenter->pivot->specialty ? $medicalCenter->pivot->specialty->name : 'Not specified' }}
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-money-bill-wave text-success me-2"></i>
                                        <strong>Consultation Fee:</strong> 
                                        ${{ number_format($medicalCenter->pivot->consultation_fee, 2) }}
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-calendar-check text-success me-2"></i>
                                        <strong>Appointment Duration:</strong> 
                                        {{ $medicalCenter->pivot->appointment_duration }} minutes
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-clock text-success me-2"></i>
                                        <strong>Max Daily Appointments:</strong> 
                                        {{ $medicalCenter->pivot->max_daily_appointments }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="mt-4 pt-4 border-top">
                    <div class="d-flex justify-content-between">
                        <div>
                            @if($medicalCenter->pivot->is_approved)
                                <form action="{{ route('doctor.medical-centers.toggle-status', $medicalCenter->id) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    <button type="submit" 
                                            class="btn {{ $medicalCenter->pivot->is_active ? 'btn-warning' : 'btn-success' }}">
                                        <i class="fas {{ $medicalCenter->pivot->is_active ? 'fa-times-circle' : 'fa-check-circle' }}"></i>
                                        {{ $medicalCenter->pivot->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('doctor.medical-centers.edit', $medicalCenter->id) }}" 
                               class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit Details
                            </a>
                            @if(!$medicalCenter->pivot->is_approved)
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#contactModal">
                                    <i class="fas fa-envelope"></i> Contact Admin
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Statistics and Details -->
        <div class="row">
            <!-- Working Hours -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Working Schedule</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $workingDays = $medicalCenter->pivot->working_days ? 
                                json_decode($medicalCenter->pivot->working_days, true) : [];
                            $workingHours = $medicalCenter->pivot->working_hours ? 
                                json_decode($medicalCenter->pivot->working_hours, true) : [];
                        @endphp
                        
                        @if(!empty($workingDays) && !empty($workingHours))
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Day</th>
                                        <th>Hours</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'] as $day)
                                    <tr>
                                        <td>
                                            <strong>{{ ucfirst($day) }}</strong>
                                        </td>
                                        <td>
                                            @if(in_array($day, $workingDays))
                                                {{ $workingHours['start'] ?? 'N/A' }} - {{ $workingHours['end'] ?? 'N/A' }}
                                            @else
                                                <span class="text-muted">Not working</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p class="text-muted text-center py-4">
                            <i class="fas fa-calendar-times fa-2x mb-3"></i><br>
                            Working schedule not specified
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Insurance Information -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Insurance Information</h5>
                    </div>
                    <div class="card-body">
                        @if($medicalCenter->pivot->accepts_insurance)
                            @php
                                $acceptedInsurances = $medicalCenter->pivot->accepted_insurances ? 
                                    json_decode($medicalCenter->pivot->accepted_insurances, true) : [];
                            @endphp
                            
                            @if(!empty($acceptedInsurances))
                            <ul class="list-group list-group-flush">
                                @foreach($acceptedInsurances as $insurance)
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    {{ $insurance }}
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <p class="text-muted">Insurance accepted but no specific providers listed.</p>
                            @endif
                        @else
                        <p class="text-muted text-center py-4">
                            <i class="fas fa-times-circle fa-2x mb-3"></i><br>
                            Insurance not accepted at this center
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Statistics -->
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Center Statistics</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <div class="stat-box">
                                    <h3>{{ $stats['total_appointments'] ?? 0 }}</h3>
                                    <p class="text-muted mb-0">Total Appointments</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="stat-box">
                                    <h3>{{ number_format($stats['average_rating'] ?? 0, 1) }}</h3>
                                    <p class="text-muted mb-0">Average Rating</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="stat-box">
                                    <h3>{{ $medicalCenter->pivot->appointments_count ?? 0 }}</h3>
                                    <p class="text-muted mb-0">Completed Appointments</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="stat-box">
                                    <h3>
                                        @if($stats['last_appointment'])
                                            {{ $stats['last_appointment']->format('M d, Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </h3>
                                    <p class="text-muted mb-0">Last Appointment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Notes -->
            @if($medicalCenter->pivot->notes)
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Additional Notes</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $medicalCenter->pivot->notes }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Contact Admin Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Contact Center Administrator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" id="message" class="form-control" rows="5" required 
                                  placeholder="Write your message to the center administrator..."></textarea>
                    </div>
                    <p class="text-muted small">
                        <i class="fas fa-info-circle"></i> Your message will be sent to the center's administration team.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .stat-box {
        padding: 20px;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        background: #f9f9f9;
        transition: all 0.3s ease;
    }
    
    .stat-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        background: #fff;
    }
    
    .stat-box h3 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 10px;
    }
</style>
@endsection
