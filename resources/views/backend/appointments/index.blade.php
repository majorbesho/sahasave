@extends('backend.layouts.master')

@section('content')

<div class="wrapper">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>إدارة المواعيد</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item active">المواعيد</li>
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
                                <p>إجمالي المواعيد</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $stats['pending'] }}</h3>
                                <p>قيد الانتظار</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $stats['confirmed'] }}</h3>
                                <p>مؤكد</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $stats['cancelled'] }}</h3>
                                <p>ملغي</p>
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
                                <h3 class="card-title">قائمة المواعيد</h3>
                                
                                <!-- Filters -->
                                <div class="card-tools">
                                    <form action="{{ route('admin.appointments.index') }}" method="GET" class="form-inline">
                                        <select name="status" class="form-control form-control-sm mr-2">
                                            <option value="">-- الحالة --</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>مؤكد</option>
                                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>مكتمل</option>
                                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>ملغي</option>
                                        </select>
                                        <input type="text" name="search" class="form-control form-control-sm mr-2" 
                                               placeholder="بحث بالاسم..." value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        @if(request()->hasAny(['status', 'search']))
                                            <a href="{{ route('admin.appointments.index') }}" class="btn btn-sm btn-secondary ml-1">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        @endif
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="appointmentsTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>رقم الموعد</th>
                                            <th>المريض</th>
                                            <th>الطبيب</th>
                                            <th>التخصص</th>
                                            <th>تاريخ الموعد</th>
                                            <th>نوع الموعد</th>
                                            <th>الحالة</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($appointments as $appointment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <code>{{ $appointment->appointment_number }}</code>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($appointment->patient && $appointment->patient->photo)
                                                        <img src="{{ asset('storage/' . $appointment->patient->photo) }}" 
                                                             alt="{{ $appointment->patient->name ?? 'Patient' }}" 
                                                             class="img-circle mr-2" 
                                                             style="width: 35px; height: 35px; object-fit: cover;">
                                                    @else
                                                        <div class="img-circle mr-2 bg-secondary d-flex align-items-center justify-content-center" 
                                                             style="width: 35px; height: 35px;">
                                                            <i class="fas fa-user text-white"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <strong>{{ $appointment->patient->name ?? 'N/A' }}</strong>
                                                        <br><small class="text-muted">{{ $appointment->patient->email ?? '' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($appointment->doctor && $appointment->doctor->photo)
                                                        <img src="{{ asset('storage/' . $appointment->doctor->photo) }}" 
                                                             alt="{{ $appointment->doctor->name ?? 'Doctor' }}" 
                                                             class="img-circle mr-2" 
                                                             style="width: 35px; height: 35px; object-fit: cover;">
                                                    @else
                                                        <div class="img-circle mr-2 bg-primary d-flex align-items-center justify-content-center" 
                                                             style="width: 35px; height: 35px;">
                                                            <i class="fas fa-user-md text-white"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <strong>{{ $appointment->doctor->name ?? 'N/A' }}</strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">
                                                    {{ $appointment->doctor->doctorProfile->specialty->name ?? 'غير محدد' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($appointment->scheduled_for)
                                                    <div>
                                                        <i class="fas fa-calendar text-primary"></i>
                                                        {{ $appointment->scheduled_for->format('Y-m-d') }}
                                                    </div>
                                                    <small class="text-muted">
                                                        <i class="fas fa-clock"></i>
                                                        {{ $appointment->scheduled_for->format('h:i A') }}
                                                    </small>
                                                @else
                                                    <span class="text-muted">غير محدد</span>
                                                @endif
                                            </td>
                                            <td>
                                                @switch($appointment->type)
                                                    @case('video_call')
                                                        <span class="badge badge-primary"><i class="fas fa-video"></i> مكالمة فيديو</span>
                                                        @break
                                                    @case('audio_call')
                                                        <span class="badge badge-info"><i class="fas fa-phone"></i> مكالمة صوتية</span>
                                                        @break
                                                    @case('direct_visit')
                                                        <span class="badge badge-secondary"><i class="fas fa-hospital"></i> زيارة مباشرة</span>
                                                        @break
                                                    @default
                                                        <span class="badge badge-light">{{ $appointment->type ?? 'غير محدد' }}</span>
                                                @endswitch
                                            </td>
                                            <td>
                                                @switch($appointment->status)
                                                    @case('pending')
                                                        <span class="badge badge-warning">قيد الانتظار</span>
                                                        @break
                                                    @case('confirmed')
                                                        <span class="badge badge-success">مؤكد</span>
                                                        @break
                                                    @case('completed')
                                                        <span class="badge badge-info">مكتمل</span>
                                                        @break
                                                    @case('cancelled')
                                                        <span class="badge badge-danger">ملغي</span>
                                                        @break
                                                    @default
                                                        <span class="badge badge-secondary">{{ $appointment->status }}</span>
                                                @endswitch
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.appointments.show', $appointment->id) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   data-toggle="tooltip" 
                                                   title="عرض التفاصيل">
                                                    <i class="fas fa-eye"></i> عرض
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted py-4">
                                                <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                                <p>لا توجد مواعيد</p>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{ $appointments->withQueryString()->links() }}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection
