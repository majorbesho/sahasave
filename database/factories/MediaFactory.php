<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
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
            'discreption' =>$this->faker->sentences(3,true),
            //sdiscreption
            'sdiscreption' =>$this->faker->sentences(10,true),
            'photo' =>$this->faker->imageUrl(100,100),
            'status'=>$this->faker->randomElement(['active','inactive']),
            'youtubeUrl'=>$this->faker->Url('youtube.com'),
            'faceUrl'=>$this->faker->Url('youtube.com'),
            'instabeUrl'=>$this->faker->Url('youtube.com'),
        ];
    }
}
