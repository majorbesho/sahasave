<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalCenterAdmin extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'medical_center_id',
        'position',
        'license_number',
        'is_super_admin'
    ];

    protected $casts = [
        'is_super_admin' => 'boolean',
    ];

    // العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // العلاقة مع المركز الطبي
    public function medicalCenter()
    {
        return $this->belongsTo(MedicalCenter::class);
    }

    // العلاقة مع الأطباء (إذا كان له صلاحية إدارتهم)
    public function doctors()
    {
        return $this->hasMany(DoctorProfile::class, 'medical_center_id', 'medical_center_id');
    }

    // التحقق إذا كان مديراً عاماً
    public function isSuperAdmin()
    {
        return $this->is_super_admin;
    }

    // الحصول على الصلاحيات
    public function permissions()
    {
        $base = ['dashboard', 'profile', 'notifications'];

        if ($this->is_super_admin) {
            return array_merge($base, [
                'manage_doctors',
                'manage_staff',
                'manage_finance',
                'manage_appointments',
                'manage_services',
                'manage_settings',
                'view_reports',
                'manage_promotions'
            ]);
        }

        // يمكن إضافة صلاحيات حسب المنصب
        switch ($this->position) {
            case 'مدير الأطباء':
                return array_merge($base, ['manage_doctors', 'view_reports']);
            case 'مدير المواعيد':
                return array_merge($base, ['manage_appointments']);
            case 'مدير المالية':
                return array_merge($base, ['manage_finance', 'view_reports']);
            default:
                return $base;
        }
    }
}
