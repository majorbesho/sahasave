<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(6);
        $content = $this->faker->paragraphs(5, true);
        $status = $this->faker->randomElement(['published', 'draft', 'archived']);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->sentence(20),
            'content' => $content,
            'featured_image' => null, // Or a placeholder URL if desired
            'status' => $status,
            'visibility' => 'public',
            'content_type' => $this->faker->randomElement(['article', 'news', 'guide', 'tips']),
            'reading_time' => $this->faker->numberBetween(1, 15) . ' min read',
            'views' => $this->faker->numberBetween(0, 1000),
            'likes' => $this->faker->numberBetween(0, 500),
            'shares' => $this->faker->numberBetween(0, 100),
            'author_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'category_id' => BlogCategory::inRandomOrder()->first()->id ?? 1, // Fallback to 1 if no categories

            // SEO
            'meta_title' => $title,
            'meta_description' => Str::limit($content, 150),
            'meta_keywords' => implode(', ', $this->faker->words(5)),
            'schema_type' => 'Article',

            // Optimization
            'word_count' => str_word_count($content),
            'flesch_score' => $this->faker->numberBetween(30, 90),

            'featured' => $this->faker->boolean(20), // 20% chance of being featured
            'published_at' => $status === 'published' ? $this->faker->dateTimeBetween('-1 year', 'now') : null,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
