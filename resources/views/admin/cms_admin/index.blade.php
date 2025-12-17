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
