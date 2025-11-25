<?php $__env->startSection('pageTitle', 'Detail Data Buku'); ?>

<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Buku</title>
    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .book-cover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }
        .book-cover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15), 0 10px 10px -5px rgba(0, 0, 0, 0.08);
        }
        .info-card {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f7faf7',
                            100: '#e8f3e8',
                            200: '#d1e7d1',
                            300: '#a4b465',
                            400: '#8fa352',
                            500: '#7a9140',
                            600: '#657f2e',
                            700: '#506d1c',
                            800: '#3b5b0a',
                            900: '#264900',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-green-50 to-emerald-50">
    <div class="min-h-screen py-8 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header dengan Breadcrumb -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                        <i class="fas fa-book-open text-primary-500 mr-3"></i>Detail Buku
                    </h1>
                    <a href="<?php echo e(route('admin.data_buku.index')); ?>" class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-white border border-gray-200 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-green-50 hover:text-primary-600 transition-all duration-300 hover:border-primary-300">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Buku
                    </a>
                </div>
            </div>

            <!-- Card Detail Buku -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-green-100">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">
                    <!-- Kolom Gambar & File -->
                    <div class="lg:col-span-1">
                        <!-- Foto Buku -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-image text-primary-500 mr-2"></i> Foto Buku
                            </h3>
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-4 flex justify-center">
                                <?php if($buku->foto_buku): ?>
                                    <div class="relative">
                                        <img src="<?php echo e(asset($buku->foto_buku)); ?>" alt="Foto Buku <?php echo e($buku->judul_buku); ?>"
                                            class="w-full max-w-xs h-80 object-cover rounded-xl book-cover">
                                        <div class="absolute inset-0 rounded-xl border-2 border-white opacity-20 pointer-events-none"></div>
                                    </div>
                                <?php else: ?>
                                    <div class="w-full max-w-xs h-80 flex flex-col items-center justify-center bg-gradient-to-br from-green-100 to-emerald-100 text-primary-700 rounded-xl border-2 border-dashed border-primary-300">
                                        <i class="fas fa-image text-5xl mb-3 opacity-70"></i>
                                        <span class="text-sm font-medium">Tidak ada foto</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- File Buku -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-file-pdf text-primary-500 mr-2"></i> File Buku
                            </h3>
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-4">
                                <?php if($buku->file_buku): ?>
                                    <a href="<?php echo e(asset($buku->file_buku)); ?>" target="_blank"
                                        class="inline-flex items-center justify-center w-full px-4 py-3 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-xl shadow-lg hover:from-primary-600 hover:to-primary-700 transition-all duration-300 transform hover:-translate-y-1">
                                        <i class="fas fa-external-link-alt mr-2"></i>
                                        <span>Buka File PDF</span>
                                    </a>
                                <?php else: ?>
                                    <div class="flex flex-col items-center justify-center text-primary-500 py-4">
                                        <i class="fas fa-file-pdf text-4xl mb-2 opacity-70"></i>
                                        <span class="text-sm font-medium">Tidak ada file PDF</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Informasi Buku -->
                    <div class="lg:col-span-2">
                        <div class="info-card rounded-2xl p-6 border border-green-100">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-3 border-b border-green-200"><?php echo e($buku->judul_buku); ?></h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-4">
                                    <div class="flex items-start bg-white p-3 rounded-xl shadow-sm border border-green-50">
                                        <i class="fas fa-user text-primary-500 mt-1 mr-3 w-5"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Penulis</p>
                                            <p class="font-semibold text-gray-800"><?php echo e($buku->penulis); ?></p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start bg-white p-3 rounded-xl shadow-sm border border-green-50">
                                        <i class="fas fa-building text-primary-500 mt-1 mr-3 w-5"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Penerbit</p>
                                            <p class="font-semibold text-gray-800"><?php echo e($buku->penerbit); ?></p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start bg-white p-3 rounded-xl shadow-sm border border-green-50">
                                        <i class="fas fa-calendar-alt text-primary-500 mt-1 mr-3 w-5"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Tahun Terbit</p>
                                            <p class="font-semibold text-gray-800"><?php echo e($buku->tahun_terbit); ?></p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start bg-white p-3 rounded-xl shadow-sm border border-green-50">
                                        <i class="fas fa-language text-primary-500 mt-1 mr-3 w-5"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Bahasa</p>
                                            <p class="font-semibold text-gray-800"><?php echo e($buku->bahasa); ?></p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    <div class="flex items-start bg-white p-3 rounded-xl shadow-sm border border-green-50">
                                        <i class="fas fa-tags text-primary-500 mt-1 mr-3 w-5"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Kategori</p>
                                            <p class="font-semibold text-gray-800">
                                                <?php if($buku->kategoris->isNotEmpty()): ?>
                                                    <?php echo e($buku->kategoris->pluck('nama_kategori')->join(', ')); ?>

                                                <?php else: ?>
                                                    <span class="text-gray-500 italic">Tidak ada kategori</span>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start bg-white p-3 rounded-xl shadow-sm border border-green-50">
                                        <i class="fas fa-file-alt text-primary-500 mt-1 mr-3 w-5"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Jumlah Halaman</p>
                                            <p class="font-semibold text-gray-800"><?php echo e($buku->jumlah_halaman); ?></p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start bg-white p-3 rounded-xl shadow-sm border border-green-50">
                                        <i class="fas fa-book text-primary-500 mt-1 mr-3 w-5"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Edisi</p>
                                            <p class="font-semibold text-gray-800"><?php echo e($buku->edisi); ?></p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start bg-white p-3 rounded-xl shadow-sm border border-green-50">
                                        <i class="fas fa-boxes text-primary-500 mt-1 mr-3 w-5"></i>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Stok</p>
                                            <p class="font-semibold text-gray-800"><?php echo e($buku->stok); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Deskripsi -->
                            <div class="mt-6 pt-4 border-t border-green-200">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                    <i class="fas fa-align-left text-primary-500 mr-2"></i> Deskripsi
                                </h3>
                                <div class="bg-white rounded-xl p-4 shadow-inner border border-green-50">
                                    <p class="text-gray-700 leading-relaxed"><?php echo e($buku->deskripsi); ?></p>
                                </div>
                            </div>
                            
                            <!-- Tombol Aksi -->
                            <div class="mt-8 pt-6 border-t border-green-200 flex flex-col sm:flex-row gap-3">
                                <a href="<?php echo e(route('admin.data_buku.edit', $buku->id)); ?>" 
                                   class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-600 text-white rounded-xl shadow-lg hover:from-primary-600 hover:to-primary-700 transition-all duration-300 transform hover:-translate-y-1">
                                    <i class="fas fa-edit mr-2"></i>
                                    Edit Buku
                                </a>
                                <form action="<?php echo e(route('admin.data_buku.destroy', $buku->id)); ?>" method="POST" class="inline w-full sm:w-auto">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" 
                                        class="w-full inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl shadow-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 transform hover:-translate-y-1"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                        <i class="fas fa-trash-alt mr-2"></i>
                                        Hapus Buku
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SILALA_BPMSPH\resources\views/admin/data_buku/show.blade.php ENDPATH**/ ?>