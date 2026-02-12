@extends('backend.layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Adjust User Points</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    @include('backend.layouts.notification')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Adjust points for {{ $loyaltyPoint->user->name }}</h3>
                        </div>
                        <form action="{{ route('admin.loyalty.points.update', $loyaltyPoint->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Current Available Points</label>
                                    <input type="text" class="form-control" value="{{ $loyaltyPoint->available_points }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="available_points">Set New Points Balance</label>
                                    <input type="number" name="available_points" class="form-control" id="available_points" value="{{ $loyaltyPoint->available_points }}" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Balance</button>
                                <a href="{{ route('admin.loyalty.points.index') }}" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
