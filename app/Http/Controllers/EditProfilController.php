<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class EditProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        return view('user.editprofil', [
            'title' => 'EDIT PROFIL',
            'user' => $user
        ]);
    }

    public function update(Request $request)
{
    $user = User::find(Auth::id());
    
    // Validasi data - membership_type sekarang REQUIRED karena radio button wajib dipilih
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:20',
        'gender' => 'nullable|in:Laki-laki,Perempuan',
        'membership_type' => 'required|in:Karyawan,Magang', // Diubah menjadi REQUIRED
        'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'current_password' => 'nullable|required_with:new_password',
        'new_password' => 'nullable|min:8|confirmed',
    ]);

    // Update data
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->phone = $validated['phone'] ?? $user->phone;
    
    // Konversi gender sesuai database (L/P)
    $genderInput = $validated['gender'] ?? null;
    if ($genderInput) {
        if ($genderInput == 'Laki-laki') {
            $user->gender = 'L'; // Database menggunakan 'L'
        } elseif ($genderInput == 'Perempuan') {
            $user->gender = 'P'; // Database menggunakan 'P'
        }
    }
    
    // Update membership_type (selalu ada karena required)
    $user->membership_type = $validated['membership_type'];

    // Update foto profil jika ada
    if ($request->hasFile('foto_profil')) {
        if ($user->foto_profil && Storage::exists('public/' . $user->foto_profil)) {
            Storage::delete('public/' . $user->foto_profil);
        }
        
        $path = $request->file('foto_profil')->store('foto_profil', 'public');
        $user->foto_profil = $path;
    }

    // Update password
    if ($request->filled('current_password')) {
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password salah'])->withInput();
        }
        
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }
    }

    $user->save();

    // Redirect dengan session success untuk SweetAlert
        return redirect()->route('user.profil')
            ->with('success', 'Profil berhasil diperbarui!')
            ->with('alert_type', 'success');
}
}