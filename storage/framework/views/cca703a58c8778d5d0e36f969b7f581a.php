<?php $__env->startSection('title', 'Favorit User'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Pencarian -->
    <div class="w-full">
        <div class="relative w-full mb-8">
            <input id="searchBuku" type="text" placeholder="Cari Buku..."
                class="w-full bg-white border border-white rounded-full py-3 px-5 
             text-sm text-green focus:outline-none shadow-sm">
            <span class="absolute right-4 top-3 text-green text-lg">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
        </div>
    </div>

    <!-- Container untuk buku favorit -->
<div id="favorites-container">

    
    <div 
        id="favorites-grid"
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6"
        <?php if($favorites->count() === 0): ?> style="display:none" <?php endif; ?>
    >
        <?php $__currentLoopData = $favorites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="book-card bg-white rounded-xl shadow-md border border-white overflow-hidden p-3 flex gap-3 
                hover:shadow-lg hover:-translate-y-1 transition-all duration-300 cursor-pointer"
                data-url="<?php echo e(route('user.detailbuku', $fav->buku->id)); ?>"
                data-book-id="<?php echo e($fav->buku->id); ?>"
                data-judul="<?php echo e(strtolower($fav->buku->judul_buku)); ?>"
                data-penulis="<?php echo e(strtolower($fav->buku->penulis)); ?>"
            >
                <img src="<?php echo e($fav->buku->foto_buku 
                    ? asset('storage/' . $fav->buku->foto_buku) 
                    : asset('assets/default-cover.jpg')); ?>"
                    class="w-16 h-24 object-cover shadow-md rounded-md flex-shrink-0"
                >

                <div class="flex flex-col justify-between flex-grow">
                    <div>
                        <p class="book-title text-gray-800 text-sm font-semibold leading-tight">
                            <?php echo e($fav->buku->judul_buku); ?>

                        </p>
                        <p class="text-green text-xs font-semibold mt-1">
                            <?php echo e($fav->buku->penulis); ?>

                        </p>
                    </div>

                    <div class="border-t border-gray-400 my-2"></div>

                    <div class="flex items-center justify-between">
                        <button type="button"
                            class=" bg-green text-white text-xs font-semibold px-6 py-[5px] rounded-full"
                            onclick="openPdfModal('<?php echo e(route('user.baca', $fav->buku->id)); ?>')"
                        >
                            Baca
                        </button>

                        <button type="button"
                            class="favorite-btn text-red-500 text-lg"
                            data-book-id="<?php echo e($fav->buku->id); ?>"
                            data-favorit-route="<?php echo e(route('user.favorit.toggle')); ?>"
                        >
                            <i class="fa-solid fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Pesan default saat tidak ada favorit sama sekali -->
    <div 
        id="no-favorites-default"
        class="text-center py-12 <?php echo e($favorites->count() > 0 ? 'hidden' : ''); ?>"
    >
        <div class="text-green text-lg font-semibold mb-2">
            Belum ada buku favorit
        </div>
        <p class="text-gray-500 text-sm">
            Tambahkan buku ke favorit untuk melihatnya di sini
        </p>
    </div>

    <!-- Pesan saat tidak ada hasil pencarian -->
    <div id="no-favorites-search" class="hidden text-center py-12">
        <div class="text-green text-lg font-semibold mb-2">
            Tidak ada buku yang sesuai
        </div>
        <p class="text-gray-500 text-sm">
            Coba gunakan kata kunci lain
        </p>
    </div>

</div>
<!-- MODAL PDF -->
<div id="pdfModal"
     class="fixed inset-0 z-50 hidden bg-black/70 flex items-center justify-center">

    <div
        class="
        relative bg-white flex flex-col w-full h-full md:w-3/4 md:h-[90vh] rounded-none md:rounded-xl overflow-hidden">

        <!-- HEADER -->
        <div
            class="h-12 shrink-0 bg-gray-900 text-white flex items-center justify-between px-4">

            <button
                onclick="closePdfModal()"
                class=" bg-red-500 hover:bg-red-600 w-8 h-8 rounded-full flex items-center justify-center font-bold">
                ✕
            </button>
        </div>

        <!-- PDF -->
        <iframe
            id="pdfFrame" class="flex-1 w-full border-0" loading="lazy">
        </iframe>

    </div>
</div>

    <?php echo csrf_field(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_user.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/user/favorit.blade.php ENDPATH**/ ?>