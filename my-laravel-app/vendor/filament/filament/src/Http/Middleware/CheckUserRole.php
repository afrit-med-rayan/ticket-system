<?php

namespace Filament\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Filament\Models\Contracts\FilamentUser;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $user = Filament::auth()->user();
        $panel = Filament::getCurrentPanel();

        // Ensure the user is authenticated
        if (!$user) {
            return redirect(Filament::getLoginUrl());
        }

        // Check if the user's role matches the panel ID
        if ($user->role !== $panel->getId()) {
            // Log the user out before redirecting to the correct panel's login page
            Filament::auth()->logout();

            // Optionally, you can clear the session completely
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Redirect to the correct login page
            return redirect(Filament::getLoginUrl())->withErrors([
                'auth' => 'You do not have permission to access this panel. Please log in to the correct panel.',
            ]);
        }

        return $next($request);
    }
}
