<?php

use App\Http\Controllers\Admin\DoctorManagementController;
use App\Http\Controllers\Admin\MedicalCenterController;
use App\Http\Controllers\admin\SpecialtyController as AdminSpecialtyController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\WishListController;
use App\Http\Controllers\frontend\SearchControll;
use App\Http\Controllers\Auth\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Auth\PatientRegisterController;
use App\Http\Controllers\Auth\DoctorRegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Patient\PatientDashboardController;
use App\Http\Controllers\Doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\Doctor\AppointmentController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Controllers\frontend\DoctorSearchController;
use App\Http\Controllers\SpecialtyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
require __DIR__ . '/suppliers.php';
require __DIR__ . '/shipper.php';

// ==================== SYSTEM UTILITY ROUTES ====================
Route::prefix('system')->group(function () {
    Route::get('/key', function () {
        Artisan::call('key:generate');
        echo "key cleared<br>";
    });

    Route::post('/keyx', function (Illuminate\Http\Request $request) {
        $request->session()->flush();
        echo "Session cleared<br>";
    });

    Route::get('/cleareverything', function () {
        Artisan::call('cache:clear');
        echo "Cache cleared<br>";

        Artisan::call('view:clear');
        echo "View cleared<br>";

        Artisan::call('route:clear');
        echo "Route cleared<br>";

        Artisan::call('config:cache');
        echo "Config cached<br>";

        Artisan::call('config:clear');
        echo "Config cleared<br>";

        Artisan::call('storage:link');
        echo "Storage linked<br>";

        Artisan::call('optimize:clear');
        echo "Optimize cleared<br>";
    });

    Route::get('temp-create-link', function () {
        exec("ln -s " . escapeshellarg(storage_path('app/public')) . ' ' . escapeshellarg(public_path('storage')));
    });
});

