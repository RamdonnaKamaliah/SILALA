<?php $__env->startSection('pageTitle', 'Data Buku'); ?>

<?php $__env->startSection('content'); ?>
<!-- FONT & ICON -->
<div class="p-4 md:p-8 font-[Inter] text-slate-800 bg-gray-50 min-h-screen">

    <!-- HEADER -->
    <div class="text-center mb-8">
        <h1 class="text-2xl md:text-4xl font-bold text-slate-800 mb-2 flex items-center justify-center gap-2 flex-wrap">
            <i class="fa-solid fa-book text-[#A4B465]"></i>
            Data Buku Perpustakaan
        </h1>
        <p class="text-gray-500 text-sm md:text-base">
            Kelola dan pantau seluruh koleksi buku dengan mudah dan cepat.
        </p>
    </div>

    <!-- TOMBOL AKSI -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h2 class="text-lg md:text-xl font-semibold text-[#A4B465] flex items-center gap-2">
            <i class="fa-solid fa-list"></i> Daftar Buku
        </h2>
        <div x-data="{ open: false }" class="flex flex-wrap items-center gap-3 w-full md:w-auto">

            <button @click="open = true"
                    class="bg-yellow-400 text-black font-medium px-4 py-2 rounded-lg shadow hover:bg-yellow-500 transition w-full sm:w-auto text-center">
                    Import
            </button>
            <!-- Modal Import -->
                <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                    <div @click.away="open = false"
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md p-6 relative">
                        <!-- Header -->
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-bold text-gray-800 dark:text-white">Upload Excel Buku</h2>
                            <button @click="open = false"
                                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                ✖
                            </button>
                        </div>

                        <!-- Body -->
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            Gunakan template dibawah ini untuk format yang benar
                        </p>

                        <!-- Tombol Download Template -->
                        <a href="<?php echo e(asset('uploads/template/TEMPLATE_INPUT_DATA_BUKU_SILALA_NEW.xlsx')); ?>"
                            class="block w-full bg-red-500 hover:bg-red-600 text-white text-center py-2 rounded-lg mb-4 transition"
                            download>
                            ⬇️ Download Template
                        </a>

                        <!-- Form Upload -->
                        <form action="<?php echo e(route('admin.data_buku.import')); ?>" method="POST" enctype="multipart/form-data">
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
                                    Close
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            <a href="<?php echo e(route('admin.data_buku.create')); ?>"
               class="bg-[#A4B465] text-white font-medium px-4 py-2 rounded-lg shadow hover:bg-[#8A9A55] transition w-full sm:w-auto text-center">
                <i class="fa-solid fa-plus mr-1"></i> Tambah Buku
            </a>
            <button id="bulkDeleteBtn"
                class="bg-gray-400 text-white font-medium px-4 py-2 rounded-lg shadow transition cursor-not-allowed opacity-50 w-full sm:w-auto text-center"
                disabled>
                <i class="fa-solid fa-trash"></i> Hapus Data Terpilih
            </button>
        </div>
    </div>
    

    <!-- DATA TABLE CONTROL -->
    <div id="datatable-controls"
        class="flex flex-col sm:flex-row justify-between items-start sm:items-center bg-white border border-gray-200 rounded-2xl shadow p-4 mb-4 gap-3">
        <div class="flex items-center gap-2 text-sm">
            <label for="entries" class="text-gray-700">Show</label>
            <select id="entries" class="border rounded-lg px-2 py-1 focus:ring-2 focus:ring-[#A4B465]">
                <option>5</option>
                <option selected>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            <span class="text-gray-700">entries</span>
        </div>
        <div class="flex items-center gap-2 text-sm w-full sm:w-auto">
            <label for="search" class="text-gray-700">Search:</label>
            <input type="text" id="search"
                class="border rounded-lg px-3 py-1 focus:ring-2 focus:ring-[#A4B465] w-full sm:w-auto"
                placeholder="Cari buku...">
        </div>
    </div>

    <!-- TABLE -->
    <form id="bulkDeleteForm" action="<?php echo e(route('admin.data_buku.bulk-delete')); ?>" method="POST"> <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>

        <!-- 🔥 GANTI INI KE POST SESUAI ROUTE -->
        

        <div class="bg-white border border-gray-200 rounded-2xl shadow-xl p-0 overflow-hidden">
            <div class="rounded-2xl overflow-hidden">
                <div class="overflow-x-auto p-4 md:p-6">
                    <table id="dataTable" class="w-full text-sm divide-y divide-gray-200 min-w-[1000px]">
                        <thead class="bg-[#A4B465] text-white">
                            <tr>
                                <th class="px-3 py-3 text-center"><input type="checkbox" id="selectAll" name="selected_ids[]" class="w-4 h-4"></th>
                                <th class="px-4 py-3 text-center font-semibold">No</th>
                                <th class="px-4 py-3 text-center font-semibold">Foto</th>
                                <th class="px-4 py-3 text-left font-semibold">Judul</th>
                                <th class="px-4 py-3 text-left font-semibold">Penulis</th>
                                <th class="px-4 py-3 text-left font-semibold">Penerbit</th>
                                <th class="px-4 py-3 text-left font-semibold">Tahun Terbit</th>
                                <th class="px-4 py-3 text-left font-semibold">Kategori</th>
                            
                                <th class="px-4 py-3 text-left font-semibold">Edisi</th>
                                <th class="px-4 py-3 text-left font-semibold">Stok</th>
                                <th class="px-4 py-3 text-left font-semibold">File</th>
                            
                                <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700">
                            <?php $__currentLoopData = $data_buku->where('status', 'aktif'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-[#F5F7ED] transition">
                                <td class="px-3 py-3 text-center">
                                    <input type="checkbox" name="selected_ids[]" value="<?php echo e($buku->id); ?>" class="row-checkbox w-4 h-4">
                                </td>
                                <td class="px-4 py-3 text-center"><?php echo e($loop->iteration); ?></td>
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
                                <td class="px-4 py-3 font-medium text-slate-800"><?php echo e($buku->judul_buku); ?></td>
                                <td class="px-4 py-3 text-gray-600"><?php echo e($buku->penulis); ?></td>
                                <td class="px-4 py-3 text-gray-600"><?php echo e($buku->penerbit); ?></td>
                                <td class="px-4 py-3 text-gray-600"><?php echo e($buku->tahun_terbit); ?></td>
                     
                                <td class="px-4 py-3 text-gray-600">
                                    <?php if($buku->kategoris->count()): ?>
                                        <?php echo e($buku->kategoris->pluck('nama_kategori')->join(', ')); ?>

                                    <?php else: ?>
                                        <span class="italic text-gray-400">Tidak Ada</span>
                                    <?php endif; ?>
                                </td>
                        
                                <td class="px-4 py-3 text-gray-600"><?php echo e($buku->edisi); ?></td>
                                <td class="px-4 py-3 text-gray-600"><?php echo e($buku->stok); ?></td>
                                <td class="px-4 py-3 text-gray-600">
                                   <?php if($buku->file_buku): ?>
                                        <a href="<?php echo e(asset($buku->file_buku)); ?>" target="_blank"
                                            class="inline-block bg-blue-600 text-white px-3 py-1 rounded-lg shadow hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 transition text-xs">
                                            Lihat File
                                        </a>
                                    <?php else: ?>
                                        <span class="text-gray-400 italic text-xs">Tidak ada file</span>
                                    <?php endif; ?>

                                </td>
                        
                                <td class="px-4 py-3 text-center">
                                    <div class="flex justify-center gap-3">
                                        <a href="<?php echo e(route('admin.data_buku.show', $buku->id)); ?>" class="text-[#A4B465] hover:text-[#8A9A55]" title="Detail">
                                            <i class="fa-solid fa-circle-info"></i>
                                        </a>
                                        <a href="<?php echo e(route('admin.data_buku.edit', $buku->id)); ?>" class="text-[#A4B465] hover:text-[#8A9A55]" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                        
                                        <form action="<?php echo e(route('admin.data_buku.destroy', $buku->id)); ?>" method="POST"
                                            class="inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-red-600 hover:text-red-800 delete-btn"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                                Hapus
                                            </button>
                                        </form>

                                        <form action="<?php echo e(route('admin.data_buku.archive', ['id' => $buku->id])); ?>"
                                            method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <button type="submit"
                                                onclick="return confirm('Arsipkan buku ini?')">Arsipkan</button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/data_buku/index.blade.php ENDPATH**/ ?>