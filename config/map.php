<?php

return [
    'default_center' => [
        'lat' => 24.7136,
        'lng' => 46.6753,
        'zoom' => 12
    ],

    'types' => [
        'clinic' => [
            'label' => 'عيادة',
            'color' => '#3498db',
            'icon' => 'hospital'
        ],
        'hospital' => [
            'label' => 'مستشفى',
            'color' => '#e74c3c',
            'icon' => 'hospital-alt'
        ],
        'medical_center' => [
            'label' => 'مركز طبي',
            'color' => '#2ecc71',
            'icon' => 'clinic-medical'
        ],
        'lab' => [
            'label' => 'مختبر',
            'color' => '#9b59b6',
            'icon' => 'flask'
        ],
        'pharmacy' => [
            'label' => 'صيدلية',
            'color' => '#f39c12',
            'icon' => 'pills'
        ]
    ],

    'filters' => [
        'rating_ranges' => [
            ['min' => 0, 'max' => 2, 'label' => 'ضعيف'],
            ['min' => 2, 'max' => 3.5, 'label' => 'متوسط'],
            ['min' => 3.5, 'max' => 4.5, 'label' => 'جيد'],
            ['min' => 4.5, 'max' => 5, 'label' => 'ممتاز']
        ],
        'experience_ranges' => [
            ['min' => 0, 'max' => 2, 'label' => 'مبتدئ'],
            ['min' => 2, 'max' => 5, 'label' => 'متوسط'],
            ['min' => 5, 'max' => 10, 'label' => 'خبير'],
            ['min' => 10, 'max' => 100, 'label' => 'خبير جداً']
        ]
    ],

    'map' => [
        'tile_url' => 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        'attribution' => '&copy; OpenStreetMap contributors',
        'max_zoom' => 19,
        'min_zoom' => 3
    ]
];
