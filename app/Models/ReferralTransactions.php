<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'referral_id',
        'user_id',
        'transaction_type',
        'amount',
        'currency',
        'points_earned',
        'status',
        'transaction_date',
        'notes',
        'metadata'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'points_earned' => 'integer',
        'transaction_date' => 'datetime',
        'metadata' => 'array',
    ];

    // العلاقات
    public function referral()
    {
        return $this->belongsTo(Referral::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
