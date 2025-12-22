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

    public function updateSidebarLogo(Request $request)
    {
        $request->validate([
            'sidebar_logo' => 'required|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
        ]);

        // Pastikan folder ada
        Storage::disk('public')->makeDirectory('cms');

        $file = $request->file('sidebar_logo');
        $filename = 'sidebar_logo_' . time() . '.' . $file->getClientOriginalExtension();

        // SIMPAN KE STORAGE YANG BENAR
        $file->storeAs('cms', $filename, 'public');

        Setting::updateOrCreate(
            ['key' => 'sidebar_logo'],
            ['value' => $filename]
        );

        return back()->with('success', 'Logo Sidebar berhasil diperbarui!');
    }

        public function updateHeroBg(Request $request)
        {
            $request->validate([
                'hero_bg' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
            ]);

            // pastiin folder ada
            Storage::disk('public')->makeDirectory('cms');

            $file = $request->file('hero_bg');

            // nama aman & unik
            $filename = 'hero_bg_' . time() . '.' . $file->getClientOriginalExtension();

            // simpan ke storage/app/public/cms
            $file->storeAs('cms', $filename, 'public');

            // simpan ke DB
            Setting::updateOrCreate(
                ['key' => 'hero_bg'],
                ['value' => $filename]
            );

            return back()->with('success', 'Background hero berhasil diubah!');
        }

        public function updateAdminSidebarLogo(Request $request)
            {
                $request->validate([
                    'admin_sidebar_logo' => 'required|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
                ]);

                // pastikan folder cms ada
                Storage::disk('public')->makeDirectory('cms');

                $file = $request->file('admin_sidebar_logo');
                $filename = 'admin_sidebar_' . time() . '.' . $file->getClientOriginalExtension();

                // simpan ke storage/app/public/cms
                $file->storeAs('cms', $filename, 'public');

                // simpan ke DB
                Setting::updateOrCreate(
                    ['key' => 'admin_sidebar_logo'],
                    ['value' => $filename]
                );

                return back()->with('success', 'Logo sidebar admin berhasil diperbarui!');
            }

}