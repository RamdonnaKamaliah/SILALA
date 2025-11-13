<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php echo $__env->make('layout_dashboard.partial_dashboard.link', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <title>SILALA</title>
  <!-- vite -->
  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
  <!-- style -->
 <link rel="stylesheet" href="<?php echo e(asset('assets_user/css/dashboard.css')); ?>">

</head>
<body class="min-h-screen font-[Ubuntu,sans-serif] bg-white">
  <?php echo $__env->make('layout_dashboard.partial_dashboard.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- Konten Utama Dashboard -->
<main
  class="pt-8 pb-6 px-6 bg-cream
  relative top-[90px] mb-24
  md:ml-[320px] md:mr-3
  md:rounded-3xl transition-all duration-300 z-30
  flex flex-col overflow-y-auto overflow-x-hidden max-w-full shadow-inner">

  <!-- Kartu Sambutan -->
<section class="relative bg-gradient-to-r from-green to-[#A4B465] text-white 
  px-3 py-3 sm:px-4 sm:py-3 md:px-8 md:py-3 rounded-2xl shadow-md 
  flex items-center justify-between overflow-hidden flex-shrink-0">

  <!-- Bintang kiri atas -->
  <img src="<?php echo e(asset('assets/logo_bintang.png')); ?>" alt="star" 
       class="absolute top-1.5 left-3 w-4 sm:w-5 md:w-7 opacity-90 z-20">  

  <!-- Bintang kanan atas -->
  <img src="<?php echo e(asset('assets/logo_bintang.png')); ?>" alt="star" 
       class="absolute top-1.5 right-3 w-4 sm:w-5 md:w-7 opacity-90 z-20"> 

  <!-- Teks sambutan -->
  <div class="z-10 max-w-[70%] sm:max-w-[65%] md:max-w-none">
    <h2 class="text-base sm:text-lg md:text-3xl font-medium text-[#F7EDD6] font-mochiy leading-tight">
      Hallo Rifdah,
    </h2> 
    <p class="text-xs sm:text-sm md:text-base mt-1 text-[#F7EDD6]/90 leading-snug">
      Selamat datang di perpustakaan BPMSPH.<br> 
      Mari jelajahi dunia lewat membaca 
      <img src="<?php echo e(asset('assets/emoji_bumi.png')); ?>" alt="Globe" 
           class="inline w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 align-text-bottom">
    </p> 
  </div>

  <!-- Gambar buku -->
  <div class="z-10 w-20 sm:w-24 md:w-36 lg:w-40 relative flex-shrink-0 ml-2 sm:ml-4"> 
    <img src="<?php echo e(asset('assets/logo_buku.png')); ?>" alt="Welcome" 
         class="w-full drop-shadow-lg"> 
  </div> 

  <!-- Efek lembut -->
  <div class="absolute inset-0 bg-gradient-to-r from-[#A4B465]/20 to-transparent 
              backdrop-blur-[1px] rounded-2xl"></div> 
</section>

<!-- CARD STATISTIK -->
<section class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mt-6 px-2">

  <!-- Sedang Dipinjam -->
  <div class="bg-green px-6 pt-2 pb-4 rounded-2xl shadow-md relative overflow-hidden">
    <span class="iconify absolute left-2 -top-2 opacity-40 text-[70px] text-white"
      data-icon="mdi:book-plus"></span>
    <div class="ml-[78px] mt-[4px] leading-tight">
      <p class="text-sm text-white font-medium">Sedang dipinjam</p>
      <h3 class="text-lg font-mochiy text-white"><?php echo e($dipinjam); ?> Buku</h3>
    </div>
  </div>

  <!-- Denda -->
  <div class="bg-green px-6 pt-2 pb-4 rounded-2xl shadow-md relative overflow-hidden">
    <span class="iconify absolute left-2 -top-2 opacity-40 text-[70px] text-white"
      data-icon="mdi:book-alert"></span>
    <div class="ml-[78px] mt-[4px] leading-tight">
      <p class="text-sm text-white font-medium">Denda</p>
      <h3 class="text-lg font-mochiy text-white"><?php echo e($denda); ?> Buku</h3>
    </div>
  </div>

  <!-- Favorit -->
  <div class="bg-green px-6 pt-2 pb-4 rounded-2xl shadow-md relative overflow-hidden">
    <span class="iconify absolute left-2 -top-2 opacity-40 text-[70px] text-white"
      data-icon="mdi:book-heart"></span>
    <div class="ml-[78px] mt-[4px] leading-tight">
      <p class="text-sm text-white font-medium">Favorit</p>
      <h3 class="text-lg font-mochiy text-white">Buku</h3>
    </div>
  </div>

</section>


<!-- BAGIAN KONTEN YANG SCROLL -->
  <div class="mt-6 overflow-y-auto scrollbar-hide flex-1 pr-2 
    pb-10 md:rounded-b-3xl">
    <!-- Bacaan Anda -->
     <section class="pb-8">
      <h2 class="text-lg md:text-xl font-medium text-black mb-4 ml-2">Rekomendasi</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card Buku 1 -->
        <div class="flex items-start bg-transparent p-3 hover:scale-[1.03] transition-transform duration-300">
          <div class="relative w-32 h-44 flex-shrink-0">
            <div class="absolute inset-0 bg-gradient-to-r from-[#00000020] to-transparent rounded-lg shadow-md"></div>
            <img src="<?php echo e(asset('assets/buku1.jpg')); ?>" alt="Buku 1"
                 class="w-full h-full object-cover rounded-lg shadow-lg border border-[#e6e6e6]">
            <div class="absolute right-0 top-0 w-1 h-full bg-[#d1cfcf] rounded-r-lg"></div>
          </div>
          <div class="ml-4 flex flex-col justify-between h-full">
            <div>
              <h3 class="font-bold text-[#1E1E1E] text-base leading-snug">Statistika Peternakan</h3>
              <p class="text-sm text-gray-600 mb-2">By Indah Hanaco</p>
              <div class="flex text-yellow-400 text-sm space-x-1 mb-2">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star-half-stroke"></i>
                <i class="fa-regular fa-star"></i>
              </div>
            </div>
            <button class="bg-[#626F47] text-white text-xs px-5 py-1.5 rounded-full hover:bg-[#4e5d38] transition w-fit">
              Baca
            </button>
          </div>
        </div>
    <!-- Card Buku 2 -->
    <div class="flex items-start bg-transparent p-3 hover:scale-[1.03] transition-transform duration-300">
      <!-- Cover Buku -->
      <div class="relative w-32 h-44 flex-shrink-0">
        <div class="absolute inset-0 bg-gradient-to-r from-[#00000020] to-transparent rounded-lg shadow-md"></div>
        <img src="<?php echo e(asset('assets/buku2.jpg')); ?>" alt="Buku 2"
             class="w-full h-full object-cover rounded-lg shadow-lg border border-[#e6e6e6]">
        <div class="absolute right-0 top-0 w-1 h-full bg-[#d1cfcf] rounded-r-lg"></div>
      </div>
   <!-- Info Buku -->
      <div class="ml-4 flex flex-col justify-between h-full">
        <div>
          <h3 class="font-bold text-[#1E1E1E] text-base leading-snug">Buku Saku Pelaksanaan KIE</h3>
          <p class="text-sm text-gray-600 mb-2">By J. Anderson</p>

          <!-- Bintang rating -->
          <div class="flex text-yellow-400 text-sm space-x-1 mb-2">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
          </div>
        </div>

        <button class="bg-[#626F47] text-white text-xs px-5 py-1.5 rounded-full hover:bg-[#4e5d38] transition w-fit">
          Baca
        </button>
      </div>
    </div>

<!-- Card Buku 3 -->
    <div class="flex items-start bg-transparent p-3 hover:scale-[1.03] transition-transform duration-300">
      <!-- Cover Buku -->
      <div class="relative w-32 h-44 flex-shrink-0">
        <div class="absolute inset-0 bg-gradient-to-r from-[#00000020] to-transparent rounded-lg shadow-md"></div>
        <img src="<?php echo e(asset('assets/buku3.jpg')); ?>" alt="Buku 3"
             class="w-full h-full object-cover rounded-lg shadow-lg border border-[#e6e6e6]">
        <div class="absolute right-0 top-0 w-1 h-full bg-[#d1cfcf] rounded-r-lg"></div>
      </div>

      <!-- Info Buku -->
      <div class="ml-4 flex flex-col justify-between h-full">
        <div>
          <h3 class="font-bold text-[#1E1E1E] text-base leading-snug">Budi Daya Peternakan</h3>
          <p class="text-sm text-gray-600 mb-2">By J. Anderson</p>

          <!-- Bintang rating -->
          <div class="flex text-yellow-400 text-sm space-x-1 mb-2">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-regular fa-star"></i>
          </div>
 </div>
        <button class="bg-[#626F47] text-white text-xs px-5 py-1.5 rounded-full hover:bg-[#4e5d38] transition w-fit">
          Baca
        </button>
      </div>
    </div>
  </div>
</section>
</main>
<?php echo $__env->make('layout_dashboard.partial_dashboard.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- script -->
<script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
<script src="<?php echo e(asset('assets_user/js/dashboard.js')); ?>"></script>

</body>
</html><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/user/dashboard.blade.php ENDPATH**/ ?>