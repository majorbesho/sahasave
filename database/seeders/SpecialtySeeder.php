<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialty;

class SpecialtySeeder extends Seeder
{
    public function run()
    {
        $specialties = [
            // التخصصات الرئيسية (Level 1)
            [
                'name_ar' => 'طب الباطنة',
                'name_en' => 'Internal Medicine',
                'description_ar' => 'تشخيص وعلاج أمراض الأعضاء الداخلية للبالغين',
                'description_en' => 'Diagnosis and treatment of internal organ diseases in adults',
                'icon' => 'internal-medicine.png',
                'color' => '#3498db',
                'level' => 1,
                'order' => 1,
                'is_featured' => true,
            ],
            [
                'name_ar' => 'طب الأطفال',
                'name_en' => 'Pediatrics',
                'description_ar' => 'رعاية صحية للأطفال من الولادة حتى المراهقة',
                'description_en' => 'Healthcare for children from birth to adolescence',
                'icon' => 'pediatrics.png',
                'color' => '#e74c3c',
                'level' => 1,
                'order' => 2,
                'is_featured' => true,
            ],
            [
                'name_ar' => 'جراحة عامة',
                'name_en' => 'General Surgery',
                'description_ar' => 'إجراء العمليات الجراحية لمختلف أجزاء الجسم',
                'description_en' => 'Performing surgical procedures on various body parts',
                'icon' => 'surgery.png',
                'color' => '#2ecc71',
                'level' => 1,
                'order' => 3,
                'is_featured' => true,
            ],
            [
                'name_ar' => 'أمراض النساء والتوليد',
                'name_en' => 'Obstetrics and Gynecology',
                'description_ar' => 'رعاية صحة المرأة والحمل والولادة',
                'description_en' => 'Women\'s health care, pregnancy and childbirth',
                'icon' => 'gynecology.png',
                'color' => '#9b59b6',
                'level' => 1,
                'order' => 4,
                'is_featured' => true,
            ],
            [
                'name_ar' => 'طب القلب',
                'name_en' => 'Cardiology',
                'description_ar' => 'تشخيص وعلاج أمراض القلب والأوعية الدموية',
                'description_en' => 'Diagnosis and treatment of heart and blood vessel diseases',
                'icon' => 'cardiology.png',
                'color' => '#e67e22',
                'level' => 1,
                'order' => 5,
                'is_featured' => true,
            ],
        ];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }

        // إضافة تخصصات فرعية (Level 2)
        $internalMedicine = Specialty::where('name_en', 'Internal Medicine')->first();
        $pediatrics = Specialty::where('name_en', 'Pediatrics')->first();
        $surgery = Specialty::where('name_en', 'General Surgery')->first();

        $subSpecialties = [
            [
                'name_ar' => 'أمراض الجهاز الهضمي',
                'name_en' => 'Gastroenterology',
                'parent_id' => $internalMedicine->id,
                'level' => 2,
                'order' => 1,
            ],
            [
                'name_ar' => 'أمراض الكلى',
                'name_en' => 'Nephrology',
                'parent_id' => $internalMedicine->id,
                'level' => 2,
                'order' => 2,
            ],
            [
                'name_ar' => 'أمراض الروماتيزم',
                'name_en' => 'Rheumatology',
                'parent_id' => $internalMedicine->id,
                'level' => 2,
                'order' => 3,
            ],
            [
                'name_ar' => 'جراحة الأطفال',
                'name_en' => 'Pediatric Surgery',
                'parent_id' => $pediatrics->id,
                'level' => 2,
                'order' => 1,
            ],
            [
                'name_ar' => 'جراحة القلب',
                'name_en' => 'Cardiac Surgery',
                'parent_id' => $surgery->id,
                'level' => 2,
                'order' => 1,
            ],
        ];

        foreach ($subSpecialties as $subSpecialty) {
            Specialty::create($subSpecialty);
        }
    }
}
