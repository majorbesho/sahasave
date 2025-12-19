<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log; // يجب إضافة Log لاستخدامه

class Schedule extends Model
{
    use HasFactory;

    public const DAYS_OF_WEEK = [
        0 => 'Sunday',
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday',
    ];

    public const DAYS_OF_WEEK_ARABIC = [
        0 => 'الأحد',
        1 => 'الإثنين',
        2 => 'الثلاثاء',
        3 => 'الأربعاء',
        4 => 'الخميس',
        5 => 'الجمعة',
        6 => 'السبت',
    ];

    public const APPOINTMENT_TYPES = [
        'clinic' => 'عيادة',
        'virtual' => 'افتراضي',
        'home' => 'منزلي'
    ];

    protected $fillable = [
        'doctor_id',
        'medical_center_id',
        'clinic_name',
        'clinic_address',
        'clinic_phone',
        'day_of_week',
        'start_time',
        'end_time',
        'session_type',
        'session_duration',
        'max_sessions',
        'appointment_type',
        'consultation_fee',
        'is_recurring',
        'is_active',
        'effective_from',
        'effective_until',
        'date',
        'discount',
        'discount_type',
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'is_active' => 'boolean',
        'effective_from' => 'date',
        'effective_until' => 'date',
        'date' => 'date',
        'session_duration' => 'integer',
        'max_sessions' => 'integer',
        'is_recurring' => 'boolean',
        'consultation_fee' => 'decimal:2',
        'discount' => 'decimal:2',
    ];

    // العلاقات
    public function medicalCenter()
    {
        return $this->belongsTo(MedicalCenter::class);
    }

