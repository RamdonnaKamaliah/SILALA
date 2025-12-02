<!-- ====== NAVBAR ====== -->
<nav id="navbar"
     class="fixed top-0 left-0 md:left-[320px] right-0 md:right-3 z-40 
            bg-[#f7edd6] rounded-b-3xl shadow-sm
            px-4 md:px-6 py-6 transition-all duration-300
            h-[55vh] flex flex-col justify-start">

  <?php
      $title = $title ?? 'Detail Buku';
      $averageRating = isset($averageRating) ? (float) $averageRating : 0.0;
      $totalRatings = isset($totalRatings) ? (int) $totalRatings : 0;
      $userId = Auth::id();
      $userBorrow = \App\Models\DataPeminjam::where('user_id', $userId)
                      ->where('buku_id', $buku->id)
                      ->where('status', 'dipinjam')
                      ->first();
  ?>

  <!-- ====== Bagian Atas: Judul & Icon ====== -->
  <div class="flex justify-between items-center w-full relative">

    <!-- NAV TITLE + BACK -->
    <div class="absolute left-1/2 transform -translate-x-1/2 flex items-center gap-3 md:static md:transform-none">
      <button id="backBtn"
              class="text-[#626F47] hover:text-[#A4B465] transition-colors duration-300">
        <i class="fa-solid fa-arrow-left text-base md:text-lg"></i>
      </button>
      <h1 class="text-lg md:text-xl font-semibold text-[#626F47]"><?php echo e($title); ?></h1>
    </div>

    <!-- IKON KANAN -->
    <div class="relative flex items-center gap-4 ml-auto">
      <button id="notifBtn" class="text-[#626F47] text-lg focus:outline-none">
        <i class="fa-solid fa-bell"></i>
      </button>
      <div id="notifBox"
           class="absolute right-0 top-full mt-3 w-72 sm:w-80 bg-white rounded-2xl shadow-2xl 
                  border border-gray-100 z-[10000] opacity-0 pointer-events-none 
                  transform scale-95 transition-all duration-300 origin-top">
        <div class="flex items-center justify-between px-5 py-3 border-b border-gray-100">
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-bell text-[#A4B465]"></i>
            <h3 class="font-semibold text-gray-700 text-sm">Notifikasi</h3>
          </div>
          <button id="closeNotif" class="text-gray-400 hover:text-gray-600 transition">
            <i class="fa-solid fa-xmark"></i>
          </button>
        </div>
        <div id="notifList" class="max-h-80 overflow-y-auto divide-y divide-gray-100">
          
        </div>
        <div class="text-center py-3 border-t border-gray-100">
          <a href="#" class="text-[#626F47] text-sm font-medium hover:text-[#A4B465]">
            Lihat semua aktivitas
          </a>
        </div>
      </div>

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
          src="<?php echo e(asset($buku->foto_buku ?? 'assets/default-cover.jpg')); ?>" 
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

        <!-- RATING TERUPDATE -->
        <div class="flex justify-center md:justify-start items-center text-[#FACC15] text-sm mb-2" id="navbarRating" data-average="<?php echo e($averageRating); ?>" data-total="<?php echo e($totalRatings); ?>">
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

      <?php if($userBorrow): ?>
      <div class="mt-2">
        <div class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">
          <i class="fa-solid fa-clock"></i>
          Anda sedang meminjam buku ini
        </div>
        <p class="text-xs text-gray-600 mt-1">
          Batas pengembalian: <?php echo e(\Carbon\Carbon::parse($userBorrow->tanggal_kembali)->timezone('Asia/Jakarta')->translatedFormat('d F Y')); ?>

        </p>
      </div>
      <?php endif; ?>

    </div>
  </div>
</nav>
<?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/components/navbardetus.blade.php ENDPATH**/ ?>