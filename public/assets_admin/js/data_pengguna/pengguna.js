    // Animasi progress bars
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            const progressBarKaryawan = document.querySelector('.progress-bar-karyawan');
            const progressBarMagang = document.querySelector('.progress-bar-magang');
            
            if (progressBarKaryawan) {
                progressBarKaryawan.style.width = progressBarKaryawan.dataset.width + '%';
            }
            
            if (progressBarMagang) {
                progressBarMagang.style.width = progressBarMagang.dataset.width + '%';
            }
        }, 300);
    });