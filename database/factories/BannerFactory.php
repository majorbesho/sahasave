<?php

namespace Database\Factories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    protected $model= Banner::class;

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
            // 'discreption' =>$this->faker->sentences(3,true),
            'discreption' =>$this->faker->word,

            'photo' =>$this->faker->imageUrl(600,800),
            'status'=>$this->faker->randomElement(['active','inactive']),
            'bigTitle'=>$this->faker->word,
            'smallTitle'=>$this->faker->word,
            'type'=>$this->faker->randomElement(['promo','banner']),
            'name'=>$this->faker->numberBetween(10,50),
            'youtube'=>$this->faker->url(),


        ];
    }
}
