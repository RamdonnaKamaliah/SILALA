// favorit.js
document.addEventListener("DOMContentLoaded", () => {

  setupFavoritesSearch();
  setupFavoriteButtons();

  // ================================
  // 1. FITUR SEARCH
  // ================================
  function setupFavoritesSearch() {
    const searchInput = document.getElementById("searchBuku");
    const bookCards = document.querySelectorAll(".book-card");
    const noSearchResults = document.getElementById("no-favorites-search");
    const favoritesGrid = document.getElementById("favorites-grid");
    const noFavoritesDefault = document.getElementById("no-favorites-default");

    if (!searchInput) return;

    function performSearch() {
      const keyword = searchInput.value.toLowerCase().trim();
      let visibleCount = 0;

      // Reset tampilan
      if (noSearchResults) noSearchResults.classList.add("hidden");
      if (favoritesGrid) favoritesGrid.style.display = "grid";
      if (noFavoritesDefault) noFavoritesDefault.style.display = "none";

      bookCards.forEach((card) => {
        const judul = card.getAttribute("data-judul") || "";
        const penulis = card.getAttribute("data-penulis") || "";
        const isMatch = judul.includes(keyword) || penulis.includes(keyword);

        card.style.display = isMatch ? "flex" : "none";
        if (isMatch) visibleCount++;
      });

      // Tampilkan pesan jika tidak ada hasil
      if (keyword !== "" && visibleCount === 0) {
        noSearchResults?.classList.remove("hidden");
        favoritesGrid.style.display = "none";
      }
    }

    searchInput.addEventListener("input", performSearch);
  }

  // ======================================
  // 2. SETUP ACTION TOMBOL FAVORIT ❤️
  // ======================================
  function setupFavoriteButtons() {
    document.addEventListener("click", (e) => {
      const favoriteBtn = e.target.closest(".favorite-btn");
      if (!favoriteBtn) return;

      e.preventDefault();
      const bookId = favoriteBtn.dataset.bookId;

      hapusFavorite(favoriteBtn, bookId);
    });
  }

  // ======================================
  // 3. HAPUS FAVORIT (SWEETALERT2)
  // ======================================
  async function hapusFavorite(button, bookId) {
    event.stopPropagation();

    // KONFIRMASI SWEETALERT
    const confirmAction = await Swal.fire({
      title: "Hapus dari Favorit?",
      text: "Buku ini akan dihapus dari daftar favorit Anda.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Ya, hapus",
      cancelButtonText: "Batal",
      customClass: { popup: "rounded-2xl" }
    });

    if (!confirmAction.isConfirmed) return;

    try {
      const csrfToken =
        document.querySelector('meta[name="csrf-token"]')?.content ||
        document.querySelector('input[name="_token"]')?.value;

      if (!csrfToken) {
        Swal.fire("Error", "CSRF Token tidak ditemukan.", "error");
        return;
      }

      const response = await fetch(favoritRoute, {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": csrfToken,
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        body: JSON.stringify({
          buku_id: bookId,
          _method: "POST"
        })
      });

      // FIX: backend boleh return apa saja → cukup cek sukses response.ok
      if (!response.ok) {
        throw new Error("Gagal menghapus favorit");
      }

      // ANIMASI HAPUS CARD
      const card = button.closest(".book-card");
      card.classList.add("opacity-0", "scale-90", "transition", "duration-300");
      setTimeout(() => card.remove(), 250);

      // CEK SISA BUKU
      setTimeout(() => {
        const remainingCards = document.querySelectorAll(".book-card");
        const favoritesGrid = document.getElementById("favorites-grid");
        const noFavoritesDefault = document.getElementById("no-favorites-default");

        if (remainingCards.length === 0) {
          favoritesGrid.style.display = "none";
          noFavoritesDefault.classList.remove("hidden");
        }
      }, 300);

      // SWEETALERT SUKSES
      Swal.fire({
        title: "Berhasil!",
        text: "Buku telah dihapus dari favorit.",
        icon: "success",
        confirmButtonColor: "#4C6444",
        customClass: { popup: "rounded-2xl" }
      });

    } catch (error) {
      Swal.fire("Error", "Terjadi kesalahan. Coba lagi nanti.", "error");
      console.error(error);
    }
  }

  // Expose global
  window.hapusFavorite = hapusFavorite;

});

