<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    //



    public function index()
    {
        $doctors = User::where('role', 'doctor')
            ->where('status', 'active')
            ->with('doctorProfile')
            ->paginate(12);

        return view('doctors.index', compact('doctors'));
    }

    public function search(Request $request)
    {
        $query = User::where('role', 'doctor')
            ->where('status', 'active')
            ->with('doctorProfile', 'medicalCenters');

        // البحث حسب التخصص
        if ($request->has('specialization') && $request->specialization) {
            $query->whereHas('doctorProfile', function ($q) use ($request) {
                $q->where('specialization', 'like', '%' . $request->specialization . '%');
            });
        }

        // البحث حسب الاسم
        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // البحث حسب المدينة
        if ($request->has('city') && $request->city) {
            $query->whereHas('medicalCenters', function ($q) use ($request) {
                $q->where('city', $request->city);
            });
        }

        $doctors = $query->paginate(12);
        $specializations = $this->getSpecializations();
        $cities = $this->getCities();

        return view('doctors.search', compact('doctors', 'specializations', 'cities'));
    }

    public function show($id)
    {
        $doctor = User::where('role', 'doctor')
            ->where('status', 'active')
            ->with(['doctorProfile', 'medicalCenters', 'schedules'])
            ->findOrFail($id);

        return view('doctors.show', compact('doctor'));
    }

    public function book($id)
    {
        $doctor = User::where('role', 'doctor')
            ->where('status', 'active')
            ->with([
                'doctorProfile',
                'medicalCenters',
                'activeSchedules.medicalCenter' // تحميل الجداول المرتبطة
            ])
            ->findOrFail($id);

        // تجميع الجداول حسب المركز الطبي
        $schedulesByCenter = [];
        foreach ($doctor->activeSchedules as $schedule) {
            $centerId = $schedule->medical_center_id;
            if (!isset($schedulesByCenter[$centerId])) {
                $schedulesByCenter[$centerId] = [
                    'medical_center' => $schedule->medicalCenter,
                    'schedules' => []
                ];
            }
            $schedulesByCenter[$centerId]['schedules'][] = $schedule;
        }

        return view('frontend.doctor.book', compact('doctor', 'schedulesByCenter'));
    }

    private function getSpecializations()
    {
        // يمكنك استبدال هذا ببيانات حقيقية من قاعدة البيانات
        return [
            'Cardiology' => 'Cardiology',
            'Dermatology' => 'Dermatology',
            'Neurology' => 'Neurology',
            'Pediatrics' => 'Pediatrics',
            'Orthopedics' => 'Orthopedics',
            'Dentistry' => 'Dentistry',
            'General Practice' => 'General Practice',
        ];
    }

    private function getCities()
    {
        // يمكنك استبدال هذا ببيانات حقيقية من قاعدة البيانات
        return [
            'Dubai' => 'Dubai',
            'AbuDaib' => 'AbuDaib',
            'Mecca' => 'Mecca',
            'Medina' => 'Medina',
            'Dammam' => 'Dammam',
            'Khobar' => 'Khobar',
        ];
    }
}