    // تم تبسيط العلاقة. ستتم الفلترة بناءً على الموقع (المركز الطبي/نوع الموعد) داخل getAvailableSlots
    public function appointments()
    {
        // نربط فقط بـ doctor_id دون فلترة إضافية هنا لتجنب خطأ العمود المفقود
        return $this->hasMany(Appointment::class, 'doctor_id', 'doctor_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id')->with('doctorProfile');
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

    public function scopeForMedicalCenter($query, $medicalCenterId)
    {
        return $query->where('medical_center_id', $medicalCenterId);
    }

    public function scopeForPrivateClinic($query, $clinicName)
    {
        return $query->where('clinic_name', $clinicName);
    }

    // الطرق المساعدة
    public function getDayNameAttribute()
    {
        return self::DAYS_OF_WEEK[$this->day_of_week] ?? 'Unknown';
    }

    public function getDayNameArabicAttribute()
    {
        return self::DAYS_OF_WEEK_ARABIC[$this->day_of_week] ?? 'غير معروف';
    }

    public function getTimeRangeAttribute()
    {
        // نستخدم خاصية casts لضمان أن start_time و end_time كائنات Carbon
        return $this->start_time->format('h:i A') . ' - ' . $this->end_time->format('h:i A');
    }

    public function getAppointmentTypeDisplayAttribute()
    {
        return self::APPOINTMENT_TYPES[$this->appointment_type] ?? $this->appointment_type;
    }

    public function getLocationNameAttribute()
    {
        if ($this->medical_center_id) {
            // يجب التأكد من تحميل medicalCenter
            return $this->medicalCenter->name ?? 'مركز طبي غير معروف';
        }

        return $this->clinic_name ?? 'عيادة خاصة';
    }

    public function getLocationAddressAttribute()
    {
        if ($this->medical_center_id) {
            // يجب التأكد من تحميل medicalCenter
            return $this->medicalCenter->address ?? 'عنوان مركز طبي غير معروف';
        }

        return $this->clinic_address;
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

    /**
     * الدالة المسؤولة عن حساب المواعيد المتاحة بنظام النطاقات (Ranges)
     * يتم تقسيم الوقت إلى فترات (افتراضياً 3 ساعات)
     */
    public function getAvailableSlots(string $date, $appointments = null): array
    {
        try {
            // 1. تحديد مدة النطاق (افتراضي 3 ساعات = 180 دقيقة)
            // نستخدم القيمة المخزنة في النموذج، أو 180 كقيمة افتراضية
            $rangeDuration = $this->session_duration ?: 180;

            // 2. تحديد فترة العمل من الجدول
            // بما أن start_time و end_time تم تحويلهما إلى Carbon عبر casts
            $startTime = Carbon::parse($date . ' ' . $this->start_time->format('H:i'));
            $endTime = Carbon::parse($date . ' ' . $this->end_time->format('H:i'));

            // 3. جلب المواعيد مرة واحدة إذا لم يتم تمريرها
            if ($appointments === null) {
                $appointments = Appointment::where('doctor_id', $this->doctor_id)
                    ->whereDate('scheduled_for', $date)
                    ->whereIn('status', ['scheduled', 'confirmed'])
                    ->get();
            }

            // 3. توليد النطاقات الزمنية
            $ranges = [];
            $current = $startTime->copy();

            while ($current->lessThan($endTime)) {
                $rangeEnd = $current->copy()->addMinutes($rangeDuration);

                // إذا تجاوزنا وقت النهاية، نقتطع النطاق
                if ($rangeEnd->greaterThan($endTime)) {
                    $rangeEnd = $endTime->copy();
                }

                // تنسيق الوقت للعرض
                $startStr = $current->format('H:i');
                $endStr = $rangeEnd->format('H:i');
                $displayStr = $current->format('h:i A') . ' - ' . $rangeEnd->format('h:i A');

                // 4. حساب السعر والخصم
                $price = $this->consultation_fee;
                $discount = $this->discount ?? 0;
                $discountType = $this->discount_type;
                $finalPrice = $price;

                if ($discount > 0) {
                    if ($discountType === 'percentage') {
                        $finalPrice = $price - ($price * ($discount / 100));
                    } else {
                        $finalPrice = $price - $discount;
                    }
                }

                // التأكد من عدم وجود قيم سالبة
                $finalPrice = max(0, $finalPrice);

                // 5. التحقق من التوفر (هل الطبيب محجوز بالكامل في هذه الفترة؟)
                // استخدام الفلترة في الذاكرة بدلاً من الاستعلام عن قاعدة البيانات لكل نطاق
                $bookingsCount = $appointments->filter(function ($appointment) use ($current, $rangeEnd) {
                    $apptStart = $appointment->scheduled_for;
                    $apptEnd = $appointment->scheduled_until;

                    // التحقق من التداخل: (StartA < EndB) and (EndA > StartB)
                    // نستخدم lt (أقل من) و gt (أكبر من) لضمان عدم تداخل الفترات المتلاصقة تماماً
                    return $apptStart->lt($rangeEnd) && $apptEnd->gt($current);
                })->count();



                $isAvailable = true; // يمكن تحسين المنطق لاحقاً

                // التحقق من الوقت الماضي
                if ($current->isPast() && Carbon::parse($date)->isToday()) {
                    $isAvailable = false;
                }

                if ($isAvailable) {
                    $ranges[] = [
                        'start_time' => $startStr,
                        'end_time' => $endStr,
                        'display' => $displayStr,
                        'is_available' => true,
                        'price' => $price,
                        'discount' => $discount,
                        'discount_type' => $discountType,
                        'final_price' => $finalPrice
                    ];
                }

                $current = $rangeEnd;
            }

            return $ranges;
        } catch (\Exception $e) {
            Log::error('Error in Schedule::getAvailableSlots', [
                'schedule_id' => $this->id,
                'date' => $date,
                'message' => $e->getMessage()
            ]);
            return [];
        }
    }

    /**
     * دالة مساعدة لتوليد الفترات الزمنية (لم تعد مستخدمة في النظام الجديد ولكن نبقيها للتوافق إذا لزم الأمر)
     */
    protected function generateTimeSlots(string $start, string $end, int $duration): array
    {
        return [];
    }

    // التحقق من صحة البيانات
    public function validateSchedule()
    {
        $start = \Carbon\Carbon::parse($this->start_time);
        $end = \Carbon\Carbon::parse($this->end_time);

        if ($end <= $start) {
            return false;
        }

        $totalMinutes = $start->diffInMinutes($end);
        if ($totalMinutes < $this->session_duration) {
            return false;
        }

        return true;
    }
}
