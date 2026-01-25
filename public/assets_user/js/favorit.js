// favorit.js
document.addEventListener("DOMContentLoaded", function () {
    // Setup semua fungsi
    setupFavoritesSearch();
    setupFavoriteButtons();

    function setupFavoritesSearch() {
        const searchInput = document.getElementById("searchBuku");
        const bookCards = document.querySelectorAll(".book-card");
        const noSearchResults = document.getElementById("no-favorites-search");
        const favoritesGrid = document.getElementById("favorites-grid");
        const noFavoritesDefault = document.getElementById(
            "no-favorites-default",
        );

        if (!searchInput || bookCards.length === 0) return;

        function performSearch() {
            const keyword = searchInput.value.toLowerCase().trim();
            let visibleCount = 0;

            noSearchResults?.classList.add("hidden");

            const cards = document.querySelectorAll(".book-card");
            cards.forEach((card) => {
                const judul = card.dataset.judul || "";
                const penulis = card.dataset.penulis || "";
                const isMatch =
                    judul.includes(keyword) || penulis.includes(keyword);

                card.style.display = isMatch ? "flex" : "none";
                if (isMatch) visibleCount++;
            });

            // Jika sedang search & tidak ada hasil
            if (keyword !== "" && visibleCount === 0) {
                favoritesGrid.style.display = "none";
                noSearchResults?.classList.remove("hidden");
                noFavoritesDefault?.classList.add("hidden");
                return;
            }

            // Reset ke kondisi normal
            favoritesGrid.style.display = "grid";

            // Default empty HANYA jika benar-benar kosong
            if (cards.length === 0) {
                noFavoritesDefault?.classList.remove("hidden");
            } else {
                noFavoritesDefault?.classList.add("hidden");
            }
        }

        searchInput.addEventListener("input", performSearch);
        searchInput.addEventListener("search", function () {
            if (this.value === "") performSearch();
        });
    }

    function setupFavoriteButtons() {
        // Setup event listener untuk semua tombol favorit
        document.addEventListener("click", function (e) {
            const favoriteBtn = e.target.closest(".favorite-btn");
            if (favoriteBtn) {
                e.preventDefault();
                const bookId = favoriteBtn.getAttribute("data-book-id");
                hapusFavorite(favoriteBtn, bookId);
            }
        });
    }

    // Fungsi untuk menghapus favorit
    async function hapusFavorite(button, bookId) {
        try {
            const result = await Swal.fire({
                title: "Yakin?",
                text: "Buku ini akan dihapus dari favorit",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus",
                cancelButtonText: "Batal",
                confirmButtonColor: "#8CA47E", // hijau
                cancelButtonColor: "#d33", // merah
                reverseButtons: true,
            });

            if (!result.isConfirmed) return;

            // Ambil CSRF token dari meta tag
            const csrfToken =
                document
                    .querySelector('meta[name="csrf-token"]')
                    ?.getAttribute("content") ||
                document.querySelector('input[name="_token"]')?.value;

            if (!csrfToken) {
                console.error("CSRF token not found");
                alert("Terjadi kesalahan. Silakan refresh halaman.");
                return;
            }

            // Kirim request DELETE (bukan POST karena menghapus)
            const favoritRoute = button.dataset.favoritRoute;

            const response = await fetch(favoritRoute, {
                method: "POST", // Karena Laravel menggunakan POST untuk toggle
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                    Accept: "application/json",
                },
                body: JSON.stringify({
                    buku_id: bookId,
                    _method: "POST", // Untuk simulasi metode yang sesuai
                }),
            });

            await response.json();

            if (response.ok) {
                // Hapus card buku dari DOM
                const bookCard = button.closest(".book-card");
                if (bookCard) {
                    bookCard.remove();
                }

                // 🔥 PANGGIL SETELAH REMOVE, TANPA SYARAT
                handleEmptyFavoritesAfterDelete();

                showNotification(
                    "Buku berhasil dihapus dari favorit",
                    "success",
                );
            } else {
                throw new Error("Failed to remove favorite");
            }
        } catch (error) {
            console.error("Error:", error);
            showNotification(
                "Gagal menghapus favorit. Silakan coba lagi.",
                "error",
            );
        }
    }

    function showNotification(message, type = "success") {
        Swal.fire({
            icon: type === "success" ? "success" : "error",
            title: message,
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false,
            allowOutsideClick: false,
            didOpen: () => {},
        });
    }

    // Ekspos fungsi ke global scope
    window.hapusFavorite = hapusFavorite;

    // ====== MODAL PDF ======
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
