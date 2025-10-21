<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'status',
        'photo',
        'gender',
        'nationality',
        'date_of_birth',
        'address',
        'emergency_contact',
        'emergency_phone',
        'referral_code',
        'referred_by',
        'referral_count',
        'total_referral_earnings',
        'meta',
        'timezone',
        'language',
        'provider',
        'provider_id',
        'onesignal_device_id',
        'push_notifications',
        'email_notifications',
        'sms_notifications',





        'total_bonus_points',
        'available_bonus_points',
        'lifetime_savings',
        'total_cashback_earned',
        'referral_tier',
        'last_referral_at'

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'date_of_birth' => 'date',
        'meta' => 'array',
        'push_notifications' => 'boolean',
        'email_notifications' => 'boolean',
        'sms_notifications' => 'boolean',




        'total_referral_earnings' => 'decimal:2',
        'total_bonus_points' => 'integer',
        'available_bonus_points' => 'integer',
        'lifetime_savings' => 'decimal:2',
        'total_cashback_earned' => 'decimal:2',
        'last_referral_at' => 'datetime',
    ];

    // العلاقات الجديدة




    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'doctor_id')
            ->where('is_active', true)
            ->orderBy('day_of_week')
            ->orderBy('start_time');
    }

    public function activeSchedules()
    {
        return $this->schedules()->active()->available();
    }



    public function referralPrograms()
    {
        return $this->belongsToMany(RewardProgram::class, 'user_reward_programs')
            ->withPivot('joined_at', 'completed_referrals', 'earned_bonus')
            ->withTimestamps();
    }



    // إضافة هذه الطرق إلى نموذج User
    public function generateReferralCode()
    {
        if (!$this->referral_code) {
            $code = strtoupper(substr(md5(uniqid() . $this->id), 0, 8));
            $this->update(['referral_code' => $code]);
        }
        return $this->referral_code;
    }

    public function canEarnReferralBonus()
    {
        return $this->status === 'active' &&
            in_array($this->role, ['patient', 'doctor']);
    }

    public function getReferralTierBenefits()
    {
        $tiers = [
            'bronze' => ['discount' => 5, 'cashback' => 2],
            'silver' => ['discount' => 10, 'cashback' => 5],
            'gold' => ['discount' => 15, 'cashback' => 8],
            'platinum' => ['discount' => 20, 'cashback' => 12],
        ];

        return $tiers[$this->referral_tier] ?? $tiers['bronze'];
    }

    public function updateReferralTier()
    {
        $tier = 'bronze';
        if ($this->referral_count >= 20) {
            $tier = 'platinum';
        } elseif ($this->referral_count >= 10) {
            $tier = 'gold';
        } elseif ($this->referral_count >= 5) {
            $tier = 'silver';
        }

        if ($tier !== $this->referral_tier) {
            $this->update(['referral_tier' => $tier]);
        }
    }


    public function usedRewards()
    {
        return $this->hasMany(Reward::class)->whereNotNull('used_at');
    }

    public function activeRewardPrograms()
    {
        return $this->referralPrograms()
            ->where('is_active', true)
            ->where('end_date', '>', now());
    }

    public function medicalProfile()
    {
        return $this->hasOne(PatientMedicalProfile::class, 'patient_id');
    }

    public function doctorProfile()
    {
        return $this->hasOne(DoctorProfile::class, 'doctor_id');
    }





    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'patient_id');
    }


    public function medicalCenters()
    {
        return $this->belongsToMany(MedicalCenter::class, 'doctor_medical_center')
            ->withPivot(
                'employment_type',
                'working_days',
                'working_hours',
                'consultation_fee',
                'follow_up_fee',
                'specialty_id',
                'is_active',
                'status',
                'accepts_insurance',
                'accepted_insurances',
                'appointment_duration',
                'max_daily_appointments',
                'appointments_count',
                'average_rating',
                'is_approved',
                'approved_at',
                'approved_by',
                'notes'
            )
            ->withTimestamps();
    }
    public function favoriteDoctors()
    {
        return $this->belongsToMany(User::class, 'favorites', 'patient_id', 'doctor_id')
            ->where('role', 'doctor')
            ->withTimestamps();
    }

    public function activeRewards()
    {
        return $this->rewards()
            ->where('status', 'active')
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }

    public function upcomingAppointments()
    {
        return $this->patientAppointments()
            ->where('scheduled_for', '>', now())
            ->whereIn('status', ['scheduled', 'confirmed'])
            ->orderBy('scheduled_for', 'asc');
    }

    // تأكد من أن هذه العلاقات موجودة













    public function referralsMade()
    {
        return $this->hasMany(Referral::class, 'referrer_id');
    }

    public function referralsReceived()
    {
        return $this->hasMany(Referral::class, 'referred_id');
    }

    public function rewards()
    {
        return $this->hasMany(Reward::class);
    }

    public function doctorAppointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function patientAppointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    // النطاقات المساعدة
    public function scopeDoctors($query)
    {
        return $query->where('role', 'doctor');
    }

    public function scopePatients($query)
    {
        return $query->where('role', 'patient');
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // الطرق المساعدة - أضف طريقة isAdmin هنا
    public function isPatient(): bool
    {
        return $this->role === 'patient';
    }

    public function isDoctor(): bool
    {
        return $this->role === 'doctor';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isMedicalCenterAdmin(): bool
    {
        return $this->role === 'medical_center_admin';
    }

    public function hasMedicalProfile(): bool
    {
        return $this->medicalProfile !== null;
    }

    public function hasVerifiedProfile(): bool
    {
        if ($this->isDoctor()) {
            return $this->doctorProfile?->is_verified ?? false;
        }

        return true; // للمرضى والإداريين
    }

    public function getActiveRewards()
    {
        return $this->rewards()->where('status', 'active')
            ->where('expires_at', '>', now())
            ->get();
    }

    // العلاقات مع السجلات الطبية
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'patient_id');
    }

    public function createdMedicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'doctor_id');
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'patient_id');
    }

    public function createdPrescriptions()
    {
        return $this->hasMany(Prescription::class, 'doctor_id');
    }

    public function labOrders()
    {
        return $this->hasMany(LabOrder::class, 'patient_id');
    }

    public function requestedLabOrders()
    {
        return $this->hasMany(LabOrder::class, 'doctor_id');
    }
}
