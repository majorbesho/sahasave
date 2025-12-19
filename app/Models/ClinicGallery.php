<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ClinicGallery extends Model
{
    use HasFactory;

    protected $table = 'clinic_galleries';

    protected $fillable = [
        'clinic_id',
        'image_path',
        'image_type',
        'caption',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'image_url',
    ];

    // العلاقات
    public function clinic()
    {
        return $this->belongsTo(DoctorClinic::class, 'clinic_id');
    }

    // النطاقات (Scopes)
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeGallery($query)
    {
        return $query->where('image_type', 'gallery');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    // Attributes
    public function getImageUrlAttribute()
    {
        return Storage::url($this->image_path);
    }

    public function getThumbnailUrlAttribute()
    {
        $path = str_replace('.', '_thumb.', $this->image_path);
        if (Storage::exists($path)) {
            return Storage::url($path);
        }
        return $this->image_url;
    }
}
