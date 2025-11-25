<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php echo $__env->make('layout_user.partial_user.link', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <title>SILALA | Detail Buku</title>
  <!-- Vite -->
  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

  <!-- Custom Style -->
  <link rel="stylesheet" href="<?php echo e(asset('assets_user/css/dashboard.css')); ?>">
</head>
<body class="min-h-screen font-[Ubuntu,sans-serif] bg-white flex">

  <!-- Sidebar -->
  <?php if (isset($component)) { $__componentOriginalb763922586e375d9f7490769fccbb786 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb763922586e375d9f7490769fccbb786 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebarUser','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebarUser'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb763922586e375d9f7490769fccbb786)): ?>
<?php $attributes = $__attributesOriginalb763922586e375d9f7490769fccbb786; ?>
<?php unset($__attributesOriginalb763922586e375d9f7490769fccbb786); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb763922586e375d9f7490769fccbb786)): ?>
<?php $component = $__componentOriginalb763922586e375d9f7490769fccbb786; ?>
<?php unset($__componentOriginalb763922586e375d9f7490769fccbb786); ?>
<?php endif; ?>

  <!-- ====== NAVBAR ====== -->
<nav id="navbar"
  class="fixed top-0 left-0 md:left-[320px] right-0 md:right-3 z-40 
  bg-[#f7edd6] rounded-b-3xl shadow-sm
  px-4 md:px-6 py-6 transition-all duration-300
  h-[55vh] flex flex-col justify-start">

  <!-- ====== Bagian Atas: Judul & Icon ====== -->
  <div class="flex justify-between items-center w-full relative">

    <!-- ===== Judul & Panah ===== -->
    <div class="absolute left-1/2 transform -translate-x-1/2 flex items-center gap-3 md:static md:transform-none">
      <a href="<?php echo e(route('user.daftarbuku')); ?>"
         class="text-[#626F47] hover:text-[#A4B465] transition-colors duration-300">
        <i class="fa-solid fa-arrow-left text-base md:text-lg"></i>
      </a>
      <h1 class="text-lg md:text-xl font-semibold text-[#626F47]">
        <?php echo e($title ?? 'Detail Buku'); ?>

      </h1>
    </div>

    <!-- ===== Ikon kanan ===== -->
    <div class="relative flex items-center gap-4 ml-auto">
      <!-- Tombol Notifikasi -->
      <button id="notifBtn" class="text-[#626F47] text-lg focus:outline-none">
        <i class="fa-solid fa-bell"></i>
      </button>

      <!-- Popup Notifikasi -->
      <div id="notifBox"
           class="absolute right-0 top-full mt-3 w-72 sm:w-80 bg-white rounded-2xl shadow-2xl 
                  border border-gray-100 z-[10000] opacity-0 pointer-events-none 
                  transform scale-95 transition-all duration-300 origin-top">
        
        <!-- Header -->
        <div class="flex items-center justify-between px-5 py-3 border-b border-gray-100">
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-bell text-[#A4B465]"></i>
            <h3 class="font-semibold text-gray-700 text-sm">Notifikasi</h3>
          </div>
          <button id="closeNotif" class="text-gray-400 hover:text-gray-600 transition-colors">
            <i class="fa-solid fa-xmark"></i>
          </button>
        </div>

        <!-- Daftar Notifikasi -->
        <div id="notifList" class="max-h-80 overflow-y-auto divide-y divide-gray-100">
          <div class="notif-item relative flex items-start gap-3 px-5 py-3 hover:bg-gray-50 cursor-pointer transition group">
            <div class="notif-line absolute left-0 top-0 bottom-0 w-[3px] bg-[#A4B465] rounded-r-full scale-y-0 group-hover:scale-y-100 transition-transform origin-top"></div>
            <div class="w-2 h-2 mt-1 bg-[#A4B465] rounded-full flex-shrink-0"></div>
            <div class="flex-1">
              <p class="text-sm font-semibold text-[#626F47]">Admin</p>
              <p class="text-xs text-gray-600">Buku <b>Buku Saku</b> berhasil disimpan oleh Wildan.</p>
            </div>
            <span class="text-[10px] text-gray-400 whitespace-nowrap">1m</span>
          </div>

          <div class="notif-item relative flex items-start gap-3 px-5 py-3 hover:bg-gray-50 cursor-pointer transition group">
            <div class="notif-line absolute left-0 top-0 bottom-0 w-[3px] bg-[#A4B465] rounded-r-full scale-y-0 group-hover:scale-y-100 transition-transform origin-top"></div>
            <div class="w-2 h-2 mt-1 bg-[#A4B465] rounded-full flex-shrink-0"></div>
            <div class="flex-1">
              <p class="text-sm font-semibold text-[#626F47]">Sistem</p>
              <p class="text-xs text-gray-600">Perpustakaan diperbarui ke versi terbaru.</p>
            </div>
            <span class="text-[10px] text-gray-400 whitespace-nowrap">10m</span>
          </div>

          <div class="notif-item relative flex items-start gap-3 px-5 py-3 hover:bg-gray-50 cursor-pointer transition group">
            <div class="notif-line absolute left-0 top-0 bottom-0 w-[3px] bg-[#A4B465] rounded-r-full scale-y-0 group-hover:scale-y-100 transition-transform origin-top"></div>
            <div class="w-2 h-2 mt-1 bg-[#A4B465] rounded-full flex-shrink-0"></div>
            <div class="flex-1">
              <p class="text-sm font-semibold text-[#626F47]">Admin</p>
              <p class="text-xs text-gray-600">Notifikasi tambahan untuk testing scroll.</p>
            </div>
            <span class="text-[10px] text-gray-400 whitespace-nowrap">15m</span>
          </div>
        </div>

        <!-- Footer -->
        <div class="text-center py-3 border-t border-gray-100">
          <a href="#" class="text-[#626F47] text-sm font-medium hover:text-[#A4B465]">
            Lihat semua aktivitas
          </a>
        </div>
      </div>

      <!-- darkmode -->
    <button onclick="toggleDarkMode()" class="text-[#626F47] text-lg flex items-center gap-2">
    <span class="iconify text-2xl dark:hidden" data-icon="mdi:weather-sunny"></span>
    <span class="iconify text-2xl hidden dark:inline" data-icon="mdi:weather-night"></span>
  </button>
  </div>
</div>

  <!-- ====== Bagian Tengah: Cover & Info Buku (tetap di dalam nav seperti aslinya) ====== -->
  <div class="flex flex-col md:flex-row items-start justify-center 
              gap-6 md:gap-8 w-full max-w-4xl mx-auto relative 
              mt-[80px] md:mt-8 px-4">

    <!-- Cover Buku -->
<div class="relative w-36 sm:w-44 md:w-56 flex-shrink-0 mx-auto md:mx-0 
            -mt-4 md:mt-0 z-10">

  <div class="w-full aspect-[3/4] overflow-hidden rounded-md 
              shadow-2xl shadow-gray-500/60">
      <img 
        src="<?php echo e(asset($buku->foto_buku ?? 'assets/default-cover.jpg')); ?>" 
        alt="<?php echo e($buku->judul_buku); ?>"
        class="w-full h-full object-cover"
      >
  </div>
</div>




    <!-- Info Buku -->
    <div class="flex flex-col justify-start text-center md:text-left w-full md:w-[60%] relative z-10">
      <h2 class="block md:hidden text-xl sm:text-2xl font-semibold text-[#2E2E2E] leading-snug mb-2">
        <?php echo e($buku->judul_buku); ?>

      </h2>

      <h2 class="hidden md:block text-3xl font-semibold text-[#2E2E2E] leading-snug mb-2">
        <?php echo e($buku->judul_buku); ?>

      </h2>

      <div class="flex flex-col items-center md:items-start -mt-1">
        <p class="text-sm text-[#626F47] mb-1"><?php echo e($buku->penulis); ?></p>
        <!-- Rating Stars berdasarkan rata-rata semua user -->
        <div class="flex justify-center md:justify-start items-center text-[#FACC15] text-sm mb-2">
          <?php for($i = 1; $i <= 5; $i++): ?>
            <?php if($i <= floor($averageRating)): ?>
              <i class="fa-solid fa-star"></i>
            <?php elseif($i - 0.5 <= $averageRating): ?>
              <i class="fa-solid fa-star-half-stroke"></i>
            <?php else: ?>
              <i class="fa-regular fa-star"></i>
            <?php endif; ?>
          <?php endfor; ?>
          <?php if($totalRatings > 0): ?>
            <span class="text-xs text-gray-600 ml-2">(<?php echo e(number_format($averageRating, 1)); ?>)</span>
          <?php endif; ?>
        </div>
      </div>

      <?php
          $userId = Auth::id();
          $userBorrow = \App\Models\DataPeminjam::where('user_id', $userId)
              ->where('buku_id', $buku->id)
              ->where('status', 'dipinjam')
              ->first();
      ?>

      <?php if($userBorrow): ?>
      <div class="mt-2">
        <div class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">
          <i class="fa-solid fa-clock"></i>
          Anda sedang meminjam buku ini
        </div>
        <p class="text-xs text-gray-600 mt-1">
    Batas pengembalian: <?php echo e(\Carbon\Carbon::parse($userBorrow->tanggal_kembali)->timezone('Asia/Jakarta')->translatedFormat('d F Y')); ?>

    </p>
      </div>
      <?php endif; ?>

    </div>
  </div>
</nav>

<!-- ====== KONTEN UTAMA (SCROLLABLE) ====== -->
<main class="flex-1 ml-0 md:ml-[320px] mr-0 md:mr-3 transition-all duration-300 relative overflow-y-auto pt-[55vh] pb-20">

  <!-- WRAPPER untuk membatasi lebar dan padding -->
  <div class="max-w-4xl mx-auto px-4">

    <!-- ====== FIXED TOMBOL BACA/PINJAM/FAVORIT ====== -->
    <div class="fixed left-0 right-0 md:left-[320px] md:right-3 z-[20] bg-white pt-3">


      <div class="max-w-full px-4 md:px-6">
        <div class="flex items-center justify-between mb-2 md:px-0">

          <div class="flex items-center gap-3 md:ml-[350px]">
            <?php if($buku->file_buku && $buku->id): ?>
              <button id="openPdfModal"
        data-url="<?php echo e(route('user.baca', $buku->id)); ?>"
        class="bg-primary hover:bg-green text-white font-semibold text-sm px-8 py-1.5 rounded-full shadow-md">
        Baca
      </button>
              </a>
            <?php else: ?>
              <button class="bg-gray-400 text-white font-semibold text-sm px-8 py-1.5 rounded-full shadow-md cursor-not-allowed" disabled>
                Baca
              </button>
            <?php endif; ?>

            <?php if($userBorrow): ?>
              <button class="bg-gray-400 text-white font-semibold text-sm px-8 py-1.5 rounded-full shadow-md cursor-not-allowed" disabled>
                Sedang Dipinjam
              </button>
            <?php elseif($stokHabis): ?>
              <button class="bg-gray-400 text-white font-semibold text-sm px-8 py-1.5 rounded-full shadow-md cursor-not-allowed" disabled>
                Sedang Dipinjam
              </button>
            <?php else: ?>
              <button id="openPinjamModal" class="bg-kuning text-[#2E2E2E] hover:bg-[#F6D776] font-semibold text-sm px-8 py-1.5 rounded-full shadow-md transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg">
                Pinjam
              </button>
            <?php endif; ?>
          </div>

          <!-- Tombol Favorit -->
          <div class="flex items-center">
            <button id="loveBtn" class="group flex items-center justify-center text-[#E76F51] w-9 h-9 shadow-none bg-transparent transition-all duration-300 transform hover:-translate-y-0.5 hover:scale-110 mr-2 md:mr-[60px]">
              <?php if($isFavorited): ?>
                <i id="heartIcon" class="fa-solid fa-heart text-[#E63946] text-base transition-transform duration-300 group-hover:scale-125"></i>
              <?php else: ?>
                <i id="heartIcon" class="fa-regular fa-heart text-base transition-transform duration-300 group-hover:scale-125"></i>
              <?php endif; ?>
            </button>
          </div>

        </div>

        <!-- Garis bawah tetap di bawah tombol -->
        <div class="w-full">
          <div class="mx-auto md:ml-[350px] md:mr-[60px] border-t border-gray-300"></div>
        </div>
      </div>
    </div>

    <!-- ====== MODAL PINJAM (DILUAR NAV & MAIN) ====== -->
    <div id="pinjamModal" class="hidden fixed inset-0 z-[1050] flex items-center justify-center bg-black/40 p-4">
      <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden relative">
        <!-- Header -->
        <div class="bg-[#4C6444] text-white text-center py-3 font-semibold text-lg">
          Pinjam Buku
        </div>

        <!-- Isi Modal -->
        <div class="p-6 space-y-4 text-sm text-[#2E2E2E] max-h-[80vh] overflow-y-auto">

          <!-- Judul Buku -->
          <div>
            <label class="font-semibold mb-1 block">Judul Buku</label>
            <input type="text" value="<?php echo e($buku->judul_buku); ?>" readonly
                   class="w-full bg-[#F6D776] rounded-full px-3 py-1.5 text-sm text-center shadow-sm focus:outline-none">
          </div>

          <!-- Penulis Buku -->
          <div>
            <label class="font-semibold mb-1 block">Penulis Buku</label>
            <input type="text" value="<?php echo e($buku->penulis); ?>" readonly
                   class="w-full bg-[#F6D776] rounded-full px-3 py-1.5 text-sm text-center shadow-sm focus:outline-none">
          </div>

          <!-- Stok Buku -->
          <div>
            <label class="font-semibold mb-1 block">Stok Buku</label>
            <input type="text" value="<?php echo e($buku->stok ?? '-'); ?>" readonly
                   class="w-full bg-[#F6D776] rounded-full px-3 py-1.5 text-sm text-center shadow-sm focus:outline-none">
          </div>

          <!-- Tanggal Pinjam & Kembali -->
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="font-semibold mb-1 block">Tanggal Pinjam</label>
              <input type="date" id="tglPinjamInput" readonly
                     class="w-full bg-[#F6D776] rounded-full px-3 py-1.5 text-sm text-center shadow-sm focus:outline-none">
            </div>

            <div>
              <label for="tglKembaliInput" class="font-semibold mb-1 block">Tanggal Kembali</label>
              <input type="date" id="tglKembaliInput"
                     class="w-full bg-[#F6D776] rounded-full px-3 py-1.5 text-sm text-center shadow-sm focus:outline-none">
            </div>
          </div>

          <!-- Peringatan -->
          <div class="text-[13px] space-y-1">
            <p class="text-[#DC2626] flex items-center gap-1">
              <i class="fa-solid fa-triangle-exclamation"></i>
              Maksimal peminjaman <span class="font-semibold">7 hari</span>.
            </p>
            <p class="text-[#DC2626] flex items-center gap-1">
              <i class="fa-solid fa-triangle-exclamation"></i>
              Denda <span class="font-semibold text-[#DC2626]">Rp 1.000/hari</span> jika terlambat.
            </p>
            <p class="text-[#DC2626] flex items-center gap-1">
              <i class="fa-solid fa-triangle-exclamation"></i>
              Maksimal <span class="font-semibold">3 buku</span> yang bisa dipinjam.
            </p>
          </div>

          <!-- Tombol Aksi -->
          <div class="flex justify-end gap-3 pt-4 sticky bottom-0 bg-white">
            <button id="closeModalBtn" class="bg-[#DC2626] text-white font-semibold text-sm px-5 py-1.5 rounded-full shadow-md hover:opacity-90 transition">
              Batal
            </button>
            <button id="konfirmasiPinjam" class="bg-[#BFEA7C] text-[#2E2E2E] font-semibold text-sm px-5 py-1.5 rounded-full shadow-md hover:opacity-90 transition flex items-center gap-1">
              <i class="fa-solid fa-check text-[#2E2E2E]"></i>
              Konfirmasi
            </button>
          </div>

        </div>
      </div>
    </div>
    
    <!-- MODAL PDF -->
<div id="pdfModal"
    class="fixed inset-0 bg-black/50 backdrop-blur-md z-[99999] hidden
           flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-6xl h-[93vh]
                rounded-[32px] shadow-2xl overflow-hidden
                border border-gray-300 flex flex-col

                sm:rounded-[32px] rounded-2xl
                sm:p-0 p-2
                ">

        <!-- HEADER -->
        <div class="w-full bg-gradient-to-r from-gray-50 to-gray-200
                    px-6 py-4 border-b flex justify-between items-center shadow-sm">

            <h2 class="text-xl font-bold text-gray-700 flex items-center gap-3">
                <span class="iconify" data-icon="mdi:file-document-outline" data-width="26"></span>
                Preview Dokumen
            </h2>

            <button id="closePdfModal"
                class="p-2 text-[22px] text-gray-600 hover:text-red-600 transition">
                <span class="iconify" data-icon="mdi:close" data-width="22"></span>
            </button>
        </div>

        <!-- TOOLBAR -->
        <div class="w-full bg-white border-b px-6 py-3 flex items-center gap-6 shadow-sm">

            <div class="flex items-center gap-3">

                <button id="zoomOut"
                    class="w-10 h-10 flex items-center justify-center rounded-xl
                           bg-gray-200 hover:bg-gray-300 transition shadow-sm text-gray-700">
                    <span class="iconify" data-icon="mdi:magnify-minus-outline" data-width="22"></span>
                </button>

                <button id="zoomIn"
                    class="w-10 h-10 flex items-center justify-center rounded-xl
                           bg-gray-200 hover:bg-gray-300 transition shadow-sm text-gray-700">
                    <span class="iconify" data-icon="mdi:magnify-plus-outline" data-width="22"></span>
                </button>

                <span id="zoomLabel" class="font-semibold text-gray-700 text-sm ml-2">100%</span>
            </div>

            <span class="ml-auto text-sm text-gray-700 bg-gray-100 px-3 py-1.5 rounded-lg shadow-inner">
                Halaman: <span id="pageCurrent" class="font-bold">1</span> /
                <span id="pageTotal" class="font-bold">0</span>
            </span>
        </div>

        <!-- VIEWER -->
        <div id="pdfViewer"
    class="flex-1 overflow-y-auto overflow-x-auto bg-gray-50 scroll-smooth
           p-2 sm:p-8
           flex sm:justify-center">
</div>
    </div>
</div>

    <!--      KONTEN DESKRIPSI     -->
<div class="pt-6">

  <!-- Wrapper biasa, TANPA overflow lagi -->
  <div class="pr-2">

    <!-- Deskripsi dan Detail -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 pt-8">

      <!-- Deskripsi -->
      <div>
        <h3 class="text-lg font-semibold mb-3">Deskripsi</h3>
        <p class="text-sm leading-relaxed text-[#626F47]">
          <?php echo e($buku->deskripsi); ?>

        </p>
      </div>

      <!-- Detail Buku -->
      <div class="grid grid-cols-2 gap-y-3 text-sm text-[#626F47]">
        <div>
          <p class="font-semibold text-[#2E2E2E]">Penerbit</p>
          <p><?php echo e($buku->penulis); ?></p>
        </div>

        <div>
          <p class="font-semibold text-[#2E2E2E]">Tahun Terbit</p>
          <p><?php echo e($buku->tahun_terbit); ?></p>
        </div>

        <div>
          <p class="font-semibold text-[#2E2E2E]">Bahasa</p>
          <p><?php echo e($buku->bahasa); ?></p>
        </div>

        <div>
          <p class="font-semibold text-[#2E2E2E]">Kategori</p>
          <p>
            <?php if($buku->kategoris->isNotEmpty()): ?>
              <?php echo e($buku->kategoris->pluck('nama_kategori')->join(', ')); ?>

            <?php else: ?>
              -
            <?php endif; ?>
          </p>
        </div>

        <div>
          <p class="font-semibold text-[#2E2E2E]">Jumlah Halaman</p>
          <p><?php echo e($buku->jumlah_halaman); ?></p>
        </div>

        <div>
          <p class="font-semibold text-[#2E2E2E]">Edisi</p>
          <p><?php echo e($buku->edisi); ?></p>
        </div>
      </div>
    </div>

    <!-- === RATING CARD === -->
<?php if(($hasRead || $userBorrow) && Schema::hasTable('ratings')): ?>
<div class="w-full flex justify-center mt-8">
  <div class="bg-[#fff8ed] p-6 rounded-2xl shadow-lg border border-[#f0e6d5] w-[320px] md:w-[420px]">

    <!-- Judul -->
    <p class="text-xl font-bold text-[#3a3a3a] text-center mb-1">
      <?php if($userRating): ?>
        Ubah Rating Buku Ini
      <?php else: ?>
        Beri Rating Buku Ini
      <?php endif; ?>
    </p>

    <p class="text-sm text-[#6b6b6b] text-center mb-4">
      Seberapa bagus buku ini menurutmu?
    </p>

    <!-- Bintang -->
    <div id="starContainer" class="flex items-center justify-center gap-3 mb-5">
      <?php for($i = 1; $i <= 5; $i++): ?>
        <i class="fa-regular fa-star text-4xl text-[#d5ccb8] cursor-pointer transition-all rating-star"
           data-star="<?php echo e($i); ?>"></i>
      <?php endfor; ?>
    </div>

    <!-- Tombol -->
    <div class="flex justify-center">
      <button id="submitRating" class="bg-[#5c7040] hover:bg-[#4d5e34] active:scale-95 
        text-white text-sm font-medium px-7 py-2.5 rounded-xl transition-all shadow 
        opacity-50 cursor-not-allowed" disabled>
        <?php if($userRating): ?>
          Update Rating
        <?php else: ?>
          Kirim Rating
        <?php endif; ?>
      </button>
    </div>
  </div>
</div>
<?php endif; ?>
  </div>

</div>

</main>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
  <!-- Script -->
<script src="<?php echo e(asset('assets_user/js/dashboard.js')); ?>"></script>
<!-- Script Rating System -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    // ====== RATING SYSTEM ======
    const starContainer = document.getElementById("starContainer");
    const submitRatingBtn = document.getElementById("submitRating");
    
    // Jika elemen rating tidak ada, keluar
    if (!starContainer || !submitRatingBtn) return;

    const stars = starContainer.querySelectorAll(".rating-star");
    let selectedRating = 0;
    const bukuId = "<?php echo e($buku->id); ?>";

    console.log('Rating system initialized'); // Debug

    // Fungsi untuk update tampilan bintang
    function updateStars(rating, permanent = false) {
        stars.forEach((star, index) => {
            const starNumber = index + 1;
            if (starNumber <= rating) {
                star.classList.remove('fa-regular', 'text-[#d5ccb8]');
                star.classList.add('fa-solid', 'text-yellow-500');
            } else {
                star.classList.remove('fa-solid', 'text-yellow-500');
                star.classList.add('fa-regular', 'text-[#d5ccb8]');
            }
        });
        
        if (permanent) {
            selectedRating = rating;
        }
    }

    // Event hover untuk bintang
    stars.forEach(star => {
        star.addEventListener("mouseover", function() {
            const rating = parseInt(this.dataset.star);
            updateStars(rating, false);
        });

        star.addEventListener("click", function() {
            selectedRating = parseInt(this.dataset.star);
            updateStars(selectedRating, true);
            
            // Aktifkan tombol submit
            submitRatingBtn.disabled = false;
            submitRatingBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            submitRatingBtn.classList.add('hover:bg-[#4d5e34]', 'active:scale-95');
            
            console.log('Rating selected:', selectedRating); // Debug
        });
    });

    // Reset bintang saat mouse leave
    starContainer.addEventListener("mouseleave", function() {
        updateStars(selectedRating, true);
    });

    // Submit rating
    submitRatingBtn.addEventListener("click", async function() {
        if (selectedRating === 0) {
            Swal.fire({
                icon: "warning",
                title: "Peringatan",
                text: "Pilih rating terlebih dahulu!"
            });
            return;
        }

        try {
            // Tampilkan loading
            submitRatingBtn.disabled = true;
            submitRatingBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim...';

            const response = await fetch("<?php echo e(route('user.rating.store')); ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    buku_id: bukuId,
                    rating: selectedRating
                })
            });

            const result = await response.json();

            if (result.success) {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: result.message,
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: result.message
                });
                
                // Reset tombol
                submitRatingBtn.disabled = false;
                submitRatingBtn.innerHTML = 'Kirim Rating';
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Terjadi kesalahan sistem"
            });
            
            // Reset tombol
            submitRatingBtn.disabled = false;
            submitRatingBtn.innerHTML = 'Kirim Rating';
        }
    });
});
</script>
<!-- Script Peminjaman Buku -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    // ====== PEMINJAMAN BUKU ======
    const openPinjamModal = document.getElementById("openPinjamModal");
    const pinjamModal = document.getElementById("pinjamModal");
    const closeModalBtn = document.getElementById("closeModalBtn");
    const tglPinjamInput = document.getElementById("tglPinjamInput");
    const tglKembaliInput = document.getElementById("tglKembaliInput");
    const konfirmasiBtn = document.getElementById("konfirmasiPinjam");

    if (!openPinjamModal || !pinjamModal) return;

    // Utility: format date yyyy-mm-dd
    const now = new Date();
    const today = new Date(now.getTime() - now.getTimezoneOffset() * 60000);
    const maxDate = new Date(today);
    maxDate.setDate(today.getDate() + 7);
    const formatDate = d => d.toISOString().split("T")[0];

    // Set tanggal pinjam & min/max tanggal kembali
    if (tglPinjamInput) {
        tglPinjamInput.value = formatDate(today);
    }
    if (tglKembaliInput) {
        tglKembaliInput.min = formatDate(today);
        tglKembaliInput.max = formatDate(maxDate);
        tglKembaliInput.value = '';
    }

    function resetModal() {
        if (tglKembaliInput) tglKembaliInput.value = '';
    }

    // Modal open/close handlers
    openPinjamModal.addEventListener("click", (e) => {
        e.preventDefault();
        pinjamModal.classList.remove("hidden");
        resetModal();
        if (tglKembaliInput) tglKembaliInput.focus();
    });

    if (closeModalBtn) {
        closeModalBtn.addEventListener("click", () => {
            pinjamModal.classList.add("hidden");
        });
    }

    // Close modal when clicking outside content
    pinjamModal.addEventListener("click", (e) => {
        if (e.target === pinjamModal) {
            pinjamModal.classList.add("hidden");
        }
    });

    // Konfirmasi peminjaman
    if (konfirmasiBtn) {
        konfirmasiBtn.addEventListener("click", async () => {
            const tanggalKembali = tglKembaliInput ? tglKembaliInput.value : '';

            if (!tanggalKembali) {
                Swal.fire({
                    icon: "warning",
                    title: "Peringatan",
                    text: "Tanggal kembali belum diisi"
                });
                return;
            }

            const selectedReturnDate = new Date(tanggalKembali);
            if (selectedReturnDate < today) {
                Swal.fire({
                    icon: "warning",
                    title: "Peringatan",
                    text: "Tanggal kembali tidak boleh kurang dari tanggal pinjam"
                });
                return;
            }

            const diffTime = selectedReturnDate - today;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            if (diffDays > 7) {
                Swal.fire({
                    icon: "warning",
                    title: "Peringatan",
                    text: "Maksimal peminjaman adalah 7 hari"
                });
                return;
            }

            try {
                konfirmasiBtn.disabled = true;
                konfirmasiBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';

                const response = await fetch("<?php echo e(route('pinjam.store')); ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        buku_id: "<?php echo e($buku->id); ?>",
                        tanggal_kembali: tanggalKembali
                    })
                });

                const result = await response.json();

                if (result.success) {
                    pinjamModal.classList.add("hidden");
                    await Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: result.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    window.location.href = "<?php echo e(route('user.riwayatbuku')); ?>";
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: result.message || "Terjadi kesalahan saat meminjam buku"
                    });
                }
            } catch (error) {
                console.error("Error peminjaman:", error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Terjadi kesalahan sistem"
                });
            } finally {
                konfirmasiBtn.disabled = false;
                konfirmasiBtn.innerHTML = '<i class="fa-solid fa-check text-[#2E2E2E]"></i> Konfirmasi';
            }
        });
    }
});
</script>
<!-- Script Favorit -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    // ====== FAVORIT SYSTEM ======
    const loveBtn = document.getElementById('loveBtn');
    const heartIcon = document.getElementById('heartIcon');
    const bukuId = "<?php echo e($buku->id); ?>";

    if (!loveBtn || !heartIcon) return;

    loveBtn.addEventListener('click', async () => {
        try {
            const res = await fetch("<?php echo e(route('user.favorit.toggle')); ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                },
                body: JSON.stringify({ buku_id: bukuId })
            });

            const data = await res.json();

            if (data.favorited) {
                heartIcon.classList.remove('fa-regular');
                heartIcon.classList.add('fa-solid', 'text-[#E63946]');
            } else {
                heartIcon.classList.remove('fa-solid', 'text-[#E63946]');
                heartIcon.classList.add('fa-regular');
            }
        } catch (err) {
            console.error(err);
            Swal.fire({
                icon: "error",
                title: "Gagal",
                text: "Tidak dapat mengubah favorit sekarang."
            });
        }
    });
});
</script>
<!-- Script PDF Viewer -->
<script>
// ====== PDF VIEWER ======
let pdfDoc = null;
let zoom = 1.0;
let totalPages = 0;

