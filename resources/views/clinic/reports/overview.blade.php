@extends('frontend.layouts.master')
@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            @include('clinic.layouts.sidebar')
            <div class="col-lg-8 col-xl-9">
                <div class="card"><div class="card-header"><h4>Reports</h4></div><div class="card-body">Clinic Financial and Performance Reports</div></div>
            </div>
        </div>
    </div>
</div>
@endsection
