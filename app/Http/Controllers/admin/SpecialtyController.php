<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Specialty::with('parent', 'children');

        // البحث
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name_ar', 'like', "%{$search}%")
                    ->orWhere('name_en', 'like', "%{$search}%")
                    ->orWhere('description_ar', 'like', "%{$search}%")
                    ->orWhere('description_en', 'like', "%{$search}%");
            });
        }

        // التصفية حسب النوع
        if ($request->has('level') && $request->level != '') {
            $query->where('level', $request->level);
        }

        // التصفية حسب الحالة
        if ($request->has('status') && $request->status != '') {
            $query->where('is_active', $request->status == 'active');
        }

        $specialties = $query->orderBy('order')->paginate(15);

        $mainSpecialties = Specialty::main()->active()->get();

        return view('backend.specialties.index', compact('specialties', 'mainSpecialties'));
    }

    /**
     * عرض نموذج إنشاء تخصص جديد
     */
    public function create()
    {
        $mainSpecialties = Specialty::main()->active()->get();
        return view('backend.specialties.create', compact('mainSpecialties'));
    }

    /**
     * حفظ التخصص الجديد
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'parent_id' => 'nullable|exists:specialties,id',
            'level' => 'required|in:1,2,3',
            'color' => 'nullable|string|max:7',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // 2MB
            'meta_title_ar' => 'nullable|string|max:255',
            'meta_title_en' => 'nullable|string|max:255',
            'meta_description_ar' => 'nullable|string',
            'meta_description_en' => 'nullable|string',
            'requirements' => 'nullable|array',
            'skills' => 'nullable|array',
        ]);

        DB::beginTransaction();
        try {
            // معالجة الصورة الرئيسية
            if ($request->hasFile('image')) {
                $validated['image'] = $this->processImage($request->file('image'), 'specialties', 800, 600);
            }

            // معالجة الأيقونة
            if ($request->hasFile('icon')) {
                $validated['icon'] = $this->processIcon($request->file('icon'), 'specialties/icons', 200, 200);
            }

            // إنشاء الـ slugs تلقائياً
            $validated['slug_ar'] = $this->generateUniqueSlug($validated['name_ar'], 'slug_ar');
            $validated['slug_en'] = $this->generateUniqueSlug($validated['name_en'], 'slug_en');

            Specialty::create($validated);

            DB::commit();

            return redirect()->route('admin.specialties.index')
                ->with('success', 'تم إنشاء التخصص بنجاح.');
        } catch (\Exception $e) {
            DB::rollBack();

            // حذف الصور إذا فشل الإنشاء
            if (isset($validated['image']) && Storage::disk('public')->exists($validated['image'])) {
                Storage::disk('public')->delete($validated['image']);
            }
            if (isset($validated['icon']) && Storage::disk('public')->exists($validated['icon'])) {
                Storage::disk('public')->delete($validated['icon']);
            }

            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء إنشاء التخصص: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * تحديث التخصص (محسن)
     */
    public function update(Request $request, Specialty $specialty)
    {
        $validated = $request->validate([
            // نفس قواعد التحقق...
        ]);

        DB::beginTransaction();
        try {
            $oldImage = $specialty->image;
            $oldIcon = $specialty->icon;

            // 🔥 **الإصلاح: استخدام fill() بدلاً من update() مباشرة**
            $specialty->fill($validated);

            // معالجة الصورة الرئيسية
            if ($request->hasFile('image')) {
                $specialty->image = $this->processImage($request->file('image'), 'specialties', 800, 600);
            } elseif ($request->has('delete_image')) {
                $specialty->image = null;
            }

            // معالجة الأيقونة
            if ($request->hasFile('icon')) {
                $specialty->icon = $this->processIcon($request->file('icon'), 'specialties/icons', 200, 200);
            } elseif ($request->has('delete_icon')) {
                $specialty->icon = null;
            }

            // تحديث الـ slugs إذا تغير الاسم
            if ($specialty->isDirty('name_ar')) {
                $specialty->slug_ar = $this->generateUniqueSlug($validated['name_ar'], 'slug_ar', $specialty->id);
            }

            if ($specialty->isDirty('name_en')) {
                $specialty->slug_en = $this->generateUniqueSlug($validated['name_en'], 'slug_en', $specialty->id);
            }

            $specialty->save();

            // حذف الصور القديمة بعد التحديث الناجح
            if ($request->hasFile('image') && $oldImage && $oldImage != $specialty->image) {
                Storage::disk('public')->delete($oldImage);
            }
            if ($request->has('delete_image') && $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
            if ($request->hasFile('icon') && $oldIcon && $oldIcon != $specialty->icon) {
                Storage::disk('public')->delete($oldIcon);
            }
            if ($request->has('delete_icon') && $oldIcon) {
                Storage::disk('public')->delete($oldIcon);
            }

            DB::commit();

            return redirect()->route('admin.specialties.index')
                ->with('success', 'تم تحديث التخصص بنجاح.');
        } catch (\Exception $e) {
            DB::rollBack();

            // حذف الصور الجديدة إذا فشل التحديث
            if ($request->hasFile('image') && isset($specialty->image) && Storage::disk('public')->exists($specialty->image)) {
                Storage::disk('public')->delete($specialty->image);
            }
            if ($request->hasFile('icon') && isset($specialty->icon) && Storage::disk('public')->exists($specialty->icon)) {
                Storage::disk('public')->delete($specialty->icon);
            }

            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء تحديث التخصص: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * عرض تفاصيل التخصص
     */
    public function show(Specialty $specialty)
    {
        $specialty->load('parent', 'children', 'doctors.doctor');
        return view('backend.specialties.show', compact('specialty'));
    }

    /**
     * عرض نموذج تعديل التخصص
     */
    public function edit(Specialty $specialty)
    {
        $mainSpecialties = Specialty::main()->active()->where('id', '!=', $specialty->id)->get();
        return view('backend.specialties.edit', compact('specialty', 'mainSpecialties'));
    }

    /**
     * تحديث التخصص
     */

    /**
     * حذف التخصص
     */
    public function destroy(Specialty $specialty)
    {
        // لا يمكن حذف تخصص له أطباء مرتبطين به
        if ($specialty->doctors()->count() > 0) {
            return redirect()->back()
                ->with('error', 'لا يمكن حذف التخصص لأنه مرتبط بعدد من الأطباء.');
        }

        // حذف الصور إذا كانت موجودة
        if ($specialty->image) {
            Storage::disk('public')->delete($specialty->image);
        }
        if ($specialty->icon) {
            Storage::disk('public')->delete($specialty->icon);
        }

        $specialty->delete();

        return redirect()->route('admin.specialties.index')
            ->with('success', 'تم حذف التخصص بنجاح.');
    }

    /**
     * تحديث حالة التخصص (تفعيل/تعطيل)
     */
    public function toggleStatus(Specialty $specialty)
    {
        $newStatus = !$specialty->is_active;

        // استخدام Query Builder لتجنب Model Events
        DB::table('specialties')
            ->where('id', $specialty->id)
            ->update([
                'is_active' => $newStatus,
                'updated_at' => now()
            ]);

        $status = $newStatus ? 'مفعل' : 'معطل';

        return redirect()->back()
            ->with('success', "تم {$status} التخصص بنجاح.");
    }

    /**
     * تحديث حالة التميز
     */
    public function toggleFeatured(Specialty $specialty)
    {
        $specialty->update([
            'is_featured' => !$specialty->is_featured
        ]);

        $status = $specialty->is_featured ? 'مميز' : 'غير مميز';

        return redirect()->back()
            ->with('success', "تم جعل التخصص {$status} بنجاح.");
    }

    /**
     * تحديث ترتيب التخصصات
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:specialties,id',
            'orders.*.order' => 'required|integer'
        ]);

        foreach ($request->orders as $order) {
            Specialty::where('id', $order['id'])->update(['order' => $order['order']]);
        }

        return response()->json(['success' => true, 'message' => 'تم تحديث الترتيب بنجاح.']);
    }




    private function processImage($image, $folder, $width, $height)
    {
        $filename = 'specialty_' . time() . '_' . Str::random(10) . '.webp';
        $path = $folder . '/' . $filename;

        // إنشاء المجلد إذا لم يكن موجوداً
        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        try {
            // تحسين الصورة وتحويلها إلى webp
            $image = Image::make($image)
                ->fit($width, $height)
                ->encode('webp', 85);

            // حفظ الصورة والتحقق من النجاح
            $saved = Storage::disk('public')->put($path, $image);

            if (!$saved) {
                throw new \Exception('فشل في حفظ الصورة على السيرفر');
            }

            // إرجاع المسار النسبي للتخزين في قاعدة البيانات
            return $path;
        } catch (\Exception $e) {
            throw new \Exception('خطأ في معالجة الصورة: ' . $e->getMessage());
        }
    }
    /**
     * معالجة الأيقونة
     */
    private function processIcon($icon, $folder, $width, $height)
    {
        // إنشاء المجلد إذا لم يكن موجوداً
        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        $extension = strtolower($icon->getClientOriginalExtension());
        $filename = 'icon_' . time() . '_' . Str::random(10) . '.' . $extension;
        $path = $folder . '/' . $filename;

        try {
            if ($extension === 'svg') {
                // حفظ SVG كما هو
                $saved = Storage::disk('public')->put($path, file_get_contents($icon));
            } else {
                // تحسين الصورة العادية
                $image = Image::make($icon)
                    ->fit($width, $height)
                    ->encode($extension === 'jpg' ? 'jpeg' : $extension, 90);

                $saved = Storage::disk('public')->put($path, $image);
            }

            if (!$saved) {
                throw new \Exception('فشل في حفظ الأيقونة على السيرفر');
            }

            return $path;
        } catch (\Exception $e) {
            throw new \Exception('خطأ في معالجة الأيقونة: ' . $e->getMessage());
        }
    }

    private function generateUniqueSlug($name, $slugField, $excludeId = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        $query = Specialty::where($slugField, $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;

            $query = Specialty::where($slugField, $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }

        return $slug;
    }

    /**
     * حذف الصورة من التخصص
     */
    public function deleteImage(Specialty $specialty)
    {
        if ($specialty->image) {
            Storage::disk('public')->delete($specialty->image);
            $specialty->update(['image' => null]);

            return response()->json(['success' => true, 'message' => 'تم حذف الصورة بنجاح.']);
        }

        return response()->json(['success' => false, 'message' => 'لا توجد صورة لحذفها.'], 404);
    }

    public function deleteIcon(Specialty $specialty)
    {
        if ($specialty->icon) {
            Storage::disk('public')->delete($specialty->icon);
            $specialty->update(['icon' => null]);

            return response()->json(['success' => true, 'message' => 'تم حذف الأيقونة بنجاح.']);
        }

        return response()->json(['success' => false, 'message' => 'لا توجد أيقونة لحذفها.'], 404);
    }
}
