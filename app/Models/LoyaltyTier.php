<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoyaltyTier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'level',
        'min_points_required',
        'min_monetary_value',
        'points_earning_rate',
        'points_expiry_days',
        'benefits',
        'perks',
        'requirements',
        'is_active',
        'priority',
        'badge_image',
        'badge_color',
    ];

    protected $casts = [
        'level' => 'integer',
        'min_points_required' => 'integer',
        'min_monetary_value' => 'integer',
        'points_earning_rate' => 'decimal:4',
        'points_expiry_days' => 'integer',
        'benefits' => 'array',
        'perks' => 'array',
        'requirements' => 'array',
        'is_active' => 'boolean',
        'priority' => 'integer',
    ];

    public function users()
    {
        return $this->hasMany(LoyaltyPoint::class);
    }
}
