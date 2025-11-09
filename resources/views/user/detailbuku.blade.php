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

      <!-- Bagian Atas: Judul & Icon -->
      <div class="flex justify-between items-center w-full">
        <h1 class="flex items-center gap-3 text-lg md:text-xl font-semibold text-[#626F47]">
          <a href="{{ route('user.daftarbuku') }}" 
            class="text-[#626F47] hover:text-[#A4B465] transition-colors duration-300">
            <i class="fa-solid fa-arrow-left text-base md:text-lg"></i>
          </a>
          <span>{{ $title ?? 'Detail Buku' }}</span>
        </h1>

        <!-- Ikon kanan -->
        <div class="flex items-center gap-5">
          <button id="notifBtn" class="text-[#626F47] text-lg focus:outline-none">
            <i class="fa-solid fa-bell"></i>
          </button>
          <button class="text-[#626F47] text-lg">
            <i class="fa-solid fa-gear"></i>
          </button>
        </div>
      </div>

      <!-- Bagian Tengah: Cover & Info Buku -->
      <div class="flex flex-col md:flex-row items-center md:items-end justify-center 
                  gap-8 w-full max-w-4xl mx-auto relative mt-8">

       <!-- Cover Buku -->
        <div class="relative -mb-24 md:-mb-20 w-36 md:w-44 flex-shrink-0">
          <img src="{{ asset($buku->foto_buku ?? 'assets/default-cover.jpg') }}"  
              alt="{{ $buku->judul_buku }}"
              class="w-full h-auto rounded-10 shadow-lg border-4 border-white">
        </div>


        <!-- Info Buku -->
        <div class="flex flex-col justify-between text-left w-[85%] md:w-[60%]">
          <h2 class="text-lg md:text-xl font-semibold text-[#2E2E2E] leading-snug">
            {{ $buku->judul_buku }}
          </h2>
          <p class="text-sm text-[#626F47] mt-1">{{ $buku->penulis }}</p>


          <div class="flex items-center text-[#FACC15] text-sm mt-1">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-regular fa-star"></i>
          </div>
        </div>
      </div>
    </nav>

    <!-- ====== Konten Detail Buku ====== -->
    <main class="relative mt-[50vh] px-4 md:px-6 pb-20 text-[#2E2E2E] transition-all duration-300">

      <div class="bg-white rounded-3xl pt-10 pb-12 px-4 md:px-10">

<!-- Tombol Baca & Pinjam -->
<div class="flex justify-end gap-4 mb-10">
  <button class="bg-[#C9DABF] hover:bg-[#B7CBA8] text-[#2E2E2E] font-semibold px-8 py-2 rounded-full shadow-sm transition">
    Baca
  </button>

  <!-- Tambahkan id dan data-id -->
  <button id="btnPinjam" 
    data-id="{{ $buku->id }}"
    class="bg-[#F5C37D] hover:bg-[#E8B463] text-[#2E2E2E] font-semibold px-8 py-2 rounded-full shadow-sm transition">
    Pinjam
  </button>
</div>


