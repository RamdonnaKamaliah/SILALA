<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CmsController extends Controller
{
    public function index() {
        $logos = Setting::whereIn('group', ['logos', 'background'])->get();
        $previewLogo = Setting::getValue('logo_admin_sidebar');
        
        return view('admin.cms.index', compact('logos', 'previewLogo'));
    }

    public function upload(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'key' => 'required|string|exists:settings,key'
        ]);

        try {
            $setting = Setting::where('key', $request->key)->first();
            
            if ($setting->value && Storage::disk('public')->exists('cms/' . $setting->value)) {
                Storage::disk('public')->delete('cms/' . $setting->value);
            }

            if (!Storage::disk('public')->exists('cms')) {
                Storage::disk('public')->makeDirectory('cms');
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->key . '_' . time() . '.' . $extension;

            $file->storeAs('cms', $filename, 'public');

            $setting->update(['value' => $filename]);

            return redirect()->route('admin.cms.index')->with('succes', 'data berhasil di simpan');

        } catch (\Exception $e) {
            return redirect()
            ->back()
            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete(Request $request) {
        $request->validate([
            'key' => 'required|string|exists:settings,key'
        ]);

        try {
            $setting = Setting::where('key', $request->key)->first();
            
            if ($setting->value && Storage::disk('public')->exists('cms/' . $setting->value)) {
                Storage::disk('public')->delete('cms/' . $setting->value);
            }

            $setting->update(['value' => null]);

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus ' . $setting->label
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus: ' . $e->getMessage()
            ], 500);
        }
    }
}