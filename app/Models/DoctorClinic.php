<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DoctorClinic extends Model
{
    use HasFactory;

    protected $table = 'doctor_clinics';

    protected $fillable = [
        'doctor_id',
        'clinic_name',
        'clinic_logo',
        'location',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'latitude',
        'longitude',
        'phone',
        'email',
        'website',
        'description',
        'services',
        'amenities',
        'is_primary',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'is_active' => 'boolean',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    protected $appends = [
        'clinic_logo_url',
        'full_address',
        'gallery_images',
    ];

    // العلاقات
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function gallery()
    {
        return $this->hasMany(ClinicGallery::class, 'clinic_id')->ordered();
    }

    // النطاقات (Scopes)
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    public function scopeByDoctor($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('clinic_name');
    }

    public function scopeByLocation($query, $city = null, $state = null)
    {
        if ($city) {
            $query->where('city', $city);
        }
        if ($state) {
            $query->where('state', $state);
        }
        return $query;
    }

    // Attributes
    public function getClinicLogoUrlAttribute()
    {
        if ($this->clinic_logo) {
            if (filter_var($this->clinic_logo, FILTER_VALIDATE_URL)) {
                return $this->clinic_logo;
            }
            return Storage::url($this->clinic_logo);
        }
        return asset('frontend/xx/assets/img/clinic-default.png');
    }

    public function getFullAddressAttribute()
    {
        $parts = [];

        if ($this->address) {
            $parts[] = $this->address;
        }
        if ($this->city) {
            $parts[] = $this->city;
        }
        if ($this->state) {
            $parts[] = $this->state;
        }
        if ($this->postal_code) {
            $parts[] = $this->postal_code;
        }
        if ($this->country) {
            $parts[] = $this->country;
        }

        return implode(', ', $parts);
    }

    public function getGalleryImagesAttribute()
    {
        return $this->gallery->map(function ($image) {
            $url = $image->image_path;
            if ($url && !filter_var($url, FILTER_VALIDATE_URL)) {
                $url = Storage::url($url);
            }
            return [
                'id' => $image->id,
                'url' => $url,
                'caption' => $image->caption,
                'type' => $image->image_type,
            ];
        });
    }

    public function getServicesArrayAttribute()
    {
        return $this->services ? explode(',', $this->services) : [];
    }

    public function getAmenitiesArrayAttribute()
    {
        return $this->amenities ? explode(',', $this->amenities) : [];
    }

    public function getLocationForMapAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return "{$this->latitude},{$this->longitude}";
        }
        return null;
    }
}
