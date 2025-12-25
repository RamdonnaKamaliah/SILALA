 <?php if (isset($component)) { $__componentOriginaldd50937aa291a3a177971c35e506db3d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldd50937aa291a3a177971c35e506db3d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbarlanding','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbarlanding'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldd50937aa291a3a177971c35e506db3d)): ?>
<?php $attributes = $__attributesOriginaldd50937aa291a3a177971c35e506db3d; ?>
<?php unset($__attributesOriginaldd50937aa291a3a177971c35e506db3d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldd50937aa291a3a177971c35e506db3d)): ?>
<?php $component = $__componentOriginaldd50937aa291a3a177971c35e506db3d; ?>
<?php unset($__componentOriginaldd50937aa291a3a177971c35e506db3d); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/layout_landing/patrial_landing/header.blade.php ENDPATH**/ ?>