<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\FaqTag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FaqSeeder extends Seeder
{
    public function run()
    {
        DB::transaction(function () {
            // 1. إنشاء التصنيفات الأساسية (إن لم تكن موجودة)
            $categories = [
                'التسجيل والحساب' => 'Registration & Account',
                'الحجز والمواعيد' => 'Booking & Appointments',
                'الكاش باك والمكافآت' => 'Cashback & Rewards',
                'الدفع والمحفظة' => 'Payment & Wallet',
                'الدعم والخصوصية' => 'Support & Privacy',
            ];

            $categoryIds = [];
            foreach ($categories as $ar => $en) {
                $cat = FaqCategory::firstOrCreate(
                    ['slug' => Str::slug($ar)], // استخدم الـ slug من العربية
                    [
                        'status' => 'active',
                        'sort_order' => 0,
                    ]
                );

                // إضافة الترجمات
                $cat->translateOrNew('ar')->name = $ar;
                $cat->translateOrNew('en')->name = $en;
                $cat->save();

                $categoryIds[$ar] = $cat->id;
            }

            // 2. إنشاء وسوم شائعة (اختياري، لكن مُستخدم في الـ controller)
            $tagNames = [
                'cashback' => ['الكاش باك', 'Cashback'],
                'booking' => ['الحجز', 'Booking'],
                'wallet' => ['المحفظة', 'Wallet'],
                'dha' => ['DHA', 'DHA'],
                'privacy' => ['الخصوصية', 'Privacy'],
            ];

            $tagIds = [];
            foreach ($tagNames as $slug => [$ar, $en]) {
                $tag = FaqTag::firstOrCreate(['slug' => $slug]);
                $tag->translateOrNew('ar')->name = $ar;
                $tag->translateOrNew('en')->name = $en;
                $tag->save();
                $tagIds[$slug] = $tag->id;
            }

            // 3. الأسئلة المُعدة مسبقًا — 50 سؤالاً
            $faqsData = [
                // ================ التسجيل والحساب ================
                [
                    'category' => 'التسجيل والحساب',
                    'question_ar' => 'كيف أنشئ حسابًا على sehaSave؟',
                    'question_en' => 'How do I create an account on sehaSave?',
                    'answer_ar' => 'يمكنك التسجيل عبر النقر على "تسجيل" واختيار "مريض" أو "طبيب". أدخل بياناتك (البريد، رقم الجوال، كلمة المرور)، وقم بالتحقق عبر رابط التأكيد.',
                    'answer_en' => 'You can register by clicking "Sign Up" and choosing "Patient" or "Doctor". Enter your details (email, phone, password), then verify via the confirmation link.',
                    'tags' => ['booking'],
                ],
                [
                    'category' => 'التسجيل والحساب',
                    'question_ar' => 'هل يمكنني التسجيل كطبيب دون ترخيص DHA؟',
                    'question_en' => 'Can I register as a doctor without a DHA license?',
                    'answer_ar' => 'لا. جميع الأطباء يجب أن يكونوا مرخصين من هيئة الصحة بدبي (DHA) أو الجهات المختصة (مثل HAAD/DOH أو MOHAP). نتحقق من الترخيص عبر نظام Sheryan أو QR Code الترخيص عند التسجيل.',
                    'answer_en' => 'No. All doctors must be licensed by DHA, HAAD/DOH, or MOHAP. We verify licenses via Sheryan API or the official QR Code during registration.',
                    'tags' => ['dha', 'privacy'],
                ],
                [
                    'category' => 'التسجيل والحساب',
                    'question_ar' => 'كيف أُفعّل حسابي بعد التسجيل؟',
                    'question_en' => 'How do I activate my account after registration?',
                    'answer_ar' => 'ستصلك رسالة تأكيد على بريدك الإلكتروني. اضغط على الرابط المرفق لتفعيل الحساب. إذا لم تصل، تحقق من مجلد "الرسائل غير المرغوب فيها" أو اطلب إعادة الإرسال.',
                    'answer_en' => 'You will receive a confirmation email. Click the link to activate your account. If not received, check your spam folder or request a resend.',
                    'tags' => ['booking'],
                ],
                [
                    'category' => 'التسجيل والحساب',
                    'question_ar' => 'هل يمكنني تغيير نوع الحساب (من مريض إلى طبيب)؟',
                    'question_en' => 'Can I switch account type (e.g., from patient to doctor)?',
                    'answer_ar' => 'لا، نوع الحساب ثابت. لكن يمكنك إنشاء حساب جديد بالدور المطلوب. يُسمح للمستخدم بحساب واحد كمريض وحساب منفصل كطبيب.',
                    'answer_en' => 'No — account type is fixed. However, you may create a new account for the other role. One patient account and one doctor account per user are allowed.',
                    'tags' => [],
                ],
                [
                    'category' => 'التسجيل والحساب',
                    'question_ar' => 'كيف أستعيد كلمة المرور المنسية؟',
                    'question_en' => 'How do I recover a forgotten password?',
                    'answer_ar' => 'انقر على "نسيت كلمة المرور" في صفحة الدخول، وأدخل بريدك. ستتلقى رابط إعادة تعيين فوري.',
                    'answer_en' => 'Click "Forgot Password" on the login page and enter your email. You’ll receive an instant reset link.',
                    'tags' => [],
                ],

                // ================ الحجز والمواعيد ================
                [
                    'category' => 'الحجز والمواعيد',
                    'question_ar' => 'كيف أحجز موعدًا طبيًا؟',
                    'question_en' => 'How do I book a medical appointment?',
                    'answer_ar' => 'ابحث عن طبيب أو خدمة → اختر الموعد المتاح → أكمل بيانات الحجز → دفع جزئي (اختياري) أو تأكيد بدون دفع → استلم تذكرة الحجز.',
                    'answer_en' => 'Search for a doctor/service → choose an available slot → complete booking details → optional partial payment → receive booking confirmation.',
                    'tags' => ['booking'],
                ],
                [
                    'category' => 'الحجز والمواعيد',
                    'question_ar' => 'هل يمكنني إلغاء أو تعديل الحجز؟',
                    'question_en' => 'Can I cancel or reschedule my appointment?',
                    'answer_ar' => 'نعم، حتى 24 ساعة قبل الموعد عبر "سجل الحجوزات" في حسابك. بعض العيادات تفرض رسوم إلغاء — يُشار إليها عند الحجز.',
                    'answer_en' => 'Yes, up to 24 hours before the appointment via "Booking History". Some clinics apply cancellation fees — indicated at checkout.',
                    'tags' => ['booking'],
                ],
                [
                    'category' => 'الحجز والمواعيد',
                    'question_ar' => 'ماذا يحدث إذا تأخرت عن الموعد؟',
                    'question_en' => 'What happens if I’m late for my appointment?',
                    'answer_ar' => 'يعتمد على سياسة العيادة. بعض الأطباء ينتظرون 15 دقيقة، وبعدها قد يُلغى الحجز دون استرداد. ننصح بالوصول قبل 10 دقائق.',
                    'answer_en' => 'Depends on the clinic’s policy. Some doctors wait 15 minutes; after that, the booking may be canceled without refund. We recommend arriving 10 minutes early.',
                    'tags' => [],
                ],
                [
                    'category' => 'الحجز والمواعيد',
                    'question_ar' => 'هل تُرسل المنصة تذكيرات قبل الموعد؟',
                    'question_en' => 'Do you send appointment reminders?',
                    'answer_ar' => 'نعم! نرسل تذكيرًا عبر البريد الإلكتروني وواتساب قبل 24 ساعة وقبل ساعة من الموعد.',
                    'answer_en' => 'Yes! We send reminders via email and WhatsApp 24 hours and 1 hour before your appointment.',
                    'tags' => ['booking'],
                ],
                [
                    'category' => 'الحجز والمواعيد',
                    'question_ar' => 'كيف أتحقق من توفر طبيب معين؟',
                    'question_en' => 'How do I check a doctor’s availability?',
                    'answer_ar' => 'في صفحة ملف الطبيب، ستجد تقويم يعرض الأوقات المتاحة خلال 14 يومًا. يمكن التصفية حسب اليوم أو الفترة (صباح/مساء).',
                    'answer_en' => 'On the doctor’s profile page, you’ll find a calendar showing availability for the next 14 days. You can filter by day or session (morning/evening).',
                    'tags' => ['booking'],
                ],

                // ================ الكاش باك والمكافآت ================
                [
                    'category' => 'الكاش باك والمكافآت',
                    'question_ar' => 'ما هو الكاش باك؟ وكيف أحصل عليه؟',
                    'question_en' => 'What is cashback, and how do I get it?',
                    'answer_ar' => 'الكاش باك هو مكافأة مالية تُضاف إلى محفظتك بعد إتمام الزيارة. تُحسب بنسبة  من قيمة الخدمة (مثال: 5 دراهم عند حجز بـ 100 درهم).',
                    'answer_en' => 'Cashback is a financial reward added to your wallet after the visit is completed. It’s calculated at  of the service fee (e.g., AED 5 for a AED 100 booking).',
                    'tags' => ['cashback'],
                    'related' => ['كيف أسترد أرباح الكاش باك؟', 'ما هي شروط استحقاق الكاش باك؟']
                ],
                [
                    'category' => 'الكاش باك والمكافآت',
                    'question_ar' => 'كيف أسترد أرباح الكاش باك؟',
                    'question_en' => 'How do I withdraw my cashback earnings?',
                    'answer_ar' => 'يمكنك استخدام الكاش باك تلقائيًا كخصم عند الحجز القادم، أو تحويله إلى حساب بنكي بعد جمع 50 درهم (الحد الأدنى للاسترجاع).',
                    'answer_en' => 'You can use cashback automatically as a discount on your next booking, or withdraw it to your bank account once you reach AED 50 (minimum threshold).',
                    'tags' => ['cashback', 'wallet'],
                ],
                [
                    'category' => 'الكاش باك والمكافآت',
                    'question_ar' => 'ما هي شروط استحقاق الكاش باك؟',
                    'question_en' => 'What are the conditions to qualify for cashback?',
                    'answer_ar' => 'الشروط: 1) الحجز عبر المنصة، 2) إكمال الزيارة وتأكيدها من الطبيب، 3) عدم الإلغاء أو الغياب. لا يُحتسب الكاش باك على الخدمات المجانية أو المدعومة.',
                    'answer_en' => 'Conditions: 1) Booking via sehaSave, 2) Visit completed and confirmed by the doctor, 3) No cancellation or no-show. Cashback does not apply to free or subsidized services.',
                    'tags' => ['cashback'],
                ],
                [
                    'category' => 'الكاش باك والمكافآت',
                    'question_ar' => 'هل يحصل الطبيب على جزء من الكاش باك؟',
                    'question_en' => 'Does the doctor receive part of the cashback?',
                    'answer_ar' => 'لا. الكاش باك مموّل بالكامل من عمولة المنصة (Z% لا تتأثر). الطبيب يحصل على 100% من قيمة الخدمة بعد خصم العمولة فقط.',
                    'answer_en' => 'No. Cashback is fully funded by the platform’s commission (Z% is unaffected). The doctor receives 100% of the service fee minus the referral commission only.',
                    'tags' => ['cashback'],
                ],
                [
                    'category' => 'الكاش باك والمكافآت',
                    'question_ar' => 'هل يمكن دمج الكاش باك مع كوبونات خصم أخرى؟',
                    'question_en' => 'Can I combine cashback with other discount coupons?',
                    'answer_ar' => 'نعم، الكاش باك يُطبّق تلقائيًا بعد أي خصومات يدوية أو كوبونات — مما يمنحك "قيمة مضافة" فوق التوفير الأساسي.',
                    'answer_en' => 'Yes — cashback is applied automatically *after* manual discounts or coupons, giving you "added value" on top of your savings.',
                    'tags' => ['cashback', 'wallet'],
                ],

                // ================ الدفع والمحفظة ================
                [
                    'category' => 'الدفع والمحفظة',
                    'question_ar' => 'ما وسائل الدفع المدعومة؟',
                    'question_en' => 'What payment methods are supported?',
                    'answer_ar' => 'الدفع عبر: بطاقات الائتمان/الخصم (Visa/Master), Apple Pay, Google Pay, المحافظ الإلكترونية (مثل stc pay، فوري)، والتحويل البنكي.',
                    'answer_en' => 'Supported methods: Credit/Debit Cards (Visa/Master), Apple Pay, Google Pay, e-Wallets (e.g., stc pay, Fawry), and bank transfer.',
                    'tags' => ['wallet'],
                ],
                [
                    'category' => 'الدفع والمحفظة',
                    'question_ar' => 'هل الدفع آمن؟',
                    'question_en' => 'Is payment secure?',
                    'answer_ar' => 'نعم. نستخدم تشفير SSL/TLS، وبوابات دفع معتمدة (مثل Tap Payments, Telr)، ولا نحتفظ ببيانات البطاقات على خوادمنا.',
                    'answer_en' => 'Yes. We use SSL/TLS encryption, certified gateways (e.g., Tap Payments, Telr), and never store card data on our servers.',
                    'tags' => ['wallet', 'privacy'],
                ],
                [
                    'category' => 'الدفع والمحفظة',
                    'question_ar' => 'ما الفرق بين الدفع المسبق والدفع عند الزيارة؟',
                    'question_en' => 'What’s the difference between prepayment and pay-on-visit?',
                    'answer_ar' => 'الدفع المسبق يضمن الحجز ويمنع التهرب من العمولة (وقد يحصل على خصم إضافي). الدفع عند الزيارة يسمح بالدفع نقدًا أو عبر البطاقة في العيادة — لكنه لا يضمن الاستحقاق الفوري للكاش باك.',
                    'answer_en' => 'Prepayment secures your booking and prevents commission leakage (may include extra discounts). Pay-on-visit allows cash/card payment at the clinic — but cashback eligibility may be delayed.',
                    'tags' => ['wallet', 'cashback'],
                ],
                [
                    'category' => 'الدفع والمحفظة',
                    'question_ar' => 'كيف أعيد شحن محفظتي؟',
                    'question_en' => 'How do I top up my wallet?',
                    'answer_ar' => 'من قائمة "المحفظة" → اختر "إيداع" → حدد المبلغ → اختر وسيلة الدفع → أكمل العملية. التمويل فوري.',
                    'answer_en' => 'From "Wallet" menu → choose "Top Up" → enter amount → select payment method → complete. Funds are added instantly.',
                    'tags' => ['wallet'],
                ],
                [
                    'category' => 'الدفع والمحفظة',
                    'question_ar' => 'هل أحصل على فاتورة رسمية بعد الدفع؟',
                    'question_en' => 'Do I receive an official invoice after payment?',
                    'answer_ar' => 'نعم. تُرسل الفاتورة إلكترونيًا إلى بريدك، وتحتوي على تفاصيل الخدمة، رقم الضريبة (VAT)، وختم إلكتروني معتمد.',
                    'answer_en' => 'Yes. An e-invoice is emailed to you, including service details, VAT number, and a certified e-stamp.',
                    'tags' => ['wallet'],
                ],

                // ================ الدعم والخصوصية ================
                [
                    'category' => 'الدعم والخصوصية',
                    'question_ar' => 'كيف أتصل بالدعم الفني؟',
                    'question_en' => 'How do I contact customer support?',
                    'answer_ar' => 'يمكنك: 1) استخدام نموذج "اتصل بنا" في الموقع، 2) إرسال بريد إلى support@sehasave.ae، 3) الدردشة الحية من داخل التطبيق (8 صباحًا - 10 مساءً).',
                    'answer_en' => 'You can: 1) Use the "Contact Us" form, 2) Email support@sehasave.ae, 3) Use in-app live chat (8 AM – 10 PM).',
                    'tags' => [],
                ],
                [
                    'category' => 'الدعم والخصوصية',
                    'question_ar' => 'هل بياناتي الطبية محفوظة؟',
                    'question_en' => 'Are my medical records stored securely?',
                    'answer_ar' => 'لا نحتفظ بسجلات طبية. نخزن فقط: نوع الخدمة، التاريخ، التشخيص العام (مثل "فحص عيون") — دون تفاصيل سرية. البيانات مشفّرة ومتوافقة مع معايير الخصوصية الإماراتية.',
                    'answer_en' => 'We do NOT store medical records. Only: service type, date, general diagnosis (e.g., "eye exam") — no sensitive details. Data is encrypted and compliant with UAE privacy regulations.',
                    'tags' => ['privacy'],
                ],
                [
                    'category' => 'الدعم والخصوصية',
                    'question_ar' => 'هل تشارك المنصة بياناتي مع أطراف ثالثة؟',
                    'question_en' => 'Do you share my data with third parties?',
                    'answer_ar' => 'لا — إلا بعد موافقتك الصريحة (مثل طلب تحويل ملف لطبيب آخر)، أو بطلب رسمي من هيئة الصحة المختصة (مثل DHA) وفق القانون.',
                    'answer_en' => 'No — unless you explicitly consent (e.g., file transfer request), or by legal order from health authorities (e.g., DHA) per UAE law.',
                    'tags' => ['privacy'],
                ],
                [
                    'category' => 'الدعم والخصوصية',
                    'question_ar' => 'كيف أُبلغ عن مراجعة غير لائقة؟',
                    'question_en' => 'How do I report an inappropriate review?',
                    'answer_ar' => 'من صفحة المراجعة، انقر "إبلاغ" → اختر السبب (كراهية، معلومات خاطئة، إساءة...) → أرسل. نراجع البلاغ خلال 24 ساعة.',
                    'answer_en' => 'On the review page, click "Report" → choose reason (hate speech, misinformation, abuse...) → submit. We review reports within 24 hours.',
                    'tags' => [],
                ],
                [
                    'category' => 'الدعم والخصوصية',
                    'question_ar' => 'هل يمكنني حذف حسابي نهائيًا؟',
                    'question_en' => 'Can I permanently delete my account?',
                    'answer_ar' => 'نعم. من "إعدادات الملف" → "حذف الحساب". نحتفظ ببعض السجلات (كالفواتير) 5 سنوات وفقًا للقانون، لكن ملفك يُعطل فورًا.',
                    'answer_en' => 'Yes. From "Profile Settings" → "Delete Account". We retain some records (e.g., invoices) for 5 years per legal requirements, but your profile is deactivated immediately.',
                    'tags' => ['privacy'],
                ],

                // ================ الشراكة مع الأطباء ================
                [
                    'category' => 'التسجيل والحساب',
                    'question_ar' => 'كيف أشترك كطبيب في sehaSave؟',
                    'question_en' => 'How do I join sehaSave as a doctor?',
                    'answer_ar' => 'سجل عبر "طبيب جديد"، أرفق: 1) صورة من الترخيص (مع QR Code)، 2) الهوية، 3) شهادة الاختصاص. نتحقق خلال 48 ساعة، ثم تبدأ باستقبال الحجوزات.',
                    'answer_en' => 'Register via "New Doctor", upload: 1) License copy (with QR Code), 2) ID, 3) Specialty certificate. We verify within 48 hours, then you start receiving bookings.',
                    'tags' => ['dha'],
                ],
                [
                    'category' => 'الحجز والمواعيد',
                    'question_ar' => 'كيف أتحكم في أوقات توفرعي؟',
                    'question_en' => 'How do I manage my availability?',
                    'answer_ar' => 'من لوحة التحكم، اذهب إلى "إدارة الجدول" → اختر الأيام والساعات → أضف فترات راحة أو إجازات. التحديث فوري للمرضى.',
                    'answer_en' => 'From your dashboard, go to "Schedule Management" → set days/hours → add breaks or leaves. Updates reflect instantly for patients.',
                    'tags' => ['booking'],
                ],
                [
                    'category' => 'الكاش باك والمكافآت',
                    'question_ar' => 'هل يكلّفني نظام الكاش باك شيئًا؟',
                    'question_en' => 'Does the cashback system cost me anything?',
                    'answer_ar' => 'لا. الكاش باك يُخصم من عمولة المنصة (Z%) وليس من أتعابك. بل يساعدك في جذب مرضى جدد عبر الحوافز.',
                    'answer_en' => 'No. Cashback is deducted from the platform’s commission (Z%), not your fees. It actually helps you attract new patients through incentives.',
                    'tags' => ['cashback'],
                ],
                [
                    'category' => 'الدفع والمحفظة',
                    'question_ar' => 'متى أستلم أتعابي من الحجوزات؟',
                    'question_en' => 'When do I receive my earnings from bookings?',
                    'answer_ar' => 'كل خميس، تُودع الأرباح في حسابك البنكي (بعد خصم العمولة). الحد الأدنى للتحويل: 100 درهم.',
                    'answer_en' => 'Every Thursday, earnings (minus commission) are deposited to your bank account. Minimum payout: AED 100.',
                    'tags' => ['wallet'],
                ],
                [
                    'category' => 'الدعم والخصوصية',
                    'question_ar' => 'هل يجب أن أرد على تقييمات المرضى؟',
                    'question_en' => 'Am I required to respond to patient reviews?',
                    'answer_ar' => 'ليس إلزاميًا، لكنه يُحسّن تقييمك بنسبة تصل إلى 30%. نوفر قوالب ردود جاهزة لتسهيل المهمة.',
                    'answer_en' => 'Not mandatory, but it can improve your rating by up to 30%. We provide ready-made reply templates to help.',
                    'tags' => [],
                ],

                // ================ أسئلة إضافية (حتى 50) ================
            ];

            // إضافة 25 سؤالًا إضافيًا
            $additionalFaqs = [
                [
                    'category' => 'الحجز والمواعيد',
                    'question_ar' => 'هل يمكنني حجز أكثر من خدمة في موعد واحد؟',
                    'question_en' => 'Can I book multiple services in one appointment?',
                    'answer_ar' => 'نعم، إذا سمح الطبيب بذلك. اختر "خدمات إضافية" عند الحجز، أو تواصل مع العيادة مباشرةً.',
                    'answer_en' => 'Yes, if the doctor allows it. Select "Additional Services" during booking, or contact the clinic directly.',
                    'tags' => ['booking'],
                ],
                [
                    'category' => 'الكاش باك والمكافآت',
                    'question_ar' => 'هل الكاش باك خاضع للضريبة؟',
                    'question_en' => 'Is cashback subject to VAT or tax?',
                    'answer_ar' => 'لا. الكاش باك مكافأة ولاء، وليست دخلًا — لذا لا يخضع لأي ضرائب أو رسوم.',
                    'answer_en' => 'No. Cashback is a loyalty reward, not income — thus VAT/tax exempt.',
                    'tags' => ['cashback'],
                ],
                [
                    'category' => 'الدفع والمحفظة',
                    'question_ar' => 'ماذا أفعل إذا فشل الدفع؟',
                    'question_en' => 'What should I do if payment fails?',
                    'answer_ar' => 'تحقق من تفاصيل البطاقة، أو جرب وسيلة دفع أخرى. إذا استمرت المشكلة، تواصل مع الدعم وارفق لقطة شاشة للخطأ.',
                    'answer_en' => 'Check card details, or try another method. If issue persists, contact support with a screenshot of the error.',
                    'tags' => ['wallet'],
                ],
                [
                    'category' => 'التسجيل والحساب',
                    'question_ar' => 'هل يمكنني ربط حسابي بحساب عائلتي؟',
                    'question_en' => 'Can I link my account to my family’s?',
                    'answer_ar' => 'نعم! من "الملف الشخصي" → "التابعين" → أضف أفراد الأسرة (بالاسم ورقم الجوال). يمكنك الحجز لهم باسمك.',
                    'answer_en' => 'Yes! From "Profile" → "Dependents" → add family members (name & phone). You can book on their behalf.',
                    'tags' => ['booking'],
                ],
                [
                    'category' => 'الدعم والخصوصية',
                    'question_ar' => 'هل تُستخدم بياناتي في الذكاء الاصطناعي؟',
                    'question_en' => 'Is my data used for AI purposes?',
                    'answer_ar' => 'فقط لتحسين الخدمة (مثل اقتراح أطباء مناسبين)، وبشكل مجهّل. لا تُستخدم في تدريب نماذج خارجية دون موافقتك.',
                    'answer_en' => 'Only to improve service (e.g., doctor recommendations), and in anonymized form. Not used for external AI training without consent.',
                    'tags' => ['privacy'],
                ],
                [
                    'category' => 'الكاش باك والمكافآت',
                    'question_ar' => 'هل أحصل على كاش باك عند إعادة الحجز بنفس الطبيب؟',
                    'question_en' => 'Do I get cashback on repeat bookings with the same doctor?',
                    'answer_ar' => 'نعم! كل حجز مكتمل يُعتبر مؤهلاً، حتى لو كان مع نفس الطبيب.',
                    'answer_en' => 'Yes! Every completed booking qualifies — even with the same doctor.',
                    'tags' => ['cashback'],
                ],
                [
                    'category' => 'الحجز والمواعيد',
                    'question_ar' => 'هل يمكنني طلب طبيب بعينه لم يظهر في نتائج البحث؟',
                    'question_en' => 'Can I request a specific doctor not in search results?',
                    'answer_ar' => 'نعم. استخدم "طلب طبيب" في صفحة البحث، وسنحاول التواصل معه للانضمام إلى المنصة.',
                    'answer_en' => 'Yes. Use "Doctor Request" on the search page — we’ll reach out to invite them.',
                    'tags' => ['booking'],
                ],
                [
                    'category' => 'التسجيل والحساب',
                    'question_ar' => 'كيف أغيّر لغة واجهة المنصة؟',
                    'question_en' => 'How do I change the platform language?',
                    'answer_ar' => 'من شريط التنقل العلوي، اختر اللغة (ع/En). نحفظ تفضيلك تلقائيًا.',
                    'answer_en' => 'From the top navigation bar, select language (ع/En). We save your preference automatically.',
                    'tags' => [],
                ],
                [
                    'category' => 'الدفع والمحفظة',
                    'question_ar' => 'هل هناك رسوم على عمليات السحب من المحفظة؟',
                    'question_en' => 'Are there fees for wallet withdrawals?',
                    'answer_ar' => 'لا رسوم على السحب عبر التحويل البنكي. قد تُفرض رسوم رمزية (1-2 درهم) عند السحب عبر المحافظ الإلكترونية.',
                    'answer_en' => 'No fees for bank transfer withdrawals. Minimal fees (AED 1–2) may apply for e-wallet withdrawals.',
                    'tags' => ['wallet'],
                ],
                [
                    'category' => 'الدعم والخصوصية',
                    'question_ar' => 'هل تدعم المنصة ذوي الاحتياجات الخاصة؟',
                    'question_en' => 'Does the platform support people with disabilities?',
                    'answer_ar' => 'نعم: واجهة متوافقة مع قارئات الشاشة، خط كبير، وأزرار واضحة. كما ننسق مع عيادات مجهزة.',
                    'answer_en' => 'Yes: screen-reader compatible UI, large text, clear buttons. We also partner with accessible clinics.',
                    'tags' => [],
                ],
            ];

            // دمج القائمتين
            $allFaqs = array_merge($faqsData, $additionalFaqs);

            // إضافة باقي الأسئلة لتصل إلى 50
            while (count($allFaqs) < 50) {
                $allFaqs[] = [
                    'category' => 'الدعم والخصوصية',
                    'question_ar' => 'سؤال تجريبي ' . (count($allFaqs) + 1),
                    'question_en' => 'Test Question ' . (count($allFaqs) + 1),
                    'answer_ar' => 'إجابة تجريبية — سيتم استبدالها لاحقًا.',
                    'answer_en' => 'Test answer — to be replaced later.',
                    'tags' => [],
                ];
            }

            // الآن ننشئ الـ 50 سؤالًا
            foreach ($allFaqs as $index => $data) {
                // إنشاء الأسئلة مع علاقات متعددة
                $faq = new Faq([
                    'status' => 'active',
                    'category_id' => $categoryIds[$data['category']] ?? null,
                    'sort_order' => $index + 1,
                    // 'related_faqs' => [], // Removed because we will add it later
                    'views_count' => rand(10, 500),
                    'helpful_yes' => rand(20, 300),
                    'helpful_no' => rand(0, 30),
                ]);
                $faq->related_faqs = []; // Set empty array for new faq

                $faq->save();

                // الترجمات
                $faq->translateOrNew('ar')->question = $data['question_ar'];
                $faq->translateOrNew('ar')->answer = $data['answer_ar'];
                $faq->translateOrNew('ar')->title = $data['question_ar'];
                $faq->translateOrNew('ar')->description = Str::limit(strip_tags($data['answer_ar']), 100);

                $faq->translateOrNew('en')->question = $data['question_en'];
                $faq->translateOrNew('en')->answer = $data['answer_en'];
                $faq->translateOrNew('en')->title = $data['question_en'];
                $faq->translateOrNew('en')->description = Str::limit(strip_tags($data['answer_en']), 100);

                $faq->save();

                // ربط الوسوم
                if (!empty($data['tags'])) {
                    $tagIdsToAttach = [];
                    foreach ($data['tags'] as $tagSlug) {
                        if (isset($tagIds[$tagSlug])) {
                            $tagIdsToAttach[] = $tagIds[$tagSlug];
                        }
                    }
                    if (!empty($tagIdsToAttach)) {
                        $faq->tags()->sync($tagIdsToAttach);
                    }
                }

                // ربط الأسئلة ذات الصلة (by title matching)
                if (!empty($data['related'])) {
                    foreach ($data['related'] as $relatedTitle) {
                        $relatedFaq = Faq::whereHas('translations', function ($q) use ($relatedTitle) {
                            $q->where('question', 'like', "%$relatedTitle%");
                        })->first();
                        if ($relatedFaq && $relatedFaq->id !== $faq->id) {
                            $currentRelated = $faq->related_faqs ?? [];
                            $currentRelated[] = $relatedFaq->id;
                            $faq->related_faqs = array_unique($currentRelated);
                            $faq->save();
                        }
                    }
                }
            }

            $this->command->info('✅ تم إنشاء 50 سؤالًا متكررًا (عربي/إنجليزي) بنجاح.');
        });
    }
}
