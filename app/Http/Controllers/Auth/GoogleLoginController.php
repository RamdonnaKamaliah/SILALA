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
    // Ambil URL redirect default dari Socialite
    $redirectUrl = Socialite::driver('google')->redirect()->getTargetUrl();
    
    $redirectUrl .= '&prompt=select_account';
    
    return redirect($redirectUrl);
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

            if (!$user) {
                // BUAT USER BARU (REGISTER VIA GOOGLE)
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                    'password' => Hash::make(uniqid()), // password random sementara
                    'password_setup' => false, // TANDAI BELUM SETUP PASSWORD
                ]);

                // Login user baru
                Auth::login($user, true);
                session()->regenerate();
                
                // LANGSUNG ARAHKAN KE SETUP PASSWORD
                return redirect()->route('setup.password');
            }

            // Jika user sudah ada (daftar manual atau sebelumnya via Google)
            // Update data Google
            $user->update([
                'google_id' => $googleUser->getId(),
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);

            // Login user yang sudah ada
            Auth::login($user, true);
            session()->regenerate();

            // Periksa apakah user sudah setup password
            // Jika belum, arahkan ke setup password
            if (!$user->password_setup) {
                return redirect()->route('setup.password');
            }

            // Jika sudah setup password, arahkan ke dashboard
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            Log::error('Google login error', ['message' => $e->getMessage()]);
            return redirect('/login')->with('error', 'Login Google gagal, coba lagi.');
        }
    }

    
}