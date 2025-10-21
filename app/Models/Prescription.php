<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_id',
        'patient_id',
        'doctor_id',
        'medication_name',
        'dosage',
        'frequency',
        'duration',
        'instructions',
        'quantity',
        'refills',
        'start_date',
        'end_date',
        'status',
        'pharmacy_notes'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'quantity' => 'integer',
        'refills' => 'integer',
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

    // النطاقات
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where('start_date', '<=', now())
            ->where(function ($q) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            });
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // الطرق المساعدة
    public function isActive()
    {
        return $this->status === 'active' &&
            $this->start_date <= now() &&
            (!$this->end_date || $this->end_date >= now());
    }

    public function getDurationInDays()
    {
        if (!$this->start_date || !$this->end_date) return null;
        return $this->start_date->diffInDays($this->end_date);
    }

    public function markAsCompleted()
    {
        $this->status = 'completed';
        $this->save();
    }
}
