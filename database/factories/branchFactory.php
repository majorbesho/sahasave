<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

class branchFactory extends Factory
{
    protected $model= Branch::class;
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
            'slug' => $this->faker->unique()->slug,
            'discreption' =>$this->faker->sentences(3,true),
            'photo' =>$this->faker->imageUrl(100,100),
         
            'googleL' =>$this->faker->sentences(3,true),
            'googleE' =>$this->faker->sentences(3,true),
            'tele' =>$this->faker->sentences(3,true),
            'email' =>$this->faker->email(),
            'status'=>$this->faker->randomElement(['active','inactive']),

        ];
    }
}
