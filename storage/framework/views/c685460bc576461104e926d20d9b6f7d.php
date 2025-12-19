<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $__env->yieldContent('title', 'Login'); ?></title>

    <?php echo $__env->make('layout_login.partial.link', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="min-h-screen flex items-center justify-center px-4 relative z-10">

    <?php echo $__env->yieldContent('content'); ?>

    <script src="<?php echo e(asset('assets_admin/js/login.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/layout_login/master.blade.php ENDPATH**/ ?>