// favorit.js
document.addEventListener('DOMContentLoaded', function() {
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
      
      // Reset tampilan
      if (noSearchResults) noSearchResults.classList.add('hidden');
      if (favoritesGrid) favoritesGrid.style.display = 'grid';
      if (noFavoritesDefault) noFavoritesDefault.style.display = 'block';
      
      // Filter cards berdasarkan keyword
      bookCards.forEach(card => {
        const judul = card.getAttribute('data-judul') || '';
        const penulis = card.getAttribute('data-penulis') || '';
        const isMatch = judul.includes(keyword) || penulis.includes(keyword);
        
        if (isMatch) {
          card.style.display = 'flex';
          visibleCount++;
        } else {
          card.style.display = 'none';
        }
      });
      
      // Tampilkan pesan jika tidak ada hasil pencarian
      if (keyword !== '' && visibleCount === 0) {
        if (noSearchResults) {
          noSearchResults.classList.remove('hidden');
        }
        if (favoritesGrid) {
          favoritesGrid.style.display = 'none';
        }
        if (noFavoritesDefault) {
          noFavoritesDefault.style.display = 'none';
        }
      }
    }
    
    searchInput.addEventListener('input', performSearch);
    searchInput.addEventListener('search', function() {
      if (this.value === '') performSearch();
    });
  }
  
  function setupFavoriteButtons() {
    // Setup event listener untuk semua tombol favorit
    document.addEventListener('click', function(e) {
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
      // Tampilkan konfirmasi
      if (!confirm('Yakin ingin menghapus buku ini dari favorit?')) {
        return;
      }
      
      // Ambil CSRF token dari meta tag
      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                       document.querySelector('input[name="_token"]')?.value;
      
      if (!csrfToken) {
        console.error('CSRF token not found');
        alert('Terjadi kesalahan. Silakan refresh halaman.');
        return;
      }
      
      // Kirim request DELETE (bukan POST karena menghapus)
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
      
      const result = await response.json();
      
      if (response.ok) {
        // Hapus card buku dari DOM
        const bookCard = button.closest('.book-card');
        if (bookCard) {
          bookCard.remove();
          
          // Cek apakah masih ada buku favorit
          const remainingBooks = document.querySelectorAll('.book-card');
          const favoritesGrid = document.getElementById('favorites-grid');
          const noFavoritesDefault = document.getElementById('no-favorites-default');
          
          // Jika tidak ada buku favorit lagi
          if (remainingBooks.length === 0) {
            if (favoritesGrid) {
              favoritesGrid.style.display = 'none';
            }
            if (noFavoritesDefault) {
              noFavoritesDefault.classList.remove('hidden');
              noFavoritesDefault.style.display = 'block';
            }
          }
          
          // Tampilkan pesan sukses
          showNotification('Buku berhasil dihapus dari favorit', 'success');
        }
      } else {
        throw new Error('Failed to remove favorite');
      }
    } catch (error) {
      console.error('Error:', error);
      showNotification('Gagal menghapus favorit. Silakan coba lagi.', 'error');
    }
  }
  
  // Fungsi untuk menampilkan notifikasi
  function showNotification(message, type = 'success') {
    // Hapus notifikasi lama jika ada
    const oldNotification = document.querySelector('.custom-notification');
    if (oldNotification) {
      oldNotification.remove();
    }
    
    // Buat notifikasi baru
    const notification = document.createElement('div');
    notification.className = `custom-notification fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 ${
      type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    notification.textContent = message;
    notification.style.opacity = '0';
    notification.style.transform = 'translateY(-20px)';
    
    document.body.appendChild(notification);
    
    // Animasikan masuk
    setTimeout(() => {
      notification.style.opacity = '1';
      notification.style.transform = 'translateY(0)';
    }, 10);
    
    // Hapus otomatis setelah 3 detik
    setTimeout(() => {
      notification.style.opacity = '0';
      notification.style.transform = 'translateY(-20px)';
      setTimeout(() => {
        if (notification.parentNode) {
          notification.remove();
        }
      }, 300);
    }, 3000);
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
    for (const item of pageCanvases) {
      const page = await pdfDoc.getPage(item.page);
      const viewport = page.getViewport({ scale: zoom });
      const canvas = item.canvas;
      const ctx = canvas.getContext("2d");

      canvas.width = viewport.width;
      canvas.height = viewport.height;

      await page.render({ canvasContext: ctx, viewport }).promise;

      if (zoom <= 1) {
      canvas.className = "w-full max-w-full mx-auto block";
    } else {
      canvas.className = "block mx-auto";
      canvas.style.width = viewport.width + "px";
    }

      pdfViewer.appendChild(canvas);
    }

    zoomLabel && (zoomLabel.innerText = Math.round(zoom * 100) + "%");
    pageTotal && (pageTotal.innerText = pdfDoc.numPages);

    updateLayout();
    updatePageTracking();
  };

  window.openPdfGlobal = async (url) => {
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
      const url = btn.getAttribute("data-url");
      url && openPdfGlobal(url);
    });
  });
})();
});