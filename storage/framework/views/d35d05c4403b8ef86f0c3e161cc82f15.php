
<?php $__env->startSection('pageTitle', 'CMS - Pengaturan Logo & Gambar'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-100 p-6">
    
    
    <div class="text-left mb-8 bg-gradient-to-r from-[#A4B465] to-[#8AA24F] rounded-2xl p-6 text-white shadow-lg">
        <div class="flex items-center space-x-4 mb-3">
            <div class="bg-white/20 p-3 rounded-full">
                <i class="fas fa-tags text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl lg:text-4xl font-bold mb-2 text-white">Pengaturan Konten</h1>
                <p class="text-white text-lg">Upload logo dan background</p>
            </div>
        </div>
       
    </div>

    
    <div class="bg-white rounded-lg shadow-lg p-8">
       

        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $logos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="border-2 border-gray-200 rounded-lg p-6 hover:border-green-400 hover:shadow-md transition-all duration-300">
                
                
                <div class="flex items-center mb-4 pb-3 border-b border-gray-100">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <h3 class="font-semibold text-gray-800"><?php echo e($setting->label); ?></h3>
                </div>

                
                <form action="<?php echo e(route('admin.cms.upload')); ?>" 
                      method="POST" 
                      enctype="multipart/form-data"
                      class="upload-form"
                      data-key="<?php echo e($setting->key); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="key" value="<?php echo e($setting->key); ?>">

                    <?php if($setting->value && Storage::disk('public')->exists('cms/' . $setting->value)): ?>
                        
                        <div class="mb-4">
                            <div class="relative group">
                                <img src="<?php echo e(asset('storage/cms/' . $setting->value)); ?>" 
                                     alt="<?php echo e($setting->label); ?>"
                                     class="w-full h-48 object-contain bg-gray-50 rounded-lg border-2 border-gray-200">
                                
                                
                                <div class="absolute top-2 right-2">
                                    <button type="button"
                                            class="delete-btn bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm font-medium shadow-lg transition-all"
                                            data-key="<?php echo e($setting->key); ?>">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2 text-center">Klik "Pilih File" untuk mengganti</p>
                        </div>
                    <?php else: ?>
                        
                        <div class="mb-4">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center bg-gray-50">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                    </path>
                                </svg>
                                <p class="text-gray-600 font-medium mb-1">Belum ada gambar</p>
                                <p class="text-gray-500 text-sm">Pilih file untuk upload</p>
                            </div>
                        </div>
                    <?php endif; ?>

                    
                    <div class="space-y-3">
                        <input type="file" 
                               name="image"
                               class="file-input w-full text-sm text-gray-600
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-lg file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-green-50 file:text-green-700
                                      hover:file:bg-green-100
                                      file:cursor-pointer cursor-pointer
                                      border border-gray-300 rounded-lg"
                               accept="image/png,image/jpg,image/jpeg,image/svg+xml,image/webp"
                               required>
                        
                        <button type="submit" 
                                class="w-full bg-primary hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan 
                        </button>
                    </div>

                    <p class="text-xs text-gray-500 mt-2">Format: PNG, JPG, SVG • Max: 2MB</p>
                </form>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="mt-8 bg-green-50 border border-green-200 rounded-lg p-5">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-green-600 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <div>
                    <p class="text-green-800 font-semibold mb-2">💡 Tips Penggunaan:</p>
                    <ul class="text-green-700 text-sm space-y-1">
                        <li>• Gunakan format PNG untuk logo dengan background transparan</li>
                        <li>• Ukuran maksimal file adalah 2MB</li>
                        <li>• Gambar lama akan otomatis terhapus saat upload gambar baru</li>
                        <li>• Klik tombol "Simpan" setelah memilih file</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="loading-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl p-8 flex flex-col items-center">
        <svg class="animate-spin h-12 w-12 text-green-600 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
        <span class="text-gray-700 font-semibold text-lg">Uploading...</span>
        <span class="text-gray-500 text-sm mt-1">Mohon tunggu sebentar</span>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // Handle form submit
    document.querySelectorAll('.upload-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const fileInput = this.querySelector('.file-input');
            
            // Validasi file dipilih
            if (!fileInput.files.length) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih File',
                    text: 'Silakan pilih file terlebih dahulu',
                    confirmButtonColor: '#16A34A'
                });
                return;
            }

            const file = fileInput.files[0];

            // Validasi tipe file
            const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Format Tidak Valid',
                    text: 'File harus PNG, JPG, JPEG, SVG, atau WEBP',
                    confirmButtonColor: '#16A34A'
                });
                return;
            }

            // Validasi ukuran file
            if (file.size > 2 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Terlalu Besar',
                    text: 'Ukuran maksimal 2MB',
                    confirmButtonColor: '#16A34A'
                });
                return;
            }

            // Show loading
            document.getElementById('loading-overlay').classList.remove('hidden');

            // Submit via fetch
            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('loading-overlay').classList.add('hidden');
                
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false,
                        confirmButtonColor: '#16A34A'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Upload',
                        text: data.message || 'Terjadi kesalahan',
                        confirmButtonColor: '#16A34A'
                    });
                }
            })
            .catch(error => {
                document.getElementById('loading-overlay').classList.add('hidden');
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Gagal upload gambar. Silakan coba lagi.',
                    confirmButtonColor: '#16A34A'
                });
            });
        });
    });

    // Handle delete button
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const key = this.dataset.key;
            
            Swal.fire({
                title: 'Hapus Gambar?',
                text: 'Gambar akan dihapus permanen dari server',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteImage(key);
                }
            });
        });
    });

    /**
     * Delete Image
     */
    function deleteImage(key) {
        document.getElementById('loading-overlay').classList.remove('hidden');

        fetch('<?php echo e(route("admin.cms.delete")); ?>', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ key: key })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('loading-overlay').classList.add('hidden');
            
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Terhapus!',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: data.message,
                    confirmButtonColor: '#16A34A'
                });
            }
        })
        .catch(error => {
            document.getElementById('loading-overlay').classList.add('hidden');
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Gagal menghapus gambar',
                confirmButtonColor: '#16A34A'
            });
        });
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SILALA_BPMSPH\resources\views/admin/cms/index.blade.php ENDPATH**/ ?>