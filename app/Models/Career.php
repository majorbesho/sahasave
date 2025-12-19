<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'requirements',
        'location',
        'type', // full-time, part-time, remote, etc.
        'department',
        'salary_range',
        'experience_level',
        'education_level',
        'skills',
        'benefits',
        'application_deadline',
        'is_active',
        'posted_by', // Admin ID
    ];

    protected $casts = [
        'skills' => 'array',
        'benefits' => 'array',
        'application_deadline' => 'date',
        'is_active' => 'boolean',
    ];

    // علاقة مع Admin الذي نشر الوظيفة
    public function postedBy()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    // علاقة مع طلبات التوظيف (إذا كان هناك نموذج CareerApplication)
    public function applications()
    {
        return $this->hasMany(CareerApplication::class);
    }
}