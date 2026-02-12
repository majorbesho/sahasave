@extends('frontend.layouts.master')

@section('title', 'Medical Centers')

@section('content')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Medical Centers</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('doctor.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Medical Centers</li>
            </ul>
        </div>
        <div class="col-auto">
            <a href="{{ route('doctor.medical-centers.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Link New Center
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Statistics Cards -->
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <div class="card dash-widget">
                    <div class="card-body">
                        <div class="dash-widget-info">
                            <h6>Total Centers</h6>
                            <h3>{{ $stats['total_centers'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card dash-widget">
                    <div class="card-body">
                        <div class="dash-widget-info">
                            <h6>Active Centers</h6>
                            <h3>{{ $stats['active_centers'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card dash-widget">
                    <div class="card-body">
                        <div class="dash-widget-info">
                            <h6>Pending Approval</h6>
                            <h3>{{ $stats['pending_approval'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Medical Centers List -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">My Medical Centers</h5>
            </div>
            <div class="card-body">
                @if($medicalCenters->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>Center Name</th>
                                    <th>Location</th>
                                    <th>Consultation Fee</th>
                                    <th>Status</th>
                                    <th>Appointments</th>
                                    <th>Rating</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($medicalCenters as $center)
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="{{ route('doctor.medical-centers.show', $center->id) }}" class="avatar avatar-sm me-2">
                                                <img class="avatar-img rounded-circle" 
                                                    src="{{ $center->logo_url ?? asset('assets/img/medical-center.jpg') }}" 
                                                    alt="Medical Center">
                                            </a>
                                            <a href="{{ route('doctor.medical-centers.show', $center->id) }}">
                                                {{ $center->name }}
                                                @if($center->pivot->is_primary)
                                                    <span class="badge bg-primary-light">Primary</span>
                                                @endif
                                            </a>
                                        </h2>
                                    </td>
                                    <td>
                                        {{ $center->city }}, {{ $center->country }}
                                    </td>
                                    <td>
                                        ${{ number_format($center->pivot->consultation_fee, 2) }}
                                    </td>
                                    <td>
                                        @if($center->pivot->is_approved && $center->pivot->is_active)
                                            <span class="badge bg-success-light">Active</span>
                                        @elseif($center->pivot->is_approved && !$center->pivot->is_active)
                                            <span class="badge bg-warning-light">Inactive</span>
                                        @elseif(!$center->pivot->is_approved)
                                            <span class="badge bg-info-light">Pending Approval</span>
                                        @else
                                            <span class="badge bg-danger-light">{{ ucfirst($center->pivot->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $center->pivot->appointments_count ?? 0 }}
                                    </td>
                                    <td>
                                        <div class="rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= ($center->pivot->average_rating ?? 0) ? 'filled' : '' }}"></i>
                                            @endfor
                                            <span class="d-inline-block ms-1">({{ number_format($center->pivot->average_rating ?? 0, 1) }})</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <a href="{{ route('doctor.medical-centers.show', $center->id) }}" 
                                               class="btn btn-sm btn-info-light" 
                                               title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('doctor.medical-centers.edit', $center->id) }}" 
                                               class="btn btn-sm btn-primary-light" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if($center->pivot->is_approved)
                                                <form action="{{ route('doctor.medical-centers.toggle-status', $center->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to toggle the status?')">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" 
                                                            class="btn btn-sm {{ $center->pivot->is_active ? 'btn-warning-light' : 'btn-success-light' }}"
                                                            title="{{ $center->pivot->is_active ? 'Deactivate' : 'Activate' }}">
                                                        <i class="fas {{ $center->pivot->is_active ? 'fa-times-circle' : 'fa-check-circle' }}"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('doctor.medical-centers.destroy', $center->id) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to remove this center?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger-light" title="Remove">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $medicalCenters->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-hospital-symbol fa-4x text-muted mb-3"></i>
                        <h4>No Medical Centers Linked</h4>
                        <p class="text-muted">You haven't linked to any medical centers yet.</p>
                        <a href="{{ route('doctor.medical-centers.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Link Your First Center
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Available Centers -->
    @if($availableMedicalCenters->count() > 0)
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Available Medical Centers</h5>
                <p class="card-subtitle">Centers you can link to</p>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($availableMedicalCenters as $center)
                    <div class="col-md-4">
                        <div class="card card-hover">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $center->logo_url ?? asset('assets/img/medical-center.jpg') }}" 
                                             alt="{{ $center->name }}"
                                             class="rounded-circle"
                                             width="50" height="50">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0">{{ $center->name }}</h6>
                                        <small class="text-muted">
                                            {{ $center->city }}, {{ $center->country }}
                                        </small>
                                    </div>
                                </div>
                                <p class="text-muted mb-3">{{ Str::limit($center->description, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="badge bg-info-light">{{ $center->type }}</span>
                                    </div>
                                    <a href="{{ route('doctor.medical-centers.create') }}?center_id={{ $center->id }}" 
                                       class="btn btn-sm btn-primary">
                                        <i class="fas fa-link"></i> Link Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if($availableMedicalCenters->count() > 6)
                <div class="text-center mt-3">
                    <a href="{{ route('doctor.medical-centers.create') }}" class="btn btn-outline-primary">
                        View All Available Centers
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

