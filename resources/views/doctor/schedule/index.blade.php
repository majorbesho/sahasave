@extends('frontend.layouts.master')

@section('content')
<style>
/* =================================================
=== تخصيصات CSS لـ FullCalendar ومنع التفاعل ===
=================================================
*/

/* تحسين مظهر القوائم المنسدلة */
.form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.form-select option:checked {
    background-color: #007bff;
    color: white;
}

.form-select option:disabled {
    color: #6c757d;
    background-color: #f8f9fa;
}

/* مؤشر المواعيد (يظهر على الأيام التي فيها مواعيد مستقبلية) */
.appointment-indicator {
    position: absolute;
    top: 5px;
    left: 5px;
    background: #28a745;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    z-index: 1;
}

/* تمييز اليوم الحالي */
.fc-day-today {
    background-color: #e8f4fd !important;
    border: 2px solid #007bff !important; /* إضافة حدود لتمييزه بشكل أوضح */
}

.fc-day-today .fc-daygrid-day-number {
    background-color: #007bff;
    color: white;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 2px;
}

/* ================================
=== التعديل الرئيسي للأيام الماضية ===
================================
*/
/* تنسيق الأيام الماضية: باهتة وغير مسموح بالنقر */
.fc-day-past {
    background-color: #f8f9fa !important;
    opacity: 0.6; /* جعلها باهتة قليلاً */
    cursor: not-allowed !important;
    pointer-events: none !important; /* الأهم: منع النقر والتفاعل بالكامل */
}

/* تنسيق رقم اليوم في الأيام الماضية */
.fc-day-past .fc-daygrid-day-number {
    color: #999 !important; /* لون رمادي باهت */
}

/* تنسيق الأحداث في الأيام الماضية */
.fc-day-past .fc-event {
    opacity: 0.3 !important;
}

/* تحسين مظهر الأيام المستقبلية */
.fc-day-future {
    background-color: white;
    cursor: pointer;
}

/* تحسين مظهر الأحداث */
.fc-event {
    cursor: pointer;
    font-size: 0.8em;
    padding: 2px 4px;
    margin: 1px 0;
    border-radius: 3px;
    border: none;
}

/* تنسيقات الأحداث */
.fc-event-medical_center {
    background-color: #007bff;
}

.fc-event-private {
    background-color: #28a745;
}

/* تحسين مظهر القوائم المنسدلة المعطلة */
.form-select:disabled {
    background-color: #e9ecef;
    opacity: 1;
    cursor: not-allowed;
}

