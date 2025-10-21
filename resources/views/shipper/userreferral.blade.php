@extends('frontend.layouts.master')


@section('content')
<style>
    .popup-content {
    /* background-color: #fefefe; */
    margin: auto;
    padding: 20px;
    /* border: 1px solid #888; */
    width: 60%;
    border-radius: 25px;
    position: fixed;
    left: 20%;
    top: 10%;
}
</style>

    <div id="popupcartx" class="popup-container">
        <div class="popup-content">

            <div class="containerpop">

                <div class="container popupedit">
                    <div class="row">
                        <a href="#participate" class="close">&times;</a>

                        <div class="col-lg-12 ">
                            <div class="col-lg-12  popupbtn ">
                                <img src="{{asset('frontend4/assets/images/aff.jpg')}}" alt="" srcset="">
                                <a  class="cmn-btn style--two d-flex align-items-center"
                                    style="justify-content: center;margin-bottom: 4%;text-align: center;margin-top: 2%;width: 100%;padding: 2%;font-style: italic;font-size: 1.4rem;text-shadow: 1px 1px 3px black;font-weight: 900;">  </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="inner-hero-section style--five">
    </div>
    <!-- inner-hero-section end -->

    <!-- user section start -->
    <div class="mt-minus-150 pb-120">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 ">
                    <div class="user-card">
                        <div class="user-card user-prof">
                            <div class="avatar-upload">
                                <div class="obj-el">
                                    <img src="{{ asset('frontend4/assets/images/elements/team-obj.png') }}" alt="image">
                                </div>
                                <div class="avatar-edit">
                                    <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload"></label>
                                </div>
                            </div>
                        </div>
                        <h3 class="user-card__name">{{ $user->name }}</h3>
                        {{-- <span class="user-card__id">ID : {{$user->id}}</span> --}}
                        <span class="user-card__id">email : {{ $user->email }}</span>
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
                    @php
                        $domain = URL::to('/');
                        $url = $domain . '/authref?ref=' . $user->referral_code;
                    @endphp
                    <div class="referral-link-wrapper">
                        <h3 class="title">Partners</h3>
                        <div class="copy-link">
                            <div class="copy-link-inner">
                                <form data-copy=true>

                                    <input type="submit" value="Copy">

                                    <input type="text" value="{{ $url }}" style="font-size: 12px;">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="copy-link-inner pt-30">
                        <form data-copy=true style="padding-top: 3%;text-align: center;">

                            <a href="#popupcartx" class="btn btn-success">Click Here For Affliate System </a>
                        </form>
                    </div>
                    <div class="referral-overview mt-30">
                        <div class="row justify-content-center mb-none-30">
                            <div class="col-lg-5 col-sm-6 mb-30">
                                <div class="referral-crad">
                                    <div class="referral-crad__icon"><img src="{{ asset('frontend4/assets/images/3.png') }}"
                                            alt="image"></div>
                                    <div class="referral-crad__content">
                                        <h3 class="number" id="total">

                                            <div style="color: #fff;">Total:
                                                <span class="totalCubic">
                                                </span>
                                               <span>AED</span>
                                            </div>

                                        </h3>
                                        <span>Earned Referral</span>
                                    </div>
                                </div>
                                <!-- referral-crad end -->
                            </div>
                            <div class="col-lg-5 col-sm-6 mb-30">
                                <div class="referral-crad">
                                    <div class="referral-crad__icon"><img src="{{ asset('frontend4/assets/images/4.png') }}"
                                            alt="image"></div>
                                    <div class="referral-crad__content">
                                        <h3 class="number"></h3>
                                        <span style="color: #fff ;  font-size: 28px;" >Wallet  </span> <br>
                                        <span>5 AED  </span>
                                    </div>
                                </div>
                                <!-- referral-crad end -->
                            </div>
                        </div>
                    </div>



                    {{-- <div class="singleUnitCubic">19.600</div>
                    <div class="singleUnitCubic">5.000</div>
                     --}}
                    <div class="referral-transaction">
                        <div class="all-transaction__header">
                            <h3 class="title">Your Partners:</h3>
                            <div class="date-range">
                                <input type="text" data-range="true" data-multiple-dates-separator=" - "
                                    data-language="en" class="datepicker-here form-control" data-position='top left'
                                    placeholder="min - max date">
                                <i class="las la-calendar-alt"></i>
                            </div>
                        </div>
                        <div class="table-responsive-lg" style="overflow-x:auto;">
                            <table class="myTable">
                                <thead>
                                    <tr>
                                        <th>email</th>
                                        <th>Name</th>
                                        <th>User</th>
                                        <th>payment</th>
                                        <th>total</th>
                                        <th>%</th>
                                        <th>email</th>
                                        <th>level</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($userref) > 0)
                                        @foreach ($userref as $itemref)
                                            <tr>
                                                <td>{{ $itemref->email }}</td>
                                                <td>{{ $itemref->name }}</td>
                                                @php
                                                    $userreftest = DB::table('orders')
                                                        ->join('users', 'orders.user_id', 'users.id')
                                                        ->where('orders.user_id', '=', $itemref->id)
                                                        ->get();
                                                @endphp
                                                @if (count($userreftest) > 0)
                                                    @foreach ($userreftest as $userorder)
                                                        {{-- <p>{{$userorder->order_number}}</p> --}}
                                                        <td>{{ $userorder->user_name }}</td>
                                                        <td>{{ $userorder->payment_method }}</td>
                                                        <td>{{ $userorder->total_amount }} </td>
                                                        <td class="count-me"> @php echo ($userorder->total_amount)*0.10 @endphp</td>
                                                        <td>{{ $userorder->email }}</td>
                                                    @endforeach
                                                @else
                                                    <td></td>
                                                    <td></td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td></td>
                                                @endif

                                                <td>1</td>
                                                {{-- <td><a href="{{ $domain.('/authref?ref='.$itemref->referral_code)}}" class=""  style="color: #000;"> ref link</a></td> --}}
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        @if (count($userref) > 0)
                            @foreach ($userref as $key => $itemref)
                                {{-- <span>{{ $key + 1 }}</span> --}}
                                @foreach ($itemref->children as $item2)
                                    <table class="myTable">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>email</th>

                                                {{-- <th>income</th> --}}
                                                <th>level</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <td>{{ $item2->name }}</td>
                                            <td>{{ $item2->email }}</td>
                                            {{-- <td name="qty" id="qty2">5<span>AED </span></td> --}}


                                            @php
                                                $userreftest = DB::table('orders')
                                                    ->join('users', 'orders.user_id', 'users.id')
                                                    ->where('orders.user_id', '=', $itemref->id)
                                                    ->get();

                                            @endphp

                                            @if (count($userreftest) > 0)
                                                @foreach ($userreftest as $userorder)
                                                    <td>{{ $userorder->user_name }}</td>
                                                    <td>{{ $userorder->payment_method }}</td>
                                                    <td>{{ $userorder->total_amount }} </td>


                                                    <td  class="count-me">

                                                        @php echo ($userorder->total_amount)*0.05 @endphp

                                                    </td>

                                                    <td>{{ $userorder->email }}</td>
                                                @endforeach
                                            @else
                                                <td></td>
                                                <td></td>
                                                <td> </td>
                                                <td> </td>
                                                <td></td>
                                            @endif
                                            <td>2</td>
                                        </tbody>
                                    </table>
                                    @foreach ($item2->children as $item3)
                                        <table class="myTable">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>email</th>
                                                    <th>income</th>
                                                    <th>level</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td>{{ $item3->name }}</td>
                                                <td>{{ $item3->email }}</td>
                                                @php
                                                    $userreftest = DB::table('orders')
                                                        ->join('users', 'orders.user_id', 'users.id')
                                                        ->where('orders.user_id', '=', $itemref->id)
                                                        ->get();
                                                @endphp

                                                @if (count($userreftest) > 0)
                                                    @foreach ($userreftest as $userorder)
                                                        <td>{{ $userorder->user_name }}</td>
                                                        <td>{{ $userorder->payment_method }}</td>
                                                        <td>{{ $userorder->total_amount }} </td>

                                                        <td  class="count-me">

                                                                @php echo ($userorder->total_amount)*0.03 @endphp

                                                        </td>


                                                        <td>{{ $userorder->email }}</td>
                                                    @endforeach
                                                @else
                                                    <td></td>
                                                    <td></td>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td></td>
                                                @endif
                                                <td>3</td>
                                            </tbody>
                                        </table>
                                        @foreach ($item3->children as $item4)
                                            <table class="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>email</th>
                                                        <th>income</th>
                                                        <th>level</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <td>{{ $item4->name }}</td>
                                                    <td>{{ $item4->email }}</td>
                                                    {{-- <td name="qty" id="qty4">2<span>AED </span></td> --}}

                                                    @php
                                                        $userreftest = DB::table('orders')
                                                            ->join('users', 'orders.user_id', 'users.id')
                                                            ->where('orders.user_id', '=', $itemref->id)
                                                            ->get();
                                                    @endphp
                                                    @if (count($userreftest) > 0)
                                                        @foreach ($userreftest as $userorder)
                                                            <td>{{ $userorder->user_name }}</td>
                                                            <td>{{ $userorder->payment_method }}</td>
                                                            <td>{{ $userorder->total_amount }} </td>

                                                            <td  class="count-me">

                                                                @php echo ($userorder->total_amount)*0.02 @endphp

                                                            </td>

                                                            <td>{{ $userorder->email }}</td>
                                                        @endforeach
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                        <td> </td>
                                                        <td> </td>
                                                        <td></td>
                                                    @endif
                                                    <td>4</td>
                                                </tbody>
                                            </table>
                                            @foreach ($item4->children as $item5)
                                                <table class="myTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>email</th>
                                                            <th>income</th>
                                                            <th>level</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <td>{{ $item5->name }}</td>
                                                        <td>{{ $item5->email }}</td>
                                                        @php
                                                            $userreftest = DB::table('orders')
                                                                ->join('users', 'orders.user_id', 'users.id')
                                                                ->where('orders.user_id', '=', $itemref->id)
                                                                ->get();
                                                        @endphp
                                                        @if (count($userreftest) > 0)
                                                            @foreach ($userreftest as $userorder)
                                                                <td>{{ $userorder->user_name }}</td>
                                                                <td>{{ $userorder->payment_method }}</td>
                                                                <td>{{ $userorder->total_amount }} </td>

                                                                <td  class="count-me">

                                                                        @php echo ($userorder->total_amount)*0.01 @endphp

                                                                </td>
                                                                <td>{{ $userorder->email }}</td>
                                                            @endforeach
                                                        @else
                                                            <td></td>
                                                            <td></td>
                                                            <td> </td>
                                                            <td> </td>
                                                            <td></td>
                                                        @endif
                                                        <td>5</td>
                                                    </tbody>
                                                </table>
                                                @foreach ($item5->children as $item6)
                                                    <table class="myTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>email</th>
                                                                <th>income</th>
                                                                <th>level</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <td>{{ $item6->name }}</td>
                                                            <td>{{ $item6->email }}</td>
                                                            @php
                                                                $userreftest = DB::table('orders')
                                                                    ->join('users', 'orders.user_id', 'users.id')
                                                                    ->where('orders.user_id', '=', $itemref->id)
                                                                    ->get();
                                                            @endphp
                                                            @if (count($userreftest) > 0)
                                                                @foreach ($userreftest as $userorder)
                                                                    <td>{{ $userorder->user_name }}</td>
                                                                    <td>{{ $userorder->payment_method }}</td>
                                                                    <td>{{ $userorder->total_amount }} </td>
                                                                    <td class="count-me">


                                                                            @php echo ($userorder->total_amount)*0.01 @endphp

                                                                    </td>
                                                                    <td>{{ $userorder->email }}</td>
                                                                @endforeach
                                                            @else
                                                                <td></td>
                                                                <td></td>
                                                                <td> </td>
                                                                <td> </td>
                                                                <td></td>
                                                            @endif
                                                            <td>5</td>
                                                        </tbody>
                                                    </table>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endif
                    </div>
                </div>
                <!-- past-draw-wrapper end -->

                <div>Total:
                    <span class="totalCubic">
                    </span>

                    <div id="val"></div>
                </div>

            </div>
        </div>
    </div>


