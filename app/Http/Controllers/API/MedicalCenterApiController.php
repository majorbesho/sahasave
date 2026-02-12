<?php
// app/Http/Controllers/Api/MedicalCenterApiController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MedicalCenter;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MedicalCenterApiController extends Controller
{
    public function dashboardStats()
    {
        $admin = Auth::user()->medicalCenterAdmins()->first();
        $center = $admin->medicalCenter;

        return response()->json([
            'success' => true,
            'data' => [
                'total_doctors' => $center->doctors()->count(),
                'active_doctors' => $center->doctors()->where('is_active', true)->count(),
                'today_appointments' => $center->appointments()
                    ->whereDate('appointment_date', Carbon::today())
                    ->count(),
                'pending_appointments' => $center->appointments()
                    ->where('status', 'pending')
                    ->count(),
                'monthly_revenue' => $center->transactions()
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->sum('amount'),
                'total_patients' => $center->appointments()
                    ->distinct('patient_id')
                    ->count('patient_id')
            ]
        ]);
    }

    public function appointmentsCalendar(Request $request)
    {
        $admin = Auth::user()->medicalCenterAdmins()->first();

        $appointments = $admin->medicalCenter->appointments()
            ->with(['patient.user', 'doctor.user'])
            ->whereBetween('appointment_date', [
                $request->start ?? Carbon::now()->startOfMonth(),
                $request->end ?? Carbon::now()->endOfMonth()
            ])
            ->get()
            ->map(function ($appointment) {
                return [
                    'id' => $appointment->id,
                    'title' => $appointment->patient->user->name . ' - ' . $appointment->doctor->user->name,
                    'start' => $appointment->appointment_date->format('Y-m-d') . 'T' . $appointment->appointment_time,
                    'end' => $appointment->appointment_date->format('Y-m-d') . 'T' . $appointment->end_time,
                    'color' => $this->getStatusColor($appointment->status),
                    'extendedProps' => [
                        'patient' => $appointment->patient->user->name,
                        'doctor' => $appointment->doctor->user->name,
                        'status' => $appointment->status
                    ]
                ];
            });

        return response()->json($appointments);
    }

    private function getStatusColor($status)
    {
        $colors = [
            'pending' => '#ffc107',
            'confirmed' => '#17a2b8',
            'completed' => '#28a745',
            'cancelled' => '#dc3545',
            'no_show' => '#6c757d'
        ];

        return $colors[$status] ?? '#6c757d';
    }
}
