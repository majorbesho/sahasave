<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    <!-- Main Pages Sitemap -->
    <sitemap>
        <loc>{{ url('/sitemap-pages.xml') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
    </sitemap>
    
    <!-- Blog Sitemap -->
    <sitemap>
        <loc>{{ url('/sitemap-blog.xml') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
    </sitemap>
    
    <!-- Careers Sitemap -->
    <sitemap>
        <loc>{{ url('/sitemap-careers.xml') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
    </sitemap>
    
    <!-- Providers (Doctors & Hospitals) Sitemap -->
    <sitemap>
        <loc>{{ url('/sitemap-providers.xml') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
    </sitemap>
    
</sitemapindex>
