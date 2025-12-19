@extends('frontend.layouts.master')

@section('content')
    <section class="py-12 seha-policy-section md:py-20 bg-gray-50 dark:bg-gray-900">
        <div class="container max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-extrabold text-orange-700 dark:text-orange-400">Refund Policy</h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">This policy outlines the mechanisms for refunding
                    amounts paid through the Platform.</p>
            </div>

            <div class="space-y-8 text-gray-700 dark:text-gray-300">
                <div class="p-6 bg-white border-l-4 border-orange-500 shadow-lg policy-block dark:bg-gray-800 rounded-xl">
                    <h2 class="mb-3 text-2xl font-bold text-orange-600 dark:text-orange-300">1. Scope of Refund</h2>
                    <p>The Refund Policy applies to amounts paid <strong>in advance</strong> through the sehaSave platform
                        to secure a booking (deposit or full service payment).</p>
                    <ul class="mt-3 space-y-2 list-disc list-inside">
                        <li><strong>Platform Fees:</strong> Commission fees paid to the Platform by the service provider are
                            <strong>non-refundable</strong>.</li>
                    </ul>
                </div>

                <div class="p-6 bg-white border-l-4 border-orange-500 shadow-lg policy-block dark:bg-gray-800 rounded-xl">
                    <h2 class="mb-3 text-2xl font-bold text-orange-600 dark:text-orange-300">2. Full Refund Cases</h2>
                    <ul class="mt-3 space-y-2 list-disc list-inside">
                        <li><strong>Cancellation by Provider:</strong> If the Doctor/Clinic cancels the booking without
                            offering an acceptable alternative, the prepayment is fully refunded.</li>
                        <li><strong>Early Cancellation by Patient:</strong> If the cancellation is made before the time
                            limit specified in the Cancellation Policy (please refer to the Cancellation Policy).</li>
                        <li><strong>Confirmed Technical Issues:</strong> In case the service is not rendered due to a proven
                            technical fault within the Platform.</li>
                    </ul>
                </div>

                <div class="p-6 bg-white border-l-4 border-orange-500 shadow-lg policy-block dark:bg-gray-800 rounded-xl">
                    <h2 class="mb-3 text-2xl font-bold text-orange-600 dark:text-orange-300">3. Cashback Eligibility upon
                        Cancellation</h2>
                    <p><strong>Cashback is only earned</strong> after the service is completed and confirmed by the service
                        provider. In case of booking cancellation prior to execution, no credit is added to the customer's
                        wallet.</p>
                    <p class="mt-2 font-semibold">If a pre-paid booking is cancelled, the paid amount will be refunded
                        (according to cancellation terms) without any deduction for the Cashback amount, as the Cashback was
                        not yet disbursed or accrued.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
