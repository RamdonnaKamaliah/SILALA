document.addEventListener("DOMContentLoaded", () => {

    function lockBody() {
    document.body.classList.add('overflow-hidden');
}

function unlockBody() {
    document.body.classList.remove('overflow-hidden');
}

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
/* ==========================
   STATE GLOBAL
   ========================== */
let streamAktif = null;
let fotoDiambil = false;
let bukuDipilih = null;
let modeKamera = null;
let sedangUpload = false;

/* ==========================
   SWEETALERT HELPERS
   ========================== */
function swalInfo(text) {
    return Swal.fire({
        icon: 'info',
        title: 'Informasi',
        text
    });
}

function swalError(text) {
    return Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text
    });
}

function swalAutoSuccess(text, duration = 2000) {
    return Swal.fire({
        icon: 'success',
        title: text,
        showConfirmButton: false,
        timer: duration,
        timerProgressBar: true,
        allowOutsideClick: false,
        allowEscapeKey: false
    });
}

function swalConfirmCancel() {
    return Swal.fire({
        title: 'Batalkan Pengembalian?',
        text: 'Foto dan proses akan dibatalkan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Batalkan',
        cancelButtonText: 'Tidak'
    });
}

/* ==========================
   CSRF TOKEN
   ========================== */
function getCsrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    if (meta) return meta.content;

    const input = document.querySelector('input[name="_token"]');
    if (input) return input.value;

    return '';
}

/* ==========================
   OPEN MODAL
   ========================== */
window.bukaModalPengembalian = function () {
    lockBody();

    const hasBuku = document.querySelectorAll('#selectBukuModal option').length > 1;
    if (!hasBuku) {
        swalInfo('Tidak ada buku yang sedang dipinjam');
        unlockBody();
        return;
    }

    resetModal();
    document.getElementById('pengembalianModal').classList.remove('hidden');
};

/* ==========================
   CLOSE MODAL (USER BATAL)
   ========================== */
window.tutupModal = async function () {
    if (sedangUpload) return;

    const res = await swalConfirmCancel();
    if (!res.isConfirmed) return;

    closeModalTanpaAlert();
};

/* ==========================
   CLOSE MODAL TANPA ALERT
   ========================== */
function closeModalTanpaAlert() {
    document.getElementById('pengembalianModal').classList.add('hidden');
    hentikanKamera();
    resetModal();
    unlockBody();
}

/* ==========================
   RESET MODAL
   ========================== */
function resetModal() {
    fotoDiambil = false;
    bukuDipilih = null;
    modeKamera = null;
    sedangUpload = false;

    document.getElementById('kameraArea').classList.add('hidden');
    document.getElementById('previewContainer').classList.add('hidden');

    document.getElementById('btnAmbilFoto').classList.remove('hidden');
    document.getElementById('btnKirimFoto').classList.add('hidden');

    document.getElementById('btnKameraDepan')?.classList.remove('bg-[#4C6444]', 'text-white');
    document.getElementById('btnKameraBelakang')?.classList.remove('bg-[#4C6444]', 'text-white');
}

/* ==========================
   PILIH KAMERA
   ========================== */
window.pilihKamera = async function (facingMode) {
    const select = document.getElementById('selectBukuModal');
    bukuDipilih = select.value;

    if (!bukuDipilih) {
        swalInfo('Silakan pilih buku terlebih dahulu');
        return;
    }

    document.getElementById('judulBukuKamera').innerText =
        select.options[select.selectedIndex].text;

    document.getElementById('btnKameraDepan').classList.remove('bg-[#4C6444]', 'text-white');
    document.getElementById('btnKameraBelakang').classList.remove('bg-[#4C6444]', 'text-white');

    document.getElementById(
        facingMode === 'user' ? 'btnKameraDepan' : 'btnKameraBelakang'
    ).classList.add('bg-[#4C6444]', 'text-white');

    modeKamera = facingMode;
    document.getElementById('kameraArea').classList.remove('hidden');
    document.getElementById('previewContainer').classList.add('hidden');

    document.getElementById('btnAmbilFoto').classList.remove('hidden');
    document.getElementById('btnKirimFoto').classList.add('hidden');

    hentikanKamera();

    try {
        streamAktif = await navigator.mediaDevices.getUserMedia({
            video: { facingMode }
        });

        const video = document.getElementById('kameraStream');
        video.srcObject = streamAktif;
        video.classList.remove('hidden');
    } catch {
        swalError('Tidak dapat mengakses kamera');
        document.getElementById('kameraArea').classList.add('hidden');
    }
};

