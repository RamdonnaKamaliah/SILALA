document.addEventListener("DOMContentLoaded", () => {
    /* ==========================
       DROPDOWN PROFILE
       ========================== */
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    if (dropdownButton && dropdownMenu) {
        dropdownButton.addEventListener('click', function () {
            dropdownMenu.classList.toggle('hidden');
            const icon = dropdownButton.querySelector('.iconify');
            icon?.classList.toggle('rotate-180');
        });

        document.addEventListener('click', function (e) {
            const wrapper = document.getElementById('dropdownWrapper');
            if (wrapper && !wrapper.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
                const icon = dropdownButton.querySelector('.iconify');
                icon?.classList.remove('rotate-180');
            }
        });
    }

    /* ==========================
       MODAL PENGEMBALIAN BUKU
       ========================== */
let streamAktif = null;
let fotoDiambil = false;
let bukuDipilih = null;
let modeKamera = null;

// Fungsi untuk mendapatkan CSRF token
function getCsrfToken() {
    const metaToken = document.querySelector('meta[name="csrf-token"]');
    if (metaToken) return metaToken.getAttribute('content');

    const inputToken = document.querySelector('input[name="_token"]');
    if (inputToken) return inputToken.value;

    if (window.Laravel && window.Laravel.csrfToken) return window.Laravel.csrfToken;

    console.warn('CSRF token tidak ditemukan');
    return '';
}

/* ========================
      BUKA & TUTUP MODAL
   ======================== */

window.bukaModalPengembalian = function() {
    const bukuDipinjam = document.querySelectorAll('#selectBukuModal option').length > 1;

    if (!bukuDipinjam) {
        Swal.fire({
            icon: "info",
            title: "Tidak Ada Buku",
            text: "Tidak ada buku yang sedang dipinjam.",
        });
        return;
    }

    document.getElementById('pengembalianModal').classList.remove('hidden');
    resetModal();
};

window.tutupModal = function() {
    Swal.fire({
        icon: "question",
        title: "Tutup Modal?",
        text: "Apakah kamu yakin ingin membatalkan pengembalian?",
        showCancelButton: true,
        confirmButtonText: "Ya, tutup",
        cancelButtonText: "Batal",
        confirmButtonColor: "#4C6444",
        cancelButtonColor: "#d33"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('pengembalianModal').classList.add('hidden');
            hentikanKamera();
            resetModal();
        }
    });
};

/* ========================
      RESET MODAL
   ======================== */

function resetModal() {
    document.getElementById('kameraArea').classList.add('hidden');
    document.getElementById('previewContainer').classList.add('hidden');

    document.getElementById('btnAmbilFoto').classList.remove('hidden');
    document.getElementById('btnKirimFoto').classList.add('hidden');

    fotoDiambil = false;
    bukuDipilih = null;
    modeKamera = null;

    document.getElementById('btnKameraDepan').classList.remove('bg-[#4C6444]', 'text-white');
    document.getElementById('btnKameraBelakang').classList.remove('bg-[#4C6444]', 'text-white');
}

/* ========================
      PILIH KAMERA
   ======================== */

window.pilihKamera = async function(facingMode) {
    const selectBuku = document.getElementById('selectBukuModal');
    bukuDipilih = selectBuku.value;

    if (!bukuDipilih) {
        Swal.fire({
            icon: "warning",
            title: "Belum Memilih Buku",
            text: "Silakan pilih buku terlebih dahulu.",
        });
        return;
    }

    const selectedOption = selectBuku.options[selectBuku.selectedIndex];
    document.getElementById('judulBukuKamera').textContent = selectedOption.text;

    document.getElementById('btnKameraDepan').classList.remove('bg-[#4C6444]', 'text-white');
    document.getElementById('btnKameraBelakang').classList.remove('bg-[#4C6444]', 'text-white');

    if (facingMode === 'user') {
        document.getElementById('btnKameraDepan').classList.add('bg-[#4C6444]', 'text-white');
    } else {
        document.getElementById('btnKameraBelakang').classList.add('bg-[#4C6444]', 'text-white');
    }

    modeKamera = facingMode;

    document.getElementById('kameraArea').classList.remove('hidden');
    document.getElementById('previewContainer').classList.add('hidden');

    document.getElementById('btnAmbilFoto').classList.remove('hidden');
    document.getElementById('btnKirimFoto').classList.add('hidden');

    hentikanKamera();

    try {
        streamAktif = await navigator.mediaDevices.getUserMedia({
            video: { facingMode: facingMode }
        });

        const videoElement = document.getElementById('kameraStream');
        videoElement.srcObject = streamAktif;
        videoElement.classList.remove('hidden');

    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Tidak Bisa Mengakses Kamera",
            text: "Pastikan izin kamera sudah diberikan.",
        });

        document.getElementById('kameraArea').classList.add('hidden');
    }
};

