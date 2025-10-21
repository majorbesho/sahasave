<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model= Brand::class;

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
            'discreption' =>$this->faker->sentences(3,true),
            'photo' =>$this->faker->imageUrl(100,100), 
            'status'=>$this->faker->randomElement(['active','inactive']),
          
        ];
    }
}
