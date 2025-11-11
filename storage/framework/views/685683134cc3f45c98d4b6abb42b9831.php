<?php $__env->startSection('pageTitle', 'Tambah Kategori'); ?>
<?php $__env->startSection('content'); ?>

<?php $__errorArgs = ['nama_kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="text-danger"><?php echo e($message); ?></div>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <div class="w-fullflex justify-center">
        <div class="max-w-3xl w-full bg-white rounded-2xl shadow-lg p-8 mt-10 border border-gray-200">
            <a href="<?php echo e(route('admin.data_kategori.index')); ?>" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left"></i>
            </a>





            <h2 class="text-3xl font-bold text-primary mb-8 text-center tracking-wide">
                📚 Tambah Kategori Baru
            </h2>

            <form action="<?php echo e(route('admin.data_kategori.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?php echo csrf_field(); ?>


               
                <!-- Nama Kategori -->
                <div>
                    <label for="nama_kategori" class="block text-gray-700 font-semibold mb-2">Nama Kategori</label>
                    <input type="text" id="nama_kategori" name="nama_kategori" placeholder="Masukkan nama kategori"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50
                           focus:outline-none focus:ring-2 focus:ring-[#A4B465] placeholder-gray-400 transition duration-200"
                        required>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="bg-blue-500 text-black px-8 py-3 rounded-xl font-semibold shadow-md 
                           hover:bg-blue-600 hover:shadow-lg transition duration-200">
                        💾 Simpan Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/data_kategori/create.blade.php ENDPATH**/ ?>