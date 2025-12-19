<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoyaltyPoint extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'points',
        'available_points',
        'pending_points',
        'expired_points',
        'redeemed_points',
        'total_earned',
        'total_redeemed',
        'loyalty_tier',
        'points_value_rate',
        'tier_expires_at',
        'next_evaluation_date',
        'tier_benefits'
    ];

    protected $casts = [
        'points' => 'integer',
        'available_points' => 'integer',
        'pending_points' => 'integer',
        'expired_points' => 'integer',
        'redeemed_points' => 'integer',
        'total_earned' => 'integer',
        'total_redeemed' => 'integer',
        'points_value_rate' => 'decimal:4',
        'tier_benefits' => 'array',
        'tier_expires_at' => 'date',
        'next_evaluation_date' => 'date'
    ];

    // العلاقات
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pointTransactions()
    {
        return $this->hasMany(PointTransaction::class);
    }

    public function tier()
    {
        return $this->belongsTo(LoyaltyTier::class, 'loyalty_tier', 'code');
    }

    // النطاقات
    public function scopeByTier($query, $tier)
    {
        return $query->where('loyalty_tier', $tier);
    }

    // التوابع المساعدة
    public function getMonetaryValueAttribute()
    {
        return $this->available_points * $this->points_value_rate;
    }

    public function getTierProgressAttribute()
    {
        $nextTier = LoyaltyTier::where('level', '>', $this->tier->level ?? 0)
            ->orderBy('level')
            ->first();

        if (!$nextTier) {
            return 100; // أعلى مستوى
        }

        $current = $this->points;
        $required = $nextTier->min_points_required;

        return $required > 0 ? min(100, ($current / $required) * 100) : 0;
    }

    public function updateTier()
    {
        $newTier = LoyaltyTier::where('min_points_required', '<=', $this->points)
            ->where('is_active', true)
            ->orderBy('level', 'desc')
            ->first();

        if ($newTier && $newTier->code !== $this->loyalty_tier) {
            $this->update([
                'loyalty_tier' => $newTier->code,
                'tier_expires_at' => now()->addYear(),
                'tier_benefits' => $newTier->benefits
            ]);

            // إرسال إشعار ترقية
            event(new LoyaltyTierUpgraded($this->user, $newTier));
        }
    }
}
