
<?php $__env->startSection('pageTitle', 'Edit Profile Admin'); ?>

<?php $__env->startSection('content'); ?>

<div class="min-h-screen bg-gradient-to-br from-[#F9FBF4] via-white to-[#F2F6E9] py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- HEADER SECTION -->
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-2">
                <a href="<?php echo e(route('admin.profile.index')); ?>" class="w-10 h-10 bg-white rounded-lg shadow-md flex items-center justify-center hover:bg-[#F9FBF4] transition-all group">
                    <i class="fas fa-arrow-left text-[#6E7C45] group-hover:-translate-x-1 transition-transform"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-[#6E7C45] to-[#A4B465] bg-clip-text text-transparent">
                        Edit Profile
                    </h1>
                    <p class="text-sm text-gray-600 mt-1">Kelola informasi dan keamanan akun Anda</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- LEFT - FORM UPDATE PROFILE -->
            <div class="space-y-6">
                
                <!-- FORM UPDATE PROFILE -->
                <div class="bg-white rounded-2xl shadow-xl border border-[#DDE6C5] overflow-hidden h-full">
                    
                    <div class="bg-gradient-to-r from-[#A4B465] to-[#8C9E55] px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                                <i class="fas fa-user-edit text-white text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-white">Informasi Profil</h2>
                                <p class="text-xs text-white/80">Update data pribadi Anda</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <form action="<?php echo e(route('admin.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="space-y-5">

                                <!-- Preview Foto di dalam form -->
                                <div class="flex justify-center mb-4">
                                    <div class="relative">
                                        <img id="previewImageForm"
                                            src="<?php echo e($admin->foto ? asset('storage/' . $admin->foto) : asset('assets/image_default/image_default_book.jpeg')); ?>"
                                            class="w-24 h-24 rounded-full object-cover border-4 border-[#A4B465] shadow-lg">
                                        <div class="absolute bottom-0 right-0 w-7 h-7 bg-[#A4B465] rounded-full flex items-center justify-center shadow-lg">
                                            <i class="fas fa-camera text-white text-xs"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Upload Foto -->
                                <div>
                                    <label class="block font-semibold text-[#6E7C45] mb-2 text-sm">
                                        <i class="fas fa-image text-[#A4B465] mr-2"></i>
                                        Foto Profil
                                    </label>
                                    <label class="block relative group cursor-pointer">
                                        <div class="border-2 border-dashed border-[#D8E2C0] rounded-xl p-4 bg-gradient-to-br from-[#F9FBF4] to-white hover:border-[#A4B465] transition-all">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-gradient-to-br from-[#A4B465] to-[#8C9E55] rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                                                    <i class="fas fa-cloud-upload-alt text-white"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-sm font-medium text-[#6E7C45]" id="btnFotoText">Pilih Foto Baru</p>
                                                    <p class="text-xs text-gray-500">JPG, PNG, GIF (Max: 2MB)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="file" id="fotoInput" name="foto" class="hidden">
                                    </label>
                                    <span id="selectedFileName" class="hidden block text-xs text-green-600 font-medium mt-2"></span>
                                </div>
                        
                                <!-- Nama -->
                                <div>
                                    <label class="block font-semibold text-[#6E7C45] mb-2 text-sm">
                                        <i class="fas fa-user text-[#A4B465] mr-2"></i>
                                        Nama Lengkap
                                    </label>
                                    <input type="text" id="nameInput" name="name" value="<?php echo e($admin->name); ?>"
                                        class="w-full border-2 border-[#D8E2C0] rounded-xl px-4 py-2.5 bg-[#F9FBF4] focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465] transition-all text-sm"
                                        placeholder="Masukkan nama lengkap">
                                </div>

                                <!-- Telepon -->
                                <div>
                                    <label class="block font-semibold text-[#6E7C45] mb-2 text-sm">
                                        <i class="fas fa-phone text-[#A4B465] mr-2"></i>
                                        No Telepon
                                    </label>
                                    <input type="text" id="phoneInput" name="phone" value="<?php echo e($admin->phone); ?>"
                                        class="w-full border-2 border-[#D8E2C0] rounded-xl px-4 py-2.5 bg-[#F9FBF4] focus:ring-2 focus:ring-[#A4B465] focus:border-[#A4B465] transition-all text-sm"
                                        placeholder="08123456789">
                                </div>

                                <!-- Email (Readonly) -->
                                <div>
                                    <label class="block font-semibold text-[#6E7C45] mb-2 text-sm">
                                        <i class="fas fa-envelope text-[#A4B465] mr-2"></i>
                                        Email
                                    </label>
                                    <div class="relative">
                                        <input type="text" value="<?php echo e($admin->email); ?>" readonly
                                            class="w-full border-2 bg-gray-50 border-gray-200 rounded-xl px-4 py-2.5 cursor-not-allowed opacity-75 pr-20 text-sm">
                                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs bg-gray-200 text-gray-600 px-2 py-1 rounded-full font-medium">
                                            <i class="fas fa-lock text-xs mr-1"></i>Terkunci
                                        </span>
                                    </div>
                                </div>

                            </div>

                            <button type="submit" id="btnSaveProfile" disabled
                                class="mt-6 w-full py-3 text-white rounded-xl font-bold transition-all duration-300 flex justify-center items-center gap-2 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-400 transform hover:scale-[1.02] text-sm">
                                <i class="fas fa-save"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                        </form>
                    </div>

                </div>
            </div>

            <!-- RIGHT - FORM GANTI PASSWORD -->
            <div class="space-y-6">
                <!-- FORM GANTI PASSWORD -->
                <div class="bg-white rounded-2xl shadow-xl border border-[#DDE6C5] overflow-hidden h-full">

                    <div class="bg-gradient-to-r from-[#6E7C45] to-[#5E6A3A] px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                                <i class="fas fa-lock text-white text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-white">Keamanan Akun</h2>
                                <p class="text-xs text-white/80">Ubah password untuk keamanan</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <form id="formPassword" action="<?php echo e(route('admin.profile.updatePassword')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <div class="space-y-5">

                                <!-- Password Lama -->
                                <div>
                                    <label class="block font-semibold text-[#6E7C45] mb-2 text-sm">
                                        <i class="fas fa-key text-[#6E7C45] mr-2"></i>
                                        Password Sekarang
                                    </label>
                                    <div class="relative">
                                        <input type="password" id="currentPassword" name="current_password"
                                            class="w-full border-2 border-[#D8E2C0] rounded-xl px-4 py-2.5 bg-[#F9FBF4] focus:ring-2 focus:ring-[#6E7C45] focus:border-[#6E7C45] transition-all pr-12 text-sm"
                                            placeholder="Masukkan Password saat ini">
                                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#6E7C45] transition-colors">
                                            <i class="fas fa-eye text-sm"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Password Baru -->
                                <div>
                                    <label class="block font-semibold text-[#6E7C45] mb-2 text-sm">
                                        <i class="fas fa-unlock-alt text-[#6E7C45] mr-2"></i>
                                        Password Baru
                                    </label>
                                    <div class="relative">
                                        <input type="password" id="newPassword" name="password"
                                            class="w-full border-2 border-[#D8E2C0] rounded-xl px-4 py-2.5 bg-[#F9FBF4] focus:ring-2 focus:ring-[#6E7C45] focus:border-[#6E7C45] transition-all pr-12 text-sm"
                                            placeholder="Min. 8 karakter">
                                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#6E7C45] transition-colors">
                                            <i class="fas fa-eye text-sm"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Konfirmasi Password -->
                                <div>
                                    <label class="block font-semibold text-[#6E7C45] mb-2 text-sm">
                                        <i class="fas fa-check-circle text-[#6E7C45] mr-2"></i>
                                        Konfirmasi Password
                                    </label>
                                    <div class="relative">
                                        <input type="password" id="confirmPassword" name="password_confirmation"
                                            class="w-full border-2 border-[#D8E2C0] rounded-xl px-4 py-2.5 bg-[#F9FBF4] focus:ring-2 focus:ring-[#6E7C45] focus:border-[#6E7C45] transition-all pr-12 text-sm"
                                            placeholder="Ulangi password baru">
                                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#6E7C45] transition-colors">
                                            <i class="fas fa-eye text-sm"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>

                            <!-- Info Box -->
                            <div class="mt-5 bg-gradient-to-r from-[#FEF3C7] to-[#FDE68A] border-l-4 border-[#F59E0B] rounded-xl p-4">
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-shield-alt text-[#F59E0B] mt-0.5"></i>
                                    <div class="text-xs text-[#92400E]">
                                        <p class="font-bold mb-2">Tips Password Kuat:</p>
                                        <ul class="space-y-1">
                                            <li class="flex items-center gap-2">
                                                <i class="fas fa-check-circle text-green-600 text-xs"></i>
                                                <span>Minimal 8 karakter</span>
                                            </li>
                                            <li class="flex items-center gap-2">
                                                <i class="fas fa-check-circle text-green-600 text-xs"></i>
                                                <span>Kombinasi huruf besar & kecil</span>
                                            </li>
                                            <li class="flex items-center gap-2">
                                                <i class="fas fa-check-circle text-green-600 text-xs"></i>
                                                <span>Sertakan angka dan simbol</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" id="btnSavePassword" disabled
                                class="mt-6 w-full py-3 text-white rounded-xl font-bold transition-all duration-300 flex justify-center items-center gap-2 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-400 transform hover:scale-[1.02] text-sm">
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
    // Function untuk enable button save
    function enableSaveButton() {
        const btnSave = document.getElementById('btnSaveProfile');
        if (btnSave) {
            btnSave.disabled = false;
            btnSave.classList.remove('disabled:bg-gray-400', 'bg-gray-400');
            btnSave.classList.add('bg-gradient-to-r', 'from-[#A4B465]', 'to-[#8C9E55]', 'hover:from-[#8C9E55]', 'hover:to-[#6E7C45]');
        }
    }

    // Preview image saat dipilih
    document.addEventListener('DOMContentLoaded', function() {
        const fotoInput = document.getElementById('fotoInput');
        
        if (fotoInput) {
            fotoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Validasi ukuran
                    if (file.size > 2048000) {
                        Swal.fire({
                            icon: 'error',
                            title: 'File Terlalu Besar',
                            text: 'Ukuran file maksimal 2MB',
                            confirmButtonColor: '#6E7C45'
                        });
                        this.value = '';
                        return;
                    }

                    // Preview foto
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('previewImageForm');
                        if (preview) {
                            preview.src = e.target.result;
                        }
                    }
                    reader.readAsDataURL(file);
                    
                    // Update UI
                    const btnFotoText = document.getElementById('btnFotoText');
                    const selectedFileName = document.getElementById('selectedFileName');
                    
                    if (btnFotoText) {
                        btnFotoText.textContent = file.name;
                    }
                    if (selectedFileName) {
                        selectedFileName.textContent = '✓ ' + file.name;
                        selectedFileName.classList.remove('hidden');
                    }
                    
                    // Enable button save
                    enableSaveButton();
                }
            });
        }

        // Enable button saat input berubah
        const profileInputs = ['nameInput', 'phoneInput'];
        profileInputs.forEach(inputId => {
            const input = document.getElementById(inputId);
            if (input) {
                input.addEventListener('input', enableSaveButton);
            }
        });

        // Enable button password
        const passwordInputs = ['currentPassword', 'newPassword', 'confirmPassword'];
        passwordInputs.forEach(inputId => {
            const input = document.getElementById(inputId);
            if (input) {
                input.addEventListener('input', function() {
                    const allFilled = passwordInputs.every(id => {
                        const el = document.getElementById(id);
                        return el && el.value.length > 0;
                    });
                    
                    const btnSavePassword = document.getElementById('btnSavePassword');
                    if (btnSavePassword) {
                        if (allFilled) {
                            btnSavePassword.disabled = false;
                            btnSavePassword.classList.remove('disabled:bg-gray-400', 'bg-gray-400');
                            btnSavePassword.classList.add('bg-gradient-to-r', 'from-[#6E7C45]', 'to-[#5E6A3A]', 'hover:from-[#5E6A3A]', 'hover:to-[#4E5A2A]');
                        } else {
                            btnSavePassword.disabled = true;
                            btnSavePassword.classList.add('disabled:bg-gray-400');
                            btnSavePassword.classList.remove('bg-gradient-to-r', 'from-[#6E7C45]', 'to-[#5E6A3A]', 'hover:from-[#5E6A3A]', 'hover:to-[#4E5A2A]');
                        }
                    }
                });
            }
        });
    });

    <?php if(session('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?php echo e(session('success')); ?>',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
        }).then(() => {
            window.location.href = "<?php echo e(route('admin.profile')); ?>";
        });
    <?php endif; ?>

    <?php if(session('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?php echo e(session('error')); ?>',
            confirmButtonColor: '#6E7C45'
        });
    <?php endif; ?>
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\SILALA_BPMSPH\resources\views/admin/profile/edit.blade.php ENDPATH**/ ?>