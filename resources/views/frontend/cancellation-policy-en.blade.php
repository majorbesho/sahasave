@extends('frontend.layouts.master')


@section('content')
    <section class="py-12 seha-policy-section md:py-20 bg-gray-50 dark:bg-gray-900">
        <div class="container max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-extrabold text-red-700 dark:text-red-400">Cancellation Policy</h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">This policy specifies the terms for cancelling
                    bookings by the patient or service provider.</p>
            </div>

            <div class="space-y-8 text-gray-700 dark:text-gray-300">
                <div class="p-6 bg-white border-l-4 border-red-500 shadow-lg policy-block dark:bg-gray-800 rounded-xl">
                    <h2 class="mb-3 text-2xl font-bold text-red-600 dark:text-red-300">1. Patient Cancellation</h2>
                    <ul class="mt-3 space-y-2 list-disc list-inside">
                        <li><strong>Free Cancellation:</strong> The patient can cancel the booking free of charge up to **24
                            hours** before the scheduled appointment time. Any prepayment (if applicable) will be fully
                            refunded.</li>
                        <li><strong>Late Cancellation:</strong> If the cancellation occurs after the 24-hour window, the
                            service provider reserves the right to deduct a percentage of the paid deposit (determined by
                            the provider's terms), and the remainder is transferred to the patient.</li>
                        <li><strong>No-Show:</strong> In case of a patient no-show, the deposit or a portion of it will be
                            held for the service provider, and **no Cashback is accrued** for the cancelled or incomplete
                            booking.</li>
                    </ul>
                </div>

                <div class="p-6 bg-white border-l-4 border-red-500 shadow-lg policy-block dark:bg-gray-800 rounded-xl">
                    <h2 class="mb-3 text-2xl font-bold text-red-600 dark:text-red-300">2. Provider Cancellation</h2>
                    <p>If the service provider cancels the booking, the patient is immediately notified, and any prepayment
                        is either credited to their electronic wallet on the Platform or fully refunded.</p>
                    <p class="mt-2 font-semibold">The Platform reserves the right to take action against service providers
                        who frequently cancel bookings.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
