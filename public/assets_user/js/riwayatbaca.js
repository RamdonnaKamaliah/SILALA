document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-riwayat');
    const riwayatCards = document.querySelectorAll('.riwayat-card');
    const noSearchResults = document.getElementById('no-search-results');
    const noRiwayatDefault = document.querySelector('.no-riwayat-default');

    if (searchInput && riwayatCards.length > 0) {
        searchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase().trim();
            let visibleCount = 0;

            // Sembunyikan pesan tidak ada hasil pencarian terlebih dahulu
            if (noSearchResults) {
                noSearchResults.classList.add('hidden');
            }

            // Jika ada tampilan default saat tidak ada riwayat, sembunyikan
            if (noRiwayatDefault) {
                noRiwayatDefault.classList.add('hidden');
            }

            // Cari dan hitung card yang sesuai
            riwayatCards.forEach(card => {
                const judul = card.getAttribute('data-judul') || '';
                const penulis = card.getAttribute('data-penulis') || '';
                const isMatch = judul.includes(searchTerm) || penulis.includes(searchTerm);

                if (isMatch) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Tampilkan pesan jika tidak ada hasil yang cocok
            if (searchTerm !== '' && visibleCount === 0 && noSearchResults) {
                noSearchResults.classList.remove('hidden');
            }

            // Tampilkan kembali pesan default jika pencarian dikosongkan
            if (searchTerm === '' && riwayatCards.length === 0 && noRiwayatDefault) {
                noRiwayatDefault.classList.remove('hidden');
            }
        });

        // Reset saat halaman dimuat ulang
        searchInput.addEventListener('search', function () {
            if (this.value === '') {
                riwayatCards.forEach(card => {
                    card.style.display = 'block';
                });

                if (noSearchResults) {
                    noSearchResults.classList.add('hidden');
                }

                if (riwayatCards.length === 0 && noRiwayatDefault) {
                    noRiwayatDefault.classList.remove('hidden');
                }
            });
            
            // Reset saat halaman dimuat ulang
            searchInput.addEventListener('search', function() {
                if (this.value === '') {
                    riwayatCards.forEach(card => {
                        card.style.display = 'block';
                    });
                    
                    if (noSearchResults) {
                        noSearchResults.classList.add('hidden');
                    }
                    
                    if (riwayatCards.length === 0 && noRiwayatDefault) {
                        noRiwayatDefault.classList.remove('hidden');
                    }
                }
            });
        }
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
    });
            
