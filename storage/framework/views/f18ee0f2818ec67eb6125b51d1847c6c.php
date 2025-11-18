<?php $__env->startSection('pageTitle', 'Detail Data Buku'); ?>

<?php $__env->startSection('content'); ?>
<div class="p-4 md:p-6 overflow-x-auto">
    <!-- Header Section -->
    <div class="text-left mb-6 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] rounded-2xl p-6 text-white shadow-xl">
        <div class="flex items-center space-x-4">
            <div class="bg-white/20 p-3 rounded-xl shadow-inner">
                <i class="fas fa-book-open text-2xl"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold mb-1 text-white">Detail Buku</h1>
                <p class="text-white/90 text-sm">Informasi lengkap buku perpustakaan</p>
            </div>
        </div>
        <div class="flex items-center space-x-3 mt-3 text-white/80">
            <div class="flex items-center space-x-1 bg-white/10 px-2 py-1 rounded-lg">
                <i class="fas fa-archive text-xs"></i>
                <span class="text-xs">Status: <strong>Terarsip</strong></span>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mb-6">
        <a href="<?php echo e(route('admin.data_arsip.index')); ?>"
            class="inline-flex items-center space-x-2 px-4 py-2 
                   border border-gray-300 text-gray-700 rounded-lg font-medium
                   hover:bg-gray-50 transition-colors text-sm">
            <i class="fas fa-arrow-left text-xs"></i>
            <span>Kembali ke Data Arsip</span>
        </a>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Cover & File -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Cover Book Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                    <i class="fas fa-image text-[#A4B465] text-sm"></i>
                    <span>Cover Buku</span>
                </h2>
                <div class="flex justify-center">
                    <?php if($buku->foto_buku): ?>
                        <div class="relative group">
                            <img src="<?php echo e(asset($buku->foto_buku)); ?>" alt="Cover <?php echo e($buku->judul_buku); ?>"
                                class="w-full max-w-48 h-64 object-cover rounded-lg shadow-md border border-gray-200 
                                       group-hover:scale-105 transition-transform duration-300"
                                onerror="this.onerror=null; this.src='<?php echo e(asset('images/default-book.jpg')); ?>';">
                        </div>
                    <?php else: ?>
                        <div class="w-full max-w-48 h-64 bg-gray-100 rounded-lg border-2 border-dashed border-gray-300 
                                  flex flex-col items-center justify-center text-gray-400">
                            <i class="fas fa-book text-2xl mb-2"></i>
                            <p class="text-xs font-medium">Tidak ada cover</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- File PDF Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                    <i class="fas fa-file-pdf text-[#A4B465] text-sm"></i>
                    <span>File Buku</span>
                </h2>
                <div class="flex justify-center">
                    <?php if($buku->file_buku): ?>
                        <a href="<?php echo e(asset($buku->file_buku)); ?>" target="_blank"
                            class="flex items-center justify-center space-x-2 px-4 py-2.5
                                   bg-gradient-to-r from-[#A4B465] to-[#8AA24F] text-white rounded-lg font-semibold
                                   hover:from-[#8AA24F] hover:to-[#75883f] transition-all duration-200
                                   shadow-md hover:shadow-lg text-sm w-full">
                            <i class="fas fa-download text-xs"></i>
                            <span>Download PDF</span>
                        </a>
                    <?php else: ?>
                        <div class="flex flex-col items-center justify-center space-y-1 text-gray-400 w-full">
                            <i class="fas fa-file text-xl"></i>
                            <p class="text-xs font-medium">Tidak ada file PDF</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Right Column - Book Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                    <i class="fas fa-info-circle text-[#A4B465] text-sm"></i>
                    <span>Informasi Buku</span>
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Judul (Full Width) -->
                    <div class="md:col-span-2 flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-heading text-[#A4B465] mt-0.5 text-xs"></i>
                        <div class="flex-1">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Judul Buku</label>
                            <p class="text-gray-800 text-sm font-medium"><?php echo e($buku->judul_buku); ?></p>
                        </div>
                    </div>

                    <!-- Penulis & Penerbit -->
                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-user-edit text-[#A4B465] mt-0.5 text-xs"></i>
                        <div class="flex-1">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Penulis</label>
                            <p class="text-gray-800 text-sm"><?php echo e($buku->penulis); ?></p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-building text-[#A4B465] mt-0.5 text-xs"></i>
                        <div class="flex-1">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Penerbit</label>
                            <p class="text-gray-800 text-sm"><?php echo e($buku->penerbit); ?></p>
                        </div>
                    </div>

                    <!-- Tahun & Bahasa -->
                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-calendar text-[#A4B465] mt-0.5 text-xs"></i>
                        <div class="flex-1">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Tahun Terbit</label>
                            <p class="text-gray-800 text-sm"><?php echo e($buku->tahun_terbit); ?></p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-language text-[#A4B465] mt-0.5 text-xs"></i>
                        <div class="flex-1">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Bahasa</label>
                            <p class="text-gray-800 text-sm"><?php echo e($buku->bahasa); ?></p>
                        </div>
                    </div>

                    <!-- Edisi & Stok -->
                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-layer-group text-[#A4B465] mt-0.5 text-xs"></i>
                        <div class="flex-1">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Edisi</label>
                            <p class="text-gray-800 text-sm"><?php echo e($buku->edisi ?: '-'); ?></p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-cubes text-[#A4B465] mt-0.5 text-xs"></i>
                        <div class="flex-1">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Stok</label>
                            <span class="inline-flex items-center justify-center px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">
                                <?php echo e($buku->stok); ?>

                            </span>
                        </div>
                    </div>

                    <!-- Halaman -->
                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-file-alt text-[#A4B465] mt-0.5 text-xs"></i>
                        <div class="flex-1">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Jumlah Halaman</label>
                            <p class="text-gray-800 text-sm"><?php echo e($buku->jumlah_halaman ?: '-'); ?></p>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="md:col-span-2 flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-tags text-[#A4B465] mt-0.5 text-xs"></i>
                        <div class="flex-1">
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Kategori</label>
                            <?php if($buku->kategoris->isNotEmpty()): ?>
                                <div class="flex flex-wrap gap-1 mt-1">
                                    <?php $__currentLoopData = $buku->kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="inline-block px-2 py-1 bg-[#A4B465]/10 text-[#A4B465] rounded text-xs font-medium border border-[#A4B465]/20">
                                            <?php echo e($kategori->nama_kategori); ?>

                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php else: ?>
                                <p class="text-gray-500 italic text-xs">Tidak ada kategori</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Card - Full Width -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                    <i class="fas fa-align-left text-[#A4B465] text-sm"></i>
                    <span>Deskripsi Buku</span>
                </h2>
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 min-h-[120px]">
                    <p class="text-gray-700 leading-relaxed text-sm whitespace-pre-line">
                        <?php echo e($buku->deskripsi ?: 'Tidak ada deskripsi tersedia untuk buku ini.'); ?>

                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row justify-center gap-3 mt-6 pt-6 border-t border-gray-200">
        <a href="<?php echo e(route('admin.data_buku.edit', $buku->id)); ?>"
            class="flex items-center justify-center space-x-2 px-5 py-2.5
                   bg-gradient-to-r from-[#A4B465] to-[#8AA24F] text-white rounded-lg font-semibold
                   hover:from-[#8AA24F] hover:to-[#75883f] transition-all duration-200
                   shadow-md hover:shadow-lg text-sm w-full sm:w-auto">
            <i class="fas fa-edit text-xs"></i>
            <span>Edit Buku</span>
        </a>
        
        <form action="<?php echo e(route('admin.data_buku.restore', ['id' => $buku->id])); ?>" method="POST" class="w-full sm:w-auto">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <button type="submit"
                class="w-full flex items-center justify-center space-x-2 px-5 py-2.5
                       bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg font-semibold
                       hover:from-green-600 hover:to-green-700 transition-all duration-200
                       shadow-md hover:shadow-lg text-sm">
                <i class="fas fa-undo text-xs"></i>
                <span>Pulihkan Buku</span>
            </button>
        </form>

        <form action="<?php echo e(route('admin.data_arsip.destroy', $buku->id)); ?>" method="POST" class="w-full sm:w-auto">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit"
                class="w-full flex items-center justify-center space-x-2 px-5 py-2.5
                       bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg font-semibold
                       hover:from-red-600 hover:to-red-700 transition-all duration-200
                       shadow-md hover:shadow-lg text-sm delete-permanent-btn"
                data-title="<?php echo e($buku->judul_buku); ?>">
                <i class="fas fa-trash text-xs"></i>
                <span>Hapus Permanen</span>
            </button>
        </form>
    </div>
</div>

<style>
/* Smooth animations */
* {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 200ms;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .p-6 {
        padding: 1rem;
    }
    
    .text-2xl {
        font-size: 1.5rem;
    }
}

/* Consistent container sizes */
.bg-white {
    border-radius: 0.75rem;
    border-width: 1px;
    border-color: #e5e7eb;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.p-6 {
    padding: 1.5rem;
}

/* Consistent spacing */
.space-y-6 > * + * {
    margin-top: 1.5rem;
}

/* Text wrapping for description */
.whitespace-pre-line {
    white-space: pre-line;
    word-wrap: break-word;
}

/* Grid layout optimization */
.grid-cols-3 {
    grid-template-columns: repeat(3, minmax(0, 1fr));
}

@media (max-width: 1024px) {
    .lg\:col-span-1 {
        grid-column: span 1 / span 1;
    }
    
    .lg\:col-span-2 {
        grid-column: span 2 / span 2;
    }
}

@media (max-width: 768px) {
    .grid-cols-1 {
        grid-template-columns: repeat(1, minmax(0, 1fr));
    }
    
    .lg\:col-span-1,
    .lg\:col-span-2 {
        grid-column: span 1 / span 1;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete confirmation
    document.querySelectorAll('.delete-permanent-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const bookTitle = this.getAttribute('data-title');
            
            if (!confirm(`Hapus permanen buku "${bookTitle}"? Tindakan ini tidak dapat dibatalkan!`)) {
                return false;
            }
            
            this.closest('form').submit();
        });
    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/data_arsip/show.blade.php ENDPATH**/ ?>