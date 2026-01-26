<?php $__env->startSection('pageTitle', 'Tambah Kategori'); ?>
<?php $__env->startSection('content'); ?>

    <div class="p-4 md:p-6 overflow-x-auto">
        <!-- Header Section -->
        <div class="text-left mb-8 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center space-x-4 mb-3">
                <div class="bg-white/20 p-3 rounded-full">
                    <i class="fas fa-plus-circle text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl lg:text-4xl font-bold mb-2 text-white">Tambah Kategori Baru</h1>
                    <p class="text-white text-lg">Tambahkan kategori buku baru ke dalam sistem perpustakaan</p>
                </div>
            </div>
            <div class="flex items-center space-x-2 text-sm text-white">
                <i class="fas fa-info-circle"></i>
                <span>Isi form berikut untuk menambahkan kategori baru</span>
            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- Form Header -->
            <div class="border-b border-gray-200 bg-gradient-to-r from-gray-50 to-green-50/30 px-6 py-4">
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] rounded-full"></div>
                    <h2 class="text-lg font-semibold text-gray-800">Informasi Kategori</h2>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-6">
                <?php $__errorArgs = ['nama_kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 flex items-start space-x-3">
                        <div class="flex-shrink-0 w-5 h-5 bg-red-100 rounded-full flex items-center justify-center mt-0.5">
                            <i class="fas fa-exclamation-circle text-red-500 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-red-700 font-medium">Terjadi Kesalahan</p>
                            <p class="text-red-600 text-sm mt-0.5"><?php echo e($message); ?></p>
                        </div>
                    </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <form action="<?php echo e(route('admin.data_kategori.store')); ?>" method="POST" class="space-y-6">
                    <?php echo csrf_field(); ?>

                    <!-- Nama Kategori Field -->
                    <div class="space-y-2">
                        <label for="nama_kategori" class="block text-base font-semibold text-gray-700 flex items-center">
                            <i class="fas fa-tag text-[#A4B465] mr-3 text-base"></i>
                            Nama Kategori
                            <span class="text-red-500 ml-1">*</span>
                        </label>

                        <div class="relative max-w-2xl">
                            <input type="text" id="nama_kategori" name="nama_kategori" value="<?php echo e(old('nama_kategori')); ?>"
                                placeholder="Contoh: Fiksi, Sains, Sejarah, dll."
                                class="w-full border border-gray-300 rounded-xl px-4 py-3.5 bg-white
                                      focus:outline-none focus:ring-2 focus:ring-[#A4B465] focus:border-transparent
                                      placeholder-gray-400 transition-all duration-200
                                      hover:border-gray-400 pr-12 text-base <?php $__errorArgs = ['nama_kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                          border-red-500
                                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('nama_kategori')); ?>">
                            <?php $__errorArgs = ['nama_kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                <div class="w-7 h-7 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-bookmark text-[#A4B465] text-sm"></i>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center max-w-2xl">
                            <p class="text-sm text-gray-500 flex items-center">
                                <i class="fas fa-info-circle text-gray-400 mr-2 text-sm"></i>
                                Masukkan nama kategori yang jelas dan deskriptif
                            </p>
                            <div class="text-sm text-gray-500">
                                <span id="charCount">0</span>/50 karakter
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4 pt-6 border-t border-gray-100">
                        <a href="<?php echo e(route('admin.data_kategori.index')); ?>"
                            class="w-full md:w-auto flex items-center justify-center space-x-3 px-6 py-3.5 
                              border border-gray-300 text-gray-700 rounded-xl font-medium
                              hover:bg-gray-50 hover:border-gray-400 transition-all duration-200
                              hover:shadow-sm order-2 md:order-1 text-base">
                            <i class="fas fa-arrow-left text-sm"></i>
                            <span>Kembali ke Daftar Kategori</span>
                        </a>

                        <button type="submit"
                            class="w-full md:w-auto flex items-center justify-center space-x-3 px-7 py-3.5
                                   bg-gradient-to-r from-[#A4B465] to-[#8AA24F] text-white rounded-xl font-semibold
                                   hover:from-[#8AA24F] hover:to-[#75883f] transition-all duration-200
                                   shadow-md hover:shadow-lg transform hover:-translate-y-0.5
                                   order-1 md:order-2 text-base">
                            <i class="fas fa-save text-sm"></i>
                            <span>Simpan Kategori Baru</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tips Section -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-5 max-w-2xl">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0 w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center mt-0.5">
                    <i class="fas fa-lightbulb text-blue-500 text-sm"></i>
                </div>
                <div>
                    <h3 class="text-blue-800 font-semibold text-base mb-2">Tips Penamaan Kategori</h3>
                    <ul class="text-blue-700 text-sm space-y-1">
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-2">•</span>
                            Gunakan nama yang singkat namun jelas
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-2">•</span>
                            Hindari penggunaan karakter khusus
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-2">•</span>
                            Pastikan konsistensi dengan kategori yang sudah ada
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/data_kategori/create.blade.php ENDPATH**/ ?>