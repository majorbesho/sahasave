<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAttachmentPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $user = $request->user();

        // التحقق من أن المستخدم مسجل دخول ومن نوع مسموح له
        if (!$user || !in_array(class_basename($user), ['Broker', 'Carrier', 'Shipper', 'User'])) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
