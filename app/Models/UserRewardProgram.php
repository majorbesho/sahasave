<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRewardProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reward_program_id',
        'joined_at',
        'completed_referrals',
        'earned_bonus',
        'status'
    ];

    protected $casts = [
        'joined_at' => 'datetime',
        'completed_referrals' => 'integer',
        'earned_bonus' => 'decimal:2',
    ];

    // العلاقات
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rewardProgram()
    {
        return $this->belongsTo(RewardProgram::class);
    }
}
