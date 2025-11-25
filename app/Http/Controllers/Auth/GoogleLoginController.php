<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

public function handleGoogleCallback()
{
    try {
        $googleUser = Socialite::driver('google')->user();

        // Cek apakah ada admin
        $admin = Admin::where('email', $googleUser->getEmail())->first();
        if ($admin) {
            $admin->update([
                'google_id' => $googleUser->getId(),
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);

            Auth::guard('admin')->login($admin, true);
            session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        // Cek apakah user sudah ada
        $user = User::where('email', $googleUser->getEmail())->first();

        // Jika user belum ada, buat baru
        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'password' => Hash::make(uniqid()),
                'password_setup' => false,
            ]);

            Auth::login($user, true);
            session()->regenerate();
            return redirect()->route('setup.password');
        }

        // Jika user sudah ada (daftar manual)
        // Update data Google
        $user->update([
            'google_id' => $googleUser->getId(),
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
        ]);

        // Login langsung
        Auth::login($user, true);
        session()->regenerate();

        // Arahkan sesuai status password
        if (!$user->password_setup) {
            return redirect()->route('setup.password');
        }

        return redirect()->route('dashboard');

    } catch (\Exception $e) {
        Log::error('Google login error', ['message' => $e->getMessage()]);
        return redirect('/login')->with('error', 'Login Google gagal, coba lagi.');
    }
}


}
