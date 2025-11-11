<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('pageTitle', 'Admin Dashboard')</title>

  {{-- ====== PARTIAL: LINK FONT, ICON, DLL ====== --}}
  @include('layout_admin.partial_admin.link')
  {{-- ====== PAGE SPECIFIC STYLES ====== --}}
  @stack('styles')
</head>

<body class="bg-gray-50 min-h-screen overflow-x-hidden font-[Inter]">

  {{-- ====== HEADER (SIDEBAR + NAVBAR) ====== --}}
  @include('layout_admin.partial_admin.header')

  {{-- ====== MAIN WRAPPER ====== --}}
  <main 
    class="min-h-screen transition-all duration-300 
           pt-24 px-4 sm:px-6 bg-gray-50
           lg:ml-64 lg:w-[calc(100%-16rem)] w-full overflow-hidden"
  >
    <div class="max-w-full">
      {{-- HALAMAN KONTEN --}}
      @yield('content')
    </div>
  </main>

  {{-- ====== FOOTER SCRIPT ====== --}}
  <script src="{{ asset('assets_admin/js/plugins/chartjs.min.js') }}" async></script>
  <script src="{{ asset('assets_admin/js/plugins/perfect-scrollbar.min.js') }}" async></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  {{-- ====== SIDEBAR & LAYOUT SCRIPT ====== --}}
  <script src="{{ asset('assets_admin/js/sidebar-admin.js') }}"></script>

  {{-- ====== PAGE SPECIFIC SCRIPT ====== --}}
  @stack('scripts')
</body>
</html>
