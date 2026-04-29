<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CandidateMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            return redirect()->route('filament.candidate.auth.login');
        }

        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return $next($request);
        }

        if ($user->hasRole('candidate')) {
            return $next($request);
        }

        // Fallback pour users existants sans rôle Spatie encore assigné
        if (! $user->is_admin) {
            $user->assignRole('candidate');
            return $next($request);
        }

        return redirect('/')->with('error', 'Accès non autorisé.');
    }
}