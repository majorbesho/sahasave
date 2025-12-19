@extends('frontend.layouts.master')


@section('content')
    <section class="py-12 seha-policy-section md:py-20 bg-gray-50 dark:bg-gray-900">
        <div class="container max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-extrabold text-orange-700 dark:text-orange-400">سياسة الاسترداد</h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">توضح هذه السياسة آليات استرداد المبالغ المدفوعة عبر
                    المنصة.</p>
            </div>

            <div class="space-y-8 text-gray-700 dark:text-gray-300">
                <div class="p-6 bg-white border-t-4 border-orange-500 shadow-lg policy-block dark:bg-gray-800 rounded-xl">
                    <h2 class="mb-3 text-2xl font-bold text-orange-600 dark:text-orange-300">1. نطاق الاسترداد</h2>
                    <p>تطبق سياسة الاسترداد على المبالغ المدفوعة <strong>مقدماً</strong> عبر منصة sehaSave لضمان الحجز
                        (الوديعة أو الدفع الكامل للخدمة).</p>
                    <ul class="mt-3 space-y-2 list-disc list-inside">
                        <li><strong>رسوم المنصة:</strong> رسوم العمولة المدفوعة للمنصة من قبل مقدم الخدمة <strong>غير قابلة
                                للاسترداد</strong>.</li>
                    </ul>
                </div>

                <div class="p-6 bg-white border-t-4 border-orange-500 shadow-lg policy-block dark:bg-gray-800 rounded-xl">
                    <h2 class="mb-3 text-2xl font-bold text-orange-600 dark:text-orange-300">2. حالات الاسترداد (الكامل)
                    </h2>
                    <ul class="mt-3 space-y-2 list-disc list-inside">
                        <li><strong>الإلغاء من قبل مقدم الخدمة:</strong> إذا ألغى الطبيب/العيادة الحجز دون تقديم بديل مقبول،
                            يتم استرداد المبلغ المدفوع كاملاً.</li>
                        <li><strong>الإلغاء المبكر من قبل المريض:</strong> إذا تم الإلغاء قبل المدة المحددة في سياسة الإلغاء
                            (يُرجى مراجعة سياسة الإلغاء).</li>
                        <li><strong>مشاكل فنية مؤكدة:</strong> في حال عدم إتمام الخدمة بسبب عطل تقني مثبت في المنصة.</li>
                    </ul>
                </div>

                <div class="p-6 bg-white border-t-4 border-orange-500 shadow-lg policy-block dark:bg-gray-800 rounded-xl">
                    <h2 class="mb-3 text-2xl font-bold text-orange-600 dark:text-orange-300">3. استحقاق الكاش باك عند
                        الإلغاء</h2>
                    <p><strong>الكاش باك لا يستحق</strong> إلا بعد إتمام الخدمة وتأكيدها من قبل مقدم الخدمة. في حال إلغاء
                        الحجز قبل تنفيذه، لا يتم إضافة أي رصيد إلى محفظة العميل.</p>
                    <p class="mt-2 font-semibold">إذا تم إلغاء حجز كان العميل قد دفع قيمته مسبقاً، يتم استرداد المبلغ
                        المدفوع (وفقاً لشروط الإلغاء) دون أي خصم لمبلغ الكاش باك، لأن الكاش باك لم يكن قد تم صرفه أو
                        استحقاقه بعد.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
