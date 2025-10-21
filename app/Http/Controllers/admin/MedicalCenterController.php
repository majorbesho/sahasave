<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicalCenter;
use App\Models\User;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class MedicalCenterController extends Controller
{
    /**
     * عرض قائمة جميع المراكز الطبية
     */
    public function index(Request $request)
    {
        // استعلام بديل بدون withCount حتى يتم حل مشكلة الجدول
        $query = MedicalCenter::latest();

        // البحث
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            });
        }

        // التصفية حسب النوع
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        // التصفية حسب الحالة
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // التصفية حسب التحقق
        if ($request->has('is_verified') && $request->is_verified != '') {
            $query->where('is_verified', $request->is_verified);
        }

        $medicalCenters = $query->paginate(20);

        return view('backend.medical-centers.index', compact('medicalCenters'));
    }

    /**
     * عرض نموذج إنشاء مركز طبي جديد
     */



    /**
     * عرض نموذج إنشاء مركز طبي جديد
     */
    public function create()
    {
        $specialties = Specialty::active()->get();
        return view('backend.medical-centers.create', compact('specialties'));
    }

    /**
     * حفظ مركز طبي جديد
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:clinic,medical_center,hospital,lab',
            'email' => 'nullable|email|unique:medical_center,email',
            'phone' => 'required|string|max:20',
            'website' => 'nullable|url',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:2',
            'postal_code' => 'nullable|string|max:20',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'description' => 'nullable|string',
            'services' => 'nullable|array',
            'facilities' => 'nullable|array',
            'insurance_providers' => 'nullable|array',
            'specialties' => 'nullable|array',
            'working_hours' => 'nullable|array',
            'is_verified' => 'boolean',
            'is_featured' => 'boolean',
            'status' => 'required|in:active,inactive,pending',
        ]);

        // إنشاء slug تلقائي
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $counter = 1;

        while (MedicalCenter::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $medicalCenter = MedicalCenter::create([
            'name' => $request->name,
            'slug' => $slug,
            'type' => $request->type,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'description' => $request->description,
            'services' => $request->services,
            'facilities' => $request->facilities,
            'insurance_providers' => $request->insurance_providers,
            'specialties' => $request->specialties,
            'working_hours' => $request->working_hours,
            'is_verified' => $request->is_verified ?? false,
            'is_featured' => $request->is_featured ?? false,
            'status' => $request->status,
        ]);

        return redirect()->route('medical-centers.show', $medicalCenter->id)
            ->with('success', 'تم إنشاء المركز الطبي بنجاح');
    }

    /**
     * عرض تفاصيل المركز الطبي
     */
    public function show($id)
    {
        // استخدام withCount بدلاً من with للعلاقات التي تسبب مشاكل
        $medicalCenter = MedicalCenter::with([
            'activeDoctors.doctorProfile',
            'ratings'
        ])
            ->withCount([
                'activeDoctors',
                'appointments',
                'ratings'
            ])
            ->findOrFail($id);

        return view('backend.medical-centers.show', compact('medicalCenter'));
    }

    /**
     * عرض نموذج تعديل المركز الطبي
     */
    public function edit($id)
    {
        $medicalCenter = MedicalCenter::findOrFail($id);
        $specialties = Specialty::active()->get();

        return view('backend.medical-centers.edit', compact('medicalCenter', 'specialties'));
    }

    /**
     * تحديث بيانات المركز الطبي
     */
    public function update(Request $request, $id)
    {
        $medicalCenter = MedicalCenter::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:clinic,medical_center,hospital,lab',
            'email' => 'nullable|email|unique:medical_centers,email,' . $id,
            'phone' => 'required|string|max:20',
            'website' => 'nullable|url',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:2',
            'postal_code' => 'nullable|string|max:20',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'description' => 'nullable|string',
            'services' => 'nullable|array',
            'facilities' => 'nullable|array',
            'insurance_providers' => 'nullable|array',
            'specialties' => 'nullable|array',
            'working_hours' => 'nullable|array',
            'is_verified' => 'boolean',
            'is_featured' => 'boolean',
            'status' => 'required|in:active,inactive,pending',
        ]);

        $medicalCenter->update([
            'name' => $request->name,
            'type' => $request->type,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'description' => $request->description,
            'services' => $request->services,
            'facilities' => $request->facilities,
            'insurance_providers' => $request->insurance_providers,
            'specialties' => $request->specialties,
            'working_hours' => $request->working_hours,
            'is_verified' => $request->is_verified ?? $medicalCenter->is_verified,
            'is_featured' => $request->is_featured ?? $medicalCenter->is_featured,
            'status' => $request->status,
        ]);

        return redirect()->route('medical-centers.show', $medicalCenter->id)
            ->with('success', 'تم تحديث بيانات المركز الطبي بنجاح');
    }

    /**
     * حذف المركز الطبي
     */
    public function destroy($id)
    {
        $medicalCenter = MedicalCenter::findOrFail($id);
        $medicalCenter->delete();

        return redirect()->route('admin.medical-centers.index')
            ->with('success', 'تم حذف المركز الطبي بنجاح');
    }

    /**
     * تحديث حالة المركز الطبي
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,pending',
        ]);

        $medicalCenter = MedicalCenter::findOrFail($id);
        $medicalCenter->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'تم تحديث حالة المركز الطبي بنجاح');
    }

    /**
     * التحقق من المركز الطبي
     */
    public function verify($id)
    {
        $medicalCenter = MedicalCenter::findOrFail($id);
        $medicalCenter->update(['is_verified' => true]);

        return redirect()->back()->with('success', 'تم التحقق من المركز الطبي بنجاح');
    }

    /**
     * إلغاء التحقق من المركز الطبي
     */
    public function unverify($id)
    {
        $medicalCenter = MedicalCenter::findOrFail($id);
        $medicalCenter->update(['is_verified' => false]);

        return redirect()->back()->with('success', 'تم إلغاء التحقق من المركز الطبي بنجاح');
    }

    /**
     * تمييز المركز الطبي
     */
    public function feature($id)
    {
        $medicalCenter = MedicalCenter::findOrFail($id);
        $medicalCenter->update(['is_featured' => true]);

        return redirect()->back()->with('success', 'تم تمييز المركز الطبي بنجاح');
    }

    /**
     * إلغاء تمييز المركز الطبي
     */
    public function unfeature($id)
    {
        $medicalCenter = MedicalCenter::findOrFail($id);
        $medicalCenter->update(['is_featured' => false]);

        return redirect()->back()->with('success', 'تم إلغاء تمييز المركز الطبي بنجاح');
    }

    /**
     * إدارة الأطباء في المركز الطبي
     */
