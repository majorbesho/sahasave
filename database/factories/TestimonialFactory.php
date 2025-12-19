<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TestimonialFactory extends Factory
{
    protected $model = \App\Models\testim::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'name' => $this->faker->name,
            'company' => $this->faker->company,
            'slug' => Str::slug($this->faker->unique()->sentence(3)),
            'discreption' => $this->faker->paragraph(3),
            'photo' => 'testimonials/' . $this->faker->image('public/storage/testimonials', 400, 400, null, false),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
