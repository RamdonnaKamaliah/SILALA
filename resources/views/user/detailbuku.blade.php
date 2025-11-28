<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @include('layout_user.partial_user.link')
  <title>SILALA | Detail Buku</title>
  <!-- Vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Custom Style -->
  <link rel="stylesheet" href="{{ asset('assets_user/css/dashboard.css') }}">
  <style>
    #pdfViewer.zoom-small {
        flex-direction: row !important;
        flex-wrap: nowrap;
        align-items: flex-start;
    }
</style>
</head>
<body class="min-h-screen font-[Ubuntu,sans-serif] bg-white flex">

  <!-- Sidebar -->
  <x-sidebarUser></x-sidebarUser>

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
  <button onclick="goBack()"
         class="text-[#626F47] hover:text-[#A4B465] transition-colors duration-300">
    <i class="fa-solid fa-arrow-left text-base md:text-lg"></i>
  </button>
  <h1 class="text-lg md:text-xl font-semibold text-[#626F47]">
    {{ $title ?? 'Detail Buku' }}
  </h1>
</div>

<script>
function goBack() {
  // Cek jika ada referrer (halaman sebelumnya)
  if (document.referrer && document.referrer.includes(window.location.hostname)) {
    window.history.back();
  } else {
    // Default ke daftar buku jika tidak ada history
    window.location.href = "{{ route('user.daftarbuku') }}";
  }
}
</script>

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
              mt-[50px] md:mt-8 px-4">

    <!-- Cover Buku -->
<div class="relative w-32 sm:w-40 md:w-52 flex-shrink-0 mx-auto md:mx-0 
            -mt-4 md:mt-0 z-10">

  <div class="w-full aspect-[3/4] overflow-hidden rounded-md 
              shadow-2xl shadow-gray-500/60">
      <img 
        src="{{ asset($buku->foto_buku ?? 'assets/default-cover.jpg') }}" 
        alt="{{ $buku->judul_buku }}"
        class="w-full h-full object-cover"
      >
  </div>
</div>

    <!-- Info Buku -->
    <div class="flex flex-col justify-start text-center md:text-left w-full md:w-[60%] relative z-10">
      <h2 class="block md:hidden text-xl sm:text-2xl font-semibold text-[#2E2E2E] leading-snug mb-2">
        {{ $buku->judul_buku }}
      </h2>

      <h2 class="hidden md:block text-3xl font-semibold text-[#2E2E2E] leading-snug mb-2">
        {{ $buku->judul_buku }}
      </h2>

      <div class="flex flex-col items-center md:items-start -mt-1">
        <p class="text-sm text-[#626F47] mb-1">{{ $buku->penulis }}</p>
        <!-- Rating Stars berdasarkan rata-rata semua user -->
        <div class="flex justify-center md:justify-start items-center text-[#FACC15] text-sm mb-2">
          @for($i = 1; $i <= 5; $i++)
            @if($i <= floor($averageRating))
              <i class="fa-solid fa-star"></i>
            @elseif($i - 0.5 <= $averageRating)
              <i class="fa-solid fa-star-half-stroke"></i>
            @else
              <i class="fa-regular fa-star"></i>
            @endif
          @endfor
          @if($totalRatings > 0)
            <span class="text-xs text-gray-600 ml-2">({{ number_format($averageRating, 1) }})</span>
          @endif
        </div>
      </div>

      @php
          $userId = Auth::id();
          $userBorrow = \App\Models\DataPeminjam::where('user_id', $userId)
              ->where('buku_id', $buku->id)
              ->where('status', 'dipinjam')
              ->first();
      @endphp

      @if($userBorrow)
      <div class="mt-2">
        <div class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">
          <i class="fa-solid fa-clock"></i>
          Anda sedang meminjam buku ini
        </div>
        <p class="text-xs text-gray-600 mt-1">
    Batas pengembalian: {{ \Carbon\Carbon::parse($userBorrow->tanggal_kembali)->timezone('Asia/Jakarta')->translatedFormat('d F Y') }}
    </p>
      </div>
      @endif

    </div>
  </div>
