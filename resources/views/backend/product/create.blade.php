
@extends('backend.layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product</h1>
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
                <h3 class="card-title">Add product  <small>Add New product</small></h3>
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
              <form id="quickForm" action="{{route('product.store')}}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title"
                    class="form-control" id="exampleInputEmail1"
                    placeholder="Enter title" value="{{old('title')}}">
                  </div>

{{-- chk --}}
                <div class="form-group">
                    <label for="chk">Add to index</label>

                    <input type="checkbox" name="chk"   value="{{old('chk')}}"/>
                {{--
                    <input type="text" name="title"
                    class="form-control" id="exampleInputEmail1"
                    placeholder="Enter title" value="{{old('title')}}"> --}}
                </div>
                  <div class="form-group">
                    <label for="slug">discreption</label>
                    <textarea id="summernote" name="discreption"
                    placeholder="Enter discreption" >
                    {{old('discreption')}}
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="summary">summary</label>
                    <textarea id="summernote1" name="summary"
                    placeholder="Enter summary" >
                    {{old('summary')}}
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
                    <label for="status">status</label>
                    <select name="status"> Select your option
                        <option value="" >---Select you option---</option>
                        <option value="active" {{old('status')=='active' ? 'selected':''  }}>---active---</option>
                        <option value="inactive" {{old('status')=='inactive' ? 'selected':''  }}>---inactive--</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="conditaion">conditaion</label>
                    <select name="">
                        <option value="" >-conditaion-</option>
                         {{-- new,popular,winter,summary,woman,kids,man --}}
                        <option value="new" {{old('conditaion')=='new' ? 'selected':''  }}>---new---</option>
                        <option value="popular" {{old('conditaion')=='popular' ? 'selected':''  }}>---popular---</option>
                        <option value="winter" {{old('conditaion')=='winter' ? 'selected':''  }}>---winter---</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="type">type</label>

                    <select name="">
                        <option value="" >-type-</option>
                         {{-- new,popular,winter,summary,woman,kids,man --}}
                        <option value="woman" {{old('type')=='woman' ? 'selected':''  }}>---woman---</option>
                        <option value="kids" {{old('type')=='kids' ? 'selected':''  }}>---kids---</option>
                        <option value="man" {{old('type')=='man' ? 'selected':''  }}>---man---</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Brands</label>
                    <select name="brand_id"> Brands
                        <option value="" >Brand</option>
                        @foreach (\App\Models\Brand::get() as $brand )
                        <option value="{{$brand->id}}">{{$brand->title}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">groupproducts_id</label>
                    <select name="group_products_id"> group_products_id
                        <option value="" >group_products_id</option>
                        @foreach (\App\Models\groupProduct::get() as $grouppro )
                        <option value="{{$grouppro->id}}">{{$grouppro->title}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Vendors</label>
                    <select name="supplier_id"> Vendors

                        <option value="" >Vendors</option>
                        @foreach (\App\Models\supplier::get() as $suppliers )
                        <option value="{{$suppliers->id}}">{{$suppliers->title}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="category">category</label>
                    <select name="cat_id" id="cat_id"> category
                        <option value="" >category</option>
                        @foreach (\App\Models\Category::where('is_parent',1)->get() as $cat )
                        <option value="{{$cat->id}}">{{$cat->title}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group d-none" id="child_cat_dev">
                    <label for="child_cat_id">child_category</label>
                    <select name="child_cat_id" id="child_cat_id"> category
                        <option value="" >child_cat_id</option>
                        @foreach (\App\Models\Category::where('is_parent')->get() as $cat )
                        <option value="{{$cat->id}}">{{$cat->title}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="title">stok</label>
                    <input type="number"  name="stok"
                    class="form-control" id="exampleInputEmail1"
                    placeholder="Enter stok" value="{{old('stok')}}">
                  </div>
                  <div class="form-group">
                    <label for="price">price</label>
                    <input type="text"step="any" name="price"
                    class="form-control" id="exampleInputEmail1"
                    placeholder="Enter price" value="{{old('price')}}">
                  </div>
                  <div class="form-group">
                    <label for="offer_price">offer_price</label>
                    <input type="text" name="offer_price"
                    class="form-control" id="exampleInputEmail1"
                    placeholder="Enter offer_price" value="{{old('offer_price')}}">
                  </div>
                  <div class="form-group">
                    <label for="discount">discount</label>
                    <input type="discount" name="discount"
                    class="form-control" id="exampleInputEmail1"
                    placeholder="Enter discount" value="{{old('discount')}}">
                  </div>
                  <div class="form-group">
                    <label for="">Caturl</label>
                    <input type="text" name="Caturl"
                    class="form-control" id="exampleInputEmail1"
                    placeholder="Enter Caturl" value="{{old('Caturl')}}">
                  </div>


                  <div class="form-group">
                    <label for="Caturl">Caturl</label>
                    <input type="text" name="Caturl"
                    class="form-control" id="exampleInputEmail1"
                    placeholder="Enter Caturl" value="{{old('Caturl')}}">
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
    <script>
        $(document).ready(function() {
      $('#summernote1').summernote();
    });
        </script>
<script>
    $('#cat_id').change(function(){
        var cat_id=$(this).val();
        //alert(cat_id);
        if (cat_id !=null) {
            $.ajax({
          url:"/admin/category/"+cat_id+"/child",
          type:'POST',
          data:{
              _token:'{{csrf_token()}}',
              cat_id:cat_id,

          },
          success:function(response)
          {
            if (response.status) {
                alert(response.msg);
            } else{
                alert("error");
            }
             console.log(response.status);
          }
      });
        }
    });
</script>
@endsection
