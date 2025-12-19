<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\MedicalCenter;
use App\Models\DoctorMedicalCenter;
use App\Models\Specialty;
use Illuminate\Support\Facades\Auth;


class MedicalCenterController extends Controller
{
    public function index()
    {
        $doctor = Auth::user();

        // العيادات المرتبطة بالطبيب
        $linkedCenters = $doctor->medicalCenters()
            ->withPivot('employment_type', 'consultation_fee', 'is_active', 'is_approved')
            ->get();

        // العيادات المتاحة للانضمام
        $availableCenters = MedicalCenter::where('is_verified', true)
            ->where('status', 'active')
            ->whereNotIn('id', $linkedCenters->pluck('id'))
            ->get();

        $specialties = Specialty::where('is_active', true)->get();

        return view('doctor.medical-centers.index', compact(
            'linkedCenters',
            'availableCenters',
            'specialties'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medical_center_id' => 'required|exists:medical_centers,id',
            'employment_type' => 'required|in:full_time,part_time,contract,visiting,consultant',
            'consultation_fee' => 'required|numeric|min:0',
            'follow_up_fee' => 'nullable|numeric|min:0',
            'specialty_id' => 'required|exists:specialties,id',
            'working_days' => 'required|array',
            'working_days.*' => 'in:0,1,2,3,4,5,6',
            'appointment_duration' => 'required|integer|in:15,20,30,45,60',
            'max_daily_appointments' => 'required|integer|min:1|max:50'
        ]);

        $doctor = Auth::user();

        // التحقق من عدم وجود ارتباط مسبق
        $existingLink = DoctorMedicalCenter::where('user_id', $doctor->id)
            ->where('medical_center_id', $request->medical_center_id)
            ->first();

        if ($existingLink) {
            return back()->with('error', 'أنت already linked to this medical center.');
        }

        try {
            $doctor->medicalCenters()->attach($request->medical_center_id, [
                'employment_type' => $request->employment_type,
                'consultation_fee' => $request->consultation_fee,
                'follow_up_fee' => $request->follow_up_fee,
                'specialty_id' => $request->specialty_id,
                'working_days' => json_encode($request->working_days),
                'appointment_duration' => $request->appointment_duration,
                'max_daily_appointments' => $request->max_daily_appointments,
                'is_active' => true,
                'is_approved' => false, // يحتاج موافقة من إدارة العيادة
                'status' => 'pending'
            ]);

            return back()->with('success', 'تم إرسال طلب الانضمام للعيادة بنجاح، في انتظار الموافقة.');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء إرسال الطلب: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employment_type' => 'required|in:full_time,part_time,contract,visiting,consultant',
            'consultation_fee' => 'required|numeric|min:0',
            'follow_up_fee' => 'nullable|numeric|min:0',
            'working_days' => 'required|array',
            'working_days.*' => 'in:0,1,2,3,4,5,6',
            'appointment_duration' => 'required|integer|in:15,20,30,45,60',
            'max_daily_appointments' => 'required|integer|min:1|max:50'
        ]);

        $link = DoctorMedicalCenter::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $link->update([
            'employment_type' => $request->employment_type,
            'consultation_fee' => $request->consultation_fee,
            'follow_up_fee' => $request->follow_up_fee,
            'working_days' => json_encode($request->working_days),
            'appointment_duration' => $request->appointment_duration,
            'max_daily_appointments' => $request->max_daily_appointments
        ]);

        return back()->with('success', 'تم تحديث معلومات العمل في العيادة بنجاح.');
    }

    public function destroy($id)
    {
        $link = DoctorMedicalCenter::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $link->delete();

        return back()->with('success', 'تم إنهاء العمل في العيادة بنجاح.');
    }

    public function toggleStatus($id)
    {
        $link = DoctorMedicalCenter::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $link->update([
            'is_active' => !$link->is_active
        ]);

        $status = $link->is_active ? 'مفعل' : 'معطل';
        return back()->with('success', "تم $status العمل في العيادة بنجاح.");
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
