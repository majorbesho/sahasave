@extends('backend.layouts.master')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Banners</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
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
                                <h3 class="card-title">Add Baners <small>Add New groupn of product </small></h3>
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
                            <form id="quickForm" action="{{ route('groupro.store') }}" method="POST">
                                @csrf

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter title" value="{{ old('title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">start date</label>
                                        <input type="datetime-local" name="sdate" {{-- min="2023-06-07T00:00" max="2023-06-14T00:00" --}}
                                            {{-- pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}:[0-9]{2}" required --}} required class="form-control" id=""
                                            placeholder="Enter Start date" value="{{ old('sdate') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">end date</label>
                                        <input type="datetime-local" {{-- value="2023-01-12T19:30" --}} {{-- min="2023-01-07T00:00" max="2023-01-14T00:00" --}}
                                            {{-- pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}:[0-9]{2}" required --}} required name="edate" class="form-control"
                                            id="" placeholder="Enter end date" value="{{ old('edate') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">price</label>
                                        <input type="text" name="price" class="form-control" id=""
                                            placeholder="Enter price" value="{{ old('price') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">showPrice</label>
                                        <input type="text" name="showPrice" class="form-control" id=""
                                            placeholder="Enter showPrice" value="{{ old('showPrice') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">stock</label>
                                        <input type="number" name="stock" class="form-control" id=""
                                            placeholder="Enter stock" value="{{ old('stock') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">periodID</label>
                                        <input type="text" name="periodID" class="form-control" id=""
                                            placeholder="Enter periodID" value="{{ old('periodID') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">supplier</label>
                                        <input type="text" name="supplier" class="form-control" id=""
                                            placeholder="Enter supplier" value="{{ old('supplier') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">discreption</label>
                                        <textarea id="summernote" name="discreption" placeholder="Enter discreption">
                                            {{ old('discreption') }}
                                        </textarea>
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
                                    <div class="form-group">
                                        <label for="">Select your show</label>
                                        <select name="show">
                                            <option value="">---Select you option---</option>
                                            <option value="showin" {{ old('showx') == 'showin' ? 'selected' : '' }}>
                                                ---show---</option>
                                            <option value="notshow" {{ old('showx') == 'notshow' ? 'selected' : '' }}>
                                                ---notshow--</option>
                                        </select>
                                    </div>




                                    <div class="form-group mb-0">
                                        {{-- <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                        <label class="custom-control-label" for="exampleCheck1">Active .</label>
                                        </div> --}}
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
@endsection
