<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'SILALA | Detail Buku' }}</title>

    {{-- VITE --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Partial tambahan --}}
    @include('layout_user.partial_user.link')

    {{-- CSS tambahan --}}
    @stack('styles')
</head>

<body class="min-h-screen font-[Ubuntu,sans-serif] bg-white flex" data-buku-id="{{ $buku->id }}"
      data-favorit-url="{{ route('user.favorit.toggle') }}"
      data-pinjam-url="{{ route('pinjam.store') }}"
      data-pinjam-redirect="{{ route('user.riwayatbuku') }}"
      data-csrf="{{ csrf_token() }}">

    {{-- Sidebar --}}
    <x-sidebarUser></x-sidebarUser>

    {{-- Navbar Detail --}}
    @include('layout_user.partial_user.headerdetail', [
    'buku' => $buku,
    'userBorrow' => $userBorrow ?? null,
    'hasRead' => $hasRead ?? null,
    'userRating' => $userRating ?? null,
    'averageRating' => $averageRating ?? 0,
    'totalRatings' => $totalRatings ?? 0,
    'stokHabis' => $stokHabis ?? null,
    'isFavorited' => $isFavorited ?? false
])


    {{-- Konten Utama --}}
    <main class="flex-1 ml-0 md:ml-[320px] mr-0 md:mr-3 transition-all duration-300 relative overflow-y-auto pt-[55vh] pb-20">
        @yield('content')
    </main>

   
    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- PDF.js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

    {{-- Sidebar/Navbar --}}
    <script src="{{ asset('assets_user/js/sidebarnavbar.js') }}"></script>

    {{-- Detail Buku JS --}}
    <script src="{{ asset('assets_user/js/detailbuku.js') }}"></script>

    {{-- Iconify --}}
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    {{-- JS tambahan per halaman --}}
    @stack('scripts')

</body>

</html>
