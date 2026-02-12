@extends('backend.layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rewards Management</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('admin.rewards.create') }}" class="btn btn-primary float-right">Issue New Reward</a>
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
                        <div class="card-header">
                            <form method="GET" action="{{ route('admin.rewards.index') }}" class="form-inline">
                                <select name="type" class="form-control mr-2">
                                    <option value="">All Types</option>
                                    <option value="cashback" {{ request('type') == 'cashback' ? 'selected' : '' }}>Cashback</option>
                                    <option value="discount" {{ request('type') == 'discount' ? 'selected' : '' }}>Discount</option>
                                    <option value="bonus_points" {{ request('type') == 'bonus_points' ? 'selected' : '' }}>Bonus Points</option>
                                    <option value="free_consultation" {{ request('type') == 'free_consultation' ? 'selected' : '' }}>Free Consultation</option>
                                </select>
                                <select name="status" class="form-control mr-2">
                                    <option value="">All Status</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="used" {{ request('status') == 'used' ? 'selected' : '' }}>Used</option>
                                    <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <input type="text" name="search" class="form-control mr-2" placeholder="Search..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-secondary">Filter</button>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>User</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Value</th>
                                        <th>Status</th>
                                        <th>Expires At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rewards as $reward)
                                    <tr>
                                        <td><code>{{ $reward->code }}</code></td>
                                        <td>{{ $reward->user->name ?? 'N/A' }}</td>
                                        <td>{{ $reward->title }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ ucfirst(str_replace('_', ' ', $reward->type)) }}</span>
                                        </td>
                                        <td>{{ $reward->formatted_amount }}</td>
                                        <td>
                                            <span class="badge badge-{{ $reward->status === 'active' ? 'success' : ($reward->status === 'used' ? 'secondary' : 'danger') }}">
                                                {{ ucfirst($reward->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $reward->expires_at ? $reward->expires_at->format('Y-m-d') : 'Never' }}</td>
                                        <td>
                                            <a href="{{ route('admin.rewards.edit', $reward->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('admin.rewards.toggle-status', $reward->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-warning" title="Toggle Status"><i class="fas fa-power-off"></i></button>
                                            </form>
                                            <form action="{{ route('admin.rewards.destroy', $reward->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No rewards found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $rewards->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
