<?php $__env->startSection('pageTitle', 'Admin Dashboard - Data CMS'); ?>

<?php $__env->startSection('content'); ?>

<div class="p-6">

    <h1 class="text-2xl font-semibold mb-6">Pengaturan Gambar CMS</h1>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        
        
        
        <div class="p-4 bg-white rounded-lg shadow border">
            <h2 class="font-semibold mb-3 text-sm">Hero Section</h2>

            
            <?php if($heroImage): ?>
                <img src="<?php echo e(asset('storage/cms/' . $heroImage)); ?>" 
                     alt="Hero Image" 
                     class="w-full h-32 object-contain bg-gray-100 rounded mb-3">
            <?php else: ?>
                <div class="w-full h-32 bg-gray-100 flex items-center justify-center rounded text-gray-500 text-sm">
                    Belum ada gambar
                </div>
            <?php endif; ?>

            
            <form action="<?php echo e(route('admin.cms_admin.updateHero')); ?>" 
                  method="POST" 
                  enctype="multipart/form-data"
                  class="space-y-2">
                <?php echo csrf_field(); ?>

                <input type="file" name="hero_image" accept="image/*" class="text-sm">

                <button class="w-full bg-blue-600 text-white py-1.5 text-sm rounded hover:bg-blue-700 transition">
                    Simpan
                </button>
            </form>
        </div>



        
        
        
        <?php
            $footerLogo = \App\Models\Setting::getValue('footer_logo', 'logo_kementan.png');
            $logoExists = Storage::disk('public')->exists('cms/' . $footerLogo);
        ?>

        <div class="p-4 bg-white rounded-lg shadow border">
            <h2 class="font-semibold mb-3 text-sm">Logo Footer</h2>

            
            <?php if($logoExists): ?>
                <img src="<?php echo e(Storage::url('cms/' . $footerLogo)); ?>" 
                     alt="Footer Logo" 
                     class="w-full h-32 object-contain bg-gray-100 rounded mb-3">
            <?php else: ?>
                <div class="w-full h-32 bg-gray-100 flex items-center justify-center rounded text-gray-500 text-sm">
                    Default logo digunakan
                </div>
            <?php endif; ?>

            
            <form action="<?php echo e(route('admin.cms_admin.updateFooterLogo')); ?>" 
                  method="POST" 
                  enctype="multipart/form-data"
                  class="space-y-2">
                <?php echo csrf_field(); ?>

                <input type="file" name="footer_logo" accept="image/*" class="text-sm">

                <button class="w-full bg-blue-600 text-white py-1.5 text-sm rounded hover:bg-blue-700 transition">
                    Simpan
                </button>
            </form>
        </div>

        
        
        
        
        
        

    </div>
</div>



<?php if(session('success')): ?>
<script>
    Swal.fire({
        icon: "success",
        title: "Berhasil!",
        text: "<?php echo e(session('success')); ?>",
        timer: 1800,
        showConfirmButton: false,
    });
</script>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/cms_admin/index.blade.php ENDPATH**/ ?>