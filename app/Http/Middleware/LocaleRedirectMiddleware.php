<?php

namespace App\Http\Middleware;

use Closure;

class LocaleRedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $segments = $request->segments(); // Get all segments of the URL

        if (count($segments) == 2) {
            if (in_array($segments[0], ['en', 'fr', 'es', 'it', 'de', 'pt-br', 'zh-cn', 'ko', 'ru'])) {
                return $next($request);
            } else {
                // Redirect to the 'en' locale
                $segments[0] = 'en';
                return redirect(implode('/', $segments), 301);
            }
        } elseif (count($segments) == 1) {
            if (in_array($segments[0], ['en', 'fr', 'es', 'it', 'de', 'pt-br', 'zh-cn', 'ko', 'ru'])) {
                return $next($request);
            } else {
                return redirect()->route('home', ['locale' => 'en']);
            }
        } else {
            return redirect()->route('home');
        }
    }
}
