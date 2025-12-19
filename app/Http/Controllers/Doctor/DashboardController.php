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

        // تحقق مما إذا كان المستخدم طبيباً
        if (!$doctor->isDoctor()) {
            abort(403, 'غير مصرح بالوصول لهذه الصفحة');
        }

        // الإحصائيات
        $totalPatientsCount = $doctor->doctorAppointments()->distinct('patient_id')->count();
        $todayAppointmentsCount = $doctor->doctorAppointments()
            ->whereDate('scheduled_for', Carbon::today())
            ->count();

        // المواعيد القادمة
        $upcomingAppointments = $doctor->doctorAppointments()
            ->with('patient')
            ->where('scheduled_for', '>=', now())
            ->where('status', 'confirmed')
            ->orderBy('scheduled_for', 'asc')
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