// ==================== LANGUAGE ROUTES ====================
Route::get('language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('language');

Route::get('lang/home', [App\Http\Controllers\langController::class, 'index']);
Route::get('lang/change', [App\Http\Controllers\LangController::class, 'change'])->name('changeLang');

// ==================== AUTHENTICATION ROUTES ====================
Auth::routes(['verify' => true]);

// Social Authentication
Route::get('/login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

Route::get('/login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);

Route::get('/login/github', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGithub'])->name('login.github');
Route::get('/login/github/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGithubCallback']);

// Medical Platform Specific Registration
Route::get('register/patient', [PatientRegisterController::class, 'create'])->name('register.patient');
Route::post('register/patient', [PatientRegisterController::class, 'store'])->name('patient.register.save');

Route::get('register/doctor', [DoctorRegisterController::class, 'create'])->name('register.doctor');
Route::post('register/doctor', [DoctorRegisterController::class, 'store'])->name('doctor.register.save');
Route::get('/register/doctor/pending', function () {
    return view('auth.doctor-pending');
})->name('register.doctor.pending');

// ==================== FRONTEND ROUTES ====================

// Public Pages
Route::get('/', [IndexController::class, 'homex'])->name('home');
Route::get('/about', [IndexController::class, 'about'])->name('about');
Route::get('/services', [IndexController::class, 'allservices'])->name('servicesx');
Route::get('/blogs', [IndexController::class, 'blogs'])->name('blogs');
Route::get('/media', [IndexController::class, 'media'])->name('media');
Route::get('/affiliate', [IndexController::class, 'affiliate'])->name('affiliate');
Route::get('/gallery', [IndexController::class, 'Gallery'])->name('Gallery');
Route::get('/contactus', [IndexController::class, 'contactus'])->name('contactus');
Route::get('/howitwork', [IndexController::class, 'howwork'])->name('howitwork');
Route::get('/winners', [IndexController::class, 'winnersx'])->name('winners');
Route::get('/getin', [IndexController::class, 'getin'])->name('get-contact-us');
Route::get('/all-product', [IndexController::class, 'allproduct'])->name('allproduct');
Route::get('/terms-and-conditions', [IndexController::class, 'termsAndConditions'])->name('terms.And.Conditions');
Route::get('/privacy-policy', [IndexController::class, 'privacypolicy'])->name('privacy.policy');
Route::get('/faqs', [IndexController::class, 'faqs'])->name('user.faqs');
Route::get('/price', [IndexController::class, 'priceindex'])->name('index.price');

Route::get('/doctor-search', [DoctorSearchController::class, 'search'])->name('search.doctors');



Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{slug}/doctors', [CategoryController::class, 'doctors'])->name('categories.doctors');
Route::get('/categories/{slug}/medical-centers', [CategoryController::class, 'medicalCenters'])->name('categories.medical-centers');

Route::get('/specialties', [SpecialtyController::class, 'index'])->name('specialties.index');
Route::get('/specialties/search', [SpecialtyController::class, 'search'])->name('specialties.search');
Route::get('/specialties/{slug}', [SpecialtyController::class, 'show'])->name('specialties.show');

Route::get('/specialties/{slug}/filter', [SpecialtyController::class, 'filter'])->name('specialties.filter');


// Product & Category Routes
// Route::get('arts/{slug}/', [IndexController::class, 'artsDispaly'])->name('artsDispaly');
// Route::get('arts/', [IndexController::class, 'artsDispaly'])->name('allrticles');
// Route::get('product/{slug}/', [IndexController::class, 'product'])->name('sProduct');
// Route::get('branch/{slug}/', [IndexController::class, 'sngilbranch'])->name('sngilbranch');
// Route::get('box/{slug}/', [IndexController::class, 'groupOfProduct'])->name('groupOfProduct');
// Route::get('/pages/allbox', [IndexController::class, 'allbox'])->name('allbox');

// Authentication & User Management
Route::get('user/auth', [IndexController::class, 'userAuth'])->name('user.auth');
Route::match(['get', 'post'], 'user/login', [IndexController::class, 'loginsubmit'])->name('loginsubmit');
Route::post('user/register', [IndexController::class, 'registerSubmit'])->name('register.submit');
Route::get('user/logout', [IndexController::class, 'userlogout'])->name('user.logout');
Route::get('/loginsignup', [IndexController::class, 'loginsignup'])->name('login.signup');

// OTP Verification
Route::get('/verification/{id}', [IndexController::class, 'verification'])->name('verification');
Route::match(['get', 'post'], '/verified', [IndexController::class, 'verifiedOtp'])->name('verifiedOtp');
Route::get('/resend-otp', [IndexController::class, 'resendOtp'])->name('resendOtp');

// Search Functionality
Route::get('/search', [IndexController::class, 'SearchView'])->name('search');
Route::get('/search-result', [IndexController::class, 'searchRes'])->name('search.result');
Route::get('/indexsearchx', [SearchControll::class, 'search'])->name('searchx');
Route::match(['get', 'post'], '/searchresult', [SearchControll::class, 'searchResult'])->name('searchresultx');

// Cart & Checkout
Route::get('cart', [CartController::class, 'cart'])->name('cartuser');
Route::get('cartpro', [CartController::class, 'cartpro'])->name('cartpro');
Route::match(['get', 'post'], 'cart/store', [CartController::class, 'cartStore'])->name('cart.store');
Route::match(['get', 'post'], 'cart/delete', [CartController::class, 'cartDelete'])->name('cart.delete');
Route::post('coupon/add', [CartController::class, 'couponadd'])->name('coupon.add');

Route::get('checkout1new', [CheckoutController::class, 'checkoutnew'])->name('checkoutnew');
Route::get('checkout1', [CheckoutController::class, 'checkout1'])->name('checkout');
Route::post('checkout-first', [CheckoutController::class, 'checkout1Store'])->name('checkout1.store');
Route::match(['get', 'post'], 'checkout-store', [CheckoutController::class, 'checkoutstore'])->name('checkout.store');

// Wishlist
Route::get('wishlist', [WishListController::class, 'wishlist'])->name('wishlist');
Route::match(['get', 'post'], 'wishlist/store', [WishListController::class, 'store'])->name('wishlist.store');
Route::match(['get', 'post'], 'wishlist/move-to-cart', [WishListController::class, 'moveToCart'])->name('wishlist.move.cart');

// ==================== AUTHENTICATED USER ROUTES ====================
Route::middleware(['auth'])->group(function () {

    // Patient Dashboard
    Route::get('/patient/dashboard', [PatientDashboardController::class, 'index'])
        ->middleware('verified')
        ->name('patient.dashboard');

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

// Patient Routes


// Doctor Search Routes (إذا لم تكن موجودة)doctor.book
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.search');
Route::get('/doctors/{id}', [DoctorController::class, 'show'])->name('doctors.show');
Route::get('/doctors/book/{id}', [DoctorController::class, 'book'])->name('doctors.book');

// ==================== DOCTOR ROUTES ====================
Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/dashboard', [DoctorDashboardController::class, 'index'])->name('dashboard');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/patients', function () {
        return "My Patients Page (to be built)";
    })->name('patients');

    // Schedule Management
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::delete('/schedule/{schedule}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');

    Route::get('/profile-settings', function () {
        return "Profile Settings Page (to be built)";
    })->name('profile.settings');
});

// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/login', [AdminLoginController::class, 'loginForm'])->name('admin.login');
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin');

    // Admin Resource Routes
    $resources = [
        'banner' => App\Http\Controllers\BannerController::class,
        'brand' => App\Http\Controllers\BrandController::class,
        'art' => App\Http\Controllers\ArtController::class,
        'focus' => App\Http\Controllers\FocusController::class,
        'client' => App\Http\Controllers\ClientController::class,
        'user' => App\Http\Controllers\UserController::class,
        'setting' => App\Http\Controllers\settingController::class,
        'team' => App\Http\Controllers\teamController::class,
        'branch' => App\Http\Controllers\branchController::class,
        'testim' => App\Http\Controllers\testimController::class,
        'project' => App\Http\Controllers\ProjectController::class,
        'product' => App\Http\Controllers\ProductController::class,
        'supplier' => App\Http\Controllers\suppliertController::class,
        'about' => App\Http\Controllers\AboutController::class,
        'media' => App\Http\Controllers\MediaController::class,
        'winner' => App\Http\Controllers\winnerController::class,
        'notification' => App\Http\Controllers\NotificationController::class,
        'order' => App\Http\Controllers\orderController::class,
        'task' => App\Http\Controllers\taskController::class,
        'user_task' => App\Http\Controllers\user_taskController::class,
        'ref_level' => App\Http\Controllers\ref_levelController::class,
        'ref_category' => App\Http\Controllers\ref_categoryController::class,
        'emp' => App\Http\Controllers\EmpController::class,
        'faq' => App\Http\Controllers\FaqController::class,
        'coupon' => App\Http\Controllers\CouponController::class,
        'LoadPackage' => App\Http\Controllers\LoadPackageController::class,
        'related_product' => App\Http\Controllers\related_gproductController::class,
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


        Route::delete('/{specialty}/delete-image', [SpecialtyController::class, 'deleteImage'])->name('delete-image');
        Route::delete('/{specialty}/delete-icon', [SpecialtyController::class, 'deleteIcon'])->name('delete-icon');
    });

    // في routes/admin.php
    Route::prefix('medical-centers')->name('medical-centers.')->group(function () {
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
    Route::match(['get', 'post'], '/bannerStatus', [App\Http\Controllers\BannerController::class, 'bannerStatus'])->name('banner.status');
    Route::match(['get', 'post'], '/art_status', [App\Http\Controllers\ArtController::class, 'artStatus'])->name('art.status');
    Route::match(['get', 'post'], '/product_status', [App\Http\Controllers\ProductController::class, 'productStatus'])->name('product.status');
    Route::match(['get', 'post'], '/supplier_status', [App\Http\Controllers\suppliertController::class, 'artStatus'])->name('supplier.status');
    Route::match(['get', 'post'], '/about_status', [App\Http\Controllers\AboutController::class, 'abouttStatus'])->name('about.status');
    Route::match(['get', 'post'], '/media_status', [App\Http\Controllers\MediaController::class, 'mediaStatus'])->name('media.status');
    Route::match(['get', 'post'], '/winner_status', [App\Http\Controllers\winnerController::class, 'winnerStatus'])->name('winner.status');
    Route::match(['get', 'post'], '/LoadPackage_status', [App\Http\Controllers\LoadPackageController::class, 'LoadPackageStatus'])->name('LoadPackage.status');
    Route::match(['get', 'post'], '/coupon_status', [App\Http\Controllers\CouponController::class, 'couponsStatus'])->name('coupons.status');

    // Additional Admin Routes
    Route::match(['get', 'post'], '/category/{id}/child', [App\Http\Controllers\CategoryController::class, 'getChildByCategoryId']);
    Route::get('/contacts', [App\Http\Controllers\ContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/contacts/{contact}', [App\Http\Controllers\ContactController::class, 'show'])->name('admin.contacts.show');
});

// ==================== PAYMENT ROUTES ====================
Route::controller(App\Http\Controllers\StripePaymentController::class)->group(function () {
    Route::get('stripe', 'stripe')->name('stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

Route::controller(App\Http\Controllers\tabbyController::class)->group(function () {
    Route::get('tabby', 'tabby')->name('tabby');
    Route::post('tabby', 'tabbyPost')->name('tabby.post');
});

Route::controller(App\Http\Controllers\tamaraController::class)->group(function () {
    Route::get('tamara', 'tamara')->name('tamara');
    Route::post('tamara', 'tamaraPost')->name('tamara.post');
});

// ==================== CONTACT FORM ====================
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.submit');

// ==================== MISC ROUTES ====================
Route::get('/product-library', [IndexController::class, 'productlib'])->name('product.library');
Route::get('/sitemap.xml', [IndexController::class, 'sitemap'])->name('site.map');
Route::get('/social-media-share', [App\Http\Controllers\SocialShareButtonsController::class, 'ShareWidget']);

// ==================== PATIENT ROUTES ====================
Route::middleware(['auth', 'verified'])->prefix('patient')->name('patient.')->group(function () {

    Route::get('/dashboard', [PatientDashboardController::class, 'index'])->name('dashboard');

    // المواعيد
    Route::get('/appointments', [PatientDashboardController::class, 'appointments'])->name('appointments');
    Route::get('/appointments/{id}', [PatientDashboardController::class, 'showAppointment'])->name('appointments.show');
    // المفضلة
    Route::get('/favorites', [PatientDashboardController::class, 'favorites'])->name('favorites');
    Route::post('/favorites/toggle', [PatientDashboardController::class, 'toggleFavorite'])->name('favorites.toggle');

    // الملف الشخصي
    Route::get('/profile', [PatientDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [PatientDashboardController::class, 'updateProfile'])->name('profile.update');

    // الإعدادات
    Route::get('/settings', [PatientDashboardController::class, 'settings'])->name('settings');

    Route::get('/profile/settings', [PatientDashboardController::class, 'settings'])->name('profile.settings');


    Route::get('/medical-records', [PatientDashboardController::class, 'medicalRecords'])->name('medical-records');
    Route::get('/prescriptions', [PatientDashboardController::class, 'prescriptions'])->name('prescriptions');
    Route::get('/lab-orders', [PatientDashboardController::class, 'labOrders'])->name('lab-orders');
    Route::get('/referrals', [PatientDashboardController::class, 'referrals'])->name('referrals');
    Route::get('/favorites', [PatientDashboardController::class, 'favorites'])->name('favorites');





    // Prescriptions

    // Lab Orders

    // Referrals

    // Messages
    Route::get('/messages', [PatientDashboardController::class, 'messages'])->name('messages');
    Route::get('/chat/{doctorId}', [PatientDashboardController::class, 'chat'])->name('chat');

    // Profile Settings
});


Route::get('/doctors', [DoctorController::class, 'index'])->name('doctorshome.search');
Route::get('/doctors/search', [DoctorController::class, 'search'])->name('doctorshome.search');
Route::get('/doctors/{id}', [DoctorController::class, 'show'])->name('doctorshome.show');
Route::get('/doctors/book/{id}', [DoctorController::class, 'book'])->name('doctorshome.book');
