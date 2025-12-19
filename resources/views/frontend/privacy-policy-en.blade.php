@extends('frontend.layouts.master')

@section('content')
    <section class="py-12 seha-policy-section md:py-20 bg-gray-50 dark:bg-gray-900">
        <div class="container max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-extrabold text-green-700 dark:text-green-400">Privacy Policy</h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">We are committed to protecting your health data.</p>
            </div>

            <div class="space-y-8 text-gray-700 dark:text-gray-300">
                <div class="p-6 bg-white border-l-4 border-green-500 shadow-lg policy-block dark:bg-gray-800 rounded-xl">
                    <h2 class="mb-3 text-2xl font-bold text-green-600 dark:text-green-300">1. Types of Data We Collect</h2>
                    <ul class="mt-3 space-y-2 list-disc list-inside">
                        <li><strong>Identification Data:</strong> Name, email, phone number.</li>
                        <li><strong>Booking Data:</strong> Service date and time, service provider's name.</li>
                        <li><strong>Financial Data:</strong> Transaction records related to commissions and Cashback (credit
                            card information is NOT stored).</li>
                        <li><strong>Health Data:</strong> Health data associated with the booking (e.g., required specialty)
                            may be stored and is handled with the highest security and encryption standards.</li>
                    </ul>
                </div>

                <div class="p-6 bg-white border-l-4 border-green-500 shadow-lg policy-block dark:bg-gray-800 rounded-xl">
                    <h2 class="mb-3 text-2xl font-bold text-green-600 dark:text-green-300">2. How We Use Your Data</h2>
                    <p>We use your data to manage bookings, calculate and distribute incentives, improve services, and
                        communicate with you about your appointments.</p>
                </div>

                <div class="p-6 bg-white border-l-4 border-green-500 shadow-lg policy-block dark:bg-gray-800 rounded-xl">
                    <h2 class="mb-3 text-2xl font-bold text-green-600 dark:text-green-300">3. Data Protection and Security
                    </h2>
                    <p>We are committed to applying stringent security standards (such as encryption, backup, and data
                        segregation) in compliance with the health data protection laws (HDP) in the target region to
                        safeguard your information against unauthorized access.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
