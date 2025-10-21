
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZRSQERSTD0"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-ZRSQERSTD0');
    </script>



{!! SEOMeta::generate() !!}
{!! OpenGraph::generate() !!}
{!! Twitter::generate() !!}
{!! JsonLd::generate() !!}
{{-- {!! JsonLdMulti::generate() !!} --}}
{!! SEO::generate() !!}
{!! SEO::generate(true) !!}
{!! app('seotools')->generate() !!}


<meta http-equiv="content-type" content="text/html; charset=utf-8" >
	<meta name="author" content="beshog32@gmail.com" >
    	<!-- Stylesheets
	============================================= -->
	<meta name="viewport" content="width=device-width, initial-scale=1" >
    <link rel="canonical" href="https://smartboxuae.ae/" />
	<!-- SLIDER REVOLUTION 5.x CSS SETTINGS -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- old css --}}

 <!-- Favicon -->
    <!-- CSS bootstrap-->
    <link rel="stylesheet" href="{{asset('frontend4/media/css/bootstrap.min.css')}}" />
    <!--  Style -->
    <link rel="stylesheet" href="{{asset('frontend4/media/css/style.css')}}" />
    <!--  Responsive -->
    <link rel="stylesheet" href="{{asset('frontend4/media/css/responsive.css')}}" />

    {{-- <link rel="stylesheet" href="{{asset('frontend4/css/main.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('frontend4/media/css/custom.css')}}" type="text/css" >
   {{--  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('frontend4/css/login.css')}}">
    <link rel="stylesheet" href="{{asset('frontend4/css/mediaQuery.css')}}"> --}}



