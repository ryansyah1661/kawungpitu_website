<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * Set the application locale based on the {locale} route parameter.
     * Only allows locales defined in config('app.available_locales').
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');
        $availableLocales = config('app.available_locales', ['id', 'en']);

        if (!in_array($locale, $availableLocales)) {
            abort(404);
        }

        App::setLocale($locale);
        URL::defaults(['locale' => $locale]);

        return $next($request);
    }
}
