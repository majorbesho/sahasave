<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{


    public function index()
    {
        $categories = Category::featured()
            ->active()
            ->orderBy('sort_order')
            ->get();

        return view('frontend.about', compact('categories'));
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->with(['doctors.doctorProfile', 'medicalCenters'])
            ->firstOrFail();

        $doctors = $category->doctors()->paginate(12);
        $medicalCenters = $category->medicalCenters()->paginate(12);

        return view('frontend.categories.show', compact('category', 'doctors', 'medicalCenters'));
    }

    public function doctors($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $doctors = $category->doctors()
            ->with('doctorProfile')
            ->paginate(12);

        return view('frontend.categories.doctors', compact('category', 'doctors'));
    }

    public function medicalCenters($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $medicalCenters = $category->medicalCenters()->paginate(12);

        return view('frontend.categories.medical-centers', compact('category', 'medicalCenters'));
    }


    public function indexadmin()
    {
        $categories = Category::with('parent')
            ->orderBy('sort_order')
            ->get();

        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')
            ->active()
            ->get();

        return view('backend.category.create', compact('parentCategories'));
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color' => 'nullable|string|max:7',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500'
        ]);

        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);

        // Handle icon upload
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('categories/icons', 'public');
            $validated['icon'] = $iconPath;
        } else {
            $validated['icon'] = 'default-icon.png';
        }

        // Set default color if not provided
        if (empty($validated['color'])) {
            $validated['color'] = '#3B82F6'; // Default blue color
        }

        // Set default sort order if not provided
        if (empty($validated['sort_order'])) {
            $maxOrder = Category::max('sort_order');
            $validated['sort_order'] = $maxOrder ? $maxOrder + 1 : 1;
        }

        $category = Category::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'تم إنشاء التصنيف بنجاح.');
    }

    /**
     * Display the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function showadmin(Category $category)
    {
        $category->load(['parent', 'children', 'doctors', 'medicalCenters']);

        return view('backend.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->active()
            ->get();

        return view('backend.category.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($category->id)
            ],
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color' => 'nullable|string|max:7',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500'
        ]);

        // Update slug if name changed
        if ($category->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Handle icon upload
        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($category->icon && $category->icon !== 'default-icon.png') {
                Storage::disk('public')->delete($category->icon);
            }

            $iconPath = $request->file('icon')->store('categories/icons', 'public');
            $validated['icon'] = $iconPath;
        }

        $category->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'تم تحديث التصنيف بنجاح.');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Check if category has children
        if ($category->children()->count() > 0) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'لا يمكن حذف التصنيف لأنه يحتوي على تصنيفات فرعية.');
        }

        // Check if category has doctors or medical centers
        if ($category->doctors()->count() > 0 || $category->medicalCenters()->count() > 0) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'لا يمكن حذف التصنيف لأنه مرتبط بأطباء أو مراكز طبية.');
        }

        // Delete icon if exists
        if ($category->icon && $category->icon !== 'default-icon.png') {
            Storage::disk('public')->delete($category->icon);
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'تم حذف التصنيف بنجاح.');
    }

    /**
     * Update category status (Active/Inactive)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, Category $category)
    {
        $request->validate([
            'status' => 'required|in:active,inactive'
        ]);

        $category->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث حالة التصنيف بنجاح.'
        ]);
    }

    /**
     * Update category featured status
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function updateFeatured(Request $request, Category $category)
    {
        $category->update(['is_featured' => !$category->is_featured]);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث حالة التميز بنجاح.',
            'is_featured' => $category->is_featured
        ]);
    }

    /**
     * Reorder categories
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'categories' => 'required|array',
            'categories.*.id' => 'required|exists:categories,id',
            'categories.*.sort_order' => 'required|integer'
        ]);

        foreach ($request->categories as $item) {
            Category::where('id', $item['id'])->update([
                'sort_order' => $item['sort_order']
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'تم إعادة ترتيب التصنيفات بنجاح.'
        ]);
    }

    /**
     * Bulk actions for categories
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkActions(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete,featured,unfeatured',
            'ids' => 'required|array',
            'ids.*' => 'exists:categories,id'
        ]);

        $categories = Category::whereIn('id', $request->ids)->get();

        switch ($request->action) {
            case 'activate':
                Category::whereIn('id', $request->ids)->update(['status' => 'active']);
                $message = 'تم تفعيل التصنيفات المحددة بنجاح.';
                break;

            case 'deactivate':
                Category::whereIn('id', $request->ids)->update(['status' => 'inactive']);
                $message = 'تم إلغاء تفعيل التصنيفات المحددة بنجاح.';
                break;

            case 'featured':
                Category::whereIn('id', $request->ids)->update(['is_featured' => true]);
                $message = 'تم تمييز التصنيفات المحددة بنجاح.';
                break;

            case 'unfeatured':
                Category::whereIn('id', $request->ids)->update(['is_featured' => false]);
                $message = 'تم إلغاء تمييز التصنيفات المحددة بنجاح.';
                break;

            case 'delete':
                // Check if any category has children or related data
                $categoriesWithChildren = Category::whereIn('id', $request->ids)
                    ->whereHas('children')
                    ->count();

                $categoriesWithDoctors = Category::whereIn('id', $request->ids)
                    ->whereHas('doctors')
                    ->count();

                $categoriesWithMedicalCenters = Category::whereIn('id', $request->ids)
                    ->whereHas('medicalCenters')
                    ->count();

                if ($categoriesWithChildren > 0 || $categoriesWithDoctors > 0 || $categoriesWithMedicalCenters > 0) {
                    return redirect()
                        ->route('admin.categories.index')
                        ->with('error', 'لا يمكن حذف بعض التصنيفات لأنها تحتوي على بيانات مرتبطة.');
                }

                // Delete icons and categories
                foreach ($categories as $category) {
                    if ($category->icon && $category->icon !== 'default-icon.png') {
                        Storage::disk('public')->delete($category->icon);
                    }
                    $category->delete();
                }

                $message = 'تم حذف التصنيفات المحددة بنجاح.';
                break;
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', $message);
    }
}
