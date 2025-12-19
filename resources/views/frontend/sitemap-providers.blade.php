<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
    
    <!-- صفحة البحث عن الأطباء / Doctors Search Page -->
    <url>
        <loc>{{ url('/search') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ url('/search') }}?lang=ar" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ url('/search') }}?lang=en" />
    </url>
    
    <!-- روابط SEO للأطباء حسب المدينة والتخصص / SEO Doctor Links -->
    <url>
        <loc>{{ url('/doctors/dubai/cardiology') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    
    <url>
        <loc>{{ url('/doctors/dubai/dermatology') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    
    <url>
        <loc>{{ url('/doctors/dubai/pediatrics') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    
    <url>
        <loc>{{ url('/doctors/dubai/orthopedics') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    
    <url>
        <loc>{{ url('/doctors/dubai/dentistry') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    
    <!-- روابط المستشفيات / Hospital Links -->
    <url>
        <loc>{{ url('/hospitals/dubai') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    
    <url>
        <loc>{{ url('/hospitals/abu-dhabi') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    
    <url>
        <loc>{{ url('/hospitals/sharjah') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    
    <!-- العيادات / Clinics -->
    <url>
        <loc>{{ url('/clinics') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ url('/clinics') }}?lang=ar" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ url('/clinics') }}?lang=en" />
    </url>
    
    <!-- المراكز الطبية / Medical Centers -->
    <url>
        <loc>{{ url('/centers') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ url('/centers') }}?lang=ar" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ url('/centers') }}?lang=en" />
    </url>
    
</urlset>
