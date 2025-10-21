
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
                <h3 class="card-title">Update setting  <small>Update setting</small></h3>
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
              <form id="quickForm" action="{{route('setting.update',$setting->id)}}" method="POST">
                @csrf
                @method('patch')

                <div class="card-body">
                    <div class="form-group">
                      <label for="facebookUrl">facebookUrl</label>
                      <input type="url" name="facebookUrl"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter facebookUrl" value="{{$setting->facebookUrl}}">
                    </div>
                    <div class="form-group">
                      <label for="twiettr">twiettr</label>
                      <input type="url" name="twiettr"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter twiettr" value="{{$setting->twiettr}}">
                    </div>
                    <div class="form-group">
                      <label for="linkedin">linkedin</label>
                      <input type="url" name="linkedin"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter linkedin" value="{{$setting->linkedin}}">
                    </div>
                       <div class="form-group">
                      <label for="insta">insta</label>
                      <input type="url" name="insta"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter insta" value="{{$setting->insta}}">
                    </div>
                    <div class="form-group">
                      <label for="youtube">youtube</label>
                      <input type="url" name="youtube"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter youtube" value="{{$setting->youtube}}">
                    </div>
                    <div class="form-group">
                      <label for="google">google</label>
                      <input type="url" name="google"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter google" value="{{$setting->google}}">
                    </div>
                    <div class="form-group">
                      <label for="tele">tele</label>
                      <input type="Telephone" name="tele"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter tele" value="{{$setting->tele}}">
                    </div>
                  
  
                    <div class="form-group">
                      <label for="no1">Statices 1 </label>
                      <input type="text" name="no1"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter no1" value="{{$setting->no1}}">
                    </div>
                    <div class="form-group">
                      <label for="text1">Statices text 1 </label>
                      <input type="text" name="text1"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter text1" value="{{$setting->text1}}">
                    </div>
                    
  
                    <div class="form-group">
                      <label for="no2">Statices 2 </label>
                      <input type="text" name="no2"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter no2" value="{{$setting->no2}}">
                    </div>
                    <div class="form-group">
                      <label for="text2">Statices text 2 </label>
                      <input type="text" name="text2"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter text2" value="{{$setting->text2}}">
                    </div>
                    
  
                    <div class="form-group">
                      <label for="no3">Statices 3 </label>
                      <input type="text" name="no3"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter no3" value="{{$setting->no3}}">
                    </div>
                    <div class="form-group">
                      <label for="text3">Statices text 3 </label>
                      <input type="text" name="text3"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter text3" value="{{$setting->text3}}">
                    </div>
                    
  
                    <div class="form-group">
                      <label for="no4">Statices 4 </label>
                      <input type="text" name="no4"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter no4" value="{{$setting->no4}}">
                    </div>
                    <div class="form-group">
                      <label for="tex41">Statices text 4 </label>
                      <input type="text" name="text4"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter text4" value="{{$setting->text4}}">
                    </div>
                    <div class="form-group">
                      <label for="Email">Email </label>
                      <input type="Email" name="Email"
                      class="form-control" id="exampleInputEmail1"
                      placeholder="Enter Email" value="{{$setting->Email}}">
                    </div>
  
  
  
  
                
                  
                    <div class="form-group">
                      <label for="WHATWEDO">WHATWEDO</label>
                      <textarea id="summernote" name="WHATWEDO"
                      placeholder="Enter WHATWEDO" >
                      {{$setting->WHATWEDO}}
                      </textarea>
                    </div>
                    <div class="form-group">
                      <label for="OURMISSION">OURMISSION</label>
                      <textarea id="summernote2" name="OURMISSION"
                      placeholder="Enter OURMISSION" >
                      {{$setting->OURMISSION}}
                      </textarea>
                    </div>
                    <div class="form-group">
                      <label for="WHYCHOOSEUS">WHYCHOOSEUS</label>
                      <textarea id="summernote3" name="WHYCHOOSEUS"
                      placeholder="Enter WHYCHOOSEUS" >
                      {{$setting->WHYCHOOSEUS}}
                      </textarea>
                    </div>
                    <div class="form-group">
                      <label for="ProductsandServices">ProductsandServices</label>
                      <textarea id="summernote4" name="ProductsandServices"
                      placeholder="Enter ProductsandServices" >
                      {{$setting->ProductsandServices}}
                      </textarea>
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
