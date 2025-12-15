const modal = document.getElementById("modalGambar");
const openBtn = document.getElementById("openModalBtn");
const closeBtn = document.getElementById("closeModalBtn");

const preview = document.getElementById("previewImage");
const inputHidden = document.getElementById("gambar_buku");

openBtn.addEventListener("click", () => {
    modal.classList.remove("hidden");
    modal.classList.add("flex");
});

closeBtn.addEventListener("click", () => {
    modal.classList.add("hidden");
    modal.classList.remove("flex");
});

function pilihGambar(id, full_path) {
    document.getElementById("foto_id").value = id;
    document.getElementById("previewImage").src = full_path;
    document.getElementById("modalGambar").classList.add("hidden");
}
