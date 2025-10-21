
<!DOCTYPE html>
<html lang="en">

<head>


@include('frontend.mlayouts.head')

	<!-- Document Title
	============================================= -->

</head>



<body >


{{-- <body class="stretched">

	<!-- Document Wrapper
	============================================= -->--}}


        <div class="page-wrapper">



          {{-- <div id="header" class="full-header"> --}}
            <header id="gen-header" class="gen-header-style-1 gen-has-sticky">
                @include('frontend.mlayouts.header')
            </header><!-- #header end -->
          {{-- </div> --}}

    @yield('content')


    @include('frontend.mlayouts.footer')

        <!-- Go To Top
        ============================================= -->
        {{-- <div id="gotoTop" class="icon-angle-up"></div> --}}

    @include('frontend.mlayouts.script')


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>




</body>
</html>
