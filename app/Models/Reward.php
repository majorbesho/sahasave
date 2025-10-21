<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

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
        'code'

    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'max_discount_amount' => 'decimal:2',
        'cashback_amount' => 'decimal:2',
        'bonus_points' => 'integer',
        'expires_at' => 'datetime',
        'used_at' => 'datetime',
        'conditions' => 'array',
        'usage_limit' => 'integer',
        'used_count' => 'integer',
    ];

    // العلاقات
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

    public function appointmentUsage()
    {
        return $this->hasOne(Appointment::class, 'used_reward_id');
    }

    // النطاقات
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where(function ($q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }

    public function scopeCashback($query)
    {
        return $query->where('type', 'cashback');
    }

    public function scopeDiscount($query)
    {
        return $query->where('type', 'discount');
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'expired')
            ->orWhere(function ($q) {
                $q->where('status', 'active')
                    ->where('expires_at', '<', now());
            });
    }

    // الطرق المساعدة
    public function useReward()
    {
        if ($this->status !== 'active' || $this->isExpired()) {
            return false;
        }

        $this->status = 'used';
        $this->used_at = now();
        return $this->save();
    }

    public function isExpired()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function isValid()
    {
        return $this->status === 'active' && !$this->isExpired();
    }

    public function getFormattedAmountAttribute()
    {
        $symbols = [
            'cashback' => 'ر.س ',
            'discount' => '% ',
            'points' => ' نقطة',
        ];

        return ($symbols[$this->type] ?? '') . $this->amount;
    }

    public function generateRewardCode()
    {
        if (empty($this->reward_code)) {
            $this->reward_code = 'REW' . strtoupper(uniqid());
            $this->save();
        }
        return $this->reward_code;
    }
}
