<?php $__env->startSection('pageTitle', 'Admin Dashboard - Data Buku'); ?>
<?php $__env->startSection('content'); ?>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        <?php $__currentLoopData = $media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div
                class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition hover:shadow-lg hover:-translate-y-1">

                
                <div class="w-full h-40">
                    <?php if($item->path_file): ?>
                        <?php if($item->path_file && Storage::disk('public')->exists($item->path_file)): ?>
                            <img src="<?php echo e(asset('storage/' . $item->path_file)); ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <img src="<?php echo e(asset('assets/image_default/image_default_book.jpeg')); ?>"
                                class="w-full h-full object-cover">
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                
                <div class="p-3 flex flex-col gap-2">

                    <p class="text-lg text-gray-700 font-medium truncate">
                        <?php echo e($item->judul_buku ?? 'Tidak ada judul'); ?>

                    </p>

                    
                    <form action="<?php echo e(route('admin.media.destroy', $item->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>

                        <button class="w-full bg-red-500 hover:bg-red-600 text-white text-xs py-1.5 rounded-lg">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views\admin\media\index.blade.php ENDPATH**/ ?>