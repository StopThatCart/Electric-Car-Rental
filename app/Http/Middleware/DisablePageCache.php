<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;


class DisablePageCache
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle($request, Closure $next)
    {
        // Czyszczenie cache
        $response = $next($request);
        $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->header('Pragma', 'no-cache');




        return $response;
    }
}
