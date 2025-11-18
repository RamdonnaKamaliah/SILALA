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

  <!-- ====== Navbar ====== -->
  <nav id="navbar"
  class="fixed top-0 left-0 md:left-[320px] right-0 md:right-3 z-[999]
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

  <!-- ====== KONTEN UTAMA ====== -->
<div class="flex-1 ml-0 md:ml-[320px] mr-0 md:mr-3 transition-all duration-300 relative overflow-x-hidden">
<main class="relative mt-[50vh] px-4 md:px-6 pb-8 text-[#2E2E2E] pt-10 z-10">

<!-- ====== FIXED TOMBOL (gantikan blok tombol lama dengan ini) ====== -->
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
          <p class="text-xs text-gray-600 mt-2">
            Batas pengembalian:
            {{ \Carbon\Carbon::parse($userBorrow->tanggal_kembali)->timezone('Asia/Jakarta')->translatedFormat('d F Y') }}
          </p>
        @elseif($stokHabis)
          <button class="bg-gray-400 text-white font-semibold text-sm px-8 py-1.5 rounded-full shadow-md cursor-not-allowed" disabled>
            Stok Habis
          </button>
        @else
          <button id="openPinjamModal" class="bg-kuning text-[#2E2E2E] hover:bg-[#F6D776] font-semibold text-sm px-8 py-1.5 rounded-full shadow-md transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg">
            Pinjam
          </button>
        @endif
      </div>

      <button id="loveBtn" class="group flex items-center justify-center text-[#E76F51] w-9 h-9 shadow-none bg-transparent transition-all duration-300 transform hover:-translate-y-0.5 hover:scale-110 mr-2 md:mr-[60px]">
        @if($isFavorited)
          <i id="heartIcon" class="fa-solid fa-heart text-[#E63946] text-base transition-transform duration-300 group-hover:scale-125"></i>
        @else
          <i id="heartIcon" class="fa-regular fa-heart text-base transition-transform duration-300 group-hover:scale-125"></i>
        @endif
      </button>

    </div>

    <!-- Garis bawah (tetap di bawah tombol) -->
    <div class="w-full">
      <div class="mx-auto md:ml-[350px] md:mr-[60px] border-t border-gray-300" style="margin-top:-8px;"></div>
    </div>
  </div>
</div>

  <!-- WRAPPER SCROLL -->
  <div class="max-h-[65vh] overflow-y-auto pr-2">

  <!-- Deskripsi dan Detail -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 max-w-4xl mx-auto">

    <!-- Deskripsi -->
    <div>
      <h3 class="text-lg font-semibold mb-3">Deskripsi</h3>
      <p class="text-sm leading-relaxed text-[#626F47]">
        {{ $buku->deskripsi }}
      </p>
    </div>

    <!-- Detail Buku -->
    <div class="grid grid-cols-2 gap-y-3 text-sm text-[#626F47]">
      <div><p class="font-semibold text-[#2E2E2E]">Penerbit</p><p>{{ $buku->penulis }}</p></div>
      <div><p class="font-semibold text-[#2E2E2E]">Tahun Terbit</p><p>{{ $buku->tahun_terbit }}</p></div>
      <div><p class="font-semibold text-[#2E2E2E]">Bahasa</p><p>{{ $buku->bahasa }}</p></div>
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
      <div><p class="font-semibold text-[#2E2E2E]">Jumlah Halaman</p><p>{{ $buku->jumlah_halaman }}</p></div>
      <div><p class="font-semibold text-[#2E2E2E]">Edisi</p><p>{{ $buku->edisi }}</p></div>
    </div>
  </div>
  <!-- === RATING SECTION (center + tidak full) === -->
<div class="w-full flex justify-center mt-10">
    <div class="bg-[#f7edd6] p-5 rounded-2xl shadow-md border border-[#ebdec8] 
                w-[320px] md:w-[380px]">

        <!-- Judul -->
        <p class="text-base font-semibold text-[#2E2E2E] mb-3 text-center">
            Beri Rating Buku Ini
        </p>

        <!-- Bintang -->
        <div class="flex items-center justify-center gap-2 mb-4" id="starContainer">
            @for ($i = 1; $i <= 5; $i++)
                <i class="fa-regular fa-star text-2xl text-[#d1c8ae] cursor-pointer transition-colors duration-200"
                   data-star="{{ $i }}"></i>
            @endfor
        </div>

        <!-- Tombol -->
        <div class="flex justify-center">
            <button id="submitRating"
                    class="bg-[#626F47] hover:bg-[#4e5938] active:scale-95 text-white text-sm px-5 py-2 
                           rounded-xl transition-all duration-200 shadow-sm">
                Beri Rating
            </button>
        </div>

    </div>
