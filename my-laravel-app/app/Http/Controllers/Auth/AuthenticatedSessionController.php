<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('filament.pages.admin-dashboard');
        } elseif ($user->isEmployee()) {
            return redirect()->route('filament.pages.employee-dashboard');
        } elseif ($user->isClient()) {
            return redirect()->route('filament.pages.client-dashboard');
        }

        return redirect()->intended(Filament::getUrl());
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    protected function authenticated(Request $request, $user)
{
    if ($user->isAdmin()) {
        return redirect()->route('filament.pages.admin-dashboard');
    } elseif ($user->isEmployee()) {
        return redirect()->route('filament.pages.employee-dashboard');
    } elseif ($user->isClient()) {
        return redirect()->route('filament.pages.client-dashboard');
    }

    return redirect('/');
}
}
