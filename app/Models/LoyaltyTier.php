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
        'slug',
        'min_points',
        'max_points',
        'point_multiplier',
        'color',
        'icon',
        'description',
        'benefits',
        'priority',
        'is_active',
    ];

    protected $casts = [
        'point_multiplier' => 'decimal:2',
        'benefits' => 'array',
        'is_active' => 'boolean',
    ];

    public function users()
    {
        return $this->hasMany(LoyaltyPoint::class);
    }
}
