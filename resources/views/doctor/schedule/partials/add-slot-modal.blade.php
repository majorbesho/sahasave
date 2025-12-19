<style>
    /* تحسين مظهر أيام الأسبوع مع أزرار الإضافة */
    .day-item {
        position: relative;
        padding-bottom: 50px;
        /* مساحة للزر */
    }

    .day-item .btn {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
    }

    /* تحسين الـ Modal */
    .modal-header .btn-close {
        margin: 0;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 5px;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
    }

    .submit-section .btn {
        margin: 0 5px;
    }
</style>
<div class="modal fade custom-modal" id="add_slot" tabindex="-1" aria-labelledby="addSlotModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSlotModalLabel">إضافة مواعيد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('doctor.schedule.store') }}" method="POST" id="addSlotForm">
                    @csrf
                    <input type="hidden" name="day_of_week" id="day_of_week_input" value="">

                    <div class="row form-row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">التاريخ <span class="text-muted">(اختياري)</span></label>
                                <input type="date" name="date" class="form-control">
                                <small class="text-muted">اتركه فارغاً لاستخدام يوم الأسبوع المحدد</small>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">نوع الموعد</label>
                                <select name="appointment_type" class="form-select" required>
                                    <option value="clinic">عيادة</option>
                                    <option value="virtual">افتراضي</option>
                                    <option value="home">منزلي</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="hours-info">
                        <div class="row form-row hours-cont">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">وقت البدء</label>
                                    <input type="time" name="start_time" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">وقت الانتهاء</label>
                                    <input type="time" name="end_time" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row form-row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">مدة الجلسة (دقيقة)</label>
                                <select name="session_duration" class="form-select" required>
                                    <option value="20">20 دقيقة</option>
                                    <option value="30" selected>30 دقيقة</option>
                                    <option value="45">45 دقيقة</option>
                                    <option value="60">60 دقيقة</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">الحد الأقصى للجلسات</label>
                                <input type="number" name="max_sessions" class="form-control" value="10"
                                    min="1" required>
                            </div>
                        </div>
                    </div>

                    <div class="row form-row">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">الرسوم</label>
                                <input type="number" name="consultation_fee" class="form-control" min="0"
                                    step="0.01" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">الخصم</label>
                                <input type="number" name="discount" class="form-control" min="0"
                                    step="0.01">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label class="form-label">نوع الخصم</label>
                                <select name="discount_type" class="form-select">
                                    <option value="">لا يوجد</option>
                                    <option value="percentage">نسبة مئوية (%)</option>
                                    <option value="fixed">مبلغ ثابت</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 text-center submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">حفظ التغييرات</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // إدارة الـ Modal
    function openAddSlotModal(dayOfWeek, dayName) {
        document.getElementById('day_of_week_input').value = dayOfWeek;
        document.getElementById('addSlotModalLabel').textContent = `إضافة مواعيد لـ ${dayName}`;

        // إعادة تعيين النموذج
        document.getElementById('addSlotForm').reset();

        // فتح الـ Modal
        const modal = new bootstrap.Modal(document.getElementById('add_slot'));
        modal.show();
    }

    // إضافة زر لإضافة المواعيد في واجهة الطبيب
    function addScheduleButtons() {
        const dayItems = document.querySelectorAll('.day-item');

        dayItems.forEach(item => {
            const dayOfWeek = item.getAttribute('data-day-of-week');
            const dayName = item.getAttribute('data-day-arabic');

            // إضافة زر إضافة موعد
            const addButton = document.createElement('button');
            addButton.className = 'btn btn-sm btn-outline-secondary mt-2';
            addButton.innerHTML = '<i class="fas fa-plus"></i> إضافة موعد';
            addButton.onclick = function(e) {
                e.stopPropagation();
                openAddSlotModal(dayOfWeek, dayName);
            };

            item.appendChild(addButton);
        });
    }

    // استدعاء الدالة عند تحميل الصفحة
    document.addEventListener('DOMContentLoaded', function() {
        addScheduleButtons();
    });
</script>
