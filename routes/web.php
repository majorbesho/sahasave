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
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Patient\PatientDashboardController;
use App\Http\Controllers\Doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\Doctor\AppointmentController;
use App\Http\Controllers\Doctor\DoctorController as DoctorDoctorController;
use App\Http\Controllers\Doctor\PatientController;
use App\Http\Controllers\Doctor\RequestController;
use App\Http\Controllers\Doctor\SpecialtyController as DoctorSpecialtyController;
use App\Http\Controllers\frontend\DoctorBookingController;
use App\Http\Controllers\frontend\DoctorSearchController;
use App\Http\Controllers\Patient\FavoriteController;
use App\Http\Controllers\SpecialtyController;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\frontend\HowItWorksController;
use App\Http\Controllers\InteractiveMapController;
use App\Http\Controllers\MedicalCentersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Clinic Registration
Route::get('/clinic-registration', [App\Http\Controllers\ClinicRegistrationController::class, 'create'])->name('clinic.register')->middleware('auth');
Route::post('/clinic-registration', [App\Http\Controllers\ClinicRegistrationController::class, 'store'])->name('clinic.register.store')->middleware('auth');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/doctor.php';
require __DIR__ . '/patient.php';
require __DIR__ . '/medical-center.php';



require __DIR__ . '/clinic.php';

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



Route::get('/routes', function () {
    $routes = \Route::getRoutes();
    foreach ($routes as $route) {
        echo $route->getName() . ' - ' . $route->uri() . '<br>';
    }
});


// ==================== LANGUAGE ROUTES ====================
Route::get('language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('language');



// ==================== AUTHENTICATION ROUTES ====================
Auth::routes(['verify' => true]);

// Social Authentication




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
Route::get('/all-product', [IndexController::class, 'allproduct'])->name('allproduct');
Route::get('/terms-and-conditions', [IndexController::class, 'termsAndConditions'])->name('terms.And.Conditions');
Route::get('/privacy-policy', [IndexController::class, 'privacypolicy'])->name('privacy.policy');
Route::get('/faqs', [IndexController::class, 'faqs'])->name('user.faqs');
Route::get('/price', [IndexController::class, 'priceindex'])->name('index.price');

// Blog Routes
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [App\Http\Controllers\frontend\BlogController::class, 'index'])->name('index');
    Route::get('/category/{slug}', [App\Http\Controllers\frontend\BlogController::class, 'category'])->name('category');
    Route::get('/tag/{slug}', [App\Http\Controllers\frontend\BlogController::class, 'tag'])->name('tag');
    Route::get('/{slug}', [App\Http\Controllers\frontend\BlogController::class, 'show'])->name('show');
});

Route::get('/doctor-search', [DoctorSearchController::class, 'search'])->name('search.doctors');

Route::post('/doctor/{doctor}/favorite', [IndexController::class, 'toggleFavorite'])->name('doctor.toggle.favorite');




Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{slug}/doctors', [CategoryController::class, 'doctors'])->name('categories.doctors');
Route::get('/categories/{slug}/medical-centers', [CategoryController::class, 'medicalCenters'])->name('categories.medical-centers');

Route::get('/specialties', [SpecialtyController::class, 'index'])->name('specialties.index');
Route::get('/specialties/search', [SpecialtyController::class, 'search'])->name('specialties.search');
Route::get('/specialties/{slug}', [SpecialtyController::class, 'show'])->name('specialties.show');

Route::get('/specialties/{slug}/filter', [SpecialtyController::class, 'filter'])->name('specialties.filter');



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

// Patient Routes




// ==================== DOCTOR SEARCH & PROFILE ROUTES ====================
Route::get('/doctors', [DoctorDoctorController::class, 'index'])->name('doctors.search');
Route::get('/doctors/{slug}', [DoctorDoctorController::class, 'show'])->name('doctors.show');
Route::get('/doctors/book/create', [DoctorDoctorController::class, 'bookingcreate'])->name('booking.create');
Route::get('/doctors/book/{slug}', [DoctorDoctorController::class, 'book'])->name('doctors.book');
Route::get('/doctors/{slug}/available-times', [DoctorDoctorController::class, 'getAvailableTimes'])->name('doctors.available-times');


// ==================== PAYMENT ROUTES ====================


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
Route::get('/sitemap.xml', [IndexController::class, 'sitemap'])->name('site.map');
Route::get('/social-media-share', [App\Http\Controllers\SocialShareButtonsController::class, 'ShareWidget']);

// ==================== PATIENT ROUTES ====================

