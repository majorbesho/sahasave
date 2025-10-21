<?php

namespace Database\Factories;

use App\Models\supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class supplierFactory extends Factory
{
    protected $model= supplier::class;
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
            'status'=>$this->faker->randomElement(['active','inactive']),
            'company' => $this->faker->company,
            'contactNo' => $this->faker->phoneNumber(),
            'resName' => $this->faker->userName(),
            'email' => $this->faker->freeEmail(),
            'tele' => $this->faker->phoneNumber(),
            'web' => $this->faker->url(),
            'nots' => $this->faker->sentences(3,true),
        ];
    }
}
