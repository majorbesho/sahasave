<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\shipper\LoadController;
use App\Http\Controllers\shipper\ShipperController;


Route::prefix('shipper')->group(function () {
    Route::get('/login', [\App\Http\Controllers\shipper\ShipperController::class, 'showLoginForm'])->name('shipper.login');
    Route::post('/login', [\App\Http\Controllers\shipper\ShipperController::class, 'login']);
    Route::post('/logout', [\App\Http\Controllers\shipper\ShipperController::class, 'logout'])->name('shipper.logout');
    Route::get('/register', [\App\Http\Controllers\shipper\ShipperController::class, 'showRegisterForm'])->name('shipper.register');
    Route::post('/register', [\App\Http\Controllers\shipper\ShipperController::class, 'registerpostshipper'])->name('registerpostshipper');
});

Route::group(['prefix' => 'shipper', 'middleware' => 'shipper'], function () {
    Route::get('/', [ShipperController::class, 'dash'])->name('shipper');

    Route::get('/shipper_profile', [ShipperController::class, 'profile'])->name('shipper.profile');

    Route::resource('/loads', LoadController::class);
    Route::get('/load/details/{id}', [LoadController::class, 'details'])->name('load.details');
    // Route::get('/load/details/{id}', [LoadController::class, 'details'])->name('load.details');
    Route::get('/trucks-show', [LoadController::class, 'trucksshow'])->name('trucks.show');


    Route::get('/shipment-schedule', [ShipperController::class, 'shipment_schedule'])->name('shipment.schedule');

    Route::get('/saved-load', [ShipperController::class, 'saved_load'])->name('saved.load');



    Route::get('/shipment-history', [ShipperController::class, 'shipment_history'])->name('shipment.history');



    Route::get('/shipper-payment-account', [ShipperController::class, 'shipper_payment_account'])->name('shipper.payment.account');


    Route::get('/chat-1', [ChatController::class, 'index'])->name('shipper.chat');



    Route::get('/shipper-setting', [ShipperController::class, 'shipper_setting'])->name('shipper.setting');

    // change-password
    // two-factor-authentication.html

    Route::get('/change-password', [ShipperController::class, 'shipper_change_password'])->name('shipper.change.password');
});




// Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {});
// Route::get('/shipper/dashboard', function () {
//     return view('shipper.dashboard');
// })->middleware('shipper');
