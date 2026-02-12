<?php

namespace Database\Seeders;
// database/seeders/MedicalCenterAdminSeeder.php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MedicalCenter;
use App\Models\MedicalCenterAdmin;

class MedicalCenterAdminSeeder extends Seeder
{
    public function run()
    {
        // إنشاء مستخدمين كمديرين مراكز
        $users = User::factory(5)->create([
            'role' => 'medical_center_admin'
        ]);
        
        // الحصول على مراكز طبية عشوائية
        $centers = MedicalCenter::inRandomOrder()->limit(3)->get();
        
        foreach($users as $index => $user) {
            MedicalCenterAdmin::create([
                'user_id' => $user->id,
                'medical_center_id' => $centers->random()->id,
                'position' => $this->getRandomPosition(),
                'is_super_admin' => $index == 0, // أول مدير يكون مديراً عاماً
                'license_number' => 'MED-ADM-' . rand(1000, 9999)
            ]);
        }
    }
    
    private function getRandomPosition()
    {
        $positions = [
            'مدير تنفيذي',
            'مدير الأطباء',
            'مدير المواعيد',
            'مدير المالية',
            'مدير العمليات'
        ];
        
        return $positions[array_rand($positions)];
    }
}