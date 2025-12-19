<?php

namespace App\Http\Controllers;

use App\Services\SitemapService;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    protected $sitemapService;

    public function __construct(SitemapService $sitemapService)
    {
        $this->sitemapService = $sitemapService;
    }

    /**
     * Display sitemap index
     */
    public function index()
    {
        return response()->view('frontend.sitemap-index')
            ->header('Content-Type', 'text/xml');
    }

    /**
     * Display pages sitemap
     */
    public function pages()
    {
        return response()->view('frontend.sitemap-pages')
            ->header('Content-Type', 'text/xml');
    }

    /**
     * Display blog sitemap
     */
    public function blog()
    {
        $data = $this->sitemapService->getBlogSitemapData();

        return response()->view('frontend.sitemap-blog', $data)
            ->header('Content-Type', 'text/xml');
    }

    /**
     * Display careers sitemap
     */
    public function careers()
    {
        $data = $this->sitemapService->getCareersSitemapData();

        return response()->view('frontend.sitemap-careers', $data)
            ->header('Content-Type', 'text/xml');
    }

    /**
     * Display providers sitemap
     */
    public function providers()
    {
        return response()->view('frontend.sitemap-providers')
            ->header('Content-Type', 'text/xml');
    }

    /**
     * Get sitemap statistics (Admin only)
     */
    public function stats(Request $request)
    {
        // Simple auth check - adjust based on your auth system
        if (!$request->user() || !$request->user()->hasRole('admin')) {
            abort(403, 'Unauthorized');
        }

        $stats = $this->sitemapService->getSitemapStats();

        return response()->json([
            'success' => true,
            'stats' => $stats,
        ]);
    }

    /**
     * Ping search engines about sitemap update (Admin only)
     */
    public function ping(Request $request)
    {
        // Simple auth check - adjust based on your auth system
        if (!$request->user() || !$request->user()->hasRole('admin')) {
            abort(403, 'Unauthorized');
        }

        $results = $this->sitemapService->pingSearchEngines();

        return response()->json([
            'success' => true,
            'message' => 'Search engines have been notified',
            'results' => $results,
        ]);
    }
}
