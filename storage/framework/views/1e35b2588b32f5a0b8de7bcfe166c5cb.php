<!-- ====== NAVBAR ====== -->
<nav id="navbar"
  class="fixed top-0 left-0 md:left-[320px] right-0 md:right-3 z-30 
  bg-[#f7edd6] rounded-b-3xl shadow-sm
  px-4 md:px-6 py-6 transition-all duration-300
  h-[55vh] flex flex-col justify-start">

  <?php
      // Proteksi variabel
      $title = $title ?? 'Detail Buku';
      $averageRating = isset($averageRating) ? (float) $averageRating : 0.0;
      $totalRatings = isset($totalRatings) ? (int) $totalRatings : 0;
  ?>

  <!-- ====== Bagian Atas: Judul & Icon ====== -->
  <div class="flex justify-between items-center w-full relative">

    <!-- NAV TITLE + BACK -->
    <div class="absolute left-1/2 transform -translate-x-1/2 flex items-center gap-3 md:static md:transform-none">
  <button id="backBtn"
          class="text-[#626F47] hover:text-[#A4B465] transition-colors duration-300">
    <i class="fa-solid fa-arrow-left text-base md:text-lg"></i>
  </button>

  <h1 class="text-lg md:text-xl font-semibold text-[#626F47]">
    <?php echo e($title ?? 'Detail Buku'); ?>

  </h1>
</div>

    <!-- IKON KANAN -->
    <div class="relative flex items-center gap-4 ml-auto">

      <!-- Button dengan badge counter -->
      <button id="notifButton" class="relative text-netral text-lg">
        <i class="fa-solid fa-bell"></i>
        <!-- Badge untuk jumlah notifikasi -->
        <span id="notificationBadge" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center hidden">
          0
        </span>
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
          <!-- Notifikasi default (jika tidak ada telat) -->
          <div id="defaultNotif" class="notif-item relative flex items-start gap-3 px-5 py-3 hover:bg-gray-50 cursor-pointer group">
            <div class="notif-line absolute left-0 top-0 bottom-0 w-[3px] bg-[#A4B465] rounded-r-full scale-y-0 group-hover:scale-y-100 transition-transform origin-top"></div>
            <div class="w-2 h-2 mt-1 bg-[#A4B465] rounded-full"></div>
            <div class="flex-1">
              <p class="text-sm font-semibold text-[#626F47]">Sistem</p>
              <p class="text-xs text-gray-600">Tidak ada notifikasi baru.</p>
            </div>
            <span class="text-[10px] text-gray-400">Baru saja</span>
          </div>
          
          <!-- Container untuk notifikasi telat (akan diisi via JS) -->
          <div id="notifikasiTelatContainer"></div>
        </div>

        <!-- Footer -->
        <div class="text-center py-3 border-t border-gray-100">
          <a href="<?php echo e(route('user.riwayatbuku')); ?>" class="text-[#626F47] text-sm font-medium hover:text-[#A4B465]">
            Lihat semua aktivitas
          </a>
        </div>
      </div>
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
          src="<?php echo e(asset('storage/' . $buku->foto_buku ?? 'assets/default-cover.jpg')); ?>" 
          alt="<?php echo e($buku->judul_buku); ?>"
          class="w-full h-full object-cover">
      </div>
    </div>

    <!-- Info Buku -->
    <div class="flex flex-col justify-start text-center md:text-left w-full md:w-[60%] z-10">

      <h2 class="block md:hidden text-xl sm:text-2xl font-semibold text-[#2E2E2E] mb-2">
        <?php echo e($buku->judul_buku); ?>

      </h2>

      <h2 class="hidden md:block text-3xl font-semibold text-[#2E2E2E] mb-2">
        <?php echo e($buku->judul_buku); ?>

      </h2>

      <div class="flex flex-col items-center md:items-start -mt-1">
        <p class="text-sm text-[#626F47] mb-1"><?php echo e($buku->penulis); ?></p>

        <!-- RATING NAVBAR -->
<div class="flex justify-center md:justify-start items-center text-[#FACC15] text-sm mb-2 navbar-rating"
    data-average-rating="<?php echo e($averageRating); ?>"
    data-total-ratings="<?php echo e($totalRatings); ?>"
    data-user-rating="<?php echo e($userRating?->rating ?? 0); ?>"> 
    
  <?php for($i = 1; $i <= 5; $i++): ?>
    <?php if($i <= floor($averageRating)): ?>
      <i class="fa-solid fa-star"></i>
    <?php elseif($i - 0.5 <= $averageRating): ?>
      <i class="fa-solid fa-star-half-stroke"></i>
    <?php else: ?>
      <i class="fa-regular fa-star"></i>
    <?php endif; ?>
  <?php endfor; ?>
  
  <?php if($totalRatings > 0): ?>
    <span class="text-xs text-gray-600 ml-2">(<?php echo e(number_format($averageRating, 1)); ?>)</span>
  <?php endif; ?>
</div>

    </div>
  </div>
</nav><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/components/navbardetus.blade.php ENDPATH**/ ?>