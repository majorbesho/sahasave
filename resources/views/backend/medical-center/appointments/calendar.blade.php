@extends('backend.layouts.medical-center')

@section('title', 'تقويم المواعيد')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('medical-center.appointments.index') }}">المواعيد</a></li>
    <li class="breadcrumb-item active">التقويم</li>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">تقويم المواعيد الشهري</h6>
    </div>
    <div class="card-body">
        <div id="calendar"></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'ar',
        direction: 'rtl',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [], // يمكنك ربطها بـ API لجلب المواعيد حقيقية
        dateClick: function(info) {
            // منطق إضافة موعد جديد
        },
        eventClick: function(info) {
            // الانتقال لتفاصيل الموعد
        }
    });
    calendar.render();
});
</script>
@endpush