</nav>

<!-- ====== KONTEN UTAMA (SCROLLABLE) ====== -->
<main class="flex-1 ml-0 md:ml-[320px] mr-0 md:mr-3 transition-all duration-300 relative overflow-y-auto pt-[55vh] pb-20">

  <!-- WRAPPER untuk membatasi lebar dan padding -->
  <div class="max-w-4xl mx-auto px-4">

    <!-- ====== FIXED TOMBOL BACA/PINJAM/FAVORIT ====== -->
    <div class="fixed left-0 right-0 md:left-[320px] md:right-3 z-[30] bg-white pt-3">

      <div class="max-w-full px-4 md:px-6">
        <div class="flex items-center justify-between mb-2 md:px-0">

          <div class="flex items-center gap-3 md:ml-[350px]">
            @if($buku->file_buku && $buku->id)
              <button id="openPdfModal"
        data-url="{{ route('user.baca', $buku->id) }}"
        class="bg-primary hover:bg-green text-white font-semibold text-sm px-8 py-1.5 rounded-full shadow-md">
        Baca
      </button>
              </a>
            @else
            
              <button class="bg-gray-400 text-white font-semibold text-sm px-8 py-1.5 rounded-full shadow-md cursor-not-allowed" disabled>
                Baca
              </button>
            @endif

            @if($userBorrow)
              <button class="bg-gray-400 text-white font-semibold text-sm px-8 py-1.5 rounded-full shadow-md cursor-not-allowed" disabled>
                Sedang Dipinjam
              </button>
            @elseif($stokHabis)
              <button class="bg-gray-400 text-white font-semibold text-sm px-8 py-1.5 rounded-full shadow-md cursor-not-allowed" disabled>
                Sedang Dipinjam
              </button>
            @else
              <button id="openPinjamModal" class="bg-kuning text-[#2E2E2E] hover:bg-[#F6D776] font-semibold text-sm px-8 py-1.5 rounded-full shadow-md transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg">
                Pinjam
              </button>
            @endif
          </div>

          <!-- Tombol Favorit -->
          <div class="flex items-center">
            <button id="loveBtn" class="group flex items-center justify-center text-[#E76F51] w-9 h-9 shadow-none bg-transparent transition-all duration-300 transform hover:-translate-y-0.5 hover:scale-110 mr-2 md:mr-[60px]">
              @if($isFavorited)
                <i id="heartIcon" class="fa-solid fa-heart text-[#E63946] text-base transition-transform duration-300 group-hover:scale-125"></i>
              @else
                <i id="heartIcon" class="fa-regular fa-heart text-base transition-transform duration-300 group-hover:scale-125"></i>
              @endif
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
            <input type="text" value="{{ $buku->judul_buku }}" readonly
                   class="w-full bg-[#F6D776] rounded-full px-3 py-1.5 text-sm text-center shadow-sm focus:outline-none">
          </div>

          <!-- Penulis Buku -->
          <div>
            <label class="font-semibold mb-1 block">Penulis Buku</label>
            <input type="text" value="{{ $buku->penulis }}" readonly
                   class="w-full bg-[#F6D776] rounded-full px-3 py-1.5 text-sm text-center shadow-sm focus:outline-none">
          </div>

          <!-- Stok Buku -->
          <div>
            <label class="font-semibold mb-1 block">Stok Buku</label>
            <input type="text" value="{{ $buku->stok ?? '-' }}" readonly
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
    class="flex-1 overflow-y-auto bg-gray-50 scroll-smooth
           p-2 sm:p-8
           flex flex-col items-center">
</div>
    </div>
</div>

    <!-- KONTEN DESKRIPSI -->
