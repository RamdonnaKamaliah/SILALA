<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SetupPasswordController extends Controller
{
    public function index()
    {
        return view('auth.setup-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        // Ambil user yang sedang login
        $user = Auth::guard('web')->user();

        if ($user && $user instanceof \App\Models\User) {
            // Update password dan tandai sudah setup
            $user->password = Hash::make($request->password);
            $user->password_setup = true;
            $user->save();

            // LOGOUT USER setelah menyimpan password
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Arahkan ke halaman login dengan pesan sukses
            return redirect()->route('login')
                ->with('success', 'Password berhasil dibuat! Silakan login dengan email dan password Anda.');
        }

        return redirect('/login')->with('error', 'Gagal menyimpan password. Silakan login ulang.');
    }
}