</style>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="dashboard-header">
                    <h3>إدارة المواعيد المتاحة</h3>
                    <p>قم بإدارة جداول المواعيد في العيادات والمراكز الطبية</p>
                </div>

                @include('doctor.layouts.slide')

                <div class="col-lg-8 col-xl-9">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-4 card">
                        <div class="card-header">
                            <h5 class="mb-0">التقويم الشهري</h5>
                        </div>
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>

                    <div class="mb-3 card custom-card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">فلتر حسب العيادة:</label>
                                    <select class="form-select" id="medicalCenterFilter">
                                        <option value="">جميع العيادات</option>
                                        @foreach ($medicalCenters as $center)
                                            <option value="{{ $center->id }}">{{ $center->name }}</option>
                                        @endforeach
                                        <option value="private">عيادات خاصة</option>
                                    </select>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_slot">
                                        <i class="fa fa-plus"></i> إضافة موعد جديد
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
            </div>
        </div>

        <div class="modal fade" id="add_slot" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">إضافة موعد جديد</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('doctor.schedule.store') }}" method="POST" id="scheduleForm">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">التاريخ <span class="text-danger">*</span></label>
                                        {{-- تم تغيير min لإتاحة اختيار اليوم الحالي فما فوق فقط --}}
                                        <input type="date" name="date" class="form-control" id="appointment_date" 
                                               min="{{ date('Y-m-d') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">اليوم</label>
                                        <input type="text" class="form-control" id="day_name" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">وقت البدء <span class="text-danger">*</span></label>
                                        <select name="start_time" class="form-select" id="start_time" required>
                                            <option value="">-- اختر وقت البدء --</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">وقت الانتهاء</label>
                                        <select name="end_time" class="form-select" id="end_time" required>
                                            <option value="">-- اختر وقت الانتهاء --</option>
                                            </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">العيادة / المركز الطبي</label>
                                        <select name="medical_center_id" class="form-select" id="medical_center_select">
                                            <option value="">-- اختر مركز طبي --</option>
                                            @foreach ($medicalCenters as $center)
                                                <option value="{{ $center->id }}">{{ $center->name }}</option>
                                            @endforeach
                                            {{-- قيمة فارغة تعني عيادة خاصة --}}
                                            <option value="">عيادة خاصة</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">مدة الجلسة (دقيقة) <span class="text-danger">*</span></label>
                                        <select name="session_duration" class="form-select" id="session_duration" required>
                                            <option value="20">20 دقيقة</option>
                                            <option value="30" selected>30 دقيقة</option>
                                            <option value="45">45 دقيقة</option>
                                            <option value="60">60 دقيقة</option>
                                            <option value="120">ساعتين (120 دقيقة)</option>
                                            <option value="180">3 ساعات (180 دقيقة)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row" id="private_clinic_section" style="display: none;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">اسم العيادة <span class="text-danger">*</span></label>
                                        <input type="text" name="clinic_name" class="form-control" placeholder="اسم العيادة الخاصة">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">عنوان العيادة</label>
                                        <input type="text" name="clinic_address" class="form-control" placeholder="عنوان العيادة">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">نوع الاستشارة <span class="text-danger">*</span></label>
                                        <select name="appointment_type" class="form-select" required>
                                            <option value="clinic">عيادة</option>
                                            <option value="virtual">افتراضي</option>
                                            <option value="home">منزلي</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">سعر الاستشارة (درهم إماراتي) <span class="text-danger">*</span></label>
                                        <input type="number" name="consultation_fee" class="form-control" step="0.01" min="0" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-primary">حفظ الموعد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/ar.js'></script>


