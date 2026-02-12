@extends('backend.layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Loyalty Tier: {{ $tier->name }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('backend.layouts.notification')
                    <div class="card">
                        <form action="{{ route('admin.loyalty.tiers.update', $tier->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Tier Name</label>
                                            <input type="text" name="name" class="form-control" id="name" value="{{ $tier->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="code">Tier Code</label>
                                            <input type="text" name="code" class="form-control" id="code" value="{{ $tier->code }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="level">Level (Numeric rank)</label>
                                            <input type="number" name="level" class="form-control" id="level" value="{{ $tier->level }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="min_points_required">Min Points Required</label>
                                            <input type="number" name="min_points_required" class="form-control" id="min_points_required" value="{{ $tier->min_points_required }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="points_earning_rate">Points Earning Multiplier</label>
                                            <input type="number" step="0.01" name="points_earning_rate" class="form-control" id="points_earning_rate" value="{{ $tier->points_earning_rate }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select name="is_active" class="form-control" id="is_active">
                                        <option value="1" {{ $tier->is_active ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ !$tier->is_active ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="benefits">Benefits (JSON)</label>
                                    <textarea name="benefits" class="form-control" id="benefits" rows="3">{{ json_encode($tier->benefits) }}</textarea>
                                    <small class="text-muted">Enter as a valid JSON array of strings.</small>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Tier</button>
                                <a href="{{ route('admin.loyalty.tiers.index') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
