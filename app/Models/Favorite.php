<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'patient_id',
        'doctor_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * علاقة المفضلة مع المريض
     */
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    /**
     * علاقة المفضلة مع الطبيب
     */
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id')
            ->where('role', 'doctor') // للتأكد أنه طبيب
            ->with('profile'); // جلب بيانات الطبيب الإضافية
    }

    /**
     * التحقق من وجود علاقة مفضلة
     */
    public static function isFavorite($patientId, $doctorId)
    {
        return static::where('patient_id', $patientId)
            ->where('doctor_id', $doctorId)
            ->exists();
    }

    /**
     * إضافة إلى المفضلة
     */
    public static function addToFavorite($patientId, $doctorId)
    {
        return static::create([
            'patient_id' => $patientId,
            'doctor_id' => $doctorId
        ]);
    }

    /**
     * إزالة من المفضلة
     */
    public static function removeFromFavorite($patientId, $doctorId)
    {
        return static::where('patient_id', $patientId)
            ->where('doctor_id', $doctorId)
            ->delete();
    }

    /**
     * تبديل حالة المفضلة
     */
    public static function toggleFavorite($patientId, $doctorId)
    {
        $existing = static::where('patient_id', $patientId)
            ->where('doctor_id', $doctorId)
            ->first();

        if ($existing) {
            $existing->delete();
            return false; // تم الإزالة
        } else {
            static::create([
                'patient_id' => $patientId,
                'doctor_id' => $doctorId
            ]);
            return true; // تم الإضافة
        }
    }

    /**
     * عدد المفضلات للمريض
     */
    public static function countByPatient($patientId)
    {
        return static::where('patient_id', $patientId)->count();
    }

    /**
     * الحصول على مفضلات المريض
     */
    public static function getPatientFavorites($patientId)
    {
        return static::where('patient_id', $patientId)
            ->with('doctor')
            ->get();
    }
}
