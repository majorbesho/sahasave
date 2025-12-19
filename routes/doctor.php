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
use Illuminate\Support\Facades\Route;

// ==================== DOCTOR ROUTES ====================


Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DoctorDashboardController::class, 'index'])->name('dashboard');

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
    Route::get('/doctor/schedule/calendar-events', [ScheduleController::class, 'calendarEvents'])->name('doctor.schedule.calendar-events');


    Route::get('/doctor/schedule/booked-slots', [ScheduleController::class, 'bookedSlots'])->name('doctor.schedule.booked-slots');




    // Patients
    Route::get('/patients-list', [PatientController::class, 'index'])->name('patients');
    Route::get('/patients', [PatientController::class, 'doctor_patients_index'])->name('patients.index');
    Route::get('/patients/{id}', [PatientController::class, 'show'])->name('doctor.patients.show');
    Route::get('/patients/{id}/medical-records', [PatientController::class, 'medicalRecords'])->name('doctor.patients.medical-records');
    Route::get('/patients/{id}/appointments', [PatientController::class, 'appointments'])->name('doctor.patients.appointments');

    // Requests
    Route::get('/requests', [RequestController::class, 'index'])->name('doctor.requests');
    Route::post('/requests/{id}/accept', [RequestController::class, 'accept'])->name('doctor.requests.accept');
    Route::post('/requests/load-more', [RequestController::class, 'loadMore'])->name('doctor.requests.load-more');
    Route::get('/requests/stats', [RequestController::class, 'stats'])->name('doctor.requests.stats');
    Route::post('/requests/{id}/reject', [RequestController::class, 'reject'])->name('doctor.requests.reject');



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

    // Placeholders for other profile sections to prevent RouteNotFoundException





    // Specialties & Services
    Route::prefix('specialties')->group(function () {
        Route::get('/', [DoctorSpecialtyController::class, 'index'])->name('doctor.specialties');
        Route::post('/add-specialty', [DoctorSpecialtyController::class, 'addSpecialty'])->name('doctor.specialties.add');
        Route::post('/add-service', [DoctorSpecialtyController::class, 'addService'])->name('doctor.services.add');
        Route::put('/update-service/{service}', [DoctorSpecialtyController::class, 'updateService'])->name('doctor.services.update');
        Route::delete('/remove-specialty/{specialty}', [DoctorSpecialtyController::class, 'removeSpecialty'])->name('doctor.specialties.remove');
        Route::delete('/delete-service/{service}', [DoctorSpecialtyController::class, 'deleteService'])->name('doctor.services.delete');
        Route::post('/save-all', [DoctorSpecialtyController::class, 'saveAll'])->name('doctor.specialties.save-all');
    });

    // Medical Centers
    Route::get('/medical-centers', [MedicalCenterController::class, 'index'])->name('doctor.medical-centers.index');
    Route::post('/medical-centers', [MedicalCenterController::class, 'store'])->name('doctor.medical-centers.store');
    Route::put('/medical-centers/{id}', [MedicalCenterController::class, 'update'])->name('doctor.medical-centers.update');
    Route::delete('/medical-centers/{id}', [MedicalCenterController::class, 'destroy'])->name('doctor.medical-centers.destroy');
    Route::post('/medical-centers/{id}/toggle-status', [MedicalCenterController::class, 'toggleStatus'])->name('doctor.medical-centers.toggle-status');

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

    // Profile Management
    Route::get('/profile', [App\Http\Controllers\Doctor\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [App\Http\Controllers\Doctor\ProfileController::class, 'update'])->name('profile.update');




    // Route::get('/social', [App\Http\Controllers\Doctor\SocialMediaController::class, 'index'])->name('social.index');
    // Route::post('/social', [App\Http\Controllers\Doctor\SocialMediaController::class, 'update'])->name('social.update');
    Route::get('/password', [App\Http\Controllers\Doctor\PasswordController::class, 'edit'])->name('password.edit');
    Route::post('/password', [App\Http\Controllers\Doctor\PasswordController::class, 'update'])->name('password.update');

    // Availability
    Route::post('/update-availability', [PatientController::class, 'update'])->name('doctor.update-availability');

    // Profile Settings
    Route::get('/profile-settings', function () {
        return "Profile Settings Page (to be built)";
    })->name('profile.settings');
});


