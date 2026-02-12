@extends('frontend.layouts.master')

@section('content')
    @php
        $lang = app()->getLocale();
        $isRTL = $lang === 'ar';
    @endphp

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary: #0ea5e9;
            --primary-dark: #0284c7;
            --accent: #f59e0b;
            --bg-dark: #0f172a;
            --glass: rgba(255, 255, 255, 0.95);
        }

        body {
            font-family: 'Tajawal', {{ $isRTL ? 'sans-serif' : 'system-ui, -apple-system, sans-serif' }};
            direction: {{ $isRTL ? 'rtl' : 'ltr' }};
            overflow-x: hidden;
            background-color: #f8fafc;
        }

        /* Language Switcher */
        .lang-switcher {
            position: fixed;
            {{ $isRTL ? 'left: 20px' : 'right: 20px' }};
            top: 20px;
            z-index: 1000;
        }

        .lang-btn {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            padding: 8px 16px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .lang-btn:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 5px;
        }

        /* Hero Gradient Animation */
        .hero-bg {
            background: linear-gradient(-45deg, #0ea5e9, #2563eb, #0f172a, #f59e0b);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Floating Cards Animation */
        .float-card {
            animation: float 6s ease-in-out infinite;
        }
        .float-card-delay {
            animation: float 6s ease-in-out infinite 3s;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        /* Step Connector Line */
        .step-connector {
            position: absolute;
            top: 50%;
            {{ $isRTL ? 'right: 0' : 'left: 0' }};
            width: 100%;
            height: 4px;
            background: #e2e8f0;
            z-index: -1;
            transform: translateY(-50%);
        }

        .step-connector::after {
            content: '';
            position: absolute;
            top: 0;
            {{ $isRTL ? 'right: 0' : 'left: 0' }};
            height: 100%;
            width: 0%;
            background: var(--primary);
            transition: width 1.5s ease;
        }

        .steps-container.active .step-connector::after {
            width: 100%;
        }

        /* Coin Spin */
        .coin-icon {
            transform-style: preserve-3d;
            animation: spin 4s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotateY(0deg); }
            100% { transform: rotateY(360deg); }
        }

        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .glass-dark {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Custom Shapes */
        .blob {
            position: absolute;
            filter: blur(50px);
            z-index: 0;
            opacity: 0.6;
        }

        /* RTL/LTR Specific Adjustments */
        .rtl-float-right {
            {{ $isRTL ? 'float: right' : 'float: left' }};
        }

        .text-direction {
            direction: {{ $isRTL ? 'rtl' : 'ltr' }};
            text-align: {{ $isRTL ? 'right' : 'left' }};
        }

        .margin-start {
            margin-{{ $isRTL ? 'right' : 'left' }}: auto;
        }

        .margin-end {
            margin-{{ $isRTL ? 'left' : 'right' }}: auto;
        }

        .padding-start {
            padding-{{ $isRTL ? 'right' : 'left' }}: 1rem;
        }

        .padding-end {
            padding-{{ $isRTL ? 'left' : 'right' }}: 1rem;
        }

        .border-start {
            border-{{ $isRTL ? 'right' : 'left' }}: 1px solid #e2e8f0;
        }

        .border-end {
            border-{{ $isRTL ? 'left' : 'right' }}: 1px solid #e2e8f0;
        }

        /* Animation Delays for RTL/LTR */
        @keyframes fadeInRTL {
            from {
                opacity: 0;
                transform: {{ $isRTL ? 'translateX(-30px)' : 'translateX(30px)' }};
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-rtl {
            animation: fadeInRTL 0.6s ease-out;
        }

        /* Flex direction adjustments */
        .flex-direction {
            flex-direction: {{ $isRTL ? 'row' : 'row' }};
        }

        .flex-direction-reverse {
            flex-direction: {{ $isRTL ? 'row-reverse' : 'row' }};
        }
    </style>


    <!-- Hero Section -->
    <header class="relative min-h-screen flex items-center pt-20 overflow-hidden hero-bg text-white">
        <!-- Floating Blobs -->
        <div class="blob bg-blue-500 w-96 h-96 rounded-full top-0 {{ $isRTL ? 'right-0' : 'left-0' }} mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="blob bg-yellow-400 w-96 h-96 rounded-full bottom-0 {{ $isRTL ? 'left-0' : 'right-0' }} mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

        <div class="container mx-auto px-6 relative z-10 {{ $isRTL ? 'md:grid-cols-2' : 'md:grid-cols-2' }} gap-12 items-center grid">
            <div data-aos="{{ $isRTL ? 'fade-left' : 'fade-right' }}" data-aos-duration="1000" class="{{ $isRTL ? 'order-2' : 'order-1' }}">
                <div class="inline-block bg-white/20 backdrop-blur-md border border-white/30 rounded-full px-4 py-1 mb-6 text-sm font-semibold tracking-wide shadow-sm">
                    ✨ {{ __('howitworks.app.tagline') }}
                </div>
                <h1 class="text-5xl md:text-7xl font-bold leading-tight mb-6">
                    {{ __('howitworks.hero.title') }}<br>
                    <span class="text-amber-300">{{ __('howitworks.hero.highlight') }}</span> بأمان
                </h1>
                <p class="text-lg md:text-xl text-blue-100 mb-8 leading-relaxed max-w-lg">
                    {{ __('howitworks.app.slogan') }}
                </p>
                <div class="flex flex-wrap gap-4 flex-direction-reverse">
                    <button class="bg-amber-400 text-slate-900 px-8 py-4 rounded-xl font-bold text-lg hover:bg-amber-300 transition shadow-xl transform hover:-translate-y-1">
                        {{ __('howitworks.hero.cta_primary') }}
                    </button>
                    <button class="glass px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/20 transition flex items-center gap-2">
                        <i class="fa-solid fa-play"></i> {{ __('howitworks.hero.cta_secondary') }}
                    </button>
                </div>
            </div>

            <!-- 3D Visualization -->
            <div class="relative hidden md:block {{ $isRTL ? 'order-1' : 'order-2' }}" data-aos="zoom-in" data-aos-duration="1200">
                <div class="relative w-full h-[500px]">
                    <!-- Phone Mockup -->
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-72 h-[500px] bg-slate-900 rounded-[3rem] border-8 border-slate-800 shadow-2xl z-20 overflow-hidden flex flex-col">
                        <!-- Screen Content -->
                        <div class="bg-slate-100 flex-1 p-4 relative overflow-hidden">
                            <div class="bg-white p-4 rounded-2xl shadow-sm mb-4">
                                <div class="h-2 w-20 bg-slate-200 rounded mb-2"></div>
                                <div class="h-2 w-32 bg-slate-200 rounded"></div>
                            </div>
                            <div class="bg-sky-100 p-4 rounded-2xl mb-4 border border-sky-200">
                                <div class="flex justify-between items-center {{ $isRTL ? 'flex-row-reverse' : '' }}">
                                    <span class="text-sky-800 font-bold text-sm">{{ __('howitworks.hero.phone_mockup.refunded') }}</span>
                                    <i class="fa-solid fa-check-circle text-sky-600"></i>
                                </div>
                                <div class="text-2xl font-bold text-sky-600 mt-1">50.00 {{ $isRTL ? 'د.أ' : 'AED' }}</div>
                            </div>
                             <!-- Simulated List -->
                             <div class="space-y-3">
                                 <div class="flex items-center gap-3 bg-white p-2 rounded-xl shadow-sm {{ $isRTL ? 'flex-row-reverse' : '' }}">
                                     <div class="w-10 h-10 rounded-full bg-slate-200"></div>
                                     <div class="flex-1 h-2 bg-slate-200 rounded"></div>
                                 </div>
                                 <div class="flex items-center gap-3 bg-white p-2 rounded-xl shadow-sm {{ $isRTL ? 'flex-row-reverse' : '' }}">
                                     <div class="w-10 h-10 rounded-full bg-slate-200"></div>
                                     <div class="flex-1 h-2 bg-slate-200 rounded"></div>
                                 </div>
                             </div>
                        </div>
                    </div>

                    <!-- Floating Elements -->
                    <div class="absolute top-20 {{ $isRTL ? 'right-0' : 'left-0' }} glass p-4 rounded-2xl shadow-lg z-30 float-card flex items-center gap-3 {{ $isRTL ? 'flex-row-reverse' : '' }}">
                        <div class="bg-green-100 p-3 rounded-full text-green-600"><i class="fa-solid fa-wallet fa-lg"></i></div>
                        <div class="{{ $isRTL ? 'text-right' : 'text-left' }}">
                            <p class="text-xs text-slate-500">{{ __('howitworks.hero.phone_mockup.wallet_added') }}</p>
                            <p class="font-bold text-slate-800">+25% {{ $isRTL ? 'كاش باك' : 'Cashback' }}</p>
                        </div>
                    </div>

                    <div class="absolute bottom-32 {{ $isRTL ? 'left-0' : 'right-0' }} glass p-4 rounded-2xl shadow-lg z-30 float-card-delay flex items-center gap-3 {{ $isRTL ? 'flex-row-reverse' : '' }}">
                        <div class="bg-blue-100 p-3 rounded-full text-blue-600"><i class="fa-solid fa-user-doctor fa-lg"></i></div>
                        <div class="{{ $isRTL ? 'text-right' : 'text-left' }}">
                            <p class="text-xs text-slate-500">{{ __('howitworks.hero.phone_mockup.booking_confirmed') }}</p>
                            <p class="font-bold text-slate-800">{{ $isRTL ? 'د. أحمد محمد' : 'Dr. Ahmed Mohamed' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Wave Separator -->
        <div class="absolute bottom-0 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f8fafc" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,122.7C960,117,1056,171,1152,197.3C1248,224,1344,224,1392,224L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </header>

    <!-- Why sehaSave? (SWOT Based) -->
    <section id="benefits" class="py-20 container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-slate-800 mb-4">{{ __('howitworks.benefits.title') }}</h2>
            <p class="text-slate-500 max-w-2xl mx-auto">{{ __('howitworks.benefits.subtitle') }}</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="bg-white p-8 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-slate-100 group" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 text-2xl mb-6 group-hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-magnifying-glass-location"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-slate-800">{{ __('howitworks.benefits.cards.choices.title') }}</h3>
                <p class="text-slate-500 leading-relaxed text-direction">
                    {{ __('howitworks.benefits.cards.choices.description') }}
                </p>
            </div>

            <!-- Card 2 (USP) -->
            <div class="bg-gradient-to-br from-slate-900 to-slate-800 text-white p-8 rounded-3xl shadow-2xl transform scale-105 relative overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute top-0 {{ $isRTL ? 'right-0' : 'left-0' }} w-32 h-32 bg-amber-500 rounded-full mix-blend-overlay filter blur-3xl opacity-20"></div>
                <div class="w-16 h-16 bg-amber-500/20 rounded-2xl flex items-center justify-center text-amber-400 text-2xl mb-6">
                    <i class="fa-solid fa-sack-dollar"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-amber-400">{{ __('howitworks.benefits.cards.cashback.title') }}</h3>
                <p class="text-slate-300 leading-relaxed text-direction">
                    {{ __('howitworks.benefits.cards.cashback.description') }}
                </p>
                <div class="mt-6 inline-block bg-amber-500/20 px-4 py-2 rounded-lg text-sm text-amber-300 border border-amber-500/30">
                    {{ __('howitworks.benefits.cards.cashback.badge') }}
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white p-8 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-slate-100 group" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 text-2xl mb-6 group-hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-slate-800">{{ __('howitworks.benefits.cards.quality.title') }}</h3>
                <p class="text-slate-500 leading-relaxed text-direction">
                    {{ __('howitworks.benefits.cards.quality.description') }}
                </p>
            </div>
        </div>
    </section>

    <!-- How it Works (Interactive Timeline) -->
    <section id="how" class="py-20 bg-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjIiIGZpbGw9IiNmMWY1ZjkiLz48L3N2Zz4=')] opacity-50"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-20">
                <span class="text-sky-600 font-bold tracking-wider uppercase text-sm">{{ __('howitworks.how_it_works.subtitle') }}</span>
                <h2 class="text-4xl font-bold text-slate-800 mt-2">{{ __('howitworks.how_it_works.title') }}</h2>
            </div>

            <!-- Steps Container -->
            <div class="hidden md:flex justify-between items-start relative steps-container" id="stepsLine">
                <!-- Connector Line -->
                <div class="step-connector"></div>

                <!-- Step 1 -->
                <div class="relative z-10 w-64 text-center group cursor-pointer" data-aos="fade-up" data-aos-delay="0">
                    <div class="w-20 h-20 mx-auto bg-white border-4 border-slate-100 rounded-full flex items-center justify-center text-3xl text-slate-400 group-hover:border-sky-500 group-hover:text-sky-500 transition-all duration-500 shadow-lg mb-6 relative">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <div class="absolute -top-2 {{ $isRTL ? '-right-2' : '-left-2' }} w-8 h-8 bg-sky-600 text-white rounded-full flex items-center justify-center text-sm font-bold">1</div>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800 mb-2">{{ __('howitworks.how_it_works.steps.search.title') }}</h4>
                    <p class="text-sm text-slate-500 text-direction">{{ __('howitworks.how_it_works.steps.search.description') }}</p>
                </div>

                <!-- Step 2 -->
                <div class="relative z-10 w-64 text-center group cursor-pointer" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-20 h-20 mx-auto bg-white border-4 border-slate-100 rounded-full flex items-center justify-center text-3xl text-slate-400 group-hover:border-sky-500 group-hover:text-sky-500 transition-all duration-500 shadow-lg mb-6 relative">
                        <i class="fa-regular fa-calendar-check"></i>
                        <div class="absolute -top-2 {{ $isRTL ? '-right-2' : '-left-2' }} w-8 h-8 bg-sky-600 text-white rounded-full flex items-center justify-center text-sm font-bold">2</div>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800 mb-2">{{ __('howitworks.how_it_works.steps.book.title') }}</h4>
                    <p class="text-sm text-slate-500 text-direction">{{ __('howitworks.how_it_works.steps.book.description') }}</p>
                </div>

                <!-- Step 3 -->
                <div class="relative z-10 w-64 text-center group cursor-pointer" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-20 h-20 mx-auto bg-white border-4 border-slate-100 rounded-full flex items-center justify-center text-3xl text-slate-400 group-hover:border-sky-500 group-hover:text-sky-500 transition-all duration-500 shadow-lg mb-6 relative">
                        <i class="fa-solid fa-user-doctor"></i>
                        <div class="absolute -top-2 {{ $isRTL ? '-right-2' : '-left-2' }} w-8 h-8 bg-sky-600 text-white rounded-full flex items-center justify-center text-sm font-bold">3</div>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800 mb-2">{{ __('howitworks.how_it_works.steps.visit.title') }}</h4>
                    <p class="text-sm text-slate-500 text-direction">{{ __('howitworks.how_it_works.steps.visit.description') }}</p>
                </div>

                <!-- Step 4 -->
                <div class="relative z-10 w-64 text-center group cursor-pointer" data-aos="fade-up" data-aos-delay="600">
                    <div class="w-20 h-20 mx-auto bg-white border-4 border-amber-100 rounded-full flex items-center justify-center text-3xl text-slate-400 group-hover:border-amber-500 group-hover:text-amber-500 transition-all duration-500 shadow-lg mb-6 relative">
                        <i class="fa-solid fa-coins coin-icon"></i>
                        <div class="absolute -top-2 {{ $isRTL ? '-right-2' : '-left-2' }} w-8 h-8 bg-amber-500 text-white rounded-full flex items-center justify-center text-sm font-bold">4</div>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800 mb-2">{{ __('howitworks.how_it_works.steps.earn.title') }}</h4>
                    <p class="text-sm text-slate-500 text-direction">{{ __('howitworks.how_it_works.steps.earn.description') }}</p>
                </div>
            </div>

            <!-- Mobile Vertical Steps -->
            <div class="md:hidden space-y-8 relative">
                <div class="absolute {{ $isRTL ? 'right-8' : 'left-8' }} top-0 h-full w-1 bg-slate-200"></div>
                
                <div class="relative flex gap-6 {{ $isRTL ? 'flex-row-reverse' : '' }}" data-aos="{{ $isRTL ? 'fade-left' : 'fade-right' }}">
                    <div class="w-16 h-16 flex-shrink-0 bg-sky-600 rounded-full flex items-center justify-center text-white text-xl font-bold z-10 border-4 border-white shadow-md">1</div>
                    <div class="bg-white p-6 rounded-2xl shadow-md flex-1 {{ $isRTL ? 'text-right' : 'text-left' }}">
                        <h4 class="font-bold text-lg mb-2">{{ __('howitworks.how_it_works.mobile_steps.search') }}</h4>
                        <p class="text-slate-500 text-sm">{{ __('howitworks.how_it_works.steps.search.description') }}</p>
                    </div>
                </div>

                <div class="relative flex gap-6 {{ $isRTL ? 'flex-row-reverse' : '' }}" data-aos="{{ $isRTL ? 'fade-left' : 'fade-right' }}" data-aos-delay="100">
                    <div class="w-16 h-16 flex-shrink-0 bg-sky-600 rounded-full flex items-center justify-center text-white text-xl font-bold z-10 border-4 border-white shadow-md">2</div>
                    <div class="bg-white p-6 rounded-2xl shadow-md flex-1 {{ $isRTL ? 'text-right' : 'text-left' }}">
                        <h4 class="font-bold text-lg mb-2">{{ __('howitworks.how_it_works.mobile_steps.book') }}</h4>
                        <p class="text-slate-500 text-sm">{{ __('howitworks.how_it_works.steps.book.description') }}</p>
                    </div>
                </div>

                <div class="relative flex gap-6 {{ $isRTL ? 'flex-row-reverse' : '' }}" data-aos="{{ $isRTL ? 'fade-left' : 'fade-right' }}" data-aos-delay="200">
                    <div class="w-16 h-16 flex-shrink-0 bg-sky-600 rounded-full flex items-center justify-center text-white text-xl font-bold z-10 border-4 border-white shadow-md">3</div>
                    <div class="bg-white p-6 rounded-2xl shadow-md flex-1 {{ $isRTL ? 'text-right' : 'text-left' }}">
                        <h4 class="font-bold text-lg mb-2">{{ __('howitworks.how_it_works.mobile_steps.visit') }}</h4>
                        <p class="text-slate-500 text-sm">{{ __('howitworks.how_it_works.steps.visit.description') }}</p>
                    </div>
                </div>

                <div class="relative flex gap-6 {{ $isRTL ? 'flex-row-reverse' : '' }}" data-aos="{{ $isRTL ? 'fade-left' : 'fade-right' }}" data-aos-delay="300">
                    <div class="w-16 h-16 flex-shrink-0 bg-amber-500 rounded-full flex items-center justify-center text-white text-xl font-bold z-10 border-4 border-white shadow-md">4</div>
                    <div class="bg-white p-6 rounded-2xl shadow-md flex-1 {{ $isRTL ? 'text-right border-r-4 border-amber-500' : 'text-left border-l-4 border-amber-500' }}">
                        <h4 class="font-bold text-lg mb-2 text-amber-600">{{ __('howitworks.how_it_works.mobile_steps.earn') }}</h4>
                        <p class="text-slate-500 text-sm">{{ __('howitworks.how_it_works.steps.earn.description') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cash Flow Diagram Section -->
    <section id="cycle" class="py-20 bg-slate-900 text-white relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full bg-slate-900">
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-blue-600/20 rounded-full blur-[100px]"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid md:grid-cols-2 gap-16 items-center {{ $isRTL ? '' : 'flex-row-reverse' }}">
                <div data-aos="{{ $isRTL ? 'fade-left' : 'fade-right' }}">
                    <h2 class="text-4xl font-bold mb-6">{!! str_replace(':app', '<span class="text-sky-400">SehaSave</span>', __('howitworks.cash_flow.title')) !!}</h2>
                    <p class="text-slate-300 text-lg mb-8 leading-relaxed text-direction">
                        {{ __('howitworks.cash_flow.description') }}
                    </p>
                    
                    <ul class="space-y-6">
                        <li class="flex items-start gap-4 {{ $isRTL ? 'flex-row-reverse' : '' }}">
                            <div class="w-10 h-10 rounded-full bg-sky-500/20 flex items-center justify-center text-sky-400 mt-1 flex-shrink-0">
                                <i class="fa-solid fa-hand-holding-dollar"></i>
                            </div>
                            <div class="{{ $isRTL ? 'text-right' : 'text-left' }}">
                                <h4 class="font-bold text-xl">{{ __('howitworks.cash_flow.points.commission.title') }}</h4>
                                <p class="text-slate-400 text-sm">{{ __('howitworks.cash_flow.points.commission.description') }}</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4 {{ $isRTL ? 'flex-row-reverse' : '' }}">
                            <div class="w-10 h-10 rounded-full bg-amber-500/20 flex items-center justify-center text-amber-400 mt-1 flex-shrink-0">
                                <i class="fa-solid fa-share-nodes"></i>
                            </div>
                            <div class="{{ $isRTL ? 'text-right' : 'text-left' }}">
                                <h4 class="font-bold text-xl">{{ __('howitworks.cash_flow.points.profit_sharing.title') }}</h4>
                                <p class="text-slate-400 text-sm">{{ __('howitworks.cash_flow.points.profit_sharing.description') }}</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Visual Diagram -->
                <div class="relative bg-slate-800/50 rounded-3xl p-8 border border-slate-700 backdrop-blur-sm" data-aos="zoom-in">
                    <!-- Flow Items -->
                    <div class="flex flex-col gap-6 relative">
                        <!-- Provider -->
                        <div class="flex justify-between items-center bg-slate-700 p-4 rounded-xl border border-slate-600 {{ $isRTL ? 'flex-row-reverse' : '' }}">
                            <div class="flex items-center gap-3 {{ $isRTL ? 'flex-row-reverse' : '' }}">
                                <div class="bg-white text-slate-900 p-2 rounded-lg"><i class="fa-solid fa-user-doctor"></i></div>
                                <span>{{ __('howitworks.cash_flow.visual.provider') }}</span>
                            </div>
                            <div class="text-red-400 text-sm font-mono">{{ __('howitworks.cash_flow.visual.commission_deducted') }}</div>
                        </div>

                        <!-- Arrow Down -->
                        <div class="flex justify-center text-slate-500"><i class="fa-solid fa-arrow-down fa-fade"></i></div>

                        <!-- Platform -->
                        <div class="bg-sky-600 p-4 rounded-xl text-center shadow-lg shadow-sky-900/50">
                            <div class="font-bold text-xl mb-1">{{ __('howitworks.cash_flow.visual.platform') }}</div>
                            <div class="text-xs text-sky-100 opacity-75">{{ __('howitworks.cash_flow.visual.platform_sub') }}</div>
                        </div>

                        <!-- Arrow Split -->
                        <div class="flex justify-center text-slate-500 text-2xl"><i class="fa-solid fa-arrow-down-long"></i></div>

                        <!-- Patient Reward -->
                        <div class="flex justify-between items-center bg-gradient-to-r from-amber-500 to-orange-600 p-5 rounded-xl shadow-lg transform hover:scale-105 transition duration-300 cursor-pointer group {{ $isRTL ? 'flex-row-reverse' : '' }}">
                            <div class="flex items-center gap-3 {{ $isRTL ? 'flex-row-reverse' : '' }}">
                                <div class="bg-white text-amber-600 p-2 rounded-lg group-hover:rotate-12 transition"><i class="fa-solid fa-wallet"></i></div>
                                <span class="font-bold text-lg">{{ __('howitworks.cash_flow.visual.patient_wallet') }}</span>
                            </div>
                            <div class="text-white font-mono bg-black/20 px-3 py-1 rounded">{{ __('howitworks.cash_flow.visual.cashback_added') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- App Features (Grid) -->
    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-800">{{ __('howitworks.features.title') }}</h2>
                <p class="text-slate-500 mt-2">{{ __('howitworks.features.subtitle') }}</p>
            </div>

            <div class="grid md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition text-center" data-aos="fade-up" data-aos-delay="100">
                    <i class="fa-solid fa-mobile-screen-button text-4xl text-sky-500 mb-4"></i>
                    <h3 class="font-bold mb-2">{{ __('howitworks.features.items.easy_app.title') }}</h3>
                    <p class="text-sm text-slate-500">{{ __('howitworks.features.items.easy_app.description') }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition text-center" data-aos="fade-up" data-aos-delay="200">
                    <i class="fa-solid fa-bell text-4xl text-sky-500 mb-4"></i>
                    <h3 class="font-bold mb-2">{{ __('howitworks.features.items.notifications.title') }}</h3>
                    <p class="text-sm text-slate-500">{{ __('howitworks.features.items.notifications.description') }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition text-center" data-aos="fade-up" data-aos-delay="300">
                    <i class="fa-solid fa-chart-pie text-4xl text-sky-500 mb-4"></i>
                    <h3 class="font-bold mb-2">{{ __('howitworks.features.items.wallet.title') }}</h3>
                    <p class="text-sm text-slate-500">{{ __('howitworks.features.items.wallet.description') }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition text-center" data-aos="fade-up" data-aos-delay="400">
                    <i class="fa-solid fa-headset text-4xl text-sky-500 mb-4"></i>
                    <h3 class="font-bold mb-2">{{ __('howitworks.features.items.support.title') }}</h3>
                    <p class="text-sm text-slate-500">{{ __('howitworks.features.items.support.description') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20">
        <div class="container mx-auto px-6">
            <div class="bg-gradient-to-r from-sky-600 to-blue-700 rounded-3xl p-12 text-center text-white relative overflow-hidden shadow-2xl">
                <!-- Decorative Circles -->
                <div class="absolute top-0 {{ $isRTL ? 'right-0' : 'left-0' }} w-64 h-64 bg-white opacity-10 rounded-full transform {{ $isRTL ? 'translate-x-1/2' : '-translate-x-1/2' }} -translate-y-1/2"></div>
                <div class="absolute bottom-0 {{ $isRTL ? 'left-0' : 'right-0' }} w-64 h-64 bg-amber-500 opacity-20 rounded-full transform {{ $isRTL ? '-translate-x-1/2' : 'translate-x-1/2' }} translate-y-1/2"></div>

                <h2 class="text-4xl md:text-5xl font-bold mb-6 relative z-10">{{ __('howitworks.cta.title') }}</h2>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto relative z-10">{{ __('howitworks.cta.subtitle') }}</p>
                
                <div class="flex flex-col md:flex-row justify-center gap-4 relative z-10 {{ $isRTL ? 'flex-row-reverse' : '' }}">
                    <button class="bg-white text-blue-700 px-8 py-4 rounded-xl font-bold text-lg hover:bg-slate-100 transition shadow-lg">
                        {{ __('howitworks.cta.patient') }}
                    </button>
                    <button class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/10 transition">
                        {{ __('howitworks.cta.doctor') }}
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            offset: 100,
            duration: 800,
            easing: 'ease-out-cubic',
        });

        // Navbar Glass Effect on Scroll
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                if(navbar) {
                    navbar.classList.add('glass', 'shadow-sm');
                    navbar.classList.remove('bg-transparent');
                }
            } else {
                if(navbar) {
                    navbar.classList.remove('glass', 'shadow-sm');
                }
            }
        });

        // Step Connector Animation trigger
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    document.querySelector('.steps-container').classList.add('active');
                }
            });
        }, { threshold: 0.5 });

        const stepsSection = document.getElementById('stepsLine');
        if(stepsSection) observer.observe(stepsSection);


        // RTL/LTR specific animations
        @if($isRTL)
        document.addEventListener('DOMContentLoaded', function() {
            // Adjust floating elements position for RTL
            const floatingElements = document.querySelectorAll('.float-card, .float-card-delay');
            floatingElements.forEach(el => {
                const currentLeft = parseFloat(window.getComputedStyle(el).left);
                const currentRight = parseFloat(window.getComputedStyle(el).right);
                
                if(currentLeft === 0 && currentRight > 0) {
                    el.style.left = '';
                    el.style.right = 'auto';
                }
            });
        });
        @endif
    </script>

@endsection