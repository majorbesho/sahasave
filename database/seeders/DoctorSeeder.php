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
        //User::where('role', 'doctor')->delete();

        $specialties = Specialty::all();
        $cities = ['Dubai', 'Abu Dhabi', 'Sharjah', 'Ajman', 'Al Ain', 'Ras Al Khaimah', 'Fujairah', 'Umm Al Quwain'];

        $doctors = [
            // أطباء القلب والأوعية الدموية
            [
                'name' => 'Dr. Ahmed Mohammed Al Ali',
                'email' => 'ahmed.alali@medical.ae',
                'phone' => '+971501234001',
                'specialty' => 'Cardiology',
                'medical_license_number' => 'UAE-CARD-001',
                'years_of_experience' => 15,
                'medical_school' => 'College of Medicine - UAE University',
                'graduation_year' => 2008,
                'current_hospital' => 'Cleveland Clinic Abu Dhabi',
                'current_position' => 'Consultant Cardiologist',
                'consultation_fee' => 400,
                'city' => 'Abu Dhabi',
                'bio' => 'Consultant in Cardiology and Interventional Cardiology, holder of UAE Board and American Board in Cardiology.',
                'qualifications' => ['UAE Board of Internal Medicine', 'UAE Board of Cardiology', 'Fellowship from Cleveland Clinic'],
            ],
            [
                'name' => 'Dr. Sara Abdullah Al Harbi',
                'email' => 'sara.alharbi@medical.ae',
                'phone' => '+971501234002',
                'specialty' => 'Cardiology',
                'medical_license_number' => 'UAE-CARD-002',
                'years_of_experience' => 12,
                'medical_school' => 'Dubai Medical College',
                'graduation_year' => 2011,
                'current_hospital' => 'American Hospital Dubai',
                'current_position' => 'Pediatric Cardiologist',
                'consultation_fee' => 350,
                'city' => 'Dubai',
                'bio' => 'Pediatric Cardiologist specialized in diagnostic catheterization and congenital heart defects in children.',
            ],

            // أطباء الأطفال
            [
                'name' => 'Dr. Khalid Ibrahim Al Sudairi',
                'email' => 'khaled.alsudairi@medical.ae',
                'phone' => '+971501234003',
                'specialty' => 'Pediatrics',
                'medical_license_number' => 'UAE-PED-001',
                'years_of_experience' => 20,
                'medical_school' => 'Gulf Medical University',
                'graduation_year' => 2003,
                'current_hospital' => 'Al Jalila Children\'s Hospital',
                'current_position' => 'Consultant Pediatrician',
                'consultation_fee' => 300,
                'city' => 'Dubai',
                'bio' => 'Consultant in Neonatology and Pediatrics, holder of British Fellowship in Pediatrics.',
            ],
            [
                'name' => 'Dr. Fatima Nasser Al Qahtani',
                'email' => 'fatima.alqahtani@medical.ae',
                'phone' => '+971501234004',
                'specialty' => 'Pediatrics',
                'medical_license_number' => 'UAE-PED-002',
                'years_of_experience' => 8,
                'medical_school' => 'University of Sharjah Medical College',
                'graduation_year' => 2015,
                'current_hospital' => 'Sheikh Khalifa Hospital',
                'current_position' => 'Specialist Pediatrician',
                'consultation_fee' => 250,
                'city' => 'Abu Dhabi',
                'bio' => 'Specialist in Pediatrics and Neonatology, focused on respiratory diseases in children.',
            ],

            // أطباء الجراحة العامة
            [
                'name' => 'Dr. Mohammed Saeed Al Ghafri',
                'email' => 'mohamed.alghafri@medical.ae',
                'phone' => '+971501234005',
                'specialty' => 'General Surgery',
                'medical_license_number' => 'UAE-SUR-001',
                'years_of_experience' => 18,
                'medical_school' => 'UAE University College of Medicine',
                'graduation_year' => 2005,
                'current_hospital' => 'Rashid Hospital',
                'current_position' => 'Consultant General Surgeon',
                'consultation_fee' => 450,
                'city' => 'Dubai',
                'bio' => 'Consultant in General Surgery and Laparoscopic Surgery, specialized in gastrointestinal and gland surgeries.',
            ],

            // أطباء النساء والتوليد
            [
                'name' => 'Dr. Huda Abdulrahman Al Otaibi',
                'email' => 'huda.alotaibi@medical.ae',
                'phone' => '+971501234006',
                'specialty' => 'Obstetrics and Gynecology',
                'medical_license_number' => 'UAE-OBG-001',
                'years_of_experience' => 14,
                'medical_school' => 'Dubai Medical College',
                'graduation_year' => 2009,
                'current_hospital' => 'Latifa Women and Children Hospital',
                'current_position' => 'Consultant OBGYN',
                'consultation_fee' => 350,
                'city' => 'Dubai',
                'bio' => 'Consultant in Obstetrics, Gynecology and Laparoscopic Surgery, specialized in infertility and IVF.',
            ],
            [
                'name' => 'Dr. Lama Ahmed Al Shamsi',
                'email' => 'lama.alshamsi@medical.ae',
                'phone' => '+971501234007',
                'specialty' => 'Obstetrics and Gynecology',
                'medical_license_number' => 'UAE-OBG-002',
                'years_of_experience' => 10,
                'medical_school' => 'University of Sharjah Medical College',
                'graduation_year' => 2013,
                'current_hospital' => 'Corniche Hospital',
                'current_position' => 'Specialist OBGYN',
                'consultation_fee' => 300,
                'city' => 'Abu Dhabi',
                'bio' => 'Specialist in Obstetrics and Gynecology, focused on high-risk pregnancy and postnatal care.',
            ],

            // أطباء الباطنية
            [
                'name' => 'Dr. Waleed Hassan Al Rashid',
                'email' => 'waleed.alrasheed@medical.ae',
                'phone' => '+971501234008',
                'specialty' => 'Internal Medicine',
                'medical_license_number' => 'UAE-INT-001',
                'years_of_experience' => 16,
                'medical_school' => 'UAE University College of Medicine',
                'graduation_year' => 2007,
                'current_hospital' => 'Cleveland Clinic Abu Dhabi',
                'current_position' => 'Consultant Internal Medicine',
                'consultation_fee' => 320,
                'city' => 'Abu Dhabi',
                'bio' => 'Consultant in Internal Medicine and Endocrinology, specialized in diabetes and gland disorders.',
            ],

            // أطباء العظام
            [
                'name' => 'Dr. Abdullah Nasser Al Falahi',
                'email' => 'abdullah.alfalahi@medical.ae',
                'phone' => '+971501234009',
                'specialty' => 'Orthopedics',
                'medical_license_number' => 'UAE-ORT-001',
                'years_of_experience' => 13,
                'medical_school' => 'Gulf Medical University',
                'graduation_year' => 2010,
                'current_hospital' => 'Al Zahra Hospital Dubai',
                'current_position' => 'Consultant Orthopedic Surgeon',
                'consultation_fee' => 420,
                'city' => 'Dubai',
                'bio' => 'Consultant in Orthopedic Surgery and Joint Replacement, specialized in spinal surgeries and joint replacement.',
            ],

            // أطباء الجلدية
            [
                'name' => 'Dr. Nora Khaled Al Darmaki',
                'email' => 'nora.aldarmaki@medical.ae',
                'phone' => '+971501234010',
                'specialty' => 'Dermatology',
                'medical_license_number' => 'UAE-DER-001',
                'years_of_experience' => 9,
                'medical_school' => 'University of Sharjah Medical College',
                'graduation_year' => 2014,
                'current_hospital' => 'American Hospital Dubai',
                'current_position' => 'Dermatology Specialist',
                'consultation_fee' => 280,
                'city' => 'Dubai',
                'bio' => 'Specialist in Dermatology and Laser Treatment, focused on skin diseases for children and adults.',
            ],

            // أطباء العيون
            [
                'name' => 'Dr. Yasser Mohammed Al Qubaisi',
                'email' => 'yasser.alqubaisi@medical.ae',
                'phone' => '+971501234011',
                'specialty' => 'Ophthalmology',
                'medical_license_number' => 'UAE-OPH-001',
                'years_of_experience' => 17,
                'medical_school' => 'UAE University College of Medicine',
                'graduation_year' => 2006,
                'current_hospital' => 'Magrabi Eye Hospital',
                'current_position' => 'Consultant Ophthalmologist',
                'consultation_fee' => 380,
                'city' => 'Dubai',
                'bio' => 'Consultant in Eye Surgery and Vision Correction, specialized in retinal surgeries and LASIK.',
            ],

            // أطباء الأنف والأذن والحنجرة
            [
                'name' => 'Dr. Badr Abdulaziz Al Suwaidi',
                'email' => 'badr.alsuwaidi@medical.ae',
                'phone' => '+971501234012',
                'specialty' => 'ENT',
                'medical_license_number' => 'UAE-ENT-001',
                'years_of_experience' => 11,
                'medical_school' => 'Dubai Medical College',
                'graduation_year' => 2012,
                'current_hospital' => 'Rashid Hospital',
                'current_position' => 'ENT Consultant',
                'consultation_fee' => 340,
                'city' => 'Dubai',
                'bio' => 'ENT Consultant and Endoscopic Surgeon, specialized in sinus surgeries and endoscopy.',
            ],

            // أطباء المخ والأعصاب
            [
                'name' => 'Dr. Majed Ibrahim Al Tunaiji',
                'email' => 'majed.altunaiji@medical.ae',
                'phone' => '+971501234013',
                'specialty' => 'Neurology',
                'medical_license_number' => 'UAE-NEU-001',
                'years_of_experience' => 15,
                'medical_school' => 'UAE University College of Medicine',
                'graduation_year' => 2008,
                'current_hospital' => 'Sheikh Khalifa Hospital',
                'current_position' => 'Consultant Neurologist',
                'consultation_fee' => 400,
                'city' => 'Abu Dhabi',
                'bio' => 'Consultant in Neurology, specialized in epilepsy and stroke treatment.',
            ],

            // أطباء المسالك البولية
            [
                'name' => 'Dr. Tariq Saad Al Hameli',
                'email' => 'tarek.alhameli@medical.ae',
                'phone' => '+971501234014',
                'specialty' => 'Urology',
                'medical_license_number' => 'UAE-URO-001',
                'years_of_experience' => 12,
                'medical_school' => 'University of Sharjah Medical College',
                'graduation_year' => 2011,
                'current_hospital' => 'Al Zahra Hospital Dubai',
                'current_position' => 'Consultant Urologist',
                'consultation_fee' => 390,
                'city' => 'Dubai',
                'bio' => 'Consultant in Urology and Endoscopic Surgery, specialized in prostate and stone surgeries.',
            ],

            // أطباء الأسنان
            [
                'name' => 'Dr. Ali Mohammed Al Junaibi',
                'email' => 'ali.aljunaibi@medical.ae',
                'phone' => '+971501234015',
                'specialty' => 'Dentistry',
                'medical_license_number' => 'UAE-DEN-001',
                'years_of_experience' => 8,
                'medical_school' => 'Dubai Dental College',
                'graduation_year' => 2015,
                'current_hospital' => 'Dubai Dental Clinic',
                'current_position' => 'Cosmetic Dentistry Consultant',
                'consultation_fee' => 200,
                'city' => 'Dubai',
                'bio' => 'Consultant in Cosmetic and Implant Dentistry, specialized in ceramic veneers and gum treatments.',
            ],
        ];

        // إنشاء أطباء إضافيين بشكل عشوائي
        $additionalDoctors = $this->generateAdditionalDoctors(30, $specialties, $cities);
        $allDoctors = array_merge($doctors, $additionalDoctors);

        foreach ($allDoctors as $doctorData) {
            $this->createDoctor($doctorData, $specialties);
        }

        $this->command->info('Successfully created ' . count($allDoctors) . ' doctors!');
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
            'password' => Hash::make('11111111'),
            'role' => 'doctor',
            'status' => 'active',
            'email_verified_at' => now(),
            'gender' => $this->getGenderFromName($data['name']),
            'nationality' => 'Emirati',
            'date_of_birth' => $this->generateRandomBirthDate($data['years_of_experience']),
            'address' => $data['city'] . ', United Arab Emirates',
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
            'qualifications' => $data['qualifications'] ?? ['UAE Board', 'Specialty Fellowship'],
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
            'UAE University College of Medicine',
            'Dubai Medical College',
            'University of Sharjah Medical College',
            'Gulf Medical University',
            'Ajman University Medical College',
            'Ras Al Khaimah Medical College',
            'Abu Dhabi Medical University',
            'Al Ain Medical College'
        ];

        $hospitals = [
            'Cleveland Clinic Abu Dhabi',
            'American Hospital Dubai',
            'Rashid Hospital',
            'Al Zahra Hospital Dubai',
            'Sheikh Khalifa Hospital',
            'Al Jalila Children\'s Hospital',
            'Latifa Women and Children Hospital',
            'Corniche Hospital',
            'Mediclinic City Hospital',
            'NMC Royal Hospital'
        ];

        $positions = [
            'Consultant',
            'Specialist',
            'Senior Consultant',
            'Head of Department',
            'Deputy Head of Department'
        ];

        for ($i = 0; $i < $count; $i++) {
            $specialty = $specialties->random();
            $city = $cities[array_rand($cities)];
            $name = $arabicNames[array_rand($arabicNames)];
            $yearsExp = rand(3, 25);
            $graduationYear = date('Y') - $yearsExp - rand(4, 8);

            $additionalDoctors[] = [
                'name' => $name,
                'email' => strtolower(str_replace([' ', '.'], '', $name) . $i . '@medical.ae'),
                'phone' => '+97150' . rand(1000000, 9999999),
                'specialty' => $specialty->name_en,
                'medical_license_number' => 'UAE-' . substr($specialty->name_en, 0, 3) . '-' . str_pad($i + 100, 3, '0', STR_PAD_LEFT),
                'years_of_experience' => $yearsExp,
                'medical_school' => $medicalSchools[array_rand($medicalSchools)],
                'graduation_year' => $graduationYear,
                'current_hospital' => $hospitals[array_rand($hospitals)],
                'current_position' => $positions[array_rand($positions)] . ' ' . $specialty->name_en,
                'consultation_fee' => rand(200, 500),
                'city' => $city,
                'bio' => $this->generateBio($specialty->name_en, $yearsExp, $city),
            ];
        }

        return $additionalDoctors;
    }

    private function getArabicNames()
    {
        return [
            'Dr. Ahmed Mohammed Al Shehhi',
            'Dr. Mohammed Abdullah Al Qasimi',
            'Dr. Khalid Ibrahim Al Nuaimi',
            'Dr. Saud Nasser Al Maktoum',
            'Dr. Abdulaziz Saad Al Zaabi',
            'Dr. Fahad Mubarak Al Mansoori',
            'Dr. Turki Faisal Al Shamsi',
            'Dr. Badr Abdulrahman Al Darmaki',
            'Dr. Nasser Ali Al Qubaisi',
            'Dr. Yousuf Hamood Al Rashidi',
            'Dr. Sara Ahmed Al Ali',
            'Dr. Fatima Khalid Al Suwaidi',
            'Dr. Nora Abdulaziz Al Falahi',
            'Dr. Huda Mohammed Al Tunaiji',
            'Dr. Amal Ibrahim Al Junaibi',
            'Dr. Lama Saeed Al Shamsi',
            'Dr. Maha Nasser Al Harithi',
            'Dr. Reem Abdullah Al Qasimi',
            'Dr. Ghada Waleed Al Suwaidi',
            'Dr. Asma Mohammed Al Arefi'
        ];
    }

    private function getGenderFromName($name)
    {
        $femaleIndicators = ['Sara', 'Fatima', 'Nora', 'Huda', 'Amal', 'Lama', 'Maha', 'Reem', 'Ghada', 'Asma'];

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
            "Specialist in $specialty with over $yearsExp years of experience in the field. Holder of multiple certifications in the specialty and provides distinguished medical care in $city.",
            "Extensive experience in $specialty reaching $yearsExp years. Certified by multiple medical authorities and distinguished by accuracy in diagnosis and treatment in $city.",
            "Expert in $specialty with practical experience extending for $yearsExp years. Holder of UAE Board and provides specialized medical consultations in $city.",
            "Consultant in $specialty with clinical experience of $yearsExp years. Specialized in the latest treatment and diagnostic methods and provides distinguished medical service in $city."
        ];

        return $bios[array_rand($bios)];
    }
}
