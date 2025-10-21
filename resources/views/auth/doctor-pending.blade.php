@extends('frontend.layouts.master')

@section('content')


@section('title', 'Application Submitted') {{-- عنوان الصفحة في المتصفح --}}

@push('styles')
@endpush

@section('content')

    <style>
        .pending-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
            text-align: center;
            padding: 2rem;
            margin: auto;
        }

        .pending-card {
            background-color: #fff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            max-width: 600px;
            width: 100%;
            border-top: 5px solid #0d6efd;
            /* لون العلامة التجارية الرئيسي */
            transform: translateY(-20px);
            opacity: 0;
            animation: fadeInUp 0.8s ease-out forwards;
        }

        @keyframes fadeInUp {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .pending-icon {
            font-size: 60px;
            color: #0d6efd;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .pending-card h1 {
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 15px;
            color: #333;
        }

        .pending-card p {
            color: #6c757d;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .timeline {
            list-style: none;
            padding: 0;
            margin: 30px 0;
            position: relative;
        }

        .timeline-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            text-align: left;
        }

        .timeline-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e9ecef;
            color: #adb5bd;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 18px;
            flex-shrink: 0;
        }

        .timeline-item.completed .timeline-icon {
            background-color: #198754;
            /* لون النجاح */
            color: #fff;
        }

        .timeline-item.pending .timeline-icon {
            background-color: #ffc107;
            /* لون الانتظار */
            color: #fff;
        }

        .timeline-content h5 {
            margin-bottom: 2px;
            font-weight: 600;
        }

        .timeline-content p {
            margin-bottom: 0;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .btn-home {
            font-size: 1.1rem;
            padding: 12px 30px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
    </style>

    <div class="pt-5 text-center contanier align-items-center justify-content-center">
        <div class="row">
            <div class="text-center pending-container col-4">
                <div class="pending-card">
                    <!-- 1. الأيقونة التفاعلية -->
                    <div class="pending-icon">
                        <i class="fas fa-hourglass-half"></i> <!-- يمكنك استخدام أيقونة أخرى من FontAwesome -->
                    </div>

                    <!-- 2. الرسالة الرئيسية -->
                    <h1>Thank You for Applying!</h1>
                    <p class="lead">Your application has been successfully submitted and is now under review.</p>

                    <hr class="my-4">

                    <!-- 3. قسم "ماذا بعد؟" -->
                    <h5 class="mb-3">What's Next?</h5>
                    <ul class="timeline">
                        <li class="timeline-item completed">
                            <div class="timeline-icon"><i class="fas fa-check"></i></div>
                            <div class="timeline-content">
                                <h5>Application Submitted</h5>
                                <p>We've received your details and documents.</p>
                            </div>
                        </li>
                        <li class="timeline-item pending">
                            <div class="timeline-icon"><i class="fas fa-user-shield"></i></div>
                            <div class="timeline-content">
                                <h5>Verification In Progress</h5>
                                <p>Our team is currently reviewing your credentials. This may take up to 48 hours.</p>
                            </div>
                        </li>
                        <li class="timeline-item">
                            <div class="timeline-icon"><i class="fas fa-envelope-open-text"></i></div>
                            <div class="timeline-content">
                                <h5>Account Activation</h5>
                                <p>You will receive an email notification once your account is approved.</p>
                            </div>
                        </li>
                    </ul>

                    <!-- 4. زر العودة للصفحة الرئيسية -->
                    <a href="{{ route('home') }}" class="mt-3 btn btn-primary btn-home">
                        <i class="fas fa-home me-2"></i> Back to Homepage
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection


@endsection
