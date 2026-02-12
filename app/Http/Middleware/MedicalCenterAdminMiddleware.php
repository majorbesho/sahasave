<?php

// app/Http/Middleware/MedicalCenterAdminMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalCenterAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // التحقق إذا كان مدير مركز طبي
        if (!$user->isMedicalCenterAdmin()) {
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية للوصول إلى هذه الصفحة');
        }

        // التحقق من الصلاحية للوصول للصفحة المطلوبة
        $routeName = $request->route()->getName();
        $admin = $user->medicalCenterAdmins()->first();
        $permissions = $admin->permissions();

        // الصفحات العامة المسموح بها لجميع المديرين
        $generalRoutes = [
            'medical-center.dashboard',
            'medical-center.profile',
            'medical-center.notifications'
        ];

        if (!in_array($routeName, $generalRoutes)) {
            // استخراج الصلاحية المطلوبة من اسم المسار
            $requiredPermission = $this->getPermissionFromRoute($routeName);

            if ($requiredPermission && !in_array($requiredPermission, $permissions)) {
                return redirect()->route('medical-center.dashboard')
                    ->with('error', 'ليس لديك الصلاحية لهذا الإجراء');
            }
        }

        return $next($request);
    }

    private function getPermissionFromRoute($routeName)
    {
        $mapping = [
            'medical-center.doctors.*' => 'manage_doctors',
            'medical-center.appointments.*' => 'manage_appointments',
            'medical-center.financial.*' => 'manage_finance',
            'medical-center.services.*' => 'manage_services',
            'medical-center.analytics.*' => 'view_reports',
            'medical-center.settings.*' => 'manage_settings'
        ];

        foreach ($mapping as $pattern => $permission) {
            if (\Illuminate\Support\Str::is($pattern, $routeName)) {
                return $permission;
            }
        }

        return null;
    }
}
