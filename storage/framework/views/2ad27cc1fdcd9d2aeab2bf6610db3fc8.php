<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $__env->yieldContent('pageTitle'); ?></title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo $__env->make('layout_admin.partial_admin.link', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>
    <?php echo $__env->yieldContent('content'); ?>

    
    <script src="<?php echo e(asset('assets_admin/js/login/login.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_admin/js/login/layout.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>


     
<?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/auth/layouts/lay-login.blade.php ENDPATH**/ ?>