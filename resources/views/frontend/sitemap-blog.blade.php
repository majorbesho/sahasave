<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
    
    <!-- المدونة الرئيسية / Blog Main -->
    <url>
        <loc>{{ route('blog.index') }}</loc>
        <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
        <xhtml:link rel="alternate" hreflang="ar" href="{{ route('blog.index') }}?lang=ar" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ route('blog.index') }}?lang=en" />
    </url>
    
    <!-- مقالات المدونة / Blog Posts (Dynamic) -->
    @if(isset($blogPosts) && $blogPosts->count() > 0)
        @foreach($blogPosts as $post)
        <url>
            <loc>{{ route('blog.show', $post->slug) }}</loc>
            <lastmod>{{ $post->updated_at->format('Y-m-d') }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
            <xhtml:link rel="alternate" hreflang="ar" href="{{ route('blog.show', $post->slug) }}?lang=ar" />
            <xhtml:link rel="alternate" hreflang="en" href="{{ route('blog.show', $post->slug) }}?lang=en" />
        </url>
        @endforeach
    @endif
    
    <!-- فئات المدونة / Blog Categories -->
    @if(isset($blogCategories) && $blogCategories->count() > 0)
        @foreach($blogCategories as $category)
        <url>
            <loc>{{ url('/blog/category/' . $category->slug) }}</loc>
            <lastmod>{{ now()->format('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
            <xhtml:link rel="alternate" hreflang="ar" href="{{ url('/blog/category/' . $category->slug) }}?lang=ar" />
            <xhtml:link rel="alternate" hreflang="en" href="{{ url('/blog/category/' . $category->slug) }}?lang=en" />
        </url>
        @endforeach
    @endif
    
</urlset>
