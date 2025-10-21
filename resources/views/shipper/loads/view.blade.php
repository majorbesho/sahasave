@extends('shipper.minlayout.master')

@section('content')
    <div class="col-lg-8 col-xl-9">


        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Load #{{ $load->id }}</h5>
                <p class="card-text"><strong>Title:</strong> {{ $load->title }}</p>
                <p class="card-text"><strong>Description:</strong> {{ $load->discreption }}</p>
                <p class="card-text"><strong>Status:</strong> {{ $load->status }}</p>
                <p class="card-text"><strong>Total Items:</strong> {{ $load->totalItems }}</p>
                <p class="card-text"><strong>Weight:</strong> {{ $load->weight }} kg</p>
                <p class="card-text"><strong>Shipment:</strong> {{ $load->shipment }}</p>
                <p class="card-text"><strong>Payment Type:</strong> {{ $load->paymentType }}</p>
                <p class="card-text"><strong>Payment Status:</strong> {{ $load->paymentStatus }}</p>
                <p class="card-text"><strong>Tracking Number:</strong> {{ $load->trackingNumber }}</p>
                <p class="card-text"><strong>Tracking Status:</strong> {{ $load->trackingStatus }}</p>
                <p class="card-text"><strong>Load Date:</strong> {{ $load->loadDate }}</p>
                <p class="card-text"><strong>Load Time:</strong> {{ $load->loadTime }}</p>
                <p class="card-text"><strong>Load By:</strong> {{ $load->loadBy }}</p>
                <p class="card-text"><strong>Load To:</strong> {{ $load->loadTo }}</p>
                <p class="card-text"><strong>Load From:</strong> {{ $load->loadFrom }}</p>
                <p class="card-text"><strong>Drop Date:</strong> {{ $load->dropDate }}</p>
                <p class="card-text"><strong>Drop Time:</strong> {{ $load->dropTime }}</p>
                <p class="card-text"><strong>Drop To:</strong> {{ $load->dropTo }}</p>
                <p class="card-text"><strong>Drop From:</strong> {{ $load->dropFrom }}</p>
                <p class="card-text"><strong>Drop Notes:</strong> {{ $load->dropNotes }}</p>
                <p class="card-text"><strong>Load Notes:</strong> {{ $load->loadNotes }}</p>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('loads.index') }}" class="btn btn-secondary">Back to List</a>
        </div>

    </div>
@endsection
