{{-- resources/views/admin/medical-centers/create.blade.php --}}
@extends('backend.layouts.master')

@section('title', 'إضافة مركز طبي جديد')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="mb-2 row">
                    <div class="col-sm-6">
                        <h1>Users Account</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">إضافة مركز طبي جديد</h3>
                            <div class="card-tools">
                                <a href="{{ route('medical-centers.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-right"></i> العودة للقائمة
                                </a>
                            </div>
                        </div>
                        <form action="{{ route('medical-centers.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                @include('backend.medical-centers.partials.form')
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> حفظ المركز الطبي
                                </button>
                                <a href="{{ route('medical-centers.index') }}" class="btn btn-secondary">إلغاء</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
