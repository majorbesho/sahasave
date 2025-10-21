@extends('backend.layouts.master')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Update ref Categeory</h1>
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
                                <h3 class="card-title">Update ref Categeory <small>Update ref Categeory</small></h3>
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
                            <form id="quickForm" action="{{ route('ref_category.update', $refgategory->id) }}"
                                method="POST">
                                @csrf
                                @method('patch')
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" class="form-control"
                                                id="exampleInputEmail1" placeholder="Enter title"
                                                value="{{ $refgategory->title }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">name</label>
                                            <input type="text" name="name" class="form-control"
                                                id="exampleInputEmail1" placeholder="Enter name"
                                                value="{{ $refgategory->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_id">user_id</label>
                                            <input type="text" name="user_id" class="form-control"
                                                id="exampleInputEmail1" placeholder="Enter user_id"
                                                value="{{ $refgategory->user_id }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">congratulatory_message</label>
                                            <textarea id="summernote2" name="congratulatory_message" placeholder="Enter congratulatory_message">
                                            {{ $refgategory->congratulatory_message }}
                                            </textarea>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="taget_no_ref">taget_no_ref</label>
                                                    <input type="text" name="taget_no_ref" class="form-control"
                                                        id="exampleInputEmail1" placeholder="Enter taget_no_ref"
                                                        value="{{ $refgategory->taget_no_ref }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="ref_count">ref_count</label>
                                                    <input type="text" name="ref_count" class="form-control"
                                                        id="exampleInputEmail1" placeholder="Enter ref_count"
                                                        value="{{ $refgategory->ref_count }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="ref_viset">ref_viset</label>
                                                    <input type="text" name="bigTitle" class="form-control"
                                                        id="exampleInputEmail1" placeholder="Enter ref_viset"
                                                        value="{{ $refgategory->ref_viset }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="ref_buy">ref_buy</label>
                                                    <input type="text" name="ref_buy" class="form-control"
                                                        id="exampleInputEmail1" placeholder="Enter ref_buy"
                                                        value="{{ $refgategory->ref_buy }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">discreption</label>
                                            <textarea id="summernote" name="discreption" placeholder="Enter discreption">
                                            {{ $refgategory->description }}
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
                                                <option value="active"
                                                    {{ $refgategory->status == 'active' ? 'selected' : '' }}>---active---
                                                </option>
                                                <option value="inactive"
                                                    {{ $refgategory->status == 'inactive' ? 'selected' : '' }}>---inactive--
                                                </option>
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
                                        <button type="submit" class="btn btn-primary">Update</button>
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
            $('#summernote2').summernote();
        });
    </script>
@endsection