Route::post('/reviews', [App\Http\Controllers\ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('reviews.store');





// ==================== NEWSLETTER ROUTES ====================
Route::post('/newsletter/subscribe', [IndexController::class, 'subscribe'])
    ->name('newsletter.subscribe');

Route::get('/newsletter/unsubscribe/{email}', [IndexController::class, 'unsubscribe'])
    ->name('newsletter.unsubscribe');

Route::get('/newsletter/manage-subscription', [IndexController::class, 'manageSubscription'])
    ->name('newsletter.manage');


// Route::get('/doctors/book/{id}', [DoctorDoctorController::class, 'book'])->name('doctorshomex.booking.create');
// Route::get('/doctors/book/{id}', function ($id) {
//     dd('Route is working, ID: ' . $id);
// })->name('doctorshome.booking.create');



Route::prefix('medical-centers')->name('medical-centershome.')->group(function () {
    Route::get('/', [MedicalCentersController::class, 'index'])->name('index');
    Route::get('/search', [MedicalCentersController::class, 'search'])->name('search');
    Route::get('/featured', [MedicalCentersController::class, 'featured'])->name('featured');
    Route::get('/statistics', [MedicalCentersController::class, 'statistics'])->name('statistics');
    Route::get('/city/{city}', [MedicalCentersController::class, 'byCity'])->name('by-city');
    Route::get('/specialty/{specialty}', [MedicalCentersController::class, 'bySpecialty'])->name('by-specialty');
    Route::get('/{slug}', [MedicalCentersController::class, 'show'])->name('show');

    // General Booking Flow
    Route::get('/{slug}/book-general', [App\Http\Controllers\frontend\MedicalCenterBookingController::class, 'show'])
        ->name('book-general')
        ->middleware('auth');
    Route::post('/book-general/store', [App\Http\Controllers\frontend\MedicalCenterBookingController::class, 'store'])
        ->name('book-general.store')
        ->middleware('auth');
});


Route::get('/how-it-works', [HowItWorksController::class, 'index'])->name('how-it-works');




// خريطة تفاعلية
Route::get('/map', [InteractiveMapController::class, 'index'])
    ->name('map.index');

// API للخريطة
Route::get('/api/map-data', [InteractiveMapController::class, 'getMapData'])
    ->name('api.map.data');






Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
Route::get('/careers/{id}', [CareerController::class, 'show'])->name('careers.show');

Route::post('/careers/apply', [CareerController::class, 'storeApplication'])->name('careers.apply');

// ==================== SEO DOCTOR SPECIALTY ROUTES ====================
// SEO-friendly routes for doctor searches by city and specialty
Route::get('/doctors/{city}/{specialty}', [DoctorSearchController::class, 'searchBySpecialty'])->name('doctors.specialty');

// Additional SEO routes for hospitals and clinics
Route::get('/hospitals/{city}', [MedicalCentersController::class, 'byCity'])->name('hospitals.city');
Route::get('/clinics', [MedicalCentersController::class, 'index'])->name('clinics.index');
Route::get('/centers', [MedicalCentersController::class, 'index'])->name('centers.index');

// ==================== LEGAL PAGES ====================
Route::get('/privacy-policy', function () {
    $locale = app()->getLocale();
    $view = $locale === 'en' ? 'frontend.privacy-policy-en' : 'frontend.privacypolicy';
    return view($view);
})->name('privacy-policy');

Route::get('/terms', function () {
    $locale = app()->getLocale();
    $view = $locale === 'en' ? 'frontend.terms-and-conditions-en' : 'frontend.TermsAndConditions';
    return view($view);
})->name('terms');

Route::get('/cancellation-policy', function () {
    $locale = app()->getLocale();
    $view = $locale === 'en' ? 'frontend.cancellation-policy-en' : 'frontend.cancellation-policy';
    return view($view);
})->name('cancellation-policy');

Route::get('/refund-policy', function () {
    return view('frontend.refund-policy');
})->name('refund-policy');

// ==================== SITEMAPS ====================
use App\Http\Controllers\SitemapController;

// Main Sitemap Index
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');

// Pages Sitemap
Route::get('/sitemap-pages.xml', [SitemapController::class, 'pages'])->name('sitemap.pages');

// Blog Sitemap
Route::get('/sitemap-blog.xml', [SitemapController::class, 'blog'])->name('sitemap.blog');

// Careers Sitemap
Route::get('/sitemap-careers.xml', [SitemapController::class, 'careers'])->name('sitemap.careers');

// Providers Sitemap (Doctors & Hospitals)
Route::get('/sitemap-providers.xml', [SitemapController::class, 'providers'])->name('sitemap.providers');

// Admin sitemap management routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/sitemap/stats', [SitemapController::class, 'stats'])->name('admin.sitemap.stats');
    Route::post('/admin/sitemap/ping', [SitemapController::class, 'ping'])->name('admin.sitemap.ping');
});

