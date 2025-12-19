<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorService extends Model
{
    use HasFactory;


    protected $fillable = [
        'doctor_id',
        'specialty_id',
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'price',
        'duration',
        'is_active',
        'order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'duration' => 'integer',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    protected $appends = [
        'name',
        'description',
    ];

    // ==================== RELATIONSHIPS ====================

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function doctorProfile()
    {
        return $this->belongsTo(DoctorProfile::class, 'doctor_id', 'doctor_id');
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'service_id');
    }

    // ==================== ACCESSORS ====================

    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar'
            ? $this->attributes['name_ar'] ?? ''
            : $this->attributes['name_en'] ?? '';
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'ar'
            ? $this->attributes['description_ar'] ?? ''
            : $this->attributes['description_en'] ?? '';
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2) . ' ' . config('app.currency', 'USD');
    }

    public function getFormattedDurationAttribute()
    {
        return $this->duration . ' ' . __('minutes');
    }

    // ==================== SCOPES ====================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForDoctor($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId);
    }

    public function scopeForSpecialty($query, $specialtyId)
    {
        return $query->where('specialty_id', $specialtyId);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name_' . app()->getLocale());
    }

    // ==================== METHODS ====================

    public function canDelete()
    {
        return !$this->appointments()->exists();
    }

    public function duplicate()
    {
        $newService = $this->replicate();
        $newService->name_ar = $this->name_ar . ' - نسخة';
        $newService->name_en = $this->name_en . ' - Copy';
        $newService->save();

        return $newService;
    }
}
