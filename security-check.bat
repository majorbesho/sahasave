@echo off
echo 🔍 Security Check for Laravel Application
echo ==========================================

echo.
echo 1. Checking Composer Packages...
composer audit --format=plain

echo.
echo 2. Checking .env file...
type .env | findstr "DEBUG APP_ENV APP_KEY"

echo.
echo 3. Checking for SQL Injection patterns...
echo Searching for DB::raw...
findstr /s "DB::raw" app\Http\Controllers\*.php
echo Searching for whereRaw...
findstr /s "whereRaw" app\Http\Controllers\*.php
echo Searching for selectRaw...
findstr /s "selectRaw" app\Http\Controllers\*.php

echo.
echo 4. Checking for unescaped output (XSS)...
findstr /s "{!!" resources\views\*.blade.php

echo.
echo 5. Checking file upload patterns...
findstr /s "storeAs\|move\|store" app\Http\Controllers\*.php

echo.
echo ✅ Security check completed!
pause