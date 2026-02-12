<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalCenter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'name_ar',
        'slug',
        'type',
        'email',
        'phone',
        'website',
        'license_number',
        'address',
        'address_ar',
        'city',
        'city_ar',
        'state',
        'state_ar',
        'country',
        'country_ar',
        'postal_code',
        'latitude',
        'longitude',
        'logo',
        'cover_image',
        'description',
        'description_ar',
        'services',
        'services_ar',
        'facilities',
        'facilities_ar',
        'insurance_providers',
        'insurance_providers_ar',
        'working_hours',
        'specialties',
        'doctor_count',
        'average_rating',
        'rating_count',
        'is_verified',
        'is_featured',
        'status',
        'is_active',
        'verified_at',
        'verified_by',
        'created_by',
    ];

    protected $casts = [
        'services' => 'array',
        'services_ar' => 'array',
        'facilities' => 'array',
        'facilities_ar' => 'array',
        'insurance_providers' => 'array',
        'insurance_providers_ar' => 'array',
        'working_hours' => 'array',
        'specialties' => 'array',
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'average_rating' => 'decimal:2',
        'doctor_count' => 'integer',
        'rating_count' => 'integer',
        'verified_at' => 'datetime',
    ];

    // العلاقات
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function doctors()
    {
        return $this->belongsToMany(User::class, 'doctor_medical_center', 'medical_center_id', 'user_id')
            ->wherePivot('is_active', true)
            ->withPivot([
                'employment_type',
                'working_days',
                'working_hours',
                'consultation_fee',
                'follow_up_fee',
                'specialty_id',
                'is_active',
                'status',
                'accepts_insurance',
                'accepted_insurances',
                'appointment_duration',
                'max_daily_appointments',
                'appointments_count',
                'average_rating',
                'is_approved',
                'approved_at',
                'approved_by',
                'notes',
                'is_primary'
            ])
            ->withTimestamps();
    }

    public function activeDoctors()
    {
        return $this->doctors()
            ->where('users.status', 'active')
            ->whereHas('doctorProfile', function ($query) {
                $query->where('is_verified', true);
            });
    }

    public function staff()
    {
        return $this->hasMany(UserRole::class, 'medical_center_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'medical_center_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'medical_center_id');
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function ratings()
    {
        return $this->hasMany(Ratings::class, 'medical_center_id');
    }

    // Accessors for localization
    public function getNameAttribute($value)
    {
        $name_ar = $this->attributes['name_ar'] ?? null;
        $name_en = $this->attributes['name'] ?? null;

        $primary = (app()->getLocale() === 'ar') ? $name_ar : $name_en;
        $secondary = (app()->getLocale() === 'ar') ? $name_en : $name_ar;

        $result = !empty($primary) ? $primary : $secondary;
        return $this->localizeItem($result);
    }

    public function getDescriptionAttribute($value)
    {
        if (app()->getLocale() === 'ar' && !empty($this->attributes['description_ar'])) {
            return $this->attributes['description_ar'];
        }
        return $value;
    }

    public function getAddressAttribute($value)
    {
        $address_ar = $this->attributes['address_ar'] ?? null;
        $address_en = $this->attributes['address'] ?? null;

        $primary = (app()->getLocale() === 'ar') ? $address_ar : $address_en;
        $secondary = (app()->getLocale() === 'ar') ? $address_en : $address_ar;

        $result = !empty($primary) ? $primary : $secondary;
        return $this->localizeItem($result);
    }

    public function getCityAttribute($value)
    {
        $city_ar = $this->attributes['city_ar'] ?? null;
        $city_en = $this->attributes['city'] ?? null;

        $primary = (app()->getLocale() === 'ar') ? $city_ar : $city_en;
        $secondary = (app()->getLocale() === 'ar') ? $city_en : $city_ar;

        $result = !empty($primary) ? $primary : $secondary;
        return $this->localizeItem($result);
    }

    public function getStateAttribute($value)
    {
        $state_ar = $this->attributes['state_ar'] ?? null;
        $state_en = $this->attributes['state'] ?? null;

        $primary = (app()->getLocale() === 'ar') ? $state_ar : $state_en;
        $secondary = (app()->getLocale() === 'ar') ? $state_en : $state_ar;

        $result = !empty($primary) ? $primary : $secondary;
        return $this->localizeItem($result);
    }

    public function getCountryAttribute($value)
    {
        $country_ar = $this->attributes['country_ar'] ?? null;
        $country_en = $this->attributes['country'] ?? null;

        $primary = (app()->getLocale() === 'ar') ? $country_ar : $country_en;
        $secondary = (app()->getLocale() === 'ar') ? $country_en : $country_ar;

        $result = !empty($primary) ? $primary : $secondary;
        return $this->localizeItem($result);
    }

    public function getTypeLocalizedAttribute()
    {
        $type = $this->type;
        return __('medical_centers.' . $type);
    }

    public function getServicesLocalizedAttribute()
    {
        $primary = (app()->getLocale() === 'ar') ? $this->services_ar : $this->services;
        $secondary = (app()->getLocale() === 'ar') ? $this->services : $this->services_ar;

        $value = !empty($primary) ? $primary : $secondary;
        return is_string($value) ? json_decode($value, true) : $value;
    }

    public function getFacilitiesLocalizedAttribute()
    {
        $primary = (app()->getLocale() === 'ar') ? $this->facilities_ar : $this->facilities;
        $secondary = (app()->getLocale() === 'ar') ? $this->facilities : $this->facilities_ar;

        $value = !empty($primary) ? $primary : $secondary;
        return is_string($value) ? json_decode($value, true) : $value;
    }

    public function getInsuranceProvidersLocalizedAttribute()
    {
        $primary = (app()->getLocale() === 'ar') ? $this->insurance_providers_ar : $this->insurance_providers;
        $secondary = (app()->getLocale() === 'ar') ? $this->insurance_providers : $this->insurance_providers_ar;

        $value = !empty($primary) ? $primary : $secondary;
        return is_string($value) ? json_decode($value, true) : $value;
    }

    // هل المركز مُوثّق؟
    public function isVerified(): bool
    {
        return $this->verified_at !== null || (isset($this->is_verified) && $this->is_verified);
    }

    // رابط الشعار
    public function getLogoUrlAttribute()
    {
        if (!$this->logo) {
            return asset('frontend/xx/assets/img/hospital.png');
        }

        if (filter_var($this->logo, FILTER_VALIDATE_URL)) {
            return $this->logo;
        }

        return asset('storage/' . $this->logo);
    }

    public function getCoverImageUrlAttribute()
    {
        if (!$this->cover_image) {
            return asset('assets/img/clinics/default-cover.png');
        }

        if (filter_var($this->cover_image, FILTER_VALIDATE_URL)) {
            return $this->cover_image;
        }

        return asset('storage/' . $this->cover_image);
    }

    // النطاقات والطرق المساعدة الموجودة مسبقاً
    public function scopeClinics($query)
    {
        return $query->where('type', 'clinic');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'active')->where('is_active', true);
    }

    public function updateRatingStats()
    {
        $this->rating_count = $this->ratings()->count();
        $this->average_rating = $this->ratings()->avg('rating') ?? 0;
        $this->save();
    }

    /**
     * Localize a service or facility item based on a pre-defined mapping.
     */
    public function localizeItem($item)
    {
        if (empty($item)) return '';

        $mapping = [
            'رعاية صحية متكاملة' => 'integrated_healthcare',
            'Integrated Healthcare' => 'integrated_healthcare',
            'طوارئ 24 ساعة' => 'emergency_24_hours',
            '24-hour Emergency' => 'emergency_24_hours',
            'عمليات' => 'surgery',
            'Surgery' => 'surgery',
            'أشعة' => 'radiology',
            'Radiology' => 'radiology',
            'مختبرات' => 'laboratories',
            'Laboratories' => 'laboratories',
            'مواقف سيارات' => 'parking',
            'Parking' => 'parking',
            'استقبال' => 'reception',
            'Reception' => 'reception',
            'صيدلية' => 'pharmacy',
            'Pharmacy' => 'pharmacy',
            'كافيتيريا' => 'cafeteria',
            'Cafeteria' => 'cafeteria',
            'مصلى' => 'prayer_room',
            'Prayer Room' => 'prayer_room',
            'استشارات متخصصة' => 'specialized_consultations',
            'Specialized Consultations' => 'specialized_consultations',
            'عمليات دقيقة' => 'precision_surgeries',
            'Precision Surgeries' => 'precision_surgeries',
            'رعاية قلبية' => 'cardiac_care',
            'Cardiac Care' => 'cardiac_care',
            'أورام' => 'oncology',
            'Oncology' => 'oncology',
            'أشعة متطورة' => 'advanced_radiology',
            'Advanced Radiology' => 'advanced_radiology',
            'إنترنت لاسلكي' => 'wi_fi',
            'Wi-Fi' => 'wi_fi',
            'تكييف' => 'air_conditioning',
            'Air Conditioning' => 'air_conditioning',
            'مطاعم' => 'restaurants',
            'Restaurants' => 'restaurants',
            'مقاهي' => 'cafes',
            'Cafes' => 'cafes',
            'مستشفى الشيخ خليفة' => 'sheikh_khalifa_hospital',
            'Sheikh Khalifa Hospital' => 'sheikh_khalifa_hospital',
            'مستشفى دبي' => 'dubai_hospital',
            'Dubai Hospital' => 'dubai_hospital',
            'مستشفى راشد' => 'rashid_hospital',
            'Rashid Hospital' => 'rashid_hospital',
            'مستشفى القاسمي' => 'al_qassimi_hospital',
            'Al Qassimi Hospital' => 'al_qassimi_hospital',
            'مستشفى صقر الحكومي' => 'saqr_hospital',
            'Saqr Hospital' => 'saqr_hospital',
            'أبو ظبي' => 'abu_dhabi',
            'Abu Dhabi' => 'abu_dhabi',
            'دبي' => 'dubai',
            'Dubai' => 'dubai',
            'الشارقة' => 'sharjah',
            'Sharjah' => 'sharjah',
            'عجمان' => 'ajman',
            'Ajman' => 'ajman',
            'أم القيوين' => 'umm_al_quwain',
            'Umm Al Quwain' => 'umm_al_quwain',
            'رأس الخيمة' => 'ras_al_khaimah',
            'Ras Al Khaimah' => 'ras_al_khaimah',
            'الفجيرة' => 'fujairah',
            'Fujairah' => 'fujairah',
        ];

        if (isset($mapping[$item])) {
            return __('medical_centers.' . $mapping[$item]);
        }

        // Robust fallback: slugify the item and try to find it in translations
        $slug = \Illuminate\Support\Str::slug($item, '_');
        if (\Illuminate\Support\Facades\Lang::has('medical_centers.' . $slug)) {
            return __('medical_centers.' . $slug);
        }

        return $item;
    }
}
