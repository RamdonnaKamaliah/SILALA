document.addEventListener('DOMContentLoaded', function() {

  const btn = document.querySelector('#kategoriDropdown button');
  const menu = document.querySelector('#kategoriMenu');
  const icon = document.querySelector('#kategoriIcon');
  const text = document.querySelector('#kategoriText');
  const items = document.querySelectorAll('.kategori-item');

  if (btn) {
    btn.addEventListener('click', () => {
      menu.classList.toggle('hidden');
      icon.classList.toggle('rotate-180');
    });

    items.forEach(item => {
      item.addEventListener('click', () => {
        text.textContent = item.textContent;
        menu.classList.add('hidden');
        icon.classList.remove('rotate-180');
      });
    });

    document.addEventListener('click', (e) => {
      if (!btn.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.add('hidden');
        icon.classList.remove('rotate-180');
      }
    });
  }


  // ========================
  // FILTER DAN SEARCH BUKU
  // ========================

  const searchInput = document.querySelector('input[placeholder="Cari Buku..."]');
  const kategoriButtons = document.querySelectorAll('.kategori-btn');
  const kategoriText = document.getElementById('kategoriText');
  const cards = document.querySelectorAll('[data-judul]');

  let kategoriDipilih = "Semua";

  kategoriButtons.forEach(btn => {
    btn.addEventListener('click', function() {
      kategoriDipilih = this.getAttribute('data-kategori');
      kategoriText.textContent = kategoriDipilih;

      cards.forEach(card => {
        const kategoriBuku = card.getAttribute('data-kategori-buku');
        const judul = card.getAttribute('data-judul');

        if (
          (kategoriDipilih === "Semua" || kategoriBuku === kategoriDipilih) &&
          judul.includes(searchInput.value.toLowerCase())
        ) {
          card.classList.remove('hidden');
          card.classList.add('flex');
        } else {
          card.classList.add('hidden');
          card.classList.remove('flex');
        }
      });
    });
  });

  // SEARCH
  if (searchInput) {
    searchInput.addEventListener('input', function() {
      const query = this.value.toLowerCase().trim();

      cards.forEach(card => {
        const judul = card.getAttribute('data-judul');
        const kategoriBuku = card.getAttribute('data-kategori-buku');

        if (
          (kategoriDipilih === "Semua" || kategoriBuku === kategoriDipilih) &&
          judul.includes(query)
        ) {
          card.classList.remove('hidden');
          card.classList.add('flex');
        } else {
          card.classList.add('hidden');
          card.classList.remove('flex');
        }
      });
    });
  }

});
