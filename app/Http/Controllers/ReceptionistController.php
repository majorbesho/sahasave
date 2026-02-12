<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\MedicalCenter;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReceptionistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $clinic = $request->route('clinic');
            $clinicId = ($clinic instanceof MedicalCenter) ? $clinic->id : $clinic;

            if (!$clinicId || !Auth::user()->hasPermissionInCenter('create_appointment', $clinicId)) {
                abort(403, 'Access denied. You do not have permission to create appointments in this clinic.');
            }
            return $next($request);
        });
    }

    // عرض صفحة الحجز الرئيسية
    public function index(MedicalCenter $clinic)
    {
        // Get today's appointments for this clinic
        $todayAppointments = Appointment::where('medical_center_id', $clinic->id)
            ->whereDate('scheduled_for', Carbon::today())
            ->with(['patient', 'doctor'])
            ->orderBy('scheduled_for', 'asc')
            ->get();

        return view('clinic.reception.index', compact('clinic', 'todayAppointments'));
    }

    // البحث عن مريض (AJAX)
    public function searchPatient(Request $request, MedicalCenter $clinic)
    {
        $query = trim($request->get('q'));
        if (strlen($query) < 3) {
            return response()->json([]);
        }

        $patients = User::patients()
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('phone', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%");
            })
            ->limit(10)
            ->get(['id', 'name', 'phone', 'email']);

        return response()->json($patients);
    }

    // إنشاء مريض جديد (من واجهة الاستقبال)
    public function storePatient(Request $request, MedicalCenter $clinic)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|unique:users,phone',
            'email' => 'nullable|email|unique:users,email',
            'date_of_birth' => 'nullable|date|before:today',
        ]);

        $patient = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make(Str::random(12)),
            'role' => 'patient',
            'status' => 'active',
            'date_of_birth' => $request->date_of_birth,
        ]);

        return response()->json([
            'success' => true,
            'patient' => $patient->only('id', 'name', 'phone', 'email')
        ]);
    }

    // عرض أوقات الطبيب المتاحة (AJAX)
    public function getAvailableSlots(Request $request, MedicalCenter $clinic)
    {
        $doctorId = $request->doctor_id;
        $date = Carbon::parse($request->date);

        // التحقق أن الطبيب يعمل في هذه العيادة
        if (!$clinic->doctors()->where('users.id', $doctorId)->exists()) {
            return response()->json(['error' => 'Doctor not in this clinic'], 400);
        }

        // جلب الجدول الأسبوعي للطبيب في هذا المركز
        $schedules = Schedule::where('medical_center_id', $clinic->id)
            ->where('doctor_id', $doctorId)
            ->where('day_of_week', $date->dayOfWeek)
            ->where('is_active', true)
            ->get();

        // جلب المواعيد المحجوزة مسبقاً
        $booked = Appointment::where('doctor_id', $doctorId)
            ->where('medical_center_id', $clinic->id)
            ->whereDate('scheduled_for', $date)
            ->whereIn('status', ['scheduled', 'confirmed'])
            ->pluck('scheduled_for')
            ->map(fn($t) => Carbon::parse($t)->format('H:i'))
            ->toArray();

        $available = [];
        foreach ($schedules as $slot) {
            $start = Carbon::parse($date->format('Y-m-d') . ' ' . $slot->start_time->format('H:i'));
            $end = Carbon::parse($date->format('Y-m-d') . ' ' . $slot->end_time->format('H:i'));

            $duration = $slot->session_duration ?: 30;

            while ($start < $end) {
                $timeStr = $start->format('H:i');
                if (!in_array($timeStr, $booked)) {
                    // Avoid adding past slots if today
                    if (!$date->isToday() || $start->isFuture()) {
                        $available[] = $start->format('Y-m-d H:i:s');
                    }
                }
                $start->addMinutes($duration);
            }
        }

        return response()->json($available);
    }

    // حجز موعد جديد
    public function storeAppointment(Request $request, MedicalCenter $clinic)
    {
        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'scheduled_for' => 'required|date|after:now',
            'notes' => 'nullable|string|max:500',
        ]);

        // التحقق أن الطبيب يعمل في العيادة
        if (!$clinic->doctors()->where('users.id', $request->doctor_id)->exists()) {
            if ($request->ajax()) {
                return response()->json(['message' => 'Selected doctor is not available in this clinic.'], 422);
            }
            return back()->withErrors(['doctor_id' => 'Selected doctor is not available in this clinic.']);
        }

        // التحقق أن الوقت متاح
        $exists = Appointment::where('doctor_id', $request->doctor_id)
            ->where('medical_center_id', $clinic->id)
            ->where('scheduled_for', $request->scheduled_for)
            ->whereIn('status', ['scheduled', 'confirmed'])
            ->exists();

        if ($exists) {
            if ($request->ajax()) {
                return response()->json(['message' => 'This time slot is already booked.'], 422);
            }
            return back()->withErrors(['scheduled_for' => 'This time slot is already booked.']);
        }

        Appointment::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'medical_center_id' => $clinic->id,
            'scheduled_for' => $request->scheduled_for,
            'status' => 'scheduled',
            'patient_notes' => $request->notes, // Using patient_notes instead of notes as per migration
            // 'created_by' => Auth::id(), // created_by is not in the migration, so we omit unless we add it
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Appointment booked successfully!']);
        }

        return redirect()->route('clinic.reception.index', $clinic)
            ->with('success', 'Appointment booked successfully!');
    }

    // إلغاء موعد
    public function cancelAppointment(Appointment $appointment, MedicalCenter $clinic)
    {
        if ($appointment->medical_center_id !== $clinic->id) {
            abort(403);
        }

        $appointment->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancelled_by' => Auth::id()
        ]);

        return back()->with('info', 'Appointment cancelled.');
    }
}
