<?php

return [
    'title' => ':name - أطباء متخصصون',
    'breadcrumb' => [
        'home' => 'الرئيسية',
        'specialties' => 'التخصصات',
        'active' => ':name',
        'title' => ':name',
        'doctors_count' => ':count طبيب متخصص',
    ],
    'search' => [
        'placeholder' => 'البحث عن أطباء في :name...',
        'location' => 'المدينة أو المنطقة',
        'date' => 'تاريخ الموعد',
        'button' => 'بحث',
    ],
    'filters' => [
        'title' => 'تصفية النتائج',
        'clear_all' => 'مسح الكل',
        'search_doctors' => 'البحث عن أطباء...',
        'specialties' => 'التخصصات',
        'gender' => 'الجنس',
        'experience' => 'سنوات الخبرة',
        'rating' => 'التقييم',
        'male' => 'ذكر',
        'female' => 'أنثى',
        'experience_years' => ':years+ سنوات',
        'stars' => ':rating نجوم',
    ],
    'doctors' => [
        'title' => 'عرض :count أطباء في تخصص :name',
        'sort' => [
            'label' => 'ترتيب حسب:',
            'name_asc' => 'الاسم (أ-ي)',
            'experience_desc' => 'الخبرة (الأكثر أولاً)',
            'rating_desc' => 'التقييم (الأعلى أولاً)',
            'price_low' => 'السعر (من الأقل للأعلى)',
            'price_high' => 'السعر (من الأعلى للأقل)',
        ],
        'view' => [
            'grid' => 'عرض شبكي',
            'list' => 'عرض قائمة',
        ],
        'card' => [
            'available' => 'متاح',
            'not_available' => 'غير متاح',
            'location' => 'الموقع غير محدد',
            'experience' => 'خبرة :years سنوات',
            'consultation_fee' => 'رسوم الكشف',
            'book_appointment' => 'حجز موعد',
        ],
        'no_results' => [
            'title' => 'لم يتم العثور على نتائج',
            'message' => 'لم نتمكن من العثور على أي أطباء في هذا التخصص يطابقون معايير البحث الخاصة بك.',
            'show_all' => 'عرض جميع الأطباء',
        ],
        'pagination' => [
            'showing' => 'عرض :from إلى :to من :total طبيب',
            'results' => 'عرض :count من :total طبيب',
        ],
    ],
    'labels' => [
        'specialty' => 'التخصص',
        'doctor' => 'طبيب',
        'years' => 'سنوات',
        'rating' => 'تقييم',
        'location' => 'الموقع',
        'price' => 'السعر',
    ],
];
