<?php

use App\Http\Controllers\ClinicDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('clinic/{clinic}')->name('clinic.')->group(function () {

    Route::get('/dashboard', [ClinicDashboardController::class, 'index'])->name('dashboard');

    // Appointments
    Route::prefix('appointments')->name('appointments.')->group(function () {
        Route::get('/', [ClinicDashboardController::class, 'appointments'])->name('index');
    });

    // Patients
    Route::prefix('patients')->name('patients.')->group(function () {
        Route::get('/', [ClinicDashboardController::class, 'patients'])->name('index');
    });

    // Doctors (Manager only)
    Route::prefix('doctors')->name('doctors.')->group(function () {
        Route::get('/', [ClinicDashboardController::class, 'doctors'])->name('index');
    });

    // Staff (Manager only)
    Route::prefix('staff')->name('staff.')->group(function () {
        Route::get('/', [ClinicDashboardController::class, 'staff'])->name('index');
    });

    // Services (Manager only)
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', [ClinicDashboardController::class, 'services'])->name('index');
    });

    // Reports (Manager only)
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/overview', [ClinicDashboardController::class, 'reportsOverview'])->name('overview');
    });

    // Notifications
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [ClinicDashboardController::class, 'notifications'])->name('index');
    });

    // Receptionist Workflow
    Route::prefix('reception')->name('reception.')->group(function () {
        Route::get('/', [\App\Http\Controllers\ReceptionistController::class, 'index'])->name('index');
        Route::get('/search-patient', [\App\Http\Controllers\ReceptionistController::class, 'searchPatient'])->name('search-patient');
        Route::post('/store-patient', [\App\Http\Controllers\ReceptionistController::class, 'storePatient'])->name('store-patient');
        Route::get('/slots', [\App\Http\Controllers\ReceptionistController::class, 'getAvailableSlots'])->name('slots');
        Route::post('/book', [\App\Http\Controllers\ReceptionistController::class, 'storeAppointment'])->name('book');
        Route::post('/cancel/{appointment}', [\App\Http\Controllers\ReceptionistController::class, 'cancelAppointment'])->name('cancel');
    });

    // Settings (Manager only)
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/general', [ClinicDashboardController::class, 'settingsGeneral'])->name('general');
    });
});
