

<?php $__env->startSection('title', 'Profil User'); ?>

<?php $__env->startSection('content'); ?>
  <div class="min-h-screen bg-[#F3EED9] py-10 px-6">

    <!-- Kartu Header -->
    <div class="bg-white rounded-2xl shadow-md px-8 py-6 flex justify-between items-center max-w-5xl mx-auto -mt-6">
      <div>
        <h1 class="text-xl font-bold text-[#2E2E2E]">Hi, Rifdatul Aisya!</h1>
        <p class="text-sm text-[#626F47] mt-1">Bergabung Sejak 27 Oktober 2025</p>
      </div>

      <!-- Foto Profile -->
      <div class="w-20 h-20 rounded-full bg-[#F3F7EE] border-2 border-[#C9DABF] overflow-hidden 
                  shadow-[0_6px_12px_rgba(0,0,0,0.12)] flex items-center justify-center">
        <img src="<?php echo e(asset('assets/Profile.jpg')); ?>" class="w-full h-full object-cover" />
      </div>
    </div>

    <!-- Kartu Informasi -->
    <div class="bg-white rounded-2xl shadow-md mt-10 px-10 py-10 max-w-5xl mx-auto">
      <h2 class="text-center text-xl font-bold text-[#2E2E2E] mb-10">Informasi Tentang Anda!</h2>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">

        <!-- Kolom Kiri (Input Data) -->
        <div class="md:col-span-2 space-y-4">
            <div class="flex items-center gap-3 rounded-lg px-3 py-2 
            bg-[#F8F8F8] border border-[#626F47]">
        <span class="iconify" data-icon="fa-solid:user" style="color:#626F47;" data-width="18" data-height="18"></span>
        <input type="text" value="Rifdatul Aisya" readonly
                class="w-full border-none focus:ring-0 bg-transparent text-sm text-[#2E2E2E]" />
        </div>

          <div class="flex items-center gap-3 rounded-lg px-3 py-2 
            bg-[#F8F8F8] border border-[#626F47]">
            <span class="iconify" data-icon="fa-solid:envelope" style="color:#626F47;" data-width="18" data-height="18"></span>
            <input type="text" value="rifdatul.a12@gmail.com" readonly
                   class="w-full border-none focus:ring-0 text-sm text-[#2E2E2E] bg-transparent" />
          </div>

          <div class="flex items-center gap-3 rounded-lg px-3 py-2 
            bg-[#F8F8F8] border border-[#626F47]">
            <span class="iconify" data-icon="fa-solid:phone" style="color:#626F47;" data-width="18" data-height="18"></span>
            <input type="text" value="089567884234" readonly
                   class="w-full border-none focus:ring-0 text-sm text-[#2E2E2E] bg-transparent" />
          </div>

          <div class="flex items-center gap-3 rounded-lg px-3 py-2 
            bg-[#F8F8F8] border border-[#626F47]">
            <span class="iconify" data-icon="mdi:account-star" style="color:#626F47;" data-width="24" data-height="24"></span>
            <input type="text" value="Magang" readonly
                   class="w-full border-none focus:ring-0 text-sm text-[#2E2E2E] bg-transparent" />
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

          <div class="flex items-center gap-3 rounded-lg px-3 py-2 
            bg-[#F8F8F8] border border-[#626F47]">
            <span class="iconify" data-icon="mdi:gender-male-female" style="color:#626F47;" data-width="24" data-height="24"></span>
            <input type="text" value="Wanita" readonly
                   class="w-full border-none focus:ring-0 text-sm text-[#2E2E2E] bg-transparent" />
          </div>

          <div class="flex items-center gap-3 rounded-lg px-3 py-2 
            bg-[#F8F8F8] border border-[#626F47]">
            <span class="iconify" data-icon="fa-solid:calendar" style="color:#626F47;" data-width="18" data-height="18"></span>
            <input type="text" value="Tanggal Lahir Belum Diisi" readonly
                   class="w-full border-none focus:ring-0 text-sm text-[#2E2E2E] bg-transparent" />
          </div>
        </div>
    </div>

       <!-- Kolom Kanan (Gambar + Button) -->
  <div class="flex flex-col items-center gap-4">
    <img src="<?php echo e(asset('assets/logoprofil.png')); ?>" class="w-48 object-contain" />

    <a href="<?php echo e(route('user.editprofil')); ?>"
      class="bg-[#A4B465] hover:bg-[#8EA653] text-white font-medium px-8 py-2 rounded-full flex items-center gap-2 transition">
      <span class="iconify" data-icon="fa-solid:pen" style="color:white;" data-width="16" data-height="16"></span>
      Edit
    </a>
  </div>
      </div>
    </div>

  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_user.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/user/profil.blade.php ENDPATH**/ ?>