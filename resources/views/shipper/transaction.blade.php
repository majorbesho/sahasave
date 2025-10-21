
@extends('frontend.layouts.master')


@section('content')


<div class="inner-hero-section style--five">
</div>
<!-- inner-hero-section end -->

<!-- user section start -->

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
<div class="mt-minus-150 pb-120">
    <div class="container">

        <div class="row">
            <div class="col-lg-4 ">
                <div class="user-card">
                    <div class="user-card user-prof">
                        <div class="avatar-upload">
                            <div class="obj-el">
                                <img src="{{asset('frontend4/assets/images/elements/team-obj.png')}}" alt="image">
                            </div>
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload"></label>
                            </div>

                        </div>
                    </div>


                    <h3 class="user-card__name">{{$user->name}}</h3>
                    {{-- <span class="user-card__id">ID : {{$user->id}}</span>
                    <span class="user-card__id">email : {{$user->email}}</span> --}}
                </div>
                        <!-- user-card end -->
                        <div class="user-action-card">
                            <ul class="user-action-list">
                            @include('frontend.user.sidebar')
                            </ul>
                        </div>
                <!-- user-action-card end -->
            </div>


            <div class="col-lg-8 mt-lg-0 mt-4">
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
            </div>

        </div>
    </div>
</div>

<script>
    const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})
</script>

@endsection
