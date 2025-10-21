<?php

namespace Database\Factories;

use App\Models\trucks;
use Illuminate\Database\Eloquent\Factories\Factory;

class TruckSpecificationFactory extends Factory
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
            'truck_id'  => $this->faker->randomElement(trucks::pluck('id')->toArray()),
            'engine_type' => $this->faker->word,
            'fuel_type' => $this->faker->word,
            'fuel_consumption' => $this->faker->word,
            'transmission' => $this->faker->word,


        ];
    }
}
