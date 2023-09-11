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

        $url = $request->url();
        // Check if the URL contains '/index.php/' and remove it
        if (strpos($url, '/index.php/') !== false) {
            $url = str_replace('/index.php/', '/', $url);
            return redirect()->to($url, 301);
        }

        return $next($request);
    }
}
