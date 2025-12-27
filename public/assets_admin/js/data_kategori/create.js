document.addEventListener('DOMContentLoaded', function () {
    const namaKategoriInput = document.getElementById('nama_kategori');
    const charCount = document.getElementById('charCount');

    // ⛔ kalau elemen tidak ada, hentikan script
    if (!namaKategoriInput || !charCount) return;

    // Auto-capitalize first letter
    namaKategoriInput.addEventListener('input', function (e) {
        if (e.target.value.length === 1) {
            e.target.value =
                e.target.value.charAt(0).toUpperCase() +
                e.target.value.slice(1);
        }

        // Update character counter
        charCount.textContent = this.value.length;

        if (this.value.length > 45) {
            charCount.classList.add('text-orange-500');
            charCount.classList.remove('text-gray-500');
        } else {
            charCount.classList.remove('text-orange-500');
            charCount.classList.add('text-gray-500');
        }
    });

    // Trigger initial count
    namaKategoriInput.dispatchEvent(new Event('input'));
});
