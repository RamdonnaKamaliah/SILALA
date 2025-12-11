<!-- ====== NAVBAR ====== -->
<nav id="navbar"
  class="fixed top-0 left-0 md:left-[320px] right-0 md:right-3 z-40 
  bg-[#f7edd6] rounded-b-3xl shadow-sm
  px-4 md:px-6 py-6 transition-all duration-300
  h-[55vh] flex flex-col justify-start">

  @php
      // Proteksi variabel
      $title = $title ?? 'Detail Buku';
      $averageRating = isset($averageRating) ? (float) $averageRating : 0.0;
      $totalRatings = isset($totalRatings) ? (int) $totalRatings : 0;
  @endphp

  <!-- ====== Bagian Atas: Judul & Icon ====== -->
  <div class="flex justify-between items-center w-full relative">

    <!-- NAV TITLE + BACK -->
    <div class="absolute left-1/2 transform -translate-x-1/2 flex items-center gap-3 md:static md:transform-none">
  <button id="backBtn"
          class="text-[#626F47] hover:text-[#A4B465] transition-colors duration-300">
    <i class="fa-solid fa-arrow-left text-base md:text-lg"></i>
  </button>

  <h1 class="text-lg md:text-xl font-semibold text-[#626F47]">
    {{ $title ?? 'Detail Buku' }}
  </h1>
</div>

    <!-- IKON KANAN -->
    <div class="relative flex items-center gap-4 ml-auto">

      <!-- Notifikasi -->
      <button id="notifBtn" class="text-[#626F47] text-lg focus:outline-none">
        <i class="fa-solid fa-bell"></i>
      </button>

      <!-- Popup Notifikasi -->
      <div id="notifBox"
           class="absolute right-0 top-full mt-3 w-72 sm:w-80 bg-white rounded-2xl shadow-2xl 
                  border border-gray-100 z-[10000] opacity-0 pointer-events-none 
                  transform scale-95 transition-all duration-300 origin-top">

        <!-- Header -->
        <div class="flex items-center justify-between px-5 py-3 border-b border-gray-100">
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-bell text-[#A4B465]"></i>
            <h3 class="font-semibold text-gray-700 text-sm">Notifikasi</h3>
          </div>

          <button id="closeNotif" class="text-gray-400 hover:text-gray-600 transition">
            <i class="fa-solid fa-xmark"></i>
          </button>
        </div>

        <!-- List Notifikasi -->
        <div id="notifList" class="max-h-80 overflow-y-auto divide-y divide-gray-100">

          <!-- NOTIF 1 -->
          <div class="notif-item relative flex items-start gap-3 px-5 py-3 hover:bg-gray-50 cursor-pointer transition group">
            <div class="notif-line absolute left-0 top-0 bottom-0 w-[3px] bg-[#A4B465] rounded-r-full scale-y-0 group-hover:scale-y-100 transition-transform origin-top"></div>
            <div class="w-2 h-2 mt-1 bg-[#A4B465] rounded-full"></div>
            <div class="flex-1">
              <p class="text-sm font-semibold text-[#626F47]">Admin</p>
              <p class="text-xs text-gray-600">Buku <b>Buku Saku</b> berhasil disimpan oleh Wildan.</p>
            </div>
            <span class="text-[10px] text-gray-400">1m</span>
          </div>

          <!-- NOTIF 2 -->
          <div class="notif-item relative flex items-start gap-3 px-5 py-3 hover:bg-gray-50 cursor-pointer transition group">
            <div class="notif-line absolute left-0 top-0 bottom-0 w-[3px] bg-[#A4B465] rounded-r-full scale-y-0 group-hover:scale-y-100 transition-transform origin-top"></div>
            <div class="w-2 h-2 mt-1 bg-[#A4B465] rounded-full"></div>
            <div class="flex-1">
              <p class="text-sm font-semibold text-[#626F47]">Sistem</p>
              <p class="text-xs text-gray-600">Perpustakaan diperbarui ke versi terbaru.</p>
            </div>
            <span class="text-[10px] text-gray-400">10m</span>
          </div>

        </div>

        <!-- Footer -->
        <div class="text-center py-3 border-t border-gray-100">
          <a href="#" class="text-[#626F47] text-sm font-medium hover:text-[#A4B465]">
            Lihat semua aktivitas
          </a>
        </div>
      </div>

      <!-- DARK MODE -->
      <button id="darkModeBtn" class="text-[#626F47] text-lg flex items-center gap-2">
        <span class="iconify text-2xl dark:hidden" data-icon="mdi:weather-sunny"></span>
        <span class="iconify text-2xl hidden dark:inline" data-icon="mdi:weather-night"></span>
      </button>

    </div>
  </div>

  <!-- ====== Bagian Tengah: Cover & Info ====== -->
  <div class="flex flex-col md:flex-row items-start justify-center 
              gap-6 md:gap-8 w-full max-w-4xl mx-auto relative 
              mt-[50px] md:mt-8 px-4">

    <!-- Cover Buku -->
    <div class="relative w-32 sm:w-40 md:w-52 mx-auto md:mx-0 -mt-4 md:mt-0 z-10">
      <div class="w-full aspect-[3/4] overflow-hidden rounded-md shadow-2xl shadow-gray-500/60">
        <img 
          src="{{ asset($buku->foto_buku ?? 'assets/default-cover.jpg') }}" 
          alt="{{ $buku->judul_buku }}"
          class="w-full h-full object-cover">
      </div>
    </div>

    <!-- Info Buku -->
    <div class="flex flex-col justify-start text-center md:text-left w-full md:w-[60%] z-10">

      <h2 class="block md:hidden text-xl sm:text-2xl font-semibold text-[#2E2E2E] mb-2">
        {{ $buku->judul_buku }}
      </h2>

      <h2 class="hidden md:block text-3xl font-semibold text-[#2E2E2E] mb-2">
        {{ $buku->judul_buku }}
      </h2>

      <div class="flex flex-col items-center md:items-start -mt-1">
        <p class="text-sm text-[#626F47] mb-1">{{ $buku->penulis }}</p>

        <!-- RATING NAVBAR -->
<div class="flex justify-center md:justify-start items-center text-[#FACC15] text-sm mb-2 navbar-rating"
    data-average-rating="{{ $averageRating }}"
    data-total-ratings="{{ $totalRatings }}"
    data-user-rating="{{ $userRating?->rating ?? 0 }}"> 
    
  @for($i = 1; $i <= 5; $i++)
    @if($i <= floor($averageRating))
      <i class="fa-solid fa-star"></i>
    @elseif($i - 0.5 <= $averageRating)
      <i class="fa-solid fa-star-half-stroke"></i>
    @else
      <i class="fa-regular fa-star"></i>
    @endif
  @endfor
  
  @if($totalRatings > 0)
    <span class="text-xs text-gray-600 ml-2">({{ number_format($averageRating, 1) }})</span>
  @endif
</div>

    </div>
  </div>
</nav>
