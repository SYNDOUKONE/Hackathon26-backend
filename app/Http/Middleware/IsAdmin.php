<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            // Vérification ultra-robuste : Rôle super-admin OU Rôle Administrateur OU Email spécifique
            if ($user->hasRole('super-admin') ||
                $user->hasRole('Administrateur') ||
                $user->email === env('ADMIN_EMAIL')) {
                return $next($request);
            }
        }

        // Redirection vers le dashboard si non autorisé
        return redirect('/dashboard')->with('error', 'Accès restreint aux administrateurs.');
    }
}
