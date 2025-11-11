<?php $__env->startSection('pageTitle', 'Data Peminjam'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 overflow-x-auto">
    <!-- Judul Halaman -->
    <div class="text-left mb-6">
        <h1 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-2">
            Selamat datang di Dashboard Data Peminjam 🎉
        </h1>
        <p class="text-gray-600">
            Lihat dan pantau seluruh data peminjaman buku perpustakaan.
        </p>
    </div>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-[#A4B465]">Data Peminjaman Buku</h2>
    </div>

    <!-- Filter Status -->
    <div class="mb-6 bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div class="flex flex-wrap gap-2 items-center">
            <span class="text-sm font-medium text-gray-700">Filter Status:</span>
            <button type="button" data-status="all" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200 hover:bg-blue-200 transition-colors active">
                Semua
            </button>
            <button type="button" data-status="dipinjam" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200 hover:bg-blue-200 transition-colors">
                Dipinjam
            </button>
            <button type="button" data-status="dikembalikan" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200 hover:bg-green-200 transition-colors">
                Dikembalikan
            </button>
            <button type="button" data-status="bermasalah" class="filter-btn px-3 py-1.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200 hover:bg-red-200 transition-colors">
                Bermasalah
            </button>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="overflow-x-auto mt-4 bg-white rounded-lg shadow-sm border border-gray-200">
        <?php if($data_peminjam->count() > 0): ?>
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="w-16 px-4 py-3 border-b border-gray-200 text-center">No</th>
                        <th class="px-4 py-3 border-b border-gray-200 text-left">Nama Peminjam</th>
                        <th class="px-4 py-3 border-b border-gray-200 text-left">Judul Buku</th>
                        <th class="px-4 py-3 border-b border-gray-200 text-center">Tanggal Pinjam</th>
                        <th class="px-4 py-3 border-b border-gray-200 text-center">Tanggal Kembali</th>
                        <th class="px-4 py-3 border-b border-gray-200 text-center">Status</th>
                        <th class="px-4 py-3 border-b border-gray-200 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200" id="tableBody">
                    <?php $__currentLoopData = $data_peminjam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peminjam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $isLate = now()->gt($peminjam->tanggal_kembali) && $peminjam->status == 'dipinjam';
                        ?>
                        <tr class="hover:bg-gray-50 transition-colors" data-status="<?php echo e($peminjam->status); ?>">
                            <td class="px-4 py-3 text-center font-medium text-gray-600">
                                <?php echo e($loop->iteration); ?>

                            </td>
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900"><?php echo e($peminjam->user->name ?? '-'); ?></div>
                                <div class="text-xs text-gray-500"><?php echo e($peminjam->user->email ?? ''); ?></div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900"><?php echo e($peminjam->buku->judul_buku ?? '-'); ?></div>
                                <div class="text-xs text-gray-500">oleh <?php echo e($peminjam->buku->penulis ?? '-'); ?></div>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-600">
                                <?php echo e(\Carbon\Carbon::parse($peminjam->tanggal_pinjam)->translatedFormat('d M Y')); ?>

                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="text-gray-600 <?php echo e($isLate ? 'text-red-600 font-semibold' : ''); ?>">
                                    <?php echo e(\Carbon\Carbon::parse($peminjam->tanggal_kembali)->translatedFormat('d M Y')); ?>

                                </div>
                                <?php if($isLate): ?>
                                    <div class="text-xs text-red-500 mt-1">
                                        Terlambat <?php echo e(now()->diffInDays($peminjam->tanggal_kembali)); ?> hari
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <?php if($peminjam->status == 'dipinjam'): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium <?php echo e($isLate ? 'bg-red-100 text-red-800 border border-red-200' : 'bg-blue-100 text-blue-800 border border-blue-200'); ?>">
                                        <i class="fas <?php echo e($isLate ? 'fa-exclamation-triangle' : 'fa-book'); ?> mr-1"></i>
                                        <?php echo e($isLate ? 'Terlambat' : 'Dipinjam'); ?>

                                    </span>
                                <?php elseif($peminjam->status == 'dikembalikan'): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                        <i class="fas fa-check mr-1"></i>
                                        Dikembalikan
                                    </span>
                                <?php elseif($peminjam->status == 'bermasalah'): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        Bermasalah
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex flex-col sm:flex-row gap-2 justify-center items-center">
                                    <?php if($peminjam->status == 'dipinjam'): ?>
                                        <!-- Konfirmasi Kembali -->
                                        <form action="<?php echo e(route('admin.data_peminjam.kembalikan', $peminjam->id)); ?>" method="POST" class="inline">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <button type="submit" 
        class="bg-blue-600 text-white px-3 py-1.5 rounded-lg hover:bg-blue-700 text-xs font-medium transition-colors flex items-center gap-1"
        onclick="return confirm('Konfirmasi pengembalian buku?')">
        <i class="fas fa-undo text-xs"></i>
        Kembalikan
    </button>
</form>
                                        
                                        <!-- Laporkan Masalah -->
                                        <form action="<?php echo e(route('admin.data_peminjam.masalah', $peminjam->id)); ?>" method="POST" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <button type="submit"
                                                class="bg-red-600 text-white px-3 py-1.5 rounded-lg hover:bg-red-700 text-xs font-medium transition-colors flex items-center gap-1"
                                                title="Laporkan Masalah"
                                                onclick="return confirm('Yakin melaporkan masalah pada peminjaman ini?')">
                                                <i class="fas fa-exclamation-triangle text-xs"></i>
                                                Masalah
                                            </button>
                                        </form>
                                        
                                    <?php elseif($peminjam->status == 'dikembalikan'): ?>
                                        <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Selesai
                                        </span>
                                    <?php elseif($peminjam->status == 'bermasalah'): ?>
                                        <span class="inline-flex items-center px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">
                                            <i class="fas fa-exclamation-circle mr-1"></i>
                                            Bermasalah
                                        </span>
                                    <?php endif; ?>

                                    <!-- Tombol Detail -->
                                    <a href="<?php echo e(route('admin.data_peminjam.show', $peminjam->id)); ?>"
                                        class="bg-gray-600 text-white px-3 py-1.5 rounded-lg hover:bg-gray-700 text-xs font-medium transition-colors flex items-center gap-1"
                                        title="Lihat Detail">
                                        <i class="fas fa-eye text-xs"></i>
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <!-- Empty State untuk Filter (awalnya tersembunyi) -->
            <div id="emptyFilterState" class="hidden text-center py-12">
                <div class="mx-auto w-24 h-24 mb-4 text-gray-400">
                    <i class="fas fa-search text-6xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-700 mb-2">Tidak Ada Data</h3>
                <p class="text-gray-500 max-w-md mx-auto">
                    Tidak ada data peminjaman dengan status yang dipilih.
                </p>
            </div>
        <?php else: ?>
            <!-- Tampilan ketika data kosong secara keseluruhan -->
            <div class="text-center py-12">
                <div class="mx-auto w-24 h-24 mb-4 text-gray-400">
                    <i class="fas fa-book-open text-6xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-700 mb-2">Tidak Ada Data Peminjaman</h3>
                <p class="text-gray-500 max-w-md mx-auto mb-6">
                    Saat ini belum ada data peminjaman buku yang tercatat dalam sistem.
                </p>
                <div class="text-gray-400 text-3xl">
                    <i class="fas fa-inbox"></i>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const tableRows = document.querySelectorAll('#tableBody tr');
    const emptyFilterState = document.getElementById('emptyFilterState');
    const table = document.querySelector('table');
    
    // Hanya jalankan filter jika ada data
    if (tableRows.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const status = this.getAttribute('data-status');
                
                // Update active button
                filterButtons.forEach(btn => btn.classList.remove('active', 'ring-2', 'ring-offset-1'));
                this.classList.add('active', 'ring-2', 'ring-offset-1');
                
                let visibleRows = 0;
                
                // Filter rows
                tableRows.forEach(row => {
                    if (status === 'all') {
                        row.style.display = '';
                        visibleRows++;
                    } else {
                        const rowStatus = row.getAttribute('data-status');
                        if (rowStatus === status) {
                            row.style.display = '';
                            visibleRows++;
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });

                // Tampilkan pesan kosong jika tidak ada baris yang terlihat
                if (visibleRows === 0) {
                    table.style.display = 'none';
                    emptyFilterState.classList.remove('hidden');
                } else {
                    table.style.display = '';
                    emptyFilterState.classList.add('hidden');
                }
            });
        });
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/data_peminjam/index.blade.php ENDPATH**/ ?>