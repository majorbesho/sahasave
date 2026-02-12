<?php

use App\Http\Controllers\Doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\Doctor\AppointmentController;
use App\Http\Controllers\Doctor\PatientController;
use App\Http\Controllers\Doctor\RequestController;
use App\Http\Controllers\Doctor\SpecialtyController as DoctorSpecialtyController;
use App\Http\Controllers\Admin\MedicalCenterController;
use App\Http\Controllers\Doctor\DoctorAwardController;
use App\Http\Controllers\Doctor\DoctorClinicController;
use App\Http\Controllers\Doctor\DoctorEducationController;
use App\Http\Controllers\Doctor\DoctorExperienceController;
use App\Http\Controllers\Doctor\DoctorInsuranceController;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Controllers\DoctorMedicalCenterController;
use Illuminate\Support\Facades\Route;

// ==================== DOCTOR ROUTES ====================


Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DoctorDashboardController::class, 'index'])->name('dashboard');

    // Profile & Settings Alises/Legacy Support
    Route::get('/profile', [App\Http\Controllers\Doctor\ProfileController::class, 'edit'])->name('profile'); // Alias for doctor.profile
    Route::get('/profile-settings', function () {
        return "Profile Settings Page (to be built)";
    })->name('profile.settings'); // Alias for doctor.profile.settings

    // Profile Management
    Route::get('/profile/edit', [App\Http\Controllers\Doctor\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [App\Http\Controllers\Doctor\ProfileController::class, 'update'])->name('profile.update');

    // Appointments
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::post('/appointments/{id}/update-status', [AppointmentController::class, 'updateStatus'])->name('appointments.update-status');
    Route::post('/appointments/{id}/reschedule', [AppointmentController::class, 'reschedule'])->name('appointments.reschedule');

    // Schedule Management
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::put('/schedule/{schedule}', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::delete('/schedule/{schedule}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');

    // Double-prefixed Schedule routes for JS scripts
    Route::get('/schedule/calendar-events', [ScheduleController::class, 'calendarEvents'])->name('doctor.schedule.calendar-events');
    Route::get('/schedule/booked-slots', [ScheduleController::class, 'bookedSlots'])->name('doctor.schedule.booked-slots');

    // Patients
    Route::get('/patients-list', [PatientController::class, 'index'])->name('patients'); // For doctor.patients
    Route::get('/patients/{id}', [PatientController::class, 'show'])->name('patients.show'); // For doctor.patients.show

    // Double-prefixed Patient routes for sidebar/views
    Route::get('/patients', [PatientController::class, 'doctor_patients_index'])->name('doctor.patients.index');
    Route::get('/patients/view/{id}', [PatientController::class, 'show'])->name('doctor.patients.show');
    Route::get('/patients/{id}/medical-records', [PatientController::class, 'medicalRecords'])->name('doctor.patients.medical-records');
    Route::get('/patients/{id}/appointments', [PatientController::class, 'appointments'])->name('doctor.patients.appointments');

    // Requests (Double-prefixed for both slide and load-more JS)
    Route::get('/requests', [RequestController::class, 'index'])->name('doctor.requests');
    Route::post('/requests/{id}/accept', [RequestController::class, 'accept'])->name('doctor.requests.accept');
    Route::post('/requests/{id}/reject', [RequestController::class, 'reject'])->name('doctor.requests.reject');
    Route::post('/requests/load-more', [RequestController::class, 'loadMore'])->name('doctor.requests.load-more');
    Route::get('/requests/stats', [RequestController::class, 'stats'])->name('doctor.requests.stats');

    // Profile Sections
    Route::prefix('experience')->group(function () {
        Route::get('/', [DoctorExperienceController::class, 'index'])->name('experience.index');
        Route::post('/', [DoctorExperienceController::class, 'store'])->name('experience.store');
        Route::get('/{id}', [DoctorExperienceController::class, 'show'])->name('experience.show');
        Route::put('/{id}', [DoctorExperienceController::class, 'update'])->name('experience.update');
        Route::delete('/{id}', [DoctorExperienceController::class, 'destroy'])->name('experience.destroy');
        Route::post('/update-order', [DoctorExperienceController::class, 'updateOrder'])->name('experience.update-order');
    });

    Route::prefix('education')->group(function () {
        Route::get('/', [DoctorEducationController::class, 'index'])->name('education.index');
        Route::post('/store', [DoctorEducationController::class, 'store'])->name('education.store');
        Route::get('/{id}', [DoctorEducationController::class, 'show'])->name('education.show');
        Route::delete('/{id}', [DoctorEducationController::class, 'destroy'])->name('education.destroy');
        Route::post('/update-order', [DoctorEducationController::class, 'updateOrder'])->name('education.update-order');
    });

    Route::prefix('awards')->group(function () {
        Route::get('/', [DoctorAwardController::class, 'index'])->name('awards.index');
        Route::post('/store', [DoctorAwardController::class, 'store'])->name('awards.store');
        Route::get('/{id}', [DoctorAwardController::class, 'show'])->name('awards.show');
        Route::delete('/{id}', [DoctorAwardController::class, 'destroy'])->name('awards.destroy');
        Route::post('/update-order', [DoctorAwardController::class, 'updateOrder'])->name('awards.update-order');
    });

    Route::prefix('insurance')->group(function () {
        Route::get('/', [DoctorInsuranceController::class, 'index'])->name('insurance.index');
        Route::post('/store', [DoctorInsuranceController::class, 'store'])->name('insurance.store');
        Route::get('/{id}', [DoctorInsuranceController::class, 'show'])->name('insurance.show');
        Route::delete('/{id}', [DoctorInsuranceController::class, 'destroy'])->name('insurance.destroy');
        Route::post('/update-order', [DoctorInsuranceController::class, 'updateOrder'])->name('insurance.update-order');
        Route::post('/{id}/toggle-status', [DoctorInsuranceController::class, 'toggleStatus'])->name('insurance.toggle-status');
    });

    Route::prefix('clinics')->group(function () {
        Route::get('/', [DoctorClinicController::class, 'index'])->name('clinics.index');
        Route::post('/store', [DoctorClinicController::class, 'store'])->name('clinics.store');
        Route::get('/{id}', [DoctorClinicController::class, 'show'])->name('clinics.show');
        Route::delete('/{id}', [DoctorClinicController::class, 'destroy'])->name('clinics.destroy');
        Route::delete('/gallery/{id}', [DoctorClinicController::class, 'deleteGalleryImage'])->name('clinics.gallery.delete');
        Route::post('/update-order', [DoctorClinicController::class, 'updateOrder'])->name('clinics.update-order');
    });

    // Specialties & Services
    Route::prefix('specialties')->group(function () {
        Route::get('/', [DoctorSpecialtyController::class, 'index'])->name('specialties.index');
        Route::post('/add-specialty', [DoctorSpecialtyController::class, 'addSpecialty'])->name('specialties.add');
        Route::post('/add-service', [DoctorSpecialtyController::class, 'addService'])->name('services.add');
        Route::put('/update-service/{service}', [DoctorSpecialtyController::class, 'updateService'])->name('services.update');
        Route::delete('/remove-specialty/{specialty}', [DoctorSpecialtyController::class, 'removeSpecialty'])->name('specialties.remove');
        Route::delete('/delete-service/{service}', [DoctorSpecialtyController::class, 'deleteService'])->name('services.delete');
        Route::post('/save-all', [DoctorSpecialtyController::class, 'saveAll'])->name('specialties.save-all');
    });

    // Reviews
    Route::get('/reviews', [App\Http\Controllers\Doctor\ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews/{id}/reply', [App\Http\Controllers\Doctor\ReviewController::class, 'reply'])->name('reviews.reply');

    // Accounts & Financial
    Route::get('/accounts', [App\Http\Controllers\Doctor\AccountController::class, 'index'])->name('accounts.index');
    Route::get('/invoices', [App\Http\Controllers\Doctor\InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/{id}', [App\Http\Controllers\Doctor\InvoiceController::class, 'show'])->name('invoices.show');
    Route::get('/payouts', [App\Http\Controllers\Doctor\PayoutController::class, 'index'])->name('payouts.index');
    Route::post('/payouts/settings', [App\Http\Controllers\Doctor\PayoutController::class, 'updateSettings'])->name('payouts.update-settings');

    // Messages/Chat
    Route::get('/chat', [App\Http\Controllers\Doctor\ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{patientId}', [App\Http\Controllers\Doctor\ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{patientId}/send', [App\Http\Controllers\Doctor\ChatController::class, 'sendMessage'])->name('chat.send');

    // Social Media
    Route::get('/social', [App\Http\Controllers\Doctor\SocialMediaController::class, 'index'])->name('social.index');
    Route::post('/social', [App\Http\Controllers\Doctor\SocialMediaController::class, 'store'])->name('social.store');
    Route::put('/social/{id}', [App\Http\Controllers\Doctor\SocialMediaController::class, 'update'])->name('social.update');
    Route::delete('/social/{id}', [App\Http\Controllers\Doctor\SocialMediaController::class, 'destroy'])->name('social.destroy');

    // Password Management
    Route::get('/password', [App\Http\Controllers\Doctor\PasswordController::class, 'edit'])->name('password.edit');
    Route::post('/password', [App\Http\Controllers\Doctor\PasswordController::class, 'update'])->name('password.update');

    // Availability
    Route::post('/update-availability', [PatientController::class, 'update'])->name('update-availability');

    // Medical Centers
    Route::get('/medical-centers', [DoctorMedicalCenterController::class, 'index'])->name('medical-centers.index');
    Route::get('/medical-centers/link/new', [DoctorMedicalCenterController::class, 'create'])->name('medical-centers.create');
    Route::post('/medical-centers/link/store', [DoctorMedicalCenterController::class, 'store'])->name('medical-centers.store');
    Route::get('/medical-centers/{id}', [DoctorMedicalCenterController::class, 'show'])->name('medical-centers.show');
    Route::get('/medical-centers/{id}/edit', [DoctorMedicalCenterController::class, 'edit'])->name('medical-centers.edit');
    Route::put('/medical-centers/{id}', [DoctorMedicalCenterController::class, 'update'])->name('medical-centers.update');
    Route::delete('/medical-centers/{id}', [DoctorMedicalCenterController::class, 'destroy'])->name('medical-centers.destroy');
    Route::post('/medical-centers/{id}/toggle-status', [DoctorMedicalCenterController::class, 'toggleStatus'])->name('medical-centers.toggle-status');
    Route::get('/medical-centers-search', [DoctorMedicalCenterController::class, 'search'])->name('medical-centers.search');
});
