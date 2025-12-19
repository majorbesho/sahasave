<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\shipper\LoadController;
use App\Http\Controllers\shipper\ShipperController;


Route::prefix('shipper')->group(function () {});









// Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {});
// Route::get('/shipper/dashboard', function () {
//     return view('shipper.dashboard');
// })->middleware('shipper');
