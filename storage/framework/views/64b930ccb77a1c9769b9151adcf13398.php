<?php $__env->startSection('pageTitle', 'Admin Dashboard - Data Arsip'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 font-poppins">
    <!-- Header Section -->
    <div class="text-left mb-8 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] rounded-2xl p-6 text-white shadow-lg">
        <div class="flex items-center space-x-4 mb-3">
            <div class="bg-white/20 p-3 rounded-full">
                <i class="fas fa-archive text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl lg:text-4xl font-bold mb-2 text-white">Manajemen Data Arsip</h1>
                <p class="text-white text-lg">Kelola dan pantau seluruh arsip buku di perpustakaan</p>
            </div>
        </div>
        <div class="flex items-center space-x-2 text-sm text-white">
            <i class="fas fa-chart-line"></i>
            <span>Total Arsip: <strong><?php echo e($buku_arsip->count()); ?></strong></span>
        </div>
    </div>

    <!-- Bulk Action Buttons -->
    <div class="flex flex-col sm:flex-row gap-3 mb-6">
        <button type="button" id="bulkDeleteBtn" disabled
            class="flex-1 flex items-center justify-center space-x-3 px-4 py-3 bg-red-500 text-white rounded-xl font-semibold hover:bg-red-600 transition-all duration-300 text-sm shadow-md transform hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
            <i class="fas fa-trash-alt text-sm"></i>
            <span>Hapus Data Terpilih</span>
        </button>

        <button type="button" id="bulkRestoreBtn" disabled
            class="flex-1 flex items-center justify-center space-x-3 px-4 py-3 bg-green text-white rounded-xl font-semibold hover:bg-green transition-all duration-300 text-sm shadow-md transform hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
            <i class="fas fa-undo-alt text-sm"></i>
            <span>Pulihkan Data Terpilih</span>
        </button>
    </div>

    <!-- Hidden Forms for Bulk Actions -->
    <form id="bulkDeleteArchiveForm" action="<?php echo e(route('admin.data_arsip.bulkDeleteArchive')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="selected_ids" id="selectedIds">
    </form>

    <form id="bulkRestoreForm" action="<?php echo e(route('admin.data_arsip.bulkRestore')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="selected_ids" id="selectedIdsRestore">
    </form>

    <!-- Hidden Form for Individual Delete -->
    <form id="deleteForm" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
    </form>

    <!-- Table Container -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table id="dataTableArsip" class="w-full text-sm">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100 text-gray-700 border-b border-gray-200">
                    <tr>
                        <th class="w-12 px-3 py-4 text-center font-semibold">
                            <input type="checkbox" id="selectAll" class="w-4 h-4 rounded border-gray-300 text-[#A4B465] focus:ring-[#A4B465] focus:ring-2">
                        </th>
                        <th class="px-4 py-4 text-center font-semibold">No</th>
                        <th class="px-4 py-4 text-center font-semibold">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-image text-[#A4B465]"></i>
                                <span>Cover</span>
                            </div>
                        </th>
                        <th class="px-4 py-4 text-left font-semibold">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-book text-[#A4B465]"></i>
                                <span>Informasi Buku</span>
                            </div>
                        </th>
                        <th class="px-4 py-4 text-left font-semibold">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-user-edit text-[#A4B465]"></i>
                                <span>Penulis</span>
                            </div>
                        </th>
                        <th class="px-4 py-4 text-left font-semibold">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-building text-[#A4B465]"></i>
                                <span>Penerbit</span>
                            </div>
                        </th>
                        <th class="px-4 py-4 text-center font-semibold">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-calendar text-[#A4B465]"></i>
                                <span>Tahun</span>
                            </div>
                        </th>
                        <th class="px-4 py-4 text-left font-semibold">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-tag text-[#A4B465]"></i>
                                <span>Kategori</span>
                            </div>
                        </th>
                        <th class="px-4 py-4 text-center font-semibold">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-cubes text-[#A4B465]"></i>
                                <span>Stok</span>
                            </div>
                        </th>
                        <th class="px-4 py-4 text-center font-semibold">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-file-pdf text-[#A4B465]"></i>
                                <span>File</span>
                            </div>
                        </th>
                        <th class="px-4 py-4 text-center font-semibold">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-cog text-[#A4B465]"></i>
                                <span>Aksi</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php $__currentLoopData = $buku_arsip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $buku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-50/80 transition-colors duration-150">
                            <td class="px-3 py-4 text-center">
                                <input type="checkbox" name="selected_ids[]" value="<?php echo e($buku->id); ?>"
                                    class="row-checkbox w-4 h-4 rounded border-gray-300 text-[#A4B465] focus:ring-[#A4B465] focus:ring-2">
                            </td>
                            <td class="px-4 py-4 text-center">
                                <span class="inline-flex items-center justify-center w-7 h-7 bg-gradient-to-br from-[#A4B465] to-[#8AA24F] text-white rounded-full text-xs font-bold shadow-sm">
                                    <?php echo e($index + 1); ?>

                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <div class="w-14 h-20 overflow-hidden rounded-lg border border-gray-200 mx-auto shadow-sm">
                                    <?php if($buku->foto_buku && Storage::disk('public')->exists($buku->foto_buku)): ?>
                                        <img src="<?php echo e(asset('storage/' . $buku->foto_buku)); ?>" class="w-full h-full object-cover" alt="<?php echo e($buku->judul_buku); ?>">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('assets/image_default/image_default_book.jpeg')); ?>" class="w-full h-full object-cover" alt="Default">
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="max-w-xs">
                                    <p class="font-bold text-gray-900 text-sm line-clamp-2"><?php echo e($buku->judul_buku); ?></p>
                                    <?php if($buku->edisi): ?>
                                        <p class="text-gray-500 text-xs mt-1 font-medium">Edisi: <?php echo e($buku->edisi); ?></p>
                                    <?php endif; ?>
                                    <?php if($buku->isbn ?? false): ?>
                                        <p class="text-gray-400 text-xs mt-1">ISBN: <?php echo e($buku->isbn); ?></p>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <p class="text-gray-700 text-sm line-clamp-1 font-medium"><?php echo e($buku->penulis); ?></p>
                            </td>
                            <td class="px-4 py-4">
                                <p class="text-gray-600 text-sm line-clamp-1 font-medium"><?php echo e($buku->penerbit); ?></p>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-bold">
                                    <?php echo e($buku->tahun_terbit); ?>

                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <?php if($buku->kategoris->count()): ?>
                                    <div class="flex flex-wrap gap-1.5">
                                        <?php $__currentLoopData = $buku->kategoris->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="inline-block px-2.5 py-1 bg-[#A4B465]/20 text-[#A4B465] rounded-full text-xs font-bold">
                                                <?php echo e($kategori->nama_kategori); ?>

                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($buku->kategoris->count() > 2): ?>
                                            <span class="inline-block px-2.5 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold">
                                                +<?php echo e($buku->kategoris->count() - 2); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-gray-400 italic text-xs">Tidak ada kategori</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <span class="inline-flex items-center justify-center w-9 h-9 bg-green-100 text-green-800 rounded-full text-xs font-bold">
                                    <?php echo e($buku->stok); ?>

                                </span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <?php
                                    $path = $buku->file_buku;
                                    $url = Storage::url($path);
                                ?>
                                <a href="<?php echo e($url); ?>" target="_blank" class="inline-block bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 text-xs" title="Lihat File">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <!-- Pulihkan -->
                                    <button type="button" 
                                        class="bg-green-50 hover:bg-green-100 text-green-600 p-2.5 rounded-lg transition-all duration-200 restore-btn" 
                                        title="Pulihkan Buku"
                                        data-id="<?php echo e($buku->id); ?>"
                                        data-title="<?php echo e($buku->judul_buku); ?>">
                                        <i class="fas fa-undo-alt text-sm"></i>
                                    </button>

                                    <!-- Detail -->
                                    <a href="<?php echo e(route('admin.data_arsip.show', $buku->id)); ?>" 
                                        class="bg-blue-50 hover:bg-blue-100 text-blue-600 p-2.5 rounded-lg transition-all duration-200" 
                                        title="Detail Buku">
                                        <i class="fas fa-eye text-sm"></i>
                                    </a>

                                    <!-- Hapus Permanen -->
                                    <button type="button" 
                                        class="bg-red-50 hover:bg-red-100 text-red-600 p-2.5 rounded-lg transition-all duration-200 delete-permanent-btn" 
                                        title="Hapus Permanen" 
                                        data-id="<?php echo e($buku->id); ?>" 
                                        data-title="<?php echo e($buku->judul_buku); ?>">
                                        <i class="fas fa-trash-alt text-sm"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#dataTableArsip').DataTable({
                responsive: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                ordering: true,
                searching: true,
                info: true,
                dom: '<"flex flex-col sm:flex-row justify-between items-center gap-4 mb-4 px-4 pt-4"lf>rt<"flex flex-col sm:flex-row justify-between items-center gap-4 mt-4 px-4 pb-4"ip>',
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    zeroRecords: "Data tidak ditemukan",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "›",
                        previous: "‹"
                    }
                },
                columnDefs: [
                    { orderable: false, targets: [0, 2, 9, 10] } // Checkbox, Cover, File, Aksi tidak bisa di-sort
                ]
            });

            // Custom styling untuk DataTables elements
            $('.dataTables_length select').addClass('px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465]');
            $('.dataTables_filter input').addClass('px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465] ml-2');
            $('.dataTables_length label, .dataTables_filter label').addClass('text-sm text-gray-700 font-medium');
            $('.dataTables_info').addClass('text-sm text-gray-600');
            $('.dataTables_paginate').addClass('flex gap-1');
            $('.paginate_button').addClass('px-3 py-1 border border-gray-300 rounded-lg text-sm hover:bg-[#A4B465] hover:text-white hover:border-[#A4B465] transition-colors');
            $('.paginate_button.current').addClass('bg-[#A4B465] text-white border-[#A4B465]');
            $('.paginate_button.disabled').addClass('opacity-50 cursor-not-allowed');

            // Select All functionality
            $('#selectAll').on('change', function() {
                $('.row-checkbox').prop('checked', this.checked);
                updateBulkButtons();
            });

            // Individual checkbox functionality
            $(document).on('change', '.row-checkbox', function() {
                const totalCheckboxes = $('.row-checkbox').length;
                const checkedCheckboxes = $('.row-checkbox:checked').length;
                $('#selectAll').prop('checked', totalCheckboxes === checkedCheckboxes);
                updateBulkButtons();
            });

            // Update bulk action buttons
            function updateBulkButtons() {
                const selectedCount = $('.row-checkbox:checked').length;
                const selectedIds = $('.row-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedCount > 0) {
                    $('#bulkDeleteBtn, #bulkRestoreBtn').prop('disabled', false).removeClass('cursor-not-allowed');
                    $('#selectedIds, #selectedIdsRestore').val(selectedIds.join(','));
                } else {
                    $('#bulkDeleteBtn, #bulkRestoreBtn').prop('disabled', true).addClass('cursor-not-allowed');
                    $('#selectedIds, #selectedIdsRestore').val('');
                }
            }

            // Bulk Delete Button Click
            $('#bulkDeleteBtn').on('click', function(e) {
                e.preventDefault();
                const selectedCount = $('.row-checkbox:checked').length;
                
                if (selectedCount === 0) {
                    Swal.fire({
                        title: 'Peringatan!',
                        text: 'Pilih minimal satu buku untuk dihapus.',
                        icon: 'warning',
                        confirmButtonColor: '#A4B465'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Konfirmasi Hapus Permanen',
                    html: `Apakah Anda yakin ingin menghapus <strong>${selectedCount}</strong> buku secara permanen?<br><small class="text-red-600">Data yang dihapus tidak dapat dikembalikan!</small>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus Permanen!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#bulkDeleteArchiveForm').submit();
                    }
                });
            });

            // Bulk Restore Button Click
            $('#bulkRestoreBtn').on('click', function(e) {
                e.preventDefault();
                const selectedCount = $('.row-checkbox:checked').length;
                
                if (selectedCount === 0) {
                    Swal.fire({
                        title: 'Peringatan!',
                        text: 'Pilih minimal satu buku untuk dipulihkan.',
                        icon: 'warning',
                        confirmButtonColor: '#A4B465'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Konfirmasi Pulihkan',
                    html: `Apakah Anda yakin ingin memulihkan <strong>${selectedCount}</strong> buku?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#22c55e',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Pulihkan!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#bulkRestoreForm').submit();
                    }
                });
            });

            // Individual Restore Button Click
            $(document).on('click', '.restore-btn', function(e) {
                e.preventDefault();
                const bukuId = $(this).data('id');
                const bukuTitle = $(this).data('title');
                const restoreUrl = "<?php echo e(route('admin.data_buku.restore', ':id')); ?>".replace(':id', bukuId);

                Swal.fire({
                    title: 'Konfirmasi Pulihkan',
                    html: `Apakah Anda yakin ingin memulihkan buku <strong>${bukuTitle}</strong>?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#22c55e',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Pulihkan!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create temporary form for restore
                        const form = $('<form>', {
                            'method': 'POST',
                            'action': restoreUrl
                        });
                        
                        const csrfToken = $('<input>', {
                            'type': 'hidden',
                            'name': '_token',
                            'value': '<?php echo e(csrf_token()); ?>'
                        });
                        
                        const methodField = $('<input>', {
                            'type': 'hidden',
                            'name': '_method',
                            'value': 'PUT'
                        });
                        
                        form.append(csrfToken).append(methodField);
                        $('body').append(form);
                        form.submit();
                    }
                });
            });

            // Individual Delete Permanent Button Click
            $(document).on('click', '.delete-permanent-btn', function(e) {
                e.preventDefault();
                const bukuId = $(this).data('id');
                const bukuTitle = $(this).data('title');
                const deleteUrl = "<?php echo e(route('admin.data_arsip.destroy', ':id')); ?>".replace(':id', bukuId);

                Swal.fire({
                    title: 'Konfirmasi Hapus Permanen',
                    html: `Apakah Anda yakin ingin menghapus buku <strong>${bukuTitle}</strong> secara permanen?<br><small class="text-red-600">Data yang dihapus tidak dapat dikembalikan!</small>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus Permanen!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        const deleteForm = $('#deleteForm');
                        deleteForm.attr('action', deleteUrl);
                        deleteForm.submit();
                    }
                });
            });

            // Success message
            <?php if(session('success')): ?>
                Swal.fire({
                    title: 'Sukses!',
                    text: '<?php echo e(session('success')); ?>',
                    icon: 'success',
                    confirmButtonColor: '#A4B465',
                    timer: 3000
                });
            <?php endif; ?>

            <?php if(session('error')): ?>
                Swal.fire({
                    title: 'Error!',
                    text: '<?php echo e(session('error')); ?>',
                    icon: 'error',
                    confirmButtonColor: '#ef4444'
                });
            <?php endif; ?>
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/data_arsip/index.blade.php ENDPATH**/ ?>