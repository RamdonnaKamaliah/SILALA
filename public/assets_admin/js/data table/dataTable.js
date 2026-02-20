$(document).ready(function () {
    // Initialize DataTable
    var table = $("#dataTable").DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json",
        },
        pageLength: 5,
        responsive: true,
        autoWidth: false,
        columnDefs: [
            {
                orderable: false,
                targets: [0, 2, 10, 11], // ✅ Checkbox, Foto, File, Aksi
            },
            {
                searchable: false,
                targets: [0, 2, 10, 11], // ✅ Checkbox, Foto, File, Aksi
            },
        ],
    });

    // Checkbox Select All
    $("#selectAll").on("change", function () {
        $(".row-checkbox").prop("checked", this.checked);
        updateBulkButtons();
    });

    // Checkbox Individual
    $(document).on("change", ".row-checkbox", function () {
        updateBulkButtons();
    });

    // Update Bulk Action Buttons
    function updateBulkButtons() {
        const checked = $(".row-checkbox:checked").not("#selectAll").length;
        const deleteBtn = $("#bulkDeleteBtn");
        const archiveBtn = $("#bulkArchiveBtn");

        if (checked > 0) {
            deleteBtn
                .removeClass("opacity-50 bg-gray-400 cursor-not-allowed")
                .addClass("bg-red-600 hover:bg-red-700")
                .prop("disabled", false);
            archiveBtn
                .removeClass("opacity-50 bg-gray-400 cursor-not-allowed")
                .addClass("bg-yellow-600 hover:bg-yellow-700")
                .prop("disabled", false);

            const ids = $(".row-checkbox:checked")
                .not("#selectAll")
                .map(function () {
                    return $(this).val();
                })
                .get();

            $("#selectedIdsDelete").val(JSON.stringify(ids));
            $("#selectedIdsArchive").val(JSON.stringify(ids));
        } else {
            deleteBtn
                .addClass("opacity-50 bg-gray-400 cursor-not-allowed")
                .removeClass("bg-red-600 hover:bg-red-700")
                .prop("disabled", true);
            archiveBtn
                .addClass("opacity-50 bg-gray-400 cursor-not-allowed")
                .removeClass("bg-yellow-600 hover:bg-yellow-700")
                .prop("disabled", true);
        }
    }
});
