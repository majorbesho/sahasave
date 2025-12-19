<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DoctorProfile;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;

class DoctorManagementController extends Controller
{
    /**
     * عرض قائمة جميع الأطباء
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'doctor')
            ->with(['doctorProfile.specialty'])
            ->latest();

        // البحث
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhereHas('doctorProfile', function ($q) use ($search) {
                        $q->where('medical_license_number', 'like', "%{$search}%")
                            ->orWhere('specialization', 'like', "%{$search}%");
                    });
            });
        }

        // التصفية حسب الحالة
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // التصفية حسب حالة التحقق
        if ($request->has('verification_status') && $request->verification_status != '') {
            $query->whereHas('doctorProfile', function ($q) use ($request) {
                $q->where('verification_status', $request->verification_status);
            });
        }

        $doctors = $query->paginate(20);

        return view('backend.doctors.index', compact('doctors'));
    }

    /**
     * عرض تفاصيل الطبيب
     */
    public function show($id)
    {
        $doctor = User::where('role', 'doctor')
            ->with(['doctorProfile.specialty'])
            ->findOrFail($id);

        return view('backend.doctors.show', compact('doctor'));
    }

    /**
     * تحديث حالة الطبيب
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,pending,rejected,suspended',
            'notes' => 'nullable|string|max:1000'
        ]);

        $doctor = User::where('role', 'doctor')->findOrFail($id);

        $oldStatus = $doctor->status;
        $doctor->update(['status' => $request->status]);

        // إذا كان الطبيب معتمداً، تحديث البروفايل أيضاً
        if ($request->status === 'active' && $doctor->doctorProfile) {
            $doctor->doctorProfile->update([
                'is_verified' => true,
                'verification_status' => 'verified',
                'verification_reviewed_at' => now(),
                'verified_by' => auth()->id(),
                'verification_notes' => $request->notes
            ]);
        }

        // إرسال إشعار للمستخدم بتغيير الحالة
        // Notification::send($doctor, new DoctorStatusUpdated($doctor, $oldStatus, $request->status));

        return redirect()->back()->with('success', 'تم تحديث حالة الطبيب بنجاح');
    }

    /**
     * تحديث حالة التحقق في البروفايل
     */
    public function updateVerificationStatus(Request $request, $id)
    {
        $request->validate([
            'verification_status' => 'required|in:pending_review,under_review,verified,rejected,suspended',
            'verification_notes' => 'nullable|string|max:1000'
        ]);

        $doctorProfile = DoctorProfile::where('doctor_id', $id)->firstOrFail();

        $doctorProfile->update([
            'verification_status' => $request->verification_status,
            'verification_notes' => $request->verification_notes,
            'verification_reviewed_at' => now(),
            'verified_by' => auth()->id(),
            'is_verified' => $request->verification_status === 'verified'
        ]);

        // تحديث حالة المستخدم إذا تم الرفض
        if ($request->verification_status === 'rejected') {
            $doctorProfile->doctor->update(['status' => 'rejected']);
        }

        return redirect()->back()->with('success', 'تم تحديث حالة التحقق بنجاح');
    }

    /**
     * اعتماد الطبيب
     */
    public function approve($id)
    {
        $doctor = User::where('role', 'doctor')->findOrFail($id);

        $doctor->update(['status' => 'active']);

        if ($doctor->doctorProfile) {
            $doctor->doctorProfile->update([
                'is_verified' => true,
                'verification_status' => 'verified',
                'verification_reviewed_at' => now(),
                'verified_by' => auth()->id()
            ]);
        }

        // إرسال إشعار للمستخدم
        // Notification::send($doctor, new DoctorApproved($doctor));

        return redirect()->back()->with('success', 'تم اعتماد الطبيب بنجاح');
    }

    /**
     * رفض الطبيب
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000'
        ]);

        $doctor = User::where('role', 'doctor')->findOrFail($id);

        $doctor->update(['status' => 'rejected']);

        if ($doctor->doctorProfile) {
            $doctor->doctorProfile->update([
                'is_verified' => false,
                'verification_status' => 'rejected',
                'verification_reviewed_at' => now(),
                'verified_by' => auth()->id(),
                'verification_notes' => $request->rejection_reason
            ]);
        }

        // إرسال إشعار للمستخدم
        // Notification::send($doctor, new DoctorRejected($doctor, $request->rejection_reason));

        return redirect()->back()->with('success', 'تم رفض الطبيب بنجاح');
    }

    /**
     * تعليق الطبيب
     */
    public function suspend(Request $request, $id)
    {
        $request->validate([
            'suspension_reason' => 'required|string|max:1000'
        ]);

        $doctor = User::where('role', 'doctor')->findOrFail($id);

        $doctor->update(['status' => 'suspended']);

        if ($doctor->doctorProfile) {
            $doctor->doctorProfile->update([
                'is_verified' => false,
                'verification_status' => 'suspended',
                'verification_notes' => $request->suspension_reason
            ]);
        }

        return redirect()->back()->with('success', 'تم تعليق الطبيب بنجاح');
    }

