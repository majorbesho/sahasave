@extends('backend.layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Loyalty Tiers</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('admin.loyalty.tiers.create') }}" class="btn btn-primary float-right">Add New Tier</a>
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
                                        <th>Level</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Min Points</th>
                                        <th>Earning Rate</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tiers as $tier)
                                    <tr>
                                        <td>{{ $tier->level }}</td>
                                        <td>{{ $tier->name }}</td>
                                        <td><code>{{ $tier->code }}</code></td>
                                        <td>{{ $tier->min_points_required }}</td>
                                        <td>{{ $tier->points_earning_rate }}x</td>
                                        <td>
                                            <span class="badge badge-{{ $tier->is_active ? 'success' : 'danger' }}">
                                                {{ $tier->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.loyalty.tiers.edit', $tier->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('admin.loyalty.tiers.destroy', $tier->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
