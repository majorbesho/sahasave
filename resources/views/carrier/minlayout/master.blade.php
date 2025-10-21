<!DOCTYPE html>
<html lang="en">

<head>
    @include('carrier.minlayout.head')
</head>

<body>
    <div class="page-wrapper">


        @include('carrier.minlayout.header')
        @include('carrier.minlayout.saidbar')
        {{-- </div> --}}
        @yield('content')




        <!-- page-content" -->
    </div>
    <!-- page-wrapper -->
    </div>
    <!-- /.sidebar -->


    @include('carrier.minlayout.notify')
    @include('carrier.minlayout.footer')


    <!-- Go To Top
        ============================================= -->
    {{-- <div id="gotoTop" class="icon-angle-up"></div> --}}
    {{-- @include('minlayout.script') --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </div>
</body>

</html>
