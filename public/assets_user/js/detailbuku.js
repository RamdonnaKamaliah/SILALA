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

  
//favorite detail buku
  const loveBtn = document.getElementById('loveBtn');
  const heartIcon = document.getElementById('heartIcon');
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