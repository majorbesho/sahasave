<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranslationJob extends Model
{
    protected $fillable = [
        'source_type',
        'source_id',
        'target_locales',
        'status',
        'priority',
        'job_data',
        'assigned_to',
    ];

    protected $casts = [
        'target_locales' => 'array',
        'job_data' => 'array',
    ];

    public function source()
    {
        return $this->morphTo();
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
