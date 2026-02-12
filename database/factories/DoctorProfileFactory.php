<?php

namespace Database\Factories;

use App\Models\DoctorProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorProfileFactory extends Factory
{
    protected $model = DoctorProfile::class;

    public function definition()
    {
        return [
            'medical_license_number' => $this->faker->unique()->numerify('LIC-#####'),
            'specialty_id' => $this->faker->numberBetween(1, 10), // Assuming these IDs exist
            'specialization' => $this->faker->jobTitle,
            'license_document_path' => 'dummy/path/license.pdf',
            'years_of_experience' => $this->faker->numberBetween(1, 30),
            'bio' => $this->faker->paragraph,
            'average_rating' => $this->faker->randomFloat(1, 3.5, 5.0),
            'rating_count' => $this->faker->numberBetween(5, 100),
            'is_verified' => true,
            'verification_status' => 'verified',
            'accepting_new_patients' => true,
            'consultation_fee' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
