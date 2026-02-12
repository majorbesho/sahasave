<?php
// database/factories/MedicalCenterAdminFactory.php
namespace Database\Factories;

use App\Models\MedicalCenterAdmin;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalCenterAdminFactory extends Factory
{
    protected $model = MedicalCenterAdmin::class;

    public function definition()
    {
        return [
            'position' => $this->faker->randomElement([
                'مدير تنفيذي',
                'مدير الأطباء',
                'مدير المواعيد',
                'مدير المالية',
                'مدير العمليات'
            ]),
            'license_number' => 'MED-ADM-' . $this->faker->unique()->numberBetween(1000, 9999),
            'is_super_admin' => $this->faker->boolean(20)
        ];
    }
}
