<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - لوحة تحكم المركز الطبي</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    
    <!-- FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/medical-center.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body class="medical-center-dashboard">
    <!-- شريط التنقل العلوي -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('medical-center.dashboard') }}">
                <i class="fas fa-hospital"></i>
                لوحة تحكم المركز الطبي
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- قائمة التنقل الرئيسية -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('medical-center.dashboard') ? 'active' : '' }}" 
                           href="{{ route('medical-center.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> الرئيسية
                        </a>
                    </li>
                    
                    @if(in_array('manage_doctors', $admin->permissions()))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-md"></i> الأطباء
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('medical-center.doctors.index') }}">قائمة الأطباء</a></li>
                            <li><a class="dropdown-item" href="{{ route('medical-center.doctors.create') }}">إضافة طبيب جديد</a></li>
                        </ul>
                    </li>
                    @endif
                    
                    @if(in_array('manage_appointments', $admin->permissions()))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-calendar-check"></i> المواعيد
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('medical-center.appointments.index') }}">جميع المواعيد</a></li>
                            <li><a class="dropdown-item" href="{{ route('medical-center.appointments.calendar') }}">التقويم</a></li>
                        </ul>
                    </li>
                    @endif
                    
                    @if(in_array('manage_finance', $admin->permissions()))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('medical-center.financial.reports') }}">
                            <i class="fas fa-chart-line"></i> التقارير المالية
                        </a>
                    </li>
                    @endif
                    
                    @if(in_array('view_reports', $admin->permissions()))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('medical-center.analytics') }}">
                            <i class="fas fa-chart-pie"></i> التحليلات
                        </a>
                    </li>
                    @endif
                </ul>
                
                <!-- عناصر التحكم في المستخدم -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('medical-center.profile') }}">
                                <i class="fas fa-user"></i> الملف الشخصي
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('medical-center.settings.index') }}">
                                <i class="fas fa-cog"></i> الإعدادات
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- المحتوى الرئيسي -->
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- الشريط الجانبي (يمكن إخفاؤه في الجوال) -->
            <div class="col-lg-2 d-none d-lg-block">
                <div class="card sidebar-card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="fas fa-hospital-alt"></i> {{ $center->name }}</h6>
                    </div>
                    <div class="card-body">
                        <!-- الإحصائيات السريعة -->
                        <div class="quick-stats">
                            <div class="stat-item">
                                <small>الأطباء النشطين</small>
                                <h5 class="text-primary">{{ $stats['active_doctors'] ?? 0 }}</h5>
                            </div>
                            <div class="stat-item">
                                <small>مواعيد اليوم</small>
                                <h5 class="text-success">{{ $stats['today_appointments'] ?? 0 }}</h5>
                            </div>
                        </div>
                        
                        <!-- روابط سريعة -->
                        <hr>
                        <div class="quick-links">
                            <a href="{{ route('medical-center.appointments.index', ['status' => 'pending']) }}" 
                               class="d-block mb-2">
                                <i class="fas fa-clock text-warning"></i>
                                مواعيد قيد الانتظار
                                <span class="badge bg-warning float-end">{{ $stats['pending_appointments'] ?? 0 }}</span>
                            </a>
                            <a href="{{ route('medical-center.financial.reports') }}" class="d-block mb-2">
                                <i class="fas fa-money-bill-wave text-success"></i>
                                الإيرادات الشهرية
                                <span class="badge bg-success float-end">{{ number_format($stats['monthly_revenue'] ?? 0) }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- المحتوى الرئيسي -->
            <div class="col-lg-10">
                <!-- شريط التنقل الفرعي -->
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('medical-center.dashboard') }}">الرئيسية</a></li>
                        @yield('breadcrumb')
                    </ol>
                </nav>
                
                <!-- رسائل التنبيه -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                <!-- محتوى الصفحة -->
                <div class="main-content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="{{ asset('js/medical-center.js') }}"></script>
    
    @stack('scripts')
</body>
</html>