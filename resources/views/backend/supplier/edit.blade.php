
@extends('backend.layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Suppliers </h1>
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
                <h3 class="card-title">Update Suppliers  <small>Update Suppliers</small></h3>
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
              <form id="quickForm" action="{{route('supplier.update',$supplier->id)}}" method="POST">
                @csrf
                @method('patch')
                <div class="card-body">

                    {{-- {{$supplier-> --}}

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title"
                        class="form-control" id="exampleInputEmail1"
                        placeholder="Enter title" value="{{$supplier->title}}">
                      </div>

                    <div class="form-group">
                        <label for="">contact tele</label>
                        <input type="text" name="contactNo"
                        class="form-control" id=""
                        placeholder="Enter Start date" value="{{$supplier->contactNo}}">
                      </div>
                      <div class="form-group">
                        <label for="">res Name</label>
                        <input  type="text"
                        name="resName"
                        class="form-control" id=""
                        placeholder="Enter resName" value="{{$supplier->resName}}">
                      </div>
                      <div class="form-group">
                        <label for="">email</label>
                        <input type="email" name="email"
                        class="form-control" id=""
                        placeholder="Enter email" value="{{$supplier->email}}">
                      </div>
                      <div class="form-group">
                        <label for="">tele</label>
                        <input type="tele" name="tele"
                        class="form-control" id=""
                        placeholder="Enter tele" value="{{$supplier->tele}}">
                      </div>
                      <div class="form-group">
                        <label for="">web</label>
                        <input type="url" name="web"
                        class="form-control" id=""
                        placeholder="Enter web" value="{{$supplier->web}}">
                      </div>
                      <div class="form-group">
                        <label for="">company</label>
                        <input type="text" name="company"
                        class="form-control" id=""
                        placeholder="Enter company" value="{{$supplier->company}}">
                      </div>
                      <div class="form-group">
                        <label for="slug">nots</label>
                        <textarea id="summernote1" name="nots"
                        placeholder="Enter nots" >
                        {{$supplier->nots}}
                        </textarea>
                      </div>
                      <div class="form-group">
                        <label for="slug">discreption</label>
                        <textarea id="summernote" name="discreption"
                        placeholder="Enter discreption" >
                        {{$supplier->discreption}}
                        </textarea>
                      </div>


                        <div class="input-group">
                          <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                              <i class="fa fa-picture-o"></i> Choose
                            </a>
                          </span>
                          <input id="thumbnail" class="form-control" type="text" name="photo">
                        </div>
                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>

                         <div class="form-group">
                          <label for="">Select your option</label>
                          <select name="status">
                              <option value="" >---Select you option---</option>
                              <option value="active" {{$supplier->status=='active' ? 'selected':''  }}>---active---</option>
                              <option value="inactive" {{$supplier->status=='inactive' ? 'selected':''  }}>---inactive--</option>
                          </select>
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
      $('#summernote1').summernote();
    });
        </script>

@endsection
