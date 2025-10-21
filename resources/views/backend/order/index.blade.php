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
              <h1>Order</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Order</a></li>
                <li class="breadcrumb-item active">Order</li>
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
                  <h3 class="card-title">Order with default features</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
{{--

                        'user_id',
        'order_number',
        // 'product_id',
        // 'group_products_id',
       // 'sub_total',
        'total_amount',
        'coupon',
        'delivery_charge',
        'quantity',
        'email',
        'phone',
        'startdate',
        'enddate',
        'user_name',
        'note',
        'payment_method',
        'payment_status',
        'condition',
        'sessoin_id',
        'empid',
        'product_type',--}}

                    <tr>

                        <th>ID</th>
                        <th>no</th>
                        <th>amount</th>
                        <th>method</th>
                        <th>status</th>
                        <th>repcode</th>
                        <th>Date</th>
                        <th>qty</th>
                        <th>title</th>
                        <th>Sponser</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>action</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orderData  as $item )
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->order_number}}</td>
                      <td>{{$item->total_amount}}</td>
                      <td>{{$item->payment_method}}</td>
                      {{-- <td>{{$item->payment_status}}</td> --}}
                      <td>{{$item->condition}}</td>
                      <td>{{$item->empid}}</td>
                      <td>{{$item->o_created_at}}</td>
                      {{-- <td>{{$item->phone}}</td> --}}
                      <td>{{$item->qty}}</td>
                      <td>{{$item->title}}</td>
                      <td>{{$item->supplier}}</td>
                      <td>{{$item->email}}</td>
                      <td>{{$item->phone}}</td>





                    <td>
                        <a href="{{route('banner.edit',$item->id)}}" data-toggle="tooltip"
                         title="edit"
                         data-placement="bottom"
                         class="float-left ml-2 abtn btn-xs btn-outline-info">
                         <i class="fas fa-edit"></i>
                        </a>
                        {{-- //{{route('banner.delete',$item->id)}} --}}
                        <form action="{{route('banner.destroy',$item->id)}}" method="post">
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
                        <th>ID</th>
                        <th>no</th>
                        <th>amount</th>
                        <th>method</th>
                        <th>status</th>
                        <th>repcode</th>
                        <th>date</th>
                        <th>qty</th>
                        <th>title</th>
                        <th>Sponser</th>
                        <th>email</th>
                        <th>phone</th>
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

<script>
    $('input[name=toogle]').change(function(){
    var mode = $(this).prop('checked');
    var id = $(this).val();
    //alert (mode);
      $.ajax({
          url:"{{route('banner.status')}}",
          type:'POST',
          data:{
              _token:'{{csrf_token()}}',
              mode:mode,
              id:id,
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
      })
         });
</script>

@endsection
