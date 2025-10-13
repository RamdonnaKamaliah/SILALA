<?php $__env->startSection('pageTitle', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 space-y-8">
    <!-- 🎉 HERO SECTION -->
    <div class="max-w-5xl mx-auto">
        <div class="relative rounded-2xl overflow-hidden shadow-2xl">
            <!-- Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-800"></div>

            <!-- Efek animasi -->
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-10 left-10 w-20 h-20 bg-white rounded-full blur-xl animate-pulse"></div>
                <div class="absolute bottom-10 right-10 w-16 h-16 bg-blue-300 rounded-full blur-lg animate-bounce"></div>
                <div class="absolute top-1/2 left-1/3 w-12 h-12 bg-pink-300 rounded-full blur-md"></div>
            </div>

            <!-- Konten -->
            <div class="relative z-10 px-6 pt-5 pb-2 md:px-8 md:pt-7 md:pb-2 flex flex-row items-center justify-between">
                <!-- Text -->
                <div class="w-2/3 pr-4">
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 mb-3">
                        <i class="fas fa-shield-alt text-blue-300 mr-2"></i>
                        <span class="text-xs font-medium text-white">Admin Dashboard</span>
                    </div>

                    <h1 class="text-xl md:text-2xl lg:text-3xl font-bold text-white mb-2">
                        Selamat Datang, 
                        <span class="bg-gradient-to-r from-blue-300 to-purple-300 bg-clip-text text-transparent">
                            Administrator
                        </span>
                    </h1>

                    <p class="text-white/80 text-xs md:text-sm lg:text-base leading-relaxed">
                        Kelola sistem dengan efisiensi maksimal. Pantau aktivitas, kelola pengguna, 
                        dan optimalkan performa platform dari dashboard ini.
                    </p>
                </div>

                <!-- Gambar -->
                <div class="w-1/3 flex items-center justify-center">
                    <img src="<?php echo e(asset('/assets_admin/image/sapa.png')); ?>" alt="Sapaan Admin" 
                         class="max-w-full h-auto floating pulse-glow"
                         style="max-height: 180px;">
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>