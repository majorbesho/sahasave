<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layouts.head')
</head>

<body class="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">


    <div class="main-wrapper">



        @include('frontend.layouts.header')

        {{-- </div> --}}
        @yield('content')
        @include('frontend.layouts.footer')

        @include('frontend.layouts.notify')

        <!-- Go To Top
        ============================================= -->
        {{-- <div id="gotoTop" class="icon-angle-up"></div> --}}
        @include('frontend.layouts.script')
        @yield('scripts')


    </div>
</body>

</html>
