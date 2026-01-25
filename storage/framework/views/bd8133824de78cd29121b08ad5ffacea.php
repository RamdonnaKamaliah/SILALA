<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SILALA (Sistem Informasi Layanan Literasi & Arsip)</title>

    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    
    <?php echo $__env->make('layout_user.partial_user.link', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="min-h-screen font-[Ubuntu,sans-serif] bg-white flex" data-buku-id="<?php echo e($buku->id); ?>"
      data-favorit-url="<?php echo e(route('user.favorit.toggle')); ?>"
      data-pinjam-url="<?php echo e(route('pinjam.store')); ?>"
      data-pinjam-redirect="<?php echo e(route('user.riwayatbuku')); ?>"
      data-csrf="<?php echo e(csrf_token()); ?>">

    
    <?php if (isset($component)) { $__componentOriginalb763922586e375d9f7490769fccbb786 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb763922586e375d9f7490769fccbb786 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebarUser','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebarUser'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb763922586e375d9f7490769fccbb786)): ?>
<?php $attributes = $__attributesOriginalb763922586e375d9f7490769fccbb786; ?>
<?php unset($__attributesOriginalb763922586e375d9f7490769fccbb786); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb763922586e375d9f7490769fccbb786)): ?>
<?php $component = $__componentOriginalb763922586e375d9f7490769fccbb786; ?>
<?php unset($__componentOriginalb763922586e375d9f7490769fccbb786); ?>
<?php endif; ?>

    
    <?php echo $__env->make('layout_user.partial_user.headerdetail', [
    'buku' => $buku,
    'userBorrow' => $userBorrow ?? null,
    'hasRead' => $hasRead ?? null,
    'userRating' => $userRating ?? null,
    'averageRating' => $averageRating ?? 0,
    'totalRatings' => $totalRatings ?? 0,
    'stokHabis' => $stokHabis ?? null,
    'isFavorited' => $isFavorited ?? false
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


    
    <main class="flex-1 ml-0 md:ml-[320px] mr-0 md:mr-3 transition-all duration-300 relative overflow-y-auto pt-[55vh] pb-20">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

   
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

    
    <script src="<?php echo e(asset('assets_user/js/sidebarnavbar.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_user/js/detailbuku.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_user/js/notif.js')); ?>"></script>

    
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    
    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>

</html>
<?php /**PATH C:\laragon\www\SILALA_BPMSPH\resources\views/layout_user/detail.blade.php ENDPATH**/ ?>