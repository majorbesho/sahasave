<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
    
    <!-- صفحة الوظائف الرئيسية / Careers Main Page -->
    <url>
        <loc>{{ route('careers.index') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ route('careers.index') }}?lang=ar" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ route('careers.index') }}?lang=en" />
    </url>
    
    <!-- الوظائف الفردية / Individual Careers (Dynamic) -->
    @if(isset($careers) && $careers->count() > 0)
        @foreach($careers as $career)
        <url>
            <loc>{{ route('careers.show', $career->id) }}</loc>
            <lastmod>{{ $career->updated_at->format('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
            <xhtml:link rel="alternate" hreflang="ar" href="{{ route('careers.show', $career->id) }}?lang=ar" />
            <xhtml:link rel="alternate" hreflang="en" href="{{ route('careers.show', $career->id) }}?lang=en" />
        </url>
        @endforeach
    @endif
    
    <!-- تصفية الوظائف / Job Filters -->
    <url>
        <loc>{{ url('/careers?type=full-time') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>
    
    <url>
        <loc>{{ url('/careers?type=part-time') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>
    
    <url>
        <loc>{{ url('/careers?type=remote') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>
    
    <!-- الوظائف حسب الإدارات / Jobs by Department -->
    @if(isset($departments) && $departments->count() > 0)
        @foreach($departments as $department)
        <url>
            <loc>{{ url('/careers?department=' . urlencode($department)) }}</loc>
            <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.5</priority>
        </url>
        @endforeach
    @endif
    
</urlset>
