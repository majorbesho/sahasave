<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\MedicalCenter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ClinicDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, MedicalCenter $clinic)
    {
        // التحقق: هل المستخدم مرتبط بهذا المركز؟
        if (!Auth::user()->userRoles()->where('medical_center_id', $clinic->id)->exists() && !Auth::user()->isAdmin()) {
            abort(403, 'You are not authorized to access this clinic.');
        }

        // تحديد الصلاحيات
        $canViewFinancials = Auth::user()->hasPermissionInCenter('view_financial_reports', $clinic->id);
        $canManageStaff = Auth::user()->hasPermissionInCenter('manage_staff', $clinic->id);

        // نطاق المواعيد الأساسية للمركز (استخدام medical_center_id المطابق لقاعدة البيانات)
        $appointmentsQuery = Appointment::where('medical_center_id', $clinic->id);

        // --- الإحصائيات المشتركة ---
        $todayStart = Carbon::today();
        $todayEnd = Carbon::tomorrow();

        $upcomingAppointmentsCount = (clone $appointmentsQuery)
            ->whereBetween('scheduled_for', [$todayStart, $todayEnd])
            ->whereIn('status', ['scheduled', 'confirmed'])
            ->count();

        $newPatientsThisWeek = User::patients()
            ->whereHas('patientAppointments', function ($q) use ($clinic) {
                $q->where('medical_center_id', $clinic->id)
                    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()]);
            })
            ->distinct('id')
            ->count();

        // --- الإحصائيات المالية (فقط لمن يملك الصلاحية) ---
        $todayRevenue = 0;
        $weeklyRevenue = 0;
        $totalAppointments = 0;

        if ($canViewFinancials) {
            $todayRevenue = (clone $appointmentsQuery)
                ->whereBetween('scheduled_for', [$todayStart, $todayEnd])
                ->whereIn('status', ['completed', 'confirmed']) // تم استخدام confirmed/completed حسب سير العمل
                ->sum('final_fee'); // استخدام final_fee أو amount حسب المتاح

            $weeklyRevenue = (clone $appointmentsQuery)
                ->whereBetween('scheduled_for', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->whereIn('status', ['completed', 'confirmed'])
                ->sum('final_fee');

            $totalAppointments = $appointmentsQuery->count();
        }

        // --- تنبيهات ذكية ---
        $alerts = [];

        // تنبيه: مواعيد اليوم بدون تأكيد
        $unconfirmedToday = (clone $appointmentsQuery)
            ->whereBetween('scheduled_for', [$todayStart, $todayEnd])
            ->where('status', 'scheduled')
            ->count();

        if ($unconfirmedToday > 0) {
            $alerts[] = [
                'type' => 'warning',
                'message' => "{$unconfirmedToday} appointment(s) today are not confirmed yet."
            ];
        }

        // تنبيه: أطباء لم يُحدّثوا جدولهم (خلال 7 أيام)
        if ($canManageStaff) {
            $inactiveDoctors = $clinic->doctors()
                ->whereDoesntHave('schedules', function ($q) {
                    $q->where('updated_at', '>=', now()->subDays(7));
                })
                ->count();

            if ($inactiveDoctors > 0) {
                $alerts[] = [
                    'type' => 'info',
                    'message' => "{$inactiveDoctors} doctor(s) haven’t updated their schedule in the last 7 days."
                ];
            }
        }

        // --- بيانات للرسم البياني (آخر 7 أيام) ---
        $chartData = [];
        if ($canViewFinancials) {
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $revenue = (clone $appointmentsQuery)
                    ->whereDate('scheduled_for', $date)
                    ->whereIn('status', ['completed', 'confirmed'])
                    ->sum('final_fee');

                $chartData[] = [
                    'date' => $date->format('M j'),
                    'revenue' => $revenue,
                    'appointments' => (clone $appointmentsQuery)
                        ->whereDate('scheduled_for', $date)
                        ->whereIn('status', ['completed', 'confirmed'])
                        ->count()
                ];
            }
        }

        // استرجاع مواعيد اليوم للعرض
        $todayAppointments = (clone $appointmentsQuery)
            ->whereDate('scheduled_for', Carbon::today())
            ->with(['patient', 'doctor'])
            ->get();

        return view('clinic.dashboard', compact(
            'clinic',
            'upcomingAppointmentsCount',
            'newPatientsThisWeek',
            'todayRevenue',
            'weeklyRevenue',
            'totalAppointments',
            'alerts',
            'chartData',
            'canViewFinancials',
            'canManageStaff',
            'todayAppointments'
        ));
    }

    private function checkAccess(MedicalCenter $clinic)
    {
        if (!Auth::user()->userRoles()->where('medical_center_id', $clinic->id)->exists() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access to this clinic.');
        }
    }

    public function appointments(MedicalCenter $clinic)
    {
        $this->checkAccess($clinic);
        return view('clinic.appointments.index', compact('clinic'));
    }

    public function patients(MedicalCenter $clinic)
    {
        $this->checkAccess($clinic);
        return view('clinic.patients.index', compact('clinic'));
    }

    public function doctors(MedicalCenter $clinic)
    {
        $this->checkAccess($clinic);
        if (!Auth::user()->hasPermissionInCenter('manage_staff', $clinic->id)) {
            abort(403);
        }
        return view('clinic.doctors.index', compact('clinic'));
    }

    public function staff(MedicalCenter $clinic)
    {
        $this->checkAccess($clinic);
        if (!Auth::user()->hasPermissionInCenter('manage_staff', $clinic->id)) {
            abort(403);
        }
        return view('clinic.staff.index', compact('clinic'));
    }

    public function services(MedicalCenter $clinic)
    {
        $this->checkAccess($clinic);
        if (!Auth::user()->hasPermissionInCenter('manage_clinic_settings', $clinic->id)) {
            abort(403);
        }
        return view('clinic.services.index', compact('clinic'));
    }

    public function reportsOverview(MedicalCenter $clinic)
    {
        $this->checkAccess($clinic);
        if (!Auth::user()->hasPermissionInCenter('view_financial_reports', $clinic->id)) {
            abort(403);
        }
        return view('clinic.reports.overview', compact('clinic'));
    }

    public function notifications(MedicalCenter $clinic)
    {
        $this->checkAccess($clinic);
        return view('clinic.notifications.index', compact('clinic'));
    }

    public function settingsGeneral(MedicalCenter $clinic)
    {
        $this->checkAccess($clinic);
        if (!Auth::user()->hasPermissionInCenter('manage_clinic_settings', $clinic->id)) {
            abort(403);
        }
        return view('clinic.settings.general', compact('clinic'));
    }
}