// ==================== DOCTOR ROUTES ====================
Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/dashboard', [DoctorDashboardController::class, 'index'])->name('dashboard');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    //Route::get('/patients', [App\Http\Controllers\Doctor\PatientController::class, 'index'])->name('patients.index');;
    // Schedule Management


    // Patients

    Route::get('/profile-settings', function () {
        return "Profile Settings Page (to be built)";
    })->name('profile.settings');


    Route::get('/patients-list', [App\Http\Controllers\Doctor\PatientController::class, 'index'])->name('patients');


    // Appointments
    Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::post('/appointments/{id}/update-status', [AppointmentController::class, 'updateStatus'])->name('appointments.update-status');
    Route::post('/appointments/{id}/reschedule', [AppointmentController::class, 'reschedule'])->name('appointments.reschedule');



    Route::get('/patients', [App\Http\Controllers\Doctor\PatientController::class, 'show'])->name('doctor.patients');

    // Route::get('/patients', [App\Http\Controllers\Doctor\PatientController::class, ' doctor_patients_index'])->name(' patients.index');

    Route::get('/patients/{id}', [App\Http\Controllers\Doctor\PatientController::class, 'show'])->name('patients.show');
    Route::get('/patients/{id}/medical-records', [App\Http\Controllers\Doctor\PatientController::class, 'medicalRecords'])->name('patients.medical-records');

    // Specialties & Services
    Route::get('/specialties', [App\Http\Controllers\Doctor\SpecialtyController::class, 'index'])->name('specialties.index');
    Route::post('/specialties', [App\Http\Controllers\Doctor\SpecialtyController::class, 'update'])->name('specialties.update');

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

    // Profile Management
    Route::get('/profile', [App\Http\Controllers\Doctor\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [App\Http\Controllers\Doctor\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/social', [App\Http\Controllers\Doctor\SocialMediaControlle::class, 'index'])->name('social.index');
    Route::post('/social', [App\Http\Controllers\Doctor\SocialMediaControlle::class, 'update'])->name('social.update');
    Route::get('/password', [App\Http\Controllers\Doctor\PasswordController::class, 'edit'])->name('password.edit');
    Route::post('/password', [App\Http\Controllers\Doctor\PasswordController::class, 'update'])->name('password.update');

    Route::get('/patients', [App\Http\Controllers\Doctor\PatientController::class, 'doctor_patients_index'])->name('patients.index');

    Route::get('/patients', [PatientController::class, 'doctor_patients_index'])->name('doctor.patients.index');
    Route::get('/patients/{id}', [PatientController::class, 'show'])->name('doctor.patients.show');
    Route::get('/patients/{id}/medical-records', [PatientController::class, 'medicalRecords'])->name('doctor.patients.medical-records');
    Route::get('/patients/{id}/appointments', [PatientController::class, 'appointments'])->name('doctor.patients.appointments');

    Route::post('/update-availability', [App\Http\Controllers\Doctor\PatientController::class, 'update'])->name('doctor.update-availability');


    Route::prefix('specialties')->group(function () {
        Route::get('/', [DoctorSpecialtyController::class, 'index'])->name('doctor.specialties');
        Route::post('/add-specialty', [DoctorSpecialtyController::class, 'addSpecialty'])->name('doctor.specialties.add');
        Route::post('/add-service', [DoctorSpecialtyController::class, 'addService'])->name('doctor.services.add');
        Route::put('/update-service/{service}', [DoctorSpecialtyController::class, 'updateService'])->name('doctor.services.update');
        Route::delete('/remove-specialty/{specialty}', [DoctorSpecialtyController::class, 'removeSpecialty'])->name('doctor.specialties.remove');
        Route::delete('/delete-service/{service}', [DoctorSpecialtyController::class, 'deleteService'])->name('doctor.services.delete');
        Route::post('/save-all', [DoctorSpecialtyController::class, 'saveAll'])->name('doctor.specialties.save-all');
    });


    Route::get('/medical-centers', [MedicalCenterController::class, 'index'])->name('doctor.medical-centers.index');
    Route::post('/medical-centers', [MedicalCenterController::class, 'store'])->name('doctor.medical-centers.store');
    Route::put('/medical-centers/{id}', [MedicalCenterController::class, 'update'])->name('doctor.medical-centers.update');
    Route::delete('/medical-centers/{id}', [MedicalCenterController::class, 'destroy'])->name('doctor.medical-centers.destroy');
    Route::post('/medical-centers/{id}/toggle-status', [MedicalCenterController::class, 'toggleStatus'])->name('doctor.medical-centers.toggle-status');
});
