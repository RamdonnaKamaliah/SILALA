<?php $__env->startSection('pageTitle', 'Detail Data Buku'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-5xl mx-auto bg-white p-8 rounded-2xl shadow-lg mt-8">
        <!-- Judul Halaman -->
        <!-- Tombol Kembali -->
         <a href="<?php echo e(route('admin.data_buku.index')); ?>" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left"></i>
            </a>

        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">
            📚 Detail Buku
        </h1>

        <!-- Grid Foto & Info Buku -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Kolom Foto -->
            <div class="flex flex-col items-center justify-center">
                <?php if($buku->foto_buku): ?>
                    <img src="<?php echo e(asset($buku->foto_buku)); ?>" alt="Foto Buku"
                        class="w-60 h-80 object-cover rounded-xl shadow-md border border-gray-200 transition-transform hover:scale-105 duration-300">
                <?php else: ?>
                    <div class="w-60 h-80 flex items-center justify-center bg-gray-100 text-gray-400 italic rounded-xl">
                        Tidak ada foto
                    </div>
                <?php endif; ?>

                <?php if($buku->file_buku): ?>
                    <a href="<?php echo e(asset($buku->file_buku)); ?>" target="_blank"
                        class="mt-5 inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition-all">
                        <span>📄 Lihat File PDF</span>
                    </a>
                <?php else: ?>
                    <p class="text-gray-500 italic mt-4">Tidak ada file PDF</p>
                <?php endif; ?>
            </div>

            <!-- Kolom Detail -->
            <div class="space-y-4 text-gray-700">
                <div class="border-l-4 border-blue-600 pl-4">
                    <p><span class="font-semibold text-gray-900">Judul:</span> <?php echo e($buku->judul_buku); ?></p>
                    <p><span class="font-semibold text-gray-900">Penulis:</span> <?php echo e($buku->penulis); ?></p>
                    <p><span class="font-semibold text-gray-900">Penerbit:</span> <?php echo e($buku->penerbit); ?></p>
                    <p><span class="font-semibold text-gray-900">Tahun Terbit:</span> <?php echo e($buku->tahun_terbit); ?></p>
                    <p><span class="font-semibold text-gray-900">Bahasa:</span> <?php echo e($buku->bahasa); ?></p>
                    <p><span class="font-semibold text-gray-900">Kategori:</span> <?php echo e($buku->kategori); ?></p>
                    <p><span class="font-semibold text-gray-900">Jumlah Halaman:</span> <?php echo e($buku->jumlah_halaman); ?></p>
                    <p><span class="font-semibold text-gray-900">Edisi:</span> <?php echo e($buku->edisi); ?></p>
                    <p><span class="font-semibold text-gray-900">Stok:</span> <?php echo e($buku->stok); ?></p>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                    <p class="font-semibold text-gray-900 mb-2">Deskripsi:</p>
                    <p class="text-sm leading-relaxed"><?php echo e($buku->deskripsi); ?></p>
                </div>
            </div>
        </div>


    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/data_buku/show.blade.php ENDPATH**/ ?>