{{--
    <script>
        updateSubTotal(); // Initial call

        function updateSubTotal() {
            var table = document.getElementsByClassName(".myTable");
                var subTotal = 0 ;


            $(this).find('.count-me').each(function() {

            let subTotal = Array.from(table.rows).slice(1).reduce((total, row) => {

                return total + parseFloat(row.cells[5].innerHTML);
         }) }, 0);
            document.getElementById("val").innerHTML = "SubTotal = $" + subTotal.toFixed(2);
        }

    </script> --}}

<script>
    $(document).ready(function() {

        var sum = 0
            $(this).find('.count-me').each(function() {
            var precio = $(this).text();
            if (!isNaN(precio) && precio.length !== 0) {
                sum += parseFloat(precio);
            }
            });
            // document.getElementById("val").innerHTML = "SubTotal = $" + sum.toFixed(2);
            $('.totalCubic', this).html(sum);
        });
</script>

{{-- <script>
    var tds = document.getElementsByClassName('.count-me');
            var sum = 0;
            for(var i = 0; i < tds.length; i ++) {
                console.log(true);
                if(tds[i].className == 'count-me') {
                    console.log(done)
                    sum += isNaN(tds[i].innerHTML) ? 0 : parseInt(tds[i].innerHTML);
                }
            }
            document.getElementById('val').innerHTML += '<tr><td>' + sum + '</td><td>total</td></tr>';

            console.log(sum);
</script> --}}
@endsection
