<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
class setAppLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! in_array($request->header("lang"), config('app.available_locales'))) {

            App::setLocale('en');
        }
        elseif ($request->header("lang")=='ar'){

            App::setLocale('ar');

        } elseif ($request->header("lang")=='en'){

            App::setLocale('en');
        }


        return $next($request);
    }
}
