

@extends('backend.sellerbackend.layouts.master')

@section('content')



<style>
    .transaction-balance-wrapper .right {
    width: 50%;
    display: flex;
    justify-content: space-evenly;
    }
    .modal-dialog{
        background-color: #fff;
        border-radius: 25px;
    }
    form .col-form-label{
        color: #000;
    }
</style>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>transaction</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('supplier.home')}}">Home</a></li>
              <li class="breadcrumb-item active"></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="transaction-balance-wrapper">
            <div class="left">
                <div class="transaction-balance">
                    <h4 class="balance">0000</h4>
                    <span>Available Balance</span>
                </div>
            </div>
            <div class="right">



        <button type="button" class="transaction-action-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
            <img src="{{asset('frontend4/assets/images/1.png')}}" alt="image">
            <span>Deposit</span>
        </button>
        <button type="button" class="transaction-action-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@fat">
            <img src="{{asset('frontend4/assets/images/2.png')}}" alt="image">
            <span>Withdraw</span>
        </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="margin-left: 9px;margin-right: 12px;">
                        <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="recipient-name" placeholder="{{$user->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Tele:</label>
                            <input class="form-control" id="message-text" placeholder="{{$user->tele}}" />
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">bank account :</label>
                            <input class="form-control" id="bank_account"  name="bank_account"/>
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- transaction-balance-wrapper end -->
        <div class="all-transaction">
            <div class="all-transaction__header">
                <h3 class="title">All Transactions</h3>
                <div class="date-range">
                    <input type="text" data-range="true" data-multiple-dates-separator=" - " data-language="en" class="datepicker-here form-control" data-position='top left' placeholder="min - max date">
                    <i class="las la-calendar-alt"></i>
                </div>
            </div>
            <div class="table-responsive-xl">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>OrderID</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($userbil)>0 )
                        @foreach ($userbil as $item  )
                        <tr>
                            <td>
                                <div class="date">
                                    <span style="color: #fff">{{$item->created_at}}</span>
                                </div>
                            </td>
                            <td>
                            </td>
                            <td style="color: #000;">
                                {{$item->order_number}}
                            </td>
                            <td>
                                <span class="amount minus-amount">
                                    {{$item->total_amount}}
                                </span>
                            </td>
                            <td>
                                <div class="status-pending">

                                    <i class="fas fa-ellipsis-h"></i>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <p> No data </p>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="load-more">
                <button type="button">Show More Lotteries <i class="las la-angle-down ml-2"></i></button>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>



<script>
    const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})
</script>

@endsection
