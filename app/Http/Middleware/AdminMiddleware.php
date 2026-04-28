<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
<<<<<<< HEAD
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, trans('Unauthorized access to admin panel'));
        }

        return $next($request);
    }
=======
   public function handle(Request $request, Closure $next): Response
{
    if (! auth()->check()) {
        return redirect()->route('filament.admin.auth.login');
    }

    if (auth()->user()->hasRole('admin')) {
        return $next($request);
    }

    return redirect('/candidate/dashboard')
        ->with('error', 'Accès réservé aux administrateurs.');
}
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
}