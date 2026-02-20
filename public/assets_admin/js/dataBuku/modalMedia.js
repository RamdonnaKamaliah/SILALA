document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modalGambar");
    const openBtn = document.getElementById("openModalBtn");
    const closeBtn = document.getElementById("closeModalBtn");

    if (!modal || !openBtn || !closeBtn) return;

    openBtn.addEventListener("click", () => {
        modal.classList.remove("hidden");
        modal.classList.add("flex");
    });

    closeBtn.addEventListener("click", () => {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
    });
});

function pilihGambar(id, full_path) {
    const fotoId = document.getElementById("foto_id");
    const preview = document.getElementById("previewImage");
    const modal = document.getElementById("modalGambar");

    if (fotoId) fotoId.value = id;
    if (preview) preview.src = full_path;
    if (modal) modal.classList.add("hidden");
}
