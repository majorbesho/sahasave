@extends('frontend.layouts.master')

@section('content')
    <section class="py-12 seha-policy-section md:py-20 bg-gray-50 dark:bg-gray-900">
        <div class="container max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-extrabold text-red-700 dark:text-red-400">سياسة الإلغاء</h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">تحدد هذه السياسة شروط إلغاء الحجوزات من قبل المريض
                    أو مقدم الخدمة.</p>
            </div>

            <div class="space-y-8 text-gray-700 dark:text-gray-300">
                <div class="p-6 bg-white border-t-4 border-red-500 shadow-lg policy-block dark:bg-gray-800 rounded-xl">
                    <h2 class="mb-3 text-2xl font-bold text-red-600 dark:text-red-300">1. الإلغاء من قبل المريض</h2>
                    <ul class="mt-3 space-y-2 list-disc list-inside">
                        <li><strong>الإلغاء المجاني:</strong> يمكن للمريض إلغاء الحجز مجاناً حتى **24 ساعة** قبل موعد الحجز
                            المقرر. ويتم استرداد المبلغ المدفوع بالكامل (إن وجد).</li>
                        <li><strong>الإلغاء المتأخر:</strong> في حال الإلغاء بعد فترة الـ 24 ساعة، يحق لمقدم الخدمة خصم نسبة
                            من الوديعة المدفوعة (تحدد حسب شروط مقدم الخدمة) ويتم تحويل المبلغ المتبقي إلى المريض.</li>
                        <li><strong>عدم الحضور (No-Show):</strong> في حال عدم حضور المريض للموعد، يتم حجز الوديعة أو جزء
                            منها لمقدم الخدمة، **ولا يتم استحقاق الكاش باك** للحجز الملغى أو غير المكتمل.</li>
                    </ul>
                </div>

                <div class="p-6 bg-white border-t-4 border-red-500 shadow-lg policy-block dark:bg-gray-800 rounded-xl">
                    <h2 class="mb-3 text-2xl font-bold text-red-600 dark:text-red-300">2. الإلغاء من قبل مقدم الخدمة</h2>
                    <p>إذا قام مقدم الخدمة بإلغاء الحجز، يتم إخطار المريض فوراً، ويتم تحويل المبلغ المدفوع مقدماً إلى محفظته
                        الإلكترونية في المنصة أو استرداده كاملاً.</p>
                    <p class="mt-2 font-semibold">تحتفظ المنصة بحقها في اتخاذ إجراءات بحق مقدمي الخدمات الذين يكررون إلغاء
                        الحجوزات.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
