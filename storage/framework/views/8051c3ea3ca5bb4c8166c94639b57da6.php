<?php $__env->startSection('pageTitle', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen p-4 md:p-6">

    <!-- Header Section -->
    <div class="bg-white/70 backdrop-blur-md rounded-2xl p-4 md:p-6 mb-6 border border-white/35 shadow-sm">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <!-- Logo dan Judul -->
            <div class="flex items-center gap-4">
                <img src="<?php echo e(asset('/assets_admin/image/sisapa.png')); ?>" alt="logo"
                    class="w-16 h-16 md:w-20 md:h-20 rounded-xl object-cover shadow-sm" />
                <div>
                    <h1 class="text-xl md:text-2xl lg:text-3xl font-bold text-[#2d5016]">Selamat Datang, <?php echo e($admin->name); ?> 👋</h1>
                    <p class="text-sm text-gray-600 mt-1">Sistem Manajemen Perpustakaan — Silala</p>
                </div>
            </div>

            <!-- Tanggal dan Waktu -->
            <div class="text-center mt-4 md:mt-0">
                <div id="current-time" class="text-lg md:text-xl lg:text-2xl font-bold text-[#2d5016]">00:00:00</div>
                <div id="current-date" class="text-xs text-gray-600 mt-1">Hari, DD Bulan YYYY</div>
            </div>
        </div>
    </div>

    <!-- Statistic Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        
        <!-- Card: Total Buku -->
        <div class="bg-white rounded-xl p-4 shadow-sm border-t-4 border-[#4a7c3a] hover:shadow-md transition-shadow duration-300">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-sm font-semibold text-gray-600">Total Buku</h3>
                </div>
                <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-[#4a7c3a] text-white">
                    <i class="fas fa-book-open text-sm"></i>
                </div>
            </div>
            <div class="flex items-end justify-between">
                <div>
                    <div class="text-2xl font-bold text-gray-800">2,543</div>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-green-600 flex items-center">
                            <i class="fas fa-arrow-up mr-1 text-xs"></i>+12
                        </span>
                        <span class="text-xs text-gray-500 ml-2">dari bulan lalu</span>
                    </div>
                </div>
                <div class="w-16 h-10">
                    <canvas id="sparkTotalBuku"></canvas>
                </div>
            </div>
        </div>

        <!-- Card: Peminjam Aktif -->
        <div class="bg-white rounded-xl p-4 shadow-sm border-t-4 border-[#6b9c5a] hover:shadow-md transition-shadow duration-300">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-sm font-semibold text-gray-600">Peminjam Aktif</h3>
                </div>
                <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-[#6b9c5a] text-white">
                    <i class="fas fa-user-group text-sm"></i>
                </div>
            </div>
            <div class="flex items-end justify-between">
                <div>
                    <div class="text-2xl font-bold text-gray-800">187</div>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-green-600 flex items-center">
                            <i class="fas fa-arrow-up mr-1 text-xs"></i>+8
                        </span>
                        <span class="text-xs text-gray-500 ml-2">dari minggu lalu</span>
                    </div>
                </div>
                <div class="w-16 h-10">
                    <canvas id="sparkPeminjam"></canvas>
                </div>
            </div>
        </div>

        <!-- Card: Buku Dipinjam -->
        <div class="bg-white rounded-xl p-4 shadow-sm border-t-4 border-[#8fb982] hover:shadow-md transition-shadow duration-300">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-sm font-semibold text-gray-600">Buku Dipinjam</h3>
                </div>
                <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-[#8fb982] text-white">
                    <i class="fas fa-book-bookmark text-sm"></i>
                </div>
            </div>
            <div class="flex items-end justify-between">
                <div>
                    <div class="text-2xl font-bold text-gray-800">324</div>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-green-600 flex items-center">
                            <i class="fas fa-arrow-up mr-1 text-xs"></i>+24
                        </span>
                        <span class="text-xs text-gray-500 ml-2">dari kemarin</span>
                    </div>
                </div>
                <div class="w-16 h-10">
                    <canvas id="sparkDipinjam"></canvas>
                </div>
            </div>
        </div>

        <!-- Card: E-book -->
        <div class="bg-white rounded-xl p-4 shadow-sm border-t-4 border-[#a5c998] hover:shadow-md transition-shadow duration-300">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-sm font-semibold text-gray-600">E-book Tersedia</h3>
                </div>
                <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-[#a5c998] text-white">
                    <i class="fas fa-tablet-screen-button text-sm"></i>
                </div>
            </div>
            <div class="flex items-end justify-between">
                <div>
                    <div class="text-2xl font-bold text-gray-800">856</div>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-green-600 flex items-center">
                            <i class="fas fa-download mr-1 text-xs"></i>125
                        </span>
                        <span class="text-xs text-gray-500 ml-2">unduhan hari ini</span>
                    </div>
                </div>
                <div class="w-16 h-10">
                    <canvas id="sparkEbook"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
        <!-- Main Chart -->
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Statistik Mingguan</h3>
                    <p class="text-sm text-gray-600 mt-1">Perbandingan 7 hari terakhir</p>
                </div>
            </div>
            <div class="h-64">
                <canvas id="mainChart"></canvas>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Ringkasan Cepat</h3>
            
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-[#4a7c3a] flex items-center justify-center mr-3">
                            <i class="fas fa-clock text-white text-xs"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Peminjaman Hari Ini</p>
                        </div>
                    </div>
                    <span class="text-lg font-bold text-[#2d5016]">42</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-[#6b9c5a] flex items-center justify-center mr-3">
                            <i class="fas fa-calendar-check text-white text-xs"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Pengembalian Besok</p>
                        </div>
                    </div>
                    <span class="text-lg font-bold text-[#2d5016]">28</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-[#8fb982] flex items-center justify-center mr-3">
                            <i class="fas fa-exclamation-triangle text-white text-xs"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Keterlambatan</p>
                        </div>
                    </div>
                    <span class="text-lg font-bold text-[#dc2626]">5</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-[#a5c998] flex items-center justify-center mr-3">
                            <i class="fas fa-star text-white text-xs"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Buku Populer</p>
                        </div>
                    </div>
                    <span class="text-lg font-bold text-[#2d5016]">12</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-xl p-4 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Aktivitas Terbaru</h3>
            <a href="#" class="text-sm text-[#4a7c3a] hover:text-[#2d5016] font-medium">Lihat Semua</a>
        </div>
        
        <div class="space-y-3">
            <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mr-3">
                    <i class="fas fa-user-plus text-blue-600"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">Anggota baru terdaftar</p>
                    <p class="text-xs text-gray-500">Andi Pratama • 10 menit yang lalu</p>
                </div>
                <span class="text-xs text-gray-500">Baru</span>
            </div>

            <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center mr-3">
                    <i class="fas fa-book text-green-600"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">Peminjaman buku berhasil</p>
                    <p class="text-xs text-gray-500">"Laskar Pelangi" dipinjam • 1 jam yang lalu</p>
                </div>
                <span class="text-xs text-gray-500">Selesai</span>
            </div>

            <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                <div class="w-10 h-10 rounded-full bg-yellow-50 flex items-center justify-center mr-3">
                    <i class="fas fa-exclamation text-yellow-600"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">Pengingat pengembalian</p>
                    <p class="text-xs text-gray-500">3 buku akan jatuh tempo besok • 2 jam yang lalu</p>
                </div>
                <span class="text-xs text-yellow-600">Penting</span>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>