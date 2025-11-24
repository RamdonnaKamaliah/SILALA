<?php $__env->startSection('title', 'daftar buku User'); ?>

<?php $__env->startSection('content'); ?>
  <!-- Filter & Search (tetap di atas, tanpa garis) -->
  <div class="bg-cream px-4 md:px-6 py-3 sticky top-0 z-40">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">

<div class="relative w-full md:w-auto" id="kategoriDropdown">
  <!-- Tombol -->
  <button class="w-full md:w-48 px-4 py-2 bg-primary text-white rounded-xl shadow-md font-semibold flex justify-between items-center hover:bg-kuning hover:text-gray-700 transition-all duration-300">
    <span id="kategoriText">Semua Kategori</span>
    <svg class="w-4 h-4 transition-transform duration-200" id="kategoriIcon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
    </svg>
  </button>

 <!-- List Kategori -->
<div id="kategoriMenu" class="hidden absolute w-full md:w-48 mt-2 bg-primary rounded-xl shadow-xl p-2 z-50 border border-[#E2DAC3]">

  <!-- Tombol Semua Kategori di atas -->
  <button data-kategori="Semua" 
    class="kategori-btn block w-full text-left px-4 py-2 text-white font-medium hover:text-gray-900 transition-all rounded-lg mb-2">
    Semua Kategori
  </button>

  <!-- List Kategori dari database -->
  <?php $__currentLoopData = $data_kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <button data-kategori="<?php echo e($kat->nama_kategori); ?>" 
          class="kategori-btn block w-full text-left px-4 py-2 text-white hover:bg-kuning hover:text-gray-900 transition-all rounded-lg">
      <?php echo e($kat->nama_kategori); ?>

  </button>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>

      <!-- Pencarian -->
      <div class="relative w-full sm:w-auto flex justify-center md:justify-end">
  <input type="text" placeholder="Cari Buku..." 
         class="px-5 py-2 w-full sm:w-56 md:w-72 rounded-full 
                bg-white text-gray-900 placeholder-gray-900
                focus:outline-none focus:ring-2 focus:ring-[#8CA86C]
                pr-10 text-sm md:text-base transition-all duration-300
                border-0" />
  <i class="fa-solid fa-magnifying-glass absolute right-3 top-2.5 text-gray-900 text-sm md:text-base"></i>
</div>
    </div>
  </div>

  <!-- Area scroll untuk daftar buku -->
  <div class="flex-1 overflow-y-auto px-2 md:px-4 pt-4 pb-6">
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
      <?php $__currentLoopData = $data_bukus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <!-- Card Buku 8 -->
      <div class="group bg-[#f5ecd6] border border-[#e8dec0] rounded-2xl shadow-md overflow-hidden 
      transition-all duration-700 ease-in-out hover:shadow-lg hover:scale-[1.03] hover:bg-[#faf3df] cursor-pointer flex flex-col items-center pt-4"
     data-kategori-buku="<?php echo e($buku->nama_kategori); ?>"
     data-judul="<?php echo e(strtolower($buku->judul_buku)); ?>">

        <!-- Cover Buku -->
        <div class="relative w-[85%] h-44 md:h-52 bg-white rounded-xl shadow-sm overflow-hidden">
          <?php if($buku->foto_buku): ?>
          <img src="<?php echo e(asset($buku->foto_buku)); ?>" alt="Buku 1" class="w-full h-full object-cover rounded-lg transition-transform duration-700 ease-in-out">
          <?php else: ?>
          <img src="<?php echo e(asset('assets/default-cover.jpg')); ?>" alt="Default Cover" class="w-full h-full object-cover rounded-lg transition-transform duration-700 ease-in-out">
          <div class="absolute right-0 top-0 w-[6px] h-full bg-[#d6d6d6] shadow-inner"></div>
          <?php endif; ?>
        </div>
      
        <!-- Detail Buku -->
        <div class="p-4 flex flex-col items-center text-center space-y-1 transition-all duration-700 ease-in-out">
          <h3 class="font-bold text-[#1E1E1E] text-sm md:text-base leading-snug"><?php echo e($buku->judul_buku); ?></h3>
          <div class="transition-all duration-700 ease-in-out group-hover:opacity-0 group-hover:translate-y-2">
            <p class="text-xs md:text-sm text-gray-600"><?php echo e($buku->penulis); ?></p>
            <div class="flex justify-center text-yellow-400 text-xs md:text-sm space-x-1 mt-1">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star-half-stroke"></i>
              <i class="fa-regular fa-star"></i>
            </div>
          </div>
          <a href="<?php echo e(route('user.detailbuku', $buku->id)); ?>">
            <button
              class="opacity-0 translate-y-3 group-hover:opacity-100 group-hover:translate-y-0 
                    transition-all duration-700 ease-in-out delay-200 
                    bg-[#8CA86C] text-white text-xs md:text-sm px-5 py-1.5 rounded-full 
                    hover:bg-[#6e8a50] hover:scale-105 mt-2">
              Lihat Detail
            </button>
          </a>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_user.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/user/daftarbuku.blade.php ENDPATH**/ ?>