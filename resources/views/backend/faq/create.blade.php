
@extends('backend.layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>faq</h1>
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
                <h3 class="card-title">Add faq  <small>Add New faq</small></h3>
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




              <form id="quickForm" action="{{route('faq.store')}}" method="POST">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                      <label for="title">title</label>
                      <input type="text" name="title"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter title" value="{{old('title')}}">
                    </div>

                        <div class="form-group">
                      <label for="qu">qu</label>
                      <input type="text" name="qu"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter qu" value="{{old('qu')}}">
                    </div>



                      <div class="form-group">
                        <label for="slug">discreption</label>
                        <textarea id="summernote" name="discreption"
                        placeholder="Enter discreption" >
                        {{old('answer')}}
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
                    <select name="status"> Select your option
                        <option value="" >---Select you option---</option>
                        <option value="active" {{old('status')=='active' ? 'selected':''  }}>---active---</option>
                        <option value="inactive" {{old('status')=='inactive' ? 'selected':''  }}>---inactive--</option>
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
    $('#lfm2').filemanager('image');
 //    $('#lfm').filemanager('file');
 </script>
 <script>
    $('#lfm3').filemanager('image');
 //    $('#lfm').filemanager('file');
 </script>
 <script>
    $('#lfm4').filemanager('image');
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
