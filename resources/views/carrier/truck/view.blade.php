@extends('carrier.minlayout.master')

@section('content')
    <div class="container">
        <h1 class="mb-4">View Load Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Load #{{ $truck->id }}</h5>
                <p class="card-text"><strong>Title:</strong> {{ $truck->title }}</p>
                <p class="card-text"><strong>Description:</strong> {{ $truck->discreption }}</p>
                <p class="card-text"><strong>Status:</strong> {{ $truck->status }}</p>
                <p class="card-text"><strong>Total Items:</strong> {{ $truck->totalItems }}</p>
                <p class="card-text"><strong>Weight:</strong> {{ $truck->weight }} kg</p>
                <p class="card-text"><strong>Shipment:</strong> {{ $truck->shipment }}</p>
                <p class="card-text"><strong>Payment Type:</strong> {{ $truck->paymentType }}</p>
                <p class="card-text"><strong>Payment Status:</strong> {{ $truck->paymentStatus }}</p>
                <p class="card-text"><strong>Tracking Number:</strong> {{ $truck->trackingNumber }}</p>
                <p class="card-text"><strong>Tracking Status:</strong> {{ $truck->trackingStatus }}</p>
                <p class="card-text"><strong>Load Date:</strong> {{ $truck->loadDate }}</p>
                <p class="card-text"><strong>Load Time:</strong> {{ $truck->loadTime }}</p>
                <p class="card-text"><strong>Load By:</strong> {{ $truck->loadBy }}</p>
                <p class="card-text"><strong>Load To:</strong> {{ $truck->loadTo }}</p>
                <p class="card-text"><strong>Load From:</strong> {{ $truck->loadFrom }}</p>
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
