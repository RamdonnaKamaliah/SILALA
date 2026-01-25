document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search-riwayat");
    const riwayatCards = document.querySelectorAll(".riwayat-card");
    const noSearchResults = document.getElementById("no-search-results");
    const noRiwayatDefault = document.querySelector(".no-riwayat-default");

    if (searchInput && riwayatCards.length > 0) {
        searchInput.addEventListener("input", function () {
            const searchTerm = this.value.toLowerCase().trim();
            let visibleCount = 0;

            // Sembunyikan pesan tidak ada hasil pencarian terlebih dahulu
            if (noSearchResults) {
                noSearchResults.classList.add("hidden");
            }

            // Jika ada tampilan default saat tidak ada riwayat, sembunyikan
            if (noRiwayatDefault) {
                noRiwayatDefault.classList.add("hidden");
            }

            // Cari dan hitung card yang sesuai
            riwayatCards.forEach((card) => {
                const judul = card.getAttribute("data-judul") || "";
                const penulis = card.getAttribute("data-penulis") || "";
                const isMatch =
                    judul.includes(searchTerm) || penulis.includes(searchTerm);

                if (isMatch) {
                    card.style.display = "block";
                    visibleCount++;
                } else {
                    card.style.display = "none";
                }
            });

            // Tampilkan pesan jika tidak ada hasil yang cocok
            if (searchTerm !== "" && visibleCount === 0 && noSearchResults) {
                noSearchResults.classList.remove("hidden");
            }

            // Tampilkan kembali pesan default jika pencarian dikosongkan
            if (
                searchTerm === "" &&
                riwayatCards.length === 0 &&
                noRiwayatDefault
            ) {
                noRiwayatDefault.classList.remove("hidden");
            }
        });

        // Reset saat halaman dimuat ulang
        searchInput.addEventListener("search", function () {
            if (this.value === "") {
                riwayatCards.forEach((card) => {
                    card.style.display = "block";
                });

                if (noSearchResults) {
                    noSearchResults.classList.add("hidden");
                }

                if (riwayatCards.length === 0 && noRiwayatDefault) {
                    noRiwayatDefault.classList.remove("hidden");
                }
            }
        });
    }
    // MODAL PDF
    window.openPdfModal = function (url) {
        const iframe = document.getElementById("pdfFrame");
        const modal = document.getElementById("pdfModal");

        iframe.src = url + "#toolbar=0&navpanes=0&scrollbar=1&zoom=page-width";
        modal.classList.remove("hidden");

        // lock scroll background (mobile)
        document.body.classList.add("overflow-hidden");
    };

    window.closePdfModal = function () {
        document.getElementById("pdfFrame").src = "";
        document.getElementById("pdfModal").classList.add("hidden");

        document.body.classList.remove("overflow-hidden");
    };
});
