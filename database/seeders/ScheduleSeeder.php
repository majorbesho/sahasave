<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Schedule;
use App\Models\MedicalCenter;

class ScheduleSeeder extends Seeder
{
    public function run()
    {
        $doctors = User::where('role', 'doctor')->take(5)->get();
        $medicalCenters = MedicalCenter::take(3)->get();

        foreach ($doctors as $doctor) {
            foreach ($medicalCenters as $center) {
                // إنشاء جداول لأيام الأسبوع
                for ($day = 0; $day < 7; $day++) {
                    // تخطي يوم الجمعة (5) أو تعديله حسب الحاجة
                    if ($day == 5) continue;

                    Schedule::create([
                        'doctor_id' => $doctor->id,
                        'medical_center_id' => $center->id,
                        'day_of_week' => $day,
                        'start_time' => '09:00',
                        'end_time' => '17:00',
                        'session_type' => 'consultation',
                        'session_duration' => 30,
                        'max_sessions' => 16,
                        'is_active' => true,
                    ]);
                }
            }
        }
    }
}
