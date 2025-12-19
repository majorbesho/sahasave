<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // 1. إنشاء حساب مدير (Admin)
        // هذا الحساب له كافة الصلاحيات على النظام
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'phone' => '01000000001',
                'password' => Hash::make('11111111'),
                'role' => 'admin',
                'status' => 'active',
                'email_verified_at' => now(), // تفعيل الإيميل مباشرة
            ]
        );

        // 2. إنشاء حساب طبيب فعال (Approved Doctor)
        // هذا هو الطبيب الذي تمت الموافقة عليه ويمكنه استقبال الحجوزات
        User::firstOrCreate(
            ['email' => 'doctor.active@gmail.com'],
            [
                'name' => 'Dr. Ahmed Mahmoud',
                'phone' => '01100000002',
                'password' => Hash::make('11111111'),
                'role' => 'doctor',
                'status' => 'active',
                'email_verified_at' => now(),
                'nationality' => 'Egyptian',
                'date_of_birth' => '1985-05-15', // <<-- الصيغة الصحيحة للتاريخ
                'address' => '123 Main St, Cairo, Egypt',
                'meta' => [ // <<-- إضافة البيانات في حقل meta
                    'specialty' => 'Cardiology',
                    'license_number' => 'DOC12345-ACTIVE',
                    'license_document_path' => 'licenses/sample-license.pdf'
                ]
            ]
        );

        // 3. إنشاء حساب طبيب قيد المراجعة (Pending Doctor)
        // هذا الطبيب سجل ولكن ينتظر موافقة الأدمن
        User::firstOrCreate(
            ['email' => 'doctor.pending@gmail.com'],
            [
                'name' => 'Dr. Sara Ali (Pending)',
                'phone' => '01200000003',
                'password' => Hash::make('11111111'),
                'role' => 'doctor',
                'status' => 'pending', // <<-- أهم جزء: الحالة قيد المراجعة
                'email_verified_at' => now(),
                'nationality' => 'Saudi Arabian',
                'date_of_birth' => '1990-11-20',
                'address' => '456 King Fahd Rd, Riyadh, KSA',
                'meta' => [
                    'specialty' => 'Neurology',
                    'license_number' => 'DOC67890-PENDING',
                    'license_document_path' => 'licenses/pending-license.pdf'
                ]
            ]
        );

        // 4. إنشاء حساب مريض (Patient)
        // هذا هو المستخدم العادي للمنصة
        User::firstOrCreate(
            ['email' => 'patient@gmail.com'],
            [
                'name' => 'Mohamed Saber',
                'phone' => '01500000004',
                'password' => Hash::make('11111111'),
                'role' => 'patient',
                'status' => 'active', // المرضى يكونون فعالين تلقائياً
                'email_verified_at' => now(),
                'nationality' => 'Emirati',
                'date_of_birth' => '1995-02-10',
                'address' => '789 Sheikh Zayed Rd, Dubai, UAE',
            ]
        );



        DB::table('admins')->insert([
            [
                'name' => 'admin',
                'email' => 'beshog32@gmail.com',
                'password' => Hash::make('1111'),
                'status' => 'active',
                'photo' => 'img',
                'phone' => '+97154506729',
                // 'phone_verfiy'=>'0',
            ],
        ]);
    }
}
