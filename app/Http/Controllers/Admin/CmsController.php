<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Setting;

class CmsController extends Controller
{

    // Bagian Gambar landing Pertengahan section
    public function editHero()
    {
        $heroImage = Setting::getValue('hero_image', 'default_hero.png'); 
        return view('admin.cms_admin.index', compact('heroImage'));
    }

    public function updateHero(Request $request)
    {
        $request->validate([
            'hero_image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        if ($request->hasFile('hero_image')) {

            // Pastikan folder cms ada
            Storage::disk('public')->makeDirectory('cms');

            // Generate nama unik
            $filename = time() . '_' . $request->file('hero_image')->getClientOriginalName();

            // Simpan file ke storage/app/public/cms
            $request->file('hero_image')->storeAs('cms', $filename, 'public');

            // Simpan ke DB
            Setting::setValue('hero_image', $filename);
        }

        return back()->with('success', 'Gambar hero berhasil diperbarui!');
    }

    // Bagian logo footer landing
        public function updateFooterLogo(Request $request)
    {
        $request->validate([
            'footer_logo' => 'required|image|mimes:png,jpg,jpeg,webp,svg|max:2048'
        ]);

        if ($request->hasFile('footer_logo')) {
            // pastikan folder 'cms' ada di storage/public
            Storage::disk('public')->makeDirectory('cms');

            $file = $request->file('footer_logo');
            $filename = 'footer_' . time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            // simpan di storage/app/public/cms
            $file->storeAs('cms', $filename, 'public');

            // simpan nama file ke DB
            Setting::setValue('footer_logo', $filename);
        }

        return back()->with('success', 'Footer logo berhasil diperbarui!');
    }

}