/* ==========================
   AMBIL FOTO
   ========================== */
window.ambilFoto = function () {
    if (!streamAktif) {
        swalError('Kamera belum aktif');
        return;
    }

    const video = document.getElementById('kameraStream');
    const canvas = document.getElementById('fotoCanvas');

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);

    document.getElementById('previewFoto').src =
        canvas.toDataURL('image/png');

    video.classList.add('hidden');
    document.getElementById('previewContainer').classList.remove('hidden');
    document.getElementById('btnAmbilFoto').classList.add('hidden');
    document.getElementById('btnKirimFoto').classList.remove('hidden');

    fotoDiambil = true;
    hentikanKamera();
};

/* ==========================
   KIRIM FOTO
   ========================== */
window.kirimFoto = async function () {
    if (!fotoDiambil || !bukuDipilih || sedangUpload) return;

    sedangUpload = true;

    const btn = document.getElementById('btnKirimFoto');
    btn.disabled = true;
    btn.innerText = 'Mengirim...';

    try {
        const blob = await fetch(
            document.getElementById('fotoCanvas').toDataURL()
        ).then(r => r.blob());

        const formData = new FormData();
        formData.append('buku_id', bukuDipilih);
        formData.append('foto', blob);
        formData.append('_token', getCsrfToken());

        const res = await fetch('/kembalikan-buku-foto', {
            method: 'POST',
            body: formData,
            headers: { Accept: 'application/json' }
        });

        const json = await res.json();
        if (!json.success) throw new Error(json.message);

        await swalAutoSuccess(
            'Foto berhasil dikirim. Menunggu konfirmasi admin.'
        );

        closeModalTanpaAlert();
        location.reload();

    } catch (err) {
        swalError(err.message || 'Gagal mengirim foto');
        btn.disabled = false;
        btn.innerText = 'Kirim Foto';
        sedangUpload = false;
    }
};

/* ==========================
   STOP KAMERA
   ========================== */
function hentikanKamera() {
    if (!streamAktif) return;
    streamAktif.getTracks().forEach(track => track.stop());
    streamAktif = null;
}

    /* ==========================
   MODAL FOTO ULANG PENGEMBALIAN
   ========================== */
let streamAktifUlang = null;
let fotoDiambilUlang = false;
let bukuDipilihUlang = null;
let modeKameraUlang = null;

// Fungsi untuk membuka modal foto ulang
window.bukaModalFotoUlang = function(peminjamanId, judulBuku, keterangan = '') {
    console.log('Membuka modal foto ulang untuk peminjaman ID:', peminjamanId);

    lockBody(); // ⬅️ TAMBAH INI

    // Set buku yang dipilih
    bukuDipilihUlang = peminjamanId;

    // Set info buku
    document.getElementById('judulBukuUlang').textContent = judulBuku;
    document.getElementById('judulBukuKameraUlang').textContent = judulBuku;
    document.getElementById('keteranganTeguran').textContent =
        keterangan || 'Admin meminta foto ulang pengembalian';

    // Reset modal
    resetModalUlang();

    // Buka modal
    document.getElementById('fotoUlangModal').classList.remove('hidden');
};

// Fungsi untuk menutup modal foto ulang
window.tutupModalUlang = function() {
    document.getElementById('fotoUlangModal').classList.add('hidden');
    hentikanKameraUlang();
    resetModalUlang();

    unlockBody(); // ⬅️ TAMBAH INI
};
 

