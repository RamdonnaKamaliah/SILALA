<?php $__env->startSection('title', 'riwayat baca User'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Filter -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div class="flex flex-col sm:flex-row gap-6">
            <div class="flex flex-col gap-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="riwayat" id="pinjam" class="accent-green"
                        <?php if(request()->is('riwayatbuku')): ?> checked <?php endif; ?> onclick="window.location.href='/riwayatbuku'">
                    <span class="text-green font-semibold text-sm">Riwayat Pinjam</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="riwayat" id="baca" class="accent-green"
                        <?php if(request()->is('riwayatbaca')): ?> checked <?php endif; ?> onclick="window.location.href='/riwayatbaca'">
                    <span class="text-green font-semibold text-sm">Riwayat Baca</span>
                </label>
            </div>
        </div>

        <!-- Input Pencarian Riwayat Baca -->
        <div class="relative w-full md:w-64">
            <input type="text" placeholder="Cari di riwayat baca..." id="search-riwayat"
                class="w-full rounded-full bg-white border border-yellow-100 pl-4 pr-10 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-yellow-200" />
            <span class="iconify absolute right-3 top-1/2 -translate-y-1/2 text-green" data-icon="mdi:magnify"
                style="font-size:20px;"></span>
        </div>
    </div>

    <!-- Grid Buku -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-5 lg:gap-6"
        id="riwayat-container">
        <?php $__empty_1 = true; $__currentLoopData = $riwayat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('user.detailbuku', ['id' => $data->buku->id, 'from' => 'riwayatbaca'])); ?>"
                class="riwayat-card bg-white rounded-xl p-3 shadow-sm
       flex flex-col
       transition-transform duration-300 sm:hover:scale-105
       hover:no-underline group"
                data-judul="<?php echo e(strtolower($data->buku->judul_buku ?? '')); ?>"
                data-penulis="<?php echo e(strtolower($data->buku->penulis ?? '')); ?>">
                <div class="aspect-[3/4] w-full overflow-hidden rounded-lg bg-gray-100">
                    <img src="<?php echo e(asset('storage/' . $data->buku->foto_buku ?? 'assets/default-cover.jpg')); ?>"
                        alt="<?php echo e($data->buku->judul_buku); ?>"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>

                <p
                    class="text-[#2E2E2E] text-center font-semibold text-sm mt-2 group-hover:text-green transition-colors duration-200">
                    <?php echo e($data->buku->judul_buku ?? '-'); ?>

                </p>
                <p class="text-[#2E2E2E] text-center text-xs">
                    By <?php echo e($data->buku->penulis ?? '-'); ?>

                </p>

                <div class="flex justify-center mt-1 text-yellow-400 text-xs">
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <?php if($i <= floor($data->buku->average_rating)): ?>
                            <i class="fa-solid fa-star"></i>
                        <?php elseif($i - 0.5 <= $data->buku->average_rating): ?>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        <?php else: ?>
                            <i class="fa-regular fa-star"></i>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php if($data->buku->total_ratings > 0): ?>
                        <span
                            class="text-gray-600 text-xs ml-1">(<?php echo e(number_format($data->buku->average_rating, 1)); ?>)</span>
                    <?php endif; ?>
                </div>

                <p class="text-center text-xs text-gray-500 mt-1">
                    Terakhir dibaca: <?php echo e($data->terakhir_dibaca ? $data->terakhir_dibaca->diffForHumans() : '-'); ?>

                </p>

                <!-- 🔗 Tombol "Lanjutkan Baca" -->
                <button type="button"
                    class="open-pdf bg-green hover:bg-primary text-white
         font-semibold text-xs
         px-4 py-1 rounded-full
         mx-auto block mt-auto
         shadow transition-colors duration-200"
                    onclick="OpenPDFModal('<?php echo e(route('user.baca', $data->buku->id)); ?>')">
                    Lanjutkan Baca
                </button>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <!-- Tampilan default saat tidak ada riwayat -->
            <div class="no-riwayat-default text-center py-12 col-span-full">
                <div class="text-green text-lg font-semibold mb-2">
                    Belum ada riwayat baca
                </div>
                <p class="text-gray-500 text-sm">Silakan baca buku terlebih dahulu</p>
            </div>
        <?php endif; ?>

        <!-- Tampilan saat pencarian tidak menemukan hasil -->
        <div id="no-search-results" class="hidden text-center py-12 col-span-full">
            <div class="text-green text-lg font-semibold mb-2">
                Tidak ada buku yang sesuai
            </div>
            <p class="text-gray-500 text-sm">Coba gunakan kata kunci lain</p>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_user.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/user/riwayatbaca.blade.php ENDPATH**/ ?>