</div>

</div>
</main>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Script -->
<script src="{{ asset('assets_user/js/dashboard.js') }}"></script>
<script>
  // Debug: Cek apakah file terload
document.addEventListener("DOMContentLoaded", () => {
  const openPinjamModal = document.getElementById("openPinjamModal");
  const pinjamModal = document.getElementById("pinjamModal");
  const closeModalBtn = document.getElementById("closeModalBtn");
  const tglPinjamInput = document.getElementById("tglPinjamInput");
  const tglKembaliInput = document.getElementById("tglKembaliInput");
  const konfirmasiBtn = document.getElementById("konfirmasiPinjam");
  const closeKosong = document.getElementById("closeKosong");
  const popupStokKosong = document.getElementById("popupStokKosong");

  // Event untuk membuka modal
  if (openPinjamModal) {
    openPinjamModal.addEventListener("click", () => {
      pinjamModal.classList.remove("hidden");
      resetModal(); // Reset form ketika modal dibuka
    });
  }

  // Event untuk menutup modal
  if (closeModalBtn) {
    closeModalBtn.addEventListener("click", () => {
      pinjamModal.classList.add("hidden");
    });
  }

  // Event untuk menutup popup stok kosong
  if (closeKosong) {
    closeKosong.addEventListener("click", () => {
      popupStokKosong.classList.add("hidden");
    });
  }

  // Tutup modal ketika klik di luar
  if (pinjamModal) {
    pinjamModal.addEventListener("click", (e) => {
      if (e.target === pinjamModal) {
        pinjamModal.classList.add("hidden");
      }
    });
  }

  // Waktu lokal (Asia/Jakarta)
  const now = new Date();
  const today = new Date(now.getTime() - now.getTimezoneOffset() * 60000);  
  const maxDate = new Date(today);
  maxDate.setDate(today.getDate() + 7);

  const formatDate = d => d.toISOString().split("T")[0];

  // Set tanggal pinjam
  if (tglPinjamInput) {
    tglPinjamInput.value = formatDate(today);
  }
  
  // Set batas tanggal kembali (TANPA nilai default)
  if (tglKembaliInput) {
    tglKembaliInput.min = formatDate(today);
    tglKembaliInput.max = formatDate(maxDate);
    // JANGAN set value default - biarkan kosong
    tglKembaliInput.value = '';
  }

  // Fungsi untuk reset modal
  function resetModal() {
    if (tglKembaliInput) {
      tglKembaliInput.value = '';
    }
  }

  // Event untuk konfirmasi peminjaman
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

    // Validasi tanggal
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
      // Tampilkan loading
      konfirmasiBtn.disabled = true;
      konfirmasiBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';

      console.log('🔄 Mengirim request peminjaman...');

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

      console.log('✅ Response Status:', response.status);

      // Baca response sebagai text dulu untuk debugging
      const responseText = await response.text();
      console.log('📨 Raw Response:', responseText);

      let result;
      try {
        // Coba parse sebagai JSON
        result = JSON.parse(responseText);
        console.log('📊 Parsed JSON:', result);
      } catch (parseError) {
        console.error('❌ JSON Parse Error:', parseError);
        throw new Error('Response tidak valid dari server');
      }

      

// Handle result berdasarkan success status
if (result.success) {
  console.log('🎉 Peminjaman berhasil!');
  
  // Tutup modal
  pinjamModal.classList.add("hidden");
  
  // Tampilkan SweetAlert sukses dengan countdown 2 detik
  Swal.fire({
    icon: "success",
    title: "Berhasil!",
    text: result.message,
    timer: 2000,
    timerProgressBar: true,
    showConfirmButton: false
  }).then((result) => {
    // Redirect ke halaman riwayat setelah timer selesai
    if (result.dismiss === Swal.DismissReason.timer) {
      window.location.href = "{{ route('user.riwayatbuku') }}";
    }
  });

} else {
  console.log('❌ Peminjaman gagal:', result.message);
  
  // Handle error dari server
  Swal.fire({ 
    icon: "error", 
    title: "Gagal",
    text: result.message || "Terjadi kesalahan saat meminjam buku" 
  });
}

    } catch (error) {
      console.error("💥 Error:", error);
      
      Swal.fire({ 
        icon: "error", 
        title: "Error",
        text: "Terjadi kesalahan sistem: " + error.message
      });
    } finally {
      // Reset tombol
      if (konfirmasiBtn) {
        konfirmasiBtn.disabled = false;
        konfirmasiBtn.innerHTML = '<i class="fa-solid fa-check text-[#2E2E2E]"></i> Konfirmasi';
      }
    }
  });
}
});
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
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
    }
  });
});

</script>


</body>
</html>


