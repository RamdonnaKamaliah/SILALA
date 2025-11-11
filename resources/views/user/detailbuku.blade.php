<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @include('layout_dashboard.partial_dashboard.link')
  <title>SILALA | Detail Buku</title>
  <!-- Vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Custom Style -->
  <link rel="stylesheet" href="{{ asset('assets_user/css/dashboard.css') }}">
</head>
<body class="min-h-screen font-[Ubuntu,sans-serif] bg-white flex">

  <!-- Sidebar -->
  <x-sidebarUser></x-sidebarUser>

  <!-- ====== KONTEN UTAMA ====== -->
<div class="flex-1 ml-0 md:ml-[320px] mr-0 md:mr-3 transition-all duration-300 relative overflow-x-hidden">

  <!-- ====== Navbar ====== -->
  <nav id="navbar"
    class="fixed top-0 left-0 md:left-[320px] right-0 md:right-3 z-40 
           bg-[#f7edd6] rounded-b-3xl shadow-sm flex flex-col justify-between
           px-4 md:px-6 pt-5 pb-10 transition-all duration-300 h-[50vh]">

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
                border border-gray-100 z-[9999] opacity-0 pointer-events-none 
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
<!-- ====== Bagian Tengah: Cover & Info Buku ====== -->
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
    
    <!-- Judul (Mobile - dipersingkat) -->
    <h2 class="block md:hidden text-xl sm:text-2xl font-semibold text-[#2E2E2E] leading-snug mb-2">
      {{ $buku->judul_buku }}
    </h2>

    <!-- Judul (Desktop - tetap 3 baris) -->
    <h2 class="hidden md:block text-3xl font-semibold text-[#2E2E2E] leading-snug mb-2">
      {{ $buku->judul_buku }}
    </h2>

    <!-- Penulis + Rating -->
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

    <!-- Status Peminjaman User -->
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

 <!-- ====== Konten Detail Buku ====== -->
<main class="absolute top-[50vh] left-0 right-0 z-50 px-4 md:px-6 pb-8 text-[#2E2E2E] pt-10 overflow-hidden"> 
  <!-- overflow-hidden = biar ga bisa di-scroll -->

  <!-- Tombol Baca, Pinjam, dan Like -->
  <div class="flex items-center justify-between mb-2 px-4 md:px-0 relative">
    
    <!-- Tombol kiri (Baca & Pinjam) -->
<div class="flex items-center gap-3 md:ml-[350px]">
  <button
    class="bg-primary hover:bg-green text-white font-semibold text-sm px-8 py-1.5 
           rounded-full shadow-md transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg">
    Baca
  </button>
  
  <!-- Tombol Pinjam -->
  @php
      $userId = Auth::id();
      $isBorrowingThisBook = \App\Models\DataPeminjam::where('user_id', $userId)
          ->where('buku_id', $buku->id)
          ->where('status', 'dipinjam')
          ->exists();
      
      $activeBorrowCount = \App\Models\DataPeminjam::where('user_id', $userId)
          ->where('status', 'dipinjam')
          ->count();
  @endphp

  @if($isBorrowingThisBook)
    <!-- Tombol disabled jika sedang meminjam buku ini -->
    <button 
      class="bg-gray-400 text-white font-semibold text-sm px-8 py-1.5 
             rounded-full shadow-md cursor-not-allowed opacity-70"
      disabled
      title="Anda sedang meminjam buku ini">
      Sedang Dipinjam
    </button>
  @elseif($activeBorrowCount >= 3)
    <!-- Tombol disabled jika sudah meminjam 3 buku -->
    <button 
      class="bg-gray-400 text-white font-semibold text-sm px-8 py-1.5 
             rounded-full shadow-md cursor-not-allowed opacity-70"
      disabled
      title="Anda sudah meminjam 3 buku. Kembalikan salah satu untuk meminjam lagi.">
      Batas Pinjam
    </button>
  @elseif($buku->stok <= 0)
    <!-- Tombol disabled jika stok habis -->
    <button 
      class="bg-gray-400 text-white font-semibold text-sm px-8 py-1.5 
             rounded-full shadow-md cursor-not-allowed opacity-70"
      disabled
      title="Stok buku habis">
      Stok Habis
    </button>
  @else
    <!-- Tombol aktif jika bisa meminjam -->
    <button 
      id="openModalBtn"
      class="bg-kuning text-[#2E2E2E] hover:bg-[#F6D776] font-semibold text-sm px-8 py-1.5 
             rounded-full shadow-md transition-all duration-300 transform 
             hover:-translate-y-0.5 hover:shadow-lg">
      Pinjam
    </button>
  @endif

<!-- ====== Popup Modal Pinjam Buku ====== -->
<div id="pinjamModal" 
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
  <div class="bg-white w-[90%] sm:w-[400px] rounded-2xl shadow-xl overflow-hidden">

    <!-- Header -->
    <div class="bg-[#4C6444] text-white text-center py-3 font-semibold text-lg">
      Pinjam Buku
    </div>

    <!-- Isi Modal -->
    <div class="p-6 space-y-4 text-sm text-[#2E2E2E]">
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

        <!-- Tanggal -->
      <div class="grid grid-cols-2 gap-4">
        <!-- Tanggal Pinjam -->
        <div>
          <label class="font-semibold mb-1 block">Tanggal Pinjam</label>
          <input type="date" id="tglPinjamInput" readonly
                class="w-full bg-[#F6D776] rounded-full px-3 py-1.5 text-sm text-center shadow-sm focus:outline-none">
        </div>

        <!-- Tanggal Kembali -->
        <div>
          <label for="tglKembaliInput" class="font-semibold mb-1 block">Tanggal Kembali</label>
          <div class="relative">
            <input type="date" id="tglKembaliInput"
                  class="w-full bg-[#F6D776] rounded-full px-3 py-1.5 text-sm text-center shadow-sm focus:outline-none">
          </div>
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
      <div class="flex justify-end gap-3 pt-4">
        <button id="closeModalBtn"
          class="bg-[#DC2626] text-white font-semibold text-sm px-5 py-1.5 rounded-full shadow-md hover:opacity-90 transition">
          Batal
        </button>
        <button id="konfirmasiPinjam"
          class="bg-[#BFEA7C] text-[#2E2E2E] font-semibold text-sm px-5 py-1.5 rounded-full shadow-md hover:opacity-90 transition flex items-center gap-1">
          <i class="fa-solid fa-check text-[#2E2E2E]"></i>
          Konfirmasi
        </button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Popup Stok Kosong -->
<div id="popupStokKosong" class="hidden fixed inset-0 flex items-center justify-center bg-black/50 z-50">
  <div class="bg-white p-6 rounded-2xl shadow-lg text-center w-80">
    <div class="text-5xl mb-3 text-red-500">🚫</div>
    <h2 class="text-lg font-bold text-red-600 mb-2">Stok Kosong</h2>
    <p class="text-sm text-gray-600 mb-4">Buku sedang dipinjam semua, cek kembali nanti.</p>
    <button id="closeKosong" class="bg-red-500 text-white px-4 py-2 rounded-full">Tutup</button>
  </div>
</div>

<!-- Tombol kanan (Love) -->
<button id="loveBtn"
  class="group flex items-center justify-center text-[#E76F51] w-9 h-9 shadow-none bg-transparent 
         transition-all duration-300 transform 
         hover:-translate-y-0.5 hover:scale-110 mr-2 md:mr-[60px]">
  <i id="heartIcon" class="fa-regular fa-heart text-base transition-transform duration-300 group-hover:scale-125"></i>
</button>


    <!-- Garis bawah -->
    <div class="absolute bottom-[-8px] left-[350px] right-[60px] border-t border-gray-300 md:left-[350px] md:right-[60px]"></div>
  </div>

  <!-- Deskripsi dan Detail -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 max-w-4xl mx-auto">

    <!-- Deskripsi -->
    <div>
      <h3 class="text-lg font-semibold mb-3">Deskripsi</h3>
      <p class="text-sm leading-relaxed text-[#626F47]">
        Lorem ipsum is simply dummy text of the printing and typesetting industry. 
        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
      </p>
    </div>

    <!-- Detail Buku -->
    <div class="grid grid-cols-2 gap-y-3 text-sm text-[#626F47]">
      <div><p class="font-semibold text-[#2E2E2E]">Penerbit</p><p>Lorem Ipsum</p></div>
      <div><p class="font-semibold text-[#2E2E2E]">Tahun Terbit</p><p>Lorem Ipsum</p></div>
      <div><p class="font-semibold text-[#2E2E2E]">Bahasa</p><p>Lorem Ipsum</p></div>
      <div><p class="font-semibold text-[#2E2E2E]">Kategori</p><p>Lorem Ipsum</p></div>
      <div><p class="font-semibold text-[#2E2E2E]">Jumlah Halaman</p><p>Lorem Ipsum</p></div>
      <div><p class="font-semibold text-[#2E2E2E]">Edisi</p><p>Lorem Ipsum</p></div>
    </div>
  </div>
</main>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Script -->
  <script src="{{ asset('assets_user/js/dashboard.js')}}"></script>
  <script src="{{ asset('assets_user/js/detailbuku.js')}}"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const tglPinjamInput = document.getElementById("tglPinjamInput");
  const tglKembaliInput = document.getElementById("tglKembaliInput");
  const konfirmasiBtn = document.getElementById("konfirmasiPinjam");

  // Waktu lokal (Asia/Jakarta)
  const now = new Date();
  const today = new Date(now.getTime() - now.getTimezoneOffset() * 60000); 
  const maxDate = new Date(today);
  maxDate.setDate(today.getDate() + 7);

  const formatDate = d => d.toISOString().split("T")[0];

  // Set tanggal pinjam dan batas kembali
  tglPinjamInput.value = formatDate(today);
  tglKembaliInput.min = formatDate(today);
  tglKembaliInput.max = formatDate(maxDate);

  // Saat klik konfirmasi
  konfirmasiBtn.addEventListener("click", async () => {
    const tanggalKembali = tglKembaliInput.value;

    if (!tanggalKembali) {
      Swal.fire({
        icon: "warning",
        title: "Tanggal kembali belum diisi",
        confirmButtonColor: "#A4B465"
      });
      return;
    }

    const selectedDate = new Date(tanggalKembali);
    const daysDifference = Math.ceil((selectedDate - today) / (1000 * 60 * 60 * 24));
    if (daysDifference > 7) {
      Swal.fire({
        icon: "warning",
        title: "Maksimal peminjaman 7 hari",
        confirmButtonColor: "#A4B465"
      });
      return;
    }

    const data = {
      buku_id: "{{ $buku->id }}",
      tanggal_kembali: tanggalKembali,
      _token: "{{ csrf_token() }}"
    };

    try {
      const response = await fetch("{{ route('user.riwayatbuku.store') }}", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
      });

      const result = await response.json();

      if (response.ok && result.success) {
        Swal.fire({
          icon: "success",
          title: result.message,
          showConfirmButton: false,
          timer: 1500
        });
        setTimeout(() => {
          window.location.href = "{{ route('user.riwayatbuku') }}";
        }, 1500);
      } else {
        Swal.fire({
          icon: "error",
          title: result.message || "Gagal menyimpan data",
          confirmButtonColor: "#A4B465"
        });
      }
    } catch (error) {
      Swal.fire({
        icon: "error",
        title: "Terjadi kesalahan sistem",
        confirmButtonColor: "#A4B465"
      });
    }
  });
});

</script>
</body>
</html>