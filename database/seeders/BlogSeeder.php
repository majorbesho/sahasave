<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get fallback IDs
        $authorId = User::first()->id ?? 1;
        $categoryId = BlogCategory::first()->id ?? 1;

        $blogs = [
            [
                'title' => 'Top 10 Health Tips for 2025',
                'excerpt' => 'Discover the most important health tips to stay fit and healthy in the coming year.',
                'content' => '<p>Here are the top 10 health tips...</p><p>1. Drink water...</p><p>2. Exercise daily...</p>',
                'status' => 'published',
                'meta_keywords' => 'health, tips, 2025, wellness',
            ],
            [
                'title' => 'Understanding Mental Health in Digital Age',
                'excerpt' => 'How technology impacts our mental well-being and what to do about it.',
                'content' => '<p>Mental health is becoming increasingly important...</p><p>Screen time effects...</p>',
                'status' => 'published',
                'meta_keywords' => 'mental health, technology, digital detox',
            ],
            [
                'title' => 'Nutrition Basics: Macro vs Micro Nutrients',
                'excerpt' => 'A comprehensive guide to understanding what your body needs.',
                'content' => '<p>Proteins, carbs, and fats are macros...</p><p>Vitamins and minerals are micros...</p>',
                'status' => 'published',
                'meta_keywords' => 'nutrition, food, diet, healthy eating',
            ],
            [
                'title' => 'Benefits of Telemedicine',
                'excerpt' => 'Why seeing a doctor online is the future of healthcare.',
                'content' => '<p>Telemedicine offers convenience...</p><p>Accessibility for everyone...</p>',
                'status' => 'draft',
                'meta_keywords' => 'telemedicine, online doctor, healthcare',
            ],
            [
                'title' => 'Cardio Workouts at Home',
                'excerpt' => 'No gym? No problem. Best exercises you can do in your living room.',
                'content' => '<p>Jumping jacks...</p><p>Burpees...</p><p>High knees...</p>',
                'status' => 'published',
                'meta_keywords' => 'fitness, cardio, home workout',
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create([
                'title' => $blog['title'],
                'slug' => Str::slug($blog['title']) . '-' . rand(1000, 9999),
                'excerpt' => $blog['excerpt'],
                'content' => $blog['content'],
                'status' => $blog['status'],
                'visibility' => 'public',
                'content_type' => 'article',
                'reading_time' => rand(3, 10) . ' min read',
                'views' => rand(10, 500),
                'likes' => rand(5, 100),
                'shares' => rand(0, 50),
                'author_id' => $authorId,
                'category_id' => $categoryId,

                // SEO
                'meta_title' => $blog['title'],
                'meta_description' => $blog['excerpt'],
                'meta_keywords' => $blog['meta_keywords'],
                'schema_type' => 'Article',

                // Optimization
                'word_count' => str_word_count(strip_tags($blog['content'])),
                'flesch_score' => rand(50, 80),

                'featured' => rand(0, 1),
                'published_at' => $blog['status'] === 'published' ? now() : null,
            ]);
        }
    }
}
