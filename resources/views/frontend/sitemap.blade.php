<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">




    @foreach ($box as $boxs)
        <url>
            <loc>{{ url('/') }}/user/box/{{ $boxs->slug }}</loc>
            <lastmod>{{ $boxs->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>{{ $boxs->id}}</priority>
        </url>
    @endforeach
    @foreach ($winners as $winnerss)
    <url>
        <loc>{{ url('/') }}/{{ $winnerss->slug }}</loc>
        <lastmod>{{ $winnerss->created_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>{{ $winnerss->id}}</priority>
    </url>
@endforeach
</urlset>

