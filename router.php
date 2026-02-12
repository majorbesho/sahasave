<?php
/**
 * High Performance Router for Laravel
 */

// Performance optimizations
if (!defined('LARAVEL_START')) {
    define('LARAVEL_START', microtime(true));
}

// Static file cache - serve directly without Laravel
$staticExtensions = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'ico', 'svg', 'woff', 'woff2', 'ttf', 'eot'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$extension = pathinfo($path, PATHINFO_EXTENSION);

// Serve static files directly
if (in_array($extension, $staticExtensions)) {
    $filePath = __DIR__ . '/public' . $path;
    
    if (file_exists($filePath)) {
        // Set caching headers for static files
        $cacheTime = 31536000; // 1 year
        header('Content-Type: ' . mime_content_type($filePath));
        header('Cache-Control: public, max-age=' . $cacheTime);
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $cacheTime) . ' GMT');
        
        readfile($filePath);
        exit;
    }
}

// Laravel bootstrap - loaded once
static $bootstrapped = false;
static $app, $kernel;

if (!$bootstrapped) {
    require __DIR__ . '/vendor/autoload.php';
    $app = require_once __DIR__ . '/bootstrap/app.php';
    
    // Production optimizations
    $app->instance('request', Illuminate\Http\Request::capture());
    $app->make(Illuminate\Contracts\Http\Kernel::class)->bootstrap();
    
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $bootstrapped = true;
}

// Handle request
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// Send response
$response->send();

// Terminate
$kernel->terminate($request, $response);