<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Redis Stress Test ===\n";
echo "Testing 1000 cache operations...\n";

$start = microtime(true);
$success = 0;
$errors = 0;

for ($i = 0; $i < 1000; $i++) {
    try {
        $key = "test_key_$i";
        $value = "value_" . uniqid();
        
        // Set
        Illuminate\Support\Facades\Cache::put($key, $value, 60);
        
        // Get
        $retrieved = Illuminate\Support\Facades\Cache::get($key);
        
        if ($retrieved === $value) {
            $success++;
        } else {
            $errors++;
        }
        
        // Delete every 10th item
        if ($i % 10 === 0) {
            Illuminate\Support\Facades\Cache::forget($key);
        }
        
    } catch (Exception $e) {
        $errors++;
    }
}

$time = microtime(true) - $start;
$opsPerSecond = 1000 / $time;

echo "\nResults:\n";
echo "Total Operations: 1000\n";
echo "Success: $success\n";
echo "Errors: $errors\n";
echo "Total Time: " . round($time, 4) . " seconds\n";
echo "Operations/sec: " . round($opsPerSecond, 2) . "\n";
echo "Avg Operation: " . round(($time / 1000) * 1000, 2) . " ms\n";

// Memory usage
$memory = memory_get_peak_usage(true) / 1024 / 1024;
echo "Peak Memory: " . round($memory, 2) . " MB\n";