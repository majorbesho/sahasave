<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientMedicalProfile extends Model
{
    use HasFactory, SoftDeletes;

    // ==================== CONSTANTS ====================

    const BLOOD_TYPES = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];

    const ACTIVITY_LEVELS = [
        'sedentary' => 'قليل الحركة',
        'light' => 'نشاط خفيف',
        'moderate' => 'نشاط متوسط',
        'active' => 'نشط',
        'very_active' => 'نشط جداً'
    ];

    const SMOKING_STATUS = [
        'never' => 'لا يدخن',
        'former' => 'مدخن سابق',
        'current' => 'مدخن حالي',
        'occasional' => 'مدخن عرضي'
    ];

    const ALCOHOL_STATUS = [
        'never' => 'لا يتناول',
        'former' => 'سابقاً',
        'occasional' => 'أحياناً',
        'regular' => 'بانتظام'
    ];

    protected $fillable = [
        'patient_id',
        'height',
        'weight',
        'bmi',
        'blood_type',
        'rh_factor',
        'allergies',
        'chronic_diseases',
        'current_medications',
        'surgeries',
        'family_history',
        'smoking',
        'smoking_years',
        'smoking_per_day',
        'quit_smoking_date',
        'alcohol',
        'activity_level',
        'diet_type',
        'sleep_hours',
        'medical_notes',
        'special_needs',
        'disabilities',
        'mental_health_conditions',
        'vaccination_status',
        'last_checkup_date',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relation',
        'insurance_provider',
        'insurance_number',
        'insurance_expiry',
        'preferred_hospital',
        'preferred_pharmacy',
        'blood_pressure_systolic',
        'blood_pressure_diastolic',
        'heart_rate',
        'blood_sugar_level',
        'cholesterol_level',
        'is_pregnant',
        'pregnancy_due_date',
        'number_of_pregnancies',
        'pregnancy_complications',
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
        'disabilities' => 'array',
        'mental_health_conditions' => 'array',
        'vaccination_status' => 'array',
        'pregnancy_complications' => 'array',
        'smoking_years' => 'integer',
        'smoking_per_day' => 'integer',
        'sleep_hours' => 'decimal:1',
        'blood_pressure_systolic' => 'integer',
        'blood_pressure_diastolic' => 'integer',
        'heart_rate' => 'integer',
        'blood_sugar_level' => 'decimal:2',
        'cholesterol_level' => 'decimal:2',
        'is_pregnant' => 'boolean',
        'number_of_pregnancies' => 'integer',
        'quit_smoking_date' => 'date',
        'last_checkup_date' => 'date',
        'insurance_expiry' => 'date',
        'pregnancy_due_date' => 'date',
    ];

    protected $appends = [
        'bmi_category',
        'bmi_status_ar',
        'health_risk_level',
        'is_insurance_valid',
    ];

    // ==================== RELATIONSHIPS ====================

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }


    public function getBmiAttribute()
    {
        if ($this->height && $this->weight) {
            $heightInMeters = $this->height / 100;
            return round($this->weight / ($heightInMeters * $heightInMeters), 1);
        }
        return null;
    }



    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'patient_id', 'patient_id');
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'patient_id', 'patient_id');
    }

    public function labResults()
    {
        return $this->hasMany(LabResults::class, 'patient_id', 'patient_id');
    }

    public function vitalSigns()
    {
        return $this->hasMany(VitalSign::class, 'patient_id', 'patient_id');
    }

    public function vaccinations()
    {
        return $this->hasMany(Vaccinations::class, 'patient_id', 'patient_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id', 'patient_id');
    }

    public function allergyRecords()
    {
        return $this->hasMany(AllergyRecord::class, 'patient_id', 'patient_id');
    }

    public function chronicDiseaseRecords()
    {
        return $this->hasMany(ChronicDiseaseRecord::class, 'patient_id', 'patient_id');
    }

    // ==================== BMI CALCULATIONS ====================

    public function calculateBmi()
    {
        if ($this->height && $this->weight) {
            $heightInMeters = $this->height / 100;
            $this->bmi = round($this->weight / ($heightInMeters * $heightInMeters), 2);
            $this->save();
        }
        return $this->bmi;
    }

    public function getBmiCategoryAttribute()
    {
        if (!$this->bmi) return null;

        if ($this->bmi < 18.5) return 'underweight';
        if ($this->bmi < 25) return 'normal';
        if ($this->bmi < 30) return 'overweight';
        if ($this->bmi < 35) return 'obese_class_1';
        if ($this->bmi < 40) return 'obese_class_2';
        return 'obese_class_3';
    }

    public function getBmiStatusArAttribute()
    {
        $category = $this->bmi_category;

        $statuses = [
            'underweight' => 'نحافة',
            'normal' => 'وزن طبيعي',
            'overweight' => 'وزن زائد',
            'obese_class_1' => 'سمنة درجة أولى',
            'obese_class_2' => 'سمنة درجة ثانية',
            'obese_class_3' => 'سمنة مفرطة',
        ];

        return $statuses[$category] ?? 'غير محدد';
    }

    public function getIdealWeightRange()
    {
        if (!$this->height) return null;

        $heightInMeters = $this->height / 100;
        $minWeight = 18.5 * ($heightInMeters * $heightInMeters);
        $maxWeight = 24.9 * ($heightInMeters * $heightInMeters);

        return [
            'min' => round($minWeight, 1),
            'max' => round($maxWeight, 1),
        ];
    }

    // ==================== HEALTH RISK ASSESSMENT ====================

    public function getHealthRiskLevelAttribute()
    {
        $riskScore = 0;

        // BMI risk
        if ($this->bmi) {
            if ($this->bmi < 18.5 || $this->bmi > 30) $riskScore += 2;
            elseif ($this->bmi >= 25) $riskScore += 1;
        }

        // Smoking risk
        if ($this->smoking === 'current') $riskScore += 2;
        elseif ($this->smoking === 'occasional') $riskScore += 1;

        // Chronic diseases
        if (is_array($this->chronic_diseases) && count($this->chronic_diseases) > 0) {
            $riskScore += count($this->chronic_diseases);
        }

        // Blood pressure
        if ($this->blood_pressure_systolic > 140 || $this->blood_pressure_diastolic > 90) {
            $riskScore += 2;
        }

        // Activity level
        if ($this->activity_level === 'sedentary') $riskScore += 1;

        // Age (from patient)
        $age = $this->patient?->age ?? 0;
        if ($age > 60) $riskScore += 1;

        // Determine level
        if ($riskScore >= 6) return 'high';
        if ($riskScore >= 3) return 'moderate';
        return 'low';
    }

    public function getHealthRiskLevelArAttribute()
    {
        $levels = [
            'low' => 'منخفض',
            'moderate' => 'متوسط',
            'high' => 'عالي',
        ];

        return $levels[$this->health_risk_level] ?? 'غير محدد';
    }

    // ==================== LISTS & FORMATTING ====================

    public function getAllergiesListAttribute()
    {
        return $this->allergies && is_array($this->allergies)
            ? implode(', ', $this->allergies)
            : 'لا يوجد';
    }

    public function getChronicDiseasesListAttribute()
    {
        return $this->chronic_diseases && is_array($this->chronic_diseases)
            ? implode(', ', $this->chronic_diseases)
            : 'لا يوجد';
    }

    public function getCurrentMedicationsListAttribute()
    {
        return $this->current_medications && is_array($this->current_medications)
            ? implode(', ', $this->current_medications)
            : 'لا يوجد';
    }

    public function getBloodPressureAttribute()
    {
        if (!$this->blood_pressure_systolic || !$this->blood_pressure_diastolic) {
            return null;
        }

        return "{$this->blood_pressure_systolic}/{$this->blood_pressure_diastolic}";
    }

    public function getBloodPressureStatusAttribute()
    {
        if (!$this->blood_pressure_systolic || !$this->blood_pressure_diastolic) {
            return null;
        }

        $sys = $this->blood_pressure_systolic;
        $dia = $this->blood_pressure_diastolic;

        if ($sys < 120 && $dia < 80) return ['status' => 'normal', 'ar' => 'طبيعي'];
        if ($sys < 130 && $dia < 80) return ['status' => 'elevated', 'ar' => 'مرتفع قليلاً'];
        if ($sys < 140 || $dia < 90) return ['status' => 'stage_1', 'ar' => 'ارتفاع درجة أولى'];
        if ($sys >= 140 || $dia >= 90) return ['status' => 'stage_2', 'ar' => 'ارتفاع درجة ثانية'];
        return ['status' => 'crisis', 'ar' => 'حالة حرجة'];
    }

    // ==================== INSURANCE ====================

    public function getIsInsuranceValidAttribute()
    {
        if (!$this->insurance_number || !$this->insurance_expiry) {
            return false;
        }

        return $this->insurance_expiry->isFuture();
    }

    public function getInsuranceStatusAttribute()
    {
        if (!$this->insurance_number) {
            return ['status' => 'none', 'ar' => 'لا يوجد تأمين'];
        }

        if (!$this->insurance_expiry) {
            return ['status' => 'unknown', 'ar' => 'غير محدد'];
        }

        if ($this->insurance_expiry->isPast()) {
            return ['status' => 'expired', 'ar' => 'منتهي'];
        }

        if ($this->insurance_expiry->diffInDays() <= 30) {
            return ['status' => 'expiring_soon', 'ar' => 'ينتهي قريباً'];
        }

        return ['status' => 'active', 'ar' => 'ساري'];
    }

    // ==================== PREGNANCY ====================

    public function getPregnancyWeeksAttribute()
    {
        if (!$this->is_pregnant || !$this->pregnancy_due_date) {
            return null;
        }

        $conception = $this->pregnancy_due_date->copy()->subWeeks(40);
        return now()->diffInWeeks($conception);
    }

    public function getPregnancyTrimesterAttribute()
    {
        $weeks = $this->pregnancy_weeks;

        if (!$weeks) return null;
        if ($weeks <= 12) return 1;
        if ($weeks <= 26) return 2;
        return 3;
    }

    // ==================== SMOKING ====================

    public function getSmokingStatusArAttribute()
    {
        return self::SMOKING_STATUS[$this->smoking] ?? 'غير محدد';
    }

    public function getYearsSinceQuittingAttribute()
    {
        if (!$this->quit_smoking_date) return null;
        return now()->diffInYears($this->quit_smoking_date);
    }

    // ==================== VITAL SIGNS ====================

    public function updateVitalSigns($data)
    {
        $this->update([
            'blood_pressure_systolic' => $data['systolic'] ?? $this->blood_pressure_systolic,
            'blood_pressure_diastolic' => $data['diastolic'] ?? $this->blood_pressure_diastolic,
            'heart_rate' => $data['heart_rate'] ?? $this->heart_rate,
            'blood_sugar_level' => $data['blood_sugar'] ?? $this->blood_sugar_level,
            'weight' => $data['weight'] ?? $this->weight,
        ]);

        // إعادة حساب BMI
        if (isset($data['weight'])) {
            $this->calculateBmi();
        }

        // تسجيل في جدول VitalSigns
        VitalSign::create([
            'patient_id' => $this->patient_id,
            'systolic' => $data['systolic'] ?? null,
            'diastolic' => $data['diastolic'] ?? null,
            'heart_rate' => $data['heart_rate'] ?? null,
            'blood_sugar' => $data['blood_sugar'] ?? null,
            'weight' => $data['weight'] ?? null,
            'recorded_at' => now(),
        ]);
    }

    // ==================== HEALTH SUMMARY ====================

    public function getHealthSummary()
    {
        return [
            'basic_info' => [
                'height' => $this->height,
                'weight' => $this->weight,
                'bmi' => $this->bmi,
                'bmi_status' => $this->bmi_status_ar,
                'blood_type' => $this->blood_type,
            ],
            'vital_signs' => [
                'blood_pressure' => $this->blood_pressure,
                'bp_status' => $this->blood_pressure_status['ar'] ?? null,
                'heart_rate' => $this->heart_rate,
                'blood_sugar' => $this->blood_sugar_level,
            ],
            'lifestyle' => [
                'smoking' => $this->smoking_status_ar,
                'alcohol' => $this->alcohol,
                'activity_level' => $this->activity_level,
                'sleep_hours' => $this->sleep_hours,
            ],
            'medical_history' => [
                'allergies' => $this->allergies ?? [],
                'chronic_diseases' => $this->chronic_diseases ?? [],
                'current_medications' => $this->current_medications ?? [],
                'surgeries' => $this->surgeries ?? [],
            ],
            'risk_assessment' => [
                'level' => $this->health_risk_level,
                'level_ar' => $this->health_risk_level_ar,
            ],
            'insurance' => [
                'provider' => $this->insurance_provider,
                'status' => $this->insurance_status['ar'] ?? null,
                'is_valid' => $this->is_insurance_valid,
            ],
        ];
    }

    // ==================== VALIDATION ====================

    public function isProfileComplete()
    {
        $required = ['height', 'weight', 'blood_type'];

        foreach ($required as $field) {
            if (empty($this->$field)) {
                return false;
            }
        }

        return true;
    }

    public function getProfileCompletenessPercentage()
    {
        $fields = [
            'height',
            'weight',
            'blood_type',
            'allergies',
            'chronic_diseases',
            'current_medications',
            'smoking',
            'alcohol',
            'activity_level',
            'emergency_contact_name',
            'emergency_contact_phone'
        ];

        $filled = 0;
        foreach ($fields as $field) {
            if (!empty($this->$field)) {
                $filled++;
            }
        }

        return round(($filled / count($fields)) * 100);
    }

    // ==================== BOOT ====================

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($profile) {
            // حساب BMI تلقائياً
            if ($profile->height && $profile->weight) {
                $heightInMeters = $profile->height / 100;
                $profile->bmi = round($profile->weight / ($heightInMeters * $heightInMeters), 2);
            }
        });
    }
}
