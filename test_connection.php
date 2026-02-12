<?php
require __DIR__ . '/vendor/autoload.php';

// 1. تحميل Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Testing Redis Connection ===\n";

// 2. اختبار Redis مباشرة
try {
    $redis = app('redis.connection');
    $result = $redis->ping();
    echo "✅ Redis Ping: " . $result . "\n";
} catch (Exception $e) {
    echo "❌ Redis Error: " . $e->getMessage() . "\n";
}

// 3. اختبار Cache
try {
    Illuminate\Support\Facades\Cache::put('test_key', 'Hello Redis', 10);
    $value = Illuminate\Support\Facades\Cache::get('test_key');
    echo "✅ Cache Test: " . ($value === 'Hello Redis' ? 'PASSED' : 'FAILED') . "\n";
} catch (Exception $e) {
    echo "❌ Cache Error: " . $e->getMessage() . "\n";
}

// 4. عرض إعدادات Redis
echo "\n=== Redis Config ===\n";
$config = config('database.redis.default');
foreach ($config as $key => $value) {
    echo "$key: $value\n";
}