<?php $__env->startSection('title', 'Favorit User'); ?>

<?php $__env->startSection('content'); ?>
<!-- Pencarian -->
<div class="w-full">
  <div class="relative w-full mb-8">
    <input id="searchBuku" type="text" placeholder="Cari Buku..." 
      class="w-full bg-white border border-white rounded-full py-3 px-5 
             text-sm text-[#626F47] focus:outline-none shadow-sm">
    <span class="absolute right-4 top-3 text-[#626F47] text-lg">
      <i class="fa-solid fa-magnifying-glass"></i>
    </span>
  </div>
</div>

<!-- Container untuk buku favorit -->
<div id="favorites-container">
  <?php if($favorites->count() > 0): ?>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6" id="favorites-grid">
    <?php $__currentLoopData = $favorites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="book-card bg-white rounded-xl shadow-md border border-[#E0D6B8] overflow-hidden p-3 flex gap-3 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 cursor-pointer"
         data-book-id="<?php echo e($fav->buku->id); ?>"
         data-judul="<?php echo e(strtolower($fav->buku->judul_buku)); ?>"
         data-penulis="<?php echo e(strtolower($fav->buku->penulis)); ?>"
         onclick="window.location.href='<?php echo e(route('user.detailbuku', $fav->buku->id)); ?>'">
      <img src="<?php echo e(asset($fav->buku->foto_buku ?? 'assets/default-cover.jpg')); ?>" 
           class="w-16 h-24 object-cover shadow-md rounded-md flex-shrink-0"
           alt="<?php echo e($fav->buku->judul_buku); ?>">
      <div class="flex flex-col justify-between flex-grow">
        <div>
          <p class="book-title text-[#2E2E2E] text-sm font-semibold leading-tight"><?php echo e($fav->buku->judul_buku); ?></p>
          <p class="text-[#626F47] text-xs font-semibold mt-1"><?php echo e($fav->buku->penulis); ?></p>
        </div>
        <div class="border-t border-[#E0D6B8] my-2"></div>
        <div class="flex items-center justify-between">
          <a href="<?php echo e(route('user.baca', $fav->buku->id)); ?>" 
             class="bg-green hover:bg-primary text-white text-xs font-semibold px-6 py-[5px] rounded-full transition z-10 relative"
             onclick="event.stopPropagation()">Baca</a>
          <button class="favorite-btn text-red-500 text-lg hover:scale-110 transition z-10 relative" 
                  data-book-id="<?php echo e($fav->buku->id); ?>"
                  onclick="hapusFavorite(this, <?php echo e($fav->buku->id); ?>); event.stopPropagation()">
            <i class="fa-solid fa-heart"></i>
          </button>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  
  <!-- Pesan saat tidak ada hasil pencarian -->
  <div id="no-favorites-search" class="hidden text-center py-12">
    <div class="text-[#626F47] text-lg font-semibold mb-2">
      Tidak ada buku yang sesuai
    </div>
    <p class="text-gray-500 text-sm">Coba gunakan kata kunci lain</p>
  </div>
  
  <?php else: ?>
  <!-- Pesan default saat tidak ada favorit sama sekali -->
  <div id="no-favorites-default" class="text-center py-12">
    <div class="text-[#626F47] text-lg font-semibold mb-2">
      Belum ada buku favorit
    </div>
    <p class="text-gray-500 text-sm">Tambahkan buku ke favorit untuk melihatnya di sini</p>
  </div>
  <?php endif; ?>
</div>

<!-- Tambahkan CSRF token di dalam view -->
<?php echo csrf_field(); ?>

<script>
  // Definisikan route untuk menghapus favorit
  const favoritRoute = "<?php echo e(route('user.favorit.toggle')); ?>";
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_user.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/user/favorit.blade.php ENDPATH**/ ?>