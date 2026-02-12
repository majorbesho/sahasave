<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::post('/register', [API\UserController::class, 'register'])->middleware('throttle:5,1');
Route::post('/login', [API\UserController::class, 'login'])->middleware('throttle:5,1');
Route::post('/verify-otp', [API\UserController::class, 'verifyOtp'])->middleware('throttle:5,1');

// Patient routes
Route::prefix('patient')->group(function () {
    Route::post('/register', [API\UserController::class, 'register'])->middleware('throttle:5,1');
    Route::get('/dashboard', [API\PatientController::class, 'dashboard'])->middleware(['auth:sanctum', 'throttle:60,1']);
    Route::get('/appointments', [API\PatientController::class, 'appointments'])->middleware(['auth:sanctum', 'throttle:60,1']);
    Route::post('/appointments/book', [API\PatientController::class, 'bookAppointment'])->middleware(['auth:sanctum', 'throttle:60,1']);
});

// Doctor routes
Route::prefix('doctor')->group(function () {
    Route::get('/dashboard', [API\DoctorController::class, 'dashboard'])->middleware('auth:sanctum');
    Route::get('/appointments', [API\DoctorController::class, 'appointments'])->middleware('auth:sanctum');
    Route::put('/appointments/{id}/status', [API\DoctorController::class, 'updateAppointmentStatus'])->middleware('auth:sanctum');
});


Route::middleware(['auth:sanctum', 'medical.center.admin'])->prefix('medical-center')->group(function () {
    Route::get('/dashboard/stats', [\App\Http\Controllers\Api\MedicalCenterApiController::class, 'dashboardStats']);
    Route::get('/appointments/calendar', [\App\Http\Controllers\Api\MedicalCenterApiController::class, 'appointmentsCalendar']);
});


// Medical services
Route::prefix('medical')->group(function () {
    Route::get('/specialties', [API\MedicalController::class, 'specialties']);
    Route::get('/centers', [API\MedicalController::class, 'centers']);
    Route::get('/doctors', [API\MedicalController::class, 'doctors']);
    Route::get('/doctor/{id}', [API\MedicalController::class, 'doctorDetails']);
});

// Loyalty & Rewards
Route::prefix('loyalty')->middleware('auth:sanctum')->group(function () {
    Route::get('/points', [API\LoyaltyController::class, 'points']);
    Route::get('/tier', [API\LoyaltyController::class, 'tier']);
    Route::get('/rewards', [API\LoyaltyController::class, 'rewards']);
    Route::post('/redeem', [API\LoyaltyController::class, 'redeem']);
});

// Admin routes
Route::prefix('admin')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/stats', [API\AdminController::class, 'stats']);
    Route::get('/users', [API\AdminController::class, 'users']);
    Route::get('/doctors', [API\AdminController::class, 'doctors']);
    Route::get('/appointments', [API\AdminController::class, 'appointments']);
});
