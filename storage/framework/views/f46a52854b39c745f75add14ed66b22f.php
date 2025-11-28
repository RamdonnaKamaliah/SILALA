<?php $__env->startSection('pageTitle', 'Data Buku'); ?>

<?php $__env->startSection('content'); ?>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="p-4 md:p-8 font-[Poppins] text-slate-800 bg-gray-50 min-h-screen">

        <div class="user-dashboard p-4 md:p-6 bg-gray-50 min-h-screen">
            <!-- Header Profesional -->
            <div class="flex items-center mb-6">
                <div class="bg-user-primary p-3 rounded-xl mr-4 shadow-sm">
                    <!-- Icon Buku warna hijau primary (DIBESARKAN) -->
                    <i class="fa-solid fa-book text-3xl" style="color: #A4B465;"></i>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-800 mb-1">
                        Tambah Data Buku
                    </h1>
                    <p class="text-gray-600 text-sm md:text-base">
                        <!-- Icon chart line juga aku gedein dikit -->
                        <i class="fa-solid fa-chart-line text-lg mr-2" style="color: #A4B465;"></i>
                        Pantau dan kelala data buku perpustakaan secara real-time
                    </p>
                </div>
            </div>

            <!-- ALERT SUCCESS -->
            <?php if(session('success')): ?>
                <div
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fa-solid fa-circle-check mr-2"></i>
                        <span><?php echo e(session('success')); ?></span>
                    </div>
                    <button type="button" onclick="this.parentElement.style.display='none'"
                        class="text-green-700 hover:text-green-900">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
            <?php endif; ?>

            <!-- ALERT ERROR -->
            <?php if(session('error')): ?>
                <div
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fa-solid fa-circle-exclamation mr-2"></i>
                        <span><?php echo e(session('error')); ?></span>
                    </div>
                    <button type="button" onclick="this.parentElement.style.display='none'"
                        class="text-red-700 hover:text-red-900">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
            <?php endif; ?>

            <!-- TOMBOL AKSI -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <h2 class="text-lg md:text-xl font-semibold text-[#A4B465] flex items-center gap-2">
                    <i class="fa-solid fa-list"></i> Daftar Buku
                </h2>
                <div x-data="{ open: false }" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                    <!-- Tombol Import -->
                    <button @click="open = true"
                        class="bg-yellow-400 text-black font-medium px-4 py-2 rounded-lg shadow hover:bg-yellow-500 transition w-full sm:w-auto text-center flex items-center justify-center gap-2">
                        <i class="fa-solid fa-file-import"></i> Import
                    </button>

                    <!-- Modal Import -->
                    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
                        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        <div @click.away="open = false"
                            class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md p-6 relative mx-4">
                            <!-- Header -->
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-bold text-gray-800 dark:text-white">Upload Excel Buku</h2>
                                <button @click="open = false"
                                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 text-xl">
                                    ✖
                                </button>
                            </div>

                            <!-- Body -->
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Gunakan template dibawah ini untuk format yang benar
                            </p>

                            <!-- Tombol Download Template -->
                            <a href="<?php echo e(asset('uploads/template/TEMPLATE_INPUT_DATA_BUKU_SILALA_NEW.xlsx')); ?>"
                                class="w-full bg-red-500 hover:bg-red-600 text-white text-center py-2 rounded-lg mb-4 transition flex items-center justify-center gap-2"
                                download>
                                <i class="fa-solid fa-download"></i> Download Template
                            </a>

                            <!-- Form Upload -->
                            <form action="<?php echo e(route('admin.data_buku.import')); ?>" method="POST"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <input type="file" name="file" accept=".xlsx,.xls" required
                                    class="block w-full text-gray-700 dark:text-gray-300 file:mr-4 file:py-2 file:px-4
                               file:rounded-l-lg file:border-0 file:text-sm file:font-semibold
                               file:bg-gray-200 file:text-gray-700
                               hover:file:bg-gray-300 dark:file:bg-gray-700 dark:file:text-white
                               mb-4 rounded-lg border border-gray-300 dark:border-gray-600">

                                <!-- Tombol Aksi -->
                                <div class="flex justify-end gap-2">
                                    <button type="button" @click="open = false"
                                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg transition">
                                        Batal
                                    </button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-[#A4B465] hover:bg-[#8A9A55] text-white rounded-lg transition flex items-center gap-2">
                                        <i class="fa-solid fa-upload"></i> Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <a href="<?php echo e(route('admin.data_buku.create')); ?>"
                            class="bg-[#A4B465] text-white font-medium px-4 py-2 rounded-lg shadow hover:bg-[#8A9A55] transition w-full sm:w-auto text-center flex items-center justify-center gap-2">
                            + Tambah Buku
                        </a>
                        <form id="bulkDeleteForm" action="<?php echo e(route('admin.data_buku.bulk-delete')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <input type="hidden" name="selected_ids" id="selectedIdsDelete">
                            <button type="submit" id="bulkDeleteBtn" disabled
                                class="px-4 py-2 text-white rounded-lg opacity-50 bg-gray-400 cursor-not-allowed">Hapus Data
                                Terpilih</button>
                        </form>

                        
                        <form id="bulkArchiveForm" action="<?php echo e(route('admin.data_buku.bulkArchive')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="selected_ids" id="selectedIdsArchive">
                            <button type="submit" id="bulkArchiveBtn" disabled
                                class="px-4 py-2 text-white rounded-lg opacity-50 bg-gray-400 cursor-not-allowed">Arsipkan
                                Data
                                Terpilih</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- TABLE -->
            <form id="bulkDeleteForm" action="<?php echo e(route('admin.data_buku.bulk-delete')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>

                <div class="bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-700" id="dataTable">
                            <thead class="bg-[#A4B465] text-white">
                                <tr>
                                    <th class="px-4 py-3 text-center w-12">
                                        <input type="checkbox" id="selectAll" class="w-4 h-4">
                                    </th>
                                    <th class="px-4 py-3 text-center font-semibold w-12">No</th>
                                    <th class="px-4 py-3 text-center font-semibold w-20">Foto</th>
                                    <th class="px-4 py-3 font-semibold">Judul</th>
                                    <th class="px-4 py-3 font-semibold">Penulis</th>
                                    <th class="px-4 py-3 font-semibold hidden md:table-cell">Penerbit</th>
                                    <th class="px-4 py-3 font-semibold hidden lg:table-cell">Tahun</th>
                                    <th class="px-4 py-3 font-semibold hidden lg:table-cell">Kategori</th>
                                    <th class="px-4 py-3 font-semibold hidden xl:table-cell">Edisi</th>
                                    <th class="px-4 py-3 text-center font-semibold">Stok</th>
                                    <th class="px-4 py-3 text-center font-semibold">File</th>
                                    <th class="px-4 py-3 text-center font-semibold w-32">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                <?php $__empty_1 = true; $__currentLoopData = $data_buku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="hover:bg-[#F5F7ED] transition">
                                        <td class="px-4 py-3 text-center">
                                            <input type="checkbox" name="selected_ids[]" value="<?php echo e($buku->id); ?>"
                                                class="row-checkbox w-4 h-4">
                                        </td>

                                        <td class="px-4 py-3 text-center"><?php echo e($loop->iteration); ?></td>

                                        <td class="px-4 py-3">
                                            <div class="w-16 h-20 overflow-hidden rounded-lg border mx-auto">
                                                <?php if($buku->foto_buku && Storage::disk('public')->exists($buku->foto_buku)): ?>
                                                    <img src="<?php echo e(asset('storage/' . $buku->foto_buku)); ?>"
                                                        class="w-full h-full object-cover">
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('assets/image_default/image_default_book.jpeg')); ?>"
                                                        class="w-full h-full object-cover">
                                                <?php endif; ?>

                                            </div>
                                        </td>

                                        <td class="px-4 py-3 font-medium text-slate-800">
                                            <div class="max-w-xs truncate" title="<?php echo e($buku->judul_buku); ?>">
                                                <?php echo e($buku->judul_buku); ?></div>
                                        </td>

                                        <td class="px-4 py-3 text-gray-600">
                                            <div class="max-w-xs truncate" title="<?php echo e($buku->penulis); ?>">
                                                <?php echo e($buku->penulis); ?></div>
                                        </td>

                                        <td class="px-4 py-3 text-gray-600 hidden md:table-cell">
                                            <div class="max-w-xs truncate" title="<?php echo e($buku->penerbit); ?>">
                                                <?php echo e($buku->penerbit); ?></div>
                                        </td>

                                        <td class="px-4 py-3 text-gray-600 hidden lg:table-cell"><?php echo e($buku->tahun_terbit); ?>

                                        </td>

                                        <td class="px-4 py-3 text-gray-600 hidden lg:table-cell">
                                            <?php if($buku->kategoris && $buku->kategoris->count()): ?>
                                                <div class="max-w-xs truncate"
                                                    title="<?php echo e($buku->kategoris->pluck('nama_kategori')->join(', ')); ?>">
                                                    <?php echo e($buku->kategoris->pluck('nama_kategori')->join(', ')); ?>

                                                </div>
                                            <?php else: ?>
                                                <span class="italic text-gray-400">Tidak Ada</span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="px-4 py-3 text-gray-600 hidden xl:table-cell"><?php echo e($buku->edisi ?? '-'); ?>

                                        </td>

                                        <td class="px-4 py-3 text-center">
                                            <span
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-full 
                                        <?php echo e($buku->stok > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                                <?php echo e($buku->stok); ?>

                                            </span>
                                        </td>

                                        <td class="px-4 py-2 border-b border-gray-300 text-center">
                                            <?php
                                                $path = $buku->file_buku;

                                                // Rapikan jika path lama masih mengandung 'storage/'
                                                $path = str_replace('storage/', '', $path);
                                                $path = str_replace('public/', '', $path);
                                            ?>

                                            <a href="<?php echo e(asset('storage/' . $path)); ?>" target="_blank"
                                                class="inline-block bg-blue-600 text-white px-3 py-1 rounded-lg shadow hover:bg-blue-700 text-xs">
                                                Lihat File
                                            </a>

                                        </td>


                                        <td class="px-4 py-3 text-center">
                                            <div class="flex justify-center gap-2">
                                                <a href="<?php echo e(route('admin.data_buku.show', $buku->id)); ?>"
                                                    class="text-blue-600 hover:text-blue-800 p-2 rounded-full hover:bg-blue-50 transition"
                                                    title="Detail">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </a>

                                                <a href="<?php echo e(route('admin.data_buku.edit', $buku->id)); ?>"
                                                    class="text-green-600 hover:text-green-800 p-2 rounded-full hover:bg-green-50 transition"
                                                    title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>

                                                <form action="<?php echo e(route('admin.data_buku.archive', $buku->id)); ?>"
                                                    method="POST" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <button type="submit" onclick="return confirm('Arsipkan buku ini?')"
                                                        class="text-yellow-600 hover:text-yellow-800 p-2 rounded-full hover:bg-yellow-50 transition"
                                                        title="Arsipkan">
                                                        <i class="fa-solid fa-archive"></i>
                                                    </button>
                                                </form>

                                                <form action="<?php echo e(route('admin.data_buku.destroy', $buku->id)); ?>"
                                                    method="POST" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')"
                                                        class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-red-50 transition"
                                                        title="Hapus">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="12" class="px-4 py-8 text-center text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <i class="fa-solid fa-book-open-reader text-4xl text-gray-300 mb-4"></i>
                                                <p class="text-lg font-medium">Tidak ada data buku</p>
                                                <p class="text-sm mt-2">Silakan tambah buku baru atau periksa filter.</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript untuk fungsi interaktif -->
    

    <style>
        /* Style untuk truncate text dengan ellipsis */
        .truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Responsif untuk tabel */
        @media (max-width: 768px) {
            .table-container {
                overflow-x: auto;
            }
        }

        /* Style untuk ikon aksi */
        .action-btn {
            transition: all 0.2s ease;
        }

        .action-btn:hover {
            transform: scale(1.1);
        }

        /* Style untuk empty state */
        .empty-state {
            padding: 3rem 1rem;
            text-align: center;
            color: #6b7280;
        }

        /* Style untuk modal Alpine.js */
        [x-cloak] {
            display: none !important;
        }

        /* Style untuk checkbox */
        input[type="checkbox"] {
            cursor: pointer;
        }

        /* Style untuk tombol aksi */
        .btn-action {
            transition: all 0.2s ease-in-out;
        }

        .btn-action:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/data_buku/index.blade.php ENDPATH**/ ?>