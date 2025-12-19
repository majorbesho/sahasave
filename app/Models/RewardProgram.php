<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RewardProgram extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'type',
        'target_audience',
        'reward_structure',
        'points_reward',
        'cash_bonus',
        'start_date',
        'end_date',
        'is_active',
        'conditions',
        // Merged from RewardPrograms.php
        'description',
        'program_type',
        'bonus_amount',
        'bonus_currency',
        'bonus_points',
        'min_referrals',
        'max_referrals_per_user',
        'eligibility_criteria',
        'auto_apply',
    ];

    protected $casts = [
        'reward_structure' => 'array',
        'conditions' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
        'points_reward' => 'integer',
        'cash_bonus' => 'decimal:2',
        // Merged casts
        'bonus_amount' => 'decimal:2',
        'bonus_points' => 'integer',
        'min_referrals' => 'integer',
        'max_referrals_per_user' => 'integer',
        'auto_apply' => 'boolean',
        'target_audience' => 'array',
    ];

    protected $dates = ['deleted_at'];

    // Relationships from RewardPrograms.php
    public function referrals()
    {
        return $this->hasMany(Referral::class);
    }

    public function rewards()
    {
        return $this->hasMany(Reward::class);
    }
}
