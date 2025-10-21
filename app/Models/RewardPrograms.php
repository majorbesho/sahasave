<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'program_type',
        'bonus_amount',
        'bonus_currency',
        'bonus_points',
        'min_referrals',
        'max_referrals_per_user',
        'eligibility_criteria',
        'start_date',
        'end_date',
        'is_active',
        'auto_apply',
        'conditions',
        'target_audience'
    ];

    protected $casts = [
        'bonus_amount' => 'decimal:2',
        'bonus_points' => 'integer',
        'min_referrals' => 'integer',
        'max_referrals_per_user' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
        'auto_apply' => 'boolean',
        'conditions' => 'array',
        'target_audience' => 'array',
    ];

    // العلاقات
    public function referrals()
    {
        return $this->hasMany(Referral::class);
    }

    public function rewards()
    {
        return $this->hasMany(Reward::class);
    }
}
