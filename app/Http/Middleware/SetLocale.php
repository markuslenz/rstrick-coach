<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         $locale = 
            auth()->user()->locale
            ?? session('locale')
            ?? $request->getPreferredLanguage(['de', 'en'])
            ?? config('app.locale');

        app()->setLocale($locale);

        return $next($request);
    }
}
