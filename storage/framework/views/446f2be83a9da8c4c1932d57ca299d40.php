

<?php $__env->startSection('pageTitle', 'Admin Dashboard - Data Buku'); ?>
<?php $__env->startSection('content'); ?>

    <div class="p-6">
        <h2 class="text-2xl font-semibold mb-6">Galeri Foto Buku</h2>

        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5">
            <?php $__empty_1 = true; $__currentLoopData = $gambar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-white shadow rounded-xl overflow-hidden border border-gray-200">

                    <img src="<?php echo e(asset($g->foto_buku)); ?>" class="w-full h-36 object-cover">

                    <div class="p-3">
                        <p class="text-xs text-gray-700 truncate"><?php echo e($g->nama_file); ?></p>

                        <form action="<?php echo e(route('admin.media.destroy', $g->id)); ?>" method="POST" class="mt-3">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>

                            <button
                                class="w-full bg-red-500 hover:bg-red-600 text-white text-xs py-1.5 rounded-lg transition">
                                Hapus
                            </button>
                        </form>
                    </div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-gray-500 col-span-full text-center">Belum ada gambar.</p>
            <?php endif; ?>
        </div>

        <div class="mt-6">
            <?php echo e($gambar->links()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SILALA_BPMSPH\resources\views/admin/media/index.blade.php ENDPATH**/ ?>