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
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        // Coba login sebagai admin terlebih dahulu
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        // Jika bukan admin, coba sebagai user
        if (Auth::guard('web')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        // Jika semua gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout dari semua guard
        Auth::guard('web')->logout();
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan ke landing page
        return redirect('/login');
    }
}