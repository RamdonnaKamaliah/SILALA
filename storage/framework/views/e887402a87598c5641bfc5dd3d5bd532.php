<?php $__env->startSection('title', 'riwayat baca User'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Filter -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
      <div class="flex flex-col sm:flex-row gap-6">
        <div class="flex flex-col gap-2">
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="radio" name="riwayat" id="pinjam"
              class="accent-[#626F47]"
              <?php if(request()->is('riwayatbuku')): ?> checked <?php endif; ?>
              onclick="window.location.href='/riwayatbuku'">
            <span class="text-[#626F47] font-semibold text-sm">Riwayat Pinjam</span>
          </label>

          <label class="flex items-center gap-2 cursor-pointer">
            <input type="radio" name="riwayat" id="baca"
              class="accent-[#626F47]"
              <?php if(request()->is('riwayatbaca')): ?> checked <?php endif; ?>
              onclick="window.location.href='/riwayatbaca'">
            <span class="text-[#626F47] font-semibold text-sm">Riwayat Baca</span>
          </label>
        </div>
      </div>

      <!-- Input Pencarian -->
      <div class="relative w-full md:w-64">
        <input type="text" placeholder="Cari Buku..."
          class="w-full rounded-full bg-white border border-[#E0D6B8] pl-4 pr-10 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#C5B78B]" />
        <span class="iconify absolute right-3 top-1/2 -translate-y-1/2 text-[#626F47]" data-icon="mdi:magnify" style="font-size:20px;"></span>
      </div>
    </div>

    <!-- Grid Buku -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
      <?php $__empty_1 = true; $__currentLoopData = $riwayat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="transition-transform duration-300 hover:scale-105 bg-white rounded-xl p-3 shadow-sm">
        <div class="aspect-[3/4] w-full overflow-hidden rounded-lg bg-gray-100">
          <img src="<?php echo e(asset($data->buku->foto_buku ?? 'assets/default-cover.jpg')); ?>" 
               alt="<?php echo e($data->buku->judul_buku); ?>" 
               class="w-full h-full object-cover">
        </div>

        <p class="text-[#2E2E2E] text-center font-semibold text-sm mt-2">
          <?php echo e($data->buku->judul_buku ?? '-'); ?>

        </p>
        <p class="text-[#2E2E2E] text-center text-xs">
          By <?php echo e($data->buku->penulis ?? '-'); ?>

        </p>

        <div class="flex justify-center mt-1 text-yellow-400">
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star-half-stroke"></i>
          <i class="fa-regular fa-star"></i>
        </div>

        <p class="text-center text-xs text-gray-500 mt-1">
          Terakhir dibaca: <?php echo e($data->terakhir_dibaca ? $data->terakhir_dibaca->diffForHumans() : '-'); ?>

        </p>

        <a href="<?php echo e(asset($data->buku->file_buku)); ?>" target="_blank">
          <button class="bg-green hover:bg-primary text-white font-semibold text-xs px-4 py-1 rounded-full mx-auto block mt-3 shadow transition-colors duration-200">
            Lanjutkan Baca
          </button>
        </a>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <p class="text-gray-500 col-span-full text-center mt-8">Belum ada riwayat baca.</p>
      <?php endif; ?>
    </div>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_user.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/user/riwayatbaca.blade.php ENDPATH**/ ?>