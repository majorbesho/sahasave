<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Get simplified system stats for mobile admin
     */
    public function stats()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'total_users' => \App\Models\User::count(),
                'total_doctors' => \App\Models\User::where('role', 'doctor')->count(),
                'total_patients' => \App\Models\User::where('role', 'patient')->count(),
                'total_appointments' => \App\Models\Appointment::count(),
                'pending_appointments' => \App\Models\Appointment::where('status', 'pending')->count(),
            ]
        ]);
    }

    /**
     * List all users
     */
    public function users()
    {
        $users = \App\Models\User::paginate(20);
        return \App\Http\Resources\UserResource::collection($users)->additional(['success' => true]);
    }

    /**
     * List all doctors
     */
    public function doctors()
    {
        $doctors = \App\Models\User::where('role', 'doctor')->with('doctorProfile')->paginate(20);
        return \App\Http\Resources\DoctorResource::collection($doctors)->additional(['success' => true]);
    }

    /**
     * List all appointments
     */
    public function appointments()
    {
        $appointments = \App\Models\Appointment::with(['patient', 'doctor'])->orderBy('created_at', 'desc')->paginate(20);
        return \App\Http\Resources\AppointmentResource::collection($appointments)->additional(['success' => true]);
    }
}
