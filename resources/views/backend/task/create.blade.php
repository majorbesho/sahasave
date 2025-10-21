@extends('backend.layouts.master')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>tasks</h1>
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
                                <h3 class="card-title">Add tasks <small>Add New tasks</small></h3>
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
                            <form id="quickForm" action="{{ route('task.store') }}" method="POST">
                                @csrf





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
                                    <div class="form-group">
                                        <label for="instrac">instrac</label>
                                        <input type="text" name="instrac" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter instrac" value="{{ old('instrac') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="user_id">user_id</label>
                                        <input type="text" name="user_id" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter user_id" value="{{ old('user_id') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="reward_points">reward_points</label>
                                        <input type="text" name="reward_points" class="form-control"
                                            id="exampleInputEmail1" placeholder="Enter reward_points"
                                            value="{{ old('reward_points') }}">
                                    </div>



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
@endsection
