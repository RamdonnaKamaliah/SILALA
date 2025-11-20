<?php $__env->startSection('pageTitle', 'Tambah Buku'); ?>
<?php $__env->startSection('content'); ?>

    <div class="w-fullflex justify-center">
        <div class="max-w-3xl w-full bg-white rounded-2xl shadow-lg p-8 mt-10 border border-gray-200">
            <a href="<?php echo e(route('admin.data_buku.index')); ?>" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left"></i>
            </a>

            <h2 class="text-3xl font-bold text-primary mb-8 text-center tracking-wide">
                📚 Tambah Buku Baru
            </h2>

            <form action="<?php echo e(route('admin.data_buku.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?php echo csrf_field(); ?>


                <!-- Foto Buku -->
                <div>
                    <label for="foto_buku" class="block text-gray-700 font-semibold mb-2">Foto Buku</label>
                    <input type="file" id="foto_buku" name="foto_buku"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 
                           focus:outline-none focus:ring-2 focus:ring-[#A4B465] transition duration-200">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#pilihGambarModal">
                        Pilih dari Galeri
                    </button>

                    <input type="hidden" name="selected_gambar" id="selectedGambar">
                    <p class="mt-2">Selected: <span id="selectedGambarNama">-</span></p>

                    <div class="modal fade" id="pilihGambarModal" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Pilih Gambar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row">
                                        <?php $__currentLoopData = $gambarList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-3 mb-3">
                                                <img src="<?php echo e(Storage::url($g->path_file)); ?>"
                                                    style="width:100%; height:150px; object-fit:cover; cursor:pointer;"
                                                    onclick="pilihGambar('<?php echo e($g->id); ?>', '<?php echo e($g->nama_file); ?>')">
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <script>
                        function pilihGambar(id, nama) {
                            document.getElementById('selectedGambar').value = id;
                            document.getElementById('selectedGambarNama').innerText = nama;
                            var modal = bootstrap.Modal.getInstance(document.getElementById('pilihGambarModal'));
                            modal.hide();
                        }
                    </script>

                </div>

                <!-- Judul Buku -->
                <div>
                    <label for="judul_buku" class="block text-gray-700 font-semibold mb-2">Judul Buku</label>
                    <input type="text" id="judul_buku" name="judul_buku" placeholder="Masukkan judul buku"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 
                           focus:outline-none focus:ring-2 focus:ring-[#A4B465] placeholder-gray-400 transition duration-200"
                        required>
                </div>

                <!-- Penulis -->
                <div>
                    <label for="penulis" class="block text-gray-700 font-semibold mb-2">Penulis</label>
                    <input type="text" id="penulis" name="penulis" placeholder="Masukkan nama penulis"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 
                           focus:outline-none focus:ring-2 focus:ring-[#A4B465] placeholder-gray-400 transition duration-200"
                        required>
                </div>

                <!-- Penerbit -->
                <div>
                    <label for="penerbit" class="block text-gray-700 font-semibold mb-2">Penerbit</label>
                    <input type="text" id="penerbit" name="penerbit" placeholder="Masukkan nama penerbit"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 
                           focus:outline-none focus:ring-2 focus:ring-[#A4B465] placeholder-gray-400 transition duration-200"
                        required>
                </div>

                <!-- Tahun Terbit -->
                <div>
                    <label for="tahun_terbit" class="block text-gray-700 font-semibold mb-2">Tahun Terbit</label>
                    <input type="text" id="tahun_terbit" name="tahun_terbit" placeholder="Masukkan tahun terbit"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 
                           focus:outline-none focus:ring-2 focus:ring-[#A4B465] placeholder-gray-400 transition duration-200"
                        required>
                </div>

                <!-- Bahasa -->
                <div>
                    <label for="bahasa" class="block text-gray-700 font-semibold mb-2">Bahasa</label>
                    <input type="text" id="bahasa" name="bahasa" placeholder="Masukkan bahasa buku"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 
                           focus:outline-none focus:ring-2 focus:ring-[#A4B465] placeholder-gray-400 transition duration-200"
                        required>
                </div>

                <!-- Kategori -->
                <div>
                    <label for="kategori_id" class="block text-gray-700 font-semibold mb-2">Kategori</label>
                    <select name="kategori_id[]" id="kategori_id" multiple
                        class="form-control w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 
    focus:outline-none focus:ring-2 focus:ring-[#A4B465] transition duration-200"
                        required>
                        <option value="" disabled>Pilih kategori</option>
                        <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($kategori->id); ?>"><?php echo e($kategori->nama_kategori); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                </div>



                <!-- Jumlah Halaman -->
                <div>
                    <label for="jumlah_halaman" class="block text-gray-700 font-semibold mb-2">Jumlah Halaman</label>
                    <input type="number" id="jumlah_halaman" name="jumlah_halaman" placeholder="Masukkan jumlah halaman"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 
                           focus:outline-none focus:ring-2 focus:ring-[#A4B465] placeholder-gray-400 transition duration-200"
                        required>
                </div>

                <!-- Edisi -->
                <div>
                    <label for="edisi" class="block text-gray-700 font-semibold mb-2">Edisi</label>
                    <input type="text" id="edisi" name="edisi" placeholder="Masukkan edisi buku"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 
                           focus:outline-none focus:ring-2 focus:ring-[#A4B465] placeholder-gray-400 transition duration-200"
                        required>
                </div>


                <!-- Stok -->
                <div>
                    <label for="stok" class="block text-gray-700 font-semibold mb-2">Stok</label>
                    <input type="number" id="stok" name="stok" placeholder="Masukkan stok buku"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 
                           focus:outline-none focus:ring-2 focus:ring-[#A4B465] placeholder-gray-400 transition duration-200"
                        required>
                </div>

                <!-- File Buku (PDF) -->
                <div>
                    <label for="file_buku" class="block text-gray-700 font-semibold mb-2">File Buku (PDF)</label>
                    <input type="file" id="file_buku" name="file_buku" accept=".pdf"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 
                           focus:outline-none focus:ring-2 focus:ring-[#A4B465] transition duration-200">
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Tuliskan deskripsi singkat mengenai buku"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 
                           focus:outline-none focus:ring-2 focus:ring-[#A4B465] placeholder-gray-400 transition duration-200"
                        required></textarea>
                </div>


                <!-- Tombol Simpan -->
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="bg-blue-500 text-black px-8 py-3 rounded-xl font-semibold shadow-md 
                           hover:bg-blue-600 hover:shadow-lg transition duration-200">
                        💾 Simpan Buku
                    </button>
                </div>

                <?php if($errors->any()): ?>
                    <div class="text-red-500">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SILALA_BPMSPH\resources\views/admin/data_buku/create.blade.php ENDPATH**/ ?>