<?php
// security-scan.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class SecurityScan extends Command
{
    protected $signature = 'security:scan-full';
    protected $description = 'Comprehensive security scan';

    public function handle()
    {
        $this->info('🔍 Starting Comprehensive Security Scan...');

        $results = [];

        $results[] = $this->checkDependencies();
        $results[] = $this->checkEnvFile();
        $results[] = $this->checkDebugMode();
        $results[] = $this->checkSqlInjection();
        $results[] = $this->checkXSS();
        $results[] = $this->checkFileUploads();
        $results[] = $this->checkCsrf();
        $results[] = $this->checkDirectoryPermissions();
        $results[] = $this->checkSensitiveFiles();

        $this->displayResults($results);
    }

    private function checkDependencies()
    {
        exec('composer audit --format=plain 2>&1', $output, $returnCode);

        if ($returnCode === 0) {
            return ['check' => 'Dependencies', 'status' => '✅', 'message' => 'No known vulnerabilities'];
        } else {
            return ['check' => 'Dependencies', 'status' => '⚠️', 'message' => 'Found vulnerabilities in packages'];
        }
    }

    private function checkEnvFile()
    {
        $path = base_path('.env');

        if (!File::exists($path)) {
            return ['check' => '.env File', 'status' => '❌', 'message' => '.env file not found'];
        }

        $content = File::get($path);
        $issues = [];

        if (config('app.debug')) {
            $issues[] = 'APP_DEBUG is true';
        }

        if (empty(env('APP_KEY'))) {
            $issues[] = 'APP_KEY is empty';
        }

        return empty($issues)
            ? ['check' => '.env File', 'status' => '✅', 'message' => 'OK']
            : ['check' => '.env File', 'status' => '⚠️', 'message' => implode(', ', $issues)];
    }

    private function checkDebugMode()
    {
        return config('app.debug')
            ? ['check' => 'Debug Mode', 'status' => '❌', 'message' => 'Debug mode is enabled']
            : ['check' => 'Debug Mode', 'status' => '✅', 'message' => 'Debug mode is disabled'];
    }

    private function checkSqlInjection()
    {
        $controllers = File::allFiles(app_path('Http/Controllers'));
        $vulnerable = [];

        foreach ($controllers as $file) {
            $content = File::get($file);

            // Search for potential SQL injection patterns
            $patterns = [
                '/DB::raw\(.*\$.*\)/',
                '/whereRaw\(.*\$.*\)/',
                '/selectRaw\(.*\$.*\)/',
                '/orderByRaw\(.*\$.*\)/',
                '/havingRaw\(.*\$.*\)/',
            ];

            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $content)) {
                    $vulnerable[] = basename($file);
                    break;
                }
            }
        }

        return empty($vulnerable)
            ? ['check' => 'SQL Injection', 'status' => '✅', 'message' => 'No raw SQL with user input found']
            : ['check' => 'SQL Injection', 'status' => '⚠️', 'message' => 'Potential SQLi in: ' . implode(', ', array_unique($vulnerable))];
    }

    private function checkXSS()
    {
        $views = File::allFiles(resource_path('views'));
        $vulnerable = [];

        foreach ($views as $file) {
            $content = File::get($file);

            // Search for unescaped output
            if (preg_match('/\{!![^}]*!!\}/', $content)) {
                $vulnerable[] = basename($file);
            }
        }

        return empty($vulnerable)
            ? ['check' => 'XSS Protection', 'status' => '✅', 'message' => 'All outputs are escaped']
            : ['check' => 'XSS Protection', 'status' => '⚠️', 'message' => 'Unescaped output in: ' . implode(', ', $vulnerable)];
    }

    private function checkFileUploads()
    {
        $controllers = File::allFiles(app_path('Http/Controllers'));
        $vulnerable = [];

        foreach ($controllers as $file) {
            $content = File::get($file);

            // Check for file uploads without validation
            if (
                preg_match('/\$request->file\(|\$request->hasFile\(/', $content) &&
                !preg_match('/validate\(|Validator::make/', $content)
            ) {
                $vulnerable[] = basename($file) . ' (no validation)';
            }

            // Check for direct file moves
            if (
                preg_match('/move\(|storeAs\(/', $content) &&
                !preg_match('/basename\(|pathinfo\(/', $content)
            ) {
                $vulnerable[] = basename($file) . ' (path traversal risk)';
            }
        }

        return empty($vulnerable)
            ? ['check' => 'File Uploads', 'status' => '✅', 'message' => 'File uploads are secure']
            : ['check' => 'File Uploads', 'status' => '⚠️', 'message' => 'Issues: ' . implode(', ', $vulnerable)];
    }

    private function checkCsrf()
    {
        $views = File::allFiles(resource_path('views'));
        $formsWithoutCsrf = [];

        foreach ($views as $file) {
            $content = File::get($file);

            if (
                preg_match('/<form[^>]*>/i', $content) &&
                !preg_match('/@csrf|csrf_field|csrf_token/', $content)
            ) {
                $formsWithoutCsrf[] = basename($file);
            }
        }

        return empty($formsWithoutCsrf)
            ? ['check' => 'CSRF Protection', 'status' => '✅', 'message' => 'All forms have CSRF protection']
            : ['check' => 'CSRF Protection', 'status' => '⚠️', 'message' => 'Forms without CSRF: ' . implode(', ', $formsWithoutCsrf)];
    }

    private function checkDirectoryPermissions()
    {
        $directories = [
            'storage' => 'writable',
            'bootstrap/cache' => 'writable',
            'public/uploads' => 'writable',
        ];

        $issues = [];

        foreach ($directories as $dir => $requirement) {
            $path = base_path($dir);

            if (File::exists($path)) {
                if ($requirement === 'writable' && !is_writable($path)) {
                    $issues[] = "$dir is not writable";
                }
            }
        }

        return empty($issues)
            ? ['check' => 'Directory Permissions', 'status' => '✅', 'message' => 'All directories have correct permissions']
            : ['check' => 'Directory Permissions', 'status' => '⚠️', 'message' => implode(', ', $issues)];
    }

    private function checkSensitiveFiles()
    {
        $sensitiveFiles = [
            '.env',
            '.env.example',
            'composer.json',
            'composer.lock',
            'package.json',
            'yarn.lock',
            'storage/logs/laravel.log',
        ];

        $publiclyAccessible = [];

        foreach ($sensitiveFiles as $file) {
            $path = public_path($file);
            if (File::exists($path)) {
                $publiclyAccessible[] = $file;
            }
        }

        return empty($publiclyAccessible)
            ? ['check' => 'Sensitive Files', 'status' => '✅', 'message' => 'No sensitive files in public directory']
            : ['check' => 'Sensitive Files', 'status' => '❌', 'message' => 'Sensitive files in public: ' . implode(', ', $publiclyAccessible)];
    }

    private function displayResults($results)
    {
        $this->table(
            ['Check', 'Status', 'Message'],
            array_map(function ($result) {
                return [$result['check'], $result['status'], $result['message']];
            }, $results)
        );

        $critical = count(array_filter($results, fn($r) => str_contains($r['status'], '❌')));
        $warnings = count(array_filter($results, fn($r) => str_contains($r['status'], '⚠️')));
        $success = count(array_filter($results, fn($r) => str_contains($r['status'], '✅')));

        $this->info("\n📊 Scan Summary:");
        $this->info("✅ $success checks passed");
        $this->info("⚠️  $warnings warnings");
        $this->info("❌ $critical critical issues");

        if ($critical > 0) {
            $this->error("\n🚨 Immediate action required!");
        } elseif ($warnings > 0) {
            $this->warn("\n⚠️  Some issues need attention");
        } else {
            $this->info("\n🎉 All security checks passed!");
        }
    }
}
