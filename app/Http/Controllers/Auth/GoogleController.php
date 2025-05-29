<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        session(['google_login_redirect_url' => url()->previous()]);
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->getEmail())->first();
        if ($user) {
            // User exists, update only google_id and name if needed
            $user->update([
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
            ]);
        } else {
            // New user, create with password
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt(str()->random(24)), // Required, but never used
            ]);
        }

        // Login and redirect
        Auth::login($user);

        return redirect(session()->pull('google_login_redirect_url', '/'))->with("status", "Logged In Successfully."); // Or your preferred landing page
    }
}