// Reset modal foto ulang ke kondisi awal
function resetModalUlang() {
    document.getElementById('kameraAreaUlang').classList.add('hidden');
    document.getElementById('previewContainerUlang').classList.add('hidden');
    
    // Reset tombol
    document.getElementById('btnAmbilFotoUlang').classList.remove('hidden');
    document.getElementById('btnKirimFotoUlang').classList.add('hidden');
    
    fotoDiambilUlang = false;
    modeKameraUlang = null;
    
    // Reset tombol kamera
    document.getElementById('btnKameraDepanUlang').classList.remove('bg-yellow-600', 'text-white');
    document.getElementById('btnKameraBelakangUlang').classList.remove('bg-yellow-600', 'text-white');
}

// Fungsi untuk memilih kamera pada modal foto ulang
window.pilihKameraUlang = async function(facingMode) {
    if (!bukuDipilihUlang) {
        console.error('Buku belum dipilih untuk foto ulang');
        return;
    }
    
    // Update tampilan tombol kamera
    document.getElementById('btnKameraDepanUlang').classList.remove('bg-yellow-600', 'text-white');
    document.getElementById('btnKameraBelakangUlang').classList.remove('bg-yellow-600', 'text-white');
    
    if (facingMode === 'user') {
        document.getElementById('btnKameraDepanUlang').classList.add('bg-yellow-600', 'text-white');
    } else {
        document.getElementById('btnKameraBelakangUlang').classList.add('bg-yellow-600', 'text-white');
    }
    
    modeKameraUlang = facingMode;
    
    // Tampilkan area kamera
    document.getElementById('kameraAreaUlang').classList.remove('hidden');
    
    // Sembunyikan preview jika ada
    document.getElementById('previewContainerUlang').classList.add('hidden');
    
    // Tampilkan tombol ambil foto, sembunyikan tombol kirim
    document.getElementById('btnAmbilFotoUlang').classList.remove('hidden');
    document.getElementById('btnKirimFotoUlang').classList.add('hidden');
    
    // Hentikan kamera sebelumnya jika ada
    hentikanKameraUlang();
    
    // Mulai kamera
    try {
        streamAktifUlang = await navigator.mediaDevices.getUserMedia({
            video: { 
                facingMode: facingMode,
                width: { ideal: 1280 },
                height: { ideal: 720 }
            }
        });
        const videoElement = document.getElementById('kameraStreamUlang');
        videoElement.srcObject = streamAktifUlang;
        videoElement.classList.remove('hidden');
    } catch (error) {
        console.error('Error mengakses kamera:', error);
        alert('Tidak dapat mengakses kamera. Pastikan izin kamera telah diberikan.');
        document.getElementById('kameraAreaUlang').classList.add('hidden');
    }
};

// Fungsi untuk mengambil foto pada modal foto ulang
window.ambilFotoUlang = function() {
    if (!streamAktifUlang) {
        alert('Kamera belum aktif');
        return;
    }
    
    const video = document.getElementById('kameraStreamUlang');
    const canvas = document.getElementById('fotoCanvasUlang');
    const context = canvas.getContext('2d');
    
    // Set ukuran canvas sama dengan video
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    
    // Gambar frame video ke canvas
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    
    // Tampilkan preview foto
    const previewImg = document.getElementById('previewFotoUlang');
    previewImg.src = canvas.toDataURL('image/png');
    document.getElementById('previewContainerUlang').classList.remove('hidden');
    
    // Sembunyikan video, tampilkan preview
    video.classList.add('hidden');
    
    // Ganti tombol: sembunyikan ambil foto, tampilkan kirim foto
    document.getElementById('btnAmbilFotoUlang').classList.add('hidden');
    document.getElementById('btnKirimFotoUlang').classList.remove('hidden');
    
    fotoDiambilUlang = true;
    
    // Hentikan kamera setelah mengambil foto
    hentikanKameraUlang();
};

