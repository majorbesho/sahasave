<?php

namespace Database\Factories;

use App\Models\team;
use Illuminate\Database\Eloquent\Factories\Factory;

class teamFactory extends Factory
{
    protected $model= team::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'name' => $this->faker->word,
            // 'jobs' => $this->faker->jobTitle(),
            'addtext' => $this->faker->word,
            'facebook' => $this->faker->url,
            'twitter' => $this->faker->url,
            'google' => $this->faker->url,
            'slug' => $this->faker->unique()->slug,
            'discreption' =>$this->faker->sentences(3,true),
            'photo' =>$this->faker->imageUrl(100,100),
            'status'=>$this->faker->randomElement(['active','inactive']),

        ];
    }
}
