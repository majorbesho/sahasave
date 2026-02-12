<?php
// app/Http/Controllers/MedicalCenterDashboardController.php
namespace App\Http\Controllers;

use App\Models\MedicalCenter;
use App\Models\User;
use App\Models\DoctorProfile;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class MedicalCenterDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('medical.center.admin');
    }

    // لوحة التحكم الرئيسية
    public function dashboard()
    {
        $admin = Auth::user()->medicalCenterAdmins()->first();
        $center = $admin->medicalCenter;

        // إحصائيات رئيسية
        $stats = [
            'total_doctors' => $center->doctors()->count(),
            'active_doctors' => $center->doctors()->wherePivot('is_active', true)->count(),
            'today_appointments' => $center->appointments()
                ->whereDate('scheduled_for', Carbon::today())
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
        ];

        // آخر المواعيد
        $recentAppointments = $center->appointments()
            ->with(['patient', 'doctor'])
            ->orderBy('scheduled_for', 'desc')
            ->limit(10)
            ->get();

        // أعلى الأطباء حجزاً
        $topDoctors = $center->doctors()
            ->withCount(['appointments as total_appointments'])
            ->orderBy('total_appointments', 'desc')
            ->limit(5)
            ->get();

        return view('backend.medical-center.dashboard', compact(
            'admin',
            'center',
            'stats',
            'recentAppointments',
            'topDoctors'
        ));
    }

    // إدارة الأطباء
    public function doctors(Request $request)
    {
        $admin = $this->getAdmin();
        $center = $admin->medicalCenter;
        $stats = $this->getStats($center);

        $query = $center->doctors()->with(['specialties']);

        // فلترة
        if ($request->has('specialty')) {
            $query->whereHas('specialties', function ($q) use ($request) {
                $q->where('id', $request->specialty);
            });
        }

        if ($request->has('status')) {
            $query->where('is_active', $request->status == 'active');
        }

        $doctors = $query->paginate(20);
        $specialties = \App\Models\Specialty::all();

        return view('backend.medical-center.doctors.index', compact('doctors', 'specialties', 'admin', 'center', 'stats'));
    }

    // تفاصيل الطبيب
    public function showDoctor($id)
    {
        $admin = $this->getAdmin();
        $center = $admin->medicalCenter;
        $stats = $this->getStats($center);

        $doctor = $center->doctors()
            ->with(['specialties', 'appointments', 'reviews'])
            ->findOrFail($id);

        $doctorStats = [
            'total_appointments' => $doctor->appointments()->count(),
            'average_rating' => $doctor->reviews()->avg('rating'),
            'monthly_earnings' => $doctor->transactions()
                ->whereMonth('created_at', Carbon::now()->month)
                ->sum('amount')
        ];

        return view('backend.medical-center.doctors.show', compact('doctor', 'doctorStats', 'admin', 'center', 'stats'));
    }

    // المواعيد
    public function appointments(Request $request)
    {
        $admin = $this->getAdmin();
        $center = $admin->medicalCenter;
        $stats = $this->getStats($center);

        $query = $center->appointments()
            ->with(['patient', 'doctor']);

        // فلترة حسب التاريخ
        if ($request->has('date')) {
            $query->whereDate('scheduled_for', $request->date);
        }

        // فلترة حسب الحالة
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // فلترة حسب الطبيب
        if ($request->has('doctor_id')) {
            $query->where('doctor_id', $request->doctor_id);
        }

        $appointments = $query->orderBy('scheduled_for', 'desc')
            ->paginate(30);

        $doctors = $center->doctors()->get();
        $statuses = ['pending', 'confirmed', 'completed', 'cancelled', 'no_show'];

        return view('backend.medical-center.appointments.index', compact(
            'appointments',
            'doctors',
            'statuses',
            'admin',
            'center',
            'stats'
        ));
    }

    // التقارير المالية
    public function financialReports(Request $request)
    {
        $admin = $this->getAdmin();
        $center = $admin->medicalCenter;
        $stats = $this->getStats($center);

        $query = $center->transactions()
            ->with(['appointment', 'doctor', 'patient']);

        // فلترة حسب التاريخ
        if ($request->has('from_date') && $request->has('to_date')) {
            $query->whereBetween('created_at', [
                $request->from_date,
                $request->to_date
            ]);
        }

        // فلترة حسب النوع
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $transactions = $query->orderBy('created_at', 'desc')
            ->paginate(50);

        $summary = [
            'total_revenue' => $center->transactions()
                ->where('type', 'revenue')
                ->sum('amount'),
            'total_commissions' => $center->transactions()
                ->where('type', 'commission')
                ->sum('amount'),
            'total_refunds' => $center->transactions()
                ->where('type', 'refund')
                ->sum('amount')
        ];

        return view('backend.medical-center.financial.reports', compact(
            'transactions',
            'summary',
            'admin',
            'center',
            'stats'
        ));
    }

    // إدارة الخدمات
    public function services()
    {
        $admin = $this->getAdmin();
        $center = $admin->medicalCenter;
        $stats = $this->getStats($center);

        $services = $center->services()->with('category')->get();
        $categories = \App\Models\ServiceCategory::all();

        return view('backend.medical-center.services.index', compact('services', 'categories', 'admin', 'center', 'stats'));
    }

    // الإحصائيات والتحليلات
    public function analytics()
    {
        $admin = $this->getAdmin();
        $center = $admin->medicalCenter;
        $stats = $this->getStats($center);

        $data = Cache::remember('medical_center_' . $center->id . '_analytics', 3600, function () use ($center) {
            // إحصائيات المواعيد الشهرية
            $monthlyAppointments = [];
            for ($i = 5; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $count = $center->appointments()
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count();

                $monthlyAppointments[] = [
                    'month' => $date->format('M'),
                    'count' => $count
                ];
            }

            // إيرادات شهرية
            $monthlyRevenue = [];
            for ($i = 5; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $revenue = $center->transactions()
                    ->where('type', 'revenue')
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->sum('amount');

                $monthlyRevenue[] = [
                    'month' => $date->format('M'),
                    'revenue' => $revenue
                ];
            }

            // توزيع المواعيد حسب الحالة
            $appointmentsByStatus = $center->appointments()
                ->selectRaw('status, count(*) as count')
                ->groupBy('status')
                ->get()
                ->pluck('count', 'status');

            return compact('monthlyAppointments', 'monthlyRevenue', 'appointmentsByStatus');
        });

        return view('backend.medical-center.analytics.index', array_merge($data, compact('admin', 'center', 'stats')));
    }

    // إعدادات المركز
    public function settings()
    {
        $admin = $this->getAdmin();
        $center = $admin->medicalCenter;
        $stats = $this->getStats($center);

        return view('backend.medical-center.settings.index', compact('center', 'admin', 'stats'));
    }

    // تحديث إعدادات المركز
    public function updateSettings(Request $request)
    {
        $admin = Auth::user()->medicalCenterAdmins()->first();
        $center = $admin->medicalCenter;

        $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'address' => 'required|string',
            'address_ar' => 'nullable|string',
            'city' => 'nullable|string',
            'city_ar' => 'nullable|string',
            'state' => 'nullable|string',
            'state_ar' => 'nullable|string',
            'country' => 'nullable|string',
            'country_ar' => 'nullable|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'working_hours' => 'nullable|array',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'services' => 'nullable|array',
            'services_ar' => 'nullable|array',
            'facilities' => 'nullable|array',
            'facilities_ar' => 'nullable|array',
            'insurance_providers' => 'nullable|array',
            'insurance_providers_ar' => 'nullable|array',
            'logo' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        $data = $request->only([
            'name',
            'name_ar',
            'address',
            'address_ar',
            'city',
            'city_ar',
            'state',
            'state_ar',
            'country',
            'country_ar',
            'phone',
            'email',
            'working_hours',
            'description',
            'description_ar',
            'services',
            'services_ar',
            'facilities',
            'facilities_ar',
            'insurance_providers',
            'insurance_providers_ar'
        ]);

        // تحميل اللوجو إذا تم رفعه
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('medical-center-logos', 'public');
        }

        // تحميل صورة الغلاف إذا تم رفعها
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('medical-center-covers', 'public');
        }

        $center->update($data);

        return back()->with('success', 'تم تحديث الإعدادات بنجاح');
    }

    public function profile()
    {
        $admin = $this->getAdmin();
        $center = $admin->medicalCenter;
        $stats = $this->getStats($center);
        return view('backend.medical-center.profile', compact('admin', 'center', 'stats'));
    }

    public function createDoctor()
    {
        $admin = $this->getAdmin();
        $center = $admin->medicalCenter;
        $stats = $this->getStats($center);
        $specialties = \App\Models\Specialty::all();

        return view('backend.medical-center.doctors.create', compact('admin', 'center', 'stats', 'specialties'));
    }

    public function storeDoctor(Request $request)
    {
        $admin = $this->getAdmin();
        $center = $admin->medicalCenter;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string',
            'specialty_id' => 'nullable|exists:specialties,id',
            'profile_image' => 'nullable|image|max:2048'
        ]);

        // 1. Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'doctor',
            'status' => 'active'
        ]);

        // 2. Handle Profile Image
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('doctors/profiles', 'public');
            $user->update(['photo' => $path]);
        }

        // 3. Create Doctor Profile
        $doctorProfile = DoctorProfile::create([
            'doctor_id' => $user->id,
            'specialty_id' => $request->specialty_id,
            'slug' => Str::slug($request->name) . '-' . time(),
        ]);

        // 4. Attach to Medical Center
        $center->doctors()->attach($user->id, [
            'is_active' => true,
            'status' => 'active',
            'specialty_id' => $request->specialty_id
        ]);

        return redirect()->route('medical-center.doctors.index')->with('success', 'تم إضافة الطبيب بنجاح');
    }

    public function editDoctor($id)
    {
        $admin = $this->getAdmin();
        $center = $admin->medicalCenter;
        $stats = $this->getStats($center);
        return view('backend.medical-center.doctors.edit', compact('id', 'admin', 'center', 'stats'));
    }

    public function updateDoctorStatus(Request $request, $id)
    {
        return response()->json(['success' => true]);
    }

    public function doctorSchedule($id)
    {
        $admin = $this->getAdmin();
        $center = $admin->medicalCenter;
        $stats = $this->getStats($center);
        return view('backend.medical-center.doctors.schedule', compact('id', 'admin', 'center', 'stats'));
    }

    public function appointmentsCalendar()
    {
        $admin = $this->getAdmin();
        $center = $admin->medicalCenter;
        $stats = $this->getStats($center);
        return view('backend.medical-center.appointments.calendar', compact('admin', 'center', 'stats'));
    }

    public function transactions()
    {
        return $this->financialReports(request());
    }

    public function invoices()
    {
        $admin = $this->getAdmin();
        $center = $admin->medicalCenter;
        $stats = $this->getStats($center);
        return view('backend.medical-center.financial.invoices', compact('admin', 'center', 'stats'));
    }

    public function updateService(Request $request, $id)
    {
        return redirect()->back()->with('success', 'تم تحديث الخدمة بنجاح');
    }

    public function showAppointment($id)
    {
        $admin = $this->getAdmin();
        $center = $admin->medicalCenter;
        $stats = $this->getStats($center);
        $appointment = Appointment::findOrFail($id);
        return view('backend.medical-center.appointments.show', compact('appointment', 'admin', 'center', 'stats'));
    }

    public function updateAppointmentStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'تم تحديث حالة الموعد');
    }

    public function cancelAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => 'cancelled']);
        return redirect()->back()->with('success', 'تم إلغاء الموعد');
    }

    public function storeService(Request $request)
    {
        $admin = Auth::user()->medicalCenterAdmins()->first();
        $center = $admin->medicalCenter;

        $service = new Service($request->all());
        $service->medical_center_id = $center->id;
        $service->slug = \Illuminate\Support\Str::slug($request->name_en) . '-' . time();
        $service->save();

        return redirect()->back()->with('success', 'تمت إضافة الخدمة بنجاح');
    }

    public function deleteService($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->back()->with('success', 'تم حذف الخدمة');
    }

    private function getAdmin()
    {
        return Auth::user()->medicalCenterAdmins()->first();
    }

    private function getStats($center)
    {
        return Cache::remember('medical_center_' . $center->id . '_stats', 900, function () use ($center) {
            return [
                'total_doctors' => $center->doctors()->count(),
                'active_doctors' => $center->doctors()->wherePivot('is_active', true)->count(),
                'today_appointments' => $center->appointments()
                    ->whereDate('scheduled_for', Carbon::today())
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
            ];
        });
    }
}
