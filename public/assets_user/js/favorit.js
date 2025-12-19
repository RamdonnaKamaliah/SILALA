// favorit.js
document.addEventListener('DOMContentLoaded', function () {
  // Setup semua fungsi
  setupFavoritesSearch();
  setupFavoriteButtons();

  function setupFavoritesSearch() {
    const searchInput = document.getElementById('searchBuku');
    const bookCards = document.querySelectorAll('.book-card');
    const noSearchResults = document.getElementById('no-favorites-search');
    const favoritesGrid = document.getElementById('favorites-grid');
    const noFavoritesDefault = document.getElementById('no-favorites-default');

    if (!searchInput || bookCards.length === 0) return;

    function performSearch() {
  const keyword = searchInput.value.toLowerCase().trim();
  let visibleCount = 0;

  noSearchResults?.classList.add('hidden');

  const cards = document.querySelectorAll('.book-card');
  cards.forEach(card => {
    const judul = card.dataset.judul || '';
    const penulis = card.dataset.penulis || '';
    const isMatch = judul.includes(keyword) || penulis.includes(keyword);

    card.style.display = isMatch ? 'flex' : 'none';
    if (isMatch) visibleCount++;
  });

  // Jika sedang search & tidak ada hasil
  if (keyword !== '' && visibleCount === 0) {
    favoritesGrid.style.display = 'none';
    noSearchResults?.classList.remove('hidden');
    noFavoritesDefault?.classList.add('hidden');
    return;
  }

  // Reset ke kondisi normal
  favoritesGrid.style.display = 'grid';

  // Default empty HANYA jika benar-benar kosong
  if (cards.length === 0) {
    noFavoritesDefault?.classList.remove('hidden');
  } else {
    noFavoritesDefault?.classList.add('hidden');
  }
}


    searchInput.addEventListener('input', performSearch);
    searchInput.addEventListener('search', function () {
      if (this.value === '') performSearch();
    });
  }

  function setupFavoriteButtons() {
    // Setup event listener untuk semua tombol favorit
    document.addEventListener('click', function (e) {
      const favoriteBtn = e.target.closest('.favorite-btn');
      if (favoriteBtn) {
        e.preventDefault();
        const bookId = favoriteBtn.getAttribute('data-book-id');
        hapusFavorite(favoriteBtn, bookId);
      }
    });
  }

  // Fungsi untuk menghapus favorit
  async function hapusFavorite(button, bookId) {
    try {
      const result = await Swal.fire({
  title: 'Yakin?',
  text: 'Buku ini akan dihapus dari favorit',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Ya, hapus',
  cancelButtonText: 'Batal',
  confirmButtonColor: '#8CA47E', // hijau
  cancelButtonColor: '#d33',  // merah
  reverseButtons: true
});

if (!result.isConfirmed) return;


      // Ambil CSRF token dari meta tag
      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
        document.querySelector('input[name="_token"]')?.value;

      if (!csrfToken) {
        console.error('CSRF token not found');
        alert('Terjadi kesalahan. Silakan refresh halaman.');
        return;
      }

      // Kirim request DELETE (bukan POST karena menghapus)
      const favoritRoute = button.dataset.favoritRoute;

      const response = await fetch(favoritRoute, {

        method: "POST", // Karena Laravel menggunakan POST untuk toggle
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": csrfToken,
          "Accept": "application/json"
        },
        body: JSON.stringify({
          buku_id: bookId,
          _method: "POST" // Untuk simulasi metode yang sesuai
        })
      });

      await response.json();

      if (response.ok) {
        // Hapus card buku dari DOM
        const bookCard = button.closest('.book-card');
        if (bookCard) {
  bookCard.remove();
}

// 🔥 PANGGIL SETELAH REMOVE, TANPA SYARAT
handleEmptyFavoritesAfterDelete();

showNotification('Buku berhasil dihapus dari favorit', 'success');

      } else {
        throw new Error('Failed to remove favorite');
      }
    } catch (error) {
      console.error('Error:', error);
      showNotification('Gagal menghapus favorit. Silakan coba lagi.', 'error');
    }
  }

  function showNotification(message, type = 'success') {
  Swal.fire({
    icon: type === 'success' ? 'success' : 'error',
    title: message,
    timer: 2000,
    timerProgressBar: true,
    showConfirmButton: false,
    allowOutsideClick: false,
    didOpen: () => {
    }
  });
}




  // Ekspos fungsi ke global scope
  window.hapusFavorite = hapusFavorite;


  // MODAL PDF
  (function () {
  const pdfViewer = document.getElementById("pdfViewer");
  const pdfModal = document.getElementById("pdfModal");
  const zoomInBtn = document.getElementById("zoomIn");
  const zoomOutBtn = document.getElementById("zoomOut");
  const zoomLabel = document.getElementById("zoomLabel");
  const closePdfModal = document.getElementById("closePdfModal");
  const pageCurrent = document.getElementById("pageCurrent");
  const pageTotal = document.getElementById("pageTotal");

  if (!pdfViewer || !pdfModal) return;

  pdfjsLib.GlobalWorkerOptions.workerSrc =
    "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js";

  let pdfDoc = null;
  let zoom = 1;
  let pageCanvases = [];

  const on = (el, ev, fn) => el && el.addEventListener(ev, fn);

  const updateLayout = () => {
    if (!pageCanvases.length) return;
    const isMobile = window.innerWidth <= 1024;
    pdfViewer.style.display = "grid";
    pdfViewer.style.gridTemplateColumns = "1fr";
    pdfViewer.style.gap = "24px";
    pdfViewer.style.padding = "24px";

    if (!isMobile && zoom <= 1.2) {
      const w = pageCanvases[0].canvas.width + 40;
      const c = Math.max(1, Math.floor(pdfViewer.parentElement.clientWidth / w));
      pdfViewer.style.gridTemplateColumns = `repeat(${c}, auto)`;
    }
  };

  const updatePageTracking = () => {
    if (!pageCurrent) return;
    const scrollTop = pdfViewer.scrollTop;
    let currentPage = 1;

    for (const item of pageCanvases) {
      const rect = item.canvas.getBoundingClientRect();
      const viewerRect = pdfViewer.getBoundingClientRect();
      const offsetTop = rect.top - viewerRect.top + pdfViewer.scrollTop;
      if (scrollTop + pdfViewer.clientHeight / 2 >= offsetTop) {
        currentPage = item.page;
      }
    }
    pageCurrent.innerText = currentPage;
  };

  const renderPages = async () => {
  pdfViewer.innerHTML = "";

  const isMobile = window.innerWidth <= 1024;

  for (const item of pageCanvases) {
    const page = await pdfDoc.getPage(item.page);

    let scale = zoom;

    if (isMobile) {
      const viewport1 = page.getViewport({ scale: 1 });
      const fitScale = pdfViewer.clientWidth / viewport1.width;

      if (zoom === 1) {
        // mobile default 100%: muat container
        scale = fitScale;
        pdfViewer.style.overflowX = "hidden"; // disable scroll horizontal
      } else {
        // zoom > 100%: scale sesuai zoom, bisa scroll
        scale = fitScale * zoom;
        pdfViewer.style.overflowX = "auto"; // enable scroll horizontal
      }
    } else {
      pdfViewer.style.overflowX = "auto"; // desktop tetap
    }

    const viewport = page.getViewport({ scale });
    const canvas = item.canvas;
    const ctx = canvas.getContext("2d");

    canvas.width = viewport.width;
    canvas.height = viewport.height;

    await page.render({ canvasContext: ctx, viewport }).promise;

    canvas.style.width = viewport.width + "px";
    canvas.style.height = viewport.height + "px";
    canvas.className = "block mx-auto";

    pdfViewer.appendChild(canvas);
  }

  zoomLabel && (zoomLabel.innerText = Math.round(zoom * 100) + "%");
  pageTotal && (pageTotal.innerText = pdfDoc.numPages);

  updateLayout();
  updatePageTracking();
};


  window.openPdfGlobal = async (url, title = "Preview Dokumen") => {
  const pdfTitle = document.getElementById("pdfTitle");
  if (pdfTitle) {
    pdfTitle.lastChild.textContent = title;
  }

  pdfModal.classList.remove("hidden");
  pdfViewer.innerHTML = "Memuat PDF...";

  const pdf = await pdfjsLib.getDocument(url).promise;
  pdfDoc = pdf;
  zoom = 1;
  pageCanvases = [];

  for (let i = 1; i <= pdf.numPages; i++) {
    const canvas = document.createElement("canvas");
    canvas.dataset.page = i;
    canvas.style.borderRadius = "12px";
    canvas.style.background = "#fff";
    pageCanvases.push({ page: i, canvas });
  }

  await renderPages();
};

  on(closePdfModal, "click", () => {
    pdfModal.classList.add("hidden");
    pdfViewer.innerHTML = "";
    pdfDoc = null;
  });

  on(zoomInBtn, "click", () => {
    zoom < 3 && (zoom += 0.2, renderPages());
  });

  on(zoomOutBtn, "click", () => {
    zoom > 0.4 && (zoom -= 0.2, renderPages());
  });

  on(pdfViewer, "scroll", updatePageTracking);
  on(window, "resize", updateLayout);

  document.querySelectorAll(".open-pdf").forEach(btn => {
  btn.addEventListener("click", (e) => {
    e.stopPropagation();
    const url = btn.dataset.url;
    const title = btn.dataset.title; // dari ADMIN
    if (url) openPdfGlobal(url, title);
  });
});
})();

function handleEmptyFavoritesAfterDelete() {
  const remainingBooks = document.querySelectorAll('.book-card');
  const favoritesGrid = document.getElementById('favorites-grid');
  const noFavoritesDefault = document.getElementById('no-favorites-default');
  const noSearchResults = document.getElementById('no-favorites-search');
  const searchInput = document.getElementById('searchBuku');

  if (remainingBooks.length === 0) {
    favoritesGrid.style.display = 'none';
    noFavoritesDefault?.classList.remove('hidden');
    noSearchResults?.classList.add('hidden');
    return;
  }

  // Kalau masih ada buku → default empty HARUS hidden
  noFavoritesDefault?.classList.add('hidden');

  // Kalau sedang search → trigger ulang search
  if (searchInput && searchInput.value.trim() !== '') {
    searchInput.dispatchEvent(new Event('input'));
  }
}



});