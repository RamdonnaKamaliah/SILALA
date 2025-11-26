function updateBulkButtons() {
    const checkedCount = $(".row-checkbox:checked").length;
    $("#bulkDeleteBtn")
        .prop("disabled", checkedCount === 0)
        .text(
            checkedCount > 0
                ? "Hapus (" + checkedCount + ") Data Terpilih"
                : "Hapus Data Terpilih"
        );
    $("#bulkArchiveBtn")
        .prop("disabled", checkedCount === 0)
        .text(
            checkedCount > 0
                ? "Arsipkan (" + checkedCount + ") Data Terpilih"
                : "Arsipkan Data Terpilih"
        );
}

$("#selectAll").on("click", function () {
    $(".row-checkbox").prop("checked", this.checked);
    updateBulkButtons();
});

$(document).on("change", ".row-checkbox", updateBulkButtons);

function appendSelectedIdsToForm(formId) {
    const form = $(formId);
    form.find('input[name="selected_ids[]"]').remove();
    $(".row-checkbox:checked").each(function () {
        form.append(
            `<input type="hidden" name="selected_ids[]" value="${$(
                this
            ).val()}">`
        );
    });
}

$("#bulkDeleteBtn").on("click", function (e) {
    e.preventDefault();
    if (
        $(".row-checkbox:checked").length > 0 &&
        confirm("Yakin ingin menghapus data terpilih?")
    ) {
        appendSelectedIdsToForm("#bulkDeleteForm");
        $("#bulkDeleteForm").submit();
    }
});

$("#bulkArchiveBtn").on("click", function (e) {
    e.preventDefault();
    var selectedIds = $(".row-checkbox:checked")
        .map(function () {
            return this.value;
        })
        .get();

    if (
        selectedIds.length > 0 &&
        confirm(
            "Apakah Anda yakin ingin mengarsipkan " +
                selectedIds.length +
                " buku?"
        )
    ) {
        $("#selectedIdsArchive").val(selectedIds);
        $("#bulkArchiveForm").submit();
    }
});

updateBulkButtons();
