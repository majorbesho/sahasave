<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'medical_license_number',
        'specialty_id',
        'specialization',
        'license_document_path',
        'license_verified_at',
        'license_verified_by',
        'medical_school',
        'graduation_year',
        'qualifications',
        'certifications',
        'subspecialties',
        'years_of_experience',
        'work_experience',
        'current_hospital',
        'current_position',
        'bio',
        'treatment_approach',
        'total_consultations',
        'average_rating',
        'rating_count',
        'is_verified',
        'verification_status',
        'accepting_new_patients',
        'is_featured',
        'consultation_fee',
        'verification_notes',
        'verification_reviewed_at',
        'verified_by',
        'languages',
        'memberships'
    ];

    protected $casts = [
        'subspecialties' => 'array',
        'qualifications' => 'array',
        'certifications' => 'array',
        'work_experience' => 'array',
        'is_verified' => 'boolean',
        'accepting_new_patients' => 'boolean',
        'is_featured' => 'boolean',
        'average_rating' => 'decimal:2',
        'graduation_year' => 'integer',
        'years_of_experience' => 'integer',
        'total_consultations' => 'integer',
        'rating_count' => 'integer',
        'consultation_fee' => 'decimal:2',
        'license_verified_at' => 'datetime',
        'verification_reviewed_at' => 'datetime',


        'languages', // يمكن أن يكون نصًا أو JSON
        'awards',    // يمكن أن يكون نصًا أو JSON
        'memberships', // يمكن أن يكون نصًا أو JSON
        'recommendation_percentage', // نسبة التوصية
        'languages' => 'array',
        'awards' => 'array',
        'memberships' => 'array',
        'recommendation_percentage' => 'integer',

    ];

    // العلاقات
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }


    // دالة لمعالجة qualifications
    public function getQualificationsDisplayAttribute()
    {
        if (is_array($this->qualifications)) {
            return implode(', ', $this->qualifications);
        }

        return $this->qualifications ?? 'MBBS';
    }

    // دالة لمعالجة certifications
    public function getCertificationsDisplayAttribute()
    {
        if (is_array($this->certifications)) {
            return implode(', ', $this->certifications);
        }

        return $this->certifications ?? '';
    }

    // دالة لمعالجة subspecialties
    public function getSubspecialtiesDisplayAttribute()
    {
        if (is_array($this->subspecialties)) {
            return implode(', ', $this->subspecialties);
        }

        return $this->subspecialties ?? '';
    }

    // دالة للحصول على سنوات الخبرة
    public function getExperienceYearsAttribute()
    {
        return $this->years_of_experience ?? 0;
    }


    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'doctor_id');
    }

    public function availableSchedules()
    {
        return $this->schedules()->where('is_available', true);
    }

    // النطاقات
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopePendingVerification($query)
    {
        return $query->where('verification_status', 'pending_review');
    }

    public function scopeAcceptingPatients($query)
    {
        return $query->where('accepting_new_patients', true);
    }

    public function scopeBySpecialty($query, $specialtyId)
    {
        return $query->where('specialty_id', $specialtyId);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // الطرق المساعدة
    public function getSubspecialtiesListAttribute()
    {
        return $this->subspecialties ? implode(', ', $this->subspecialties) : null;
    }

    public function getQualificationsListAttribute()
    {
        return $this->qualifications ? implode(', ', $this->qualifications) : null;
    }

    public function getCertificationsListAttribute()
    {
        return $this->certifications ? implode(', ', $this->certifications) : null;
    }

    public function updateRating($newRating)
    {
        $totalRating = ($this->average_rating * $this->rating_count) + $newRating;
        $this->rating_count++;
        $this->average_rating = $totalRating / $this->rating_count;
        $this->save();
    }

    public function getExperienceLevelAttribute()
    {
        if ($this->years_of_experience < 2) return 'مبتدئ';
        if ($this->years_of_experience < 5) return 'متوسط';
        if ($this->years_of_experience < 10) return 'خبير';
        return 'خبير جداً';
    }

    public function canAcceptAppointments()
    {
        return $this->is_verified &&
            $this->accepting_new_patients &&
            $this->verification_status === 'verified';
    }

    public function approve()
    {
        $this->update([
            'is_verified' => true,
            'verification_status' => 'verified',
            'verification_reviewed_at' => now(),
        ]);

        // تحديث حالة المستخدم أيضاً
        $this->doctor->update(['status' => 'active']);
    }

    public function reject($notes = null)
    {
        $this->update([
            'is_verified' => false,
            'verification_status' => 'rejected',
            'verification_notes' => $notes,
            'verification_reviewed_at' => now(),
        ]);

        $this->doctor->update(['status' => 'rejected']);
    }






    // في نموذج DoctorProfile
    public function specialties()
    {
        return $this->belongsToMany(Specialty::class, 'doctor_specialties', 'doctor_id', 'specialty_id')
            ->withPivot('is_primary')
            ->withTimestamps();
    }

    public function services()
    {
        return $this->hasMany(DoctorService::class, 'doctor_id', 'doctor_id');
    }

    public function primarySpecialty()
    {
        return $this->specialties()->wherePivot('is_primary', true)->first();
    }
}
