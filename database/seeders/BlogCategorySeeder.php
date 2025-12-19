<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'General Health',
            'Cardiology',
            'Dermatology',
            'Pediatrics',
            'Mental Health',
            'Nutrition & Diet',
            'Fitness & Exercise',
            'Medical Research',
            'Hospital News',
            'Patient Stories',
        ];

        foreach ($categories as $category) {
            DB::table('blog_categories')->insertOrIgnore([
                'name' => $category,
                'slug' => Str::slug($category),
                'description' => 'All about ' . $category,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
