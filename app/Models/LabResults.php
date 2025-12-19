<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LabResults extends Model
{
    use HasFactory;

    use HasFactory, SoftDeletes;

    // ==================== CONSTANTS ====================
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_REVIEWED = 'reviewed';
    const STATUS_CANCELED = 'canceled';

    const STATUSES = [
        self::STATUS_PENDING => 'قيد الانتظار',
        self::STATUS_COMPLETED => 'مكتمل',
        self::STATUS_REVIEWED => 'تمت المراجعة',
        self::STATUS_CANCELED => 'ملغي',
    ];

    protected $fillable = [
        'patient_id',
        'ordered_by_doctor_id',
        'clinic_id',
        'lab_provider_id',
        'report_title',
        'report_code',
        'external_report_id',
        'order_date',
        'result_date',
        'status',
        'overall_notes',
        'attachment_path',
        'is_abnormal_overall',
        'reviewed_by_doctor_id',
        'reviewed_at',
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'result_date' => 'datetime',
        'is_abnormal_overall' => 'boolean',
        'reviewed_at' => 'datetime',
    ];

    // ==================== RELATIONSHIPS ====================

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function orderedByDoctor()
    {
        return $this->belongsTo(User::class, 'ordered_by_doctor_id');
    }

    public function reviewedByDoctor()
    {
        return $this->belongsTo(User::class, 'reviewed_by_doctor_id');
    }

    public function clinic()
    {
        // افترض أن لديك نموذج Clinic
        return $this->belongsTo(MedicalCenter::class);
    }

    // public function labProvider()
    // {
    //     // افترض أن لديك نموذج LabProvider
    //     return $this->belongsTo(LabProvider::class);
    // }

    public function details()
    {
        return $this->hasMany(LabResultDetail::class);
    }

    // ==================== ACCESSORS & MUTATORS ====================

    public function getStatusArAttribute()
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    // ==================== HELPERS ====================

    public function addDetail(array $data)
    {
        return $this->details()->create($data);
    }

    public function getSpecificTestResult(string $testName)
    {
        return $this->details()->where('test_name', $testName)->first();
    }





    public function labResults()
    {
        // هذا يربط PatientMedicalProfile بنتائج المختبر الخاصة بالمريض المرتبط بهذا الملف
        return $this->hasMany(LabResults::class, 'patient_id', 'patient_id');
    }
}
