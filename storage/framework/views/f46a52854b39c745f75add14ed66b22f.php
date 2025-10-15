<?php $__env->startSection('pageTitle', 'Admin Dashboard - Data Buku'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 overflow-x-auto min-h-screen bg-gradient-to-br from-purple-50 via-white to-purple-100 font-[Nunito_Sans]">

    <!-- Header -->
    <div class="flex flex-col items-center justify-center mb-10 text-center">
        <div class="flex items-center gap-3 mb-3">
            <i class="fa-solid fa-book-open-reader text-4xl text-transparent bg-clip-text bg-gradient-to-r from-[#4b0082] to-[#7b2cbf] drop-shadow-md"></i>
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#4b0082] to-[#7b2cbf]">
                    Data Buku
                </span> Perpustakaan
            </h1>
        </div>
        <p class="text-gray-500 text-sm md:text-base max-w-xl">
            Kelola koleksi buku dengan gaya elegan, modern, dan nyaman dibaca 💜
        </p>
    </div>

    <!-- Tombol Tambah -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h2 class="text-lg md:text-xl font-semibold text-gray-700 flex items-center gap-2">
            <i class="fa-solid fa-layer-group text-[#4b0082]"></i> Daftar Buku
        </h2>
        <a href="<?php echo e(route('admin.data_buku.create')); ?>"
           class="flex items-center gap-2 bg-gradient-to-r from-[#4b0082] to-[#7b2cbf] text-white px-5 py-2.5 rounded-xl shadow-lg hover:shadow-purple-300/70 hover:scale-[1.03] transition-all duration-300 ease-in-out">
           <i class="fa-solid fa-circle-plus"></i> Tambah Buku
        </a>
    </div>

    <!-- Tabel -->
    <div class="bg-white rounded-3xl shadow-lg border border-gray-200 overflow-x-auto custom-scrollbar">
        <table class="min-w-full text-sm md:text-base">
            <thead class="bg-gradient-to-r from-[#4b0082] to-[#7b2cbf] text-white shadow-md">
                <tr>
                    <th class="px-5 py-3 text-left font-semibold">Foto</th>
                    <th class="px-5 py-3 text-left font-semibold">Judul</th>
                    <th class="px-5 py-3 text-left font-semibold">Penulis</th>
                    <th class="px-5 py-3 text-left font-semibold">Penerbit</th>
                    <th class="px-5 py-3 text-left font-semibold">Tahun</th>
                    <th class="px-5 py-3 text-left font-semibold">Bahasa</th>
                    <th class="px-5 py-3 text-left font-semibold">Kategori</th>
                    <th class="px-5 py-3 text-left font-semibold">Halaman</th>
                    <th class="px-5 py-3 text-left font-semibold">Edisi</th>
                    <th class="px-5 py-3 text-left font-semibold">Deskripsi</th>
                    <th class="px-5 py-3 text-left font-semibold">Stok</th>
                    <th class="px-5 py-3 text-center font-semibold">File</th>
                    <th class="px-5 py-3 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php $__currentLoopData = $data_buku; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-purple-50 transition-all duration-200 even:bg-gray-50">
                    <td class="px-5 py-3 text-center">
                        <?php if($buku->foto_buku): ?>
                            <div class="w-12 h-16 mx-auto overflow-hidden rounded-md border border-gray-200 shadow-sm">
                                <img src="<?php echo e(asset($buku->foto_buku)); ?>" alt="Foto Buku" class="w-full h-full object-cover">
                            </div>
                        <?php else: ?>
                            <div class="w-12 h-16 bg-gray-100 flex items-center justify-center text-gray-400 text-xs mx-auto rounded-md border">
                                <i class="fa-regular fa-image"></i>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td class="px-5 py-3 font-medium text-gray-900"><?php echo e($buku->judul_buku); ?></td>
                    <td class="px-5 py-3 text-gray-700"><?php echo e($buku->penulis); ?></td>
                    <td class="px-5 py-3 text-gray-700"><?php echo e($buku->penerbit); ?></td>
                    <td class="px-5 py-3 text-gray-700"><?php echo e($buku->tahun_terbit); ?></td>
                    <td class="px-5 py-3 text-gray-700"><?php echo e($buku->bahasa); ?></td>
                    <td class="px-5 py-3">
                        <span class="px-2 py-1 rounded-lg text-xs font-semibold
                            <?php if($buku->kategori === 'Novel'): ?> bg-purple-100 text-[#4b0082]
                            <?php elseif($buku->kategori === 'Komik'): ?> bg-pink-100 text-pink-700
                            <?php elseif($buku->kategori === 'Pelajaran'): ?> bg-indigo-100 text-indigo-700
                            <?php else: ?> bg-violet-100 text-violet-700 <?php endif; ?>">
                            <?php echo e($buku->kategori); ?>

                        </span>
                    </td>
                    <td class="px-5 py-3 text-gray-700"><?php echo e($buku->jumlah_halaman); ?></td>
                    <td class="px-5 py-3 text-gray-700"><?php echo e($buku->edisi); ?></td>
                    <td class="px-5 py-3 text-gray-600"><?php echo e(Str::limit($buku->deskripsi, 60)); ?></td>
                    <td class="px-5 py-3 text-center font-semibold text-gray-800"><?php echo e($buku->stok); ?></td>
                    <td class="px-5 py-3 text-center">
                        <?php if($buku->file_buku): ?>
                            <a href="<?php echo e(asset($buku->file_buku)); ?>" target="_blank"
                               class="inline-flex items-center gap-1 bg-purple-100 text-[#4b0082] px-3 py-1.5 rounded-lg hover:bg-purple-200 transition">
                               <i class="fa-solid fa-eye"></i> Lihat
                            </a>
                        <?php else: ?>
                            <span class="text-gray-400 italic">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-5 py-3 text-center">
                        <div class="flex justify-center gap-3">
                            <form action="<?php echo e(route('admin.data_buku.destroy', $buku->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600 hover:text-red-800 transition" title="Hapus">
                                    <i class="fa-solid fa-trash-can text-lg"></i>
                                </button>
                            </form>
                            <a href="<?php echo e(route('admin.data_buku.show', $buku->id)); ?>" title="Detail"
                               class="text-green-600 hover:text-green-800 transition">
                               <i class="fa-solid fa-circle-info text-lg"></i>
                            </a>
                            <a href="<?php echo e(route('admin.data_buku.edit', $buku->id)); ?>" title="Edit"
                               class="text-[#4b0082] hover:text-[#7b2cbf] transition">
                               <i class="fa-solid fa-pen-to-square text-lg"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
    body { font-family: 'Nunito Sans', sans-serif; }

    /* Scrollbar */
    .custom-scrollbar::-webkit-scrollbar { height: 8px; }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: linear-gradient(to right, #4b0082, #7b2cbf);
        border-radius: 8px;
    }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; }

    /* Table */
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 900px;
    }

    th {
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.05em;
    }

    td, th {
        padding: 0.9rem 1rem;
        vertical-align: middle;
    }

    tbody tr {
        transition: all 0.25s ease;
    }

    tbody tr:hover {
        background-color: #f5f0ff !important;
    }

    @media (max-width: 768px) {
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
        th, td {
            font-size: 0.85rem;
            padding: 0.6rem;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/data_buku/index.blade.php ENDPATH**/ ?>