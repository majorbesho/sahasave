@extends('frontend.layouts.master')

@section('title', $career->title . ' | ' . __('careers.page_title'))

@section('content')
    @php
        $lang = app()->getLocale();
        $isRTL = $lang === 'ar';
    @endphp

    <!-- CSS Styles -->
    <style>
        /* Job Details Specific Styles */
        .job-header-bg {
            background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 100%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .section-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .section-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        /* Requirements List */
        .requirement-item {
            position: relative;
            padding-{{ $isRTL ? 'right' : 'left' }}: 1.5rem;
        }

        .requirement-item::before {
            content: '✓';
            position: absolute;
            {{ $isRTL ? 'right' : 'left' }}: 0;
            top: 0;
            color: #10b981;
            font-weight: bold;
        }

        /* Benefits Grid */
        .benefit-item {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .benefit-item:hover {
            background: white;
            border-color: #0ea5e9;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(14, 165, 233, 0.1);
        }

        /* Sticky Apply Box */
        .sticky-apply {
            position: sticky;
            top: 120px;
        }

        @media (max-width: 768px) {
            .sticky-apply {
                position: static;
                margin-top: 2rem;
            }
        }

        /* Timeline for Application Process */
        .timeline {
            position: relative;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            {{ $isRTL ? 'right' : 'left' }}: 50%;
            transform: translateX(-50%);
            width: 3px;
            height: 100%;
            background: #e2e8f0;
        }

        .timeline-step {
            position: relative;
            margin-bottom: 2rem;
        }

        .timeline-step::before {
            content: '';
            position: absolute;
            top: 0;
            {{ $isRTL ? 'right' : 'left' }}: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background: #0ea5e9;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 0 0 4px #0ea5e9;
        }

        .back-link {
            color: #64748b;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: #0ea5e9;
        }

        /* Share Buttons */
        .share-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .share-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>

    <!-- Job Header -->
    <header class="job-header-bg text-white py-20 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 {{ $isRTL ? 'right-0' : 'left-0' }} w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 {{ $isRTL ? 'left-0' : 'right-0' }} w-96 h-96 bg-sky-400/20 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-6 relative z-10">
            <!-- Back Button -->
            <div class="mb-8">
                <a href="{{ route('careers.index') }}" class="back-link inline-flex items-center gap-2 text-lg">
                    <i class="fas fa-arrow-{{ $isRTL ? 'right' : 'left' }}"></i>
                    {{ __('careers.back_to_jobs') }}
                </a>
            </div>

            <!-- Job Title and Info -->
            <div class="max-w-4xl mx-auto">
                <div class="glass-card rounded-3xl p-8 mb-8 shadow-2xl" data-aos="fade-up">
                    <div class="flex flex-wrap items-center gap-3 mb-6">
                        <h1 class="text-4xl font-bold text-slate-900">{{ $career->title }}</h1>
                        <span class="badge-job-type badge-{{ $career->type }} text-sm px-4 py-2">
                            {{ __('careers.job_types.' . $career->type) }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center text-sky-600">
                                <i class="fas fa-building text-xl"></i>
                            </div>
                            <div>
                                <div class="text-sm text-slate-500">{{ __('careers.department') }}</div>
                                <div class="font-semibold text-slate-800">{{ $career->department }}</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center text-red-600">
                                <i class="fas fa-map-marker-alt text-xl"></i>
                            </div>
                            <div>
                                <div class="text-sm text-slate-500">{{ __('careers.location') }}</div>
                                <div class="font-semibold text-slate-800">{{ $career->location }}</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600">
                                <i class="fas fa-user-graduate text-xl"></i>
                            </div>
                            <div>
                                <div class="text-sm text-slate-500">{{ __('careers.experience_label') }}</div>
                                <div class="font-semibold text-slate-800">{{ $career->experience_level }}</div>
                            </div>
                        </div>

                        @if($career->salary_range)
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600">
                                    <i class="fas fa-money-bill-wave text-xl"></i>
                                </div>
                                <div>
                                    <div class="text-sm text-slate-500">{{ __('careers.salary') }}</div>
                                    <div class="font-semibold text-slate-800">{{ $career->salary_range }}</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Deadline -->
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 inline-flex items-center gap-3">
                        <i class="fas fa-clock text-amber-600 text-xl"></i>
                        <div>
                            <div class="font-semibold text-amber-800">{{ __('careers.application_deadline') }}</div>
                            <div class="text-amber-600 font-bold">{{ $career->application_deadline->format('d F Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-12 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Job Details -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Job Description -->
                    <section class="section-card p-8" data-aos="fade-up">
                        <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                            <i class="fas fa-file-alt text-sky-500"></i> {{ __('careers.job_description') }}
                        </h2>
                        <div class="prose max-w-none text-slate-700">
                            {!! nl2br(e($career->description)) !!}
                        </div>
                    </section>

                    <!-- Requirements -->
                    <section class="section-card p-8" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                            <i class="fas fa-list-check text-green-500"></i> {{ __('careers.requirements') }}
                        </h2>
                        <div class="space-y-4">
                            @foreach(explode("\n", $career->requirements) as $requirement)
                                @if(trim($requirement))
                                    <div class="requirement-item text-slate-700">
                                        {{ trim($requirement) }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </section>

                    <!-- Skills -->
                    @if($career->skills && count(json_decode($career->skills)) > 0)
                        <section class="section-card p-8" data-aos="fade-up" data-aos-delay="200">
                            <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                                <i class="fas fa-tools text-purple-500"></i> {{ __('careers.skills_required') }}
                            </h2>
                            <div class="flex flex-wrap gap-3">
                                @foreach(json_decode($career->skills) as $skill)
                                    <span class="skill-tag text-sm px-4 py-2 bg-slate-100 text-slate-700 rounded-full border border-slate-200 hover:bg-sky-100 hover:border-sky-300 hover:text-sky-700 transition-all duration-300">
                                        {{ $skill }}
                                    </span>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- Benefits -->
                    @if($career->benefits && count(json_decode($career->benefits)) > 0)
                        <section class="section-card p-8" data-aos="fade-up" data-aos-delay="300">
                            <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                                <i class="fas fa-gift text-amber-500"></i> {{ __('careers.benefits') }}
                            </h2>
                            <div class="grid md:grid-cols-2 gap-4">
                                @foreach(json_decode($career->benefits) as $benefit)
                                    <div class="benefit-item">
                                        <div class="flex items-center gap-3 mb-3">
                                            <i class="fas fa-check-circle text-green-500 text-lg"></i>
                                            <span class="font-semibold text-slate-800">{{ $benefit }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>

                <!-- Sidebar (Apply Box & Info) -->
                <div class="lg:col-span-1">
                    <!-- Apply Box -->
                    <div class="sticky-apply">
                        <div class="glass-card rounded-3xl p-8 shadow-2xl mb-8" data-aos="fade-left">
                            <h3 class="text-2xl font-bold text-slate-800 mb-6">{{ __('careers.apply_now') }}</h3>
                            
                            <!-- Application Form -->
                            <form id="application-form" class="space-y-6">
                                @csrf
                                <input type="hidden" name="career_id" value="{{ $career->id }}">
                                
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">
                                        {{ __('careers.form.full_name') }}
                                    </label>
                                    <input type="text" name="name" required 
                                           class="w-full p-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">
                                        {{ __('careers.form.email') }}
                                    </label>
                                    <input type="email" name="email" required 
                                           class="w-full p-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">
                                        {{ __('careers.form.phone') }}
                                    </label>
                                    <input type="tel" name="phone" 
                                           class="w-full p-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">
                                        {{ __('careers.form.linkedin') }}
                                    </label>
                                    <input type="url" name="linkedin" 
                                           class="w-full p-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                                           placeholder="https://linkedin.com/in/...">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">
                                        {{ __('careers.form.resume') }}
                                    </label>
                                    <input type="file" name="resume" accept=".pdf,.doc,.docx" required 
                                           class="w-full p-3 border border-slate-300 rounded-xl">
                                    <p class="text-xs text-slate-500 mt-1">
                                        {{ __('careers.form.resume_hint') }}
                                    </p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">
                                        {{ __('careers.form.cover_letter') }}
                                    </label>
                                    <textarea name="cover_letter" rows="4" 
                                              class="w-full p-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                                              placeholder="{{ __('careers.form.cover_placeholder') }}"></textarea>
                                </div>

                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-sky-600 to-blue-700 text-white py-4 rounded-xl font-bold text-lg hover:opacity-90 transition-all duration-300 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-paper-plane mr-2"></i> {{ __('careers.submit_application') }}
                                </button>
                            </form>

                            <div class="mt-6 pt-6 border-t border-slate-200">
                                <p class="text-sm text-slate-600 text-center">
                                    {{ __('careers.application_note') }}
                                </p>
                            </div>
                        </div>

                        <!-- Share Job -->
                        <div class="bg-white rounded-3xl shadow-lg p-6" data-aos="fade-left" data-aos-delay="200">
                            <h4 class="font-bold text-slate-800 mb-4">{{ __('careers.share_job') }}</h4>
                            <div class="flex justify-center gap-4">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" 
                                   target="_blank"
                                   class="share-btn bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($career->title) }}" 
                                   target="_blank"
                                   class="share-btn bg-sky-100 text-sky-600 hover:bg-sky-600 hover:text-white">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}" 
                                   target="_blank"
                                   class="share-btn bg-blue-50 text-blue-700 hover:bg-blue-700 hover:text-white">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="mailto:?subject={{ urlencode($career->title) }}&body={{ urlencode('Check out this job opportunity: ' . url()->current()) }}" 
                                   class="share-btn bg-red-100 text-red-600 hover:bg-red-600 hover:text-white">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Process Timeline -->
            <section class="mt-16" data-aos="fade-up">
                <h3 class="text-3xl font-bold text-center text-slate-800 mb-12">
                    {{ __('careers.application_process.title') }}
                </h3>
                
                <div class="timeline max-w-4xl mx-auto">
                    <div class="grid md:grid-cols-4 gap-8">
                        @foreach([
                            'submit' => ['icon' => 'paper-plane', 'color' => 'sky'],
                            'review' => ['icon' => 'search', 'color' => 'blue'],
                            'interview' => ['icon' => 'comments', 'color' => 'purple'],
                            'offer' => ['icon' => 'handshake', 'color' => 'green']
                        ] as $step => $data)
                            <div class="timeline-step text-center">
                                <div class="mb-4">
                                    <div class="w-16 h-16 mx-auto bg-{{ $data['color'] }}-100 rounded-full flex items-center justify-center text-{{ $data['color'] }}-600 text-2xl">
                                        <i class="fas fa-{{ $data['icon'] }}"></i>
                                    </div>
                                </div>
                                <h4 class="font-bold text-slate-800 mb-2">
                                    {{ __('careers.application_process.steps.' . $step . '.title') }}
                                </h4>
                                <p class="text-sm text-slate-600">
                                    {{ __('careers.application_process.steps.' . $step . '.description') }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Related Jobs -->
    @if($relatedJobs && $relatedJobs->count() > 0)
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <h3 class="text-3xl font-bold text-center text-slate-800 mb-12" data-aos="fade-up">
                    {{ __('careers.related_jobs') }}
                </h3>
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach($relatedJobs as $relatedJob)
                        <div class="bg-slate-50 rounded-2xl p-6 hover:shadow-xl transition-all duration-300 border border-slate-200" 
                             data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="flex justify-between items-start mb-4">
                                <h4 class="font-bold text-slate-800 text-lg">{{ $relatedJob->title }}</h4>
                                <span class="badge-job-type badge-{{ $relatedJob->type }} text-xs">
                                    {{ __('careers.job_types.' . $relatedJob->type) }}
                                </span>
                            </div>
                            <div class="text-slate-600 text-sm mb-4">
                                <div class="flex items-center gap-2 mb-2">
                                    <i class="fas fa-building text-sky-500"></i>
                                    {{ $relatedJob->department }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-map-marker-alt text-red-500"></i>
                                    {{ $relatedJob->location }}
                                </div>
                            </div>
                            <a href="{{ route('careers.show', $relatedJob->id) }}" 
                               class="text-sky-600 hover:text-sky-700 font-medium text-sm flex items-center gap-2">
                                {{ __('careers.view_details') }}
                                <i class="fas fa-arrow-{{ $isRTL ? 'left' : 'right' }}"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- JavaScript -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            offset: 100,
            duration: 800,
        });

        // Application Form Submission
        document.getElementById('application-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> {{ __("careers.sending") }}...';
            submitBtn.disabled = true;
            
            try {
                const response = await fetch('{{ route("careers.apply") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                
                const result = await response.json();
                
                if (response.ok) {
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: '{{ __("careers.success.title") }}',
                        text: '{{ __("careers.success.message") }}',
                        confirmButtonText: '{{ __("careers.success.button") }}',
                        confirmButtonColor: '#0ea5e9'
                    });
                    
                    // Reset form
                    this.reset();
                } else {
                    throw new Error(result.message || '{{ __("careers.error.general") }}');
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: '{{ __("careers.error.title") }}',
                    text: error.message,
                    confirmButtonText: '{{ __("careers.error.button") }}',
                    confirmButtonColor: '#ef4444'
                });
            } finally {
                // Reset button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });

        // Share button functionality
        document.querySelectorAll('.share-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const url = this.href;
                if (url.includes('mailto')) return; // Allow mailto to open normally
                
                e.preventDefault();
                window.open(url, 'share-window', 'width=600,height=400');
            });
        });

        // Smooth scroll for page navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth scroll to all internal links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href === '#' || href === '') return;
                    
                    const targetElement = document.querySelector(href);
                    if (targetElement) {
                        e.preventDefault();
                        window.scrollTo({
                            top: targetElement.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
@endsection