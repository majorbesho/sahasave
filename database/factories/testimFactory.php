<?php

namespace Database\Factories;

use App\Models\testim;
use Illuminate\Database\Eloquent\Factories\Factory;

class testimFactory extends Factory
{
    protected $model= testim::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title' => $this->faker->word,
            'name' => $this->faker->word,
            'company' => $this->faker->company(),
            'slug' => $this->faker->unique()->slug,
            'discreption' =>$this->faker->sentences(3,true),
            'photo' =>$this->faker->imageUrl(100,100),
            'status'=>$this->faker->randomElement(['active','inactive']),
        ];
    }
}
