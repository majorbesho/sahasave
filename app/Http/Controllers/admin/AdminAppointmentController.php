<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminAppointmentController extends Controller
{
    /**
     * Display a listing of all appointments.
     */
    public function index(Request $request)
    {
        $query = Appointment::with(['patient', 'doctor.doctorProfile.specialty', 'medicalCenter'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('scheduled_for', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('scheduled_for', '<=', $request->date_to);
        }

        // Search by patient or doctor name
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('patient', function ($patient) use ($search) {
                    $patient->where('name', 'like', "%{$search}%");
                })->orWhereHas('doctor', function ($doctor) use ($search) {
                    $doctor->where('name', 'like', "%{$search}%");
                });
            });
        }

        $appointments = $query->paginate(20);

        // Statistics
        $stats = [
            'total' => Appointment::count(),
            'pending' => Appointment::where('status', 'pending')->count(),
            'confirmed' => Appointment::where('status', 'confirmed')->count(),
            'completed' => Appointment::where('status', 'completed')->count(),
            'cancelled' => Appointment::where('status', 'cancelled')->count(),
        ];

        return view('backend.appointments.index', compact('appointments', 'stats'));
    }

    /**
     * Display the specified appointment.
     */
    public function show($id)
    {
        $appointment = Appointment::with([
            'patient',
            'doctor.doctorProfile.specialty',
            'medicalCenter',
            'reward',
            'referral',
            'attachments'
        ])->findOrFail($id);

        return view('backend.appointments.show', compact('appointment'));
    }

    /**
     * Update appointment status.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => $request->status]);

        return back()->with('success', 'تم تحديث حالة الموعد بنجاح');
    }
}
