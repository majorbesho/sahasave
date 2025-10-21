<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  // <<-- هذا هو البارامتر الذي نمرره (مثل 'doctor')
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // 1. تحقق أولاً إذا كان المستخدم مسجلاً دخوله
        if (!Auth::check()) {
            // إذا لم يكن مسجلاً، أعد توجيهه لصفحة الدخول
            return redirect('login');
        }

        // 2. احصل على المستخدم الحالي
        $user = Auth::user();

        // 3. تحقق إذا كان دور المستخدم يطابق الدور المطلوب
        if ($user->role == $role) {
            // إذا كان الدور صحيحاً، اسمح للطلب بالمرور إلى وجهته
            return $next($request);
        }

        // 4. إذا لم يكن الدور صحيحاً، أوقف الطلب
        // يمكنك إعادته للصفحة الرئيسية مع رسالة خطأ، أو عرض صفحة 403 (Forbidden)
        abort(403, 'Unauthorized Action.');
    }
}
