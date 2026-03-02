
<?php $__env->startSection('pageTitle', 'Detail Data Kategori'); ?>
<?php $__env->startSection('content'); ?>

    <div class="p-4 md:p-6">
        <!-- Header -->
        <div class="mb-6 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] rounded-2xl p-6 text-white">
            <div class="flex items-center space-x-4">
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-eye text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold mb-1">Detail Kategori</h1>
                    <p class="text-white/90 text-sm">Informasi lengkap kategori buku</p>

                </div>
            </div>
        </div>

        <!-- Detail Container -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200">
            <!-- Detail Header -->
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200 pl-5">
                <a href="<?php echo e(route('superadmin.kategori.index')); ?>"
                    class="flex items-center justify-center space-x-2 px-4 py-2 
                              border border-gray-300 text-gray-700 rounded-lg font-medium
                              hover:bg-gray-50 transition-colors text-sm">
                    <i class="fas fa-arrow-left text-xs"></i>
                    <span>Kembali</span>
                </a>

            </div>
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-800">Informasi Kategori</h2>
            </div>

            <!-- Detail Content -->
            <div class="p-6">
                <!-- Main Info -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-[#A4B465] rounded-lg flex items-center justify-center">
                            <i class="fas fa-tags text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800"><?php echo e($kategori->nama_kategori); ?></h3>
                            <p class="text-gray-600 text-sm">Kategori Buku Perpustakaan</p>
                        </div>
                    </div>
                </div>

                <!-- Detail Information -->
                <div class="space-y-4 mb-6">
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-tag text-[#A4B465]"></i>
                        <div>
                            <p class="text-sm text-gray-600">Nama Kategori</p>
                            <p class="text-gray-800 font-medium"><?php echo e($kategori->nama_kategori); ?></p>
                        </div>
                    </div>


                </div>

                <!-- Waktu Sekarang -->
                <div class="flex items-center space-x-3 p-3 bg-blue-50 rounded-lg border border-blue-200">
                    <i class="fas fa-clock text-blue-600"></i>
                    <div>
                        <p class="text-sm text-gray-600">Waktu Sekarang</p>
                        <p class="text-blue-800 font-medium" id="currentDate">-</p>
                        <p class="text-blue-600 text-xs" id="currentTime">-</p>
                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateCurrentTime() {
                const now = new Date();

                // Format tanggal Indonesia
                const optionsDate = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                const formattedDate = now.toLocaleDateString('id-ID', optionsDate);

                // Format waktu
                const formattedTime = now.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });

                // Update elemen
                document.getElementById('currentDate').textContent = formattedDate;
                document.getElementById('currentTime').textContent = formattedTime;
            }

            // Update waktu setiap detik
            updateCurrentTime();
            setInterval(updateCurrentTime, 1000);
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_superAdmin.super_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SILALA_BPMSPH\resources\views/super_admin/kategori/show.blade.php ENDPATH**/ ?>