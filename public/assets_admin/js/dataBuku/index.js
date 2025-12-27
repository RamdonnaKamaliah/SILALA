document.addEventListener("DOMContentLoaded", function () {
    const selectAll = document.getElementById("selectAll");
    const bulkDeleteBtn = document.getElementById("bulkDeleteBtn");
    const bulkDeleteForm = document.getElementById("bulkDeleteForm");

    if (!selectAll || !bulkDeleteBtn || !bulkDeleteForm) return;

    const rowCheckboxes = document.querySelectorAll(".row-checkbox");

    selectAll.addEventListener("change", function () {
        const isChecked = this.checked;
        rowCheckboxes.forEach((checkbox) => {
            checkbox.checked = isChecked;
            checkbox.closest("tr")?.classList.toggle(
                "bg-[#A4B465]/10",
                isChecked
            );
        });
        updateBulkDeleteButton();
    });

    function updateBulkDeleteButton() {
        const checkedBoxes = document.querySelectorAll(".row-checkbox:checked");

        if (checkedBoxes.length > 0) {
            bulkDeleteBtn.disabled = false;

            bulkDeleteBtn.onclick = function () {
                if (
                    confirm(
                        `Apakah Anda yakin ingin menghapus ${checkedBoxes.length} buku yang dipilih?`
                    )
                ) {
                    bulkDeleteForm.submit();
                }
            };
        } else {
            bulkDeleteBtn.disabled = true;
            bulkDeleteBtn.onclick = null;
        }
    }

    // Fungsi Search
    const searchInput = document.getElementById("search");
    if (searchInput) {
        searchInput.addEventListener("input", function () {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll("#dataTable tbody tr");

            rows.forEach((row) => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    }

    // Fungsi Entries
    const entriesSelect = document.getElementById("entries");
    if (entriesSelect) {
        entriesSelect.addEventListener("change", function () {
            // Implementasi pagination berdasarkan jumlah entries
            console.log("Entries changed to:", this.value);
            // Di sini Anda bisa menambahkan logika untuk mengubah jumlah data yang ditampilkan
        });
    }
});
