


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
            <h4 class="paitent-title">{{ __('checkout.patient_details') }}</h4>
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
                    <label class="form-group-title">{{ __('checkout.booking_for') }}</label>
                    <label class="custom_radio me-4">
                        <input type="radio" name="appointment_for" value="self" checked>
                        <span class="checkmark"></span> {{ __('checkout.self') }}
                    </label>
                    <label class="custom_radio">
                        <input type="radio" name="appointment_for" value="dependent">
                        <span class="checkmark"></span> {{ __('checkout.dependent') }}
                    </label>
                </div>

                <div class="forms-block" id="dependentSection" style="display: none;">
                    <div class="form-group-flex">
                        <label class="form-group-title">{{ __('checkout.choose_dependent') }}</label>
                        <a href="javascript:void(0);" class="btn" id="addDependentBtn">
                            <i class="feather-plus"></i> {{ __('checkout.add_dependent') }}
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
                    <label class="form-group-title">{{ __('checkout.has_insurance') }}</label>
                    <label class="custom_radio me-4">
                        <input type="radio" name="has_insurance" value="1">
                        <span class="checkmark"></span> {{ __('checkout.yes') }}
                    </label>
                    <label class="custom_radio">
                        <input type="radio" name="has_insurance" value="0" checked>
                        <span class="checkmark"></span> {{ __('checkout.no') }}
                    </label>
                </div>

                <div class="forms-block" id="insuranceSection" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('checkout.insurance_company') }}</label>
                                <input type="text" name="insurance_company" class="form-control" placeholder="{{ __('checkout.insurance_company_placeholder') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('checkout.policy_number') }}</label>
                                <input type="text" name="insurance_number" class="form-control" placeholder="{{ __('checkout.policy_number_placeholder') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="forms-block">
                    <label class="form-group-title">{{ __('checkout.visit_reason') }}</label>
                    <textarea class="form-control" name="reason" placeholder="{{ __('checkout.visit_reason_placeholder') }}" maxlength="400" required></textarea>
                    <p class="characters-text"><span id="charCount">0</span>/400 {{ __('checkout.chars') }}</p>
                </div>

                <div class="forms-block">
                    <label class="form-group-title d-flex align-items-center">
                        <i class="fa fa-paperclip me-2"></i> {{ __('checkout.attachments') }}
                    </label>
                    <div class="attachment-upload">
                        <input type="file" name="attachments[]" id="fileInput" multiple style="display: none;" accept="image/*,.pdf,.doc,.docx">
                        <div class="attachment-placeholder" id="attachmentPlaceholder">
                            <i class="feather-upload-cloud"></i>
                            <p>{{ __('checkout.drag_drop') }} <span class="text-primary">{{ __('checkout.choose_files') }}</span></p>
                            <small>{{ __('checkout.file_limits') }}</small>
                        </div>
                        <div class="attachment-preview" id="attachmentPreview"></div>
                    </div>
                </div>

                <div class="forms-block">
                    <label class="form-group-title">{{ __('checkout.symptoms') }} <span>{{ __('checkout.optional') }}</span></label>
                    <input type="text" class="form-control" name="symptoms" placeholder="{{ __('checkout.symptoms_placeholder') }}">
                </div>

                <div class="forms-block mb-0">
                    <div class="booking-btn">
                        <button type="submit" class="btn btn-primary prime-btn justify-content-center align-items-center">
                            {{ __('checkout.next') }} <i class="feather-arrow-right-circle"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4 col-md-12">
        <div class="booking-header">
            <h4 class="booking-title">{{ __('checkout.booking_summary') }}</h4>
        </div>
        
        <div class="card booking-card">
            <div class="card-body booking-card-body">
                <div class="booking-doctor-details">
                    <div class="booking-doctor-left">
                        <div class="booking-doctor-img">
                            <a href="{{ $doctor->doctorProfile && $doctor->doctorProfile->slug ? route('doctors.show', $doctor->doctorProfile->slug) : '#' }}">
                                <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('frontend/xx/assets/img/doctors/doctor-thumb-01.jpg') }}" alt="{{ $doctor->name }}">
                            </a>
                        </div>
                        <div class="booking-doctor-info">
                            <h4><a href="{{ $doctor->doctorProfile && $doctor->doctorProfile->slug ? route('doctors.show', $doctor->doctorProfile->slug) : '#' }}">د. {{ $doctor->name }}</a></h4>
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
                            <li>{{ __('checkout.booking_date') }}: <span>{{ \Carbon\Carbon::parse($date)->translatedFormat('l, j F Y') }}</span></li>
                            <li>{{ __('checkout.booking_time') }}: 
                                <i class="warning"></i>
                                 {{ __('checkout.appointment_unconfirmed') }}  
                                <span>{{ \Carbon\Carbon::parse($time)->format('h:i A') }}</span></li>
        <div class="card booking-card">
            <div class="card-body booking-card-body">
                <div class="booking-pricing">
                    <div class="booking-price-item">
                        <span>{{ __('checkout.consultation_fee') }}:</span>
                        <span>{{ number_format($schedule->consultation_fee, 2) }} {{ __('checkout.aed') }}</span>
                    </div>
                    @if($schedule->discount > 0)
                    <div class="booking-price-item text-success">
                        <span>{{ __('checkout.discount') }}:</span>
                        <span>-{{ number_format($schedule->discount, 2) }} {{ __('checkout.aed') }}</span>
                    </div>
                    @endif
                    <div class="booking-price-item total">
                        <span>{{ __('checkout.total') }}:</span>
                        <span>{{ number_format($schedule->consultation_fee - $schedule->discount, 2) }} {{ __('checkout.aed') }}</span>
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
                            <h3>{{ __('checkout.we_are_here_to_help') }}</h3>
                            <p class="device-text">{{ __('checkout.contact_support') }}</p>
                            <a href="{{ route('contactus') }}" class="btn">{{ __('checkout.chat_with_us') }}</a>
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
document.addEventListener('DOMContentLoaded', function() {
    // 1. إدارة الأقسام (التابعين والتأمين)
    const elements = {
        dependent: document.getElementById('dependentSection'),
        insurance: document.getElementById('insuranceSection'),
        charCount: document.getElementById('charCount')
    };

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

    const reasonTextarea = document.querySelector('textarea[name="reason"]');
    if (reasonTextarea && elements.charCount) {
        reasonTextarea.addEventListener('input', function() {
            elements.charCount.textContent = this.value.length;
        });
    }

    // 2. إدارة المرفقات (سحب وإفلات + معاينة)
    const uploadArea = document.querySelector('.attachment-upload');
    const fileInput = document.getElementById('fileInput');
    const filePreview = document.getElementById('attachmentPreview');

    if (uploadArea && fileInput) {
        // فتح نافذة اختيار الملفات عند النقر على المنطقة
        uploadArea.addEventListener('click', function(e) {
            // منع تكرار الحدث إذا تم النقر على أيقونة الحذف
            if (e.target.closest('.remove-file')) return;
            fileInput.click();
        });

        // تغيير نمط المنطقة عند السحب
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, function(e) {
                e.preventDefault();
                e.stopPropagation();
                this.style.borderColor = '#0d6efd';
                this.style.backgroundColor = 'rgba(13, 110, 253, 0.05)';
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, function(e) {
                e.preventDefault();
                e.stopPropagation();
                this.style.borderColor = '#ddd';
                this.style.backgroundColor = 'transparent';
            }, false);
        });

        // معالجة الملفات عند الإفلات
        uploadArea.addEventListener('drop', function(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
        });

        // معالجة الملفات عند الاختيار التقليدي
        fileInput.addEventListener('change', function() {
            handleFiles(this.files);
        });

        function handleFiles(files) {
            // تحويل FileList إلى Drop لإمكانية استخدامه (اختياري للعرض فقط هنا)
            // ملاحظة: لا يمكن تعديل fileInput.files برمجياً بسهولة لدعم الإضافة التراكمية،
            // لذلك سنعرض فقط الملفات المختارة حالياً في الـ input
            // لدعم تراكيم الملفات يحتاج AJAX أو DataTransfer manipulation معقد.
            
            // لتحديث الـ input عند السحب والإفلات (مهم)
            if (files !== fileInput.files) {
                fileInput.files = files;
            }

            filePreview.innerHTML = ''; // مسح المعاينة السابقة
            
            Array.from(files).forEach((file, index) => {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                
                reader.onloadend = function() {
                    const div = document.createElement('div');
                    div.className = 'attachment-box';
                    
                    // تحديد الأيقونة بناءً على نوع الملف
                    let iconClass = 'feather-file-text';
                    if (file.type.includes('image')) iconClass = 'feather-image';
                    else if (file.type.includes('pdf')) iconClass = 'feather-file';

                    div.innerHTML = `
                        <div class="d-flex align-items-center">
                            <i class="${iconClass} me-2 fs-4 text-primary"></i>
                            <div>
                                <h6 class="mb-0 text-truncate" style="max-width: 200px;">${file.name}</h6>
                                <small class="text-muted">${(file.size / 1024 / 1024).toFixed(2)} MB</small>
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="text-danger remove-file" data-index="${index}">
                            <i class="feather-x"></i>
                        </a>
                    `;
                    
                    filePreview.appendChild(div);
                }
            });
        }
    }
});
</script>
@endsection