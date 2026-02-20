// Fungsi untuk update tampilan tombol bulk
function updateBulkButtons() {
    const checkedCount = $(".row-checkbox:checked").length;

    // Tombol Hapus
    $("#bulkDeleteBtn")
        .prop("disabled", checkedCount === 0)
        .toggleClass(
            "cursor-not-allowed opacity-50 bg-gray-400",
            checkedCount === 0
        )
        .toggleClass(
            "cursor-pointer bg-red-600 hover:bg-red-700",
            checkedCount > 0
        )
        .text(
            checkedCount > 0
                ? "Hapus (" + checkedCount + ") Data Terpilih"
                : "Hapus Data Terpilih"
        );

    // Tombol Pulihkan
    $("#bulkRestoreBtn")
        .prop("disabled", checkedCount === 0)
        .toggleClass(
            "cursor-not-allowed opacity-50 bg-gray-400",
            checkedCount === 0
        )
        .toggleClass(
            "cursor-pointer bg-green-600 hover:bg-green-700",
            checkedCount > 0
        )
        .text(
            checkedCount > 0
                ? "Pulihkan (" + checkedCount + ") Data Terpilih"
                : "Pulihkan Data Terpilih"
        );
}

// Checkbox "Pilih Semua"
$("#selectAll").on("click", function () {
    $(".row-checkbox").prop("checked", this.checked);
    updateBulkButtons();
});

// Checkbox individual
$(document).on("change", ".row-checkbox", updateBulkButtons);

// Tombol Pulihkan
$("#bulkRestoreBtn").on("click", function (e) {
    e.preventDefault();

    const selectedIds = $(".row-checkbox:checked")
        .map(function () {
            return this.value;
        })
        .get();

    if (
        selectedIds.length > 0 &&
        confirm(
            "Apakah Anda yakin ingin memulihkan " +
                selectedIds.length +
                " buku arsip?"
        )
    ) {
        $("#selectedIdsRestore").val(selectedIds);
        $("#bulkRestoreForm").submit();
    }
});

// Tombol Hapus Permanen
$("#bulkDeleteBtn").on("click", function (e) {
    e.preventDefault();

    const selectedIds = $(".row-checkbox:checked")
        .map(function () {
            return this.value;
        })
        .get();

    if (
        selectedIds.length > 0 &&
        confirm(
            "Apakah Anda yakin ingin menghapus permanen " +
                selectedIds.length +
                " buku arsip?"
        )
    ) {
        $("#selectedIds").val(selectedIds); // hidden input delete
        $("#bulkDeleteArchiveForm").submit(); // form delete
    }
});

// Jalankan awal
updateBulkButtons();
