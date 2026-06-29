<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SoloCelular
{
    public function handle(Request $request, Closure $next): Response
    {
        $userAgent = $request->header('User-Agent');

        if (
            !str_contains($userAgent, 'Mobile') &&
            !str_contains($userAgent, 'Android') &&
            !str_contains($userAgent, 'iPhone')
        ) {
            abort(403, 'Esta página solo puede ser vista desde un dispositivo móvil.');
        }

        return $next($request);
    }
}