<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        // Utilise la méthode isAdmin() du modèle User qui vérifie le rôle Bouncer
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (! $user->isAdmin()) {
            abort(403, 'Accès interdit. Réservé aux administrateurs.');
        }

        return $next($request);
    }
}
