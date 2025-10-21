@extends('frontend.layouts.master')

@section('content')
    <style>
        .fas {
            font-size: 18px;

            padding: 5px;
        }

        .fab {
            font-size: 18px;

            padding: 5px;
        }
    </style>
    <section class="page-header">
        <div class="page-header__bg"
            style="background-image: url({{ asset('4/assets/images/backgrounds/page-header-bg.jpg') }})">
        </div>
        <div class="page-header__pattern"><img src="{{ asset('4/assets/images/pattern/page-header-pattern.png') }}"
                alt=""></div>
        <div class="container">
            <div class="page-header__inner">
                <h2>RFQ</h2>
                <ul class="thm-breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span class="icon-right-arrow21"></span></li>
                    <li>RFQ</li>
                </ul>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <h1 style="color: #000"></h1>
            <div id="results"></div>
            <div class="table-responsive">
                <table style="color: #000" class="styled-table">
                    <thead>
                        <tr>
                            <th style="background: #Fabc3f">Details</th>
                            <th style="background: #Fabc3f"><i style="color: #007bff" class="fas fa-map-marker-alt"></i>
                                Pickup</th>
                            <th style="background: #Fabc3f"><i style="color: #007bff" class="fas fa-map-marker-alt"></i>
                                Destination</th>
                            <th style="background: #Fabc3f"><i style="color: #007bff" class="fas fa-weight-hanging"></i>
                                Weight</th>
                            <th style="background: #Fabc3f"><i style="color: #007bff" class="fas fa-ruler-horizontal"></i>
                                Length</th>
                            <th style="background: #Fabc3f"><i style="color: #007bff" class="fas fa-truck"></i> Truck Type
                            </th>
                            <th style="background: #Fabc3f"><i style="color: #007bff" class="fas fa-dollar-sign"></i> Price
                            </th>
                            <th style="background: #Fabc3f"><i style="color: #007bff" class="fas fa-calendar-alt"></i> Date
                            </th>
                            <th style="background: #Fabc3f"><i style="color: #007bff" class="fas fa-id-card"></i> Contact
                                Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($LoadAddFromIndexall) > 0)
                            @foreach ($LoadAddFromIndexall as $key => $LoadAddFromIndexall)
                                <tr>
                                    <td>
                                        <a href="{{ route('makeoffer', $LoadAddFromIndexall->slug) }}">
                                            <i style="color: #007bff" class="fas fa-folder-minus"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('makeoffer', $LoadAddFromIndexall->slug) }}">
                                            {{ $LoadAddFromIndexall->origin }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('makeoffer', $LoadAddFromIndexall->slug) }}">
                                            {{ $LoadAddFromIndexall->destination }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('makeoffer', $LoadAddFromIndexall->slug) }}">
                                            {{ $LoadAddFromIndexall->weight }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('makeoffer', $LoadAddFromIndexall->slug) }}">
                                            {{ $LoadAddFromIndexall->lenght }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('makeoffer', $LoadAddFromIndexall->slug) }}">
                                            {{ $LoadAddFromIndexall['cat']['title'] ?? 'No Category' }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('makeoffer', $LoadAddFromIndexall->slug) }}">
                                            {{ number_format($LoadAddFromIndexall->price, 2) }}
                                        </a>
                                    </td>
                                    <td>
                                        @php
                                            $date = \Carbon\Carbon::parse($LoadAddFromIndexall->date);
                                        @endphp
                                        <a href="{{ route('makeoffer', $LoadAddFromIndexall->slug) }}">
                                            <span class="widget-49-date-day">{{ $date->day }}</span>/
                                            <span class="widget-49-date-month">{{ $date->month }}</span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="https://wa.me/{{ $LoadAddFromIndexall->phone }}" target="_blank"
                                            class="icon-link" title="WhatsApp">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a href="{{ route('makeoffer', $LoadAddFromIndexall->slug) }}" class="icon-link"
                                            title="Email">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                        <a href="{{ route('makeoffer', $LoadAddFromIndexall->slug) }}" class="icon-link"
                                            title="Details" data-toggle="modal" data-target="#contactModal">
                                            <i class="fas fa-phone"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <style>
                /* Responsive Table Styles */
                .table-responsive {
                    overflow-x: auto;
                }

                .styled-table {
                    width: 100%;
                    border-collapse: collapse;
                }

                .styled-table th,
                .styled-table td {
                    padding: 12px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }

                .styled-table th {
                    background-color: #f8f9fa;
                    font-weight: bold;
                }

                .styled-table tbody tr:hover {
                    background-color: #f1f1f1;
                }

                /* Mobile Styles */
                @media (max-width: 767.98px) {
                    .styled-table thead {
                        display: none;
                    }

                    .styled-table tbody tr {
                        display: block;
                        margin-bottom: 15px;
                        border: 1px solid #ddd;
                        border-radius: 5px;
                    }

                    .styled-table tbody td {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        padding: 8px;
                        border-bottom: 1px solid #ddd;
                    }

                    .styled-table tbody td::before {
                        content: attr(data-label);
                        font-weight: bold;
                        margin-right: 10px;
                        flex: 1;
                    }

                    .styled-table tbody td:last-child {
                        border-bottom: none;
                    }
                }
            </style>

            <script>
                // Add data-label attributes for mobile view
                document.addEventListener("DOMContentLoaded", function() {
                    const table = document.querySelector('.styled-table');
                    const headers = table.querySelectorAll('th');
                    const rows = table.querySelectorAll('tbody tr');

                    rows.forEach(row => {
                        const cells = row.querySelectorAll('td');
                        cells.forEach((cell, index) => {
                            cell.setAttribute('data-label', headers[index].textContent.trim());
                        });
                    });
                });
            </script>



        </div>
    </div>


    {{--


    <style>
        .card {
            border: none;
            box-shadow: 0 4px 8px #Fabc3f;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 1.5em;
            color: #Fabc3f;
        }

        .card-text {
            font-size: 1.1em;
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #Fabc3f;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
        }

        .btn-primary:hover {
            background-color: #Fabc3f;
        }

        .fa,
        .fas {
            color: #Fabc3f;
            font-family: 'Font Awesome 5 Pro';
            font-weight: 900;
            font-size: 40px
        }

        .fab {
            color: #Fabc3f;
            font-size: 40px
        }
    </style> --}}

    {{--
    <div class="stricky-header stricky-header--style1 stricked-menu main-menu">
        <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
    </div><!-- /.stricky-header --> --}}

    <!--Start Page Header-->
    {{-- <section class="page-header">
        <div class="page-header__bg"
            style="background-image: url({{ asset('4/assets/images/backgrounds/page-header-bg.jpg') }})">
        </div>
        <div class="page-header__pattern"><img src="{{ asset('4/assets/images/pattern/page-header-pattern.png') }}"
                alt=""></div>
        <div class="container">
            <div class="page-header__inner">
                <h2>RFQ</h2>
                <ul class="thm-breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span class="icon-right-arrow21"></span></li>
                    <li>RFQ</li>
                </ul>
            </div>
        </div>
    </section> --}}


    <section class="offer">


        {{-- <style>
            body {
                background: #F4F7FD;
                margin-top: 20px;
            }

            .card-margin {
                margin-bottom: 1.875rem;
            }

            .card {
                border: 0;
                box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
                -webkit-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
                -moz-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
                -ms-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
            }

            .card {
                position: relative;
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #ffffff;
                background-clip: border-box;
                border: 1px solid #e6e4e9;
                border-radius: 8px;
            }

            .card .card-header.no-border {
                border: 0;
            }

            .card .card-header {
                background: none;
                padding: 0 0.9375rem;
                font-weight: 500;
                display: flex;
                align-items: center;
                min-height: 50px;
            }

            .card-header:first-child {
                border-radius: calc(8px - 1px) calc(8px - 1px) 0 0;
            }

            .widget-49 .widget-49-title-wrapper {
                display: flex;
                align-items: center;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-primary {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                background-color: #edf1fc;
                width: 4rem;
                height: 4rem;
                border-radius: 50%;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-primary .widget-49-date-day {
                color: #4e73e5;
                font-weight: 500;
                font-size: 1.5rem;
                line-height: 1;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-primary .widget-49-date-month {
                color: #4e73e5;
                line-height: 1;
                font-size: 1rem;
                text-transform: uppercase;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-secondary {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                background-color: #fcfcfd;
                width: 4rem;
                height: 4rem;
                border-radius: 50%;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-secondary .widget-49-date-day {
                color: #dde1e9;
                font-weight: 500;
                font-size: 1.5rem;
                line-height: 1;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-secondary .widget-49-date-month {
                color: #dde1e9;
                line-height: 1;
                font-size: 1rem;
                text-transform: uppercase;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-success {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                background-color: #e8faf8;
                width: 4rem;
                height: 4rem;
                border-radius: 50%;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-success .widget-49-date-day {
                color: #17d1bd;
                font-weight: 500;
                font-size: 1.5rem;
                line-height: 1;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-success .widget-49-date-month {
                color: #17d1bd;
                line-height: 1;
                font-size: 1rem;
                text-transform: uppercase;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-info {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                background-color: #ebf7ff;
                width: 4rem;
                height: 4rem;
                border-radius: 50%;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-info .widget-49-date-day {
                color: #36afff;
                font-weight: 500;
                font-size: 1.5rem;
                line-height: 1;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-info .widget-49-date-month {
                color: #36afff;
                line-height: 1;
                font-size: 1rem;
                text-transform: uppercase;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-warning {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                background-color: floralwhite;
                width: 4rem;
                height: 4rem;
                border-radius: 50%;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-warning .widget-49-date-day {
                color: #FFC868;
                font-weight: 500;
                font-size: 1.5rem;
                line-height: 1;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-warning .widget-49-date-month {
                color: #FFC868;
                line-height: 1;
                font-size: 1rem;
                text-transform: uppercase;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-danger {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                background-color: #feeeef;
                width: 4rem;
                height: 4rem;
                border-radius: 50%;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-danger .widget-49-date-day {
                color: #F95062;
                font-weight: 500;
                font-size: 1.5rem;
                line-height: 1;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-danger .widget-49-date-month {
                color: #F95062;
                line-height: 1;
                font-size: 1rem;
                text-transform: uppercase;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-light {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                background-color: #fefeff;
                width: 4rem;
                height: 4rem;
                border-radius: 50%;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-light .widget-49-date-day {
                color: #f7f9fa;
                font-weight: 500;
                font-size: 1.5rem;
                line-height: 1;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-light .widget-49-date-month {
                color: #f7f9fa;
                line-height: 1;
                font-size: 1rem;
                text-transform: uppercase;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-dark {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                background-color: #ebedee;
                width: 4rem;
                height: 4rem;
                border-radius: 50%;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-dark .widget-49-date-day {
                color: #394856;
                font-weight: 500;
                font-size: 1.5rem;
                line-height: 1;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-dark .widget-49-date-month {
                color: #394856;
                line-height: 1;
                font-size: 1rem;
                text-transform: uppercase;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-base {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                background-color: #f0fafb;
                width: 4rem;
                height: 4rem;
                border-radius: 50%;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-base .widget-49-date-day {
                color: #68CBD7;
                font-weight: 500;
                font-size: 1.5rem;
                line-height: 1;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-date-base .widget-49-date-month {
                color: #68CBD7;
                line-height: 1;
                font-size: 1rem;
                text-transform: uppercase;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-meeting-info {
                display: flex;
                flex-direction: column;
                margin-left: 1rem;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-meeting-info .widget-49-pro-title {
                color: #3c4142;
                font-size: 14px;
            }

            .widget-49 .widget-49-title-wrapper .widget-49-meeting-info .widget-49-meeting-time {
                color: #B1BAC5;
                font-size: 13px;
            }

            .widget-49 .widget-49-meeting-points {
                font-weight: 400;
                font-size: 13px;
                margin-top: .5rem;
            }

            .widget-49 .widget-49-meeting-points .widget-49-meeting-item {
                display: list-item;
                color: #727686;
            }

            .widget-49 .widget-49-meeting-points .widget-49-meeting-item span {
                margin-left: .5rem;
            }

            .widget-49 .widget-49-meeting-action {
                text-align: right;
            }

            .widget-49 .widget-49-meeting-action a {
                text-transform: uppercase;
            }
        </style> --}}

        {{-- <div class="conainer">
            <div class="row" style="padding-top: 2%;padding-bottom: 2%;"> --}}
        {{--
                @if (count($LoadAddFromIndexall) > 0)
                    @foreach ($LoadAddFromIndexall as $key => $LoadAddFromIndexall)
                        <div class="col-lg-3 col-md-4 col-sx-6">
                            <div class="card card-margin">
                                <div class="card-header no-border">
                                    <h5 class="card-title"> <i
                                            class="fas fa-dollar-sign"></i>{{ number_format($LoadAddFromIndexall->price, 2) }}
                                    </h5>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="widget-49">
                                        <div class="widget-49-title-wrapper">
                                            <div class="widget-49-date-primary">
                                                @php
                                                    $date = \Carbon\Carbon::parse($LoadAddFromIndexall->date);
                                                @endphp
                                                <span class="widget-49-date-day">{{ $day = $date->day }}</span>
                                                <span class="widget-49-date-month">{{ $day = $date->month }}
                                                </span>
                                            </div>
                                            <div class="widget-49-meeting-info">
                                                <span class="widget-49-pro-title"><i
                                                        class="fas fa-map-marker-alt"></i>{{ $LoadAddFromIndexall->name }}</span>


                                                <span class="widget-49-pro-title"><i
                                                        class="fas fa-map-marker-alt"></i>{{ $LoadAddFromIndexall->origin }}</span>
                                                <span class="widget-49-pro-title"><i
                                                        class="fas fa-map-marker-alt"></i>{{ $LoadAddFromIndexall->destination }}</span>
                                            </div>
                                        </div>

                                        <div class="widget-49-meeting-action">
                                            <a href="{{ route('makeoffer', $LoadAddFromIndexall->slug) }}"
                                                class="btn btn-sm btn-flash-border-primary">View All</a>
                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif --}}


        {{-- </div>
        </div>
    </section> --}}

        <!--End Page Header-->

        <!--Start Blog Standard Page-->
        {{-- <section class="blog-standard-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <div class="row"> --}}

        {{--
                        <div class="container">
                            <div class="row">

                                <div class="container my-5">
                                    @if (count($LoadAddFromIndexall) > 0)
                                        @foreach ($LoadAddFromIndexall as $key => $LoadAddFromIndexall)
                                            <div class="card mb-4">
                                                <div class="card-body" style="color: #0a0a0a">
                                                    <h5 class="card-title"><i
                                                            class="fas fa-map-marker-alt"></i>{{ $LoadAddFromIndexall->origin }},
                                                        To / {{ $LoadAddFromIndexall->destination }}</h5>
                                                    <p class="card-text">
                                                        <strong> <i
                                                                class="fas fa-dollar-sign"></i>{{ number_format($LoadAddFromIndexall->price, 2) }}</strong>
                                                    </p>
                                                    <p class="card-text"><i class="fas fa-truck-moving"></i>
                                                        {{ $LoadAddFromIndexall['cat']['title'] ?? 'No Category' }}
                                                        - wire:{{ $LoadAddFromIndexall->weight }} / Ton -
                                                        {{ $LoadAddFromIndexall->lenght }}/M
                                                    </p>
                                                    @php
                                                        $date = \Carbon\Carbon::parse($LoadAddFromIndexall->date);
                                                    @endphp
                                                    <p>
                                                        <i class="fas fa-user-alt"></i> {{ $LoadAddFromIndexall->name }}
                                                    </p>
                                                    <p class="card-text"><i class="fas fa-calendar-alt"></i> PICK
                                                        UP:{{ $day = $date->month }} /{{ $day = $date->day }}
                                                    </p>
                                                    <p class="card-text"><i class="fas fa-road"></i></p>
                                                    <a href="{{ route('makeoffer', $LoadAddFromIndexall->slug) }}"
                                                        class="btn btn-primary"><i class="fas fa-handshake"></i> Offer
                                                        Now</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
 --}}

        {{-- @if (count($LoadAddFromIndexall) > 0)
                            @foreach ($LoadAddFromIndexall as $key => $LoadAddFromIndexall)
                                <div class="blog-one__single">
                                    <div class="blog-one__single-img">
                                        <img src="assets/images/blog/blog-standard-img1.jpg" alt="">
                                    </div>

                                    <div class="blog-one__single-content">
                                        <div class="date-box">
                                            @php
                                                $date = \Carbon\Carbon::parse($LoadAddFromIndexall->date);
                                            @endphp
                                            <h2>{{ $day = $date->day }}</h2>
                                            <p>{{ $day = $date->month }}</p>
                                        </div>
                                        <div class="blog-one__single-content-inner">
                                            <ul class="meta-box">
                                                <li>
                                                    <div class="icon">
                                                        <span class="icon-user"></span>
                                                    </div>

                                                    <div class="text-box">
                                                        <p><a href="#">{{ $LoadAddFromIndexall->name }}</a></p>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="icon">
                                                        <span class="icon-chat"></span>
                                                    </div>

                                                    <div class="text-box">
                                                        <p><a href="#">2 Offer</a></p>
                                                    </div>
                                                </li>
                                            </ul>






                                            <p> our Client
                                            <h2 style="font-size: 22px"> {{ $LoadAddFromIndexall->name }}</h2> he want to
                                            Load
                                            his
                                            lenght :<h2 style="font-size: 22px"> {{ $LoadAddFromIndexall->lenght }}</h2>
                                            weight :
                                            <h2 style="font-size: 22px">{{ $LoadAddFromIndexall->weight }}</h2>
                                            From : <h2 style="font-size: 22px">{{ $LoadAddFromIndexall->origin }}</h2>
                                            to
                                            <h2 style="font-size: 22px">{{ $LoadAddFromIndexall->destination }}</h2>
                                            <h2 style="font-size: 22px">{{ number_format($LoadAddFromIndexall->price, 2) }}
                                            </h2>

                                            <p>
                                                truck type:
                                            <h2 style="font-size: 22px">
                                                {{ $LoadAddFromIndexall['cat']['title'] ?? 'No Category' }}</h2>
                                            </p>
                                            </p>
                                            <div class="btn-box">
                                                <a class="thm-btn"
                                                    href="{{ route('makeoffer', $LoadAddFromIndexall->slug) }}">Make
                                                    Offer
                                                    <i class="icon-right-arrow21"></i>
                                                    <span class="hover-btn hover-bx"></span>
                                                    <span class="hover-btn hover-bx2"></span>
                                                    <span class="hover-btn hover-bx3"></span>
                                                    <span class="hover-btn hover-bx4"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End Blog One Single-->
                            @endforeach
                        @endif --}}


        <ul class="styled-pagination text-center clearfix">
            <li class="arrow prev active"><a href="#"><span class="icon-right-arrow3"></span></a>
            </li>
            <li><a style="color: #Fabc3f" href="#">1</a></li>
            <li><a style="color: #Fabc3f" href="#">2</a></li>
            <li><a style="color: #Fabc3f" href="#">3</a></li>
            <li class="arrow next"><a href="#"><span class="icon-right-arrow31"></span></a>
            </li>
        </ul>
        </div>
        </div>

        <!--Start Sidebar-->
        <div class="col-xl-4">
            <div class="sidebar">
                <!--Start Sidebar Single-->
                {{-- <div class="sidebar__single sidebar__search wow fadeInUp" data-wow-delay=".1s">
                    <form action="#" class="sidebar__search-form">
                        <input type="search" placeholder="Search...">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div> --}}
                <!--End Sidebar Single-->

                <!--Start Sidebar Single-->
                {{-- <div class="sidebar__single sidebar__category wow fadeInUp" data-wow-delay=".1s">
                    <h3 class="sidebar__title">Categories</h3>
                    <ul class="sidebar__category-list">

                        @foreach (\App\Models\Category::get() as $brand)
                            <li><a href="#">{{ $brand->title }} <span>(12)</span></a></li>
                        @endforeach

                    </ul>
                </div> --}}
                <!--End Sidebar Single-->



            </div>
        </div>
        <!--End Sidebar-->
        </div>
        </div>
    </section>

    <script>
        document.querySelectorAll('.btn-primary').forEach(button => {
            button.addEventListener('click', () => {
                alert('Offer submitted successfully!');
            });
        });
    </script>
@endsection