const viewer = document.getElementById("pdfViewer");
const zoomInBtn = document.getElementById("zoomIn");
const zoomOutBtn = document.getElementById("zoomOut");
const zoomLabel = document.getElementById("zoomLabel");
const pageCurrentEl = document.getElementById("pageCurrent");
const pageTotalEl = document.getElementById("pageTotal");
const openBtn = document.getElementById("openPdfModal");
const closeBtn = document.getElementById("closePdfModal");
const modal = document.getElementById("pdfModal");

// Debounce function
function debounce(fn, wait = 120) {
    let t;
    return (...args) => {
        clearTimeout(t);
        t = setTimeout(() => fn(...args), wait);
    };
}

// Render satu halaman PDF
function renderPage(pageNum) {
    return pdfDoc.getPage(pageNum).then(page => {
        const viewport = page.getViewport({ scale: zoom });
        const canvas = document.createElement("canvas");
        const ctx = canvas.getContext("2d");

        canvas.width = viewport.width;
        canvas.height = viewport.height;

        canvas.style.marginBottom = "20px";
        canvas.style.border = "1px solid #ddd";
        canvas.style.borderRadius = "10px";
        canvas.style.background = "white";
        canvas.style.boxShadow = "0 2px 8px rgba(0,0,0,0.1)";
        canvas.style.display = "block";
        canvas.style.marginLeft = "auto";
        canvas.style.marginRight = "auto";

        const wrap = document.createElement("div");
        wrap.appendChild(canvas);
        viewer.appendChild(wrap);

        return page.render({
            canvasContext: ctx,
            viewport: viewport
        }).promise.then(() => canvas);
    });
}

