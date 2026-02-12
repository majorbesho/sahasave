<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
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
        $response = $next($request);

        // X-Content-Type-Options
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // X-Frame-Options
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Referrer-Policy
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');

        // Content-Security-Policy
        // Note: Starting with a balanced policy to ensure compatibility.
        // upgrade-insecure-requests: ensure all requests are via HTTPS
        // block-all-mixed-content: prevent loading HTTP assets on HTTPS pages
        $response->headers->set('Content-Security-Policy', "upgrade-insecure-requests; block-all-mixed-content;");

        // X-XSS-Protection (Legacy but still useful for older browsers)
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        return $response;
    }
}
