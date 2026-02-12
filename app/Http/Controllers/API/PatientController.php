<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * Patient Registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|unique:users,phone',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'patient',
            'status' => 'active',
        ]);

        // Initialize loyalty points if method exists
        if (method_exists($user, 'initializeLoyaltyPoints')) {
            $user->initializeLoyaltyPoints();
        }

        $token = $user->createToken('patient-app')->plainTextToken;

        return (new \App\Http\Resources\UserResource($user))->additional([
            'success' => true,
            'message' => 'Patient registered successfully',
            'token' => $token
        ]);
    }

    /**
     * Patient Dashboard summary
     */
    public function dashboard()
    {
        $user = Auth::user();

        $upcoming = Appointment::with(['doctor', 'medicalCenter'])
            ->where('patient_id', $user->id)
            ->upcoming()
            ->orderBy('scheduled_for', 'asc')
            ->first();

        $stats = [
            'total_appointments' => $user->patientAppointments()->count(),
            'upcoming_count' => $user->patientAppointments()->upcoming()->count(),
            'loyalty_points' => $user->available_points ?? 0,
            'savings' => $user->lifetime_savings ?? 0,
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'upcoming_appointment' => $upcoming ? new \App\Http\Resources\AppointmentResource($upcoming) : null,
                'stats' => $stats,
                'user' => new \App\Http\Resources\UserResource($user)
            ]
        ]);
    }

    /**
     * List patient appointments
     */
    public function appointments()
    {
        $appointments = Auth::user()->patientAppointments()
            ->with(['doctor', 'medicalCenter'])
            ->orderBy('scheduled_for', 'desc')
            ->paginate(15);

        return \App\Http\Resources\AppointmentResource::collection($appointments)->additional(['success' => true]);
    }

    /**
     * Book an appointment
     */
    public function bookAppointment(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'medical_center_id' => 'required|exists:medical_centers,id',
            'scheduled_for' => 'required|date|after:now',
            'type' => 'required|in:video_call,audio_call,direct_visit',
            'reason' => 'nullable|string'
        ]);

        $appointment = Appointment::create([
            'patient_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'medical_center_id' => $request->medical_center_id,
            'scheduled_for' => $request->scheduled_for,
            'type' => $request->type,
            'reason' => $request->reason,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Appointment booked successfully and pending doctor approval',
            'data' => $appointment
        ], 201);
    }
}
