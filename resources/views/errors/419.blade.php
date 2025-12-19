@extends('frontend.layouts.master')

@section('content')
<div class="container" style="padding: 100px 0;">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <h2 class="mb-4 text-danger">@lang('Session Expired')</h2>
                    <p class="lead mb-4">@lang('Your session has expired due to inactivity. You are being redirected to the login page.')</p>
                    
                    <div class="spinner-border text-primary mb-3" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <p>
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            @lang('Click here if not redirected')
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(function() {
        window.location.href = "{{ route('login') }}";
    }, 2000);
</script>
@endsection
