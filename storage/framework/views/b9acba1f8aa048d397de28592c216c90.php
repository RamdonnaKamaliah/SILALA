<?php $__env->startSection('pageTitle', 'Admin Dashboard - Data CMS'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-6 space-y-6">

    
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Pengaturan Gambar CMS</h1>
        <p class="text-sm text-gray-500">Kelola aset visual website & dashboard</p>
    </div>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        
        <?php
            function cardStart($title) {
                echo '<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 flex flex-col justify-between">';
                echo '<h2 class="text-sm font-semibold text-gray-700 mb-3">'.$title.'</h2>';
            }
            function cardEnd() {
                echo '</div>';
            }
        ?>

        
        <?php cardStart('Hero Section'); ?>
            <?php if($heroImage): ?>
                <img src="<?php echo e(asset('storage/cms/' . $heroImage)); ?>"
                     class="w-full h-36 object-contain bg-gray-50 rounded-lg mb-3">
            <?php else: ?>
                <div class="w-full h-36 flex items-center justify-center bg-gray-50 rounded-lg text-sm text-gray-400 mb-3">
                    Belum ada gambar
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.cms_admin.updateHero')); ?>" method="POST" enctype="multipart/form-data" class="space-y-2">
                <?php echo csrf_field(); ?>
                <input type="file" name="hero_image" class="w-full text-sm">
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 rounded-lg transition">
                    Simpan
                </button>
            </form>
        <?php cardEnd(); ?>

        
        <?php
            $footerLogo = \App\Models\Setting::getValue('footer_logo', 'logo_kementan.png');
            $logoExists = Storage::disk('public')->exists('cms/' . $footerLogo);
        ?>

        <?php cardStart('Logo Footer'); ?>
            <?php if($logoExists): ?>
                <img src="<?php echo e(Storage::url('cms/' . $footerLogo)); ?>"
                     class="w-full h-36 object-contain bg-gray-50 rounded-lg mb-3">
            <?php else: ?>
                <div class="w-full h-36 flex items-center justify-center bg-gray-50 rounded-lg text-sm text-gray-400 mb-3">
                    Default logo digunakan
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.cms_admin.updateFooterLogo')); ?>" method="POST" enctype="multipart/form-data" class="space-y-2">
                <?php echo csrf_field(); ?>
                <input type="file" name="footer_logo" class="w-full text-sm">
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 rounded-lg transition">
                    Simpan
                </button>
            </form>
        <?php cardEnd(); ?>

        
        <?php
            $heroBg = \App\Models\Setting::getValue('hero_bg', 'background.png');
        ?>

        <?php cardStart('Background Hero Landing'); ?>
            <img
                src="<?php echo e(Storage::disk('public')->exists('cms/' . $heroBg) ? Storage::url('cms/' . $heroBg) : asset('assets/background.png')); ?>"
                class="w-full h-36 object-cover bg-gray-50 rounded-lg mb-3">

            <form action="<?php echo e(route('admin.cms_admin.updateHeroBg')); ?>" method="POST" enctype="multipart/form-data" class="space-y-2">
                <?php echo csrf_field(); ?>
                <input type="file" name="hero_bg" class="w-full text-sm">
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 rounded-lg transition">
                    Simpan
                </button>
            </form>
        <?php cardEnd(); ?>

        
        <?php
            $adminSidebarLogo = \App\Models\Setting::getValue('admin_sidebar_logo');
        ?>

        <?php cardStart('Logo Sidebar Admin'); ?>
            <?php if($adminSidebarLogo && Storage::disk('public')->exists('cms/' . $adminSidebarLogo)): ?>
                <img src="<?php echo e(Storage::url('cms/' . $adminSidebarLogo)); ?>"
                     class="w-full h-36 object-contain bg-gray-50 rounded-lg mb-3">
            <?php else: ?>
                <div class="w-full h-36 flex items-center justify-center bg-gray-50 rounded-lg text-sm text-gray-400 mb-3">
                    Logo default digunakan
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('admin.cms_admin.updateAdminSidebarLogo')); ?>" method="POST" enctype="multipart/form-data" class="space-y-2">
                <?php echo csrf_field(); ?>
                <input type="file" name="admin_sidebar_logo" class="w-full text-sm">
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 rounded-lg transition">
                    Simpan
                </button>
            </form>
        <?php cardEnd(); ?>

        
        <?php
            $footerdash = \App\Models\Setting::getValue('footerdash', 'logo_kementan.png');
            $footerdashPath = Storage::disk('public')->exists('cms/' . $footerdash)
                ? Storage::url('cms/' . $footerdash)
                : asset('assets/logo_kementan.png');
        ?>

        <?php cardStart('Logo Footer Dashboard'); ?>
            <img src="<?php echo e($footerdashPath); ?>"
                 class="w-20 h-20 mx-auto object-contain bg-gray-50 rounded-lg mb-3">

            <form action="<?php echo e(route('admin.cms_admin.updateFooterDash')); ?>" method="POST" enctype="multipart/form-data" class="space-y-2">
                <?php echo csrf_field(); ?>
                <input type="file" name="footerdash" class="w-full text-sm">
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 rounded-lg transition">
                    Simpan
                </button>
            </form>
        <?php cardEnd(); ?>

        <?php
    $sidebarLogo = \App\Models\Setting::getValue('sidebar_logo', null);
?>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 flex flex-col justify-between">
    <h2 class="text-sm font-semibold text-gray-700 mb-3">
        Logo Sidebar Landing
    </h2>

    <?php if($sidebarLogo && Storage::disk('public')->exists('cms/' . $sidebarLogo)): ?>
        <img src="<?php echo e(Storage::url('cms/' . $sidebarLogo)); ?>"
             class="w-full h-36 object-contain bg-gray-50 rounded-lg mb-3">
    <?php else: ?>
        <div class="w-full h-36 flex items-center justify-center bg-gray-50 rounded-lg text-sm text-gray-400 mb-3">
            Logo default digunakan
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.cms_admin.updateSidebarLogo')); ?>"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-2">
        <?php echo csrf_field(); ?>

        <input type="file" name="sidebar_logo" class="w-full text-sm">

        <button
            class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm py-2 rounded-lg transition">
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

<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views\admin\cms_admin\index.blade.php ENDPATH**/ ?>