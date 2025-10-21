@extends('frontend.layouts.master')


@section('content')


    <style>
        .fa,
        .fas {
            color: #Fabc3f;
            font-family: 'Font Awesome 5 Pro';
            font-weight: 900;
            font-size: 18px
        }

        .fab {
            color: #Fabc3f;
            font-size: 18px
        }
    </style>


    <div class="container-fluid" style="padding-top: 2%;">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="container">
                    <div class="row">


                        <table style="color: #000" class="styled-table">
                            <thead style="">
                                <tr>
                                    <th>
                                        <i style="color: #007bff" class="fas fa-map-marker-alt ">
                                        </i>Location From
                                    </th>
                                    <th><i style="color: #007bff" class="fas fa-map-marker-alt "> </i>Location To</th>
                                    <th><i style="color: #007bff" class="fas fa-weight-hanging "> </i>Weight</th>
                                    <th><i style="color: #007bff" class="fas fa-ruler-horizontal "> </i>lenght</th>
                                    <th><i style="color: #007bff" class="fas fa-truck "> </i>Truck Type</th>
                                    <th><i style="color: #007bff" class="fas fa-calendar-alt "> </i>Date </th>
                                    <th><i style="color: #007bff" class="fas fa-dollar-sign "> </i>Price</th>
                                    <th><i style="color: #007bff" class="fas fa-id-card"> </i>Contact Info</th>
                                </tr>
                            </thead>
                            <tbody>



                                <tr>



                                    <td>
                                        {{ $gop->origin }}</td>
                                    <td>
                                        {{ $gop->destination }}</td>
                                    <td>
                                        {{ $gop->weight }}</td>
                                    <td>
                                        {{ $gop->lenght }}</td>

                                    <td>
                                        {{ $gop['cat']['title'] ?? 'No Category' }}</td>
                                    <td>
                                        {{ number_format($gop->price, 2) }}</td>

                                    <td> @php
                                        $date = \Carbon\Carbon::parse($gop->date);
                                    @endphp

                                        <span class="widget-49-date-day">{{ $day = $date->day }}</span>/
                                        <span class="widget-49-date-month">{{ $day = $date->month }}
                                        </span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="https://wa.me/{{ $gop->phone }}" target="_blank" class="icon-link"
                                            title="WhatsApp">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <!-- Email Icon -->
                                        <a href="{{ route('makeoffer', $gop->slug) }}" class="icon-link" title="Email">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                        <!-- Details Icon -->
                                        <a href="{{ route('makeoffer', $gop->slug) }}" class="icon-link" title="Details"
                                            data-toggle="modal" data-target="#contactModal">
                                            <i class="fas fa-phone"></i>
                                        </a>
                                    </td>

                                </tr>

                            </tbody>
                        </table>



                        {{-- <div class="container my-5">
                            <div class="card mb-4">
                                <div class="card-body" style="color: #0a0a0a">
                                    <h5 class="card-title"><i class="fas fa-map-marker-alt"></i>{{ $gop->origin }},
                                        To / {{ $gop->destination }}</h5>
                                    <p class="card-text">
                                        <strong> <i class="fas fa-dollar-sign"></i>8
                                            {{ number_format($gop->price, 2) }}</strong>
                                    </p>
                                    <p class="card-text"><i class="fas fa-truck-moving"></i>
                                        {{ $gop['cat']['title'] ?? 'No Category' }}
                                        - wire:{{ $gop->weight }} / Ton -
                                        {{ $gop->lenght }}/M
                                    </p>
                                    <p>
                                        {!! $gop->notice !!}
                                    </p>
                                    @php
                                        $date = \Carbon\Carbon::parse($gop->date);
                                    @endphp
                                    <p>
                                        <i class="fas fa-user-alt"></i> {{ $gop->name }}
                                    </p>
                                    <p class="card-text"><i class="fas fa-calendar-alt"></i> PICK
                                        UP:{{ $day = $date->month }} /{{ $day = $date->day }}
                                    </p>
                                    <p class="card-text"><i class="fas fa-map-marker-alt"></i></p>
                                    <a href="{{ route('makeoffer', $gop->slug) }}" class="btn btn-primary"><i
                                            class="fas fa-handshake"></i> Offer
                                        Now</a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <!--End Blog One Single-->


            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {{-- <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Load Package</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid --> --}}
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
                                <h3 class="card-title">Add Your Truck Info</h3>
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
                            @if (Auth::check())
                                <form id="quickForm" action="{{ route('LoadPackage.store') }}" method="POST">
                                    @csrf
                                    {{-- 'shipment' => 'nullable|string', --}}
                                    <div class="card-body">
                                        {{-- <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" class="form-control"
                                                id="exampleInputEmail1" placeholder="Enter Name"
                                                value="{{ old('title') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">name</label>
                                            <input type="text" name="name" class="form-control"
                                                id="exampleInputEmail1" placeholder="Enter name"
                                                value="{{ old('name') }}">
                                        </div> --}}
                                        {{-- <div class="container">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="totalItems">total Items</label>
                                                        <input type="text" name="total Items" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Enter total Items"
                                                            value="{{ old('totalItems') }}">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="totalDimensions">Total Dimensions</label>
                                                        <input type="text" name="totalDimensions" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Enter total Dimensions"
                                                            value="{{ old('totalDimensions') }}">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="totalLength">total Length</label>
                                                        <input type="text" name="totalLength" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Enter total Length"
                                                            value="{{ old('totalLength') }}">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="totalWidth">total Width</label>
                                                        <input type="text" name="totalWidth" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Enter total Width"
                                                            value="{{ old('totalWidth') }}">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="totalHeight">total Height</label>
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
                                                                <option value="">---Select you payment
                                                                    Type---
                                                                </option>
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
                                                            <label for="">Select your payment
                                                                Status</label>
                                                            <select name="paymentStatus">
                                                                <option value="">---Select you payment
                                                                    Status---
                                                                </option>
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
                                                            <label for="">Select your payment
                                                                Method</label>
                                                            <select name="paymentMethod">
                                                                <option value="">---Select you payment
                                                                    Method---
                                                                </option>
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

                                                    <div class="col-4 pt-20" style="padding-top: 6%;">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="">payment Date</label>

                                                                        <input type="date" name="paymentDate" required
                                                                            class="form-control" id=""
                                                                            placeholder="Enter Start payment Date"
                                                                            value="{{ old('paymentDate') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="paymentRef">payment Ref</label>
                                                                        <input type="text" name="payment Ref"
                                                                            class="form-control" id="exampleInputEmail1"
                                                                            placeholder="Enter payment Ref"
                                                                            value="{{ old('paymentRef') }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="trackingNumber">tracking Number</label>
                                                        <input type="text" name="trackingNumber" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Enter trackingNumber"
                                                            value="{{ old('trackingNumber') }}">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="">Select your tracking Status</label>
                                                        <select name="trackingStatus">
                                                            <option value="">---Select you tracking Status---
                                                            </option>
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
                                                {{-- <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="trackingUrl">tracking Url</label>
                                                        <input type="text" name="trackingUrl" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Enter tracking Url"
                                                            value="{{ old('trackingUrl') }}">
                                                    </div>

                                                </div> --}}
                                            </div>
                                        </div>

                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Select your loadType </label>
                                                        <select name="loadType">
                                                            <option value="">---Select you loadType ---
                                                            </option>
                                                            <option value="full"
                                                                {{ old('loadType') == 'full' ? 'selected' : '' }}>
                                                                ---full---</option>
                                                            <option value="partial"
                                                                {{ old('loadType') == 'partial' ? 'selected' : '' }}>
                                                                ---partial--</option>
                                                        </select>
                                                    </div>
                                                    {{-- <div class="form-group">
                                                        <label for="loadNumber">load Number</label>
                                                        <input type="text" name="loadNumber" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Enter load Number"
                                                            value="{{ old('loadNumber') }}">
                                                    </div> --}}
                                                    {{-- <div class="form-group">
                                                        <label for="">loadDate</label>
                                                        <input type="date" name="loadDate" required
                                                            class="form-control" id=""
                                                            placeholder="Enter Start paymentDate"
                                                            value="{{ old('loadDate') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">loadTime</label>
                                                        <input type="time" name="loadTime" required
                                                            class="form-control" id=""
                                                            placeholder="Enter Start load Time"
                                                            value="{{ old('loadTime') }}">
                                                    </div> --}}

                                                    <div class="form-group">
                                                        <label for="">loadBy</label>
                                                        <input type="text" name="loadBy" required class="form-control"
                                                            id="" placeholder="Enter Start load By"
                                                            value="{{ old('loadBy') }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">load To</label>
                                                        <input type="text" name="loadTo" required
                                                            class="form-control" id=""
                                                            placeholder="Enter Start load By"
                                                            value="{{ old('loadBy') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">load From</label>
                                                        <input type="text" name="loadFrom" required
                                                            class="form-control" id=""
                                                            placeholder="Enter Start load From"
                                                            value="{{ old('loadFrom') }}">
                                                    </div>
                                                    {{-- <div class="form-group">
                                                        <label for="">load Status</label>
                                                        <input type="text" name="loadStatus" required
                                                            class="form-control" id=""
                                                            placeholder="Enter Start load Status"
                                                            value="{{ old('loadStatus') }}">
                                                    </div> --}}
                                                    {{-- <div class="form-group">
                                                        <label for="">loadApproval</label>
                                                        <input type="text" name="loadApproval" required
                                                            class="form-control" id=""
                                                            placeholder="Enter Start load Approval"
                                                            value="{{ old('loadApproval') }}">
                                                    </div> --}}
                                                    <div class="form-group">

                                                        <label for="slug">load Notes</label>
                                                        <textarea id="summernote1" name="loadNotes" placeholder="Enter load Notes">
                                                            {{ old('loadNotes') }}
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label for="">drop Date</label>
                                                        <input type="date" name="dropDate" required
                                                            class="form-control" id=""
                                                            placeholder="Enter Start drop Date"
                                                            value="{{ old('dropDate') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">drop Time</label>
                                                        <input type="time" name="dropTime" required
                                                            class="form-control" id=""
                                                            placeholder="Enter Start drop Time"
                                                            value="{{ old('dropTime') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">drop To</label>
                                                        <input type="text" name="dropTo" required
                                                            class="form-control" id=""
                                                            placeholder="Enter Start dropTo" value="{{ old('dropTo') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">drop From</label>
                                                        <input type="text" name="dropFrom" required
                                                            class="form-control" id=""
                                                            placeholder="Enter Start drop From"
                                                            value="{{ old('dropFrom') }}">
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="">Select your drop Status</label>
                                                        <select name="trackingStatus">
                                                            <option value="">---Select you drop Status ---
                                                            </option>
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

                                                    {{-- <div class="form-group">
                                                        <label for="">drop Approval</label>
                                                        <input type="text" name="dropApproval" required
                                                            class="form-control" id=""
                                                            placeholder="Enter Start drop Approval"
                                                            value="{{ old('dropApproval') }}">
                                                    </div> --}}
                                                    <div class="form-group">
                                                        <label for="">dropNotes</label>
                                                        <textarea id="summernote2" name="dropNotes" placeholder="Enter drop Notes">
                                                        {{ old('dropNotes') }}
                                                    </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            @elseif (Auth::guest())
                                <div class="container"
                                    style="
                                        padding-top: 7%;
                                        padding-bottom: 7%;
                                    ">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-center pt-8 center-text">
                                                <h1>
                                                    <span class="text-primary">Please
                                                    </span>

                                                    <a href="{{ route('newreg') }}">Sign Up
                                                        <i class="icon-right-arrow21"></i>
                                                    </a>
                                                </h1>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif
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


    <script>
        $('#summernote1').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
    </script>
    <script>
        $('#summernote2').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
    </script>



@endsection
@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('image');
        //    $('#lfm').filemanager('file');
    </script>

    <!--Start Blog One Single-->



    </div>

    </div>
    <div class="quotes-weight">


    </div>
@endsection
