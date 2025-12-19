<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\DoctorEducation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DoctorEducationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:doctor');
    }

    /**
     * عرض صفحة إدارة التعليم
     */
    public function index()
    {
        $doctor = Auth::user();
        $educations = $doctor->educations()->ordered()->get();

        return view('doctor.education.index', compact('doctor', 'educations'));
    }

    /**
     * حفظ أو تحديث تعليم
     */
    public function store(Request $request)
    {
        try {
            $doctor = Auth::user();

            $validated = $request->validate([
                'institution_name' => 'required|string|max:255',
                'course' => 'required|string|max:255',
                'degree' => 'nullable|string|max:255',
                'field_of_study' => 'nullable|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'is_current' => 'boolean',
                'years' => 'nullable|integer|min:1|max:10',
                'description' => 'nullable|string|max:2000',
                'institution_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'grade' => 'nullable|string|max:100',
            ], [
                'institution_name.required' => 'اسم المؤسسة التعليمية مطلوب',
                'course.required' => 'اسم الدورة أو التخصص مطلوب',
                'start_date.required' => 'تاريخ البدء مطلوب',
                'end_date.after_or_equal' => 'تاريخ الانتهاء يجب أن يكون بعد تاريخ البدء أو مساوياً له',
            ]);

            // تحضير البيانات
            $educationData = [
                'doctor_id' => $doctor->id,
                'institution_name' => $validated['institution_name'],
                'course' => $validated['course'],
                'degree' => $validated['degree'] ?? null,
                'field_of_study' => $validated['field_of_study'] ?? null,
                'start_date' => $validated['start_date'],
                'is_current' => $request->has('is_current') && $request->is_current == '1',
                'description' => $validated['description'] ?? null,
                'grade' => $validated['grade'] ?? null,
            ];

            // إذا كانت الدراسة حالية
            if ($educationData['is_current']) {
                $educationData['end_date'] = null;
            } else {
                $educationData['end_date'] = $validated['end_date'] ?? null;
            }

            // حساب عدد السنوات تلقائياً إذا لم يتم تزويدها
            if (empty($validated['years'])) {
                $endDate = $educationData['is_current'] ? now() : $educationData['end_date'];
                if ($endDate) {
                    $educationData['years'] = DoctorEducation::calculateYears(
                        $educationData['start_date'],
                        $endDate
                    );
                } else {
                    $educationData['years'] = 1;
                }
            } else {
                $educationData['years'] = $validated['years'];
            }

            // رفع شعار المؤسسة
            if ($request->hasFile('institution_logo')) {
                $logoPath = $request->file('institution_logo')->store(
                    'doctor-education/' . $doctor->id,
                    'public'
                );
                $educationData['institution_logo'] = $logoPath;
            }

            // حفظ أو تحديث
            if ($request->has('education_id') && !empty($request->education_id)) {
                $education = DoctorEducation::where('doctor_id', $doctor->id)
                    ->find($request->education_id);

                if ($education) {
                    // حذف الصورة القديمة إذا تم رفع صورة جديدة
                    if ($request->hasFile('institution_logo') && $education->institution_logo) {
                        Storage::disk('public')->delete($education->institution_logo);
                    }

                    $education->update($educationData);
                    $message = 'تم تحديث التعليم بنجاح';
                } else {
                    DoctorEducation::create($educationData);
                    $message = 'تم إضافة التعليم بنجاح';
                }
            } else {
                DoctorEducation::create($educationData);
                $message = 'تم إضافة التعليم بنجاح';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'redirect' => route('doctor.education.index')
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
                'message' => 'يرجى تصحيح الأخطاء في النموذج'
            ], 422);
        } catch (\Exception $e) {
            Log::error('Education store error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حفظ التعليم: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * الحصول على بيانات تعليم محددة
     */
    public function show($id)
    {
        try {
            $doctor = Auth::user();
            $education = DoctorEducation::where('doctor_id', $doctor->id)
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'education' => $education
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'لم يتم العثور على التعليم'
            ], 404);
        }
    }

    /**
     * حذف تعليم
     */
    public function destroy($id)
    {
        try {
            $doctor = Auth::user();
            $education = DoctorEducation::where('doctor_id', $doctor->id)
                ->findOrFail($id);

            // حذف الصورة إذا كانت موجودة
            if ($education->institution_logo) {
                Storage::disk('public')->delete($education->institution_logo);
            }

            $education->delete();

            return response()->json([
                'success' => true,
                'message' => 'تم حذف التعليم بنجاح'
            ]);
        } catch (\Exception $e) {
            Log::error('Education delete error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حذف التعليم'
            ], 500);
        }
    }

    /**
     * تحديث ترتيب التعليم
     */
    public function updateOrder(Request $request)
    {
        try {
            $doctor = Auth::user();
            $order = $request->input('order', []);

            foreach ($order as $index => $id) {
                DoctorEducation::where('doctor_id', $doctor->id)
                    ->where('id', $id)
                    ->update(['sort_order' => $index + 1]);
            }

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الترتيب بنجاح'
            ]);
        } catch (\Exception $e) {
            Log::error('Education order update error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث الترتيب'
            ], 500);
        }
    }
}
