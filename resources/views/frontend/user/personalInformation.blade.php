@extends('frontend.layouts.master')


@section('content')
    <div class="inner-hero-section style--five">
    </div>
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
                    <div class="past-draw-wrapper">
                        <h3 class="title">My ticket</h3>
                        <div class="table-responsive-lg">

                            @if (count($result) > 0)
                                @foreach ($result[0] as $key => $test)
                                @endforeach
                            @endif
                            @if (count($userbilx) > 0)
                                @foreach ($userbilx as $item)
                                    <div class="draw-single-ticket">
                                        <div class="draw-single-ticket__header">
                                            <div class="left">{{ $item->order_number }}</div>
                                            <div class="left">
                                                Purchases : {{ \Carbon\Carbon::parse($item->orderDatelast) }}
                                            </div>
                                            <div class="right">{{ $item->showPrice }}</div>
                                            <div class="right">{{ $item->email }}</div>
                                            <div class="right">{{ $item->phone }}</div>
                                        </div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-6 left">
                                                    <p>{{ $item->showPrice }}</p>
                                                </div>
                                                <div class="container">
                                                    <div class="row">
                                                        @for ($i = 0; $i < $item->qty; $i++)
                                                            <div class="col-lg-4">
                                                                <p style="padding: 1%"> {!! QrCode::size(300)->size(200)->generate(
                                                                        ' order:' .
                                                                            $item->order_number .
                                                                            ' tele:' .
                                                                            $item->phone .
                                                                            ' price:' .
                                                                            $item->showPrice .
                                                                            ' email:' .
                                                                            $item->email .
                                                                            ' name:' .
                                                                            $item->name .
                                                                            ' supplier:' .
                                                                            // $item->supplier .
                                                                            ' ex:' .
                                                                            \Carbon\Carbon::parse($item->edate)->addDay(30),
                                                                    ) !!}
                                                                </p>
                                                            </div>
                                                            <div class="col-lg-8 vcart">
                                                                @if ($item->showPrice == 50 || $item->showPrice < 70)
                                                                    <img src="{{ asset('frontend4/images/blue.png') }}"
                                                                        alt="">
                                                                @elseif ($item->showPrice == 75 || $item->showPrice < 95)
                                                                    <img src="{{ asset('frontend4/images/sliver.png') }}"
                                                                        alt="">
                                                                @elseif($item->showPrice > 95)
                                                                    <img src="{{ asset('frontend4/images/gold.png') }}"
                                                                        alt="">
                                                                @endif
                                                                @if ($item->showPrice == 50 || $item->showPrice < 70)
                                                                    <div class="leftv">
                                                                        <p> Name: <span
                                                                                style="color:#fff">{{ $item->name }}</span>
                                                                        </p>
                                                                        <p> Box: <span style="color:#fff">
                                                                                {{ $item->title }}</span></p>
                                                                        <p> Price: <span style="color:#fff">
                                                                                {{ $item->showPrice }}</span></p>
                                                                        <p> Draw Date: <span
                                                                                style="color:#fff">{{ $item->edate }}
                                                                            </span></p>
                                                                        <p> Exp Date: <span
                                                                                style="color:#fff">{{ \Carbon\Carbon::parse($item->edate)->addDay(30) }}
                                                                            </span></p>
                                                                        {{-- <p> Supplier:<span
                                                                                style="color:#fff">{{ $item->supplier }}
                                                                            </span></p> --}}
                                                                    </div>
                                                                @else
                                                                    <div class="leftv">
                                                                        <p> Name: <span>{{ $item->name }}</span></p>
                                                                        <p> Tele:<span> {{ $item->phone }}</span></p>
                                                                        <p> Price:<span> {{ $item->showPrice }}</span></p>
                                                                        <p> Draw Date:<span>{{ $item->edate }} </span></p>
                                                                        <p> Exp Date:<span>{{ \Carbon\Carbon::parse($item->edate)->addDay(30) }}
                                                                            </span>
                                                                        </p>
                                                                        {{-- <p> Supplier:<span>{{ $item->supplier }} </span>
                                                                        </p> --}}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endfor
                                                        @php
                                                            $empidcheck = DB::table('emps')
                                                                ->where('emps.repcode', '=', $item->empid)
                                                                ->get();

                                                        @endphp
                                                        {{-- <p> {{ $empidcheck }}</p> --}}
                                                        @if (count($empidcheck) > 0)
                                                            <h1 class="offerplus center" style="text-align: center;"> +
                                                            </h1>
                                                            <h5 class="offerplus center" style="text-align: center;">Promo
                                                                Code : {{ $item->empid }} </h5>
                                                            @for ($i = 0; $i < 2; $i++)
                                                                <div class="col-lg-4">
                                                                    <p style="padding: 1%"> {!! QrCode::size(300)->size(200)->generate(
                                                                            ' order:' .
                                                                                $item->order_number .
                                                                                ' tele:' .
                                                                                $item->phone .
                                                                                ' email:' .
                                                                                $item->email .
                                                                                ' name:' .
                                                                                $item->name .
                                                                                ' not:' .
                                                                                'non remeedable at our vendors ' .
                                                                                ' ex:' .
                                                                                \Carbon\Carbon::parse($item->edate),
                                                                        ) !!}
                                                                    </p>
                                                                </div>
                                                                <div class="col-lg-8 vcart">
                                                                    @if ($item->showPrice == 50 || $item->showPrice < 70)
                                                                        <img src="{{ asset('frontend4/images/blue.png') }}"
                                                                            alt="">
                                                                    @elseif ($item->showPrice == 75 || $item->showPrice < 95)
                                                                        <img src="{{ asset('frontend4/images/sliver.png') }}"
                                                                            alt="">
                                                                    @elseif($item->showPrice > 95)
                                                                        <img src="{{ asset('frontend4/images/gold.png') }}"
                                                                            alt="">
                                                                    @endif

                                                                    <div class="leftv">
                                                                        <p> Name: <span>{{ $item->name }}</span></p>
                                                                        <p> Tele:<span> {{ $item->phone }}</span></p>
                                                                        <p> Price:<span> chance</span></p>
                                                                        <p> Draw Date:<span>{{ $item->edate }} </span></p>
                                                                        <p> Exp Date:<span>{{ \Carbon\Carbon::parse($item->edate) }}
                                                                            </span></p>
                                                                        <p> Not:<span class="color:#fff">non remeedable at
                                                                                our vendors </span></p>
                                                                    </div>
                                                                </div>
                                                            @endfor
                                                        @endif


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="center"><span> No data </span> </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
