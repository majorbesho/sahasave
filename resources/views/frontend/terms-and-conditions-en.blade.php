@extends('frontend.layouts.master')
@section('content')
    <section class="py-12 seha-policy-section md:py-20 bg-gray-50 dark:bg-gray-900">
        <div class="container max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-extrabold text-blue-700 dark:text-blue-400">Terms and Conditions</h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">Last Updated: November 16, 2025</p>
            </div>

            <div class="space-y-8 text-gray-700 dark:text-gray-300">
                <div class="p-6 bg-white border-l-4 border-blue-500 shadow-lg policy-block dark:bg-gray-800 rounded-xl">
                    <h2 class="mb-3 text-2xl font-bold text-blue-600 dark:text-blue-300">1. Acceptance and Compliance</h2>
                    <p>By using the "sehaSave" Platform, you acknowledge and agree to be bound by these Terms and
                        Conditions. If you do not agree to any part of these terms, please refrain from using the Platform.
                    </p>
                </div>

                <div class="p-6 bg-white border-l-4 border-blue-500 shadow-lg policy-block dark:bg-gray-800 rounded-xl">
                    <h2 class="mb-3 text-2xl font-bold text-blue-600 dark:text-blue-300">2. Nature of Service</h2>
                    <p>sehaSave operates as an **intermediary referral and booking platform** between patients and medical
                        service providers. The Platform is not a healthcare provider and does not assume responsibility for
                        the quality or outcome of the medical services rendered.</p>
                    <ul class="mt-3 space-y-2 list-disc list-inside">
                        <li><strong>Provider Responsibility:</strong> Service providers are solely responsible for their
                            licenses, service quality, and adherence to professional standards.</li>
                        <li><strong>Incentive System:</strong> Incentives (Discount/Cashback) are granted based solely on
                            confirmed and completed bookings made through the Platform.</li>
                    </ul>
                </div>

                <div class="p-6 bg-white border-l-4 border-blue-500 shadow-lg policy-block dark:bg-gray-800 rounded-xl">
                    <h2 class="mb-3 text-2xl font-bold text-blue-600 dark:text-blue-300">3. Platform Commission and
                        Incentives</h2>
                    <p>Service providers agree to pay a commission to the Platform for every successful and completed
                        booking. A portion of this commission is distributed as an **Incentive (Cashback)** to the patient
                        to foster loyalty and repeated usage.</p>
                </div>

                <div class="p-6 bg-white border-l-4 border-blue-500 shadow-lg policy-block dark:bg-gray-800 rounded-xl">
                    <h2 class="mb-3 text-2xl font-bold text-blue-600 dark:text-blue-300">4. Termination</h2>
                    <p>sehaSave reserves the right to suspend or terminate your access to the Platform if you violate any of
                        these terms or the contractual conditions signed with service providers.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
