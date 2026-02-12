@extends('frontend.layouts.master')

@section('title', __('booking.book_appointment_with', ['name' => $doctor->name]))

@section('content')
  <style>



            .day-item.past-day {
                opacity: 0.5;
                cursor: not-allowed !important;
                background-color: #f8f9fa !important;
                color: #6c757d !important;
            }

            .day-item.past-day:hover {
                background-color: #f8f9fa !important;
                transform: none !important;
            }

            .day-item.past-day.active {
                background-color: #6c757d !important;
                color: white !important;
            }

        .day-item {
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 10px 5px;
            border-radius: 5px;
        }

        .day-item:hover {
            background-color: #f8f9fa;
        }

        .day-item.active {
            background-color: #0d6efd;
            color: white;
        }

        .time-slot-btn {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .time-slot-btn.selected {
            background-color: #0d6efd !important;
            color: white !important;
            border-color: #0d6efd !important;
        }

        .timing {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .timing:hover {
            border-color: #0d6efd;
            color: #0d6efd;
            transform: translateY(-2px);
        }

        .left-arrow,
        .right-arrow {
            cursor: pointer;
        }

        .left-arrow a,
        .right-arrow a {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #0d6efd;
            text-decoration: none;
            font-size: 18px;
        }
    </style>

    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="text-center col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="isax isax-home-15"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('doctors.search') }}">{{ __('booking.doctors') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('booking.book_appointment') }}</li>
                        </ol>
                        <h2 class="breadcrumb-title">{{ __('booking.book_appointment_with', ['name' => $doctor->name]) }}</h2>
                    </nav>
                </div>
            </div>
        </div>
        <div class="breadcrumb-bg">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-01.png') }}" alt="img"
                class="breadcrumb-bg-01">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-02.png') }}" alt="img"
                class="breadcrumb-bg-02">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img" class="breadcrumb-bg-03">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img" class="breadcrumb-bg-04">
        </div>
    </div>

    <div class="content doctor-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- معلومات الطبيب -->
                    <div class="card">
                        <div class="card-body">
                            <div class="booking-doc-info">
                                <a href="#" class="booking-doc-img">
                                    <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('frontend/xx/assets/img/doctors/doctor-thumb-01.jpg') }}" alt="{{ $doctor->name }}">
                                    {{-- <p>
                                        {{ $doctor->photo }}
                                    </p> --}}
                                </a>
                                <div class="booking-info">
                                    <h4><a href="{{ $doctor->doctorProfile && $doctor->doctorProfile->slug ? route('doctors.show', $doctor->doctorProfile->slug) : '#' }}">{{ $doctor->name }}</a></h4>
                                    <div class="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="fas fa-star {{ $i <= ($doctor->doctorProfile->average_rating ?? 4.5) ? 'filled' : '' }}"></i>
                                        @endfor
                                        <span
                                            class="d-inline-block average-rating">{{ $doctor->doctorProfile->average_rating ?? '4.5' }}</span>
                                    </div>
                                    <p class="mb-0 text-muted">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $doctor->doctorProfile->clinic_address ?? __('booking.address_not_specified') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- اختيار التاريخ والوقت -->
                    <div class="row">
                        <div class="col-12 col-sm-4 col-md-6">
                            <h4 class="mb-1" id="selected-date-display">
                                @if (count($availableDays) > 0)
                                    {{ \Carbon\Carbon::parse($availableDays[0]['date'])->format('d M Y') }}
                                @else
                                    {{ now()->format('d M Y') }}
                                @endif
                            </h4>
                            <p class="text-muted" id="selected-day-display">
                                @if (count($availableDays) > 0)
                                    {{ $availableDays[0]['day_name_arabic'] }}
                                @else
                                    {{ now()->translatedFormat('l') }}
                                @endif
                            </p>
                        </div>
                        <div class="col-12 col-sm-8 col-md-6 text-sm-end">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-primary btn-sm" id="current-week-btn">
                                    {{ __('booking.current_week') }}
                                </button>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle"
                                        data-bs-toggle="dropdown">
                                        {{ __('booking.choose_week') }}
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item week-option" href="#" data-week="0">{{ __('booking.current_week') }}</a></li>
                                        <li><a class="dropdown-item week-option" href="#" data-week="1">{{ __('booking.next_week') }}</a></li>
                                        <li><a class="dropdown-item week-option" href="#" data-week="2">{{ __('booking.after_two_weeks') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- جدول المواعيد -->
                    <div class="card booking-schedule schedule-widget">
                        <!-- رأس الجدول -->
                        <div class="schedule-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="day-slot">
                                        <ul>
                                            <li class="left-arrow">
                                                <a href="javascript:void(0)" id="prev-week">
                                                    <i class="fa fa-chevron-left"></i>
                                                </a>
                                            </li>
                                        @foreach ($availableDays as $day)
                                            <li class="day-item {{ $loop->first ? 'active' : '' }} {{ $day['is_past'] ? 'past-day' : '' }}"
                                                data-date="{{ $day['date'] }}" 
                                                data-day="{{ $day['day_name'] }}"
                                                data-day-arabic="{{ $day['day_name_arabic'] }}"
                                                data-day-of-week="{{ $day['day_of_week'] }}"
                                                @if($day['is_past']) title="{{ __('booking.cannot_book_past_date') }}" @endif>
                                                <span>{{ $day['day_name_arabic'] }}</span>
                                                <span class="slot-date">
                                                    {{ $day['display_date'] }}
                                                    <small class="slot-year">{{ $day['display_year'] }}</small>
                                                </span>
                                                @if($day['is_past'])
                                                    <small class="text-muted d-block">({{ __('booking.past') }})</small>
                                                @endif
                                            </li>
                                        @endforeach
                                            <li class="right-arrow">
                                                <a href="javascript:void(0)" id="next-week">
                                                    <i class="fa fa-chevron-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- محتوى الجدول -->
                        <div class="schedule-cont">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="time-slot" id="time-slots-container">
                                        @if (count($availableDays) > 0)
                                            <div class="py-4 text-center">
                                                <i class="mb-3 fas fa-clock fa-2x text-muted"></i>
                                                <p>{{ __('booking.select_day_to_view') }}</p>
                                            </div>
                                        @else
                                            <div class="py-4 text-center">
                                                <i class="mb-3 fas fa-calendar-times fa-2x text-muted"></i>
                                                <h5>{{ __('booking.no_available_days') }}</h5>
                                                <p class="text-muted">{{ __('booking.no_appointments_this_week') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- زر المتابعة -->
                    <div class="mt-4 mb-0 submit-section proceed-btn text-end">
                        <button type="button" id="proceed-btn" class="btn btn-primary submit-btn" disabled>
                            {{ __('booking.proceed_to_payment') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        let selectedScheduleId = null;
        let selectedDate = null;
        let selectedDay = null;
        let currentWeek = {{ $weekOffset }};
        const doctorSlug = "{{ $doctor->doctorProfile->slug }}";

        // دوال التنقل بين الأسابيع
        function navigateWeek(direction) {
            currentWeek += direction;
            window.location.href = getBookUrl(currentWeek);
        }



        function selectDay(dayElement) {
            const date = dayElement.getAttribute('data-date');
            
            // التحقق من أن التاريخ ليس في الماضي
            if (!isValidDate(date)) {
                alert('{{ __('booking.alert_past_date') }}');
                return;
            }

            // إزالة النشط من جميع الأيام
            const dayItems = document.querySelectorAll('.day-item');
            dayItems.forEach(day => day.classList.remove('active'));
            
            // إضافة النشط لليوم المختار
            dayElement.classList.add('active');

            selectedDate = date;
            selectedDay = dayElement.getAttribute('data-day');
            const dayArabic = dayElement.getAttribute('data-day-arabic');

            // تحديث عرض التاريخ
            const dateDisplay = document.getElementById('selected-date-display');
            const dayDisplay = document.getElementById('selected-day-display');
            
            if (dateDisplay) {
                dateDisplay.textContent = formatDate(selectedDate);
            }
            if (dayDisplay) {
                dayDisplay.textContent = dayArabic;
            }

            // جلب الأوقات المتاحة
            loadAvailableTimes(selectedDate, selectedDay);
        }


// التحقق من أن التاريخ ليس في الماضي
function isValidDate(dateString) {
    const selectedDate = new Date(dateString);
    const today = new Date();
    today.setHours(0, 0, 0, 0); // إزالة الوقت للتحقق من التاريخ فقط
    
    return selectedDate >= today;
}

// تحميل الأوقات المتاحة من السيرفر مع التحقق من التاريخ
function loadAvailableTimes(date, day) {
    // التحقق من أن التاريخ ليس في الماضي
    if (!isValidDate(date)) {
        const container = document.getElementById('time-slots-container');
        container.innerHTML = `
            <div class="py-4 text-center">
                <i class="mb-3 fas fa-calendar-times fa-2x text-warning"></i>
                <h5>{{ __('booking.cannot_select_past_date') }}</h5>
                <p class="text-muted">{{ __('booking.select_future_date') }}</p>
            </div>
        `;
        
        // تعطيل زر المتابعة
        document.getElementById('proceed-btn').disabled = true;
        return;
    }

    const container = document.getElementById('time-slots-container');
    if (!container) {
        console.error('Container not found');
        return;
    }

    container.innerHTML = `
        <div class="py-4 text-center">
            <div class="mb-3 spinner-border text-primary" role="status">
                <span class="visually-hidden">{{ __('booking.loading_available_times') }}</span>
            </div>
            <p>{{ __('booking.loading_available_times') }}</p>
        </div>`;

    fetch(`/doctors/${doctorSlug}/available-times?date=${date}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(slots => {
            displayTimeSlots(slots, container, date);
        })
        .catch(error => {
            console.error('Error:', error);
            container.innerHTML = `
                <div class="py-4 text-center">
                    <i class="mb-3 fas fa-exclamation-triangle fa-2x text-danger"></i>
                    <h5>{{ __('booking.error_loading_data') }}</h5>
                    <p class="text-muted">{{ __('booking.error_fetching_times') }}</p>
                    <button class="btn btn-primary btn-sm" onclick="window.loadAvailableTimes('${date}', '${day}')">
                        {{ __('booking.retry') }}
                    </button>
                </div>
            `;
        });
}



        function getBookUrl(week = 0) {
            return "{{ route('doctors.book', $doctor->doctorProfile->slug) }}?week=" + week;
        }

        // تحميل الأوقات المتاحة من السيرفر
        function loadAvailableTimes(date, day) {
            const container = document.getElementById('time-slots-container');
            if (!container) {
                console.error('Container not found');
                return;
            }

            container.innerHTML = `
                <div class="py-4 text-center">
                    <div class="mb-3 spinner-border text-primary" role="status">
                        <span class="visually-hidden">{{ __('booking.loading_available_times') }}</span>
                    </div>
                    <p>{{ __('booking.loading_available_times') }}</p>
                </div>`;

            fetch(`/doctors/${doctorSlug}/available-times?date=${date}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(slots => {
                    displayTimeSlots(slots, container, date);
                })
                .catch(error => {
                    console.error('Error:', error);
                    container.innerHTML = `
                        <div class="py-4 text-center">
                            <i class="mb-3 fas fa-exclamation-triangle fa-2x text-danger"></i>
                            <h5>{{ __('booking.error_loading_data') }}</h5>
                            <p class="text-muted">{{ __('booking.error_fetching_times') }}</p>
                            <button class="btn btn-primary btn-sm" onclick="window.loadAvailableTimes('${date}', '${day}')">
                                {{ __('booking.retry') }}
                            </button>
                        </div>
                    `;
                });
        }

        // عرض الأوقات المتاحة
        function displayTimeSlots(slots, container, date) {
            if (!slots || !Array.isArray(slots)) {
                container.innerHTML = `
                    <div class="py-4 text-center">
                        <i class="mb-3 fas fa-exclamation-triangle fa-2x text-warning"></i>
                        <h5>{{ __('booking.no_data') }}</h5>
                        <p class="text-muted">{{ __('booking.no_times_found') }}</p>
                    </div>
                `;
                return;
            }

            const availableSlots = slots.filter(slot => slot.is_available);

            if (availableSlots.length === 0) {
                container.innerHTML = `
                    <div class="py-4 text-center">
                        <i class="mb-3 fas fa-calendar-times fa-2x text-muted"></i>
                        <h5>{{ __('booking.no_available_times') }}</h5>
                        <p class="text-muted">{{ __('booking.all_booked_today') }}</p>
                    </div>
                `;
                return;
            }

            let html = '<div class="time-slot"><ul class="clearfix">';

            availableSlots.forEach(slot => {
                // استخدام start_time بدلاً من time لأن الاستجابة تحتوي على start_time
                const timeValue = slot.start_time || slot.time; 
                const scheduleId = generateScheduleId(slot.schedule_id, date, timeValue);
                
                html += `
                    <li>
                        <a class="timing time-slot-btn d-flex flex-column align-items-center justify-content-center"
                           style="height: auto; min-height: 80px;"
                           href="javascript:void(0)"
                           data-schedule-id="${scheduleId}"
                           data-date="${date}"
                           data-time="${timeValue}"
                           data-display="${slot.display}"
                           data-price="${slot.final_price}">
                            <span class="fw-bold">${slot.display}</span>
                        </a>
                    </li>
                `;
            });

            html += '</ul></div>';
            container.innerHTML = html;

            // إضافة event listeners للأزرار
            const timeButtons = container.querySelectorAll('.time-slot-btn');
            timeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // إزالة التحديد من جميع الأزرار
                    timeButtons.forEach(btn => btn.classList.remove('selected'));
                    // إضافة التحديد للزر المختار
                    this.classList.add('selected');

                    selectedScheduleId = this.getAttribute('data-schedule-id');
                    selectedDate = this.getAttribute('data-date');
                    const selectedTime = this.getAttribute('data-time');
                    const selectedDisplay = this.getAttribute('data-display');

                    // تفعيل زر المتابعة
                    const proceedBtn = document.getElementById('proceed-btn');
                    if (proceedBtn) {
                        proceedBtn.disabled = false;
                    }

                    // تحديث معلومات الموعد المختار
                    updateSelectedAppointmentInfo(selectedDate, selectedTime, selectedDisplay);
                });
            });
        }

        // دوال مساعدة
        function formatDate(dateString) {
            try {
                const date = new Date(dateString);
                return date.toLocaleDateString('ar-EG', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                });
            } catch (error) {
                return dateString;
            }
        }

        function formatTimeForDisplay(timeString) {
            try {
                const [hours, minutes] = timeString.split(':');
                const hour = parseInt(hours);
                const ampm = hour >= 12 ? 'PM' : 'AM';
                const displayHour = hour % 12 || 12;
                return `${displayHour}:${minutes} ${ampm}`;
            } catch (error) {
                return timeString;
            }
        }

       function generateScheduleId(scheduleId, date, time) {
                return `${scheduleId}_${date}_${time.replace(':', '')}`;
            }

        function updateSelectedAppointmentInfo(date, time, displayTime) {
            console.log('موعد مختار:', {
                date: date,
                time: time,
                display: displayTime,
                scheduleId: selectedScheduleId
            });
        }

        function selectDay(dayElement) {
            // إزالة النشط من جميع الأيام
            const dayItems = document.querySelectorAll('.day-item');
            dayItems.forEach(day => day.classList.remove('active'));
            // إضافة النشط لليوم المختار
            dayElement.classList.add('active');

            selectedDate = dayElement.getAttribute('data-date');
            selectedDay = dayElement.getAttribute('data-day');
            const dayArabic = dayElement.getAttribute('data-day-arabic');

            // تحديث عرض التاريخ
            const dateDisplay = document.getElementById('selected-date-display');
            const dayDisplay = document.getElementById('selected-day-display');
            
            if (dateDisplay) {
                dateDisplay.textContent = formatDate(selectedDate);
            }
            if (dayDisplay) {
                dayDisplay.textContent = dayArabic;
            }

            // جلب الأوقات المتاحة
            loadAvailableTimes(selectedDate, selectedDay);
        }

        // إضافة event listeners
        function initializeEventListeners() {
            // التنقل بين الأسابيع
            const prevWeekBtn = document.getElementById('prev-week');
            const nextWeekBtn = document.getElementById('next-week');
            
            if (prevWeekBtn) {
                prevWeekBtn.addEventListener('click', function() {
                    navigateWeek(-1);
                });
            }
            
            if (nextWeekBtn) {
                nextWeekBtn.addEventListener('click', function() {
                    navigateWeek(1);
                });
            }

            // اختيار أسبوع من القائمة
            document.querySelectorAll('.week-option').forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();
                    const week = this.getAttribute('data-week');
                    window.location.href = getBookUrl(week);
                });
            });

            // العودة للأسبوع الحالي
            const currentWeekBtn = document.getElementById('current-week-btn');
            if (currentWeekBtn) {
                currentWeekBtn.addEventListener('click', function() {
                    window.location.href = getBookUrl(0);
                });
            }

            // اختيار يوم
            const dayItems = document.querySelectorAll('.day-item');
            dayItems.forEach(item => {
                item.addEventListener('click', function() {
                    selectDay(this);
                });
            });

            // زر المتابعة
            const proceedBtn = document.getElementById('proceed-btn');
            if (proceedBtn) {
                proceedBtn.addEventListener('click', function() {
                    if (selectedScheduleId) {
                        // توجيه إلى صفحة  نجاح التاكيد
                        const checkoutUrl = "{{ route('appointments.checkout', ['scheduleId' => 'PLACEHOLDER']) }}";
        window.location.href = checkoutUrl.replace('PLACEHOLDER', selectedScheduleId);
                    } else {
                        alert('{{ __('booking.alert_select_appointment') }}');
                    }
                });
            }
        }

        // تهيئة التطبيق
        function initializeApp() {
            console.log('Application initialized');
            console.log('Day items found:', document.querySelectorAll('.day-item').length);

            initializeEventListeners();

            // تهيئة اليوم الأول إذا كان متاحاً
            @if (count($availableDays) > 0)
                const firstDay = document.querySelector('.day-item.active');
                if (firstDay) {
                    selectedDate = firstDay.getAttribute('data-date');
                    selectedDay = firstDay.getAttribute('data-day');
                    loadAvailableTimes(selectedDate, selectedDay);
                }
            @endif
        }

        // جعل الدوال متاحة globally للاستدعاء من الأزرار
        window.loadAvailableTimes = loadAvailableTimes;
        window.selectDay = selectDay;

        // بدء التطبيق
        initializeApp();
    });

</script>

  
@endsection
