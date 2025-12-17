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
        // Cari dari meta tag
        const metaToken = document.querySelector('meta[name="csrf-token"]');
        if (metaToken) {
            return metaToken.getAttribute('content');
        }
        
        // Cari dari input hidden
        const inputToken = document.querySelector('input[name="_token"]');
        if (inputToken) {
            return inputToken.value;
        }
        
        // Fallback ke token dari Laravel jika ada
        if (window.Laravel && window.Laravel.csrfToken) {
            return window.Laravel.csrfToken;
        }
        
        console.warn('CSRF token tidak ditemukan');
        return '';
    }

    // Fungsi untuk membuka modal
    window.bukaModalPengembalian = function() {
        // Cek apakah ada buku yang sedang dipinjam
        const bukuDipinjam = document.querySelectorAll('#selectBukuModal option').length > 1;
        
        if (!bukuDipinjam) {
            alert('Tidak ada buku yang sedang dipinjam');
            return;
        }
        
        document.getElementById('pengembalianModal').classList.remove('hidden');
        resetModal();
    };

    // Fungsi untuk menutup modal
    window.tutupModal = function() {
        document.getElementById('pengembalianModal').classList.add('hidden');
        hentikanKamera();
        resetModal();
    };

    // Reset modal ke kondisi awal
    function resetModal() {
        document.getElementById('kameraArea').classList.add('hidden');
        document.getElementById('previewContainer').classList.add('hidden');
        
        // Reset tombol
        document.getElementById('btnAmbilFoto').classList.remove('hidden');
        document.getElementById('btnKirimFoto').classList.add('hidden');
        
        fotoDiambil = false;
        bukuDipilih = null;
        modeKamera = null;
        
        // Reset tombol kamera
        document.getElementById('btnKameraDepan').classList.remove('bg-[#4C6444]', 'text-white');
        document.getElementById('btnKameraBelakang').classList.remove('bg-[#4C6444]', 'text-white');
    }

    // Fungsi untuk memilih kamera
    window.pilihKamera = async function(facingMode) {
        // Dapatkan buku yang dipilih
        const selectBuku = document.getElementById('selectBukuModal');
        bukuDipilih = selectBuku.value;
        
        if (!bukuDipilih) {
            alert('Silakan pilih buku terlebih dahulu');
            return;
        }
        
        // Update judul buku di overlay
        const selectedOption = selectBuku.options[selectBuku.selectedIndex];
        document.getElementById('judulBukuKamera').textContent = selectedOption.text;
        
        // Update tampilan tombol kamera
        document.getElementById('btnKameraDepan').classList.remove('bg-[#4C6444]', 'text-white');
        document.getElementById('btnKameraBelakang').classList.remove('bg-[#4C6444]', 'text-white');
        
        if (facingMode === 'user') {
            document.getElementById('btnKameraDepan').classList.add('bg-[#4C6444]', 'text-white');
        } else {
            document.getElementById('btnKameraBelakang').classList.add('bg-[#4C6444]', 'text-white');
        }
        
        modeKamera = facingMode;
        
        // Tampilkan area kamera
        document.getElementById('kameraArea').classList.remove('hidden');
        
        // Sembunyikan preview jika ada
        document.getElementById('previewContainer').classList.add('hidden');
        
        // Tampilkan tombol ambil foto, sembunyikan tombol kirim
        document.getElementById('btnAmbilFoto').classList.remove('hidden');
        document.getElementById('btnKirimFoto').classList.add('hidden');
        
        // Hentikan kamera sebelumnya jika ada
        hentikanKamera();
        
        // Mulai kamera
        try {
            streamAktif = await navigator.mediaDevices.getUserMedia({
                video: { 
                    facingMode: facingMode,
                    width: { ideal: 1280 },
                    height: { ideal: 720 }
                }
            });
            const videoElement = document.getElementById('kameraStream');
            videoElement.srcObject = streamAktif;
            videoElement.classList.remove('hidden');
        } catch (error) {
            console.error('Error mengakses kamera:', error);
            alert('Tidak dapat mengakses kamera. Pastikan izin kamera telah diberikan.');
            document.getElementById('kameraArea').classList.add('hidden');
        }
    };

    // Fungsi untuk mengambil foto
    window.ambilFoto = function() {
        if (!streamAktif) {
            alert('Kamera belum aktif');
            return;
        }
        
        const video = document.getElementById('kameraStream');
        const canvas = document.getElementById('fotoCanvas');
        const context = canvas.getContext('2d');
        
        // Set ukuran canvas sama dengan video
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        
        // Gambar frame video ke canvas
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        
        // Tampilkan preview foto
        const previewImg = document.getElementById('previewFoto');
        previewImg.src = canvas.toDataURL('image/png');
        document.getElementById('previewContainer').classList.remove('hidden');
        
        // Sembunyikan video, tampilkan preview
        video.classList.add('hidden');
        
        // Ganti tombol: sembunyikan ambil foto, tampilkan kirim foto
        document.getElementById('btnAmbilFoto').classList.add('hidden');
        document.getElementById('btnKirimFoto').classList.remove('hidden');
        
        fotoDiambil = true;
        
        // Hentikan kamera setelah mengambil foto
        hentikanKamera();
    };

    // Fungsi untuk mengirim foto
    window.kirimFoto = async function() {
        if (!fotoDiambil || !bukuDipilih) {
            alert('Silakan ambil foto terlebih dahulu dan pilih buku');
            return;
        }
        
        const canvas = document.getElementById('fotoCanvas');
        const imageData = canvas.toDataURL('image/png');
        
        // Tampilkan loading pada tombol kirim
        const btnKirim = document.getElementById('btnKirimFoto');
        const originalText = btnKirim.innerHTML;
        btnKirim.innerHTML = '<span class="iconify animate-spin" data-icon="mdi:loading"></span> Mengirim...';
        btnKirim.disabled = true;
        
        try {
            console.log('Memulai proses pengiriman foto...');
            
            // Konversi base64 ke blob
            const blob = await fetch(imageData).then(res => res.blob());
            console.log('Blob berhasil dibuat, ukuran:', blob.size, 'bytes');
            
            // Dapatkan CSRF token
            const csrfToken = getCsrfToken();
            if (!csrfToken) {
                throw new Error('CSRF token tidak ditemukan');
            }
            
            // Buat FormData untuk dikirim
            const formData = new FormData();
            formData.append('buku_id', bukuDipilih);
            formData.append('foto', blob, `pengembalian_${Date.now()}.png`);
            formData.append('_token', csrfToken);
            
            console.log('Mengirim ke server dengan CSRF token...');
            
            // Kirim ke endpoint yang sesuai - gunakan URL yang benar
            // Sesuaikan route dengan yang ada di Laravel
            const url = '/kembalikan-buku-foto'; // Ganti dengan route yang benar
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    // Jangan tambahkan Content-Type header untuk FormData,
                    // browser akan mengatur sendiri dengan boundary yang sesuai
                },
                credentials: 'same-origin' // Penting untuk mengirim cookie session
            });
            
            console.log('Response status:', response.status);
            
            // Cek jika response bukan JSON
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                const text = await response.text();
                console.error('Response bukan JSON:', text.substring(0, 500));
                
                // Coba untuk mengekstrak pesan error jika ada
                if (text.includes('CSRF token mismatch')) {
                    throw new Error('CSRF token tidak valid. Silakan refresh halaman dan coba lagi.');
                }
                throw new Error('Server mengembalikan respons tidak valid. Status: ' + response.status);
            }
            
            const result = await response.json();
            console.log('Response JSON:', result);
            
            if (result.success) {
                alert('Foto berhasil dikirim! Menunggu konfirmasi admin.');
                // Tutup modal dan reload halaman
                tutupModal();
                window.location.reload();
            } else {
                throw new Error(result.message || 'Gagal mengirim foto');
            }
        } catch (error) {
            console.error('Error detail mengirim foto:', error);
            alert('Gagal mengirim foto: ' + error.message);
            
            // Reset tombol kirim
            btnKirim.innerHTML = originalText;
            btnKirim.disabled = false;
        }
    };

    // Fungsi untuk menghentikan kamera
    function hentikanKamera() {
        if (streamAktif) {
            streamAktif.getTracks().forEach(track => track.stop());
            streamAktif = null;
        }
    }

    // Event listener untuk dropdown buku
    const selectBukuModal = document.getElementById('selectBukuModal');
    if (selectBukuModal) {
        selectBukuModal.addEventListener('change', function() {
            if (streamAktif) {
                hentikanKamera();
                document.getElementById('kameraArea').classList.add('hidden');
                fotoDiambil = false;
                modeKamera = null;
            }
        });
    }

    // Event listener untuk tombol batal di luar modal
    document.addEventListener('click', function(e) {
        const modal = document.getElementById('pengembalianModal');
        if (e.target === modal) {
            tutupModal();
        }
    });

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
    
    // Set buku yang dipilih
    bukuDipilihUlang = peminjamanId;
    
    // Set info buku
    document.getElementById('judulBukuUlang').textContent = judulBuku;
    document.getElementById('judulBukuKameraUlang').textContent = judulBuku;
    document.getElementById('keteranganTeguran').textContent = keterangan || 'Admin meminta foto ulang pengembalian';
    
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
document.addEventListener('DOMContentLoaded', function() {
    const hasTeguran = cekNotifikasiTeguran();
    
    if (hasTeguran) {
        console.log('Ada peminjaman yang memerlukan foto ulang');
        // Anda bisa tambahkan notifikasi toast di sini jika diperlukan
    }
});
});