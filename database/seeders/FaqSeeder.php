<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\faq;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // مسح البيانات القديمة أولاً
        DB::table('faqs')->truncate();

        $faqs = [
            // Medical Services FAQs (Arabic)
            [
                'title' => 'الخدمات الطبية',
                'slug' => Str::slug('medical-services-faq-ar'),
                'qu' => 'كيف يمكنني حجز موعد عبر الإنترنت؟',
                'answer' => 'يمكنك حجز موعد عبر الإنترنت من خلال زيارة موقعنا الإلكتروني والذهاب إلى قسم "حجز المواعيد". ستحتاج إلى إنشاء حساب، اختيار التخصص والطبيب المناسب، وتحديد الوقت والتاريخ المناسبين لك. ستتلقى تأكيدًا بالبريد الإلكتروني والرسائل النصية.',
                'discreption' => 'أسئلة متكررة حول الخدمات الطبية',
                'photo' => 'faqs/medical-services.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'الخدمات الطبية',
                'slug' => Str::slug('insurance-coverage-faq-ar'),
                'qu' => 'هل تغطي التأمين خدماتكم الطبية؟',
                'answer' => 'نعم، نتعامل مع معظم شركات التأمين الطبي الرئيسية في المملكة. ننصحك بالاتصال بفريق دعم المرضى للتحقق من تغطية تأمينك المحدد قبل حجز الموعد. يمكنك أيضًا تقديم معلومات التأمين عبر الإنترنت وسنقوم بالتحقق نيابةً عنك.',
                'discreption' => 'أسئلة حول التغطية التأمينية',
                'photo' => 'faqs/insurance.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'الخدمات الطبية',
                'slug' => Str::slug('emergency-services-faq-ar'),
                'qu' => 'هل تقدمون خدمات طوارئ 24/7؟',
                'answer' => 'نعم، قسم الطوارئ لدينا يعمل على مدار الساعة طوال أيام الأسبوع. يمكنك الحضور مباشرة إلى قسم الطوارئ أو الاتصال بنا مسبقًا للإعلان عن وصولك. فريق الطوارئ لدينا مجهز للتعامل مع جميع أنواع الحالات الطارئة.',
                'discreption' => 'أسئلة حول خدمات الطوارئ',
                'photo' => 'faqs/emergency.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'التكاليف والدفع',
                'slug' => Str::slug('payment-methods-faq-ar'),
                'qu' => 'ما هي طرق الدفع المتاحة؟',
                'answer' => 'نقبل جميع طرق الدفع الرئيسية بما في ذلك: الدفع النقدي، البطاقات الائتمانية والمدينة (فيزا، ماستركارد، أمريكان إكسبريس)، التحويل البنكي، والدفع الإلكتروني عبر بوابات الدفع الآمنة. كما نتعامل مع دفعات التأمين المباشرة.',
                'discreption' => 'أسئلة حول طرق الدفع',
                'photo' => 'faqs/payment.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'التكاليف والدفع',
                'slug' => Str::slug('consultation-fees-faq-ar'),
                'qu' => 'كم تبلغ تكلفة الاستشارة الطبية؟',
                'answer' => 'تختلف تكلفة الاستشارة حسب التخصص والخبرة الطبية. تتراوح الأسعار بين 150 ريال إلى 500 ريال للاستشارة العادية. يمكنك الاطلاع على الأسعار التفصيلية لكل طبيب في صفحته الشخصية على موقعنا الإلكتروني.',
                'discreption' => 'أسئلة حول أسعار الاستشارات',
                'photo' => 'faqs/fees.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'التعيينات والمتابعة',
                'slug' => Str::slug('appointment-reschedule-faq-ar'),
                'qu' => 'كيف يمكنني إعادة جدولة موعدي؟',
                'answer' => 'يمكنك إعادة جدولة موعدك بسهولة من خلال حسابك الشخصي على موقعنا، أو عن طريق الاتصال بمركز خدمة العملاء. ننصح بإعادة الجدولة قبل 24 ساعة على الأقل من الموعد الأصلي لتجنب أي رسوم إلغاء.',
                'discreption' => 'أسئلة حول إعادة جدولة المواعيد',
                'photo' => 'faqs/reschedule.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'التعيينات والمتابعة',
                'slug' => Str::slug('prescription-renewal-faq-ar'),
                'qu' => 'كيف يمكنني تجديد وصفة طبية؟',
                'answer' => 'يمكنك تجديد الوصفات الطبية إما عن طريق حجز موعد مع طبيبك، أو استخدام خدمة تجديد الوصفات عبر الإنترنت إذا كانت حالتك مستقرة. تحتاج إلى تقديم الوصفة القديمة والمعلومات الطبية المطلوبة.',
                'discreption' => 'أسئلة حول تجديد الوصفات',
                'photo' => 'faqs/prescription.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Medical Services FAQs (English)
            [
                'title' => 'Medical Services',
                'slug' => Str::slug('online-appointment-faq-en'),
                'qu' => 'Can I make an appointment online with your hospital?',
                'answer' => 'Yes, you can book appointments online through our website by visiting the "Book Appointment" section. You need to create an account, select the appropriate specialty and doctor, and choose your preferred date and time. You will receive confirmation via email and SMS.',
                'discreption' => 'Frequently asked questions about medical services',
                'photo' => 'faqs/online-booking.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Medical Services',
                'slug' => Str::slug('insurance-faq-en'),
                'qu' => 'Do you accept medical insurance?',
                'answer' => 'Yes, we work with most major medical insurance companies in the Kingdom. We recommend contacting our patient support team to verify your specific insurance coverage before booking an appointment. You can also submit your insurance information online, and we will verify it for you.',
                'discreption' => 'Questions about insurance coverage',
                'photo' => 'faqs/medical-insurance.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Medical Services',
                'slug' => Str::slug('emergency-faq-en'),
                'qu' => 'Do you offer 24/7 emergency services?',
                'answer' => 'Yes, our emergency department operates 24 hours a day, 7 days a week. You can come directly to the emergency department or call ahead to announce your arrival. Our emergency team is equipped to handle all types of emergency cases.',
                'discreption' => 'Questions about emergency services',
                'photo' => 'faqs/24-7-emergency.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Costs & Payment',
                'slug' => Str::slug('payment-options-faq-en'),
                'qu' => 'What payment methods do you accept?',
                'answer' => 'We accept all major payment methods including: cash, credit and debit cards (Visa, Mastercard, American Express), bank transfers, and secure online payment gateways. We also handle direct insurance payments.',
                'discreption' => 'Questions about payment methods',
                'photo' => 'faqs/payment-options.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Costs & Payment',
                'slug' => Str::slug('consultation-cost-faq-en'),
                'qu' => 'How much does a medical consultation cost?',
                'answer' => 'Consultation costs vary depending on specialty and medical expertise. Prices range from 150 SAR to 500 SAR for a regular consultation. You can view detailed prices for each doctor on their profile page on our website.',
                'discreption' => 'Questions about consultation fees',
                'photo' => 'faqs/consultation-cost.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Appointments & Follow-up',
                'slug' => Str::slug('reschedule-appointment-faq-en'),
                'qu' => 'How can I reschedule my appointment?',
                'answer' => 'You can easily reschedule your appointment through your personal account on our website, or by contacting our customer service center. We recommend rescheduling at least 24 hours before the original appointment to avoid any cancellation fees.',
                'discreption' => 'Questions about rescheduling appointments',
                'photo' => 'faqs/rescheduling.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Appointments & Follow-up',
                'slug' => Str::slug('prescription-renewal-faq-en'),
                'qu' => 'How can I renew a prescription?',
                'answer' => 'You can renew prescriptions either by booking an appointment with your doctor, or using our online prescription renewal service if your condition is stable. You need to provide the old prescription and required medical information.',
                'discreption' => 'Questions about prescription renewal',
                'photo' => 'faqs/prescription-renewal.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($faqs as $faq) {
            // إضافة صور افتراضية إذا كانت فارغة
            if (empty($faq['photo'])) {
                $faq['photo'] = 'faqs/default-faq.jpg';
            }
            
            faq::create($faq);
        }

        $this->command->info('✅ FAQs seeded successfully!');
        $this->command->info('📊 Total: ' . count($faqs) . ' FAQs added.');
        $this->command->info('🌐 Languages: Arabic & English FAQs included.');
    }
}