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
<body class="min-h-screen font-[Ubuntu,sans-serif] bg-white">
  @include('layout_dashboard.partial_dashboard.header')
<!-- Konten Utama Dashboard -->
 <main
  class="pt-8 pb-6 px-4 md:px-6 bg-cream
  relative top-[90px] mb-24
  md:ml-[320px] md:mr-3
  md:rounded-3xl transition-all duration-300 z-30
  flex flex-col overflow-y-auto overflow-x-hidden max-w-full shadow-inner">

  <!-- Filter dan Pencarian -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">

  <div class="flex flex-col sm:flex-row sm:items-start gap-4 sm:gap-6 w-full md:w-auto">
    
    <!-- Kolom Riwayat -->
    <div class="flex flex-col gap-2">
      <div class="flex items-center gap-2">
        <input type="radio" name="riwayat" id="pinjam" checked class="accent-[#626F47]">
        <label for="pinjam" class="text-[#626F47] font-semibold text-sm">Riwayat Pinjam</label>
      </div>
      <div class="flex items-center gap-2">
        <input type="radio" name="riwayat" id="baca" class="accent-[#626F47]">
        <label for="baca" class="text-[#626F47] font-semibold text-sm">Riwayat Baca</label>
      </div>
    </div>

    <!-- Tombol Status -->
    <button
      class="bg-white border border-[#E0D6B8] px-4 py-1 rounded-full text-[#626F47] text-sm font-semibold flex items-center justify-center gap-1 shadow-sm w-fit">
      Status Peminjaman
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
        stroke-width="2" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
      </svg>
    </button>
  </div>

    <div class="relative w-full md:w-64">
      <input type="text" placeholder="Cari Buku..."
        class="w-full rounded-full bg-white border border-[#E0D6B8] pl-4 pr-10 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#C5B78B]" />
      <svg xmlns="http://www.w3.org/2000/svg"
        class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-[#626F47]" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
      </svg>
    </div>
  </div>

  <!-- Table -->
<div class="mt-6 bg-white rounded-3xl shadow-sm overflow-x-auto">
  <table class="min-w-full text-sm text-[#2E2E2E] border-collapse border border-[#F0EAD2]">
    <thead class="bg-cream text-[#626F47] font-semibold text-left">
      <tr>
        <th class="py-3 px-4 border-[#E6E6E6]">Buku</th>
        <th class="py-3 px-4 border-[#E6E6E6]">Tanggal Pinjam</th>
        <th class="py-3 px-4 border-[#E6E6E6]">Batas Pinjam</th>
        <th class="py-3 px-4 border-[#E6E6E6]">Keterangan</th>
        <th class="py-3 px-4">Status</th>
      </tr>
    </thead>

    <tbody class="divide-y divide-[#F0EAD2]">

      <!-- Sedang Dipinjam -->
      <tr class="hover:bg-[#FFF8E8] transition">
        <td class="py-4 px-4 flex items-center gap-3 min-w-[220px] border-r border-[#F0EAD2]">
          <img src="https://placehold.co/60x80" alt="Buku" class="rounded-lg shadow-sm flex-shrink-0">
          <div class="min-w-0">
            <p class="font-semibold text-sm leading-snug">Judul Buku dolor sit amet, consectetur.</p>
            <p class="text-[#626F47] text-xs font-medium">Penulis Buku</p>
          </div>
        </td>
        <td class="py-4 px-4 whitespace-nowrap border-r border-[#F0EAD2]">01 September 2025</td>
        <td class="py-4 px-4 whitespace-nowrap border-r border-[#F0EAD2]">07 September 2025</td>
        <td class="py-4 px-4 text-[#2E2E2E] font-medium whitespace-nowrap border-r border-[#F0EAD2]">
          Masih Dipinjam
        </td>
        <td class="py-4 px-4 whitespace-nowrap">
          <span class="inline-flex items-center justify-center bg-[#FCEFC1] text-[#9E7A1C] px-3 py-1.5 rounded-full text-xs font-semibold min-w-[130px] text-center">
            Sedang Dipinjam
          </span>
        </td>
      </tr>

      <!-- Sudah Dikembalikan Tepat Waktu -->
      <tr class="hover:bg-[#FFF8E8] transition">
        <td class="py-4 px-4 flex items-center gap-3 min-w-[220px] border-r border-[#F0EAD2]">
          <img src="https://placehold.co/60x80" alt="Buku" class="rounded-lg shadow-sm flex-shrink-0">
          <div class="min-w-0">
            <p class="font-semibold text-sm leading-snug">Judul Buku dolor sit amet, consectetur.</p>
            <p class="text-[#626F47] text-xs font-medium">Penulis Buku</p>
          </div>
        </td>
        <td class="py-4 px-4 whitespace-nowrap border-r border-[#F0EAD2]">01 September 2025</td>
        <td class="py-4 px-4 whitespace-nowrap border-r border-[#F0EAD2]">07 September 2025</td>
        <td class="py-4 px-4 text-[#2E2E2E] font-medium whitespace-nowrap border-r border-[#F0EAD2]">
          Tepat Waktu
        </td>
        <td class="py-4 px-4 whitespace-nowrap">
          <span class="inline-flex items-center justify-center bg-[#E3F8D2] text-[#478C24] px-3 py-1.5 rounded-full text-xs font-semibold min-w-[130px] text-center">
            Sudah Dikembalikan
          </span>
        </td>
      </tr>

      <!-- Terlambat -->
      <tr class="hover:bg-[#FFF8E8] transition">
        <td class="py-4 px-4 flex items-center gap-3 min-w-[220px] border-r border-[#F0EAD2]">
          <img src="https://placehold.co/60x80" alt="Buku" class="rounded-lg shadow-sm flex-shrink-0">
          <div class="min-w-0">
            <p class="font-semibold text-sm leading-snug">Judul Buku dolor sit amet, consectetur.</p>
            <p class="text-[#626F47] text-xs font-medium">Penulis Buku</p>
          </div>
        </td>

        <td class="py-4 px-4 whitespace-nowrap border-r border-[#F0EAD2]">01 September 2025</td>
        <td class="py-4 px-4 whitespace-nowrap border-r border-[#F0EAD2]">07 September 2025</td>

        <td class="py-4 px-4 text-red-600 font-medium whitespace-nowrap border-r border-[#F0EAD2]">
          Telat 9 Hari<br>
          <span class="text-xs text-red-500">Denda: Rp 9.000</span>
        </td>

        <td class="py-4 px-4 whitespace-nowrap">
          <div class="flex flex-col items-start">
            <span class="inline-flex items-center justify-center bg-[#F8D6D6] text-[#C24141] px-3 py-1.5 rounded-full text-xs font-semibold min-w-[130px] text-center shadow-sm">
              Terlambat
            </span>
            <span class="mt-1 text-[11px] text-red-500 italic">*Denda Rp 1.000 per hari</span>
          </div>
        </td>
      </tr>

      <!-- Sudah Dikembalikan (Telat) -->
      <tr class="hover:bg-[#FFF8E8] transition">
        <td class="py-4 px-4 flex items-center gap-3 min-w-[220px] border-r border-[#F0EAD2]">
          <img src="https://placehold.co/60x80" alt="Buku" class="rounded-lg shadow-sm flex-shrink-0">
          <div class="min-w-0">
            <p class="font-semibold text-sm leading-snug">Judul Buku dolor sit amet, consectetur.</p>
            <p class="text-[#626F47] text-xs font-medium">Penulis Buku</p>
          </div>
        </td>
        <td class="py-4 px-4 whitespace-nowrap border-r border-[#F0EAD2]">01 September 2025</td>
        <td class="py-4 px-4 whitespace-nowrap border-r border-[#F0EAD2]">07 September 2025</td>
        <td class="py-4 px-4 text-red-600 font-medium whitespace-nowrap border-r border-[#F0EAD2]">
          Telat 1 Hari<br>
          <span class="text-xs text-red-500">Denda: Rp 1.000</span>
        </td>
        <td class="py-4 px-4 whitespace-nowrap">
          <span class="inline-flex items-center justify-center bg-[#E3F8D2] text-[#478C24] px-3 py-1.5 rounded-full text-xs font-semibold min-w-[130px] text-center">
            Sudah Dikembalikan
          </span>
        </td>
      </tr>

    </tbody>
  </table>
</div>
</main>

@include('layout_dashboard.partial_dashboard.footer')

<!-- script -->
<script src="{{asset('assets_user/js/dashboard.js')}}"></script>
</body>
</html>