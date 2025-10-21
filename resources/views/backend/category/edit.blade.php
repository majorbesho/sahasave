@extends('backend.layouts.master')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Update categories</h1>
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
                                <h3 class="card-title">Update category <small>Update category</small></h3>
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
                            <form id="quickForm" action="{{ route('category.update', $category->id) }}" method="POST">
                                @csrf
                                @method('patch')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter title" value="{{ $category->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="Caturl">Csategory URl For SahaSave.com </label>
                                        <input type="text" name="Caturl" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter title" value="{{ $category->Caturl }}">
                                    </div>
                                    {{-- $categories-> --}}
                                    <div class="form-group">
                                        <label for="slug">discreption</label>
                                        <textarea id="summernote" name="discreption" placeholder="Enter discreption">
                    {{ $category->discreption }}
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
                                    <div id="holder" style="margin-top:15px;max-height:100px;"
                                        value="{{ $category->photo }}"></div>

                                    <div class="form-group">
                                        <select name="status"> Select your option
                                            <option value="acive">---Select you option---</option>
                                            <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>
                                                ---active---</option>
                                            <option value="inactive"
                                                {{ $category->status == 'inactive' ? 'selected' : '' }}>
                                                ---inactive--</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Is_parent"> Is parent </label>
                                        <input id="is_parent" type="checkbox" name="is_parent" id=""
                                            value="{{ $category->is_parent }}"
                                            {{ $category->is_parent == 1 ? 'checked' : '' }}>
                                    </div>
                                    <div class="form-group {{ $category->is_parent == 1 ? 'd-none' : '' }}"
                                        id="parent_id_dev">
                                        <select name="parent_id"> parent Category
                                            @foreach ($parents_cate as $pcats)
                                                <option
                                                    value="{{ $pcats->id }}"{{ $pcats->id == $category->parent_id ? 'selected' : '' }}>
                                                    ---{{ $pcats->title }}---</option>
                                            @endforeach
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
        $('#is_parent').change(function(e) {

            e.preventDefault();
            var is_checked = $('#is_parent').prop('checked');
            //alert(is_checked);
            if (is_checked) {
                $('#parent_id_dev').addClass('d-none');
                $('#parent_id_dev').val('');
            } else {
                $('#parent_id_dev').removeClass('d-none');
            }

        });
    </script>
@endsection
