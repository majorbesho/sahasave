
@extends('backend.layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
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
                <h3 class="card-title">Edit User  <small>Edit  User</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                            @foreach ($errors->all() as $error )
                             <ul><i>{{$error}} </i></ul>
                            @endforeach
                    </div>
                @endif
              </div>
              <form id="quickForm" action="{{route('emp.update',$emp->id)}}" method="POST">
                @csrf
                @method('patch')
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" name="name"
                    class="form-control" id="exampleInputEmail1"
                    placeholder="Enter name" value="{{$emp->name}}">
                  </div>
                  <div class="form-group">
                    <label for="email">email</label>
                    <input type="email" name="email"
                    class="form-control" id="exampleInputEmail1"
                    placeholder="Enter email" value="{{$emp->email}}">
                  </div>
                  <div class="form-group">
                    <label for="password">password</label>
                    <input type="password" name="password"
                    class="form-control" id="exampleInputEmail1"
                    placeholder="Enter password" value="{{$emp->password}}">
                  </div>
                  <div class="form-group">
                    <label for="password">confirm password</label>
                    <input type="password" name="password"
                    class="form-control" id="exampleInputEmail1"
                    placeholder="Enter password agin" value="{{$emp->password}}">
                  </div>

                  <div class="form-group">
                    <label for="phone">phone</label>
                    <input type="text" name="phone"
                    class="form-control" id="exampleInputEmail1"
                    placeholder="Enter phone" value="{{$emp->phone}}">
                  </div>

                  <div class="form-group">
                    <label for="repcode">repcode</label>
                    <input type="text" name="repcode"
                    class="form-control" id="exampleInputEmail1"
                    placeholder="Enter repcode" value="{{$emp->repcode}}">
                  </div>




                  <div class="input-group">
                    <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail"
                      data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose photo
                      </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" name="photo">
                  </div>
                  <img src=" {{$emp->photo}}" id="holder" style="margin-top:15px;max-height:100px;"></img>

                   <div class="form-group">
                    <select name="status"> Select your option
                        <option value="" >---Select you option---</option>
                        <option value="active" {{$emp->status=='active' ? 'selected':''  }}>---active---</option>
                        <option value="inactive" {{$emp->status=='inactive' ? 'selected':''  }}>---inactive--</option>
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
