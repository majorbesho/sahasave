@extends('backend.layouts.medical-center')

@section('title', 'جدول مواعيد الطبيب')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('medical-center.doctors.index') }}">الأطباء</a></li>
    <li class="breadcrumb-item active">جدول مواعيد الطبيب</li>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">إدارة المواعيد المتاحة للطبيب #{{ $id }}</h6>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            سيتم دمج نظام الجدولة الكامل هنا قريباً.
        </div>
        <p>يمكنك حالياً عرض المواعيد من خلال قسم <a href="{{ route('medical-center.appointments.index', ['doctor_id' => $id]) }}">المواعيد</a>.</p>
    </div>
</div>
@endsection
