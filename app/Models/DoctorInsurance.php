<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DoctorInsurance extends Model
{
    use HasFactory;

    protected $table = 'doctor_insurances';

    protected $fillable = [
        'doctor_id',
        'insurance_name',
        'insurance_company',
        'policy_number',
        'coverage_start_date',
        'coverage_end_date',
        'is_active',
        'coverage_details',
        'terms_and_conditions',
        'insurance_logo',
        'contact_number',
        'website_url',
        'sort_order',
    ];

    protected $casts = [
        'coverage_start_date' => 'date',
        'coverage_end_date' => 'date',
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'insurance_logo_url',
        'coverage_period',
        'is_current',
    ];

    // العلاقات
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    // النطاقات (Scopes)
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCurrent($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('coverage_end_date')
                ->orWhere('coverage_end_date', '>=', now());
        });
    }

    public function scopeExpired($query)
    {
        return $query->where('coverage_end_date', '<', now());
    }

    public function scopeByDoctor($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('insurance_name');
    }

    // Attributes
    public function getInsuranceLogoUrlAttribute()
    {
        if ($this->insurance_logo) {
            return Storage::url($this->insurance_logo);
        }
        return asset('frontend/xx/assets/img/insurance-default.png');
    }

    public function getCoveragePeriodAttribute()
    {
        if (!$this->coverage_start_date) {
            return 'N/A';
        }

        $startDate = Carbon::parse($this->coverage_start_date)->format('M Y');

        if ($this->coverage_end_date) {
            $endDate = Carbon::parse($this->coverage_end_date)->format('M Y');
            return "{$startDate} - {$endDate}";
        }

        return "{$startDate} - Present";
    }

    public function getIsCurrentAttribute()
    {
        if (!$this->coverage_end_date) {
            return true;
        }

        return Carbon::parse($this->coverage_end_date)->isFuture();
    }

    public function getDisplayTitleAttribute()
    {
        $title = $this->insurance_name;
        if ($this->insurance_company) {
            $title .= " ({$this->insurance_company})";
        }
        return $title;
    }

    public function getStatusBadgeAttribute()
    {
        if (!$this->is_current) {
            return '<span class="badge bg-danger">Expired</span>';
        } elseif (!$this->is_active) {
            return '<span class="badge bg-warning">Inactive</span>';
        } else {
            return '<span class="badge bg-success">Active</span>';
        }
    }
}
