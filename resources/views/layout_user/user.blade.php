<!DOCTYPE html>
<<<<<<< HEAD
<html lang="id" class="theme-green">
=======
<html lang="id">
>>>>>>> a8ca92be733905685b35971da96e246167f9f327

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<<<<<<< HEAD
=======
    <meta name="csrf-token" content="{{ csrf_token() }}">
>>>>>>> a8ca92be733905685b35971da96e246167f9f327
    <title>Silala</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Include link (CSS, font, dsb) --}}
    @include('layout_user.partial_user.link')

    {{-- Tempat buat CSS tambahan tiap halaman --}}
    @stack('styles')
</head>

<<<<<<< HEAD
<body class="theme-green min-h-screen flex flex-col font-[Ubuntu,sans-serif] bg-white transition-colors duration-300">

    {{-- HEADER USER --}}
    @include('layout_user.partial_user.header')

    {{-- KONTEN UTAMA --}}
    <main
        class="pt-8 pb-6 px-4 md:px-6 bg-cream dark:bg-black relative top-[90px] mb-24 md:ml-[320px] md:mr-3 md:rounded-3xl transition-all duration-300 z-30 flex flex-col max-w-full shadow-inner">
        @yield('content')
    </main>
=======
<body class="min-h-screen flex flex-col font-[Ubuntu,sans-serif] bg-white">
    {{-- HEADER USER --}}
    @include('layout_user.partial_user.header')

    {{-- KONTEN UTAMA --}}
      <main class="pt-8 pb-6 px-4 md:px-6 bg-cream relative top-[90px] mb-24 md:ml-[320px] md:mr-3 md:rounded-3xl transition-all duration-300
   flex flex-col max-w-full shadow-inner">
    @yield('content')
</main>
>>>>>>> a8ca92be733905685b35971da96e246167f9f327

    {{-- FOOTER USER --}}
    @include('layout_user.partial_user.footer')

    {{-- Script tambahan (kalau ada JS per halaman) --}}
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
<<<<<<< HEAD
=======
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
>>>>>>> a8ca92be733905685b35971da96e246167f9f327
    <script src="{{ asset('assets_user/js/sidebarnavbar.js') }}"></script>
    <script src="{{ asset('assets_user/js/daftarbuku.js') }}"></script>
    <script src="{{ asset('assets_user/js/riwayatbuku.js') }}"></script>
    <script src="{{ asset('assets_user/js/favorit.js') }}"></script>
<<<<<<< HEAD
    <script src="{{ asset('assets_user/js/colorSwitcher.js') }}"></script>
=======
    <script src="{{ asset('assets_user/js/editprofil.js') }}"></script>
    <script src="{{ asset('assets_user/js/profil.js') }}"></script>
    <script src="{{ asset('assets_user/js/riwayatbaca.js') }}"></script>
    <script src="{{ asset('assets_user/js/notif.js') }}"></script>
>>>>>>> a8ca92be733905685b35971da96e246167f9f327
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @stack('scripts')

</body>

</html>
