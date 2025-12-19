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
        'appointment_time',
        'discounted_fee',
        'applied_discount',
        'cashback_earned',
        'reward_id',
        'referral_id',
        'service_type',
        'cancelled_by',
        'cancelled_at',

        'location_details',
        'symptoms',
        'reason',
        'insurance_covered',
        'insurance_details',
        'follow_up_required',
        'follow_up_notes',
        'reminder_sent',
        'confirmed_at',
        'completed_at',
        'rescheduled_from',
        'video_call_url',
        'audio_call_url'
    ];

    protected $casts = [
        'scheduled_for' => 'datetime',
        'scheduled_until' => 'datetime',
        'cancelled_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'confirmed_at' => 'datetime',
        'completed_at' => 'datetime',
        'original_fee' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'final_fee' => 'decimal:2',
        'applied_rewards' => 'array',
        'duration' => 'integer',
        'rating' => 'integer',
        'discounted_fee' => 'decimal:2',
        'applied_discount' => 'decimal:2',
        'cashback_earned' => 'decimal:2',
        'location_details' => 'array',
        'insurance_details' => 'array',
        'insurance_covered' => 'boolean',
        'follow_up_required' => 'boolean',
        'reminder_sent' => 'boolean',

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

    public function cancelledBy()
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }



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

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }



    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
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

    public function scopeLastDays($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function scopeVideoCall($query)
    {
        return $query->where('type', 'video_call');
    }

    public function scopeAudioCall($query)
    {
        return $query->where('type', 'audio_call');
    }

    public function scopeDirectVisit($query)
    {
        return $query->where('type', 'direct_visit');
    }

    /**
     * Scope to check for overlapping appointments.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $start DateTime string
     * @param string $end DateTime string
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOverlapping($query, $start, $end)
    {
        return $query->where(function ($q) use ($start, $end) {
            $q->whereBetween('scheduled_for', [$start, $end])
                ->orWhereBetween('scheduled_until', [$start, $end])
                ->orWhere(function ($subQ) use ($start, $end) {
                    $subQ->where('scheduled_for', '<', $start)
                        ->where('scheduled_until', '>', $end);
                });
        });
    }


    // الطرق المساعدة
    public function generateAppointmentNumber()
    {
        if (empty($this->appointment_number)) {
            $date = now()->format('Ymd');

            // الحصول على آخر موعد لهذا اليوم
            $lastAppointment = self::where('appointment_number', 'like', 'APT' . $date . '%')
                ->orderBy('id', 'desc')
                ->first();

            if ($lastAppointment) {
                // استخراج الرقم التسلسلي وإضافة 1
                $lastNumber = intval(substr($lastAppointment->appointment_number, -6));
                $sequence = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
            } else {
                $sequence = '000001';
            }

            $this->appointment_number = 'APT' . $date . $sequence;
        }
        return $this->appointment_number;
    }
    public function canBeCancelled()
    {
        return in_array($this->status, ['scheduled', 'confirmed']) &&
            $this->scheduled_for->diffInHours(now()) > 24;
    }

    // في Appointment Model
    public function cancel($reason = null, $cancelledBy = null, $refundOption = null)
    {
        $this->status = 'cancelled';
        $this->cancellation_reason = $reason;
        $this->cancelled_by = $cancelledBy;
        $this->cancelled_at = now();
        $this->refund_option = $refundOption;
        $this->save();

        // إعادة المكافآت المستخدمة - مع التحقق من وجود العلاقة
        if (method_exists($this, 'usedRewards') && $this->relationLoaded('usedRewards')) {
            foreach ($this->usedRewards as $reward) {
                $reward->update(['status' => 'active']);
            }
        }

        return $this;
    }


    // في Appointment Model
    public function rejectByDoctor($reason, $refundOption = null)
    {
        $this->status = 'cancelled';
        $this->cancellation_reason = $reason;
        $this->cancelled_by = auth()->id(); // الدكتور الذي يرفض
        $this->cancelled_at = now();
        $this->refund_option = $refundOption;
        $this->save();

        // إعادة المكافآت المستخدمة - مع التحقق من وجود العلاقة
        if (method_exists($this, 'usedRewards') && $this->relationLoaded('usedRewards')) {
            foreach ($this->usedRewards as $reward) {
                $reward->update(['status' => 'active']);
            }
        }

        return $this;
    }




    public function canBeAccepted()
    {
        return $this->status === 'pending' && $this->scheduled_for > now();
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isConfirmed()
    {
        return $this->status === 'confirmed';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }
    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    public function isUpcoming()
    {
        return $this->scheduled_for > now() && in_array($this->status, ['pending', 'confirmed']);
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


    public function getTypeIconAttribute()
    {
        return match ($this->type) {
            'video_call' => 'isax isax-video5 text-blue',
            'audio_call' => 'isax isax-call5 text-indigo',
            'direct_visit' => 'isax isax-building5 text-green',
            default => 'isax isax-clock5'
        };
    }





    public function getTypeDisplayAttribute()
    {
        return match ($this->type) {
            'video_call' => 'Video Call',
            'audio_call' => 'Audio Call',
            'direct_visit' => 'Direct Visit',
            default => ucfirst(str_replace('_', ' ', $this->type))
        };
    }

    public function getStatusBadgeClassAttribute()
    {
        return match ($this->status) {
            'pending' => 'badge new-tag',
            'confirmed' => 'badge bg-success',
            'completed' => 'badge bg-info',
            'cancelled' => 'badge bg-danger',
            default => 'badge bg-secondary'
        };
    }
    public function accept()
    {
        $this->update([
            'status' => 'confirmed',
            'confirmed_at' => now()
        ]);

        return $this;
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

        return $this;
    }

    public function getServiceTypeDisplayAttribute()
    {
        return match ($this->service_type) {
            'general_visit' => 'General Visit',
            'consultation_for_cardio' => 'Consultation for Cardio',
            'consultation_for_dental' => 'Consultation for Dental',
            default => ucfirst(str_replace('_', ' ', $this->service_type))
        };
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($appointment) {
            $appointment->generateAppointmentNumber();

            // إذا كان لا يزال الرقم فارغاً، استخدم طريقة بديلة
            if (empty($appointment->appointment_number)) {
                $appointment->appointment_number = 'APT' . now()->format('YmdHis') . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            }
        });

        static::created(function ($appointment) {
            $appointment->calculateFees();
        });
    }


    public function addReview($rating, $review = null)
    {
        $this->update([
            'rating' => $rating,
            'review' => $review,
            'reviewed_at' => now()
        ]);

        // تحديث تقييم الطبيب
        if ($this->doctor->doctorProfile) {
            $this->doctor->doctorProfile->updateRating($rating);
        }

        // تحديث تقييم المركز الطبي
        if ($this->medicalCenter) {
            $this->medicalCenter->updateRatingStats();
        }

        return $this;
    }



    public function getAppointmentDateAttribute()
    {
        return $this->scheduled_for ? $this->scheduled_for->format('Y-m-d') : null;
    }

    public function getAppointmentTimeAttribute()
    {
        return $this->scheduled_for ? $this->scheduled_for->format('H:i:s') : null;
    }




    public function getGoogleCalendarLink()
    {
        $startTime = $this->scheduled_for->format('Ymd\THis\Z');
        $endTime = $this->scheduled_for->addMinutes($this->duration ?? 30)->format('Ymd\THis\Z');

        $title = "موعد مع د. {$this->doctor->name}";
        $details = "موعد طبي مع د. {$this->doctor->name} - {$this->reason}";

        $params = [
            'action' => 'TEMPLATE',
            'text' => $title,
            'dates' => "{$startTime}/{$endTime}",
            'details' => $details,
            'location' => $this->medicalCenter->name ?? 'عيادة الطبيب',
        ];

        return 'https://calendar.google.com/calendar/render?' . http_build_query($params);
    }




    public function getStatusDisplayAttribute()
    {
        return match ($this->status) {
            'pending' => 'قيد الانتظار',
            'confirmed' => 'مؤكد',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي',
            default => $this->status
        };
    }
}
