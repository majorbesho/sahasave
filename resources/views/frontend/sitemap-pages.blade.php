<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
    
    <!-- الصفحة الرئيسية / Home Page -->
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ url('/', [], true) }}?lang=ar" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ url('/', [], true) }}?lang=en" />
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ url('/', [], true) }}" />
    </url>
    
    <!-- من نحن / About Us -->
    <url>
        <loc>{{ url('/about') }}</loc>
        <lastmod>{{ now()->subDays(30)->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ url('/about', [], true) }}?lang=ar" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ url('/about', [], true) }}?lang=en" />
    </url>
    
    <!-- كيف تعمل / How It Works -->
    <url>
        <loc>{{ url('/how-it-works') }}</loc>
        <lastmod>{{ now()->subDays(15)->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.9</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ url('/how-it-works', [], true) }}?lang=ar" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ url('/how-it-works', [], true) }}?lang=en" />
    </url>
    
    <!-- اتصل بنا / Contact Us -->
    <url>
        <loc>{{ url('/contactus') }}</loc>
        <lastmod>{{ now()->subDays(7)->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ url('/contactus', [], true) }}?lang=ar" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ url('/contactus', [], true) }}?lang=en" />
    </url>
    
    <!-- الأسئلة الشائعة / FAQ -->
    <url>
        <loc>{{ url('/faqs') }}</loc>
        <lastmod>{{ now()->subDays(10)->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ url('/faqs', [], true) }}?lang=ar" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ url('/faqs', [], true) }}?lang=en" />
    </url>
    
    <!-- المدونة / Blog -->
    <url>
        <loc>{{ route('blog.index') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ route('blog.index') }}?lang=ar" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ route('blog.index') }}?lang=en" />
    </url>
    
    <!-- الوظائف / Careers -->
    <url>
        <loc>{{ route('careers.index') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ route('careers.index') }}?lang=ar" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ route('careers.index') }}?lang=en" />
    </url>
    
    <!-- سياسة الخصوصية / Privacy Policy -->
    <url>
        <loc>{{ url('/privacy-policy') }}</loc>
        <lastmod>{{ now()->subMonths(3)->format('Y-m-d') }}</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.5</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ url('/privacy-policy', [], true) }}?lang=ar" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ url('/privacy-policy', [], true) }}?lang=en" />
    </url>
    
    <!-- شروط الاستخدام / Terms & Conditions -->
    <url>
        <loc>{{ url('/terms') }}</loc>
        <lastmod>{{ now()->subMonths(3)->format('Y-m-d') }}</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.5</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ url('/terms', [], true) }}?lang=ar" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ url('/terms', [], true) }}?lang=en" />
    </url>
    
    <!-- سياسة الإلغاء / Cancellation Policy -->
    <url>
        <loc>{{ url('/cancellation-policy') }}</loc>
        <lastmod>{{ now()->subMonths(3)->format('Y-m-d') }}</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.5</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ url('/cancellation-policy', [], true) }}?lang=ar" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ url('/cancellation-policy', [], true) }}?lang=en" />
    </url>
    
    <!-- تسجيل الدخول / Login -->
    <url>
        <loc>{{ url('/login') }}</loc>
        <lastmod>{{ now()->subDays(1)->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.4</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ url('/login', [], true) }}?lang=ar" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ url('/login', [], true) }}?lang=en" />
    </url>
    
    <!-- التسجيل / Register -->
    <url>
        <loc>{{ url('/register') }}</loc>
        <lastmod>{{ now()->subDays(1)->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.4</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ url('/register', [], true) }}?lang=ar" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ url('/register', [], true) }}?lang=en" />
    </url>
    
    <!-- البحث / Search -->
    <url>
        <loc>{{ url('/search') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ url('/search', [], true) }}?lang=ar" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ url('/search', [], true) }}?lang=en" />
    </url>
    
    <!-- مقالات المدونة / Blog Posts (Dynamic) -->
    @if(isset($blogs) && $blogs->count() > 0)
        @foreach($blogs as $blog)
        <url>
            <loc>{{ route('blog.show', $blog->slug) }}</loc>
            <lastmod>{{ $blog->updated_at->format('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
            <xhtml:link rel="alternate" hreflang="ar" href="{{ route('blog.show', $blog->slug) }}?lang=ar" />
            <xhtml:link rel="alternate" hreflang="en" href="{{ route('blog.show', $blog->slug) }}?lang=en" />
        </url>
        @endforeach
    @endif
    
    
    <!-- روابط SEO للأطباء / SEO Doctor Links -->
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
    
</urlset>
