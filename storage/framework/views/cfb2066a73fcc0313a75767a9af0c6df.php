
<?php $__env->startSection('pageTitle', 'Edit Profile Admin'); ?>

<?php $__env->startSection('content'); ?>


<div class="min-h-screen">
    
    <div class="h-full">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                
                <div class="lg:col-span-4">
                    <div class="bg-white/20 backdrop-blur-lg border border-white/30 rounded-2xl shadow-xl overflow-hidden">

                        
                        
                        <div class="bg-gradient-to-br from-[#A4B465] to-[#6E7C45] h-24 relative">
                            <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2">
                                <div class="relative group">
                                    <div class="absolute inset-0 bg-white rounded-full blur-md opacity-50"></div>
                                    <img id="previewImage" 
                                         src="<?php echo e($admin->foto ? asset('uploads/admin/'.$admin->foto) : asset('default.png')); ?>"
                                         class="relative w-32 h-32 rounded-full object-cover border-4 border-white shadow-xl ring-4 ring-[#A4B465]/30 bg-white">
                                    <div class="absolute inset-0 rounded-full bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <i class="fas fa-camera text-white text-2xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-20 pb-6 px-6 text-center">
                            <label class="inline-flex items-center gap-2 cursor-pointer bg-gradient-to-r from-[#A4B465] to-[#8C9E55] text-white px-4 py-2 rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300 text-sm font-medium">
                                <i class="fas fa-camera"></i> 
                                <span>Ganti Foto</span>
                                <input type="file" id="fotoInput" name="foto" class="hidden" form="formProfile" accept="image/*">
                            </label>

                            <div class="mt-6 space-y-3">
                                <h3 class="text-xl font-bold text-[#6E7C45]"><?php echo e($admin->name); ?></h3>
                                <p class="text-sm text-[#8C9E55] flex items-center justify-center gap-2">
                                    <i class="fas fa-envelope"></i>
                                    <span class="break-all"><?php echo e($admin->email); ?></span>
                                </p>
                                <span class="inline-flex items-center gap-1.5 bg-[#F2F6E9] text-[#6E7C45] text-xs font-semibold px-3 py-1.5 rounded-full border border-[#DDE6C5]">
                                    <i class="fas fa-shield-alt"></i>
                                    Administrator
                                </span>
                            </div>
                        </div>

                    </div>
                </div>

                
                <div class="lg:col-span-8 space-y-6">
                    
                    
                    <div class="bg-white rounded-2xl shadow-xl border border-[#DDE6C5] overflow-hidden">
                        
                        <div class="bg-gradient-to-r from-[#F9FBF4] to-[#F2F6E9] px-6 py-4 border-b-2 border-[#DDE6C5]">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#A4B465] to-[#8C9E55] rounded-lg flex items-center justify-center shadow-md">
                                    <i class="fas fa-user-edit text-white"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg md:text-xl font-bold text-[#6E7C45]">Informasi Profil</h2>
                                    <p class="text-xs text-[#8C9E55]">Update data pribadi Anda</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <form id="formProfile" action="<?php echo e(route('admin.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                    
                                    <div>
                                        <label class="font-semibold text-[#6E7C45] flex items-center gap-2 mb-2 text-sm">
                                            <i class="fas fa-id-card-alt text-[#A4B465]"></i> 
                                            <span>Nama Lengkap</span>
                                        </label>
                                        <input type="text" id="nameInput" name="name" value="<?php echo e($admin->name); ?>"
                                               class="w-full border-2 border-[#D8E2C0] rounded-lg px-4 py-2.5 bg-[#F9FBF4] focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465] transition-all text-sm"
                                               placeholder="Masukkan nama lengkap">
                                    </div>

                                    
                                    <div>
                                        <label class="font-semibold text-[#6E7C45] flex items-center gap-2 mb-2 text-sm">
                                            <i class="fas fa-phone-alt text-[#A4B465]"></i> 
                                            <span>No Telepon</span>
                                        </label>
                                        <input type="text" id="telpInput" name="telp" value="<?php echo e($admin->telp); ?>"
                                               class="w-full border-2 border-[#D8E2C0] rounded-lg px-4 py-2.5 bg-[#F9FBF4] focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465] transition-all text-sm"
                                               placeholder="08123456789">
                                    </div>

                                    
                                    <div class="md:col-span-2">
                                        <label class="font-semibold text-[#6E7C45] flex items-center gap-2 mb-2 text-sm">
                                            <i class="fas fa-envelope text-[#A4B465]"></i> 
                                            <span>Email</span>
                                        </label>
                                        <div class="relative">
                                            <input type="text" value="<?php echo e($admin->email); ?>" readonly
                                                   class="w-full border-2 bg-gray-50 border-gray-200 rounded-lg px-4 py-2.5 cursor-not-allowed opacity-75 pr-24 text-sm">
                                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs bg-gray-200 text-gray-600 px-2 py-1 rounded-full font-medium">
                                                <i class="fas fa-lock text-xs mr-1"></i>Terkunci
                                            </span>
                                        </div>
                                    </div>

                                </div>

                                <button type="submit" id="btnSaveProfile" disabled
                                        class="mt-6 w-full py-3 text-white rounded-lg font-bold transition-all duration-300 flex justify-center items-center gap-2 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-400">
                                    <i class="fas fa-save"></i> 
                                    <span>Simpan Perubahan</span>
                                </button>
                            </form>
                        </div>

                    </div>

                </div>

            </div>

            
            <div class="mt-6">
                <div class="bg-white rounded-2xl shadow-xl border border-[#DDE6C5] overflow-hidden">

                    <div class="bg-gradient-to-r from-[#F9FBF4] to-[#F2F6E9] px-6 py-4 border-b-2 border-[#DDE6C5]">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#6E7C45] to-[#5E6A3A] rounded-lg flex items-center justify-center shadow-md">
                                <i class="fas fa-lock text-white"></i>
                            </div>
                            <div>
                                <h2 class="text-lg md:text-xl font-bold text-[#6E7C45]">Keamanan Akun</h2>
                                <p class="text-xs text-[#8C9E55]">Ubah password untuk keamanan</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <form id="formPassword" action="<?php echo e(route('admin.profile.updatePassword')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

                                
                                <div>
                                    <label class="font-semibold text-[#6E7C45] flex items-center gap-2 mb-2 text-sm">
                                        <i class="fas fa-key text-[#6E7C45]"></i> 
                                        <span>Password Sekarang</span>
                                    </label>
                                    <input type="password" id="currentPassword" name="current_password"
                                           class="w-full border-2 border-[#D8E2C0] rounded-lg px-4 py-2.5 bg-[#F9FBF4] focus:ring-2 focus:ring-[#6E7C45] focus:border-[#6E7C45] transition-all text-sm"
                                           placeholder="Masukkan password saat ini">
                                </div>

                                
                                <div>
                                    <label class="font-semibold text-[#6E7C45] flex items-center gap-2 mb-2 text-sm">
                                        <i class="fas fa-unlock-alt text-[#6E7C45]"></i> 
                                        <span>Password Baru</span>
                                    </label>
                                    <input type="password" id="newPassword" name="password"
                                           class="w-full border-2 border-[#D8E2C0] rounded-lg px-4 py-2.5 bg-[#F9FBF4] focus:ring-2 focus:ring-[#6E7C45] focus:border-[#6E7C45] transition-all text-sm"
                                           placeholder="Min. 8 karakter">
                                </div>

                                
                                <div>
                                    <label class="font-semibold text-[#6E7C45] flex items-center gap-2 mb-2 text-sm">
                                        <i class="fas fa-check-circle text-[#6E7C45]"></i> 
                                        <span>Konfirmasi Password</span>
                                    </label>
                                    <input type="password" id="confirmPassword" name="password_confirmation"
                                           class="w-full border-2 border-[#D8E2C0] rounded-lg px-4 py-2.5 bg-[#F9FBF4] focus:ring-2 focus:ring-[#6E7C45] focus:border-[#6E7C45] transition-all text-sm"
                                           placeholder="Ulangi password baru">
                                </div>

                            </div>

                            
                            <div class="mt-4 bg-gradient-to-r from-[#F9FBF4] to-[#F2F6E9] border-l-4 border-[#A4B465] rounded-lg p-3">
                                <div class="flex items-start gap-2">
                                    <i class="fas fa-info-circle text-[#A4B465] mt-0.5 text-sm"></i>
                                    <div class="text-xs text-[#6E7C45]">
                                        <p class="font-semibold mb-1">Tips Password Kuat:</p>
                                        <p>Min. 8 karakter • Kombinasi huruf, angka & simbol • Hindari info pribadi</p>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" id="btnSavePassword" disabled
                                    class="mt-6 w-full lg:w-auto lg:px-8 py-3 text-white rounded-lg font-bold transition-all duration-300 flex justify-center items-center gap-2 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-400">
                                <i class="fas fa-sync-alt"></i> 
                                <span>Update Password</span>
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<script>
   <?php if(session('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?php echo e(session("success")); ?>',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
        }).then(() => {
            window.location.href = "<?php echo e(route('admin.dashboard')); ?>";
        });
    <?php endif; ?>

    <?php if(session('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?php echo e(session("error")); ?>',
            confirmButtonColor: '#6E7C45'
        });
    <?php endif; ?>
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/profile_admin/edit.blade.php ENDPATH**/ ?>