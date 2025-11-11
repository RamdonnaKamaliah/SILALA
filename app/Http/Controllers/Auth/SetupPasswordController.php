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

    // pastikan ambil dari guard 'web'
    $user = Auth::guard('web')->user();

    if ($user && $user instanceof \App\Models\User) {
        $user->password = Hash::make($request->password);
        $user->password_setup = true;
        $user->save();

        return redirect()->route('dashboard');
    }

    // fallback kalau entah kenapa bukan user web
    return redirect('/login')->with('error', 'Gagal menyimpan password. Silakan login ulang.');
}


}
