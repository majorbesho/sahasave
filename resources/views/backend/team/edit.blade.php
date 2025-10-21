
@extends('backend.layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Setting</h1>
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
                <h3 class="card-title">Update Team  <small>Update Team</small></h3>
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
              <form id="quickForm" action="{{route('team.update',$team->id)}}" method="POST">
                @csrf
                @method('patch')


                <div class="card-body">
                    <div class="form-group">
                      <label for="title">title</label>
                      <input type="text" name="title"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter title" value="{{$team->title}}">
                    </div>

                    <div class="form-group">
                      <label for="name">name</label>
                      <input type="text" name="name"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter name" value="{{$team->name}}">
                    </div>



                      <div class="form-group">
                        <label for="addtext">addtext</label>
                        <textarea id="summernote" name="addtext"
                        placeholder="Enter addtext" >
                        {{$team->addtext}}
                        </textarea>
                      </div>


                  <div class="form-group">
                    <label for="facebook">facebook</label>
                    <input type="url" name="facebook"
                    class="form-control" id="exampleInputEmail1"
                    placeholder="Enter facebook" value="{{$team->facebook}}">
                  </div>
                  <div class="form-group">
                    <label for="twitter">twitter</label>
                    <input type="url" name="twitter"
                    class="form-control" id="exampleInputEmail1"
                    placeholder="Enter twitter" value="{{$team->twitter}}">
                  </div>
                  <div class="form-group">
                    <label for="google">google</label>
                    <input type="url" name="google"
                    class="form-control" id="exampleInputEmail1"
                    placeholder="Enter google" value="{{$team->google}}">
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
                    <select name="status"> Select your option
                        <option value="" >---Select you option---</option>
                        <option value="active" {{$team->status=='active' ? 'selected':''  }}>---active---</option>
                        <option value="inactive" {{$team->status=='inactive' ? 'selected':''  }}>---inactive--</option>
                    </select>
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
  $('#summernote2').summernote();
});
    </script>
    <script>
        $(document).ready(function() {
      $('#summernote3').summernote();
    });
        </script>
        <script>
            $(document).ready(function() {
          $('#summernote4').summernote();
        });
            </script>


@endsection
