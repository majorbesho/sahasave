<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FaqFactory extends Factory
{
    protected $model = \App\Models\faq::class;

    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
            'slug' => Str::slug($this->faker->unique()->sentence(3)),
            'qu' => $this->faker->sentence(10) . '?',
            'answer' => $this->faker->paragraphs(3, true),
            'discreption' => $this->faker->sentence(),
            'photo' => 'faqs/' . $this->faker->image('public/storage/faqs', 600, 400, null, false),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
