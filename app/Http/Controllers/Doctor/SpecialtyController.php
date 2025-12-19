<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DoctorProfile;
use App\Models\DoctorService;

class SpecialtyController extends Controller
{

    public function index()
    {
        $doctor = Auth::user();

        // التحقق من وجود البروفايل وإعادة التوجيه إذا لم يكن موجوداً
        if (!$doctor->doctorProfile) {
            return redirect()->route('doctor.profile.create')
                ->with('warning', 'يجب إكمال الملف الشخصي أولاً قبل إدارة التخصصات');
        }

        $doctorProfile = $doctor->doctorProfile;

        // الحصول على تخصصات الطبيب مع خدماتها
        $specialties = $doctorProfile->specialties()->with(['doctorServices' => function ($query) use ($doctor) {
            $query->where('doctor_id', $doctor->id);
        }])->get();

        // جميع التخصصات المتاحة للإضافة
        $availableSpecialties = Specialty::active()
            ->whereNotIn('id', $specialties->pluck('id'))
            ->ordered()
            ->get();

        return view('doctor.specialties.index', compact(
            'specialties',
            'availableSpecialties',
            'doctorProfile'
        ));
    }

    /**
     * إضافة تخصص جديد للطبيب
     */
    public function addSpecialty(Request $request)
    {
        $request->validate([
            'specialty_id' => 'required|exists:specialties,id',
        ]);

        $doctor = Auth::user();
        $doctorProfile = $doctor->doctorProfile;

        try {
            DB::transaction(function () use ($doctorProfile, $request) {
                // ربط التخصص بالطبيب
                $doctorProfile->specialties()->attach($request->specialty_id);

                // إنشاء خدمة افتراضية للتخصص
                DoctorService::create([
                    'doctor_id' => $doctorProfile->doctor_id,
                    'specialty_id' => $request->specialty_id,
                    'name_ar' => 'فحص عام',
                    'name_en' => 'General Checkup',
                    'description_ar' => 'فحص طبي عام',
                    'description_en' => 'General medical examination',
                    'price' => 100,
                    'duration' => 30,
                    'is_active' => true,
                ]);
            });

            return response()->json([
                'success' => true,
                'message' => 'تم إضافة التخصص بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء إضافة التخصص'
            ], 500);
        }
    }

    /**
     * إضافة خدمة جديدة
     */
    public function addService(Request $request)
    {
        $request->validate([
            'specialty_id' => 'required|exists:specialties,id',
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:5',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        $doctor = Auth::user();
        $doctorProfile = $doctor->doctorProfile;

        // التأكد من أن التخصص مرتبط بالطبيب
        if (!$doctorProfile->specialties()->where('specialty_id', $request->specialty_id)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'التخصص غير مرتبط بطبيبك'
            ], 422);
        }

        try {
            $service = DoctorService::create([
                'doctor_id' => $doctorProfile->doctor_id,
                'specialty_id' => $request->specialty_id,
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'description_ar' => $request->description_ar,
                'description_en' => $request->description_en,
                'price' => $request->price,
                'duration' => $request->duration,
                'is_active' => true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'تم إضافة الخدمة بنجاح',
                'service' => $service
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء إضافة الخدمة'
            ], 500);
        }
    }

    /**
     * تحديث خدمة
     */
    public function updateService(Request $request, $serviceId)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:5',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        $doctor = Auth::user();
        $service = DoctorService::where('id', $serviceId)
            ->where('doctor_id', $doctor->id)
            ->firstOrFail();

        try {
            $service->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الخدمة بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث الخدمة'
            ], 500);
        }
    }

    /**
     * حذف تخصص من الطبيب
     */
    public function removeSpecialty($specialtyId)
    {
        $doctor = Auth::user();
        $doctorProfile = $doctor->doctorProfile;

        try {
            DB::transaction(function () use ($doctorProfile, $specialtyId) {
                // حذف خدمات التخصص أولاً
                DoctorService::where('doctor_id', $doctorProfile->doctor_id)
                    ->where('specialty_id', $specialtyId)
                    ->delete();

                // فصل التخصص عن الطبيب
                $doctorProfile->specialties()->detach($specialtyId);
            });

            return response()->json([
                'success' => true,
                'message' => 'تم حذف التخصص بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حذف التخصص'
            ], 500);
        }
    }

    /**
     * حذف خدمة
     */
    public function deleteService($serviceId)
    {
        $doctor = Auth::user();
        $service = DoctorService::where('id', $serviceId)
            ->where('doctor_id', $doctor->id)
            ->firstOrFail();

        try {
            $service->delete();

            return response()->json([
                'success' => true,
                'message' => 'تم حذف الخدمة بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حذف الخدمة'
            ], 500);
        }
    }

    /**
     * حفظ جميع التغييرات
     */
    public function saveAll(Request $request)
    {
        $request->validate([
            'services' => 'required|array',
            'services.*.id' => 'required|exists:doctor_services,id',
            'services.*.price' => 'required|numeric|min:0',
            'services.*.duration' => 'required|integer|min:5',
            'services.*.name_ar' => 'required|string|max:255',
            'services.*.name_en' => 'required|string|max:255',
        ]);

        $doctor = Auth::user();

        try {
            DB::transaction(function () use ($request, $doctor) {
                foreach ($request->services as $serviceData) {
                    DoctorService::where('id', $serviceData['id'])
                        ->where('doctor_id', $doctor->id)
                        ->update([
                            'name_ar' => $serviceData['name_ar'],
                            'name_en' => $serviceData['name_en'],
                            'price' => $serviceData['price'],
                            'duration' => $serviceData['duration'],
                            'description_ar' => $serviceData['description_ar'] ?? null,
                            'description_en' => $serviceData['description_en'] ?? null,
                        ]);
                }
            });

            return response()->json([
                'success' => true,
                'message' => 'تم حفظ جميع التغييرات بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حفظ التغييرات'
            ], 500);
        }
    }
}
