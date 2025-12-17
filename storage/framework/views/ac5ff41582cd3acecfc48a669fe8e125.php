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

<body class="bg-gray-50 dark:bg-[#15202B] font-sans text-slate-700 dark:text-[#39FF14]">

    <!-- navbar -->
    <?php echo $__env->make('layout_landing.patrial_landing.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Hero Section -->
    <section class="pt-24 md:pt-32 pb-32 md:pb-40 relative bg-cover bg-center hero-section" id="/"
        style="background-image: url('<?php echo e(asset('assets/background.png')); ?>');">
        <div class="max-w-5xl mx-auto flex flex-col items-center text-center px-4 md:px-6">

            <!-- Judul + Icon -->
            <h1
                class="flex items-center justify-center responsive-heading md:text-4xl font-inknut font-bold text-black dark:text-white">
                <span class="mr-2">
                    <img src="<?php echo e(asset('assets/logo 1.png')); ?>" alt="Ilustrasi Buku" class="w-10 h-10 md:w-12 md:h-12">
                </span>
                <span class="wave-text">
                    P<span>e</span><span>r</span><span>p</span><span>u</span><span>s</span><span>t</span><span>a</span><span>k</span><span>a</span><span>a</span><span>n</span>
                </span>
            </h1>

            <!-- BPMSPH + Deskripsi sejajar -->
            <div
                class="mt-4 md:mt-6 flex flex-col md:flex-row md:items-center md:justify-center gap-2 md:gap-6 max-w-2xl text-gray-600 dark:text-gray-200 text-center md:text-left">
                <!-- BPMSPH -->
                <span
                    class="italic font-serif font-bold text-xl md:text-2xl whitespace-nowrap text-black dark:text-white">
                    BPMSPH
                </span>

                <!-- Deskripsi -->
                <p class="text-base md:text-lg leading-relaxed text-black dark:text-white">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
            </div>

           <!-- Gambar di batas section -->
        <div class="absolute left-1/2 transform -translate-x-1/2 bottom-0 translate-y-1/2">
            <?php
            $heroImage = \App\Models\Setting::getValue('hero_image', 'hero1.png');
        ?>

        <img src="<?php echo e(asset('storage/cms/' . $heroImage)); ?>"
            class="hero-image w-48 md:w-80 object-contain"
            alt="Hero Image">

</div>


        </div>
    </section>

    <!-- Section Hijau -->
    <section class="bg-[#A4B465] dark:bg-[#6B7C38] pt-32 pb-16 px-4 md:px-8 rounded-t-[50px]" id="tentang">
        <div class="max-w-7xl mx-auto space-y-12">

            <!-- Quote Box -->
            <div class="flex justify-center px-2">
                <div
                    class="quote-box relative bg-white dark:bg-[#15202B] rounded-2xl shadow-xl px-6 md:px-10 py-8 max-w-3xl w-full text-center
              border-4 border-[#626F47] dark:border-[#626F47]
              opacity-0 translate-y-10 transition-all duration-700 ease-out
              hover:border-green-400 hover:shadow-[0_0_20px_rgba(57,255,20,0.7)] hover:scale-105">
                    <span class="absolute -top-4 right-6 text-black dark:text-white text-3xl">
                        <i class="fa-solid fa-quote-left"></i>
                    </span>

                    <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed font-medium italic">
                        "Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry. Lorem Ipsum has been the industry's standard dummy text
                        ever since the 1500s, when an unknown printer took a galley of type
                        and scrambled it to make a type specimen book."
                    </p>

                    <span class="absolute -bottom-4 left-6 text-black dark:text-white text-3xl">
                        <i class="fa-solid fa-quote-right"></i>
                    </span>
                </div>
            </div>

            <!-- Judul Section -->
            <div class="text-center" id="rekomendasi">
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 dark:text-white">
                    Rekomendasi Buku Best Seller
                </h2>
                <p class="mt-2 text-gray-600 dark:text-gray-300 text-base">
                    Pilihan buku terbaik untuk menambah wawasan dan inspirasi
                </p>
            </div>

            <!-- Grid Card -->
            
        </div>
    </section>

    <!-- footer -->
    <?php echo $__env->make('layout_landing.patrial_landing.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- js -->
    <script src="<?php echo e(asset('assets_landing/js/landingpage.js')); ?>"></script>

</body>

</html>
<?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/landingpage.blade.php ENDPATH**/ ?>