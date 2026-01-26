<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Silala | Sistem Informasi Layanan Literasi & Arsip</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Include link (CSS, font, dsb) --}}
    @include('layout_user.partial_user.link')

    {{-- Tempat buat CSS tambahan tiap halaman --}}
    @stack('styles')
</head>

<body class="min-h-screen flex flex-col font-[Ubuntu,sans-serif] bg-white">
@if(session('success'))
  <div id="toast-success"
       class="fixed top-5 right-5 z-50
              bg-primary
              text-white
              border-l-4 border-white
              px-4 py-3 rounded-xl shadow-md
              flex items-center gap-2
              transition-opacity duration-500">
    <i class="fa-solid fa-circle-check text-white"></i>
    <span class="text-sm font-medium">
      {{ session('success') }}
    </span>
  </div>
@endif

    {{-- HEADER USER --}}
    @include('layout_user.partial_user.header')

    {{-- KONTEN UTAMA --}}
      <main class="pt-8 pb-6 px-4 md:px-6 bg-cream relative top-[90px] mb-24 md:ml-[320px] md:mr-3 md:rounded-3xl transition-all duration-300
   flex flex-col max-w-full shadow-inner">
    @yield('content')
</main>

    {{-- FOOTER USER --}}
    @include('layout_user.partial_user.footer')

    {{-- Script tambahan (kalau ada JS per halaman) --}}
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script src="{{ asset('assets_user/js/sidebarnavbar.js') }}"></script>
    <script src="{{ asset('assets_user/js/daftarbuku.js') }}"></script>
    <script src="{{ asset('assets_user/js/riwayatbuku.js') }}"></script>
    <script src="{{ asset('assets_user/js/favorit.js') }}"></script>
    <script src="{{ asset('assets_user/js/editprofil.js') }}"></script>
    <script src="{{ asset('assets_user/js/profil.js') }}"></script>
    <script src="{{ asset('assets_user/js/riwayatbaca.js') }}"></script>
    <script src="{{ asset('assets_user/js/notif.js') }}"></script>
    <script src="{{ asset('assets_user/js/notifikasilogin.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @stack('scripts')

</body>

</html>
