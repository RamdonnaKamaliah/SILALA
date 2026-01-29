<!-- sidebar -->
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

<!-- navbar -->
 <?php if (isset($component)) { $__componentOriginalf6a6961a4a734967f9f0760d17cf910b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf6a6961a4a734967f9f0760d17cf910b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbarUser','data' => ['title' => $title ?? 'Dashboard']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbarUser'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title ?? 'Dashboard')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf6a6961a4a734967f9f0760d17cf910b)): ?>
<?php $attributes = $__attributesOriginalf6a6961a4a734967f9f0760d17cf910b; ?>
<?php unset($__attributesOriginalf6a6961a4a734967f9f0760d17cf910b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf6a6961a4a734967f9f0760d17cf910b)): ?>
<?php $component = $__componentOriginalf6a6961a4a734967f9f0760d17cf910b; ?>
<?php unset($__componentOriginalf6a6961a4a734967f9f0760d17cf910b); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/layout_user/partial_user/header.blade.php ENDPATH**/ ?>