<?php

use App\Http\Controllers\Admin\AdminAppointmentController;
use App\Http\Controllers\Admin\DoctorManagementController;
use App\Http\Controllers\Admin\MedicalCenterController;
use App\Http\Controllers\admin\SpecialtyController as AdminSpecialtyController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Doctor\SpecialtyController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\Admin\LoyaltyTierController;
use App\Http\Controllers\Admin\LoyaltyPointController;
use App\Http\Controllers\Admin\LoyaltySettingsController;
use Illuminate\Support\Facades\Route;

// ==================== ADMIN AUTH ROUTES ====================
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/login', [AdminLoginController::class, 'loginForm'])->name('admin.login');
});

// ==================== ADMIN DASHBOARD ROUTES ====================
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin');


    // Admin Resource Routes
    $resources = [
        'banner' => App\Http\Controllers\BannerController::class,
        'brand' => App\Http\Controllers\BrandController::class,
        'art' => App\Http\Controllers\ArtController::class,
        'client' => App\Http\Controllers\ClientController::class,
        'user' => App\Http\Controllers\UserController::class,
        'setting' => App\Http\Controllers\settingController::class,
        'branch' => App\Http\Controllers\branchController::class,
        'testim' => App\Http\Controllers\testimController::class,
        'project' => App\Http\Controllers\ProjectController::class,
        'product' => App\Http\Controllers\ProductController::class,
        'supplier' => App\Http\Controllers\suppliertController::class,
        'about' => App\Http\Controllers\AboutController::class,
        'media' => App\Http\Controllers\MediaController::class,
        'notification' => App\Http\Controllers\NotificationController::class,
        'order' => App\Http\Controllers\orderController::class,
        'task' => App\Http\Controllers\taskController::class,
        'user_task' => App\Http\Controllers\user_taskController::class,
        'ref_level' => App\Http\Controllers\ref_levelController::class,
        'ref_category' => App\Http\Controllers\ref_categoryController::class,
        'emp' => App\Http\Controllers\EmpController::class,
        // 'faq' => App\Http\Controllers\FaqController::class,
        'coupon' => App\Http\Controllers\CouponController::class,



    ];

    foreach ($resources as $name => $controller) {
        Route::resource("/{$name}", $controller);
    }



    Route::prefix('doctors')->name('doctors.')->group(function () {
        Route::get('/', [DoctorManagementController::class, 'index'])->name('index');
        Route::get('/statistics', [DoctorManagementController::class, 'statistics'])->name('statistics');
        Route::get('/{id}', [DoctorManagementController::class, 'show'])->name('showxx');
        Route::get('/{id}/edit', [DoctorManagementController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DoctorManagementController::class, 'update'])->name('update');
        Route::put('/{id}/status', [DoctorManagementController::class, 'updateStatus'])->name('updateStatus');
        Route::put('/{id}/verification-status', [DoctorManagementController::class, 'updateVerificationStatus'])->name('updateVerificationStatus');
        Route::post('/{id}/approve', [DoctorManagementController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [DoctorManagementController::class, 'reject'])->name('reject');
        Route::post('/{id}/suspend', [DoctorManagementController::class, 'suspend'])->name('suspend');
        Route::delete('/{id}', [DoctorManagementController::class, 'destroy'])->name('destroy');
    });

    // Appointments Management Routes
    Route::prefix('appointments')->name('admin.appointments.')->group(function () {
        Route::get('/', [AdminAppointmentController::class, 'index'])->name('index');
        Route::get('/{id}', [AdminAppointmentController::class, 'show'])->name('show');
        Route::put('/{id}/status', [AdminAppointmentController::class, 'updateStatus'])->name('updateStatus');
    });

    // Reviews Management
    Route::prefix('reviews')->name('admin.reviews.')->group(function () {
        Route::get('/', [AdminReviewController::class, 'index'])->name('index');
        Route::put('/{id}/status', [AdminReviewController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/{id}', [AdminReviewController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('specialties')->name('admin.specialties.')->group(function () {
        Route::get('/', [AdminSpecialtyController::class, 'index'])->name('index');
        Route::get('/create', [AdminSpecialtyController::class, 'create'])->name('create');
        Route::post('/', [AdminSpecialtyController::class, 'store'])->name('store');
        Route::get('/{specialty}', [AdminSpecialtyController::class, 'show'])->name('show');
        Route::get('/{specialty}/edit', [AdminSpecialtyController::class, 'edit'])->name('edit');
        Route::put('/{specialty}', [AdminSpecialtyController::class, 'update'])->name('update');
        Route::delete('/{specialty}', [AdminSpecialtyController::class, 'destroy'])->name('destroy');
        Route::post('/{specialty}/toggle-status', [AdminSpecialtyController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('/{specialty}/toggle-featured', [AdminSpecialtyController::class, 'toggleFeatured'])->name('toggle-featured');
        Route::post('/update-order', [AdminSpecialtyController::class, 'updateOrder'])->name('update-order');


        Route::delete('/{specialty}/delete-image', [AdminSpecialtyController::class, 'deleteImage'])->name('delete-image');
        Route::delete('/{specialty}/delete-icon', [AdminSpecialtyController::class, 'deleteIcon'])->name('delete-icon');
    });

    Route::prefix('categories')->name('categories.admin.')->group(function () {
        Route::get('/', [CategoryController::class, 'indexadmin'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}', [CategoryController::class, 'showadmin'])->name('show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');

        // Additional routes
        Route::patch('/{category}/status', [CategoryController::class, 'updateStatus'])->name('update-status');
        Route::patch('/{category}/featured', [CategoryController::class, 'updateFeatured'])->name('update-featured');
        Route::post('/reorder', [CategoryController::class, 'reorder'])->name('reorder');
        Route::post('/bulk-actions', [CategoryController::class, 'bulkActions'])->name('bulk-actions');
    });

    // في routes/admin.php
    Route::prefix('medical-centers')->name('admin.medical-centers.')->group(function () {
        Route::get('/', [MedicalCenterController::class, 'index'])->name('index');
        Route::get('/create', [MedicalCenterController::class, 'create'])->name('create');
        Route::post('/', [MedicalCenterController::class, 'store'])->name('store');
        Route::get('/{id}', [MedicalCenterController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [MedicalCenterController::class, 'edit'])->name('edit');
        Route::put('/{id}', [MedicalCenterController::class, 'update'])->name('update');
        Route::delete('/{id}', [MedicalCenterController::class, 'destroy'])->name('destroy');

        // العمليات الإضافية
        Route::put('/{id}/status', [MedicalCenterController::class, 'updateStatus'])->name('updateStatus');
        Route::post('/{id}/verify', [MedicalCenterController::class, 'verify'])->name('verify');
        Route::post('/{id}/unverify', [MedicalCenterController::class, 'unverify'])->name('unverify');
        Route::post('/{id}/feature', [MedicalCenterController::class, 'feature'])->name('feature');
        Route::post('/{id}/unfeature', [MedicalCenterController::class, 'unfeature'])->name('unfeature');

        // إدارة الأطباء
        Route::get('/{id}/doctors', [MedicalCenterController::class, 'manageDoctors'])->name('manage-doctors');
        Route::post('/{id}/doctors', [MedicalCenterController::class, 'addDoctor'])->name('add-doctor');
        Route::delete('/{id}/doctors', [MedicalCenterController::class, 'removeDoctor'])->name('remove-doctor');
        Route::put('/{id}/doctors/status', [MedicalCenterController::class, 'updateDoctorStatus'])->name('update-doctor-status');

        // الإحصائيات
        Route::get('/statistics', [MedicalCenterController::class, 'statistics'])->name('statistics');
    });

    // Status Routes


    Route::put('/doctors/{id}/toggle-featured', [DoctorManagementController::class, 'toggleFeatured'])
        ->name('doctors.toggle-featured');

    Route::match(['get', 'post'], '/bannerStatus', [App\Http\Controllers\BannerController::class, 'bannerStatus'])->name('banner.status');
    Route::match(['get', 'post'], '/art_status', [App\Http\Controllers\ArtController::class, 'artStatus'])->name('art.status');
    Route::match(['get', 'post'], '/product_status', [App\Http\Controllers\ProductController::class, 'productStatus'])->name('product.status');
    Route::match(['get', 'post'], '/supplier_status', [App\Http\Controllers\suppliertController::class, 'artStatus'])->name('supplier.status');
    Route::match(['get', 'post'], '/about_status', [App\Http\Controllers\AboutController::class, 'abouttStatus'])->name('about.status');
    Route::match(['get', 'post'], '/media_status', [App\Http\Controllers\MediaController::class, 'mediaStatus'])->name('media.status');
    Route::match(['get', 'post'], '/coupon_status', [App\Http\Controllers\CouponController::class, 'couponsStatus'])->name('coupons.status');

    // Additional Admin Routes
    Route::match(['get', 'post'], '/category/{id}/child', [App\Http\Controllers\CategoryController::class, 'getChildByCategoryId']);
    Route::get('/contacts', [App\Http\Controllers\ContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/contacts/{contact}', [App\Http\Controllers\ContactController::class, 'show'])->name('admin.contacts.show');
    // Blog Management Routes
    Route::group(['prefix' => 'blogs', 'as' => 'adminblog.'], function () {
        Route::get('/', [AdminBlogController::class, 'index'])->name('index');
        Route::get('/create', [AdminBlogController::class, 'create'])->name('create');
        Route::post('/', [AdminBlogController::class, 'store'])->name('store');
        Route::get('/{id}', [AdminBlogController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminBlogController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminBlogController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminBlogController::class, 'destroy'])->name('destroy');

        // Additional routes
        Route::post('/bulk-action', [AdminBlogController::class, 'bulkAction'])->name('bulk-action');
        Route::put('/{id}/status', [AdminBlogController::class, 'updateStatus'])->name('update-status');
        Route::post('/{id}/regenerate-slug', [AdminBlogController::class, 'regenerateSlug'])->name('regenerate-slug');
        Route::get('/{id}/clone', [AdminBlogController::class, 'clone'])->name('clone');
        Route::get('/{id}/seo-analysis', [AdminBlogController::class, 'seoAnalysis'])->name('seo-analysis');
        Route::get('/export', [AdminBlogController::class, 'export'])->name('export');
        Route::get('create-with-ai', [AdminBlogController::class, 'createWithAI'])->name('create-with-ai');
        Route::post('generate-with-ai', [AdminBlogController::class, 'generateWithAI'])->name('generate-ai');
        Route::post('store-ai-generated', [AdminBlogController::class, 'storeAIGenerated'])->name('store-ai');
        Route::get('{id}/improve-with-ai', [AdminBlogController::class, 'improveWithAI'])->name('improve-with-ai');
    });


    Route::get('/careers', [CareerController::class, 'adminIndex'])->name('admin.careers.index');
    Route::get('/careers/create', [CareerController::class, 'create'])->name('admin.careers.create');
    Route::post('/careers', [CareerController::class, 'store'])->name('admin.careers.store');
    Route::get('/careers/{id}/edit', [CareerController::class, 'edit'])->name('admin.careers.edit');
    Route::put('/careers/{id}', [CareerController::class, 'update'])->name('admin.careers.update');
    Route::delete('/careers/{id}', [CareerController::class, 'destroy'])->name('admin.careers.destroy');
    Route::post('/careers/{id}/toggle-status', [CareerController::class, 'toggleStatus'])->name('admin.careers.toggle-status');


    Route::resource('faq', FaqController::class);

    // Additional routes
    Route::post('faq/{id}/status', [FaqController::class, 'status'])->name('faq.status');
    Route::post('faq/{id}/sort', [FaqController::class, 'sort'])->name('faq.sort');
    Route::post('faq/bulk-action', [FaqController::class, 'bulkAction'])->name('faq.bulk.action');

    // Category routes (Commented out as controllers are missing)
    // Route::resource('faq-category', 'FaqCategoryController');
    // Route::post('faq-category/{id}/status', 'FaqCategoryController@status')->name('faq-category.status');


    // Tag routes
    // Route::resource('faq-tag', 'FaqTagController');
    // Loyalty Management
    Route::prefix('loyalty')->name('admin.loyalty.')->group(function () {
        Route::resource('tiers', LoyaltyTierController::class)->names('tiers');
        Route::get('points', [LoyaltyPointController::class, 'index'])->name('points.index');
        Route::get('points/{id}/edit', [LoyaltyPointController::class, 'edit'])->name('points.edit');
        Route::put('points/{id}', [LoyaltyPointController::class, 'update'])->name('points.update');

        Route::get('settings', [LoyaltySettingsController::class, 'index'])->name('settings.index');
        Route::post('settings', [LoyaltySettingsController::class, 'update'])->name('settings.update');
    });

    // Rewards Management
    Route::prefix('rewards')->name('admin.rewards.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\RewardController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\RewardController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Admin\RewardController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [\App\Http\Controllers\Admin\RewardController::class, 'edit'])->name('edit');
        Route::put('/{id}', [\App\Http\Controllers\Admin\RewardController::class, 'update'])->name('update');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\RewardController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/toggle-status', [\App\Http\Controllers\Admin\RewardController::class, 'toggleStatus'])->name('toggle-status');
    });
});




Route::prefix('admin')->middleware('admin')->group(function () {});


    

// Blog Categories Routes
// Route::resource('blog-categories', AdminBlogCategoryController::class);

// // Blog Tags Routes
// Route::resource('blog-tags', AdminBlogTagController::class);

// Translation Management
// Route::group(['prefix' => 'translations', 'as' => 'translations.'], function () {
//     Route::get('/', [AdminTranslationController::class, 'index'])->name('index');
//     Route::get('/pending', [AdminTranslationController::class, 'pending'])->name('pending');
//     Route::get('/{id}/edit', [AdminTranslationController::class, 'edit'])->name('edit');
//     Route::put('/{id}', [AdminTranslationController::class, 'update'])->name('update');
//     Route::post('/{id}/approve', [AdminTranslationController::class, 'approve'])->name('approve');
//     Route::post('/{id}/reject', [AdminTranslationController::class, 'reject'])->name('reject');
//     Route::post('/bulk-approve', [AdminTranslationController::class, 'bulkApprove'])->name('bulk-approve');
// });
