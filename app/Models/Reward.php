<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Reward extends Model
{
    use HasFactory, SoftDeletes;

    // ==================== CONSTANTS ====================

    const TYPE_CASHBACK = 'cashback';
    const TYPE_DISCOUNT = 'discount';
    const TYPE_BONUS_POINTS = 'bonus_points';
    const TYPE_FREE_CONSULTATION = 'free_consultation';
    const TYPE_VOUCHER = 'voucher';

    const STATUS_ACTIVE = 'active';
    const STATUS_USED = 'used';
    const STATUS_EXPIRED = 'expired';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_PENDING = 'pending';

    const DISCOUNT_PERCENTAGE = 'percentage';
    const DISCOUNT_FIXED = 'fixed';

    const SOURCE_REFERRAL = 'referral';
    const SOURCE_APPOINTMENT = 'appointment';
    const SOURCE_REWARD_PROGRAM = 'reward_program';
    const SOURCE_MANUAL = 'manual';
    const SOURCE_PROMOTIONAL = 'promotional';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'type',
        'amount',
        'currency',
        'status',
        'source_type',
        'source_id',
        'issued_at',
        'used_at',
        'expires_at',
        'referral_id',
        'reward_program_id',
        'discount_type',
        'discount_value',
        'min_consultation_value',
        'max_discount_amount',
        'cashback_amount',
        'cashback_currency',
        'bonus_points',
        'appointment_id',
        'conditions',
        'usage_limit',
        'used_count',
        'code',
        'metadata',
        'applicable_to',
        'excluded_doctors',
        'excluded_specialties',
        'is_stackable',
        'priority',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'discount_value' => 'decimal:2',
        'max_discount_amount' => 'decimal:2',
        'cashback_amount' => 'decimal:2',
        'min_consultation_value' => 'decimal:2',
        'bonus_points' => 'integer',
        'expires_at' => 'datetime',
        'used_at' => 'datetime',
        'issued_at' => 'datetime',
        'conditions' => 'array',
        'metadata' => 'array',
        'applicable_to' => 'array',
        'excluded_doctors' => 'array',
        'excluded_specialties' => 'array',
        'usage_limit' => 'integer',
        'used_count' => 'integer',
        'is_stackable' => 'boolean',
        'priority' => 'integer',
    ];

    protected $appends = [
        'formatted_amount',
        'is_valid',
        'is_expired',
        'days_until_expiry',
        'can_be_used',
    ];

    // ==================== RELATIONSHIPS ====================

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referral()
    {
        return $this->belongsTo(Referral::class);
    }

    public function rewardProgram()
    {
        return $this->belongsTo(RewardProgram::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function transactions()
    {
        return $this->hasMany(RewardTransaction::class);
    }

    public function source()
    {
        return $this->morphTo();
    }

    public function appointmentUsages()
    {
        return $this->hasMany(Appointment::class, 'used_reward_id');
    }

    public function lastUsedAppointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    // ==================== SCOPES ====================

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->where(function ($q) {
                $q->whereNull('usage_limit')
                    ->orWhereRaw('used_count < usage_limit');
            });
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeCashback($query)
    {
        return $query->where('type', self::TYPE_CASHBACK);
    }

    public function scopeDiscount($query)
    {
        return $query->where('type', self::TYPE_DISCOUNT);
    }

    public function scopeBonusPoints($query)
    {
        return $query->where('type', self::TYPE_BONUS_POINTS);
    }

    public function scopeExpired($query)
    {
        return $query->where(function ($q) {
            $q->where('status', self::STATUS_EXPIRED)
                ->orWhere(function ($sq) {
                    $sq->where('status', self::STATUS_ACTIVE)
                        ->whereNotNull('expires_at')
                        ->where('expires_at', '<', now());
                });
        });
    }

    public function scopeUsed($query)
    {
        return $query->where('status', self::STATUS_USED);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeExpiringIn($query, $days)
    {
        return $query->where('status', self::STATUS_ACTIVE)
            ->whereNotNull('expires_at')
            ->whereBetween('expires_at', [now(), now()->addDays($days)]);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeBySource($query, $source)
    {
        return $query->where('source_type', $source);
    }

    public function scopeApplicableToDoctor($query, $doctorId)
    {
        return $query->where(function ($q) use ($doctorId) {
            $q->whereNull('applicable_to')
                ->orWhereJsonContains('applicable_to', $doctorId);
        })->where(function ($q) use ($doctorId) {
            $q->whereNull('excluded_doctors')
                ->orWhereJsonDoesntContain('excluded_doctors', $doctorId);
        });
    }

    public function scopeApplicableToSpecialty($query, $specialtyId)
    {
        return $query->where(function ($q) use ($specialtyId) {
            $q->whereNull('excluded_specialties')
                ->orWhereJsonDoesntContain('excluded_specialties', $specialtyId);
        });
    }

    public function scopeStackable($query)
    {
        return $query->where('is_stackable', true);
    }

    public function scopeOrderByPriority($query)
    {
        return $query->orderBy('priority', 'desc')
            ->orderBy('discount_value', 'desc');
    }

    // ==================== ACCESSORS ====================

    public function getFormattedAmountAttribute()
    {
        switch ($this->type) {
            case self::TYPE_CASHBACK:
                return $this->cashback_amount . ' ' . ($this->cashback_currency ?? 'جنيه');

            case self::TYPE_DISCOUNT:
                if ($this->discount_type === self::DISCOUNT_PERCENTAGE) {
                    return $this->discount_value . '%';
                }
                return $this->discount_value . ' جنيه';

            case self::TYPE_BONUS_POINTS:
                return $this->bonus_points . ' نقطة';

            case self::TYPE_FREE_CONSULTATION:
                return 'كشف مجاني';

            default:
                return $this->amount . ' ' . ($this->currency ?? 'جنيه');
        }
    }

    public function getIsValidAttribute()
    {
        return $this->isValid();
    }

    public function getIsExpiredAttribute()
    {
        return $this->isExpired();
    }

    public function getDaysUntilExpiryAttribute()
    {
        if (!$this->expires_at) {
            return null;
        }

        $days = now()->diffInDays($this->expires_at, false);
        return $days > 0 ? (int)$days : 0;
    }

    public function getCanBeUsedAttribute()
    {
        return $this->canBeUsed();
    }

    public function getUsagePercentageAttribute()
    {
        if (!$this->usage_limit) {
            return 0;
        }

        return ($this->used_count / $this->usage_limit) * 100;
    }

    public function getRemainingUsesAttribute()
    {
        if (!$this->usage_limit) {
            return null;
        }

        return max(0, $this->usage_limit - $this->used_count);
    }

    // ==================== VALIDATION METHODS ====================

    public function isValid()
    {
        return $this->status === self::STATUS_ACTIVE
            && !$this->isExpired()
            && !$this->hasReachedUsageLimit();
    }

    public function isExpired()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function hasReachedUsageLimit()
    {
        if (!$this->usage_limit) {
            return false;
        }

        return $this->used_count >= $this->usage_limit;
    }

    public function canBeUsed()
    {
        return $this->isValid() && $this->status === self::STATUS_ACTIVE;
    }

    public function isApplicableToAppointment($appointmentAmount, $doctorId = null, $specialtyId = null)
    {
        // التحقق من الصلاحية
        if (!$this->isValid()) {
            return false;
        }

        // التحقق من الحد الأدنى للمبلغ
        if ($this->min_consultation_value && $appointmentAmount < $this->min_consultation_value) {
            return false;
        }

        // التحقق من الطبيب
        if ($doctorId && $this->excluded_doctors && in_array($doctorId, $this->excluded_doctors)) {
            return false;
        }

        if ($doctorId && $this->applicable_to && !in_array($doctorId, $this->applicable_to)) {
            return false;
        }

        // التحقق من التخصص
        if ($specialtyId && $this->excluded_specialties && in_array($specialtyId, $this->excluded_specialties)) {
            return false;
        }

        // التحقق من الشروط الإضافية
        if ($this->conditions) {
            return $this->validateConditions($appointmentAmount, $doctorId, $specialtyId);
        }

        return true;
    }

    protected function validateConditions($appointmentAmount, $doctorId, $specialtyId)
    {
        foreach ($this->conditions as $condition => $value) {
            switch ($condition) {
                case 'min_appointments':
                    $userAppointments = $this->user->patientAppointments()
                        ->where('status', 'completed')
                        ->count();
                    if ($userAppointments < $value) {
                        return false;
                    }
                    break;

                case 'first_appointment_only':
                    if ($value && $this->user->patientAppointments()->exists()) {
                        return false;
                    }
                    break;

                case 'specific_days':
                    if (!in_array(now()->dayOfWeek, $value)) {
                        return false;
                    }
                    break;

                case 'specific_hours':
                    $currentHour = now()->hour;
                    if ($currentHour < $value['start'] || $currentHour > $value['end']) {
                        return false;
                    }
                    break;
            }
        }

        return true;
    }

    // ==================== USAGE METHODS ====================

    public function use($appointmentId = null)
    {
        if (!$this->canBeUsed()) {
            return false;
        }

        $this->used_count++;
        $this->appointment_id = $appointmentId;

        // إذا وصل لحد الاستخدام، غير الحالة
        if ($this->usage_limit && $this->used_count >= $this->usage_limit) {
            $this->status = self::STATUS_USED;
            $this->used_at = now();
        }

        return $this->save();
    }

    public function cancel()
    {
        if ($this->status === self::STATUS_USED) {
            return false;
        }

        $this->status = self::STATUS_CANCELLED;
        return $this->save();
    }

    public function expire()
    {
        $this->status = self::STATUS_EXPIRED;
        return $this->save();
    }

    public function activate()
    {
        if ($this->isExpired()) {
            return false;
        }

        $this->status = self::STATUS_ACTIVE;
        return $this->save();
    }

    // ==================== CALCULATION METHODS ====================

    public function calculateDiscountAmount($originalAmount)
    {
        if ($this->type !== self::TYPE_DISCOUNT) {
            return 0;
        }

        $discount = 0;

        if ($this->discount_type === self::DISCOUNT_PERCENTAGE) {
            $discount = $originalAmount * ($this->discount_value / 100);
        } else {
            $discount = $this->discount_value;
        }

        // تطبيق الحد الأقصى للخصم
        if ($this->max_discount_amount) {
            $discount = min($discount, $this->max_discount_amount);
        }

        // التأكد من عدم تجاوز المبلغ الأصلي
        return min($discount, $originalAmount);
    }

    public function calculateCashback($appointmentAmount)
    {
        if ($this->type !== self::TYPE_CASHBACK) {
            return 0;
        }

        return $this->cashback_amount;
    }

    public function applyToAmount($amount)
    {
        switch ($this->type) {
            case self::TYPE_DISCOUNT:
                $discount = $this->calculateDiscountAmount($amount);
                return [
                    'original_amount' => $amount,
                    'discount' => $discount,
                    'final_amount' => $amount - $discount,
                ];

            case self::TYPE_CASHBACK:
                return [
                    'original_amount' => $amount,
                    'cashback' => $this->cashback_amount,
                    'final_amount' => $amount,
                ];

            case self::TYPE_FREE_CONSULTATION:
                return [
                    'original_amount' => $amount,
                    'discount' => $amount,
                    'final_amount' => 0,
                ];

            default:
                return [
                    'original_amount' => $amount,
                    'discount' => 0,
                    'final_amount' => $amount,
                ];
        }
    }

    // ==================== STATIC METHODS ====================

    public static function generateCode($prefix = 'RWD')
    {
        do {
            $code = $prefix . strtoupper(Str::random(8));
        } while (static::where('code', $code)->exists());

        return $code;
    }

    public static function createReferralReward($userId, $referralId, $amount)
    {
        return static::create([
            'user_id' => $userId,
            'title' => 'مكافأة إحالة',
            'description' => 'مكافأة لإحالة صديق بنجاح',
            'type' => self::TYPE_CASHBACK,
            'cashback_amount' => $amount,
            'cashback_currency' => 'جنيه',
            'status' => self::STATUS_ACTIVE,
            'source_type' => self::SOURCE_REFERRAL,
            'referral_id' => $referralId,
            'issued_at' => now(),
            'expires_at' => now()->addMonths(3),
            'code' => static::generateCode('REF'),
        ]);
    }

    public static function createAppointmentCashback($userId, $appointmentId, $amount)
    {
        return static::create([
            'user_id' => $userId,
            'title' => 'كاش باك على الموعد',
            'description' => 'استرجاع نقدي على موعدك الطبي',
            'type' => self::TYPE_CASHBACK,
            'cashback_amount' => $amount,
            'status' => self::STATUS_ACTIVE,
            'source_type' => self::SOURCE_APPOINTMENT,
            'appointment_id' => $appointmentId,
            'issued_at' => now(),
            'expires_at' => now()->addMonths(6),
            'code' => static::generateCode('APT'),
        ]);
    }

    public static function createDiscountVoucher($userId, $discountValue, $discountType = self::DISCOUNT_PERCENTAGE, $expiryDays = 30)
    {
        return static::create([
            'user_id' => $userId,
            'title' => 'قسيمة خصم',
            'description' => 'خصم خاص على موعدك القادم',
            'type' => self::TYPE_DISCOUNT,
            'discount_type' => $discountType,
            'discount_value' => $discountValue,
            'status' => self::STATUS_ACTIVE,
            'source_type' => self::SOURCE_PROMOTIONAL,
            'issued_at' => now(),
            'expires_at' => now()->addDays($expiryDays),
            'code' => static::generateCode('DSC'),
        ]);
    }

    // ==================== BOOT METHOD ====================

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($reward) {
            // توليد كود تلقائي
            if (empty($reward->code)) {
                $reward->code = static::generateCode();
            }

            // تعيين تاريخ الإصدار
            if (!$reward->issued_at) {
                $reward->issued_at = now();
            }

            // تعيين الحالة الافتراضية
            if (!$reward->status) {
                $reward->status = self::STATUS_ACTIVE;
            }

            // تعيين الأولوية
            if (is_null($reward->priority)) {
                $reward->priority = 1;
            }
        });

        // جدولة انتهاء الصلاحية
        static::saving(function ($reward) {
            if ($reward->isExpired() && $reward->status === self::STATUS_ACTIVE) {
                $reward->status = self::STATUS_EXPIRED;
            }
        });

        static::created(function ($reward) {
            // تسجيل في جدول المعاملات
            RewardTransaction::create([
                'reward_id' => $reward->id,
                'user_id' => $reward->user_id,
                'transaction_type' => 'reward_issuance',
                'amount' => $reward->amount ?? 0,
                'notes' => 'إصدار مكافأة جديدة',
                'status' => 'completed',
            ]);
        });
    }
}
