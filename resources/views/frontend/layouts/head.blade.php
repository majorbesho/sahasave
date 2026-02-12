<meta charset="UTF-8">
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

{{-- Dynamic Title --}}
@php
    $defaultTitleAr = 'SehaSave - احجز طبيبك واكسب كاش باك | دبي';
    $defaultTitleEn = 'SehaSave - Book Your Doctor & Earn Cashback | Dubai';
    $defaultTitle = app()->getLocale() == 'ar' ? $defaultTitleAr : $defaultTitleEn;
    
    $defaultDescAr = 'SehaSave — أول منصة تسويق طبي في دبي تمنحك كاش باك نقدي بعد كل زيارة. احجز عند أفضل الأطباء واربح عند كل حجز.';
    $defaultDescEn = 'SehaSave — The first medical marketing platform in Dubai that grants you cash back after every visit. Book with the best doctors and earn with every booking.';
    $defaultDesc = app()->getLocale() == 'ar' ? $defaultDescAr : $defaultDescEn;
    
    $currentUrl = url()->current();
    $baseUrl = config('app.url', 'https://sehasave.com');
@endphp

<title>@yield('title', $defaultTitle)</title>
<meta name="description" content="@yield('meta_description', $defaultDesc)">
<meta name="author" content="SehaSave">
<meta name="robots" content="index, follow">

{{-- Canonical URL --}}
<link rel="canonical" href="@yield('canonical_url', $currentUrl)" />

{{-- Hreflang for multilingual SEO --}}
@php
    $urlWithoutQuery = strtok($currentUrl, '?');
@endphp
<link rel="alternate" hreflang="ar" href="{{ $urlWithoutQuery }}?lang=ar" />
<link rel="alternate" hreflang="en" href="{{ $urlWithoutQuery }}?lang=en" />
<link rel="alternate" hreflang="x-default" href="{{ $urlWithoutQuery }}" />

{{-- Open Graph Meta Tags --}}
<meta property="og:title" content="@yield('og_title', $defaultTitle)" />
<meta property="og:description" content="@yield('og_description', $defaultDesc)" />
<meta property="og:image" content="@yield('og_image', asset('frontend/xx/assets/img/og-image.jpg'))" />
<meta property="og:url" content="{{ $currentUrl }}" />
<meta property="og:type" content="@yield('og_type', 'website')" />
<meta property="og:site_name" content="SehaSave" />
<meta property="og:locale" content="{{ app()->getLocale() == 'ar' ? 'ar_AE' : 'en_US' }}" />
<meta property="og:locale:alternate" content="{{ app()->getLocale() == 'ar' ? 'en_US' : 'ar_AE' }}" />

{{-- Twitter Card Meta Tags --}}
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="@yield('twitter_title', $defaultTitle)" />
<meta name="twitter:description" content="@yield('twitter_description', $defaultDesc)" />
<meta name="twitter:image" content="@yield('twitter_image', asset('frontend/xx/assets/img/og-image.jpg'))" />

<!-- Google Fonts Preconnect -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- Critical CSS Preload -->
<link rel="preload" href="{{ mix('css/app.css') }}" as="style">
<link rel="preload" href="{{ asset('frontend/xx/assets/css/bootstrap.min.css') }}" as="style">

<style>
    /* Ensure text remains visible during webfont load */
    @font-face {
        font-display: swap;
    }
</style>

<!-- Tailwind CSS (Laravel Mix) -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('frontend/xx/assets/css/bootstrap.min.css') }}">

<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/xx/assets/img/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend/xx/assets/img/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend/xx/assets/img/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('frontend/xx/assets/img/site.webmanifest') }}">

<!-- Fontawesome CSS -->
<link rel="stylesheet" href="{{ asset('frontend/xx/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/xx/assets/plugins/fontawesome/css/all.min.css') }}">

<link rel="stylesheet" href="{{ asset('frontend/xx/assets/css/feather.css') }}">

<!-- Apple Touch Icon -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/xx/assets/img/apple-touch-icon.png') }}">

<!-- Theme Settings Js -->
<script src="{{ asset('frontend/xx/assets/js/theme-script.js') }}"></script>

<!-- Iconsax CSS-->
<link rel="stylesheet" href="{{ asset('frontend/xx/assets/css/iconsax.css') }}">


<!-- Animation CSS -->
<link rel="stylesheet" href="{{ asset('frontend/xx/assets/css/aos.css') }}">

<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="{{ asset('frontend/xx/assets/css/owl.carousel.min.css') }}">

<!-- Main CSS -->
<link rel="stylesheet" href="{{ asset('frontend/xx/assets/css/custom.css') }}">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
<meta name="google-site-verification" content="8Gq0l0ntGfx5F9LJWItrNy8qRBZDhszBX4gI-MSj6XU" />

<meta name="msvalidate.01" content="ED5E5330355AD691E55EF78450431287" />

{{-- Organization Schema (shown on all pages) --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "MedicalBusiness",
    "name": "SehaSave",
    "alternateName": "صحة سيف",
    "url": "https://sehasave.com",
    "logo": "{{ asset('frontend/xx/assets/img/logo.png') }}",
    "image": "{{ asset('frontend/xx/assets/img/og-image.jpg') }}",
    "description": "{{ app()->getLocale() == 'ar' ? 'أول منصة تسويق طبي في دبي تمنحك كاش باك نقدي بعد كل زيارة' : 'The first medical marketing platform in Dubai that grants you cash back after every visit' }}",
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "Dubai",
        "addressRegion": "Dubai",
        "addressCountry": "AE"
    },
    "contactPoint": {
        "@type": "ContactPoint",
        "contactType": "customer service",
        "availableLanguage": ["Arabic", "English"]
    },
    "sameAs": [
        "https://www.facebook.com/sehasave",
        "https://www.instagram.com/sehasave",
        "https://twitter.com/sehasave"
    ],
    "priceRange": "$$"
}
</script>

{{-- WebSite Schema for search box --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "SehaSave",
    "url": "https://sehasave.com",
    "potentialAction": {
        "@type": "SearchAction",
        "target": "https://sehasave.com/search?q={search_term_string}",
        "query-input": "required name=search_term_string"
    }
}
</script>

@if(isset($blog))
<script type="application/ld+json">
{!! json_encode($blog->generateStructuredData()) !!}
</script>

@if($blog->faq_json)
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": {!! json_encode($blog->faq_json) !!}
}
</script>
@endif
@endif



{{-- Ahrefs Analytics (single script) --}}
{{-- <script src="https://analytics.ahrefs.com/analytics.js" data-key="i7kxaCZnHu1lMQ7IytJLxA" async defer></script>
<meta name="ahrefs-site-verification" content="badd7ebe2cf27706c7e9d77db751fee086afd12bf7a5211e69a5d9c59dcbfbed"> --}}

<script src="https://analytics.ahrefs.com/analytics.js" data-key="rktdTJxFe7x+zVSx22yySw" async></script>

<script>function loadScript(a){var b=document.getElementsByTagName("head")[0],c=document.createElement("script");c.type="text/javascript",c.src="https://tracker.metricool.com/resources/be.js",c.onreadystatechange=a,c.onload=a,b.appendChild(c)}loadScript(function(){beTracker.t({hash:"ac220276f392a540a90428e8766a1898"})});</script>
