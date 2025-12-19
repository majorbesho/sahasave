@extends('frontend.layouts.master')

@section('title', __('careers.page_title'))

@section('content')
    @php
        $lang = app()->getLocale();
        $isRTL = $lang === 'ar';
    @endphp

    <!-- CSS Styles -->
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
            background-color: #f8fafc;
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

        /* Floating Cards Animation */
        .float-card {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        /* Badge Styles */
        .badge-job-type {
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
        }

        .badge-full-time { background-color: #10b981; color: white; }
        .badge-part-time { background-color: #f59e0b; color: white; }
        .badge-remote { background-color: #8b5cf6; color: white; }
        .badge-internship { background-color: #0ea5e9; color: white; }

        /* Skill Tags */
        .skill-tag {
            display: inline-block;
            background-color: #e2e8f0;
            color: #475569;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.75rem;
            margin: 0.125rem;
            transition: all 0.3s;
        }

        .skill-tag:hover {
            background-color: #0ea5e9;
            color: white;
            transform: translateY(-2px);
        }

        /* Card Hover Effects */
        .job-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
        }

        .job-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(14, 165, 233, 0.15);
            border-color: rgba(14, 165, 233, 0.2);
        }

        /* RTL/LTR Adjustments */
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

        .border-start {
            border-{{ $isRTL ? 'right' : 'left' }}: 1px solid #e2e8f0;
        }

        .border-end {
            border-{{ $isRTL ? 'left' : 'right' }}: 1px solid #e2e8f0;
        }

        /* Pagination Styles */
        .pagination .page-link {
            border: 1px solid #e2e8f0;
            padding: 0.5rem 1rem;
            color: #475569;
            transition: all 0.3s;
        }

        .pagination .page-item.active .page-link {
            background-color: #0ea5e9;
            border-color: #0ea5e9;
            color: white;
        }

        .pagination .page-link:hover {
            background-color: #f1f5f9;
            color: #0ea5e9;
        }

        /* Filter Sidebar */
        .filter-section {
            position: sticky;
            top: 120px;
        }

        @media (max-width: 768px) {
            .filter-section {
                position: static;
                margin-bottom: 2rem;
            }
        }

        /* Apply Button Animation */
        .btn-apply {
            background: linear-gradient(135deg, #0ea5e9, #3b82f6);
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .btn-apply::before {
            content: '';
            position: absolute;
            top: 0;
            {{ $isRTL ? 'right' : 'left' }}: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: all 0.6s;
        }

        .btn-apply:hover::before {
            {{ $isRTL ? 'right' : 'left' }}: 100%;
        }

        .btn-apply:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(14, 165, 233, 0.3);
        }
    </style>

    <!-- Hero Section -->
    <header class="relative py-20 overflow-hidden hero-bg text-white">
        <!-- Floating Elements -->
        <div class="absolute top-20 {{ $isRTL ? 'right-10' : 'left-10' }} w-20 h-20 bg-yellow-400/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 {{ $isRTL ? 'left-10' : 'right-10' }} w-32 h-32 bg-blue-400/20 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-block bg-white/20 backdrop-blur-md border border-white/30 rounded-full px-6 py-2 mb-8 text-lg font-semibold tracking-wide shadow-sm animate-pulse">
                    🚀 {{ __('careers.hero.tagline') }}
                </div>
                <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6" data-aos="fade-up">
                    {{ __('careers.hero.title') }}
                </h1>
                <p class="text-xl text-blue-100 mb-10 leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                    {{ __('careers.hero.subtitle') }}
                </p>
                <div class="flex justify-center gap-4" data-aos="fade-up" data-aos-delay="400">
                    <a href="#open-positions" class="btn-apply">
                        <i class="fas fa-briefcase mr-2"></i> {{ __('careers.hero.browse_jobs') }}
                    </a>
                    <a href="#why-join" class="glass px-8 py-3 rounded-xl font-bold text-lg hover:bg-white/20 transition flex items-center gap-2">
                        <i class="fas fa-question-circle"></i> {{ __('careers.hero.why_join') }}
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Wave Separator -->
        <div class="absolute bottom-0 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#f8fafc" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,122.7C960,117,1056,171,1152,197.3C1248,224,1344,224,1392,224L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-12">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-4 gap-8">
                <!-- Filter Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-3xl shadow-lg p-6 filter-section" data-aos="fade-right">
                        <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                            <i class="fas fa-filter text-sky-500"></i> {{ __('careers.filter.title') }}
                        </h3>

                        <!-- Search Box -->
                        <div class="mb-6">
                            <div class="relative">
                                <input type="text" id="search-jobs" 
                                       class="w-full p-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-transparent" 
                                       placeholder="{{ __('careers.filter.search_placeholder') }}">
                                <i class="fas fa-search absolute top-1/2 {{ $isRTL ? 'right-4' : 'left-4' }} transform -translate-y-1/2 text-slate-400"></i>
                            </div>
                        </div>

                        <!-- Job Type Filter -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-slate-700 mb-3">{{ __('careers.filter.job_type') }}</h4>
                            <div class="space-y-2">
                                @foreach(['full-time', 'part-time', 'remote', 'contract', 'internship'] as $type)
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" name="job_type[]" value="{{ $type }}" class="h-4 w-4 text-sky-600 rounded">
                                        <span class="ml-3 text-slate-600">{{ __('careers.job_types.' . $type) }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Department Filter -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-slate-700 mb-3">{{ __('careers.filter.department') }}</h4>
                            <select class="w-full p-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-sky-500">
                                <option value="">{{ __('careers.filter.all_departments') }}</option>
                                @foreach($departments ?? [] as $dept)
                                    <option value="{{ $dept }}">{{ $dept }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Location Filter -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-slate-700 mb-3">{{ __('careers.filter.location') }}</h4>
                            <select class="w-full p-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-sky-500">
                                <option value="">{{ __('careers.filter.all_locations') }}</option>
                                @foreach($locations ?? [] as $location)
                                    <option value="{{ $location }}">{{ $location }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Experience Level -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-slate-700 mb-3">{{ __('careers.filter.experience') }}</h4>
                            <select class="w-full p-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-sky-500">
                                <option value="">{{ __('careers.filter.all_levels') }}</option>
                                <option value="entry">{{ __('careers.experience.entry') }}</option>
                                <option value="mid">{{ __('careers.experience.mid') }}</option>
                                <option value="senior">{{ __('careers.experience.senior') }}</option>
                                <option value="lead">{{ __('careers.experience.lead') }}</option>
                            </select>
                        </div>

                        <!-- Filter Buttons -->
                        <div class="space-y-3">
                            <button id="apply-filters" class="w-full bg-sky-600 text-white py-3 rounded-xl font-semibold hover:bg-sky-700 transition">
                                {{ __('careers.filter.apply_filters') }}
                            </button>
                            <button id="reset-filters" class="w-full bg-slate-100 text-slate-700 py-3 rounded-xl font-semibold hover:bg-slate-200 transition">
                                {{ __('careers.filter.reset_filters') }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Jobs List -->
                <div class="lg:col-span-3">
                    <!-- Stats Bar -->
                    <div class="bg-white rounded-3xl shadow-lg p-6 mb-8" data-aos="fade-up">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-sky-600 mb-2">{{ $careers->total() }}</div>
                                <div class="text-slate-600">{{ __('careers.stats.open_positions') }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-green-600 mb-2">
                                    {{ $careers->where('type', 'remote')->count() }}
                                </div>
                                <div class="text-slate-600">{{ __('careers.stats.remote_jobs') }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-amber-600 mb-2">
                                    {{ $departments->count() ?? 0 }}
                                </div>
                                <div class="text-slate-600">{{ __('careers.stats.departments') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Why Join Section -->
                    <div id="why-join" class="bg-gradient-to-r from-sky-50 to-blue-50 rounded-3xl p-8 mb-8" data-aos="fade-up">
                        <h3 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                            <i class="fas fa-star text-amber-500"></i> {{ __('careers.why_join.title') }}
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="flex items-start gap-4 {{ $isRTL ? 'flex-row-reverse' : '' }}">
                                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 text-xl">
                                    <i class="fas fa-bolt"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 mb-2">{{ __('careers.why_join.growth.title') }}</h4>
                                    <p class="text-slate-600 text-sm">{{ __('careers.why_join.growth.description') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 {{ $isRTL ? 'flex-row-reverse' : '' }}">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600 text-xl">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 mb-2">{{ __('careers.why_join.culture.title') }}</h4>
                                    <p class="text-slate-600 text-sm">{{ __('careers.why_join.culture.description') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Open Positions -->
                    <div id="open-positions" data-aos="fade-up">
                        <h3 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                            <i class="fas fa-briefcase text-sky-500"></i> {{ __('careers.open_positions') }}
                        </h3>

                        @if($careers->count() > 0)
                            <div class="space-y-6">
                                @foreach($careers as $career)
                                    <div class="job-card bg-white rounded-3xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
                                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                                            <div class="flex-1">
                                                <div class="flex flex-wrap items-center gap-3 mb-4">
                                                    <h4 class="text-xl font-bold text-slate-800">{{ $career->title }}</h4>
                                                    <span class="badge-job-type badge-{{ $career->type }}">
                                                        {{ __('careers.job_types.' . $career->type) }}
                                                    </span>
                                                    @if($career->salary_range)
                                                        <span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-sm font-medium">
                                                            <i class="fas fa-money-bill-wave mr-1"></i> {{ $career->salary_range }}
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="flex flex-wrap gap-4 mb-4 text-slate-600">
                                                    <div class="flex items-center gap-2">
                                                        <i class="fas fa-building text-sky-500"></i>
                                                        <span>{{ $career->department }}</span>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <i class="fas fa-map-marker-alt text-red-500"></i>
                                                        <span>{{ $career->location }}</span>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <i class="fas fa-user-graduate text-purple-500"></i>
                                                        <span>{{ $career->experience_level }}</span>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <i class="fas fa-clock text-amber-500"></i>
                                                        <span>{{ __('careers.deadline') }}: {{ $career->application_deadline->format('d/m/Y') }}</span>
                                                    </div>
                                                </div>

                                                <p class="text-slate-600 mb-4 line-clamp-2">
                                                    {{ Str::limit($career->description, 200) }}
                                                </p>

                                                @if($career->skills && count(json_decode($career->skills)) > 0)
                                                    <div class="mb-4">
                                                        @foreach(json_decode($career->skills) as $skill)
                                                            <span class="skill-tag">{{ $skill }}</span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="flex flex-col items-end gap-4">
                                                <a href="{{ route('careers.show', $career->id) }}" 
                                                   class="btn-apply px-6 py-3">
                                                    {{ __('careers.apply_now') }}
                                                </a>
                                                <a href="{{ route('careers.show', $career->id) }}" 
                                                   class="text-sky-600 hover:text-sky-700 font-medium text-sm flex items-center gap-2">
                                                    {{ __('careers.view_details') }}
                                                    <i class="fas fa-arrow-{{ $isRTL ? 'left' : 'right' }}"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            @if($careers->hasPages())
                                <div class="mt-12">
                                    {{ $careers->links() }}
                                </div>
                            @endif
                        @else
                            <div class="text-center py-16 bg-white rounded-3xl shadow-lg" data-aos="fade-up">
                                <i class="fas fa-search text-6xl text-slate-300 mb-6"></i>
                                <h4 class="text-xl font-bold text-slate-700 mb-3">{{ __('careers.no_jobs.title') }}</h4>
                                <p class="text-slate-500 max-w-md mx-auto mb-8">{{ __('careers.no_jobs.description') }}</p>
                                <button id="reset-filters" class="bg-sky-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-sky-700 transition">
                                    {{ __('careers.no_jobs.reset_filters') }}
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- CTA Section -->
    <section class="py-20">
        <div class="container mx-auto px-6">
            <div class="bg-gradient-to-r from-slate-900 to-slate-800 rounded-3xl p-12 text-center text-white relative overflow-hidden shadow-2xl">
                <!-- Decorative Elements -->
                <div class="absolute top-0 {{ $isRTL ? 'right-0' : 'left-0' }} w-64 h-64 bg-white opacity-10 rounded-full transform {{ $isRTL ? 'translate-x-1/2' : '-translate-x-1/2' }} -translate-y-1/2"></div>
                <div class="absolute bottom-0 {{ $isRTL ? 'left-0' : 'right-0' }} w-64 h-64 bg-sky-500 opacity-20 rounded-full transform {{ $isRTL ? '-translate-x-1/2' : 'translate-x-1/2' }} translate-y-1/2"></div>

                <h2 class="text-4xl font-bold mb-6 relative z-10">{{ __('careers.cta.title') }}</h2>
                <p class="text-xl text-slate-300 mb-8 max-w-2xl mx-auto relative z-10">
                    {{ __('careers.cta.subtitle') }}
                </p>
                
                <div class="flex flex-col md:flex-row justify-center gap-4 relative z-10 {{ $isRTL ? 'flex-row-reverse' : '' }}">
                    <a href="mailto:careers@sehasave.com" class="bg-sky-500 text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-sky-600 transition shadow-lg flex items-center justify-center gap-3">
                        <i class="fas fa-paper-plane"></i> {{ __('careers.cta.send_cv') }}
                    </a>
                    <a href="{{ route('contact') }}" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/10 transition flex items-center justify-center gap-3">
                        <i class="fas fa-headset"></i> {{ __('careers.cta.contact_hr') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            offset: 100,
            duration: 800,
        });

        // Filter Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-jobs');
            const jobTypeFilters = document.querySelectorAll('input[name="job_type[]"]');
            const applyFiltersBtn = document.getElementById('apply-filters');
            const resetFiltersBtn = document.getElementById('reset-filters');
            const jobCards = document.querySelectorAll('.job-card');

            function filterJobs() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedTypes = Array.from(jobTypeFilters)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                jobCards.forEach(card => {
                    const title = card.querySelector('h4').textContent.toLowerCase();
                    const type = card.querySelector('.badge-job-type').textContent.toLowerCase();
                    
                    const matchesSearch = title.includes(searchTerm);
                    const matchesType = selectedTypes.length === 0 || 
                        selectedTypes.some(selectedType => type.includes(selectedType));

                    if (matchesSearch && matchesType) {
                        card.style.display = 'block';
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 100);
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 300);
                    }
                });
            }

            // Event Listeners
            searchInput.addEventListener('input', filterJobs);
            jobTypeFilters.forEach(filter => {
                filter.addEventListener('change', filterJobs);
            });
            applyFiltersBtn.addEventListener('click', filterJobs);
            resetFiltersBtn.addEventListener('click', function() {
                searchInput.value = '';
                jobTypeFilters.forEach(filter => filter.checked = false);
                filterJobs();
            });

            // Smooth scroll to positions
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });

        // RTL Specific Adjustments
        @if($isRTL)
        document.addEventListener('DOMContentLoaded', function() {
            // Adjust pagination arrows
            const paginationArrows = document.querySelectorAll('.pagination a');
            paginationArrows.forEach(arrow => {
                const text = arrow.textContent;
                if (text.includes('←')) {
                    arrow.textContent = text.replace('←', '→');
                } else if (text.includes('→')) {
                    arrow.textContent = text.replace('→', '←');
                }
            });
        });
        @endif
    </script>
@endsection