//MODAL PDF
(function initPdfViewer() {
    const pdfViewer = document.getElementById("pdfViewer");
    const pdfModal = document.getElementById("pdfModal");
    const zoomInBtn = document.getElementById("zoomIn");
    const zoomOutBtn = document.getElementById("zoomOut");
    const zoomLabel = document.getElementById("zoomLabel");
    const closePdfModal = document.getElementById("closePdfModal");
    document.querySelectorAll(".open-pdf").forEach(btn => {
    btn.addEventListener("click", () => {
      const url = btn.dataset.url;
      if (!url) {
        return Swal.fire({
          icon: "warning",
          title: "Error",
          text: "URL PDF tidak ditemukan",
        });
      }

      pdfModal.classList.remove("hidden");
      openPdf(url);
    });
  });
  
    const pageCurrent = document.getElementById("pageCurrent");
    const pageTotal = document.getElementById("pageTotal");

    if (!pdfViewer || !pdfModal) return;

    pdfjsLib.GlobalWorkerOptions.workerSrc =
        "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js";

    let pdfDoc = null;
    let totalPages = 0;
    let zoom = 1.0;
    let pageCanvases = [];
    let observer = null;

    /* =========================================================
       AUTO LAYOUT (GOOGLE DOCS STYLE)
    ========================================================== */
    const updateLayout = () => {
        if (!pageCanvases.length) return;

        const isMobile = window.innerWidth <= 1024;
        let cols = 1;

        if (isMobile) {
            // MOBILE → Selalu 1 kolom
            cols = 1;
            pdfViewer.style.justifyContent = "center";
        } else {
            // DESKTOP
            if (zoom > 1.2) {
                cols = 1;
                pdfViewer.style.justifyContent = "start";
            } else {
                const firstCanvas = pageCanvases[0].canvas;
                const pageWidth = firstCanvas.width + 40;
                const containerWidth = pdfViewer.parentElement.clientWidth;

                cols = Math.max(1, Math.floor(containerWidth / pageWidth));
                pdfViewer.style.justifyContent = "center";
            }
        }

        pdfViewer.style.display = "grid";
        pdfViewer.style.gridTemplateColumns = `repeat(${cols}, auto)`;
        pdfViewer.style.gap = "24px";
        pdfViewer.style.padding = "24px";
    };

    /* =========================================================
       PAGE TRACKING LIKE GOOGLE VIEWER
    ========================================================== */
    const activatePageTracking = () => {
        if (observer) observer.disconnect();

        observer = new IntersectionObserver(
            (entries) => {
                let maxRatio = 0;
                let visiblePage = 1;

                entries.forEach((entry) => {
                    if (entry.intersectionRatio > maxRatio) {
                        maxRatio = entry.intersectionRatio;
                        visiblePage = parseInt(entry.target.dataset.page);
                    }
                });

                pageCurrent.innerText = visiblePage;
            },
            {
                root: pdfViewer,
                threshold: Array.from({ length: 101 }, (_, i) => i / 100)
            }
        );

        pageCanvases.forEach((item) => observer.observe(item.canvas));
    };

    /* =========================================================
       RENDER SEMUA HALAMAN (UNTUK ZOOM)
    ========================================================== */
    const renderPages = async () => {
        if (!pdfDoc) return;

        const isMobile = window.innerWidth <= 1024;
        pdfViewer.innerHTML = "";

        for (let item of pageCanvases) {
            try {
                const page = await pdfDoc.getPage(item.pageNumber);
                const viewport = page.getViewport({ scale: zoom });
                const canvas = item.canvas;
                const ctx = canvas.getContext("2d");

                canvas.width = viewport.width;
                canvas.height = viewport.height;

                ctx.clearRect(0, 0, canvas.width, canvas.height);
                await page.render({ canvasContext: ctx, viewport }).promise;

                /* ====== FIX MOBILE RESPONSIVE + ZOOM WORK ====== */
                if (isMobile) {
                    if (zoom <= 1) {
                        // DEFAULT mobile → full width terpampang
                        canvas.style.width = "100%";
                        canvas.style.height = "auto";
                        canvas.style.maxWidth = "100%";
                        canvas.style.margin = "0 auto";
                    } else {
                        // AFTER zoom → biarkan ukuran asli dan bisa digeser
                        canvas.style.width = "auto";
                        canvas.style.height = "auto";
                        canvas.style.maxWidth = "none";
                        canvas.style.margin = "0 auto";
                    }
                } else {
                    // DESKTOP → tidak berubah sama sekali
                    canvas.style.width = "auto";
                    canvas.style.height = "auto";
                    canvas.style.maxWidth = "none";
                }

                pdfViewer.appendChild(canvas);
            } catch (err) {
                console.error("Render gagal:", err);
            }
        }

        zoomLabel.innerText = Math.round(zoom * 100) + "%";
        pageTotal.innerText = totalPages;

        updateLayout();
        activatePageTracking();

        pdfViewer.scrollLeft = 0;
        pdfViewer.scrollTop = 0;
    };

    /* =========================================================
       BUKA PDF
    ========================================================== */
    const openPdf = async (url) => {
        try {
            pdfViewer.innerHTML =
                "<p class='text-center mt-6 text-gray-500'>Memuat PDF...</p>";

            const pdf = await pdfjsLib.getDocument(url).promise;
            pdfDoc = pdf;
            totalPages = pdf.numPages;
            zoom = 1.0;
            pageCanvases = [];

            for (let i = 1; i <= totalPages; i++) {
                const canvas = document.createElement("canvas");
                canvas.dataset.page = i;
                canvas.style.display = "block";
                canvas.style.border = "1px solid #ddd";
                canvas.style.borderRadius = "12px";
                canvas.style.background = "white";
                canvas.style.boxShadow = "0 2px 8px rgba(0,0,0,0.08)";
                pageCanvases.push({ pageNumber: i, canvas });
            }

            await renderPages();
        } catch (err) {
            pdfViewer.innerHTML =
                `<p class="text-center text-red-500 mt-6">Gagal memuat PDF: ${err.message}</p>`;
            console.error("PDF load error:", err);
        }
    };

    /* =========================================================
       EVENT LISTENERS
    ========================================================== */
    openPdfBtn.addEventListener("click", () => {
        const url = openPdfBtn.dataset.url;
        if (!url)
            return Swal.fire({
                icon: "warning",
                title: "Error",
                text: "URL PDF tidak ditemukan",
            });

        pdfModal.classList.remove("hidden");
        openPdf(url);
    });

    closePdfModal.addEventListener("click", () => {
        pdfModal.classList.add("hidden");
        pdfViewer.innerHTML = "";
        pdfDoc = null;
        zoom = 1;
        totalPages = 0;
        pageCurrent.innerText = "1";
        pageTotal.innerText = "0";
    });

    zoomInBtn.addEventListener("click", () => {
        if (zoom < 3) {
            zoom = +(zoom + 0.2).toFixed(2);
            renderPages();
        }
    });

    zoomOutBtn.addEventListener("click", () => {
        if (zoom > 0.4) {
            zoom = +(zoom - 0.2).toFixed(2);
            renderPages();
        }
    });

    window.addEventListener("resize", updateLayout);

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") closePdfModal.click();
    });
})();
