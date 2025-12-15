<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title>Silala</title>
  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

  
  <?php echo $__env->make('layout_user.partial_user.link', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="min-h-screen flex flex-col font-[Ubuntu,sans-serif] bg-white">

  
  <?php echo $__env->make('layout_user.partial_user.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <main class="pt-8 pb-6 px-4 md:px-6 bg-cream relative top-[90px] mb-24 md:ml-[320px] md:mr-3 md:rounded-3xl transition-all duration-300 z-50 flex flex-col max-w-full shadow-inner">
    <?php echo $__env->yieldContent('content'); ?>
</main>

  
  <?php echo $__env->make('layout_user.partial_user.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
  <script src="<?php echo e(asset('assets_user/js/sidebarnavbar.js')); ?>"></script>
  <script src="<?php echo e(asset('assets_user/js/daftarbuku.js')); ?>"></script>
  <script src="<?php echo e(asset('assets_user/js/riwayatbuku.js')); ?>"></script>
  <script src="<?php echo e(asset('assets_user/js/favorit.js')); ?>"></script>
  <script src="<?php echo e(asset('assets_user/js/editprofil.js')); ?>"></script>
  <script src="<?php echo e(asset('assets_user/js/riwayatbaca.js')); ?>"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  

  <?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html>
<?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/layout_user/user.blade.php ENDPATH**/ ?>