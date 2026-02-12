<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\TranslatableContent;
use App\Models\TranslationJob;
use App\Models\Language;
use App\Services\AI\BlogAIGenerator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class AdminBlogController extends Controller
{


    protected $aiGenerator;

    public function __construct()
    {
        $this->aiGenerator = new BlogAIGenerator();
    }



    public function generateWithAI(Request $request)
    {
        $request->validate([
            'topic' => 'required|string|max:255',
            'category_id' => 'required|exists:blog_categories,id',
            'content_type' => 'required|in:article,guide,research,tips,faq,case_study',
            'keywords' => 'nullable|string',
            'word_count' => 'nullable|integer|min:500|max:5000'
        ]);

        $params = [
            'topic' => $request->topic,
            'category_id' => $request->category_id,
            'content_type' => $request->content_type,
            'keywords' => $request->keywords ? explode(',', $request->keywords) : [],
            'word_count' => $request->word_count ?? 1500
        ];

        $articleData = $this->aiGenerator->generateMedicalArticle($params);

        return response()->json([
            'success' => true,
            'data' => $articleData,
            'suggestions' => [
                'titles' => $this->aiGenerator->suggestTitles($request->topic, 5),
                'meta_descriptions' => $this->aiGenerator->generateSEOMeta($articleData['title'], $articleData['content'])
            ]
        ]);
    }

    /**
     * تحسين مقال موجود بالذكاء الاصطناعي
     */
    public function improveWithAI($id)
    {
        $blog = Blog::findOrFail($id);

        $improvedData = $this->aiGenerator->improveExistingArticle($blog);

        return view('backend.blog.improve-with-ai', compact('blog', 'improvedData'));
    }

    /**
     * حفظ المقال المولد
     */
    public function storeAIGenerated(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'required|string|max:500',
            'category_id' => 'required|exists:blog_categories,id',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'target_keywords' => 'nullable|array',
            'faq_json' => 'nullable|array',
            'is_ai_generated' => 'boolean'
        ]);

        $blog = Blog::create([
            'title' => $request->title,
            'slug' => \Illuminate\Support\Str::slug($request->title) . '-' . \Illuminate\Support\Str::random(6),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'target_keywords' => $request->target_keywords,
            'faq_json' => $request->faq_json,
            'word_count' => str_word_count($request->content),
            'reading_time' => ceil(str_word_count($request->content) / 200) . ' min',
            'author_id' => auth()->id(),
            'status' => 'draft',
            'is_ai_generated' => $request->boolean('is_ai_generated', true),
            'ai_generated_at' => now(),
            'ai_model' => 'gpt-4'
        ]);

        return redirect()->route('admin.blog.edit', $blog->id)
            ->with('success', 'تم إنشاء المقال بالذكاء الاصطناعي بنجاح. يمكنك الآن مراجعته وتعديله.');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Blog::with(['category', 'author', 'translations'])
            ->when($request->search, function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                    ->orWhere('content', 'like', "%{$request->search}%")
                    ->orWhere('excerpt', 'like', "%{$request->search}%");
            })
            ->when($request->status, function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->when($request->category, function ($q) use ($request) {
                $q->where('category_id', $request->category);
            })
            ->when($request->author, function ($q) use ($request) {
                $q->where('author_id', $request->author);
            })
            ->when($request->featured, function ($q) use ($request) {
                $q->where('featured', $request->featured === 'yes');
            })
            ->when($request->date_from, function ($q) use ($request) {
                $q->whereDate('published_at', '>=', $request->date_from);
            })
            ->when($request->date_to, function ($q) use ($request) {
                $q->whereDate('published_at', '<=', $request->date_to);
            });

        // Sort options
        switch ($request->sort) {
            case 'views_desc':
                $query->orderBy('views', 'desc');
                break;
            case 'views_asc':
                $query->orderBy('views', 'asc');
                break;
            case 'likes_desc':
                $query->orderBy('likes', 'desc');
                break;
            case 'likes_asc':
                $query->orderBy('likes', 'asc');
                break;
            case 'published_desc':
                $query->orderBy('published_at', 'desc');
                break;
            case 'published_asc':
                $query->orderBy('published_at', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $blogs = $query->paginate(20);

        // Calculate SEO score for each blog
        foreach ($blogs as $blog) {
            $blog->seo_score = $this->calculateSeoScore($blog);
        }

        $categories = BlogCategory::where('is_active', true)->get();
        $statuses = ['draft', 'published', 'archived'];
        $authors = \App\Models\User::whereHas('blogs')->get();

        // Statistics for dashboard
        $stats = [
            'total' => Blog::count(),
            'published' => Blog::where('status', 'published')->count(),
            'drafts' => Blog::where('status', 'draft')->count(),
            'featured' => Blog::where('featured', true)->count(),
            'views_today' => Blog::whereDate('created_at', today())->sum('views'),
            'views_month' => Blog::whereMonth('created_at', now()->month)->sum('views'),
        ];

        return view('backend.blog.index', compact('blogs', 'categories', 'statuses', 'authors', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::where('is_active', true)->get();
        $tags = BlogTag::orderBy('name')->get();
        $contentTypes = ['article', 'news', 'guide', 'research', 'tips', 'faq', 'case_study'];
        $schemaTypes = ['Article', 'NewsArticle', 'BlogPosting', 'MedicalWebPage', 'FAQPage'];
        $languages = Language::where('is_active', true)->get();
        $updateFrequencies = ['always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'];

        return view('backend.blog.create', compact(
            'categories',
            'tags',
            'contentTypes',
            'schemaTypes',
            'languages',
            'updateFrequencies'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'schema_type' => 'nullable|string',
            'target_keywords' => 'nullable|string',
            'author_credentials' => 'nullable|string',
            'author_bio' => 'nullable|string',
            'canonical_url' => 'nullable|url',
            'update_frequency' => 'nullable|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
            'source_locale' => 'required|string|size:2',
            'is_translatable' => 'boolean',
            'translation_priority' => 'nullable|in:1,2,3,4,5',
            'target_locales' => 'nullable|array',
        ]);

        DB::beginTransaction();
        try {
            // Handle featured image
            $featuredImagePath = null;
            if ($request->hasFile('featured_image')) {
                $featuredImagePath = $request->file('featured_image')->store('blogs', 'public');
            }

            // Calculate reading time
            $wordCount = str_word_count(strip_tags($request->content));
            $readingTime = ceil($wordCount / 200);

            // Create blog
            $blog = Blog::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title) . '-' . Str::random(6),
                'excerpt' => $request->excerpt,
                'content' => $request->content,
                'featured_image' => $featuredImagePath,
                'status' => $request->status ?? 'draft',
                'visibility' => $request->visibility ?? 'public',
                'content_type' => $request->content_type ?? 'article',
                'reading_time' => $readingTime . ' min',
                'author_id' => auth()->id(),
                'category_id' => $request->category_id,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'canonical_url' => $request->canonical_url,
                'schema_type' => $request->schema_type,
                'target_keywords' => $request->target_keywords ? json_encode(explode(',', $request->target_keywords)) : null,
                'ls_keyword' => $request->ls_keyword,
                'word_count' => $wordCount,
                'source_locale' => $request->source_locale,
                'is_translatable' => $request->boolean('is_translatable'),
                'translation_priority' => $request->translation_priority,
                'featured' => $request->boolean('featured'),
                'published_at' => $request->status === 'published' ? now() : null,
                'scheduled_for' => $request->scheduled_for ? Carbon::parse($request->scheduled_for) : null,
                'author_credentials' => $request->author_credentials,
                'author_bio' => $request->author_bio,
                'update_frequency' => $request->update_frequency,
                'last_updated' => now(),
            ]);

            // Sync tags
            if ($request->tags) {
                $blog->relatedTags()->sync($request->tags);

                // Update tag usage count
                foreach ($request->tags as $tagId) {
                    BlogTag::where('id', $tagId)->increment('usage_count');
                }
            }

            // Handle FAQ data
            if ($request->faqs) {
                $faqs = [];
                foreach ($request->faqs as $faq) {
                    if (!empty($faq['question']) && !empty($faq['answer'])) {
                        $faqs[] = [
                            'question' => $faq['question'],
                            'answer' => $faq['answer'],
                        ];
                    }
                }
                if (!empty($faqs)) {
                    $blog->update(['faq_json' => $faqs]);
                }
            }

            // Create translation job if requested
            if ($request->boolean('is_translatable') && $request->target_locales) {
                $blog->createTranslationJob(
                    $request->target_locales,
                    $request->translation_priority ? 'high' : 'medium',
                    [
                        'translate_medical_terms' => $request->boolean('translate_medical_terms'),
                        'cultural_adaptation' => $request->boolean('cultural_adaptation'),
                        'seo_optimized' => $request->boolean('seo_optimized'),
                    ]
                );
            }

            DB::commit();

            // Clear cache
            Cache::forget('blogs_index_*');

            return redirect()->route('adminblog.index')
                ->with('success', 'Blog created successfully. ' .
                    ($request->boolean('is_translatable') ? 'Translation job created.' : ''));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error creating blog: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::with([
            'category',
            'author',
            'relatedTags',
            'translations',
            'translations.translator',
            'translations.reviewer'
        ])->findOrFail($id);

        $seoData = $blog->generateStructuredData();
        $translationJobs = TranslationJob::where('source_type', Blog::class)
            ->where('source_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        $seoScore = $this->calculateSeoScore($blog);

        return view('backend.blog.show', compact('blog', 'seoData', 'translationJobs', 'seoScore'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::with(['relatedTags', 'translations'])->findOrFail($id);
        $categories = BlogCategory::where('is_active', true)->get();
        $tags = BlogTag::orderBy('name')->get();
        $contentTypes = ['article', 'news', 'guide', 'research', 'tips', 'faq', 'case_study'];
        $schemaTypes = ['Article', 'NewsArticle', 'BlogPosting', 'MedicalWebPage', 'FAQPage'];
        $languages = Language::where('is_active', true)->get();
        $updateFrequencies = ['always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'];
        $selectedTags = $blog->relatedTags->pluck('id')->toArray();
        $faqs = $blog->faq_json ?? [];

        return view('backend.blog.edit', compact(
            'blog',
            'categories',
            'tags',
            'selectedTags',
            'contentTypes',
            'schemaTypes',
            'languages',
            'updateFrequencies',
            'faqs'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'schema_type' => 'nullable|string',
            'target_keywords' => 'nullable|string',
            'author_credentials' => 'nullable|string',
            'author_bio' => 'nullable|string',
            'canonical_url' => 'nullable|url',
            'update_frequency' => 'nullable|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
            'target_locales' => 'nullable|array',
        ]);

        DB::beginTransaction();
        try {
            \Log::info('Update Request Data:', $request->all());
            // Handle featured image
            $data = [
                'title' => $request->title,
                'slug' => $request->slug ?? $blog->slug,
                'excerpt' => $request->excerpt,
                'content' => $request->content,
                'status' => $request->status,
                'visibility' => $request->visibility,
                'content_type' => $request->content_type,
                'category_id' => $request->category_id,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'canonical_url' => $request->canonical_url,
                'schema_type' => $request->schema_type,
                'target_keywords' => $request->target_keywords ? json_encode(explode(',', $request->target_keywords)) : null,
                'ls_keyword' => $request->ls_keyword,
                'featured' => $request->boolean('featured'),
                'published_at' => $request->status === 'published' && !$blog->published_at ? now() : $blog->published_at,
                'scheduled_for' => $request->scheduled_for ? Carbon::parse($request->scheduled_for) : null,
                'last_updated' => now(),
                'update_frequency' => $request->update_frequency,
                'author_credentials' => $request->author_credentials,
                'author_bio' => $request->author_bio,
            ];

            // Handle featured image
            if ($request->hasFile('featured_image')) {
                // Delete old image
                if ($blog->featured_image) {
                    Storage::disk('public')->delete($blog->featured_image);
                }
                $featuredImagePath = $request->file('featured_image')->store('blogs', 'public');
                $data['featured_image'] = $featuredImagePath;
            }

            // Update blog
            \Log::info('Update data:', $data);
            $updated = $blog->update($data);
            \Log::info('Update result: ' . ($updated ? 'true' : 'false'));

            // Sync tags with usage count update
            // Sync tags with usage count update
            if ($request->has('tags')) {
                // Ensure relatedTags is loaded or use query to avoid null on JSON column collision
                $oldTags = $blog->relatedTags()->pluck('blog_tags.id')->toArray();
                $newTags = $request->tags ?? [];

                // Decrement usage for removed tags
                $removedTags = array_diff($oldTags, $newTags);
                foreach ($removedTags as $tagId) {
                    BlogTag::where('id', $tagId)->decrement('usage_count');
                }

                // Increment usage for new tags
                $addedTags = array_diff($newTags, $oldTags);
                foreach ($addedTags as $tagId) {
                    BlogTag::where('id', $tagId)->increment('usage_count');
                }

                $blog->relatedTags()->sync($newTags);
            }

            // Handle FAQ data
            if ($request->faqs) {
                $faqs = [];
                foreach ($request->faqs as $faq) {
                    if (!empty($faq['question']) && !empty($faq['answer'])) {
                        $faqs[] = [
                            'question' => $faq['question'],
                            'answer' => $faq['answer'],
                        ];
                    }
                }
                $blog->faq_json = !empty($faqs) ? $faqs : null;
                $blog->save();
            }

            // Create new translation job if requested
            if ($request->boolean('create_translation_job') && $request->target_locales) {
                $blog->createTranslationJob(
                    $request->target_locales,
                    $request->translation_priority ? 'high' : 'medium',
                    [
                        'translate_medical_terms' => $request->boolean('translate_medical_terms'),
                        'cultural_adaptation' => $request->boolean('cultural_adaptation'),
                        'seo_optimized' => $request->boolean('seo_optimized'),
                    ]
                );
            }

            DB::commit();

            // Clear cache
            Cache::forget('blogs_index_*');
            Cache::forget("blog_related_{$blog->id}");

            return redirect()->route('adminblog.index')
                ->with('success', 'Blog updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Blog update failed: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return redirect()->back()
                ->with('error', 'Error updating blog: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);

        DB::beginTransaction();
        try {
            // Delete featured image
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }

            // Decrement tag usage counts
            foreach ($blog->tags as $tag) {
                $tag->decrement('usage_count');
            }

            // Delete translations
            $blog->translations()->delete();

            // Delete translation jobs
            TranslationJob::where('source_type', Blog::class)
                ->where('source_id', $id)
                ->delete();

            // Delete the blog
            $blog->delete();

            DB::commit();

            // Clear cache
            Cache::forget('blogs_index_*');

            return redirect()->route('adminblog.index')
                ->with('success', 'Blog deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error deleting blog: ' . $e->getMessage());
        }
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,publish,draft,archive,feature,unfeature',
            'ids' => 'required|array',
            'ids.*' => 'exists:blogs,id',
        ]);

        $count = 0;

        switch ($request->action) {
            case 'delete':
                foreach ($request->ids as $id) {
                    $blog = Blog::find($id);
                    if ($blog) {
                        $blog->delete();
                        $count++;
                    }
                }
                $message = "$count blogs deleted successfully.";
                break;

            case 'publish':
                $count = Blog::whereIn('id', $request->ids)
                    ->update(['status' => 'published', 'published_at' => now()]);
                $message = "$count blogs published successfully.";
                break;

            case 'draft':
                $count = Blog::whereIn('id', $request->ids)
                    ->update(['status' => 'draft']);
                $message = "$count blogs moved to draft.";
                break;

            case 'archive':
                $count = Blog::whereIn('id', $request->ids)
                    ->update(['status' => 'archived']);
                $message = "$count blogs archived.";
                break;

            case 'feature':
                $count = Blog::whereIn('id', $request->ids)
                    ->update(['featured' => true]);
                $message = "$count blogs marked as featured.";
                break;

            case 'unfeature':
                $count = Blog::whereIn('id', $request->ids)
                    ->update(['featured' => false]);
                $message = "$count blogs unfeatured.";
                break;
        }

        // Clear cache
        Cache::forget('blogs_index_*');

        return redirect()->back()->with('success', $message);
    }

    /**
     * Update blog status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:draft,published,archived',
        ]);

        $blog = Blog::findOrFail($id);

        $data = ['status' => $request->status];

        if ($request->status === 'published' && !$blog->published_at) {
            $data['published_at'] = now();
        }

        $blog->update($data);

        Cache::forget('blogs_index_*');

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully.',
            'status' => $blog->status
        ]);
    }

    /**
     * Regenerate slug
     */
    public function regenerateSlug($id)
    {
        $blog = Blog::findOrFail($id);
        $newSlug = Str::slug($blog->title) . '-' . Str::random(6);

        $blog->update(['slug' => $newSlug]);

        return response()->json([
            'success' => true,
            'message' => 'Slug regenerated successfully.',
            'slug' => $newSlug
        ]);
    }

    /**
     * Clone blog
     */
    public function clone($id)
    {
        $blog = Blog::with('relatedTags')->findOrFail($id);

        DB::beginTransaction();
        try {
            $newBlog = $blog->replicate();
            $newBlog->title = $blog->title . ' (Copy)';
            $newBlog->slug = $blog->slug . '-copy-' . Str::random(6);
            $newBlog->status = 'draft';
            $newBlog->views = 0;
            $newBlog->likes = 0;
            $newBlog->shares = 0;
            $newBlog->featured = false;
            $newBlog->published_at = null;
            $newBlog->scheduled_for = null;
            $newBlog->save();

            // Copy tags
            $newBlog->relatedTags()->sync($blog->relatedTags->pluck('id'));

            DB::commit();

            return redirect()->route('adminblog.edit', $newBlog->id)
                ->with('success', 'Blog cloned successfully. You can now edit the copy.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error cloning blog: ' . $e->getMessage());
        }
    }

    /**
     * Export blogs
     */
    public function export(Request $request)
    {
        $blogs = Blog::with(['category', 'author', 'relatedTags'])
            ->when($request->format, function ($q) use ($request) {
                if ($request->format === 'csv') {
                    return $q->get(['id', 'title', 'slug', 'status', 'views', 'likes', 'published_at']);
                }
                return $q->get();
            });

        if ($request->format === 'csv') {
            $fileName = 'blogs-export-' . date('Y-m-d') . '.csv';
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=$fileName",
            ];

            $callback = function () use ($blogs) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['ID', 'Title', 'Slug', 'Status', 'Views', 'Likes', 'Published At']);

                foreach ($blogs as $blog) {
                    fputcsv($file, [
                        $blog->id,
                        $blog->title,
                        $blog->slug,
                        $blog->status,
                        $blog->views,
                        $blog->likes,
                        $blog->published_at ? $blog->published_at->format('Y-m-d') : 'N/A'
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        // Default to JSON
        return response()->json($blogs);
    }

    /**
     * SEO Analysis for blog
     */
    public function seoAnalysis($id)
    {
        $blog = Blog::with(['category', 'relatedTags'])->findOrFail($id);

        // استخدام الدالة المحسنة
        $analysis = $this->analyzeBlogSeo($blog);
        $totalScore = $this->calculateSeoScore($blog);

        return view('backend.blog.seo-analysis', compact('blog', 'analysis', 'totalScore'));
    }

    /**
     * Calculate SEO Score for blog
     */
    private function calculateSeoScore($blog)
    {
        $score = 0;
        $maxScore = 100;

        // 1. Title Analysis (25 points)
        $titleLength = strlen($blog->title);
        if ($titleLength >= 50 && $titleLength <= 60) {
            $score += 25; // Optimal
        } elseif ($titleLength >= 40 && $titleLength <= 70) {
            $score += 20; // Acceptable
        } elseif ($titleLength >= 30 && $titleLength <= 80) {
            $score += 15; // Fair
        } else {
            $score += 5; // Poor
        }

        // 2. Meta Description (20 points)
        if ($blog->meta_description) {
            $descLength = strlen($blog->meta_description);
            if ($descLength >= 120 && $descLength <= 160) {
                $score += 20; // Optimal
            } elseif ($descLength >= 100 && $descLength <= 200) {
                $score += 15; // Acceptable
            } elseif ($descLength >= 80 && $descLength <= 220) {
                $score += 10; // Fair
            } else {
                $score += 5; // Poor
            }
        } else {
            // Use excerpt as fallback
            $descLength = strlen($blog->excerpt);
            if ($descLength >= 120 && $descLength <= 160) {
                $score += 15; // Good excerpt
            } elseif ($descLength >= 100 && $descLength <= 200) {
                $score += 10; // Acceptable excerpt
            } else {
                $score += 5; // Poor excerpt
            }
        }

        // 3. Content Length (30 points)
        $wordCount = $blog->word_count ?? str_word_count(strip_tags($blog->content));
        if ($wordCount >= 1500) {
            $score += 30; // Excellent
        } elseif ($wordCount >= 1000) {
            $score += 25; // Very Good
        } elseif ($wordCount >= 700) {
            $score += 20; // Good
        } elseif ($wordCount >= 500) {
            $score += 15; // Fair
        } elseif ($wordCount >= 300) {
            $score += 10; // Minimal
        } else {
            $score += 5; // Poor
        }

        // 4. Featured Image (10 points)
        if ($blog->featured_image) {
            $score += 10; // Has featured image
        }

        // 5. Keywords Optimization (15 points)
        $keywordsScore = 0;

        // Check if meta keywords exist
        if ($blog->meta_keywords) {
            $keywordsScore += 5;
        }

        // Check if target keywords exist
        if ($blog->target_keywords && !empty($blog->target_keywords)) {
            $keywordsScore += 5;
        }

        // Check keyword density
        if ($blog->target_keywords) {
            $keywords = $blog->target_keywords;
            $content = strtolower(strip_tags($blog->content));
            $totalWords = str_word_count($content);

            $keywordCount = 0;
            foreach ($keywords as $keyword) {
                $keywordCount += substr_count($content, strtolower($keyword));
            }

            if ($totalWords > 0) {
                $density = ($keywordCount / $totalWords) * 100;
                if ($density >= 1 && $density <= 3) {
                    $keywordsScore += 5; // Optimal density
                } elseif ($density >= 0.5 && $density <= 4) {
                    $keywordsScore += 3; // Acceptable density
                } else {
                    $keywordsScore += 1; // Poor density
                }
            }
        }

        $score += $keywordsScore;

        // 6. Readability (10 points)
        $readabilityScore = $this->calculateFleschScore($blog->content);
        if ($readabilityScore >= 60) {
            $score += 10; // Easy to read
        } elseif ($readabilityScore >= 50) {
            $score += 7; // Fairly easy
        } elseif ($readabilityScore >= 40) {
            $score += 5; // Standard
        } elseif ($readabilityScore >= 30) {
            $score += 3; // Difficult
        } else {
            $score += 1; // Very difficult
        }

        // 7. Internal Links (5 points)
        $content = $blog->content;
        $internalLinks = substr_count($content, 'href="/') + substr_count($content, "href='/'");
        if ($internalLinks >= 3) {
            $score += 5; // Good internal linking
        } elseif ($internalLinks >= 1) {
            $score += 3; // Some internal links
        } else {
            $score += 0; // No internal links
        }

        // 8. Technical SEO (5 points)
        $technicalScore = 0;

        if ($blog->schema_type) {
            $technicalScore += 2; // Has schema
        }

        if ($blog->faq_json) {
            $technicalScore += 2; // Has FAQ schema
        }

        if ($blog->canonical_url) {
            $technicalScore += 1; // Has canonical URL
        }

        $score += $technicalScore;

        // 9. Content Freshness (5 points)
        if ($blog->last_updated) {
            $daysSinceUpdate = $blog->last_updated->diffInDays(now());
            if ($daysSinceUpdate <= 30) {
                $score += 5; // Recently updated
            } elseif ($daysSinceUpdate <= 90) {
                $score += 3; // Updated in last 3 months
            } elseif ($daysSinceUpdate <= 180) {
                $score += 1; // Updated in last 6 months
            }
        } elseif ($blog->published_at) {
            $daysSincePublish = $blog->published_at->diffInDays(now());
            if ($daysSincePublish <= 30) {
                $score += 3; // Recently published
            } elseif ($daysSincePublish <= 180) {
                $score += 1; // Published in last 6 months
            }
        }

        // Ensure score doesn't exceed 100
        return min($maxScore, $score);
    }

    /**
     * Analyze SEO for blog
     */
    private function analyzeBlogSeo($blog)
    {
        $analysis = [];

        // Title analysis
        $titleLength = strlen($blog->title);
        $analysis['title'] = [
            'length' => $titleLength,
            'optimal' => $titleLength >= 50 && $titleLength <= 60,
            'score' => $this->calculateTitleScore($titleLength),
        ];

        // Meta description analysis
        $descText = $blog->meta_description ?: $blog->excerpt;
        $descLength = strlen($descText);
        $analysis['meta_description'] = [
            'length' => $descLength,
            'optimal' => $descLength >= 120 && $descLength <= 160,
            'score' => $this->calculateDescriptionScore($descLength, (bool)$blog->meta_description),
        ];

        // Content analysis
        $wordCount = $blog->word_count ?? str_word_count(strip_tags($blog->content));
        $analysis['content'] = [
            'word_count' => $wordCount,
            'optimal' => $wordCount >= 1000,
            'score' => $this->calculateContentScore($wordCount),
        ];

        // Keywords analysis
        $analysis['keywords'] = [
            'density' => $this->calculateKeywordDensity($blog),
            'score' => $this->calculateKeywordsScore($blog),
        ];

        // Readability analysis
        $fleschScore = $this->calculateFleschScore($blog->content);
        $analysis['readability'] = [
            'flesch_score' => $fleschScore,
            'optimal' => $fleschScore >= 60,
            'score' => min(100, $fleschScore),
        ];

        // Images analysis
        $analysis['images'] = [
            'has_featured' => !empty($blog->featured_image),
            'has_alt' => false, // You would need to store alt text
            'score' => !empty($blog->featured_image) ? 100 : 0,
        ];

        // Links analysis
        $content = $blog->content;
        $analysis['links'] = [
            'internal' => substr_count($content, 'href="/') + substr_count($content, "href='/'"),
            'external' => substr_count($content, 'href="http') + substr_count($content, "href='http"),
            'score' => $this->calculateLinksScore($content),
        ];

        return $analysis;
    }

    /**
     * Helper scoring functions
     */
    private function calculateTitleScore($length)
    {
        if ($length >= 50 && $length <= 60) {
            return 100;
        } elseif ($length >= 40 && $length <= 70) {
            return 80;
        } elseif ($length >= 30 && $length <= 80) {
            return 60;
        } else {
            return 30;
        }
    }

    private function calculateDescriptionScore($length, $hasCustomMeta = false)
    {
        if ($length >= 120 && $length <= 160) {
            return $hasCustomMeta ? 100 : 90;
        } elseif ($length >= 100 && $length <= 200) {
            return $hasCustomMeta ? 80 : 70;
        } elseif ($length >= 80 && $length <= 220) {
            return $hasCustomMeta ? 60 : 50;
        } else {
            return $hasCustomMeta ? 40 : 30;
        }
    }

    private function calculateContentScore($wordCount)
    {
        if ($wordCount >= 1500) {
            return 100;
        } elseif ($wordCount >= 1000) {
            return 85;
        } elseif ($wordCount >= 700) {
            return 70;
        } elseif ($wordCount >= 500) {
            return 60;
        } elseif ($wordCount >= 300) {
            return 40;
        } else {
            return 20;
        }
    }

    private function calculateKeywordsScore($blog)
    {
        $score = 0;

        if ($blog->meta_keywords) {
            $score += 30;
        }

        if ($blog->target_keywords && !empty($blog->target_keywords)) {
            $score += 30;
        }

        // Add density score
        $density = $this->calculateKeywordDensity($blog);
        if ($density >= 1 && $density <= 3) {
            $score += 40;
        } elseif ($density >= 0.5 && $density <= 4) {
            $score += 25;
        } elseif ($density > 0) {
            $score += 10;
        }

        return min(100, $score);
    }

    private function calculateKeywordDensity($blog)
    {
        if (!$blog->target_keywords) return 0;

        $keywords = $blog->target_keywords;
        if (empty($keywords)) return 0;

        $content = strtolower(strip_tags($blog->content));
        $totalWords = str_word_count($content);

        if ($totalWords === 0) return 0;

        $keywordCount = 0;
        foreach ($keywords as $keyword) {
            $keywordCount += substr_count($content, strtolower($keyword));
        }

        return ($keywordCount / $totalWords) * 100;
    }

    private function calculateLinksScore($content)
    {
        $internalLinks = substr_count($content, 'href="/') + substr_count($content, "href='/'");
        $externalLinks = substr_count($content, 'href="http') + substr_count($content, "href='http");
        $totalLinks = $internalLinks + $externalLinks;

        if ($totalLinks >= 5 && $internalLinks >= 2) {
            return 100;
        } elseif ($totalLinks >= 3) {
            return 70;
        } elseif ($totalLinks >= 1) {
            return 40;
        } else {
            return 10;
        }
    }

    private function calculateFleschScore($content)
    {
        $text = strip_tags($content);

        // Count sentences
        $sentences = preg_split('/[.!?]+/', $text, -1, PREG_SPLIT_NO_EMPTY);
        $sentenceCount = count($sentences);

        // Count words
        $words = str_word_count($text);

        // Count syllables (simplified)
        $syllables = 0;
        foreach (explode(' ', $text) as $word) {
            $word = strtolower(preg_replace('/[^a-z]/', '', $word));
            if (strlen($word) <= 3) {
                $syllables += 1;
            } else {
                // Count vowel groups
                preg_match_all('/[aeiouy]+/', $word, $matches);
                $syllables += count($matches[0]);
            }
        }

        if ($words === 0 || $sentenceCount === 0) {
            return 0;
        }

        // Flesch Reading Ease formula
        $score = 206.835 - 1.015 * ($words / $sentenceCount) - 84.6 * ($syllables / $words);

        return max(0, min(100, $score));
    }

    private function calculateKeywordFrequency($content, $keyword)
    {
        $content = strtolower(strip_tags($content));
        $keyword = strtolower($keyword);

        // Count exact matches
        $count = substr_count($content, $keyword);

        // Count variations (plurals, etc.)
        $variations = [
            $keyword . 's',
            $keyword . 'es',
            str_replace('y', 'ies', $keyword),
        ];

        foreach ($variations as $variation) {
            $count += substr_count($content, $variation);
        }

        return $count;
    }

    /**
     * Count syllables (kept for backward compatibility)
     */
    private function countSyllables($text)
    {
        // Simplified syllable counting
        $text = strtolower($text);
        $text = preg_replace('/[^a-z]/', ' ', $text);
        $words = explode(' ', $text);

        $syllables = 0;
        foreach ($words as $word) {
            if (strlen($word) <= 3) {
                $syllables += 1;
            } else {
                $syllables += max(1, preg_match_all('/[aeiouy]+/', $word));
            }
        }

        return $syllables;
    }
}
