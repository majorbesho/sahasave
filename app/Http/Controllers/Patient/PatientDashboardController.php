<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Favorite;
use App\Models\User;
use App\Models\MedicalRecord;
use App\Models\Prescription;
use App\Models\LabOrder;
use App\Models\Referral;
use App\Models\Reward;
use App\Models\PatientMedicalProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PatientDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $upcomingAppointments = $user->patientAppointments()
            ->with(['doctor', 'medicalCenter'])
            ->where('scheduled_for', '>', now())
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('scheduled_for', 'asc')
            ->paginate(5, ['*'], 'upcoming_page');

        $cancelledAppointments = $user->patientAppointments()
            ->with(['doctor', 'medicalCenter'])
            ->where('status', 'cancelled')
            ->orderBy('scheduled_for', 'desc')
            ->paginate(5, ['*'], 'cancelled_page');

        $completedAppointments = $user->patientAppointments()
            ->with(['doctor', 'medicalCenter'])
            ->where('status', 'completed')
            ->orderBy('scheduled_for', 'desc')
            ->paginate(5, ['*'], 'completed_page');

        return view('patient.appointments', compact('upcomingAppointments', 'cancelledAppointments', 'completedAppointments'));
    }



    public function show(Appointment $appointment)
    {
        if ($appointment->patient_id !== Auth::id()) {
            abort(403);
        }

        $appointment->load(['doctor', 'medicalCenter']);
        return view('patient.appointment-details', compact('appointment'));
    }

    public function cancel(Request $request, Appointment $appointment)
    {
        if ($appointment->patient_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        if (!$appointment->canBeCancelled()) {
            return response()->json([
                'success' => false,
                'message' => 'This appointment cannot be cancelled.'
            ], 400);
        }

        $appointment->cancel($request->reason);

        return response()->json([
            'success' => true,
            'message' => 'Appointment cancelled successfully.'
        ]);
    }

    public function addReview(Request $request, Appointment $appointment)
    {
        if ($appointment->patient_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000'
        ]);

        if ($appointment->status !== 'completed') {
            return response()->json(['success' => false, 'message' => 'Only completed appointments can be reviewed'], 400);
        }

        $appointment->addReview($request->rating, $request->review);

        return response()->json([
            'success' => true,
            'message' => 'Review added successfully.'
        ]);
    }


    public function appointments()
    {
        $user = Auth::user();

        $upcomingAppointments = $user->patientAppointments()
            ->with(['doctor', 'medicalCenter'])
            ->where('scheduled_for', '>', now())
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('scheduled_for', 'asc')
            ->paginate(5, ['*'], 'upcoming_page');

        $cancelledAppointments = $user->patientAppointments()
            ->with(['doctor', 'medicalCenter'])
            ->where('status', 'cancelled')
            ->orderBy('scheduled_for', 'desc')
            ->paginate(5, ['*'], 'cancelled_page');

        $completedAppointments = $user->patientAppointments()
            ->with(['doctor', 'medicalCenter'])
            ->where('status', 'completed')
            ->orderBy('scheduled_for', 'desc')
            ->paginate(5, ['*'], 'completed_page');

        return view('patient.appointments', compact('upcomingAppointments', 'cancelledAppointments', 'completedAppointments'));
    }

    public function dashboard()
    {
        $user = Auth::user();

        // Ensure loyalty points are initialized
        $loyaltyPoints = $user->initializeLoyaltyPoints();

        $data = [
            'unreadMessages' => 0,
            'recentActivities' => $this->getRecentActivities($user),
            'loyaltyPoints' => $loyaltyPoints,
            'loyaltyStats' => $user->getLoyaltyDashboardStats(),
        ];

        return view('patient.dashboard', $data);
    }

    public function showAppointment(Appointment $appointment)
    {
        if ($appointment->patient_id !== Auth::id()) {
            abort(403);
        }

        $appointment->load(['doctor', 'medicalCenter', 'medicalRecord']);

        return view('patient.appointment-details', compact('appointment'));
    }

    public function favorites()
    {
        return redirect()->route('patient.favorites.index');
    }

    public function medicalRecords()
    {
        /** @var User $patient */
        $patient = Auth::user();
        $medicalRecords = $patient->medicalRecords()
            ->with(['doctor', 'medicalCenter'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('patient.medical-records', compact('medicalRecords'));
    }

    public function prescriptions()
    {
        /** @var User $patient */
        $patient = Auth::user();
        $prescriptions = $patient->prescriptions()
            ->with(['doctor', 'medicalRecord'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('patient.prescriptions', compact('prescriptions'));
    }

    public function labOrders()
    {
        /** @var User $patient */
        $patient = Auth::user();
        $labOrders = $patient->labOrders()
            ->with(['doctor', 'labCenter'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('patient.lab-orders', compact('labOrders'));
    }

    public function referrals()
    {
        /** @var User $patient */
        $patient = Auth::user();

        // Ensure user has a referral code
        $patient->generateReferralCode();

        // Fetch 3-level referral tree
        $referralTree = $patient->getReferralTree();

        $referrals = $patient->referralsMade()
            ->with('referred')
            ->orderBy('created_at', 'desc')
            ->get();

        $rewards = $patient->rewards()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('patient.referrals', compact('referrals', 'rewards', 'referralTree'));
    }

    public function messages()
    {
        return view('patient.messages');
    }

    public function chat($doctorId)
    {
        return view('patient.chat', compact('doctorId'));
    }

    public function profileSettings()
    {
        /** @var User $user */
        $user = Auth::user();
        $medicalProfile = $user->medicalProfile ?? new PatientMedicalProfile();

        return view('patient.profile-settings', compact('user', 'medicalProfile'));
    }

    public function updateProfileSettings(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'required|in:male,female',
            'nationality' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:500',
            'emergency_contact' => 'nullable|string|max:255',
            'emergency_phone' => 'nullable|string|max:20',
            'blood_group' => 'nullable|string|max:10',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'allergies' => 'nullable|string',
            'chronic_conditions' => 'nullable|string',
            'current_medications' => 'nullable|string',
        ]);

        try {
            // تحديث بيانات المستخدم الأساسية
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'nationality' => $request->nationality,
                'address' => $request->address,
                'emergency_contact' => $request->emergency_contact,
                'emergency_phone' => $request->emergency_phone,
            ];

            $user->update($userData);

            // تحديث أو إنشاء الملف الطبي
            $medicalData = [
                'blood_group' => $request->blood_group,
                'height' => $request->height,
                'weight' => $request->weight,
                'allergies' => $request->allergies,
                'chronic_conditions' => $request->chronic_conditions,
                'current_medications' => $request->current_medications,
            ];

            if ($user->medicalProfile) {
                $user->medicalProfile->update($medicalData);
            } else {
                $medicalData['patient_id'] = $user->id;
                PatientMedicalProfile::create($medicalData);
            }

            // معالجة رفع الصورة
            if ($request->hasFile('photo')) {
                $this->updateProfilePhoto($user, $request->file('photo'));
            }

            return redirect()->route('patient.profile.settings')
                ->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            Log::error('Profile update error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to update profile. Please try again.']);
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password changed successfully!');
    }

    public function updateNotificationSettings(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $user->update([
            'push_notifications' => $request->boolean('push_notifications'),
            'email_notifications' => $request->boolean('email_notifications'),
            'sms_notifications' => $request->boolean('sms_notifications'),
        ]);

        return back()->with('success', 'Notification settings updated!');
    }

    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password',
        ]);

        /** @var User $user */
        $user = Auth::user();

        Auth::logout();

        // استخدام Soft Delete
        $user->delete();

        return redirect('/')->with('success', 'Your account has been deleted successfully.');
    }

    public function toggleFavorite(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id'
        ]);

        /** @var User $patient */
        $patient = Auth::user();

        $favorite = Favorite::where('patient_id', $patient->id)
            ->where('doctor_id', $request->doctor_id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $message = 'Doctor removed from favorites';
            $isFavorite = false;
        } else {
            Favorite::create([
                'patient_id' => $patient->id,
                'doctor_id' => $request->doctor_id
            ]);
            $message = 'Doctor added to favorites';
            $isFavorite = true;
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'is_favorite' => $isFavorite
        ]);
    }

    private function updateProfilePhoto(User $user, $photo)
    {
        try {
            if ($user->photo) {
                Storage::delete('public/profiles/' . $user->photo);
            }

            $filename = 'profile-' . $user->id . '-' . time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/profiles', $filename);

            $user->update([
                'photo' => $filename
            ]);
        } catch (\Exception $e) {
            Log::error('Profile photo update error: ' . $e->getMessage());
            throw $e;
        }
    }

    private function getRecentActivities(User $user)
    {
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
        ]);
    }

    /**
     * الحصول على إحصائيات المريض
     */
    public function getStats()
    {
        /** @var User $patient */
        $patient = Auth::user();

        return [
            'total_appointments' => $patient->patientAppointments()->count(),
            'upcoming_appointments' => $patient->upcomingAppointments()->count(),
            'favorite_doctors' => $patient->favorites()->count(),
            'medical_records' => $patient->medicalRecords()->count(),
            'pending_prescriptions' => $patient->prescriptions()->where('status', 'active')->count(),
        ];
    }
}
