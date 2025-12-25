@extends('layout_admin.admin')
@section('pageTitle', 'Admin Dashboard - Data CMS')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-semibold mb-6">Pengaturan Gambar CMS</h1>

    {{-- GRID: maksimal 4 kolom --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        {{-- ===================== --}}
        {{--      HERO IMAGE       --}}
        {{-- ===================== --}}
        <div class="p-4 bg-white rounded-lg shadow border">
            <h2 class="font-semibold mb-3 text-sm">Hero Section</h2>

            {{-- Preview --}}
            @if ($heroImage)
                <img src="{{ asset('storage/cms/' . $heroImage) }}" 
                     alt="Hero Image" 
                     class="w-full h-32 object-contain bg-gray-100 rounded mb-3">
            @else
                <div class="w-full h-32 bg-gray-100 flex items-center justify-center rounded text-gray-500 text-sm">
                    Belum ada gambar
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('admin.cms_admin.updateHero') }}" 
                  method="POST" 
                  enctype="multipart/form-data"
                  class="space-y-2">
                @csrf

                <input type="file" name="hero_image" accept="image/*" class="text-sm">

                <button class="w-full bg-blue-600 text-white py-1.5 text-sm rounded hover:bg-blue-700 transition">
                    Simpan
                </button>
            </form>
        </div>



        {{-- ===================== --}}
        {{--     FOOTER LOGO       --}}
        {{-- ===================== --}}
        @php
            $footerLogo = \App\Models\Setting::getValue('footer_logo', 'logo_kementan.png');
            $logoExists = Storage::disk('public')->exists('cms/' . $footerLogo);
        @endphp

        <div class="p-4 bg-white rounded-lg shadow border">
            <h2 class="font-semibold mb-3 text-sm">Logo Footer</h2>

            {{-- Preview --}}
            @if ($logoExists)
                <img src="{{ Storage::url('cms/' . $footerLogo) }}" 
                     alt="Footer Logo" 
                     class="w-full h-32 object-contain bg-gray-100 rounded mb-3">
            @else
                <div class="w-full h-32 bg-gray-100 flex items-center justify-center rounded text-gray-500 text-sm">
                    Default logo digunakan
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('admin.cms_admin.updateFooterLogo') }}" 
                  method="POST" 
                  enctype="multipart/form-data"
                  class="space-y-2">
                @csrf

                <input type="file" name="footer_logo" accept="image/*" class="text-sm">

                <button class="w-full bg-blue-600 text-white py-1.5 text-sm rounded hover:bg-blue-700 transition">
                    Simpan
                </button>
            </form>
        </div>

        <form action="{{ route('admin.cms_admin.updateSidebarLogo') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label class="block mb-2 font-medium">Upload Logo Sidebar Baru</label>
            <input type="file" name="sidebar_logo" class="mb-3">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Simpan Logo Sidebar
            </button>
        </form>

        @php
    $heroBg = \App\Models\Setting::getValue('hero_bg', 'background.png');
@endphp

<div class="p-4 bg-white rounded-lg shadow border">
    <h2 class="font-semibold mb-3 text-sm">Background Hero Landing</h2>

    {{-- Preview --}}
    <img 
        src="{{ Storage::disk('public')->exists('cms/' . $heroBg) 
            ? Storage::url('cms/' . $heroBg) 
            : asset('assets/background.png') }}"
        class="w-full h-32 object-cover rounded bg-gray-100 mb-3"
    >

    {{-- Form --}}
    <form action="{{ route('admin.cms_admin.updateHeroBg') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="space-y-2">
        @csrf

        <input type="file" name="hero_bg" accept="image/*" class="text-sm">

        <button class="w-full bg-blue-600 text-white py-1.5 rounded text-sm">
            Simpan
        </button>
    </form>
</div>

<div class="p-4 bg-white rounded-lg shadow border">
    <h2 class="font-semibold mb-3 text-sm">Logo Sidebar Admin</h2>

    @php
        $adminSidebarLogo = \App\Models\Setting::getValue('admin_sidebar_logo', null);
    @endphp

    @if ($adminSidebarLogo && Storage::disk('public')->exists('cms/' . $adminSidebarLogo))
        <img src="{{ Storage::url('cms/' . $adminSidebarLogo) }}"
             class="w-full h-32 object-contain bg-gray-100 rounded mb-3">
    @else
        <div class="w-full h-32 bg-gray-100 flex items-center justify-center rounded text-gray-500 text-sm">
            Logo default digunakan
        </div>
    @endif

    <form action="{{ route('admin.cms_admin.updateAdminSidebarLogo') }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-2">
        @csrf

        <input type="file" name="admin_sidebar_logo" accept="image/*" class="text-sm">

        <button class="w-full bg-blue-600 text-white py-1.5 text-sm rounded">
            Simpan
        </button>
    </form>
</div>


@php
    $footerdash = \App\Models\Setting::getValue(
        'footerdash',
        'logo_kementan.png'
    );

    $footerdashPath = Storage::disk('public')->exists('cms/' . $footerdash)
        ? Storage::url('cms/' . $footerdash)
        : asset('assets/logo_kementan.png');
@endphp

<div class="p-4 bg-white rounded-lg shadow border">
    <h2 class="font-semibold mb-3 text-sm">Logo Footer Dashboard</h2>

    <img src="{{ $footerdashPath }}"
         class="w-16 h-16 mx-auto object-contain bg-gray-100 rounded mb-3">

    <form action="{{ route('admin.cms_admin.updateFooterDash') }}"
      method="POST"
      enctype="multipart/form-data">

        @csrf

        <input type="file" name="footerdash" accept="image/*" class="text-sm w-full">

        <button class="w-full bg-blue-600 text-white py-1.5 text-sm rounded">
            Simpan
        </button>
    </form>
</div>

        {{-- =============== --}}
        {{--   KOTAK LAIN?   --}}
        {{-- =============== --}}
        {{-- nanti tinggal copy card di atas untuk item CMS lain --}}
        {{-- 1 card = 1 setting CMS --}}
        {{-- tinggal call Setting::getValue('nama_key') --}}

    </div>
</div>


{{-- SweetAlert --}}
@if (session('success'))
<script>
    Swal.fire({
        icon: "success",
        title: "Berhasil!",
        text: "{{ session('success') }}",
        timer: 1800,
        showConfirmButton: false,
    });
</script>
@endif

@endsection
