@extends('backend.layouts.master')

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
              <h1>about</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">about</li>
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
                  <h3 class="card-title"></h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>


                    <tr>
                      <th>ID</th>
                      <th>title</th>
                      <th>address</th>

                      <th>photo</th>
                      <th>status</th>
                      <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($about  as $item )

                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->title}}</td>
                       <td>{{$item->address}}</td>

                      <td>
                        <img src="{{$item->photo}}" alt="image" style="max-height: 90px; max-width: 90;">
                    </td>
                      <td>
                        @if ($item->status=='active')
                        <span class="badge badge-success">{{$item->status}}</span>
                      @else
                      <span class="badge badge-danger">{{$item->status}}</span>

                      @endif
                    </td>

                    <td>
                        <a href="{{route('about.edit',$item->id)}}" data-toggle="tooltip"
                         title="edit"
                         data-placement="bottom"
                         class="float-left ml-2 abtn btn-xs btn-outline-info">
                         <i class="fas fa-edit"></i>
                        </a>
                        {{-- //{{route('banner.delete',$item->id)}} --}}
                        <form action="{{route('about.destroy',$item->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <a href="" data-toggle="tooltip"
                                title="delete"
                                data-placement="bottom"
                                data-id="{{$item->id}}"
                                class="cltBtn float-left ml-2 btn btn-xs btn-outline-danger" >
                                <i class="fas fa-trash"></i>
                            </a>
                        </form>


                    </td>

                    </tr>

                    @endforeach



                    </tbody>
                    <tfoot>
                    <tr>

                        <td>ID</td>
                        <td>tele</td>
                        <td>Address</td>

                        <td>photo</td>
                        <td>status</td>
                        <td>action</td>

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
@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.cltBtn').click(function (e){
        var form=$(this).closest('form');
        var  dataId=$(this).data('id');
        e.preventDefault();
        swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this imaginary file!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
        form.submit();
        swal("Poof! Your imaginary file has been deleted!", {
        icon: "success",
        });
    } else {
        swal("Your imaginary file is safe!");
    }
    });


    });
</script>
@endsection
