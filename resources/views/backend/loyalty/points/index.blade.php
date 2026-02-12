@extends('backend.layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Loyalty Points</h1>
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
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Total Points</th>
                                        <th>Available</th>
                                        <th>Tier</th>
                                        <th>Evaluation Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($loyaltyPoints as $lp)
                                    <tr>
                                        <td>{{ $lp->user->name ?? 'N/A' }} ({{ $lp->user->email ?? 'N/A' }})</td>
                                        <td>{{ $lp->points }}</td>
                                        <td>{{ $lp->available_points }}</td>
                                        <td><span class="badge badge-primary">{{ strtoupper($lp->loyalty_tier) }}</span></td>
                                        <td>{{ $lp->next_evaluation_date ? $lp->next_evaluation_date->format('Y-m-d') : '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.loyalty.points.edit', $lp->id) }}" class="btn btn-sm btn-info">Adjust Points</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $loyaltyPoints->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
