<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicalCenter;
use App\Models\User;
use App\Models\DoctorProfile;

class MapDataSeeder extends Seeder
{
    public function run()
    {
        // 1. إنشاء المراكز الطبية
        $centers = MedicalCenter::factory(10)->create();

        // 2. إنشاء أطباء (Users) مع إحداثيات دبي
        $doctors = User::factory(20)->create([
            'role' => 'doctor',
            'status' => 'active',
            'city' => 'Dubai',
            // Default lat/long for user (fallback if no center)
            'latitude' => 25.2048,
            'longitude' => 55.2708,
        ]);

        foreach ($doctors as $doctor) {
            // تحديث موقع الطبيب ليكون عشوائياً في دبي أيضاً
            $doctor->update([
                'latitude' => 25.0 + (rand(0, 300) / 1000),
                'longitude' => 55.1 + (rand(0, 300) / 1000),
            ]);

            // إنشاء بروفايل للطبيب
            DoctorProfile::factory()->create([
                'doctor_id' => $doctor->id,
                'slug' => \Illuminate\Support\Str::slug($doctor->name) . '-' . $doctor->id
            ]);

            // ربط الطبيب بمركز طبي عشوائي
            $center = $centers->random();
            $doctor->medicalCenters()->attach($center->id, ['is_primary' => true]);

            // تحديث العيادة الرئيسية في جدول Users
            $doctor->update(['primary_clinic_id' => $center->id]);
        }
    }
}
