@extends('backend.layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Reward</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('admin.rewards.index') }}" class="btn btn-secondary float-right">Back to List</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('backend.layouts.notification')
                    <div class="card">
                        <form action="{{ route('admin.rewards.update', $reward->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_id">User <span class="text-danger">*</span></label>
                                            <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                                                <option value="">Select User</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ ($reward->user_id ?? old('user_id')) == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }} ({{ $user->email }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Reward Type <span class="text-danger">*</span></label>
                                            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                                                <option value="">Select Type</option>
                                                <option value="cashback" {{ ($reward->type ?? old('type')) == 'cashback' ? 'selected' : '' }}>Cashback</option>
                                                <option value="discount" {{ ($reward->type ?? old('type')) == 'discount' ? 'selected' : '' }}>Discount</option>
                                                <option value="bonus_points" {{ ($reward->type ?? old('type')) == 'bonus_points' ? 'selected' : '' }}>Bonus Points</option>
                                                <option value="free_consultation" {{ ($reward->type ?? old('type')) == 'free_consultation' ? 'selected' : '' }}>Free Consultation</option>
                                            </select>
                                            @error('type')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ $reward->title ?? old('title') }}" required>
                                            @error('title')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="expires_at">Expires At</label>
                                            <input type="date" name="expires_at" id="expires_at" class="form-control @error('expires_at') is-invalid @enderror" value="{{ $reward->expires_at ? $reward->expires_at->format('Y-m-d') : old('expires_at') }}">
                                            @error('expires_at')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ $reward->description ?? old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Cashback Fields -->
                                <div id="cashback-fields" class="reward-type-fields" style="display:none;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cashback_amount">Cashback Amount <span class="text-danger">*</span></label>
                                                <input type="number" step="0.01" name="cashback_amount" id="cashback_amount" class="form-control @error('cashback_amount') is-invalid @enderror" value="{{ $reward->cashback_amount ?? old('cashback_amount') }}">
                                                @error('cashback_amount')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Discount Fields -->
                                <div id="discount-fields" class="reward-type-fields" style="display:none;">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="discount_type">Discount Type <span class="text-danger">*</span></label>
                                                <select name="discount_type" id="discount_type" class="form-control @error('discount_type') is-invalid @enderror">
                                                    <option value="percentage" {{ ($reward->discount_type ?? old('discount_type')) == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                                    <option value="fixed" {{ ($reward->discount_type ?? old('discount_type')) == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                                </select>
                                                @error('discount_type')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="discount_value">Discount Value <span class="text-danger">*</span></label>
                                                <input type="number" step="0.01" name="discount_value" id="discount_value" class="form-control @error('discount_value') is-invalid @enderror" value="{{ $reward->discount_value ?? old('discount_value') }}">
                                                @error('discount_value')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="max_discount_amount">Max Discount (optional)</label>
                                                <input type="number" step="0.01" name="max_discount_amount" id="max_discount_amount" class="form-control @error('max_discount_amount') is-invalid @enderror" value="{{ $reward->max_discount_amount ?? old('max_discount_amount') }}">
                                                @error('max_discount_amount')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bonus Points Fields -->
                                <div id="bonus-points-fields" class="reward-type-fields" style="display:none;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bonus_points">Bonus Points <span class="text-danger">*</span></label>
                                                <input type="number" name="bonus_points" id="bonus_points" class="form-control @error('bonus_points') is-invalid @enderror" value="{{ $reward->bonus_points ?? old('bonus_points') }}">
                                                @error('bonus_points')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="min_consultation_value">Min Consultation Value (optional)</label>
                                            <input type="number" step="0.01" name="min_consultation_value" id="min_consultation_value" class="form-control @error('min_consultation_value') is-invalid @enderror" value="{{ $reward->min_consultation_value ?? old('min_consultation_value') }}">
                                            @error('min_consultation_value')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="usage_limit">Usage Limit (optional)</label>
                                            <input type="number" name="usage_limit" id="usage_limit" class="form-control @error('usage_limit') is-invalid @enderror" value="{{ $reward->usage_limit ?? old('usage_limit') }}">
                                            @error('usage_limit')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Reward</button>
                                <a href="{{ route('admin.rewards.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const rewardTypeFields = document.querySelectorAll('.reward-type-fields');

    typeSelect.addEventListener('change', function() {
        // Hide all type-specific fields
        rewardTypeFields.forEach(field => field.style.display = 'none');

        // Show relevant fields based on selected type
        const selectedType = this.value;
        if (selectedType === 'cashback') {
            document.getElementById('cashback-fields').style.display = 'block';
        } else if (selectedType === 'discount') {
            document.getElementById('discount-fields').style.display = 'block';
        } else if (selectedType === 'bonus_points') {
            document.getElementById('bonus-points-fields').style.display = 'block';
        }
    });

    // Trigger change event on page load
    typeSelect.dispatchEvent(new Event('change'));
});
</script>
@endsection
