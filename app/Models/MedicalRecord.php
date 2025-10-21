<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_id',
        'medical_center_id',
        'record_type',
        'title',
        'description',
        'symptoms',
        'diagnosis',
        'treatment_plan',
        'prescriptions',
        'vital_signs',
        'lab_results',
        'imaging_results',
        'follow_up_instructions',
        'next_visit_date',
        'is_emergency',
        'confidentiality_level',
        'status'
    ];

    protected $casts = [
        'symptoms' => 'array',
        'prescriptions' => 'array',
        'vital_signs' => 'array',
        'lab_results' => 'array',
        'imaging_results' => 'array',
        'follow_up_instructions' => 'array',
        'is_emergency' => 'boolean',
        'next_visit_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // العلاقات
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function medicalCenter()
    {
        return $this->belongsTo(MedicalCenter::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function labOrders()
    {
        return $this->hasMany(LabOrder::class);
    }

    // النطاقات (Scopes)
    public function scopeForPatient($query, $patientId)
    {
        return $query->where('patient_id', $patientId);
    }

    public function scopeByDoctor($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId);
    }

    public function scopeEmergency($query)
    {
        return $query->where('is_emergency', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('record_type', $type);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function scopeWithLabResults($query)
    {
        return $query->whereNotNull('lab_results');
    }

    public function scopeWithPrescriptions($query)
    {
        return $query->whereNotNull('prescriptions');
    }

    // الطرق المساعدة
    public function getSymptomsListAttribute()
    {
        return $this->symptoms ? implode(', ', $this->symptoms) : 'لا توجد أعراض مسجلة';
    }

    public function getConfidentialityLevelTextAttribute()
    {
        $levels = [
            'low' => 'عادي',
            'medium' => 'متوسط',
            'high' => 'عالي',
            'critical' => 'سري'
        ];

        return $levels[$this->confidentiality_level] ?? 'غير محدد';
    }

    public function getRecordTypeTextAttribute()
    {
        $types = [
            'consultation' => 'استشارة',
            'follow_up' => 'متابعة',
            'emergency' => 'طوارئ',
            'surgery' => 'عملية جراحية',
            'lab_test' => 'فحص مخبري',
            'imaging' => 'تصوير',
            'vaccination' => 'تطعيم',
            'checkup' => 'فحص دوري'
        ];

        return $types[$this->record_type] ?? 'غير محدد';
    }

    public function getVitalSignsSummaryAttribute()
    {
        if (!$this->vital_signs) return null;

        $summary = [];
        $vitals = $this->vital_signs;

        if (isset($vitals['blood_pressure'])) {
            $summary[] = "ضغط الدم: {$vitals['blood_pressure']}";
        }
        if (isset($vitals['heart_rate'])) {
            $summary[] = "نبض: {$vitals['heart_rate']}";
        }
        if (isset($vitals['temperature'])) {
            $summary[] = "حرارة: {$vitals['temperature']}°C";
        }
        if (isset($vitals['oxygen_saturation'])) {
            $summary[] = "تشبع الأكسجين: {$vitals['oxygen_saturation']}%";
        }

        return implode(' | ', $summary);
    }

    public function canBeAccessedBy($user)
    {
        // المريض يمكنه رؤية سجلاته دائماً
        if ($user->id === $this->patient_id) {
            return true;
        }

        // الطبيب المعالج يمكنه رؤية السجل
        if ($user->id === $this->doctor_id) {
            return true;
        }

        // الأطباء في نفس المركز الطبي يمكنهم رؤية السجلات حسب مستوى السرية
        if ($user->isDoctor() && $user->medicalCenters->contains($this->medical_center_id)) {
            return $this->confidentiality_level !== 'critical';
        }

        // المسؤولون يمكنهم رؤية كل السجلات
        if ($user->isAdmin()) {
            return true;
        }

        return false;
    }

    public function addPrescription($medication)
    {
        $prescriptions = $this->prescriptions ?? [];
        $prescriptions[] = $medication;
        $this->prescriptions = $prescriptions;
        $this->save();
    }

    public function addLabResult($testName, $result)
    {
        $labResults = $this->lab_results ?? [];
        $labResults[$testName] = $result;
        $this->lab_results = $labResults;
        $this->save();
    }

    public function requiresFollowUp()
    {
        return !empty($this->follow_up_instructions) || $this->next_visit_date;
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function markAsCompleted()
    {
        $this->status = 'completed';
        $this->save();
    }

    // الأحداث
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($medicalRecord) {
            if (empty($medicalRecord->record_type)) {
                $medicalRecord->record_type = 'consultation';
            }
            if (empty($medicalRecord->confidentiality_level)) {
                $medicalRecord->confidentiality_level = 'medium';
            }
            if (empty($medicalRecord->status)) {
                $medicalRecord->status = 'draft';
            }
        });

        static::created(function ($medicalRecord) {
            // تحديث الملف الطبي للمريض إذا لزم الأمر
            if ($medicalRecord->diagnosis && $medicalRecord->patient->medicalProfile) {
                // يمكن إضافة المنطق هنا لتحديث الملف الطبي
            }
        });
    }
}
