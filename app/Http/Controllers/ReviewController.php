<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * تخزين مراجعة جديدة
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'appointment_id' => 'required|exists:appointments,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();

        // 1. التحقق من أن المريض هو صاحب الموعد
        $appointment = Appointment::where('id', $request->appointment_id)
            ->where('patient_id', $user->id)
            ->where('doctor_id', $request->doctor_id)
            ->first();

        if (!$appointment) {
            return back()->with('error', 'هذا الموعد غير موجود أو لا يخصك.');
        }

        // 2. التحقق من أن الموعد مكتمل
        if ($appointment->status !== 'completed') {
            return back()->with('error', 'لا يمكنك تقييم الطبيب قبل اكتمال الموعد.'); // أو "يجب أن تزور الطبيب فعلاً"
        }

        // 3. التحقق من عدم وجود مراجعة سابقة لهذا الموعد
        if ($appointment->review) {
            return back()->with('error', 'لقد قمت بتقييم هذا الموعد مسبقاً.');
        }

        // إنشاء المراجعة
        Review::create([
            'patient_id' => $user->id,
            'doctor_id' => $request->doctor_id,
            'appointment_id' => $appointment->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'pending', // افتراضياً معلق
        ]);

        return back()->with('success', 'شكراً لتقييمك! سيتم نشر تعليقك بعد المراجعة.');
    }
}
