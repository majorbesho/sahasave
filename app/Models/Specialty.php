<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialty extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'image',
        'icon',
        'color',
        'is_active',
        'is_featured',
        'order',
        'doctors_count',
        'consultations_count',
        'slug_ar',
        'slug_en',
        'meta_title_ar',
        'meta_title_en',
        'meta_description_ar',
        'meta_description_en',
        'parent_id',
        'level',
        'requirements',
        'skills'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'order' => 'integer',
        'doctors_count' => 'integer',
        'consultations_count' => 'integer',
        'level' => 'integer',
        'requirements' => 'array',
        'skills' => 'array'
    ];

    // العلاقات
    public function parent()
    {
        return $this->belongsTo(Specialty::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Specialty::class, 'parent_id')->orderBy('order');
    }

    public function activeChildren()
    {
        return $this->children()->where('is_active', true);
    }

    public function doctors()
    {
        return $this->hasMany(DoctorProfile::class, 'specialty_id');
    }

    public function activeDoctors()
    {
        return $this->doctors()->whereHas('doctor', function ($query) {
            $query->where('status', 'active');
        })->where('is_verified', true);
    }

    // الطرق المساعدة
    public function getNameAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->description_ar : $this->description_en;
    }

    public function getSlugAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->slug_ar : $this->slug_en;
    }

    public function getMetaTitleAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->meta_title_ar : $this->meta_title_en;
    }

    public function getMetaDescriptionAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->meta_description_ar : $this->meta_description_en;
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('assets/img/specialties/default.png');
    }

    public function getIconUrlAttribute()
    {
        if ($this->icon) {
            return asset('storage/' . $this->icon);
        }
        return asset('assets/img/specialties/default-icon.png');
    }

    public function isMainSpecialty()
    {
        return $this->level === 1;
    }

    public function isSubSpecialty()
    {
        return $this->level === 2;
    }

    public function isSuperSpecialty()
    {
        return $this->level === 3;
    }

    public function getFullPath()
    {
        $path = [];
        $current = $this;

        while ($current) {
            $path[] = $current->name;
            $current = $current->parent;
        }

        return implode(' → ', array_reverse($path));
    }

    // النطاقات
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeMain($query)
    {
        return $query->where('level', 1);
    }

    public function scopeSub($query)
    {
        return $query->where('level', 2);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name_' . app()->getLocale());
    }

    public function scopePopular($query)
    {
        return $query->orderBy('doctors_count', 'desc');
    }

    // الطرق الإحصائية
    public function updateDoctorsCount()
    {
        $this->update([
            'doctors_count' => $this->activeDoctors()->count()
        ]);
    }

    public function incrementConsultations()
    {
        $this->increment('consultations_count');
    }

    // التهيئة التلقائية
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($specialty) {
            // إنشاء slug تلقائي إذا لم يتم توفيره
            if (empty($specialty->slug_ar)) {
                $specialty->slug_ar = \Illuminate\Support\Str::slug($specialty->name_ar);
            }
            if (empty($specialty->slug_en)) {
                $specialty->slug_en = \Illuminate\Support\Str::slug($specialty->name_en);
            }
        });

        static::updated(function ($specialty) {
            // تحديث عدد الأطباء عند تغيير حالة التخصص
            if ($specialty->isDirty('is_active')) {
                $specialty->updateDoctorsCount();
            }
        });
    }
}
