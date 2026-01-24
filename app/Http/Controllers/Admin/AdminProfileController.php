<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class AdminProfileController extends Controller
{
    public function index() {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.index', compact('admin'));
    }

    public function edit() {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.edit', compact('admin'));
    }

    public function update(Request $request) {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:225',
            'phone' => 'required|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048'
        ]);

        if($request->hasFile('foto')){
            if($admin->foto && Storage::disk('public')->exists($admin->foto)) {
                Storage::disk('public')->delete($admin->foto);
            }
            $validated['foto'] = $request->file('foto')->store('uploads/admin', 'public');
        }

        $admin->update($validated);
        
        return redirect()->route('admin.profile.index')->with('succes','data berhasil di edit');
    }

   public function updatePassword(Request $request)
{
    $admin = Auth::guard('admin')->user();

    $request->validate([
        'current_password' => 'required',
        'password' => 'required|min:6|confirmed',
    ]);

    if (!Hash::check($request->current_password, $admin->password)) {
        return back()->withErrors([
            'current_password' => 'Password lama salah!'
        ])->withInput();
    }

    $admin->update([
        'password' => Hash::make($request->password),
    ]);

    Auth::guard('admin')->logout();

    return redirect('login')
        ->with('success', 'Password berhasil diganti, silakan login ulang.');
}

}