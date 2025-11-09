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
        <input type="radio" name="riwayat" id="pinjam" checked class="accent-[#626F47]"
               onclick="window.location.href='/riwayatbuku'">
        <label for="pinjam" class="text-[#626F47] font-semibold text-sm">Riwayat Pinjam</label>
      </div>
      <div class="flex items-center gap-2">
        <input type="radio" name="riwayat" id="baca" class="accent-[#626F47]"
               onclick="window.location.href='/riwayat-baca'">
        <label for="baca" class="text-[#626F47] font-semibold text-sm">Riwayat Baca</label>
      </div>
    </div>

    <!-- Wrapper Dropdown + Badge -->
<div class="flex items-center gap-3">

  <!-- Dropdown Status -->
  <div class="relative" id="dropdownWrapper">

    <!-- Tombol -->
    <button id="dropdownButton"
      class="bg-white border border-[#E0D6B8] px-4 py-3 rounded-xl 
             text-[#626F47] text-sm font-semibold flex items-center gap-2
             shadow-lg shadow-[#C5B78B]/50">
      Status Peminjaman
      <span class="iconify w-6 h-6 transition duration-200" data-icon="mdi:chevron-down"></span>
    </button>

    <!-- Menu Dropdown -->
    <div id="dropdownMenu"
      class="absolute z-50 mt-2 left-0 w-52 shadow-lg rounded-lg overflow-hidden hidden">

      <a href="?status=sudah" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold bg-[#98E690] text-[#1C4B1A] hover:bg-[#7FDA77] cursor-pointer">
        <span class="iconify" data-icon="mdi:check" style="font-size:18px;"></span>
        Sudah Dikembalikan
      </a>

      <a href="?status=pinjam" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold bg-[#E8D26E] text-[#5F5311] hover:bg-[#D5C059] cursor-pointer">
        <span class="iconify" data-icon="mdi:clock-outline" style="font-size:18px;"></span>
        Sedang Dipinjam
      </a>

      <a href="?status=belum" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold bg-[#F19E9E] text-[#7E1D1D] hover:bg-[#E57C7C] cursor-pointer">
        <span class="iconify" data-icon="mdi:close" style="font-size:18px;"></span>
        Terlambat
      </a>
    </div>
  </div>


  <!-- ✅ Badge Hanya Muncul Jika Ada request()->status -->
  @if(request()->has('status'))
    @if(request()->status == 'sudah')
      <span class="inline-flex items-center gap-1 bg-[#98E690] text-[#1C4B1A] px-3 py-2 rounded-lg text-sm font-semibold">
        <span class="iconify" data-icon="mdi:check"></span> Sudah Dikembalikan
      </span>

    @elseif(request()->status == 'pinjam')
      <span class="inline-flex items-center gap-1 bg-[#E8D26E] text-[#5F5311] px-3 py-2 rounded-lg text-sm font-semibold">
        <span class="iconify" data-icon="mdi:clock-outline"></span> Sedang Dipinjam
      </span>

    @elseif(request()->status == 'belum')
      <span class="inline-flex items-center gap-1 bg-[#F19E9E] text-[#7E1D1D] px-3 py-2 rounded-lg text-sm font-semibold">
        <span class="iconify" data-icon="mdi:close"></span> Terlambat
      </span>
    @endif
  @endif

</div>
</div>
  <!-- Input Pencarian -->
  <div class="relative w-full md:w-64">
    <input type="text" placeholder="Cari Buku..."
      class="w-full rounded-full bg-white border border-[#E0D6B8] pl-4 pr-10 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#C5B78B]" />
    <span class="iconify absolute right-3 top-1/2 -translate-y-1/2 text-[#626F47]" data-icon="mdi:magnify" style="font-size:20px;"></span>
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
    <td class="py-4 px-4 relative min-w-[220px]">
      <div class="flex items-center gap-3">
        <img src="{{ asset('assets/buku3.jpg') }}" alt="Buku" class="w-[60px] h-[80px] object-cover rounded-lg shadow-lg flex-shrink-0">
        <div class="min-w-0">
          <p class="font-semibold text-sm leading-snug">Judul Buku dolor sit amet, consectetur.</p>
          <p class="text-[#626F47] text-xs font-medium">Penulis Buku</p>
        </div>
      </div>
      <!-- Garis pendek di tengah cell -->
      <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
    </td>

    <td class="py-4 px-4 whitespace-nowrap relative">
      01 September 2025
      <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
    </td>

    <td class="py-4 px-4 whitespace-nowrap relative">
      07 September 2025
      <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
    </td>

    <td class="py-4 px-4 text-[#2E2E2E] font-medium whitespace-nowrap relative">
      Masih Dipinjam
      <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
    </td>
    
    <td class="py-4 px-4 whitespace-nowrap relative">
  <div class="flex items-center relative">
    <!-- ICON KELUAR BORDER -->
    <span class="iconify text-[#A78C1E] w-4 h-4 absolute -left-4 self-center" data-icon="mdi:clock-outline"></span>

    <!-- BADGE -->
    <span class="inline-flex items-center bg-[#FFF4C6] text-[#A78C1E] px-3 py-1.5 rounded-full text-xs font-semibold min-w-[150px] justify-center shadow-sm">
      Sedang Dipinjam
    </span>
  </div>
</td>
  </tr>

  <!-- Sudah Dikembalikan -->
  <tr class="hover:bg-[#FFF8E8] transition">
    <td class="py-4 px-4 relative min-w-[220px]">
      <div class="flex items-center gap-3">
        <img src="https://placehold.co/60x80" alt="Buku" class="w-[60px] h-[80px] object-cover rounded-lg shadow-lg flex-shrink-0">
        <div class="min-w-0">
          <p class="font-semibold text-sm leading-snug">Judul Buku dolor sit amet, consectetur.</p>
          <p class="text-[#626F47] text-xs font-medium">Penulis Buku</p>
        </div>
      </div>
      <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
    </td>

    <td class="py-4 px-4 whitespace-nowrap relative">
      01 September 2025
      <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
    </td>

    <td class="py-4 px-4 whitespace-nowrap relative">
      07 September 2025
      <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
    </td>

    <td class="py-4 px-4 text-[#2E2E2E] font-medium whitespace-nowrap relative">
      Tepat Waktu
      <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
    </td>

    <td class="py-4 px-4 whitespace-nowrap relative">
  <div class="flex items-center relative">
    <span class="iconify text-[#2F7A2F] w-4 h-4 absolute -left-4 self-center" data-icon="mdi:check"></span>

    <span class="inline-flex items-center bg-[#CCF6C2] text-[#2F7A2F] px-3 py-1.5 rounded-full text-xs font-semibold min-w-[150px] justify-center shadow-sm">
      Sudah Dikembalikan
    </span>
  </div>
</td>
  </tr>

  <!-- Terlambat -->
  <tr class="hover:bg-[#FFF8E8] transition">
    <td class="py-4 px-4 relative min-w-[220px]">
      <div class="flex items-center gap-3">
        <img src="https://placehold.co/60x80" alt="Buku" class="w-[60px] h-[80px] object-cover rounded-lg shadow-lg flex-shrink-0">
        <div class="min-w-0">
          <p class="font-semibold text-sm leading-snug">Judul Buku dolor sit amet, consectetur.</p>
          <p class="text-[#626F47] text-xs font-medium">Penulis Buku</p>
        </div>
      </div>
      <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
    </td>

    <td class="py-4 px-4 whitespace-nowrap relative">
      01 September 2025
      <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
    </td>

    <td class="py-4 px-4 whitespace-nowrap relative">
      07 September 2025
      <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
    </td>

    <td class="py-4 px-4 text-red-600 font-medium whitespace-nowrap relative">
      Telat 9 Hari<br>
      <span class="text-xs text-red-500">Denda: Rp 9.000</span>
      <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
    </td>

    <td class="py-4 px-4 whitespace-nowrap relative">
  <div class="flex items-start relative">
    <span class="iconify text-[#B43131] w-4 h-4 absolute -left-4 mt-1" data-icon="mdi:close"></span>

    <div>
      <span class="inline-flex items-center bg-[#FFD1D1] text-[#B43131] px-3 py-1.5 rounded-full text-xs font-semibold min-w-[150px] justify-center shadow-sm">
        Terlambat
      </span>
      <span class="block mt-1 text-[11px] text-red-500 italic">*Denda Rp 1.000 per hari</span>
    </div>
  </div>
</td>

  </tr>
  <!-- Sudah Dikembalikan -->
  <tr class="hover:bg-[#FFF8E8] transition">
    <td class="py-4 px-4 relative min-w-[220px]">
      <div class="flex items-center gap-3">
        <img src="https://placehold.co/60x80" alt="Buku" class="w-[60px] h-[80px] object-cover rounded-lg shadow-lg flex-shrink-0">
        <div class="min-w-0">
          <p class="font-semibold text-sm leading-snug">Judul Buku dolor sit amet, consectetur.</p>
          <p class="text-[#626F47] text-xs font-medium">Penulis Buku</p>
        </div>
      </div>
      <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
    </td>

    <td class="py-4 px-4 whitespace-nowrap relative">
      01 September 2025
      <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
    </td>

    <td class="py-4 px-4 whitespace-nowrap relative">
      07 September 2025
      <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
    </td>

    <td class="py-4 px-4 text-[#2E2E2E] font-medium whitespace-nowrap relative">
      Tepat Waktu
      <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
    </td>

    <td class="py-4 px-4 whitespace-nowrap relative">
  <div class="flex items-center relative">
    <!-- ICON KELUAR BORDER -->
    <span class="iconify text-[#A78C1E] w-4 h-4 absolute -left-4 self-center" data-icon="mdi:clock-outline"></span>

    <!-- BADGE -->
    <span class="inline-flex items-center bg-[#FFF4C6] text-[#A78C1E] px-3 py-1.5 rounded-full text-xs font-semibold min-w-[150px] justify-center shadow-sm">
      Sedang Dipinjam
    </span>
  </div>
</td>
  </tr>
</tbody>
  </table>
</div>
</main>

@include('layout_dashboard.partial_dashboard.footer')

<!-- script -->
<script src="{{asset('assets_user/js/dashboard.js')}}"></script>
<script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
<script>
  const dropdownButton = document.getElementById('dropdownButton');
  const dropdownMenu = document.getElementById('dropdownMenu');

  dropdownButton.addEventListener('click', function () {
    dropdownMenu.classList.toggle('hidden');
    dropdownButton.querySelector('.iconify').classList.toggle('rotate-180');
  });

  // Klik di luar dropdown → tutup
  document.addEventListener('click', function (e) {
    if (!document.getElementById('dropdownWrapper').contains(e.target)) {
      dropdownMenu.classList.add('hidden');
      dropdownButton.querySelector('.iconify').classList.remove('rotate-180');
    }
  });
</script>

</body>
</html>