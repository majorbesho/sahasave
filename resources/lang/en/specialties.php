<?php

return [
    'title' => ':name - Specialist Doctors',
    'breadcrumb' => [
        'home' => 'Home',
        'specialties' => 'Specialties',
        'active' => ':name',
        'title' => ':name',
        'doctors_count' => ':count specialist doctors',
    ],
    'search' => [
        'placeholder' => 'Search for doctors in :name...',
        'location' => 'City or Area',
        'date' => 'Appointment Date',
        'button' => 'Search',
    ],
    'filters' => [
        'title' => 'Filters',
        'clear_all' => 'Clear All',
        'search_doctors' => 'Search doctors...',
        'specialties' => 'Specialties',
        'gender' => 'Gender',
        'experience' => 'Years of Experience',
        'rating' => 'Rating',
        'male' => 'Male',
        'female' => 'Female',
        'experience_years' => ':years+ years',
        'stars' => ':rating stars',
    ],
    'doctors' => [
        'title' => 'Showing :count doctors in :name specialty',
        'sort' => [
            'label' => 'Sort by:',
            'name_asc' => 'Name (A-Z)',
            'experience_desc' => 'Experience (Highest first)',
            'rating_desc' => 'Rating (Highest first)',
            'price_low' => 'Price (Low-High)',
            'price_high' => 'Price (High-Low)',
        ],
        'view' => [
            'grid' => 'Grid View',
            'list' => 'List View',
        ],
        'card' => [
            'available' => 'Available',
            'not_available' => 'Not Available',
            'location' => 'Location not specified',
            'experience' => ':years years experience',
            'consultation_fee' => 'Consultation Fee',
            'book_appointment' => 'Book Appointment',
        ],
        'no_results' => [
            'title' => 'No Results Found',
            'message' => 'We couldn\'t find any doctors in this specialty matching your search criteria.',
            'show_all' => 'View All Doctors',
        ],
        'pagination' => [
            'showing' => 'Showing :from to :to of :total doctors',
            'results' => 'Showing :count of :total doctors',
        ],
    ],
    'labels' => [
        'specialty' => 'Specialty',
        'doctor' => 'Doctor',
        'years' => 'years',
        'rating' => 'rating',
        'location' => 'Location',
        'price' => 'Price',
    ],
];