<!-- POPUP PEMINJAMAN -->
<div id="popupPinjam" 
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-lg p-6 w-11/12 md:w-1/3 relative">
    
    <!-- Tombol Close -->
    <button id="closePopup" class="absolute top-3 right-4 text-gray-500 hover:text-gray-700 text-xl">
      <i class="fa-solid fa-xmark"></i>
    </button>

    <h2 class="text-lg font-semibold text-center mb-4 text-[#2E2E2E]">Konfirmasi Peminjaman</h2>

    <div class="space-y-3 text-sm text-[#2E2E2E]">
      <p><span class="font-semibold">Judul:</span> {{ $buku->judul_buku }}</p>
      <p><span class="font-semibold">Penulis:</span> {{ $buku->penulis }}</p>
      <p><span class="font-semibold">Stok Buku:</span> {{ $buku->stok ?? '-' }}</p>
      <p><span class="font-semibold">Tanggal Pinjam:</span> <span id="tglPinjam"></span></p>

      <div>
        <label for="tglKembaliInput" class="font-semibold">Tanggal Kembali (maks. 7 hari):</label>
        <input type="date" id="tglKembaliInput" 
               class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-[#8CA86C] focus:border-[#8CA86C]"
               required>
      </div>
    </div>

    <div class="flex justify-center mt-6">
      <button id="konfirmasiPinjam"
        class="bg-[#8CA86C] hover:bg-[#6e8a50] text-white font-semibold px-6 py-2 rounded-full transition">
        Konfirmasi Pinjam
      </button>
    </div>
  </div>
</div>



        <!-- Informasi Buku -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-10 gap-x-12 border-t border-gray-200 pt-8">

          <!-- Deskripsi -->
          <div>
            <h3 class="text-lg font-semibold mb-3">Deskripsi</h3>
            <p class="text-sm leading-relaxed text-[#626F47]">
              {{ $buku->deskripsi }}
            </p>
          </div>

          <!-- Detail Buku -->
<div class="grid grid-cols-2 gap-y-4 text-sm text-[#626F47]">
  <div>
    <p class="font-semibold text-[#2E2E2E]">Penerbit</p>
    <p>{{ $buku->penerbit ?? '-' }}</p>
  </div>
  <div>
    <p class="font-semibold text-[#2E2E2E]">Tahun Terbit</p>
    <p>{{ $buku->tahun_terbit ?? '-' }}</p>
  </div>
  <div>
    <p class="font-semibold text-[#2E2E2E]">Bahasa</p>
    <p>{{ $buku->bahasa ?? '-' }}</p>
  </div>
  <div>
    <p class="font-semibold text-[#2E2E2E]">Kategori</p>
    <p>{{ $buku->kategori ?? '-' }}</p>
  </div>
  <div>
    <p class="font-semibold text-[#2E2E2E]">Jumlah Halaman</p>
    <p>{{ $buku->jumlah_halaman ?? '-' }}</p>
  </div>
  <div>
    <p class="font-semibold text-[#2E2E2E]">Edisi</p>
    <p>{{ $buku->edisi ?? '-' }}</p>
  </div>
</div>


        </div>
      </div>
    </main>

  </div>


 
<script src="{{ asset('assets_user/js/dashboard.js') }}"></script>
<script>
const btnPinjam = document.getElementById('btnPinjam');
const popupPinjam = document.getElementById('popupPinjam');
const closePopup = document.getElementById('closePopup');
const tglPinjamEl = document.getElementById('tglPinjam');
const tglKembaliInput = document.getElementById('tglKembaliInput');

// Format tanggal
function toInputDateFormat(date) {
  return date.toISOString().split('T')[0];
}
function formatTanggal(date) {
  return date.toLocaleDateString('id-ID', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
}

// Tampilkan popup
btnPinjam.addEventListener('click', () => {
  const now = new Date();
  const maxDate = new Date();
  maxDate.setDate(now.getDate() + 7);

  // Isi tanggal pinjam dan batas pengembalian
  tglPinjamEl.textContent = formatTanggal(now);
  tglKembaliInput.min = toInputDateFormat(now);
  tglKembaliInput.max = toInputDateFormat(maxDate);
  tglKembaliInput.value = toInputDateFormat(now);

  popupPinjam.classList.remove('hidden');
});

// Tutup popup
closePopup.addEventListener('click', () => popupPinjam.classList.add('hidden'));
popupPinjam.addEventListener('click', e => {
  if (e.target === popupPinjam) popupPinjam.classList.add('hidden');
});

// Kirim data konfirmasi
document.getElementById('konfirmasiPinjam').addEventListener('click', () => {
  const bukuId = btnPinjam.dataset.id;
  const tanggalKembali = tglKembaliInput.value;

  if (!tanggalKembali) {
    alert('Isi tanggal kembali dulu.');
    return;
  }

  fetch("{{ route('user.riwayatbuku.store') }}", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": "{{ csrf_token() }}"
    },
    body: JSON.stringify({
      buku_id: bukuId,
      tanggal_kembali: tanggalKembali
    })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      alert("Peminjaman berhasil disimpan.");
      window.location.href = "{{ route('user.riwayatbuku') }}";
    } else {
      alert("Gagal menyimpan peminjaman.");
    }
  })
  .catch(err => {
    console.error(err);
    alert("Terjadi kesalahan. Coba lagi.");
  });
});
</script>

</body>
</html>
