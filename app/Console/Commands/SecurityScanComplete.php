<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SecurityScanComplete extends Command
{
    protected $signature = 'security:scan-complete';
    protected $description = 'Complete security scan for Windows';

    public function handle()
    {
        $this->info('🔍 Laravel Security Scan Complete (Windows)');
        $this->info('============================================');

        $this->checkComposer();
        $this->checkEnv();
        $this->checkSqlInjection();
        $this->checkXSS();
        $this->checkFileUploads();
        $this->checkCsrf();
        $this->checkDBRaw();

        $this->info("\n✅ Scan completed!");
    }

    private function checkComposer()
    {
        $this->info("\n1. Checking Composer Packages...");
        exec('composer audit --format=plain 2>&1', $output, $returnCode);

        foreach ($output as $line) {
            if (str_contains($line, 'Found 0')) {
                $this->info("   ✅ " . $line);
            } elseif (str_contains($line, 'Found')) {
                $this->warn("   ⚠️  " . $line);
            } else {
                $this->line("   " . $line);
            }
        }
    }

    private function checkEnv()
    {
        $this->info("\n2. Checking .env file...");

        if (!File::exists(base_path('.env'))) {
            $this->error("   ❌ .env file not found!");
            return;
        }

        $content = File::get(base_path('.env'));
        $lines = explode("\n", $content);

        foreach ($lines as $line) {
            $line = trim($line);
            if (str_starts_with($line, 'APP_DEBUG=')) {
                if ($line === 'APP_DEBUG=true') {
                    $this->warn("   ⚠️  APP_DEBUG is true (should be false in production)");
                } else {
                    $this->info("   ✅ " . $line);
                }
            }

            if (str_starts_with($line, 'APP_ENV=')) {
                $this->info("   📝 " . $line);
            }

            if (str_starts_with($line, 'APP_KEY=')) {
                if (empty($line) || $line === 'APP_KEY=') {
                    $this->error("   ❌ APP_KEY is empty!");
                } else {
                    $this->info("   ✅ APP_KEY is set");
                }
            }
        }
    }

    private function checkSqlInjection()
    {
        $this->info("\n3. Checking for SQL Injection patterns...");

        $patterns = ['DB::raw', 'whereRaw', 'selectRaw', 'orderByRaw'];
        $found = false;

        foreach ($patterns as $pattern) {
            $files = File::allFiles(app_path('Http/Controllers'));

            foreach ($files as $file) {
                $content = File::get($file);
                if (str_contains($content, $pattern)) {
                    if (!$found) {
                        $found = true;
                        $this->warn("   ⚠️  Found raw SQL patterns:");
                    }
                    $this->line("     - " . basename($file) . " contains: " . $pattern);
                }
            }
        }

        if (!$found) {
            $this->info("   ✅ No raw SQL patterns found");
        }
    }

    private function checkDBRaw()
    {
        $this->info("\n4. Checking DB::raw usage...");

        $filesWithRaw = [];
        $files = File::allFiles(app_path('Http/Controllers'));

        foreach ($files as $file) {
            $content = File::get($file);
            if (str_contains($content, 'DB::raw')) {
                $filesWithRaw[] = basename($file);
            }
        }

        if (empty($filesWithRaw)) {
            $this->info("   ✅ No DB::raw usage found");
        } else {
            $this->info("   📝 DB::raw found in: " . implode(', ', array_unique($filesWithRaw)));
            $this->line("     Note: DB::raw for COUNT(*) is generally safe if no user input is used");
        }
    }

    private function checkXSS()
    {
        $this->info("\n5. Checking for XSS vulnerabilities...");

        $files = File::allFiles(resource_path('views'));
        $found = false;

        foreach ($files as $file) {
            $content = File::get($file);
            if (str_contains($content, '{!!')) {
                if (!$found) {
                    $found = true;
                    $this->warn("   ⚠️  Found unescaped output:");
                }
                $this->line("     - " . basename($file));
            }
        }

        if (!$found) {
            $this->info("   ✅ All outputs are escaped");
        }
    }

    private function checkFileUploads()
    {
        $this->info("\n6. Checking file upload security...");

        $patterns = ['storeAs', 'move', 'store'];
        $found = false;

        $files = File::allFiles(app_path('Http/Controllers'));

        foreach ($files as $file) {
            $content = File::get($file);
            foreach ($patterns as $pattern) {
                if (str_contains($content, $pattern)) {
                    if (!$found) {
                        $found = true;
                        $this->info("   📝 File upload operations found:");
                    }
                    $this->line("     - " . basename($file));
                    break;
                }
            }
        }

        if (!$found) {
            $this->info("   📝 No file upload operations found");
        }
    }

    private function checkCsrf()
    {
        $this->info("\n7. Checking CSRF protection...");

        $files = File::allFiles(resource_path('views'));
        $forms = 0;
        $protected = 0;

        foreach ($files as $file) {
            $content = File::get($file);
            if (str_contains($content, '<form')) {
                $forms++;
                if (
                    str_contains($content, '@csrf') ||
                    str_contains($content, 'csrf_field') ||
                    str_contains($content, 'csrf_token')
                ) {
                    $protected++;
                }
            }
        }

        if ($forms > 0) {
            if ($forms === $protected) {
                $this->info("   ✅ All forms ($forms) have CSRF protection");
            } else {
                $this->warn("   ⚠️  $protected out of $forms forms have CSRF protection");
            }
        } else {
            $this->info("   📝 No forms found in views");
        }
    }
}
