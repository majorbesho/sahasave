<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'medical_center_id',
        'day_of_week',
        'start_time',
        'end_time',
        'session_type',
        'session_duration',
        'max_sessions',
        'is_active',
        'effective_from',
        'effective_until'
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'is_active' => 'boolean',
        'effective_from' => 'date',
        'effective_until' => 'date',
        'session_duration' => 'integer',
        'max_sessions' => 'integer'
    ];

    // العلاقات
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function medicalCenter()
    {
        return $this->belongsTo(MedicalCenter::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id', 'doctor_id')
            ->where('medical_center_id', $this->medical_center_id);
    }

    // النطاقات
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForDoctor($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId);
    }

    public function scopeForDay($query, $dayOfWeek)
    {
        return $query->where('day_of_week', $dayOfWeek);
    }

    public function scopeAvailable($query)
    {
        $now = now();
        return $query->where(function ($q) use ($now) {
            $q->whereNull('effective_from')
                ->orWhere('effective_from', '<=', $now);
        })->where(function ($q) use ($now) {
            $q->whereNull('effective_until')
                ->orWhere('effective_until', '>=', $now);
        });
    }

    // الطرق المساعدة
    public function getDayNameAttribute()
    {
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        return $days[$this->day_of_week] ?? 'Unknown';
    }

    public function getDayNameArabicAttribute()
    {
        $days = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];
        return $days[$this->day_of_week] ?? 'غير معروف';
    }

    public function getTimeRangeAttribute()
    {
        return $this->start_time->format('h:i A') . ' - ' . $this->end_time->format('h:i A');
    }

    public function isAvailable()
    {
        if (!$this->is_active) {
            return false;
        }

        $now = now();
        if ($this->effective_from && $this->effective_from > $now) {
            return false;
        }

        if ($this->effective_until && $this->effective_until < $now) {
            return false;
        }

        return true;
    }

    public function getAvailableSlots($date)
    {
        $bookedSlots = $this->appointments()
            ->whereDate('scheduled_for', $date)
            ->whereIn('status', ['scheduled', 'confirmed'])
            ->pluck('scheduled_for')
            ->map(function ($datetime) {
                return $datetime->format('H:i');
            })
            ->toArray();

        $slots = [];
        $currentTime = \Carbon\Carbon::parse($this->start_time);
        $endTime = \Carbon\Carbon::parse($this->end_time);

        while ($currentTime < $endTime) {
            $slotTime = $currentTime->format('H:i');

            if (!in_array($slotTime, $bookedSlots)) {
                $slots[] = [
                    'time' => $slotTime,
                    'display' => $currentTime->format('h:i A'),
                    'is_available' => true
                ];
            } else {
                $slots[] = [
                    'time' => $slotTime,
                    'display' => $currentTime->format('h:i A'),
                    'is_available' => false
                ];
            }

            $currentTime->addMinutes($this->session_duration);
        }

        return $slots;
    }
}
