 const openModalBtn = document.getElementById('openModalBtn');
  const closeModalBtn = document.getElementById('closeModalBtn');
  const confirmBtn = document.getElementById('confirmBtn');
  const modal = document.getElementById('pinjamModal');
  const popupStokKosong = document.getElementById('popupStokKosong');
  const closeKosong = document.getElementById('closeKosong');

  // ==== SIMULASI STOK ====
  // ubah nilai stok ini buat ngetes (0 = kosong, >0 = ada stok)
  let stokBuku = 2; // ganti ke 0 buat ngetes popup stok habis

  // ==== Buka modal ====
  openModalBtn.addEventListener('click', () => {
    // kalau stok kosong, langsung tampilkan popup stok habis
    if (stokBuku <= 0) {
      popupStokKosong.classList.remove('hidden');
    } else {
      modal.classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }
  });

  // ==== Tutup modal ====
  closeModalBtn.addEventListener('click', () => {
    modal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
  });

  // ==== Tutup popup stok kosong ====
  closeKosong.addEventListener('click', () => {
    popupStokKosong.classList.add('hidden');
  });

  // ==== Tombol Konfirmasi ====
  confirmBtn.addEventListener('click', () => {
    modal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');

    if (stokBuku > 0) {
      // === Kondisi stok masih ada ===
      Swal.fire({
        title: 'Buku berhasil dipinjam!',
        text: 'Selamat membaca, jangan lupa kembalikan tepat waktu 📚',
        icon: 'success',
        showConfirmButton: false, // gak ada tombol OK
        timer: 2000,              // otomatis hilang setelah 2 detik
        timerProgressBar: true
      });
    }
  });

// tanggal pinjam
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


//favorite detail buku
 document.addEventListener('DOMContentLoaded', () => {
  const loveBtn = document.getElementById('loveBtn');
  const heartIcon = document.getElementById('heartIcon');

  if (!loveBtn || !heartIcon) return; // aman kalau element belum ada

  let loved = false;

  loveBtn.addEventListener('click', () => {
    loved = !loved;

    if (loved) {
      heartIcon.classList.remove('fa-regular');
      heartIcon.classList.add('fa-solid', 'text-[#E63946]');
      heartIcon.classList.add('scale-125');
      setTimeout(() => heartIcon.classList.remove('scale-125'), 150);
    } else {
      heartIcon.classList.remove('fa-solid', 'text-[#E63946]');
      heartIcon.classList.add('fa-regular');
    }
  });
});
