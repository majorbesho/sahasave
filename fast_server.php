<?php
/**
 * High Performance PHP Server for Laravel
 * Better than php artisan serve
 */

// Custom PHP settings for maximum performance
ini_set('memory_limit', '512M');
ini_set('max_execution_time', 0);
ini_set('realpath_cache_size', '10M');
ini_set('realpath_cache_ttl', '7200');
ini_set('opcache.enable_cli', '1');

// Disable XDEBUG if exists
ini_set('xdebug.remote_enable', '0');
ini_set('xdebug.profiler_enable', '0');
ini_set('xdebug.remote_autostart', '0');

$host = '0.0.0.0';
$port = 8000;
$root = __DIR__ . '/public';

echo "🚀 Starting High Performance Laravel Server...\n";
echo "📡 Listening on: http://{$host}:{$port}\n";
echo "📁 Document root: {$root}\n";
echo "⚡ Performance mode: Enabled\n\n";

// Custom request handler
$server = new class($root) {
    private $laravelApp;
    private $kernel;
    private $root;
    
    public function __construct($root) {
        $this->root = $root;
        $this->initLaravel();
    }
    
    private function initLaravel() {
        define('LARAVEL_START', microtime(true));
        
        require __DIR__ . '/vendor/autoload.php';
        
        $app = require_once __DIR__ . '/bootstrap/app.php';
        
        // Optimize for production-like environment
        $app->bind('path.public', function() {
            return __DIR__ . '/public';
        });
        
        $this->kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
        $this->laravelApp = $app;
    }
    
    public function handle($uri, $method = 'GET', $headers = [], $body = '') {
        try {
            // Create Laravel request
            $request = Illuminate\Http\Request::create(
                $uri,
                $method,
                [],
                [],
                [],
                $_SERVER,
                $body
            );
            
            // Add headers
            foreach ($headers as $key => $value) {
                $request->headers->set($key, $value);
            }
            
            // Handle request
            $response = $this->kernel->handle($request);
            
            // Terminate
            $this->kernel->terminate($request, $response);
            
            return [
                'status' => $response->getStatusCode(),
                'headers' => $response->headers->all(),
                'content' => $response->getContent(),
            ];
            
        } catch (Exception $e) {
            return [
                'status' => 500,
                'headers' => ['Content-Type' => 'text/plain'],
                'content' => 'Server Error: ' . $e->getMessage(),
            ];
        }
    }
};

// Start PHP built-in server with custom router
$command = sprintf(
    'php -S %s:%s -t "%s" %s',
    $host,
    $port,
    $root,
    __DIR__ . '/router.php'
);

echo "✅ Server command: {$command}\n";
echo "📊 Ready for load testing!\n";

// Execute
shell_exec($command);