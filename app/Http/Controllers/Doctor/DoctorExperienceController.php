<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;

use App\Models\DoctorExperience;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DoctorExperienceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:doctor');
    }

    /**
     * عرض صفحة إدارة الخبرات
     */
    public function index()
    {
        $doctor = Auth::user();
        $experiences = $doctor->experiences()->ordered()->get();

        return view('doctor.profile.experience', compact('doctor', 'experiences'));
    }

    /**
     * حفظ أو تحديث خبرة
     */
    /**
     * حفظ أو تحديث خبرة
     */
    public function store(Request $request)
    {
        try {
            $doctor = Auth::user();

            Log::info('Experience store request:', $request->all());

            $validated = $request->validate([
                'hospital_name' => 'required|string|max:255',
                'title' => 'nullable|string|max:255',
                'location' => 'required|string|max:255',
                'employment_type' => 'required|in:Full Time,Part Time',
                'description' => 'required|string|max:2000',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'is_current' => 'boolean',
                'years_of_experience' => 'nullable|integer|min:0|max:60',
                'hospital_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], [
                'hospital_name.required' => 'اسم المستشفى مطلوب',
                'location.required' => 'الموقع مطلوب',
                'description.required' => 'وصف الوظيفة مطلوب',
                'start_date.required' => 'تاريخ البدء مطلوب',
                'end_date.after_or_equal' => 'تاريخ الانتهاء يجب أن يكون بعد تاريخ البدء أو مساوياً له',
            ]);

            // تحضير البيانات
            $experienceData = [
                'doctor_id' => $doctor->id,
                'hospital_name' => $validated['hospital_name'],
                'title' => $validated['title'],
                'location' => $validated['location'],
                'employment_type' => $validated['employment_type'],
                'description' => $validated['description'],
                'start_date' => $validated['start_date'],
                'is_current' => $request->has('is_current') && $request->is_current == '1',
            ];

            // إذا كانت الوظيفة حالية، لا نحتاج تاريخ الانتهاء
            if ($experienceData['is_current']) {
                $experienceData['end_date'] = null;
            } else {
                $experienceData['end_date'] = $validated['end_date'] ?? null;
            }

            // حساب سنوات الخبرة تلقائياً إذا لم يتم تزويدها
            if (empty($validated['years_of_experience'])) {
                $endDate = $experienceData['is_current'] ? now() : $experienceData['end_date'];
                $experienceData['years_of_experience'] = DoctorExperience::calculateYears(
                    $experienceData['start_date'],
                    $endDate
                );
            } else {
                $experienceData['years_of_experience'] = $validated['years_of_experience'];
            }

            // رفع صورة المستشفى
            if ($request->hasFile('hospital_logo')) {
                $logoPath = $request->file('hospital_logo')->store(
                    'doctor-experiences/' . $doctor->id,
                    'public'
                );
                $experienceData['hospital_logo'] = $logoPath;
            }

            // حفظ أو تحديث
            if ($request->has('experience_id') && !empty($request->experience_id)) {
                $experience = DoctorExperience::where('doctor_id', $doctor->id)
                    ->find($request->experience_id);

                if ($experience) {
                    // حذف الصورة القديمة إذا تم رفع صورة جديدة
                    if ($request->hasFile('hospital_logo') && $experience->hospital_logo) {
                        Storage::disk('public')->delete($experience->hospital_logo);
                    }

                    $experience->update($experienceData);
                    $message = 'تم تحديث الخبرة بنجاح';
                } else {
                    // إذا لم يتم العثور على الخبرة، أنشئ خبرة جديدة
                    DoctorExperience::create($experienceData);
                    $message = 'تم إضافة الخبرة بنجاح';
                }
            } else {
                DoctorExperience::create($experienceData);
                $message = 'تم إضافة الخبرة بنجاح';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'redirect' => route('doctor.experience.index')
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
                'message' => 'يرجى تصحيح الأخطاء في النموذج'
            ], 422);
        } catch (\Exception $e) {
            Log::error('Experience store error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حفظ الخبرة: ' . $e->getMessage()
            ], 500);
        }
    }
    /**
     * الحصول على بيانات خبرة محددة
     */
    public function show($id)
    {
        try {
            $doctor = Auth::user();
            $experience = DoctorExperience::where('doctor_id', $doctor->id)
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'experience' => $experience
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'لم يتم العثور على الخبرة'
            ], 404);
        }
    }

    /**
     * حذف خبرة
     */
    public function destroy($id)
    {
        try {
            $doctor = Auth::user();
            $experience = DoctorExperience::where('doctor_id', $doctor->id)
                ->findOrFail($id);

            // حذف الصورة إذا كانت موجودة
            if ($experience->hospital_logo) {
                Storage::disk('public')->delete($experience->hospital_logo);
            }

            $experience->delete();

            return response()->json([
                'success' => true,
                'message' => 'تم حذف الخبرة بنجاح'
            ]);
        } catch (\Exception $e) {
            Log::error('Experience delete error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حذف الخبرة'
            ], 500);
        }
    }

    /**
     * تحديث ترتيب الخبرات
     */
    public function updateOrder(Request $request)
    {
        try {
            $doctor = Auth::user();
            $order = $request->input('order', []);

            foreach ($order as $index => $id) {
                DoctorExperience::where('doctor_id', $doctor->id)
                    ->where('id', $id)
                    ->update(['sort_order' => $index + 1]);
            }

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الترتيب بنجاح'
            ]);
        } catch (\Exception $e) {
            Log::error('Experience order update error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث الترتيب'
            ], 500);
        }
    }

    /**
     * تحديث خبرة محددة
     */
    public function update(Request $request, $id)
    {
        try {
            $doctor = Auth::user();

            $validated = $request->validate([
                'hospital_name' => 'required|string|max:255',
                'title' => 'nullable|string|max:255',
                'location' => 'required|string|max:255',
                'employment_type' => 'required|in:Full Time,Part Time',
                'description' => 'required|string|max:2000',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'is_current' => 'boolean',
                'years_of_experience' => 'nullable|integer|min:0|max:60',
                'hospital_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $experience = DoctorExperience::where('doctor_id', $doctor->id)
                ->findOrFail($id);

            // تحضير البيانات
            $experienceData = $validated;
            $experienceData['is_current'] = $request->has('is_current') && $request->is_current == '1';

            // حساب سنوات الخبرة تلقائياً إذا لم يتم تزويدها
            if (empty($validated['years_of_experience'])) {
                $endDate = $experienceData['is_current'] ? now() : $experienceData['end_date'];
                $experienceData['years_of_experience'] = DoctorExperience::calculateYears(
                    $experienceData['start_date'],
                    $endDate
                );
            }

            // رفع صورة المستشفى
            if ($request->hasFile('hospital_logo')) {
                // حذف الصورة القديمة إذا كانت موجودة
                if ($experience->hospital_logo) {
                    Storage::disk('public')->delete($experience->hospital_logo);
                }

                $logoPath = $request->file('hospital_logo')->store(
                    'doctor-experiences/' . $doctor->id,
                    'public'
                );
                $experienceData['hospital_logo'] = $logoPath;
            }

            $experience->update($experienceData);

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الخبرة بنجاح',
                'redirect' => route('doctor.experience.index')
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
                'message' => 'يرجى تصحيح الأخطاء في النموذج'
            ], 422);
        } catch (\Exception $e) {
            Log::error('Experience update error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تحديث الخبرة: ' . $e->getMessage()
            ], 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DoctorExperience  $doctorExperience
     * @return \Illuminate\Http\Response
     */
}
