<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMedicalProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'height',
        'weight',
        'bmi',
        'blood_type',
        'allergies',
        'chronic_diseases',
        'current_medications',
        'surgeries',
        'family_history',
        'smoking',
        'alcohol',
        'activity_level',
        'medical_notes',
        'special_needs'
    ];

    protected $casts = [
        'height' => 'decimal:2',
        'weight' => 'decimal:2',
        'bmi' => 'decimal:2',
        'allergies' => 'array',
        'chronic_diseases' => 'array',
        'current_medications' => 'array',
        'surgeries' => 'array',
        'family_history' => 'array',
    ];

    // العلاقات
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'patient_id');
    }

    // الطرق المساعدة
    public function calculateBmi()
    {
        if ($this->height && $this->weight) {
            $heightInMeters = $this->height / 100;
            $this->bmi = $this->weight / ($heightInMeters * $heightInMeters);
        }
        return $this->bmi;
    }

    public function getBmiCategoryAttribute()
    {
        if (!$this->bmi) return null;

        if ($this->bmi < 18.5) return 'underweight';
        if ($this->bmi < 25) return 'normal';
        if ($this->bmi < 30) return 'overweight';
        return 'obese';
    }

    public function getAllergiesListAttribute()
    {
        return $this->allergies ? implode(', ', $this->allergies) : 'لا يوجد';
    }

    public function getChronicDiseasesListAttribute()
    {
        return $this->chronic_diseases ? implode(', ', $this->chronic_diseases) : 'لا يوجد';
    }
}
