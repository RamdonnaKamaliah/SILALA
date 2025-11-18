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
