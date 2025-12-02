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

<?php if (isset($component)) { $__componentOriginal74ac52b4635c6b2ea5ec52fd09979eac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal74ac52b4635c6b2ea5ec52fd09979eac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbardetus','data' => ['buku' => $buku]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbardetus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['buku' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($buku)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal74ac52b4635c6b2ea5ec52fd09979eac)): ?>
<?php $attributes = $__attributesOriginal74ac52b4635c6b2ea5ec52fd09979eac; ?>
<?php unset($__attributesOriginal74ac52b4635c6b2ea5ec52fd09979eac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal74ac52b4635c6b2ea5ec52fd09979eac)): ?>
<?php $component = $__componentOriginal74ac52b4635c6b2ea5ec52fd09979eac; ?>
<?php unset($__componentOriginal74ac52b4635c6b2ea5ec52fd09979eac); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/layout_user/partial_user/headerdetail.blade.php ENDPATH**/ ?>