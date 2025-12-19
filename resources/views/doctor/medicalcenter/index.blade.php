@extends('frontend.layouts.master')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="dashboard-header">
                    <h3>إدارة العيادات والمراكز الطبية</h3>
                    <p>قم بإدارة العيادات والمراكز التي تعمل بها</p>
                </div>

                @include('doctor.layouts.slide')

                <div class="col-lg-8 col-xl-9">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
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

                    <!-- العيادات المرتبطة -->
                    <div class="mb-4 card custom-card">
                        <div class="card-header">
                            <h4 class="mb-0 card-title">
                                <i class="fa fa-hospital me-2"></i>
                                العيادات والمراكز المرتبطة
                            </h4>
                        </div>
                        <div class="card-body">
                            @if ($linkedCenters->count() > 0)
                                <div class="row">
                                    @foreach ($linkedCenters as $center)
                                        @php
                                            $pivot = $center->pivot;
                                            $workingDays = json_decode($pivot->working_days, true) ?? [];
                                            $daysMap = [
                                                'الأحد',
                                                'الإثنين',
                                                'الثلاثاء',
                                                'الأربعاء',
                                                'الخميس',
                                                'الجمعة',
                                                'السبت',
                                            ];
                                        @endphp

                                        <div class="mb-4 col-md-6">
                                            <div
                                                class="medical-center-card card h-100 {{ $pivot->is_active ? 'border-success' : 'border-secondary' }}">
                                                <div class="card-body">
                                                    <div class="mb-3 d-flex justify-content-between align-items-start">
                                                        <h5 class="card-title">{{ $center->name }}</h5>
                                                        <span
                                                            class="badge bg-{{ $pivot->is_active ? 'success' : 'secondary' }}">
                                                            {{ $pivot->is_active ? 'نشط' : 'غير نشط' }}
                                                        </span>
                                                    </div>

                                                    <div class="mb-3 center-info">
                                                        <p class="mb-2 text-muted">
                                                            <i class="fa fa-map-marker me-2"></i>
                                                            {{ $center->address }}, {{ $center->city }}
                                                        </p>
                                                        <p class="mb-2 text-muted">
                                                            <i class="fa fa-phone me-2"></i>
                                                            {{ $center->phone }}
                                                        </p>
                                                        <p class="mb-2">
                                                            <strong>نوع التوظيف:</strong>
                                                            <span
                                                                class="badge bg-info">{{ $this->getEmploymentTypeArabic($pivot->employment_type) }}</span>
                                                        </p>
                                                        <p class="mb-2">
                                                            <strong>رسوم الاستشارة:</strong>
                                                            {{ $pivot->consultation_fee }} ر.س
                                                        </p>
                                                        @if ($pivot->follow_up_fee)
                                                            <p class="mb-2">
                                                                <strong>رسوم المتابعة:</strong>
                                                                {{ $pivot->follow_up_fee }} ر.س
                                                            </p>
                                                        @endif
                                                    </div>

                                                    <div class="mb-3 working-days">
                                                        <strong>أيام العمل:</strong>
                                                        <div class="mt-1">
                                                            @foreach ($workingDays as $day)
                                                                <span
                                                                    class="badge bg-light text-dark me-1">{{ $daysMap[$day] }}</span>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <div class="gap-2 action-buttons d-flex">
                                                        <button class="btn btn-sm btn-outline-primary edit-center"
                                                            data-bs-toggle="modal" data-bs-target="#editCenterModal"
                                                            data-link-id="{{ $pivot->id }}"
                                                            data-center="{{ json_encode($center) }}"
                                                            data-pivot="{{ json_encode($pivot) }}">
                                                            <i class="fa fa-edit"></i> تعديل
                                                        </button>

                                                        <form
                                                            action="{{ route('doctor.medical-centers.toggle-status', $pivot->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-{{ $pivot->is_active ? 'warning' : 'success' }}">
                                                                <i
                                                                    class="fa fa-{{ $pivot->is_active ? 'pause' : 'play' }}"></i>
                                                                {{ $pivot->is_active ? 'إيقاف' : 'تفعيل' }}
                                                            </button>
                                                        </form>

                                                        <form
                                                            action="{{ route('doctor.medical-centers.destroy', $pivot->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                onclick="return confirm('هل أنت متأكد من إنهاء العمل في هذه العيادة؟')">
                                                                <i class="fa fa-trash"></i> إنهاء
                                                            </button>
                                                        </form>
                                                    </div>

                                                    @if (!$pivot->is_approved)
                                                        <div class="mt-2">
                                                            <span class="badge bg-warning">في انتظار الموافقة</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="py-4 text-center">
                                    <i class="mb-3 fa fa-hospital-o fa-3x text-muted"></i>
                                    <p class="text-muted">لا توجد عيادات مرتبطة حالياً</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- العيادات المتاحة للانضمام -->
                    <div class="card custom-card">
                        <div class="card-header">
                            <h4 class="mb-0 card-title">
                                <i class="fa fa-plus-circle me-2"></i>
                                الانضمام إلى عيادة جديدة
                            </h4>
                        </div>
                        <div class="card-body">
                            @if ($availableCenters->count() > 0)
                                <div class="row">
                                    @foreach ($availableCenters as $center)
                                        <div class="mb-3 col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="card-title">{{ $center->name }}</h6>
                                                    <p class="mb-2 text-muted small">
                                                        <i class="fa fa-map-marker me-1"></i>
                                                        {{ $center->address }}, {{ $center->city }}
                                                    </p>
                                                    <p class="mb-2 text-muted small">
                                                        <i class="fa fa-phone me-1"></i>
                                                        {{ $center->phone }}
                                                    </p>

                                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#joinCenterModal"
                                                        data-center-id="{{ $center->id }}"
                                                        data-center-name="{{ $center->name }}">
                                                        <i class="fa fa-user-plus"></i> طلب الانضمام
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="py-3 text-center">
                                    <p class="text-muted">لا توجد عيادات متاحة للانضمام حالياً</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal الانضمام إلى عيادة جديدة -->
        <div class="modal fade" id="joinCenterModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">طلب الانضمام إلى عيادة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="joinCenterForm" action="{{ route('doctor.medical-centers.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="medical_center_id" id="medical_center_id">

                        <div class="modal-body">
                            <div class="mb-4 text-center">
                                <h6 id="centerName" class="text-primary"></h6>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">نوع التوظيف</label>
                                        <select name="employment_type" class="form-select" required>
                                            <option value="">اختر نوع التوظيف</option>
                                            <option value="full_time">دوام كامل</option>
                                            <option value="part_time">دوام جزئي</option>
                                            <option value="contract">عقد</option>
                                            <option value="visiting">زيارة</option>
                                            <option value="consultant">استشاري</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">التخصص في هذه العيادة</label>
                                        <select name="specialty_id" class="form-select" required>
                                            <option value="">اختر التخصص</option>
                                            @foreach ($specialties as $specialty)
                                                <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">رسوم الاستشارة (درهم إماراتي)</label>
                                        <input type="number" name="consultation_fee" class="form-control"
                                            step="0.01" min="0" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">رسوم المتابعة (درهم إماراتي)</label>
                                        <input type="number" name="follow_up_fee" class="form-control" step="0.01"
                                            min="0">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">مدة الموعد (دقيقة)</label>
                                        <select name="appointment_duration" class="form-select" required>
                                            <option value="15">15 دقيقة</option>
                                            <option value="20">20 دقيقة</option>
                                            <option value="30" selected>30 دقيقة</option>
                                            <option value="45">45 دقيقة</option>
                                            <option value="60">60 دقيقة</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">الحد الأقصى للمواعيد اليومية</label>
                                        <input type="number" name="max_daily_appointments" class="form-control"
                                            value="20" min="1" max="50" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">أيام العمل</label>
                                <div class="row">
                                    @php $days = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت']; @endphp
                                    @foreach ($days as $index => $day)
                                        <div class="mb-2 col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="working_days[]"
                                                    value="{{ $index }}" id="day{{ $index }}">
                                                <label class="form-check-label"
                                                    for="day{{ $index }}">{{ $day }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-primary">إرسال طلب الانضمام</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .medical-center-card {
            transition: all 0.3s ease;
        }

        .medical-center-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .center-info p {
            margin-bottom: 0.5rem;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // modal الانضمام
            const joinCenterModal = document.getElementById('joinCenterModal');
            if (joinCenterModal) {
                joinCenterModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const centerId = button.getAttribute('data-center-id');
                    const centerName = button.getAttribute('data-center-name');

                    document.getElementById('medical_center_id').value = centerId;
                    document.getElementById('centerName').textContent = centerName;
                });
            }

            // modal التعديل
            const editButtons = document.querySelectorAll('.edit-center');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const linkId = this.getAttribute('data-link-id');
                    const center = JSON.parse(this.getAttribute('data-center'));
                    const pivot = JSON.parse(this.getAttribute('data-pivot'));

                    // هنا يمكنك فتح modal التعديل وملء البيانات
                    console.log('Edit center:', center, pivot);
                });
            });
        });

        // دالة مساعدة لعرض نوع التوظيف بالعربية
        function getEmploymentTypeArabic(type) {
            const types = {
                'full_time': 'دوام كامل',
                'part_time': 'دوام جزئي',
                'contract': 'عقد',
                'visiting': 'زيارة',
                'consultant': 'استشاري'
            };
            return types[type] || type;
        }
    </script>
@endsection
