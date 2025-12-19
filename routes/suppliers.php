<?php

use App\Http\Controllers\Supplier\LoadPackageController;
use App\Http\Controllers\Supplier\TruckController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;


Route::group(['prefix' => 'supplier'], function () {
    Route::get('/supplier-login', [App\Http\Controllers\Auth\Admin\sellerController::class, 'showLoginFormSup'])->name('supplier.login.form');
    Route::post('/supplierdashboard', [App\Http\Controllers\Auth\Admin\sellerController::class, 'loginFormpost'])->name('supplier.post');
    Route::get('/supplier-register1', [App\Http\Controllers\Auth\Admin\sellerController::class, 'ShowSupplierRegister1'])->name('supplier.register1.form');
    Route::match(['get', 'post'], '/supplier-register1-post', [App\Http\Controllers\Auth\Admin\sellerController::class, 'supplierRegister1Post'])->name('supplier.register1.post');
});










Route::group(['prefix' => 'supplier', 'middleware' => 'supplier'], function () {
    Route::get('/', [App\Http\Controllers\Auth\Admin\sellerController::class, 'supplier_home'])->name('supplier.home');
    // Route::match(['get', 'post'], '/supplier-dashboard', [App\Http\Controllers\Auth\Admin\sellerController::class, 'supplier'])->name('supplier.dashboard');

    //Route::match(['get', 'post'], '/supplier-dashboard', [App\Http\Controllers\Auth\Admin\sellerController::class, 'suppDashboard'])->name('supplier');
    Route::get('/supplier-transaction', [App\Http\Controllers\Auth\Admin\sellerController::class, 'transaction'])->name('supplier.transaction');
    Route::get('/supplier-personalInformation', [App\Http\Controllers\Auth\Admin\sellerController::class, 'personalInformation'])->name('supplier.personalInformation');
    // Route::get('/contact',[App\Http\Controllers\Auth\Admin\sellerController::class,'contact'])->name('contact');
    Route::get('/supplier-cart', [App\Http\Controllers\Auth\Admin\sellerController::class, 'cartDetails'])->name('supplier.cart');
    Route::get('/supplier-userlottery', [App\Http\Controllers\Auth\Admin\sellerController::class, 'userlottery'])->name('supplier.userlottery');
    Route::get('/supplier-userreferral', [App\Http\Controllers\Auth\Admin\sellerController::class, 'userreferral'])->name('supplier.userreferral');
    //new-userreferral
    Route::get('/supplier-new-userreferral', [App\Http\Controllers\Auth\Admin\sellerController::class, 'new_userreferral'])->name('supplier.new.userreferral');
    Route::get('/supplier-refs/{user_id}/{ref_cat_id}', [App\Http\Controllers\Auth\Admin\sellerController::class, 'refs'])->name('supplier.refs.user');
    Route::get('/supplier-contact', [App\Http\Controllers\Auth\Admin\sellerController::class, 'contact'])->name('supplier.contact');
    Route::get('/supplier-graph', [App\Http\Controllers\Auth\Admin\sellerController::class, 'graph'])->name('supplier.graph');
    Route::match(['get', 'post'], '/supplier-editinfo/{id}/', [App\Http\Controllers\Auth\Admin\sellerController::class, 'editinfo'])->name('supplier.editinfo');
    Route::post('/supplier-editaccount/{id}/', [App\Http\Controllers\Auth\Admin\sellerController::class, 'editaccount'])->name('supplier.editaccount');
    Route::get('/supplier-otp', [App\Http\Controllers\Auth\Admin\sellerController::class, 'otp'])->name('supplier.otp');
    // Route::get('arts/{slug}/',[App\Http\Controllers\Auth\Admin\sellerController::class,'artsDispaly'])->name('artsDispaly');
    Route::get('/supplier-branch/{slug}/', [App\Http\Controllers\Auth\Admin\sellerController::class, 'sngilbranch'])->name('supplier.sngilbranch');
    Route::get('/supplier-box/{slug}/', [App\Http\Controllers\Auth\Admin\sellerController::class, 'groupOfProduct'])->name('supplier.groupOfProduct');
    // Route::get('/cart',[App\Http\Controllers\Auth\Admin\sellerController::class,'cartDetails'])->name('cart');

});
