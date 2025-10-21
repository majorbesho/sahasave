<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MedicalCenter;
use App\Models\Specialty;
use Carbon\Carbon;

class MedicalCenterSeeder extends Seeder
{
    public function run()
    {
        // مسح البيانات القديمة إذا وجدت
        MedicalCenter::query()->delete();

        $specialties = Specialty::all();

        $cities = [
            'الرياض',
            'جدة',
            'الدمام',
            'مكة المكرمة',
            'المدينة المنورة',
            'الطائف',
            'تبوك',
            'الخرج',
            'بريدة',
            'خميس مشيط'
        ];

        $medicalCenters = [
            // مستشفيات
            [
                'name' => 'مستشفى الملك فيصل التخصصي',
                'type' => 'hospital',
                'email' => 'info@kfsh.edu.sa',
                'phone' => '+966112647000',
                'website' => 'https://www.kfsh.edu.sa',
                'address' => 'حي المعذر، الرياض 11525',
                'city' => 'الرياض',
                'state' => 'منطقة الرياض',
                'country' => 'SA',
                'postal_code' => '11525',
                'latitude' => 24.7136,
                'longitude' => 46.6753,
                'description' => 'أحد أبرز المستشفيات التخصصية في المملكة العربية السعودية، يقدم خدمات طبية متقدمة في مختلف التخصصات.',
                'services' => ['استشارات طبية', 'فحوصات مخبرية', 'أشعة وتصوير', 'طوارئ', 'عمليات جراحية', 'رعاية أسنان', 'عيون'],
                'facilities' => ['مواقف سيارات', 'إنترنت لاسلكي', 'تكييف', 'مصلى', 'كافيتيريا', 'صيدلية', 'غرف انتظار مريحة', 'مدخل لذوي الاحتياجات'],
                'insurance_providers' => ['بوبا العربية', 'الشركة العربية', 'الجزيرة', 'أكسا', 'تكافل'],
                'specialties' => $specialties->pluck('id')->toArray(),
                'working_hours' => [
                    'sunday' => ['open' => '08:00', 'close' => '22:00', 'closed' => false],
                    'monday' => ['open' => '08:00', 'close' => '22:00', 'closed' => false],
                    'tuesday' => ['open' => '08:00', 'close' => '22:00', 'closed' => false],
                    'wednesday' => ['open' => '08:00', 'close' => '22:00', 'closed' => false],
                    'thursday' => ['open' => '08:00', 'close' => '22:00', 'closed' => false],
                    'friday' => ['open' => '14:00', 'close' => '22:00', 'closed' => false],
                    'saturday' => ['open' => '08:00', 'close' => '22:00', 'closed' => false],
                ],
                'doctor_count' => 150,
                'average_rating' => 4.8,
                'rating_count' => 1250,
                'is_verified' => true,
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'name' => 'مستشفى الملك عبدالله التخصصي للأطفال',
                'type' => 'hospital',
                'email' => 'info@kach.org.sa',
                'phone' => '+966118099999',
                'website' => 'https://www.kach.org.sa',
                'address' => 'حي السليمانية، الرياض 12211',
                'city' => 'الرياض',
                'state' => 'منطقة الرياض',
                'country' => 'SA',
                'postal_code' => '12211',
                'latitude' => 24.6748,
                'longitude' => 46.6977,
                'description' => 'أكبر مستشفى متخصص في طب الأطفال في الشرق الأوسط، يقدم رعاية شاملة للأطفال من الولادة حتى سن المراهقة.',
                'services' => ['استشارات طبية', 'فحوصات مخبرية', 'أشعة وتصوير', 'طوارئ', 'عمليات جراحية', 'أطفال', 'علاج طبيعي'],
                'facilities' => ['مواقف سيارات', 'إنترنت لاسلكي', 'تكييف', 'مصلى', 'كافيتيريا', 'صيدلية', 'غرف انتظار مريحة', 'مدخل لذوي الاحتياجات', 'ملاعب أطفال'],
                'insurance_providers' => ['بوبا العربية', 'الشركة العربية', 'الجزيرة', 'تكافل', 'المتحدة'],
                'specialties' => $specialties->whereIn('name_en', ['Pediatrics', 'Pediatric Surgery'])->pluck('id')->toArray(),
                'working_hours' => [
                    'sunday' => ['open' => '07:00', 'close' => '23:00', 'closed' => false],
                    'monday' => ['open' => '07:00', 'close' => '23:00', 'closed' => false],
                    'tuesday' => ['open' => '07:00', 'close' => '23:00', 'closed' => false],
                    'wednesday' => ['open' => '07:00', 'close' => '23:00', 'closed' => false],
                    'thursday' => ['open' => '07:00', 'close' => '23:00', 'closed' => false],
                    'friday' => ['open' => '14:00', 'close' => '23:00', 'closed' => false],
                    'saturday' => ['open' => '07:00', 'close' => '23:00', 'closed' => false],
                ],
                'doctor_count' => 85,
                'average_rating' => 4.7,
                'rating_count' => 890,
                'is_verified' => true,
                'is_featured' => true,
                'status' => 'active',
            ],

            // مراكز طبية
            [
                'name' => 'المركز الطبي الدولي',
                'type' => 'medical_center',
                'email' => 'info@internationalmedical.com',
                'phone' => '+966112345678',
                'website' => 'https://www.internationalmedical.com',
                'address' => 'حي العليا، شارع الملك فهد، الرياض 12241',
                'city' => 'الرياض',
                'state' => 'منطقة الرياض',
                'country' => 'SA',
                'postal_code' => '12241',
                'latitude' => 24.7619,
                'longitude' => 46.6735,
                'description' => 'مركز طبي متكامل يقدم خدمات طبية متقدمة في مختلف التخصصات مع فريق طبي متميز.',
                'services' => ['استشارات طبية', 'فحوصات مخبرية', 'أشعة وتصوير', 'رعاية أسنان', 'عيون', 'أمراض جلدية', 'أمراض نسائية', 'تغذية'],
                'facilities' => ['مواقف سيارات', 'إنترنت لاسلكي', 'تكييف', 'مصلى', 'صيدلية', 'غرف انتظار مريحة', 'دفع إلكتروني'],
                'insurance_providers' => ['بوبا العربية', 'الجزيرة', 'أكسا', 'تكافل', 'أسيج'],
                'specialties' => $specialties->take(8)->pluck('id')->toArray(),
                'working_hours' => [
                    'sunday' => ['open' => '08:00', 'close' => '20:00', 'closed' => false],
                    'monday' => ['open' => '08:00', 'close' => '20:00', 'closed' => false],
                    'tuesday' => ['open' => '08:00', 'close' => '20:00', 'closed' => false],
                    'wednesday' => ['open' => '08:00', 'close' => '20:00', 'closed' => false],
                    'thursday' => ['open' => '08:00', 'close' => '20:00', 'closed' => false],
                    'friday' => ['open' => '16:00', 'close' => '20:00', 'closed' => false],
                    'saturday' => ['open' => '08:00', 'close' => '20:00', 'closed' => false],
                ],
                'doctor_count' => 45,
                'average_rating' => 4.5,
                'rating_count' => 320,
                'is_verified' => true,
                'is_featured' => false,
                'status' => 'active',
            ],

            // عيادات
            [
                'name' => 'عيادة الرياض التخصصية',
                'type' => 'clinic',
                'email' => 'appointments@riyadhclinic.com',
                'phone' => '+966112233445',
                'website' => 'https://www.riyadhclinic.com',
                'address' => 'حي النخيل، الرياض 13315',
                'city' => 'الرياض',
                'state' => 'منطقة الرياض',
                'country' => 'SA',
                'postal_code' => '13315',
                'latitude' => 24.7889,
                'longitude' => 46.6769,
                'description' => 'عيادة متخصصة تقدم خدمات طبية متميزة في تخصصات متعددة مع تركيز على الرعاية الشخصية.',
                'services' => ['استشارات طبية', 'فحوصات مخبرية', 'رعاية أسنان', 'عيون', 'أمراض جلدية', 'صحة نفسية'],
                'facilities' => ['مواقف سيارات', 'إنترنت لاسلكي', 'تكييف', 'صيدلية', 'غرف انتظار مريحة'],
                'insurance_providers' => ['بوبا العربية', 'الجزيرة', 'تكافل'],
                'specialties' => $specialties->take(6)->pluck('id')->toArray(),
                'working_hours' => [
                    'sunday' => ['open' => '09:00', 'close' => '18:00', 'closed' => false],
                    'monday' => ['open' => '09:00', 'close' => '18:00', 'closed' => false],
                    'tuesday' => ['open' => '09:00', 'close' => '18:00', 'closed' => false],
                    'wednesday' => ['open' => '09:00', 'close' => '18:00', 'closed' => false],
                    'thursday' => ['open' => '09:00', 'close' => '18:00', 'closed' => false],
                    'friday' => ['open' => '16:00', 'close' => '20:00', 'closed' => false],
                    'saturday' => ['open' => '09:00', 'close' => '18:00', 'closed' => false],
                ],
                'doctor_count' => 12,
                'average_rating' => 4.3,
                'rating_count' => 156,
                'is_verified' => true,
                'is_featured' => false,
                'status' => 'active',
            ],

            [
                'name' => 'عيادة جدة للأسنان',
                'type' => 'clinic',
                'email' => 'info@jeddahdental.com',
                'phone' => '+966126543210',
                'website' => 'https://www.jeddahdental.com',
                'address' => 'حي السلامة، جدة 23435',
                'city' => 'جدة',
                'state' => 'منطقة مكة المكرمة',
                'country' => 'SA',
                'postal_code' => '23435',
                'latitude' => 21.5433,
                'longitude' => 39.1728,
                'description' => 'عيادة متخصصة في طب الأسنان تقدم أحدث التقنيات في علاج وتجميل الأسنان.',
                'services' => ['رعاية أسنان', 'استشارات طبية', 'فحوصات مخبرية'],
                'facilities' => ['مواقف سيارات', 'إنترنت لاسلكي', 'تكييف', 'صيدلية', 'غرف انتظار مريحة'],
                'insurance_providers' => ['بوبا العربية', 'الجزيرة', 'أكسا'],
                'specialties' => $specialties->where('name_en', 'like', '%Dental%')->pluck('id')->toArray(),
                'working_hours' => [
                    'sunday' => ['open' => '10:00', 'close' => '20:00', 'closed' => false],
                    'monday' => ['open' => '10:00', 'close' => '20:00', 'closed' => false],
                    'tuesday' => ['open' => '10:00', 'close' => '20:00', 'closed' => false],
                    'wednesday' => ['open' => '10:00', 'close' => '20:00', 'closed' => false],
                    'thursday' => ['open' => '10:00', 'close' => '20:00', 'closed' => false],
                    'friday' => ['open' => '16:00', 'close' => '22:00', 'closed' => false],
                    'saturday' => ['open' => '10:00', 'close' => '20:00', 'closed' => false],
                ],
                'doctor_count' => 8,
                'average_rating' => 4.6,
                'rating_count' => 210,
                'is_verified' => true,
                'is_featured' => true,
                'status' => 'active',
            ],

            // مختبرات
            [
                'name' => 'مختبر الدمام للتحاليل الطبية',
                'type' => 'lab',
                'email' => 'lab@dammamlabs.com',
                'phone' => '+966138765432',
                'website' => 'https://www.dammamlabs.com',
                'address' => 'حي الشاطئ، الدمام 32241',
                'city' => 'الدمام',
                'state' => 'المنطقة الشرقية',
                'country' => 'SA',
                'postal_code' => '32241',
                'latitude' => 26.4207,
                'longitude' => 50.0888,
                'description' => 'مختبر متكامل للتحاليل الطبية يقدم خدمات دقيقة وسريعة باستخدام أحدث الأجهزة.',
                'services' => ['فحوصات مخبرية', 'استشارات طبية'],
                'facilities' => ['مواقف سيارات', 'إنترنت لاسلكي', 'تكييف', 'غرف انتظار مريحة', 'خدمة التوصيل'],
                'insurance_providers' => ['بوبا العربية', 'الشركة العربية', 'الجزيرة', 'تكافل'],
                'specialties' => [],
                'working_hours' => [
                    'sunday' => ['open' => '07:00', 'close' => '22:00', 'closed' => false],
                    'monday' => ['open' => '07:00', 'close' => '22:00', 'closed' => false],
                    'tuesday' => ['open' => '07:00', 'close' => '22:00', 'closed' => false],
                    'wednesday' => ['open' => '07:00', 'close' => '22:00', 'closed' => false],
                    'thursday' => ['open' => '07:00', 'close' => '22:00', 'closed' => false],
                    'friday' => ['open' => '14:00', 'close' => '22:00', 'closed' => false],
                    'saturday' => ['open' => '07:00', 'close' => '22:00', 'closed' => false],
                ],
                'doctor_count' => 5,
                'average_rating' => 4.4,
                'rating_count' => 178,
                'is_verified' => true,
                'is_featured' => false,
                'status' => 'active',
            ],
        ];

        foreach ($medicalCenters as $centerData) {
            // إنشاء slug تلقائي
            $slug = \Illuminate\Support\Str::slug($centerData['name']);
            $originalSlug = $slug;
            $counter = 1;

            while (MedicalCenter::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $centerData['slug'] = $slug;
            $centerData['created_at'] = Carbon::now();
            $centerData['updated_at'] = Carbon::now();

            // لا نحتاج لتحويل المصفوفات إلى JSON يدوياً - الـ Model سيفعل ذلك تلقائياً
            // لأننا عرفنا الـ casts في الموديل

            MedicalCenter::create($centerData);
        }

        $this->command->info('تم إنشاء ' . count($medicalCenters) . ' مركز طبي بنجاح!');
    }
}
