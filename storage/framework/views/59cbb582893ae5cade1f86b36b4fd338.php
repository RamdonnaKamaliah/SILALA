<?php $__env->startSection('pageTitle', 'Edit Data Buku'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container mt-4">
        <h2 class="text-xl font-semibold mb-4 text-[#A4B465]">Edit Buku</h2>

        <form action="<?php echo e(route('admin.data_buku.update', $buku->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            
            <div class="mb-4">
                <label for="foto_buku" class="block text-gray-700 font-semibold mb-2">Foto Buku</label>
                <?php if($buku->foto_buku): ?>
                    <img src="<?php echo e(asset($buku->foto_buku)); ?>" alt="Foto Buku" class="w-24 h-32 object-cover rounded mb-2">
                <?php endif; ?>
                <input type="file" name="foto_buku" id="foto_buku"
                    class="border border-gray-300 rounded-xl px-4 py-2 w-full">
            </div>

            
            <div class="mb-4">
                <label for="judul_buku" class="block text-gray-700 font-semibold mb-2">Judul Buku</label>
                <input type="text" name="judul_buku" id="judul_buku" value="<?php echo e(old('judul_buku', $buku->judul_buku)); ?>"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#A4B465]"
                    required>
            </div>

            
            <div class="mb-4">
                <label for="penulis" class="block text-gray-700 font-semibold mb-2">Penulis</label>
                <input type="text" name="penulis" id="penulis" value="<?php echo e(old('penulis', $buku->penulis)); ?>"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#A4B465]"
                    required>
            </div>

            
            <div class="mb-4">
                <label for="penerbit" class="block text-gray-700 font-semibold mb-2">Penerbit</label>
                <input type="text" name="penerbit" id="penerbit" value="<?php echo e(old('penerbit', $buku->penerbit)); ?>"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#A4B465]"
                    required>
            </div>

            
            <div class="mb-4">
                <label for="tahun_terbit" class="block text-gray-700 font-semibold mb-2">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" id="tahun_terbit"
                    value="<?php echo e(old('tahun_terbit', $buku->tahun_terbit)); ?>"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#A4B465]"
                    required>
            </div>

            
            <div class="mb-4">
                <label for="bahasa" class="block text-gray-700 font-semibold mb-2">Bahasa</label>
                <input type="text" name="bahasa" id="bahasa" value="<?php echo e(old('bahasa', $buku->bahasa)); ?>"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#A4B465]"
                    required>
            </div>

            
            <div class="mb-4">
                <label for="kategori" class="block text-gray-700 font-semibold mb-2">Kategori</label>
                <input type="text" name="kategori" id="kategori" value="<?php echo e(old('kategori', $buku->kategori)); ?>"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#A4B465]"
                    required>
            </div>

            
            <div class="mb-4">
                <label for="jumlah_halaman" class="block text-gray-700 font-semibold mb-2">Jumlah Halaman</label>
                <input type="number" name="jumlah_halaman" id="jumlah_halaman"
                    value="<?php echo e(old('jumlah_halaman', $buku->jumlah_halaman)); ?>"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#A4B465]"
                    required>
            </div>

            
            <div class="mb-4">
                <label for="edisi" class="block text-gray-700 font-semibold mb-2">Edisi</label>
                <input type="text" name="edisi" id="edisi" value="<?php echo e(old('edisi', $buku->edisi)); ?>"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#A4B465]"
                    required>
            </div>

            
            <div class="mb-4">
                <label for="stok" class="block text-gray-700 font-semibold mb-2">Stok</label>
                <input type="number" name="stok" id="stok" value="<?php echo e(old('stok', $buku->stok)); ?>"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#A4B465]"
                    required>
            </div>

            
            <div class="mb-4">
                <label for="file_buku" class="block text-gray-700 font-semibold mb-2">File Buku (PDF)</label>
                <?php if($buku->file_buku): ?>
                    <a href="<?php echo e(asset($buku->file_buku)); ?>" target="_blank"
                        class="text-blue-500 underline mb-2 inline-block">Lihat File Saat Ini</a>
                <?php endif; ?>
                <input type="file" name="file_buku" id="file_buku" accept=".pdf"
                    class="border border-gray-300 rounded-xl px-4 py-2 w-full">
                <p class="text-sm text-gray-500 mt-1">Unggah file PDF jika ingin mengganti file buku.</p>

            </div>

            
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#A4B465]"><?php echo e(old('deskripsi', $buku->deskripsi)); ?></textarea>
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="bg-[#A4B465] hover:bg-[#8EA05C] text-white font-semibold px-6 py-2 rounded-xl transition duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/data_buku/edit.blade.php ENDPATH**/ ?>