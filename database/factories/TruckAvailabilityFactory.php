<?php

namespace Database\Factories;

use App\Models\trucks;
use Illuminate\Database\Eloquent\Factories\Factory;

class TruckAvailabilityFactory extends Factory
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
            'truck_id' => $this->faker->randomElement(trucks::pluck('id')->toArray()),
            'start_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'end_date' => $this->faker->date($format = 'Y-m-d'),
            'status' => $this->faker->randomElement(['active', 'inactive']),


        ];
    }
}
