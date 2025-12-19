<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Health Tips',
            'Wellness',
            'Heart Health',
            'Skin Care',
            'Child Care',
            'Anxiety',
            'Healthy Eating',
            'Workout',
            'Medical News',
            'Recovery',
            'Surgery',
            'Prevention',
            'Lifestyle',
            'Doctors',
            'Telemedicine',
        ];

        foreach ($tags as $tag) {
            DB::table('blog_tags')->insertOrIgnore([
                'name' => $tag,
                'slug' => Str::slug($tag),
                'usage_count' => rand(0, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