/* ========================
      AMBIL FOTO
   ======================== */

window.ambilFoto = function() {
    if (!streamAktif) {
        Swal.fire({
            icon: "warning",
            title: "Kamera Belum Aktif",
            text: "Silakan pilih kamera terlebih dahulu.",
        });
        return;
    }

    const video = document.getElementById('kameraStream');
    const canvas = document.getElementById('fotoCanvas');
    const ctx = canvas.getContext('2d');

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    document.getElementById('previewFoto').src = canvas.toDataURL('image/png');
    document.getElementById('previewContainer').classList.remove('hidden');

    video.classList.add('hidden');

    document.getElementById('btnAmbilFoto').classList.add('hidden');
    document.getElementById('btnKirimFoto').classList.remove('hidden');

    fotoDiambil = true;
    hentikanKamera();
};

/* ========================
      KIRIM FOTO
   ======================== */

window.kirimFoto = async function() {
    if (!fotoDiambil || !bukuDipilih) {
        Swal.fire({
            icon: "warning",
            title: "Belum Lengkap",
            text: "Ambil foto dan pilih buku terlebih dahulu.",
        });
        return;
    }

    Swal.fire({
        title: "Kirim Foto?",
        text: "Pastikan foto jelas dan sesuai buku.",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Kirim",
        cancelButtonText: "Batal",
        confirmButtonColor: "#4C6444",
        cancelButtonColor: "#d33"
    }).then(async (result) => {
        if (!result.isConfirmed) return;

        Swal.fire({
            title: "Mengirim...",
            text: "Foto sedang dikirim ke server.",
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading(),
        });

        try {
            const canvas = document.getElementById('fotoCanvas');
            const blob = await fetch(canvas.toDataURL("image/png")).then(r => r.blob());

            const formData = new FormData();
            formData.append("buku_id", bukuDipilih);
            formData.append("foto", blob, `pengembalian_${Date.now()}.png`);
            formData.append("_token", getCsrfToken());

            const response = await fetch("/kembalikan-buku-foto", {
                method: "POST",
                body: formData,
            });

            const data = await response.json();

            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: "Foto berhasil dikirim. Menunggu konfirmasi admin.",
                    confirmButtonColor: "#4C6444"
                }).then(() => location.reload());
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Gagal Mengirim",
                    text: data.message || "Terjadi kesalahan.",
                });
            }

        } catch (err) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: err.message,
            });
        }
    });
};

/* ========================
      STOP KAMERA
   ======================== */

function hentikanKamera() {
    if (streamAktif) {
        streamAktif.getTracks().forEach(t => t.stop());
        streamAktif = null;
    }
}

/* ========================
  CLOSE MODAL KETIKA CLICK LUAR
   ======================== */

document.addEventListener("click", function(e) {
    const modal = document.getElementById("pengembalianModal");
    if (e.target === modal) {
        tutupModal();
    }
});

});