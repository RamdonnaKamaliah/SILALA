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
                    data-url="<?php echo e(route('user.baca', $data->buku->id)); ?>" data-title="<?php echo e($data->buku->judul_buku); ?>"
                    onclick="event.preventDefault(); event.stopPropagation()">
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
    <!-- ====== MODAL PDF ====== -->
    <div id="pdfModal"
        class="
    fixed inset-0 bg-black/50 backdrop-blur-md z-[99999] flex items-center justify-center p-4 <?php echo e($showPdfModal ?? false ? '' : 'hidden'); ?> ">
        <div
            class="bg-white w-full max-w-6xl h-[93vh] rounded-[32px] shadow-2xl overflow-hidden flex flex-col border border-gray-300 sm:p-0 p-2">
            <div
                class="w-full bg-gradient-to-r from-gray-50 to-gray-200 px-6 py-4 border-b flex justify-between items-center shadow-sm">
                <h2 id="pdfTitle" class="text-xl font-bold text-gray-700 flex items-center gap-3">
                    <span class="iconify" data-icon="mdi:file-document-outline" data-width="26"></span>
                    Preview Dokumen
                </h2>
                <button id="closePdfModal" class="p-2 text-[22px] text-gray-600 hover:text-red-600 transition">
                    <span class="iconify" data-icon="mdi:close" data-width="22"></span>
                </button>
            </div>

            <div class="w-full bg-white border-b px-6 py-3 flex items-center gap-6 shadow-sm">
                <div class="flex items-center gap-3">
                    <button id="zoomOut"
                        class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-200 hover:bg-gray-300 transition shadow-sm text-gray-700">
                        <span class="iconify" data-icon="mdi:magnify-minus-outline" data-width="22"></span>
                    </button>
                    <button id="zoomIn"
                        class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-200 hover:bg-gray-300 transition shadow-sm text-gray-700">
                        <span class="iconify" data-icon="mdi:magnify-plus-outline" data-width="22"></span>
                    </button>
                    <span id="zoomLabel" class="font-semibold text-gray-700 text-sm ml-2">100%</span>
                </div>
                <span class="ml-auto text-sm text-gray-700 bg-gray-100 px-3 py-1.5 rounded-lg shadow-inner">
                    Halaman: <span id="pageCurrent" class="font-bold">1</span> / <span id="pageTotal"
                        class="font-bold">0</span>
                </span>
            </div>

            <div id="pdfViewer" class="flex-1 overflow-y-auto bg-gray-50 scroll-smooth p-4"></div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_user.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/user/riwayatbaca.blade.php ENDPATH**/ ?>