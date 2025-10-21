@extends('broker.minlayout.master')

@section('content')

    <div class="col-lg-8 col-xl-9">
        <div class="container">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <ul><i>{{ $error }} </i></ul>
                        @endforeach
                    </div>
                @endif
            </div>

            <h1 class="mb-4">Edit Load</h1>
            <form action="{{ route('loads.update', $LoadPackage->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Use PUT method for updates -->

                <div class="row">
                    <!-- Column 1 -->
                    <div class="col-md-6">
                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ $LoadPackage->title }}" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="discreption" class="form-label">Description</label>
                            <textarea class="form-control" id="discreption" name="discreption" rows="3">{{ $LoadPackage->discreption }}</textarea>
                        </div>

                        <!-- Photo -->
                        {{-- <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                        @if ($LoadPackage->photo)
                            <img src="{{ asset('storage/' . $LoadPackage->photo) }}" alt="Current Photo"
                                class="img-thumbnail mt-2" width="100">
                        @endif
                    </div> --}}
                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                            @if ($LoadPackage->photo)
                                <img src="{{ asset('storage/' . $LoadPackage->photo) }}" alt="Current Photo"
                                    class="img-thumbnail mt-2" width="100">
                            @endif
                        </div>


                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="active" {{ $LoadPackage->status == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ $LoadPackage->status == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </div>

                        <!-- Total Items -->
                        <div class="mb-3">
                            <label for="totalItems" class="form-label">Total Items</label>
                            <input type="number" class="form-control" id="totalItems" name="totalItems"
                                value="{{ $LoadPackage->totalItems }}">
                        </div>

                        <!-- Total Dimensions -->
                        <div class="mb-3">
                            <label for="totalDimensions" class="form-label">Total Dimensions</label>
                            <input type="text" class="form-control" id="totalDimensions" name="totalDimensions"
                                value="{{ $LoadPackage->totalDimensions }}">
                        </div>

                        <!-- Total Length -->
                        <div class="mb-3">
                            <label for="totalLength" class="form-label">Total Length</label>
                            <input type="text" class="form-control" id="totalLength" name="totalLength"
                                value="{{ $LoadPackage->totalLength }}">
                        </div>

                        <!-- Total Width -->
                        <div class="mb-3">
                            <label for="totalWidth" class="form-label">Total Width</label>
                            <input type="text" class="form-control" id="totalWidth" name="totalWidth"
                                value="{{ $LoadPackage->totalWidth }}">
                        </div>

                        <!-- Total Height -->
                        <div class="mb-3">
                            <label for="totalHeight" class="form-label">Total Height</label>
                            <input type="text" class="form-control" id="totalHeight" name="totalHeight"
                                value="{{ $LoadPackage->totalHeight }}">
                        </div>

                        <!-- Weight -->
                        <div class="mb-3">
                            <label for="weight" class="form-label">Weight</label>
                            <input type="number" class="form-control" id="weight" name="weight" step="0.01"
                                value="{{ $LoadPackage->weight }}">
                        </div>
                    </div>

                    <!-- Column 2 -->
                    <div class="col-md-6">
                        <!-- Shipment -->
                        <div class="mb-3">
                            <label for="shipment" class="form-label">Shipment</label>
                            <input type="text" class="form-control" id="shipment" name="shipment"
                                value="{{ $LoadPackage->shipment }}">
                        </div>

                        <!-- Payment Type -->
                        <div class="mb-3">
                            <label for="paymentType" class="form-label">Payment Type</label>
                            <select class="form-select" id="paymentType" name="paymentType">
                                <option value="cod" {{ $LoadPackage->paymentType == 'cod' ? 'selected' : '' }}>COD
                                </option>
                                <option value="prepaid" {{ $LoadPackage->paymentType == 'prepaid' ? 'selected' : '' }}>
                                    Prepaid
                                </option>
                                <option value="prepaid_cod"
                                    {{ $LoadPackage->paymentType == 'prepaid_cod' ? 'selected' : '' }}>
                                    Prepaid + COD</option>
                                <option value="prepaid_prepaid"
                                    {{ $LoadPackage->paymentType == 'prepaid_prepaid' ? 'selected' : '' }}>Prepaid +
                                    Prepaid
                                </option>
                            </select>
                        </div>

                        <!-- Payment Status -->
                        <div class="mb-3">
                            <label for="paymentStatus" class="form-label">Payment Status</label>
                            <select class="form-select" id="paymentStatus" name="paymentStatus">
                                <option value="pending" {{ $LoadPackage->paymentStatus == 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option value="paid" {{ $LoadPackage->paymentStatus == 'paid' ? 'selected' : '' }}>Paid
                                </option>
                                <option value="failed" {{ $LoadPackage->paymentStatus == 'failed' ? 'selected' : '' }}>
                                    Failed
                                </option>
                            </select>
                        </div>

                        <!-- Payment Method -->
                        <div class="mb-3">
                            <label for="paymentMethod" class="form-label">Payment Method</label>
                            <select class="form-select" id="paymentMethod" name="paymentMethod">
                                <option value="cash" {{ $LoadPackage->paymentMethod == 'cash' ? 'selected' : '' }}>Cash
                                </option>
                                <option value="cheque" {{ $LoadPackage->paymentMethod == 'cheque' ? 'selected' : '' }}>
                                    Cheque
                                </option>
                                <option value="online" {{ $LoadPackage->paymentMethod == 'online' ? 'selected' : '' }}>
                                    Online
                                </option>
                                <option value="wire transfer"
                                    {{ $LoadPackage->paymentMethod == 'wire transfer' ? 'selected' : '' }}>
                                    Wire Transfer</option>
                            </select>
                        </div>

                        <!-- Payment Date -->
                        <div class="mb-3">
                            <label for="paymentDate" class="form-label">Payment Date</label>
                            <input type="date" class="form-control" id="paymentDate" name="paymentDate"
                                value="{{ $LoadPackage->paymentDate }}">
                        </div>

                        <!-- Payment Reference -->
                        <div class="mb-3">
                            <label for="paymentRef" class="form-label">Payment Reference</label>
                            <input type="text" class="form-control" id="paymentRef" name="paymentRef"
                                value="{{ $LoadPackage->paymentRef }}">
                        </div>

                        <!-- Tracking Number -->
                        <div class="mb-3">
                            <label for="trackingNumber" class="form-label">Tracking Number</label>
                            <input type="text" class="form-control" id="trackingNumber" name="trackingNumber"
                                value="{{ $LoadPackage->trackingNumber }}">
                        </div>

                        <!-- Tracking Status -->
                        <div class="mb-3">
                            <label for="trackingStatus" class="form-label">Tracking Status</label>
                            <select class="form-select" id="trackingStatus" name="trackingStatus">
                                <option value="pending" {{ $LoadPackage->trackingStatus == 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option value="delivered"
                                    {{ $LoadPackage->trackingStatus == 'delivered' ? 'selected' : '' }}>
                                    Delivered</option>
                                <option value="delayed" {{ $LoadPackage->trackingStatus == 'delayed' ? 'selected' : '' }}>
                                    Delayed
                                </option>
                                <option value="cancelled"
                                    {{ $LoadPackage->trackingStatus == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                                <option value="failed" {{ $LoadPackage->trackingStatus == 'failed' ? 'selected' : '' }}>
                                    Failed
                                </option>
                            </select>
                        </div>

                        <!-- Tracking URL -->
                        <div class="mb-3">
                            <label for="trackingUrl" class="form-label">Tracking URL</label>
                            <input type="url" class="form-control" id="trackingUrl" name="trackingUrl"
                                value="{{ $LoadPackage->trackingUrl }}">
                        </div>
                    </div>
                </div>

                <!-- Load Details Section -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h4>Load Details</h4>
                        <!-- Load Type -->
                        <div class="mb-3">
                            <label for="loadType" class="form-label">Load Type</label>
                            <select class="form-select" id="loadType" name="loadType">
                                <option value="full" {{ $LoadPackage->loadType == 'full' ? 'selected' : '' }}>Full
                                </option>
                                <option value="partial" {{ $LoadPackage->loadType == 'partial' ? 'selected' : '' }}>
                                    Partial
                                </option>
                            </select>
                        </div>

                        <!-- Load Number -->
                        <div class="mb-3">
                            <label for="loadNumber" class="form-label">Load Number</label>
                            <input type="text" class="form-control" id="loadNumber" name="loadNumber"
                                value="{{ $LoadPackage->loadNumber }}">
                        </div>

                        <!-- Load Date -->
                        <div class="mb-3">
                            <label for="loadDate" class="form-label">Load Date</label>
                            <input type="date" class="form-control" id="loadDate" name="loadDate"
                                value="{{ $LoadPackage->loadDate }}">
                        </div>

                        <!-- Load Time -->
                        <div class="mb-3">
                            <label for="loadTime" class="form-label">Load Time</label>
                            <input type="time" class="form-control" id="loadTime" name="loadTime"
                                value="{{ $LoadPackage->loadTime }}">
                        </div>

                        <!-- Load By -->
                        <div class="mb-3">
                            <label for="loadBy" class="form-label">Load By</label>
                            <input type="text" class="form-control" id="loadBy" name="loadBy"
                                value="{{ $LoadPackage->loadBy }}">
                        </div>

                        <!-- Load To -->
                        <div class="mb-3">
                            <label for="loadTo" class="form-label">Load To</label>
                            <input type="text" class="form-control" id="loadTo" name="loadTo"
                                value="{{ $LoadPackage->loadTo }}">
                        </div>

                        <!-- Load From -->
                        <div class="mb-3">
                            <label for="loadFrom" class="form-label">Load From</label>
                            <input type="text" class="form-control" id="loadFrom" name="loadFrom"
                                value="{{ $LoadPackage->loadFrom }}">
                        </div>

                        <!-- Load Status -->
                        <div class="mb-3">
                            <label for="loadStatus" class="form-label">Load Status</label>
                            <input type="text" class="form-control" id="loadStatus" name="loadStatus"
                                value="{{ $LoadPackage->loadStatus }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h4>Drop Details</h4>
                        <!-- Drop Date -->
                        <div class="mb-3">
                            <label for="dropDate" class="form-label">Drop Date</label>
                            <input type="date" class="form-control" id="dropDate" name="dropDate"
                                value="{{ $LoadPackage->dropDate }}">
                        </div>

                        <!-- Drop Time -->
                        <div class="mb-3">
                            <label for="dropTime" class="form-label">Drop Time</label>
                            <input type="time" class="form-control" id="dropTime" name="dropTime"
                                value="{{ $LoadPackage->dropTime }}">
                        </div>

                        <!-- Drop To -->
                        <div class="mb-3">
                            <label for="dropTo" class="form-label">Drop To</label>
                            <input type="text" class="form-control" id="dropTo" name="dropTo"
                                value="{{ $LoadPackage->dropTo }}">
                        </div>

                        <!-- Drop From -->
                        <div class="mb-3">
                            <label for="dropFrom" class="form-label">Drop From</label>
                            <input type="text" class="form-control" id="dropFrom" name="dropFrom"
                                value="{{ $LoadPackage->dropFrom }}">
                        </div>

                        <!-- Drop Status -->
                        <div class="mb-3">
                            <label for="dropStatus" class="form-label">Drop Status</label>
                            <input type="text" class="form-control" id="dropStatus" name="dropStatus"
                                value="{{ $LoadPackage->dropStatus }}">
                        </div>

                        <!-- Drop Approval -->
                        <div class="mb-3">
                            <label for="dropApproval" class="form-label">Drop Approval</label>
                            <input type="text" class="form-control" id="dropApproval" name="dropApproval"
                                value="{{ $LoadPackage->dropApproval }}">
                        </div>

                        <!-- Drop Notes -->
                        <div class="mb-3">
                            <label for="dropNotes" class="form-label">Drop Notes</label>
                            <textarea class="form-control" id="dropNotes" name="dropNotes" rows="3">{{ $LoadPackage->dropNotes }}</textarea>
                        </div>

                        <!-- Load Approval -->
                        <div class="mb-3">
                            <label for="loadApproval" class="form-label">Load Approval</label>
                            <input type="text" class="form-control" id="loadApproval" name="loadApproval"
                                value="{{ $LoadPackage->loadApproval }}">
                        </div>

                        <!-- Load Notes -->
                        <div class="mb-3">
                            <label for="loadNotes" class="form-label">Load Notes</label>
                            <textarea class="form-control" id="loadNotes" name="loadNotes" rows="3">{{ $LoadPackage->loadNotes }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update Load</button>
                </div>
            </form>
        </div>

    </div>
@endsection
