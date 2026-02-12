<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\FaqTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class FaqController extends Controller
{
    private const CACHE_TTL = 300; // 5 دقائق
    private const REDIS_PREFIX = 'faqs:v4:';

    /**
     * Display a listing of FAQs for frontend users (Optimized with Redis)
     */
    public function index(Request $request)
    {
        $locale = App::getLocale();
        $redisKey = $this->getRedisKey($request, $locale);

        // جلب البيانات من الكاش أو توليدها
        $data = Cache::remember($redisKey, self::CACHE_TTL, function () use ($request, $locale) {
            $freshData = $this->fetchFreshData($request, $locale);

            return [
                'faqs_items' => $freshData['faqs']->getCollection(), // تخزين الكولكشن مباشرة (سيريالايز للموديلات)
                'faqs_total' => $freshData['faqs']->total(),
                'categories' => $freshData['categories'],
                'tags' => $freshData['tags']
            ];
        });

        // التحقق من وجود المفاتيح المطلوبة (مهم في حالة وجود بيانات قديمة في الكاش)
        if (!isset($data['faqs_items'])) {
            Cache::forget($redisKey);
            return redirect()->refresh();
        }

        // إعادة بناء الـ Paginator ليعمل في الفيو
        $faqs = new LengthAwarePaginator(
            $data['faqs_items'],
            $data['faqs_total'],
            15, // perPage
            $request->input('page', 1),
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $categories = $data['categories'];
        $tags = $data['tags'];

        return view('frontend.faqs', compact('faqs', 'categories', 'tags'));
    }

    private function getRedisKey(Request $request, string $locale): string
    {
        $params = [
            'l' => $locale,
            'c' => $request->input('category', ''),
            't' => $request->input('tag', ''),
            's' => md5($request->input('search', '')),
            'p' => $request->input('page', 1)
        ];

        return self::REDIS_PREFIX . md5(serialize($params));
    }

    private function fetchFreshData(Request $request, string $locale): array
    {
        $query = Faq::with(['translations' => function ($q) use ($locale) {
            $q->where('locale', $locale);
        }])
            ->active()
            ->ordered();

        // تطبيق الفلاتر
        $this->applyFilters($query, $request);

        $perPage = 15;
        $page = $request->input('page', 1);

        // حساب العدد الإجمالي
        $total = $this->estimateCount($query);

        $faqs = $query->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        // جلب بيانات التصنيفات والوسوم بشكل متوازي (عبر الكاش)
        [$categories, $tags] = $this->fetchFiltersData();

        return [
            'faqs' => new LengthAwarePaginator(
                $faqs,
                $total,
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            ),
            'categories' => $categories,
            'tags' => $tags
        ];
    }

    private function applyFilters($query, Request $request): void
    {
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('faq_tags.id', $request->tag);
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('translations', function ($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                    ->orWhere('answer', 'like', "%{$search}%");
            });
        }
    }

    private function estimateCount($query): int
    {
        // تقدير العدد (سرعة أكبر لقواعد البيانات الضخمة)
        if (config('database.default') === 'pgsql') {
            $result = DB::selectOne("SELECT reltuples::bigint AS estimate FROM pg_class WHERE relname = 'faqs'");
            return $result ? (int) $result->estimate : $query->count();
        }

        return $query->count();
    }

    private function fetchFiltersData(): array
    {
        $categories = Cache::remember('faq_categories_optimized', 3600, function () {
            return FaqCategory::active()
                ->withCount('faqs')
                ->having('faqs_count', '>', 0)
                ->get();
        });

        $tags = Cache::remember('faq_tags_optimized', 3600, function () {
            return FaqTag::withCount('faqs')
                ->having('faqs_count', '>', 0)
                ->get();
        });

        return [$categories, $tags];
    }

    /**
     * Display the specified FAQ
     */
    public function show($slug)
    {
        $locale = App::getLocale();

        $faq = Faq::where('slug', $slug)
            ->with(['translations' => function ($q) use ($locale) {
                $q->where('locale', $locale);
            }])
            ->active()
            ->firstOrFail();

        // زيادة عدد المشاهدات
        $faq->incrementViews();

        // FAQs ذات الصلة
        $relatedFaqs = [];
        if ($faq->related_faqs) {
            $relatedFaqs = Faq::whereIn('id', $faq->related_faqs)
                ->active()
                ->with(['translations' => function ($q) use ($locale) {
                    $q->where('locale', $locale);
                }])
                ->get();
        }

        // الحصول على التصنيف
        $category = $faq->category;

        // الحصول على الوسوم
        $tags = $faq->tags;

        return view('frontend.faq-detail', compact('faq', 'relatedFaqs', 'category', 'tags'));
    }

    /**
     * Mark FAQ as helpful or not helpful
     */
    public function markHelpful(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:yes,no'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request'
            ], 400);
        }

        $faq = Faq::findOrFail($id);

        if ($request->type === 'yes') {
            $faq->increment('helpful_yes');
            $faq->helpful_yes++;
        } else {
            $faq->increment('helpful_no');
            $faq->helpful_no++;
        }

        return response()->json([
            'success' => true,
            'helpful_yes' => $faq->helpful_yes,
            'helpful_no' => $faq->helpful_no,
            'message' => __('Thank you for your feedback!')
        ]);
    }

    /**
     * Display FAQs by category
     */
    public function byCategory($slug)
    {
        $category = FaqCategory::where('slug', $slug)->firstOrFail();
        return redirect()->route('frontend.faq.index', ['category' => $category->id]);
    }

    /**
     * Display FAQs by tag
     */
    public function byTag($slug)
    {
        $tag = FaqTag::where('slug', $slug)->firstOrFail();
        return redirect()->route('frontend.faq.index', ['tag' => $tag->id]);
    }
}
