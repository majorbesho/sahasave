<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'type',
        'discount_type',
        'discount_value',
        'points_required',
        'minimum_purchase',
        'maximum_discount',
        'valid_from',
        'valid_to',
        'usage_limit',
        'used_count',
        'user_usage_limit',
        'is_active',
        'is_redeemable',
        'applicable_services',
        'restrictions',
        'terms_conditions',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'minimum_purchase' => 'decimal:2',
        'maximum_discount' => 'decimal:2',
        'valid_from' => 'date',
        'valid_to' => 'date',
        'is_active' => 'boolean',
        'is_redeemable' => 'boolean',
        'applicable_services' => 'array',
        'restrictions' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function redemptions()
    {
        return $this->hasMany(PointRedemption::class);
    }

    public function isValid()
    {
        if (!$this->is_active) return false;
        if (now()->format('Y-m-d') < $this->valid_from->format('Y-m-d')) return false; // Check start date
        if (now()->format('Y-m-d') > $this->valid_to->format('Y-m-d')) return false; // Check end date
        if ($this->usage_limit && $this->used_count >= $this->usage_limit) return false;

        return true;
    }
}
