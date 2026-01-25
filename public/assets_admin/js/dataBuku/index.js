document.addEventListener("DOMContentLoaded", function () {
    const selectAll = document.getElementById("selectAll");
    const checkboxes = document.querySelectorAll(".row-checkbox");

    const bulkDeleteBtn = document.getElementById("bulkDeleteBtn");
    const bulkArchiveBtn = document.getElementById("bulkArchiveBtn");

    const selectedIdsDelete = document.getElementById("selectedIdsDelete");
    const selectedIdsArchive = document.getElementById("selectedIdsArchive");

    function update() {
        const checked = document.querySelectorAll(".row-checkbox:checked");
        const ids = Array.from(checked).map((cb) => cb.value);

        selectedIdsDelete.value = ids.join(",");
        selectedIdsArchive.value = ids.join(",");

        bulkDeleteBtn.disabled = ids.length === 0;
        bulkArchiveBtn.disabled = ids.length === 0;
    }

    selectAll.addEventListener("change", function () {
        checkboxes.forEach((cb) => (cb.checked = this.checked));
        update();
    });

    checkboxes.forEach((cb) => {
        cb.addEventListener("change", update);
    });
});
