<?php

use App\Http\Controllers\API\BannerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/', function () {
    return 23;
});
Route::get('/apibanners', [App\Http\Controllers\API\BannerController::class, 'index']);
Route::get('banners', [App\Http\Controllers\API\BannerController::class, 'index']);


//api


// Route::prefix('shipper')->group(function () {
//     Route::post('/login', [\App\Http\Controllers\api\ShipperAuthController::class, 'login']);
//     Route::post('/register', [\App\Http\Controllers\api\ShipperAuthController::class, 'registerapi'])->withoutMiddleware('auth:api');;
// });

// Route::prefix('carrier')->group(function () {
//     Route::post('/login', [\App\Http\Controllers\api\CarrierController::class, 'cclogin']);
//     Route::post('/register', [\App\Http\Controllers\api\CarrierController::class, 'ccregisterapi'])->withoutMiddleware('auth:api');;
// });
// Route::prefix('broker')->group(function () {
//     Route::post('/login', [\App\Http\Controllers\api\brokerController::class, 'login']);
//     Route::post('/register', [\App\Http\Controllers\api\brokerController::class, 'registerapi'])->withoutMiddleware('auth:api');;
// });
