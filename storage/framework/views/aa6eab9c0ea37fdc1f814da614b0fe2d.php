

<?php $__env->startSection('title', 'Edit Profil User'); ?>

<?php $__env->startSection('content'); ?>
   <!-- Card -->
    <div class="bg-white shadow-md rounded-3xl p-8 md:p-10 w-full max-w-5xl">
      <h2 class="text-center text-xl md:text-2xl font-semibold text-[#2E2E2E] mb-8">
        Ubah Informasi Anda
      </h2>

      <!-- Kontainer dua kolom -->
      <div class="flex flex-col md:flex-row gap-8 md:gap-10 items-start">

        <!-- KIRI: Foto profil + Password (justify-between agar password turun sejajar) -->
        <div class="flex flex-col w-full md:w-1/2 justify-between">
          <!-- Foto Profil -->
          <div class="flex justify-center mb-6">
            <div class="relative">
              <div class="w-36 h-36 rounded-full bg-[#F3F7EE] border-2 border-[#C9DABF] overflow-hidden 
                          shadow-[0_6px_12px_rgba(0,0,0,0.12)] flex items-center justify-center">
                <img src="<?php echo e(asset('assets/Profile.jpg')); ?>" class="w-full h-full object-cover" alt="Foto profil" />
              </div>

              <button class="absolute bottom-2 right-2 bg-[#8CA47E] hover:bg-[#7c946e] text-white p-2 rounded-full shadow-md transition"
                      type="button" aria-label="Ubah foto profil">
                <span class="iconify" data-icon="mdi:pencil" data-width="16"></span>
              </button>
            </div>
          </div>

          <!-- Passwords (di bawah foto, jadi sejajar dengan kanan) -->
          <div class="mt-2">
            <label class="flex items-center text-[#2E2E2E] text-sm font-medium mb-1">
              <span class="iconify mr-2 text-[#8CA47E]" data-icon="mdi:lock-outline"></span> Password Sekarang
            </label>
            <input id="current_password" type="password" placeholder="********"
              class="w-full border border-[#DADADA] rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-[#8CA47E]" />

            <label class="flex items-center text-[#2E2E2E] text-sm font-medium mt-4 mb-1">
              <span class="iconify mr-2 text-[#8CA47E]" data-icon="mdi:lock-reset"></span> Ubah Password
            </label>
            <input id="new_password" type="password" placeholder="Masukkan password baru"
              class="w-full border border-[#DADADA] rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-[#8CA47E]" />
          </div>
        </div>

        <!-- KANAN: Nama, Email, Telepon, Tanggal Lahir + Jenis Kelamin (stacked, bukan grid) -->
        <div class="flex flex-col w-full md:w-1/2 gap-4">

          <!-- Nama Lengkap -->
          <div>
            <label class="flex items-center text-[#2E2E2E] text-sm font-medium mb-1">
              <span class="iconify mr-2 text-[#8CA47E]" data-icon="mdi:account-outline"></span> Nama Lengkap
            </label>
            <input id="name" type="text" value="Rifdhatul Aisya"
              class="w-full border border-[#DADADA] rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-[#8CA47E]" />
          </div>

          <!-- Email -->
          <div>
            <label class="flex items-center text-[#2E2E2E] text-sm font-medium mb-1">
              <span class="iconify mr-2 text-[#8CA47E]" data-icon="mdi:email-outline"></span> Email
            </label>
            <input id="email" type="email" value="rifdah.a122@gmail.com"
              class="w-full border border-[#DADADA] rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-[#8CA47E]" />
          </div>

          <!-- Telepon -->
          <div>
            <label class="flex items-center text-[#2E2E2E] text-sm font-medium mb-1">
              <span class="iconify mr-2 text-[#8CA47E]" data-icon="mdi:phone-outline"></span> Telepon
            </label>
            <input id="phone" type="text" value="089567884234"
              class="w-full border border-[#DADADA] rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-[#8CA47E]" />
          </div>

          <!-- Tanggal Lahir (stacked, bukan grid) -->
          <div>
            <label class="flex items-center text-[#2E2E2E] text-sm font-medium mb-1">
              <span class="iconify mr-2 text-[#8CA47E]" data-icon="mdi:calendar-outline"></span> Tanggal Lahir
            </label>
            <div class="relative">
              <input id="birthdate" type="text" value="23 Oktober 2007"
                class="w-full border border-[#DADADA] rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-[#8CA47E]" />
              <span class="iconify absolute right-3 top-2.5 text-[#8CA47E]" data-icon="mdi:calendar-month-outline"></span>
            </div>
          </div>

          <!-- Jenis Kelamin (stacked, radio inline tapi bukan grid) -->
          <div>
            <label class="flex items-center text-[#2E2E2E] text-sm font-medium mb-1">
              <span class="iconify mr-2 text-[#8CA47E]" data-icon="mdi:gender-female"></span> Jenis Kelamin
            </label>

            <div class="flex items-center space-x-6">
              <label class="flex items-center text-sm text-[#2E2E2E]">
                <input type="radio" name="gender" value="wanita" checked class="accent-[#8CA47E] mr-2" /> Wanita
              </label>
              <label class="flex items-center text-sm text-[#2E2E2E]">
                <input type="radio" name="gender" value="pria" class="accent-[#8CA47E] mr-2" /> Pria
              </label>
            </div>
          </div>

        </div>
      </div>

      <!-- Tombol Simpan -->
      <div class="mt-8 flex justify-center">
        <button type="submit"
          class="bg-[#8CA47E] hover:bg-[#7c946e] text-white font-semibold py-2 px-6 rounded-xl shadow-md transition">
          Simpan
        </button>
      </div>
    </div>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_user.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/user/editprofil.blade.php ENDPATH**/ ?>