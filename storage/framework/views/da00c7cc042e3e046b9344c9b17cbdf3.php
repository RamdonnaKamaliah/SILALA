


<?php $__env->startSection('pageTitle', 'Detail Data Buku'); ?>

<?php $__env->startSection('content'); ?>
    <div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-50 py-8 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header dengan Breadcrumb -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-book-open text-[#7a9140] mr-3"></i>
                        <span>Detail Buku</span>
                    </h1>
                    <a href="<?php echo e(route('superadmin.data_buku.index')); ?>"
                        class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-200 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-green-50 hover:text-[#7a9140] transition-all duration-300 hover:border-[#a4b465]">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali ke Daftar Buku</span>
                    </a>
                </div>
            </div>

            <!-- Card Detail Buku -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-green-100">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">
                    <!-- Kolom Gambar & File -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Foto Buku -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-image text-[#7a9140] mr-2"></i>
                                <span>Foto Buku</span>
                            </h3>
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-4 flex justify-center">
                                <?php if($buku->foto_buku && Storage::disk('public')->exists($buku->foto_buku)): ?>
                                    <img src="<?php echo e(asset('storage/' . $buku->foto_buku)); ?>"
                                        class="w-full h-full object-cover">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('assets/image_default/image_default_book.jpeg')); ?>"
                                        class="w-full h-full object-cover">
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- File Buku -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-file-pdf text-[#7a9140] mr-2"></i>
                                <span>File Buku</span>
                            </h3>
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-4">
                                <?php
                                    $path = $buku->file_buku;

                                    $path = str_replace('storage/', '', $path);
                                    $path = str_replace('public/', '', $path);
                                ?>
                                <?php if($buku->file_buku): ?>
                                    <a href="<?php echo e(asset('storage/' . $buku->file_buku)); ?>" target="_blank"
                                        class="inline-flex items-center justify-center w-full px-4 py-3 bg-gradient-to-r from-[#7a9140] to-[#657f2e] text-white rounded-xl shadow-lg hover:from-[#657f2e] hover:to-[#506d1c] transition-all duration-300 transform hover:-translate-y-1 font-medium">
                                        <i class="fas fa-external-link-alt mr-2"></i>
                                        <span>Buka File PDF</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Informasi Buku -->
                    <div class="lg:col-span-2">
                        <div class="bg-gradient-to-br from-slate-50 to-gray-50 rounded-2xl p-6 border border-green-100">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-3 border-b border-green-200">
                                <?php echo e($buku->judul_buku); ?>

                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-4">
                                    <div
                                        class="flex items-start bg-white p-4 rounded-xl shadow-sm border border-green-50 hover:shadow-md transition-shadow duration-300">
                                        <i class="fas fa-user text-[#7a9140] mt-1 mr-3 w-5 flex-shrink-0"></i>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-500 mb-1">Penulis</p>
                                            <p class="font-semibold text-gray-800 break-words"><?php echo e($buku->penulis); ?></p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-start bg-white p-4 rounded-xl shadow-sm border border-green-50 hover:shadow-md transition-shadow duration-300">
                                        <i class="fas fa-building text-[#7a9140] mt-1 mr-3 w-5 flex-shrink-0"></i>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-500 mb-1">Penerbit</p>
                                            <p class="font-semibold text-gray-800 break-words"><?php echo e($buku->penerbit); ?></p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-start bg-white p-4 rounded-xl shadow-sm border border-green-50 hover:shadow-md transition-shadow duration-300">
                                        <i class="fas fa-calendar-alt text-[#7a9140] mt-1 mr-3 w-5 flex-shrink-0"></i>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-500 mb-1">Tahun Terbit</p>
                                            <p class="font-semibold text-gray-800"><?php echo e($buku->tahun_terbit); ?></p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-start bg-white p-4 rounded-xl shadow-sm border border-green-50 hover:shadow-md transition-shadow duration-300">
                                        <i class="fas fa-language text-[#7a9140] mt-1 mr-3 w-5 flex-shrink-0"></i>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-500 mb-1">Bahasa</p>
                                            <p class="font-semibold text-gray-800"><?php echo e($buku->bahasa); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div
                                        class="flex items-start bg-white p-4 rounded-xl shadow-sm border border-green-50 hover:shadow-md transition-shadow duration-300">
                                        <i class="fas fa-tags text-[#7a9140] mt-1 mr-3 w-5 flex-shrink-0"></i>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-500 mb-1">Kategori</p>
                                            <p class="font-semibold text-gray-800 break-words">
                                                <?php if($buku->kategoris->isNotEmpty()): ?>
                                                    <?php echo e($buku->kategoris->pluck('nama_kategori')->join(', ')); ?>

                                                <?php else: ?>
                                                    <span class="text-gray-500 italic">Tidak ada kategori</span>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-start bg-white p-4 rounded-xl shadow-sm border border-green-50 hover:shadow-md transition-shadow duration-300">
                                        <i class="fas fa-file-alt text-[#7a9140] mt-1 mr-3 w-5 flex-shrink-0"></i>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-500 mb-1">Jumlah Halaman</p>
                                            <p class="font-semibold text-gray-800"><?php echo e($buku->jumlah_halaman); ?></p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-start bg-white p-4 rounded-xl shadow-sm border border-green-50 hover:shadow-md transition-shadow duration-300">
                                        <i class="fas fa-book text-[#7a9140] mt-1 mr-3 w-5 flex-shrink-0"></i>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-500 mb-1">Edisi</p>
                                            <p class="font-semibold text-gray-800"><?php echo e($buku->edisi); ?></p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-start bg-white p-4 rounded-xl shadow-sm border border-green-50 hover:shadow-md transition-shadow duration-300">
                                        <i class="fas fa-boxes text-[#7a9140] mt-1 mr-3 w-5 flex-shrink-0"></i>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-500 mb-1">Stok</p>
                                            <p class="font-semibold text-gray-800">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?php echo e($buku->stok > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                                    <?php echo e($buku->stok); ?>

                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div class="mt-6 pt-6 border-t border-green-200">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                    <i class="fas fa-align-left text-[#7a9140] mr-2"></i>
                                    <span>Deskripsi</span>
                                </h3>
                                <div class="bg-white rounded-xl p-5 shadow-inner border border-green-50">
                                    <p class="text-gray-700 leading-relaxed text-justify"><?php echo e($buku->deskripsi); ?></p>
                                </div>
                            </div>

                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_superAdmin.super_admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SILALA_BPMSPH\resources\views/super_admin/data_buku/show.blade.php ENDPATH**/ ?>