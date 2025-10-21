<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;




    protected $fillable = [
        'name',
        'slug',
        'icon',
        'color',
        'description',
        'parent_id',
        'lft',
        'rgt',
        'depth',
        'doctors_count',
        'medical_centers_count',
        'services_count',
        'is_featured',
        'sort_order',
        'status',
        'meta_title',
        'meta_description'
    ];

    // العلاقات
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function doctors()
    {
        return $this->belongsToMany(User::class, 'category_doctor', 'category_id', 'doctor_id')
            ->where('role', 'doctor')
            ->where('status', 'active');
    }

    public function medicalCenters()
    {
        return $this->belongsToMany(MedicalCenter::class, 'category_medical_center');
    }

    // public function services()
    // {
    //     return $this->hasMany(Service::class);
    // }

    // النطاقات
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeMainCategories($query)
    {
        return $query->whereNull('parent_id');
    }

    // الطرق المساعدة
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getFullPathAttribute()
    {
        $path = [];
        $category = $this;

        while ($category) {
            $path[] = $category->name;
            $category = $category->parent;
        }

        return implode(' > ', array_reverse($path));
    }

    public function updateCounts()
    {
        $this->update([
            'doctors_count' => $this->doctors()->count(),
            'medical_centers_count' => $this->medicalCenters()->count(),
            'services_count' => $this->services()->count(),
        ]);
    }
}
