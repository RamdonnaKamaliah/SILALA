document.addEventListener("DOMContentLoaded", () => {
  // ====== GLOBAL DATA ======
  const body = document.body;
  const bukuId = body.dataset.bukuId;
  const csrfToken = body.dataset.csrf;
  const favoritUrl = body.dataset.favoritUrl;
  const pinjamUrl = body.dataset.pinjamUrl;
  const pinjamRedirect = body.dataset.pinjamRedirect;

  // ====== FAVORIT ======
  const loveBtn = document.getElementById('loveBtn');
  const heartIcon = document.getElementById('heartIcon');

  if (loveBtn && heartIcon) {
    loveBtn.addEventListener('click', async () => {
      try {
        const res = await fetch(favoritUrl, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
          },
          body: JSON.stringify({ buku_id: bukuId })
        });

        const data = await res.json();
        if (data.favorited) {
          heartIcon.classList.remove('fa-regular');
          heartIcon.classList.add('fa-solid', 'text-[#E63946]');
        } else {
          heartIcon.classList.remove('fa-solid', 'text-[#E63946]');
          heartIcon.classList.add('fa-regular');
        }
      } catch (err) {
        console.error("Error toggle favorit:", err);
      }
    });
  }

  // ====== PINJAM ======
  const openPinjamModal = document.getElementById("openPinjamModal");
  const pinjamModal = document.getElementById("pinjamModal");
  const closeModalBtn = document.getElementById("closeModalBtn");
  const tglPinjamInput = document.getElementById("tglPinjamInput");
  const tglKembaliInput = document.getElementById("tglKembaliInput");
  const konfirmasiBtn = document.getElementById("konfirmasiPinjam");

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

  if (openPinjamModal && pinjamModal) {
    openPinjamModal.addEventListener("click", () => pinjamModal.classList.remove("hidden"));
  }
  if (closeModalBtn && pinjamModal) {
    closeModalBtn.addEventListener("click", () => pinjamModal.classList.add("hidden"));
  }
  if (pinjamModal) {
    pinjamModal.addEventListener("click", e => {
      if (e.target === pinjamModal) pinjamModal.classList.add("hidden");
    });
  }

  if (konfirmasiBtn && tglKembaliInput) {
    konfirmasiBtn.addEventListener("click", async () => {
      const tanggalKembali = tglKembaliInput.value;
      if (!tanggalKembali) return Swal.fire({ icon: "warning", title: "Peringatan", text: "Tanggal kembali belum diisi" });

      const diffDays = Math.ceil((new Date(tanggalKembali) - today) / (1000*60*60*24));
      if (diffDays < 0 || diffDays > 7) return Swal.fire({ icon: "warning", title: "Peringatan", text: "Maksimal peminjaman 7 hari" });

      try {
        konfirmasiBtn.disabled = true;
        konfirmasiBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';

        const res = await fetch(pinjamUrl, {
          method: "POST",
          headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": csrfToken, "Accept": "application/json" },
          body: JSON.stringify({ buku_id: bukuId, tanggal_kembali: tanggalKembali })
        });

        const result = await res.json();

        if (result.success) {
          pinjamModal.classList.add("hidden");
          Swal.fire({ icon: "success", title: "Berhasil!", text: result.message, timer: 2000, showConfirmButton: false })
            .then(() => window.location.href = pinjamRedirect);
        } else {
          Swal.fire({ icon: "error", title: "Gagal", text: result.message || "Terjadi kesalahan" });
        }

      } catch (err) {
        console.error(err);
        Swal.fire({ icon: "error", title: "Error", text: "Terjadi kesalahan sistem" });
      } finally {
        konfirmasiBtn.disabled = false;
        konfirmasiBtn.innerHTML = '<i class="fa-solid fa-check text-[#2E2E2E]"></i> Konfirmasi';
      }
    });
  }

  // ====== RATING ======
  const starContainer = document.getElementById("starContainer");
  const submitRatingBtn = document.getElementById("submitRating");

  if (starContainer && submitRatingBtn) {
    const stars = starContainer.querySelectorAll(".rating-star");
    let selectedRating = parseInt(starContainer.dataset.userRating) || 0;

    function updateStars(rating) {
      stars.forEach((star, index) => {
        if (index < rating) {
          star.classList.remove("fa-regular", "text-[#d5ccb8]");
          star.classList.add("fa-solid", "text-yellow-500");
        } else {
          star.classList.remove("fa-solid", "text-yellow-500");
          star.classList.add("fa-regular", "text-[#d5ccb8]");
        }
      });
    }

    updateStars(selectedRating);

    stars.forEach(star => {
      const rating = parseInt(star.dataset.star);
      star.addEventListener("mouseover", () => updateStars(rating));
      star.addEventListener("click", () => {
        selectedRating = rating;
        updateStars(selectedRating);
        submitRatingBtn.disabled = false;
        submitRatingBtn.classList.remove("opacity-50", "cursor-not-allowed");
      });
    });

    starContainer.addEventListener("mouseleave", () => updateStars(selectedRating));

    submitRatingBtn.addEventListener("click", async () => {
      if (selectedRating === 0) {
        return Swal.fire({ icon: "warning", title: "Peringatan", text: "Pilih rating terlebih dahulu!" });
      }

      try {
        submitRatingBtn.disabled = true;
        submitRatingBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim...';

        const res = await fetch("/user/rating", { // sesuaikan route
          method: "POST",
          headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": csrfToken, "Accept": "application/json" },
          body: JSON.stringify({ buku_id: bukuId, rating: selectedRating })
        });

        const data = await res.json();

        if (data.success) {
          Swal.fire({ icon: "success", title: "Berhasil!", text: data.message, timer: 2000, showConfirmButton: false })
            .then(() => location.reload());
        } else {
          Swal.fire({ icon: "error", title: "Gagal", text: data.message });
        }

      } catch (err) {
        console.error(err);
        Swal.fire({ icon: "error", title: "Error", text: "Terjadi kesalahan sistem" });
      } finally {
        submitRatingBtn.disabled = false;
        submitRatingBtn.innerText = "Kirim Rating";
      }
    });
  }

  // ====== PDF VIEWER ======
  const pdfViewer = document.getElementById("pdfViewer");
  const pdfModal = document.getElementById("pdfModal");
  const zoomInBtn = document.getElementById("zoomIn");
  const zoomOutBtn = document.getElementById("zoomOut");
  const zoomLabel = document.getElementById("zoomLabel");
  const pageCurrent = document.getElementById("pageCurrent");
  const pageTotal = document.getElementById("pageTotal");
  const closePdfModal = document.getElementById("closePdfModal");

  let pdfDoc = null, currentPage = 1, zoom = 1.0;

  const openPdf = (url) => {
    pdfjsLib.getDocument(url).promise.then(pdf => {
      pdfDoc = pdf;
      pageTotal.textContent = pdf.numPages;
      currentPage = 1;
      renderPage(currentPage);
    });
  };

  const renderPage = pageNum => {
    pdfDoc.getPage(pageNum).then(page => {
      const viewport = page.getViewport({ scale: zoom });
      const canvas = document.createElement("canvas");
      const context = canvas.getContext("2d");
      canvas.height = viewport.height;
      canvas.width = viewport.width;
      pdfViewer.innerHTML = "";
      pdfViewer.appendChild(canvas);
      page.render({ canvasContext: context, viewport });
      pageCurrent.textContent = pageNum;
    });
  };

  document.getElementById("openPdfModal")?.addEventListener("click", e => {
    const url = e.currentTarget.dataset.url;
    pdfModal.classList.remove("hidden");
    openPdf(url);
  });

  closePdfModal?.addEventListener("click", () => pdfModal.classList.add("hidden"));
  zoomInBtn?.addEventListener("click", () => { zoom += 0.1; renderPage(currentPage); zoomLabel.textContent = `${Math.round(zoom*100)}%`; });
  zoomOutBtn?.addEventListener("click", () => { zoom -= 0.1; renderPage(currentPage); zoomLabel.textContent = `${Math.round(zoom*100)}%`; });
});

