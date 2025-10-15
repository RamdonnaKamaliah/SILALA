<?php $__env->startSection('pageTitle', 'Tambah Buku'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-[#f8fbff] via-[#fdfdfd] to-[#eef4ff] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 font-[Poppins]">

    <div class="w-full max-w-3xl bg-white/80 backdrop-blur-xl rounded-3xl shadow-[0_10px_30px_rgba(0,0,0,0.08)] border border-blue-100 p-10 transition-all duration-300 hover:shadow-[0_20px_40px_rgba(0,0,0,0.12)]">

        <!-- Tombol Kembali -->
        <div class="mb-6">
            <a href="<?php echo e(route('admin.data_buku.index')); ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Data Buku
            </a>
        </div>

        <!-- Judul -->
        <h2 class="text-3xl sm:text-4xl font-extrabold text-center text-gray-800 mb-10 tracking-wide">
            📘 Tambah Buku Baru
        </h2>

        <!-- Form -->
        <form action="<?php echo e(route('admin.data_buku.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-8">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Foto Buku -->
                <div>
                    <label for="foto_buku" class="block text-gray-700 font-semibold mb-2">Foto Buku</label>
                    <input type="file" id="foto_buku" name="foto_buku"
                        class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white shadow-inner
                        focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-300 transition-all duration-200">
                </div>

                <!-- File Buku -->
                <div>
                    <label for="file_buku" class="block text-gray-700 font-semibold mb-2">File Buku (PDF)</label>
                    <input type="file" id="file_buku" name="file_buku" accept=".pdf"
                        class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white shadow-inner
                        focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-300 transition-all duration-200">
                </div>

                <!-- Judul Buku -->
                <div class="md:col-span-2">
                    <label for="judul_buku" class="block text-gray-700 font-semibold mb-2">Judul Buku</label>
                    <input type="text" id="judul_buku" name="judul_buku" placeholder="Masukkan judul buku"
                        class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white shadow-inner placeholder-gray-400
                        focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-300 transition-all duration-200" required>
                </div>

                <!-- Penulis -->
                <div>
                    <label for="penulis" class="block text-gray-700 font-semibold mb-2">Penulis</label>
                    <input type="text" id="penulis" name="penulis" placeholder="Masukkan nama penulis"
                        class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white shadow-inner placeholder-gray-400
                        focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-200" required>
                </div>

                <!-- Penerbit -->
                <div>
                    <label for="penerbit" class="block text-gray-700 font-semibold mb-2">Penerbit</label>
                    <input type="text" id="penerbit" name="penerbit" placeholder="Masukkan nama penerbit"
                        class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white shadow-inner placeholder-gray-400
                        focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-200" required>
                </div>

                <!-- Tahun Terbit -->
                <div>
                    <label for="tahun_terbit" class="block text-gray-700 font-semibold mb-2">Tahun Terbit</label>
                    <input type="text" id="tahun_terbit" name="tahun_terbit" placeholder="Masukkan tahun terbit"
                        class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white shadow-inner placeholder-gray-400
                        focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-200" required>
                </div>

                <!-- Bahasa -->
                <div>
                    <label for="bahasa" class="block text-gray-700 font-semibold mb-2">Bahasa</label>
                    <input type="text" id="bahasa" name="bahasa" placeholder="Masukkan bahasa buku"
                        class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white shadow-inner placeholder-gray-400
                        focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-200" required>
                </div>

                <!-- Kategori -->
                <div>
                    <label for="kategori" class="block text-gray-700 font-semibold mb-2">Kategori</label>
                    <input type="text" id="kategori" name="kategori" placeholder="Contoh: Fiksi, Edukasi..."
                        class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white shadow-inner placeholder-gray-400
                        focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-200" required>
                </div>

                <!-- Jumlah Halaman -->
                <div>
                    <label for="jumlah_halaman" class="block text-gray-700 font-semibold mb-2">Jumlah Halaman</label>
                    <input type="number" id="jumlah_halaman" name="jumlah_halaman" placeholder="Masukkan jumlah halaman"
                        class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white shadow-inner placeholder-gray-400
                        focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-200" required>
                </div>

                <!-- Edisi -->
                <div>
                    <label for="edisi" class="block text-gray-700 font-semibold mb-2">Edisi</label>
                    <input type="text" id="edisi" name="edisi" placeholder="Masukkan edisi buku"
                        class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white shadow-inner placeholder-gray-400
                        focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-200" required>
                </div>

                <!-- Stok -->
                <div>
                    <label for="stok" class="block text-gray-700 font-semibold mb-2">Stok</label>
                    <input type="number" id="stok" name="stok" placeholder="Masukkan stok buku"
                        class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white shadow-inner placeholder-gray-400
                        focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-200" required>
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Tuliskan deskripsi singkat mengenai buku"
                    class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white shadow-inner placeholder-gray-400
                    focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-200" required></textarea>
            </div>

            <!-- Tombol Simpan -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-8 py-3 rounded-2xl font-semibold bg-gradient-to-r from-blue-500 to-indigo-500 text-white shadow-lg 
                    hover:shadow-xl hover:scale-[1.03] active:scale-95 transition-all duration-200 ease-in-out">
                    💾 Simpan Buku
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/data_buku/create.blade.php ENDPATH**/ ?>