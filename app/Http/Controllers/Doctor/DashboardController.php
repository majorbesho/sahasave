<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $doctor = Auth::user();

        // الإحصائيات
        $totalPatientsCount = $doctor->doctorAppointments()->distinct('patient_id')->count();
        $todayAppointmentsCount = $doctor->doctorAppointments()
            ->whereDate('appointment_time', Carbon::today())
            ->count();

        // المواعيد القادمة (مثال: أحدث 5 مواعيد قادمة)
        $upcomingAppointments = $doctor->doctorAppointments()
            ->with('patient') // لجلب بيانات المريض مع الموعد بكفاءة
            ->where('appointment_time', '>=', now())
            ->where('status', 'confirmed')
            ->orderBy('appointment_time', 'asc')
            ->limit(5)
            ->get();

        return view('doctor.dashboard', compact(
            'doctor',
            'totalPatientsCount',
            'todayAppointmentsCount',
            'upcomingAppointments'
        ));
    }
}
