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

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
  <?php $__currentLoopData = $favorites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="book-card bg-white rounded-xl shadow-md border border-[#E0D6B8] overflow-hidden p-3 flex gap-3 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
    <img src="<?php echo e(asset($fav->buku->foto_buku ?? 'assets/default-cover.jpg')); ?>" class="w-16 h-24 object-cover shadow-md rounded-md flex-shrink-0">
    <div class="flex flex-col justify-between flex-grow">
      <div>
        <p class="book-title text-[#2E2E2E] text-sm font-semibold leading-tight"><?php echo e($fav->buku->judul_buku); ?></p>
        <p class="text-[#626F47] text-xs font-semibold mt-1"><?php echo e($fav->buku->penulis); ?></p>
      </div>
      <div class="border-t border-[#E0D6B8] my-2"></div>
      <div class="flex items-center justify-between">
        <a href="<?php echo e(route('user.baca', $fav->buku->id)); ?>" class="bg-green hover:bg-primary text-white text-xs font-semibold px-6 py-[5px] rounded-full transition">Baca</a>
        <button class="text-red-500 text-lg hover:scale-110 transition" onclick="hapusFavorite(<?php echo e($fav->buku->id); ?>)">
          <i class="fa-solid fa-heart"></i>
        </button>
      </div>
    </div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<script>
async function hapusFavorite(id) {
  await fetch("<?php echo e(route('user.favorit.toggle')); ?>", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
    },
    body: JSON.stringify({ buku_id: id })
  });
  location.reload();
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_user.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SILALA_BPMSPH\resources\views/user/favorit.blade.php ENDPATH**/ ?>