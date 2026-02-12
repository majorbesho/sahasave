<?php

namespace App\Http\Controllers;

use App\Models\MedicalCenter;
use App\Models\Specialty;
use App\Models\DoctorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorMedicalCenterController extends Controller
{
    /**
     * Display a listing of the doctor's medical centers.
     */
    public function index()
    {
        $doctor = Auth::user();

        // الحصول على المراكز الطبية للطبيب مع معلومات إضافية
        $medicalCenters = $doctor->medicalCenters()
            ->orderBy('pivot_created_at', 'desc')
            ->paginate(10);

        // الحصول على التخصصات للطبيب
        $specialties = Specialty::where('is_active', true)->get();

        // الحصول على جميع المراكز الطبية المتاحة للربط
        $availableMedicalCenters = MedicalCenter::where('status', 'active')
            ->whereNotIn('id', function ($query) use ($doctor) {
                $query->select('medical_center_id')
                    ->from('doctor_medical_center')
                    ->where('user_id', $doctor->id);
            })
            ->take(20)
            ->get();

        // إحصائيات
        $stats = [
            'total_centers' => $doctor->medicalCenters()->count(),
            'active_centers' => $doctor->medicalCenters()->wherePivot('is_active', true)->count(),
            'pending_approval' => $doctor->medicalCenters()->wherePivot('is_approved', false)->count(),
        ];

        return view('doctor.medicalcenter.index', compact(
            'medicalCenters',
            'availableMedicalCenters',
            'specialties',
            'stats'
        ));
    }

    /**
     * Show the form for linking to a new medical center.
     */
    public function create()
    {
        $doctor = Auth::user();

        // الحصول على المراكز الطبية المتاحة للربط
        $medicalCenters = MedicalCenter::where('status', 'active')
            ->whereNotIn('id', function ($query) use ($doctor) {
                $query->select('medical_center_id')
                    ->from('doctor_medical_center')
                    ->where('user_id', $doctor->id);
            })
            ->get();

        // الحصول على التخصصات
        $specialties = Specialty::where('is_active', true)->get();

        // الحصول على بروفايل الطبيب
        $doctorProfile = $doctor->doctorProfile;

        return view('doctor.medicalcenter.create', compact(
            'medicalCenters',
            'specialties',
            'doctorProfile'
        ));
    }

    /**
     * Store a newly created medical center link.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'medical_center_id' => 'required|exists:medical_centers,id',
            'employment_type' => 'required|in:full_time,part_time,contract,visiting,consultant',
            'working_days' => 'nullable|array',
            'working_days.*' => 'string|in:sunday,monday,tuesday,wednesday,thursday,friday,saturday',
            'working_hours' => 'nullable|array',
            'working_hours.start' => 'nullable|date_format:H:i',
            'working_hours.end' => 'nullable|date_format:H:i',
            'consultation_fee' => 'required|numeric|min:0',
            'follow_up_fee' => 'nullable|numeric|min:0',
            'specialty_id' => 'nullable|exists:specialties,id',
            'appointment_duration' => 'required|integer|min:10|max:120',
            'max_daily_appointments' => 'required|integer|min:1|max:100',
            'accepts_insurance' => 'boolean',
            'accepted_insurances' => 'nullable|array',
            'notes' => 'nullable|string|max:1000',
        ]);

        $doctor = Auth::user();

        // التحقق من أن الطبيب ليس مرتبطاً بالفعل بهذا المركز
        $exists = $doctor->medicalCenters()
            ->where('medical_center_id', $validated['medical_center_id'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'You are already linked to this medical center.');
        }

        // إعداد بيانات العمل
        $workingData = [];
        if (isset($validated['working_days'])) {
            $workingData['days'] = $validated['working_days'];
        }
        if (isset($validated['working_hours']['start']) && isset($validated['working_hours']['end'])) {
            $workingData['hours'] = [
                'start' => $validated['working_hours']['start'],
                'end' => $validated['working_hours']['end'],
            ];
        }

        // إعداد بيانات التأمين
        $insuranceData = null;
        if (isset($validated['accepts_insurance']) && $validated['accepts_insurance'] && isset($validated['accepted_insurances'])) {
            $insuranceData = $validated['accepted_insurances'];
        }

        try {
            DB::beginTransaction();

            // ربط الطبيب بالمركز الطبي
            $doctor->medicalCenters()->attach($validated['medical_center_id'], [
                'employment_type' => $validated['employment_type'],
                'working_days' => !empty($workingData['days']) ? json_encode($workingData['days']) : null,
                'working_hours' => !empty($workingData['hours']) ? json_encode($workingData['hours']) : null,
                'consultation_fee' => $validated['consultation_fee'],
                'follow_up_fee' => $validated['follow_up_fee'] ?? null,
                'specialty_id' => $validated['specialty_id'] ?? null,
                'appointment_duration' => $validated['appointment_duration'],
                'max_daily_appointments' => $validated['max_daily_appointments'],
                'accepts_insurance' => $validated['accepts_insurance'] ?? false,
                'accepted_insurances' => $insuranceData ? json_encode($insuranceData) : null,
                'notes' => $validated['notes'] ?? null,
                'is_active' => false, // غير نشط حتى يتم الموافقة
                'status' => 'pending',
                'is_approved' => false,
            ]);

            DB::commit();

            return redirect()->route('doctor.medical-centers.index')
                ->with('success', 'Medical center linked successfully. Waiting for approval.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to link medical center: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified medical center link.
     */
    public function show($id)
    {
        $doctor = Auth::user();

        $medicalCenter = $doctor->medicalCenters()
            ->where('medical_center_id', $id)
            ->firstOrFail();

        // إحصائيات
        $stats = [
            'total_appointments' => $medicalCenter->pivot->appointments_count ?? 0,
            'average_rating' => $medicalCenter->pivot->average_rating ?? 0,
            'last_appointment' => $this->getLastAppointment($doctor->id, $id),
        ];

        return view('doctor.medicalcenter.show', compact('medicalCenter', 'stats'));
    }

    /**
     * Show the form for editing a medical center link.
     */
    public function edit($id)
    {
        $doctor = Auth::user();

        $medicalCenter = $doctor->medicalCenters()
            ->where('medical_center_id', $id)
            ->firstOrFail();

        // يمكن التعديل فقط إذا كان غير معتمد أو معلق
        if ($medicalCenter->pivot->is_approved && $medicalCenter->pivot->status === 'active') {
            return redirect()->route('doctor.medical-centers.show', $id)
                ->with('info', 'Cannot edit approved and active medical center. Contact administrator for changes.');
        }

        $specialties = Specialty::where('is_active', true)->get();

        // فك ترميز البيانات المخزنة
        $workingDays = $medicalCenter->pivot->working_days ?
            json_decode($medicalCenter->pivot->working_days, true) : [];

        $workingHours = $medicalCenter->pivot->working_hours ?
            json_decode($medicalCenter->pivot->working_hours, true) : [];

        $acceptedInsurances = $medicalCenter->pivot->accepted_insurances ?
            json_decode($medicalCenter->pivot->accepted_insurances, true) : [];

        return view('doctor.medicalcenter.edit', compact(
            'medicalCenter',
            'specialties',
            'workingDays',
            'workingHours',
            'acceptedInsurances'
        ));
    }

    /**
     * Update the specified medical center link.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'employment_type' => 'required|in:full_time,part_time,contract,visiting,consultant',
            'working_days' => 'nullable|array',
            'working_days.*' => 'string|in:sunday,monday,tuesday,wednesday,thursday,friday,saturday',
            'working_hours' => 'nullable|array',
            'working_hours.start' => 'nullable|date_format:H:i',
            'working_hours.end' => 'nullable|date_format:H:i',
            'consultation_fee' => 'required|numeric|min:0',
            'follow_up_fee' => 'nullable|numeric|min:0',
            'specialty_id' => 'nullable|exists:specialties,id',
            'appointment_duration' => 'required|integer|min:10|max:120',
            'max_daily_appointments' => 'required|integer|min:1|max:100',
            'accepts_insurance' => 'boolean',
            'accepted_insurances' => 'nullable|array',
            'notes' => 'nullable|string|max:1000',
        ]);

        $doctor = Auth::user();

        // التحقق من وجود الرابط
        $medicalCenter = $doctor->medicalCenters()
            ->where('medical_center_id', $id)
            ->firstOrFail();

        // يمكن التعديل فقط إذا كان غير معتمد أو معلق
        if ($medicalCenter->pivot->is_approved && $medicalCenter->pivot->status === 'active') {
            return back()->with('error', 'Cannot edit approved and active medical center.');
        }

        try {
            DB::beginTransaction();

            // تحديث البيانات
            $doctor->medicalCenters()->updateExistingPivot($id, [
                'employment_type' => $validated['employment_type'],
                'working_days' => isset($validated['working_days']) ? json_encode($validated['working_days']) : null,
                'working_hours' => isset($validated['working_hours']) ? json_encode($validated['working_hours']) : null,
                'consultation_fee' => $validated['consultation_fee'],
                'follow_up_fee' => $validated['follow_up_fee'] ?? null,
                'specialty_id' => $validated['specialty_id'] ?? null,
                'appointment_duration' => $validated['appointment_duration'],
                'max_daily_appointments' => $validated['max_daily_appointments'],
                'accepts_insurance' => $validated['accepts_insurance'] ?? false,
                'accepted_insurances' => isset($validated['accepted_insurances']) ? json_encode($validated['accepted_insurances']) : null,
                'notes' => $validated['notes'] ?? null,
                'status' => 'pending', // العودة للحالة المعلقة بعد التعديل
            ]);

            DB::commit();

            return redirect()->route('doctor.medical-centers.show', $id)
                ->with('success', 'Medical center details updated successfully. Waiting for re-approval.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to update medical center: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified medical center link.
     */
    public function destroy($id)
    {
        $doctor = Auth::user();

        // التحقق من وجود الرابط
        $medicalCenter = $doctor->medicalCenters()
            ->where('medical_center_id', $id)
            ->firstOrFail();

        // يمكن الحذف فقط إذا لم يكن هناك مواعيد مستقبلية
        $hasFutureAppointments = $this->hasFutureAppointments($doctor->id, $id);

        if ($hasFutureAppointments) {
            return back()->with('error', 'Cannot delete medical center with future appointments. Please reschedule appointments first.');
        }

        try {
            $doctor->medicalCenters()->detach($id);

            return redirect()->route('doctor.medical-centers.index')
                ->with('success', 'Medical center link removed successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to remove medical center link: ' . $e->getMessage());
        }
    }

    /**
     * Toggle active status of a medical center link.
     */
    public function toggleStatus($id)
    {
        $doctor = Auth::user();

        $medicalCenter = $doctor->medicalCenters()
            ->where('medical_center_id', $id)
            ->firstOrFail();

        // التحقق من أن الرابط معتمد
        if (!$medicalCenter->pivot->is_approved) {
            return back()->with('error', 'Cannot activate unapproved medical center.');
        }

        $newStatus = !$medicalCenter->pivot->is_active;

        $doctor->medicalCenters()->updateExistingPivot($id, [
            'is_active' => $newStatus,
            'status' => $newStatus ? 'active' : 'inactive',
        ]);

        $statusText = $newStatus ? 'activated' : 'deactivated';

        return back()->with('success', "Medical center {$statusText} successfully.");
    }

    /**
     * Search for medical centers to link.
     */
    public function search(Request $request)
    {
        $search = $request->get('search');
        $doctor = Auth::user();

        $medicalCenters = MedicalCenter::where('status', 'active')
            ->whereNotIn('id', function ($query) use ($doctor) {
                $query->select('medical_center_id')
                    ->from('doctor_medical_center')
                    ->where('user_id', $doctor->id);
            })
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('name_ar', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%");
            })
            ->paginate(10);

        return response()->json($medicalCenters);
    }

    /**
     * Get last appointment for a doctor at a medical center.
     */
    private function getLastAppointment($doctorId, $medicalCenterId)
    {
        // يمكنك تعديل هذا بناءً على نموذج المواعيد لديك
        return null;
        /*
        return Appointment::where('doctor_id', $doctorId)
            ->where('medical_center_id', $medicalCenterId)
            ->orderBy('scheduled_for', 'desc')
            ->first();
        */
    }

    /**
     * Check if there are future appointments.
     */
    private function hasFutureAppointments($doctorId, $medicalCenterId)
    {
        // يمكنك تعديل هذا بناءً على نموذج المواعيد لديك
        return false;
        /*
        return Appointment::where('doctor_id', $doctorId)
            ->where('medical_center_id', $medicalCenterId)
            ->where('scheduled_for', '>', now())
            ->whereIn('status', ['scheduled', 'confirmed'])
            ->exists();
        */
    }
}