<script>
        document.addEventListener('DOMContentLoaded', function() {
        let selectedStartTime = '';

        // تهيئة التقويم
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'ar',
            direction: 'rtl',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: {
                url: '{{ route("doctor.doctor.schedule.calendar-events") }}',
                method: 'GET'
            },
            dateClick: function(info) {
                // التحقق قبل فتح المودال (طبقة حماية إضافية على الرغم من منع النقر بالـ CSS)
                const clickedDate = new Date(info.dateStr);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                
                if (clickedDate < today) {
                    // لن يتم الوصول لهذا الكود إلا إذا كان هناك تجاوز لـ pointer-events: none
                    Swal.fire({
                        title: 'غير مسموح',
                        text: 'لا يمكن اختيار تاريخ ماضي',
                        icon: 'warning',
                        confirmButtonText: 'حسناً'
                    });
                    return;
                }
                
                $('#appointment_date').val(info.dateStr);
                updateDayName(info.dateStr);
                generateTimeSlots();
                $('#add_slot').modal('show');
            },
            eventClick: function(info) {
                showAppointmentDetails(info.event);
            },
            eventDisplay: 'block',
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            },

            // **التعديل الرئيسي 1:** ضمان عدم إمكانية التنقل إلى الأشهر الماضية بالأسهم
            validRange: function(nowDate) {
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                return {
                    start: today
                };
            },
            
            // **التعديل الرئيسي 2:** تطبيق التنسيقات وإضافة مؤشر المواعيد
            dayCellDidMount: function(info) {
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                const cellDate = info.date;
                
                // إضافة تلميح للأيام الماضية
                if (cellDate < today) {
                    info.el.title = 'تاريخ ماضي - غير متاح';
                    // الاعتماد على CSS لـ opacity و pointer-events: none
                }
                
                // تمييز اليوم الحالي (الـ CSS يغطي هذا، ولكن للتأكد)
                if (cellDate.toDateString() === today.toDateString()) {
                    info.el.classList.add('fc-day-today');
                }
                
                // التحقق إذا كان هناك مواعيد في هذا اليوم وإضافة مؤشر
                const hasEvents = info.dayNumberText && calendar.getEvents().some(event => {
                    const eventDate = new Date(event.start);
                    eventDate.setHours(0, 0, 0, 0); // مقارنة التاريخ فقط
                    return eventDate.toDateString() === cellDate.toDateString();
                });
                
                if (hasEvents && cellDate >= today) {
                    info.el.classList.add('has-appointments');
                    info.el.style.position = 'relative';
                    
                    // إضافة مؤشر مرئي (اعتماداً على تنسيق .appointment-indicator في الـ CSS)
                    const indicator = document.createElement('div');
                    indicator.className = 'appointment-indicator';
                    indicator.innerHTML = '<i class="fa fa-calendar-check"></i>';
                    info.el.appendChild(indicator);
                }
            },
            
            // تخصيص مظهر الأحداث
            eventDidMount: function(info) {
                const eventDate = new Date(info.event.start);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                
                // إذا كان الحدث في يوم ماضي، جعله باهت (بالإضافة إلى CSS)
                if (eventDate < today) {
                    info.el.style.opacity = '0.4';
                    info.el.style.cursor = 'not-allowed';
                }
                
                const icon = info.event.extendedProps.type === 'medical_center' ? 
                    '<i class="fa fa-hospital me-1"></i>' : 
                    '<i class="fa fa-stethoscope me-1"></i>';
                
                info.el.innerHTML = icon + info.event.title;
                
                info.el.title = `${info.event.title}\nالوقت: ${info.event.start.toLocaleTimeString('ar-EG', {hour: '2-digit', minute:'2-digit'})}\nالمدة: ${info.event.extendedProps.duration} دقيقة\nالسعر: ${info.event.extendedProps.fee} ر.س`;
            },
            
        });
        
        calendar.render();

        // دالة لعرض تفاصيل الموعد
        function showAppointmentDetails(event) {
            // (الكود كما هو)
            const startTime = event.start.toLocaleTimeString('ar-EG', {hour: '2-digit', minute:'2-digit'});
            const endTime = event.end.toLocaleTimeString('ar-EG', {hour: '2-digit', minute:'2-digit'});
            const type = event.extendedProps.type === 'medical_center' ? 'مركز طبي' : 'عيادة خاصة';
            
            Swal.fire({
                title: event.title,
                html: `
                    <div class="text-start">
                        <p><strong>النوع:</strong> ${type}</p>
                        <p><strong>الوقت:</strong> ${startTime} - ${endTime}</p>
                        <p><strong>المدة:</strong> ${event.extendedProps.duration} دقيقة</p>
                        <p><strong>السعر:</strong> ${event.extendedProps.fee} ر.س</p>
                        <p><strong>التاريخ:</strong> ${event.start.toLocaleDateString('ar-EG')}</p>
                    </div>
                `,
                icon: 'info',
                confirmButtonText: 'حسناً'
            });
        }

        // تحديث اسم اليوم عند اختيار التاريخ
        function updateDayName(dateStr) {
            const date = new Date(dateStr);
            // تأكد من أن أسماء الأيام هي باللغة العربية
            const days = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];
            $('#day_name').val(days[date.getDay()]);
        }

        // توليد أوقات البداية والنهاية
        function generateTimeSlots() {
            const selectedDate = $('#appointment_date').val();
            
            // التحقق من صلاحية التاريخ قبل جلب المواعيد
            const today = new Date().toISOString().split('T')[0];
            if (selectedDate && selectedDate < today) {
                // (منطق منع التحديد في الماضي)
                populateTimeSlots([], null, null);
                return;
            }

            const currentStartValue = $('#start_time').val();
            const currentEndValue = $('#end_time').val();
            
            if (selectedDate) {
                checkBookedSlots(selectedDate, currentStartValue, currentEndValue);
            } else {
                populateTimeSlots([], currentStartValue, currentEndValue);
            }
        }

        // جلب المواعيد المحجوزة في تاريخ معين
        function checkBookedSlots(date, currentStartValue, currentEndValue) {
            $.ajax({
                url: '{{ route("doctor.doctor.schedule.booked-slots") }}',
                method: 'GET',
                data: { date: date },
                success: function(response) {
                    window.bookedSlots = response.booked_slots || [];
                    populateTimeSlots(window.bookedSlots, currentStartValue, currentEndValue);
                },
                error: function() {
                    window.bookedSlots = [];
                    populateTimeSlots([], currentStartValue, currentEndValue);
                }
            });
        }

        // تعبئة قائمة الأوقات مع الحفاظ على القيم المختارة
        function populateTimeSlots(bookedSlots, currentStartValue, currentEndValue) {
            const startSelect = $('#start_time');
            const endSelect = $('#end_time');
            const duration = parseInt($('#session_duration').val()) || 30; // الحصول على المدة الحالية
            
            startSelect.empty().append('<option value="">-- اختر وقت البدء --</option>');
            endSelect.empty().append('<option value="">-- اختر وقت الانتهاء --</option>');
            
            // التحقق من أن التاريخ ليس في الماضي
            const selectedDate = $('#appointment_date').val();
            const today = new Date().toISOString().split('T')[0];
            
            if (selectedDate < today) {
                startSelect.empty().append('<option value="">-- التاريخ الماضي غير متاح --</option>');
                endSelect.empty().append('<option value="">-- التاريخ الماضي غير متاح --</option>');
                startSelect.prop('disabled', true);
                endSelect.prop('disabled', true);
                return;
            } else {
                startSelect.prop('disabled', false);
                endSelect.prop('disabled', false);
            }
            
            for (let hour = 8; hour <= 20; hour++) {
                for (let minute = 0; minute < 60; minute += 15) {
                    const timeString = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                    const formattedTime = formatTime(timeString);
                    
                    // حساب وقت النهاية لهذا الخيار لعرضه كنطاق
                    const [h, m] = timeString.split(':').map(Number);
                    const totalMins = h * 60 + m + duration;
                    const endH = Math.floor(totalMins / 60);
                    const endM = totalMins % 60;
                    const endTimeString = `${endH.toString().padStart(2, '0')}:${endM.toString().padStart(2, '0')}`;
                    const formattedEndTime = formatTime(endTimeString);
                    
                    const rangeLabel = `${formattedTime} - ${formattedEndTime}`;

                    const startSelected = timeString === currentStartValue ? 'selected' : '';
                    // عرض النطاق في القائمة
                    startSelect.append(`<option value="${timeString}" ${startSelected}>${rangeLabel}</option>`);
                    
                    const endSelected = timeString === currentEndValue ? 'selected' : '';
                    endSelect.append(`<option value="${timeString}" ${endSelected}>${formattedTime}</option>`);
                }
            }

            // استعادة القيم المختارة إن وجدت
            if (currentStartValue && startSelect.find(`option[value="${currentStartValue}"]:not(:disabled)`).length > 0) {
                startSelect.val(currentStartValue);
            } else {
                startSelect.val('');
            }

            if (currentEndValue && endSelect.find(`option[value="${currentEndValue}"]:not(:disabled)`).length > 0) {
                endSelect.val(currentEndValue);
            } else {
                endSelect.val('');
            }

            if (startSelect.val()) {
                updateEndTimeOptions(startSelect.val());
            }
        }

        function formatTime(timeString) {
            const [hours, minutes] = timeString.split(':');
            const hour = parseInt(hours);
            const ampm = hour >= 12 ? 'م' : 'ص';
            const formattedHour = hour % 12 || 12;
            return `${formattedHour}:${minutes} ${ampm}`;
        }

        // تحديث أوقات النهاية عند اختيار وقت البداية
        $('#start_time').on('change', function() {
            const startTime = $(this).val();
            selectedStartTime = startTime;
            
            if (startTime) {
                updateEndTimeOptions(startTime);
            } else {
                $('#end_time').val('');
            }
        });

        // تحديث خيارات وقت النهاية بناءً على وقت البدء والمدة
        function updateEndTimeOptions(startTime) {
            const duration = parseInt($('#session_duration').val());
            const endSelect = $('#end_time');
            
            if (startTime) {
                const [startHour, startMinute] = startTime.split(':').map(Number);
                const startTotalMinutes = startHour * 60 + startMinute;
                const endTotalMinutes = startTotalMinutes + duration;
                
                const endHour = Math.floor(endTotalMinutes / 60);
                const endMinute = endTotalMinutes % 60;
                const calculatedEndTime = `${endHour.toString().padStart(2, '0')}:${endMinute.toString().padStart(2, '0')}`;
                
                // إخفاء/تعطيل الأوقات التي تساوي أو تسبق وقت البدء + المدة
                endSelect.find('option').each(function() {
                    const optionTime = $(this).val();
                    if (optionTime && optionTime <= calculatedEndTime) {
                        $(this).hide().prop('disabled', true);
                    } else {
                        // إعادة إظهار وتمكين باقي الأوقات
                        $(this).show().prop('disabled', $(this).is(':contains("(محجوز)")'));
                    }
                });
                
                // محاولة اختيار وقت الانتهاء المحسوب أو أول وقت متاح بعده
                if (endSelect.find(`option[value="${calculatedEndTime}"]:not(:disabled)`).length > 0) {
                    endSelect.val(calculatedEndTime);
                } else {
                    const firstAvailable = endSelect.find('option:not(:disabled):visible').first();
                    if (firstAvailable.length > 0) {
                        endSelect.val(firstAvailable.val());
                    } else {
                        endSelect.val('');
                    }
                }
            }
        }

        // تحديث الأوقات عند تغيير التاريخ - مع الحفاظ على القيم
        $('#appointment_date').on('change', function() {
            updateDayName($(this).val());
            generateTimeSlots();
        });

        // تحديث خيارات النهاية عند تغيير مدة الجلسة
        $('#session_duration').on('change', function() {
            // إعادة توليد القائمة لتحديث النطاقات المعروضة في وقت البدء
            generateTimeSlots();
        });

        // تبديل قسم العيادة الخاصة
        $('#medical_center_select').on('change', function() {
            if ($(this).val() === '') {
                $('#private_clinic_section').show();
                $('input[name="clinic_name"]').prop('required', true);
            } else {
                $('#private_clinic_section').hide();
                $('input[name="clinic_name"]').prop('required', false);
            }
        });

        // فلتر العيادات
        $('#medicalCenterFilter').on('change', function() {
            // (يمكنك استخدام هذه الوظيفة لفلترة جدول مواعيد آخر، لكنها لا تؤثر على عرض FullCalendar هنا مباشرة)
            const selectedCenter = $(this).val();
            calendar.refetchEvents(); // إعادة جلب الأحداث لتطبيق الفلترة إذا كان السيرفر يدعمها
            // أو قم بتطبيق منطق الفلترة على الأحداث في الواجهة
        });

        // توليد الأوقات عند فتح المودال
        $('#add_slot').on('show.bs.modal', function() {
            const today = new Date().toISOString().split('T')[0];
            $('#appointment_date').val(today);
            updateDayName(today);
            
            selectedStartTime = '';
            generateTimeSlots();
        });

        // منع إغلاق المودال عند حدوث خطأ في الإرسال
        $('#scheduleForm').on('submit', function(e) {
            const startTime = $('#start_time').val();
            const endTime = $('#end_time').val();
            const selectedDate = $('#appointment_date').val();
            const today = new Date().toISOString().split('T')[0];
            
            if (selectedDate < today) {
                e.preventDefault();
                alert('لا يمكن حجز موعد في تاريخ ماضي');
                return false;
            }
            
            if (!startTime || !endTime) {
                e.preventDefault();
                alert('يرجى اختيار وقت البدء ووقت الانتهاء');
                return false;
            }
            
            if (startTime >= endTime) {
                e.preventDefault();
                alert('وقت الانتهاء يجب أن يكون بعد وقت البدء');
                return false;
            }
        });
    });
</script>
@endsection