<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reward_id',
        'user_id',
        'appointment_id',
        'transaction_type',
        'amount',
        'points',
        'currency',
        'status',
        'transaction_date',
        'notes',
        'metadata'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'points' => 'integer',
        'transaction_date' => 'datetime',
        'metadata' => 'array',
    ];

    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
