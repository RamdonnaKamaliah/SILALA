<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @include('layout_dashboard.partial_dashboard.link')
  <title>SILALA</title>
  <!-- vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <!-- style -->
 <link rel="stylesheet" href="{{ asset('assets_user/css/dashboard.css') }}">
</head>
<body class="min-h-screen overflow-hidden font-[Ubuntu,sans-serif] bg-white">
  @include('layout_dashboard.partial_dashboard.header')

 <!-- Konten Utama Dashboard -->
  <main class="pt-8 pb-6 px-4 md:px-6 bg-cream relative top-[90px] mb-24 md:ml-[320px] md:mr-3 md:rounded-3xl transition-all duration-300 z-30 flex flex-col overflow-y-auto overflow-x-hidden max-w-full shadow-inner">

    <!-- Filter dan Pencarian -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
      <div class="flex flex-col sm:flex-row sm:items-start gap-4 sm:gap-6 w-full md:w-auto">
        
        <!-- Kolom Riwayat -->
        <div class="flex flex-col gap-2">
          <div class="flex items-center gap-2">
            <input type="radio" name="riwayat" id="pinjam" checked class="accent-[#626F47]"
                   onclick="window.location.href='/riwayatbuku'">
            <label for="pinjam" class="text-[#626F47] font-semibold text-sm">Riwayat Pinjam</label>
          </div>
          <div class="flex items-center gap-2">
            <input type="radio" name="riwayat" id="baca" class="accent-[#626F47]"
                   onclick="window.location.href='/riwayatbaca'">
            <label for="baca" class="text-[#626F47] font-semibold text-sm">Riwayat Baca</label>
          </div>
        </div>
        </div>
    <!-- Input Pencarian -->
      <div class="relative w-full md:w-64">
        <input type="text" placeholder="Cari Buku..."
          class="w-full rounded-full bg-white border border-[#E0D6B8] pl-4 pr-10 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#C5B78B]" />
        <span class="iconify absolute right-3 top-1/2 -translate-y-1/2 text-[#626F47]" data-icon="mdi:magnify" style="font-size:20px;"></span>
      </div>
    </div>

</main>
<!-- script -->
<script src="{{asset('assets_user/js/dashboard.js')}}"></script>
</body>
</html>