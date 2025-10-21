
@extends('backend.layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>About</h1>
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
                <h3 class="card-title">Add about  <small>Add New about</small></h3>
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
              <form id="quickForm" action="{{route('about.store')}}" method="POST">
                @csrf

                {{-- 'title',
                'slug',
                'discreption',
                'sdiscreption',
                'photo',
                'status',
                'youtubeUrl',
                'mainImg',
                'testim_caption',
                'team_caption',
                'no1',
                'text1',
                'no2',
                'text2',
                'no3',
                'text3',
                'no14',
                'text4',
                'address',
                'city', --}}


                <div class="card-body">
                    <div class="form-group">
                      <label for="title">title</label>
                      <input type="text" name="title"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter title" value="{{old('title')}}">
                    </div>

                    <div class="form-group">
                        <label for="youtubeUrl">youtubeUrl</label>
                        <input type="text" name="youtubeUrl"
                        class="form-control" id="exampleInputEmail1"
                        placeholder="Enter youtubeUrl" value="{{old('youtubeUrl')}}">
                      </div>


                      <div class="form-group">
                        <label for="testim_caption">testim_caption</label>
                        <input type="text" name="testim_caption"
                        class="form-control" id="exampleInputEmail1"
                        placeholder="Enter testim_caption" value="{{old('testim_caption')}}">
                      </div>


                      <div class="form-group">
                        <label for="team_caption">team_caption</label>
                        <input type="text" name="team_caption"
                        class="form-control" id="exampleInputEmail1"
                        placeholder="Enter team_caption" value="{{old('team_caption')}}">
                      </div>


                      <div class="form-group">
                        <label for="no1">no1</label>
                        <input type="text" name="no1"
                        class="form-control" id="exampleInputEmail1"
                        placeholder="Enter no1" value="{{old('no1')}}">
                      </div>
                      <div class="form-group">
                        <label for="text1">text1</label>
                        <input type="text" name="text1"
                        class="form-control" id="exampleInputEmail1"
                        placeholder="Enter text1" value="{{old('text1')}}">
                      </div>







                      <div class="form-group">
                        <label for="no2">no2</label>
                        <input type="text" name="no2"
                        class="form-control" id="exampleInputEmail1"
                        placeholder="Enter no2" value="{{old('no2')}}">
                      </div>
                      <div class="form-group">
                        <label for="text2">text2</label>
                        <input type="text2" name="text2"
                        class="form-control" id="exampleInputEmail1"
                        placeholder="Enter text2" value="{{old('text2')}}">
                      </div>






                      <div class="form-group">
                        <label for="no3">no3</label>
                        <input type="text" name="no3"
                        class="form-control" id="exampleInputEmail1"
                        placeholder="Enter no3" value="{{old('no3')}}">
                      </div>
                      <div class="form-group">
                        <label for="text3">text3</label>
                        <input type="text3" name="text3"
                        class="form-control" id="exampleInputEmail1"
                        placeholder="Enter text3" value="{{old('text3')}}">
                      </div>

                      <div class="form-group">
                        <label for="no4">no4</label>
                        <input type="text" name="no4"
                        class="form-control" id="exampleInputEmail1"
                        placeholder="Enter no4" value="{{old('no4')}}">
                      </div>
                      <div class="form-group">
                        <label for="text4">text4</label>
                        <input type="text" name="text4"
                        class="form-control" id="exampleInputEmail1"
                        placeholder="Enter text4" value="{{old('text4')}}">
                      </div>




                    <div class="form-group">
                        <label for="address">address</label>
                        <input type="text" name="address"
                        class="form-control" id="exampleInputEmail1"
                        placeholder="Enter address" value="{{old('address')}}">
                      </div>
                      <div class="form-group">
                        <label for="city">city </label>
                        <input type="text" name="city"
                        class="form-control" id="exampleInputEmail1"
                        placeholder="Enter city" value="{{old('city')}}">
                      </div>


                        <div class="form-group">
                    <label for="slug">discreption</label>
                    <textarea id="summernote" name="discreption"
                    placeholder="Enter discreption" >
                    {{old('discreption')}}
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
