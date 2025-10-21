<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class truck_ownerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //'role' => $this->faker->randomElement(['admin', 'customer', 'supplier', 'emp']),
            'photo' => $this->faker->imageUrl(100, 100),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'nationality' => $this->faker->country(),
            'dateOfbarth' => $this->faker->date(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'remember_token' => Str::random(10),
            'company_name' => $this->faker->company(),

        ];
    }
}