<div class="pt-6">

  <!-- Wrapper biasa, TANPA overflow lagi -->
  <div class="pr-2">

    <!-- Deskripsi dan Detail -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 pt-8">

      <!-- Deskripsi -->
      <div>
        <h3 class="text-lg font-semibold mb-3">Deskripsi</h3>
        <p class="text-sm leading-relaxed text-[#626F47]">
          {{ $buku->deskripsi }}
        </p>
      </div>

      <!-- Detail Buku -->
      <div class="grid grid-cols-2 gap-y-3 text-sm text-[#626F47]">
        <div>
          <p class="font-semibold text-[#2E2E2E]">Penerbit</p>
          <p>{{ $buku->penulis }}</p>
        </div>

        <div>
          <p class="font-semibold text-[#2E2E2E]">Tahun Terbit</p>
          <p>{{ $buku->tahun_terbit }}</p>
        </div>

        <div>
          <p class="font-semibold text-[#2E2E2E]">Bahasa</p>
          <p>{{ $buku->bahasa }}</p>
        </div>

        <div>
          <p class="font-semibold text-[#2E2E2E]">Kategori</p>
          <p>
            @if($buku->kategoris->isNotEmpty())
              {{ $buku->kategoris->pluck('nama_kategori')->join(', ') }}
            @else
              -
            @endif
          </p>
        </div>

        <div>
          <p class="font-semibold text-[#2E2E2E]">Jumlah Halaman</p>
          <p>{{ $buku->jumlah_halaman }}</p>
        </div>

        <div>
          <p class="font-semibold text-[#2E2E2E]">Edisi</p>
          <p>{{ $buku->edisi }}</p>
        </div>
      </div>
    </div>

    <!-- === RATING CARD === -->
@if(($hasRead || $userBorrow) && Schema::hasTable('ratings'))
<div class="w-full flex justify-center mt-8">
  <div class="bg-[#fff8ed] p-6 rounded-2xl shadow-lg border border-[#f0e6d5] w-[320px] md:w-[420px]">

    <!-- Judul -->
    <p class="text-xl font-bold text-[#3a3a3a] text-center mb-1">
      @if($userRating)
        Ubah Rating Buku Ini
      @else
        Beri Rating Buku Ini
      @endif
    </p>

    <p class="text-sm text-[#6b6b6b] text-center mb-4">
      Seberapa bagus buku ini menurutmu?
    </p>

    <!-- Bintang -->
    <div id="starContainer" class="flex items-center justify-center gap-3 mb-5">
      @for ($i = 1; $i <= 5; $i++)
        <i class="fa-regular fa-star text-4xl text-[#d5ccb8] cursor-pointer transition-all rating-star"
           data-star="{{ $i }}"></i>
      @endfor
    </div>

    <!-- Tombol -->
    <div class="flex justify-center">
      <button id="submitRating" class="bg-[#5c7040] hover:bg-[#4d5e34] active:scale-95 
        text-white text-sm font-medium px-7 py-2.5 rounded-xl transition-all shadow 
        opacity-50 cursor-not-allowed" disabled>
        @if($userRating)
          Update Rating
        @else
          Kirim Rating
        @endif
      </button>
    </div>
  </div>
</div>
@endif
  </div>
</div>
</main>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
  <!-- Script -->
