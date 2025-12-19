<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DoctorAward extends Model
{
    use HasFactory;


    protected $table = 'doctor_awards';

    protected $fillable = [
        'doctor_id',
        'award_name',
        'organization',
        'year',
        'description',
        'award_image',
        'award_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'year' => 'integer',
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'award_image_url',
        'display_year',
    ];

    // العلاقات
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    // النطاقات (Scopes)
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByDoctor($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderByDesc('year');
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }

    // Attributes
    public function getDisplayYearAttribute()
    {
        return $this->year ?: 'N/A';
    }

    public function getAwardImageUrlAttribute()
    {
        if ($this->award_image) {
            return Storage::url($this->award_image);
        }
        return asset('frontend/xx/assets/img/award-default.png');
    }

    public function getDisplayTitleAttribute()
    {
        $title = $this->award_name;
        if ($this->organization) {
            $title .= " - {$this->organization}";
        }
        return $title;
    }
}
