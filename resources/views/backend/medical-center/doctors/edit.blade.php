@extends('backend.layouts.medical-center')

@section('title', 'تعديل بيانات الطبيب')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('medical-center.doctors.index') }}">الأطباء</a></li>
    <li class="breadcrumb-item active">تعديل بيانات الطبيب</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">تعديل بيانات الطبيب #{{ $id }}</h6>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    سيتم عرض بيانات الطبيب هنا قريباً.
                </div>
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">الاسم الكامل</label>
                        <input type="text" class="form-control" disabled value="جاري التحميل...">
                    </div>

                    <div class="mt-4 text-end">
                        <a href="{{ route('medical-center.doctors.index') }}" class="btn btn-secondary">إلغاء</a>
                        <button type="submit" class="btn btn-primary" disabled>تحديث البيانات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
