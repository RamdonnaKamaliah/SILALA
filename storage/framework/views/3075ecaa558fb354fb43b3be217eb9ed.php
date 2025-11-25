<!-- Navbar -->
<nav id="navbar"
  class="fixed top-0 left-0 md:left-[320px] right-0 md:right-3 z-40 bg-[#f7edd6]
  rounded-b-3xl shadow-sm flex justify-between items-center
  px-4 md:px-6 py-4 md:py-6 transition-all duration-300">

  <!-- Judul -->
  <h1
    class="absolute left-1/2 transform -translate-x-1/2 text-lg md:text-xl font-semibold text-[#626F47]
    md:static md:transform-none md:translate-x-0">
    <?php echo e($title ?? 'BERANDA'); ?>

  </h1>

  <div class="flex items-center gap-4 ml-auto relative">
<!-- Notifikasi -->
<div class="relative">
  <button id="notifBtn" class="text-[#626F47] text-lg focus:outline-none">
    <i class="fa-solid fa-bell"></i>
  </button>

  <!-- Popup Notifikasi -->
  <div id="notifBox"
       class="absolute right-0 mt-3 w-72 sm:w-80 bg-white rounded-2xl shadow-2xl border border-gray-100 z-50
              opacity-0 pointer-events-none transform -translate-y-2 transition-all duration-300">

    <!-- Header -->
    <div class="flex items-center justify-between px-5 py-3 border-b border-gray-100">
      <div class="flex items-center gap-2">
        <i class="fa-solid fa-bell text-[#A4B465]"></i>
        <h3 class="font-semibold text-gray-700 text-sm">Notifikasi</h3>
      </div>
      <button id="closeNotif" class="text-gray-400 hover:text-gray-600 transition-colors">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <!-- Daftar Notifikasi -->
    <div id="notifList" class="max-h-80 overflow-y-auto divide-y divide-gray-100">
      <!-- Item Notifikasi -->
      <div class="notif-item relative flex items-start gap-3 px-5 py-3 hover:bg-gray-50 cursor-pointer transition group">
        <div class="notif-line absolute left-0 top-0 bottom-0 w-[3px] bg-[#A4B465] rounded-r-full scale-y-0 group-hover:scale-y-100 transition-transform origin-top"></div>
        <div class="w-2 h-2 mt-1 bg-[#A4B465] rounded-full flex-shrink-0"></div>
        <div class="flex-1">
          <p class="text-sm font-semibold text-[#626F47]">Admin</p>
          <p class="text-xs text-gray-600">Buku <b>Buku Saku</b> berhasil disimpan oleh Wildan.</p>
        </div>
        <span class="text-[10px] text-gray-400 whitespace-nowrap">1m</span>
      </div>

      <div class="notif-item relative flex items-start gap-3 px-5 py-3 hover:bg-gray-50 cursor-pointer transition group">
        <div class="notif-line absolute left-0 top-0 bottom-0 w-[3px] bg-[#A4B465] rounded-r-full scale-y-0 group-hover:scale-y-100 transition-transform origin-top"></div>
        <div class="w-2 h-2 mt-1 bg-[#A4B465] rounded-full flex-shrink-0"></div>
        <div class="flex-1">
          <p class="text-sm font-semibold text-[#626F47]">Sistem</p>
          <p class="text-xs text-gray-600">Perpustakaan diperbarui ke versi terbaru.</p>
        </div>
        <span class="text-[10px] text-gray-400 whitespace-nowrap">10m</span>
      </div>

      <div class="notif-item relative flex items-start gap-3 px-5 py-3 hover:bg-gray-50 cursor-pointer transition group">
        <div class="notif-line absolute left-0 top-0 bottom-0 w-[3px] bg-[#A4B465] rounded-r-full scale-y-0 group-hover:scale-y-100 transition-transform origin-top"></div>
        <div class="w-2 h-2 mt-1 bg-[#A4B465] rounded-full flex-shrink-0"></div>
        <div class="flex-1">
          <p class="text-sm font-semibold text-[#626F47]">Admin</p>
          <p class="text-xs text-gray-600">Notifikasi tambahan untuk testing scroll.</p>
        </div>
        <span class="text-[10px] text-gray-400 whitespace-nowrap">15m</span>
      </div>
    </div>

    <!-- Footer -->
    <div class="text-center py-3 border-t border-gray-100">
      <a href="#" class="text-[#626F47] text-sm font-medium hover:text-[#A4B465]">
        Lihat semua aktivitas
      </a>
    </div>
  </div>
</div>

<<<<<<< HEAD
<!-- darkmode -->
    <button onclick="toggleDarkMode()" class="text-[#626F47] text-lg flex items-center gap-2">
    <span class="iconify text-2xl dark:hidden" data-icon="mdi:weather-sunny"></span>
    <span class="iconify text-2xl hidden dark:inline" data-icon="mdi:weather-night"></span>
  </button>
  </div>
</nav>


=======
<!-- Pengaturan -->
    <button class="text-[#626F47] text-lg">
      <i class="fa-solid fa-gear"></i>
    </button>
  </div>
</nav>

>>>>>>> f0747171cd3dd3a038c7f5e52e06862e4f0a8864
<?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/components/navbarUser.blade.php ENDPATH**/ ?>