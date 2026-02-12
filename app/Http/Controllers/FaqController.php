<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\FaqTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Faq::with(['translations', 'category.translations', 'tags.translations']);

        // البحث
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('translations', function ($q2) use ($search) {
                    $q2->where('question', 'like', "%{$search}%")
                        ->orWhere('answer', 'like', "%{$search}%");
                });
            });
        }
        // التصفية حسب الحالة
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // التصفية حسب التصنيف
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category_id', $request->category);
        }

        $faqs = $query->orderBy('sort_order')->orderBy('id', 'DESC')->paginate(20);
        $categories = FaqCategory::active()->with('translations')->get();

        return view('backend.faq.index', compact('faqs', 'categories'));
    }



    public function show($slug)
    {
        $locale = App::getLocale();

        $faq = Faq::where('slug', $slug)
            ->with(['translations' => function ($q) use ($locale) {
                $q->where('locale', $locale);
            }])
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
        } else {
            $faq->increment('helpful_no');
        }

        return response()->json([
            'success' => true,
            'helpful_yes' => $faq->helpful_yes,
            'helpful_no' => $faq->helpful_no,
            'message' => __('Thank you for your feedback!')
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = FaqCategory::active()->with('translations')->get();
        $tags = FaqTag::with('translations')->get();
        $faqs = Faq::active()->with('translations')->get();

        return view('backend.faq.create', compact('categories', 'tags', 'faqs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_ar' => 'required|string|max:255',
            'question_en' => 'required|string|max:255',
            'answer_ar' => 'required|string',
            'answer_en' => 'required|string',
            'title_ar' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'category_id' => 'nullable|exists:faq_categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:faq_tags,id',
            'related_faqs' => 'nullable|array',
            'related_faqs.*' => 'exists:faqs,id',
            'status' => 'required|in:active,inactive,draft',
            'sort_order' => 'nullable|integer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            // رفع الصور
            $photoPath = null;
            $ogImagePath = null;

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('faqs', 'public');
            }

            if ($request->hasFile('og_image')) {
                $ogImagePath = $request->file('og_image')->store('faqs/og', 'public');
            }

            // إنشاء الـ FAQ بدون الحقول المترجمة
            $faq = new Faq([
                'status' => $request->status,
                'category_id' => $request->category_id,
                'sort_order' => $request->sort_order ?? 0,
                'photo' => $photoPath,
                'og_image' => $ogImagePath,
                'related_faqs' => $request->related_faqs,
            ]);

            // حفظ الـ FAQ أولاً للحصول على ID
            $faq->save();

            // الآن أضف الترجمات
            $faq->translateOrNew('ar')->title = $request->title_ar;
            $faq->translateOrNew('ar')->description = $request->description_ar;
            $faq->translateOrNew('ar')->question = $request->question_ar;
            $faq->translateOrNew('ar')->answer = $request->answer_ar;
            $faq->translateOrNew('ar')->meta_title = $request->meta_title_ar;
            $faq->translateOrNew('ar')->meta_description = $request->meta_description_ar;
            $faq->translateOrNew('ar')->meta_keywords = $request->meta_keywords_ar;

            $faq->translateOrNew('en')->title = $request->title_en;
            $faq->translateOrNew('en')->description = $request->description_en;
            $faq->translateOrNew('en')->question = $request->question_en;
            $faq->translateOrNew('en')->answer = $request->answer_en;
            $faq->translateOrNew('en')->meta_title = $request->meta_title_en;
            $faq->translateOrNew('en')->meta_description = $request->meta_description_en;
            $faq->translateOrNew('en')->meta_keywords = $request->meta_keywords_en;

            // حفظ الترجمات
            $faq->save();

            // إضافة الـ Tags
            if ($request->has('tags')) {
                $faq->tags()->sync($request->tags);
            }

            DB::commit();

            return redirect()->route('faq.index')->with('success', 'تم إنشاء السؤال بنجاح');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $faq = Faq::with(['translations', 'tags', 'category'])->findOrFail($id);
        $categories = FaqCategory::active()->with('translations')->get();
        $tags = FaqTag::with('translations')->get();
        $allFaqs = Faq::where('id', '!=', $id)->active()->with('translations')->get();

        // الحصول على الترجمات الحالية
        $transAr = $faq->translations->where('locale', 'ar')->first();
        $transEn = $faq->translations->where('locale', 'en')->first();

        return view('backend.faq.edit', compact('faq', 'categories', 'tags', 'allFaqs', 'transAr', 'transEn'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'question_ar' => 'required|string|max:255',
            'question_en' => 'required|string|max:255',
            'answer_ar' => 'required|string',
            'answer_en' => 'required|string',
            'title_ar' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'category_id' => 'nullable|exists:faq_categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:faq_tags,id',
            'related_faqs' => 'nullable|array',
            'related_faqs.*' => 'exists:faqs,id',
            'status' => 'required|in:active,inactive,draft',
            'sort_order' => 'nullable|integer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            // تحديث الصور
            if ($request->hasFile('photo')) {
                // حذف الصورة القديمة إذا كانت موجودة
                if ($faq->photo) {
                    \Storage::disk('public')->delete($faq->photo);
                }
                $faq->photo = $request->file('photo')->store('faqs', 'public');
            }

            if ($request->hasFile('og_image')) {
                // حذف الصورة القديمة إذا كانت موجودة
                if ($faq->og_image) {
                    \Storage::disk('public')->delete($faq->og_image);
                }
                $faq->og_image = $request->file('og_image')->store('faqs/og', 'public');
            }

            // تحديث البيانات الأساسية
            $faq->status = $request->status;
            $faq->category_id = $request->category_id;
            $faq->sort_order = $request->sort_order ?? $faq->sort_order;
            $faq->related_faqs = $request->related_faqs;

            // تحديث الترجمات العربية
            $faq->translateOrNew('ar')->title = $request->title_ar;
            $faq->translateOrNew('ar')->description = $request->description_ar;
            $faq->translateOrNew('ar')->question = $request->question_ar;
            $faq->translateOrNew('ar')->answer = $request->answer_ar;
            $faq->translateOrNew('ar')->meta_title = $request->meta_title_ar;
            $faq->translateOrNew('ar')->meta_description = $request->meta_description_ar;
            $faq->translateOrNew('ar')->meta_keywords = $request->meta_keywords_ar;

            // تحديث الترجمات الإنجليزية
            $faq->translateOrNew('en')->title = $request->title_en;
            $faq->translateOrNew('en')->description = $request->description_en;
            $faq->translateOrNew('en')->question = $request->question_en;
            $faq->translateOrNew('en')->answer = $request->answer_en;
            $faq->translateOrNew('en')->meta_title = $request->meta_title_en;
            $faq->translateOrNew('en')->meta_description = $request->meta_description_en;
            $faq->translateOrNew('en')->meta_keywords = $request->meta_keywords_en;

            // حفظ التغييرات
            $faq->save();

            // تحديث الـ Tags
            if ($request->has('tags')) {
                $faq->tags()->sync($request->tags);
            } else {
                $faq->tags()->detach();
            }

            DB::commit();

            return redirect()->route('faq.index')->with('success', 'تم تحديث السؤال بنجاح');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage())->withInput();
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);

        DB::beginTransaction();
        try {
            // حذف الصور
            if ($faq->photo) {
                \Storage::disk('public')->delete($faq->photo);
            }
            if ($faq->og_image) {
                \Storage::disk('public')->delete($faq->og_image);
            }

            // حذف الترجمات أولاً
            $faq->translations()->delete();

            // حذف العلاقات
            $faq->tags()->detach();

            // حذف الـ FAQ نفسه
            $faq->delete();

            DB::commit();

            return redirect()->route('faq.index')->with('success', 'تم حذف السؤال بنجاح');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }

    /**
     * Update FAQ status.
     */
    public function status(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->status = $request->status;
        $faq->save();

        return response()->json(['success' => true, 'message' => 'تم تحديث الحالة بنجاح']);
    }

    /**
     * Bulk actions.
     */
    public function bulkAction(Request $request)
    {
        $action = $request->action;
        $ids = $request->ids;

        if (empty($ids)) {
            return redirect()->back()->with('error', 'لم يتم تحديد أي عناصر');
        }

        switch ($action) {
            case 'activate':
                Faq::whereIn('id', $ids)->update(['status' => 'active']);
                break;

            case 'deactivate':
                Faq::whereIn('id', $ids)->update(['status' => 'inactive']);
                break;

            case 'delete':
                Faq::whereIn('id', $ids)->each(function ($faq) {
                    // حذف الصور
                    if ($faq->photo) {
                        \Storage::disk('public')->delete($faq->photo);
                    }
                    if ($faq->og_image) {
                        \Storage::disk('public')->delete($faq->og_image);
                    }

                    // حذف الترجمات
                    $faq->translations()->delete();

                    // حذف العلاقات
                    $faq->tags()->detach();

                    // حذف الـ FAQ
                    $faq->delete();
                });
                break;
        }

        return redirect()->back()->with('success', 'تم تنفيذ العملية بنجاح');
    }
}
