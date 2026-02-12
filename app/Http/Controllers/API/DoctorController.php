<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\DoctorProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    /**
     * Doctor Registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|unique:users,phone',
            'password' => 'required|string|min:8|confirmed',
            'medical_license_number' => 'required|string|unique:doctor_profiles,medical_license_number',
            'specialty_id' => 'required|exists:specialties,id',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'doctor',
                'status' => 'pending', // Doctors usually need verification
            ]);

            DoctorProfile::create([
                'doctor_id' => $user->id,
                'medical_license_number' => $request->medical_license_number,
                'specialty_id' => $request->specialty_id,
                'verification_status' => 'pending_review'
            ]);

            DB::commit();

            $token = $user->createToken('doctor-app')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Doctor registered successfully. Profile is pending verification.',
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error during registration: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Doctor Dashboard summary
     */
    public function dashboard()
    {
        $user = Auth::user();
        $doctorProfile = $user->doctorProfile;

        $stats = [
            'today_appointments' => $user->doctorAppointments()->today()->count(),
            'pending_appointments' => $user->doctorAppointments()->pending()->count(),
            'total_consultations' => $doctorProfile->total_consultations ?? 0,
            'average_rating' => $doctorProfile->average_rating ?? 0,
        ];

        $todayAppointments = $user->doctorAppointments()
            ->with(['patient'])
            ->today()
            ->orderBy('scheduled_for', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'stats' => $stats,
                'today_appointments' => \App\Http\Resources\AppointmentResource::collection($todayAppointments),
                'doctor' => new \App\Http\Resources\DoctorResource($user)
            ]
        ]);
    }

    /**
     * List doctor appointments
     */
    public function appointments(Request $request)
    {
        $status = $request->query('status');

        $query = Auth::user()->doctorAppointments()
            ->with(['patient', 'medicalCenter']);

        if ($status) {
            $query->where('status', $status);
        }

        $appointments = $query->orderBy('scheduled_for', 'desc')->paginate(15);

        return \App\Http\Resources\AppointmentResource::collection($appointments)->additional(['success' => true]);
    }

    /**
     * Update appointment status (Accept/Reject/Complete)
     */
    public function updateAppointmentStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:confirmed,cancelled,completed',
            'notes' => 'nullable|string',
            'cancellation_reason' => 'nullable|string|required_if:status,cancelled'
        ]);

        $appointment = Appointment::where('doctor_id', Auth::id())->findOrFail($id);

        if ($request->status === 'confirmed') {
            $appointment->accept();
        } elseif ($request->status === 'cancelled') {
            $appointment->cancel($request->cancellation_reason, Auth::id());
        } elseif ($request->status === 'completed') {
            $appointment->complete();
        }

        if ($request->notes) {
            $appointment->update(['doctor_notes' => $request->notes]);
        }

        return (new \App\Http\Resources\AppointmentResource($appointment))->additional([
            'success' => true,
            'message' => 'Appointment status updated to ' . $request->status
        ]);
    }
}
