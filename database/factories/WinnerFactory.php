<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WinnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->unique()->slug,
            'fullName' => $this->faker->name(),
            'Isvideo' => $this->faker->boolean(),
            'email' => $this->faker->unique()->safeEmail(),
            'photo' =>$this->faker->imageUrl(100,100),
            'status'=>$this->faker->randomElement(['active','inactive']),
            'nationality'=> $this->faker->country(),
            'dateOfbarth'=>$this->faker->date(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
        ];
    }
}
