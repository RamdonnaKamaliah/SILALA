<?php $__env->startSection('title', 'daftar buku User'); ?>

<?php $__env->startSection('content'); ?>
<div class="halaman-daftar-buku">
 <!-- Filter & Search -->
<div class="bg-cream px-4 md:px-6 py-3 sticky top-0 z-40">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">

        <!-- Dropdown Kategori -->
        <div class="relative w-full md:w-auto" id="kategoriDropdown">

            <button class="w-full md:w-48 px-4 py-2 bg-primary text-white rounded-xl shadow-md font-semibold flex justify-between items-center hover:bg-kuning hover:text-gray-700 transition-all duration-300">
                <span id="kategoriText">Semua Kategori</span>
                <svg class="w-4 h-4 transition-transform duration-200" id="kategoriIcon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Menu -->
            <div id="kategoriMenu" 
                 class="hidden absolute left-0 w-full md:w-48 mt-2 z-[9999] bg-primary rounded-xl shadow-xl p-2 border border-[#E2DAC3]">

                <button data-kategori="Semua" 
                        class="kategori-btn block w-full text-left px-4 py-2 text-white font-medium hover:text-gray-900 transition-all rounded-lg mb-2">
                    Semua Kategori
                </button>

                <?php $__currentLoopData = $data_kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button data-kategori="<?php echo e($kat->nama_kategori); ?>" 
                        class="kategori-btn block w-full text-left px-4 py-2 text-white hover:bg-kuning hover:text-gray-900 transition-all rounded-lg">
                    <?php echo e($kat->nama_kategori); ?>

                </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Search -->
        <div class="relative w-full sm:w-auto flex justify-center md:justify-end">
            <input type="text" placeholder="Cari Buku..."
                   class="px-5 py-2 w-full sm:w-56 md:w-72 rounded-full bg-white text-gray-900 placeholder-gray-900
                   focus:outline-none focus:ring-2 focus:ring-[#8CA86C] pr-10 text-sm md:text-base transition-all duration-300">
            <i class="fa-solid fa-magnifying-glass absolute right-3 top-2.5 text-gray-900"></i>
        </div>

    </div>
</div>

<!-- Daftar Buku -->
<div class="flex-1 px-2 md:px-4 pt-4 pb-6">

    <!-- Tampilkan pesan jika kosong -->
        <div id="pesanKosong" class="col-span-full text-center text-gray-500 py-10 hidden">
        Tidak ada buku pada kategori ini.
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">

        <?php $__currentLoopData = $data_bukus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="group bg-[#f5ecd6] border border-[#e8dec0] rounded-2xl shadow-md overflow-hidden 
    transition-all duration-700 ease-in-out hover:shadow-lg hover:scale-[1.03] hover:bg-[#faf3df] 
    cursor-pointer flex flex-col items-center pt-4"
    data-kategori-buku="<?php echo e($buku->nama_kategori); ?>"
    data-judul="<?php echo e(strtolower($buku->judul_buku)); ?>">

    <!-- COVER -->
    <div class="relative w-[85%] h-44 md:h-52 bg-white rounded-xl shadow-sm overflow-hidden">
        <?php if($buku->foto_buku): ?>
            <img src="<?php echo e(asset($buku->foto_buku)); ?>" class="w-full h-full object-cover rounded-lg">
        <?php else: ?>
            <img src="<?php echo e(asset('assets/default-cover.jpg')); ?>" class="w-full h-full object-cover rounded-lg">
            <div class="absolute right-0 top-0 w-[6px] h-full bg-[#d6d6d6] shadow-inner"></div>
        <?php endif; ?>
    </div>

    <!-- KONTEN -->
    <div class="p-4 flex flex-col items-center text-center flex-1 w-full min-h-[150px]">

        <!-- JUDUL -->
        <h3 class="font-bold text-[#1E1E1E] text-sm md:text-base line-clamp-2 h-10">
            <?php echo e($buku->judul_buku); ?>

        </h3>

        <!-- PENULIS -->
        <p class="text-xs md:text-sm text-gray-600 h-5">
            <?php echo e($buku->penulis); ?>

        </p>

        <!-- RATING -->
        <div class="flex justify-center text-yellow-400 text-xs md:text-sm space-x-1 mt-1">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star-half-stroke"></i>
            <i class="fa-regular fa-star"></i>
        </div>

        <!-- BUTTON -->
        <div class="mt-auto pt-2">
            <a href="<?php echo e(route('user.detailbuku', $buku->id)); ?>">
                <button class="bg-[#8CA86C] text-white text-xs md:text-sm px-5 py-1.5 rounded-full 
                               hover:bg-[#6e8a50] hover:scale-105">
                    Lihat Detail
                </button>
            </a>
        </div>
    </div>
</div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_user.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/user/daftarbuku.blade.php ENDPATH**/ ?>