@extends('backend.layouts.master')

@section('content')

<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>إدارة التقييمات</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item active">التقييمات</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistics Cards -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $stats['total'] }}</h3>
                                <p>إجمالي التقييمات</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-comments"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $stats['pending'] }}</h3>
                                <p>قيد المراجعة</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $stats['approved'] }}</h3>
                                <p>تمت الموافقة</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $stats['rejected'] }}</h3>
                                <p>مرفوض</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @include('backend.layouts.notification')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">قائمة التقييمات</h3>
                                
                                <!-- Filters -->
                                <div class="card-tools">
                                    <form action="{{ route('admin.reviews.index') }}" method="GET" class="form-inline">
                                        <select name="status" class="form-control form-control-sm mr-2">
                                            <option value="">-- كل الحالات --</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>قيد المراجعة</option>
                                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>مقبول</option>
                                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>مرفوض</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fas fa-filter"></i> تصفية
                                        </button>
                                        @if(request()->has('status'))
                                            <a href="{{ route('admin.reviews.index') }}" class="btn btn-sm btn-secondary ml-1">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        @endif
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>المريض</th>
                                            <th>الطبيب</th>
                                            <th>التقييم</th>
                                            <th>التعليق</th>
                                            <th>الحالة</th>
                                            <th>التاريخ</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($reviews as $review)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                     @if($review->patient && $review->patient->photo)
                                                        <img src="{{ asset('storage/' . $review->patient->photo) }}" 
                                                             class="img-circle mr-2" 
                                                             style="width: 30px; height: 30px; object-fit: cover;">
                                                    @endif
                                                    {{ $review->patient->name ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td>{{ $review->doctor->name ?? 'N/A' }}</td>
                                            <td>
                                                <span class="text-warning">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $review->rating ? '' : 'text-muted' }}"></i>
                                                    @endfor
                                                </span>
                                                ({{ $review->rating }})
                                            </td>
                                            <td>
                                                <span title="{{ $review->comment }}">
                                                    {{ Str::limit($review->comment, 50) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($review->status == 'pending')
                                                    <span class="badge badge-warning">قيد المراجعة</span>
                                                @elseif($review->status == 'approved')
                                                    <span class="badge badge-success">مقبول</span>
                                                @else
                                                    <span class="badge badge-danger">مرفوض</span>
                                                @endif
                                            </td>
                                            <td>{{ $review->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                @if($review->status === 'pending')
                                                    <form action="{{ route('admin.reviews.updateStatus', $review->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="approved">
                                                        <button type="submit" class="btn btn-sm btn-success" title="قبول">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.reviews.updateStatus', $review->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit" class="btn btn-sm btn-danger" title="رفض">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="حذف">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">
                                                لا توجد تقييمات حالياً
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                {{ $reviews->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection
