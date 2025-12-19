<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $doctor = Auth::user();

        // الحصول على معايير التصفية
        $filters = [
            'status' => $request->get('status', 'active'),
            'search' => $request->get('search'),
            'date_range' => $request->get('date_range'),
            'appointment_type' => $request->get('appointment_type'),
            'visit_type' => $request->get('visit_type')
        ];

        // استعلام للحصول على المرضى
        $patientsQuery = User::whereHas('patientAppointments', function ($query) use ($doctor) {
            $query->where('doctor_id', $doctor->id);
        })->with(['patientAppointments' => function ($query) use ($doctor) {
            $query->where('doctor_id', $doctor->id)
                ->orderBy('scheduled_for', 'desc');
        }]);

        // تطبيق الفلاتر
        if ($filters['search']) {
            $patientsQuery->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('email', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('phone', 'like', '%' . $filters['search'] . '%');
            });
        }

        // تصفية حسب النشاط بناءً على آخر موعد
        if ($filters['status'] === 'active') {
            $patientsQuery->whereHas('patientAppointments', function ($query) {
                $query->where('scheduled_for', '>=', now()->subMonths(6))
                    ->whereIn('status', ['completed', 'confirmed']);
            });
        } else {
            $patientsQuery->whereDoesntHave('patientAppointments', function ($query) {
                $query->where('scheduled_for', '>=', now()->subMonths(6))
                    ->whereIn('status', ['completed', 'confirmed']);
            });
        }

        $patients = $patientsQuery->paginate(12);

        return view('doctor.patients.index', compact('patients', 'filters'));
    }

    /**
     * Display doctor patients index (for the provided HTML design)
     */
    // في PatientController - تحديث دالة doctor_patients_index
    public function doctor_patients_index(Request $request)
    {
        $doctor = Auth::user();

        $filters = [
            'tab' => $request->get('tab', 'active'),
            'search' => $request->get('search'),
            'name_search' => $request->get('name_search'),
            'date_range' => $request->get('date_range'),
            'appointment_type' => $request->get('appointment_type', []),
            'visit_type' => $request->get('visit_type', [])
        ];

        // الحصول على إحصائيات المرضى
        $activePatientsCount = $this->getPatientsCount($doctor->id, 'active');
        $inactivePatientsCount = $this->getPatientsCount($doctor->id, 'inactive');

        // استعلام المرضى
        $patientsQuery = User::whereHas('patientAppointments', function ($query) use ($doctor, $filters) {
            $query->where('doctor_id', $doctor->id);

            // تطبيق فلاتر المواعيد
            if (!empty($filters['appointment_type']) && !in_array('all', $filters['appointment_type'])) {
                $query->whereIn('type', $filters['appointment_type']);
            }

            if (!empty($filters['visit_type']) && !in_array('all', $filters['visit_type'])) {
                $query->whereIn('service_type', $filters['visit_type']);
            }

            if ($filters['date_range']) {
                $dates = explode(' - ', $filters['date_range']);
                if (count($dates) === 2) {
                    $query->whereBetween('scheduled_for', [trim($dates[0]), trim($dates[1])]);
                }
            }
        })->with(['patientAppointments' => function ($query) use ($doctor) {
            $query->where('doctor_id', $doctor->id)
                ->orderBy('scheduled_for', 'desc')
                ->limit(5);
        }, 'medicalProfile']);

        // البحث بالاسم
        if ($filters['name_search']) {
            $patientsQuery->where('name', 'like', '%' . $filters['name_search'] . '%');
        }

        // البحث العام
        if ($filters['search']) {
            $patientsQuery->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('email', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('phone', 'like', '%' . $filters['search'] . '%');
            });
        }

        // تصفية حسب النشاط
        if ($filters['tab'] === 'active') {
            $patientsQuery->whereHas('patientAppointments', function ($query) {
                $query->where('scheduled_for', '>=', now()->subMonths(3))
                    ->whereIn('status', ['completed', 'confirmed']);
            });
        } else {
            $patientsQuery->whereDoesntHave('patientAppointments', function ($query) {
                $query->where('scheduled_for', '>=', now()->subMonths(3))
                    ->whereIn('status', ['completed', 'confirmed']);
            });
        }

        $patients = $patientsQuery->paginate(9);

        // إذا كان الطلب AJAX لتبديل التبويبات
        if ($request->ajax()) {
            return view('doctor.partials.patients-grid', compact('patients', 'filters'))->render();
        }

        return view('doctor.my-patients', compact(
            'patients',
            'filters',
            'activePatientsCount',
            'inactivePatientsCount'
        ));
    }

    /**
     * Get patient profile
     */
    public function show($id)
    {
        $doctor = Auth::user();

        $patient = User::whereHas('patientAppointments', function ($query) use ($doctor) {
            $query->where('doctor_id', $doctor->id);
        })->with([
            'medicalProfile',
            'patientAppointments' => function ($query) use ($doctor) {
                $query->where('doctor_id', $doctor->id)
                    ->orderBy('scheduled_for', 'desc');
            },
            'medicalRecords' => function ($query) use ($doctor) {
                $query->where('doctor_id', $doctor->id);
            }
        ])->findOrFail($id);

        return view('doctor.patients.show', compact('patient'));
    }

    /**
     * Get patient medical records
     */
    public function medicalRecords($patientId)
    {
        $doctor = Auth::user();

        $patient = User::whereHas('patientAppointments', function ($query) use ($doctor) {
            $query->where('doctor_id', $doctor->id);
        })->findOrFail($patientId);

        $medicalRecords = $patient->medicalRecords()
            ->where('doctor_id', $doctor->id)
            ->with('appointment')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('doctor.patients.medical-records', compact('patient', 'medicalRecords'));
    }

    /**
     * Get patient appointments
     */
    public function appointments($patientId, Request $request)
    {
        $doctor = Auth::user();

        $patient = User::whereHas('patientAppointments', function ($query) use ($doctor) {
            $query->where('doctor_id', $doctor->id);
        })->findOrFail($patientId);

        $appointments = Appointment::where('patient_id', $patientId)
            ->where('doctor_id', $doctor->id)
            ->with('medicalCenter')
            ->orderBy('scheduled_for', 'desc')
            ->paginate(10);

        return view('doctor.patients.appointments', compact('patient', 'appointments'));
    }

    /**
     * Helper method to get patients count by status
     */
    private function getPatientsCount($doctorId, $status)
    {
        $query = User::whereHas('patientAppointments', function ($query) use ($doctorId) {
            $query->where('doctor_id', $doctorId);
        });

        if ($status === 'active') {
            $query->whereHas('patientAppointments', function ($query) {
                $query->where('scheduled_for', '>=', now()->subMonths(3))
                    ->whereIn('status', ['completed', 'confirmed']);
            });
        } else {
            $query->whereDoesntHave('patientAppointments', function ($query) {
                $query->where('scheduled_for', '>=', now()->subMonths(3))
                    ->whereIn('status', ['completed', 'confirmed']);
            });
        }

        return $query->count();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // لحفظ مريض جديد (إذا كان مطلوباً)
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
