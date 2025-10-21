<?php

namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;
use App\Models\DoctorProfile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Specialty;



class DoctorRegisterController extends Controller
{
    //

    public function create()
    {
        $specialties = Specialty::where('is_active', true)->get();
        return view('auth.doctor-register', compact('specialties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20', 'unique:users'],
            'specialty' => ['required', 'integer', 'exists:specialties,id'],
            'license_number' => ['required', 'string', 'max:100', 'unique:doctor_profiles,medical_license_number'],
            'license_document' => ['required', 'file', 'mimes:pdf,jpg,png', 'max:2048'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['accepted'],
        ]);

        // حفظ ملف الرخصة
        $path = $request->file('license_document')->store('licenses', 'public');

        // إنشاء المستخدم
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'doctor',
            'status' => 'pending',
        ]);

        // الحصول على اسم التخصص
        $specialty = Specialty::find($request->specialty);
        $specialization = app()->getLocale() == 'ar' ? $specialty->name_ar : $specialty->name_en;

        // إنشاء البروفايل الطبي للطبيب
        DoctorProfile::create([
            'doctor_id' => $user->id,
            'medical_license_number' => $request->license_number,
            'specialization' => $specialization,
            'specialty_id' => $request->specialty, // حفظ ID التخصص أيضاً
            'license_document_path' => $path,
            'is_verified' => false,
            'verification_status' => 'pending_review',
        ]);

        // توليد كود الإحالة
        $user->generateReferralCode();

        // إرسال إشعار التأكيد
        event(new Registered($user));

        return redirect()->route('register.doctor.pending')
            ->with('success', __('messages.registration_pending_approval'));
    }
}
