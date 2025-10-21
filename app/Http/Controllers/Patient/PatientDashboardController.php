<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Favorite;


use App\Models\User;
use App\Models\MedicalRecord;
use App\Models\Reward;


use Illuminate\Support\Facades\Auth;

class PatientDashboardController extends Controller
{
    public function index()
    {
        $patient = Auth::user();
        $appointments = Appointment::where('patient_id', $patient->id)
            ->with('doctor')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $favoritesCount = Favorite::where('patient_id', $patient->id)->count();

        return view('patient.dashboard', compact('patient', 'appointments', 'favoritesCount'));
    }



    public function appointments()
    {
        $appointments = Auth::user()->patientAppointments()
            ->with(['doctor', 'medicalCenter'])
            ->orderBy('scheduled_for', 'desc')
            ->get();

        return view('patient.appointments', compact('appointments'));
    }



    public function dashboard()
    {
        $user = Auth::user();

        $data = [
            'unreadMessages' => 0, // يمكنك استبدال هذا بالمنطق الحقيقي
            'recentActivities' => $this->getRecentActivities($user),
        ];

        return view('patient.dashboard', $data);
    }


    public function showAppointment($id)
    {
        $appointment = Appointment::where('patient_id', Auth::id())
            ->with(['doctor', 'medicalCenter', 'medicalRecord'])
            ->findOrFail($id);

        return view('patient.appointment-details', compact('appointment'));
    }

    public function favorites()
    {
        $favoriteDoctors = Auth::user()->favoriteDoctors()
            ->with('doctorProfile')
            ->get();

        return view('patient.favorites', compact('favoriteDoctors'));
    }

    public function medicalRecords()
    {
        $medicalRecords = Auth::user()->medicalRecords()
            ->with(['doctor', 'medicalCenter'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('patient.medical-records', compact('medicalRecords'));
    }

    public function prescriptions()
    {
        $prescriptions = Auth::user()->prescriptions()
            ->with(['doctor', 'medicalRecord'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('patient.prescriptions', compact('prescriptions'));
    }

    public function labOrders()
    {
        $labOrders = Auth::user()->labOrders()
            ->with(['doctor', 'labCenter'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('patient.lab-orders', compact('labOrders'));
    }

    public function referrals()
    {
        $referrals = Auth::user()->referralsMade()
            ->with('referred')
            ->orderBy('created_at', 'desc')
            ->get();

        $rewards = Auth::user()->rewards()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('patient.referrals', compact('referrals', 'rewards'));
    }

    public function messages()
    {
        // سيتم تنفيذ المنطق الخاص بالرسائل لاحقاً
        return view('patient.messages');
    }

    public function chat($doctorId)
    {
        // سيتم تنفيذ المنطق الخاص بالدردشة لاحقاً
        return view('patient.chat', compact('doctorId'));
    }

    public function profileSettings()
    {
        $user = Auth::user();
        $medicalProfile = $user->medicalProfile;

        return view('patient.profile-settings', compact('user', 'medicalProfile'));
    }

    private function getRecentActivities($user)
    {
        // هذا مثال للأنشطة الحديثة - يمكنك تخصيصه حسب احتياجاتك
        return collect([
            (object)[
                'created_at' => now()->subDays(1),
                'description' => 'Medical checkup completed',
                'doctor_name' => 'Dr. Smith'
            ],
            (object)[
                'created_at' => now()->subDays(3),
                'description' => 'Lab results received',
                'doctor_name' => 'Dr. Johnson'
            ],
            (object)[
                'created_at' => now()->subDays(5),
                'description' => 'Prescription renewed',
                'doctor_name' => 'Dr. Wilson'
            ],
        ]);
    }



    public function toggleFavorite(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id'
        ]);

        $patient = Auth::user();

        $favorite = Favorite::where('patient_id', $patient->id)
            ->where('doctor_id', $request->doctor_id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $message = 'تم إزالة الطبيب من المفضلة';
            $isFavorite = false;
        } else {
            Favorite::create([
                'patient_id' => $patient->id,
                'doctor_id' => $request->doctor_id
            ]);
            $message = 'تم إضافة الطبيب إلى المفضلة';
            $isFavorite = true;
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'is_favorite' => $isFavorite
        ]);
    }

    public function profile()
    {
        $patient = Auth::user();
        return view('patient.profile', compact('patient'));
    }

    public function updateProfile(Request $request)
    {
        $patient = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $patient->id,
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
        ]);

        $patient->update($request->all());

        return redirect()->route('patient.profile')
            ->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }

    public function settings()
    {
        $patient = Auth::user();
        return view('patient.settings', compact('patient'));
    }
}
