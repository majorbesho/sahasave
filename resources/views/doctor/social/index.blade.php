@extends('frontend.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="text-center col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="isax isax-home-15"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Doctor</li>
                            <li class="breadcrumb-item active">Social Media</li>
                        </ol>
                        <h2 class="breadcrumb-title">Social Media</h2>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="content">
        <div class="container">
            <div class="row">
                
                @include('doctor.layouts.slide')

                <div class="col-lg-8 col-xl-9">
                    <div class="dashboard-card">
                        <div class="dashboard-card-head">
                            <div class="header-title">
                                <h5>Manage Social Media</h5>
                            </div>
                        </div>
                        <div class="dashboard-card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form action="{{ route('doctor.social.store') }}" method="POST" class="mb-4">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group mb-3">
                                            <label>Platform</label>
                                            <select name="platform" class="form-control select">
                                                <option value="Facebook">Facebook</option>
                                                <option value="Twitter">Twitter</option>
                                                <option value="Instagram">Instagram</option>
                                                <option value="LinkedIn">LinkedIn</option>
                                                <option value="Youtube">Youtube</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group mb-3">
                                            <label>URL</label>
                                            <input type="url" name="url" class="form-control" placeholder="https://..." required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group mb-3">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="btn btn-primary w-100">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Platform</th>
                                            <th>URL</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($socialMedias as $social)
                                            <tr>
                                                <td>{{ $social->platform }}</td>
                                                <td><a href="{{ $social->url }}" target="_blank">{{ $social->url }}</a></td>
                                                <td class="text-end">
                                                    <div class="table-action">
                                                        <form action="{{ route('doctor.social.destroy', $social->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm bg-danger-light" onclick="return confirm('Are you sure?')">
                                                                <i class="fas fa-trash-alt"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No social media accounts added yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
