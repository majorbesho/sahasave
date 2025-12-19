<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\DoctorProfile;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:doctor');
    }




    public function edit()
    {
        $doctor = Auth::user();
        $doctorProfile = $doctor->doctorProfile ?? new DoctorProfile();

        // تحميل القيم القديمة إذا كانت موجودة (في حالة أخطاء التحقق)
        return view('doctor.profile.edit', [
            'doctor' => $doctor,
            'doctorProfile' => $doctorProfile,
        ]);
    }


    public function update(Request $request)
    {
        try {
            $doctor = Auth::user();

            Log::info('=== Profile Update Started ===');
            Log::info('User ID: ' . $doctor->id);
            Log::info('Request Data:', $request->all());

            // **هنا التحقق الصحيح - الحقول مطلوبة**
            $validatedData = $request->validate([
                'name' => 'nullable|string|max:255|min:2',
                'phone' => 'nullable|string|max:20|min:8',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                'medical_license_number' => 'nullable|string|max:100',
                'specialization' => 'nullable|string|max:255',
                'years_of_experience' => 'nullable|integer|min:0|max:60',
                'medical_school' => 'nullable|string|max:255',
                'graduation_year' => 'nullable|integer|digits:4|min:1950|max:' . date('Y'),
                'current_hospital' => 'nullable|string|max:255',
                'current_position' => 'nullable|string|max:255',
                'bio' => 'nullable|string|max:2000',
                'consultation_fee' => 'nullable|numeric|min:0|max:10000',
                'qualifications' => 'nullable|string',
                'certifications' => 'nullable|string',
                'subspecialties' => 'nullable|string',
                'languages' => 'nullable|string',
                'memberships' => 'nullable|string',
            ], [
                'name.required' => 'حقل الاسم مطلوب',
                'name.min' => 'الاسم يجب أن يكون على الأقل حرفين',
                'phone.required' => 'حقل الهاتف مطلوب',
                'phone.min' => 'رقم الهاتف يجب أن يكون على الأقل 8 أرقام',
                'photo.image' => 'يجب أن تكون الصورة من نوع صورة',
                'photo.max' => 'حجم الصورة يجب أن يكون أقل من 4 ميجابايت',
                'graduation_year.min' => 'سنة التخرج يجب أن تكون بعد 1950',
                'graduation_year.max' => 'سنة التخرج لا يمكن أن تكون في المستقبل',
            ]);

            Log::info('Validation passed');

            // بداية المعاملة
            \DB::beginTransaction();

            try {
                // 1. تحديث بيانات المستخدم

                $name = $validatedData['name'] ?? $doctor->name;
                $phone = $validatedData['phone'] ?? $doctor->phone;

                // Update User information
                $userData = [
                    'name' => $name,
                    'phone' => $phone,
                ];

                // التعامل مع صورة الملف الشخصي
                $this->handleProfilePhoto($request, $doctor, $userData);

                // تحديث المستخدم
                $doctor->update($userData);
                Log::info('User updated successfully');

                // 2. تحديث أو إنشاء الملف الشخصي للطبيب
                $this->updateOrCreateDoctorProfile($doctor, $validatedData, $request);

                // تأكيد المعاملة
                \DB::commit();
                Log::info('=== Profile Update Completed Successfully ===');

                return redirect()->route('doctor.profile.edit')
                    ->with('success', 'تم تحديث الملف الشخصي بنجاح');
            } catch (\Exception $e) {
                // التراجع عن المعاملة في حالة خطأ
                \DB::rollBack();
                throw $e;
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error:', $e->errors());
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'يرجى تصحيح الأخطاء في النموذج');
        } catch (\Exception $e) {
            Log::error('Profile update error: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return redirect()->back()
                ->withInput()
                ->with('error', 'حدث خطأ غير متوقع: ' . $e->getMessage());
        }
    }

    /**
     * Process array fields from comma-separated string to array
     */
    private function processArrayField(Request $request, $fieldName, &$dataArray)
    {
        if ($request->filled($fieldName)) {
            $value = trim($request->$fieldName);
            if (!empty($value)) {
                // تقسيم النص باستخدام الفواصل، وتنظيف كل عنصر
                $items = array_map('trim', explode(',', $value));
                $filteredItems = array_filter($items, function ($item) {
                    return !empty($item);
                });

                if (!empty($filteredItems)) {
                    $dataArray[$fieldName] = $filteredItems;
                }
            }
        }
    }
    private function handleProfilePhoto(Request $request, $doctor, &$userData)
    {
        // إزالة الصورة إذا طلب المستخدم ذلك
        if ($request->has('remove_photo') && $request->remove_photo == '1') {
            if ($doctor->photo && Storage::disk('public')->exists($doctor->photo)) {
                Storage::disk('public')->delete($doctor->photo);
                $userData['photo'] = null;
                Log::info('Photo removed by user request');
            }
        }

        // رفع صورة جديدة
        if ($request->hasFile('photo')) {
            Log::info('Photo file detected');

            // حذف الصورة القديمة إذا كانت موجودة
            if ($doctor->photo && Storage::disk('public')->exists($doctor->photo)) {
                Storage::disk('public')->delete($doctor->photo);
                Log::info('Old photo deleted: ' . $doctor->photo);
            }

            // حفظ الصورة الجديدة
            $fileName = 'doctor_' . $doctor->id . '_' . time() . '.' . $request->file('photo')->extension();
            $path = $request->file('photo')->storeAs('profile-photos', $fileName, 'public');
            $userData['photo'] = $path;

            Log::info('New photo stored at: ' . $path);
        }
    }
    private function updateOrCreateDoctorProfile($doctor, $validatedData, $request)
    {
        $doctorProfileData = [
            'medical_license_number' => $validatedData['medical_license_number'] ?? null,
            'specialization' => $validatedData['specialization'] ?? null,
            'years_of_experience' => $validatedData['years_of_experience'] ?? null,
            'medical_school' => $validatedData['medical_school'] ?? null,
            'graduation_year' => $validatedData['graduation_year'] ?? null,
            'current_hospital' => $validatedData['current_hospital'] ?? null,
            'current_position' => $validatedData['current_position'] ?? null,
            'bio' => $validatedData['bio'] ?? null,
            'consultation_fee' => $validatedData['consultation_fee'] ?? null,
        ];

        // معالجة الحقول المصفوفة
        $this->processArrayField($request, 'qualifications', $doctorProfileData);
        $this->processArrayField($request, 'certifications', $doctorProfileData);
        $this->processArrayField($request, 'subspecialties', $doctorProfileData);
        $this->processArrayField($request, 'languages', $doctorProfileData);
        $this->processArrayField($request, 'memberships', $doctorProfileData);

        Log::info('DoctorProfile data prepared:', $doctorProfileData);

        // تحديث أو إنشاء الملف الشخصي
        if ($doctor->doctorProfile) {
            $doctor->doctorProfile->update($doctorProfileData);
            Log::info('DoctorProfile updated');
        } else {
            $doctorProfileData['doctor_id'] = $doctor->id;
            DoctorProfile::create($doctorProfileData);
            Log::info('DoctorProfile created');
        }
    }
}
