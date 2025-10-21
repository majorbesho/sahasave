@extends('frontend.layouts.master')


@section('content')



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
                                {{-- <div class="avatar-preview">
                                @if (auth()->user()->photo)
                                <div id="imagePreview" style="background-image: url({{$user->photo}});">
                                </div>
                                @else
                                <div id="imagePreview"
                                style="background-image: url({{Helper::userDefaultImage()}});">
                                </div>

                                @endif

                            </div> --}}
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
                        {{-- <input type="text" value="{{ $url }}" > --}}

                        <div class="copy-link">
                            {{--  <span class="copy-link-icon">
                                <i class="las la-link"></i>
                            </span> --}}
                            {{-- <span class="label">Link:</span> --}}
                            <div class="copy-link-inner">
                                <form data-copy=true>
                                    {{-- {{$user->referral_code}} --}}

                                    {{-- <input type="text" value="{{ $url }}" data-click-select-all> --}}
                                    <input type="submit" value="Copy">

                                    <input type="text" value="{{ $url }}" style="font-size: 12px;">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="referral-overview mt-30">
                        <div class="row justify-content-center mb-none-30">
                            <div class="col-lg-5 col-sm-6 mb-30">
                                <div class="referral-crad">
                                    <div class="referral-crad__icon"><img src="{{ asset('frontend4/assets/images/3.png') }}"
                                            alt="image">
                                    </div>
                                    <div class="referral-crad__content">
                                        <h3 class="number" id="totla"> 0</h3>
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
                                        <h3 class="number"> 0 </h3>
                                        <span>Last Month</span>
                                    </div>
                                </div>
                                <!-- referral-crad end -->
                            </div>
                        </div>
                    </div>

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
                            <table id="table">
                                <thead>
                                    <tr>
                                        <th>email</th>
                                        <th>Name</th>
                                        <th>level</th>
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
                                                <td>1</td>
                                            </tr>
                                                @php
                                                    $userreftest = DB::table('orders')
                                                        ->join('users', 'orders.user_id', 'users.id')
                                                        ->where('orders.user_id', '=', $itemref->id)
                                                        ->get();
                                                @endphp
                                                @foreach ($userreftest as $userorder)

                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>email</th>
                                                            <th>level</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    <td>{{ $userorder->user_name }}</td>
                                                    <td>{{ $userorder->payment_method }}</td>
                                                    <td>{{ $userorder->total_amount }} </td>
                                                    <td class="count-me"> @php echo ($userorder->total_amount)*0.10 @endphp</td>
                                                    <td>{{ $userorder->email }}</td>

                                                </tr>


                                            </tbody>
                                        </table>

                                                @endforeach

                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        @if (count($userref) > 0)
                            @foreach ($userref as $key => $itemref)
                                @foreach ($itemref->children as $item2)
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>email</th>
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

                                            @foreach ($userreftest as $userorder)
                                                <td>{{ $userorder->user_name }}</td>
                                                <td>{{ $userorder->payment_method }}</td>
                                                <td>{{ $userorder->total_amount }} </td>
                                                <td class="count-me"> @php echo ($userorder->total_amount)*0.05 @endphp</td>
                                                <td>{{ $userorder->email }}</td>
                                            @endforeach

                                            <td>2</td>

                                        </tbody>
                                    </table>
                                    @foreach ($item2->children as $item3)
                                        <table>
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
                                                @foreach ($userreftest as $userorder)
                                                    <td>{{ $userorder->user_name }}</td>
                                                    <td>{{ $userorder->payment_method }}</td>
                                                    <td>{{ $userorder->total_amount }} </td>
                                                    <td class="count-me"> @php echo ($userorder->total_amount)*0.03 @endphp</td>
                                                    <td>{{ $userorder->email }}</td>
                                                @endforeach
                                                <td>3</td>
                                            </tbody>
                                        </table>
                                        @foreach ($item3->children as $item4)
                                            <table>
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

                                                    @foreach ($userreftest as $userorder)
                                                        <td>{{ $userorder->user_name }}</td>
                                                        <td>{{ $userorder->payment_method }}</td>
                                                        <td>{{ $userorder->total_amount }} </td>
                                                        <td class="count-me"> @php echo ($userorder->total_amount)*0.02 @endphp</td>
                                                        <td>{{ $userorder->email }}</td>
                                                    @endforeach

                                                    <td>4</td>
                                                </tbody>
                                            </table>
                                            @foreach ($item4->children as $item5)
                                                <table>
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
                                                        {{-- <td  name="qty" id="qty5">1<span>AED </span></td> --}}

                                                        @php
                                                            $userreftest = DB::table('orders')
                                                                ->join('users', 'orders.user_id', 'users.id')
                                                                ->where('orders.user_id', '=', $itemref->id)
                                                                ->get();

                                                        @endphp

                                                        @foreach ($userreftest as $userorder)
                                                            <td>{{ $userorder->user_name }}</td>
                                                            <td>{{ $userorder->payment_method }}</td>
                                                            <td>{{ $userorder->total_amount }} </td>
                                                            <td class="count-me"> @php echo ($userorder->total_amount)*0.01 @endphp</td>
                                                            <td>{{ $userorder->email }}</td>
                                                        @endforeach

                                                        <td>5</td>
                                                    </tbody>
                                                </table>
                                                @foreach ($item5->children as $item6)
                                                    <table>
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

                                                            @foreach ($userreftest as $userorder)
                                                                <td>{{ $userorder->user_name }}</td>
                                                                <td>{{ $userorder->payment_method }}</td>
                                                                <td>{{ $userorder->total_amount }} </td>
                                                                <td class="count-me"> @php echo ($userorder->total_amount)*0.01 @endphp</td>
                                                                <td>{{ $userorder->email }}</td>
                                                            @endforeach
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



                        {{-- @foreach ($all as $i => $alls)
                            <small>{{ $alls->ancestors->count() ? implode(' > ', $alls->ancestors->pluck('name')->toArray()) : 'Top Level' }}</small><br>
                            {{ $alls->name }}
                        @endforeach --}}

                        {{-- <div class="load-more">
                            <button type="button">Show More Lotteries <i class="las la-angle-down ml-2"></i></button>
                        </div> --}}
                    </div>
                </div>
                <!-- past-draw-wrapper end -->

            </div>
        </div>
    </div>




    <script type="text/javascript">
        function findTotal() {
            var arr = document.getElementsByName('count-me');
            var tot = 0;

            for (var i = 0; i < arr.length; i++) {
                console.log( 'count-me');
                if (parseInt(arr[i].value))
                    tot += parseInt(arr[i].value);
                    console.log( 'count-me');
            }
            document.getElementById('totla').value = tot;
        }
    </script>





@endsection
