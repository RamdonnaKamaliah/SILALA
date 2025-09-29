<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('layout_admin.partial_admin.link')
    <title>Admin Dashboard</title>
</head>

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">

    {{-- Header (sidebar + navbar + buka <main>) --}}
    @include('layout_admin.partial_admin.header')

    {{-- Main Content --}}
    <div class="p-6">
        @yield('content')
    </div>

    {{-- Tutup main disini --}}
    </main>

    {{-- Footer --}}
    @include('layout_admin.partial_admin.footer')

    <!-- plugin for charts  -->
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}" async></script>
    <!-- plugin for scrollbar  -->
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}" async></script>
    <!-- github button -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- main script file  -->
    <script src="{{ asset('assets/js/soft-ui-dashboard-tailwind.js?v=1.0.5') }}" async></script>

</body>

</html>
