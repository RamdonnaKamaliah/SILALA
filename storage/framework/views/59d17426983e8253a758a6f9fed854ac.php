<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $__env->yieldContent('pageTitle', 'Admin Dashboard'); ?></title>

  
  <?php echo $__env->make('layout_admin.partial_admin.link', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  
  <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="bg-gray-50 min-h-screen overflow-x-hidden font-[Inter]">

  
  <?php echo $__env->make('layout_admin.partial_admin.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <main 
    class="min-h-screen transition-all duration-300 
           pt-24 px-4 sm:px-6 bg-gray-50
           lg:ml-64 lg:w-[calc(100%-16rem)] w-full overflow-hidden"
  >
    <div class="max-w-full">
      
      <?php echo $__env->yieldContent('content'); ?>
    </div>
  </main>

  
  <script src="<?php echo e(asset('assets_admin/js/plugins/chartjs.min.js')); ?>" async></script>
  <script src="<?php echo e(asset('assets_admin/js/plugins/perfect-scrollbar.min.js')); ?>" async></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  
  <script src="<?php echo e(asset('assets_admin/js/sidebar-admin.js')); ?>"></script>

  
  <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/layout_admin/admin.blade.php ENDPATH**/ ?>