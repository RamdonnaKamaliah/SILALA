<?php $__env->startSection('pageTitle', 'Admin Dashboard - Data Arsip'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 overflow-x-auto">
    <!-- Header Section -->
    <div class="text-left mb-8 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] rounded-2xl p-8 text-white shadow-2xl">
        <div class="flex items-center space-x-6">
            <div class="bg-white/20 p-4 rounded-2xl shadow-inner backdrop-blur-sm">
                <i class="fas fa-archive text-3xl"></i>
            </div>
            <div>
                <h1 class="text-4xl font-bold mb-3 text-white tracking-tight">Data Buku Terarsip</h1>
                <p class="text-white/90 text-lg font-light">Kelola dan pantau buku yang telah diarsipkan di perpustakaan</p>
            </div>
        </div>
        <div class="flex items-center space-x-4 mt-4 text-white/80">
            <div class="flex items-center space-x-2 bg-white/10 px-3 py-1 rounded-full">
                <i class="fas fa-books text-sm"></i>
                <span class="text-sm">Total Arsip: <strong><?php echo e($buku_arsip->count()); ?></strong></span>
            </div>
            <div class="flex items-center space-x-2 bg-white/10 px-3 py-1 rounded-full">
                <i class="fas fa-database text-sm"></i>
                <span class="text-sm">Sistem Manajemen Arsip</span>
            </div>
        </div>
    </div>

    <!-- Bulk Action Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Bulk Delete Card -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-red-100 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center space-x-4 mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-trash-alt text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Hapus Permanen</h3>
                    <p class="text-gray-600 text-sm">Hapus data terpilih secara permanen</p>
                </div>
            </div>
            <form id="bulkDeleteArchiveForm" action="<?php echo e(route('admin.data_arsip.bulkDeleteArchive')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="selected_ids" id="selectedIds">
                <button type="submit" id="bulkDeleteBtn" disabled
                    class="w-full flex items-center justify-center space-x-3 px-6 py-3.5
                           bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl font-semibold
                           hover:from-red-600 hover:to-red-700 transition-all duration-200
                           shadow-lg hover:shadow-xl transform hover:-translate-y-0.5
                           disabled:bg-gray-300 disabled:from-gray-300 disabled:to-gray-400 disabled:cursor-not-allowed disabled:transform-none disabled:shadow-none
                           text-base group">
                    <i class="fas fa-trash text-sm group-hover:scale-110 transition-transform"></i>
                    <span>Hapus Data Terpilih</span>
                </button>
            </form>
        </div>

        <!-- Bulk Restore Card -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-green-100 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center space-x-4 mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-undo text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Pulihkan Data</h3>
                    <p class="text-gray-600 text-sm">Kembalikan data terpilih ke sistem</p>
                </div>
            </div>
            <form action="<?php echo e(route('admin.data_arsip.bulkRestore')); ?>" method="POST" id="bulkRestoreForm">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="selected_ids" id="selectedIdsRestore">
                <button type="submit" id="bulkRestoreBtn" disabled
                    class="w-full flex items-center justify-center space-x-3 px-6 py-3.5
                           bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl font-semibold
                           hover:from-green-600 hover:to-green-700 transition-all duration-200
                           shadow-lg hover:shadow-xl transform hover:-translate-y-0.5
                           disabled:bg-gray-300 disabled:from-gray-300 disabled:to-gray-400 disabled:cursor-not-allowed disabled:transform-none disabled:shadow-none
                           text-base group">
                    <i class="fas fa-undo text-sm group-hover:scale-110 transition-transform"></i>
                    <span>Pulihkan Data Terpilih</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
        <!-- Table Header -->
        <div class="border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100/80 px-6 py-4 backdrop-blur-sm">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] rounded-full shadow-sm"></div>
                    <h2 class="text-xl font-bold text-gray-800">Daftar Buku Terarsip</h2>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2 bg-white px-3 py-2 rounded-lg border border-gray-200 shadow-sm">
                        <i class="fas fa-filter text-gray-400 text-sm"></i>
                        <span class="text-sm text-gray-600"><?php echo e($buku_arsip->count()); ?> data ditemukan</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="selectAll" class="w-4 h-4 rounded border-gray-300 text-[#A4B465] focus:ring-[#A4B465]">
                        <label for="selectAll" class="text-sm text-gray-600 font-medium">Pilih Semua</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table id="dataTable" class="w-full text-sm">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 text-gray-700 border-b border-gray-200">
                    <tr>
                        <th class="w-14 px-4 py-4 text-center">
                            
                        </th>
                        <th class="px-6 py-4 text-center font-bold text-gray-900 text-xs uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-center font-bold text-gray-900 text-xs uppercase tracking-wider">Cover Buku</th>
                        <th class="px-6 py-4 text-left font-bold text-gray-900 text-xs uppercase tracking-wider">Informasi Buku</th>
                        <th class="px-6 py-4 text-left font-bold text-gray-900 text-xs uppercase tracking-wider">Penulis</th>
                        <th class="px-6 py-4 text-left font-bold text-gray-900 text-xs uppercase tracking-wider">Penerbit</th>
                        <th class="px-6 py-4 text-center font-bold text-gray-900 text-xs uppercase tracking-wider">Tahun</th>
                        <th class="px-6 py-4 text-left font-bold text-gray-900 text-xs uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-center font-bold text-gray-900 text-xs uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-4 text-center font-bold text-gray-900 text-xs uppercase tracking-wider">File</th>
                        <th class="px-6 py-4 text-center font-bold text-gray-900 text-xs uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php $__empty_1 = true; $__currentLoopData = $buku_arsip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $buku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gradient-to-r hover:from-gray-50/80 hover:to-gray-100/50 transition-all duration-300 group border-b border-gray-100 last:border-b-0">
                            <td class="px-4 py-4 text-center">
                                <input type="checkbox" name="selected_ids[]" value="<?php echo e($buku->id); ?>" 
                                       class="row-checkbox w-4 h-4 rounded border-gray-300 text-[#A4B465] focus:ring-[#A4B465] transition-all duration-200">
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 bg-gradient-to-br from-gray-100 to-gray-200 text-gray-700 rounded-full text-sm font-bold shadow-sm">
                                    <?php echo e($index + 1); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-16 h-20 overflow-hidden rounded-xl border-2 border-gray-200/80 mx-auto shadow-sm group-hover:shadow-md transition-all duration-300 bg-white">
                                    <?php if($buku->foto_buku): ?>
                                        <img src="<?php echo e(asset($buku->foto_buku)); ?>" alt="Cover <?php echo e($buku->judul_buku); ?>"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                            onerror="this.onerror=null; this.src='<?php echo e(asset('images/default-book.jpg')); ?>';">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('assets/image_default/image_default_book.jpeg')); ?>"
                                            alt="Cover default" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="max-w-xs">
                                    <p class="font-bold text-gray-900 line-clamp-2 text-base leading-tight group-hover:text-gray-800 transition-colors"><?php echo e($buku->judul_buku); ?></p>
                                    <?php if($buku->edisi): ?>
                                        <p class="text-gray-500 text-xs mt-1 font-medium">Edisi: <?php echo e($buku->edisi); ?></p>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-user-edit text-gray-400 text-xs"></i>
                                    <p class="text-gray-700 font-medium line-clamp-1"><?php echo e($buku->penulis); ?></p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-building text-gray-400 text-xs"></i>
                                    <p class="text-gray-600 line-clamp-1"><?php echo e($buku->penerbit); ?></p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center px-3 py-1 bg-gradient-to-br from-blue-100 to-blue-200 text-blue-800 rounded-full text-xs font-bold shadow-sm">
                                    <?php echo e($buku->tahun_terbit); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <?php if($buku->kategoris->count()): ?>
                                    <div class="flex flex-wrap gap-1">
                                        <?php $__currentLoopData = $buku->kategoris->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="inline-block px-2 py-1 bg-gradient-to-br from-[#A4B465]/20 to-[#8AA24F]/20 text-[#A4B465] rounded-lg text-xs font-semibold border border-[#A4B465]/10">
                                                <?php echo e($kategori->nama_kategori); ?>

                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($buku->kategoris->count() > 2): ?>
                                            <span class="inline-block px-2 py-1 bg-gray-100 text-gray-600 rounded-lg text-xs font-medium">
                                                +<?php echo e($buku->kategoris->count() - 2); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-gray-400 italic text-xs">Tidak ada kategori</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center w-10 h-10 bg-gradient-to-br from-green-100 to-green-200 text-green-800 rounded-xl text-sm font-bold shadow-sm group-hover:shadow-md transition-shadow">
                                    <?php echo e($buku->stok); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php if($buku->file_buku): ?>
                                    <a href="<?php echo e(asset($buku->file_buku)); ?>" target="_blank"
                                        class="inline-flex items-center justify-center w-10 h-10 bg-gradient-to-br from-purple-100 to-purple-200 text-purple-600 rounded-xl hover:from-purple-200 hover:to-purple-300 transition-all duration-200 shadow-sm hover:shadow-md group-hover:scale-105"
                                        title="Download File PDF">
                                        <i class="fas fa-file-pdf text-sm"></i>
                                    </a>
                                <?php else: ?>
                                    <div class="inline-flex items-center justify-center w-10 h-10 bg-gradient-to-br from-gray-100 to-gray-200 text-gray-400 rounded-xl shadow-sm">
                                        <i class="fas fa-file text-sm"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <!-- Pulihkan -->
                                    <form action="<?php echo e(route('admin.data_buku.restore', ['id' => $buku->id])); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <button type="submit" 
                                            class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 text-white rounded-xl flex items-center justify-center hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 group/tooltip relative"
                                            title="Pulihkan Buku">
                                            <i class="fas fa-undo text-sm"></i>
                                            <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover/tooltip:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                Pulihkan
                                            </div>
                                        </button>
                                    </form>
                                    
                                    <!-- Detail -->
                                    <a href="<?php echo e(route('admin.data_arsip.show', $buku->id)); ?>"
                                        class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl flex items-center justify-center hover:from-blue-600 hover:to-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 group/tooltip relative"
                                        title="Detail Buku">
                                        <i class="fas fa-eye text-sm"></i>
                                        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover/tooltip:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                            Detail
                                        </div>
                                    </a>
                                    
                                    <!-- Hapus Permanen -->
                                    <form action="<?php echo e(route('admin.data_arsip.destroy', $buku->id)); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" 
                                            class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 text-white rounded-xl flex items-center justify-center hover:from-red-600 hover:to-red-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 group/tooltip relative delete-permanent-btn"
                                            title="Hapus Permanen"
                                            data-title="<?php echo e($buku->judul_buku); ?>">
                                            <i class="fas fa-trash text-sm"></i>
                                            <div class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover/tooltip:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                                                Hapus
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="11" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-4 shadow-inner">
                                        <i class="fas fa-inbox text-3xl text-gray-300"></i>
                                    </div>
                                    <p class="text-2xl font-light text-gray-500 mb-2">Tidak ada buku terarsip</p>
                                    <p class="text-gray-400 text-sm">Semua buku aktif tersedia di data utama</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Smooth animations */