// في MedicalCenterController - تحديث دالة manageDoctors
public function manageDoctors($id)
{
    $medicalCenter = MedicalCenter::with(['doctors.doctorProfile'])->findOrFail($id);
    
    // الأطباء المتاحين للإضافة (ليسوا مضافين بالفعل و status = active)
    $availableDoctors = User::where('role', 'doctor')
                          ->where('status', 'active')
                          ->whereDoesntHave('medicalCenters', function($query) use ($id) {
                              $query->where('medical_center_id', $id);
                          })
                          ->with(['doctorProfile'])
                          ->get();

    $specialties = Specialty::active()->get();

    return view('backend.medical-centers.manage-doctors', compact('medicalCenter', 'availableDoctors', 'specialties'));
}

    /**
     * إضافة طبيب إلى المركز الطبي
     */
    public function addDoctor(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'employment_type' => 'required|in:full_time,part_time,contract,visiting',
            'consultation_fee' => 'required|numeric|min:0',
        ]);

        $medicalCenter = MedicalCenter::findOrFail($id);
        $doctor = User::where('role', 'doctor')->findOrFail($request->doctor_id);

        // التحقق من أن الطبيب غير مضاف مسبقاً
        if ($medicalCenter->doctors()->where('user_id', $request->doctor_id)->exists()) {
            return redirect()->back()->with('error', 'الطبيب مضاف بالفعل إلى هذا المركز');
        }

        $medicalCenter->doctors()->attach($request->doctor_id, [
            'employment_type' => $request->employment_type,
            'consultation_fee' => $request->consultation_fee,
            'is_active' => true,
        ]);

        // تحديث عدد الأطباء
        $medicalCenter->updateDoctorCount();

        return redirect()->back()->with('success', 'تم إضافة الطبيب إلى المركز الطبي بنجاح');
    }

    /**
     * إزالة طبيب من المركز الطبي
     */
    public function removeDoctor(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
        ]);

        $medicalCenter = MedicalCenter::findOrFail($id);
        $medicalCenter->doctors()->detach($request->doctor_id);

        // تحديث عدد الأطباء
        $medicalCenter->updateDoctorCount();

        return redirect()->back()->with('success', 'تم إزالة الطبيب من المركز الطبي بنجاح');
    }

    /**
     * تحديث حالة طبيب في المركز الطبي
     */
    public function updateDoctorStatus(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'is_active' => 'required|boolean',
        ]);

        $medicalCenter = MedicalCenter::findOrFail($id);
        $medicalCenter->doctors()->updateExistingPivot($request->doctor_id, [
            'is_active' => $request->is_active,
        ]);

        return redirect()->back()->with('success', 'تم تحديث حالة الطبيب بنجاح');
    }

    /**
     * عرض إحصائيات المراكز الطبية
     */
    public function statistics()
    {
        $stats = [
            'total_centers' => MedicalCenter::count(),
            'clinics' => MedicalCenter::clinics()->count(),
            'hospitals' => MedicalCenter::hospitals()->count(),
            'labs' => MedicalCenter::where('type', 'lab')->count(),
            'verified_centers' => MedicalCenter::verified()->count(),
            'featured_centers' => MedicalCenter::featured()->count(),
            'active_centers' => MedicalCenter::active()->count(),
            'total_doctors_in_centers' => DB::table('doctor_medical_center')->where('is_active', true)->count(),
        ];

        $centersByCity = MedicalCenter::select('city', DB::raw('COUNT(*) as count'))
            ->groupBy('city')
            ->orderBy('count', 'desc')
            ->get();

        $centersByType = MedicalCenter::select('type', DB::raw('COUNT(*) as count'))
            ->groupBy('type')
            ->get();

        return view('backend.medical-centers.statistics', compact('stats', 'centersByCity', 'centersByType'));
    }
}
