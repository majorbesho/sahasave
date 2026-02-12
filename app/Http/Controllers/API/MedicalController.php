<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MedicalCenter;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;

class MedicalController extends Controller
{
    /**
     * Get all active specialties
     */
    public function specialties()
    {
        $specialties = Specialty::active()
            ->orderBy('order', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $specialties
        ]);
    }

    /**
     * Get medical centers
     */
    public function centers(Request $request)
    {
        $type = $request->query('type');
        $city = $request->query('city');

        $query = MedicalCenter::active()->verified();

        if ($type) {
            $query->where('type', $type);
        }

        if ($city) {
            $query->where('city', $city);
        }

        $centers = $query->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $centers
        ]);
    }

    /**
     * Get doctors with filters
     */
    public function doctors(Request $request)
    {
        $specialtyId = $request->query('specialty_id');
        $city = $request->query('city');
        $search = $request->query('search');

        $query = User::role('doctor')
            ->where('status', 'active')
            ->with(['doctorProfile.specialty', 'medicalCenters']);

        if ($specialtyId) {
            $query->whereHas('doctorProfile', function ($q) use ($specialtyId) {
                $q->where('specialty_id', $specialtyId);
            });
        }

        if ($city) {
            $query->whereHas('medicalCenters', function ($q) use ($city) {
                $q->where('city', $city);
            });
        }

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $doctors = $query->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $doctors
        ]);
    }

    /**
     * Get doctor details
     */
    public function doctorDetails($id)
    {
        $doctor = User::role('doctor')
            ->with(['doctorProfile.specialty', 'medicalCenters', 'doctorReviews'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $doctor
        ]);
    }
}
