<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalCenter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'email',
        'phone',
        'website',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'latitude',
        'longitude',
        'description',
        'services',
        'facilities',
        'insurance_providers',
        'working_hours',
        'specialties',
        'doctor_count',
        'average_rating',
        'rating_count',
        'is_verified',
        'is_featured',
        'status'
    ];

    protected $casts = [
        'services' => 'array',
        'facilities' => 'array',
        'insurance_providers' => 'array',
        'working_hours' => 'array',
        'specialties' => 'array',
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'average_rating' => 'decimal:2',
        'doctor_count' => 'integer',
        'rating_count' => 'integer',
    ];

    // العلاقات
    public function doctors()
    {
        return $this->belongsToMany(User::class, 'doctor_medical_center')
            ->withPivot(
                'employment_type',
                'working_days',
                'working_hours',
                'consultation_fee',
                'follow_up_fee',
                'specialty_id',
                'is_active',
                'status',
                'accepts_insurance',
                'accepted_insurances',
                'appointment_duration',
                'max_daily_appointments',
                'appointments_count',
                'average_rating',
                'is_approved',
                'approved_at',
                'approved_by',
                'notes'
            )
            ->withTimestamps();
    }
    public function labResults()
    {
        return $this->hasMany(LabResults::class);
    }


    public function admins()
    {
        // استخدام العلاقة المتعددة مع تصفية حسب الدور
        return $this->belongsToMany(User::class, 'doctor_medical_centers')
            ->wherePivot('employment_type', 'admin') // أو أي معيار آخر
            ->where('role', 'medical_center_admin')
            ->withPivot('employment_type', 'is_active')
            ->withTimestamps();
    }

    public function activeDoctors()
    {
        return $this->doctors()->wherePivot('is_active', true);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function ratings()
    {
        return $this->hasMany(Ratings::class, 'medical_center_id');
    }

    // في موديل MedicalCenter
    public function getServicesArrayAttribute()
    {
        if (is_array($this->services)) {
            return $this->services;
        }

        return json_decode($this->services, true) ?? [];
    }

    public function getFacilitiesArrayAttribute()
    {
        if (is_array($this->facilities)) {
            return $this->facilities;
        }

        return json_decode($this->facilities, true) ?? [];
    }

    public function getInsuranceProvidersArrayAttribute()
    {
        if (is_array($this->insurance_providers)) {
            return $this->insurance_providers;
        }

        return json_decode($this->insurance_providers, true) ?? [];
    }

    // النطاقات
    public function scopeClinics($query)
    {
        return $query->where('type', 'clinic');
    }


    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByCity($query, $city)
    {
        return $query->where('city', $city);
    }

    public function scopeBySpecialty($query, $specialty)
    {
        return $query->whereJsonContains('specialties', $specialty);
    }

    // الطرق المساعدة
    public function getWorkingHoursForDay($day)
    {
        return $this->working_hours[$day] ?? null;
    }

    public function isOpenNow()
    {
        $currentDay = strtolower(now()->format('l'));
        $currentTime = now()->format('H:i');

        $hours = $this->getWorkingHoursForDay($currentDay);

        if (!$hours || $hours['closed'] ?? false) {
            return false;
        }

        return $currentTime >= $hours['open'] && $currentTime <= $hours['close'];
    }

    public function updateDoctorCount()
    {
        $this->doctor_count = $this->activeDoctors()->count();
        $this->save();
    }

    public function updateRatingStats()
    {
        $this->rating_count = $this->ratings()->count();
        $this->average_rating = $this->ratings()->avg('rating') ?? 0;
        $this->save();
    }
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function labOrders()
    {
        return $this->hasMany(LabOrder::class, 'lab_center_id');
    }






    public function scopeVirtual($query)
    {
        return $query->where('is_virtual', true);
    }

    public function scopeAcceptsAppointments($query)
    {
        return $query->where('accepts_appointments', true);
    }

    public function scopeHospitals($query)
    {
        return $query->where('type', 'hospital');
    }
}
