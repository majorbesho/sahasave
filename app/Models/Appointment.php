<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'medical_center_id',
        'appointment_number',
        'type',
        'mode',
        'scheduled_for',
        'scheduled_until',
        'duration',
        'status',
        'original_fee',
        'discount_amount',
        'final_fee',
        'applied_rewards',
        'patient_notes',
        'doctor_notes',
        'cancellation_reason',
        'rating',
        'review',
        'reviewed_at',


        'discounted_fee',
        'applied_discount',
        'cashback_earned',
        'reward_id',
        'referral_id'
    ];

    protected $casts = [
        'scheduled_for' => 'datetime',
        'scheduled_until' => 'datetime',
        'original_fee' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'final_fee' => 'decimal:2',
        'applied_rewards' => 'array',
        'reviewed_at' => 'datetime',
        'duration' => 'integer',
        'rating' => 'integer',


        'discounted_fee' => 'decimal:2',
        'applied_discount' => 'decimal:2',
        'cashback_earned' => 'decimal:2',

    ];

    // العلاقات
    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }

    public function referral()
    {
        return $this->belongsTo(Referral::class);
    }
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function medicalCenter()
    {
        return $this->belongsTo(MedicalCenter::class);
    }

    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecord::class);
    }

    public function usedRewards()
    {
        return $this->belongsToMany(Reward::class, 'appointment_rewards')
            ->withTimestamps();
    }

    // public function payments()
    // {
    //     return $this->hasMany(Payment::class);
    // }




    // النطاقات
    public function scopeUpcoming($query)
    {
        return $query->where('scheduled_for', '>', now())
            ->whereIn('status', ['scheduled', 'confirmed']);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeForDoctor($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId);
    }

    public function scopeForPatient($query, $patientId)
    {
        return $query->where('patient_id', $patientId);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('scheduled_for', today());
    }

    // الطرق المساعدة
    public function generateAppointmentNumber()
    {
        if (empty($this->appointment_number)) {
            $this->appointment_number = 'APT' . date('Ymd') . str_pad($this->id, 6, '0', STR_PAD_LEFT);
        }
        return $this->appointment_number;
    }

    public function canBeCancelled()
    {
        return in_array($this->status, ['scheduled', 'confirmed']) &&
            $this->scheduled_for->diffInHours(now()) > 24;
    }

    public function cancel($reason = null)
    {
        $this->status = 'cancelled';
        $this->cancellation_reason = $reason;
        $this->save();

        // إعادة المكافآت المستخدمة
        foreach ($this->usedRewards as $reward) {
            $reward->update(['status' => 'active']);
        }
    }

    public function complete()
    {
        $this->status = 'completed';
        $this->save();

        // تحديث إحصائيات الطبيب
        if ($this->doctor->doctorProfile) {
            $this->doctor->doctorProfile->increment('total_consultations');
        }
    }

    public function addReview($rating, $review = null)
    {
        $this->rating = $rating;
        $this->review = $review;
        $this->reviewed_at = now();
        $this->save();

        // تحديث تقييم الطبيب
        if ($this->doctor->doctorProfile) {
            $this->doctor->doctorProfile->updateRating($rating);
        }

        // تحديث تقييم المركز الطبي
        $this->medicalCenter->updateRatingStats();
    }

    public function calculateFees()
    {
        $doctorFee = $this->doctor->medicalCenters()
            ->where('medical_center_id', $this->medical_center_id)
            ->first()
            ->pivot
            ->consultation_fee ?? 0;

        $this->original_fee = $doctorFee;
        $this->final_fee = $doctorFee - $this->discount_amount;
        $this->save();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($appointment) {
            $appointment->generateAppointmentNumber();
        });

        static::created(function ($appointment) {
            $appointment->calculateFees();
        });
    }
}
