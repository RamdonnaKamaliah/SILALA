
<?php $__env->startSection('pageTitle', 'Edit Data Kategori'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container mt-4">
        <h2 class="text-xl font-semibold mb-4 text-[#A4B465]">Edit Kategori</h2>


        <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <?php echo e($errors->first()); ?>

    </div>
<?php endif; ?>

<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>


        <form action="<?php echo e(route('admin.data_kategori.update', $kategori->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            
            <div class="mb-4">
                <label for="nama_kategori" class="block text-gray-700 font-semibold mb-2">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" value="<?php echo e(old('nama_kategori', $kategori->nama_kategori)); ?>"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#A4B465]"
                    required>
            </div>

            <button 
    type="submit"
    class="bg-[#A4B465] hover:bg-[#8EA05C] text-white font-semibold px-6 py-2 rounded-xl transition duration-200 shadow-md"
>
    Simpan Perubahan
</button>


        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/data_kategori/edit.blade.php ENDPATH**/ ?>