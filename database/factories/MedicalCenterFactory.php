<?php

namespace Database\Factories;

use App\Models\MedicalCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalCenterFactory extends Factory
{
    protected $model = MedicalCenter::class;

    public function definition()
    {
        // Dubai Coordinates boundaries
        $latitude = $this->faker->latitude(25.0, 25.3);
        $longitude = $this->faker->longitude(55.1, 55.4);

        return [
            'name' => $this->faker->company . ' Medical Center',
            'slug' => $this->faker->slug,
            'type' => $this->faker->randomElement(['clinic', 'hospital', 'medical_center', 'lab', 'pharmacy']),
            'description' => $this->faker->paragraph,
            'address' => $this->faker->streetAddress,
            'city' => 'Dubai',
            'latitude' => $latitude,
            'longitude' => $longitude,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->companyEmail,
            'status' => 'active', // Important for the scopeActive
            'is_verified' => $this->faker->boolean(80),
            'is_featured' => $this->faker->boolean(20),
            'average_rating' => $this->faker->randomFloat(1, 3.5, 5.0),
            'doctor_count' => 0,
            'specialties' => json_encode([$this->faker->word, $this->faker->word]),
            'services' => json_encode([$this->faker->word, $this->faker->word]),
        ];
    }
}
