<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'note',
        'notify_availability',
        'last_viewed_at',
        'views_count',
    ];

    protected $casts = [
        'notify_availability' => 'boolean',
        'last_viewed_at' => 'datetime',
        'views_count' => 'integer',
    ];

    // ==================== RELATIONSHIPS ====================

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function doctorProfile()
    {
        return $this->hasOneThrough(
            DoctorProfile::class,
            User::class,
            'id',           // FK on users
            'doctor_id',    // FK on doctor_profiles
            'doctor_id',    // Local key on favorites
            'id'            // Local key on users
        );
    }

    // ==================== SCOPES ====================

    public function scopeForPatient($query, $patientId)
    {
        return $query->where('patient_id', $patientId);
    }

    public function scopeForDoctor($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId);
    }

    public function scopeWithNotifications($query)
    {
        return $query->where('notify_availability', true);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function scopeMostViewed($query, $limit = 10)
    {
        return $query->orderBy('views_count', 'desc')
            ->limit($limit);
    }

    public function scopeOrderByRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeOrderByLastViewed($query)
    {
        return $query->orderBy('last_viewed_at', 'desc');
    }

    // ==================== HELPER METHODS ====================

    /**
     * تسجيل مشاهدة
     */
    public function recordView()
    {
        $this->increment('views_count');
        $this->update(['last_viewed_at' => now()]);
    }

    /**
     * التحقق من توفر الطبيب
     */
    public function isDoctorAvailable()
    {
        $doctor = $this->doctor;

        if (!$doctor || !$doctor->isDoctor()) {
            return false;
        }

        return $doctor->status === 'active' &&
            $doctor->doctorProfile?->is_verified === true;
    }

    /**
     * الحصول على معلومات الطبيب المفضل
     */
    public function getDoctorInfo()
    {
        $doctor = $this->doctor;
        $profile = $doctor?->doctorProfile;

        if (!$doctor || !$profile) {
            return null;
        }

        return [
            'id' => $doctor->id,
            'name' => $doctor->name,
            'photo' => $doctor->photo,
            'specialty' => $profile->specialty?->name,
            'rating' => $profile->average_rating,
            'reviews_count' => $profile->reviews_count,
            'consultation_fee' => $profile->consultation_fee,
            'is_available' => $this->isDoctorAvailable(),
            'next_available' => $profile->getNextAvailableSlot(),
        ];
    }

    /**
     * إرسال إشعار عند توفر الطبيب
     */
    public function notifyIfAvailable()
    {
        if (!$this->notify_availability) {
            return false;
        }

        if ($this->isDoctorAvailable()) {
            // يمكن إرسال إشعار هنا
            // $this->patient->notify(new DoctorAvailableNotification($this));
            return true;
        }

        return false;
    }

    // ==================== STATIC METHODS ====================

    /**
     * إضافة/إزالة من المفضلة (Toggle)
     */
    public static function toggle($patientId, $doctorId)
    {
        $favorite = static::where('patient_id', $patientId)
            ->where('doctor_id', $doctorId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return ['action' => 'removed', 'favorite' => null];
        }

        $favorite = static::create([
            'patient_id' => $patientId,
            'doctor_id' => $doctorId,
        ]);

        return ['action' => 'added', 'favorite' => $favorite];
    }

    /**
     * التحقق من وجود في المفضلة
     */
    public static function exists($patientId, $doctorId)
    {
        return static::where('patient_id', $patientId)
            ->where('doctor_id', $doctorId)
            ->exists();
    }

    /**
     * الحصول على عدد المفضلات لطبيب معين
     */
    public static function countForDoctor($doctorId)
    {
        return static::where('doctor_id', $doctorId)->count();
    }

    /**
     * الأطباء الأكثر إضافة للمفضلة
     */
    public static function mostFavorited($limit = 10)
    {
        return static::select('doctor_id', DB::raw('COUNT(*) as favorites_count'))
            ->groupBy('doctor_id')
            ->orderBy('favorites_count', 'desc')
            ->limit($limit)
            ->with('doctor.doctorProfile')
            ->get();
    }

    /**
     * الحصول على توصيات بناءً على المفضلات
     */
    public static function getRecommendations($patientId, $limit = 5)
    {
        // الحصول على تخصصات الأطباء المفضلين
        $favoriteSpecialties = static::where('patient_id', $patientId)
            ->with('doctor.doctorProfile.specialty')
            ->get()
            ->pluck('doctor.doctorProfile.specialty_id')
            ->unique()
            ->filter();

        if ($favoriteSpecialties->isEmpty()) {
            return collect();
        }

        // البحث عن أطباء في نفس التخصصات ليسوا في المفضلة
        $favoriteDoctorIds = static::where('patient_id', $patientId)
            ->pluck('doctor_id');

        return User::doctors()
            ->active()
            ->whereHas('doctorProfile', function ($q) use ($favoriteSpecialties) {
                $q->whereIn('specialty_id', $favoriteSpecialties)
                    ->where('is_verified', true);
            })
            ->whereNotIn('id', $favoriteDoctorIds)
            ->with('doctorProfile.specialty')
            ->limit($limit)
            ->get();
    }

    // ==================== BOOT METHOD ====================

    protected static function boot()
    {
        parent::boot();

        static::created(function ($favorite) {
            // يمكن إرسال إشعار للطبيب
            // $favorite->doctor->notify(new AddedToFavoritesNotification($favorite->patient));

            // تحديث عدد المفضلات في ملف الطبيب
            if ($favorite->doctor?->doctorProfile) {
                $favorite->doctor->doctorProfile->increment('favorites_count');
            }
        });

        static::deleted(function ($favorite) {
            // تحديث عدد المفضلات
            if ($favorite->doctor?->doctorProfile) {
                $favorite->doctor->doctorProfile->decrement('favorites_count');
            }
        });
    }

    // ==================== ACCESSORS ====================

    public function getIsFavoriteAttribute()
    {
        return true; // دائماً true لأنه موجود في الجدول
    }

    public function getAddedAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getLastViewedAgoAttribute()
    {
        return $this->last_viewed_at
            ? $this->last_viewed_at->diffForHumans()
            : null;
    }
}
