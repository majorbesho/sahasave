    <!-- Content Wrapper. Contains page content -->

@extends('backend.sellerbackend.layouts.master')

@section('content')



    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Truck</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('supplier.home') }}">Home</a></li>
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
                                <h3 class="card-title">Add trauck <small>Add New trauck  </small></h3>
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


                            <form id="quickForm" action="{{ route('supplier-trauck.store') }}" method="POST">
                                @csrf

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter title" value="{{ old('title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="Caturl">Caturl</label>
                                        <input type="Caturl" name="Caturl" class="form-control" placeholder="Enter Caturl"
                                            value="{{ old('Caturl') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="related_id">related product</label>
                                        <select class="select2bs4" id="related_id" multiple="multiple" name="related_id[]"
                                            data-placeholder="Select a State" style="width: 100%;">


                                            @foreach (\App\Models\groupProduct::get() as $related)
                                                @php
                                                    $photos = explode(',', $related->photo);
                                                @endphp
                                                <option value="{{ $related->id }}">
                                                    {{ $related->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                    <label for="dose">Year</label>
                                                    <input type="text" name="dose" class="form-control" id="exampleInputEmail1"
                                                        placeholder="Enter Year" value="{{ old('dose') }}">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                    <label for="Directions">Directions</label>
                                                    <input type="text" name="Directions" class="form-control" id="exampleInputEmail1"
                                                        placeholder="Enter Directions" value="{{ old('Directions') }}">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                    <label for="Ingredients">premium</label>
                                                    <input type="text" name="Ingredients" class="form-control"
                                                        id="exampleInputEmail1" placeholder="Enter premium"
                                                        value="{{ old('Ingredients') }}">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="">periodID</label>
                                                        <input type="text" name="periodID" class="form-control" id=""
                                                            placeholder="Enter periodID" value="{{ old('periodID') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="sdate">start date</label>
                                                    <input type="datetime-local" {{-- value="2023-01-12T19:30" --}} {{-- min="2023-01-07T00:00" max="2023-01-14T00:00" --}}
                                                        {{-- pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}:[0-9]{2}" required --}} required name="sdate" class="form-control"
                                                        id="sdate" placeholder="Enter end date" value="{{ old('sdate') }}">
                                                </div>

                                            </div>
                                            <div class="col-6">



                                                <div class="form-group">
                                                    <label for="">end date</label>
                                                    <input type="datetime-local" {{-- value="2023-01-12T19:30" --}} {{-- min="2023-01-07T00:00" max="2023-01-14T00:00" --}}
                                                        {{-- pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}:[0-9]{2}" required --}} required name="edate" class="form-control"
                                                        id="" placeholder="Enter end date" value="{{ old('edate') }}">
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="">price</label>
                                                    <input type="text" name="price" class="form-control" id=""
                                                        placeholder="Enter price" value="{{ old('price') }}">
                                                </div>

                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="">showPrice</label>
                                                        <input type="text" name="showPrice" class="form-control" id=""
                                                            placeholder="Enter showPrice" value="{{ old('showPrice') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="">discount</label>
                                                    <input type="text" name="discount" class="form-control" id=""
                                                        placeholder="Enter discount" value="{{ old('discount') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="locationCountry">locationCountry</label>
                                                    <input type="text" name="locationCountry" class="form-control" id="exampleInputEmail1"
                                                        placeholder="Enter locationCountry" value="{{ old('locationCountry') }}">
                                                    </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="locationCity">locationCity</label>
                                                    <input type="text" name="locationCity" class="form-control" id="exampleInputEmail1"
                                                        placeholder="Enter locationCity" value="{{ old('locationCity') }}">
                                                    </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="locationL">locationL</label>
                                                    <input type="text" name="locationL" class="form-control" id="exampleInputEmail1"
                                                        placeholder="Enter locationL" value="{{ old('locationL') }}">
                                                    </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="locationG">locationG</label>
                                                    <input type="text" name="locationG" class="form-control" id="exampleInputEmail1"
                                                        placeholder="Enter locationG" value="{{ old('locationG') }}">
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="refId">refId</label>
                                                    <input type="text" name="refId" class="form-control" id=""
                                                        placeholder="Enter refId" value="{{ old('refId') }}">
                                                </div>

                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="lenght">lenght</label>
                                                        <input type="text" name="lenght" class="form-control" id=""
                                                            placeholder="Enter lenght" value="{{ old('lenght') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="weght">weght</label>
                                                    <input type="text" name="weght" class="form-control" id=""
                                                        placeholder="Enter weght" value="{{ old('weght') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">supplier</label>
                                        <input type="text" name="supplier" class="form-control" id=""
                                            placeholder="Enter supplier" value="{{ old('supplier') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">discreption</label>
                                        <textarea id="summernote" name="discreption" placeholder="Enter discreption">
                                            {{ old('discreption') }}
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
                                    {{-- {{ ucfirst(auth('supplier')->user()->title) }} --}}
                                    <div class="form-group">
                                        <input type="hidden" name="added_by" class="form-control" id=""
                                            placeholder="{{ ucfirst(auth('supplier')->user()->title) }} , {{ ucfirst(auth('supplier')->user()->title) }}" value="{{ ucfirst(auth('supplier')->user()->id) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">supplier</label>
                                        <p>{{ ucfirst(auth('supplier')->user()->title) }}</p>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="">Select your Brand</label>
                                                    <select name="brand_id">
                                                        <option value="">---Select you option---</option>
                                                        @foreach (\App\Models\Brand::get() as $brand)
                                                            <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="">Select your Category</label>
                                                    <select name="cat_id">
                                                        <option value="">---Select you option---</option>
                                                        @foreach (\App\Models\Category::get() as $cat)
                                                            <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="">Select your status</label>
                                                    <select name="status">
                                                        <option value="">---Select you status---</option>
                                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                                            ---active---</option>
                                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                            ---inactive--</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="">Select your conditaion </label>
                                                    <select name="conditaion">
                                                        <option value="">---Select you conditaion---</option>

                                                        <option value="popular"
                                                            {{ old('conditaion') == 'popular' ? 'selected' : '' }}> popular</option>
                                                        <option value="all" {{ old('conditaion') == 'all' ? 'selected' : '' }}>all
                                                        </option>
                                                        <option value="new" {{ old('conditaion') == 'new' ? 'selected' : '' }}>new
                                                        </option>


                                                    </select>
                                                </div>
                                            </div>

                                            {{-- <div class="col-4">
                                                <div class="form-group">
                                                    <label for="">Select your Category</label>
                                                    <select name="added_by">
                                                        <option value="">---Select you option---</option>
                                                        @foreach (\App\Models\supplier::get() as $supplier)
                                                            <option value="{{ $supplier->id }}">{{ $supplier->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> --}}

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="">Select your show</label>
                                                    <select name="showx">
                                                        <option value="">---Select you option---</option>
                                                        <option value="showin" {{ old('showx') == 'showin' ? 'selected' : '' }}>
                                                            ---show---</option>
                                                        <option value="notshow" {{ old('notshow') == 'notshow' ? 'selected' : '' }}>
                                                            ---notshow--</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
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
