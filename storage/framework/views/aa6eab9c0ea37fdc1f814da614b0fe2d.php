<?php $__env->startSection('title', 'Edit Profil User'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-[#F3EED9] py-10 px-6">
    <form method="POST" action="<?php echo e(route('user.updateprofil')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
        
        <!-- Card -->
        <div class="bg-white shadow-md rounded-3xl p-8 md:p-10 w-full">
            <h2 class="text-center text-xl md:text-2xl font-semibold text-[#2E2E2E] mb-8">
                Ubah Informasi Anda
            </h2>

            <!-- Kontainer dua kolom -->
            <div class="flex flex-col md:flex-row gap-8 md:gap-10 items-start">

                <!-- KIRI: Foto profil + Password -->
                <div class="flex flex-col w-full md:w-1/2 justify-between">
                    <!-- Foto Profil -->
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <div class="w-36 h-36 rounded-full bg-[#F3F7EE] border-2 border-[#C9DABF] overflow-hidden 
                                      shadow-[0_6px_12px_rgba(0,0,0,0.12)] flex items-center justify-center">
                                <?php if(Auth::user()->foto_profil): ?>
                                    <img id="preview-foto" src="<?php echo e(asset('storage/' . Auth::user()->foto_profil)); ?>" 
                                         class="w-full h-full object-cover" alt="Foto profil" />
                                <?php else: ?>
                                    <img id="preview-foto" src="<?php echo e(asset('assets/Profile.jpg')); ?>" 
                                         class="w-full h-full object-cover" alt="Foto profil" />
                                <?php endif; ?>
                            </div>

                            <label for="foto_profil" class="cursor-pointer absolute bottom-2 right-2 bg-[#8CA47E] hover:bg-[#7c946e] text-white p-2 rounded-full shadow-md transition"
                                   aria-label="Ubah foto profil">
                                <span class="iconify" data-icon="mdi:pencil" data-width="16"></span>
                            </label>
                            <input type="file" id="foto_profil" name="foto_profil" accept="image/*" class="hidden" onchange="previewImage(this)">
                        </div>
                    </div>

                    <!-- Passwords -->
<div class="mt-2">
    <!-- Password Sekarang -->
    <div class="mb-1">
        <label for="current_password" class="flex items-center text-[#2E2E2E] text-sm font-medium mb-1">
            <span class="iconify mr-2 text-[#8CA47E]" data-icon="mdi:lock-outline"></span> Password Sekarang
        </label>
        <div class="relative">
            <input id="current_password"
       name="current_password"
       type="password"
       placeholder="Masukkan password saat ini"
       autocomplete="new-password"
       class="w-full border border-[#DADADA] rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-[#8CA47E] pr-10" />

            <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-[#8CA47E] transition"
                onclick="togglePassword('current_password', 'current_password_eye')">
                <span id="current_password_eye" class="iconify" data-icon="mdi:eye-off-outline" data-width="20"></span>
            </button>
        </div>
        <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Password Baru -->
    <div class="mt-4">
        <label for="new_password" class="flex items-center text-[#2E2E2E] text-sm font-medium mb-1">
            <span class="iconify mr-2 text-[#8CA47E]" data-icon="mdi:lock-reset"></span> Password Baru
        </label>
        <div class="relative">
            <input id="new_password" name="new_password" type="password" placeholder="Masukkan password baru (opsional)"
                class="w-full border border-[#DADADA] rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-[#8CA47E] pr-10" />
            <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-[#8CA47E] transition"
                onclick="togglePassword('new_password', 'new_password_eye')">
                <span id="new_password_eye" class="iconify" data-icon="mdi:eye-off-outline" data-width="20"></span>
            </button>
        </div>
        <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- Konfirmasi Password Baru -->
    <div class="mt-4">
        <label for="new_password_confirmation" class="flex items-center text-[#2E2E2E] text-sm font-medium mb-1">
            <span class="iconify mr-2 text-[#8CA47E]" data-icon="mdi:lock-check-outline"></span> Konfirmasi Password Baru
        </label>
        <div class="relative">
            <input id="new_password_confirmation" name="new_password_confirmation" type="password" placeholder="Konfirmasi password baru"
                class="w-full border border-[#DADADA] rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-[#8CA47E] pr-10" />
            <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-[#8CA47E] transition"
                onclick="togglePassword('new_password_confirmation', 'new_password_confirmation_eye')">
                <span id="new_password_confirmation_eye" class="iconify" data-icon="mdi:eye-off-outline" data-width="20"></span>
            </button>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, eyeIconId) {
    const passwordInput = document.getElementById(inputId);
    const eyeIcon = document.getElementById(eyeIconId);
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.setAttribute('data-icon', 'mdi:eye-outline');
    } else {
        passwordInput.type = 'password';
        eyeIcon.setAttribute('data-icon', 'mdi:eye-off-outline');
    }
    
    // Refresh iconify icon
    if (window.iconify) {
        window.iconify.scan(eyeIcon);
    }
}
</script>
                </div>

                <!-- KANAN: Data Profil -->
                <div class="flex flex-col w-full md:w-1/2 gap-4">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="name" class="flex items-center text-[#2E2E2E] text-sm font-medium mb-1">
                            <span class="iconify mr-2 text-[#8CA47E]" data-icon="mdi:account-outline"></span> Nama Lengkap
                        </label>
                        <input id="name" name="name" type="text" value="<?php echo e(old('name', Auth::user()->name)); ?>"
                            class="w-full border border-[#DADADA] rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-[#8CA47E]" />
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="flex items-center text-[#2E2E2E] text-sm font-medium mb-1">
                            <span class="iconify mr-2 text-[#8CA47E]" data-icon="mdi:email-outline"></span> Email
                        </label>
                        <input id="email" name="email" type="email" value="<?php echo e(old('email', Auth::user()->email)); ?>"
                            class="w-full border border-[#DADADA] rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-[#8CA47E]" />
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Telepon -->
                    <div>
                        <label for="phone" class="flex items-center text-[#2E2E2E] text-sm font-medium mb-1">
                            <span class="iconify mr-2 text-[#8CA47E]" data-icon="mdi:phone-outline"></span> Telepon
                        </label>
                        <input id="phone" name="phone" type="text" value="<?php echo e(old('phone', Auth::user()->phone)); ?>"
                            class="w-full border border-[#DADADA] rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-[#8CA47E]" />
                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="flex items-center text-[#2E2E2E] text-sm font-medium mb-1">
                            <span class="iconify mr-2 text-[#8CA47E]" data-icon="mdi:gender-female"></span> Jenis Kelamin
                        </label>
                        <div class="flex items-center space-x-6">
                            <label class="flex items-center text-sm text-[#2E2E2E]">
                                <input type="radio" name="gender" value="Perempuan" 
                                  <?php echo e((old('gender', Auth::user()->gender) == 'P' || old('gender') == 'Perempuan') ? 'checked' : ''); ?> class="accent-[#8CA47E] mr-2" /> Perempuan
                            </label>
                            <label class="flex items-center text-sm text-[#2E2E2E]">
                                <input type="radio" name="gender" value="Laki-laki" 
                                  <?php echo e((old('gender', Auth::user()->gender) == 'L' || old('gender') == 'Laki-laki') ? 'checked' : ''); ?> class="accent-[#8CA47E] mr-2" /> Laki-laki  
                            </label>
                        </div>
                        <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
<!-- Tipe Keanggotaan -->
<div>
    <label class="flex items-center text-[#2E2E2E] text-sm font-medium mb-1">
        <span class="iconify mr-2 text-[#8CA47E]" data-icon="mdi:card-account-details"></span> Tipe Keanggotaan
    </label>
    
    <div class="bg-[#F8F8F8] border border-[#DADADA] rounded-md p-4">
        <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-6">
            <?php
                $current = old('membership_type', Auth::user()->membership_type);
                // Normalize value - trim whitespace and ensure proper case
                $normalizedCurrent = $current ? trim(ucfirst(strtolower($current))) : '';
            ?>
            
            <!-- Opsi Karyawan -->
            <div class="flex items-center">
                <input type="radio" id="karyawan" name="membership_type" value="Karyawan" 
                    <?php echo e(($normalizedCurrent == 'Karyawan') ? 'checked' : ''); ?> 
                    class="accent-[#8CA47E] mr-2" />
                <label for="karyawan" class="text-sm text-[#2E2E2E] cursor-pointer flex items-center">
                    <span class="iconify mr-1" data-icon="mdi:briefcase-account" data-width="16"></span>
                    Karyawan
                </label>
            </div>
            
            <!-- Opsi Magang -->
            <div class="flex items-center">
                <input type="radio" id="magang" name="membership_type" value="Magang" 
                    <?php echo e(($normalizedCurrent == 'Magang') ? 'checked' : ''); ?> 
                    class="accent-[#8CA47E] mr-2" />
                <label for="magang" class="text-sm text-[#2E2E2E] cursor-pointer flex items-center">
                    <span class="iconify mr-1" data-icon="mdi:school-outline" data-width="16"></span>
                    Magang
                </label>
            </div>
        </div>
    </div>
    
    <?php $__errorArgs = ['membership_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <p class="text-xs text-gray-500 mt-1">Pilih status keanggotaan Anda di perusahaan</p>
</div>
                </div>
            </div>

            <!-- Tombol Simpan dan Batal -->
            <div class="mt-8 flex justify-center gap-4">
                <a href="<?php echo e(route('user.profil')); ?>" 
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-xl shadow-md transition">
                    Batal
                </a>
                <button type="submit"
                    class="bg-[#8CA47E] hover:bg-[#7c946e] text-white font-semibold py-2 px-6 rounded-xl shadow-md transition">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
<script>
function previewImage(input) {
    const preview = document.getElementById('preview-foto');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_user.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/user/editprofil.blade.php ENDPATH**/ ?>