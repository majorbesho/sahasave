<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TierHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'old_tier',
        'new_tier',
        'upgrade_reason',
        'performance_data',
        'bonus_awarded'
    ];

    protected $casts = [
        'performance_data' => 'array',
        'bonus_awarded' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
