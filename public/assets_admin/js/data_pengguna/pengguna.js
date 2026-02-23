    // Animasi progress bars
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            const progressBarPengunjung = document.querySelector('.progress-bar-pengunjung');
            const progressBarAnggota = document.querySelector('.progress-bar-anggota');
            
            if (progressBarPengunjung) {
                progressBarPengunjung.style.width = progressBarPengunjung.dataset.width + '%';
            }
            
            if (progressBarAnggota) {
                progressBarAnggota.style.width = progressBarAnggota.dataset.width + '%';
            }
        }, 300);
    });