@extends('frontend.layouts.master')

@section('content')

    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('patient.loyalty.index') }}">{{ __('Loyalty Points') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('History') }}</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">{{ __('Points History') }}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Profile Sidebar -->
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                    @include('patient.sidebar')
                </div>
                <!-- /Profile Sidebar -->

                <div class="col-md-7 col-lg-8 col-xl-9">
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Type</th>
                                            <th>Points</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->created_at->format('M d, Y h:i A') }}</td>
                                                <td>
                                                    {{ $transaction->description ?? $transaction->type }}
                                                    @if($transaction->transaction_code)
                                                        <br><small class="text-muted">Ref: {{ $transaction->transaction_code }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge {{ $transaction->direction == 'credit' ? 'bg-success-light' : 'bg-danger-light' }}">
                                                        {{ ucfirst($transaction->direction) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="{{ $transaction->direction == 'credit' ? 'text-success' : 'text-danger' }} fw-bold">
                                                        {{ $transaction->direction == 'credit' ? '+' : '-' }}{{ $transaction->points }}
                                                    </span>
                                                </td>
                                                <td>{{ $transaction->points_after }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No transactions found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="mt-4">
                                {{ $transactions->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

@endsection
