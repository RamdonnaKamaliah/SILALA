<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php echo $__env->make('layout_dashboard.partial_dashboard.link', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <title>SILALA - Riwayat Pinjam</title>
  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets_user/css/dashboard.css')); ?>">
</head>
<body class="min-h-screen overflow-x-hidden font-[Ubuntu,sans-serif] bg-white">
  <?php echo $__env->make('layout_dashboard.partial_dashboard.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

 <main
  class="pt-8 pb-6 px-6 bg-cream
  relative top-[90px] mb-24
  md:ml-[320px] md:mr-3
  md:rounded-3xl transition-all duration-300 z-30
  flex flex-col overflow-y-auto overflow-x-hidden max-w-full shadow-inner">

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
        <i class="fa-solid fa-user text-[#626F47]"></i>

        <input type="text" value="Rifdatul Aisya" readonly
                class="w-full border-none focus:ring-0 bg-transparent text-sm text-[#2E2E2E]" />
        </div>

          <div class="flex items-center gap-3 rounded-lg px-3 py-2 
            bg-[#F8F8F8] border border-[#626F47]">
            <i class="fa-solid fa-envelope text-[#626F47]"></i>
            <input type="text" value="rifdatul.a12@gmail.com" readonly
                   class="w-full border-none focus:ring-0 text-sm text-[#2E2E2E] bg-transparent" />
          </div>

          <div class="flex items-center gap-3 rounded-lg px-3 py-2 
            bg-[#F8F8F8] border border-[#626F47]">
            <i class="fa-solid fa-phone text-[#626F47]"></i>
            <input type="text" value="089567884234" readonly
                   class="w-full border-none focus:ring-0 text-sm text-[#2E2E2E] bg-transparent" />
          </div>

          <div class="flex items-center gap-3 rounded-lg px-3 py-2 
            bg-[#F8F8F8] border border-[#626F47]">
            <i class="fa-solid fa-briefcase text-[#626F47]"></i>
            <input type="text" value="Magang" readonly
                   class="w-full border-none focus:ring-0 text-sm text-[#2E2E2E] bg-transparent" />
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

          <div class="flex items-center gap-3 rounded-lg px-3 py-2 
            bg-[#F8F8F8] border border-[#626F47]">
            <i class="fa-solid fa-venus text-[#626F47]"></i>
            <input type="text" value="Wanita" readonly
                   class="w-full border-none focus:ring-0 text-sm text-[#2E2E2E] bg-transparent" />
          </div>

          <div class="flex items-center gap-3 rounded-lg px-3 py-2 
            bg-[#F8F8F8] border border-[#626F47]">
            <i class="fa-solid fa-calendar text-[#626F47]"></i>
            <input type="text" value="Tanggal Lahir Belum Diisi" readonly
                   class="w-full border-none focus:ring-0 text-sm text-[#2E2E2E] bg-transparent" />
          </div>
        </div>
    </div>

        <!-- Kolom Kanan (Gambar + Button) -->
        <div class="flex flex-col items-center gap-4">
          <img src="<?php echo e(asset('assets/logoprofil.png')); ?>" class="w-48 object-contain" />

          <button class="bg-[#A4B465] hover:bg-[#8EA653] text-white font-medium px-8 py-2 rounded-full flex items-center gap-2 transition">
            <i class="fa-solid fa-pen"></i> Edit
          </button>
        </div>

      </div>
    </div>

  </div>
</main>

<script src="<?php echo e(asset('assets_user/js/dashboard.js')); ?>"></script>
</body>
</html><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/user/profil.blade.php ENDPATH**/ ?>