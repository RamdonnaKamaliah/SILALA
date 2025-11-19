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
</head>
<body class="min-h-screen font-[Ubuntu,sans-serif] bg-white flex">

  <!-- Sidebar -->
  <x-sidebarUser></x-sidebarUser>

  <!-- ====== NAVBAR ====== -->
<nav id="navbar" class="fixed top-0 left-0 md:left-[320px] right-0 md:right-3 z-[999]
         bg-[#f7edd6] rounded-b-3xl shadow-sm flex flex-col justify-between
         px-4 md:px-6 pt-5 pb-5 transition-all duration-300 h-[50vh]">

  <!-- ====== Bagian Atas: Judul & Icon ====== -->
  <div class="flex justify-between items-center w-full relative">

    <!-- ===== Judul & Panah ===== -->
    <div class="absolute left-1/2 transform -translate-x-1/2 flex items-center gap-3 md:static md:transform-none">
      <a href="{{ route('user.daftarbuku') }}"
         class="text-[#626F47] hover:text-[#A4B465] transition-colors duration-300">
        <i class="fa-solid fa-arrow-left text-base md:text-lg"></i>
      </a>
      <h1 class="text-lg md:text-xl font-semibold text-[#626F47]">
        {{ $title ?? 'Detail Buku' }}
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

      <!-- Tombol Pengaturan -->
      <button class="text-[#626F47] text-lg">
        <i class="fa-solid fa-gear"></i>
      </button>
    </div>
  </div>

  <!-- ====== Bagian Tengah: Cover & Info Buku (tetap di dalam nav seperti aslinya) ====== -->
  <div class="flex flex-col md:flex-row items-start justify-center 
              gap-6 md:gap-8 w-full max-w-4xl mx-auto relative 
              mt-[80px] md:mt-8 px-4">

    <!-- Cover Buku -->
    <div class="relative w-32 sm:w-36 md:w-52 flex-shrink-0 mx-auto md:mx-0 
                -mt-4 md:mt-0 z-10">
      <img 
        src="{{ asset($buku->foto_buku ?? 'assets/default-cover.jpg') }}" 
        alt="{{ $buku->judul_buku }}"
        class="w-full h-auto rounded-md shadow-xl border-4 border-white object-cover">
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
        <div class="flex justify-center md:justify-start items-center text-[#FACC15] text-sm mb-2">
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-regular fa-star"></i>
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

<!-- ====== KONTEN UTAMA (SCROLLABLE) ======
     NOTE: beri padding-top minimal sedikit lebih besar dari tinggi navbar (50vh)
     supaya konten tidak tertutup navbar -->
<main class="flex-1 ml-0 md:ml-[320px] mr-0 md:mr-3 transition-all duration-300 relative overflow-y-auto pt-[55vh] pb-20">

  <!-- WRAPPER untuk membatasi lebar dan padding -->
  <div class="max-w-4xl mx-auto px-4">

    <!-- ====== FIXED TOMBOL BACA/PINJAM/FAVORIT ====== -->
    <div class="fixed left-0 right-0 md:left-[320px] md:right-3 z-[998] bg-white pointer-events-auto"
         style="top: calc(50vh - 40px); padding-top: 60px;">

      <div class="max-w-full px-4 md:px-6">
        <div class="flex items-center justify-between mb-2 md:px-0">

          <div class="flex items-center gap-3 md:ml-[350px]">
            @if($buku->file_buku && $buku->id)
              <a href="{{ route('user.baca', $buku->id) }}" target="_blank">
                <button class="bg-primary hover:bg-green text-white font-semibold text-sm px-8 py-1.5 rounded-full shadow-md">
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
    <div class="w-full flex justify-center mt-8">
      <div class="bg-[#fff8ed] p-6 rounded-2xl shadow-lg border border-[#f0e6d5] w-[320px] md:w-[420px]">

        <!-- Judul -->
        <p class="text-xl font-bold text-[#3a3a3a] text-center mb-1">
          Beri Rating Buku Ini
        </p>

        <p class="text-sm text-[#6b6b6b] text-center mb-4">
          Seberapa bagus buku ini menurutmu?
        </p>

        <!-- Bintang -->
        <div id="starContainer" class="flex items-center justify-center gap-3 mb-5">
          @for ($i = 1; $i <= 5; $i++)
            <i class="fa-regular fa-star text-4xl text-[#d5ccb8] cursor-pointer transition-all"
               data-star="{{ $i }}"></i>
          @endfor
        </div>

        <!-- Tombol -->
        <div class="flex justify-center">
          <button id="submitRating" class="bg-[#5c7040] hover:bg-[#4d5e34] active:scale-95 
            text-white text-sm font-medium px-7 py-2.5 rounded-xl transition-all shadow hidden">
            Kirim Rating
          </button>
        </div>
      </div>
    </div>

  </div>

</div>

</main>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
  <!-- Script -->
<script src="{{ asset('assets_user/js/dashboard.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  // ====== SweetAlert default supaya selalu muncul di atas ======
  const SwalDefault = Swal.mixin({
    target: document.body,
    zIndex: 999999
  });

  // ====== Element references ======
  const openPinjamModal = document.getElementById("openPinjamModal");
  const pinjamModal = document.getElementById("pinjamModal");
  const closeModalBtn = document.getElementById("closeModalBtn");
  const tglPinjamInput = document.getElementById("tglPinjamInput");
  const tglKembaliInput = document.getElementById("tglKembaliInput");
  const konfirmasiBtn = document.getElementById("konfirmasiPinjam");
  const closeKosong = document.getElementById("closeKosong");
  const popupStokKosong = document.getElementById("popupStokKosong");
  const loveBtn = document.getElementById('loveBtn');
  const heartIcon = document.getElementById('heartIcon');
  const bukuId = "{{ $buku->id }}";
  const starContainer = document.getElementById("starContainer");
  const submitRatingBtn = document.getElementById("submitRating");

  // ====== Utility: format date yyyy-mm-dd ======
  const now = new Date();
  const today = new Date(now.getTime() - now.getTimezoneOffset() * 60000);
  const maxDate = new Date(today);
  maxDate.setDate(today.getDate() + 7);
  const formatDate = d => d.toISOString().split("T")[0];

  // ====== Modal open/close handlers ======
  if (openPinjamModal && pinjamModal) {
    openPinjamModal.addEventListener("click", (e) => {
      e.preventDefault();
      pinjamModal.classList.remove("hidden");
      resetModal();
      // optional: focus first input
      if (tglKembaliInput) tglKembaliInput.focus();
    });
  }

  if (closeModalBtn && pinjamModal) {
    closeModalBtn.addEventListener("click", () => {
      pinjamModal.classList.add("hidden");
    });
  }

  // close stok kosong popup
  if (closeKosong && popupStokKosong) {
    closeKosong.addEventListener("click", () => {
      popupStokKosong.classList.add("hidden");
    });
  }

  // close modal when clicking outside content
  if (pinjamModal) {
    pinjamModal.addEventListener("click", (e) => {
      if (e.target === pinjamModal) {
        pinjamModal.classList.add("hidden");
      }
    });
  }

  // ====== Set tanggal pinjam & min/max tanggal kembali ======
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

  // ====== Konfirmasi peminjaman (AJAX) ======
  if (konfirmasiBtn) {
    konfirmasiBtn.addEventListener("click", async () => {
      const tanggalKembali = tglKembaliInput ? tglKembaliInput.value : '';

      // Validasi: tanggal harus diisi
      if (!tanggalKembali) {
        SwalDefault.fire({
          icon: "warning",
          title: "Peringatan",
          text: "Tanggal kembali belum diisi"
        });
        return;
      }

      // Validasi: tidak boleh < today
      const selectedReturnDate = new Date(tanggalKembali);
      if (selectedReturnDate < today) {
        SwalDefault.fire({
          icon: "warning",
          title: "Peringatan",
          text: "Tanggal kembali tidak boleh kurang dari tanggal pinjam"
        });
        return;
      }

      // Validasi: maksimal 7 hari
      const diffTime = selectedReturnDate - today;
      const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
      if (diffDays > 7) {
        SwalDefault.fire({
          icon: "warning",
          title: "Peringatan",
          text: "Maksimal peminjaman adalah 7 hari"
        });
        return;
      }

      try {
        // Tampilkan loading state
        konfirmasiBtn.disabled = true;
        konfirmasiBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';

        // Kirim request peminjaman
        const response = await fetch("{{ route('pinjam.store') }}", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
          },
          body: JSON.stringify({
            buku_id: "{{ $buku->id }}",
            tanggal_kembali: tanggalKembali
          })
        });

        const responseText = await response.text();

        let result;
        try {
          result = JSON.parse(responseText);
        } catch (parseError) {
          // Jika server tidak mengembalikan JSON valid
          throw new Error("Response tidak valid dari server");
        }

        if (result.success) {
          // Tutup modal sebelum menampilkan alert
          if (pinjamModal) pinjamModal.classList.add("hidden");

          // Tampilkan SweetAlert sukses (menggunakan mixin sehingga pasti di depan)
          await SwalDefault.fire({
            icon: "success",
            title: "Berhasil!",
            text: result.message,
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
          });

          // Redirect setelah timer
          window.location.href = "{{ route('user.riwayatbuku') }}";
        } else {
          // Error dari server (tetap dengan SweetAlert front)
          SwalDefault.fire({
            icon: "error",
            title: "Gagal",
            text: result.message || "Terjadi kesalahan saat meminjam buku"
          });
        }

      } catch (error) {
        console.error("Error peminjaman:", error);
        SwalDefault.fire({
          icon: "error",
          title: "Error",
          text: "Terjadi kesalahan sistem: " + (error.message || "Unknown")
        });
      } finally {
        // Reset tombol
        konfirmasiBtn.disabled = false;
        konfirmasiBtn.innerHTML = '<i class="fa-solid fa-check text-[#2E2E2E]"></i> Konfirmasi';
      }
    });
  }

  // ====== Toggle favorit (love) ======
  if (loveBtn && heartIcon) {
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
        SwalDefault.fire({
          icon: "error",
          title: "Gagal",
          text: "Tidak dapat mengubah favorit sekarang."
        });
      }
    });
  }

  // ====== Rating stars ======
  if (starContainer && submitRatingBtn) {
    const stars = starContainer.querySelectorAll("i");
    submitRatingBtn.classList.remove("hidden");
    let selectedRating = 0;

    stars.forEach(star => {
      star.addEventListener("mouseover", function () {
        const rating = this.dataset.star;
        stars.forEach(s => {
          s.classList.remove("fa-solid", "text-yellow-500");
          s.classList.add("fa-regular", "text-[#d5ccb8]");
        });
        for (let i = 0; i < rating; i++) {
          stars[i].classList.remove("fa-regular", "text-[#d5ccb8]");
          stars[i].classList.add("fa-solid", "text-yellow-500");
        }
      });

      star.addEventListener("click", function () {
        selectedRating = this.dataset.star;
      });
    });

    starContainer.addEventListener("mouseleave", function () {
      stars.forEach(s => {
        s.classList.remove("fa-solid", "text-yellow-500");
        s.classList.add("fa-regular", "text-[#d5ccb8]");
      });
      for (let i = 0; i < selectedRating; i++) {
        stars[i].classList.remove("fa-regular", "text-[#d5ccb8]");
        stars[i].classList.add("fa-solid", "text-yellow-500");
      }
    });
  }

}); // end DOMContentLoaded
</script>

  

</body>
</html>


