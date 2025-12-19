<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\DoctorAward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DoctorAwardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:doctor');
    }

    /**
     * عرض صفحة إدارة الجوائز
     */
    public function index()
    {
        $doctor = Auth::user();
        $awards = $doctor->awards()->ordered()->get();

        return view('doctor.awards.index', compact('doctor', 'awards'));
    }

    /**
     * حفظ أو تحديث جائزة
     */
    public function store(Request $request)
    {
        try {
            $doctor = Auth::user();

            $validated = $request->validate([
                'award_name' => 'required|string|max:255',
                'organization' => 'nullable|string|max:255',
                'year' => 'required|integer|min:1900|max:' . date('Y'),
                'description' => 'nullable|string|max:2000',
                'award_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'award_url' => 'nullable|url|max:500',
            ], [
                'award_name.required' => 'اسم الجائزة مطلوب',
                'year.required' => 'سنة الجائزة مطلوبة',
                'year.integer' => 'يجب أن تكون السنة رقماً',
                'year.min' => 'السنة يجب أن تكون بعد 1900',
                'year.max' => 'السنة يجب أن تكون قبل أو تساوي السنة الحالية',
                'award_url.url' => 'يجب أن يكون الرابط صحيحاً',
            ]);

            // تحضير البيانات
            $awardData = [
                'doctor_id' => $doctor->id,
                'award_name' => $validated['award_name'],
                'organization' => $validated['organization'] ?? null,
                'year' => $validated['year'],
                'description' => $validated['description'] ?? null,
                'award_url' => $validated['award_url'] ?? null,
            ];

            // رفع صورة الجائزة
            if ($request->hasFile('award_image')) {
                $imagePath = $request->file('award_image')->store(
                    'doctor-awards/' . $doctor->id,
                    'public'
                );
                $awardData['award_image'] = $imagePath;
            }

            // حفظ أو تحديث
            if ($request->has('award_id') && !empty($request->award_id)) {
                $award = DoctorAward::where('doctor_id', $doctor->id)
                    ->find($request->award_id);

                if ($award) {
                    // حذف الصورة القديمة إذا تم رفع صورة جديدة
                    if ($request->hasFile('award_image') && $award->award_image) {
                        Storage::disk('public')->delete($award->award_image);
                    }

                    $award->update($awardData);
                    $message = 'تم تحديث الجائزة بنجاح';
                } else {
                    DoctorAward::create($awardData);
                    $message = 'تم إضافة الجائزة بنجاح';
                }
            } else {
                DoctorAward::create($awardData);
                $message = 'تم إضافة الجائزة بنجاح';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'redirect' => route('doctor.awards.index')
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
                'message' => 'يرجى تصحيح الأخطاء في النموذج'
            ], 422);
        } catch (\Exception $e) {
            Log::error('Award store error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حفظ الجائزة: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * الحصول على بيانات جائزة محددة
     */
    public function show($id)
    {
        try {
            $doctor = Auth::user();
            $award = DoctorAward::where('doctor_id', $doctor->id)
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'award' => $award
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'لم يتم العثور على الجائزة'
            ], 404);
        }
    }

    /**
     * حذف جائزة
     */
    public function destroy($id)
    {
        try {
            $doctor = Auth::user();
            $award = DoctorAward::where('doctor_id', $doctor->id)
                ->findOrFail($id);

            // حذف الصورة إذا كانت موجودة
            if ($award->award_image) {
                Storage::disk('public')->delete($award->award_image);
            }

            $award->delete();

            return response()->json([
                'success' => true,
                'message' => 'تم حذف الجائزة بنجاح'
            ]);
        } catch (\Exception $e) {
            Log::error('Award delete error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حذف الجائزة'
            ], 500);
        }
    }

    /**
     * تحديث ترتيب الجوائز
     */
    public function updateOrder(Request $request)
    {
        try {
            $doctor = Auth::user();
            $order = $request->input('order', []);

            foreach ($order as $index => $id) {
                DoctorAward::where('doctor_id', $doctor->id)
                    ->where('id', $id)
                    ->update(['sort_order' => $index + 1]);
            }

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الترتيب بنجاح'
            ]);
        } catch (\Exception $e) {
            Log::error('Award order update error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث الترتيب'
            ], 500);
        }
    }
}
