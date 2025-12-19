<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'loyalty_point_id',
        'type',
        'amount',
        'balance_after',
        'source_type',
        'source_id',
        'description',
        'expiry_date',
        'metadata',
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
