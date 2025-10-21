<?php

namespace Database\Factories;

use App\Models\about;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutFactory extends Factory
{


    protected $model= about::class;


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
            'sdiscreption' =>$this->faker->sentences(3,true),
            'youtubeUrl' =>$this->faker->sentences(3,true),
            'photo' =>$this->faker->imageUrl(400,500),
            'mainImg' =>$this->faker->imageUrl(400,500),
            'testim_caption' =>$this->faker->sentences(3,true),
            'team_caption' =>$this->faker->sentences(3,true),
            'no1' =>$this->faker->sentences(1,true),
            'text1' =>$this->faker->numberBetween(10,50),
            'no2' =>$this->faker->sentences(1,true),
            'text2' =>$this->faker->numberBetween(10,50),
            'no3' =>$this->faker->sentences(1,true),
            'text3' =>$this->faker->numberBetween(10,50),
            'no4' =>$this->faker->sentences(1,true),
            'text4' =>$this->faker->numberBetween(10,50),
            'status'=>$this->faker->randomElement(['active','inactive']),
            'address'=>$this->faker->sentences(3,true),
            'city'=>$this->faker->sentences(3,true),
        ];
    }
}
