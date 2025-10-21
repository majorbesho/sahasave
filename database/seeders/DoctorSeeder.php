<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\DoctorProfile;
use App\Models\Specialty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DoctorSeeder extends Seeder
{
    public function run()
    {
        // مسح البيانات القديمة إذا وجدت
        User::where('role', 'doctor')->delete();

        $specialties = Specialty::all();
        $cities = ['الرياض', 'جدة', 'الدمام', 'مكة المكرمة', 'المدينة المنورة', 'الطائف', 'تبوك', 'بريدة', 'خميس مشيط', 'الأحساء'];

        $doctors = [
            // أطباء القلب والأوعية الدموية
            [
                'name' => 'د. أحمد محمد العلي',
                'email' => 'ahmed.alali@medical.com',
                'phone' => '+966501234001',
                'specialty' => 'Cardiology',
                'medical_license_number' => 'SA-CARD-001',
                'years_of_experience' => 15,
                'medical_school' => 'كلية الطب بجامعة الملك سعود',
                'graduation_year' => 2008,
                'current_hospital' => 'مستشفى الملك فيصل التخصصي',
                'current_position' => 'استشاري أمراض القلب',
                'consultation_fee' => 300,
                'city' => 'الرياض',
                'bio' => 'استشاري أمراض القلب والقسطرة العلاجية، حاصل على البورد السعودي والبورد الأمريكي في أمراض القلب.',
                'qualifications' => ['البورد السعودي للطب الباطني', 'البورد السعودي لأمراض القلب', 'زمالة أمراض القلب من كليفلاند كلينك'],
            ],
            [
                'name' => 'د. سارة عبدالله الحربي',
                'email' => 'sara.alharbi@medical.com',
                'phone' => '+966501234002',
                'specialty' => 'Cardiology',
                'medical_license_number' => 'SA-CARD-002',
                'years_of_experience' => 12,
                'medical_school' => 'كلية الطب بجامعة الملك عبدالعزيز',
                'graduation_year' => 2011,
                'current_hospital' => 'مستشفى الملك عبدالله التخصصي للأطفال',
                'current_position' => 'استشارية قلب أطفال',
                'consultation_fee' => 280,
                'city' => 'الرياض',
                'bio' => 'استشارية أمراض قلب الأطفال والقسطرة التشخيصية، متخصصة في عيوب القلب الخلقية لدى الأطفال.',
            ],

            // أطباء الأطفال
            [
                'name' => 'د. خالد إبراهيم السديري',
                'email' => 'khaled.alsudairi@medical.com',
                'phone' => '+966501234003',
                'specialty' => 'Pediatrics',
                'medical_license_number' => 'SA-PED-001',
                'years_of_experience' => 20,
                'medical_school' => 'كلية الطب بجامعة القاهرة',
                'graduation_year' => 2003,
                'current_hospital' => 'مستشفى الملك فيصل التخصصي',
                'current_position' => 'استشاري طب الأطفال',
                'consultation_fee' => 200,
                'city' => 'الرياض',
                'bio' => 'استشاري طب الأطفال حديثي الولادة، حاصل على الزمالة البريطانية في طب الأطفال.',
            ],
            [
                'name' => 'د. فاطمة ناصر القحطاني',
                'email' => 'fatima.alqahtani@medical.com',
                'phone' => '+966501234004',
                'specialty' => 'Pediatrics',
                'medical_license_number' => 'SA-PED-002',
                'years_of_experience' => 8,
                'medical_school' => 'كلية الطب بجامعة الدمام',
                'graduation_year' => 2015,
                'current_hospital' => 'مستشفى الملك فهد التخصصي بالدمام',
                'current_position' => 'أخصائية طب الأطفال',
                'consultation_fee' => 180,
                'city' => 'الدمام',
                'bio' => 'أخصائية طب الأطفال وحديثي الولادة، متخصصة في أمراض الجهاز التنفسي لدى الأطفال.',
            ],

            // أطباء الجراحة العامة
            [
                'name' => 'د. محمد سعيد الغامدي',
                'email' => 'mohamed.alghamdi@medical.com',
                'phone' => '+966501234005',
                'specialty' => 'General Surgery',
                'medical_license_number' => 'SA-SUR-001',
                'years_of_experience' => 18,
                'medical_school' => 'كلية الطب بجامعة الملك سعود',
                'graduation_year' => 2005,
                'current_hospital' => 'مستشفى الملك خالد الجامعي',
                'current_position' => 'استشاري الجراحة العامة',
                'consultation_fee' => 350,
                'city' => 'الرياض',
                'bio' => 'استشاري الجراحة العامة وجراحة المناظير، متخصص في جراحات الجهاز الهضمي والغدد.',
            ],

            // أطباء النساء والتوليد
            [
                'name' => 'د. هدى عبدالرحمن العتيبي',
                'email' => 'huda.alotaibi@medical.com',
                'phone' => '+966501234006',
                'specialty' => 'Obstetrics and Gynecology',
                'medical_license_number' => 'SA-OBG-001',
                'years_of_experience' => 14,
                'medical_school' => 'كلية الطب بجامعة الملك عبدالعزيز',
                'graduation_year' => 2009,
                'current_hospital' => 'مستشفى الملك عبدالعزيز الجامعي',
                'current_position' => 'استشارية نساء وتوليد',
                'consultation_fee' => 250,
                'city' => 'جدة',
                'bio' => 'استشارية نساء وتوليد وجراحات المناظير النسائية، متخصصة في العقم وأطفال الأنابيب.',
            ],
            [
                'name' => 'د. لمى أحمد الشمري',
                'email' => 'lama.alshamri@medical.com',
                'phone' => '+966501234007',
                'specialty' => 'Obstetrics and Gynecology',
                'medical_license_number' => 'SA-OBG-002',
                'years_of_experience' => 10,
                'medical_school' => 'كلية الطب بجامعة طيبة',
                'graduation_year' => 2013,
                'current_hospital' => 'مستشفى النساء والتوليد بالمدينة',
                'current_position' => 'أخصائية نساء وتوليد',
                'consultation_fee' => 220,
                'city' => 'المدينة المنورة',
                'bio' => 'أخصائية نساء وتوليد، متخصصة في متابعة الحمل عالي الخطورة ورعاية ما بعد الولادة.',
            ],

            // أطباء الباطنية
            [
                'name' => 'د. وليد حسن الرشيد',
                'email' => 'waleed.alrasheed@medical.com',
                'phone' => '+966501234008',
                'specialty' => 'Internal Medicine',
                'medical_license_number' => 'SA-INT-001',
                'years_of_experience' => 16,
                'medical_school' => 'كلية الطب بجامعة الملك سعود',
                'graduation_year' => 2007,
                'current_hospital' => 'مستشفى الملك فيصل التخصصي',
                'current_position' => 'استشاري الباطنية',
                'consultation_fee' => 230,
                'city' => 'الرياض',
                'bio' => 'استشاري الأمراض الباطنية والغدد الصماء، متخصص في أمراض السكري والغدد.',
            ],

            // أطباء العظام
            [
                'name' => 'د. عبدالله ناصر الفهد',
                'email' => 'abdullah.alfahad@medical.com',
                'phone' => '+966501234009',
                'specialty' => 'Orthopedics',
                'medical_license_number' => 'SA-ORT-001',
                'years_of_experience' => 13,
                'medical_school' => 'كلية الطب بجامعة الملك سعود',
                'graduation_year' => 2010,
                'current_hospital' => 'مستشفى الملك خالد الجامعي',
                'current_position' => 'استشاري العظام',
                'consultation_fee' => 320,
                'city' => 'الرياض',
                'bio' => 'استشاري جراحة العظام والمفاصل، متخصص في جراحات العمود الفقري واستبدال المفاصل.',
            ],

            // أطباء الجلدية
            [
                'name' => 'د. نورة خالد الدوسري',
                'email' => 'nora.aldosari@medical.com',
                'phone' => '+966501234010',
                'specialty' => 'Dermatology',
                'medical_license_number' => 'SA-DER-001',
                'years_of_experience' => 9,
                'medical_school' => 'كلية الطب بجامعة الأميرة نورة',
                'graduation_year' => 2014,
                'current_hospital' => 'مستشفى الملك عبدالله التخصصي للأطفال',
                'current_position' => 'أخصائية الجلدية',
                'consultation_fee' => 190,
                'city' => 'الرياض',
                'bio' => 'أخصائية الأمراض الجلدية والعلاج بالليزر، متخصصة في أمراض الجلد لدى الأطفال والكبار.',
            ],

            // أطباء العيون
            [
                'name' => 'د. ياسر محمد القاضي',
                'email' => 'yasser.alqadi@medical.com',
                'phone' => '+966501234011',
                'specialty' => 'Ophthalmology',
                'medical_license_number' => 'SA-OPH-001',
                'years_of_experience' => 17,
                'medical_school' => 'كلية الطب بجامعة الملك سعود',
                'graduation_year' => 2006,
                'current_hospital' => 'مستشفى الملك خالد التخصصي للعيون',
                'current_position' => 'استشاري العيون',
                'consultation_fee' => 280,
                'city' => 'الرياض',
                'bio' => 'استشاري جراحة العيون وتصحيح النظر، متخصص في جراحات الشبكية والليزك.',
            ],

            // أطباء الأنف والأذن والحنجرة
            [
                'name' => 'د. بدر عبدالعزيز السبيعي',
                'email' => 'badr.alsubaie@medical.com',
                'phone' => '+966501234012',
                'specialty' => 'ENT',
                'medical_license_number' => 'SA-ENT-001',
                'years_of_experience' => 11,
                'medical_school' => 'كلية الطب بجامعة الملك سعود',
                'graduation_year' => 2012,
                'current_hospital' => 'مستشفى الملك فيصل التخصصي',
                'current_position' => 'استشاري الأنف والأذن والحنجرة',
                'consultation_fee' => 240,
                'city' => 'الرياض',
                'bio' => 'استشاري جراحة الأنف والأذن والحنجرة، متخصص في جراحات الجيوب الأنفية والمناظير.',
            ],

            // أطباء المخ والأعصاب
            [
                'name' => 'د. ماجد إبراهيم التركي',
                'email' => 'majed.alturki@medical.com',
                'phone' => '+966501234013',
                'specialty' => 'Neurology',
                'medical_license_number' => 'SA-NEU-001',
                'years_of_experience' => 15,
                'medical_school' => 'كلية الطب بجامعة الملك سعود',
                'graduation_year' => 2008,
                'current_hospital' => 'مستشفى الملك فيصل التخصصي',
                'current_position' => 'استشاري المخ والأعصاب',
                'consultation_fee' => 300,
                'city' => 'الرياض',
                'bio' => 'استشاري أمراض المخ والأعصاب، متخصص في الصرع والجلطات الدماغية.',
            ],

            // أطباء المسالك البولية
            [
                'name' => 'د. طارق سعد الحميد',
                'email' => 'tarek.alhamid@medical.com',
                'phone' => '+966501234014',
                'specialty' => 'Urology',
                'medical_license_number' => 'SA-URO-001',
                'years_of_experience' => 12,
                'medical_school' => 'كلية الطب بجامعة الملك سعود',
                'graduation_year' => 2011,
                'current_hospital' => 'مستشفى الملك خالد الجامعي',
                'current_position' => 'استشاري المسالك البولية',
                'consultation_fee' => 290,
                'city' => 'الرياض',
                'bio' => 'استشاري جراحة المسالك البولية والمناظير، متخصص في جراحات البروستاتا والحصوات.',
            ],

            // أطباء الأسنان
            [
                'name' => 'د. علي محمد الجهني',
                'email' => 'ali.aljuhani@medical.com',
                'phone' => '+966501234015',
                'specialty' => 'Dentistry',
                'medical_license_number' => 'SA-DEN-001',
                'years_of_experience' => 8,
                'medical_school' => 'كلية طب الأسنان بجامعة الملك سعود',
                'graduation_year' => 2015,
                'current_hospital' => 'عيادة الرياض التخصصية للأسنان',
                'current_position' => 'استشاري تجميل الأسنان',
                'consultation_fee' => 150,
                'city' => 'الرياض',
                'bio' => 'استشاري تجميل وزراعة الأسنان، متخصص في القشور الخزفية وعلاجات اللثة.',
            ],
        ];

        // إنشاء أطباء إضافيين بشكل عشوائي
        $additionalDoctors = $this->generateAdditionalDoctors(30, $specialties, $cities);
        $allDoctors = array_merge($doctors, $additionalDoctors);

        foreach ($allDoctors as $doctorData) {
            $this->createDoctor($doctorData, $specialties);
        }

        $this->command->info('تم إنشاء ' . count($allDoctors) . ' طبيب بنجاح!');
    }

    private function createDoctor($data, $specialties)
    {
        // البحث عن التخصص المناسب
        $specialty = $specialties->where('name_en', $data['specialty'])->first();
        if (!$specialty) {
            $specialty = $specialties->first();
        }

        // إنشاء المستخدم
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make('111111'),
            'role' => 'doctor',
            'status' => 'active',
            'email_verified_at' => now(),
            'gender' => $this->getGenderFromName($data['name']),
            'nationality' => 'Saudi Arabian',
            'date_of_birth' => $this->generateRandomBirthDate($data['years_of_experience']),
            'address' => $data['city'] . ', المملكة العربية السعودية',
            'referral_code' => \Illuminate\Support\Str::upper(\Illuminate\Support\Str::random(8)),
        ]);

        // إنشاء البروفايل الطبي
        DoctorProfile::create([
            'doctor_id' => $user->id,
            'medical_license_number' => $data['medical_license_number'],
            'specialty_id' => $specialty->id,
            'specialization' => $specialty->name,
            'medical_school' => $data['medical_school'],
            'graduation_year' => $data['graduation_year'],
            'years_of_experience' => $data['years_of_experience'],
            'current_hospital' => $data['current_hospital'],
            'current_position' => $data['current_position'],
            'consultation_fee' => $data['consultation_fee'],
            'bio' => $data['bio'],
            'qualifications' => $data['qualifications'] ?? ['البورد السعودي', 'زمالة التخصص'],
            'is_verified' => true,
            'verification_status' => 'verified',
            'accepting_new_patients' => true,
            'average_rating' => rand(40, 50) / 10, // تقييم بين 4.0 و 5.0
            'rating_count' => rand(10, 200),
            'total_consultations' => rand(50, 1000),
        ]);

        return $user;
    }

    private function generateAdditionalDoctors($count, $specialties, $cities)
    {
        $additionalDoctors = [];
        $arabicNames = $this->getArabicNames();
        $medicalSchools = [
            'كلية الطب بجامعة الملك سعود',
            'كلية الطب بجامعة الملك عبدالعزيز',
            'كلية الطب بجامعة الملك سعود بن عبدالعزيز',
            'كلية الطب بجامعة الدمام',
            'كلية الطب بجامعة طيبة',
            'كلية الطب بجامعة القصيم',
            'كلية الطب بجامعة تبوك',
            'كلية الطب بجامعة جازان',
            'كلية الطب بجامعة الأميرة نورة',
            'كلية الطب بجامعة حائل'
        ];

        $hospitals = [
            'مستشفى الملك فيصل التخصصي',
            'مستشفى الملك عبدالله التخصصي للأطفال',
            'مستشفى الملك خالد الجامعي',
            'مستشفى الملك عبدالعزيز الجامعي',
            'مستشفى الملك فهد التخصصي بالدمام',
            'مستشفى القوات المسلحة بالجنوب',
            'مستشفى الملك فهد العام',
            'مستشفى الملك سلمان',
            'مستشفى الولادة والأطفال',
            'مستشفى المركز الطبي الدولي'
        ];

        $positions = [
            'استشاري',
            'استشارية',
            'أخصائي',
            'أخصائية',
            'استشاري أول',
            'رئيس قسم',
            'نائب رئيس قسم'
        ];

        for ($i = 0; $i < $count; $i++) {
            $specialty = $specialties->random();
            $city = $cities[array_rand($cities)];
            $name = $arabicNames[array_rand($arabicNames)];
            $yearsExp = rand(3, 25);
            $graduationYear = date('Y') - $yearsExp - rand(4, 8);

            $additionalDoctors[] = [
                'name' => $name,
                'email' => strtolower(str_replace(' ', '.', $name) . $i . '@medical.com'),
                'phone' => '+96650' . rand(1000000, 9999999),
                'specialty' => $specialty->name_en,
                'medical_license_number' => 'SA-' . substr($specialty->name_en, 0, 3) . '-' . str_pad($i + 100, 3, '0', STR_PAD_LEFT),
                'years_of_experience' => $yearsExp,
                'medical_school' => $medicalSchools[array_rand($medicalSchools)],
                'graduation_year' => $graduationYear,
                'current_hospital' => $hospitals[array_rand($hospitals)],
                'current_position' => $positions[array_rand($positions)] . ' ' . $specialty->name,
                'consultation_fee' => rand(150, 400),
                'city' => $city,
                'bio' => $this->generateBio($specialty->name, $yearsExp, $city),
            ];
        }

        return $additionalDoctors;
    }

    private function getArabicNames()
    {
        return [
            'د. أحمد محمد الشهري',
            'د. محمد عبدالله القحطاني',
            'د. خالد إبراهيم الحربي',
            'د. سعود ناصر العتيبي',
            'د. عبدالعزيز سعد الزهراني',
            'د. فهد مبارك الغامدي',
            'د. تركي فيصل السبيعي',
            'د. بدر عبدالرحمن الدوسري',
            'د. ناصر علي القاضي',
            'د. يوسف حمود الرشيد',
            'د. سارة أحمد العلي',
            'د. فاطمة خالد السديري',
            'د. نورة عبدالعزيز الفهد',
            'د. هدى محمد التركي',
            'د. أمل إبراهيم الجهني',
            'د. لمى سعيد الشمري',
            'د. مها ناصر الحارثي',
            'د. ريم عبدالله القصير',
            'د. غادة وليد السفياني',
            'د. أسماء محمد العريفي'
        ];
    }

    private function getGenderFromName($name)
    {
        $femaleIndicators = ['سارة', 'فاطمة', 'نورة', 'هدى', 'أمل', 'لمى', 'مها', 'ريم', 'غادة', 'أسماء'];

        foreach ($femaleIndicators as $indicator) {
            if (strpos($name, $indicator) !== false) {
                return 'female';
            }
        }

        return 'male';
    }

    private function generateRandomBirthDate($yearsOfExperience)
    {
        $minAge = $yearsOfExperience + 28; // افتراض أن العمر عند التخرج 24 + سنوات الخبرة
        $maxAge = $yearsOfExperience + 45;
        $age = rand($minAge, $maxAge);

        $birthYear = date('Y') - $age;
        $birthMonth = rand(1, 12);
        $birthDay = rand(1, 28);

        return Carbon::create($birthYear, $birthMonth, $birthDay)->format('Y-m-d');
    }

    private function generateBio($specialty, $yearsExp, $city)
    {
        $bios = [
            "متخصص في $specialty مع خبرة تزيد عن $yearsExp سنة في مجال التخصص. حاصل على عدة شهادات في مجال التخصص ويقدم رعاية طبية متميزة في $city.",
            "يمتلك خبرة واسعة في $specialty تصل إلى $yearsExp سنة. معتمد من عدة جهات طبية ويتميز بالدقة في التشخيص والعلاج في $city.",
            "خبير في $specialty مع خبرة عملية ممتدة لـ $yearsExp سنة. حاصل على البورد السعودي ويقدم استشارات طبية متخصصة في $city.",
            "استشاري $specialty مع خبرة سريرية تبلغ $yearsExp سنة. متخصص في أحدث طرق العلاج والتشخيص ويقدم خدمة طبية متميزة في $city."
        ];

        return $bios[array_rand($bios)];
    }
}