    public function statistics()
    {
        $stats = [
            'total_doctors' => User::where('role', 'doctor')->count(),
            'pending_doctors' => User::where('role', 'doctor')->where('status', 'pending')->count(),
            'active_doctors' => User::where('role', 'doctor')->where('status', 'active')->count(),
            'rejected_doctors' => User::where('role', 'doctor')->where('status', 'rejected')->count(),
            'verified_doctors' => DoctorProfile::where('is_verified', true)->count(),
        ];

        // إحصائيات حسب التخصص
        $specialtyStats = DoctorProfile::select(
            'specialization',
            DB::raw('COUNT(*) as total_count'),
            DB::raw('SUM(CASE WHEN doctor_profiles.is_verified = 1 THEN 1 ELSE 0 END) as active_count'),
            DB::raw('SUM(CASE WHEN users.status = "pending" THEN 1 ELSE 0 END) as pending_count'),
            DB::raw('SUM(CASE WHEN users.status = "rejected" THEN 1 ELSE 0 END) as rejected_count')
        )
            ->join('users', 'doctor_profiles.doctor_id', '=', 'users.id')
            ->groupBy('specialization')
            ->get();

        return view('backend.doctors.statistics', compact('stats', 'specialtyStats'));
    }

    /**
     * تحرير بيانات الطبيب
     */
    public function edit($id)
    {
        $doctor = User::where('role', 'doctor')
            ->with(['doctorProfile'])
            ->findOrFail($id);

        $specialties = Specialty::active()->get();

        return view('backend.doctors.edit', compact('doctor', 'specialties'));
    }

    /**
     * تحديث بيانات الطبيب
     */
    public function update(Request $request, $id)
    {
        $doctor = User::where('role', 'doctor')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|unique:users,phone,' . $id,
            'status' => 'required|in:active,inactive,pending,rejected,suspended',
            'specialty_id' => 'required|exists:specialties,id',
            'medical_license_number' => 'required|string|max:100|unique:doctor_profiles,medical_license_number,' . $doctor->doctorProfile->id,
            'years_of_experience' => 'nullable|integer|min:0',
            'consultation_fee' => 'nullable|numeric|min:0',
            'medical_school' => 'nullable|string|max:255',
            'graduation_year' => 'nullable|integer|min:1950|max:' . date('Y'),
            'bio' => 'nullable|string|max:1000',
            'current_hospital' => 'nullable|string|max:255',
            'current_position' => 'nullable|string|max:255',
        ]);

        // تحديث بيانات المستخدم
        $doctor->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);

        // تحديث البروفايل الطبي
        $specialty = Specialty::find($request->specialty_id);

        $doctor->doctorProfile->update([
            'specialty_id' => $request->specialty_id,
            'specialization' => app()->getLocale() == 'ar' ? $specialty->name_ar : $specialty->name_en,
            'medical_license_number' => $request->medical_license_number,
            'years_of_experience' => $request->years_of_experience,
            'consultation_fee' => $request->consultation_fee,
            'medical_school' => $request->medical_school,
            'graduation_year' => $request->graduation_year,
            'bio' => $request->bio,
            'current_hospital' => $request->current_hospital,
            'current_position' => $request->current_position,
        ]);

        return redirect()->route('doctors.show', $doctor->id)
            ->with('success', 'تم تحديث بيانات الطبيب بنجاح');
    }
    /**
     * حذف الطبيب
     */
    public function destroy($id)
    {
        $doctor = User::where('role', 'doctor')->findOrFail($id);

        // حذف الملفات المرفوعة إذا وجدت
        if ($doctor->doctorProfile && $doctor->doctorProfile->license_document_path) {
            Storage::disk('public')->delete($doctor->doctorProfile->license_document_path);
        }

        $doctor->delete();

        return redirect()->route('doctors.index')
            ->with('success', 'تم حذف الطبيب بنجاح');
    }

    /**
     * عرض الإحصائيات
     */


    // في DoctorManagementController
    /**
     * تبديل حالة التميز للطبيب
     */
    public function toggleFeatured($id)
    {
        $doctor = User::where('role', 'doctor')->findOrFail($id);

        if (!$doctor->doctorProfile) {
            return redirect()->back()
                ->with('error', 'لا يوجد بروفايل طبي لهذا الطبيب.');
        }

        $newFeaturedStatus = !$doctor->doctorProfile->is_featured;

        $doctor->doctorProfile->update([
            'is_featured' => $newFeaturedStatus,
            'updated_at' => now()
        ]);

        $status = $newFeaturedStatus ? 'مميز' : 'غير مميز';

        return redirect()->back()
            ->with('success', "تم جعل الطبيب {$status} بنجاح.");
    }
}
