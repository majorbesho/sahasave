<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // Cache for SEO performance
        $cacheKey = 'blogs_index_' . md5(json_encode($request->all()));

        $data = Cache::remember($cacheKey, 3600, function () use ($request) {
            // Featured blog
            $featuredBlog = Blog::published()
                ->featured()
                ->with(['author', 'category'])
                ->orderBy('published_at', 'desc')
                ->first();

            // Main blogs with SEO optimization
            $blogs = Blog::published()
                ->with(['author', 'category', 'relatedTags'])
                ->when($request->category, function ($query, $categorySlug) {
                    $query->whereHas('category', function ($q) use ($categorySlug) {
                        $q->where('slug', $categorySlug);
                    });
                })
                ->when($request->tag, function ($query, $tagSlug) {
                    $query->whereHas('relatedTags', function ($q) use ($tagSlug) {
                        $q->where('slug', $tagSlug);
                    });
                })
                ->when($request->q, function ($query, $search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%")
                            ->orWhere('content', 'like', "%{$search}%")
                            ->orWhere('excerpt', 'like', "%{$search}%")
                            ->orWhere('meta_keywords', 'like', "%{$search}%");
                    });
                })
                ->orderBy('published_at', 'desc')
                ->paginate(12);

            // Categories for sidebar
            // Assuming 'active' scope is defined as is_active=true
            $categories = BlogCategory::where('is_active', true)
                ->withCount(['blogs' => function ($query) {
                    $query->published();
                }])
                ->orderBy('order')
                ->get();

            // Popular tags
            $popularTags = BlogTag::withCount('blogs')
                ->orderBy('usage_count', 'desc')
                ->limit(15)
                ->get();

            return [
                'featuredBlog' => $featuredBlog,
                'blogs' => $blogs,
                'categories' => $categories,
                'popularTags' => $popularTags,
            ];
        });

        // Generate SEO metadata
        $pageTitle = "Medical Blog | Health Articles & Tips";
        $metaDescription = "Expert medical advice, health tips, and wellness articles from licensed healthcare professionals. Stay informed about your health.";

        $category = null;
        if ($request->category) {
            $category = BlogCategory::where('slug', $request->category)->first();
            if ($category) {
                $pageTitle = "{$category->name} Articles | Medical Blog";
                $metaDescription = $category->meta_description ?? "Read articles about {$category->name} from medical experts.";
            }
        }

        if ($request->tag) {
            $tag = BlogTag::where('slug', $request->tag)->first();
            if ($tag) {
                $pageTitle = "Articles about {$tag->name} | Health Topics";
                $metaDescription = "Discover articles, tips, and information about {$tag->name} from medical professionals.";
            }
        }

        return view('frontend.blog.index', array_merge($data, [
            'pageTitle' => $pageTitle,
            'metaDescription' => $metaDescription,
            'category' => $category ?? null,
        ]));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->published()
            ->with(['author', 'category', 'relatedTags', 'comments' => function ($query) {
                $query->approved()->with('user');
            }])
            ->firstOrFail();

        // Increment views
        $blog->incrementViews();

        // Related articles (semantic SEO)
        $relatedArticles = Cache::remember("blog_related_{$blog->id}", 300, function () use ($blog) {
            return Blog::published()
                ->where('id', '!=', $blog->id)
                ->where('category_id', $blog->category_id)
                ->orWhere(function ($query) use ($blog) {
                    $tagIds = $blog->relatedTags->pluck('id');
                    $query->whereHas('relatedTags', function ($q) use ($tagIds) {
                        $q->whereIn('id', $tagIds);
                    });
                })
                ->with(['author', 'category'])
                ->limit(4)
                ->get();
        });

        // Generate structured data for AI
        $structuredData = $blog->generateStructuredData();

        // Add FAQ schema if exists
        if ($blog->faq_json) {
            $structuredData['mainEntity'] = [
                '@type' => 'FAQPage',
                'mainEntity' => array_map(function ($faq) {
                    return [
                        '@type' => 'Question',
                        'name' => $faq['question'],
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => $faq['answer']
                        ]
                    ];
                }, $blog->faq_json)
            ];
        }

        return view('frontend.blog.show', [
            'blog' => $blog,
            'relatedArticles' => $relatedArticles,
            'structuredData' => $structuredData,
            'pageTitle' => $blog->meta_title ?? $blog->title,
            'metaDescription' => $blog->meta_description ?? $blog->excerpt,
        ]);
    }

    public function sitemap()
    {
        $blogs = Blog::published()
            ->select(['slug', 'updated_at'])
            ->orderBy('updated_at', 'desc')
            ->get();

        $categories = BlogCategory::where('is_active', true)
            ->select(['slug', 'updated_at'])
            ->get();

        return response()->view('frontend.blog.sitemap', [
            'blogs' => $blogs,
            'categories' => $categories,
        ])->header('Content-Type', 'application/xml');
    }

    public function generateJSONLD(Request $request)
    {
        $type = $request->type;

        switch ($type) {
            case 'medical_organization':
                return response()->json([
                    '@context' => 'https://schema.org',
                    '@type' => 'MedicalOrganization',
                    'name' => 'SehaSave',
                    'url' => url('/'),
                    'logo' => asset('assets/img/logo.png'),
                    'description' => 'Medical referral platform connecting patients with healthcare providers',
                    'medicalSpecialty' => [
                        'General Medicine',
                        'Dermatology',
                        'Cardiology',
                        'Pediatrics',
                        'Dentistry'
                    ],
                    'founder' => [
                        '@type' => 'Person',
                        'name' => 'SehaSave Team'
                    ]
                ]);

            case 'health_topic_collection':
                return response()->json([
                    '@context' => 'https://schema.org',
                    '@type' => 'CollectionPage',
                    'name' => 'Health Topics',
                    'description' => 'Collection of medical articles and health information',
                    'hasPart' => BlogCategory::where('is_active', true)->get()->map(function ($category) {
                        return [
                            '@type' => 'WebPage',
                            'name' => $category->name,
                            'url' => route('blog.category', $category->slug),
                            'description' => $category->description
                        ];
                    })->toArray()
                ]);
        }
    }
}