// Render semua halaman PDF
function renderAllPages() {
    if (!pdfDoc) return Promise.resolve();
    viewer.innerHTML = "";
    pageCurrentEl.innerText = "1";

    const renderPromises = [];
    for (let i = 1; i <= totalPages; i++) {
        renderPromises.push(renderPage(i));
    }

    return Promise.all(renderPromises).then(() => {
        zoomLabel.innerText = Math.round(zoom * 100) + "%";
        pageTotalEl.innerText = totalPages;
    });
}

// Event listeners untuk PDF
if (openBtn) {
    openBtn.addEventListener("click", function () {
        const url = this.getAttribute("data-url");
        modal.classList.remove("hidden");
        viewer.innerHTML = "<p class='text-center mt-5 text-gray-500'>Memuat PDF...</p>";

        pdfjsLib.getDocument(url).promise.then(pdf => {
            pdfDoc = pdf;
            totalPages = pdf.numPages;
            pageTotalEl.innerText = totalPages;
            zoom = 1.0;
            zoomLabel.innerText = "100%";
            renderAllPages();
        }).catch(err => {
            viewer.innerHTML = `<p class="text-center text-red-500 mt-6">Gagal memuat PDF: ${err.message}</p>`;
        });
    });
}

if (closeBtn) {
    closeBtn.addEventListener("click", () => {
        modal.classList.add("hidden");
        viewer.innerHTML = "";
        pageCurrentEl.innerText = "1";
        pdfDoc = null;
        totalPages = 0;
    });
}

if (zoomInBtn) {
    zoomInBtn.addEventListener("click", () => {
        if (zoom < 3.0) {
            zoom = +(zoom + 0.2).toFixed(2);
            renderAllPages();
        }
    });
}

if (zoomOutBtn) {
    zoomOutBtn.addEventListener("click", () => {
        if (zoom > 0.4) {
            zoom = +(zoom - 0.2).toFixed(2);
            renderAllPages();
        }
    });
}

// ESC to close PDF modal
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && modal && !modal.classList.contains("hidden")) {
        closeBtn.click();
    }
});
</script>
  

</body>
</html>


<?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/user/detailbuku.blade.php ENDPATH**/ ?>