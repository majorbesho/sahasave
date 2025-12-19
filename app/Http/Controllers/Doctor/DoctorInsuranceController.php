<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\DoctorInsurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DoctorInsuranceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:doctor');
    }

    /**
     * عرض صفحة إدارة التأمينات
     */
    public function index()
    {
        $doctor = Auth::user();
        $insurances = $doctor->insurances()->ordered()->get();

        return view('doctor.insurance.index', compact('doctor', 'insurances'));
    }

    /**
     * حفظ أو تحديث تأمين
     */
    public function store(Request $request)
    {
        try {
            $doctor = Auth::user();

            $validated = $request->validate([
                'insurance_name' => 'required|string|max:255',
                'insurance_company' => 'nullable|string|max:255',
                'policy_number' => 'nullable|string|max:100',
                'coverage_start_date' => 'nullable|date',
                'coverage_end_date' => 'nullable|date|after_or_equal:coverage_start_date',
                'is_active' => 'boolean',
                'coverage_details' => 'nullable|string|max:2000',
                'terms_and_conditions' => 'nullable|string|max:2000',
                'insurance_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'contact_number' => 'nullable|string|max:20',
                'website_url' => 'nullable|url|max:500',
            ], [
                'insurance_name.required' => 'اسم التأمين مطلوب',
                'coverage_end_date.after_or_equal' => 'تاريخ انتهاء التغطية يجب أن يكون بعد تاريخ البدء أو مساوياً له',
                'website_url.url' => 'يجب أن يكون الرابط صحيحاً',
                'contact_number.max' => 'رقم الهاتف يجب أن لا يتجاوز 20 رقم',
            ]);

            // تحضير البيانات
            $insuranceData = [
                'doctor_id' => $doctor->id,
                'insurance_name' => $validated['insurance_name'],
                'insurance_company' => $validated['insurance_company'] ?? null,
                'policy_number' => $validated['policy_number'] ?? null,
                'coverage_start_date' => $validated['coverage_start_date'] ?? null,
                'coverage_end_date' => $validated['coverage_end_date'] ?? null,
                'is_active' => $request->has('is_active') && $request->is_active == '1',
                'coverage_details' => $validated['coverage_details'] ?? null,
                'terms_and_conditions' => $validated['terms_and_conditions'] ?? null,
                'contact_number' => $validated['contact_number'] ?? null,
                'website_url' => $validated['website_url'] ?? null,
            ];

            // رفع شعار التأمين
            if ($request->hasFile('insurance_logo')) {
                $logoPath = $request->file('insurance_logo')->store(
                    'doctor-insurances/' . $doctor->id,
                    'public'
                );
                $insuranceData['insurance_logo'] = $logoPath;
            }

            // حفظ أو تحديث
            if ($request->has('insurance_id') && !empty($request->insurance_id)) {
                $insurance = DoctorInsurance::where('doctor_id', $doctor->id)
                    ->find($request->insurance_id);

                if ($insurance) {
                    // حذف الصورة القديمة إذا تم رفع صورة جديدة
                    if ($request->hasFile('insurance_logo') && $insurance->insurance_logo) {
                        Storage::disk('public')->delete($insurance->insurance_logo);
                    }

                    $insurance->update($insuranceData);
                    $message = 'تم تحديث التأمين بنجاح';
                } else {
                    DoctorInsurance::create($insuranceData);
                    $message = 'تم إضافة التأمين بنجاح';
                }
            } else {
                DoctorInsurance::create($insuranceData);
                $message = 'تم إضافة التأمين بنجاح';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'redirect' => route('doctor.insurance.index')
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
                'message' => 'يرجى تصحيح الأخطاء في النموذج'
            ], 422);
        } catch (\Exception $e) {
            Log::error('Insurance store error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حفظ التأمين: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * الحصول على بيانات تأمين محدد
     */
    public function show($id)
    {
        try {
            $doctor = Auth::user();
            $insurance = DoctorInsurance::where('doctor_id', $doctor->id)
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'insurance' => $insurance
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'لم يتم العثور على التأمين'
            ], 404);
        }
    }

    /**
     * حذف تأمين
     */
    public function destroy($id)
    {
        try {
            $doctor = Auth::user();
            $insurance = DoctorInsurance::where('doctor_id', $doctor->id)
                ->findOrFail($id);

            // حذف الصورة إذا كانت موجودة
            if ($insurance->insurance_logo) {
                Storage::disk('public')->delete($insurance->insurance_logo);
            }

            $insurance->delete();

            return response()->json([
                'success' => true,
                'message' => 'تم حذف التأمين بنجاح'
            ]);
        } catch (\Exception $e) {
            Log::error('Insurance delete error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حذف التأمين'
            ], 500);
        }
    }

    /**
     * تحديث ترتيب التأمينات
     */
    public function updateOrder(Request $request)
    {
        try {
            $doctor = Auth::user();
            $order = $request->input('order', []);

            foreach ($order as $index => $id) {
                DoctorInsurance::where('doctor_id', $doctor->id)
                    ->where('id', $id)
                    ->update(['sort_order' => $index + 1]);
            }

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الترتيب بنجاح'
            ]);
        } catch (\Exception $e) {
            Log::error('Insurance order update error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث الترتيب'
            ], 500);
        }
    }

    /**
     * تبديل حالة التأمين
     */
    public function toggleStatus($id)
    {
        try {
            $doctor = Auth::user();
            $insurance = DoctorInsurance::where('doctor_id', $doctor->id)
                ->findOrFail($id);

            $insurance->update([
                'is_active' => !$insurance->is_active
            ]);

            return response()->json([
                'success' => true,
                'message' => $insurance->is_active ? 'تم تفعيل التأمين' : 'تم تعطيل التأمين',
                'is_active' => $insurance->is_active
            ]);
        } catch (\Exception $e) {
            Log::error('Insurance toggle status error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تغيير حالة التأمين'
            ], 500);
        }
    }
}
