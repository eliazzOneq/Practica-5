<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RegistrarPeticion
{
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('Petición recibida', [
            'metodo' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'fecha' => now(),
        ]);

        return $next($request);
    }
}