// Fungsi untuk mengirim foto ulang
window.kirimFotoUlang = async function() {
    if (!fotoDiambilUlang || !bukuDipilihUlang) {
        alert('Silakan ambil foto terlebih dahulu');
        return;
    }
    
    const canvas = document.getElementById('fotoCanvasUlang');
    const imageData = canvas.toDataURL('image/png');
    
    // Tampilkan loading pada tombol kirim
    const btnKirim = document.getElementById('btnKirimFotoUlang');
    const originalText = btnKirim.innerHTML;
    btnKirim.innerHTML = '<span class="iconify animate-spin" data-icon="mdi:loading"></span> Mengirim...';
    btnKirim.disabled = true;
    
    try {
        console.log('Memulai proses pengiriman foto ulang...');
        
        // Konversi base64 ke blob
        const blob = await fetch(imageData).then(res => res.blob());
        console.log('Blob foto ulang berhasil dibuat, ukuran:', blob.size, 'bytes');
        
        // Dapatkan CSRF token
        const csrfToken = getCsrfToken();
        if (!csrfToken) {
            throw new Error('CSRF token tidak ditemukan');
        }
        
        // Buat FormData untuk dikirim
        const formData = new FormData();
        formData.append('buku_id', bukuDipilihUlang);
        formData.append('foto', blob, `pengembalian_ulang_${Date.now()}.png`);
        formData.append('_token', csrfToken);
        
        console.log('Mengirim foto ulang ke server...');
        
        // Kirim ke endpoint yang sama dengan pengembalian biasa
        const url = '/kembalikan-buku-foto';
        const response = await fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            credentials: 'same-origin'
        });
        
        console.log('Response status foto ulang:', response.status);
        
        // Cek jika response bukan JSON
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            const text = await response.text();
            console.error('Response foto ulang bukan JSON:', text.substring(0, 500));
            
            if (text.includes('CSRF token mismatch')) {
                throw new Error('CSRF token tidak valid. Silakan refresh halaman dan coba lagi.');
            }
            throw new Error('Server mengembalikan respons tidak valid. Status: ' + response.status);
        }
        
        const result = await response.json();
        console.log('Response JSON foto ulang:', result);
        
        if (result.success) {
            alert('Foto ulang berhasil dikirim! Menunggu konfirmasi admin.');
            // Tutup modal dan reload halaman
            tutupModalUlang();
            window.location.reload();
        } else {
            throw new Error(result.message || 'Gagal mengirim foto ulang');
        }
    } catch (error) {
        console.error('Error detail mengirim foto ulang:', error);
        alert('Gagal mengirim foto ulang: ' + error.message);
        
        // Reset tombol kirim
        btnKirim.innerHTML = originalText;
        btnKirim.disabled = false;
    }
};

// Fungsi untuk menghentikan kamera foto ulang
function hentikanKameraUlang() {
    if (streamAktifUlang) {
        streamAktifUlang.getTracks().forEach(track => track.stop());
        streamAktifUlang = null;
    }
}

// Event listener untuk tombol batal di luar modal foto ulang
document.addEventListener('click', function(e) {
    const modalUlang = document.getElementById('fotoUlangModal');
    if (e.target === modalUlang) {
        tutupModalUlang();
    }
});

// Hapus fungsi cekPeminjamanTeguran yang tidak perlu
// Karena kita sudah menggunakan tombol langsung di table

/* ==========================
   CEK NOTIFIKASI FOTO ULANG
   ========================== */

// Fungsi untuk cek dan tampilkan notifikasi jika ada teguran
function cekNotifikasiTeguran() {
    const rowsWithTeguran = document.querySelectorAll('tbody tr');
    let hasTeguran = false;
    
    rowsWithTeguran.forEach(row => {
        const keteranganCell = row.querySelector('td:nth-child(4)');
        if (keteranganCell && keteranganCell.textContent.includes('Teguran:')) {
            hasTeguran = true;
            // Tambahkan highlight pada row
            row.classList.add('border-2', 'border-yellow-500');
        }
    });
    
    return hasTeguran;
}

// Jalankan cek saat halaman dimuat
    const hasTeguran = cekNotifikasiTeguran();
    
    if (hasTeguran) {
        console.log('Ada peminjaman yang memerlukan foto ulang');
        // Anda bisa tambahkan notifikasi toast di sini jika diperlukan
    }
});