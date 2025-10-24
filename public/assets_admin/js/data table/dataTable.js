$(document).ready(function () {
    // Initialize DataTable
    var table = $("#dataTable").DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json",
        },
        pageLength: 5,
        columnDefs: [
            {
                orderable: false,
                targets: [0, 1, 9, 10],
            }, // Kolom checkbox, foto, file, aksi
            {
                searchable: false,
                targets: [0, 1, 9],
            }, // Kolom checkbox, foto, file
        ],
    });
});
