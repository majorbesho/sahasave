<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Book Appointment',
                'slug' => 'book-appointment',
                'icon' => 'list-icon-01.svg',
                'color' => '#6c757d',
                'description' => 'Book appointments with qualified doctors',
                'is_featured' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Talk to Doctors',
                'slug' => 'talk-to-doctors',
                'icon' => 'list-icon-02.svg',
                'color' => '#007bff',
                'description' => 'Online consultations with doctors',
                'is_featured' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Hospitals & Clinics',
                'slug' => 'hospitals-clinics',
                'icon' => 'list-icon-03.svg',
                'color' => '#e83e8c',
                'description' => 'Find hospitals and clinics near you',
                'is_featured' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'Healthcare',
                'slug' => 'healthcare',
                'icon' => 'list-icon-04.svg',
                'color' => '#17a2b8',
                'description' => 'Comprehensive healthcare services',
                'is_featured' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'Medicine & Supplies',
                'slug' => 'medicine-supplies',
                'icon' => 'list-icon-05.svg',
                'color' => '#6f42c1',
                'description' => 'Medical supplies and prescriptions',
                'is_featured' => true,
                'sort_order' => 5
            ],
            [
                'name' => 'Lab Testing',
                'slug' => 'lab-testing',
                'icon' => 'list-icon-06.svg',
                'color' => '#fd7e14',
                'description' => 'Laboratory tests and diagnostics',
                'is_featured' => true,
                'sort_order' => 6
            ],
            [
                'name' => 'Home Care',
                'slug' => 'home-care',
                'icon' => 'list-icon-07.svg',
                'color' => '#20c997',
                'description' => 'Home healthcare services',
                'is_featured' => true,
                'sort_order' => 7
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
