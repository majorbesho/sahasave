<!DOCTYPE html>
<html lang="en">

<head>

    @include('shipper.minlayout.head')

</head>

<body>
    <div class="main-wrapper">


        @include('shipper.minlayout.header')


        <div class="breadcrumb-bar">
            <div class="container">
                <div class="row align-items-center inner-banner">
                    <div class="col-md-12 col-12 text-center">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-1.html"><i class="isax isax-home-15"></i></a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">shipper</li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                            <h2 class="breadcrumb-title">shipper Dashboard</h2>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="breadcrumb-bg">
                <img src="{{ asset('dashboard/assets/img/bg/breadcrumb-bg-01.png') }}" alt="img"
                    class="breadcrumb-bg-01">
                <img src="{{ asset('dashboard/assets/img/bg/breadcrumb-bg-02.png') }}" alt="img"
                    class="breadcrumb-bg-02">
                <img src="{{ asset('dashboard/assets/img/bg/breadcrumb-icon.png') }}" alt="img"
                    class="breadcrumb-bg-03">
                <img src="{{ asset('dashboard/assets/img/bg/breadcrumb-icon.png') }}" alt="img"
                    class="breadcrumb-bg-04">
            </div>
        </div>
        <!-- /Breadcrumb -->

        <!-- Page Content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">


                    <!-- /.navbar -->

                    <!-- Main Sidebar Container -->




                    @include('shipper.minlayout.saidbar')







                    @yield('content')


                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        @include('backend.layouts.footer')

</body>

</html>







{{-- @include('shipper.minlayout.notify') --}}
