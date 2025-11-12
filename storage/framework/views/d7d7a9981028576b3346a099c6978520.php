<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo $__env->make('layout_landing.patrial_landing.link', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <title>SILALA</title>
    <!-- Vite -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
     <!-- style -->
    <link rel="stylesheet" href="<?php echo e(asset('assets_landing/css/landingpage.css')); ?>">

</head>
<body class="bg-gray-50 font-sans text-slate-700">

    <!-- Navbar -->
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
<?php endif; ?>
  
    <!-- Hero Section -->
    <?php echo $__env->make('layout_landing.patrial_landing.hero', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Section Hijau -->
<section class="bg-[#F5ECD5] dark:bg-[#A4B465] pt-32 pb-16 px-4 md:px-8 rounded-t-[50px]" id="tentang">
  <div class="max-w-7xl mx-auto space-y-12">

    <!-- Quote Box -->
    <div class="flex justify-center px-2">
      <div class="quote-box relative bg-white rounded-2xl shadow-xl px-6 md:px-10 py-8 max-w-3xl w-full text-center border-4 border-[#626F47]
                  opacity-0 translate-y-10 transition-all duration-700 ease-out">
        <span class="absolute -top-4 right-6 text-black text-3xl">
          <i class="fa-solid fa-quote-left"></i>
        </span>

        <p class="text-gray-700 text-lg leading-relaxed font-medium italic">
          "Lorem Ipsum is simply dummy text of the printing and typesetting
      industry. Lorem Ipsum has been the industry's standard dummy text
      ever since the 1500s, when an unknown printer took a galley of type
      and scrambled it to make a type specimen book."
        </p>

        <span class="absolute -bottom-4 left-6 text-black text-3xl">
          <i class="fa-solid fa-quote-right"></i>
        </span>
      </div>
    </div>

    <!-- Judul Section -->
    <div class="text-center" id="rekomendasi">
      <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 dark:text-white">
        Rekomendasi Buku Best Seller
      </h2>
      <p class="mt-2 text-gray-600 dark:text-white text-base">
        Pilihan buku terbaik untuk menambah wawasan dan inspirasi
      </p>
    </div>

    <!-- Grid Card -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      <!-- CARD TEMPLATE -->
      <?php $__currentLoopData = [
        ['buku1.jpg','Statistika Peternakan','Indah Hanaco','★★★★☆','+20'],
        ['buku2.jpg','Buku Saku Pelaksanaa Kie','J. Anderson','★★★★☆','+35'],
        ['buku3.jpg','Statistika Peternakan','Indah Hanaco','★★★★★','+50'],
        ['buku4.jpg','Budidaya Peternakan','J. Anderson','★★★★☆','+20'],
        ['buku2.jpg','Buku Saku Pelaksanaa Kie','J. Anderson','★★★★☆','+35'],
        ['buku3.jpg','Statistika Peternakan','Indah Hanaco','★★★★★','+50'],
      ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$img,$title,$author,$rating,$users]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <article class="recommend-card bg-[#A4B465] dark:bg-white rounded-xl p-5 md:p-6 flex flex-col sm:flex-row items-center sm:items-start gap-4 md:gap-5 w-full h-full
                      opacity-0 translate-y-10 transition-all duration-700 ease-out">
        <div class="cover w-28 h-40 md:w-32 md:h-44 flex-shrink-0">
          <img src="<?php echo e(asset('assets/'.$img)); ?>" alt="<?php echo e($title); ?> - cover" class="w-full h-full object-cover rounded-lg shadow-md">
        </div>
        <div class="meta text-center sm:text-left">
          <h3 class="text-lg md:text-xl font-semibold text-white dark:text-gray-900"><?php echo e($title); ?></h3>
          <p class="text-sm md:text-base text-gray-100 dark:text-gray-900 mt-1">By <?php echo e($author); ?></p>
          <div class="mt-3 flex justify-center sm:justify-start items-center gap-2">
            <div class="text-yellow-400 text-base"><?php echo e($rating); ?></div>
            <div class="text-sm text-gray-200 dark:text-gray-900 flex items-center"><i class="fa fa-user mr-1"></i><?php echo e($users); ?></div>
          </div>
        </div>
      </article>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>

    <?php echo $__env->make('layout_landing.patrial_landing.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script src="<?php echo e(asset('assets_landing/js/landingpage.js')); ?>"></script>
</body>
</html><?php /**PATH C:\laragon\www\SILALA_BPMSPH\resources\views/landingpage.blade.php ENDPATH**/ ?>