@extends('frontend.layouts.master')

@section('title', 'سياسة الخصوصية | Privacy Policy')


@section('content')<style>
    .policy-container {
        max-width: 1000px;
        margin: 40px auto;
        background: #fff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    .lang-toggle {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 30px;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }
    .btn-lang {
        padding: 8px 20px;
        margin-left: 10px;
        border: 1px solid #007bff;
        border-radius: 20px;
        background: transparent;
        color: #007bff;
        cursor: pointer;
        font-weight: bold;
        transition: all 0.3s;
    }
    .btn-lang.active {
        background: #007bff;
        color: #fff;
    }
    .policy-content {
        line-height: 1.8;
        color: #333;
    }
    .policy-content h1 {
        font-size: 28px;
        color: #1a1a1a;
        margin-bottom: 20px;
        border-bottom: 3px solid #007bff;
        display: inline-block;
        padding-bottom: 10px;
    }
    .policy-content h2 {
        font-size: 20px;
        color: #0056b3;
        margin-top: 30px;
        margin-bottom: 15px;
        background: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
    }
    .policy-content ul {
        margin-bottom: 15px;
        padding-right: 20px; /* Adjusted for RTL default */
    }
    .policy-content li {
        margin-bottom: 8px;
    }
    .last-updated {
        font-size: 0.9em;
        color: #666;
        margin-bottom: 30px;
    }
    /* RTL & LTR Handling */
    .rtl { direction: rtl; text-align: right; }
    .ltr { direction: ltr; text-align: left; }
    .ltr ul { padding-left: 20px; padding-right: 0; }
</style>

<div class="policy-container">
    <div class="lang-toggle">
        <button class="btn-lang active" onclick="switchLang('ar')" id="btn-ar">العربية</button>
        <button class="btn-lang" onclick="switchLang('en')" id="btn-en">English</button>
    </div>

    <div id="policy-ar" class="policy-content rtl">
        <h1>سياسة الخصوصية</h1>
        <p class="last-updated">آخر تحديث: {{ date('d-m-Y') }}</p>

        <p>مرحباً بك في منصة <strong>SehaSave</strong> ("نحن"، "المنصة"، "SehaSave"). نحن ندرك أن بياناتك الطبية والمالية هي أصول حساسة، ونلتزم بحمايتها وفقاً لأعلى المعايير العالمية وبما يتوافق تماماً مع القوانين المعمول بها في دولة الإمارات العربية المتحدة، وتحديداً المرسوم بقانون اتحادي رقم 45 لسنة 2021 بشأن حماية البيانات الشخصية.</p>

        <h2>1. المعلومات التي نجمعها</h2>
        <p>لتقديم خدمات الحجز الطبي والمكافآت (الكاش باك)، نقوم بجمع الأنواع التالية من البيانات:</p>
        <ul>
            <li><strong>البيانات الشخصية والتعريفية:</strong> الاسم الكامل، رقم الهوية/الإقامة (للتحقق من التأمين)، تاريخ الميلاد، والجنس.</li>
            <li><strong>بيانات الاتصال:</strong> رقم الهاتف المحمول (للمصادقة وتأكيد الحجز)، وعنوان البريد الإلكتروني.</li>
            <li><strong>البيانات الصحية (Health Data):</strong> تفاصيل المواعيد المحجوزة، التخصص الطبي المطلوب، اسم الطبيب المعالج، وتاريخ الزيارات. <strong>ملاحظة:</strong> نحن لا نقوم بتخزين التشخيصات الطبية التفصيلية أو نتائج الفحوصات إلا بموافقة صريحة منك لغرض السجل الشخصي أو متطلبات التأمين.</li>
            <li><strong>البيانات المالية (Financial Data):</strong> سجل المعاملات للدفع الإلكتروني (يتم معالجتها عبر بوابات دفع آمنة ولا نحفظ أرقام البطاقات كاملة)، رصيد المحفظة الإلكترونية، وسجلات استحقاق الكاش باك.</li>
            <li><strong>البيانات التقنية:</strong> عنوان IP، نوع الجهاز، وبيانات الموقع الجغرافي (لتوجيهك لأقرب عيادة).</li>
        </ul>

        <h2>2. كيف نستخدم بياناتك (الغرض من المعالجة)</h2>
        <p>نستخدم بياناتك للأغراض التالية فقط:</p>
        <ul>
            <li><strong>إدارة الحجوزات:</strong> ربطك بمقدمي الخدمات الطبية وتأكيد المواعيد .</li>
            <li><strong>حساب وتوزيع الحوافز (Cashback):</strong> تتبع إتمام الزيارة الطبية وقيمة الفاتورة المدفوعة لحساب نسبة الكاش باك المستحقة وإيداعها في محفظتك .</li>
            <li><strong>الامتثال القانوني:</strong> التحقق من الهوية ومنع الاحتيال المالي أو الطبي.</li>
            <li><strong>تحسين الخدمة:</strong> تحليل البيانات (بشكل مجهول الهوية) لفهم اتجاهات السوق وتحسين جودة مقدمي الخدمات.</li>
        </ul>

        <h2>3. مشاركة البيانات والإفصاح عنها</h2>
        <p>نحن لا نبيع بياناتك الشخصية لأي طرف ثالث. تتم مشاركة البيانات فقط في الحدود الضرورية مع:</p>
        <ul>
            <li><strong>مقدمي الخدمات الطبية (الأطباء/العيادات):</strong> نشارك اسمك ورقم هاتفك وسبب الزيارة مع الطبيب الذي قمت بالحجز لديه فقط لغرض تقديم الخدمة .</li>
            <li><strong>معالجي المدفوعات:</strong> شركات بوابات الدفع المعتمدة لإتمام العمليات المالية.</li>
            <li><strong>الجهات التنظيمية:</strong> هيئة الصحة بدبي (DHA) أو السلطات المختصة في حال طُلب منا ذلك بموجب القانون لغرض الامتثال أو التقصي الوبائي.</li>
        </ul>

        <h2>4. أمن البيانات وتخزينها</h2>
        <ul>
            <li><strong>مكان التخزين:</strong> يتم تخزين جميع البيانات الحساسة داخل خوادم آمنة تقع جغرافيًا داخل دولة الإمارات العربية المتحدة أو مراكز بيانات معتمدة، امتثالاً لسيادة البيانات .</li>
            <li><strong>التشفير:</strong> نستخدم بروتوكول SSL/TLS لتشفير البيانات أثناء النقل، وتقنيات تشفير متقدمة للبيانات المخزنة (Encryption at Rest) .</li>
            <li><strong>فصل البيانات:</strong> يتم فصل السجلات المالية عن السجلات الطبية تقنياً لضمان أقصى درجات الخصوصية .</li>
        </ul>

        <h2>5. حقوقك كمستخدم (وفقاً لقانون الإمارات)</h2>
        <p>بموجب قانون حماية البيانات الشخصية الإماراتي، لديك الحقوق التالية:</p>
        <ul>
            <li><strong>حق الوصول:</strong> طلب نسخة من بياناتك التي نحتفظ بها.</li>
            <li><strong>حق التصحيح:</strong> تعديل أي بيانات غير دقيقة في ملفك الشخصي.</li>
            <li><strong>حق النسيان (المحو):</strong> طلب حذف حسابك وبياناتك نهائياً، ما لم نكن ملزمين قانوناً بالاحتفاظ بها (مثل السجلات المالية لأغراض الضريبة أو السجلات الطبية وفق لوائح هيئة الصحة).</li>
            <li><strong>حق سحب الموافقة:</strong> يمكنك إلغاء اشتراكك في الرسائل التسويقية في أي وقت.</li>
        </ul>

        <h2>6. سياسة الكاش باك والمحفظة</h2>
        <p>لضمان الشفافية المالية:</p>
        <ul>
            <li>يتم ربط الكاش باك برقم الحجز (Booking ID). لا يحق للمستخدم المطالبة بكاش باك عن زيارات تمت دون حجز مسبق عبر المنصة.</li>
            <li>تحتفظ SehaSave بالحق في تدقيق المعاملات قبل إيداع الرصيد لمنع الاحتيال.</li>
        </ul>

        <h2>7. اتصل بنا</h2>
        <p>إذا كان لديك أي استفسار حول خصوصيتك، يرجى التواصل مع مسؤول حماية البيانات لدينا:</p>
        <p>البريد الإلكتروني: privacy@sehasave.com<br>
        العنوان: دبي، الإمارات العربية المتحدة</p>
    </div>

    <div id="policy-en" class="policy-content ltr" style="display: none;">
        <h1>Privacy Policy</h1>
        <p class="last-updated">Last Updated: {{ date('d-m-Y') }}</p>

        <p>Welcome to <strong>SehaSave</strong> ("We", "Us", "The Platform"). We recognize that your medical and financial data are sensitive assets. We are committed to protecting them in accordance with global standards and in full compliance with the laws of the United Arab Emirates, specifically Federal Decree-Law No. 45 of 2021 regarding the Protection of Personal Data.</p>

        <h2>1. Information We Collect</h2>
        <p>To provide medical booking and cashback services, we collect the following types of data:</p>
        <ul>
            <li><strong>Identity Data:</strong> Full name, Emirates ID/Residency number (for insurance verification), date of birth, and gender.</li>
            <li><strong>Contact Data:</strong> Mobile number (for authentication and booking confirmation) and email address.</li>
            <li><strong>Health Data:</strong> Details of booked appointments, requested specialty, provider name, and visit history. <strong>Note:</strong> We do not store detailed medical diagnoses or test results unless explicitly consented by you for personal records or insurance requirements.</li>
            <li><strong>Financial Data:</strong> Transaction history for online payments (processed via secure gateways; we do not store full card numbers), wallet balance, and cashback accrual records.</li>
            <li><strong>Technical Data:</strong> IP address, device type, and geolocation (to guide you to the nearest clinic).</li>
        </ul>

        <h2>2. How We Use Your Data (Purpose of Processing)</h2>
        <p>We use your data strictly for the following purposes:</p>
        <ul>
            <li><strong>Booking Management:</strong> Connecting you with healthcare providers and confirming appointments .</li>
            <li><strong>Incentive Calculation (Cashback):</strong> Tracking visit completion and paid invoice value to calculate eligible cashback and deposit it into your wallet .</li>
            <li><strong>Legal Compliance:</strong> Identity verification and prevention of financial or medical fraud.</li>
            <li><strong>Service Improvement:</strong> Analyzing anonymized data to understand market trends and improve provider quality.</li>
        </ul>

        <h2>3. Data Sharing and Disclosure</h2>
        <p>We do not sell your personal data to third parties. Data is shared only to the extent necessary with:</p>
        <ul>
            <li><strong>Healthcare Providers (Doctors/Clinics):</strong> We share your name, phone number, and reason for visit only with the doctor you booked with to facilitate the service .</li>
            <li><strong>Payment Processors:</strong> Authorized payment gateways to complete financial transactions.</li>
            <li><strong>Regulatory Authorities:</strong> Dubai Health Authority (DHA) or competent authorities if required by law for compliance or epidemiological tracking.</li>
        </ul>

        <h2>4. Data Security and Storage</h2>
        <ul>
            <li><strong>Data Residency:</strong> All sensitive data is stored on secure servers geographically located within the UAE or approved data centers, complying with data sovereignty .</li>
            <li><strong>Encryption:</strong> We use SSL/TLS protocols to encrypt data in transit and advanced encryption techniques for data at rest .</li>
            <li><strong>Data Segregation:</strong> Financial records are technically segregated from medical records to ensure maximum privacy .</li>
        </ul>

        <h2>5. Your Rights (Under UAE Law)</h2>
        <p>Under the UAE Data Protection Law, you have the following rights:</p>
        <ul>
            <li><strong>Right of Access:</strong> To request a copy of the data we hold about you.</li>
            <li><strong>Right to Rectification:</strong> To correct any inaccurate data in your profile.</li>
            <li><strong>Right to Erasure (Right to be Forgotten):</strong> To request the deletion of your account and data, unless we are legally required to retain it (e.g., financial records for tax purposes or medical logs per health regulations).</li>
            <li><strong>Right to Withdraw Consent:</strong> You may unsubscribe from marketing communications at any time.</li>
        </ul>

        <h2>6. Cashback & Wallet Policy</h2>
        <p>To ensure financial transparency:</p>
        <ul>
            <li>Cashback is linked to a valid Booking ID. Users cannot claim cashback for visits made without a prior booking through the platform.</li>
            <li>SehaSave reserves the right to audit transactions before depositing funds to prevent fraud.</li>
        </ul>

        <h2>7. Contact Us</h2>
        <p>If you have any inquiries regarding your privacy, please contact our Data Protection Officer:</p>
        <p>Email: privacy@sehasave.com<br>
        Address: Dubai, United Arab Emirates</p>
    </div>
</div>
<script>
    function switchLang(lang) {
        // Hide both
        document.getElementById('policy-ar').style.display = 'none';
        document.getElementById('policy-en').style.display = 'none';
        
        // Remove active class
        document.getElementById('btn-ar').classList.remove('active');
        document.getElementById('btn-en').classList.remove('active');

        // Show selected
        document.getElementById('policy-' + lang).style.display = 'block';
        document.getElementById('btn-' + lang).classList.add('active');
    }
</script>
@endsection

