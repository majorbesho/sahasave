<?php

namespace App\Services;

use App\Models\Career;
use App\Models\Blog;
use App\Models\BlogCategory;
use Carbon\Carbon;

class SitemapService
{
    /**
     * Generate careers sitemap data
     */
    public function getCareersSitemapData()
    {
        $careers = Career::where('is_active', true)
            ->where('application_deadline', '>=', Carbon::now())
            ->orderBy('updated_at', 'desc')
            ->get();

        $departments = Career::where('is_active', true)
            ->distinct()
            ->pluck('department');

        return [
            'careers' => $careers,
            'departments' => $departments,
        ];
    }

    /**
     * Generate blog sitemap data
     */
    public function getBlogSitemapData()
    {
        $blogPosts = Blog::where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->get();

        $blogCategories = BlogCategory::where('is_active', true)
            ->orderBy('name')
            ->get();

        return [
            'blogPosts' => $blogPosts,
            'blogCategories' => $blogCategories,
        ];
    }

    /**
     * Get sitemap statistics
     */
    public function getSitemapStats()
    {
        return [
            'total_pages' => 13, // Static pages count
            'blog_posts' => Blog::where('status', 'published')->count(),
            'careers' => Career::where('is_active', true)
                ->where('application_deadline', '>=', Carbon::now())
                ->count(),
            'seo_links' => 8, // 5 doctor specialty + 3 hospital city links
            'last_generated' => Carbon::now()->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Ping search engines about sitemap update
     */
    public function pingSearchEngines()
    {
        $sitemapUrl = urlencode(url('/sitemap.xml'));
        $engines = [
            'Google' => "https://www.google.com/ping?sitemap={$sitemapUrl}",
            'Bing' => "https://www.bing.com/ping?sitemap={$sitemapUrl}",
        ];

        $results = [];
        foreach ($engines as $engine => $url) {
            try {
                $context = stream_context_create([
                    'http' => [
                        'timeout' => 5,
                        'ignore_errors' => true,
                    ]
                ]);

                $response = @file_get_contents($url, false, $context);
                $results[$engine] = $response !== false ? 'Success' : 'Failed';
            } catch (\Exception $e) {
                $results[$engine] = 'Error: ' . $e->getMessage();
            }
        }

        return $results;
    }
}
