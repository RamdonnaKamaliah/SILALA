<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile_admin.index', compact('admin'));
    }

    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile_admin.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'foto'  => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        // Update basic data
        $admin->name = $request->name;
        $admin->phone = $request->phone;

        if ($request->hasFile('foto')) {
            \Log::info('📸 File foto detected!', [
                'original_name' => $request->file('foto')->getClientOriginalName(),
                'size' => $request->file('foto')->getSize(),
                'mime' => $request->file('foto')->getMimeType(),
            ]);

            // Hapus foto lama jika ada
            if ($admin->foto && file_exists(storage_path('app/public/uploads/admin/'.$admin->foto))) {
                unlink(storage_path('app/public/uploads/admin/'.$admin->foto));
                \Log::info('🗑️ Old photo deleted: ' . $admin->foto);
            }

            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            
            // Pastikan folder ada
            if (!file_exists(storage_path('app/public/uploads/admin'))) {
                mkdir(storage_path('app/public/uploads/admin'), 0755, true);
                \Log::info('📁 Folder created: uploads/admin');
            }
            
            $file->storeAs('uploads/admin', $filename, 'public');
            
            $admin->foto = $filename;
            
            \Log::info('✅ New photo saved: ' . $filename);
        } else {
            \Log::warning('⚠️ No file detected in request');
        }

        $admin->save();

        \Log::info('💾 Admin profile updated', [
            'name' => $admin->name,
            'phone' => $admin->phone,
            'foto' => $admin->foto,
        ]);

        return redirect()->route('admin.profile_admin.index')
                         ->with('success', 'Profile berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors([
                'current_password' => 'Password lama salah!'
            ]);
        }

        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route('admin.profile_admin.index')
                         ->with('success', 'Password berhasil diganti!');
    }
}