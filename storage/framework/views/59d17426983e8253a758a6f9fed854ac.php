<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo $__env->make('layout_admin.partial_admin.link', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>

</head>

<body class="overflow-x-hidden bg-gray-50 min-h-screen">

    
    <?php echo $__env->make('layout_admin.partial_admin.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
   <main
    class="min-h-screen transition-all duration-300 pt-24 px-4 sm:px-6 bg-gray-50 main-bg
         lg:ml-64 lg:w-[calc(100%-16rem)] w-full overflow-hidden">
        <div class="max-w-full">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

    <!-- Plugins -->
    <script src="<?php echo e(asset('/assets_admin/js/plugins/chartjs.min.js')); ?>" async></script>
    <script src="<?php echo e(asset('/assets_admin/js/plugins/perfect-scrollbar.min.js')); ?>" async></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="<?php echo e(asset('assets_admin/js/data table/dataTable.js')); ?>"></script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    
    <!-- Analytics -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTable -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Global tidak bercabang -->
    <script src="<?php echo e(asset('assets_admin/js/dashboard/index.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_admin/js/data_pengguna/pengguna.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_admin/js/data_peminjam/peminjam.js')); ?>"></script>

    <!-- Data Buku -->
    <script src="<?php echo e(asset('assets_admin/js/dataBuku/ModalPlilhMedia.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_admin/js/dataBuku/deleteArsip.js')); ?>"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="<?php echo e(asset('/assets_admin/js/create-databuku.js')); ?>"></script>
    
    <script src="<?php echo e(asset('assets_admin/js/dataBuku/edit.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    
    <script src="<?php echo e(asset('assets_admin/js/dataBuku/index.js')); ?>"></script>
    
    <!-- Arsip Buku -->
    <script src="<?php echo e(asset('assets_admin/js/arsipBuku/deleteArsip.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_admin/js/arsipBuku/index.js')); ?>"></script>

    <!-- Kategori -->
    <script src="<?php echo e(asset('assets_admin/js/data_kategori/create.js')); ?>"></script>

    
    <script src="<?php echo e(asset('assets_admin/js/navbarAdmin.js')); ?>"></script>

    
    <script src="<?php echo e(asset('assets_admin/js/profile_Admin/index.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_admin/js/profile_Admin/edit.js')); ?>"></script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/layout_admin/admin.blade.php ENDPATH**/ ?>