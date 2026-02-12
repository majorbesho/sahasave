<?php

namespace App\Http\Controllers;

use App\Models\MedicalCenter;
use App\Models\UserRole;
use App\Models\Role;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClinicRegistrationController extends Controller
{
    public function create()
    {
        // فقط المستخدمين المسجلين يمكنهم فتح النموذج
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // منع التسجيل المتكرر إذا كان المستخدم مديراً لمركز موجود بالفعل
        // ملاحظة: قمت بتعديل العلاقة لتناسب الهيكل الحالي (UserRole)
        $existingAdmin = UserRole::where('user_id', Auth::id())
            ->whereHas('role', function ($q) {
                $q->where('name', 'clinic_manager');
            })->first();

        if ($existingAdmin) {
            return redirect()->route('clinic.dashboard', $existingAdmin->medical_center_id);
        }

        $specialties = Specialty::active()->orderBy('name_en')->get();

        return view('clinic.register', compact('specialties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'name_ar' => 'nullable|string|max:150',
            'phone' => 'required|string|unique:medical_centers,phone',
            'email' => 'nullable|email|unique:medical_centers,email',
            'address' => 'required|string',
            'address_ar' => 'nullable|string',
            'city' => 'required|string',
            'city_ar' => 'nullable|string',
            'license_number' => 'nullable|string|max:100',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'specialties' => 'nullable|array',
            'working_hours' => 'nullable|array',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
        ]);

        $data = $request->except('logo');
        $data['slug'] = Str::slug($request->name) . '-' . rand(1000, 9999);
        $data['type'] = 'clinic';
        $data['status'] = 'pending'; // المراكز الجديدة تكون معلقة حتى التحقق

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('clinics/logos', 'public');
        }

        $center = MedicalCenter::create(array_merge($data, [
            'created_by' => Auth::id(),
            'country' => 'Qatar', // قيمة افتراضية أو حسب الحاجة
        ]));

        // ربط المستخدم كـ "مدير عيادة" تلقائيًا
        $managerRole = Role::where('name', 'clinic_manager')->first();
        if ($managerRole) {
            UserRole::create([
                'user_id' => Auth::id(),
                'role_id' => $managerRole->id,
                'medical_center_id' => $center->id,
            ]);
        }

        return redirect()->route('clinic.dashboard', $center->id)
            ->with('success', 'Your clinic has been registered successfully! Verification may take 1-2 business days.');
    }
}
