<?php

namespace Database\Factories;

use App\Models\trucks;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TruckRatingFactory extends Factory
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
            'user_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
            'rating' => $this->faker->randomNumber(),
            'comment' => $this->faker->word,
        ];
    }
}
