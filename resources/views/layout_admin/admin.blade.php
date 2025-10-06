<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('layout_admin.partial_admin.link')
    <title>Admin Dashboard</title>
</head>

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">

    {{-- Header (sidebar + navbar) --}}
    @include('layout_admin.partial_admin.header')

    {{-- Main Wrapper --}}
    <main class="ml-64 flex flex-col min-h-screen">
        
        {{-- Main Content --}}
        <div class="flex-1 p-6">
            @yield('content')
        </div>

        {{-- Footer --}}
        @include('layout_admin.partial_admin.footer')

    </main>

    <!-- plugin for charts  -->
    <script src="{{ asset('/assets_admin/js/plugins/chartjs.min.js') }}" async></script>
    <!-- plugin for scrollbar  -->
    <script src="{{ asset('/assets_admin/js/plugins/perfect-scrollbar.min.js') }}" async></script>
    <!-- github button -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- main script file  -->

</body>

</html>
