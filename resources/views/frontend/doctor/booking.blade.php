{{-- resources/views/frontend/doctors/booking.blade.php --}}
@extends('frontend.layouts.master')

@section('content')

    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="text-center col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('doctors.search') }}">الأطباء</a></li>
                            <li class="breadcrumb-item"><a href="{{ $doctor->doctorProfile && $doctor->doctorProfile->slug ? route('doctors.show', $doctor->doctorProfile->slug) : '#' }}">{{ $doctor->name }}</a></li>
                            <li class="breadcrumb-item active">حجز موعد</li>
                        </ol>
                        <h2 class="breadcrumb-title">حجز موعد مع {{ $doctor->name }}</h2>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <!-- معلومات الطبيب -->
                <div class="col-lg-4">
                    <div class="card booking-card">
                        <div class="card-body">
                            <div class="booking-doc-info">
                                <div class="text-center">
                                    <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('frontend/xx/assets/img/doctors/doctor-thumb-01.jpg') }}"
                                        alt="د. {{ $doctor->name }}" class="mb-3 img-fluid rounded-circle" width="120">
                                    <h4>د. {{ $doctor->name }}</h4>
                                    <p class="text-muted">{{ $doctor->doctor_specialization }}</p>

                                    <div class="clinic-details">
                                        <p class="mb-2">
                                            <i class="fas fa-star text-warning"></i>
                                            التقييم: {{ $doctor->doctor_rating }}/5
                                        </p>
                                        <p class="mb-2">
                                            <i class="fas fa-briefcase text-primary"></i>
                                            الخبرة: {{ $doctor->doctor_experience }} سنة
                                        </p>
                                        <p class="mb-0">
                                            <i class="fas fa-user-md text-success"></i>
                                            {{ $doctor->doctorProfile->total_consultations ?? 0 }} استشارة
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- معلومات المريض -->
                    <div class="mt-4 card patient-info-card">
                        <div class="card-header">
                            <h5 class="mb-0 card-title">معلومات المريض</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>الاسم:</strong> {{ $patient->name }}</p>
                            <p><strong>البريد الإلكتروني:</strong> {{ $patient->email }}</p>
                            <p><strong>الهاتف:</strong> {{ $patient->phone }}</p>

                            @if ($patient->medicalProfile)
                                <div class="mt-3">
                                    <a href="{{ route('medical-profile.edit') }}" class="btn btn-outline-primary btn-sm">
                                        تحديث الملف الطبي
                                    </a>
                                </div>
                            @else
                                <div class="mt-3 alert alert-warning">
                                    <small>لم تقم بإكمال ملفك الطبي بعد.</small>
                                    {{-- <a href="{{ route('medical-profile.create') }}" class="mt-2 btn btn-sm btn-warning">
                                        إكمال الملف الطبي
                                    </a> --}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- نموذج الحجز -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 card-title">تفاصيل الحجز</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('appointments.store') }}" method="POST"
                                id="bookingForm">
                                @csrf

                                <!-- المركز الطبي -->
                                <div class="mb-4 form-group">
                                    <label for="medical_center_id" class="form-label">المركز الطبي <span
                                            class="text-danger">*</span></label>
                                    <select name="medical_center_id" id="medical_center_id" class="form-select" required>
                                        <option value="">اختر المركز الطبي</option>
                                        @foreach ($medicalCenters as $center)
                                            <option value="{{ $center->id }}"
                                                data-fee="{{ $center->pivot->consultation_fee ?? 100 }}"
                                                data-duration="{{ $center->pivot->appointment_duration ?? 30 }}">
                                                {{ $center->name }} - {{ $center->city }}
                                                (رسوم: ${{ $center->pivot->consultation_fee ?? 100 }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <!-- نوع الموعد -->
                                    <div class="col-md-6">
                                        <div class="mb-4 form-group">
                                            <label for="appointment_type" class="form-label">نوع الموعد <span
                                                    class="text-danger">*</span></label>
                                            <select name="appointment_type" id="appointment_type" class="form-select"
                                                required>
                                                <option value="consultation">استشارة أولية</option>
                                                <option value="follow_up">متابعة</option>
                                                <option value="emergency">حالة طارئة</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- طريقة الاستشارة -->
                                    <div class="col-md-6">
                                        <div class="mb-4 form-group">
                                            <label for="appointment_mode" class="form-label">طريقة الاستشارة <span
                                                    class="text-danger">*</span></label>
                                            <select name="appointment_mode" id="appointment_mode" class="form-select"
                                                required>
                                                <option value="in_person">حضوري</option>
                                                <option value="virtual">افتراضي (أونلاين)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- التاريخ -->
                                    <div class="col-md-6">
                                        <div class="mb-4 form-group">
                                            <label for="scheduled_date" class="form-label">التاريخ <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="scheduled_date" id="scheduled_date"
                                                class="form-control" min="{{ date('Y-m-d') }}" required>
                                        </div>
                                    </div>

                                    <!-- الوقت -->
                                    <div class="col-md-6">
                                        <div class="mb-4 form-group">
                                            <label for="scheduled_time" class="form-label">الوقت <span
                                                    class="text-danger">*</span></label>
                                            <select name="scheduled_time" id="scheduled_time" class="form-select"
                                                required disabled>
                                                <option value="">اختر التاريخ أولاً</option>
                                            </select>
                                            <div id="loadingSlots" class="d-none">
                                                <small class="text-muted">جاري تحميل الأوقات المتاحة...</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- المكافآت -->
                                @if ($activeRewards->count() > 0)
                                    <div class="mb-4 form-group">
                                        <label for="reward_id" class="form-label">استخدام مكافأة</label>
                                        <select name="reward_id" id="reward_id" class="form-select">
                                            <option value="">لا أريد استخدام مكافأة</option>
                                            @foreach ($activeRewards as $reward)
                                                <option value="{{ $reward->id }}"
                                                    data-discount="{{ $reward->discount_amount }}">
                                                    {{ $reward->title }} - خصم ${{ $reward->discount_amount }}
                                                    @if ($reward->expires_at)
                                                        (تنتهي في {{ $reward->expires_at->format('Y-m-d') }})
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <!-- ملاحظات -->
                                <div class="mb-4 form-group">
                                    <label for="patient_notes" class="form-label">ملاحظات إضافية</label>
                                    <textarea name="patient_notes" id="patient_notes" class="form-control" rows="3"
                                        placeholder="أي معلومات إضافية تريد إبلاغ الطبيب بها..."></textarea>
                                </div>

                                <!-- ملخص التكلفة -->
                                <div class="booking-summary card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">ملخص التكلفة</h6>
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="mb-1">رسوم الاستشارة:</p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <p class="mb-1" id="consultationFee">$0</p>
                                            </div>
                                        </div>
                                        <div class="row d-none" id="discountRow">
                                            <div class="col-6">
                                                <p class="mb-1">الخصم:</p>
                                            </div>
                                            <div class="col-6 text-end">
                                                <p class="mb-1 text-success" id="discountAmount">-$0</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-6">
                                                <h6 class="mb-0">المجموع:</h6>
                                            </div>
                                            <div class="col-6 text-end">
                                                <h6 class="mb-0 text-primary" id="totalFee">$0</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- زر الحجز -->
                                <div class="mt-4 form-group">
                                    <button type="submit" class="btn btn-primary btn-lg w-100" id="submitBtn" disabled>
                                        <i class="fas fa-calendar-check me-2"></i>
                                        تأكيد الحجز
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const medicalCenterSelect = document.getElementById('medical_center_id');
            const appointmentTypeSelect = document.getElementById('appointment_type');
            const dateInput = document.getElementById('scheduled_date');
            const timeSelect = document.getElementById('scheduled_time');
            const rewardSelect = document.getElementById('reward_id');
            const loadingSlots = document.getElementById('loadingSlots');
            const submitBtn = document.getElementById('submitBtn');

            // عناصر عرض التكلفة
            const consultationFeeEl = document.getElementById('consultationFee');
            const discountRow = document.getElementById('discountRow');
            const discountAmountEl = document.getElementById('discountAmount');
            const totalFeeEl = document.getElementById('totalFee');

            let baseFee = 0;

            // تحديث التكلفة
            function updateFees() {
                let fee = baseFee;

                // تعديل السعر حسب نوع الموعد
                if (appointmentTypeSelect.value === 'follow_up') {
                    fee = fee * 0.8; // خصم 20% للمتابعة
                } else if (appointmentTypeSelect.value === 'emergency') {
                    fee = fee * 1.2; // زيادة 20% للحالات الطارئة
                }

                // تطبيق الخصم من المكافأة
                let discount = 0;
                if (rewardSelect.value) {
                    const selectedOption = rewardSelect.options[rewardSelect.selectedIndex];
                    discount = parseFloat(selectedOption.dataset.discount) || 0;
                }

                const total = Math.max(0, fee - discount);

                // تحديث العرض
                consultationFeeEl.textContent = `$${fee.toFixed(2)}`;
                discountAmountEl.textContent = `-$${discount.toFixed(2)}`;
                totalFeeEl.textContent = `$${total.toFixed(2)}`;

                if (discount > 0) {
                    discountRow.classList.remove('d-none');
                } else {
                    discountRow.classList.add('d-none');
                }
            }

            // تحميل الأوقات المتاحة
            function loadAvailableSlots() {
                const medicalCenterId = medicalCenterSelect.value;
                const date = dateInput.value;

                if (!medicalCenterId || !date) {
                    timeSelect.innerHTML = '<option value="">اختر المركز والتاريخ أولاً</option>';
                    timeSelect.disabled = true;
                    submitBtn.disabled = true;
                    return;
                }

                timeSelect.disabled = true;
                loadingSlots.classList.remove('d-none');
                timeSelect.innerHTML = '<option value="">جاري تحميل الأوقات...</option>';

                fetch(
                        `{{ route('doctorshome.available-slots', $doctor->id) }}?date=${date}&medical_center_id=${medicalCenterId}`
                    )
                    .then(response => response.json())
                    .then(data => {
                        timeSelect.innerHTML = '';

                        if (data.slots.length === 0) {
                            timeSelect.innerHTML = '<option value="">لا توجد أوقات متاحة في هذا اليوم</option>';
                        } else {
                            data.slots.forEach(slot => {
                                const option = document.createElement('option');
                                option.value = slot;
                                option.textContent = slot;
                                timeSelect.appendChild(option);
                            });
                            timeSelect.disabled = false;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        timeSelect.innerHTML = '<option value="">حدث خطأ في تحميل الأوقات</option>';
                    })
                    .finally(() => {
                        loadingSlots.classList.add('d-none');
                        checkFormValidity();
                    });
            }

            // التحقق من صحة النموذج
            function checkFormValidity() {
                const isFormValid = medicalCenterSelect.value &&
                    dateInput.value &&
                    timeSelect.value &&
                    timeSelect.value !== '';

                submitBtn.disabled = !isFormValid;
            }

            // Event Listeners
            medicalCenterSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                baseFee = parseFloat(selectedOption.dataset.fee) || 0;
                updateFees();
                if (dateInput.value) {
                    loadAvailableSlots();
                }
            });

            appointmentTypeSelect.addEventListener('change', updateFees);
            rewardSelect.addEventListener('change', updateFees);
            dateInput.addEventListener('change', loadAvailableSlots);
            /

            // تحديث التكلفة الأولية
            updateFees();
        });
    </script>
@endsection
