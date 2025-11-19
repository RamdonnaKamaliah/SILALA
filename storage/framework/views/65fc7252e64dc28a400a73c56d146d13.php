<?php $__env->startSection('pageTitle', 'Admin Dashboard - Data Arsip'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="text-primary font-bold text-center mb-4">Data Buku Terarsip</h1>

    
    <div class="mb-4 flex gap-2">
        <form id="bulkDeleteArchiveForm" action="<?php echo e(route('admin.data_arsip.bulkDeleteArchive')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <input type="hidden" name="selected_ids" id="selectedIds">
            <button type="submit" id="bulkDeleteBtn" disabled
                class="px-4 py-2 text-white rounded-lg opacity-50 bg-gray-400 cursor-not-allowed">
                Hapus Data Terpilih
            </button>
        </form>

        <form action="<?php echo e(route('admin.data_arsip.bulkRestore')); ?>" method="POST" id="bulkRestoreForm">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="selected_ids" id="selectedIdsRestore">
            <button type="submit" id="bulkRestoreBtn" disabled
                class="px-4 py-2 text-white rounded-lg opacity-50 bg-gray-400 cursor-not-allowed">
                Pulihkan Data Terpilih
            </button>
        </form>
    </div>

    
    <table id="dataTable" class="min-w-full border border-gray-300 text-sm text-gray-800">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="w-12 px-2 py-2 border-b text-center"><input type="checkbox" id="selectAll"></th>
                <th class="px-4 py-2 border-b">No</th>
                <th class="px-4 py-2 border-b">Foto Buku</th>
                <th class="px-4 py-2 border-b">Judul</th>
                <th class="px-4 py-2 border-b">Penulis</th>
                <th class="px-4 py-2 border-b">Penerbit</th>
                <th class="px-4 py-2 border-b">Tahun Terbit</th>
                <th class="px-4 py-2 border-b">Kategori</th>
                <th class="px-4 py-2 border-b">Edisi</th>
                <th class="px-4 py-2 border-b">Stok</th>
                <th class="px-4 py-2 border-b">File Buku</th>
                <th class="px-4 py-2 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $buku_arsip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $buku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="w-12 px-2 py-2 text-center"><input type="checkbox" class="row-checkbox"
                            value="<?php echo e($buku->id); ?>"></td>
                    <td class="px-4 py-2 text-center"><?php echo e($index + 1); ?></td>
                    <td class="px-4 py-2 border-b border-gray-300">
                        <?php if($buku->foto_buku): ?>
                            <div class="w-16 h-20 overflow-hidden rounded-lg border-2 mx-auto">
                                <img src="<?php echo e(asset($buku->foto_buku)); ?>" alt="Foto Buku <?php echo e($buku->judul_buku); ?>"
                                    class="w-full h-full object-cover"
                                    onerror="this.onerror=null; this.src='<?php echo e(asset('images/default-book.jpg')); ?>';">
                            </div>
                        <?php else: ?>
                            <div
                                class="w-16 h-20 bg-gray-200 flex items-center justify-center text-gray-500 rounded-lg border mx-auto">
                                <img src="<?php echo e(asset('assets/image_default/image_default_book.jpeg')); ?>"
                                    alt="Foto default buku" class="w-full h-full object-cover">
                            </div>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-2"><?php echo e($buku->judul_buku); ?></td>
                    <td class="px-4 py-2"><?php echo e($buku->penulis); ?></td>
                    <td class="px-4 py-2"><?php echo e($buku->penerbit); ?></td>
                    <td class="px-4 py-2"><?php echo e($buku->tahun_terbit); ?></td>
                    <td class="px-4 py-2 border-b border-gray-300">
                        <?php if($buku->kategoris->count()): ?>
                            <?php echo e($buku->kategoris->pluck('nama_kategori')->join(', ')); ?>

                        <?php else: ?>
                            <span class="text-gray-500 italic">Tidak Ada Kategori</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-2"><?php echo e($buku->edisi); ?></td>
                    <td class="px-4 py-2 text-center"><?php echo e($buku->stok); ?></td>
                    <td class="px-4 py-2 border-b border-gray-300 text-center">
                        <?php if($buku->file_buku): ?>
                            <a href="<?php echo e(asset($buku->file_buku)); ?>" target="_blank"
                                class="inline-block bg-blue-600 text-white px-3 py-1 rounded-lg shadow hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 transition text-xs">
                                Lihat File
                            </a>
                        <?php else: ?>
                            <span class="text-gray-400 italic text-xs">Tidak ada file</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-2 text-center">
                        <form action="<?php echo e(route('admin.data_buku.restore', ['id' => $buku->id])); ?>" method="POST"
                            style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="bg-green-600 hover:bg-green-700 px-3 py-1 rounded-lg text-white">
                                Pulihkan
                            </button>
                        </form>
                        <a href="<?php echo e(route('admin.data_arsip.show', $buku->id)); ?>"
                            class="bg-yellow-400 hover:bg-green-700 text-white px-3 py-1 rounded-lg">
                            Detail
                        </a>
                        <form action="<?php echo e(route('admin.data_arsip.destroy', $buku->id)); ?>" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini secara permanen?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr> 
                    <td colspan="12" class="text-center py-3 text-gray-500">Belum ada buku terarsip</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('selectAll');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');
            const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
            const bulkRestoreBtn = document.getElementById('bulkRestoreBtn');
            const selectedIdsInput = document.getElementById('selectedIds');
            const selectedIdsRestoreInput = document.getElementById('selectedIdsRestore');

            // Select All functionality
            selectAll.addEventListener('change', function() {
                rowCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAll.checked;
                });
                updateBulkButtons();
            });

            // Individual checkbox functionality
            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateBulkButtons);
            });

            function updateBulkButtons() {
                const selectedIds = Array.from(rowCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                // Update hidden inputs
                selectedIdsInput.value = selectedIds.join(',');
                selectedIdsRestoreInput.value = selectedIds.join(',');

                // Enable/disable buttons
                const hasSelection = selectedIds.length > 0;
                
                bulkDeleteBtn.disabled = !hasSelection;
                bulkRestoreBtn.disabled = !hasSelection;
                
                if (hasSelection) {
                    bulkDeleteBtn.classList.remove('opacity-50', 'bg-gray-400', 'cursor-not-allowed');
                    bulkDeleteBtn.classList.add('bg-red-600', 'hover:bg-red-700', 'cursor-pointer');
                    
                    bulkRestoreBtn.classList.remove('opacity-50', 'bg-gray-400', 'cursor-not-allowed');
                    bulkRestoreBtn.classList.add('bg-green-600', 'hover:bg-green-700', 'cursor-pointer');
                } else {
                    bulkDeleteBtn.classList.add('opacity-50', 'bg-gray-400', 'cursor-not-allowed');
                    bulkDeleteBtn.classList.remove('bg-red-600', 'hover:bg-red-700', 'cursor-pointer');
                    
                    bulkRestoreBtn.classList.add('opacity-50', 'bg-gray-400', 'cursor-not-allowed');
                    bulkRestoreBtn.classList.remove('bg-green-600', 'hover:bg-green-700', 'cursor-pointer');
                }
            }

            // Konfirmasi sebelum bulk delete
            document.getElementById('bulkDeleteArchiveForm').addEventListener('submit', function(e) {
                const selectedIds = selectedIdsInput.value.split(',').filter(id => id !== '');
                if (selectedIds.length === 0) {
                    e.preventDefault();
                    alert('Pilih setidaknya satu data untuk dihapus.');
                    return;
                }
                
                if (!confirm(`Apakah Anda yakin ingin menghapus ${selectedIds.length} data secara permanen?`)) {
                    e.preventDefault();
                }
            });

            // Konfirmasi sebelum bulk restore
            document.getElementById('bulkRestoreForm').addEventListener('submit', function(e) {
                const selectedIds = selectedIdsRestoreInput.value.split(',').filter(id => id !== '');
                if (selectedIds.length === 0) {
                    e.preventDefault();
                    alert('Pilih setidaknya satu data untuk dipulihkan.');
                    return;
                }
                
                if (!confirm(`Apakah Anda yakin ingin memulihkan ${selectedIds.length} data?`)) {
                    e.preventDefault();
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views\admin\data_arsip\index.blade.php ENDPATH**/ ?>