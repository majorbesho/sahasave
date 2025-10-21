<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'referrer_id',
        'referred_id',
        'referral_code_used',
        'status',
        'condition_type',
        'condition_metadata',
        'referrer_reward',
        'referred_reward',
        'reward_type',
        'completed_at',
        'expires_at',

        'referral_type',
        'bonus_amount',
        'bonus_currency',
        'bonus_type',
        'max_bonus_uses',
        'conditions_met',
        'reward_program_id',
        'notes',
        'completed_steps'

    ];

    protected $casts = [
        'bonus_amount' => 'decimal:2',
        'expires_at' => 'datetime',
        'completed_at' => 'datetime',
        'conditions_met' => 'array',
        'completed_steps' => 'array',
    ];

    // العلاقات
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    public function referred()
    {
        return $this->belongsTo(User::class, 'referred_id');
    }

    public function rewards()
    {
        return $this->morphMany(Reward::class, 'source');
    }
    public function rewardProgram()
    {
        return $this->belongsTo(RewardProgram::class);
    }
    public function transactions()
    {
        return $this->hasMany(ReferralTransaction::class);
    }


    // النطاقات
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'expired')
            ->orWhere(function ($q) {
                $q->where('status', 'pending')
                    ->where('expires_at', '<', now());
            });
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where('expires_at', '>', now());
    }
    public function scopeByRewardProgram($query, $programId)
    {
        return $query->where('reward_program_id', $programId);
    }

    // الطرق المساعدة
    public function markAsCompleted()
    {
        $this->status = 'completed';
        $this->completed_at = now();
        $this->save();

        // منح المكافآت
        if ($this->referrer_reward > 0) {
            Reward::create([
                'user_id' => $this->referrer_id,
                'title' => 'مكافأة إحالة',
                'description' => "مكافأة لإحالة {$this->referred->name}",
                'type' => $this->reward_type,
                'amount' => $this->referrer_reward,
                'source_type' => self::class,
                'source_id' => $this->id,
                'expires_at' => now()->addMonths(6),
            ]);

            $this->referrer->addReferralEarnings($this->referrer_reward);
        }

        if ($this->referred_reward > 0) {
            Reward::create([
                'user_id' => $this->referred_id,
                'title' => 'مكافأة انضمام',
                'description' => 'مكافأة للانضمام عبر الإحالة',
                'type' => $this->reward_type,
                'amount' => $this->referred_reward,
                'source_type' => self::class,
                'source_id' => $this->id,
                'expires_at' => now()->addMonths(3),
            ]);
        }
    }

    public function isExpired()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function getConditionDescriptionAttribute()
    {
        $conditions = [
            'first_appointment' => 'حجز أول موعد',
            'profile_completion' => 'إكمال الملف الشخصي',
            'first_payment' => 'إتمام أول دفعة',
        ];

        return $conditions[$this->condition_type] ?? 'شرط غير محدد';
    }
}
