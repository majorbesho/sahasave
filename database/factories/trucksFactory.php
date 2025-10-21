<?php

namespace Database\Factories;

use App\Models\Carrier;
use App\Models\shipment_owners;
use App\Models\truck_owners;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class trucksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'title' => $this->faker->word,
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->word(),
            'photo' => $this->faker->imageUrl(),
            'statusactive' => $this->faker->randomElement(['active', 'inactive']),
            'price' => $this->faker->randomNumber(),
            'offer_price' => $this->faker->randomNumber(),
            'condition' => $this->faker->randomElement(['new', 'used', 'refurbished']), // ENUM('new', 'used', 'refurbished') DEFAULT 'new',
            'type' => $this->faker->word,
            'sender_type' => $this->faker->word,
            'truck_type' => $this->faker->word,
            'license_plate' => $this->faker->randomNumber(),
            'capacity' => $this->faker->word,

            'location_country' => $this->faker->country(),
            'location_city' => $this->faker->city(),
            'latitude' => $this->faker->randomNumber(),
            'longitude' => $this->faker->randomNumber(),
            'length' => $this->faker->randomNumber(),
            'width' => $this->faker->randomNumber(),
            'height' => $this->faker->randomNumber(),
            'weight' => $this->faker->randomNumber(),
            'added_by' => $this->faker->randomElement(Carrier::pluck('id')->toArray()),
            'truck_owner_id' => $this->faker->randomElement(truck_owners::pluck('id')->toArray()),

            'shipment_id' => $this->faker->randomElement(shipment_owners::pluck('id')->toArray()),

            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
            'status' => $this->faker->randomElement(['avialable', 'pending', 'booked', 'failed']),





        ];
    }
}
