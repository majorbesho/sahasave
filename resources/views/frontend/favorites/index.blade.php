@extends('frontend.layouts.master')



@section('title', 'الأطباء المفضلون')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <h2>
                        <i class="fas fa-heart text-danger"></i>
                        الأطباء المفضلون
                    </h2>
                    <span class="badge bg-primary fs-5">{{ $favorites->total() }} طبيب</span>
                </div>

                @if ($favorites->isEmpty())
                    <div class="py-5 text-center alert alert-info">
                        <i class="mb-3 fas fa-heart fa-3x text-muted"></i>
                        <h4>لا توجد أطباء في المفضلة</h4>
                        <p class="text-muted">ابحث عن أطباء وأضفهم للمفضلة لسهولة الوصول إليهم</p>
                        <a href="{{ route('doctors.search') }}" class="mt-3 btn btn-primary">
                            <i class="fas fa-search"></i> ابحث عن أطباء
                        </a>
                    </div>
                @else
                    <div class="row">
                        @foreach ($favorites as $favorite)
                            @php
                                $doctor = $favorite->doctor;
                                $profile = $doctor->doctorProfile;
                            @endphp

                            <div class="mb-4 col-md-6 col-lg-4">
                                <div class="shadow-sm card h-100 favorite-card">
                                    <div class="card-body">
                                        <!-- Header -->
                                        <div class="mb-3 d-flex justify-content-between align-items-start">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $doctor->photo }}" alt="{{ $doctor->name }}"
                                                    class="rounded-circle me-2" width="60" height="60"
                                                    style="object-fit: cover;">
                                                <div>
                                                    <h5 class="mb-0">
                                                        <a href="{{ route('doctors.show', $doctor->id) }}"
                                                            class="text-decoration-none text-dark"
                                                            onclick="recordView({{ $favorite->id }})">
                                                            {{ $doctor->name }}
                                                        </a>
                                                    </h5>
                                                    <small class="text-muted">
                                                        {{ $profile->specialty->name ?? 'غير محدد' }}
                                                    </small>
                                                </div>
                                            </div>

                                            <!-- إزالة من المفضلة -->
                                            <button class="p-0 btn btn-sm btn-link text-danger"
                                                onclick="removeFavorite({{ $favorite->id }})" title="إزالة من المفضلة">
                                                <i class="fas fa-heart-broken"></i>
                                            </button>
                                        </div>

                                        <!-- Rating -->
                                        @if ($profile->average_rating > 0)
                                            <div class="mb-2">
                                                <span class="text-warning">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $profile->average_rating)
                                                            <i class="fas fa-star"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </span>
                                                <small class="text-muted">
                                                    ({{ $profile->reviews_count }} تقييم)
                                                </small>
                                            </div>
                                        @endif

                                        <!-- Info -->
                                        <div class="mb-3">
                                            <div class="mb-2 d-flex justify-content-between">
                                                <span class="text-muted">سعر الكشف:</span>
                                                <strong class="text-primary">
                                                    {{ $profile->consultation_fee ?? 0 }} جنيه
                                                </strong>
                                            </div>

                                            @if ($favorite->note)
                                                <div class="py-2 mb-0 alert alert-light">
                                                    <small>
                                                        <i class="fas fa-sticky-note text-warning"></i>
                                                        {{ $favorite->note }}
                                                    </small>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Stats -->
                                        <div class="mb-3 d-flex justify-content-between text-muted small">
                                            <span>
                                                <i class="fas fa-clock"></i>
                                                أضيف {{ $favorite->added_ago }}
                                            </span>
                                            <span>
                                                <i class="fas fa-eye"></i>
                                                {{ $favorite->views_count }} مشاهدة
                                            </span>
                                        </div>

                                        <!-- Actions -->
                                        <div class="gap-2 d-grid">
                                            <a href="{{ route('appointments.create', ['doctor_id' => $doctor->id]) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-calendar-plus"></i>
                                                احجز موعد
                                            </a>

                                            <button class="btn btn-outline-secondary btn-sm"
                                                onclick="openNoteModal({{ $favorite->id }}, '{{ addslashes($favorite->note) }}')">
                                                <i class="fas fa-edit"></i>
                                                {{ $favorite->note ? 'تعديل الملاحظة' : 'إضافة ملاحظة' }}
                                            </button>
                                        </div>

                                        <!-- Notification Toggle -->
                                        <div class="mt-3 form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="notify_{{ $favorite->id }}"
                                                {{ $favorite->notify_availability ? 'checked' : '' }}
                                                onchange="toggleNotifications({{ $favorite->id }})">
                                            <label class="form-check-label small" for="notify_{{ $favorite->id }}">
                                                إشعار عند التوفر
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $favorites->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Note Modal -->
    <div class="modal fade" id="noteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">إضافة/تعديل ملاحظة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <textarea id="noteText" class="form-control" rows="4" maxlength="500" placeholder="اكتب ملاحظتك هنا..."></textarea>
                    <small class="text-muted">الحد الأقصى 500 حرف</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" onclick="saveNote()">حفظ</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        let currentFavoriteId = null;
        const noteModal = new bootstrap.Modal(document.getElementById('noteModal'));

        function openNoteModal(favoriteId, currentNote) {
            currentFavoriteId = favoriteId;
            document.getElementById('noteText').value = currentNote || '';
            noteModal.show();
        }

        function saveNote() {
            const note = document.getElementById('noteText').value;

            fetch(`/patient/favorites/${currentFavoriteId}/note`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        note
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        noteModal.hide();
                        location.reload();
                    }
                });
        }

        function removeFavorite(favoriteId) {
            if (!confirm('هل أنت متأكد من إزالة هذا الطبيب من المفضلة؟')) {
                return;
            }

            fetch(`/patient/favorites/${favoriteId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
        }

        function toggleNotifications(favoriteId) {
            fetch(`/patient/favorites/${favoriteId}/notifications`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // يمكن إضافة toast notification
                        console.log(data.message);
                    }
                });
        }

        function recordView(favoriteId) {
            fetch(`/patient/favorites/${favoriteId}/view`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
        }
    </script>
@endsection



@push('styles')
    <style>
        .favorite-card {
            transition: transform 0.2s;
        }

        .favorite-card:hover {
            transform: translateY(-5px);
        }
    </style>
@endpush
