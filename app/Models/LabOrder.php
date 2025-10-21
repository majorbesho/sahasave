<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_id',
        'patient_id',
        'doctor_id',
        'lab_center_id',
        'test_name',
        'test_type',
        'instructions',
        'required_samples',
        'urgency_level',
        'results',
        'result_date',
        'status',
        'notes'
    ];

    protected $casts = [
        'required_samples' => 'array',
        'results' => 'array',
        'result_date' => 'datetime',
    ];

    // العلاقات
    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function labCenter()
    {
        return $this->belongsTo(MedicalCenter::class, 'lab_center_id');
    }

    // النطاقات
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeUrgent($query)
    {
        return $query->where('urgency_level', 'high');
    }

    // الطرق المساعدة
    public function addResult($testParameter, $value, $unit = null, $normalRange = null)
    {
        $results = $this->results ?? [];
        $results[$testParameter] = [
            'value' => $value,
            'unit' => $unit,
            'normal_range' => $normalRange,
            'timestamp' => now()
        ];
        $this->results = $results;
        $this->status = 'completed';
        $this->result_date = now();
        $this->save();
    }

    public function isAbnormal($testParameter = null)
    {
        if (!$this->results) return false;

        if ($testParameter) {
            return $this->checkParameterAbnormal($this->results[$testParameter] ?? null);
        }

        foreach ($this->results as $result) {
            if ($this->checkParameterAbnormal($result)) {
                return true;
            }
        }

        return false;
    }

    private function checkParameterAbnormal($result)
    {
        if (!$result || !isset($result['normal_range'])) return false;

        // منطق بسيط للتحقق من النتائج غير الطبيعية
        // يمكن تطوير هذا المنطق حسب احتياجاتك
        return false;
    }
}
