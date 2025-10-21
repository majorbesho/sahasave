@extends('backend.sellerbackend.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Load Package</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('supplier.home') }}">Home</a></li>
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add LoadPackage <small>Add New LoadPackage</small></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="col-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <ul><i>{{ $error }} </i></ul>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <form id="quickForm" action="{{ route('supplier-LoadPackage.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                {{-- 'shipment' => 'nullable|string', --}}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter title" value="{{ old('title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">name</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter name" value="{{ old('name') }}">
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="totalItems">totalItems</label>
                                                    <input type="text" name="totalItems" class="form-control"
                                                        id="exampleInputEmail1" placeholder="Enter total Items"
                                                        value="{{ old('totalItems') }}">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="totalDimensions">totalDimensions</label>
                                                    <input type="text" name="totalDimensions" class="form-control"
                                                        id="exampleInputEmail1" placeholder="Enter totalDimensions"
                                                        value="{{ old('totalDimensions') }}">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="totalLength">totalLength</label>
                                                    <input type="text" name="totalLength" class="form-control"
                                                        id="exampleInputEmail1" placeholder="Enter totalLength"
                                                        value="{{ old('totalLength') }}">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="totalWidth">totalWidth</label>
                                                    <input type="text" name="totalWidth" class="form-control"
                                                        id="exampleInputEmail1" placeholder="Enter totalWidth"
                                                        value="{{ old('totalWidth') }}">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="totalHeight">totalHeight</label>
                                                    <input type="text" name="totalHeight" class="form-control"
                                                        id="exampleInputEmail1" placeholder="Enter total Height "
                                                        value="{{ old('totalHeight') }}">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="weight">weight</label>
                                                    <input type="number" name="weight" class="form-control"
                                                        id="exampleInputEmail1" value=00.00 placeholder="Enter weight"
                                                        value="{{ old('weight') }}">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="contaner payment">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Select your payment Type</label>
                                                        <select name="paymentType">
                                                            <option value="">---Select you payment Type---</option>
                                                            <option value="cod"
                                                                {{ old('paymentType') == 'cod' ? 'selected' : '' }}>
                                                                ---cod---</option>
                                                            <option value="prepaid"
                                                                {{ old('paymentType') == 'prepaid' ? 'selected' : '' }}>
                                                                ---prepaid--</option>
                                                            <option value="prepaid_cod"
                                                                {{ old('paymentType') == 'prepaid_cod' ? 'selected' : '' }}>
                                                                ---prepaid_cod--</option>
                                                            <option value="prepaid_prepaid"
                                                                {{ old('paymentType') == 'prepaid_prepaid' ? 'selected' : '' }}>
                                                                ---prepaid_prepaid--</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Select your payment Status</label>
                                                        <select name="paymentStatus">
                                                            <option value="">---Select you paymentStatus---</option>
                                                            <option value="pending"
                                                                {{ old('paymentStatus') == 'pending' ? 'selected' : '' }}>
                                                                ---pending---</option>
                                                            <option value="paid"
                                                                {{ old('paymentStatus') == 'paid' ? 'selected' : '' }}>
                                                                ---paid--</option>
                                                            <option value="failed"
                                                                {{ old('paymentStatus') == 'failed' ? 'selected' : '' }}>
                                                                ---failed--</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Select your payment Method</label>
                                                        <select name="paymentMethod">
                                                            <option value="">---Select you payment Method---</option>
                                                            <option value="cash"
                                                                {{ old('paymentMethod') == 'cash' ? 'selected' : '' }}>
                                                                ---cash---</option>
                                                            <option value="cheque"
                                                                {{ old('paymentMethod') == 'cheque' ? 'selected' : '' }}>
                                                                ---cheque--</option>
                                                            <option value="online"
                                                                {{ old('paymentMethod') == 'online' ? 'selected' : '' }}>
                                                                ---online--</option>
                                                            <option value="wiretransfer"
                                                                {{ old('paymentMethod') == 'wiretransfer' ? 'selected' : '' }}>
                                                                ---wiretransfer--</option>
                                                            <option value="COD"
                                                                {{ old('paymentMethod') == 'COD' ? 'selected' : '' }}>
                                                                ---COD--</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="">paymentDate</label>

                                                                    <input type="date" name="paymentDate" required
                                                                        class="form-control" id=""
                                                                        placeholder="Enter Start paymentDate"
                                                                        value="{{ old('paymentDate') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="paymentRef">paymentRef</label>
                                                                    <input type="text" name="paymentRef"
                                                                        class="form-control" id="exampleInputEmail1"
                                                                        placeholder="Enter paymentRef"
                                                                        value="{{ old('paymentRef') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="trackingNumber">trackingNumber</label>
                                                    <input type="text" name="trackingNumber" class="form-control"
                                                        id="exampleInputEmail1" placeholder="Enter trackingNumber"
                                                        value="{{ old('trackingNumber') }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="">Select your tracking Status</label>
                                                    <select name="trackingStatus">
                                                        <option value="">---Select you tracking Status---</option>
                                                        <option value="pending"
                                                            {{ old('paymentMethod') == 'pending' ? 'selected' : '' }}>
                                                            ---pending---</option>
                                                        <option value="delivered"
                                                            {{ old('paymentMethod') == 'delivered' ? 'selected' : '' }}>
                                                            ---delivered--</option>
                                                        <option value="delayed"
                                                            {{ old('paymentMethod') == 'delayed' ? 'selected' : '' }}>
                                                            ---delayed--</option>
                                                        <option value="cancelled"
                                                            {{ old('paymentMethod') == 'cancelled' ? 'selected' : '' }}>
                                                            ---cancelled--</option>
                                                        <option value="failed"
                                                            {{ old('paymentMethod') == 'failed' ? 'selected' : '' }}>
                                                            ---failed--</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="trackingUrl">trackingUrl</label>
                                                    <input type="text" name="trackingUrl" class="form-control"
                                                        id="exampleInputEmail1" placeholder="Enter trackingUrl"
                                                        value="{{ old('trackingUrl') }}">
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="">Select your loadType </label>
                                                    <select name="loadType">
                                                        <option value="">---Select you loadType ---</option>
                                                        <option value="full"
                                                            {{ old('loadType') == 'full' ? 'selected' : '' }}>
                                                            ---full---</option>
                                                        <option value="partial"
                                                            {{ old('loadType') == 'partial' ? 'selected' : '' }}>
                                                            ---partial--</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="loadNumber">loadNumber</label>
                                                    <input type="text" name="loadNumber" class="form-control"
                                                        id="exampleInputEmail1" placeholder="Enter loadNumber"
                                                        value="{{ old('loadNumber') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">loadDate</label>
                                                    <input type="date" name="loadDate" required class="form-control"
                                                        id="" placeholder="Enter Start paymentDate"
                                                        value="{{ old('loadDate') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">loadTime</label>
                                                    <input type="time" name="loadTime" required class="form-control"
                                                        id="" placeholder="Enter Start loadTime"
                                                        value="{{ old('loadTime') }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="">loadBy</label>
                                                    <input type="text" name="loadBy" required class="form-control"
                                                        id="" placeholder="Enter Start loadBy"
                                                        value="{{ old('loadBy') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">loadTo</label>
                                                    <input type="text" name="loadTo" required class="form-control"
                                                        id="" placeholder="Enter Start loadBy"
                                                        value="{{ old('loadBy') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">loadFrom</label>
                                                    <input type="text" name="loadFrom" required class="form-control"
                                                        id="" placeholder="Enter Start loadFrom"
                                                        value="{{ old('loadFrom') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">loadStatus</label>
                                                    <input type="text" name="loadStatus" required class="form-control"
                                                        id="" placeholder="Enter Start loadStatus"
                                                        value="{{ old('loadStatus') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">loadApproval</label>
                                                    <input type="text" name="loadApproval" required
                                                        class="form-control" id=""
                                                        placeholder="Enter Start loadApproval"
                                                        value="{{ old('loadApproval') }}">
                                                </div>
                                                <div class="form-group">

                                                    <label for="slug">loadNotes</label>
                                                    <textarea id="summernote1" name="loadNotes" placeholder="Enter loadNotes">
                                                            {{ old('loadNotes') }}
                                                        </textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="">dropDate</label>
                                                    <input type="date" name="dropDate" required class="form-control"
                                                        id="" placeholder="Enter Start dropDate"
                                                        value="{{ old('dropDate') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">dropTime</label>
                                                    <input type="time" name="dropTime" required class="form-control"
                                                        id="" placeholder="Enter Start dropTime"
                                                        value="{{ old('dropTime') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">dropTo</label>
                                                    <input type="text" name="dropTo" required class="form-control"
                                                        id="" placeholder="Enter Start dropTo"
                                                        value="{{ old('dropTo') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">dropFrom</label>
                                                    <input type="text" name="dropFrom" required class="form-control"
                                                        id="" placeholder="Enter Start dropFrom"
                                                        value="{{ old('dropFrom') }}">
                                                </div>


                                                <div class="form-group">
                                                    <label for="">Select your dropStatus</label>
                                                    <select name="trackingStatus">
                                                        <option value="">---Select you drop Status ---</option>
                                                        <option value="pending"
                                                            {{ old('dropStatus') == 'pending' ? 'selected' : '' }}>
                                                            ---pending---</option>
                                                        <option value="delivered"
                                                            {{ old('dropStatus') == 'delivered' ? 'selected' : '' }}>
                                                            ---delivered--</option>
                                                        <option value="delayed"
                                                            {{ old('dropStatus') == 'delayed' ? 'selected' : '' }}>
                                                            ---delayed--</option>
                                                        <option value="cancelled"
                                                            {{ old('dropStatus') == 'cancelled' ? 'selected' : '' }}>
                                                            ---cancelled--</option>
                                                        <option value="failed"
                                                            {{ old('dropStatus') == 'failed' ? 'selected' : '' }}>
                                                            ---failed--</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">dropApproval</label>
                                                    <input type="text" name="dropApproval" required
                                                        class="form-control" id=""
                                                        placeholder="Enter Start dropApproval"
                                                        value="{{ old('dropApproval') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">dropNotes</label>
                                                    <textarea id="summernote2" name="dropNotes" placeholder="Enter dropNotes">
                                                        {{ old('dropNotes') }}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                        <input id="thumbnail" class="form-control" type="text" name="photo">
                                    </div>
                                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>

                                    <div class="form-group">
                                        <label for="">Select your option</label>
                                        <select name="status">
                                            <option value="">---Select you option---</option>
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                                ---active---</option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                ---inactive--</option>
                                        </select>
                                    </div>



                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
        //    $('#lfm').filemanager('file');
    </script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#summernote1').summernote();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#summernote2').summernote();
        });
    </script>
@endsection
