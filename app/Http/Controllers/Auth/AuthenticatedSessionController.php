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
    public function create()
    {
        return redirect()->route('home')->with('error', 'Login to access this page.');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $authUserRole = Auth::user()->role;

        // if ($authUserRole == 0) {
        //     return redirect()->intended(route('admin', absolute: false));
        // } elseif ($authUserRole == 1) {
        //     return redirect()->intended(route('vendor', absolute: false));
        // } elseif ($authUserRole == 3) {
        //     return redirect()->intended(route('delivery', absolute: false));
        // } else {
            return redirect()->back()->with(
                'success',
                'Logged In Successfully.'
            );
        // }

        // return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // return redirect('https://accounts.google.com/Logout');
        return redirect()->route('home')->with(
            'success',
            'Logged Out Successfully.'
        );
    }
}
