<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\DoctorClinic;
use App\Models\ClinicGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DoctorClinicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:doctor');
    }

    /**
     * عرض صفحة إدارة العيادات
     */
    public function index()
    {
        $doctor = Auth::user();
        $clinics = $doctor->clinics()->with('gallery')->ordered()->get();

        return view('doctor.clinics.index', compact('doctor', 'clinics'));
    }

    /**
     * حفظ أو تحديث عيادة
     */
    public function store(Request $request)
    {
        try {
            $doctor = Auth::user();

            $validated = $request->validate([
                'clinic_name' => 'required|string|max:255',
                'location' => 'nullable|string|max:255',
                'address' => 'required|string|max:500',
                'city' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:100',
                'country' => 'nullable|string|max:100',
                'postal_code' => 'nullable|string|max:20',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'website' => 'nullable|url|max:500',
                'description' => 'nullable|string|max:2000',
                'services' => 'nullable|string|max:1000',
                'amenities' => 'nullable|string|max:1000',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'is_primary' => 'boolean',
                'is_active' => 'boolean',
                'clinic_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'gallery_images' => 'nullable|array',
                'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'clinic_name.required' => 'اسم العيادة مطلوب',
                'address.required' => 'العنوان مطلوب',
                'email.email' => 'يجب أن يكون البريد الإلكتروني صحيحاً',
                'website.url' => 'يجب أن يكون الرابط صحيحاً',
                'latitude.numeric' => 'يجب أن يكون خط العرض رقماً',
                'longitude.numeric' => 'يجب أن يكون خط الطول رقماً',
            ]);

            // تحضير البيانات
            $clinicData = [
                'doctor_id' => $doctor->id,
                'clinic_name' => $validated['clinic_name'],
                'location' => $validated['location'] ?? null,
                'address' => $validated['address'],
                'city' => $validated['city'] ?? null,
                'state' => $validated['state'] ?? null,
                'country' => $validated['country'] ?? null,
                'postal_code' => $validated['postal_code'] ?? null,
                'phone' => $validated['phone'] ?? null,
                'email' => $validated['email'] ?? null,
                'website' => $validated['website'] ?? null,
                'description' => $validated['description'] ?? null,
                'services' => $validated['services'] ?? null,
                'amenities' => $validated['amenities'] ?? null,
                'latitude' => $validated['latitude'] ?? null,
                'longitude' => $validated['longitude'] ?? null,
                'is_primary' => $request->has('is_primary') && $request->is_primary == '1',
                'is_active' => $request->has('is_active') && $request->is_active == '1',
            ];

            // إذا تم تحديدها كعيادة رئيسية، نلغي العيادات الأخرى
            if ($clinicData['is_primary']) {
                DoctorClinic::where('doctor_id', $doctor->id)
                    ->where('is_primary', true)
                    ->update(['is_primary' => false]);
            }

            // رفع شعار العيادة
            if ($request->hasFile('clinic_logo')) {
                $logoPath = $request->file('clinic_logo')->store(
                    'doctor-clinics/' . $doctor->id . '/logo',
                    'public'
                );
                $clinicData['clinic_logo'] = $logoPath;
            }

            // حفظ أو تحديث
            if ($request->has('clinic_id') && !empty($request->clinic_id)) {
                $clinic = DoctorClinic::where('doctor_id', $doctor->id)
                    ->find($request->clinic_id);

                if ($clinic) {
                    // حذف الصورة القديمة إذا تم رفع صورة جديدة
                    if ($request->hasFile('clinic_logo') && $clinic->clinic_logo) {
                        Storage::disk('public')->delete($clinic->clinic_logo);
                    }

                    $clinic->update($clinicData);
                    $clinicId = $clinic->id;
                    $message = 'تم تحديث العيادة بنجاح';
                } else {
                    $newClinic = DoctorClinic::create($clinicData);
                    $clinicId = $newClinic->id;
                    $message = 'تم إضافة العيادة بنجاح';
                }
            } else {
                $newClinic = DoctorClinic::create($clinicData);
                $clinicId = $newClinic->id;
                $message = 'تم إضافة العيادة بنجاح';
            }

            // رفع صور المعرض
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $image) {
                    $imagePath = $image->store(
                        'doctor-clinics/' . $doctor->id . '/gallery',
                        'public'
                    );

                    ClinicGallery::create([
                        'clinic_id' => $clinicId,
                        'image_path' => $imagePath,
                        'image_type' => 'gallery',
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'redirect' => route('doctor.clinics.index')
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
                'message' => 'يرجى تصحيح الأخطاء في النموذج'
            ], 422);
        } catch (\Exception $e) {
            Log::error('Clinic store error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حفظ العيادة: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * الحصول على بيانات عيادة محددة
     */
    public function show($id)
    {
        try {
            $doctor = Auth::user();
            $clinic = DoctorClinic::with('gallery')
                ->where('doctor_id', $doctor->id)
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'clinic' => $clinic,
                'gallery' => $clinic->gallery
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'لم يتم العثور على العيادة'
            ], 404);
        }
    }

    /**
     * حذف عيادة
     */
    public function destroy($id)
    {
        try {
            $doctor = Auth::user();
            $clinic = DoctorClinic::with('gallery')
                ->where('doctor_id', $doctor->id)
                ->findOrFail($id);

            // حذف الشعار إذا كان موجوداً
            if ($clinic->clinic_logo) {
                Storage::disk('public')->delete($clinic->clinic_logo);
            }

            // حذف صور المعرض
            foreach ($clinic->gallery as $image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }

            $clinic->delete();

            return response()->json([
                'success' => true,
                'message' => 'تم حذف العيادة بنجاح'
            ]);
        } catch (\Exception $e) {
            Log::error('Clinic delete error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حذف العيادة'
            ], 500);
        }
    }

    /**
     * حذف صورة من المعرض
     */
    public function deleteGalleryImage($id)
    {
        try {
            $doctor = Auth::user();
            $image = ClinicGallery::whereHas('clinic', function ($query) use ($doctor) {
                $query->where('doctor_id', $doctor->id);
            })
                ->findOrFail($id);

            // حذف الصورة من التخزين
            Storage::disk('public')->delete($image->image_path);
            $image->delete();

            return response()->json([
                'success' => true,
                'message' => 'تم حذف الصورة بنجاح'
            ]);
        } catch (\Exception $e) {
            Log::error('Gallery image delete error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حذف الصورة'
            ], 500);
        }
    }

    /**
     * تحديث ترتيب العيادات
     */
    public function updateOrder(Request $request)
    {
        try {
            $doctor = Auth::user();
            $order = $request->input('order', []);

            foreach ($order as $index => $id) {
                DoctorClinic::where('doctor_id', $doctor->id)
                    ->where('id', $id)
                    ->update(['sort_order' => $index + 1]);
            }

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الترتيب بنجاح'
            ]);
        } catch (\Exception $e) {
            Log::error('Clinic order update error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث الترتيب'
            ], 500);
        }
    }
}
