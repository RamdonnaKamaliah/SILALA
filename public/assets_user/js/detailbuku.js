// detailbuku.js
document.addEventListener("DOMContentLoaded", () => {
    // ====== PANAH TITLE ======
    const backBtn = document.getElementById("backBtn");

    if (backBtn) {
        backBtn.addEventListener("click", () => {
            if (
                document.referrer &&
                document.referrer.includes(window.location.hostname)
            ) {
                window.history.back();
            } else {
                window.location.href = backBtn.dataset.backUrl;
            }
        });
    }

    // ====== GLOBAL DATA ======
    const body = document.body;
    const bukuId = body.dataset.bukuId;
    const favoritUrl =
        body.datasetFavoritUrl ||
        body.dataset.favoritUrl ||
        body.getAttribute("data-favorit-url");
    const pinjamUrl =
        body.datasetPinjamUrl ||
        body.dataset.pinjamUrl ||
        body.getAttribute("data-pinjam-url");
    const pinjamRedirect =
        body.datasetPinjamRedirect ||
        body.dataset.pinjamRedirect ||
        body.getAttribute("data-pinjam-redirect");
    const metaCsrf = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = metaCsrf
        ? metaCsrf.getAttribute("content")
        : body.dataset.csrf || body.getAttribute("data-csrf");

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
    (function initFavorit() {
        const loveBtn = document.getElementById("loveBtn");
        const heartIcon = document.getElementById("heartIcon");
        if (!loveBtn || !heartIcon || !favoritUrl) return;

        loveBtn.addEventListener("click", async (e) => {
            e.preventDefault();
            try {
                const { ok, status, json, text } = await fetchJson(favoritUrl, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                        Accept: "application/json",
                    },
                    body: JSON.stringify({ buku_id: bukuId }),
                });

                if (!ok) {
                    if (status === 419)
                        return Swal.fire({
                            icon: "warning",
                            title: "Sesi Habis",
                            text: "Silakan refresh halaman lalu coba lagi.",
                        });
                    console.error("Favorit error:", text || json);
                    return Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Gagal mengubah favorit.",
                    });
                }

                const data = json;
                if (data.favorited) {
                    heartIcon.classList.remove("fa-regular");
                    heartIcon.classList.add("fa-solid", "text-[#E63946]");
                } else {
                    heartIcon.classList.remove("fa-solid", "text-[#E63946]");
                    heartIcon.classList.add("fa-regular");
                }
            } catch (err) {
                console.error("Error toggle favorit:", err);
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Terjadi kesalahan.",
                });
            }
        });
    })();

    // ====== PINJAM ======
    (function initPinjam() {
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
        const formatDate = (d) => d.toISOString().split("T")[0];

        if (tglPinjamInput) tglPinjamInput.value = formatDate(today);
        if (tglKembaliInput) {
            tglKembaliInput.min = formatDate(today);
            tglKembaliInput.max = formatDate(maxDate);
            tglKembaliInput.value = "";
        }

        openPinjamModal.addEventListener("click", (e) => {
            e.preventDefault();
            pinjamModal.classList.remove("hidden");
            if (tglKembaliInput) tglKembaliInput.focus();
        });
        if (closeModalBtn)
            closeModalBtn.addEventListener("click", () =>
                pinjamModal.classList.add("hidden")
            );
        pinjamModal.addEventListener("click", (e) => {
            if (e.target === pinjamModal) pinjamModal.classList.add("hidden");
        });

        konfirmasiBtn.addEventListener("click", async () => {
            const tanggalKembali = tglKembaliInput?.value || "";
            if (!tanggalKembali)
                return Swal.fire({
                    icon: "warning",
                    title: "Peringatan",
                    text: "Tanggal kembali belum diisi",
                });

            const diffDays = Math.ceil(
                (new Date(tanggalKembali) - today) / (1000 * 60 * 60 * 24)
            );
            if (diffDays < 0 || diffDays > 7)
                return Swal.fire({
                    icon: "warning",
                    title: "Peringatan",
                    text: "Maksimal peminjaman 7 hari",
                });

            try {
                konfirmasiBtn.disabled = true;
                konfirmasiBtn.innerHTML =
                    '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';

                const { ok, status, json, text } = await fetchJson(pinjamUrl, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                        Accept: "application/json",
                    },
                    body: JSON.stringify({
                        buku_id: bukuId,
                        tanggal_kembali: tanggalKembali,
                    }),
                });

                if (!ok) {
                    if (status === 419)
                        return Swal.fire({
                            icon: "warning",
                            title: "Sesi Habis",
                            text: "Silakan refresh halaman lalu coba lagi.",
                        });
                    console.error("Pinjam error:", text || json);
                    return Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Anda telah mencapai batas maksimal peminjaman.",
                    });
                }

                const result = json;
                if (result.success) {
                    pinjamModal.classList.add("hidden");
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: result.message,
                        timer: 2000,
                        showConfirmButton: false,
                    }).then(
                        () => (window.location.href = pinjamRedirect || "/")
                    );
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: result.message || "Terjadi kesalahan",
                    });
                }
            } catch (err) {
                console.error("Error pinjam:", err);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Terjadi kesalahan sistem",
                });
            } finally {
                konfirmasiBtn.disabled = false;
                konfirmasiBtn.innerHTML =
                    '<i class="fa-solid fa-check text-[#2E2E2E]"></i> Konfirmasi';
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
            const icon = star.querySelector(".iconify");
            if (index < rating) {
                icon.dataset.icon = "mdi:star"; // ⭐ penuh
            } else {
                icon.dataset.icon = "mdi:star-outline"; // ☆ kosong
            }
        });

        if (permanent) selectedRating = rating;
    }

    function updateNavbar(avgRating, totalRatings) {
        if (!navbar) return;

        let html = "";
        for (let i = 1; i <= 5; i++) {
            if (i <= Math.floor(avgRating)) {
                html += `<span class="iconify text-yellow-500" data-icon="mdi:star"></span>`;
            } else {
                html += `<span class="iconify text-yellow-500" data-icon="mdi:star-outline"></span>`;
            }
        }

        if (totalRatings > 0) {
            html += `<span class="text-xs text-gray-600 ml-2">(${avgRating.toFixed(
                1
            )})</span>`;
        }

        navbar.innerHTML = html;
    }

    // Set awal bintang
    updateStars(initialRating, true);

    if (initialRating > 0) {
        submitRatingBtn.disabled = false;
        submitRatingBtn.classList.remove("opacity-50", "cursor-not-allowed");
    }

    stars.forEach((star) => {
        star.addEventListener("mouseover", () => {
            updateStars(parseInt(star.dataset.star));
        });

        star.addEventListener("click", () => {
            const rating = parseInt(star.dataset.star);
            updateStars(rating, true);

            submitRatingBtn.disabled = false;
            submitRatingBtn.classList.remove(
                "opacity-50",
                "cursor-not-allowed"
            );
        });
    });

    starContainer.addEventListener("mouseleave", () => {
        updateStars(selectedRating, true);
    });

    submitRatingBtn.addEventListener("click", async () => {
        if (selectedRating === 0)
            return Swal.fire({ icon: "warning", title: "Pilih rating dulu!" });

        submitRatingBtn.disabled = true;
        submitRatingBtn.innerHTML =
            '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim...';

        try {
            const res = await fetch(starContainer.dataset.ratingUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": starContainer.dataset.csrf,
                    Accept: "application/json",
                },
                body: JSON.stringify({
                    buku_id: starContainer.dataset.bukuId,
                    rating: selectedRating,
                }),
            });

            const data = await res.json();

            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false,
                });

                if (navbar) {
                    const avgRating = selectedRating;
                    const totalRatings =
                        parseInt(navbar.dataset.totalRatings) || 1;
                    updateNavbar(avgRating, totalRatings);
                }
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: data.message,
                });
            }
        } catch (err) {
            console.error(err);
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Kesalahan sistem",
            });
        } finally {
            submitRatingBtn.disabled = false;
            submitRatingBtn.innerHTML = submitRatingBtn.dataset.defaultText;
        }
    });

    // ====== PDF VIEWER (GLOBAL & SAFE) ======
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
                const c = Math.max(
                    1,
                    Math.floor(pdfViewer.parentElement.clientWidth / w)
                );
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
                const offsetTop =
                    rect.top - viewerRect.top + pdfViewer.scrollTop;
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
            zoom < 3 && ((zoom += 0.2), renderPages());
        });

        on(zoomOutBtn, "click", () => {
            zoom > 0.4 && ((zoom -= 0.2), renderPages());
        });

        on(pdfViewer, "scroll", updatePageTracking);
        on(window, "resize", updateLayout);

        document.querySelectorAll(".open-pdf").forEach((btn) => {
            btn.addEventListener("click", (e) => {
                e.stopPropagation();
                const url = btn.dataset.url;
                const title = btn.dataset.title; // dari ADMIN
                if (url) openPdfGlobal(url, title);
            });
        });
    })();
}); // DOMContentLoaded
