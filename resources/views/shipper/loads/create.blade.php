@extends('shipper.minlayout.master')



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

            <h1 class="mb-4">Create New Load</h1>
            <form action="{{ route('loads.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Column 1 -->
                    <div class="col-md-6">
                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="discreption" class="form-label">Description</label>
                            <textarea class="form-control" id="discreption" name="discreption" rows="3"></textarea>
                        </div>

                        <!-- Photo -->



                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label mb-2 d-block">Status</label>
                            <select class="form-select w-100" id="status" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="row" style="justify-content: space-around;">
                            <div class="mb-3">
                                <label for="totalItems" class="form-label">Total Items(number)</label>
                                <input type="number" class="form-control" id="totalItems" name="totalItems">
                            </div>

                            <!-- Total Dimensions -->
                            <div class="mb-3">
                                <label for="totalDimensions" class="form-label">Total Dimensions (m)</label>
                                <input type="text" class="form-control" id="totalDimensions" name="totalDimensions">
                            </div>

                            <!-- Total Length -->
                            <div class="mb-3">
                                <label for="totalLength" class="form-label">Total Length(m)</label>
                                <input type="text" class="form-control" id="totalLength" name="totalLength">
                            </div>

                            <!-- Total Width -->
                            <div class="mb-3">
                                <label for="totalWidth" class="form-label">Total Width(m)</label>
                                <input type="text" class="form-control" id="totalWidth" name="totalWidth">
                            </div>

                        </div>
                        <div class="row" style="justify-content: space-around;">
                            <div class="mb-3">
                                <label for="totalHeight" class="form-label">Total Height(m)</label>
                                <input type="text" class="form-control" id="totalHeight" name="totalHeight">
                            </div>

                            <!-- Weight -->
                            <div class="mb-3">
                                <label for="weight" class="form-label">Weight(kg)</label>
                                <input type="number" class="form-control" id="weight" name="weight" step="0.01">
                            </div>

                        </div>
                        <!-- Total Items -->


                    </div>

                    <!-- Column 2 -->
                    <div class="col-md-6">
                        <!-- Shipment -->


                        <div class="mb-4"> <!-- زيادة الـ margin-bottom -->
                            <label for="shipment" class="form-label mb-2 d-block"> <!-- إضافة margin-bottom -->
                                Shipment
                            </label>
                            <select class="form-select w-100" id="shipment" name="shipment"> <!-- عرض كامل -->
                                <option value="all">All</option>
                                <option value="favorite">Favorite</option>
                            </select>
                        </div>



                        <!-- Payment Type -->





                        <div class="mb-3">
                            <label for="paymentType" class="form-label mb-2 d-block">Payment Type</label>
                            <select class="form-select w-100" id="paymentType" name="paymentType">
                                <option value="cod">COD</option>
                                <option value="prepaid">Prepaid</option>
                                <option value="prepaid_cod">Prepaid + COD</option>
                                <option value="prepaid_prepaid">Prepaid + Prepaid</option>
                            </select>
                        </div>

                        <!-- Payment Status -->
                        {{-- <div class="mb-3">
                        <label for="paymentStatus" class="form-label">Payment Status</label>
                        <select class="form-select" id="paymentStatus" name="paymentStatus">
                            <option value="pending">Pending</option>
                            <option value="paid">Paid</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div> --}}

                        <!-- Payment Method -->
                        <div class="mb-3">
                            <label for="paymentMethod" class="form-label mb-2 d-block">Payment Method</label>
                            <select class="form-select w-100" id="paymentMethod" name="paymentMethod">
                                <option value="cash">Cash</option>
                                <option value="cheque">Cheque</option>
                                <option value="online">Online</option>
                                <option value="wire transfer">Wire Transfer</option>
                            </select>
                        </div>

                        <!-- Payment Date -->
                        <div class="mb-3">
                            <label for="paymentDate" class="form-label">Payment Date</label>
                            <input type="date" class="form-control" id="paymentDate" name="paymentDate">
                        </div>

                        <!-- Payment Reference -->
                        {{-- <div class="mb-3">
                        <label for="paymentRef" class="form-label">Payment Reference</label>
                        <input type="text" class="form-control" id="paymentRef" name="paymentRef">
                    </div> --}}

                        <!-- Tracking Number -->
                        <div class="mb-3">
                            <label for="trackingNumber" class="form-label">Tracking Number</label>
                            <input type="text" class="form-control" id="trackingNumber" name="trackingNumber">
                        </div>

                        <!-- Tracking Status -->
                        <div class="mb-3">
                            <label for="trackingStatus" class="form-label mb-2 d-block">Tracking Status</label>
                            <select class="form-select w-100" id="trackingStatus" name="trackingStatus">
                                <option value="pending">Pending</option>
                                <option value="delivered">Delivered</option>
                                <option value="delayed">Delayed</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>

                        <!-- Tracking URL -->
                        <div class="mb-3">
                            <label for="trackingUrl" class="form-label">Tracking URL</label>
                            <input type="url" class="form-control" id="trackingUrl" name="trackingUrl">
                        </div>
                    </div>
                </div>

                <!-- Load Details Section -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h4>Load Details</h4>
                        <!-- Load Type -->
                        <div class="mb-3">
                            <label for="loadType" class="form-label mb-2 d-block">Load Type</label>
                            <select class="form-select w-100" id="loadType" name="loadType">
                                <option value="full">Full</option>
                                <option value="partial">Partial</option>
                            </select>
                        </div>

                        <!-- Load Number -->
                        {{-- <div class="mb-3">
                        <label for="loadNumber" class="form-label">Load Number</label>
                        <input type="text" class="form-control" id="loadNumber" name="loadNumber">
                    </div> --}}

                        <!-- Load Date -->
                        <div class="row" style="justify-content: space-around;">
                            <div class="mb-3">
                                <label for="loadDate" class="form-label">Load Date</label>
                                <input type="date" class="form-control" id="loadDate" name="loadDate">
                            </div>

                            <!-- Load Time -->
                            <div class="mb-3">
                                <label for="loadTime" class="form-label">Load Time</label>
                                <input type="time" class="form-control" id="loadTime" name="loadTime">
                            </div>
                        </div>



                        <div class="row" style="justify-content: space-around;">
                            <div class="mb-3">
                                <label for="loadTo" class="form-label">Load To</label>
                                <input type="text" class="form-control" id="loadTo" name="loadTo">
                            </div>

                            <!-- Load From -->
                            <div class="mb-3">
                                <label for="loadFrom" class="form-label">Load From</label>
                                <input type="text" class="form-control" id="loadFrom" name="loadFrom">
                            </div>
                        </div>
                        <!-- Load By -->
                        <div class="mb-3">
                            <label for="loadBy" class="form-label">Load By</label>
                            <input type="text" class="form-control" id="loadBy" name="loadBy">
                        </div>

                        <!-- Load To -->
                        <!-- Load Status -->
                        <div class="mb-3">
                            <label for="loadStatus" class="form-label">Load Status</label>
                            <input type="text" class="form-control" id="loadStatus" name="loadStatus">
                        </div>


                        <div class="mb-3">
                            <label for="loadApproval" class="form-label">Load Approval</label>
                            <input type="text" class="form-control" id="loadApproval" name="loadApproval">
                        </div>

                        <!-- Load Notes -->
                        <div class="mb-3">
                            <label for="loadNotes" class="form-label">Load Notes</label>
                            <textarea class="form-control" id="loadNotes" name="loadNotes" rows="3"></textarea>
                        </div>


                    </div>

                    <div class="col-md-6">
                        <h4>Drop Details</h4>
                        <!-- Drop Date -->

                        <div class="row" style="justify-content: space-around;">
                            <div class="mb-3">
                                <label for="dropDate" class="form-label">Drop Date</label>
                                <input type="date" class="form-control" id="dropDate" name="dropDate">
                            </div>

                            <!-- Drop Time -->
                            <div class="mb-3">
                                <label for="dropTime" class="form-label">Drop Time</label>
                                <input type="time" class="form-control" id="dropTime" name="dropTime">
                            </div>
                        </div>


                        <!-- Drop To -->
                        <div class="row" style="justify-content: space-around;">
                            <div class="mb-3">
                                <label for="dropTo" class="form-label">Drop To</label>
                                <input type="text" class="form-control" id="dropTo" name="dropTo">
                            </div>

                            <!-- Drop From -->
                            <div class="mb-3">
                                <label for="dropFrom" class="form-label">Drop From</label>
                                <input type="text" class="form-control" id="dropFrom" name="dropFrom">
                            </div>
                        </div>


                        <!-- Drop Status -->
                        <div class="mb-3">
                            <label for="dropStatus" class="form-label">Drop Status</label>
                            <input type="text" class="form-control" id="dropStatus" name="dropStatus">
                        </div>

                        <!-- Drop Approval -->
                        <div class="mb-3">
                            <label for="dropApproval" class="form-label">Drop Approval</label>
                            <input type="text" class="form-control" id="dropApproval" name="dropApproval">
                        </div>

                        <!-- Drop Notes -->
                        <div class="mb-3">
                            <label for="dropNotes" class="form-label">Drop Notes</label>
                            <textarea class="form-control" id="dropNotes" name="dropNotes" rows="3"></textarea>
                        </div>

                        <!-- Load Approval -->

                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Create Load</button>
                </div>
            </form>
        </div>
    </div>
@endsection
