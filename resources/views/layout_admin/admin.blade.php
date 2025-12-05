<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('layout_admin.partial_admin.link')
    
    @stack('styles')

</head>

<body class="overflow-x-hidden bg-gray-50 min-h-screen">

    {{-- HEADER: hanya include komponen (sidebar + navbar) --}}
    @include('layout_admin.partial_admin.header')

    {{-- MAIN: satu-satunya main di layout --}}
    <main
        class="min-h-screen transition-all duration-300 pt-24 px-4 sm:px-6 bg-gray-50 
             lg:ml-64 lg:w-[calc(100%-16rem)] w-full overflow-hidden">
        <div class="max-w-full">
            @yield('content')
        </div>
    </main>

    <!-- Plugins -->
    <script src="{{ asset('/assets_admin/js/plugins/chartjs.min.js') }}" async></script>
    <script src="{{ asset('/assets_admin/js/plugins/perfect-scrollbar.min.js') }}" async></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>

    <!-- Global tidak bercabang -->
    <script src="{{ asset('assets_admin/js/dashboard/index.js') }}"></script>
    <script src="{{ asset('assets_admin/js/data_pengguna/pengguna.js') }}"></script>
    <script src="{{ asset('assets_admin/js/data_peminjam/peminjam.js') }}"></script>

    <!-- Data Buku -->
    <script src="{{ asset('assets_admin/js/dataBuku/ModalPlilhMedia.js') }}"></script>
    <script src="{{ asset('assets_admin/js/dataBuku/deleteArsip.js') }}"></script>
    {{-- databuku bagian create --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="{{ asset('/assets_admin/js/create-databuku.js') }}"></script>
    {{-- databuku bagian edit --}}
    <script src="{{ asset('assets_admin/js/dataBuku/edit.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    {{-- databuku bagian index --}}
    <script src="{{ asset('assets_admin/js/dataBuku/index.js') }}"></script>
    
    <!-- Arsip Buku -->
    <script src="{{ asset('assets_admin/js/arsipBuku/deleteArsip.js') }}"></script>
    <script src="{{ asset('assets_admin/js/arsipBuku/index.js') }}"></script>

    <!-- Kategori -->
    <script src="{{ asset('assets_admin/js/data_kategori/create.js') }}"></script>

    @stack('scripts')
</body>

</html>
