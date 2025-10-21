<?php

namespace Database\Factories;

use App\Http\Middleware\shipper;
use App\Models\Shipper as ModelsShipper;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoadPackageFactory extends Factory
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
            'discreption' => $this->faker->word,

            'photo' => $this->faker->imageUrl(600, 800),
            'status' => $this->faker->randomElement(['active', 'inactive']),

            'totalItems' => $this->faker->randomNumber(),
            'totalDimensions' => $this->faker->word,
            'totalLength' => $this->faker->randomNumber(),
            'totalWidth' => $this->faker->randomNumber(),
            'totalHeight' => $this->faker->randomNumber(),
            'weight' => $this->faker->randomNumber(),
            'shipment' => $this->faker->word,

            'paymentType' =>  $this->faker->randomElement(['cod', 'prepaid', 'prepaid_cod', 'prepaid_prepaid']),

            'paymentStatus' => $this->faker->randomElement(['pending', 'paid', 'failed']),
            'paymentMethod' => $this->faker->randomElement(['cash', 'cheque', 'online', 'wire transfer']),

            'paymentDate' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'paymentRef' => $this->faker->word,
            'trackingNumber' => $this->faker->randomNumber(),
            'trackingUrl' => $this->faker->url(),
            'loadType' => $this->faker->randomElement(['full', 'partial']),
            'loadNumber' => $this->faker->randomNumber(),
            'trackingStatus'  => $this->faker->randomElement(['pending', 'delivered', 'delayed', 'cancelled', 'failed']),


            'loadDate' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'loadTime' => $this->faker->time(),
            'loadBy' => $this->faker->firstName(),
            'loadTo' => $this->faker->city,
            'loadFrom' => $this->faker->city,
            'loadStatus' => $this->faker->word,
            'dropDate' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'dropTime' => $this->faker->time(),
            'dropBy' => $this->faker->firstName(),
            'dropTo' => $this->faker->city,
            'dropFrom' => $this->faker->city,
            'dropStatus' => $this->faker->word,
            'dropApproval' => $this->faker->word,
            'dropNotes' => $this->faker->word,
            'loadApproval' => $this->faker->word,
            'loadNotes' => $this->faker->word,
            'createdBy' => $this->faker->randomElement(ModelsShipper::pluck('id')->toArray()),

        ];
    }
}
