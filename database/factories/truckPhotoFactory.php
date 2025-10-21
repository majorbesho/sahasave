<?php

// namespace Database\Factories;

// use App\Models\trucks;
// use Illuminate\Database\Eloquent\Factories\Factory;

// class truck_photosFactory extends Factory
// {
//     /**
//      * Define the model's default state.
//      *
//      * @return array
//      */
//     public function definition()
//     {
//         return [
//             //

//             'truck_id' => $this->faker->randomElement(trucks::pluck('id')->toArray()),
//             'photo_path' => $this->faker->imageUrl(),
//             'is_default' => $this->faker->randomElement(true, false),


//         ];
//     }
// }



namespace Database\Factories;

use App\Models\Trucks; // Use PascalCase for the model
use Illuminate\Database\Eloquent\Factories\Factory;

class TruckPhotoFactory extends Factory // Use PascalCase for the class name
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'truck_id' => $this->faker->randomElement(Trucks::pluck('id')->toArray()), // Use 'truck_id' instead of 'truck_id'
            'photo_path' => $this->faker->imageUrl(),
            'is_default' => $this->faker->randomElement([true, false]), // Use an array for randomElement
        ];
    }
}
