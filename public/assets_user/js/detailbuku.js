// detailbuku.js
document.addEventListener("DOMContentLoaded", () => {
  // ====== GLOBAL DATA ======
  const body = document.body;
  const bukuId = body.dataset.bukuId;
  const favoritUrl = body.datasetFavoritUrl || body.dataset.favoritUrl || body.getAttribute('data-favorit-url');
  const pinjamUrl = body.datasetPinjamUrl || body.dataset.pinjamUrl || body.getAttribute('data-pinjam-url');
  const pinjamRedirect = body.datasetPinjamRedirect || body.dataset.pinjamRedirect || body.getAttribute('data-pinjam-redirect');
  const metaCsrf = document.querySelector('meta[name="csrf-token"]');
  const csrfToken = metaCsrf ? metaCsrf.getAttribute('content') : (body.dataset.csrf || body.getAttribute('data-csrf'));

  // safety: helper untuk fetch JSON dengan handling 419/HTML responses
  async function fetchJson(url, options = {}) {
    const res = await fetch(url, options);
    const text = await res.text();
    try {
      return { ok: res.ok, status: res.status, json: JSON.parse(text) };
    } catch (err) {
      // bukan JSON (mis. HTML error page)
      return { ok: res.ok, status: res.status, text };
    }
  }

  // ====== FAVORIT ======
  (function initFavorit(){
    const loveBtn = document.getElementById('loveBtn');
    const heartIcon = document.getElementById('heartIcon');
    if (!loveBtn || !heartIcon || !favoritUrl) return;

    loveBtn.addEventListener('click', async (e) => {
      e.preventDefault();
      try {
        const { ok, status, json, text } = await fetchJson(favoritUrl, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          body: JSON.stringify({ buku_id: bukuId })
        });

        if (!ok) {
          if (status === 419) return Swal.fire({ icon: 'warning', title: 'Sesi Habis', text: 'Silakan refresh halaman lalu coba lagi.'});
          console.error('Favorit error:', text || json);
          return Swal.fire({ icon: 'error', title: 'Gagal', text: 'Gagal mengubah favorit.'});
        }

        const data = json;
        if (data.favorited) {
          heartIcon.classList.remove('fa-regular');
          heartIcon.classList.add('fa-solid', 'text-[#E63946]');
        } else {
          heartIcon.classList.remove('fa-solid', 'text-[#E63946]');
          heartIcon.classList.add('fa-regular');
        }
      } catch (err) {
        console.error('Error toggle favorit:', err);
        Swal.fire({ icon: 'error', title: 'Gagal', text: 'Terjadi kesalahan.'});
      }
    });
  })();

  // ====== PINJAM ======
  (function initPinjam(){
    const openPinjamModal = document.getElementById("openPinjamModal");
    const pinjamModal = document.getElementById("pinjamModal");
    const closeModalBtn = document.getElementById("closeModalBtn");
    const tglPinjamInput = document.getElementById("tglPinjamInput");
    const tglKembaliInput = document.getElementById("tglKembaliInput");
    const konfirmasiBtn = document.getElementById("konfirmasiPinjam");
    if (!openPinjamModal || !pinjamModal || !konfirmasiBtn) return;

    const now = new Date();
    const today = new Date(now.getTime() - now.getTimezoneOffset() * 60000);
    const maxDate = new Date(today);
    maxDate.setDate(today.getDate() + 7);
    const formatDate = d => d.toISOString().split("T")[0];

    if (tglPinjamInput) tglPinjamInput.value = formatDate(today);
    if (tglKembaliInput) {
      tglKembaliInput.min = formatDate(today);
      tglKembaliInput.max = formatDate(maxDate);
      tglKembaliInput.value = '';
    }

    openPinjamModal.addEventListener('click', (e) => {
      e.preventDefault();
      pinjamModal.classList.remove('hidden');
      if (tglKembaliInput) tglKembaliInput.focus();
    });
    if (closeModalBtn) closeModalBtn.addEventListener('click', () => pinjamModal.classList.add('hidden'));
    pinjamModal.addEventListener('click', e => { if (e.target === pinjamModal) pinjamModal.classList.add('hidden'); });

    konfirmasiBtn.addEventListener('click', async () => {
      const tanggalKembali = tglKembaliInput?.value || '';
      if (!tanggalKembali) return Swal.fire({ icon:'warning', title:'Peringatan', text:'Tanggal kembali belum diisi'});

      const diffDays = Math.ceil((new Date(tanggalKembali) - today) / (1000*60*60*24));
      if (diffDays < 0 || diffDays > 7) return Swal.fire({ icon:'warning', title:'Peringatan', text:'Maksimal peminjaman 7 hari'});

      try {
        konfirmasiBtn.disabled = true;
        konfirmasiBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';

        const { ok, status, json, text } = await fetchJson(pinjamUrl, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          body: JSON.stringify({ buku_id: bukuId, tanggal_kembali: tanggalKembali })
        });

        if (!ok) {
          if (status === 419) return Swal.fire({ icon:'warning', title:'Sesi Habis', text:'Silakan refresh halaman lalu coba lagi.'});
          console.error('Pinjam error:', text || json);
          return Swal.fire({ icon:'error', title:'Gagal', text:'Terjadi kesalahan saat meminjam buku' });
        }

        const result = json;
        if (result.success) {
          pinjamModal.classList.add('hidden');
          Swal.fire({ icon:'success', title:'Berhasil!', text: result.message, timer:2000, showConfirmButton:false })
            .then(() => window.location.href = pinjamRedirect || '/');
        } else {
          Swal.fire({ icon:'error', title:'Gagal', text: result.message || 'Terjadi kesalahan' });
        }
      } catch (err) {
        console.error('Error pinjam:', err);
        Swal.fire({ icon:'error', title:'Error', text:'Terjadi kesalahan sistem' });
      } finally {
        konfirmasiBtn.disabled = false;
        konfirmasiBtn.innerHTML = '<i class="fa-solid fa-check text-[#2E2E2E]"></i> Konfirmasi';
      }
    });
  })();

  // ====== RATING ======
    const starContainer = document.getElementById("starContainer");
    const submitRatingBtn = document.getElementById("submitRating");
    const navbar = document.querySelector(".navbar-rating");

    if (!starContainer || !submitRatingBtn) return;

    const initialRating = parseInt(starContainer.dataset.userRating) || 0;
    const stars = starContainer.querySelectorAll(".rating-star");
    let selectedRating = initialRating;

    function updateStars(rating, permanent = false) {
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('fa-regular', 'text-[#d5ccb8]');
                star.classList.add('fa-solid', 'text-yellow-500');
            } else {
                star.classList.remove('fa-solid', 'text-yellow-500');
                star.classList.add('fa-regular', 'text-[#d5ccb8]');
            }
        });
        if (permanent) selectedRating = rating;
    }

    function updateNavbar(avgRating, totalRatings) {
        if (!navbar) return;
        let html = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= Math.floor(avgRating)) html += '<i class="fa-solid fa-star"></i>';
            else if (i - 0.5 <= avgRating) html += '<i class="fa-solid fa-star-half-stroke"></i>';
            else html += '<i class="fa-regular fa-star"></i>';
        }
        if (totalRatings > 0) html += `<span class="text-xs text-gray-600 ml-2">(${avgRating.toFixed(1)})</span>`;
        navbar.innerHTML = html;
    }

    // Set awal bintang dan tombol
    updateStars(initialRating, true);
    if (initialRating > 0) {
        submitRatingBtn.disabled = false;
        submitRatingBtn.classList.remove('opacity-50', 'cursor-not-allowed');
    }

    stars.forEach(star => {
        star.addEventListener("mouseover", () => updateStars(parseInt(star.dataset.star)));
        star.addEventListener("click", () => {
            const rating = parseInt(star.dataset.star);
            updateStars(rating, true);
            submitRatingBtn.disabled = false;
            submitRatingBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        });
    });

    starContainer.addEventListener("mouseleave", () => updateStars(selectedRating, true));

    submitRatingBtn.addEventListener("click", async () => {
        if (selectedRating === 0) return Swal.fire({ icon: "warning", title: "Pilih rating dulu!" });

        submitRatingBtn.disabled = true;
        submitRatingBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim...';

        try {
            const res = await fetch(starContainer.dataset.ratingUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": starContainer.dataset.csrf,
                    "Accept": "application/json"
                },
                body: JSON.stringify({ buku_id: starContainer.dataset.bukuId, rating: selectedRating })
            });

            const data = await res.json();

            if (data.success) {
                Swal.fire({ icon: "success", title: "Berhasil!", text: data.message, timer: 1500, showConfirmButton: false });
                
                // Update navbar live jika ada
                if (navbar) {
                    const avgRating = selectedRating; // sementara ambil rating user sebagai avg
                    const totalRatings = parseInt(navbar.dataset.totalRatings) || 1;
                    updateNavbar(avgRating, totalRatings);
                }
            } else {
                Swal.fire({ icon: "error", title: "Gagal", text: data.message });
            }
        } catch (err) {
            console.error(err);
            Swal.fire({ icon: "error", title: "Error", text: "Kesalahan sistem" });
        } finally {
            submitRatingBtn.disabled = false;
            submitRatingBtn.innerHTML = submitRatingBtn.dataset.defaultText || "Kirim Rating";
        }
    });

  // ====== PDF VIEWER (multi-page, stable) ======
  (function initPdfViewer() {
    const pdfViewer = document.getElementById("pdfViewer");
    const pdfModal = document.getElementById("pdfModal");
    const zoomInBtn = document.getElementById("zoomIn");
    const zoomOutBtn = document.getElementById("zoomOut");
    const zoomLabel = document.getElementById("zoomLabel");
    const closePdfModal = document.getElementById("closePdfModal");
    const openPdfBtn = document.getElementById("openPdfModal");
    const pageCurrent = document.getElementById("pageCurrent");
    const pageTotal = document.getElementById("pageTotal");

    if (!pdfViewer || !pdfModal || !openPdfBtn) return;

    pdfjsLib.GlobalWorkerOptions.workerSrc =
        "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js";

    let pdfDoc = null;
    let totalPages = 0;
    let zoom = 1.0;
    let pageCanvases = [];
    let observer = null;

    /* =========================================================
       AUTO MULTI-COLUMN LIKE GOOGLE DOCS
    ========================================================== */
    const updateLayout = () => {
    if (!pageCanvases.length) return;

    const firstCanvas = pageCanvases[0].canvas;
    const pageWidth = firstCanvas.width + 40;
    const containerWidth = pdfViewer.clientWidth;

    // Kalau zoom > 1.2, pakai 1 kolom supaya scroll horizontal muncul
    const cols = zoom > 1.2 ? 1 : Math.max(1, Math.floor(containerWidth / pageWidth));

    pdfViewer.style.display = "grid";
    pdfViewer.style.gridTemplateColumns = `repeat(${cols}, auto)`;
    
    // Jika zoom > 1.2, scroll horizontal aktif (justify start)
    // Jika zoom <= 1.2, tetap di tengah (justify center)
    pdfViewer.style.justifyContent = zoom > 1.2 ? "start" : "center";

    pdfViewer.style.gap = "24px";
    pdfViewer.style.padding = "24px";
};

    /* =========================================================
       PAGE TRACKING SAAT SCROLL (LIKE GOOGLE PDF VIEWER)
    ========================================================== */
    const activatePageTracking = () => {
    if (observer) observer.disconnect();

    observer = new IntersectionObserver(
        (entries) => {
            // Pilih entry yang paling terlihat
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
            root: pdfViewer,       // scroll container
            threshold: Array.from({ length: 101 }, (_, i) => i / 100) // 0, 0.01, ..., 1
        }
    );

    pageCanvases.forEach((item) => observer.observe(item.canvas));
};


    /* =========================================================
       RENDER SEMUA HALAMAN (DIPAKAI UNTUK ZOOM)
    ========================================================== */
   const renderPages = async () => {
    if (!pdfDoc) return;

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

            pdfViewer.appendChild(canvas);
        } catch (err) {
            console.error("Render gagal:", err);
        }
    }

    zoomLabel.innerText = Math.round(zoom * 100) + "%";
    pageTotal.innerText = totalPages;

    updateLayout();
    activatePageTracking();

    // 🔹 posisi scroll awal ke kiri atas
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
                canvas.dataset.page = i;              // WAJIB untuk tracking
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
}); // DOMContentLoaded
