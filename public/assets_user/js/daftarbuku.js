document.addEventListener('DOMContentLoaded', function () {

    // ================================
    // DROPDOWN KATEGORI
    // ================================
    const btn = document.querySelector('#kategoriDropdown button');
    const menu = document.querySelector('#kategoriMenu');
    const icon = document.querySelector('#kategoriIcon');
    const kategoriText = document.querySelector('#kategoriText');
    const items = document.querySelectorAll('.kategori-item');

    if (btn) {
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });

        // Klik item dropdown
        items.forEach(item => {
            item.addEventListener('click', () => {
                kategoriText.textContent = item.textContent;
                menu.classList.add('hidden');
                icon.classList.remove('rotate-180');
            });
        });

        // Klik luar dropdown → tutup
        document.addEventListener('click', (e) => {
            if (!btn.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        });
    }

    // ================================
    // FILTER & SEARCH BUKU
    // ================================
    const searchInput = document.querySelector('input[placeholder="Cari Buku..."]');
    const kategoriButtons = document.querySelectorAll('.kategori-btn');
    const cards = document.querySelectorAll('[data-judul]');

    let kategoriDipilih = "Semua";

    // --------------------
    // FUNGSI FILTER UTAMA
    // --------------------
    function filterBuku() {
        const query = searchInput.value.toLowerCase().trim();

        cards.forEach(card => {
            const kategori = card.getAttribute('data-kategori-buku');
            const judul = card.getAttribute('data-judul').toLowerCase();

            const cocokKategori = (kategoriDipilih === "Semua" || kategori === kategoriDipilih);
            const cocokSearch = judul.startsWith(query);

            if (cocokKategori && cocokSearch) {
                card.classList.remove('hidden');
                card.classList.add('flex');
            } else {
                card.classList.add('hidden');
                card.classList.remove('flex');
            }
        });

        cekKosong();
    }

    // KLIK KATEGORI
    kategoriButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            kategoriDipilih = this.getAttribute('data-kategori');

            kategoriText.textContent = kategoriDipilih;
            filterBuku();
        });
    });

    // SEARCH
    if (searchInput) {
        searchInput.addEventListener('input', filterBuku);
    }
});


// ================================
// CEK KOSONG
// ================================
function cekKosong() {
    const kartu = document.querySelectorAll('[data-kategori-buku]');
    const adaYangTampil = Array.from(kartu).some(k => !k.classList.contains('hidden'));

    document.getElementById('pesanKosong').classList.toggle('hidden', adaYangTampil);
}
