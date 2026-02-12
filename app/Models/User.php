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
        'city',
        'latitude',
        'longitude',
        'primary_clinic_id',
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

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'author_id');
    }

    // العلاقات الجديدة
    public function getDoctorSpecializationAttribute()
    {
        return $this->doctorProfile->specialization ?? 'General';
    }

    public function getSpecializationAttribute()
    {
        return $this->doctor_specialization;
    }

    public function getDoctorExperienceAttribute()
    {
        return $this->doctorProfile->years_of_experience ?? 0;
    }

    public function getDoctorRatingAttribute()
    {
        return $this->doctorProfile->average_rating ?? 4.5;
    }



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

    /**
     * Get masked name (e.g., "Bi****orge")
     */
    public function getMaskedNameAttribute()
    {
        $name = $this->name;
        if (!$name) return 'Unknown';

        $parts = explode(' ', $name);
        $maskedParts = array_map(function ($part) {
            $len = mb_strlen($part);
            if ($len <= 2) return $part;

            $show = floor($len / 3);
            if ($show < 1) $show = 1;

            $start = mb_substr($part, 0, $show);
            $end = mb_substr($part, -$show);
            $stars = str_repeat('*', $len - (2 * $show));

            return $start . $stars . $end;
        }, $parts);

        return implode(' ', $maskedParts);
    }

    public function canEarnReferralBonus()
    {
        return $this->status === 'active' &&
            in_array($this->role, ['patient', 'doctor']);
    }

    public function getPhotoUrlAttribute()
    {
        return $this->photoUrl();
    }

    public function photoUrl($default = null)
    {
        if (!$this->photo) {
            return $default ?: asset('frontend/xx/assets/img/doctors/doctor-thumb-01.jpg');
        }

        if (filter_var($this->photo, FILTER_VALIDATE_URL)) {
            return $this->photo;
        }

        return asset('storage/' . $this->photo);
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

    public function scopeSearch($query, $filters)
    {
        return $query->when(isset($filters['specialization']), function ($q) use ($filters) {
            $q->whereHas('doctorProfile', function ($q) use ($filters) {
                $q->whereIn('specialization', (array)$filters['specialization']);
            });
        })
            ->when(isset($filters['gender']), function ($q) use ($filters) {
                $q->whereIn('gender', (array)$filters['gender']);
            })
            ->when(isset($filters['price_min']), function ($q) use ($filters) {
                $q->whereHas('doctorProfile', function ($q) use ($filters) {
                    $q->where('consultation_fee', '>=', $filters['price_min']);
                });
            })
            ->when(isset($filters['price_max']), function ($q) use ($filters) {
                $q->whereHas('doctorProfile', function ($q) use ($filters) {
                    $q->where('consultation_fee', '<=', $filters['price_max']);
                });
            });
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


    // العلاقة مع المراكز الطبية (إذا كان الطبيب يعمل في عدة مراكز)
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
                'notes',
                'is_primary'
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

    /**
     * Recursive Referral Relationships (3 Levels)
     */

    // Level 1: Direct referrals
    public function referralsL1()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    // Level 2: Referrals of Level 1
    public function referralsL2()
    {
        return $this->hasManyThrough(User::class, User::class, 'referred_by', 'referred_by', 'id', 'id');
    }

    // Level 3: Referrals of Level 2
    // For 3 levels, it's easier to use nested relationships in Eloquent
    public function children()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function getReferralTree()
    {
        return $this->referralsL1()->with(['children.children'])->get();
    }

    public function rewards()
    {
        return $this->hasMany(Reward::class);
    }
    // في موديل User (App\Models\User)
    public function doctorAppointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function patientAppointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function appointments()
    {
        if ($this->isDoctor()) {
            return $this->doctorAppointments();
        }
        return $this->patientAppointments();
    }

    public function reviews()
    {
        if ($this->isDoctor()) {
            return $this->reviewsReceived();
        }
        return $this->reviewsGiven();
    }

    public function reviewsGiven()
    {
        return $this->hasMany(Review::class, 'patient_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'doctor_id')->where('status', 'approved');
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

    // نطاق للأطباء النشطين
    public function scopeActiveDoctors($query)
    {
        return $query->where('role', 'doctor')
            ->where('status', 'active')
            ->whereHas('doctorProfile', function ($q) {
                $q->where('is_verified', true);
            });
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

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles')
            ->withPivot('medical_center_id');
    }

    public function userRoles()
    {
        return $this->hasMany(UserRole::class);
    }

    // هل المستخدم له دور معين في مركز طبي محدد؟
    public function hasRoleInCenter(string $roleName, int $medicalCenterId): bool
    {
        return $this->userRoles()
            ->whereHas('role', fn($q) => $q->where('name', $roleName))
            ->where('medical_center_id', $medicalCenterId)
            ->exists();
    }

    // هل لديه صلاحية في مركز طبي محدد؟
    public function hasPermissionInCenter(string $permissionName, int $medicalCenterId): bool
    {
        // Admin عام يمر دايمًا
        if ($this->isAdmin()) {
            return true;
        }

        return $this->userRoles()
            ->where('medical_center_id', $medicalCenterId)
            ->whereHas('role.permissions', fn($q) => $q->where('name', $permissionName))
            ->exists();
    }

    // لإرجاع كل الصلاحيات في مركز معين (مفيد للـ frontend)
    public function getPermissionsForCenter(int $medicalCenterId): array
    {
        return $this->userRoles()
            ->where('medical_center_id', $medicalCenterId)
            ->with('role.permissions')
            ->get()
            ->pluck('role.permissions')
            ->flatten()
            ->pluck('name')
            ->unique()
            ->values()
            ->toArray();
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



    // علاقة المريض مع نتائج المختبر
    public function labResultsAsPatient()
    {
        return $this->hasMany(LabResults::class, 'patient_id');
    }

    // علاقة الطبيب مع نتائج المختبر التي طلبها
    public function labResultsOrdered()
    {
        return $this->hasMany(LabResults::class, 'ordered_by_doctor_id');
    }

    // علاقة الطبيب مع نتائج المختبر التي راجعها
    public function labResultsReviewed()
    {
        return $this->hasMany(LabResults::class, 'reviewed_by_doctor_id');
    }

    public function getLastAppointmentWithDoctor($doctorId)
    {
        return $this->patientAppointments()
            ->where('doctor_id', $doctorId)
            ->whereIn('status', ['completed', 'confirmed'])
            ->orderBy('scheduled_for', 'desc')
            ->first();
    }

    public function getAppointmentsCountWithDoctor($doctorId)
    {
        return $this->patientAppointments()
            ->where('doctor_id', $doctorId)
            ->whereIn('status', ['completed', 'confirmed'])
            ->count();
    }

    public function getAgeAttribute()
    {
        return $this->date_of_birth ? $this->date_of_birth->age : null;
    }

    // في نموذج User
    public function doctorServices()
    {
        return $this->hasMany(DoctorService::class, 'doctor_id');
    }

    public function doctorSocialMedia()
    {
        return $this->hasMany(DoctorSocialMedia::class, 'doctor_id');
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class, 'doctor_specialties', 'doctor_id', 'specialty_id')
            ->withPivot('is_primary', 'years_experience')
            ->withTimestamps();
    }

    public function primarySpecialty()
    {
        return $this->specialties()->wherePivot('is_primary', true)->first();
    }


    public function activeDoctors()
    {
        return $this->doctors()
            ->where('status', 'active')
            ->where('is_verified', true);
    }


    public function experiences()
    {
        return $this->hasMany(DoctorExperience::class, 'doctor_id')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('start_date');
    }

    public function activeExperiences()
    {
        return $this->experiences()->active();
    }

    public function educations()
    {
        return $this->hasMany(DoctorEducation::class, 'doctor_id')->ordered();
    }


    public function awards()
    {
        return $this->hasMany(DoctorAward::class, 'doctor_id')->ordered();
    }

    public function insurances()
    {
        return $this->hasMany(DoctorInsurance::class, 'doctor_id')->ordered();
    }



    public function clinics()
    {
        return $this->hasMany(DoctorClinic::class, 'doctor_id')->ordered();
    }

    // العلاقة مع العيادة الرئيسية (MedicalCenter)
    public function primaryClinic()
    {
        return $this->belongsTo(MedicalCenter::class, 'primary_clinic_id');
    }

    // العلاقة القديمة مع DoctorClinic
    public function primaryDoctorClinic()
    {
        return $this->hasOne(DoctorClinic::class, 'doctor_id')->where('is_primary', true);
    }












    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function defaultWallet()
    {
        return $this->hasOne(Wallet::class)->where('is_default', true);
    }

    public function walletTransactions()
    {
        return $this->hasManyThrough(WalletTransaction::class, Wallet::class);
    }

    // علاقات نقاط الولاء
    public function loyaltyPoints()
    {
        return $this->hasOne(LoyaltyPoint::class);
    }

    public function pointTransactions()
    {
        return $this->hasMany(PointTransaction::class);
    }

    public function pointRedemptions()
    {
        return $this->hasMany(PointRedemption::class);
    }

    public function activeVouchers()
    {
        return $this->belongsToMany(Voucher::class, 'voucher_user')
            ->withPivot('usage_count', 'last_used_at')
            ->where('is_active', true)
            ->where('valid_to', '>', now())
            ->where(function ($query) {
                $query->whereNull('usage_limit')
                    ->orWhereRaw('used_count < usage_limit');
            });
    }

    // توابع المحفظة
    public function getTotalWalletBalanceAttribute()
    {
        return $this->wallets()->active()->sum('balance');
    }

    public function getAvailableWalletBalanceAttribute()
    {
        return $this->wallets()->active()
            ->selectRaw('SUM(balance - hold_balance) as available')
            ->value('available') ?? 0;
    }

    public function createDefaultWallet()
    {
        if (!$this->defaultWallet) {
            $wallet = $this->wallets()->create([
                'type' => 'personal',
                'currency' => 'AED',
                'is_default' => true
            ]);

            $wallet->generateWalletNumber();
            $wallet->save();

            return $wallet;
        }

        return $this->defaultWallet;
    }

    // توابع نقاط الولاء
    public function getLoyaltyTierAttribute()
    {
        return $this->loyaltyPoints?->loyalty_tier ?? 'bronze';
    }

    public function getAvailablePointsAttribute()
    {
        return $this->loyaltyPoints?->available_points ?? 0;
    }

    public function getPointsMonetaryValueAttribute()
    {
        return $this->loyaltyPoints?->monetary_value ?? 0;
    }

    public function initializeLoyaltyPoints($grantWelcome = true)
    {
        if (!$this->loyaltyPoints) {
            $loyaltyPoints = LoyaltyPoint::create([
                'user_id' => $this->id,
                'points' => 0,
                'available_points' => 0,
                'total_earned' => 0,
                'points_value_rate' => LoyaltySetting::get('points_value_rate', 0.01),
                'next_evaluation_date' => now()->addMonth()
            ]);

            // تعيين المستوى الافتراضي
            $defaultTier = LoyaltyTier::where('level', 1)->first();
            if ($defaultTier) {
                $loyaltyPoints->update([
                    'loyalty_tier' => $defaultTier->code,
                    'tier_benefits' => $defaultTier->benefits
                ]);
            }

            // Sync relation locally to avoid recursive calls
            $this->setRelation('loyaltyPoints', $loyaltyPoints);
        } else {
            $loyaltyPoints = $this->loyaltyPoints;
        }

        // Grant welcome points if configured and not already granted
        if ($grantWelcome) {
            $welcomePoints = LoyaltySetting::get('loyalty_welcome_points', 0);
            if ($welcomePoints > 0 && !$this->pointTransactions()->where('type', 'welcome_bonus')->exists()) {
                $this->earnPoints($welcomePoints, 'welcome_bonus');
                $loyaltyPoints->refresh();
            }
        }

        return $loyaltyPoints;
    }

    public function earnPoints($points, $type, $source = null)
    {
        $loyaltyPoints = $this->initializeLoyaltyPoints(false);

        // تطبيق مضاعف المستوى
        $multiplier = $loyaltyPoints->tier?->points_earning_rate ?? 1.0;
        $actualPoints = $points * $multiplier;

        $transaction = PointTransaction::create([
            'user_id' => $this->id,
            'loyalty_point_id' => $loyaltyPoints->id,
            'transaction_code' => 'PT' . time() . strtoupper(substr(md5(uniqid()), 0, 8)),
            'type' => $type,
            'points' => $actualPoints,
            'points_before' => $loyaltyPoints->points,
            'points_after' => $loyaltyPoints->points + $actualPoints,
            'direction' => 'credit',
            'source_type' => $source ? get_class($source) : null,
            'source_id' => $source?->id,
            'status' => 'approved',
            'approved_at' => now(),
            'expires_at' => now()->addDays($loyaltyPoints->tier?->points_expiry_days ?? 365)
        ]);

        // تحديث نقاط الولاء
        $loyaltyPoints->increment('points', $actualPoints);
        $loyaltyPoints->increment('available_points', $actualPoints);
        $loyaltyPoints->increment('total_earned', $actualPoints);

        // تحديث المستوى إذا لزم الأمر
        $loyaltyPoints->updateTier();

        return $transaction;
    }

    // Dashboard Helpers
    public function getLoyaltyDashboardStats()
    {
        return [
            'current_points' => $this->available_points,
            'points_value' => $this->points_monetary_value,
            'current_tier' => $this->loyalty_tier,
            'next_tier' => $this->getNextTier(),
            'progress_to_next_tier' => $this->getTierProgressAttribute(),
            'points_expiring_soon' => $this->getExpiringPoints(30),
            'monthly_earnings' => $this->getMonthlyEarnings(),
            'redemption_history' => $this->getRecentRedemptions(),
            'active_offers' => $this->getActiveOffers(),
            'achievements' => $this->getRecentAchievements()
        ];
    }

    public function getNextTier()
    {
        $currentLevel = $this->loyaltyPoints->tier->level ?? 0;
        return LoyaltyTier::where('level', '>', $currentLevel)
            ->where('is_active', true)
            ->orderBy('level')
            ->first();
    }

    public function getMonthlyEarnings()
    {
        return PointTransaction::where('user_id', $this->id)
            ->where('direction', 'credit')
            ->where('status', 'approved')
            ->whereMonth('created_at', now()->month)
            ->sum('points');
    }

    public function getTierProgressAttribute()
    {
        $nextTier = $this->getNextTier();
        if (!$nextTier) return 100;

        $currentPoints = $this->loyaltyPoints->points ?? 0; // Cumulative points usually decide tier
        // Or if tier is based on points balance:
        // $currentPoints = $this->available_points;
        // Prompt implies progress.

        $target = $nextTier->min_points_required;
        if ($target <= 0) return 100;

        return min(100, round(($currentPoints / $target) * 100));
    }

    public function getExpiringPoints($days = 30)
    {
        return PointTransaction::where('user_id', $this->id)
            ->where('direction', 'credit')
            ->where('status', 'approved')
            ->whereBetween('expires_at', [now(), now()->addDays($days)])
            ->sum('points');
        // Note: Simplistic sum. In reality, you'd subtract used portions if fully tracked.
    }

    public function getRecentRedemptions($limit = 5)
    {
        return $this->pointRedemptions()
            ->orderByDesc('created_at')
            ->take($limit)
            ->get();
    }

    public function getActiveOffers()
    {
        // Example: Return available vouchers or programs
        // For now returning empty array or logic based on available vouchers
        return $this->activeVouchers;
    }

    public function getRecentAchievements()
    {
        // Placeholder for achievements logic
        return [];
    }





    public function medicalCenterAdmins()
    {
        return $this->hasMany(MedicalCenterAdmin::class);
    }

    public function isMedicalCenterAdmin(): bool
    {
        return $this->role === 'medical_center_admin' || $this->medicalCenterAdmins()->exists();
    }
}
