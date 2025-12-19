<?php

namespace App\Models;

use App\Models\Review; // إذا كان لديك نموذج Review
use Google\Service\AndroidPublisher\Resource\Reviews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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
        'skills',
        'average_consultation_fee',
        'min_consultation_fee',
        'max_consultation_fee',
        'average_rating',
        'total_reviews',
        'is_emergency_available',
        'keywords',
        'children_count',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_emergency_available' => 'boolean',
        'order' => 'integer',
        'doctors_count' => 'integer',
        'consultations_count' => 'integer',
        'children_count' => 'integer',
        'level' => 'integer',
        'requirements' => 'array',
        'skills' => 'array',
        'keywords' => 'array',
        'average_consultation_fee' => 'decimal:2',
        'min_consultation_fee' => 'decimal:2',
        'max_consultation_fee' => 'decimal:2',
        'average_rating' => 'decimal:1',
        'total_reviews' => 'integer',
    ];

    protected $appends = [
        'name',
        'description',
        'slug',
        'image_url',
        'icon_url',
        'full_path',
        'meta_title',
        'meta_description',
    ];

    // ==================== RELATIONSHIPS ====================

    public function parent()
    {
        return $this->belongsTo(Specialty::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Specialty::class, 'parent_id')
            ->orderBy('order')
            ->orderBy('name_' . app()->getLocale());
    }



    // public function getActiveDoctorsCountAttribute()
    // {
    //     return $this->doctors()
    //         ->where('status', 'active')
    //         ->whereHas('doctorProfile', function ($query) {
    //             $query->where('is_verified', true)
    //                 ->where('accepting_new_patients', true);
    //         })
    //         ->count();
    // }


    public function activeVerifiedDoctors()
    {
        return $this->doctors()
            ->whereHas('doctorProfile', function ($query) {
                $query->where('is_verified', true)
                    ->where('verification_status', 'verified')
                    ->where('accepting_new_patients', true);
            })
            ->where('status', 'active');
    }


    public function activeChildren()
    {
        return $this->children()->where('is_active', true);
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    public function activeDoctors()
    {
        return $this->doctors()
            ->where('status', 'active')
            ->whereHas('doctorProfile', function ($query) {
                $query->where('is_verified', true)
                    ->where('accepting_new_patients', true);
            });
    }



    public function doctorsThroughProfile()
    {
        return $this->hasManyThrough(
            User::class,
            DoctorProfile::class,
            'specialty_id', // Foreign key on DoctorProfile table
            'id',           // Foreign key on User table
            'id',           // Local key on Specialty table
            'doctor_id'     // Local key on DoctorProfile table
        )->where('users.status', 'active')
            ->where('doctor_profiles.is_verified', true)
            ->where('doctor_profiles.accepting_new_patients', true);
    }
    public function getActiveDoctorsCountAttribute()
    {
        return $this->doctorsThroughProfile()->count();
    }

    public function doctors()
    {
        return $this->belongsToMany(User::class, 'doctor_specialties', 'specialty_id', 'doctor_id')
            ->withPivot('is_primary', 'years_experience')
            ->withTimestamps();
    }




    public function verifiedDoctors()
    {
        return $this->activeDoctors();
    }

    public function appointments()
    {
        return $this->hasManyThrough(
            Appointment::class,
            DoctorProfile::class,
            'specialty_id',
            'doctor_id',
            'id',
            'doctor_id'
        );
    }



    // public function activeDoctors()
    // {
    //     return $this->doctors()
    //         ->whereHas('doctorProfile', function ($query) {
    //             $query->where('verification_status', 'verified')
    //                 ->where('accepting_new_patients', true);
    //         })
    //         ->where('status', 'active');
    // }


    // ==================== ACCESSORS (Laravel 8) ====================

    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar'
            ? $this->attributes['name_ar'] ?? ''
            : $this->attributes['name_en'] ?? '';
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'ar'
            ? $this->attributes['description_ar'] ?? ''
            : $this->attributes['description_en'] ?? '';
    }

    public function getSlugAttribute()
    {
        return app()->getLocale() === 'ar'
            ? $this->attributes['slug_ar'] ?? ''
            : $this->attributes['slug_en'] ?? '';
    }

    public function getImageUrlAttribute()
    {
        if (empty($this->attributes['image'])) {
            return asset('assets/img/specialties/default.png');
        }

        $image = $this->attributes['image'];

        if (Str::startsWith($image, ['http://', 'https://'])) {
            return $image;
        }

        return asset('storage/' . $image);
    }

    public function getIconUrlAttribute()
    {
        if (empty($this->attributes['icon'])) {
            return asset('assets/img/specialties/default-icon.png');
        }

        $icon = $this->attributes['icon'];

        if (Str::startsWith($icon, ['http://', 'https://'])) {
            return $icon;
        }

        return asset('storage/' . $icon);
    }

    public function getFullPathAttribute()
    {
        return $this->getFullPath();
    }

    public function getMetaTitleAttribute()
    {
        return app()->getLocale() === 'ar'
            ? $this->attributes['meta_title_ar'] ?? $this->name
            : $this->attributes['meta_title_en'] ?? $this->name;
    }

    public function getMetaDescriptionAttribute()
    {
        return app()->getLocale() === 'ar'
            ? $this->attributes['meta_description_ar'] ?? ''
            : $this->attributes['meta_description_en'] ?? '';
    }

    // ==================== HELPER METHODS ====================

    public function isMainSpecialty()
    {
        return $this->level === 1 || is_null($this->parent_id);
    }

    public function isSubSpecialty()
    {
        return $this->level === 2;
    }

    public function isSuperSpecialty()
    {
        return $this->level === 3;
    }

    public function hasChildren()
    {
        return $this->children()->exists();
    }

    public function getFullPath()
    {
        $path = [];
        $current = $this;

        while ($current) {
            $path[] = app()->getLocale() === 'ar'
                ? $current->attributes['name_ar']
                : $current->attributes['name_en'];
            $current = $current->parent;
        }

        return implode(' → ', array_reverse($path));
    }

    public function getBreadcrumbs()
    {
        $breadcrumbs = [];
        $current = $this;

        while ($current) {
            $breadcrumbs[] = [
                'id' => $current->id,
                'name' => app()->getLocale() === 'ar'
                    ? $current->attributes['name_ar']
                    : $current->attributes['name_en'],
                'slug' => app()->getLocale() === 'ar'
                    ? $current->attributes['slug_ar']
                    : $current->attributes['slug_en'],
            ];
            $current = $current->parent;
        }

        return array_reverse($breadcrumbs);
    }

    public function getAllChildrenIds()
    {
        $ids = [$this->id];

        foreach ($this->children as $child) {
            $ids = array_merge($ids, $child->getAllChildrenIds());
        }

        return $ids;
    }

    // ==================== STATISTICS METHODS ====================

    public function updateStatistics()
    {
        $activeDoctors = $this->activeDoctors;

        $this->update([
            'doctors_count' => $activeDoctors->count(),
            'average_consultation_fee' => $activeDoctors->avg('consultation_fee') ?? 0,
            'min_consultation_fee' => $activeDoctors->min('consultation_fee') ?? 0,
            'max_consultation_fee' => $activeDoctors->max('consultation_fee') ?? 0,
        ]);
    }


    public function incrementConsultations()
    {
        $this->increment('consultations_count');

        if ($this->parent) {
            $this->parent->incrementConsultations();
        }
    }

    public function getTotalConsultations()
    {
        $total = $this->consultations_count;

        foreach ($this->children as $child) {
            $total += $child->getTotalConsultations();
        }

        return $total;
    }

    public function getStats()
    {
        return [
            'doctors_count' => $this->doctors_count,
            'consultations_count' => $this->consultations_count,
            'average_fee' => $this->average_consultation_fee,
            'fee_range' => [
                'min' => $this->min_consultation_fee,
                'max' => $this->max_consultation_fee,
            ],

            'is_emergency_available' => $this->is_emergency_available,
        ];
    }

    // ==================== SCOPES ====================

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
        return $query->whereNull('parent_id');
    }

    public function scopeSub($query)
    {
        return $query->whereNotNull('parent_id');
    }

    public function scopeLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')
            ->orderBy('name_' . app()->getLocale());
    }

    public function scopePopular($query, $limit = null)
    {
        $query = $query->orderBy('consultations_count', 'desc')
            ->orderBy('doctors_count', 'desc');

        return $limit ? $query->limit($limit) : $query;
    }

    public function scopeTopRated($query, $limit = null)
    {
        $query = $query->where('average_rating', '>', 0)
            ->orderBy('average_rating', 'desc');

        return $limit ? $query->limit($limit) : $query;
    }

    public function scopeWithDoctors($query, $minDoctors = 1)
    {
        return $query->where('doctors_count', '>=', $minDoctors);
    }

    public function scopeEmergency($query)
    {
        return $query->where('is_emergency_available', true);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('name_ar', 'LIKE', "%{$term}%")
                ->orWhere('name_en', 'LIKE', "%{$term}%")
                ->orWhere('description_ar', 'LIKE', "%{$term}%")
                ->orWhere('description_en', 'LIKE', "%{$term}%");
        });
    }

    public function scopeWithAvailableDoctors($query)
    {
        return $query->whereHas('activeDoctors', function ($q) {
            $q->whereHas('schedules', function ($sq) {
                $sq->where('is_active', true)

                    ->where('day_of_week', '>=', now()->dayOfWeek);
            });
        });
    }

    // ==================== BOOT METHOD ====================

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($specialty) {
            if (is_null($specialty->level)) {
                $specialty->level = $specialty->parent_id
                    ? ($specialty->parent->level + 1)
                    : 1;
            }

            if (empty($specialty->slug_ar) && !empty($specialty->name_ar)) {
                $specialty->slug_ar = Str::slug($specialty->name_ar);
            }

            if (empty($specialty->slug_en) && !empty($specialty->name_en)) {
                $specialty->slug_en = Str::slug($specialty->name_en);
            }

            if (is_null($specialty->order)) {
                $maxOrder = static::where('parent_id', $specialty->parent_id)
                    ->max('order') ?? 0;
                $specialty->order = $maxOrder + 1;
            }

            if (empty($specialty->color)) {
                $colors = ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899'];
                $specialty->color = $colors[array_rand($colors)];
            }
        });

        static::created(function ($specialty) {
            if ($specialty->parent) {
                $specialty->parent->increment('children_count');
            }
        });

        static::updating(function ($specialty) {
            if ($specialty->isDirty('name_ar')) {
                $specialty->slug_ar = Str::slug($specialty->name_ar);
            }

            if ($specialty->isDirty('name_en')) {
                $specialty->slug_en = Str::slug($specialty->name_en);
            }
        });

        static::updated(function ($specialty) {
            if ($specialty->isDirty('is_active')) {
                $specialty->updateStatistics();
            }
        });

        static::deleted(function ($specialty) {
            static::where('parent_id', $specialty->parent_id)
                ->where('order', '>', $specialty->order)
                ->decrement('order');

            if ($specialty->parent) {
                $specialty->parent->decrement('children_count');
            }
        });
    }

    // ==================== ADDITIONAL HELPERS ====================

    public function canDelete()
    {
        return $this->doctors_count === 0 && !$this->hasChildren();
    }

    public function duplicate()
    {
        $newSpecialty = $this->replicate();
        $newSpecialty->slug_ar = $this->slug_ar . '-copy';
        $newSpecialty->slug_en = $this->slug_en . '-copy';
        $newSpecialty->is_active = false;
        $newSpecialty->save();

        return $newSpecialty;
    }

    public function toSearchResult()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'icon' => $this->icon_url,
            'doctors_count' => $this->doctors_count,
            'average_rating' => $this->average_rating,
            'type' => 'specialty',
        ];
    }
    // في نموذج Specialty
    public function doctorServices()
    {
        return $this->hasMany(DoctorService::class, 'specialty_id');
    }
}