// Legacy sitemap redirect
Route::get('/sitemap', function () {
    return redirect('/sitemap.xml', 301);
});

// Authentication Routes (Public)
Route::middleware('guest')->group(function () {
    // Medical Platform Specific Registration
    Route::get('register/patient', [PatientRegisterController::class, 'create'])->name('register.patient');
    Route::post('register/patient', [PatientRegisterController::class, 'store'])->name('patient.register.save');

    Route::get('register/doctor', [DoctorRegisterController::class, 'create'])->name('register.doctor');
    Route::post('register/doctor', [DoctorRegisterController::class, 'store'])->name('doctor.register.save');

    Route::get('/register/doctor/pending', function () {
        return view('auth.doctor-pending');
    })->name('register.doctor.pending');
});

// Google Authentication Routes (Public)
Route::middleware(['guest', 'throttle:google-auth'])->group(function () {
    Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])
        ->name('auth.google');

    Route::get('/auth/google/doctor', [GoogleAuthController::class, 'redirectToDoctor'])
        ->name('auth.google.doctor');

    Route::get('/auth/google/patient', [GoogleAuthController::class, 'redirectToPatient'])
        ->name('auth.google.patient');
});

// Google Callback Route (Public)
Route::middleware(['guest', 'throttle:google-callback'])->group(function () {
    Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])
        ->name('auth.google.callback');
});

// Protected Google Account Routes (Require Authentication)
Route::middleware(['auth', 'throttle:google-account'])->group(function () {
    Route::post('/auth/google/connect', [GoogleAuthController::class, 'connectGoogleAccount'])
        ->name('auth.google.connect');

    Route::post('/auth/google/disconnect', [GoogleAuthController::class, 'disconnectGoogleAccount'])
        ->name('auth.google.disconnect');
});

// Test Route
Route::get('/test-rate-limit', function () {
    $ip = request()->ip();

    $loginKey = 'login:' . $ip;
    $loginAttempts = RateLimiter::attempts($loginKey) ?? 0;

    $googleKey = 'google-auth:' . $ip;
    $googleAttempts = RateLimiter::attempts($googleKey) ?? 0;

    return response()->json([
        'ip' => $ip,
        'login_attempts' => $loginAttempts,
        'google_auth_attempts' => $googleAttempts,
        'time' => now()->toDateTimeString(),
    ]);
});



Route::get('/test-rate-limit', function () {
    $ip = request()->ip();

    // Test login rate limiting
    $loginKey = 'login:' . $ip;
    $loginAttempts = RateLimiter::attempts($loginKey);

    // Test google auth rate limiting
    $googleKey = 'google-auth:' . $ip;
    $googleAttempts = RateLimiter::attempts($googleKey);

    return response()->json([
        'ip' => $ip,
        'login_attempts' => $loginAttempts,
        'google_auth_attempts' => $googleAttempts,
        'time' => now()->toDateTimeString(),
    ]);
});



// ==================== FRONTEND FAQ ROUTES ====================
Route::prefix('faqs')->name('frontend.faq.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Frontend\FaqController::class, 'index'])->name('index');
    Route::get('/{slug}', [\App\Http\Controllers\Frontend\FaqController::class, 'show'])->name('show');
    Route::post('/{id}/helpful', [\App\Http\Controllers\Frontend\FaqController::class, 'markHelpful'])->name('helpful');
    Route::get('/category/{slug}', [\App\Http\Controllers\Frontend\FaqController::class, 'byCategory'])->name('category');
    Route::get('/tag/{slug}', [\App\Http\Controllers\Frontend\FaqController::class, 'byTag'])->name('tag');
});

// ==================== RESTAURANT AI AGENT ROUTES ====================
Route::prefix('restaurant-ai')->name('restaurant-ai.')->group(function () {
    Route::get('/', [\App\Http\Controllers\RestaurantAiController::class, 'index'])->name('home');
    Route::get('/pricing', [\App\Http\Controllers\RestaurantAiController::class, 'pricing'])->name('pricing');
    Route::get('/features', [\App\Http\Controllers\RestaurantAiController::class, 'features'])->name('features');
    Route::post('/demo-request', [\App\Http\Controllers\RestaurantAiController::class, 'demoRequest'])->name('demo.request');
});
