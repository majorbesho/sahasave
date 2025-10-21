@extends('backend.layouts.master')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Update tasks</h1>
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
                                <h3 class="card-title">Update tasks <small>Update tasks</small></h3>
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
                            <form id="quickForm" action="{{ route('task.update', $task->id) }}" method="POST">
                                @csrf
                                @method('patch')
                                <div class="card-body">



                                    'user_id',
                                    'reward_points',


                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter title" value="{{ $task->title }}">
                                    </div>


                                    <div class="form-group">
                                        <label for="name">name</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter name" value="{{ $task->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="instrac">instrac</label>
                                        <input type="text" name="instrac" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter instrac" value="{{ $task->instrac }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="user_id">user_id</label>
                                        <input type="text" name="smallTitle" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter user_id" value="{{ $task->user_id }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="reward_points">reward_points</label>
                                        <input type="text" name="reward_points" class="form-control"
                                            id="exampleInputEmail1" placeholder="Enter reward_points"
                                            value="{{ $task->reward_points }}">
                                    </div>

                                    <div class="form-group">
                                        <select name="status"> Select your option
                                            <option value="acive">---Select you option---</option>
                                            <option value="active" {{ $task->status == 'active' ? 'selected' : '' }}>
                                                ---active---</option>
                                            <option value="inactive" {{ $task->status == 'inactive' ? 'selected' : '' }}>
                                                ---inactive--</option>
                                        </select>
                                    </div>




                                    <div class="form-group mb-0">

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
@endsection
