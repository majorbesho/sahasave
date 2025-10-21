<?php

namespace Database\Factories;

use App\Models\shipment_owners;
use Illuminate\Database\Eloquent\Factories\Factory;

class shipmentsFactory extends Factory
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
            'shipment_owner_id' => $this->faker->randomElement(shipment_owners::pluck('id')->toArray()),
            'weight' => $this->faker->randomNumber(),
            'origin' => $this->faker->word,
            'destination' => $this->faker->word,
            'shipping_method' => $this->faker->word,
            'shipping_status' => $this->faker->randomElement(['avialable', 'pending', 'booked', 'failed']),
            'shipping_carrier' => $this->faker->word,
            'tracking_number' => $this->faker->randomNumber(),
            'shipping_date' => $this->faker->date(),
            'estimated_delivery_date' => $this->faker->date(),
            'actual_delivery_date' => $this->faker->date(),

        ];
    }
}
