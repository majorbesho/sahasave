


@extends('frontend.layouts.master')

@section('content')



<style>
        .attachment-upload {
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
        }

        .attachment-upload:hover {
            border-color: #0d6efd;
        }

        .attachment-placeholder {
            color: #6c757d;
        }

        .attachment-box {
            display: flex;
            justify-content: between;
            align-items: center;
            padding: 10px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .booking-pricing .booking-price-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .booking-pricing .total {
            border-top: 1px solid #e9ecef;
            padding-top: 10px;
            font-weight: bold;
            font-size: 1.1em;
        }
</style>

<!-- Page Content -->
<div class="doctor-content">
    <div class="container">

        <!-- Patient -->
      

<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="paitent-header">
            <h4 class="paitent-title">بيانات المريض</h4>
        </div>
        <div class="paitent-appointment">
            <form action="{{ route('appointments.store') }}" method="POST" id="appointmentForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                <input type="hidden" name="appointment_date" value="{{ $date }}">
                <input type="hidden" name="appointment_time" value="{{ $time }}">
                <input type="hidden" name="consultation_fee" value="{{ $schedule->consultation_fee }}">

                <div class="forms-block">
                    <label class="form-group-title">الحجز لـ</label>
                    <label class="custom_radio me-4">
                        <input type="radio" name="appointment_for" value="self" checked>
                        <span class="checkmark"></span> نفسي
                    </label>
                    <label class="custom_radio">
                        <input type="radio" name="appointment_for" value="dependent">
                        <span class="checkmark"></span> تابع
                    </label>
                </div>

                <div class="forms-block" id="dependentSection" style="display: none;">
                    <div class="form-group-flex">
                        <label class="form-group-title">اختر التابع</label>
                        <a href="javascript:void(0);" class="btn" id="addDependentBtn">
                            <i class="feather-plus"></i> إضافة تابع
                        </a>
                    </div>
                    <div class="paitent-dependent-select">
                        {{-- <select class="select" name="dependent_id" id="dependentSelect">
                            <option value="">اختر</option>
                            @foreach(auth()->user()->dependents as $dependent)
                                <option value="{{ $dependent->id }}">
                                    {{ $dependent->name }} - {{ $dependent->relationship }}
                                </option>
                            @endforeach
                        </select> --}}
                    </div>
                </div>

                <div class="forms-block">
                    <label class="form-group-title">هل لديك تأمين صحي؟</label>
                    <label class="custom_radio me-4">
                        <input type="radio" name="has_insurance" value="1">
                        <span class="checkmark"></span> نعم
                    </label>
                    <label class="custom_radio">
                        <input type="radio" name="has_insurance" value="0" checked>
                        <span class="checkmark"></span> لا
                    </label>
                </div>

                <div class="forms-block" id="insuranceSection" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>شركة التأمين</label>
                                <input type="text" name="insurance_company" class="form-control" placeholder="اسم شركة التأمين">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>رقم البوليصة</label>
                                <input type="text" name="insurance_number" class="form-control" placeholder="رقم البوليصة">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="forms-block">
                    <label class="form-group-title">سبب الزيارة</label>
                    <textarea class="form-control" name="reason" placeholder="اذكر سبب زيارتك للطبيب" maxlength="400" required></textarea>
                    <p class="characters-text"><span id="charCount">0</span>/400 حرف</p>
                </div>

                <div class="forms-block">
                    <label class="form-group-title d-flex align-items-center">
                        <i class="fa fa-paperclip me-2"></i> المرفقات
                    </label>
                    <div class="attachment-upload">
                        <input type="file" name="attachments[]" id="fileInput" multiple style="display: none;" accept="image/*,.pdf,.doc,.docx">
                        <div class="attachment-placeholder" id="attachmentPlaceholder">
                            <i class="feather-upload-cloud"></i>
                            <p>اسحب وأفلت الملفات هنا أو <span class="text-primary">اختر ملفات</span></p>
                            <small>PDF, DOC, PNG, JPG (الحد الأقصى 5MB لكل ملف)</small>
                        </div>
                        <div class="attachment-preview" id="attachmentPreview"></div>
                    </div>
                </div>

                <div class="forms-block">
                    <label class="form-group-title">الأعراض <span>(اختياري)</span></label>
                    <input type="text" class="form-control" name="symptoms" placeholder="اذكر الأعراض التي تعاني منها">
                </div>

                <div class="forms-block mb-0">
                    <div class="booking-btn">
                        <button type="submit" class="btn btn-primary prime-btn justify-content-center align-items-center">
                            التالي <i class="feather-arrow-right-circle"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4 col-md-12">
        <div class="booking-header">
            <h4 class="booking-title">ملخص الحجز</h4>
        </div>
        
        <div class="card booking-card">
            <div class="card-body booking-card-body">
                <div class="booking-doctor-details">
                    <div class="booking-doctor-left">
                        <div class="booking-doctor-img">
                            <a href="{{ route('doctorshome.show', $doctor->id) }}">
                                <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('frontend/xx/assets/img/doctors/doctor-thumb-01.jpg') }}" alt="{{ $doctor->name }}">
                            </a>
                        </div>
                        <div class="booking-doctor-info">
                            <h4><a href="{{ route('doctorshome.show', $doctor->id) }}">د. {{ $doctor->name }}</a></h4>
                            <p>{{ $doctor->doctorProfile->specialization ?? 'طبيب' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card booking-card">
            <div class="card-body booking-card-body booking-list-body">
                <div class="booking-list">
                    <div class="booking-date-list">
                        <ul>
                            <li>تاريخ الحجز: <span>{{ \Carbon\Carbon::parse($date)->translatedFormat('l, j F Y') }}</span></li>
                            <li>وقت الحجز: 
                                <i class="warning"></i>
                                 الموعد غير مؤكد ... برجاء الانتظار التاكيد في خلال 24 ساعه 
                                <span>{{ \Carbon\Carbon::parse($time)->format('h:i A') }}</span></li>
        <div class="card booking-card">
            <div class="card-body booking-card-body">
                <div class="booking-pricing">
                    <div class="booking-price-item">
                        <span>رسوم الكشف:</span>
                        <span>{{ number_format($schedule->consultation_fee, 2) }} درهم إماراتي</span>
                    </div>
                    @if($schedule->discount > 0)
                    <div class="booking-price-item text-success">
                        <span>الخصم:</span>
                        <span>-{{ number_format($schedule->discount, 2) }} درهم إماراتي</span>
                    </div>
                    @endif
                    <div class="booking-price-item total">
                        <span>المجموع:</span>
                        <span>{{ number_format($schedule->consultation_fee - $schedule->discount, 2) }} درهم إماراتي</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card booking-card">
            <div class="card-body booking-card-body">
                <div class="booking-doctor-details">
                    <div class="booking-device">
                        <div class="booking-device-img">
                            <img src="{{ asset('frontend/xx/assets/img/icons/device-message.svg') }}" alt="device-message-image">
                        </div>
                        <div class="booking-doctor-info">
                            <h3>نحن هنا لمساعدتك</h3>
                            <p class="device-text">اتصل بنا +971545060739 أو دردش مع فريق الدعم.</p>
                            <a href="{{ route('contactus') }}" class="btn">دردش معنا</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- /Patient -->

<script>
// أبسط نسخة ممكنة
document.addEventListener('DOMContentLoaded', function() {
    // فقط الأساسيات الضرورية
    const elements = {
        dependent: document.getElementById('dependentSection'),
        insurance: document.getElementById('insuranceSection'),
        charCount: document.getElementById('charCount')
    };

    // تبديل الأقسام
    document.querySelectorAll('input[name="appointment_for"]').forEach(radio => {
        radio.addEventListener('change', function() {
            if (elements.dependent) {
                elements.dependent.style.display = this.value === 'dependent' ? 'block' : 'none';
            }
        });
    });

    document.querySelectorAll('input[name="has_insurance"]').forEach(radio => {
        radio.addEventListener('change', function() {
            if (elements.insurance) {
                elements.insurance.style.display = this.value === '1' ? 'block' : 'none';
            }
        });
    });

    // عداد الأحرف
    const reasonTextarea = document.querySelector('textarea[name="reason"]');
    if (reasonTextarea && elements.charCount) {
        reasonTextarea.addEventListener('input', function() {
            elements.charCount.textContent = this.value.length;
        });
    }
});
</script>
@endsection