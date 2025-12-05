<?php $__env->startSection('pageTitle', 'Edit Data Buku'); ?>
<?php $__env->startSection('content'); ?>

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">

            <!-- Page Header -->
            <div class="mb-8">
                <a href="<?php echo e(route('admin.data_buku.index')); ?>"
                    class="inline-flex items-center gap-2 text-[#A4B465] font-medium hover:bg-[#f0f4e4] hover:text-[#8a9a58] px-4 py-2 rounded-lg transition-all duration-300">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Daftar Buku</span>
                </a>

                <div class="text-center mt-6">
                    <h1
                        class="text-2xl md:text-3xl font-bold text-gray-800 flex items-center justify-center gap-3 flex-wrap">
                        <i class="fas fa-edit text-[#A4B465]"></i>
                        <span>Edit Data Buku</span>
                    </h1>
                    <p class="text-gray-600 text-base md:text-lg mt-2">Perbarui informasi buku di perpustakaan digital</p>
                </div>
            </div>

            <!-- Form -->
            <form action="<?php echo e(route('admin.data_buku.update', $buku->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- Upload Section - Dua kolom sejajar -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 pb-3 border-b-2 border-[#f0f4e4] mb-6">
                        <i class="fas fa-cloud-upload-alt text-[#A4B465] text-2xl"></i>
                        <h2 class="text-xl md:text-2xl font-semibold text-gray-800">Upload File Buku</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                        <!-- Foto Buku -->
                        <div
                            class="bg-white border-2 border-dashed border-[#A4B465] rounded-xl p-6 text-center hover:border-[#8a9a58] hover:bg-[#f7faf7] transition-all duration-300 hover:-translate-y-1 <?php $__errorArgs = ['foto_buku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            border-dashed border-red-500
                                
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <div class="text-4xl text-[#A4B465] mb-3">
                                <i class="fas fa-image"></i>
                            </div>
                            <h3 class="font-semibold text-gray-800 mb-2 text-base md:text-lg">Foto Cover Buku</h3>
                            <p class="text-sm text-gray-600 mb-4">Format: JPG, PNG, JPEG</p>

                            <!-- Preview Foto Saat Ini -->
                            <?php if($buku->foto_buku): ?>
                                <div class="mt-4 text-center">
                                    <div class="bg-[#f7faf7] p-3 rounded-lg mb-3">
                                        <div class="text-sm font-semibold text-[#8a9a58] mb-2">Foto Saat Ini:</div>
                                        <img src="<?php echo e(asset('storage/' . $buku->foto_buku)); ?>" alt="Foto Buku Saat Ini"
                                            class="max-w-[120px] max-h-[160px] rounded-lg object-cover mx-auto border-2 border-[#f0f4e4]">
                                    </div>
                                </div>
                            <?php endif; ?>

                            <input type="file" id="foto_buku" name="foto_buku" accept="image/*" class="hidden">
                            <label for="foto_buku"
                                class="inline-flex items-center gap-2 bg-[#A4B465] text-white px-5 py-2.5 rounded-lg font-semibold cursor-pointer hover:bg-[#8a9a58] transition-all duration-300 hover:-translate-y-0.5 mt-3">
                                <i class="fas fa-camera"></i>
                                <span><?php echo e($buku->foto_buku ? 'Ganti Foto' : 'Pilih Foto'); ?></span>
                            </label>

                            <div id="imagePreviewContainer" class="mt-4 text-center hidden">
                                <div class="bg-[#f7faf7] p-3 rounded-lg">
                                    <div class="text-sm font-semibold text-[#8a9a58] mb-2">Preview Foto Baru:</div>
                                    <img id="imagePreview"
                                        class="max-w-[120px] max-h-[160px] rounded-lg object-cover mx-auto border-2 border-[#f0f4e4]"
                                        alt="Preview Cover">

                                </div>
                            </div>
                            <?php $__errorArgs = ['foto_buku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- File Buku PDF -->
                        <div
                            class="bg-white border-2 border-dashed border-[#A4B465] rounded-xl p-6 text-center hover:border-[#8a9a58] hover:bg-[#f7faf7] transition-all duration-300 hover:-translate-y-1 <?php $__errorArgs = ['file_buku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            border-dashed border-red-500
                                
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <div class="text-4xl text-[#A4B465] mb-3">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <h3 class="font-semibold text-gray-800 mb-2 text-base md:text-lg">File Buku (PDF)</h3>
                            <p class="text-sm text-gray-600 mb-4">Format: PDF, maksimal 10MB</p>

                            <!-- Preview File Saat Ini -->
                            <?php if($buku->file_buku): ?>
                                <div class="mt-4 text-center">
                                    <div class="bg-[#f7faf7] p-3 rounded-lg mb-3">
                                        <div class="text-sm font-semibold text-[#8a9a58] mb-2">File Saat Ini:</div>
                                        <div class="bg-[#f0f4e4] p-4 rounded-lg relative">
                                            <div id="currentPdfThumbnail" class="pdf-thumbnail-container">
                                                <div class="flex items-center justify-center gap-2 text-[#8a9a58] text-sm">
                                                    <i class="fas fa-spinner fa-spin"></i>
                                                    <span>Loading thumbnail...</span>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <p class="text-sm font-medium text-[#8a9a58]">File PDF tersedia</p>
                                                <a href="<?php echo e(asset($buku->file_buku)); ?>" target="_blank"
                                                    class="text-[#8a9a58] underline text-sm mt-1 inline-block hover:text-[#A4B465]">
                                                    Lihat file lengkap
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <input type="file" id="file_buku" name="file_buku" accept=".pdf" class="hidden">
                            <label for="file_buku"
                                class="inline-flex items-center gap-2 bg-[#A4B465] text-white px-5 py-2.5 rounded-lg font-semibold cursor-pointer hover:bg-[#8a9a58] transition-all duration-300 hover:-translate-y-0.5 mt-3">
                                <i class="fas fa-file-upload"></i>
                                <span><?php echo e($buku->file_buku ? 'Ganti File' : 'Pilih File'); ?></span>
                            </label>

                            <!-- Preview PDF Baru -->
                            <div id="pdfPreviewContainer" class="mt-4 text-center hidden">
                                <div class="bg-[#f7faf7] p-3 rounded-lg">
                                    <div class="text-sm font-semibold text-[#8a9a58] mb-2">Preview File Baru:</div>
                                    <div class="bg-[#f0f4e4] p-4 rounded-lg">
                                        <canvas id="pdfPreview"
                                            class="max-w-[120px] max-h-[160px] rounded-md border-2 border-[#A4B465] bg-white mx-auto shadow-sm"></canvas>
                                        <div class="mt-2">
                                            <p id="pdfName" class="text-sm font-medium text-[#8a9a58]"></p>
                                            <p id="pdfSize" class="text-xs text-[#8a9a58] mt-1"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $__errorArgs = ['file_buku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Informasi Buku -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 pb-3 border-b-2 border-[#f0f4e4] mb-6">
                        <i class="fas fa-info-circle text-[#A4B465] text-2xl"></i>
                        <h2 class="text-xl md:text-2xl font-semibold text-gray-800">Informasi Buku</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Judul Buku -->
                        <div>
                            <label for="judul_buku"
                                class="flex items-center gap-2 font-semibold text-gray-700 mb-2 text-sm md:text-base">
                                <i class="fas fa-heading text-[#A4B465]"></i>
                                <span>Judul Buku</span>
                            </label>
                            <input type="text" id="judul_buku" name="judul_buku"
                                value="<?php echo e(old('judul_buku', $buku->judul_buku)); ?>" placeholder="Masukkan judul buku"
                                class="w-full border-2 border-gray-300 bg-gray-50 rounded-lg px-4 py-3 text-gray-700 focus:border-[#A4B465] focus:ring-4 focus:ring-[#A4B465]/20 focus:bg-white outline-none transition-all duration-300"
                                required>
                        </div>

                        <!-- Penulis -->
                        <div>
                            <label for="penulis"
                                class="flex items-center gap-2 font-semibold text-gray-700 mb-2 text-sm md:text-base">
                                <i class="fas fa-user-edit text-[#A4B465]"></i>
                                <span>Penulis</span>
                            </label>
                            <input type="text" id="penulis" name="penulis"
                                value="<?php echo e(old('penulis', $buku->penulis)); ?>" placeholder="Masukkan nama penulis"
                                class="w-full border-2 border-gray-300 bg-gray-50 rounded-lg px-4 py-3 text-gray-700 focus:border-[#A4B465] focus:ring-4 focus:ring-[#A4B465]/20 focus:bg-white outline-none transition-all duration-300"
                                required>
                        </div>

                        <!-- Penerbit -->
                        <div>
                            <label for="penerbit"
                                class="flex items-center gap-2 font-semibold text-gray-700 mb-2 text-sm md:text-base">
                                <i class="fas fa-building text-[#A4B465]"></i>
                                <span>Penerbit</span>
                            </label>
                            <input type="text" id="penerbit" name="penerbit"
                                value="<?php echo e(old('penerbit', $buku->penerbit)); ?>" placeholder="Masukkan nama penerbit"
                                class="w-full border-2 border-gray-300 bg-gray-50 rounded-lg px-4 py-3 text-gray-700 focus:border-[#A4B465] focus:ring-4 focus:ring-[#A4B465]/20 focus:bg-white outline-none transition-all duration-300"
                                required>
                        </div>

                        <!-- Tahun Terbit -->
                        <div>
                            <label for="tahun_terbit"
                                class="flex items-center gap-2 font-semibold text-gray-700 mb-2 text-sm md:text-base">
                                <i class="fas fa-calendar-alt text-[#A4B465]"></i>
                                <span>Tahun Terbit</span>
                            </label>
                            <input type="number" id="tahun_terbit" name="tahun_terbit"
                                value="<?php echo e(old('tahun_terbit', $buku->tahun_terbit)); ?>" placeholder="Contoh: 2024"
                                class="w-full border-2 border-gray-300 bg-gray-50 rounded-lg px-4 py-3 text-gray-700 focus:border-[#A4B465] focus:ring-4 focus:ring-[#A4B465]/20 focus:bg-white outline-none transition-all duration-300"
                                required>
                        </div>

                        <!-- Bahasa -->
                        <div>
                            <label for="bahasa"
                                class="flex items-center gap-2 font-semibold text-gray-700 mb-2 text-sm md:text-base">
                                <i class="fas fa-language text-[#A4B465]"></i>
                                <span>Bahasa</span>
                            </label>
                            <input type="text" id="bahasa" name="bahasa"
                                value="<?php echo e(old('bahasa', $buku->bahasa)); ?>" placeholder="Contoh: Indonesia"
                                class="w-full border-2 border-gray-300 bg-gray-50 rounded-lg px-4 py-3 text-gray-700 focus:border-[#A4B465] focus:ring-4 focus:ring-[#A4B465]/20 focus:bg-white outline-none transition-all duration-300"
                                required>
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="kategori_id"
                                class="flex items-center gap-2 font-semibold text-gray-700 mb-2 text-sm md:text-base">
                                <i class="fas fa-tags text-[#A4B465]"></i>
                                <span>Kategori</span>
                            </label>
                            <select name="kategori_id[]" id="kategori_id" multiple
                                class="w-full border-2 border-gray-300 bg-gray-50 rounded-lg px-4 py-3 text-gray-700 focus:border-[#A4B465] focus:ring-4 focus:ring-[#A4B465]/20 focus:bg-white outline-none transition-all duration-300"
                                required>
                                <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($kategori->id); ?>"
                                        <?php echo e(in_array($kategori->id, old('kategori_id', $buku->kategoris->pluck('id')->toArray())) ? 'selected' : ''); ?>>
                                        <?php echo e($kategori->nama_kategori); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <small class="text-gray-600 text-xs mt-2 block">
                                <i class="fas fa-info-circle mr-1"></i>
                                Tekan Ctrl (Windows) atau Cmd (Mac) untuk pilih lebih dari satu
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Detail Publikasi -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 pb-3 border-b-2 border-[#f0f4e4] mb-6">
                        <i class="fas fa-book-open text-[#A4B465] text-2xl"></i>
                        <h2 class="text-xl md:text-2xl font-semibold text-gray-800">Detail Publikasi</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <!-- Jumlah Halaman -->
                        <div>
                            <label for="jumlah_halaman"
                                class="flex items-center gap-2 font-semibold text-gray-700 mb-2 text-sm md:text-base">
                                <i class="fas fa-file-alt text-[#A4B465]"></i>
                                <span>Jumlah Halaman</span>
                            </label>
                            <input type="number" id="jumlah_halaman" name="jumlah_halaman"
                                value="<?php echo e(old('jumlah_halaman', $buku->jumlah_halaman)); ?>" placeholder="0"
                                class="w-full border-2 border-gray-300 bg-gray-50 rounded-lg px-4 py-3 text-gray-700 focus:border-[#A4B465] focus:ring-4 focus:ring-[#A4B465]/20 focus:bg-white outline-none transition-all duration-300"
                                required>
                        </div>

                        <!-- Edisi -->
                        <div>
                            <label for="edisi"
                                class="flex items-center gap-2 font-semibold text-gray-700 mb-2 text-sm md:text-base">
                                <i class="fas fa-bookmark text-[#A4B465]"></i>
                                <span>Edisi</span>
                            </label>
                            <input type="text" id="edisi" name="edisi"
                                value="<?php echo e(old('edisi', $buku->edisi)); ?>" placeholder="Contoh: Edisi 1"
                                class="w-full border-2 border-gray-300 bg-gray-50 rounded-lg px-4 py-3 text-gray-700 focus:border-[#A4B465] focus:ring-4 focus:ring-[#A4B465]/20 focus:bg-white outline-none transition-all duration-300"
                                required>
                        </div>

                        <!-- Stok -->
                        <div>
                            <label for="stok"
                                class="flex items-center gap-2 font-semibold text-gray-700 mb-2 text-sm md:text-base">
                                <i class="fas fa-boxes text-[#A4B465]"></i>
                                <span>Stok Tersedia</span>
                            </label>
                            <input type="number" id="stok" name="stok" value="<?php echo e(old('stok', $buku->stok)); ?>"
                                placeholder="0"
                                class="w-full border-2 border-gray-300 bg-gray-50 rounded-lg px-4 py-3 text-gray-700 focus:border-[#A4B465] focus:ring-4 focus:ring-[#A4B465]/20 focus:bg-white outline-none transition-all duration-300"
                                required>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 pb-3 border-b-2 border-[#f0f4e4] mb-6">
                        <i class="fas fa-align-left text-[#A4B465] text-2xl"></i>
                        <h2 class="text-xl md:text-2xl font-semibold text-gray-800">Deskripsi Buku</h2>
                    </div>

                    <div>
                        <label for="deskripsi"
                            class="flex items-center gap-2 font-semibold text-gray-700 mb-2 text-sm md:text-base">
                            <i class="fas fa-paragraph text-[#A4B465]"></i>
                            <span>Deskripsi Lengkap</span>
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="6"
                            placeholder="Tuliskan deskripsi lengkap mengenai buku, sinopsis, atau ringkasan isi buku..."
                            class="w-full border-2 border-gray-300 bg-gray-50 rounded-lg px-4 py-3 text-gray-700 focus:border-[#A4B465] focus:ring-4 focus:ring-[#A4B465]/20 focus:bg-white outline-none transition-all duration-300 resize-none"
                            required><?php echo e(old('deskripsi', $buku->deskripsi)); ?></textarea>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="bg-white rounded-lg p-6 border border-gray-200 shadow-sm">
                    <div class="flex flex-col sm:flex-row gap-4 justify-end">
                        <a href="<?php echo e(route('admin.data_buku.index')); ?>"
                            class="inline-flex items-center justify-center gap-2 bg-white text-gray-600 font-semibold px-8 py-3 rounded-lg border-2 border-gray-300 hover:bg-gray-50 hover:text-gray-800 hover:border-gray-400 transition-all duration-300">
                            <i class="fas fa-times"></i>
                            <span>Batal</span>
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 bg-[#A4B465] text-white font-semibold px-8 py-3 rounded-lg hover:bg-[#8a9a58] transition-all duration-300 hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                            <i class="fas fa-save"></i>
                            <span>Perbarui Buku</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SILALA_BPMSPH\resources\views/admin/data_buku/edit.blade.php ENDPATH**/ ?>