* {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 300ms;
}

/* Custom scrollbar for table */
.overflow-x-auto::-webkit-scrollbar {
    height: 8px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f8fafc;
    border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: linear-gradient(to right, #A4B465, #8AA24F);
    border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to right, #8AA24F, #75883f);
}

/* Glass morphism effect */
.backdrop-blur-sm {
    backdrop-filter: blur(8px);
}

/* Hover effects */
.hover\\:shadow-xl {
    transition: box-shadow 0.3s ease;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select All functionality
    const selectAll = document.getElementById('selectAll');
    const rowCheckboxes = document.querySelectorAll('.row-checkbox');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    const bulkRestoreBtn = document.getElementById('bulkRestoreBtn');
    const selectedIdsInput = document.getElementById('selectedIds');
    const selectedIdsRestoreInput = document.getElementById('selectedIdsRestore');

    selectAll.addEventListener('change', function() {
        const isChecked = this.checked;
        rowCheckboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
            checkbox.dispatchEvent(new Event('change'));
        });
        updateBulkButtons();
    });

    // Individual checkbox change
    rowCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (!this.checked) {
                selectAll.checked = false;
            } else {
                const allChecked = Array.from(rowCheckboxes).every(cb => cb.checked);
                selectAll.checked = allChecked;
            }
            updateBulkButtons();
        });
    });

    function updateBulkButtons() {
        const checkedBoxes = Array.from(rowCheckboxes).filter(cb => cb.checked);
        const checkedIds = checkedBoxes.map(cb => cb.value);
        const checkedCount = checkedIds.length;
        
        if (checkedCount > 0) {
            bulkDeleteBtn.disabled = false;
            bulkRestoreBtn.disabled = false;
            bulkDeleteBtn.innerHTML = `<i class="fas fa-trash text-sm group-hover:scale-110 transition-transform"></i><span>Hapus (${checkedCount}) Data</span>`;
            bulkRestoreBtn.innerHTML = `<i class="fas fa-undo text-sm group-hover:scale-110 transition-transform"></i><span>Pulihkan (${checkedCount}) Data</span>`;
            selectedIdsInput.value = checkedIds.join(',');
            selectedIdsRestoreInput.value = checkedIds.join(',');
        } else {
            bulkDeleteBtn.disabled = true;
            bulkRestoreBtn.disabled = true;
            bulkDeleteBtn.innerHTML = `<i class="fas fa-trash text-sm"></i><span>Hapus Data Terpilih</span>`;
            bulkRestoreBtn.innerHTML = `<i class="fas fa-undo text-sm"></i><span>Pulihkan Data Terpilih</span>`;
        }
    }

    // Delete confirmation with SweetAlert
    document.querySelectorAll('.delete-permanent-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const bookTitle = this.getAttribute('data-title');
            
            Swal.fire({
                title: 'Hapus Permanen?',
                html: `Buku <strong>"${bookTitle}"</strong> akan dihapus secara permanen dari sistem!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus Permanen!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                background: '#fff',
                backdrop: 'rgba(0,0,0,0.1)'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });
    });

    // Bulk actions confirmation
    bulkDeleteBtn.addEventListener('click', function(e) {
        if (this.disabled) return;
        
        const checkedCount = document.querySelectorAll('.row-checkbox:checked').length;
        Swal.fire({
            title: 'Hapus Permanen?',
            html: `<strong>${checkedCount} buku</strong> akan dihapus secara permanen dari sistem!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus Semua!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            background: '#fff',
            backdrop: 'rgba(0,0,0,0.1)'
        }).then((result) => {
            if (!result.isConfirmed) {
                e.preventDefault();
            }
        });
    });

    bulkRestoreBtn.addEventListener('click', function(e) {
        if (this.disabled) return;
        
        const checkedCount = document.querySelectorAll('.row-checkbox:checked').length;
        Swal.fire({
            title: 'Pulihkan Data?',
            html: `<strong>${checkedCount} buku</strong> akan dikembalikan ke sistem utama!`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Pulihkan Semua!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            background: '#fff',
            backdrop: 'rgba(0,0,0,0.1)'
        }).then((result) => {
            if (!result.isConfirmed) {
                e.preventDefault();
            }
        });
    });
});
</script>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/data_arsip/index.blade.php ENDPATH**/ ?>