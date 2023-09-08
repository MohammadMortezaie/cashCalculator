<?php

namespace App\Http\Middleware;

use Closure;

class LanguageMiddleware
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
        // Spanish, French, Italian, and German
        // Portuguese, Chinese, Korean, Russian
        if ($request->segment(1) && in_array($request->segment(1), array('en', 'fr', 'es', 'it', 'de', 'pt-br', 'zh-cn', 'ko', 'ru'))) {
            $lang = $request->segment(1);
        } else {
            $lang = 'en';
        }
        app()->setLocale($lang);

        if (!$request->secure() && app()->environment() === 'production') {
            return redirect()->to($request->getRequestUri(), 302, [], true);
        }


        return $next($request);
    }
}
