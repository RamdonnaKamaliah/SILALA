<?php $__env->startSection('pageTitle', 'Admin Dashboard - Data Pengguna'); ?>

<?php $__env->startSection('content'); ?>
<div class="user-dashboard p-4 md:p-6 bg-gray-50 min-h-screen">
    
    <!-- Header Profesional -->
    <div class="text-left mb-8 md:mb-10">
        <div class="flex items-center mb-3">
            <div class="bg-[#A4B465] p-3 rounded-xl mr-4 shadow-lg">
                <i class="fas fa-users text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-800 mb-1">
                    Manajemen Data Pengguna
                </h1>
                <p class="text-gray-600 text-sm md:text-base">
                    <i class="fas fa-chart-line text-[#A4B465] mr-2"></i>
                    Pantau dan kelola data pengguna perpustakaan secara real-time
                </p>
            </div>
        </div>
        <div class="w-24 h-1 bg-gradient-to-r from-[#A4B465] to-[#C5D28B] rounded-full mt-2"></div>
    </div>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">
        <!-- Total Pengguna -->
        <div class="bg-white rounded-xl p-4 md:p-6 shadow-md hover:shadow-xl border-l-4 border-[#A4B465] transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-user-friends text-[#A4B465] mr-2 text-sm"></i>
                        <h3 class="font-semibold text-gray-700 text-sm md:text-base">Total Pengguna</h3>
                    </div>
                    <p class="text-2xl md:text-3xl font-bold text-[#A4B465] mb-1"><?php echo e($totalUsers); ?></p>
                    <p class="text-xs text-gray-500">
                        <i class="fas fa-database mr-1"></i>
                        Seluruh pengguna terdaftar
                    </p>
                </div>
                <div class="bg-[#F5F7ED] p-3 rounded-full ml-4">
                    <i class="fas fa-users text-[#A4B465] text-lg md:text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Karyawan -->
        <div class="bg-white rounded-xl p-4 md:p-6 shadow-md hover:shadow-xl border-l-4 border-[#A4B465] transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-briefcase text-[#A4B465] mr-2 text-sm"></i>
                        <h3 class="font-semibold text-gray-700 text-sm md:text-base">Karyawan</h3>
                    </div>
                    <p class="text-2xl md:text-3xl font-bold text-[#A4B465] mb-1"><?php echo e($karyawanCount); ?></p>
                    <p class="text-xs text-gray-500">
                        <i class="fas fa-chart-pie mr-1"></i>
                        <?php echo e($totalUsers > 0 ? number_format(($karyawanCount/$totalUsers)*100, 1) : 0); ?>% dari total
                    </p>
                </div>
                <div class="bg-[#F5F7ED] p-3 rounded-full ml-4">
                    <i class="fas fa-user-tie text-[#A4B465] text-lg md:text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Magang/PKL -->
        <div class="bg-white rounded-xl p-4 md:p-6 shadow-md hover:shadow-xl border-l-4 border-[#A4B465] transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-user-graduate text-[#A4B465] mr-2 text-sm"></i>
                        <h3 class="font-semibold text-gray-700 text-sm md:text-base">Magang/PKL</h3>
                    </div>
                    <p class="text-2xl md:text-3xl font-bold text-[#A4B465] mb-1"><?php echo e($magangCount); ?></p>
                    <p class="text-xs text-gray-500">
                        <i class="fas fa-chart-pie mr-1"></i>
                        <?php echo e($totalUsers > 0 ? number_format(($magangCount/$totalUsers)*100, 1) : 0); ?>% dari total
                    </p>
                </div>
                <div class="bg-[#F5F7ED] p-3 rounded-full ml-4">
                    <i class="fas fa-graduation-cap text-[#A4B465] text-lg md:text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Distribusi Pengguna -->
    <div class="bg-white rounded-xl p-5 md:p-6 shadow-md mb-8 border border-gray-100">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 pb-4 border-b border-gray-200">
            <div class="flex items-center mb-3 md:mb-0">
                <div class="bg-[#A4B465] p-2 rounded-lg mr-3">
                    <i class="fas fa-chart-bar text-white"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-lg md:text-xl text-gray-800">Analisis Distribusi Pengguna</h3>
                    <p class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Persentase berdasarkan kategori pengguna
                    </p>
                </div>
            </div>
            
            <!-- Legend untuk Mobile -->
            <div class="flex md:hidden space-x-4 mt-2">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-[#A4B465] rounded-full mr-2"></div>
                    <span class="text-xs text-gray-600">Karyawan</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-[#C5D28B] rounded-full mr-2"></div>
                    <span class="text-xs text-gray-600">Magang</span>
                </div>
            </div>
            
            <!-- Legend untuk Desktop -->
            <div class="hidden md:flex space-x-6">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-[#A4B465] rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">Karyawan</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-[#C5D28B] rounded-full mr-2"></div>
                    <span class="text-sm text-gray-600">Magang/PKL</span>
                </div>
            </div>
        </div>
        
        <!-- Progress Bars -->
        <div class="space-y-5 md:space-y-6">
            <!-- Progress Bar Karyawan -->
            <div>
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-2">
                    <div class="flex items-center mb-1 sm:mb-0">
                        <i class="fas fa-briefcase text-[#A4B465] mr-2 text-sm"></i>
                        <span class="text-sm font-medium text-gray-700">Karyawan</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-700 bg-[#F5F7ED] px-3 py-1 rounded-full">
                        <?php echo e($karyawanCount); ?> pengguna (<?php echo e($totalUsers > 0 ? number_format(($karyawanCount/$totalUsers)*100, 1) : 0); ?>%)
                    </span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                    <div class="bg-gradient-to-r from-[#A4B465] to-[#8A9A55] h-3 rounded-full transition-all duration-1000 ease-out shadow-sm progress-bar-karyawan" 
                         style="width: 0%"
                         data-width="<?php echo e($totalUsers > 0 ? ($karyawanCount/$totalUsers)*100 : 0); ?>"></div>
                </div>
            </div>
            
            <!-- Progress Bar Magang/PKL -->
            <div>
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-2">
                    <div class="flex items-center mb-1 sm:mb-0">
                        <i class="fas fa-user-graduate text-[#C5D28B] mr-2 text-sm"></i>
                        <span class="text-sm font-medium text-gray-700">Magang/PKL</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-700 bg-[#F5F7ED] px-3 py-1 rounded-full">
                        <?php echo e($magangCount); ?> pengguna (<?php echo e($totalUsers > 0 ? number_format(($magangCount/$totalUsers)*100, 1) : 0); ?>%)
                    </span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                    <div class="bg-gradient-to-r from-[#C5D28B] to-[#A4B465] h-3 rounded-full transition-all duration-1000 ease-out shadow-sm progress-bar-magang" 
                         style="width: 0%"
                         data-width="<?php echo e($totalUsers > 0 ? ($magangCount/$totalUsers)*100 : 0); ?>"></div>
                </div>
            </div>
        </div>

        <!-- Summary untuk Mobile -->
        <div class="mt-6 p-4 bg-gradient-to-r from-[#F5F7ED] to-white rounded-lg md:hidden border border-[#A4B465]/20">
            <div class="text-center">
                <p class="text-[#A4B465] font-semibold text-sm">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Total Data: <?php echo e($totalUsers); ?> Pengguna
                </p>
            </div>
        </div>

        <!-- Summary untuk Desktop -->
        <div class="hidden md:block mt-6 p-4 bg-gradient-to-r from-[#F5F7ED] to-white rounded-lg border border-[#A4B465]/20">
            <div class="flex items-center justify-center space-x-8">
                <div class="text-center">
                    <p class="text-xs text-gray-500 mb-1">Total Pengguna</p>
                    <p class="text-2xl font-bold text-[#A4B465]"><?php echo e($totalUsers); ?></p>
                </div>
                <div class="h-12 w-px bg-gray-300"></div>
                <div class="text-center">
                    <p class="text-xs text-gray-500 mb-1">Karyawan</p>
                    <p class="text-2xl font-bold text-[#8A9A55]"><?php echo e($karyawanCount); ?></p>
                </div>
                <div class="h-12 w-px bg-gray-300"></div>
                <div class="text-center">
                    <p class="text-xs text-gray-500 mb-1">Magang/PKL</p>
                    <p class="text-2xl font-bold text-[#C5D28B]"><?php echo e($magangCount); ?></p>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $__env->startPush('scripts'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SILALA_BPMSPH\resources\views/admin/data_pengguna/index.blade.php ENDPATH**/ ?>