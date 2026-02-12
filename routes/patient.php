<?php

use App\Http\Controllers\Doctor\AppointmentController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\frontend\DoctorBookingController;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\Patient\PatientDashboardController;
use App\Http\Controllers\Patient\FavoriteController;
use App\Http\Controllers\Patient\LoyaltyController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {



    // User Dashboard & Profile
    Route::prefix('user')->group(function () {
        Route::get('/cart', [IndexController::class, 'cartDetails'])->name('cart');
        Route::get('/userlottery', [IndexController::class, 'userlottery'])->name('userlottery');
        Route::get('/userreferral', [IndexController::class, 'userreferral'])->name('userreferral');
        Route::get('/new-userreferral', [IndexController::class, 'new_userreferral'])->name('new.userreferral');
        Route::get('/refs/{user_id}/{ref_cat_id}', [IndexController::class, 'refs'])->name('refs.user');
        Route::get('/contact', [IndexController::class, 'contact'])->name('contact');
        Route::get('/graph', [IndexController::class, 'graph'])->name('graph');
        Route::match(['get', 'post'], '/editinfo/{id}/', [IndexController::class, 'editinfo'])->name('editinfo');
        Route::post('/editaccount/{id}/', [IndexController::class, 'editaccount'])->name('editaccount');
        Route::get('/otp', [IndexController::class, 'otp'])->name('otp');
    });

    // Documents
    Route::resource('documents', App\Http\Controllers\UserDocumentController::class);
    Route::get('/documents/{document}/download', [App\Http\Controllers\UserDocumentController::class, 'download'])->name('documents.download');

    // Attachments
    Route::prefix('attachments')->group(function () {
        Route::post('/', [App\Http\Controllers\AttachmentsController::class, 'store']);
        Route::get('/', [App\Http\Controllers\AttachmentsController::class, 'index']);
        Route::get('/{id}', [App\Http\Controllers\AttachmentsController::class, 'show']);
    });
});



Route::group(['middleware' => ['auth', 'verified']], function () {



    // Route::get('/doctors/search', [DoctorController::class, 'search'])->name('doctorshome.search');
    // Route::get('/doctors/{id}', [DoctorController::class, 'show'])->name('doctorshome.show');

    //Route::get('/doctors/book/{id}', [DoctorController::class, 'book'])->name('doctorshome.booking.create');






    Route::get('/doctors/{slug}/available-times', [DoctorController::class, 'getAvailableTimes'])->name('doctors.available_times');



    // صفحة تأكيد الحجز


    Route::get('/appointments/checkout/{scheduleId}', [AppointmentController::class, 'checkout'])->name('appointments.checkout');
    Route::post('/appointments/store', [AppointmentController::class, 'store'])->name('appointments.store');

    //     ->name('api.doctors.available-times');

    Route::get('/appointments/{appointment}/confirmation', [AppointmentController::class, 'confirmation'])
        ->name('appointments.confirmation');

    Route::get('/appointments', [PatientDashboardController::class, 'index'])->name('patient.appointments');
    Route::get('/appointments/{appointment}', [PatientDashboardController::class, 'show'])->name('patient.appointment.details');
    Route::post('/appointments/{appointment}/cancel', [PatientDashboardController::class, 'cancel'])->name('patient.appointments.cancel');
    Route::post('/appointments/{appointment}/review', [PatientDashboardController::class, 'addReview'])->name('patient.appointments.review');
});


Route::middleware(['auth', 'verified'])->prefix('patient')->name('patient.')->group(function () {

    Route::get('/dashboard', [PatientDashboardController::class, 'dashboard'])->name('dashboard');

    // المواعيد
    Route::get('/appointments', [PatientDashboardController::class, 'appointments'])->name('appointmentsslide');
    Route::get('/appointments/{appointment}', [PatientDashboardController::class, 'showAppointment'])->name('appointments.show');
    // المفضلة
    Route::get('/favorites', [PatientDashboardController::class, 'favorites'])->name('favorites');
    Route::post('/favorites/toggle', [PatientDashboardController::class, 'toggleFavorite'])->name('favorites.toggle-global');

    // الملف الشخصي
    Route::get('/profile', [PatientDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [PatientDashboardController::class, 'updateProfile'])->name('profile.update');

    // الإعدادات
    Route::get('/settings', [PatientDashboardController::class, 'settings'])->name('settings');
    Route::get('/profile/settings', [PatientDashboardController::class, 'profileSettings'])->name('profile.settings');
    Route::post('/profile/settings', [PatientDashboardController::class, 'updateProfileSettings'])->name('profile.settings.update');
    Route::post('/profile/change-password', [PatientDashboardController::class, 'changePassword'])->name('change.password');
    Route::post('/profile/notifications', [PatientDashboardController::class, 'updateNotificationSettings'])->name('notifications.update');
    Route::post('/profile/delete-account', [PatientDashboardController::class, 'deleteAccount'])->name('delete.account');
    Route::post('/profile/two-factor-authentication', [PatientDashboardController::class, 'twoFactorAuthentication'])->name('two.factor.authentication');



    // Route::get('/profile/settings', [PatientDashboardController::class, 'settings'])->name('profile.settings');


    Route::get('/medical-records', [PatientDashboardController::class, 'medicalRecords'])->name('medical-records');
    Route::get('/prescriptions', [PatientDashboardController::class, 'prescriptions'])->name('prescriptions');
    Route::get('/lab-orders', [PatientDashboardController::class, 'labOrders'])->name('lab-orders');
    Route::get('/referrals', [PatientDashboardController::class, 'referrals'])->name('referrals');
    Route::get('/favorites', [PatientDashboardController::class, 'favorites'])->name('favorites');
    //favorites






    Route::prefix('favorites')->name('favorites.')->group(function () {
        Route::get('/', [FavoriteController::class, 'index'])->name('index');
        Route::post('/toggle/{doctor}', [FavoriteController::class, 'toggle'])->name('toggle');
        Route::delete('/{favorite}', [FavoriteController::class, 'destroy'])->name('destroy');
        Route::post('/{favorite}/note', [FavoriteController::class, 'updateNote'])->name('update-note');
        Route::post('/{favorite}/notifications', [FavoriteController::class, 'toggleNotifications'])->name('toggle-notifications');
        Route::post('/{favorite}/view', [FavoriteController::class, 'recordView'])->name('record-view');
        Route::get('/recommendations', [FavoriteController::class, 'recommendations'])->name('recommendations');
        Route::get('/popular', [FavoriteController::class, 'popular'])->name('popular');
        Route::get('/check/{doctor}', [FavoriteController::class, 'check'])->name('check');
    });


    // Messages
    Route::get('/messages', [PatientDashboardController::class, 'messages'])->name('messages');
    Route::get('/chat/{doctorId}', [PatientDashboardController::class, 'chat'])->name('chat');


    // Loyalty Points
    Route::get('/loyalty', [LoyaltyController::class, 'index'])->name('loyalty.index');
    Route::get('/loyalty/history', [LoyaltyController::class, 'history'])->name('loyalty.history');

    // Profile Settings
});
