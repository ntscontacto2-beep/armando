<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (auth()->check() && $user->two_factor_code) {
            // Si el usuario tiene un código pendiente en la BD,
            // significa que aún no ha verificado.

            // Verificamos que no esté expirado, si expiró, lo reseteamos (opcional)
            if ($user->two_factor_expires_at->lt(now())) {
                $user->resetTwoFactorCode();
                auth()->logout();
                return redirect()->route('login')->with('error', 'El código ha expirado. Inicia sesión de nuevo.');
            }

            // Si la ruta actual NO es la de verificar código, redirigir a verificar
            if (!$request->is('verify*')) {
                return redirect()->route('verify.index');
            }
        }

        return $next($request);
    }
}