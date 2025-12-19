<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DoctorExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'hospital_name',
        'title',
        'location',
        'employment_type',
        'description',
        'start_date',
        'end_date',
        'is_current',
        'years_of_experience',
        'hospital_logo',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'is_active' => 'boolean',
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

    public function scopeCurrent($query)
    {
        return $query->where('is_current', true);
    }

    public function scopeByDoctor($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderByDesc('start_date');
    }

    // الطرق المساعدة
    public function getDurationAttribute()
    {
        if ($this->is_current) {
            return date('M Y', strtotime($this->start_date)) . ' - Present';
        }

        if ($this->end_date) {
            return date('M Y', strtotime($this->start_date)) . ' - ' . date('M Y', strtotime($this->end_date));
        }

        return date('M Y', strtotime($this->start_date));
    }

    public function getHospitalLogoUrlAttribute()
    {
        if ($this->hospital_logo) {
            return Storage::url($this->hospital_logo);
        }
        return asset('assets/img/hospital-default.png');
    }

    public function getDisplayTitleAttribute()
    {
        return $this->title ?: 'Experience';
    }

    // حساب سنوات الخبرة التلقائي
    public static function calculateYears($startDate, $endDate = null)
    {
        $start = new \DateTime($startDate);
        $end = $endDate ? new \DateTime($endDate) : new \DateTime();

        $interval = $start->diff($end);
        return $interval->y;
    }
}
