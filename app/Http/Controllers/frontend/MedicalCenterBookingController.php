<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicalCenter;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class MedicalCenterBookingController extends Controller
{
    /**
     * Display the general booking page for a medical center
     */
    public function show($slug)
    {
        $center = MedicalCenter::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $patient = Auth::user();
        $activeRewards = $patient ? $patient->activeRewards()->get() : collect();

        // Get active doctors for this center if the user wants to see them (optional)
        $doctors = $center->activeDoctors()->get();

        return view('frontend.medical-centers.booking-general', compact(
            'center',
            'patient',
            'activeRewards',
            'doctors'
        ));
    }

    /**
     * Store a general appointment for the medical center
     */
    public function store(Request $request)
    {
        $request->validate([
            'medical_center_id' => 'required|exists:medical_centers,id',
            'scheduled_date' => 'required|date|after_or_equal:today',
            'scheduled_time' => 'required',
            'visit_type' => 'required|string',
            'patient_notes' => 'nullable|string|max:1000',
        ]);

        $center = MedicalCenter::findOrFail($request->medical_center_id);
        $patient = Auth::user();

        $scheduledFor = Carbon::parse($request->scheduled_date . ' ' . $request->scheduled_time);

        // Basic availability check (within center working hours)
        if (!$this->isWithinWorkingHours($center, $scheduledFor)) {
            return back()->withErrors(['scheduled_time' => __('booking.outside_working_hours')])->withInput();
        }

        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'medical_center_id' => $center->id,
            'doctor_id' => null, // General booking
            'appointment_number' => $this->generateAppointmentNumber(),
            'type' => 'direct_visit',
            'mode' => 'offline',
            'scheduled_for' => $scheduledFor,
            'scheduled_until' => $scheduledFor->copy()->addMinutes(30),
            'duration' => 30,
            'status' => 'pending',
            'service_type' => $request->visit_type,
            'patient_notes' => $request->patient_notes,
            'slug' => Str::random(12) . '-' . time(),
        ]);

        return redirect()->route('appointments.confirmation', $appointment)
            ->with('success', __('booking.success_message'));
    }

    /**
     * Check if the scheduled time is within the center's working hours
     */
    private function isWithinWorkingHours($center, $scheduledFor)
    {
        $dayName = strtolower($scheduledFor->format('l'));
        $workingHours = $center->working_hours;

        if (!$workingHours || !isset($workingHours[$dayName])) {
            return true; // Fallback if no hours set
        }

        $dayHours = $workingHours[$dayName];

        if (isset($dayHours['closed']) && $dayHours['closed']) {
            return false;
        }

        $openTime = Carbon::createFromFormat('H:i', $dayHours['open']);
        $closeTime = Carbon::createFromFormat('H:i', $dayHours['close']);
        $checkTime = Carbon::createFromFormat('H:i', $scheduledFor->format('H:i'));

        return $checkTime->between($openTime, $closeTime);
    }

    /**
     * Generate a unique appointment number
     */
    private function generateAppointmentNumber()
    {
        return 'APT' . strtoupper(Str::random(8)) . time();
    }
}
