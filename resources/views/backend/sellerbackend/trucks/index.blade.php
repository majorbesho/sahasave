
@extends('backend.sellerbackend.layouts.master')

@section('content')




<div class="wrapper">
    <!-- Navbar -->



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Traucks  </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Trauks Product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @include('backend.layouts.notification')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Trauks with default features</h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>




                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            {{-- <th>Slug(s)</th> --}}
                                            <th>sdate</th>
                                            <th>edate</th>
                                            <th>price</th>
                                            <th>showPrice</th>
                                            <th>stock</th>
                                            <th>suppliers</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>show</th>
                                            {{-- <th>type</th> --}}

                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Traucks as $item)
                                            <tr>



                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->title }}</td>
                                                {{-- <td>{{$item->slug}}</td> --}}
                                                <td>{{ $item->sdate }}</td>
                                                <td>{{ $item->edate }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>{{ $item->showPrice }}</td>
                                                <td>{{ $item->stock }}</td>
                                                <td>{{ $item->cat_id }}</td>
                                                {{-- <td>{{$item->slug}}</td> --}}
                                                <td>

                                                    @php
                                                        $photos = explode(',', $item->photo);
                                                    @endphp

                                                    @foreach ($photos as $key => $photo)
                                                        <img src="{{ $photo }}"
                                                            alt="image"style="max-height: 90px; max-width: 90;">
                                                    @endforeach


                                                    {{-- <img src="{{$item->photo}}" alt="image" style="max-height: 90px; max-width: 90;"> --}}
                                                </td>
                                                <td>
                                                    <input type="checkbox" data-toggle="switchbutton" checked
                                                        data-onlabel="active" value="{{ $item->id }}"
                                                        {{ $item->status == 'active' ? 'checked' : '' }}
                                                        data-offlabel="inActive" name="toogle" data-onstyle="success"
                                                        data-offstyle="danger">
                                                    {{-- @if ($item->status == 'active')
                    <span class="badge badge-success">{{$item->status}}</span>
                  @else
                  <span class="badge badge-danger">{{$item->status}}</span>

                  @endif --}}
                                                </td>
                                                <td>{{ $item->showx }}</td>

                                                {{-- <td>
                    @if ($item->type == 'promo')
                    <span class="badge badge-success">{{$item->type}}</span>
                  @else
                  <span class="badge badge-danger">{{$item->type}}</span>

                  @endif
                </td> --}}
                                                <td>
                                                    <a href="{{ route('supplier-trauck.edit', $item->id) }}"
                                                        data-toggle="tooltip" title="edit" data-placement="bottom"
                                                        class="float-left ml-2 abtn btn-xs btn-outline-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {{-- //{{route('banner.delete',$item->id)}} --}}
                                                    <form action="{{ route('supplier-trauck.destroy', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="" data-toggle="tooltip" title="delete"
                                                            data-placement="bottom" data-id="{{ $item->id }}"
                                                            class="cltBtn float-left ml-2 btn btn-xs btn-outline-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </form>


                                                </td>

                                            </tr>
                                        @endforeach



                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            {{-- <th>Slug(s)</th> --}}
                                            <th>sdate</th>
                                            <th>edate</th>
                                            <th>price</th>
                                            <th>showPrice</th>
                                            <th>stock</th>
                                            <th>suppliers</th>

                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>show</th>
                                            {{-- <th>type</th> --}}

                                            <th>action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



    <!-- /.control-sidebar -->
</div>




@endsection
