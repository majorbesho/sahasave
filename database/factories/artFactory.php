<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\art;


class artFactory extends Factory
{
    protected $model= art::class;

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
            'mainImg'=>$this->faker->imageUrl(600,600),

        ];

    }
}
