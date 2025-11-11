<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>

    @include('layout_admin.partial_admin.link')

    <style>
        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }

        @media (max-width: 1024px) {
            main {
                margin-left: 0 !important;
                width: 100% !important;
                padding-top: 6.5rem !important;
            }
        }

        @media (max-width: 640px) {
            main {
                padding-top: 7.5rem !important;
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>

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

    <script src="{{ asset('/assets_admin/js/plugins/chartjs.min.js') }}" async></script>
    <script src="{{ asset('/assets_admin/js/plugins/perfect-scrollbar.min.js') }}" async></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>

    
    @stack('scripts')

</body>

</html>
