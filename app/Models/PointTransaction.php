<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loyalty_point_id',
        'transaction_code',
        'type',
        'points',
        'points_before',
        'points_after',
        'monetary_value',
        'status',
        'direction',
        'source_type',
        'source_id',
        'description',
        'metadata',
        'expires_at',
        'approved_at',
        'approved_by',
    ];

    protected $casts = [
        'expiry_date' => 'datetime',
        'metadata' => 'array',
    ];

    public function loyaltyPoint()
    {
        return $this->belongsTo(LoyaltyPoint::class);
    }

    public function source()
    {
        return $this->morphTo();
    }
}