<script src="{{ asset('assets_user/js/sidebarnavbar.js') }}"></script>
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
    const bukuId = "{{ $buku->id }}";

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

            const response = await fetch("{{ route('user.rating.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
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

                const response = await fetch("{{ route('pinjam.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        buku_id: "{{ $buku->id }}",
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
                    window.location.href = "{{ route('user.riwayatbuku') }}";
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
    const bukuId = "{{ $buku->id }}";

    if (!loveBtn || !heartIcon) return;

    loveBtn.addEventListener('click', async () => {
        try {
            const res = await fetch("{{ route('user.favorit.toggle') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
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
 /* ============================================================
   PDF VIEWER — FULL REFACTOR (Mobile friendly, Responsive)
   Replace entire previous script with this.
============================================================ */

let pdfDoc = null;
let zoom = 1.0;           // used for desktop zoom only
let totalPages = 0;
let observer = null;
let resizeTimeout = null;

const viewer = document.getElementById("pdfViewer");
const zoomInBtn = document.getElementById("zoomIn");
const zoomOutBtn = document.getElementById("zoomOut");
const zoomLabel = document.getElementById("zoomLabel");
const pageCurrentEl = document.getElementById("pageCurrent");
const pageTotalEl = document.getElementById("pageTotal");
const openBtn = document.getElementById("openPdfModal");
const closeBtn = document.getElementById("closePdfModal");
const modal = document.getElementById("pdfModal");

/* ============================================================
   CLEANUP
============================================================ */
function cleanupViewer() {
    if (observer) {
        observer.disconnect();
        observer = null;
    }
    if (viewer) viewer.innerHTML = "";
    zoom = 1.0;
    pdfDoc = null;
    totalPages = 0;
    pageCurrentEl && (pageCurrentEl.innerText = "0");
    pageTotalEl && (pageTotalEl.innerText = "0");
}

/* ============================================================
   RENDER PAGE
   (renders at scale 1 inside canvas, visual scaling done via CSS transform)
============================================================ */
function renderPage(pageNum) {
    return pdfDoc.getPage(pageNum).then(page => {
        const viewport = page.getViewport({ scale: 1 });

        const canvas = document.createElement("canvas");
        canvas.className = "pdf-page";
        canvas.dataset.pageNumber = pageNum;
        canvas.width = viewport.width;
        canvas.height = viewport.height;
        canvas.style.transformOrigin = "top center";
        canvas.style.display = "block";

        const wrap = document.createElement("div");
        wrap.className = "pdf-page-wrap";
        wrap.dataset.wrapFor = pageNum;
        wrap.style.display = "flex";
        wrap.style.justifyContent = "center";
        wrap.style.alignItems = "flex-start";
        wrap.style.overflow = "hidden";

        wrap.appendChild(canvas);
        viewer.appendChild(wrap);

        const ctx = canvas.getContext("2d");
        return page.render({ canvasContext: ctx, viewport }).promise;
    });
}

/* ============================================================
   RENDER ALL PAGES
============================================================ */
function renderAllPages() {
    viewer.innerHTML = "";
    const jobs = [];
    for (let i = 1; i <= totalPages; i++) jobs.push(renderPage(i));
    Promise.all(jobs).then(() => {
        setupObserver();
        applyZoom(); // layout after pages exist
    });
}

/* ============================================================
   COLUMN LOGIC (desktop)
============================================================ */
function getColumns(z) {
    if (window.innerWidth < 600) return 1; // mobile always single-page
    if (z >= 1) return 1;
    if (z >= 0.7) return 2;
    if (z >= 0.45) return 3;
    return 4;
}

/* ============================================================
   APPLY ZOOM & LAYOUT
   - Mobile: compute fit-to-screen per canvas (scale so page width = container width)
   - Desktop: grid layout and use `zoom` scale
============================================================ */
function applyZoom() {
    const pages = document.querySelectorAll(".pdf-page");
    if (!pages || pages.length === 0) return;

    const isMobile = window.innerWidth < 600;

    if (isMobile) {
        // MOBILE: single column, fit width
        viewer.style.display = "block";
        viewer.style.width = "100%";
        viewer.style.overflowX = "hidden";

        pages.forEach(canvas => {
            const wrap = canvas.parentElement;
            const containerWidth = viewer.clientWidth || window.innerWidth;
            // ensure we leave small padding inside container if needed
            const available = Math.max(1, containerWidth);
            const scale = available / canvas.width;

            canvas.style.transform = `scale(${scale})`;
            canvas.style.transformOrigin = "top center";

            wrap.style.width = available + "px";
            wrap.style.height = (canvas.height * scale) + "px";
            wrap.style.margin = "0 auto 16px auto";
        });

        // show "100%" (fit to screen) for mobile UX clarity
        zoomLabel && (zoomLabel.innerText = "100%");
        return;
    }

    // DESKTOP: grid using zoom
    const cols = getColumns(zoom);

    viewer.style.display = "grid";
    viewer.style.gridTemplateColumns = `repeat(${cols}, auto)`;
    viewer.style.justifyContent = "center";
    viewer.style.alignItems = "start";
    viewer.style.gap = (20 * zoom) + "px";
    viewer.style.overflowX = "hidden";
    viewer.style.width = "100%";

    pages.forEach(canvas => {
        const wrap = canvas.parentElement;
        canvas.style.transform = `scale(${zoom})`;
        canvas.style.transformOrigin = "top center";

        wrap.style.width = (canvas.width * zoom) + "px";
        wrap.style.height = (canvas.height * zoom) + "px";
        wrap.style.margin = "0 auto";
    });

    zoomLabel && (zoomLabel.innerText = Math.round(zoom * 100) + "%");
}

/* ============================================================
   OBSERVER — page indicator
   Uses IntersectionObserver with root = viewer (the scroll container)
============================================================ */
function setupObserver() {
    if (observer) {
        observer.disconnect();
        observer = null;
    }

    const wraps = document.querySelectorAll(".pdf-page-wrap");
    if (!wraps || wraps.length === 0) return;

    // root: the viewer (so entries are relative to the viewer's viewport)
    observer = new IntersectionObserver(entries => {
        let bestPage = 1;
        let bestRatio = 0;
        entries.forEach(e => {
            const p = parseInt(e.target.dataset.wrapFor, 10);
            if (e.intersectionRatio > bestRatio) {
                bestRatio = e.intersectionRatio;
                bestPage = p;
            }
        });
        pageCurrentEl && (pageCurrentEl.innerText = bestPage);
    }, {
        root: viewer,
        threshold: Array.from({ length: 21 }, (_, i) => i * 0.05)
    });

    wraps.forEach(w => observer.observe(w));
}

/* ============================================================
   ZOOM CONTROLS
============================================================ */
function changeZoom(f) {
    // zoom only affects desktop (mobile uses fit-to-screen)
    zoom = Math.max(0.25, Math.min(zoom * f, 3));
    applyZoom();
}

zoomInBtn?.addEventListener("click", () => changeZoom(1.15));
zoomOutBtn?.addEventListener("click", () => changeZoom(1 / 1.15));

// ctrl + wheel = zoom (desktop)
viewer.addEventListener("wheel", e => {
    if (e.ctrlKey) {
        e.preventDefault();
        changeZoom(e.deltaY < 0 ? 1.08 : 1 / 1.08);
    }
}, { passive: false });

/* ============================================================
   OPEN / LOAD PDF (modal) — uses pdfjsLib
============================================================ */
openBtn?.addEventListener("click", function () {
    const url = this.dataset.url;
    if (!url) return alert("URL PDF tidak ditemukan.");

    // show modal
    modal && modal.classList.remove("hidden");

    // load PDF
    pdfjsLib.getDocument(url).promise.then(pdf => {
        cleanupViewer();
        pdfDoc = pdf;
        totalPages = pdf.numPages;
        pageTotalEl && (pageTotalEl.innerText = totalPages);
        renderAllPages();
    }).catch(err => {
        console.error("PDF load error:", err);
        alert("Gagal memuat PDF.");
        modal && modal.classList.add("hidden");
    });
});

/* ============================================================
   CLOSE
============================================================ */
closeBtn?.addEventListener("click", () => {
    cleanupViewer();
    modal && modal.classList.add("hidden");
});

document.addEventListener("keydown", e => {
    if (e.key === "Escape" && modal && !modal.classList.contains("hidden")) {
        closeBtn && closeBtn.click();
    }
});

/* ============================================================
   RESIZE HANDLING — reapply layout on resize (debounced)
============================================================ */
window.addEventListener("resize", () => {
    if (resizeTimeout) clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
        // Recompute layout for mobile/desktop transitions
        applyZoom();

        // Recreate observer root bounding if needed
        if (observer) {
            observer.disconnect();
            setupObserver();
        }
    }, 120);
});

</script>
</body>
</html>


