

<?php $__env->startSection('title', 'dashboard super admin'); ?>

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
                        <h1 class="text-xl md:text-2xl lg:text-3xl font-bold text-[#2d5016]">Selamat Datang, Super Admin</h1>
                        <p class="text-sm text-gray-600 mt-1">Sistem Informasi Layanan Literasi dan Arsip — Silala</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Statistic Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

            <!-- Card: Total Buku -->
            <div
                class="bg-white rounded-xl p-4 shadow-sm border-t-4 border-[#4a7c3a] hover:shadow-md transition-shadow duration-300">
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
                        <div class="text-2xl font-bold text-gray-800"><?php echo e($totalBuku); ?></div>
                    </div>
                </div>
            </div>

            <!-- Card: Peminjam Aktif -->
            <div
                class="bg-white rounded-xl p-4 shadow-sm border-t-4 border-[#6b9c5a] hover:shadow-md transition-shadow duration-300">
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
                        <div class="text-2xl font-bold text-gray-800"><?php echo e($peminjamAktif); ?></div>
                    </div>
                </div>
            </div>

            <!-- Card: Buku Dipinjam -->
            <div
                class="bg-white rounded-xl p-4 shadow-sm border-t-4 border-[#8fb982] hover:shadow-md transition-shadow duration-300">
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
                        <div class="text-2xl font-bold text-gray-800"><?php echo e($bukuDipinjam); ?></div>                       
                    </div>                   
                </div>
            </div>

            <!-- Card: E-book -->
            <div
                class="bg-white rounded-xl p-4 shadow-sm border-t-4 border-[#a5c998] hover:shadow-md transition-shadow duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-600">Buku Ter Arsip</h3>
                    </div>
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-[#a5c998] text-white">
                        <i class="fas fa-tablet-screen-button text-sm"></i>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <div class="text-2xl font-bold text-gray-800"><?php echo e($bukuArsip); ?></div>                      
                    </div>              
                </div>
            </div>
        </div>

        <!-- Statistik Mingguan -->
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

            <!-- Ringkasan Cepat -->
            <div class="bg-white rounded-xl p-4 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Ringkasan Cepat</h3>

                <div class="space-y-3">

                    <!-- Peminjaman Hari Ini -->
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-[#4a7c3a] flex items-center justify-center mr-3">
                                <i class="fas fa-clock text-white text-xs"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">Peminjaman Hari Ini</p>
                        </div>
                        <span class="text-lg font-bold text-[#2d5016]">
                            <?php echo e($pinjamHariIni); ?>

                        </span>
                    </div>

                    <!-- Pengembalian Besok -->
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-[#6b9c5a] flex items-center justify-center mr-3">
                                <i class="fas fa-calendar-check text-white text-xs"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">Pengembalian Besok</p>
                        </div>
                        <span class="text-lg font-bold text-[#2d5016]">
                            <?php echo e($kembaliBesok); ?>

                        </span>
                    </div>

                    <!-- Keterlambatan -->
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-[#8fb982] flex items-center justify-center mr-3">
                                <i class="fas fa-exclamation-triangle text-white text-xs"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">Keterlambatan</p>
                        </div>
                        <span class="text-lg font-bold text-red-600">
                            <?php echo e($keterlambatan); ?>

                        </span>
                    </div>

                    <!-- Buku Populer -->
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-[#a5c998] flex items-center justify-center mr-3">
                                <i class="fas fa-star text-white text-xs"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">Buku Populer</p>
                        </div>
                        <span class="text-lg font-bold text-[#2d5016]">
                            <?php echo e($bukuPopuler); ?>

                        </span>
                    </div>

                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Aktivitas Terbaru</h3>
            </div>

            <div class="space-y-3">
                <?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors duration-200">
                        <div class="w-10 h-10 rounded-full <?php echo e($activity['bg']); ?> flex items-center justify-center mr-3">
                            <i class="fas <?php echo e($activity['icon']); ?> <?php echo e($activity['iconColor']); ?>"></i>
                        </div>

                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">
                                <?php echo e($activity['title']); ?>

                            </p>
                            <p class="text-xs text-gray-500">
                                <?php echo e($activity['desc']); ?> • <?php echo e($activity['time']->diffForHumans()); ?>

                            </p>
                        </div>

                        <?php if($activity['type'] === 'pengingat'): ?>
                            <span class="text-xs text-yellow-600 font-medium">Penting</span>
                        <?php else: ?>
                            <span class="text-xs text-gray-500">Baru</span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-sm text-gray-500 text-center">
                        Belum ada aktivitas terbaru
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php $__env->startPush('scripts'); ?>
    <script>
    const ctx = document.getElementById('mainChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($chartLabels, 15, 512) ?>,
            datasets: [{
                label: 'Jumlah Peminjaman',
                data: <?php echo json_encode($chartData, 15, 512) ?>,
                tension: 0.4,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: true
                }
            }
        }
    });
    </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_superAdmin.super_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SILALA_BPMSPH\resources\views/super_admin/dashboard.blade.php ENDPATH**/ ?>