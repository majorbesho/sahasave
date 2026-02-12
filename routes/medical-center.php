<?php



use App\Http\Controllers\MedicalCenterDashboardController;

Route::middleware(['auth', 'medical.center.admin'])->prefix('medical-center')->name('medical-center.')->group(function () {

    Route::get('/dashboard', [MedicalCenterDashboardController::class, 'dashboard'])->name('dashboard');

    Route::prefix('doctors')->name('doctors.')->group(function () {
        Route::get('/', [MedicalCenterDashboardController::class, 'doctors'])->name('index');
        Route::get('/create', [MedicalCenterDashboardController::class, 'createDoctor'])->name('create');
        Route::post('/', [MedicalCenterDashboardController::class, 'storeDoctor'])->name('store');
        Route::get('/{id}', [MedicalCenterDashboardController::class, 'showDoctor'])->name('show');
        Route::get('/{id}/edit', [MedicalCenterDashboardController::class, 'editDoctor'])->name('edit');
        Route::get('/{id}/schedule', [MedicalCenterDashboardController::class, 'doctorSchedule'])->name('schedule');
        Route::put('/{id}/status', [MedicalCenterDashboardController::class, 'updateDoctorStatus'])->name('update-status');
    });

    // إدارة المواعيد
    Route::prefix('appointments')->name('appointments.')->group(function () {
        Route::get('/', [MedicalCenterDashboardController::class, 'appointments'])->name('index');
        Route::get('/calendar', [MedicalCenterDashboardController::class, 'appointmentsCalendar'])->name('calendar');
        Route::get('/{id}', [MedicalCenterDashboardController::class, 'showAppointment'])->name('show');
        Route::put('/{id}/status', [MedicalCenterDashboardController::class, 'updateAppointmentStatus'])->name('update-status');
        Route::delete('/{id}', [MedicalCenterDashboardController::class, 'cancelAppointment'])->name('cancel');
    });

    // التقارير المالية
    Route::prefix('financial')->name('financial.')->group(function () {
        Route::get('/reports', [MedicalCenterDashboardController::class, 'financialReports'])->name('reports');
        Route::get('/transactions', [MedicalCenterDashboardController::class, 'transactions'])->name('transactions');
        Route::get('/invoices', [MedicalCenterDashboardController::class, 'invoices'])->name('invoices');
    });

    // إدارة الخدمات
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', [MedicalCenterDashboardController::class, 'services'])->name('index');
        Route::post('/', [MedicalCenterDashboardController::class, 'storeService'])->name('store');
        Route::put('/{id}', [MedicalCenterDashboardController::class, 'updateService'])->name('update');
        Route::delete('/{id}', [MedicalCenterDashboardController::class, 'deleteService'])->name('delete');
    });

    // التحليلات والإحصائيات
    Route::get('/analytics', [MedicalCenterDashboardController::class, 'analytics'])->name('analytics');

    // الإعدادات
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [MedicalCenterDashboardController::class, 'settings'])->name('index');
        Route::put('/', [MedicalCenterDashboardController::class, 'updateSettings'])->name('update');
    });

    // الملف الشخصي
    Route::get('/profile', [MedicalCenterDashboardController::class, 'profile'])->name('profile');
});
