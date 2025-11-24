

<?php $__env->startSection('pageTitle', 'Detail Peminjaman'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-slate-800 mb-2">
                Detail Peminjaman
            </h1>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="<?php echo e(route('admin.data_peminjam.index')); ?>" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#A4B465]">
                            <i class="fas fa-home mr-2"></i>
                            Data Peminjam
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="text-sm font-medium text-gray-500">Detail</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <a href="<?php echo e(route('admin.data_peminjam.index')); ?>" 
           class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors flex items-center gap-2">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <!-- Card Detail -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Informasi Peminjaman -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-3 border-b border-gray-200">
                <i class="fas fa-info-circle text-[#A4B465] mr-2"></i>
                Informasi Peminjaman
            </h3>
            
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                        <?php if($peminjam->status == 'menunggu_konfirmasi'): ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-2"></i>
                                Menunggu Konfirmasi
                            </span>
                        <?php elseif($peminjam->status == 'dipinjam'): ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-book mr-2"></i>
                                Dipinjam
                            </span>
                        <?php elseif($peminjam->status == 'dikembalikan'): ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check mr-2"></i>
                                Dikembalikan
                            </span>
                        <?php elseif($peminjam->status == 'bermasalah'): ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Bermasalah
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Denda</label>
                        <p class="text-lg font-semibold <?php echo e($peminjam->denda > 0 ? 'text-red-600' : 'text-green-600'); ?>">
                            Rp <?php echo e(number_format($peminjam->denda, 0, ',', '.')); ?>

                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Pinjam</label>
                        <p class="text-gray-900 font-medium">
                            <?php echo e(\Carbon\Carbon::parse($peminjam->tanggal_pinjam)->translatedFormat('d F Y')); ?>

                        </p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Kembali</label>
                        <p class="text-gray-900 font-medium">
                            <?php echo e(\Carbon\Carbon::parse($peminjam->tanggal_kembali)->translatedFormat('d F Y')); ?>

                        </p>
                    </div>
                </div>

                <?php if($peminjam->status == 'dikembalikan'): ?>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Dikembalikan</label>
                    <p class="text-gray-900 font-medium">
                        <?php echo e(\Carbon\Carbon::parse($peminjam->updated_at)->translatedFormat('d F Y H:i')); ?>

                    </p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Informasi Peminjam -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-3 border-b border-gray-200">
                <i class="fas fa-user text-[#A4B465] mr-2"></i>
                Informasi Peminjam
            </h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Nama Lengkap</label>
                    <p class="text-gray-900 font-medium"><?php echo e($peminjam->user->name ?? '-'); ?></p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                    <p class="text-gray-900"><?php echo e($peminjam->user->email ?? '-'); ?></p>
                </div>
            </div>
        </div>

        <!-- Informasi Buku -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 lg:col-span-2">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-3 border-b border-gray-200">
                <i class="fas fa-book text-[#A4B465] mr-2"></i>
                Informasi Buku
            </h3>
            
            <div class="flex flex-col md:flex-row gap-6">
                <?php if($peminjam->buku->foto_buku ?? false): ?>
                <div class="flex-shrink-0">
                    <img src="<?php echo e(asset($peminjam->buku->foto_buku)); ?>" 
                         alt="<?php echo e($peminjam->buku->judul_buku); ?>" 
                         class="w-32 h-40 object-cover rounded-lg shadow-md">
                </div>
                <?php endif; ?>
                
                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Judul Buku</label>
                        <p class="text-gray-900 font-medium"><?php echo e($peminjam->buku->judul_buku ?? '-'); ?></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Penulis</label>
                        <p class="text-gray-900"><?php echo e($peminjam->buku->penulis ?? '-'); ?></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Penerbit</label>
                        <p class="text-gray-900"><?php echo e($peminjam->buku->penerbit ?? '-'); ?></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Tahun Terbit</label>
                        <p class="text-gray-900"><?php echo e($peminjam->buku->tahun_terbit ?? '-'); ?></p>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Deskripsi</label>
                        <p class="text-gray-900 text-sm leading-relaxed">
                            <?php echo e($peminjam->buku->deskripsi ?? 'Tidak ada deskripsi'); ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <?php if(in_array($peminjam->status, ['menunggu_konfirmasi', 'dipinjam'])): ?>
    <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h3>
        <div class="flex flex-wrap gap-3">
            <?php if($peminjam->status == 'menunggu_konfirmasi'): ?>
                <form action="<?php echo e(route('admin.data_peminjam.konfirmasi', $peminjam->id)); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2">
                        <i class="fas fa-check"></i>
                        Setujui Peminjaman
                    </button>
                </form>
                
                <form action="<?php echo e(route('admin.data_peminjam.batalkan', $peminjam->id)); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2"
                        onclick="return confirm('Yakin ingin membatalkan peminjaman ini?')">
                        <i class="fas fa-times"></i>
                        Tolak Peminjaman
                    </button>
                </form>
                
            <?php elseif($peminjam->status == 'dipinjam'): ?>
                <form action="<?php echo e(route('admin.data_peminjam.kembalikan', $peminjam->id)); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                        <i class="fas fa-undo"></i>
                        Konfirmasi Pengembalian
                    </button>
                </form>
                
                <form action="<?php echo e(route('admin.data_peminjam.masalah', $peminjam->id)); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2"
                        onclick="return confirm('Yakin melaporkan masalah pada peminjaman ini?')">
                        <i class="fas fa-exclamation-triangle"></i>
                        Laporkan Masalah
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/data_peminjam/show.blade.php ENDPATH**/ ?>