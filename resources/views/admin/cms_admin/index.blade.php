@extends('layout_admin.admin')
@section('pageTitle', 'Admin Dashboard - Data CMS')

@section('content')
<div class="p-6 space-y-6">

    {{-- HEADER --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Pengaturan Gambar CMS</h1>
        <p class="text-sm text-gray-500">Kelola aset visual website & dashboard</p>
    </div>

    {{-- GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        {{-- CARD TEMPLATE --}}
        @php
            function cardStart($title) {
                echo '<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 flex flex-col justify-between">';
                echo '<h2 class="text-sm font-semibold text-gray-700 mb-3">'.$title.'</h2>';
            }
            function cardEnd() {
                echo '</div>';
            }
        @endphp

        {{-- HERO IMAGE --}}
        @php cardStart('Hero Section'); @endphp
            @if ($heroImage)
                <img src="{{ asset('storage/cms/' . $heroImage) }}"
                     class="w-full h-36 object-contain bg-gray-50 rounded-lg mb-3">
            @else
                <div class="w-full h-36 flex items-center justify-center bg-gray-50 rounded-lg text-sm text-gray-400 mb-3">
                    Belum ada gambar
                </div>
            @endif

            <form action="{{ route('admin.cms_admin.updateHero') }}" method="POST" enctype="multipart/form-data" class="space-y-2">
                @csrf
                <input type="file" name="hero_image" class="w-full text-sm">
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 rounded-lg transition">
                    Simpan
                </button>
            </form>
        @php cardEnd(); @endphp

        {{-- FOOTER LOGO --}}
        @php
            $footerLogo = \App\Models\Setting::getValue('footer_logo', 'logo_kementan.png');
            $logoExists = Storage::disk('public')->exists('cms/' . $footerLogo);
        @endphp

        @php cardStart('Logo Footer'); @endphp
            @if ($logoExists)
                <img src="{{ Storage::url('cms/' . $footerLogo) }}"
                     class="w-full h-36 object-contain bg-gray-50 rounded-lg mb-3">
            @else
                <div class="w-full h-36 flex items-center justify-center bg-gray-50 rounded-lg text-sm text-gray-400 mb-3">
                    Default logo digunakan
                </div>
            @endif

            <form action="{{ route('admin.cms_admin.updateFooterLogo') }}" method="POST" enctype="multipart/form-data" class="space-y-2">
                @csrf
                <input type="file" name="footer_logo" class="w-full text-sm">
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 rounded-lg transition">
                    Simpan
                </button>
            </form>
        @php cardEnd(); @endphp

        {{-- HERO BACKGROUND --}}
        @php
            $heroBg = \App\Models\Setting::getValue('hero_bg', 'background.png');
        @endphp

        @php cardStart('Background Hero Landing'); @endphp
            <img
                src="{{ Storage::disk('public')->exists('cms/' . $heroBg) ? Storage::url('cms/' . $heroBg) : asset('assets/background.png') }}"
                class="w-full h-36 object-cover bg-gray-50 rounded-lg mb-3">

            <form action="{{ route('admin.cms_admin.updateHeroBg') }}" method="POST" enctype="multipart/form-data" class="space-y-2">
                @csrf
                <input type="file" name="hero_bg" class="w-full text-sm">
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 rounded-lg transition">
                    Simpan
                </button>
            </form>
        @php cardEnd(); @endphp

        {{-- ADMIN SIDEBAR LOGO --}}
        @php
            $adminSidebarLogo = \App\Models\Setting::getValue('admin_sidebar_logo');
        @endphp

        @php cardStart('Logo Sidebar Admin'); @endphp
            @if ($adminSidebarLogo && Storage::disk('public')->exists('cms/' . $adminSidebarLogo))
                <img src="{{ Storage::url('cms/' . $adminSidebarLogo) }}"
                     class="w-full h-36 object-contain bg-gray-50 rounded-lg mb-3">
            @else
                <div class="w-full h-36 flex items-center justify-center bg-gray-50 rounded-lg text-sm text-gray-400 mb-3">
                    Logo default digunakan
                </div>
            @endif

            <form action="{{ route('admin.cms_admin.updateAdminSidebarLogo') }}" method="POST" enctype="multipart/form-data" class="space-y-2">
                @csrf
                <input type="file" name="admin_sidebar_logo" class="w-full text-sm">
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 rounded-lg transition">
                    Simpan
                </button>
            </form>
        @php cardEnd(); @endphp

        {{-- FOOTER DASHBOARD --}}
        @php
            $footerdash = \App\Models\Setting::getValue('footerdash', 'logo_kementan.png');
            $footerdashPath = Storage::disk('public')->exists('cms/' . $footerdash)
                ? Storage::url('cms/' . $footerdash)
                : asset('assets/logo_kementan.png');
        @endphp

        @php cardStart('Logo Footer Dashboard'); @endphp
            <img src="{{ $footerdashPath }}"
                 class="w-20 h-20 mx-auto object-contain bg-gray-50 rounded-lg mb-3">

            <form action="{{ route('admin.cms_admin.updateFooterDash') }}" method="POST" enctype="multipart/form-data" class="space-y-2">
                @csrf
                <input type="file" name="footerdash" class="w-full text-sm">
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 rounded-lg transition">
                    Simpan
                </button>
            </form>
        @php cardEnd(); @endphp

        @php
    $sidebarLogo = \App\Models\Setting::getValue('sidebar_logo', null);
@endphp

<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 flex flex-col justify-between">
    <h2 class="text-sm font-semibold text-gray-700 mb-3">
        Logo Sidebar Landing
    </h2>

    @if ($sidebarLogo && Storage::disk('public')->exists('cms/' . $sidebarLogo))
        <img src="{{ Storage::url('cms/' . $sidebarLogo) }}"
             class="w-full h-36 object-contain bg-gray-50 rounded-lg mb-3">
    @else
        <div class="w-full h-36 flex items-center justify-center bg-gray-50 rounded-lg text-sm text-gray-400 mb-3">
            Logo default digunakan
        </div>
    @endif

    <form action="{{ route('admin.cms_admin.updateSidebarLogo') }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-2">
        @csrf

        <input type="file" name="sidebar_logo" class="w-full text-sm">

        <button
            class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 rounded-lg transition">
            Simpan
        </button>
    </form>
    </div>

{{-- LAGI --}}
    </div>
</div>

{{-- SWEETALERT --}}
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
